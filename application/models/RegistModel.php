<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RegistModel extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function add($staff){
		$this->db->insert('login', $staff);
		return $this->db->insert_id();
	}
}