<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('LoginModel','login', TRUE);
		$this->load->model('MasterModel','master', TRUE);
		$this->load->model('PengajuanCutiModel','pengajuan', TRUE);
		$this->load->model('NotifikasiSurelModel','notif', TRUE);
		$this->load->model('PersetujuanCutiModel', 'persetujuan', TRUE);
		$this->load->model('HistoryCutiModel', 'history', TRUE);
		$this->load->model('ListPengajuanCutiModel', 'listPengajuan', TRUE);
		$this->load->helper('url');
		$this->load->library('mailer');
		$this->checkAuth(false);
	}

	public $parseData = [
		'content'	=> '',
		'title'		=> '',
		'navbar'	=> 'layout/navbar',
		'sidebar'	=> 'layout/sidebar',
		'footer'	=> 'layout/footer'
	];

	public function like_match($pattern, $subject){
		$pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
		return (bool) preg_match("/^{$pattern}$/i", $subject);
	}

	public function notfound(){
        $this->load->view('MainView/notfound');
    }

	public function preg($value) {
		return str_replace(" ", "-", str_replace("/", "-", str_replace("\\", "-", str_replace("'", "-", str_replace(",", "-", str_replace(".", "-", str_replace('!', '', $value)))))));
	}

	public function checkAuth($NotByPass){
		if($NotByPass){
			if(!$this->session->userdata('backToken')){
				redirect('Auth/login');
			}else{
				if(!$this->login->checkToken($this->session->userdata('backToken'))){
					redirect('MainPage/logout');
				}
			}
		}
	}

	public function message($title = NULL,$text = NULL,$type = NULL) {
		return $this->session->set_flashdata([
				'title' => $title,
				'text' => $text,
				'type' => $type
			]
		);
	}
}