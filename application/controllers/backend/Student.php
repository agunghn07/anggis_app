<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends MY_Controller {

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
		$this->parseData['dataMapel'] = $this->student->getAllLesson();
		$this->parseData['dataKelas'] = $this->student->getAllClassroom();
		$this->parseData['title']   = 'Dashboard';
		$this->parseData['content'] = 'content/backend/v_student';
		$this->load->view('MainView/backendView', $this->parseData);
	}

    public function list_student(){
        $this->load->helper('url');
        $list = $this->student->get_datatables();
        $data = array();
        $no   = $_POST['start'];
        foreach($list as $siswa){
            $no++;
            $time    = $siswa->student_created;
            $time    = strtotime($time);
            $newdate = date('d F Y', $time);
            $row = array();
            $row[] = $no;
            if($siswa->student_photo)
                $row[] = '<a href="'.base_url('assets/img/foto_siswa/'.$siswa->student_photo).'" target="_blank"><img src="'.base_url('assets/img/foto_siswa/'.$siswa->student_photo).'" height="40px" width="40px;" class="img-circle" /></a>';
            else
                $row[] = '(No Result)';
            $row[] = $siswa->student_name;
            $row[] = $siswa->student_nis;
            $row[] = $siswa->class_name;//Join table pada model(ms.class, ms_class.id_class = ms_student.id_student)
            //$row[] = $siswa->student_phone;
            $row[] = $siswa->student_email;
            $row[] = $newdate;

            $row[] = ' <a class="btn btn-sm btn-outline btn-primary" href="javascript:void(0)" title="Edit" 
                       onclick="edit('."'".$siswa->id_student."'".')">
                       <i class="fa fa-edit"></i>Edit&emsp;</a>
                       <a class="btn btn-sm btn-outline btn-danger" href="javascript:void(0)" 
                       title="Hapus" onclick="hapus('."'".$siswa->id_student."'".')">
                       <i class="fa fa-trash"></i>Delete</a>';
 
            $data[] = $row;
        }
         $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->student->count_all(),
                    "recordsFiltered" => $this->student->count_filtered(),
                    "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

	public function add_student(){
		$this->_validate();
		$data = array(
			'student_name'  	=> $this->input->post('student_name'),
			'student_nis'		=> $this->input->post('student_nis'),
			'student_password'  => sha1($this->config->item('salt').$this->input->post('student_password')),
			'student_email'		=> $this->input->post('student_email'),
			'student_phone'  	=> $this->input->post('student_phone'),
			'id_class'			=> $this->input->post('id_class'),
			'student_created'	=> date('Y-m-d')
		);
		if(!empty($_FILES['student_photo']['name']))
		{
			$upload = $this->_do_upload();
			$data['student_photo'] = $upload;
		}
		$insert = $this->student->add_student($data);
		echo json_encode(array("status" => TRUE));
	}

    public function get_student($id)
    {
        $data = $this->student->getStudentById($id);
        echo json_encode($data);
    }

    public function update_student()
    {
        $this->_validates();
        $data = array(
                'student_name'     => $this->input->post('student_name'),
                'student_nis'      => $this->input->post('student_nis'),
                'student_email'    => $this->input->post('student_email'),
                'student_phone'    => $this->input->post('student_phone'),
                'id_class'         => $this->input->post('id_class'),
                'student_created'  => date('Y-m-d')
            );

        if($this->input->post('student_password') != ''){
            $data['student_password'] = sha1($this->config->item('salt').$this->input->post('student_password'));
        }else{
            unset($data['student_password']);
        }

        if(!empty($_FILES['student_photo']['name']))
        {
            $upload = $this->_do_upload();
            
            //delete file
            $person = $this->student->getStudentById($this->input->post('id_student'));
            if($person->student_photo != 'noimage.png'){
                if(file_exists('assets/img/foto_siswa/'.$person->student_photo) && $person->student_photo){
                    unlink('assets/img/foto_siswa/'.$person->student_photo);
                }
            }
            $data['student_photo'] = $upload;
        }

        $id = array('id_student' => $this->input->post('id_student'));
        $this->student->update_siswa($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete_student($id){
        $data = $this->student->getStudentById($id);
        if($data->student_photo != 'noimage.png'){
            if(file_exists('assets/img/foto_siswa/'.$data->student_photo) && $data->student_photo){
                unlink('assets/img/foto_siswa/'.$data->student_photo);
            }
        }
        $this->student->hapus_siswa($id);
        echo json_encode(array('status' => TRUE));
    }

	private function _do_upload()
    {
        $config['upload_path']          = 'assets/img/foto_siswa/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000; //set max size allowed in Kilobyte
        $config['max_width']            = 10000; // set max width image allowed
        $config['max_height']           = 10000; // set max height allowed
        $config['file_name']            = ''; //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('student_photo')) //upload and validate
        {
            $data['inputerror'][] = 'student_photo';
            $data['error_string'][] = $this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }else{
            $gbr = $this->upload->data();
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/img/foto_siswa/'.$gbr['file_name'];
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

        if($this->student->getstudentName($this->input->post('student_name')))
        {
            $data['inputerror'][] = 'student_name';
            $data['error_string'][] = '* Nama siswa sudah ada';
            $data['status'] = FALSE;
        }

        if($this->student->getstudentNis($this->input->post('student_nis')))
        {
            $data['inputerror'][] = 'student_nis';
            $data['error_string'][] = '* NIS siswa sudah ada';
            $data['status'] = FALSE;
        }

        if($this->input->post('student_name') == '')
        {
            $data['inputerror'][] = 'student_name';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        }  

        if($this->input->post('student_nis') == '')
        {
            $data['inputerror'][] = 'student_nis';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        } 

        if($this->input->post('student_password') == '')
        {
            $data['inputerror'][] = 'student_password';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        }

        if($this->input->post('student_email') == '')
        {
            $data['inputerror'][] = 'student_email';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        } 

        if($this->input->post('student_phone') == '')
        {
            $data['inputerror'][] = 'student_phone';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        }  

        if($this->input->post('id_class') == '')
        {
            $data['inputerror'][] = 'id_class';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        }   

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
	}

    private function _validates(){
        $data = array();
        $nama = $this->student->getstudentName($this->input->post('student_name'));
        $nis  = $this->student->getstudentNis($this->input->post('student_nis'));
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($nama)
        {
            if($this->input->post('id_student') != $nama->id_student){
                $data['inputerror'][] = 'student_name';
                $data['error_string'][] = '* Nama siswa sudah ada';
                $data['status'] = FALSE;
            }
        }

        if($nis){
            if($this->input->post('id_student') != $nis->id_student){
                $data['inputerror'][] = 'student_nis';
                $data['error_string'][] = '* NIS siswa sudah ada';
                $data['status'] = FALSE;
            }
        }

        if($this->input->post('student_name') == '')
        {
            $data['inputerror'][] = 'student_name';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        }  

        if($this->input->post('student_nis') == '')
        {
            $data['inputerror'][] = 'student_nis';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        } 

        if($this->input->post('student_email') == '')
        {
            $data['inputerror'][] = 'student_email';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        } 

        if($this->input->post('student_phone') == '')
        {
            $data['inputerror'][] = 'student_phone';
            $data['error_string'][] = '* Field tidak boleh kosong !';
            $data['status'] = FALSE;
        }  

        if($this->input->post('id_class') == '')
        {
            $data['inputerror'][] = 'id_class';
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