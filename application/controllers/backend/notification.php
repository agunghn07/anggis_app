<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MY_Controller{

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') != 'admin'){
			redirect('MainPage/notfound');
		}
	}

	public function index(){
		$this->paresData['title'] = 'Live Notification';
		$this->parseData['content'] = 'content/backend/notif/Notification.php';
		$this->load->view('MainView/backendView', $this->parseData);
	}

	public function insert(){
		$data = array(
			'comment_subject' => $this->input->post('subject'),
			'comment_text' => $this->input->post('comment'),
			'comment_status' => 0,
			'comment_created' => date('Y-m-d H:i:s')
		);

		$query = $this->notif->insert($data);

		echo json_encode($query);
	}

	

}