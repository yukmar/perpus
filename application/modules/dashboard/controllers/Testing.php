<?php
/**
 * 
 */
class Testing extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('buku/Buku_model', 'buku');
	}

	public function index()
	{
		header('Content-Type: application/json');
		echo json_encode($this->buku->get_all());
	}
}