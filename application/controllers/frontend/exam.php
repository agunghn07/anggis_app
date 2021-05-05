<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('template');
		//$this->load->model('LoginModel', 'login', TRUE);
		$this->load->model('AssignmentModel', 'assignment', TRUE);
		$this->load->model('MasterModel', 'master', TRUE);
		date_default_timezone_set('Asia/Jakarta');
		//$this->checkAuth();
		if(!$this->session->userdata('examToken')){
			$this->session->sess_destroy();
			redirect('Auth/login/exam');
		}
	}

	public function message($title = NULL, $text = NULL, $type = NULL){
		return $this->session->set_flashdata([
			'title'	=> $title,
			'text'	=> $text,
			'type'	=> $type
		]);
	}

	/*
	public $dataParse = [
		'navbar' => 'layout/student/navbar',
		'title'  => '',
		'content'=> ''
	];
	*/

	public function index()
	{
		redirect('frontend/exam/list');
	}

	/*
	public function checkAuth(){
		if(!$this->session->userdata('examToken')){
			$this->session->sess_destroy();
			redirect('auth/login/exam');
		}else{
			if(!$this->login->checkToken($this->session->userdata('examToken'))){
				redirect('mainpage/logoutStudent');
			}
		}
	}
	*/

	public function list(){
		$dataAssignments = [];
		$dataClassStudent = $this->assignment->getClassByIdStudent($this->session->userdata('globalStudent')->id_student);
		foreach ($this->assignment->getAllAssignmentStudent() as $row => $value) {
			$push = false;
			foreach ($this->assignment->getClassByAssignment($value->id_assignment) as $r => $v) {
				if ($v->id_class == $this->session->userdata('globalStudent')->id_class) {
					$push = true;
				}
			}
			if ($push) {
				if ($value->assignment_active == 1) {
					if (!$this->assignment->checkDoneAssignment($value->id_assignment,$this->session->userdata('globalStudent')->id_student)) {
						array_push($dataAssignments, $value);
					}
				}
			}
		}
		foreach ($dataAssignments as $r => $v) {
			$dataAssignments[$r]->totalQuestion = count($this->assignment->getQuestionByAssignment($v->id_assignment));
		}
		$data['title'] = 'OnlineExam | List Exam';
		$data['dataClassStudent'] = $dataClassStudent;
		$data['dataAssignments'] = $dataAssignments;
		$this->template->student('content/frontend/listExamView', $data);
		/*
		$dataAssignments = [];
		$dataClassStudent = $this->assignment->getClassByIdStudent($this->session->userdata('globalStudent')->id_student);
		foreach ($this->assignment->getAllAssignmentStudent() as $row => $value) {
			$push = false;
			foreach ($this->assignment->getClassByAssignment($value->id_assignment) as $r => $v) {
				if ($v->id_class == $this->session->userdata('globalStudent')->id_class) {
					$push = true;
				}
			}
			if ($push) {
				if ($value->assignment_active == 1) {
					if (!$this->assignment->checkDoneAssignment($value->id_assignment,$this->session->userdata('globalStudent')->id_student)) {
						array_push($dataAssignments, $value);
					}
				}
			}
		}
		foreach ($dataAssignments as $r => $v) {
			$dataAssignments[$r]->totalQuestion = count($this->assignment->getQuestionByAssignment($v->id_assignment));
		}
		$this->dataParse['dataClassStudent'] = $dataClassStudent;
		$this->dataParse['dataAssignments'] = $dataAssignments;
		$this->dataParse['title'] = 'List Ujian';
		$this->dataParse['content'] = 'content/student/listExamView';
		$this->load->view('studentView',$this->dataParse);
		*/
	}

	public function begin($id_assignment = NULL){
		if(!$id_assignment){
			redirect('frontend/exam/lists');
		}
		
		//Ambil data assignment berdasarkan id assigmnet yang dikirim dari listExamView pada bagian view
		$dataAssignment = $this->assignment->getAssignmentById($id_assignment);
		if(!$dataAssignment){
			redirect('frontend/exam/lists');
		}else{
			$red = true;
			//Ambil data kelas berdasarkan assignment
			foreach ($this->assignment->getClassByAssignment($id_assignment) as $row => $value) {
				//jika id kelas yang diambil sama dengan id kelas student
				if($value->id_class == $this->session->userdata('globalStudent')->id_class){
					//maka bernilai false yang mana nantinya akan pindah ke halaman berikutnya
					$red = false;
				}
			}
			//jika bernilai true, maka akan kembali ke halaman list exam
			if($red){
				redirect('frontend/exam/list');
			}
		}
		$long = 0;
		//buat data array untuk menampung id assignment, id student, dan waktu mulai
		$begin = array(
			'id_assignment' => $id_assignment,
			'id_student'	=> $this->session->userdata('globalStudent')->id_student,
			'time_begin'	=> date('H:i')
		);
		//ambil data waktu mulai pada table assignment begin berdasarkan data array diatas
		$lastBegin = $this->assignment->checkBegin($begin);
		//jika bernilai true, buat variable untuk memulai countdown
		if ($lastBegin) {
			$to_time = strtotime(date("H:i:s"));
			$from_time = strtotime($lastBegin->time_begin);
			$long = round(abs($to_time - $from_time) / 60);
		//jika bernilai salah, maka akan di masukan kedalam table assingmnet begin
		} else {
			$this->assignment->insertBegin($begin);
		}
		//ambil data question berdasarkan assignment
		$dataAssignment->questions = $this->assignment->getQuestionByAssignment($id_assignment,$dataAssignment->assignment_order);
		foreach ($dataAssignment->questions as $r => $v) {
			//ambil data option berdasarkan data assignment question
			$dataAssignment->questions[$r]->options = $this->assignment->getOptionByQuestion($v->id_question);
		}
		$data['long'] = $long;
		$data['dataAssignment'] = $dataAssignment;
		$data['title'] = 'OnlineExam | Exam Begin';
		$this->template->student('content/frontend/examBegin', $data);
	}

	public function calculate(){
		//ambil data assignment yang di post pada view examBegin dibagian tag input (name="id_assignmemt")
		$dataAssignment = $this->assignment->getAssignmentById($this->input->post('id_assignment'));
		//buat definisi awal atau variable $resultTrue dan $resultFalse
		$resultTrue = 0;
		$resultFalse = 0;
		//$resultEmpty = 0;
		//buat variable array $dataResult untuk dimasukan ke table assignemnt result
		$dataResult = array(
			'id_assignment' => $this->input->post('id_assignment'),
			'id_student' => $this->session->userdata('globalStudent')->id_student,
			'result_created' => date('Y-m-d H:i:s')
		);
		//lakukan perulangan pada tag input (name=id_question) yang dipost karena id_question terdefisi sebagai array (id_question[])
		foreach($this->input->post('id_question') as $row => $value){
			//buat variable option untuk menampung tag input name=option
			$option = $this->input->post('option'.$value);
			//buat variable option untuk menampung tag input name=key_option
			$option_char = $this->input->post('key_option'.$value.$this->input->post('option'.$value));
			//jika name = option dan name option_char tidak di isi atau kosong
			if(!$option){
				//maka bernilai null dan status analisis bernilai empty
				$option = NULL;
				$analytics_status = 'empty';
				//$resultEmpty++;
			}
			if(!$option_char){
				//maka option char bernilai null
				$option_char = NULL;
			}
			//lakukan pengecekan jawaban yang benar berdasarkan name option yang dipost
			if($this->assignment->checkTrueOption($option)){
				$analytics_status = 'true';
				$resultTrue++;
			}else {
				$analytics_status = 'false';
				$resultFalse++;
			}
			//buat variable array untuk menampung data yang akan dimasukan ke table assignment_analytic
			$forAnalytics = array(
				'id_assignment' => $this->input->post('id_assignment'),
				'id_student' => $this->session->userdata('globalStudent')->id_student,
				'id_question' => $value,
				'id_option' => $option,
				'option_char' => $option_char,
				'analytics_status' => $analytics_status,
				'analytics_created' => date('Y-m-d H:i:s'),
			);
			//insert array ke table assignment_analytic
			$this->assignment->insertAssignmentAnalytics($forAnalytics);
		}
		// CONTINUE RESULT DATA //
		$dataResult['result_true'] = $resultTrue;
		$dataResult['result_false'] = $resultFalse;
		//$dataResult['result_false'] = $resultEmpty;
		//buat variable untuk melakukan perhitungan nilai
		$finalScore = ($resultTrue / count($this->assignment->getQuestionByAssignment($this->input->post('id_assignment')))) * 100;
		if ($finalScore > 0) {
			$finalScore = ceil($finalScore);//untuk melakukan pembulatan
		}
		$dataResult['result_score'] = $finalScore;
		$resultStatus = 'lulus';
		if ($finalScore < $dataAssignment->assignment_kkm) {
			$resultStatus = 'gagal';
		}
		$dataResult['result_status'] = $resultStatus;
		//masukan variable array dataResult ke table assignment result
		$this->assignment->insertAssignmentResult($dataResult);
		// DELETE BEGIN
		$this->assignment->deleteAssignmentBegin($dataAssignment->id_assignment,$this->session->userdata('globalStudent')->id_student); 
		if ($dataAssignment->show_report == 1) {
			$this->message('Yeeaay!','Ujian telah dikumpulkan, anda bisa melihat hasilnya disini :)','success');
			redirect('frontend/exam/report/'.$dataAssignment->id_assignment);
		} else {
			$this->message('Yeeaay!','Ujian berhasil dikumpulkan, semoga hasilnya memuaskan :)','success');
			redirect('frontend/exam/list');
		}
	}

	public function report($id_assignment = NULL){
		if(!$id_assignment){
			redirect('frontend/exams');
		}
		$dataAssignment = $this->assignment->getAssignmentById($id_assignment);
		if (!$id_assignment) {
			redirect('frontend/exams');
		} elseif($dataAssignment->show_report != 1) {
			redirect('frontend/exams');
		}
		$dataResult = $this->assignment->getResultStudentById($id_assignment, $this->session->userdata('globalStudent')->id_student);
		$dataAnalytics = $this->assignment->getAnalyticsStudentById($id_assignment, $this->session->userdata('globalStudent')->id_student);
		
		foreach($dataAnalytics as $row => $value) {
			$dataAnalytics[$row]->studentChoosed = $this->assignment->getOptionById($value->id_option);
			$dataAnalytics[$row]->trueAnswer = $this->assignment->getTrueAnswerByQuestion($value->id_question);
		}
		
		$data['dataAssignment'] = $dataAssignment;
		$data['dataResult'] = $dataResult;
		$data['dataAnalytics'] = $dataAnalytics;
		$data['title'] = 'Hasil Ujian';
		$this->template->student('content/frontend/report', $data);
	}

	public function history(){
		$dataAssignments = [];
		foreach ($this->assignment->getResultByStudent($this->session->userdata('globalStudent')->id_student) as $row => $value) {
			$assignment = $this->assignment->getAssignmentById($value->id_assignment);
			$assignment->resultCreated = $value->result_created;
			array_push($dataAssignments, $assignment);
		}
		foreach ($dataAssignments as $r => $v) {
			$dataAssignments[$r]->totalQuestion = count($this->assignment->getQuestionByAssignment($v->id_assignment));
		}
		$data['dataAssignments'] = $dataAssignments;
		$data['title'] = 'OnlineExam | Exam History';
		$this->template->student('content/frontend/examHistory', $data);
	}

	public function logout(){
		$this->session->unset_userdata('globalStudent');
		$this->session->unset_userdata('examToken');
		$this->message('Logout Berhasil ','Silahkan login kembali untuk melanjutkan','success');
		redirect('Auth/login/exam');
	}
}