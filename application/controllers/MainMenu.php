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
		$countAllSubist = $this->MModel->getcountAllSubist();

		foreach ($list as $i) {
			$countCheckedList = $this->MModel->getCheckedList($i->NO_BABP);
			$persentage = round($countCheckedList * 100 / $countAllSubist, 0);
			$regn = $countAllSubist - $countCheckedList;
			$status = $i->STATUS == 1 ? "Done" : "On Progress";
			$backgroundStatus = $status == "Done" ? "#24ac58" : "#778295";
			$isDisable = $i->FLAG == 0 ? ($regn == 0 ? "" : "disabled") : "disabled";

            $row = array();
            $row[] = '<center>' . $i->NO_BABP . '</center>' ;
            $row[] = '
				<div class="progress" style="margin-bottom: 0px !important; display: flex; background-color: #778295; font-weight: bolder; border-radius: 5px;">
					<div class="progress-bar" role="progressbar" aria-valuenow="'. $persentage .'"
					aria-valuemin="0" aria-valuemax="100" style="width:'. $persentage .'%; background-color: #f3d14b !important; color: #4c4f34 !important;">
					'. $persentage .'%
					</div>
				</div>
			';
			$row[] = '<center><span class="label" style="background-color: #ff9fa2; font-weight: bold;" border-radius: 5px;>'. $regn .'</span></center>';
            $row[] = '<center>' . date('d M Y', strtotime($i->TANGGAL_BABP)) . '</center>';
			$row[] = $i->APP;
			$row[] = $i->PERUSAHAAN;
			$row[] = '<center><span class="label" style="background-color: '. $backgroundStatus .'; color: #fff; border-radius: 5px; display: inline-block; width: 75px; padding: 5px;">'. $status .'</span></center>';
            $row[] = '
				<center>
					<a class="btn btn-sm btn-outline" style="border-radius: 15px; padding: 1px; margin: 0px; background-color: #edc839; border-style: none; color: #778295 !important; width: 20px !important; height: 20px !important;" 
						id="btnCeklist" title="Isi Ceklist" data-id="'.$i->NO_BABP.'">
						<small>
							<i class="fa fa-binoculars"></i>
						</small>
					</a>
					<a class="btn btn-sm btn-outline btn-danger" style="border-radius: 15px; padding: 1px; margin: 0px; background-color: #cb5150; border-style: none; color: #fff !important; width: 20px !important; height: 20px !important;" 
						id="btnDelete" title="Hapus" data-id="'.$i->NO_BABP.'">
						<small>
							<i class="glyphicon glyphicon-trash"></i>
							</small>
					</a>
			';

			if($this->session->userdata("Role") == "admin"){
				$row[7] = $row[7] .= '
					<a class="btn btn-sm '. ($i->FLAG == 0 ? 'btn-primary' : '') .'" style="border-radius: 15px; padding: 0px; margin: 0px; width: 20px !important; height: 20px !important;'. ($i->FLAG == 0 ? '' : 'background-color: #9E9E9E; color: #fff; opacity: 0.6;').'" 
						id="btnClose" title="'.($i->FLAG == 0 ? 'Close' : 'Closed').'" data-id="'.$i->NO_BABP.'" '.$isDisable.'>
						<small>
							<i class="fa fa-check-square-o"></i>
						</small>
					</a>
				';
			}
			$row[7] = $row[7] .= "</center>";
 
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
		$parse  = array('status' => false, 'message' => null, "ID_NOTE" => null, "checkList" => []);
		$result = $this->MModel->saveChecklistData($this->input->post('data'));
		if($result["bool"] == false){
			$parse["message"] = "Looks like there's an error, please contact your administrator.";
		}
		$parse["status"]    = $result["bool"];
		$parse["ID_NOTE"]   = $result["ID_NOTE"]; 
		$parse["checkList"] = $result["checkList"]; 
		echo json_encode($parse);
	}

	public function getChecklistDataById(){
		$data = $this->MModel->getCheckById($this->input->post("ID")); 
		echo json_encode($data);
	}

	public function AddDataBabp(){
		$parse  = array('status' => false, 'message' => null, "isExsistBabp" => false);
		$data = array(
			'NO_BABP'      => $this->input->post("data")["NO_BABP"],
			'TANGGAL_BABP' => date('Y-m-d', strtotime($this->input->post("data")["TANGGAL_BABP"])),
			'APP'          => $this->input->post("data")["APP"],
			'PERUSAHAAN'   => $this->input->post("data")["PERUSAHAAN"] 
		);

		$checkNoBabp = $this->MModel->checkExistingBabp($data["NO_BABP"]);
		if($checkNoBabp){
			$parse["status"] = true;
			$parse["isExsistBabp"] = $checkNoBabp;
		}else{
			$result = $this->MModel->insertDataBabp($data);

			$parse["message"] = $result == false ? "Looks like there's an error, please contact your administrator." : "Process ADD Data BABP Finish Succesfully";
			$parse["status"]  = $result;
		}

		echo json_encode($parse);
	}

	public function deleteDataBabp(){
		$parse  = array('status' => false, 'message' => null);

		$ID     = $this->input->post('ID');
		$table  = ["tb_r_checklist", "tb_r_note", "tb_r_babp"];

		$resultDelete = $this->MModel->deleteData($table, $ID);

		$parse["message"] = $resultDelete == false ? "Looks like there's an error, please contact your administrator." : "Process DELETE Data Finish Succesfully";
		$parse["status"]  = $resultDelete;

		echo json_encode($parse);
	}

	public function closeChecklist(){
		$parse  = array('status' => false, 'message' => null);
		$ID     = $this->input->post('ID');
		$result = $this->MModel->close($ID);

		$parse["message"] = $result == false ? "Looks like there's an error, please contact your administrator." : "Process CLOSE Data Finish Succesfully";
		$parse["status"]  = $result;
		
		echo json_encode($parse);
	}

	public function checkingForStatus(){
		$no_babp = $this->input->post('NO_BABP');
		$result = $this->MModel->checkingForStatusModel($no_babp);

		echo $result;
	}
}