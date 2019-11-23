<?php
/**
 * 
 */
class Katalog extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('katalog_view');
	}
}