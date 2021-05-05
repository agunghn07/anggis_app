<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forget_pass extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('ResetModel','reset',TRUE);
		$this->load->model('MasterModel', 'master', TRUE);
	}

	public function message($title = NULL, $text = NULL, $type = NULL){
		return $this->session->set_flashdata([
			'title'	=> $title,
			'text'	=> $text,
			'type'	=> $type,
		]);
	}

	public function index(){
		$this->load->view('auth/forget_password');
	}

	public function forget_password(){
		if(isset($_POST['nEmpEmailRecover']) && !empty($_POST['nEmpEmailRecover'])){
			$this->form_validation->set_rules('nEmpEmailRecover','Email','trim|required|valid_email',
				array(
					'required' 		=> '* Email tidak boleh kosong!',
					'valid_email'	=> '* Email tidak valid!'
				));
			$this->form_validation->set_error_delimiters('<small class="error">','</small>');

			if($this->form_validation->run() == FALSE){
				$this->index();
			}else{
				$email  = trim($this->input->post('nEmpEmailRecover'));
				$username = $this->reset->email_exists($email);
				$userInfo = $this->master->getUserDetail($username->row()->noreg);

				if($username->num_rows() == 1){
					$emailPenerima = $email;
					$subjek = "Password Recovery : ".$userInfo->noreg;
					$token  = base64_encode(random_bytes(32));
					$hash   = password_hash($userInfo->username, PASSWORD_BCRYPT);

					$content = $this->load->view('emailTemplate/passRecovery', 
						array(
							'param'   => $hash,
							'token'   => $token,
							'noreg'   => $userInfo->noreg,
							'empName' => $userInfo->name,
						), true
					);

					$resultSendMail = $this->master->sendEmail($emailPenerima, $subjek, $content);
					if($resultSendMail['status']){

						$user_token = [
							'param' => $hash,
							'token'	=> $token
						];
						$this->db->insert('tb_r_reset_token', $user_token);
						$this->message('Great!','Form reset password telah dikirim ke email anda','success');
						redirect('auth/Login');
					}else{
						$this->message('Ooppsss!','Error while sending email','error');
						redirect('auth/Forget_pass');
					}
				}else{
					$this->message('Ooppsss!','Email tidak terdaftar atau belum aktif','error');
					redirect('auth/Forget_pass');
				}
			}
		}else{
			$this->index();
		}
	}

	public function reset_password_form(){
		$param = $this->input->get('param');
		$token = $this->input->get('token');
		$noreg = $this->input->get('noreg');

		$user_token = $this->reset->getToken($param, $token);
		if($user_token){
			$this->session->set_userdata(array('noreg' => $noreg, 'param' => $param));
			$this->changePassword();
		}else{
			$this->message('Ooppsss!','The url link has expired','error');
			redirect('auth/login');
		}
	}

	public function changePassword(){
		$validate = array('success'=> false, 'messages' => array());

		if(!$this->session->userdata('param')){
			$this->message('Ooppsss!','There is a problem with the link','error');
			redirect('auth/login');
		}

		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirm', 'Confirm', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<small style="color: red">* ','</small>');

		if($this->form_validation->run() === true){
			$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
			$noreg = $this->session->userdata('noreg');

			$update = $this->reset->changePassword($password, $noreg);
			if($update == 1){
				$this->db->delete('tb_r_reset_token', ['param' => $this->session->userdata('param')]);
				$this->session->unset_userdata(array('noreg' => '', 'param' => ''));
				$validate['success'] = true;
				echo json_encode($validate);
			}
            
		}else{
			$isSubmit = $this->input->post('isSubmit');
			if($isSubmit != 1){
				$this->load->view('auth/reset_password');
			}else{
				foreach($_POST as $key=>$value){
					$validate['messages'][$key] = form_error($key);
				}
				echo json_encode($validate);
			}
		}
	}


	// public function changePassword(){
	// 	if(!$this->session->userdata('param')){
	// 		$this->message('Ooppsss!','There is a problem with the link','error');
	// 		redirect('auth/login');
	// 	}
	// 	$this->form_validation->set_rules('password', 'Password', 'trim|required');
	// 	$this->form_validation->set_rules('confirm', 'Confirm', 'trim|required|matches[password]');
	// 	$this->form_validation->set_error_delimiters('<small class="error">* ','</small>');

	// 	if($this->form_validation->run() == false){
	// 		$this->load->view('auth/reset_password');	
	// 	}else{
	// 		$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
	// 		$noreg = $this->session->userdata('noreg');

	// 		$update = $this->reset->changePassword($password, $noreg);

	// 		$this->db->delete('tb_r_reset_token', ['param' => $this->session->userdata('param')]);
	// 		$this->message('Great!','Password has been changed, please login','success');
	// 		$this->session->unset_userdata(array('noreg' => '', 'param' => ''));
	// 		redirect('auth/login');
	// 	}
	// }

}