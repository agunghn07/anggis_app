<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengajuanCuti extends MY_Controller {

	public function __construct(){
		parent::__construct();
  }

  public function index(){
    $sessionData = $this->master->getUserDetail($this->session->userdata('Noreg'));
    switch($sessionData->id_position){
      case 1:
        $this->notfound();
      break;
      case 2:
        $this->notfound();
      break;
      default:
        if($sessionData->until_dt == null || ((date('Y-m-d') > $sessionData->until_dt && $sessionData->is_approve == 3) || $sessionData->is_approve == 1)){
          $this->parseData['userDetail'] = $sessionData;
          $this->parseData['jatahCuti'] = $this->pengajuan->getFromTable('sisa_cuti', 'tb_t_cuti', 'emp_noreg', $this->session->userdata('Noreg'))->sisa_cuti;
          $this->parseData['title']   = 'Halaman Pengajuan Cuti';
          $this->parseData['menu']   = 'Pengajuan Cuti';
          $this->parseData['submenu']   = 'Cuti';
          $this->parseData['content'] = 'content/pengajuan_cuti/screenPengajuanCuti';
          $this->load->view('MainView/backendView', $this->parseData);
        }else{
          $this->notfound();
        }
      break;
    }
  }

  public function cekValidasiUser(){
    $parse = array("status" => false, "msg" => "", "nomor_pengajuan" => "");
    $noreg = $_POST['noreg'];
    $cekSisaCuti = $this->pengajuan->getFromTable('sisa_cuti', 'tb_t_cuti', 'emp_noreg', $noreg);
    if($cekSisaCuti->sisa_cuti != 0){
      $nomorPengajuan = $this->pengajuan->nomorPengajuan($noreg);
      $isInRejection = $this->pengajuan->checkIsInRejection($nomorPengajuan, date('Y-m-d'));
      if($isInRejection){
        $lastDateRejection = $this->pengajuan->getLastRejectionDate($nomorPengajuan)->row();
        $parse['msg'] = "Anda masih dalam masa penolakan cuti sampai dengan tanggal ". date_format(date_create($lastDateRejection->until_dt), "d M Y");
      }else{
        $parse['status'] = true;
        $parse['msg'] = "Data sudah divalidasi, anda berhak mengajukan cuti";
        $parse['nomor_pengajuan'] = $nomorPengajuan;
      }
    }else{
      $parse['msg'] = "Sisa masa cuti anda periode ini sudah habis";
    }

    echo json_encode($parse);
  }

  public function prosesPengajuanCuti(){
    $this->load->library('mailer');
    $parse = array("status" => false, 'status_email' => "", "msg" => "");
    $data = $_POST['data'];
    $pic = $this->pengajuan->getPic($data['cutiNoreg']);

    if($pic->position == 3){
      $setApprove = array('approval_1' => 2);
      $to = 'Supervisor';
    }else if($pic->position == 2){
      $setApprove = array(($pic->division == 'DK' ? "approval_3" : "approval_2") => 2);
      $to = 'Manager';
    }

    $setApprove = array_merge($setApprove, array("is_approve" => 2));

    // $isCutiPresent = $this->pengajuan->checkIsCutiPresen($data['nomorPengajuan']);
    
    $dataPengajuanCuti = array(
      'nomor_cuti' => $data['nomorPengajuan'],
      'noreg'=> $data['cutiNoreg'],
      'start_dt' => date("Y-m-d", strtotime(str_replace("/", "-", $data['dateStart']))),
      'until_dt' => date("Y-m-d", strtotime(str_replace("/", "-", $data['dateEnd']))),
      'alasan' => $data['alasanCuti'],
      'created_by' => $this->session->userdata('Username')
    );

    $dataPengajuanCuti = array_merge($dataPengajuanCuti, $setApprove);

    // if($isCutiPresent->result != 1){
      $resultInsert = $this->pengajuan->insertIntoDatabase('tb_t_pengajuan_cuti', $dataPengajuanCuti);
    // }else{
    //   $resultInsertOrUpdate = $this->master->updateDatabaseTable('tb_t_pengajuan_cuti', $setApprove, array('nomor_cuti' => $data['nomorPengajuan']));
    // }

    if($resultInsert != null){

      $emailPenerima = $pic->email;
      $subjek = "Surat pengajuan cuti nomor : ".$data['nomorPengajuan'];
      $pesan = $data['alasanCuti'];

      $content = $this->load->view('emailTemplate/template', 
        array(
          'pesan' => $pesan, 
          'empInfo' => $dataPengajuanCuti,
          'kepada' => $to,
          'empName' => $data['cutiName'], 
          'divisi' => $data['cutiDivision'],
          'posisi' => $data['cutiPosition'],
          'picPosition' => $pic->position
        ), true
      );

      if($emailPenerima != null){
        $resultSendMail = $this->master->sendEmail($emailPenerima, $subjek, $content);
        if($resultSendMail['status']){
          $parse['status_email'] = $resultSendMail['status_email'];
          $parse['msg'] = $resultSendMail['msg'];
        }
      }
      // $sendmail = array(
      //   'email_penerima'=> $emailPenerima,
      //   'subjek' => $subjek,
      //   'content' => $content
      // );
  
      // $send = $this->mailer->send($sendmail);
      // if($send['status'] == "Sukses"){
      
        $saveEmail = array(
          'sender' => $dataPengajuanCuti['noreg'],
          'receiver' => $pic->noreg,
          'id_cuti' => $resultInsert,
          'subject' => $subjek,
          'message' => $content,
          'read_status' => 0,
          'created_by' => $data['cutiName']
        );
        $resultSaveEmail = $this->master->insertIntoDatabase('tb_r_email', $saveEmail);
        if($resultSaveEmail == 1){
          $parse['status'] = true;
        }
    }else{
      // $parse['status_email'] = 'Failed to send';
      $parse['msg'] = 'Error while inserting or updating into database';
    }
      echo json_encode($parse);
  }
}
?>