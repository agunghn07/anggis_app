<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('string');
	}

	public function index(){
		$list = $this->notif->userList();

		$userList = [];
		foreach($list as $data){
			$userList[] = array(
				'id' => $this->notif->Encryptor('encrypt', $data['id_admin']),
				'fullname' => $data['full_name'],
				'avatar' => $data['avatar']
			);
		}

		$this->parseData['userList'] = $userList;
		$this->parseData['strTitle'] = 'All Connected Users';
		$this->parseData['strsubTitle'] = 'Users';
		$this->parseData['chatTitle'] = 'Select user with chat';
		$this->parseData['content'] = 'content/backend/chatting/chat';
		$this->load->view('MainView/backendView', $this->parseData);
	}

	public function getChatHistory(){
		$receiver_id = $this->notif->Encryptor('decrypt', $this->input->get('receiver_id'));
		$logSenderId = $this->session->userdata('id_');
		$history = $this->notif->getRecieverChatHistory($receiver_id); 

		foreach($history as $chat):
			$message_id = $this->notif->Encryptor('encrypt', $chat['id']);
			$sender_id = $chat['sender_id'];
			$userName = $this->notif->getName($chat['sender_id']);
			$userPic = $this->notif->getPictureById($chat['sender_id']);

			$message = $chat['message'];
			$messageDateTime = date('d F Y H:i:s', strtotime($chat['message_date_time']));
		?>
			<?php
			$messageBody='';
            	if($message=='NULL'){ //fetach media objects like images,pdf,documents etc
					$classBtn = 'right';
					if($logSenderId==$sender_id){
						$classBtn = 'left';
					}
					
					$attachment_name = $chat['attachment_name'];
					$file_ext = $chat['file_ext'];
					$mime_type = explode('/',$chat['mime_type']);
					
					$document_url = base_url('assets/chat/uploads/attachment/'.$attachment_name);
					
				  if($mime_type[0]=='image'){
 					$messageBody.='<img src="'.$document_url.'" onClick="ViewAttachmentImage('."'".$document_url."'".','."'".$attachment_name."'".');" class="img-responsive">';	
				  }else{
						$messageBody='';
						$messageBody.='<div class="panel panel-default">';
							$messageBody.='<div class="panel-heading">';
								$messageBody.='<h3 class="panel-title">Attachment File</h3>';
							$messageBody.='</div>';
                          	$messageBody.='<div class="panel-body filename">';
                            	$messageBody.= $attachment_name;
	                        	$messageBody.='<div style="margin-top: 10px;">';
	                            	$messageBody.='<a download href="'.$document_url.'"><button type="button" id="'.$message_id.'" class="btn btn-primary btn-sm btn-flat btnFileOpen">Open Attachment File</button></a>';
	                        	$messageBody.='</div>';
                         	$messageBody.='</div>';
                    	$messageBody.='</div>';
					}						
				}else{
					$messageBody = $message;
				}
			?>
            
            <?php if($logSenderId!=$sender_id){?>     
                  <!-- Message. Default to the left -->
                  <div class="chat-message left">
                      <img class="message-avatar" src="<?= base_url('assets/img/foto_admin/'). $userPic;?>" alt="<?=$userName;?>">
                      <div class="message" style="box-shadow: 1px 1px 1px rgba(0,0,0,0.2);">
                          <strong class="message-author" href="#"><?=$userName;?></strong>
                          <span class="message-date"> <?=$messageDateTime;?></span>
                          <span class="message-content" style="margin-top: 3px;">
                          <?=$messageBody;?>
                          </span>
                      </div>
                  </div>
			<?php }else{?>
                    <!-- Message to the right -->
                    <div class="chat-message right">
                        <img class="message-avatar" src="<?= base_url('assets/img/foto_admin/').$userPic;?>" alt="<?=$userName;?>">
                        <div class="message" style="background-color: #F0FFFF; box-shadow: 1px 1px 1px rgba(0,0,0,0.2);">
                            <strong class="message-author" href="#"><?=$userName;?></strong>
                            <span class="message-date"> <?=$messageDateTime;?></span>
                            <span class="message-content" style="margin-top: 3px;">
                            <?=$messageBody;?>
                            </span>
                        </div>
                    </div>
             <?php }?>
        
        <?php
		endforeach;
	}

	public function sendTextMessage(){
		$post = $this->input->post();
		$messageTxt ='NULL';
		$attachment_name = '';
		$file_ext = '';
		$mime_type = ''; 
		if(isset($post['type']) == 'Attachment'){
			$attachmentData = $this->ChatAttachmentUpload();
			$attachment_name = $attachmentData['file_name'];
			$file_ext = $attachmentData['file_ext'];
			$mime_type = $attachmentData['file_type'];
		}else{
			$messageTxt = reduce_multiples($post['messageTxt'],' ');//tambahkan helper string di constructor untuk menggunakan reduce_multiple
		}
		$data = [
			'sender_id' => $this->session->userdata('id_'),
			'receiver_id' => $this->notif->Encryptor('decrypt', $post['receiver_id']),
			'message' =>   $messageTxt,
			'attachment_name' => $attachment_name,
			'file_ext' => $file_ext,
			'mime_type' => $mime_type,
			'message_date_time' => date('Y-m-d H:i:s'), //23 Jan 2:05 pm
			'ip_address' => $this->input->ip_address(),
		];

		$query = $this->notif->sendTextMessage($this->notif->xss_clean($data));
		$response = '';
		if($query == true){
			$response = ['status' => 1 ,'message' => '' ];
		}else{
			$response = ['status' => 0 ,'message' => 'sorry we re having some technical problems. please try again !'];
		}

		echo json_encode($response);
	}

	public function ChatAttachmentUpload(){
		$file_data = '';
		if(isset($_FILES['attachmentfile']['name']) && !empty($_FILES['attachmentfile']['name'])){
			$config['upload_path'] = 'assets/chat/uploads/attachment';
			$config['allowed_types'] = 'jpeg|jpg|png|txt|pdf|docx|xlsx|pptx|rtf';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('attachmentfile'))
			{
				echo json_encode(['status' => 0,'message' => '<span style="color:#900;">'.$this->upload->display_errors(). '<span>' ]); die;
			}
			else
			{
				$file_data = $this->upload->data();
				//$filePath = $file_data['file_name'];
				return $file_data;
			}
		}
	}

	public function fetch(){
		$list = $this->notif->getLogin();
		$output = '';

		foreach($list as $data){
			$id = $this->notif->Encryptor('encrypt', $data['id_admin']);
			$output .= '
				<div class="chat-user selectVendor" id="'.$id.'" title="Chating with '.$data['full_name'].'">
		 		    <img class="chat-avatar" src="'.base_url('assets/img/foto_admin/').$data['avatar'].'" alt="'.$data['full_name'].'" >
					<div class="chat-user-name">
		 		        <a href="#">'.$data['full_name'].'</a>
		 		    </div>
		 		</div>
			';
		}

		echo $output;

	}

	public function notification(){
		$list = $this->notif->getLogin();
		$output = '';

		foreach($list as $data){
			$status = '';
			$timeStamp = strtotime(date("Y-m-d H:i:s") . '- 5 second');
			$current_timestamp = date('Y-m-d H:i:s', $timeStamp);
			$user_last_activity = $this->notif->fetchUserLastActivity($data['id_admin']);
			$countUnreadMessage = $this->notif->count_unseen_message($data['id_admin'], $this->session->userdata('id_'));
			if($user_last_activity > $current_timestamp)
			{
				$status = '<span class="pull-right label label-primary">Onl</span>';
			}else{
				$status = '<span class="pull-right label label-danger">Off</span>';
			}
			$output .= '
				<div class="chat-user">
		 		    <div>'.$status.'</div>
		 		    <div>'.$countUnreadMessage.'</div>
					<div class="chat-user-name">
		 		        <a href="#">&ensp;</a>
		 		    </div>
		 		</div>
			';
		}

		echo $output;
	}

	public function update_last_activity(){
		$query = "UPDATE ms_token SET last_activity = now() WHERE id_token = '".$this->session->userdata('login_detail')."'";
		$this->db->query($query);
	}

	public function unreadMessage(){
		$receiver_id = $this->session->userdata('id_');
		$sender_id = $this->notif->Encryptor('decrypt',$this->input->post('receiver_id'));
		$query = "UPDATE chat SET chat_status = '1'  WHERE receiver_id = '$receiver_id' AND sender_id = '$sender_id' AND chat_status = '0'";
		$output = $this->db->query($query);

	}

}