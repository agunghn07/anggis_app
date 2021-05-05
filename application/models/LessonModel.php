<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lessonmodel extends CI_Model {

	var $table = 'ms_lesson';
    var $column_order = array('','lesson_name','lesson_created',''); 
    //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $column_search = array('lesson_name','lesson_created'); 
    // default order 
    var $order = array('id_lesson' => 'desc');  // default order 

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	 private function _get_datatables_query()
    {
        
        $this->db->from($this->table);

        $i = 0;
    
        foreach ($this->column_search as $item) // loop column 
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

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function tambah_mapel($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

	public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_lesson',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function hapus_mapel($id){
    	$this->db->where('id_lesson', $id);
    	$this->db->delete($this->table);
    }

    public function getLessonName($mapel) {
        $this->db->where('lesson_name', $mapel);
        $query = $this->db->get($this->table);
        return $query->row_object();
    }

    public function getLessonById($id_lesson){
        $this->db->where('id_lesson', $id_lesson);
        return $this->db->get('ms_lesson')->row_object();
    }

    public function getLessonInAssignment(){
        $id_ = $this->session->userdata('id_');
        $query = "SELECT DISTINCT id_lesson FROM ms_assignment WHERE id_ = '$id_'";
        return $this->db->query($query)->result_object();
    }

}