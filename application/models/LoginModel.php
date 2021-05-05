<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends CI_Model {

	public function check(){
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);

		$sql   = "
			SELECT emp.noreg, logon.password, logon.status, emp.username, emp.position 
			FROM tb_r_logon logon 
			JOIN tb_r_employee emp 
			ON emp.NOREG = logon.NOREG 
			WHERE emp.username =  '{$username}' LIMIT 1
		";

		$result= $this->db->query($sql);
		$row   = $result->row();

		if($result->num_rows() === 1){
			if($row->position == 1){
				return $this->verifyPassword($password, $row);
			}else{
				if($row->status == 1){
					return $this->verifyPassword($password, $row);
				}else{
					return 'not_activated';
				}
			}
		}else{
			return 'username_not_found';
		}
	}

	private function verifyPassword($password, $row){
		if(password_verify($password, $row->password)){
			$sess_ = array(
				'Noreg'		=> $row->noreg,
				'Username'  => $row->username,
				'backToken' => crypt($row->name,'')
			);
			$this->set_session($sess_);
			return 'employee';
		}else{
			return 'incorrect_password';
		}
	}

	private function set_session($sess_){
		$sess_data = array(
			'Noreg'		=> $sess_['Noreg'],
			'Username'	=> $sess_['Username'],
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
		// $query = "INSERT INTO login_details (user_id) VALUES ('".$this->session->userdata('id_')."')";
		// $this->db->query($query);
		$this->db->insert('tb_r_token', $data);
		return $this->db->insert_id();
	}
	
}