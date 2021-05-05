<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template 
{
	function __construct()
	{
		$this->ci =&get_instance();
	}

	function student($template, $data='')
	{
		$data['content'] = $this->ci->load->view($template, $data, TRUE);
		$data['navbar'] = $this->ci->load->view('layout/frontend/navbar', $data, TRUE);

		$this->ci->load->view('MainView/frontendView', $data);
	}	

}