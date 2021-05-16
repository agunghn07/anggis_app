<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterList extends MY_Controller {
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
		if($this->session->userdata("Role") == "admin"){
			$this->parseData['title']   = 'Master List';
			$this->parseData['menu']    = 'Dashboard';
			$this->parseData['submenu'] = 'Master List';
			$this->parseData['content'] = 'content/master/masterList';
			$this->load->view('MainView/backendView', $this->parseData);
		}else{
			$this->notfound();
		}
    }

	public function getDataList(){
		$list = $this->ListModel->get_datatables();
		$data = array();
        $no = $_POST['start'];
		foreach ($list as $i) {
            $no++;
            $row = array();
            $row[] = '<center>' . $no . '</center>' ;
            $row[] = $i->TITLE;
            $row[] = $i->DESCRIPTION;
            $row[] = '<center>' . $i->CREATED_DT . '</center>';
            $row[] = '<center>' . $i->CREATED_BY . '</center>';
            $row[] = '
				<center>
					<a class="btn btn-sm btn-info" id="btnEdit" style="padding: 0px 3px;" title="Edit" data-id="'.$i->ID.'">
						<small>
							<i class="glyphicon glyphicon-pencil"></i>
						</small>
					</a>
					<a class="btn btn-sm btn-warning" id="btnDelete" style="padding: 0px 3px;" title="Hapus" data-id="'.$i->ID.'">
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
			"recordsTotal" => $this->ListModel->count_all(),
			"recordsFiltered" => $this->ListModel->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function AddOrUpdateData(){
		$parse  = array('status' => false, 'message' => null);
		
		$data   = $this->input->post('data');
		$method = $this->input->post('method');
		$table  = ["tb_m_list", "tb_m_sublist"];
		
		if($method == "ADD"){
			$resultInsert = $this->ListModel->insertIntoTableDestination($table, $data);

			$parse["message"] = $resultInsert == false ? "Looks like there's an error, please contact your administrator." : "Process " . $method . " Data Finish Succesfully";
			$parse["status"]  = $resultInsert;
		}else{
			$resultUpdate = $this->ListModel->updateIntoTableDestination($table, $data);

			$parse["message"] = $resultUpdate == false ? "Looks like there's an error, please contact your administrator." : "Process " . $method . " Data Finish Succesfully";
			$parse["status"]  = $resultUpdate;
		}

		echo json_encode($parse);
	}

	public function getDataById(){
		$data = $this->ListModel->getById($this->input->post("ID")); 
		echo json_encode($data);
	}

	public function deleteData(){
		$parse  = array('status' => false, 'message' => null);

		$ID     = $this->input->post('ID');
		$method = $this->input->post('Method'); 
		$table  = ["tb_m_list", "tb_m_sublist"];

		$resultDelete = $this->ListModel->deleteFromTableDestination($table, $ID);

		$parse["message"] = $resultDelete == false ? "Looks like there's an error, please contact your administrator." : "Process " . $method . " Data Finish Succesfully";
		$parse["status"]  = $resultDelete;

		echo json_encode($parse);
	}
}