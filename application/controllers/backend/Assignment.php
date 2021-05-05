<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment extends MY_Controller {

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

	public function index()
	{
		$this->parseData['dataLessons'] = $this->assignment->getAllLessons();
		$this->parseData['dataClasses'] = $this->assignment->getAllClasses();
		$this->parseData['title']   = 'Dashboard';
		$this->parseData['content'] = 'content/backend/assignment/addAssignment';
		$this->load->view('MainView/backendView', $this->parseData);
	}

	public function list_assignment(){
		$this->load->helper('url');
		$list = $this->assignment->get_datatables();
		foreach ($list as $row => $value) {
			$list[$row]->totalQuestion = count($this->assignment->getQuestionByAssignment($value->id_assignment));
		}
		$data = array();
		$no   = $_POST['start'];
		foreach($list as $daftar){
			$time    = $daftar->assignment_created;
			$time    = strtotime($time);
			$newdate = date('d F Y', $time);
			$no++; 
			$row = array();
            $row[] = $daftar->lesson_name.' - '.$daftar->assignment_type;
            $row[] = $daftar->assignment_kkm.' %';
            // $row[] = $daftar->totalQuestion.' Soal';
            $row[] = $daftar->assignment_author;

            if($daftar->totalQuestion < 1){
            	$row[] = '<center><i class="text-danger">Soal belum Dibuat</i></center>';
            }else{
            	if($daftar->assignment_active == 1){
            		$row[] = '<div class="onoffswitch">
								<input type="checkbox" name="assignment_active" id="assignment_active'.$daftar->id_assignment.'" checked onclick="forCheck('.$daftar->id_assignment.')" class="onoffswitch-checkbox">
								<label class="onoffswitch-label" for="assignment_active'.$daftar->id_assignment.'"></label>
							  </div>';
            	}else{
            		$row[] = '<div class="onoffswitch">
								<input type="checkbox" name="assignment_active" id="assignment_active'.$daftar->id_assignment.'" onclick="forCheck('.$daftar->id_assignment.')" class="onoffswitch-checkbox">
								<label class="onoffswitch-label" for="assignment_active'.$daftar->id_assignment.'"></label>
							  </div>';
            	}
            }
            $row[] = $newdate;
            
            $row[] = '<a title="Buat Soal" href="'.site_url("backend/Question/list_question/").$daftar->id_assignment.'" 
            		  class="btn btn-outline btn-success btn-sm"><i class="fa fa-bookmark"></i></a>
					  <a title="Ubah Data Ujian" href="'.site_url("backend/assignment/edit/").$daftar->id_assignment.'" 
					  class="btn btn-outline btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					  <a title="Hapus Ujian" onclick="hapus('."'".$daftar->id_assignment."'".')" class="btn btn-outline btn-danger btn-sm">
					  <i class="fa fa-trash"></i></a>';

 
            $data[] = $row;
		}
		 $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->assignment->count_all(),
                    "recordsFiltered" => $this->assignment->count_filtered(),
                    "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}

	public function create(){
		if (!$this->input->post()) {
			redirect('backend/Assignment/create');
		}
		$this->form_validation->set_rules('assignment_type','Tipe Ujian','required',array('required' => '* Field tidak boleh kosong!'));
		$this->form_validation->set_rules('assignment_kkm','KKM','required',array('required' => '* Field tidak boleh kosong!'));
		$this->form_validation->set_rules('assignment_duration','Durasi','required',array('required' => '* Field tidak boleh kosong!'));
		$this->form_validation->set_rules('assignment_author','Pembuat','required',array('required' => '* Field tidak boleh kosong!'));
		$this->form_validation->set_error_delimiters('<small class="error">','</small>');
		if($this->form_validation->run() == FALSE){
			$this->index();
		}else{
			$data = $this->input->post();//semua atribut name di post
			unset($data['show_report']);//di unset terlebih dahulu untuk kondisi if
			unset($data['show_analytic']);
			unset($data['id_class']);
			if ($this->input->post('show_analytic')) {
				$data['show_analytic'] = 1;
			}
			if ($this->input->post('show_report')) {
				$data['show_report'] = 1;
			}
			$data['id_'] = $this->session->userdata('id_admin');//ambil session id_admin
			$data['author_'] = $this->session->userdata('level');//ambil session level
			$data['assignment_created'] = date('Y-m-d H:i:s');
			$dirName = date('s').'-'.substr(sha1($data['id_']), 4,7).'-'.$data['id_']; //nama folder yang nanti dibuat
			if (!is_dir('assets/img/assignments/'.$dirName)) {
				mkdir('./assets/img/assignments/' . $dirName, 0777, TRUE);//lokasi folder yang dibuat
			}
			$data['assignment_path'] = $dirName;
			$idAssignment = $this->assignment->insertAssignment($data);
			
			// CLASS //
			foreach ($this->input->post('id_class') as $row => $value) {
				$single = [
					'id_assignment' => $idAssignment,
					'id_class' => $value
				];
				$this->assignment->insertAssignmentClass($single);
			}
			$this->message('Saved!','Silahkan buat soal untuk melanjutkan','success');
			redirect('backend/question/list_question/'.$idAssignment);
		}
	}

	public function edit($id_assignment = NULL){
		if (!$id_assignment) {
			redirect('page/assignments');
		}
		$dataAssignment = $this->assignment->getAssignmentById($id_assignment);
		if (!$dataAssignment) {
			redirect('page/assignments');
		}
		//ambil data kelas (table ms_class) berdasarkan id assignment yang di post
		$dataAssignment->classes = $this->assignment->getClassByAssignment($id_assignment);
		if ($this->session->userdata('level') == 'guru') {
			$dataClasses = $this->teacher->getClassByTeacher($this->session->userdata('id_admin'));
			$dataLessons = $this->teacher->getLessonByTeacher($this->session->userdata('id_admin'));
		} else {
			$dataClasses = $this->assignment->getAllClasses();
			$dataLessons = $this->assignment->getAllLessons();
		}
		$this->parseData['dataAssignment'] = $dataAssignment;
		$this->parseData['dataLessons'] = $dataLessons;
		$this->parseData['dataClasses'] = $dataClasses;
		$this->parseData['content'] = 'content/backend/assignment/editAssignment';
		$this->parseData['title'] = 'Ubah Ujian ';
		$this->load->view('MainView/backendView',$this->parseData);
	}

	public function update(){
		if (!$this->input->post()) {
			redirect('backend/assignments');
		}
		$data = $this->input->post();
		unset($data['show_report']);
		unset($data['show_analytic']);
		unset($data['id_class']);
		if ($this->input->post('show_analytic')) {
			$data['show_analytic'] = 1;
		} else {
			$data['show_analytic'] = 0;
		}
		if ($this->input->post('show_report')) {
			$data['show_report'] = 1;
		} else {
			$data['show_report'] = 0;
		}
		$this->assignment->updateAssignment($data);
		
		// CLASS //
		//ambil data kelas (table ms_class) berdasarkan id assignment yang di post
		foreach ($this->assignment->getClassByAssignment($this->input->post('id_assignment')) as $r => $v) {
			$valDel = true;
			foreach ($this->input->post('id_class') as $row => $value) {
			//jika id_class yang di post sama dengan id_class yang di get pada getClassByAssignent, maka bernilai false dan langsung diupdate
				if ($value == $v->id_class) {
					$valDel = false;
				}
			}
			//jika $valDel bernilai true, maka kelas di hapus
			if ($valDel) {
				$this->assignment->deleteAssignmentClassId($v->id_aclass);
			}
		}
		foreach ($this->input->post('id_class') as $_row => $_value) {
			$valIns = true;
			foreach ($this->assignment->getClassByAssignment($this->input->post('id_assignment')) as $_r => $_v) {
				if ($_v->id_class == $_value) {
					$valIns = false;
				}
			}
			if ($valIns) {
				$single = [
					'id_assignment' => $this->input->post('id_assignment'),
					'id_class' => $_value
				];
				$this->assignment->insertAssignmentClass($single);
			}
		}
		$this->message('Selamat!','Data ujian berhasil di ubah','success');
		redirect('backend/Assignment');
	}

	public function delete_assignment($id){
		$dataAssignment = $this->assignment->getAssignmentById($id);
		//Hapus folder/directory yang ada di folder assignment berdasarkan assignment_path
		if (is_dir('assets/img/assignments/'.$dataAssignment->assignment_path)) {//lokasi folder/directory yang akan di hapus
	        $objects = scandir('assets/img/assignments/'.$dataAssignment->assignment_path);//fungsi scandir untuk melihat isi directory
	        //lakukan perulangan untuk mengecek jika ada file didalam folder, maka file tersebut akan ikut terhapus
	        foreach ($objects as $object) {
	            if ($object != "." && $object !="..") {
	                if (filetype('assets/img/assignments/'.$dataAssignment->assignment_path . DIRECTORY_SEPARATOR . $object) == "dir") {
	                    deleteDirectory('assets/img/assignments/'.$dataAssignment->assignment_path . DIRECTORY_SEPARATOR . $object);
	                } else {
	                	//hapus file yang ada di directory
	                    unlink('assets/img/assignments/'.$dataAssignment->assignment_path . DIRECTORY_SEPARATOR . $object);
	                }
	            }
	        }
		    reset($objects);
		    //hapus directory
		    rmdir('assets/img/assignments/'.$dataAssignment->assignment_path);
	    }
		$this->assignment->deleteAssignment($id, $dataAssignment->id_lesson);
		echo json_encode(array('status' => TRUE));
	}

	public function changeStatusAssignment($id_assignment,$status){
		if ($status == 2) {
			$status = 0;
		}
		$data = [
			'id_assignment' => $id_assignment,
			'assignment_active' => $status,
		];
		//ambil data assignment yang bernilai 1 atau aktif
		$totalAssignment = 0;
		foreach ($this->assignment->getAllAssignment() as $row => $value) {
			if ($value->assignment_active == 1) {
				$totalAssignment++;
			}
		}
		//batasi data assignment yang aktif sebanyak 10 data
		if ($totalAssignment >= 10 AND $status == 1) {
			echo "limit";
		} else {
			$this->assignment->updateAssignment($data);
			return true;
		}
	}
}