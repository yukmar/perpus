<?php
/**
 * 
 */
class BUku extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Detailbuku_model', 'detbuku_m');
	}

	public function index()
	{
	}
}