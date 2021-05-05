<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('mailer');
    }

    function get_datatables($forQuery, $tableId)
    {
        $this->_get_datatables_query($forQuery, $tableId);
        if($_POST['length'] != -1){
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_datatables_query($forQuery, $tableId)
    {   
        $userInfo = $this->getUserDetail($this->session->userdata('Noreg'));

        if(strtolower($tableId) == "tableemployee"){
            $forQuery["columnSelect"] = array_merge($forQuery["columnSelect"], array(
                '(SELECT start_dt FROM tb_t_pengajuan_cuti WHERE noreg = emp.noreg ORDER BY id DESC LIMIT 1) start_dt',
                '(SELECT until_dt FROM tb_t_pengajuan_cuti WHERE noreg = emp.noreg ORDER BY id DESC LIMIT 1) until_dt',
                '(SELECT is_approve FROM tb_t_pengajuan_cuti WHERE noreg = emp.noreg ORDER BY id DESC LIMIT 1) is_approve'
            ));
        }

        $this->db->select($forQuery["columnSelect"]);
        $this->db->from($forQuery["table"]);

        if(strtolower($tableId) == "tableemployee"){
            $this->db->join('tb_m_sex gend', 'gend.id = emp.sex');
            $this->db->join('tb_m_occupation occ', 'occ.id = emp.position');
            $this->db->join('tb_m_division divs', 'divs.id = emp.division');
            $this->db->join('tb_r_logon log', 'log.noreg = emp.noreg');
            $this->db->join('tb_m_status stat', 'stat.id = log.status');
            $this->db->join('tb_r_employee emp2', 'emp2.noreg = emp.pic', 'left');
            
            $this->db->where(array("emp.noreg !=" => $this->session->userdata('Noreg'), "emp.position !=" => 1) );
            if($userInfo->id_position == 2 && $userInfo->id_division != 'DK'){
                $this->db->where('emp.division', $userInfo->id_division);
            }else if($userInfo->id_division == 'DK'){
                $this->db->where('emp.position != ', 2);
            }
        }else if(strtolower($tableId) == "tableoccupation"){
            $this->db->join('tb_m_access acc', 'occ.access = acc.id');
        }

        $i = 0;
    
        foreach ($forQuery["columnSearch"] as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($forQuery["columnSearch"]) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($forQuery["columnOrder"][$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($forQuery["order"]))
        {
            $order = $forQuery["order"];
            $key = array_keys($order);
            foreach($key as $k){
                $this->db->order_by($k, $order[$k]);  
            }
        }
    }

    public function count_all($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    function count_filtered($forQuery, $tableId)
    {
        $this->_get_datatables_query($forQuery, $tableId);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getGender(){
        $this->db->select('id, description');
        $this->db->from('tb_m_sex');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function getPosition(){
        $sql = "SELECT id, position FROM tb_m_occupation where id != 1";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getDivision(){
        $this->db->select('id, description');
        $this->db->from('tb_m_division');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function getEmpLastId($division){
        $sql = "SELECT EXISTS(Select 1 from tb_r_employee where DIVISION = '$division') as result";
        $query = $this->db->query($sql);
        $result = $query->row();
        if($result->result == 0){
            return 1;
        }else{
            $i = 1;
            $checkOrder = "
                SELECT SUBSTRING(REVERSE(NOREG), 1, (INSTR(REVERSE(NOREG), '/') - 1)) as result
                FROM tb_r_employee 
                WHERE division = '$division'
                ORDER BY result ASC
            ";
            $executeOrder = $this->db->query($checkOrder);
            $getOrderNumber = $executeOrder->result();
            foreach($getOrderNumber as $orderNumber){
                if($orderNumber->result != $i){
                    break;
                }
                $i++;
            }
            return $i;
        }
    }

    public function getLogonLastId(){
        $i = 1;
        $sql = "SELECT id FROM tb_r_logon ORDER BY id ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        foreach($result as $r){
            if($r->id != $i){
                break;
            }
            $i++;
        }
        return $i;
    }

    public function insertIntoDatabase($table, $data){
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function updateDatabaseTable($table, $dataUpdate, $id){
        $data = array_merge($dataUpdate, array("updated_by" => $this->session->userdata("Username"), "updated_dt" => date('Y-m-d h:i:s')));
        $this->db->update($table, $data, $id);
        return $this->db->affected_rows();
    }

    public function addToLogon($data){
        $this->db->insert('tb_r_logon', $data);
        return $this->db->affected_rows();
    }
    
    public function checkIfExist($table, $whereClause, $params){
        $sql = "SELECT EXISTS(Select 1 from ".$table." where ".$whereClause." = '$params') as result";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }

    public function getById($table, $column, $whereClause, $id){
        $sql = "SELECT ".$column." FROM ".$table." WHERE ".$whereClause." = '$id'";
        $query = $this->db->query($sql);
        return $query->row_object();
    }

    public function deleteEmployee($noreg){
        $this->db->where('noreg', $noreg);
        $this->db->delete('tb_r_logon');
        $result = $this->db->affected_rows();
        if($result == 1){
            $this->db->where('noreg', $noreg);
            $this->db->delete('tb_r_employee');
            return $this->db->affected_rows();
        }else{
            return $result;
        }
    }

	public function update_password($userId){
        $pass = password_hash($this->input->post('newpass'), PASSWORD_BCRYPT);
        $data = array('password' => $pass);
        
		$this->db->where('noreg', $userId);
		$query = $this->db->update('tb_r_logon',$data);
		return ($query === true) ? true : false ;
	}

    public function getPhoto($noreg){
        $sql = "SELECT photo, username FROM tb_r_employee WHERE noreg = '$noreg'";
        $query = $this->db->query($sql);
        return $query->row_object();
    }

	public function cek_oldpass($userId = NULL){
		if($userId){
			$get = $this->getUserDataById($userId);
            return password_verify($this->input->post('oldpass'), $get['password']);
		}
	}

	public function getUserDataById($userId) {
		$sql = " 
            SELECT log.password, emp.photo, emp.signature, emp.username FROM tb_r_employee emp 
            JOIN tb_r_logon log ON emp.noreg = log.noreg
            WHERE emp.noreg = ?
        ";
		$query = $this->db->query($sql, array($userId));
		return $query->row_array();
	}

    public function getUserDetail($sessionData){
        $statement = "
            SELECT 
                emp.name, 
                emp.noreg, 
                emp.username, 
                occ.position, 
                occ.id id_position, 
                emp.photo, 
                divs.description division,
                divs.id id_division, 
                emp.pic, 
                emp.signature,
                emp.email,
                (SELECT until_dt FROM tb_t_pengajuan_cuti WHERE noreg = emp.noreg ORDER BY id DESC LIMIT 1) until_dt,
                (SELECT is_approve FROM tb_t_pengajuan_cuti WHERE noreg = emp.noreg ORDER BY id DESC LIMIT 1) is_approve
            FROM tb_r_employee emp
            JOIN tb_m_occupation occ ON emp.position = occ.id 
            JOIN tb_m_division divs on emp.division = divs.id
            WHERE emp.noreg = '$sessionData'
        ";
        // (SELECT until_dt FROM tb_t_pengajuan_cuti WHERE noreg = emp.noreg AND is_approve = 2) until_dt
        $query = $this->db->query($statement);
        $result = $query->row();
        return $result;
    }

    public function getListPositionByDivision($division){
        $sql = "
            SELECT DISTINCT occ.position
            FROM tb_r_employee emp
            JOIN tb_m_occupation occ ON emp.position = occ.id
            WHERE emp.division = '$division' AND emp.position != 1
            ORDER BY occ.position ASC
        ";
        $query = $this->db->query($sql);
        return $query->result_object();
    }

    public function getPic($positionId, $division){
        $sql = "
            SELECT noreg, name
            FROM tb_r_employee
            WHERE position = '$positionId' AND division = '$division'
        ";
        $query = $this->db->query($sql);
        return $query->result_object();
    }

    public function getInfoMessage($userInfo){
        $sql = "
            SELECT emp.name, emp.photo, email.read_status, email.receive_dt, emp.username, email.id id_email
            FROM tb_r_email email
            JOIN tb_r_employee emp
            ON email.sender = emp.noreg
            WHERE email.receiver = '$userInfo->noreg' AND email.read_status = 0 ORDER BY email.receive_dt desc
        ";
        // WHERE ".($userInfo->id_division == 'DK' ? "email.receiver = '$userInfo->noreg'" : "1=1")." AND
        // if($userInfo->id_position != 4){
        //     if($userInfo->id_division != 'DK'){
        //         $sql = $sql."emp.pic = '$userInfo->noreg' AND emp.division = '$userInfo->id_division' AND";
        //     }
        // }else{
        //     $sql = $sql."email.receiver = '$userInfo->noreg' AND";
        // }
        // $sql = $sql." email.read_status = 0 ORDER BY email.receive_dt desc";
        $query = $this->db->query($sql);
        return $query;
    }

    public function sendEmail($receiver, $subject, $content){
        $returnSendEmailStatus = array('status' => false, 'status_email' => '', 'msg' => '');
        $sendmail = array(
          'email_penerima'=> $receiver,
          'subjek' => $subject,
          'content' => $content
        );
        
        $send = $this->mailer->send($sendmail);
        if($send['status'] == "Sukses"){
            $returnSendEmailStatus['status'] = true;
        }
        $returnSendEmailStatus['status_email'] = $send['status'];
        $returnSendEmailStatus['msg'] = $send['message'];
        return $returnSendEmailStatus;
    }
}