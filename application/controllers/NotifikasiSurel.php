<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotifikasiSurel extends MY_Controller {
    public function __construct(){
		parent::__construct();
    }
    
    public function index($id_email = null)
	{
        $readStatus = null;
        $data = []; $noregForGetMail = null;
        $userInfo = $this->master->getUserDetail($this->session->userdata('Noreg'));
        if($id_email != null){
            $cutiInfo = $this->notif->getCutiInfo($id_email);
            // if($userInfo->id_position != 4){
            //     $noregForGetMail = $cutiInfo->pic;
            // }else{
            //     $noregForGetMail = $userInfo->noreg;
            // }
            $message = $this->notif->getListMessage($userInfo, $id_email, $cutiInfo->nomor_cuti);
            if($message == null){
                $readStatus = 1;
            }else{
                $data = $this->getDataMessage($message, $userInfo);
                $readStatus = $message[0]->read_status;
            }

        }
        $listMessages = $this->notif->getListMessage($userInfo);
        if($userInfo->id_position == 4 || $userInfo->id_position == 3){
            foreach($listMessages as $list){
                if($list->is_approve == 1 || $list->is_approve == 3){
                    $list->name = $this->master->getById('tb_r_employee', 'name', 'noreg', $list->sender)->name;
                }
            }
        }
        
        if($readStatus == 1){
            $this->notfound();
        }else{
            $this->parseData['emailMessage'] = (count($data) == 0 ? null : $data);
            $this->parseData['listMessages'] = $listMessages;
            $this->parseData['userDetail'] = $userInfo;
            $this->parseData['title']   = 'Halaman Pesan Surel';
            $this->parseData['menu']   = 'Notifikasi Surel';
            $this->parseData['submenu']   = 'Surel';
            $this->parseData['content'] = 'content/notifikasi_surel/screenSurel';
            $this->load->view('MainView/backendView', $this->parseData);
        }
    }

    public function getMessage(){
        $nomorCuti = $_POST['nomorCuti'];
        // $picNoreg = $_POST['picNoreg'];
        // $division = $_POST['division'];
        $idEmail = $_POST['idEmail'];
        // $noregParam = null;

        $userInfo = $this->master->getUserDetail($this->session->userdata('Noreg'));
        // if($userInfo->id_position == 4){
        //     $noregParam = $userInfo->noreg; 
        // }else if($userInfo->id_position == 3){
        //     $noregParam = $picNoreg; 
        // }else{
        //     $noregParam = $this->master->getById('tb_r_employee', 'pic', 'noreg', $picNoreg)->pic;
        // }

        $message = $this->notif->getListMessage($userInfo, $idEmail, $nomorCuti);
        $data = $this->getDataMessage($message, $userInfo);
        echo json_encode($data);
    }

    public function getDataMessage($message, $userInfo){
        $isProcessed = null; $getApprovalDesc = null;
        if($userInfo->id_position == 4 || ($userInfo->id_position == 3 && $this->like_match('Surat penerimaan%', $message[0]->subject))){
            $message[0]->photo = $this->master->getById('tb_r_employee', 'photo', 'noreg', $message[0]->sender)->photo;
            $id_position = $this->master->getById('tb_r_employee', 'position', 'noreg', $message[0]->sender)->position;
            $id_division = $this->master->getById('tb_r_employee', 'division', 'noreg', $message[0]->sender)->division;
            if($id_division == 'DK'){
                $message[0]->division = $id_division;
            }
            $message[0]->position = $this->master->getById('tb_m_occupation', 'position', 'id', $id_position)->position;
        }
        $data = array(
            'message' => $message[0]->message,
            'receive_date' => date('d M Y (H:i:s)', strtotime($message[0]->receive_dt)),
            'photo' => $message[0]->photo,
            'subject' => $message[0]->subject,
            'position' => $message[0]->position.' '.$message[0]->division,
            'id_position' => $userInfo->id_position
        );

        if($userInfo->id_position != 4){
            if($userInfo->id_position == 3){
                if($this->like_match('Surat pengajuan%', $message[0]->subject)){
                    $isProcessed = $message[0]->approval_1;
                    $getApprovalDesc = $this->notif->getApprovalDesc($message[0]->approval_1)->description;
                }
            }else if($userInfo->id_position == 2){
                $isProcessed = ($userInfo->id_division != 'DK' ? $message[0]->approval_2 : $message[0]->approval_3);
                $getApprovalDesc = $this->notif->getApprovalDesc(($userInfo->id_division != 'DK' ? $message[0]->approval_2 : $message[0]->approval_3))->description;
            }
        }
        
        $data = array_merge($data, array('isProcessed' => $isProcessed, 'statusApproval' => $getApprovalDesc));
        $this->notif->updateReadStatus($message);

        return $data;
    }

    public function updateApproval(){
        $parse = array('status' => false);
        $pic = new stdClass(); $message = null;
        // $posisiPic = $this->input->post('picPosition');
        $nomorCuti = $this->input->post('nomorCuti');
        $approvalId = ($_POST['alasanTolak'] == null ? 3 : 1);
        $userInfo = $this->master->getUserDetail($this->session->userdata('Noreg'));
        $getFirstSender = $this->master->getById('tb_t_pengajuan_cuti', ' DISTINCT noreg', 'nomor_cuti', $nomorCuti)->noreg;
        $getReceiver = $this->notif->getReceiverInfo($nomorCuti, $getFirstSender);

        if($userInfo->id_division != 'DK'){
            if($userInfo->id_position == 3){
                $approvalUpdate = array('approval_1' => $approvalId, 'approval_2' => ($_POST['alasanTolak'] == null ? 2 : null));
                $pic = $this->notif->getPicEmail($getReceiver->pic_noreg);
            }else if($userInfo->id_position == 2){
                $approvalUpdate = array('approval_2' => $approvalId, 'approval_3' => ($_POST['alasanTolak'] == null ? 2 : null));
                $pic->noreg = 'Emp/DK/1';
                $pic->email = $this->master->getById('tb_r_employee', 'email', 'noreg', $pic->noreg)->email;
            }
            $approvalUpdate = array_merge($approvalUpdate, array('is_approve' => ($_POST['alasanTolak'] == null ? 2 : $approvalId)));
        }else{
            $approvalUpdate = array('approval_3' => $approvalId, 'is_approve' => $approvalId);
            $pic->email = $getReceiver->email;
        }

        // if($posisiPic == 3){
        //     $approvalUpdate = array('approval_1' => $approvalId, 'approval_2' => ($_POST['alasanTolak'] == null ? 2 : null));
        //     $pic = $this->notif->getPicEmail($getReceiver->pic_noreg);
        // }else if($posisiPic == 2){
        //     $approvalUpdate = array('approval_2' => $approvalId, 'approval_3' => ($_POST['alasanTolak'] == null ? 2 : null));
        // }

        // $resultUpdate = $this->notif->updateStatusApprove($approvalUpdate, $nomorCuti);
        $resultUpdate = $this->master->updateDatabaseTable('tb_t_pengajuan_cuti', $approvalUpdate, ['nomor_cuti' => $nomorCuti, 'is_approve' => 2]);
        if($resultUpdate != 0){
            if($_POST['alasanTolak'] != null){
                $bool = $this->sendEmailMessage($getReceiver, $userInfo, $this->input->post('nomorCuti'), $_POST['alasanTolak']);
                $parse['status'] = $bool;
            }else{
                if($userInfo->id_division == 'DK'){
                    $subjek = "Surat penerimaan cuti nomor : ".$nomorCuti;
                    $message = $this->getEmailTemplate('emailTemplate/approve', $getReceiver, $userInfo, $nomorCuti);
                    $this->master->updateDatabaseTable('tb_t_cuti', array('sisa_cuti' => $this->master->getById('tb_t_cuti', 'sisa_cuti', 'emp_noreg', $getFirstSender)->sisa_cuti - 1), ['emp_noreg' => $getFirstSender]);
                }else{
                    $subjek = $getReceiver->subject;
                    $getReceiver->noreg = $pic->noreg;
                    if($userInfo->id_position == 2){
                        $message = str_replace(['<span>Supervisor</span>', "<span>".$userInfo->division."</span>"], ['<span>Manager</span>', '<span>Divisi Kepegawaian</span>'], $getReceiver->message);
                    }else{
                        $message = str_replace('Supervisor', 'Manager', $getReceiver->message);
                    }
                }
                if($pic->email != null){
                    $bool = $this->master->sendEmail($pic->email, $subjek, $message);
                    if($bool['status']){
                        $parse['status'] = $bool['status'];
                    }
                }
                $isTrue = $this->saveEmailMessage($getReceiver, $userInfo, $subjek, $message);
                $parse['status'] = $isTrue;
                
            }
        }

        echo json_encode($parse);
    }

    function sendEmailMessage($getReceiver, $userInfo, $nomorCuti, $message){
        $return = false;
        $emailPenerima = $getReceiver->email;
        $subjek = "Surat penolakan cuti nomor : ".$nomorCuti;
        $alasaTolak = $message;

        $content = $this->getEmailTemplate('emailTemplate/reject', $getReceiver, $userInfo, $nomorCuti, $alasaTolak);

        $sendmail = array(
            'email_penerima'=> $emailPenerima,
            'subjek' => $subjek,
            'content' => $content
        );
        
        if($emailPenerima != null){
            $send = $this->mailer->send($sendmail);
            // if($send['status'] == "Sukses"){ }
        }
        $return = $this->saveEmailMessage($getReceiver, $userInfo, $subjek, $content);
        return $return;
    }

    public function saveEmailMessage($getReceiver, $sender, $subjek, $content){
        $return = false;
        $saveEmail = array(
            'sender' => $sender->noreg,
            'receiver' => $getReceiver->noreg,
            'id_cuti' => $getReceiver->id_cuti,
            'subject' => $subjek,
            'message' => $content,
            'read_status' => 0,
            'created_by' => $sender->name
        );
        $resultSaveEmail = $this->master->insertIntoDatabase('tb_r_email', $saveEmail);
        if($resultSaveEmail == 1){
            $return = true;
        }
        return $return;
    }

    public function getEmailTemplate($path, $getReceiver, $userInfo, $nomorCuti, $alasaTolak = null){
        $data = array(
            'kepada' =>  $getReceiver->name,
            'nomorCuti' => $nomorCuti,
            'start_dt' => $getReceiver->start_dt,
            'until_dt' => $getReceiver->until_dt,
            'receive_dt' => $getReceiver->created_dt, 
            'divisi' => $getReceiver->division_name,
            'picName' => $userInfo->name,
            'pic_position' => $userInfo->position
        );
        
        if($alasaTolak != null){
            $data = array_merge($data, array('alasanTolak' => $alasaTolak, 'alasaCuti' => $getReceiver->alasan));
        }
        $content = $this->load->view($path, $data, true);
        if($userInfo->id_division == 'DK'){
            $content = str_replace('<span>'.$getReceiver->division_name.'</span>', '<span>'.$userInfo->division.'</span>', $content);
        }
        return $content;
    }

}
?>