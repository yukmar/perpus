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
			'Buku_model' => 'buku_m',
			'Itembuku_model' => 'item',
			'Penerbit_model' => 'penerbit_m',
			'Pengarang_model' => 'pengarang_m'
		));
	}

	public function index()
	{
		$data['info_buku'] = $this->buku_m->get_all();
		$data['list_penerbit'] = $this->penerbit_m->get_all();
		$this->load->view('Buku_view', $data);
	}

	public function search_pengarang()
	{
		$nama = $this->input->get('no');
	}

	public function daftar_pengarang()
	{
		$daftar = array();
		foreach ($this->pengarang_m->get_all() as $key => $value) {
			$daftar[] = $value['nama'];
		}
		print json_encode($daftar);
	}

	public function addinfo()
	{
		$newdata['isbn'] = $this->input->post('txtisbn');
		$newdata['judul'] = $this->input->post('txtjudul');
		$newdata['pengarang'] = $this->input->post('txtpengarang[]');
		$newdata['idpenerbit'] = $this->input->post('opsipenerbit');

		var_dump($newdata);
		// $result = $this->detbuku_m->insert($newdata);
		// if ($result) {
		// 	redirect(site_url('manage-buku'));
		// } else {
		// 	echo "gagal";
		// }
	}

	// public function additem()
	// {
	// 	$newdata['isbn'] = $this->input->post('txtitemisbn');
	// 	$newdata['terbit'] = $this->input->post('txtterbit');
	// 	$newdata['harga'] = $this->input->post('txtharga');
	// 	$newdata['tgl_beli'] = $this->input->post('txttglbeli');

	// 	$existedisbn = $this->detbuku_m->search('isbn', $newdata['isbn']);
	// 	if ($existedisbn) {
	// 		$result = $this->item->insert($newdata);
	// 		if ($result) {
	// 			redirect(site_url('manage-buku'));
	// 		} else {
	// 			echo "gagal menambahkan item buku";
	// 		}
	// 	} else {
	// 		echo "isbn belum terdaftar, silahkan tambah info buku terlebih dahulu";
	// 	}
	// }

	// public function update()
	// {
	// 	$oldisbn = $this->input->get('no');
	// 	$newdata['isbn'] = $this->input->post('txtisbn');
	// 	$newdata['judul'] = $this->input->post('txtjudul');
	// 	$newdata['pengarang'] = $this->input->post('txtpengarang');
	// 	$newdata['idpenerbit'] = $this->input->post('opsipenerbit');

	// 	$result = $this->buku_m->update($oldisbn, $newdata);
	// 	if ($result) {		
	// 		redirect(site_url('manage-buku'));
	// 	} else {
	// 		echo "gagal";
	// 	}
	// }

	// public function delete()
	// {
	// 	$isbn = $this->input->get('no');
	// 	$result = $this->buku_m->delete($isbn);
	// 	if ($result) {
	// 		redirect(site_url('manage-buku'));
	// 	} else {
	// 		echo "gagal hapus";
	// 	}
	// }

	public function testing()
	{
		print json_encode($this->buku_m->get_all());
	}
}