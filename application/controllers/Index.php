<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {
    public function __construct(){
		parent::__construct();
	}

    public function index(){
        $this->parseData['content'] = 'index';
		$this->load->view('MainView/backendView', $this->parseData);
    }
}