<?php
/**
 * 
 */
class Testing extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Itembuku_model', 'item_m');
	}

	public function index()
	{
		echo json_encode($this->item_m->get_allitem());
	}
}