<?php
/**
 * 
 */
class Pengarang extends CI_Controller
{
	private $tipe=null;
	private $iduser = null;

	function __construct()
	{
		parent::__construct();
		$this->load->model([
			'buku/Pengarang_model' => 'pengarang_m',
			'buku/Detailpengarang_model' => 'detpengarang_m'
		]);
		$this->iduser = $this->session->userdata('iduser');
		if ($this->session->userdata('tipe') !== 'petugas') {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function index()
	{
		$data['item'] = $this->pengarang_m->all_total();
		$this->load->view('buku/Pengarang_view', $data);
	}

	// ------------------ start CRUD ------------------
	public function create()
	{
		$nama = $this->input->post('txtnama');
		$result = $this->pengarang_m->insert($nama);
		if ($result) {
			redirect(site_url('manage-pengarang'));
		} else {
			echo "Pengarang telah terdaftar, silahkan <a href='".site_url('manage-pengarang')."'>kembali</a>";
		}
	}

	public function update()
	{
		$id = $this->input->get('no');
		$newnama = $this->input->post('txtnama');

		$prep_data = array(
			'id' => $id,
			'nama' => $newnama
		);

		$result=$this->pengarang_m->update($prep_data);
		if (!$result) {
			echo "Terjadi kesalahan, mohon menghubungi admin";
		} else {
			redirect(site_url('manage-pengarang'));
		}
	}

	public function delete()
	{
		$id = $this->input->get('no');
		$result = $this->pengarang_m->delete($id);
		if (!$result) {
			echo "Terjadi kesalahan, mohon menghubungi admin";
		} else {
			redirect(site_url('manage-pengarang'));
		}
	}
	// ------------------ end CRUD ------------------

	public function checknama()
	{
		$nama = $this->input->get('nama');
		$result = $this->pengarang_m->search('nama', $nama);
		if ($result) {
			echo json_encode(array("ada" => "Nama telah terdaftar"));
		} else {
			echo json_encode(array("tidak" => "Nama belum terdaftar"));
		}
	}

	public function search_pengarang()
	{
		$isbn = $this->input->get('isbn');
		print json_encode($this->detpengarang_m->get_set($isbn));
	}

	public function daftar_pengarang()
	{
		$daftar = array();
		foreach ($this->pengarang_m->get_all() as $key => $value) {
			$daftar[] = $value['nama'];
		}
		print json_encode($daftar);
	}
}