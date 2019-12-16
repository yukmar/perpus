<?php
/**
 * 
 */
class Testing extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Buku_model' , 'buku_m');
	}

	public function index()
	{
		echo json_encode($this->buku_m->search_word('bahasa'));
	}
}