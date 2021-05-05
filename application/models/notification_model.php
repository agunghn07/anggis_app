<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model {
	public function insert($data){
		$this->db->insert('comments', $data);
		return $this->db->insert_id();
	}

	// public function update(){
	// 	$this->db->set('comment_status', 1);
	// 	$this->db->where('comment_status', 0);
	// 	return $this->db->update('comments');
	// }

	public function updateReadStatus(){
		$this->db->set('read_status', 1);
		$this->db->where('read_status', 0);
		return $this->db->update('login');
	}

	public function updateChat(){
		$this->db->set('chat_status', 1);
		$this->db->where('chat_status', 0);
		return $this->db->update('chat');
	}

	// public function getAllComments(){
	// 	$this->db->order_by('comment_id', 'DESC');
	// 	$this->db->limit(5);
	// 	return $this->db->get('comments');
	// }

	public function getChatStatus($id_session){
		$this->db->order_by('id', 'DESC');
		$this->db->where(array('receiver_id' => $id_session, 'chat_status' => 0));
		$this->db->join('login','chat.sender_id = login.id_admin','left');
		$this->db->limit(5);
		return $this->db->get('chat');
	}

	public function getLoginNotif(){
		$this->db->order_by('id_admin', 'DESC');
		if($this->session->userdata('level') == 'staff'){
			$this->db->where('status', 'aktif');
		}
		$this->db->limit(5);
		return $this->db->get('login');
	}

	public function getUnseenComments(){
		// $this->db->where('comment_status', 0);
		// return $this->db->get('comments')->result_array();
		$this->db->where('read_status', 0);
		return $this->db->get('login')->result_array();
	}

	public function getUnseenChat(){
		$receiver_id = $this->session->userdata('id_');
		$this->db->where(array('receiver_id' => $receiver_id, 'chat_status' => 0));
		return $this->db->get('chat')->num_rows();
	}

	public function count_unseen_message($sender_id, $receiver_id){
		$query = "SELECT * FROM chat WHERE sender_id = '$sender_id' AND receiver_id = '$receiver_id' AND chat_status = '0'";
		$result = $this->db->query($query);
		$count = $result->num_rows();
		$output = '';
		if($count > 0){
			$output = '<span class="pull-right label label-info countMessage" style="margin-right: 5px;">'.$count.'</span>';
		}
		return $output;
	}

	public function unreadMessage($sender_id, $receiver_id){
		$query = "SELECT * FROM chat WHERE sender_id = '$sender_id' AND receiver_id = '$receiver_id' AND chat_status = '0'";
		$result = $this->db->query($query);
		return $result;
	}

	public function userList(){
		$this->db->select('id_admin, full_name, avatar');
		$this->db->from('login');
		$this->db->where('status', 'aktif');
		return $this->db->get()->result_array();
	}

	public function getLogin(){
		$query = "SELECT * FROM login WHERE status = 'aktif'AND id_admin != '".$this->session->userdata('id_')."'";
		return $this->db->query($query)->result_array();
	}


	public function getUser(){
		$this->db->where('status', 'aktif');
		return $this->db->get('login')->result_array();
	}

	public function profilePicture(){
		$this->db->select('id_admin, avatar');
		$this->db->from('login');
		$this->db->where('id_admin', $this->session->userdata('id_'));
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}

	public function getUserData(){
		$this->db->where('id_admin', $this->session->userdata('id_'));
		$this->db->limit(1);
		return $this->db->get('login')->row_array();
	}

	public function getRecieverChatHistory($receiver_id){
		$sender_id = $this->session->userdata('id_');
		//SELECT * FROM `chat` WHERE `sender_id`= 197 AND `receiver_id` = 184 OR `sender_id`= 184 AND `receiver_id` = 197
		$condition= "`sender_id`= '$sender_id' AND `receiver_id` = '$receiver_id' OR `sender_id`= '$receiver_id' AND `receiver_id` = '$sender_id'";
		$this->db->where($condition);
		return $this->db->get('chat')->result_array();
	}

	// public function updateChatStatus($receiver_id){
	// 	$sender_id = $this->session->userdata('id_');
	// 	$query = "UPDATE chat SET chat_status = '1' WHERE chat_status = '0'";
	// 	return $this->db->query($query);
	// }

	public function getName($id){
		$this->db->select('id_admin, full_name');
		$this->db->where('id_admin', $id);
		$this->db->limit(1);
		$res = $this->db->get('login')->row_array();
		return $res['full_name'];
	}

	public function getPictureById($id){
		$this->db->select('id_admin, avatar');
		$this->db->where('id_admin', $id);
		$this->db->limit(1);
		$res = $this->db->get('login')->row_array();
		return $res['avatar'];
	}

	public function sendTextMessage($data){
		$this->db->insert('chat', $data);
		return $this->db->insert_id();
	}

	public function loginDetail(){
		$query = "UPDATE login_details SET last_activity = now() WHERE login_details_id = '".$this->session->userdata('id_')."'";
		return $this->db->query($query);
	}

	public function fetchUserLastActivity($id){
		$this->db->where('user_id', $id);
		$this->db->order_by('last_activity', 'DESC');
		$this->db->limit(1);
		$result = $this->db->get('ms_token')->result_array();
		foreach($result as $row)
		{
			return $row['last_activity'];
		}	
	}

	public function xss_clean($data){
		return $this->security->xss_clean($data);
	}

	public function Encryptor($action, $string){
		$output = false;

		$encrypt_method = 'AES-256-CBC';
		//pls set your unique hashing key
		$secret_key = 'hitenVkuld%:bTXz,3r>6|FW#!7eSs>vM~n+48~{Mh$#A4p).)#wV3^_y-B.6WCar=b4.';
		$secret_iv = '3w8XD|r@n:nxp|oml]nw$-KEc|rT$H).(~ &`gnV!vD0vs|?r]#Zdr-qRlOV@&#6';

		//hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		//do the encyption given text/string/number
		if( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}
		else if( $action == 'decrypt' ){
			//decrypt the given text/string/number
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
	
		return $output;
	}
}