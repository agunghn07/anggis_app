<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersetujuanCuti extends MY_Controller {
    public function __construct(){
		parent::__construct();
    }

    public function index()
	{
        $userInfo = $this->master->getUserDetail($this->session->userdata('Noreg'));

        switch($userInfo->id_position){
            case 1:
                $this->notfound();
            break;
            case 2:
                $this->notfound();
            break;
            default:
                if($userInfo->until_dt != null && ((date('Y-m-d') <= $userInfo->until_dt && $userInfo->is_approve == 3) || $userInfo->is_approve == 2)) {
                    $idCuti = $this->persetujuan->getNomorCuti($userInfo->noreg);
                    $approvalList = $this->persetujuan->getListApproval($idCuti->id);

                    $listTrackingApproval = $this->getListTrackingApproval($approvalList, $userInfo, $idCuti);
        
                    $this->parseData['userDetail'] = $userInfo;
                    $this->parseData['approvalTracking'] = $listTrackingApproval;
                    $this->parseData['title'] = 'Approval Status';
                    $this->parseData['menu'] = 'Status Persetujuan';
                    $this->parseData['submenu'] = 'Status';
                    $this->parseData['content'] = 'content/persetujuan_cuti/screenPersetujuan';
                    $this->load->view('MainView/backendView', $this->parseData);
                }else{
                    $this->notfound();
                }
            break;
        }
    }

    public function getListTrackingApproval($approvalList, $userInfo, $idCuti){
        $listTrackingApproval = [];
        for($i = 0; $i < count($approvalList); $i++){
            $key = array_keys($approvalList);
            if($userInfo->id_position == 3){
                if($key[$i] == 'approval_1'){
                    continue;
                }
            }
            if($userInfo->id_division == 'DK'){
                if($key[$i] == 'approval_1' || $key[$i] == 'approval_2'){
                    continue;
                }
            }
            $approvalDesc = $this->checkApproval($approvalList[$key[$i]], $key[$i], $userInfo, $idCuti);
            array_push($listTrackingApproval, $approvalDesc);
        }
        return $listTrackingApproval;
    }

    public function checkApproval($approval, $key, $userInfo, $idCuti){
        $pic = $userInfo->pic; $statusApproval = null;
        if($approval != null){
            $statusApproval = $this->master->getById('tb_m_approval', 'description', 'id', $approval)->description;
        }
        
        $returnStatusApproval = array('status' => $statusApproval);
        if($key == 'approval_2'){
            if($userInfo->id_position == 4){
                $pic = $this->master->getUserDetail($userInfo->pic)->pic;
            }
        }else if($key == 'approval_3'){
            $pic = 'Emp/DK/1';
        }
        $approverDetail = $this->master->getUserDetail($pic);
        $arrayApprovalDetail = array(
            'nama'   => $approverDetail->name, 
            'posisi' => $approverDetail->position,
            'id_division' => $approverDetail->id_division,
            'divisi' => $approverDetail->division,
            'nomor_cuti' => $idCuti->nomor_cuti,
            'signature' => $approverDetail->signature,
            'read_dt'=> ($approval != null ? $this->persetujuan->getReadDt($idCuti->id, $pic)->updated_dt : null) 
        );
        $returnStatusApproval = array_merge($returnStatusApproval, $arrayApprovalDetail);
        return $returnStatusApproval;
    }

    public function printSuratCuti(){
        require_once(APPPATH.'third_party/vendor/autoload.php');
        $userInfo = $this->master->getUserDetail($this->session->userdata('Noreg'));
        $dataCuti = $this->persetujuan->getNomorCuti($userInfo->noreg);

        $idCuti = $this->persetujuan->getNomorCuti($userInfo->noreg);
        $approvalList = $this->persetujuan->getListApproval($idCuti->id);

        $listTrackingApproval = $this->getListTrackingApproval($approvalList, $userInfo, $idCuti);

        $cutiInfo = array(
            'nomor_cuti' => $dataCuti->nomor_cuti,
            'noreg'=> $userInfo->noreg,
            'start_dt' => date("Y-m-d", strtotime(str_replace("/", "-", $dataCuti->start_dt))),
            'until_dt' => date("Y-m-d", strtotime(str_replace("/", "-", $dataCuti->until_dt))),
        );
        $data = array(
            'pesan' => $dataCuti->alasan, 
            'empInfo' => $cutiInfo,
            'empName' => $userInfo->name, 
            'divisi' => $userInfo->division,
            'posisi' => $userInfo->position,
            'id_position' => $userInfo->id_position,
            'id_division' => $userInfo->id_division,
            'picInfo' => $listTrackingApproval
        );
        
        $html = $this->load->view('pdfTemplate/suratCuti', $data, true);
  
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('Surat_Cuti.pdf', 'D');
      }
}
?>