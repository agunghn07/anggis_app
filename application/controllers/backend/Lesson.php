<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends MY_Controller {

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
		$this->parseData['title']   = 'Dashboard';
		$this->parseData['content'] = 'content/backend/v_lesson';
		$this->load->view('MainView/backendView', $this->parseData);
	}

	public function daftar_pelajaran(){
		$this->load->helper('url');
		$list = $this->lesson->get_datatables();
		$data = array();
		$no   = $_POST['start'];
		foreach($list as $daftar){
			$time    = $daftar->lesson_created;
			$time    = strtotime($time);
			$newdate = date('d F Y', $time);
			$no++; 
			$row = array();
            $row[] = $no;
            $row[] = $daftar->lesson_name;
            $row[] = $newdate;

            $row[] = ' <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit"
                       onclick="edit('."'".$daftar->id_lesson."'".')">
                       <i class="fa fa-edit"></i>Edit&emsp;</a>
                       <a class="btn btn-sm btn-danger" href="javascript:void(0)" 
                       title="Hapus" onclick="hapus('."'".$daftar->id_lesson."'".')">
                       <i class="fa fa-trash"></i>Delete</a>';
 
            $data[] = $row;
		}
		 $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->lesson->count_all(),
                    "recordsFiltered" => $this->lesson->count_filtered(),
                    "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}

	public function add_mapel(){
		$validate = array('success' => false, 'messages' => array());

        $this->form_validation->set_rules('lesson_name','Lesson','required|is_unique[ms_lesson.lesson_name]',
            array(
                'required' => '* Mapel Tidak Boleh Kosong !',
                'is_unique' => '* Mata Pelajaran Sudah Ada !'
            ));
        $this->form_validation->set_error_delimiters('<small class="text-danger">','</small>');
            
        if($this->form_validation->run() == TRUE){
            $data = array(
                'lesson_name'    => $this->input->post('lesson_name'),
                'lesson_created' => date('Y-m-d')
            );
            $query  = $this->lesson->tambah_mapel($data);

            if($query){
                $validate['success'] = true;
            }
        }else{
            $validate['success'] = false;
            foreach($_POST as $key=>$value){
                $validate['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($validate);
	}

    public function get_mapel($id)
    {
        $data = $this->lesson->get_by_id($id);
        echo json_encode($data);
    }

    public function update_mapel()
    {
        $this->_validate();
        $data = array('lesson_name' => $this->input->post('lesson_name'));
        $id   = array('id_lesson'   => $this->input->post('id_lesson'));
        $this->lesson->update($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus_mapel($id){
    	$this->lesson->hapus_mapel($id);
    	echo json_encode(array('status' => TRUE));
    }

	private function _validate(){
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->lesson->getLessonName($this->input->post('lesson_name')))
        {
            $data['inputerror'][] = 'lesson_name';
            $data['error_string'][] = '* Mata Pelajaran sudah ada';
            $data['status'] = FALSE;
        }

        if($this->input->post('lesson_name') == '')
        {
            $data['inputerror'][] = 'lesson_name';
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