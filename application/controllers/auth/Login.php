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
				redirect('MainPage');
			}else{
				$this->session->unset_userdata('backToken');
				redirect('MainPage/logout');
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
				case 'employee':
					$this->registToken();
				break;

				case 'incorrect_password':
					$this->message('Oooppss!','Password tidak sesuai','error');
					redirect('auth/login');
				break;

				case 'not_activated':
					$this->message('Sorry!','Akun belum diaktivasi, silahkan hubungi admin','warning');
					redirect('auth/login');
				break;

				case 'username_not_found':
					$this->message('Oooppss!','Username tidak terdaftar, silahkan coba lagi','error');
					redirect('auth/login');
				break;	
			}
		}
	}

	public function registToken(){
		$data = ['user_noreg' => $this->session->userdata('Noreg'), 'access_token' => $this->session->userdata('backToken')];
		$logId = $this->login->registToken($data);
		$this->message('Halo '.$this->session->userdata("Username"). '!','Semoga hari anda menyenangkan :)','success');
		redirect('MainPage');
	}

	public function exam(){
		//$this->checkTokenExam();
		//$this->load->view('auth/login_exam');
		if ($this->input->post()) {
			$data = $this->input->post();
			$student = $this->login->getStudentByNis($data['student_nis']);
			if ($student) {
				if ($student->student_password == sha1($this->config->item('salt').$data['student_password'])) {
					$sess_ = [
						'globalStudent' => $student,
						'examToken' => crypt($student->student_password,'')
					];
					$this->session->set_userdata($sess_);
					$this->message('Wohoooo!!','Login berhasil di verifikasi, selamat datang '.$student->student_name,'success');
					redirect('frontend/exam/list');	
				} else {
					$this->message('Oooppss!','Password tidak sesuai','error');
					redirect('Auth/login/exam');	
				}
			} else {
				$this->message('Oooppss','NIS tidak terdaftar, silahkan coba lagi','error');
				redirect('Auth/login/exam');
			}
		} else {
			if ($this->session->userdata('examToken') AND $this->session->userdata('globalStudent')) {
				$this->session->unset_userdata('globalStudent');
				$this->session->unset_userdata('examToken');
				redirect('frontend/exam/logout');
			}
			$this->load->view('auth/login_exam');
		}
	}

	/*
	public function checkTokenExam(){
		if($this->session->userdata('examToken')){
			if($this->login->checkToken($this->session->userdata('examToken'))){
				$this->session->unset_userdata('examToken');
				redirect('student/exam/logout');
			}else{
				$this->session->unset_userdata('examToken');
				redirect('student/exam/logout');
			}
		}
	}


	public function examLogin(){
		$this->form_validation->set_rules('nis','NIS','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_error_delimiters('<small class="error">','</small>');
		if($this->form_validation->run() == FALSE){
			$this->exam();
		}else{
			$result = $this->login->checkExam();
			switch ($result) {
				case 'student':
					$this->message('Welcome '.$this->session->userdata("globalStudent")->student_name.'!','Selamat mengerjakan ujian :)'
						,'success');
					redirect('student/exam');
				break;

				case 'incorrect_password':
					$this->message('Oooppss!','Password tidak sesuai','error');
					redirect('auth/login/exam');
				break;

				case 'nis_not_found':
					$this->message('Sorry!','NIS tidak terdaftar, coba yang lain','error');
					redirect('auth/login/exam');
				break;
			}
		}
	}
*/

	public function not_found(){
		echo "Page not Found";
	}

/*
	public function register(){
		$validate = array('success' => false, 'messages' => form_array());
		$this->form_validation->set_rules('username','Username','trim|required|is_unique[login.username]|xss_clean',
			array(
				'required' => '* Kolom Username Harus Diisi!',
				'is_unique' => '* Usename Sudah Ada',
			));
		$this->form_validation->set_rules('full_name','Fullname','trim|required|is_unique[login.full_name]|xss_clean',
			array(
				'required' => '* Kolom Email Harus Diisi!',
				'is_unique' => '* Fullname Sudah Ada',
			));
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]',
			array(
				'required' => '* Password Tidak Boleh Kosong!',
				'min_length' => '* Jumlah Karakter Minimal 6 Karakter'
			));
		$this->form_validation->set_error_delimiters('<small class="text-danger">','</small>');

		if($this->form_validation->run() == TRUE){
			$username
		}
	}

	public function exam(){
		if($this->input->post()){
			$data 	 = $this->input->post();
			$student = $this->login->getStudentByNis($data['student_nis']);
			if($student){
				if(password_verify($data['student_password'], $student->student_password)){
					$sess_ = [
						'globalStudent'	=> $student,
						'examToken'		=> crypt($studen->student_password,'')
					];
					$this->session->set_userdata($sess_);
					$this->message('Wohoooo!!','Login berhasil diverifikasi, selamat datang '.$student->student_name, 'success');
					redirect('exam/list');
				}else{
					$this->message('Ooppsss','NIS dan password tidak sesuai, silahkan coba lagi', 'danger');
					redirect('auth/exam');
				}
			}else{
				$this->message('Ooppsss','NIS tidak terdaftar, silahkan coba lagi','danger');
				redirect('auth/exam');
			}
		}else{
			if($this->session->userdata('examToken') AND $this->session->userdata('globalStudent')){
				redirect('exam');
			}
			$this->load->view('auth/loginExam');
		}
	}
*/
}