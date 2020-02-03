<?php
/**
 * 
 */
class Katalog extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model([
			'buku/Buku_model' => 'buku_m',
			'users/Kelas_model' => 'kelas_m'
		]);
	}

	public function list_buku()
	{
		$list = $this->buku_m->get_field('judul');
		header('Content-Type: application/json');
		echo json_encode($list);
	}

	public function search_buku()
	{
		$judul = $this->input->get('search');
		$data['list_buku'] = $this->buku_m->get_all();
		$data['kelas'] = $this->kelas_m->get_all();
		$data['judul'] = $judul;
		$data['hasil'] = $this->buku_m->search_word($judul);
		$this->load->view('dashboard/Search_view', $data);
	}
}