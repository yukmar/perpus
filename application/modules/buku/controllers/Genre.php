<?php
/**
 * 
 */
class Genre extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('buku/Genre_model', 'genre_m');
	}

	public function addgenre()
	{
		$newgenre = $this->input->post('newgenre');
		$result = $this->genre_m->insert($newgenre);

		redirect(site_url('manage-buku'));
	}

	public function updategenre()
	{
		$idgenre = $this->input->post('nogenre');
		$namagenre = $this->input->post('editgenre');

		$result = $this->genre_m->update($idgenre, array('nama' => $namagenre));
		redirect(site_url('manage-buku'));
	}

	public function deletegenre()
	{
		$genre = $this->input->get('g');
		$result = $this->genre_m->delete($genre);
		redirect(site_url('manage-buku'));
	}
}