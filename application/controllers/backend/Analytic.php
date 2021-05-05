<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytic extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function message($title = NULL, $text = NULL, $type = NULL){
		return $this->session->set_flashdata([
			'title'	=> $title,
			'text'	=> $text,
			'type'	=> $type
		]);
	}

	public function index(){
		redirect('backend/analytic/result_analytic');
	}

	public function result_analytic(){
		if($this->input->post()){
			//buat variable dataAssignments sebagai array
			$dataAssignments = [];
			//lakukan perulangan untuk mengambil data-data assignment berdasarkan id class
			foreach ($this->assignment->getAssignmentByClass($this->input->post('id_class')) as $row => $value) {
				//buat variable assignment untuk mengambil data assignment berdasarkan tipe lesson dan id lesson
				$assignment = $this->assignment->getAssignmentByTypeLessonAndId($this->input->post('assignment_type'), $this->input->post('id_lesson'),$value->id_assignment);
				if($assignment){
					//masukan data variable assignment tadi kedalam array dataAssignment
					array_push($dataAssignments, $assignment);
				}
			}
			//buat variable students untuk mengambil data-data siswa berdasarkan id_class
			$students = $this->master->getStudentByClass($this->input->post('id_class'));
			foreach ($dataAssignments as $r => $v) {
				$questions = $this->question->getQuestionByAssignment($v->id_assignment);
				foreach ($questions as $rQuestion => $vQuestion) {
					$notYet = 0;
					$true = 0;
					$false = 0;
					$empty = 0;
					foreach ($students as $rStudent => $vStudent) {
						$analytics = $this->assignment->getAnalyticsByStudentAndAssignment($vStudent->id_student, $v->id_assignment);
						if($analytics){
							foreach ($analytics as $rAnalytic => $vAnalytic) {
								if($vAnalytic->id_question == $vQuestion->id_question){
									if($vAnalytic->analytics_status == 'true'){
										$true++;
									}elseif($vAnalytic->analytics_status == 'false'){
										$false++;
									}elseif($vAnalytic->analytics_status == 'empty'){
										$empty++;
									}
								}
							}
						}else{
							$notYet++;
						}
					}
					$questions[$rQuestion]->notYet = $notYet;
					$questions[$rQuestion]->true = $true;
					$questions[$rQuestion]->false = $false;
					$questions[$rQuestion]->empty = $empty;
				}
				$dataAssignments[$r]->questions = $questions;
			}
			//DATA FILTERING AUTH
			$clearAssignment = [];
			foreach ($dataAssignments as $rAssignment => $vAssignment) {
				if ($this->session->userdata('level') != 'admin') {
					if($vAssignment->id_ == $this->session->userdata('id_admin')){
						array_push($clearAssignment, $vAssignment);
					}
				}else{
					array_push($clearAssignment, $vAssignment);
				}
			}

			if($dataAssignments){
				$this->parseData['dataAssignments'] = $clearAssignment;
				$this->parseData['post'] = $this->input->post();
				$this->parseData['dataClass'] = $this->student->getClassById($this->input->post('id_class'));
				$this->parseData['dataLesson'] = $this->lesson->getLessonById($this->input->post('id_lesson'));
			}else{
				$this->message('Wooppss!','Tidak ditemukan laporan hasil ujian pada data ini','error');
				redirect('backend/analytic/result_analytic');
			}
		}
		$dataLessons = $this->lesson->getLessonInAssignment();
		foreach ($dataLessons as $row => $value) {
			$dataLessons[$row]->lesson_name = $this->lesson->getLessonById($value->id_lesson)->lesson_name;
		}
		$this->parseData['dataLessons'] = $dataLessons;
		$this->parseData['title'] = 'Laporan Analisis Ujian';
		$this->parseData['content'] = 'content/backend/analytic/resultAnalytic';
		$this->load->view('MainView/backendView', $this->parseData);
	}
}
