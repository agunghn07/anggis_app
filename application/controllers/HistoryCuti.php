<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryCuti extends MY_Controller {
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
            $this->parseData['userDetail'] = $sessionData;
            $this->parseData['title']   = 'Halaman History Cuti';
            $this->parseData['menu']   = 'History Cuti';
            $this->parseData['submenu']   = 'History';
            $this->parseData['content'] = 'content/history_cuti/screenHistoryCuti';
            $this->load->view('MainView/backendView', $this->parseData);
          break;
        }
    }

    public function listHistoryCuti(){
        $listData = $this->history->get_datatables(false);
        $data = array();
        $no   = $_POST['start'];
        foreach($listData as $list){
            $no++;
            $row = array();
            $row[] = '<center>'.$no.'</center>';
            $row[] = '<center>'.$list->nomor_cuti.'</center>';
            $row[] = '<center>'.date_format(date_create($list->start_dt), "d M Y").'</center>';
            $row[] = '<center>'.date_format(date_create($list->until_dt), "d M Y").'</center>';
            $row[] = $list->alasan;
            $row[] = "<div class='label ".($list->is_approve == 1 ? 'label-danger' : 'label-primary')."'>".$list->description."</div>";
            $row[] = '<center>'.date_format(date_create($list->updated_dt), "d M Y").'</center>';
            $row[] = '
            <center>
            	<div class="btn-group-horizontal">
                  <button type="button" class="btn btn-sm btn-primary btn-outline" title="Lihat Detail" id="btnEmailDetail" data-idemail='.$list->id_email.' data-nomorcuti='.$list->nomor_cuti.'>
                    <i class="fa fa-envelope-open-o "></i>
                  </button>
                </div>
            </center>
            ';
 
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->history->count_all(),
            "recordsFiltered" => $this->history->count_filtered(false),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function printHistory(){
      require_once(APPPATH.'third_party/vendor/autoload.php');
      $userInfo = $this->master->getUserDetail($this->session->userdata('Noreg'));
      $data = array(
        'empName' => $userInfo->name,
        'empPosition' => $userInfo->position,
        'empDivision' => $userInfo->division,
        'empSignature' => $userInfo->signature,
        'listData' => $this->history->get_datatables(true)
      );
      
      $html = $this->load->view('pdfTemplate/historyPdf', $data, true);

      $mpdf = new \Mpdf\Mpdf();
      $mpdf->WriteHTML($html);
      $mpdf->Output('Laporan_Cuti_Tahunan.pdf', 'D');
    }
}
?>