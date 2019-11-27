<?php
/**
 * 
 */
class Buku extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'Detailbuku_model' => 'detbuku_m',
			'Buku_model' => 'buku_m'
		));
	}

	public function index()
	{
		$data['info_buku'] = $this->detbuku_m->get_all();
		$this->load->view('Buku_view', $data);
	}

	public function testing()
	{
		var_dump($this->buku_m->get_all());
	}
}