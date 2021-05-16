<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends CI_Model {

	public function check(){
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);

		$result = $this->db->select('ID, USERNAME, PASSWORD, ROLE')->where("USERNAME", $username)->get("tb_m_user");
		$row = $result->row();

		if($result->num_rows() === 1){
			return $this->verifyPassword($password, $row);
		}else{
			return 'username_not_found';
		}
	}

	private function verifyPassword($password, $row){
		if($password == $row->PASSWORD){
			$sess_ = array(
				'Id'		=> $row->ID,
				'Username'  => $row->USERNAME,
				'Role'      => $row->ROLE,
				'backToken' => crypt($row->USERNAME,'')
			);
			$this->set_session($sess_);
			
			return 'verified';
		}else{
			return 'incorrect_password';
		}
	}

	private function set_session($sess_){
		$sess_data = array(
			'Id'		=> $sess_['Id'],
			'Username'	=> $sess_['Username'],
			'Role'	=> $sess_['Role'],
			'backToken'	=> $sess_['backToken']
		);
		$this->session->set_userdata($sess_data);
	}

	public function checkToken($access_token){
		$this->db->where('access_token', $access_token);
		return $this->db->get('tb_r_token')->row_object();
	}

	public function deleteToken($access_token){
		$this->db->where('access_token', $access_token);
		return $this->db->delete('tb_r_token');
	}

	public function registToken($data){
		$this->db->insert('tb_r_token', $data);
		return $this->db->insert_id();
	}
	
}