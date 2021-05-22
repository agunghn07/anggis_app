<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('LoginModel','login',TRUE);
	}

	public function message($title = NULL, $text = NULL, $type = NULL){
		return $this->session->set_flashdata([
			'title'	=> $title,
			'text'	=> $text,
			'type'	=> $type,
		]);
	}

	public function index(){
		$this->checkToken();
		$this->load->view('auth/login');
	}

	public function checkToken(){
		if($this->session->userdata('backToken')){
			if($this->login->checkToken($this->session->userdata('backToken'))){
				redirect('MainMenu');
			}else{
				$this->session->sess_destroy();
				redirect('auth/login/logout');
			}
		}
	}

	public function login(){
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_error_delimiters('<small class="text-danger">','</small>');

		if($this->form_validation->run() == FALSE){
			$this->index();
		}else{
			$result = $this->login->check();
			switch ($result) {
				case 'verified':
					$this->registToken();
				break;

				case 'incorrect_password':
					$this->message('Oooppss!','Password tidak sesuai','error');
					redirect('auth/login');
				break;

				case 'username_not_found':
					$this->message('Oooppss!','Username tidak terdaftar','error');
					redirect('auth/login');
				break;	
			}
		}
	}

	public function registToken(){
		$data = ['user_id' => $this->session->userdata('Id'), 'access_token' => $this->session->userdata('backToken')];
		$logId = $this->login->registToken($data);
		$this->message('Halo '.$this->session->userdata("Username"). '!','Welcome to Anggis App','success');
		redirect('MainMenu');
	}

	public function not_found(){
		echo "Page not Found";
	}

	public function logout(){
		$unsetSession = array(
			$this->session->userdata('Id'),
			$this->session->userdata('Userrname'),
			$this->session->userdata('Role'),
			$this->session->userdata('backToken'),
		);
		$this->login->deleteToken($this->session->userdata('backToken'));
		$this->session->unset_userdata($unsetSession);
		$this->message('Logout Berhasil ','Silahkan login kembali untuk melanjutkan','success');
		redirect('Auth/login');
	}
}