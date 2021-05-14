<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainMenu extends MY_Controller {
    public function __construct(){
		parent::__construct();
	}

    public function message($title = NULL, $text = NULL, $type = NULL){
		return $this->session->set_flashdata([
			'title'	=> $title,
			'text'	=> $text,
			'type'	=> $type
		]);
	}

    public function index()
	{
		$this->parseData["dataChecklist"] = $this->MModel->getDataChecklist();
        $this->parseData['title']   = 'Main Menu';
        $this->parseData['menu']    = 'Checklist Dokumen';
        $this->parseData['submenu'] = 'Main Menu';
		$this->parseData['content'] = 'content/mainMenu/main_menu';
		$this->load->view('MainView/backendView', $this->parseData);
    }

	public function getDataList(){
		$list = $this->MModel->get_datatables();
		$data = array();
		foreach ($list as $i) {
            $row = array();
            $row[] = '<center>' . $i->NO_BABP . '</center>' ;
            $row[] = '
				<div class="progress" style="margin-bottom: 0px !important; display: flex; background-color: #778295; font-weight: bolder; border-radius: 5px;">
					<div class="progress-bar" role="progressbar" aria-valuenow="60"
					aria-valuemin="0" aria-valuemax="100" style="width:60%; background-color: #f3d14b !important; color: #4c4f34 !important;">
					60%
					</div>
				</div>
			';
			$row[] = '<center><span class="label" style="background-color: #ff9fa2; font-weight: bold;" border-radius: 5px;>2</span></center>';
            $row[] = '<center>' . $i->TANGGAL_BABP . '</center>';
			$row[] = '<center><span class="label" style="background-color: #778295; color: #fff; border-radius: 5px;">On Progress</span></center>';
            $row[] = '
				<center>
					<a class="btn btn-sm btn-outline" style="border-radius: 20px; padding: 0px 5px; margin: 0px; background-color: #edc839; border-style: none; color: #778295 !important;" 
						id="btnCeklist" title="Isi Ceklist" data-id="'.$i->NO_BABP.'">
						<small>
							<i class="fa fa-binoculars"></i>
						</small>
					</a>
					<a class="btn btn-sm btn-outline btn-danger" style="border-radius: 20px; padding: 0px 5px; margin: 0px; background-color: #d34448; border-style: none; color: #fff !important;" 
						id="btnDelete" title="Hapus" data-id="'.$i->NO_BABP.'">
						<small>
							<i class="glyphicon glyphicon-trash"></i>
							</small>
					</a>
				</center>
			';
 
            $data[] = $row;
        }

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->MModel->count_all(),
			"recordsFiltered" => $this->MModel->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function saveCheklist(){
		$parse  = array('status' => false, 'message' => null);
		$result = $this->MModel->saveChecklistData($this->input->post('data'));
		if($result == false){
			$parse["message"] = "Looks like there's an error, please contact your administrator.";
		}
		$parse["status"] = $result;
		echo json_encode($parse);
	}

	public function getChecklistDataById(){
		$data = $this->MModel->getCheckById($this->input->post("ID")); 
		echo json_encode($data);
	}
}