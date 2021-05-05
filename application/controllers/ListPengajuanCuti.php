<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListPengajuanCuti extends MY_Controller {
    public function __construct(){
		parent::__construct();
    }

    public function index($id_email = null)
	{
        $userInfo = $this->master->getUserDetail($this->session->userdata('Noreg'));
        if($userInfo->id_position == 2){
            $this->parseData['userDetail'] = $userInfo;
            $this->parseData['title']   = 'Daftar Pengajuan Cuti';
            $this->parseData['menu']   = 'Pengajuan Cuti';
            $this->parseData['submenu']   = 'Daftar';
            $this->parseData['content'] = 'content/list_pengajuan_cuti/screenListPengajuanCuti';
            $this->load->view('MainView/backendView', $this->parseData);
        }else{
            $this->notfound();
        }
    
    }

    public function listPengajuan(){
        // $userInfo = $this->master->getUserDetail($this->session->userdata('Noreg'));
        $listData = $this->listPengajuan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach($listData as $list){
            // $actionColumn = "No Action";
            // $keterangan = $list->description;
            // switch($list->is_approve){
            //     case 1:
            //         $class = 'label-danger';
            //     break;
            //     case 2:
                    $keterangan = 'Menunggu Diproses';
            //         $class = 'label-warning';
                    $actionColumn = '
                        <center>
                            <div class="btn-group-horizontal">
                            <button type="button" class="btn btn-xs btn-primary btn-outline" title="Lihat Detail" id="btnProsesCuti" data-nomorcuti="'.$list->nomor_cuti.'" data-idemail="'.$list->id_email.'">
                                Proses Cuti
                            </button>
                            </div>
                        </center>
                    ';
            //         if($userInfo->id_division != 'DK'){
            //             if($list->approval_2 != 2){
            //                 $keterangan = 'Send to Manager DK';
            //                 $class = 'label-default';
            //                 $actionColumn = "No Action";
            //             }
            //         }
            //     break;
            //     case 3:
            //         if((date('Y-m-d') >= $list->start_dt) && (date('Y-m-d') <= $list->until_dt)){
            //             $class = 'label-info';
            //             $keterangan = 'Sedang Cuti';
            //         }else{
                        $class = 'label-primary';
            //         }
            //     break;
            // }

            $no++;
            $row = array();
            $row[] = '<center>'.$no.'</center>';
            $row[] = '<center>'.$list->noreg.'</center>';
            $row[] = $list->name;
            $row[] = '<center>'.date_format(date_create($list->start_dt), "d M Y").'</center>';
            $row[] = '<center>'.date_format(date_create($list->until_dt), "d M Y").'</center>';
            $row[] = $list->alasan;
            $row[] = "<center><div class='label ".$class."'>".$keterangan."</div></center>";
            // $row[] = ''.($list->is_approve == 2 ? "Belum Diproses" : $list->updated_by).'';
            $row[] = $actionColumn;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->listPengajuan->count_all(),
            "recordsFiltered" => $this->listPengajuan->count_filtered(false),
            "data" => $data,
        );
        echo json_encode($output);  
    }
}