<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends MY_Controller {

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

	public function list_question($id_assignment)
	{
		if (!$id_assignment) {
			redirect('backend/assignments');
		}
		$dataAssignment = $this->assignment->getAssignmentById($id_assignment);
		if (!$dataAssignment) {
			redirect('backend/assignments');
		}
		$dataAssignment->questions = $this->question->getQuestionByAssignment($id_assignment);
		foreach ($dataAssignment->questions as $row => $value) {
			$dataAssignment->questions[$row]->totalAnswer = count($this->question->getOptionByQuestion($value->id_question));
		}
		$dataClassroom = $this->assignment->getClassByAssignment($id_assignment);
		$this->parseData['dataAssignment'] = $dataAssignment;
		$this->parseData['dataClassroom'] = $dataClassroom;
		$this->parseData['content'] = 'content/backend/v_listquestion';
		$this->parseData['title'] = 'List Soal ';
		$this->load->view('MainView/backendView',$this->parseData);
	}

	public function detail_question($id_assignment = NULL, $id_question = NULL, $bank = NULL){
		if (!$id_question OR !$id_assignment) {
			redirect('backend/assignments');
		}
		$dataQuestion = $this->question->getQuestionById($id_question);
		$dataAssignment = $this->assignment->getAssignmentById($id_assignment);
		if (!$dataQuestion OR !$dataAssignment) {
			redirect('backend/assignments');
		}
		$dataQuestion->options = $this->question->getOptionByQuestion($id_question);
		$this->parseData['dataQuestion'] = $dataQuestion;
		$this->parseData['dataAssignment'] = $dataAssignment;
		$this->parseData['bank'] = $bank;
		$this->parseData['content'] = 'content/backend/v_detailQuestion';
		$this->parseData['title'] = 'Rincial Soal ';
		$this->load->view('MainView/backendView',$this->parseData);
	}

	public function create_question($id_assignment = NULL){
		if (!$id_assignment) {
			redirect('backend/assignments');
		}
		$dataAssignment = $this->assignment->getAssignmentById($id_assignment);
		if (!$dataAssignment) {
			redirect('backend/assignments');
		}
		$dataClassroom = $this->assignment->getClassByAssignment($id_assignment);
		$this->parseData['dataAssignment'] = $dataAssignment;
		$this->parseData['dataClassroom'] = $dataClassroom;
		$this->parseData['content'] = 'content/backend/v_createQuestion';
		$this->parseData['title'] = 'Buat Soal ';
		$this->load->view('MainView/backendView',$this->parseData);
	}

	public function add_question(){
		if ($this->input->post('question_') == '') {
			$this->message('Ooppsss','Anda belum membuat soal, pastikan anda membuat soal terlebih dahulu','error');
			redirect('backend/Question/create_question/'.$this->input->post('id_assignment'));
		}
		$dataQuestion = [
			'id_lesson' => $this->input->post('id_lesson'),
			'question_' => $this->input->post('question_'),
			'question_created' => date('Y-m-d H:i:s')
		];
		// IMAGE QUESTION //
		if ($_FILES['question_image']['name']) {
			$this->imageConf('assignments/'.$this->input->post('assignment_path')); //nama folder yang dituju
            if(!$this->upload->do_upload('question_image')) :
                $this->message('Oopppsss',$this->upload->display_errors(),'error');
            	redirect('backend/question/create_question/'.$this->input->post('id_assignment'));
            else :
            	$dataUpload = $this->upload->data();
            	$dataQuestion['question_image'] = str_replace(' ', '_', $dataUpload['file_name']);
            	// COMPRESS IMAGE //
            	$resolution = ['width' => 500, 'height' => 500];
	            $this->compreesImage('assignments/'.$this->input->post('assignment_path'),$dataUpload['file_name'],$resolution);
            endif;
		} // IMAGE QUESTION //
		// SOUND QUESTION //
		if ($_FILES['question_sound']['name']) {
			$this->soundConf('assignments/'.$this->input->post('assignment_path')); // Validation image
            if(!$this->upload->do_upload('question_sound')) :
                $this->message('Oopppsss',$this->upload->display_errors(),'error');
            	redirect('page/create_question/'.$this->input->post('id_assignment'));
            else :
            	$dataUpload = $this->upload->data();
            	$dataQuestion['question_sound'] = str_replace(' ', '_', $dataUpload['file_name']);
            endif;
		} // SOUND QUESTION //
		$idQuestion = $this->question->insertQuestion($dataQuestion);
		// FOR OPTION //
		foreach (json_decode($this->input->post('JSONanswer')) as $row => $value) {
			$answer = [
				'id_question' => $idQuestion,
				'option_char' => $this->input->post('option_char'.$value->row),
				'option_' => $this->input->post('option_'.$value->row),
				'option_created' => date('Y-m-d H:i:s')
			];
			if ($value->row == $this->input->post('choosedAnswer')) {
				$answer['option_true'] = 1;
			}
			// IMAGE OPTION //
			if ($_FILES['option_image'.$value->row]['name']) {
				$this->imageConf('assignments/'.$this->input->post('assignment_path')); // Validation image
	            if(!$this->upload->do_upload('option_image'.$value->row)) :
	                $this->message('Oopppsss','Unggah jawaban nomor '.($value->row + 1).' gagal, detail -> '.$this->upload->display_errors(),'error');
	            	redirect('backend/question/create_question/'.$this->input->post('id_assignment'));
	            else :
	            	$dataUpload = $this->upload->data();
	            	$answer['option_image'] = str_replace(' ', '_', $dataUpload['file_name']);
	            	// COMPRESS IMAGE //
	            	$resolution = ['width' => 500, 'height' => 500];
		            $this->compreesImage('assignments/'.$this->input->post('assignment_path'),$dataUpload['file_name'],$resolution);
	            endif;
			} // END IMAGE OPTION //
			$this->question->insertOption($answer);
		}
		// INSERT ASSIGNMENT QUESTION //
		$assignmentQuestion = [
			'id_assignment' => $this->input->post('id_assignment'),
			'id_question' => $idQuestion
		];
		$this->question->insertAssignmentQuestion($assignmentQuestion);
		$this->message('Saved!','Silahkan lanjut ke soal berikutnya atau kembali :)','success');
		redirect('backend/Question/create_question/'.$this->input->post('id_assignment'));
	}

	public function edit_question($id_assignment = NULL, $id_question = NULL){
		if (!$id_question OR !$id_assignment) { // jika id_assignment & id_question berbeda dengan yanng dikirim dari button Edit Soal
			redirect('backend/assignments');//Kembali ke halaman assignment
		}
		$dataQuestion = $this->question->getQuestionById($id_question);//ambul data question berdasarkan id_question
		$dataAssignment = $this->assignment->getAssignmentById($id_assignment);//amnil data assignmeny berdasarkan id_assignment
		if (!$dataQuestion OR !$dataAssignment) {//jika data assignment dan data question berbeda 
			redirect('backend/assignments');//kembali kelaman assignment
		}
		$dataQuestion->options = $this->question->getOptionByQuestion($id_question);//ambil data jawaban berdasarkan id_question
		// echo "<pre>";
		foreach ($dataQuestion->options as $row => $value) {
			//cek jawaban yang bernilai TRUE atau bernilai 1
			if ($this->question->checkAnswerTrue($value->id_option,$id_question)) {
				$dataQuestion->trueAnswer = $row;
			}
		}
		// print_r($dataQuestion);
		// die;
		$this->parseData['dataQuestion'] = $dataQuestion;
		$this->parseData['dataAssignment'] = $dataAssignment;
		$this->parseData['content'] = 'content/backend/v_updateQuestion';
		$this->parseData['title'] = 'Rincial Soal ';
		$this->load->view('MainView/backendView',$this->parseData);
	}

	public function update_question(){
		if ($this->input->post('question_') == '') {//jika pertanyaan yang diinput kosong
			$this->message('Ooppsss','Anda belum membuat soal, pastikan anda membuat soal terlebih dahulu','error');
			//kembali ke halaman edit question 
			redirect('backend/question/edit_question/'.$this->input->post('id_assignment').'/'.$this->input->post('id_question'));
		}
		//simpan kedalam array
		$dataQuestion = [
			'id_question' => $this->input->post('id_question'),
			'id_lesson' => $this->input->post('id_lesson'),
			'question_' => $this->input->post('question_'),
			'question_created' => date('Y-m-d H:i:s')
		];
		// IMAGE QUESTION //
		if ($_FILES['question_image']['name']) {
			$this->imageConf('assignments/'.$this->input->post('assignment_path')); // Nama folder yang dituju
            if(!$this->upload->do_upload('question_image')) ://jika gagal mengupload
            	//tampilkan pesan error
                $this->message('Oopppsss',$this->upload->display_errors(),'error');
                //kembali ke halaman edit question
            	redirect('backend/question/edit_question/'.$this->input->post('id_assignment').'/'.$this->input->post('id_question'));
            else :
            	//hapus gambar sebelumnya sebelum update gambar yang baru
				$imageQuestion = $this->question->getQuestionById($this->input->post('id_question'));
				if(file_exists('assets/img/assignments/'.$this->input->post('assignment_path').'/'.$imageQuestion->question_image) && 
					$imageQuestion->question_image) 
					unlink('assets/img/assignments/'.$this->input->post('assignment_path').'/'.$imageQuestion->question_image);

            	$dataUpload = $this->upload->data();//upload data
            	$dataQuestion['question_image'] = str_replace(' ', '_', $dataUpload['file_name']);
            	// COMPRESS IMAGE //
            	$resolution = ['width' => 500, 'height' => 500];
	            $this->compreesImage('assignments/'.$this->input->post('assignment_path'),$dataUpload['file_name'],$resolution);
            endif;
		} // IMAGE QUESTION //
		// SOUND QUESTION //
		if ($_FILES['question_sound']['name']) {
			$this->soundConf('assignments/'.$this->input->post('assignment_path')); // Nama folder yang dituju
            if(!$this->upload->do_upload('question_sound')) :
                $this->message('Oopppsss',$this->upload->display_errors(),'error');
            	redirect('page/update_question/'.$this->input->post('id_assignment').'/'.$this->input->post('id_question'));
            else :
            	$dataUpload = $this->upload->data();
            	$dataQuestion['question_sound'] = str_replace(' ', '_', $dataUpload['file_name']);
            endif;
		} // SOUND QUESTION //
		//Lakukan update data berdasarkan array yang telah didefinisikan yaitu $dataQuestion[]
		$this->question->updateQuestion($dataQuestion);
		// FOR OPTION //
		foreach (json_decode($this->input->post('JSONanswer')) as $row => $value) {
			$answer = [
				'id_question' => $this->input->post('id_question'),
				'option_' => $this->input->post('option_'.$value->row),
				'option_char' => $this->input->post('option_char'.$value->row),
				'option_created' => date('Y-m-d H:i:s')
			];
			if ($value->row == $this->input->post('choosedAnswer')) {
				$answer['option_true'] = 1;
			}
			// IMAGE OPTION //
			if ($_FILES['option_image'.$value->row]['name']) {
				$this->imageConf('assignments/'.$this->input->post('assignment_path')); // Nama folder yang dituju
	            if(!$this->upload->do_upload('option_image'.$value->row)) :
	                $this->message('Oopppsss','Unggah jawaban nomor '.($value->row + 1).' gagal, detail -> '.$this->upload->display_errors(),'error');
	            	redirect('backend/question/edit_question/'.$this->input->post('id_assignment').'/'.$this->input->post('id_question'));
	            else :
	            	//hapus gambar sebelumnya sebelum update gambar yang baru
					$imageOption = $this->question->getOptionById($this->input->post('id_option'.$row));
					if(file_exists('assets/img/assignments/'.$this->input->post('assignment_path').'/'.$imageOption->option_image) && 
						$imageOption->option_image) 
						unlink('assets/img/assignments/'.$this->input->post('assignment_path').'/'.$imageOption->option_image);

	            	$dataUpload = $this->upload->data();
	            	$answer['option_image'] = str_replace(' ', '_', $dataUpload['file_name']);
	            	// COMPRESS IMAGE //
	            	$resolution = ['width' => 500, 'height' => 500];
		            $this->compreesImage('assignments/'.$this->input->post('assignment_path'),$dataUpload['file_name'],$resolution);
	            endif;
			} // END IMAGE OPTION //
			if ($this->input->post('id_option'.$row)) {
				$answer['id_option'] = $this->input->post('id_option'.$row);
				unset($answer['option_created']);
				$this->question->updateOption($answer);
			} else {
				$this->question->insertOption($answer);
			}
		}
		$this->message('Yeeayy!','Soal dan jawaban berhasil diubah :)','success');
		redirect('backend/question/list_question/'.$this->input->post('id_assignment'));
	}

	public function removeQuestion($id_question = NULL, $id_assignment, $assignment_path){
		$dataQuestion = $this->question->getQuestionById($id_question);
		$dataOption = $this->question->getOptionByQuestion($id_question);
		//hapus gambar question
		if(file_exists('assets/img/assignments/'.$assignment_path.'/'.$dataQuestion->question_image) && $dataQuestion->question_image) 
			unlink('assets/img/assignments/'.$assignment_path.'/'.$dataQuestion->question_image);

		foreach ($dataOption as $row => $value) {
			//hapus gambar option
			if(file_exists('assets/img/assignments/'.$assignment_path.'/'.$value->option_image) && $value->option_image) 
				unlink('assets/img/assignments/'.$assignment_path.'/'.$value->option_image);
		}
		$this->question->deleteQuestionById($id_question);
		$this->message('Yeeayy!','Soal yang anda pilih berhasil dihapus :)','success');
		redirect('backend/question/list_question/'.$id_assignment);
	}

	public function deleteImageOption($id_assignment = NULL, $id_question = NULL, $assignment_path = NULL, $id_option = NULL){
		if(!$id_assignment OR !$id_question OR !$id_option OR !$assignment_path){
			redirect('backend/Assignment');
		}
		$optionImage = $this->assignment->getOptionById($id_option);
		//hapus gambar option
		if(file_exists('assets/img/assignments/'.$assignment_path.'/'.$optionImage->option_image) && $optionImage->option_image){ 
			unlink('assets/img/assignments/'.$assignment_path.'/'.$optionImage->option_image);
		}

		$this->assignment->deleteOptionById($id_option);
		$this->message('Yeeay!','Jawaban berhasil dihapus','success');
		redirect('backend/question/edit_question/'.$id_assignment.'/'.$id_question);
	}

	public function delete_option($id_assignment = NULL, $id_question = NULL, $id_option = NULL){
		if(!$id_assignment OR !$id_question OR !$id_option){
			redirect('backend/Assignment');
		}

		$this->assignment->deleteOptionById($id_option);
		$this->message('Yeeay!','Jawaban berhasil dihapus','success');
		redirect('backend/question/edit_question/'.$id_assignment.'/'.$id_question);
	}
}