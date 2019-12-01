<?php
/**
 * 
 */
class Testing extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'Itembuku_model' => 'item',
			'Buku_model' => 'buku_m',
			'Penerbit_model' => 'penerbit_m',
			'Pengarang_model' => 'pengarang_m',
			'Detailpengarang_model' => 'detpengarang_m'
		));
	}

	public function index()
	{
		print json_encode($this->buku_m->get_all());
	}
}