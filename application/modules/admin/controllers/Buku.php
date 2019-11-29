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
			'Buku_model' => 'buku_m',
			'Penerbit_model' => 'penerbit_m'
		));
	}

	public function index()
	{
		$data['info_buku'] = $this->detbuku_m->get_all();
		$data['list_penerbit'] = $this->penerbit_m->get_all();
		$this->load->view('Buku_view', $data);
	}

	public function addinfo()
	{
		$newdata['isbn'] = $this->input->post('txtisbn');
		$newdata['judul'] = $this->input->post('txtjudul');
		$newdata['pengarang'] = $this->input->post('txtpengarang');
		$newdata['idpenerbit'] = $this->input->post('opsipenerbit');
		// var_dump($isbn, $judul, $pengarang, $penerbit);
		$result = $this->detbuku_m->insert($newdata);
		if ($result) {
			redirect(site_url('manage-buku'));
		} else {
			echo "gagal";
		}
	}

	public function addintem()
	{
		echo "additembuku";
	}

	public function update()
	{
		$oldisbn = $this->input->get('no');
		$newdata['isbn'] = $this->input->post('txtisbn');
		$newdata['judul'] = $this->input->post('txtjudul');
		$newdata['pengarang'] = $this->input->post('txtpengarang');
		$newdata['idpenerbit'] = $this->input->post('opsipenerbit');

		$result = $this->detbuku_m->update($oldisbn, $newdata);
		if ($result) {		
			redirect(site_url('manage-buku'));
		} else {
			echo "gagal";
		}
	}

	public function delete()
	{
		$isbn = $this->input->get('no');
		$result = $this->detbuku_m->delete($isbn);
		if ($result) {
			redirect(site_url('manage-buku'));
		} else {
			echo "gagal hapus";
		}
	}

	public function testing()
	{
		print json_encode($this->detbuku_m->get_all());
	}
}