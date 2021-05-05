<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TeacherModel extends CI_Model {

	var $table = 'ms_teacher';
    var $column_order = array('','','teacher_name','teacher_username','teacher_phone','teacher_email','teacher_created',''); 
    //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $column_search = array('teacher_name','teacher_username','teacher_phone','teacher_email','teacher_created'); 
    // default order 
    var $order = array('id_teacher' => 'desc');  // default order 

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

	public function get_mapel(){
		$query = $this->db->get('ms_lesson');
		return $query->result_object();
	}

	public function get_kelas(){
		$query = $this->db->get('ms_class');
		return $query->result_object();
	}

	public function add_teacher($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

    public function getTeacherById($id_teacher){
        $this->db->from($this->table);
        $this->db->where('id_teacher', $id_teacher);
        $query = $this->db->get();
        return $query->row();
    }

    public function getClassByTeacher($id) {
        $this->db->where('teacher_class.id_teacher', $id);
        $this->db->join('ms_class', 'teacher_class.id_class = ms_class.id_class', 'left');
        return $this->db->get('teacher_class')->result_object();
    }
    
    public function getLessonByTeacher($id) {
        $this->db->where('teacher_lesson.id_teacher', $id);
        $this->db->join('ms_lesson', 'teacher_lesson.id_lesson = ms_lesson.id_lesson', 'left');
        return $this->db->get('teacher_lesson')->result_object();
    }

    public function insertTeacherClass($data) {
        return $this->db->insert('teacher_class',$data);
    }

    public function insertTeacherLesson($data) {
        return $this->db->insert('teacher_lesson', $data);
    }

	public function getTeacherUsername($teacher_username){
		$this->db->where('teacher_username', $teacher_username);
		$query = $this->db->get($this->table);
		return $query->row_object();
	}

    public function getTeacherFullname($teacher_name){
        $this->db->where('teacher_name', $teacher_name);
        $query = $this->db->get($this->table);
        return $query->row_object();
    }

    public function updateTeacher($data){
        $this->db->where('id_teacher', $data['id_teacher']);
        return $this->db->update('ms_teacher', $data);
    }

    public function deleteClassByTeacher($id_teacher, $id_class){
        $this->db->where('id_teacher', $id_teacher);
        $this->db->where('id_class', $id_class);
        return $this->db->delete('teacher_class');
    }

    public function deleteLessonByTeacher($id_teacher, $id_lesson){
        $this->db->where('id_teacher', $id_teacher);
        $this->db->where('id_lesson', $id_lesson);
        return $this->db->delete('teacher_lesson');
    }

    public function hapus_teacher($id){
        $this->db->delete('ms_teacher', array('id_teacher' => $id));
        $this->db->delete('teacher_class', array('id_teacher' => $id));
        $this->db->delete('teacher_lesson', array('id_teacher' => $id));
    }
}