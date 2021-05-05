<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AssignmentModel extends CI_Model {

    var $table = 'ms_assignment';
    var $column_order = array('','lesson_name','assignment_kkm','','assignment_author','','assignment_created'); 
    //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $column_search = array('lesson_name','assignment_type','assignment_kkm','assignment_author','assignment_created'); 
    // default order 
    var $order = array('id_assignment' => 'desc');  // default order 

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

     private function _get_datatables_query()
    {
        $this->db->where('ms_assignment.assignment_hide', 0);
        if ($this->session->userdata('level') != 'admin') {
            $this->db->where('ms_assignment.id_', $this->session->userdata('id_admin'));
        }
        $this->db->join('ms_lesson', 'ms_assignment.id_lesson = ms_lesson.id_lesson', 'left');
        
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

	public function getAllLessons(){
		$query = $this->db->get('ms_lesson');
		return $query->result_object();
	}

	public function getAllClasses(){
		$query = $this->db->get('ms_class');
		return $query->result_object();
	}

	public function insertAssignment($data){
		$this->db->insert('ms_assignment', $data);
		return $this->db->insert_id();
	}

	public function insertAssignmentClass($single){
		return $this->db->insert('assignment_class', $single);
	}

	public function getAllAssignment(){
		$this->db->order_by('ms_assignment.id_assignment','desc');
        //jika userdata bukan admin, maka data akan ditampilkan berdasarkan userdata id_admin. Jika userdata admin, maka data aditampilkan semua
		if($this->session->userdata('level') != 'admin' AND $this->session->userdata('level') != 'staff'){
			$this->db->where('ms_assignment.id_', $this->session->userdata('id_admin'));
		}
		$this->db->join('ms_lesson','ms_assignment.id_lesson = ms_lesson.id_lesson');
		return $this->db->get('ms_assignment')->result_object();
        //result objet biasanya untuk menampilkan data yang banyak dan di tampilkan dengan foreach atau perulangan
	}

    public function getAllAssignmentStudent() {
        $this->db->order_by('ms_assignment.id_assignment', 'desc');
        $this->db->where('ms_assignment.assignment_hide', 0);
        $this->db->join('ms_lesson', 'ms_assignment.id_lesson = ms_lesson.id_lesson', 'left');
        return $this->db->get('ms_assignment')->result_object();
    }

	public function getQuestionByAssignment($id_assignment, $assignment_order = NULL){
		$this->db->where('assignment_question.id_assignment', $id_assignment);
		if($assignment_order){
			$this->db->order_by('assignment_question.id_aquestion','random');
		}
		$this->db->where('assignment_question.val_hide',0);
		$this->db->join('ms_question','assignment_question.id_question = ms_question.id_question');
		return $this->db->get('assignment_question')->result_object();
	}

    public function getAssignmentById($id_assignment){
        $this->db->where('ms_assignment.id_assignment', $id_assignment);
        $this->db->where('ms_assignment.assignment_hide', 0);
        $this->db->join('ms_lesson', 'ms_assignment.id_lesson = ms_lesson.id_lesson', 'left');
        return $this->db->get('ms_assignment')->row_object();
        //row_object biasanya untuk menampilkan data yang hanya terdiri dari satu baris dan tanpa perlu foreach atau perulangan
    }


    public function getAssignmentByClassNew($id_class){
        $query = "SELECT * FROM assignment_class WHERE id_class = '$id_class' ORDER BY id_aclass DESC";
        return $this->db->query($query)->result_object();
    }

    public function getAssignmentByClass($id_class){
        $query = "SELECT DISTINCT id_assignment from assignment_class WHERE id_class = '$id_class'";
        return $this->db->query($query)->result_object();
    }

    public function getAssignmentByTypeLessonAndId($assignment_type, $id_lesson, $id_assignment){
        $this->db->where('assignment_type', $assignment_type);
        $this->db->where('id_lesson', $id_lesson);
        $this->db->where('id_assignment', $id_assignment);
        return $this->db->get('ms_assignment')->row_object();
    }

    public function getAssignmentTypeByLesson($id_lesson){
        $query = "SELECT DISTINCT assignment_type FROM ms_assignment WHERE id_lesson = '$id_lesson'";
        return $this->db->query($query)->result_object();
    }

    public function getAssignmentByLesson($id_lesson){
        $query = "SELECT DISTINCT id_assignment FROM ms_assignment WHERE id_lesson = '$id_lesson'";
        return $this->db->query($query)->result_object();
    }

    public function getClassByAssignment($id_assignment){
        $this->db->where('assignment_class.id_assignment', $id_assignment);
        $this->db->join('ms_class', 'assignment_class.id_class = ms_class.id_class', 'left');
        return $this->db->get('assignment_class')->result_object();
    }

    public function getClassByIdStudent($id_student){
        $this->db->where('ms_student.id_student', $id_student);
        $this->db->join('ms_class','ms_student.id_class = ms_class.id_class','left');
        return $this->db->get('ms_student')->row_object();
    }

    public function updateAssignment($data){
        $this->db->where('id_assignment', $data['id_assignment']);
        return $this->db->update('ms_assignment',$data);
    }

    public function deleteAssignmentClassId($id_aclass){
        $this->db->where('id_aclass', $id_aclass);
        return $this->db->delete('assignment_class');
    }

    public function deleteAssignment($id, $id_lesson){
        $this->db->delete('ms_assignment', array('id_assignment' => $id));
        $this->db->delete('assignment_class', array('id_assignment' => $id));
        $this->db->delete('ms_question', array('id_lesson' => $id_lesson));
    }

    public function checkDoneAssignment($id_assignment,$id_student) {
        $this->db->where('id_assignment', $id_assignment);
        $this->db->where('id_student', $id_student);
        return $this->db->get('assignment_result')->row_object();
    }

    public function checkBegin($data) {
        $this->db->where('id_assignment', $data['id_assignment']);
        $this->db->where('id_student', $data['id_student']);
        return $this->db->get('assignment_begin')->row_object();
    }

    public function insertBegin($data){
        return $this->db->insert('assignment_begin', $data);
    }

    public function getOptionByQuestion($id_question) {
        $this->db->where('id_question', $id_question);
        $this->db->where('option_hide', 0);
        return $this->db->get('question_option')->result_object();
    }

    public function getOptionById($id_option){
        $this->db->where('id_option', $id_option);
        $this->db->where('option_hide', 0);
        $query = $this->db->get('question_option');
        return $query->row_object();
    }

    public function checkTrueOption($id_option) {
        $this->db->where('id_option', $id_option);
        $this->db->where('option_hide', 0);
        $this->db->where('option_true', 1);
        return $this->db->get('question_option')->row_object();
    }

    public function insertAssignmentAnalytics($data) {
        return $this->db->insert('assignment_analytics', $data);
    }

    public function insertAssignmentResult($data) {
        return $this->db->insert('assignment_result', $data);
    }

    public function deleteAssignmentBegin($id_assignment,$id_student) {
        $this->db->where('id_assignment', $id_assignment);
        $this->db->where('id_student', $id_student);
        return $this->db->delete('assignment_begin');
    }

    public function getResultStudentById($id_assignment, $id_student){
        $this->db->where('id_assignment', $id_assignment);
        $this->db->where('id_student', $id_student);
        $query = $this->db->get('assignment_result');
        return $query->row_object();
    }

    public function getAnalyticsStudentById($id_assignment, $id_student){
        $this->db->where('assignment_analytics.id_assignment', $id_assignment);
        $this->db->where('assignment_analytics.id_student', $id_student);
        $this->db->join('ms_question','assignment_analytics.id_question = ms_question.id_question','left');
        return $this->db->get('assignment_analytics')->result_object();
    }

    public function getTrueAnswerByQuestion($id_question) {
        $this->db->where('id_question', $id_question);
        $this->db->where('option_true', 1);
        $this->db->where('option_hide', 0);
        return $this->db->get('question_option')->row_object();
    }

    public function getResultByStudent($id_student){
        $query = "SELECT * FROM assignment_result WHERE id_student = '$id_student' ORDER BY result_created DESC";
        return $this->db->query($query)->result_object();
    }

    public function deleteOptionById($id_option){
        $this->db->where('id_option', $id_option);
        return $this->db->delete('question_option');
    }

    public function getResultByStudentAndAssignment($id_student, $id_assignment){
        $this->db->where('id_student', $id_student);
        $this->db->where('id_assignment', $id_assignment);
        return $this->db->get('assignment_result')->row_object();
    }

    public function getAnalyticsByStudentAndAssignment($id_student, $id_assignment){
        $this->db->where('id_student',$id_student);
        $this->db->where('id_assignment', $id_assignment);
        return $this->db->get('assignment_analytics')->result_object();
    }

    public function getAllResult(){
        return $this->db->get('assignment_result')->result_object();
    }

    public function getAssignmentByTeacher($id_teacher){
        $this->db->where('id_', $id_teacher);
        return $this->db->get('ms_assignment')->result_object();
    }

    public function getActiveAssignment(){
        $this->db->where('assignment_hide', 0);
        $this->db->where('assignment_active', 1);
        if ($this->session->userdata('level') != 'admin' AND $this->session->userdata('level') != 'staff') {
            $this->db->where('id_', $this->session->userdata('id_'));
        }
        return $this->db->get('ms_assignment')->result_object();
    }

    public function getResultByAssignment($id_assignment){
        $this->db->where('id_assignment', $id_assignment);
        return $this->db->get('assignment_result')->result_object();
    }
}