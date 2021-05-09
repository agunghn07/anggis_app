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
        $this->parseData['title']   = 'Master List';
        $this->parseData['menu']    = 'Dashboard';
        $this->parseData['submenu'] = 'Master List';
		$this->parseData['content'] = 'content/master/masterList';
		$this->load->view('MainView/backendView', $this->parseData);
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
					<a class="btn btn-sm btn-outline btn-info" style="padding: 0px 5px;" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$i->ID."'".')">
						<small>
							<i class="glyphicon glyphicon-pencil"></i>
						</small>
					</a>
					<a class="btn btn-sm btn-outline btn-danger" style="padding: 0px 5px;" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$i->ID."'".')">
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
}