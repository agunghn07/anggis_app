<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HistoryCutiModel extends CI_Model {
    var $table = 'tb_t_pengajuan_cuti cuti';

    var $column_order = array('', 'cuti.nomor_cuti', 'cuti.start_dt', 'cuti.until_dt', 'cuti.alasan', 'app.description', ''); 

    var $column_search = array('cuti.nomor_cuti', 'cuti.alasan', 'app.description'); 

    var $order = array('cuti.id' => 'desc');  

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($isPrint){  
        $this->db->select(
            'cuti.nomor_cuti, 
             cuti.start_dt, 
             cuti.until_dt, 
             cuti.alasan, 
             cuti.is_approve,
             app.description, 
             cuti.updated_dt,
             (SELECT id FROM tb_r_email WHERE id_cuti = cuti.id ORDER BY id DESC LIMIT 1) id_email
        '); 
        $this->db->from($this->table);
        $this->db->join('tb_m_approval app', 'cuti.is_approve = app.id');
        $this->db->where(array('cuti.noreg' => $this->session->userdata('Noreg'), "is_approve !=" => 2));
        if(!$isPrint){
            if($this->input->post('startdt') != null){
                $this->groupStart('startdt');
            }
            if($this->input->post('untildt') != null){
                $this->groupStart('untildt');
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
        }else{
            if($this->input->get('startdt') != null){
                $this->groupStart('startdt');
            }
            if($this->input->get('untildt') != null){
                $this->groupStart('untildt');
            }
        }
    }

    function get_datatables($isPrint){
        $this->_get_datatables_query($isPrint);
        if(!$isPrint){
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($isPrint){
        $this->_get_datatables_query($isPrint);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function groupStart($param){
        if($param == 'startdt'){
            $this->db->group_start();
            $this->db->where("CAST(cuti.created_dt AS date) >= '".date("Y-m-d", strtotime(str_replace("/", "-", $_POST['startdt'])))."' ");
            $this->db->group_end();
        }else{
            $this->db->group_start();
            $this->db->where("CAST(cuti.created_dt AS date) < DATE_ADD('".date("Y-m-d", strtotime(str_replace("/", "-", $_POST['untildt'])))."', INTERVAL 1 DAY)");
            $this->db->group_end();
        }
    }
}

?>