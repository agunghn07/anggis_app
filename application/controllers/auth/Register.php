<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('RegistModel','regist',TRUE);
	}

	public function message($title = NULL, $text = NULL, $type = NULL){
		return $this->session->set_flashdata([
			'title' => $title,
			'text'	=> $text,
			'type'	=> $type,
		]);
	}

	public function index(){
		$this->load->view('auth/register');
	}

	public function regist(){
		$this->form_validation->set_rules('username','Username','trim|required|is_unique[login.username]',
			array(
				'required'   => '* Kolom Username Harus Diisi!',
				'is_unique'  => '* Usename Sudah Ada',
			));
		$this->form_validation->set_rules('full_name','Fullname','trim|required|is_unique[login.full_name]',
			array(
				'required'   => '* Kolom Username Harus Diisi!',
				'is_unique'  => '* Fullname Sudah Ada',
			));
		$this->form_validation->set_rules('email','Email',
			'trim|required|valid_email|max_length[50]|is_unique[login.email]',
			array(
				'valid_email' => '* Format Email Tidak Sesuai !',
				'required'    => '* Kolom Email Harus Diisi!',
				'is_unique'   => '* Email Sudah Ada',
				'max_length'  => '* Jumlah Karakter Maksimal 50!'
			));
		$this->form_validation->set_rules('password','Password','trim|required|min_length[8]',
			array(
				'required'   => '* Password Tidak Boleh Kosong!',
				'min_length' => '* Jumlah Karakter Minimal 8'
			));
		$this->form_validation->set_error_delimiters('<small class="error">','</small>');
		if($this->form_validation->run() == FALSE){
			$this->load->view('auth/register');
		}else{
			$level 	   = $this->input->post('level');
			// Tambahkan parameter true untuk mengaktifkan fitur keamanan XSS filtering
			$full_name = htmlspecialchars($this->input->post('full_name'), true); 
			$username  = htmlspecialchars($this->input->post('username'), true);
			$email     = htmlspecialchars($this->input->post('email'), true);
			$password  = sha1($this->config->item('salt').$this->input->post('password'));
			$set       = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code      = substr(str_shuffle($set), 0, 12);

			$staff = array(
				'level'	   => $level,
				'full_name'=> $full_name,
				'username' => $username,
				'email'	   => $email,
				'password' => $password,
				'code'     => $code,
				'status'   => 'nonaktif'
			);

			$id = $this->regist->add($staff);
			$this->message('Success!','Registrasi berhasil diproses','success');
			redirect('auth/login');
		}
	}
}
