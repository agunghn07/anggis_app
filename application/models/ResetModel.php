<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ResetModel extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function email_exists($email){
		$sql = "
			SELECT emp.username, emp.noreg
			FROM tb_r_employee emp
			JOIN tb_r_logon logon ON emp.noreg = logon.noreg
			WHERE emp.email = '{$email}' AND logon.status = 1 LIMIT 1
		";
		$result = $this->db->query($sql);
		$row = $result->row();

		// return ($result->num_rows() === 1 && $row->email) ? $row->username : false;
		return $result;
 	}

 	public function getToken($param, $token){
 		$this->db->where(array('param' => $param ,'token' => $token));
 		return $this->db->get('tb_r_reset_token')->row_array();
 	}

 	public function verify_reset_password_code($email, $code){
 		$sql    = "SELECT username, email FROM login WHERE email ='{$email}' LIMIT 1";
 		$result = $this->db->query($sql);
 		$row 	= $result->row();

 		if($result->num_rows() === 1){
 			return($code == sha1($this->config->item('salt'). $row->username)) ? true : false;
 		}else{
 			return false;
 		}
 	}

 	public function reset_password(){
 		$email    = $this->input->post('email');
 		// $password = sha1($this->config->item('salt'). $this->input->post('password'));
 		$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
 		$sql	  = "UPDATE login SET password = '{$password}' WHERE email = '{$email}' LIMIT 1";
 		
 		$this->db->query($sql);
 		 if($this->db->affected_rows() === 1){
 			return true;
 		}else{
 			return false;
 		}
 	}

 	public function changePassword($password, $noreg){
 		$this->db->set('password', $password);
		$this->db->where('noreg', $noreg);
		$this->db->update('tb_r_logon');
 		return $this->db->affected_rows();
 	}
}