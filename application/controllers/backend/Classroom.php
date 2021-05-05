<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classroom extends MY_Controller {

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
		$this->parseData['content'] = 'content/backend/v_classroom';
		$this->load->view('MainView/backendView', $this->parseData);
	}

	public function daftar_kelas(){
		$this->load->helper('url');
		$list = $this->classroom->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach($list as $daftar){
			$time    = $daftar->class_created;
			$time    = strtotime($time);
			$newdate = date('d F Y', $time);
			$no++;
			$row = array();
			$row[]   = $no;
			$row[]   = $daftar->class_name;
			$row[]   = $newdate;
			$row[]   = ' <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit"
                         onclick="edit('."'".$daftar->id_class."'".')">
                         <i class="fa fa-edit"></i>Edit&emsp;</a>
                         <a class="btn btn-sm btn-danger" href="javascript:void(0)" 
                         title="Hapus" onclick="hapus('."'".$daftar->id_class."'".')">
                         <i class="fa fa-trash"></i>Delete</a>';
 
            $data[] = $row;
		}
		$output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->classroom->count_all(),
                    "recordsFiltered" => $this->classroom->count_filtered(),
                    "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}

	public function tambah_kelas(){
		$validate = array('success' => false, 'messages' => array());

        $this->form_validation->set_rules('class_name','Class','required|is_unique[ms_class.class_name]',
            array(
                'required' => '* Kelas Tidak Boleh Kosong !',
                'is_unique' => '* Kelas Sudah Ada !'
            ));
        $this->form_validation->set_error_delimiters('<small class="text-danger">','</small>');
            
        if($this->form_validation->run() == TRUE){
            $data = array(
                'class_name'    => $this->input->post('class_name'),
                'class_created' => date('Y-m-d')
            );
            $query  = $this->classroom->add_kelas($data);

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

	public function get_classroom($id){
		$data = $this->classroom->get($id);
		echo json_encode($data);
	}

	public function update_kelas(){
		$this->_validate();
		$data = array('class_name' => $this->input->post('class_name'));
		$id   = array('id_class' => $this->input->post('id_class'));
		$this->classroom->update($id, $data);
		echo json_encode(array('status' => TRUE));
	}

	public function hapus_kelas($id){
		$this->classroom->delete_kelas($id);
		echo json_encode(array('status' => TRUE));
	}

	private function _validate(){
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->classroom->getClassName($this->input->post('class_name'))){
        	$data['inputerror'][] = 'class_name';
        	$data['error_string'][] = '* Kelas sudah ada';
        	$data['status'] = FALSE;	
        }

        if($this->input->post('class_name') == '')
        {
            $data['inputerror'][] = 'class_name';
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