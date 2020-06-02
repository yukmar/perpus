<?php
/**
 * 
 */
class Buku extends CI_Controller
{
	protected $tipe=null;
	protected $iduser = null;

	function __construct()
	{
		parent::__construct();
		$this->load->model([
			'buku/Buku_model' => 'buku_m',
			'buku/Itembuku_model' => 'item'
		]);
		$this->iduser = $this->session->userdata('iduser');
		if ($this->session->userdata('tipe') !== 'petugas') {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function index()
	{
		$data['info_buku'] = $this->buku_m->get_all();
		$this->load->view('buku/Buku_view', $data);
	}

	// ------------------ start CRUD ------------------
	public function create()
	{
		$newbuku = [
			'isbn' => preg_replace('/\s+/', '', $this->input->post('txtisbn')) ,
			'judul' => $this->input->post('txtjudul'),
			'pengarang' => $this->input->post('txtpengarang'),
			'penerbit' => $this->input->post('txtpenerbit'),
			'tahunterbit' => preg_replace('/\s+/', '', $this->input->post('txtterbitan')),
			'genre' => $this->input->post('txtgenre')
		];
		$result = $this->buku_m->insert($newbuku);
		if ($result) {			
			redirect(site_url('manage-buku'));
		} else {
			echo "gagal";
			var_dump($result);
		}
		/*header('Content-Type: application/json');
		print json_encode($newbuku);*/
	}

	public function update()
	{
		$old_isbn = $this->input->get('isbn');
		$update_buku = [
			'isbn' => preg_replace('/\s+/', '', $this->input->post('txtisbn')) ,
			'judul' => $this->input->post('txtjudul'),
			'pengarang' => $this->input->post('txtpengarang'),
			'penerbit' => $this->input->post('txtpenerbit'),
			'tahunterbit' => preg_replace('/\s+/', '', $this->input->post('txtterbitan')),
			'genre' => $this->input->post('txtgenre')
		];
		$result = $this->buku_m->update($old_isbn, $update_buku);
		if ($result) {
			redirect(site_url('manage-buku'));
		} else {
			echo "gagal";
			var_dump($result);
		}
	}
	
	public function delete()
	{
		$isbn = $this->input->get('isbn');
		$result = $this->buku_m->delete($isbn);
		if ($result) {
			redirect(site_url('manage-buku'));
		} else {
			echo "gagal hapus";
		}
	}
	// ------------------ end CRUD ------------------

	public function daftar_isbn()
	{
		$daftar = array();
		foreach ($this->buku_m->get_all() as $key => $value) {
			$daftar[] = $value['isbn'];
		}
		print json_encode($daftar);
	}

	public function search()
	{
		$find_isbn = $this->input->get('isbn');
		$result = $this->buku_m->search('isbn', $find_isbn);
		header('Content-Type: application/json');
		echo json_encode($result);
	}

}