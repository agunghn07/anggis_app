<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function message($title = NULL, $text = NULL, $type = NULL){
		return $this->session->set_flashdata([
			'title' => $title,
			'text'	=> $text,
			'type'	=> $type
		]);
	}

	public function index(){
		redirect('backend/result/result_assignment');
	}

	public function result_assignment(){
		if ($this->input->post()) {
			//buat 2 variable yang akan menampung array
			$dataAssignments = [];
			$forAssignment = [];
			//lakukan perulangan untuk mengambil beberapa data assignment berdasarkan kelas dari table assignment_class 
			foreach ($this->assignment->getAssignmentByClassNew($this->input->post('id_class')) as $row => $value) {
				//intinya pada kodingan ini untuk mengelompokan beberapa data yang diambil kedalam array $forAssigment yang telah didefinisikan
				if ($forAssignment) {
					$val = false;
					foreach ($forAssignment as $_rr => $_vv) {
						if ($_vv->id_assignment == $value->id_assignment) {
							$val = true;
						}
					}
					if ($val) {
						array_push($forAssignment, $value);
					}
				} else {
					array_push($forAssignment, $value);
				}
			}
			// NEW LOGIC //
			//setelah data dikelompokan kedalam array $forAssignment, lakukan perulangan lagi untuk mengambil id_assignment dari array tersebut
			foreach ($forAssignment as $row => $value) {
				//kemudian buat variable untuk mengambil beberapa data assignment berdasarkan assignment_type, id_lesson dan id_assigment
				$assignment = $this->assignment->getAssignmentByTypeLessonAndId($this->input->post('assignment_type'),
					$this->input->post('id_lesson'),$value->id_assignment);
				if ($assignment) {
					//setelah itu data yang diambil dikelompokan kedalam array $dataAssignment
					array_push($dataAssignments,$assignment);
				}
			}
			// END //

			//lakukan perulangan lagi, kali ini menggunakan array $dataAssignment untuk mengambil id_assignment dari array tersebut
			foreach ($dataAssignments as $r => $v) {
				//buat variable student untuk mengambil data student berdasarkan kelas
				$students = $this->master->getStudentByClass($this->input->post('id_class'));
				if ($students) {
					//lakukan perulangan untuk mengambil beberapa data result
					foreach ($students as $_r => $_v) {
						//setelah itu buat variable baru dari value perulangan $students tadi untuk megambil data result berdasarkan id_student dan id_assignment
						$students[$_r]->result = $this->assignment->getResultByStudentAndAssignment($_v->id_student,$v->id_assignment);
					}
					//buat variable baru lagi kali ini dari value perulangan $dataAssignment yang berisi data student pada variable $students
					$dataAssignments[$r]->students = $students;
				} else {
					unset($dataAssignments[$r]);
				}
			}
			// DATA FILTERING AUTH //
			//lakukan filtering berdasarkan session level
			$clearAssignment = [];
			foreach ($dataAssignments as $rAssignment => $vAssignment) {
				if ($this->session->userdata('level') != 'admin') {
					if ($vAssignment->id_ == $this->session->userdata('id_')) {
						array_push($clearAssignment, $vAssignment);
					}
				} else {
					array_push($clearAssignment, $vAssignment);
				}
			}
			// END //
			if ($dataAssignments) {
				$this->parseData['dataAssignments'] = $clearAssignment;
				$this->parseData['post'] = $this->input->post();
				$this->parseData['dataClass'] = $this->student->getClassById($this->input->post('id_class'));
				$this->parseData['dataLesson'] = $this->lesson->getLessonById($this->input->post('id_lesson'));
			} else {
				$this->message('Woopsss!','Tidak ditemukan laporan hasil ujian pada data ini','error');
				redirect('backend/result/result_assignment');
			}
		}
		$dataLessons = $this->lesson->getLessonInAssignment();
		foreach ($dataLessons as $row => $value) {
			$dataLessons[$row]->lesson_name = $this->lesson->getLessonById($value->id_lesson)->lesson_name;
		}
		$this->parseData['dataLessons'] = $dataLessons;
		$this->parseData['content'] = 'content/backend/report/result';
		$this->parseData['title'] = 'Laporan Hasil Ujian ';
		$this->load->view('MainView/backendView',$this->parseData);
	}

	public function findTypeAndClassForReport($id_lesson){
		if(!$id_lesson){
			echo "failure";
		}
		$dataLesson = $this->lesson->getLessonById($id_lesson);
		if(!$dataLesson){
			echo "failure";
		}
		$dataType = $this->assignment->getAssignmentTypeByLesson($id_lesson);
		$dataClass = [];
		$assignmentClass = [];
		foreach ($this->assignment->getAssignmentByLesson($id_lesson) as $r => $v) {
			foreach ($this->assignment->getClassByAssignment($v->id_assignment) as $_r => $_v) {
				if ($this->session->userdata('level') == 'guru') {
					$valPush = false;
					foreach ($this->master->getClassByTeacher($this->session->userdata('id_')) as $__r => $__v) {
						if ($__v->id_class == $_v->id_class) {
							$valPush = true;
						}
					}
					if ($valPush) {
						array_push($assignmentClass, $_v);
					}
				} else {
					array_push($assignmentClass, $_v);
				}
			}
		}
		foreach ($assignmentClass as $r_ => $v_) {
			if ($dataClass) {
				$val = true;
				foreach ($dataClass as $row => $value) {
					if ($value->id_class == $v_->id_class) {
						$val = false;
					}
				}
				if ($val) {
					array_push($dataClass, $v_);
				}
			} else {
				array_push($dataClass,$v_);
			}
		}
		if ($dataType) {
			$callback = ['dataType' => $dataType, 'dataClass' => $dataClass ];
			echo json_encode($callback);
		} else {
			echo "failure";
		}
	}

	public function result_pdf($id_assignment = NULL, $id_class = NULL){
		if(!$id_assignment OR !$id_class){
			redirect('backend/result');
		}
		$dataAssignment = $this->assignment->getAssignmentById($id_assignment);
		$dataClass = $this->student->getClassById($id_class);
		if(!$dataAssignment OR !$dataClass){
			redirect('backend/result');
		}
		if($this->session->userdata('level') == 'guru'){
			if($dataAssignment->id_ != $this->session->userdata('id_')){
				redirect('backend/result');
			}
		}
		$students = $this->master->getStudentByClass($id_class);
		foreach ($students as $row => $value) {
			$students[$row]->result = $this->assignment->getResultByStudentAndAssignment($value->id_student, $id_assignment);
		}
		$dataAssignment->students = $students;
		$dataAssignment->totalQuestion = count($this->question->getQuestionByAssignment($id_assignment));
		$this->result['dataAssignment'] = $dataAssignment;
		$this->result['dataClass'] = $dataClass;
		$this->result['dataLesson'] = $this->lesson->getLessonById($dataAssignment->id_lesson);
		$html = $this->load->view('content/backend/report/result-pdf', $this->result, true);
		$this->load->library('pdf');
		$this->pdf->pdf->WriteHTML($html);
		$this->pdf->pdf->output('');
	}

}