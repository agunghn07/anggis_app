<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class StudentModel extends CI_Model {
	var $table = 'ms_student';
    var $column_order = array('','','student_name','student_nis','student_phone','student_email','student_created',''); 
    //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $column_search = array('student_name','student_nis','student_phone','student_email','student_created'); 
    // default order 
    var $order = array('id_student' => 'desc');  // default order 

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
        //jika tag select di submit
        if($this->input->post('id_classroom'))
        {
            $this->db->where('class_name', $this->input->post('id_classroom'));
        }
    	$this->db->join('ms_class','ms_class.id_class = ms_student.id_class');
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

	public function getAllClassroom(){
		$query = $this->db->get('ms_class');
		return $query->result_object();
	}

	public function getAllLesson(){
		$query = $this->db->get('ms_lesson');
		return $query->result_object();
	}

    public function getClassById($id_class) {
        $this->db->where('id_class', $id_class);
        return $this->db->get('ms_class')->row_object();
    }

	public function getStudentName($student_name){
		$this->db->where('student_name', $student_name);
		$query = $this->db->get('ms_student');
		return $query->row_object();
	}

    public function getStudentNis($student_nis){
        $this->db->where('student_nis', $student_nis);
        $query = $this->db->get('ms_student');
        return $query->row_object();
    }

    public function getStudentById($id){
    	$this->db->from($this->table);
    	$this->db->where('id_student', $id);
    	$query = $this->db->get();
    	return $query->row();
    }

	public function add_student($data){
		$this->db->insert('ms_student', $data);
		return $this->db->insert_id();
	}

    public function update_siswa($id, $data){
        $this->db->update($this->table, $data, $id);
        return $this->db->affected_rows();
    }

    public function hapus_siswa($id){
        $this->db->where('id_student', $id);
        return $this->db->delete($this->table);
    }
}