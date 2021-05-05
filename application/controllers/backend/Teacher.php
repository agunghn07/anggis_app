<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends MY_Controller {

	public function __construct(){
		parent::__construct();
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
		$this->parseData['dataMapel'] = $this->teacher->get_mapel();
		$this->parseData['dataKelas'] = $this->teacher->get_kelas();
		$this->parseData['title']   = 'Dashboard';
		$this->parseData['content'] = 'content/backend/v_teacher';
		$this->load->view('MainView/backendView', $this->parseData);
	}

	public function list_teacher(){
		$this->load->helper('url');
		$list = $this->teacher->get_datatables();
		$data = array();
        $no   = $_POST['start']; 
		foreach($list as $guru){
            $no++;
            $time    = $guru->teacher_created;
            $time    = strtotime($time);
            $newdate = date('d F Y', $time);
			$row = array();
            $row[] = $no;
            if($guru->teacher_photo)
                $row[] = '<a href="'.base_url('assets/img/foto_guru/'.$guru->teacher_photo).'" target="_blank"><img src="'.base_url('assets/img/foto_guru/'.$guru->teacher_photo).'" height="40px" width="40px;" class="img-circle" /></a>';
            else
                $row[] = '(No Result)';
            $row[] = $guru->teacher_name;
            $row[] = $guru->teacher_username;
            $row[] = $guru->teacher_phone;
            $row[] = $guru->teacher_email;
            $row[] = $newdate;

            $row[] = ' <a class="btn btn-sm btn-outline btn-primary" href="'.site_url("backend/Teacher/edit_teacher/").$guru->id_teacher.'" 
                       title="Edit"><i class="fa fa-edit"></i>Edit&emsp;</a>
                       <a class="btn btn-sm btn-outline btn-danger" href="javascript:void(0)" 
                       title="Hapus" onclick="hapus('."'".$guru->id_teacher."'".')">
                       <i class="fa fa-trash"></i>Delete</a>';
 
            $data[] = $row;
		}
		 $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->teacher->count_all(),
                    "recordsFiltered" => $this->teacher->count_filtered(),
                    "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}

	public function add_teacher(){
		$this->_validate();
		$data = array(
			'teacher_name' 	   => $this->input->post('teacher_name'),
			'teacher_username' => $this->input->post('teacher_username'), 
			'teacher_password' => sha1($this->config->item('salt').$this->input->post('teacher_password')),
			'teacher_email'	   => $this->input->post('teacher_email'),
			'teacher_phone'    => $this->input->post('teacher_phone'),
			'teacher_address'  => $this->input->post('teacher_address'),
			'teacher_created'  => date('Y-m-d')
		);
		if(!empty($_FILES['teacher_photo']['name']))
		{
			$upload = $this->_do_upload();
			$data['teacher_photo'] = $upload;
		}
		$insert = $this->teacher->add_teacher($data);
		if($this->input->post('id_lesson') && $this->input->post('id_class')){
			foreach($this->input->post('id_lesson') as $lesson => $mapel){
			$singleLesson = array(
				'id_teacher' =>  $insert,
				'id_lesson'  => $mapel
			);
			$this->teacher->insertTeacherLesson($singleLesson);
			}
			foreach($this->input->post('id_class') as $classroom => $kelas){
				$singleClass = array(
					'id_teacher' => $insert,
					'id_class'	 => $kelas 
				);
				$this->teacher->insertTeacherClass($singleClass);
			}
		}
		echo json_encode(array("status" => TRUE));
	}

    public function edit_teacher($id_teacher = NULL) {
        if (!$id_teacher) {
            redirect('backend/teacher');
        }
        $dataTeacher = $this->teacher->getTeacherById($id_teacher);
        if (!$dataTeacher) {
            redirect('page/teachers');
        }
        $dataTeacher->classes = $this->teacher->getClassByTeacher($id_teacher);
        $dataTeacher->lessons = $this->teacher->getLessonByTeacher($id_teacher);
        $this->parseData['dataTeacher'] = $dataTeacher;
        $this->parseData['dataLessons'] = $this->teacher->get_mapel();
        $this->parseData['dataClasses'] = $this->teacher->get_kelas();
        $this->parseData['content'] = 'content/backend/v_teacher_edit';
        $this->parseData['title'] = 'Ubah Guru ';
        $this->load->view('MainView/backendView',$this->parseData);
    }

    public function update_teacher() {
        if ($this->input->post()) {
            $data = $this->input->post();
            $teacherUsername = $this->preg($this->input->post('teacher_username'));
            if($this->input->post('id_teacher')){
                $dataStudent = $this->teacher->getTeacherUsername($teacherUsername);
                if($dataStudent){
                    if($dataStudent->id_teacher != $data['id_teacher']){
                        $this->message('Oopppsss!','Username sudah ada, coba username lain','error');
                        redirect('backend/Teacher/edit_teacher/'.$data['id_teacher']);
                    }
                }
                $dataName = $this->teacher->getTeacherFullname($data['teacher_name']);
                if($dataName){
                    if($dataName->id_teacher != $data['id_teacher']){
                        $this->message('Oopppsss!','Nama sudah ada, coba nama lain','error');
                        redirect('backend/Teacher/edit_teacher/'.$data['id_teacher']);
                    }
                }
            }
            if ($_FILES['teacher_photo']['name']) {
                $this->imageConf('foto_guru'); // foto _guru merupakan nama folder lokasi yang akan dituju pada function imageConf
                if(!$this->upload->do_upload('teacher_photo')) :
                    $this->message('Oopppsss',$this->upload->display_errors(),'error');
                    redirect('backend/teacher');
                else :
                    //Delete File
                    $person = $this->teacher->getTeacherById($this->input->post('id_teacher'));
                    if($person->teacher_photo != 'noimage.png'){
                        if(file_exists('assets/img/foto_guru/'.$person->teacher_photo) && $person->teacher_photo){
                            unlink('assets/img/foto_guru/'.$person->teacher_photo);
                        }
                    }
                    $dataUpload = $this->upload->data();
                    $data['teacher_photo'] = str_replace(' ', '_', $dataUpload['file_name']);
                    // COMPRESS IMAGE //
                    $resolution = ['width' => 500, 'height' => 500];
                    $this->compreesImage('foto_guru',$dataUpload['file_name'],$resolution);
                endif;
            }
            unset($data['id_class']);
            unset($data['id_lesson']);
            if ($this->input->post('password') != '') {
                $data['teacher_password'] = sha1($this->config->item('salt').$this->input->post('teacher_password'));
            } else {
                unset($data['teacher_password']);
            }
            $data['teacher_username'] = $teacherUsername;
            $this->teacher->updateTeacher($data);
            // FOR CLASS //
            foreach ($this->teacher->getClassByTeacher($this->input->post('id_teacher')) as $classroom => $kelas) {
                $classDel = true;
                foreach ($this->input->post('id_class') as $_classroom => $_kelas) {
                    if ($_kelas == $kelas->id_class) {
                        $classDel = false;
                    }
                }
                if ($classDel) {
                    $this->teacher->deleteClassByTeacher($this->input->post('id_teacher'),$kelas->id_class);
                }
            }
            foreach ($this->input->post('id_class') as $__classroom => $__kelas) {
                $classIns = true;
                foreach ($this->teacher->getClassByTeacher($this->input->post('id_teacher')) as $classroom_ => $kelas_) {
                    if ($__kelas == $kelas_->id_class) {
                        $classIns = false;
                    }
                }
                if ($classIns) {
                    $singleClass = [
                        'id_teacher' => $this->input->post('id_teacher'),
                        'id_class' => $__kelas,
                    ];
                    $this->teacher->insertTeacherClass($singleClass);
                }
            }
            // FOR LESSON //
            foreach ($this->teacher->getLessonByTeacher($this->input->post('id_teacher')) as $lesson => $mapel) {
                $lessonDel = true;
                foreach ($this->input->post('id_lesson') as $_lesson => $_mapel) {
                    if ($_mapel == $mapel->id_lesson) {
                        $lessonDel = false;
                    }
                }
                if ($lessonDel) {
                    $this->teacher->deleteLessonByTeacher($this->input->post('id_teacher'),$mapel->id_lesson);
                }
            }
            foreach ($this->input->post('id_lesson') as $__lesson => $__mapel) {
                $lessonIns = true;
                foreach ($this->teacher->getLessonByTeacher($this->input->post('id_teacher')) as $lesson_ => $mapel_) {
                    if ($__mapel == $mapel_->id_lesson) {
                        $lessonIns = false;
                    }
                }
                if ($lessonIns) {
                    $singleLesson = [
                        'id_teacher' => $this->input->post('id_teacher'),
                        'id_lesson' => $__mapel,
                    ];
                    $this->teacher->insertTeacherLesson($singleLesson);
                }
            }
            $this->message('Selamat!','Data guru berhasil diubah','success');
        }
        redirect('backend/teacher');
    }

    public function delete_teacher($id){
        $data = $this->teacher->getTeacherById($id);
        if($data->teacher_photo != 'noimage.png'){   
            if(file_exists('assets/img/foto_guru/'.$data->teacher_photo) && $data->teacher_photo){
                unlink('assets/img/foto_guru/'.$data->teacher_photo);
            }   
        }
        $this->teacher->hapus_teacher($id);
        echo json_encode(array('status' => TRUE));
    }

	private function _do_upload()
    {
        $config['upload_path']          = 'assets/img/foto_guru/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000; //set max size allowed in Kilobyte
        $config['max_width']            = 10000; // set max width image allowed
        $config['max_height']           = 10000; // set max height allowed
        $config['file_name']            = ''; //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('teacher_photo')) //upload and validate
        {
            $data['inputerror'][] = 'teacher_photo';
            $data['error_string'][] = $this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }else{
            $gbr = $this->upload->data();
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/img/foto_guru/'.$gbr['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 500;
            $config['height'] = 500;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            return $gbr['file_name'];
        }
    }

	private function _validate(){
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->teacher->getTeacherUsername($this->input->post('teacher_username')))
        {
            $data['inputerror'][] = 'teacher_username';
            $data['error_string'][] = '* Username sudah ada';
            $data['status'] = FALSE;
        }

        if($this->teacher->getTeacherFullname($this->input->post('teacher_name')))
        {
            $data['inputerror'][] = 'teacher_name';
            $data['error_string'][] = '* Nama guru sudah ada';
            $data['status'] = FALSE;
        }

        if($this->input->post('teacher_name') == '')
        {
            $data['inputerror'][] = 'teacher_name';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        }  

        if($this->input->post('teacher_username') == '')
        {
            $data['inputerror'][] = 'teacher_username';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        } 

        if($this->input->post('teacher_password') == '')
        {
            $data['inputerror'][] = 'teacher_password';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        }

        if($this->input->post('teacher_email') == '')
        {
            $data['inputerror'][] = 'teacher_email';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        } 

        if($this->input->post('teacher_phone') == '')
        {
            $data['inputerror'][] = 'teacher_phone';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        }  

        if($this->input->post('teacher_address') == '')
        {
            $data['inputerror'][] = 'teacher_address';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        }   

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
	}
}