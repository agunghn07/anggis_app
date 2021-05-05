<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ListPengajuanCutiModel extends CI_Model {
    var $table = 'tb_t_pengajuan_cuti cuti';

    var $column_order = array('cuti.alasan'); 

    var $column_search = array('cuti.nomor_cuti', 'cuti.alasan'); 

    var $order = array('cuti.id' => 'desc');  

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query(){  
        $userInfo = $this->master->getUserDetail($this->session->userdata('Noreg'));
        $this->db->select(
            'emp.noreg, 
             emp.name, 
             cuti.start_dt, 
             cuti.until_dt, 
             cuti.alasan, 
             cuti.is_approve,
             cuti.updated_by,
             app.description,
             cuti.nomor_cuti,
             cuti.approval_2,
             email.id id_email
        '); 
        $this->db->from($this->table);
        $this->db->join('tb_r_email email', 'cuti.id = email.id_cuti');
        $this->db->join('tb_r_employee emp', 'cuti.noreg = emp.noreg');
        $this->db->join('tb_m_approval app', 'cuti.IS_APPROVE = app.ID');
        $this->db->where('email.receiver', $this->session->userdata('Noreg'));
        $this->db->where('cuti.is_approve', 2);
        if($userInfo->id_division != 'DK'){
            $this->db->where('approval_2', 2);
        }

        $i = 0;
    
        foreach ($this->column_search as $item)
        {
            if($_POST['search']['value']) 
            {
                
                if($i===0)
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
    
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
            
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function countPengajuanCuti($userInfo){
        $this->db->from($this->table);
        $this->db->join('tb_r_email email', 'cuti.id = email.id_cuti');
        $this->db->join('tb_m_approval app', 'cuti.IS_APPROVE = app.ID');
        $this->db->where('email.receiver', $this->session->userdata('Noreg'));
        $this->db->where('cuti.is_approve', 2);
        if($userInfo->id_division != 'DK'){
            $this->db->where('approval_2', 2);
        }
        return $this->db->count_all_results();
    }

    public function count_all(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}