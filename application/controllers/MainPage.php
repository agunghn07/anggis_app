<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainPage extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function message($title = NULL, $text = NULL, $type = NULL){
		return $this->session->set_flashdata([
			'title'	=> $title,
			'text'	=> $text,
			'type'	=> $type
		]);
	}

	public function index()
	{
        // $sessionData = $this->master->getUserDetail($this->session->userdata('Noreg'));
        // $gender = $this->master->getGender();
        // $position = $this->master->getPosition();
        // $division = $this->master->getDivision();

        // $this->parseData['Division'] = $division;
        // $this->parseData['Position'] = $position;
        // $this->parseData['Gender'] = $gender;
        // $this->parseData['userDetail'] = $sessionData;
        $this->parseData['title']   = 'Master Page';
        $this->parseData['menu']   = 'Dashboard';
        $this->parseData['submenu']   = 'Master';
		$this->parseData['content'] = 'content/dashboard/screenDashboard';
		$this->load->view('MainView/backendView', $this->parseData);
    }
    
    public function list_employee(){
        $tableId = "tableEmployee";
        $table = 'tb_r_employee emp';
        $column_order = array(
            'emp.noreg','','emp.name','emp.username','gend.description', 'occ.position', 'divs.description', 'pic.name', ''
        ); 
        $column_search = array(
            'emp.noreg','emp.name','emp.username','gend.description', 'stat.description', 'occ.position', 'divs.description'
        ); 
        $column_select = array(
            'emp.noreg', 'emp.name', 'emp.username', 'stat.description status', 'log.status status_id', 'occ.id id_position', 'divs.id division_id',
            'gend.description sex', 'emp.photo', 'occ.position', 'divs.description division', 'emp2.name pic', 'emp2.noreg pic_noreg'
        );
        $order = array('emp.division' => 'desc', 'emp.position' => 'asc');   
        $forQuery = [
            "table"        => $table,
            "columnOrder"  => $column_order, 
            "columnSearch" => $column_search, 
            "columnSelect" => $column_select, 
            "order"        => $order
        ];
        $listData = $this->master->get_datatables($forQuery, $tableId);
        $data = [];
        foreach ($listData as $list) {
            $status = $list->status;
            $class = null;
            if((date('Y-m-d') >= $list->start_dt && date('Y-m-d') <= $list->until_dt) && $list->is_approve == 3){
                $status = 'Sedang Cuti';
                $class  = 'label-info';
            }
            $row = array();
            $row[] = $list->noreg;
            if($list->photo)
                $row[] = '<img src="'.base_url('assets/img/empPhoto/'.$list->photo).'" height="40px" width="40px;" class="img-circle" style="box-shadow: 1px 1px 3px rgba(0,0,0,0.5)"/>';
            else
                $row[] = '(No Result)';
            $row[] = $list->name;
            $row[] = $list->username;
            $row[] = $list->sex;
            $row[] = $list->position;
            $row[] = $list->division;

            if(($list->id_position == 4) && ($list->division_id != 'DK')){
                $row[] = '<p class="picText" data-noreg="'.$list->noreg.'" data-picnoreg="'.$list->pic_noreg.'" data-division="'.$list->division_id.'">'.$list->pic.'</a>';
            }else{
                $row[] = ($list->pic == null ? "(No PIC)" : $list->pic);
            }

            if($list->status_id == 1)
                $row[] = '<p class="label '.($class != null ? $class : "label-primary label-status").'" id="status'.$list->username.'" status='.$list->status_id.'>'.$status.'</a>';
            else
                $row[] = '<p class="label label-default label-status" id="status'.$list->username.'" status='.$list->status_id.'>'.$status.'</a>';

            $row[] = '
            		<div class="btn-group-horizontal">
                      <button type="button" class="btn btn-sm btn-primary btn-outline" title="Edit" id="btnEditEmp" data-noreg="'.$list->noreg.'">
                        <i class="fa fa-edit"></i>
                      </button>
                    </div>';
            $data[] = $row;
        }
        $this->returnToDataTables($_POST, $forQuery, $tableId, $data);
    }
    
    public function list_division(){
        $column_order  = array('id');
        $column_search = array('id','description'); 
        $column_select = "*";
        $order = array('id' => 'desc');   
        $forQuery = [
            "table"        => 'tb_m_division',
            "columnOrder"  => $column_order, 
            "columnSearch" => $column_search, 
            "columnSelect" => $column_select, 
            "order"        => $order
        ];
        $tableId = "tableDivision";
        $listData = $this->master->get_datatables($forQuery, $tableId);
        $data = array();
        $no = $_POST["start"];
        foreach ($listData as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->ID;
            $row[] = $list->DESCRIPTION;
            $row[] = '
            		<div class="btn-group-horizontal">
                      <button type="button" class="btn btn-sm btn-primary btn-outline" title="Edit" id="btnEditDivision" data-id="'.$list->ID.'">
                        <i class="fa fa-edit"></i>
                      </button>
                    </div>';
            $data[] = $row;
        }
        $this->returnToDataTables($_POST, $forQuery, $tableId, $data);
    }

    public function list_position(){
        $column_order  = array('id');
        $column_search = array('occ.id','occ.position', 'acc.description'); 
        $column_select = array("occ.id", "occ.position", "acc.description");
        $order = array('id' => 'asv');   
        $forQuery = [
            "table"        => 'tb_m_occupation occ',
            "columnOrder"  => $column_order, 
            "columnSearch" => $column_search, 
            "columnSelect" => $column_select, 
            "order"        => $order
        ];
        $tableId = "tableOccupation";
        $listData = $this->master->get_datatables($forQuery, $tableId);
        $data = array();
        foreach ($listData as $list) {
            $row = array();
            $row[] = $list->id;
            $row[] = $list->position;
            $row[] = $list->description;
            $row[] = '
            		<div class="btn-group-horizontal">
                      <button type="button" class="btn btn-sm btn-primary btn-outline" title="Edit" id="btnEditOccupation" data-position="'.$list->position.'" data-id="'.$list->id.'">
                        <i class="fa fa-edit"></i>
                      </button>
                    </div>';
            $data[] = $row;
        }
        $this->returnToDataTables($_POST, $forQuery, $tableId, $data);
    }
    
    public function returnToDataTables($post, $forQuery, $tableId, $data){
        $output = array(
            "draw" => $post['draw'],
            "recordsTotal" => $this->master->count_all($forQuery["table"]),
            "recordsFiltered" => $this->master->count_filtered($forQuery, $tableId),
            "data" => $data,
        );
        echo json_encode($output);
    }

	public function change_password(){
		$validate = array('success'=> false, 'messages' => array());

		$this->form_validation->set_rules('oldpass','Password Lama','trim|required|callback_cekpass',
			array(
				'required'	 => '* The Password field is required',
			));
		$this->form_validation->set_rules('newpass','Password Baru','callback_valid_password');
		$this->form_validation->set_rules('confirm','Konfirmasi','trim|required|matches[newpass]',
			array(
				'matches'	 => "* Password doesn't match ",
				'required'	 => '* The Password field is required',
			));

		/*untuk menampilkan pesan error lalu pada view */
		$this->form_validation->set_error_delimiters('<small class="text-danger">','</small>');
		if($this->form_validation->run() === true){
            $userId = $this->session->userdata('Noreg');
            $query  = $this->master->update_password($userId);

            if($query){
                $validate['success'] = true;
            }   
            
		}else{
			$validate['success'] = false;
			foreach($_POST as $key=>$value){
				$validate['messages'][$key] = form_error($key);
			}
		}
		echo json_encode($validate);
	}

    public function valid_password($password = ''){
        $password = trim($password);

        // Strong password validation
        // $regex_lowercase = '/[a-z]/';
        // $regex_uppercase = '/[A-Z]/';
        // $regex_number = '/[0-9]/';
        // $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

        if(empty($password)){
            $this->form_validation->set_message('valid_password', '* The Password field is required');
            return FALSE;
        }
        // if(preg_match_all($regex_lowercase, $password) < 1){
        //     $this->form_validation->set_message('valid_password', '* The Password field must be at least one lowercase letter.');
        //     return FALSE;
        // }
        // if(preg_match_all($regex_uppercase, $password) < 1){
        //     $this->form_validation->set_message('valid_password', '* The Password field must be at least one uppercase letter.');
        //     return FALSE;
        // }
        // if(preg_match_all($regex_number, $password) < 1){
        //     $this->form_validation->set_message('valid_password', '* The Password field must be at least one number.');
        //     return FALSE;
        // }
        // if(preg_match_all($regex_special, $password) < 1){
        //     $this->form_validation->set_message('valid_password', '* The Password field must be at least one special character. Ex : YourPassword@1');
        //     return FALSE;
        // }
        // if(strlen($password) < 5){
        //     $this->form_validation->set_message('valid_password', '* The Password field must be at least 5 characters in length.');
        //     return FALSE;
        // }
        // if(strlen($password) > 32){
        //     $this->form_validation->set_message('valid_password', '* The Password field cannot exceed 32 characters in length.');
        //     return FALSE;
        // }

        return TRUE;
    }

	public function cekpass(){
        $userId = $this->session->userdata('Noreg');
        $query  = $this->master->cek_oldpass($userId);
		if($query === true){
			return true;
		}else{
			$this->form_validation->set_message('cekpass',"* Old password doesn't match !");
			return false;
		}
	}

    public function addEditEmployee(){
        $parse = array('status' => false, 'class' => '', 'msg' => '');       
        // $data = $_POST['data'];
        $method = $_POST['method'];

        if($method != 'Edit'){
            $this->checkSignatureFormat($parse, 'nEmpSignature', 'empSignature');
            
            $signatureName = $this->_do_upload('nEmpSignature', 'assets/img/Signature/', $_POST['nEmpUsername'].'.svg');
        }

        $hashPassword = password_hash($_POST['nEmpPassword'], PASSWORD_BCRYPT);
        $division = $_POST['nEmpDivision'];
        $noreg = "Emp/".$division."/".$this->master->getEmpLastId($division);

        if(($_POST['nEmpPosition'] == 4) && ($_POST['nEmpDivision'] != 'DK')){
            $pic = $_POST['nListPic'];
        }else if(($_POST['nEmpPosition'] == 3) || (($_POST['nEmpPosition'] == 4) && ($_POST['nEmpDivision'] == 'DK'))){
            $picList = $this->master->getPic(2, $division);
            $pic = $picList[0]->noreg;
        }else{
            $pic = null;
        }

        if(strtolower($method) == 'add'){
            $dataEmp = array(
                'noreg'      => $noreg, 
                'name'       => $_POST['nEmpName'],
                'username'   => $_POST['nEmpUsername'],
                'sex'        => $_POST['nEmpGender'],
                'email'      => $_POST['nEmpEmail'],
                'position'   => $_POST['nEmpPosition'],
                'pic'        => $pic,
                'division'   => $division,
                'signature'  => $signatureName
            );
    
            $dataLogin = [
                'id'         => $this->master->getLogonLastId(),
                'password'   => $hashPassword,
                'noreg'      => $noreg,
                'status'     => 0
            ];
            $checkUsename = $this->master->checkIfExist("tb_r_employee", "username", $dataEmp['username']);
            if($checkUsename->result == 1){
                $parse['class'] = 'empUsename';
                $parse['msg'] = '* Username already exists';
            }else{
                $this->db->trans_start();
                $toEmpTable = $this->master->insertIntoDatabase('tb_r_employee', $dataEmp);
                if($toEmpTable == 1){
                    $tologTable = $this->master->addToLogon($dataLogin);
                    if($tologTable == 1){
                        $dataCuti = array(
                            'emp_noreg' => $noreg,
                            'periode'   => date("Y"),
                            'sisa_cuti' => 12
                        );
                        $this->master->insertIntoDatabase('tb_t_cuti', $dataCuti);
                        $parse['status'] = true;
                    }
                }   
                $this->db->trans_complete();
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $parse['status'] = false;
            } else {
                $this->db->trans_commit();
            }
        }else{
            $noregUser = ["noreg" => $_POST['nEmpNoreg']];
            $dataUpdate = array("password" => $hashPassword);
            $updateEmp = $this->master->updateDatabaseTable('tb_r_logon', $dataUpdate, $noregUser);
            if($updateEmp == 1){
                $parse['status'] = true;
            }
        }
        echo json_encode($parse);
    }

    public function editBasicProfile(){
        $parse = array('status' => false); 
        // $data = $_POST['data'];
        
        $noregUser = ["noreg" => $_POST['nNoregEmpDashboard']];
        $dataUpdate = array(
            "name"      => $_POST['nNameEmpDashboard'], 
            "username"  => $_POST["nUsernameEmpDashboard"], 
            "email"     => $_POST['nEmailEmpDashboard']
        );

        if(!empty($_FILES['nSignatureEmpDashboard']['name'])){
            $this->checkSignatureFormat($parse, 'nSignatureEmpDashboard', 'empSignatureDashboard');

            $oldSignature = $this->master->getUserDataById($this->session->userdata('Noreg'));
            if(file_exists('assets/img/Signature/'.$oldSignature['signature']) && $oldSignature['signature']){
                unlink('assets/img/Signature/'.$oldSignature['signature']);
            }

            $newSignature = $this->_do_upload('nSignatureEmpDashboard', 'assets/img/Signature/', $_POST['nUsernameEmpDashboard'].'.svg');
            $dataUpdate = array_merge($dataUpdate, array('signature' => $newSignature));
        }

        $updateEmp = $this->master->updateDatabaseTable('tb_r_employee', $dataUpdate, $noregUser);
        if($updateEmp == 1){
            $parse['status'] = true;
        }
        echo json_encode($parse);
    }

    public function checkSignatureFormat($parse, $name, $class){
        if($_FILES[$name]['type'] != 'image/svg+xml'){
            $parse['class'] = $class;
            $parse['msg'] = '* Format file should be .svg !';
            echo json_encode($parse);
            exit();
        }
    }

    public function addEditDivision(){
        $parse = array('status' => false, 'msg' => '', 'class' => '', 'listDivision' => []);       
        $data = $_POST['data'];
        $method = $_POST['method'];
        $division = [
            "id"       => $data["id"],
            "description" => $data["description"]
        ];
        if(strtolower($method) == 'add'){

            $checkDivision = $this->master->checkIfExist("tb_m_division", "id", $division['id']);
            if($checkDivision->result == 1){
                $parse['msg'] = '* Division ID already exists';
                $parse['class'] = 'divisionId';
            }else{
                $resultInsert = $this->master->insertIntoDatabase('tb_m_division', $division);
                if($resultInsert == 1){
                    $parse['status'] = true;
                }   
            }
        }else{
            $key = array_keys($data);
            $id = array($key[0] => $data[$key[0]]);
            $description = array($key[1] => $data[$key[1]]);
            $resultUpdate = $this->master->updateDatabaseTable('tb_m_division', $description , $id);
            if($resultUpdate == 1){
                $parse['status'] = true;
            }
        }
        $parse['listDivision'] = $this->master->getDivision();
        echo json_encode($parse);
    }

    public function EditOccupation(){
        $parse = array('status' => false, 'msg' => '');       
        $data = $_POST['data'];
        $key = array_keys($data);
        $id = array($key[0] => $data[$key[0]]);
        $position = array($key[1] => $data[$key[1]]);

        $result = $this->master->getById('tb_m_occupation', 'position', 'id', $data['id']);
        if($result->position != $data['position']){
            $checkPosition = $this->master->checkIfExist('tb_m_occupation', 'position', $data['position']);
            if($checkPosition->result == 1){
                $parse['msg'] = '* Position Name already exists';
            }else{
                $resultUpdate = $this->master->updateDatabaseTable('tb_m_occupation', $position , $id);
                if($resultUpdate == 1){
                    $parse['status'] = true;
                }
            }
        }else{
            $parse['status'] = true;
        }
        echo json_encode($parse);
    }

    public function getDivisionById(){
        $id = $_POST['id'];
        $return = $this->master->getById("tb_m_division", "description", "id", $id);
        echo json_encode($return->description);
    }

    public function onChangeDivision(){
        $data = ["isHaveManager" => false, "listPic" => []];
        $result = $this->master->getListPositionByDivision($_POST['division']);
        foreach($result as $r){
            if(strtolower($r->position) == "manager"){
                $data["isHaveManager"] = true;
            }
        }
        $data["listPic"] = $result;
        echo json_encode($data);
    }

    public function onChangePosition(){
        $data = ["listPic" => []];
        $picList = $this->master->getPic(3, $_POST["division"]);
        $data["listPic"] = $picList;
        echo json_encode($data);
    }

    public function changeEmpStatus(){
        $return = array('status' => false);
        $key = array_keys($_POST);

        $noreg  = [$key[0] => $_POST[$key[0]]];
        $status = [$key[1] => ($_POST[$key[1]] == 1 ? 0 : 1)]; 
        $result = $this->master->updateDatabaseTable('tb_r_logon', $status, $noreg);
        if($result == 1){
            $return['status'] = true;
        }
        echo json_encode($return);
    }

    public function changePicStaff(){
        $return = array('status' => false);

        $noreg  = ['noreg' => $_POST['noreg']];
        $pic    = ['pic'   => $_POST['pic']]; 
        $result = $this->master->updateDatabaseTable('tb_r_employee', $pic, $noreg);
        if($result == 1){
            $return['status'] = true;
        }
        echo json_encode($return);
    }

	public function deleteEmp(){
        $parse = array('status' => false);
		$person = $this->master->getUserDataById($_POST['noreg']);
        if($person['photo'] != 'noimage.png'){
            if(file_exists('assets/img/empPhoto/'.$person['photo']) && $person['photo']){
           		unlink('assets/img/empPhoto/'.$person['photo']);
           	}
        }
        $result = $this->master->deleteEmployee($_POST['noreg']);
        if($result == 1){
            $parse['status'] = true;
        }
		echo json_encode($parse);
	}

	public function change_photo(){

        if(!empty($_FILES['file']['name']))
        {
            $upload = $this->_do_upload('file', 'assets/img/empPhoto/');
                
            //delete file
            $person = $this->master->getUserDataById($this->session->userdata('Noreg'));
            if($person['photo'] != 'noimage.png'){
                if(file_exists('assets/img/empPhoto/'.$person['photo']) && $person['photo']){
                    unlink('assets/img/empPhoto/'.$person['photo']);
                }
            }
            // $data['photo'] = $upload;
            $data = ['photo' => $upload];
        }
        $id = array('noreg' => $this->session->userdata('Noreg'));
        $hasil = $this->master->updateDatabaseTable("tb_r_employee", $data, $id);
        echo json_encode(array("status" => TRUE, "filename" => $upload));
    }
    
    public function removeCurrentPhoto(){
        $parse = array('status' => false, 'msg' => '', 'photo' => '');
        $noreg = ['noreg' => $this->session->userdata('Noreg')];

        $photoBefore = $this->master->getPhoto($noreg['noreg']);
        $photo = array('photo' => 'noimage.png');
        if(file_exists('assets/img/empPhoto/'.$photoBefore->photo) && $photoBefore->photo){
            unlink('assets/img/empPhoto/'.$photoBefore->photo);
        }

        $result = $this->master->updateDatabaseTable("tb_r_employee", $photo, $noreg);
        if($result == 1){
            $photoAfter = $this->master->getPhoto($noreg['noreg']);
            $parse['status'] = true;
            $parse['photo'] = $photoAfter->photo;
        }else{
            $parse['msg'] = 'There are something wrong';
        }
        echo json_encode($parse);
    }

    private function _do_upload($name, $path, $fileName = null)
    {
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
        $config['max_size']             = 10000; //set max size allowed in Kilobyte
        $config['max_width']            = 10000; // set max width image allowed
        $config['max_height']           = 10000; // set max height allowed
        $config['file_name']            = $fileName; //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload($name)) //upload and validate
        {
            $data['inputerror'][] = $name;
            $data['error_string'][] = $this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }else{
            $gbr = $this->upload->data();
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = './'.$path.''.$gbr['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 500;
            $config['height'] = 500;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            return $gbr['file_name'];
        }
    }

    public function getNotif(){
        // $test = $_POST['view'];
        $userInfo = $this->master->getUserDetail($this->session->userdata('Noreg'));
        $notifMessage = $this->master->getInfoMessage($userInfo);
        $output = "";
        
        if($notifMessage->num_rows() > 0){
            foreach($notifMessage->result_array() as $data){
                $date = $data['receive_dt'];
                $time = strtotime($date);
                $newDate = date('H:i:s, d F Y', $time);
                $output .= '
                <li>
                    <div class="dropdown-messages-box" data-url="'.base_url('NotifikasiSurel/index/'.$data['id_email']).'" style="cursor: pointer;" onclick="moveToNotifikasiSurel(this)">
                        <a href="#" class="pull-left">
                            <img alt="image" class="img-circle" src="'.base_url('assets/img/empPhoto/'.$data['photo']).'">
                        </a>
                        <div class="media-body">
                            <small class="pull-right">'.time_ago($newDate).'</small>
                            '.($data['read_status'] == 0 ? "<strong class='label label-info' style='display: inline-block'>New message</strong><br/>" : "").'
                            <strong>'.$data['name'].'</strong> has sent you an email message.
                            <br>
                            <small class="text-muted">'.time_ago($newDate).' at '.$newDate.'</small>
                        </div>
                    </div>
                </li>
                <li class="divider"></li>
                ';
            }
        }else{
            $output .= '<li><center><p class="text-bold text-italic">No Notification Found</p><center></li><li class="divider"></li>';
        }   
        $unseenMessage = count($notifMessage->result_array());
        $data = array(
            'notification'   => $output,
            'unseen_notification' => $unseenMessage
        );
        echo json_encode($data);     
    }

    public function getCountPengajuan(){
        $userInfo = $this->master->getUserDetail($this->session->userdata('Noreg'));
        $data = array('countList' => $this->listPengajuan->countPengajuanCuti($userInfo));
        echo json_encode($data);
    }

	public function logout(){
		$this->login->deleteToken($this->session->userdata('backToken'));
		$this->session->unset_userdata('backToken');
		$this->message('Logout Berhasil ','Silahkan login kembali untuk melanjutkan','success');
		redirect('Auth/login');
	}
}