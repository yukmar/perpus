<?php
/**
 * 
 */
class Penerbit extends CI_Controller
{
	private $tipe=null;
	private $iduser = null;

	function __construct()
	{
		parent::__construct();
		$this->load->model('buku/Penerbit_model', 'penerbit_m');
		$this->iduser = $this->session->userdata('iduser');
		if ($this->session->userdata('tipe') !== 'petugas') {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function index()
	{
		$data['info_penerbit'] = $this->penerbit_m->get_all();
		$this->load->view('buku/Penerbit_view', $data);
	}

	public function add()
	{
		$nama = $this->input->post('txtnama');
		$alamat = $this->input->post('txtalamat');
		$result = $this->penerbit_m->insert($nama, $alamat);
		if ($result) {
			redirect(site_url('manage-penerbit'));
		} else {
			echo "gagal tambah penerbit";
		}
	}
	public function update()
	{
		$id = $this->input->get('no');
		$newdata['nama'] = $this->input->post('txtnama');
		$newdata['alamat'] = $this->input->post('txtalamat');
		
		$result = $this->penerbit_m->update($id, $newdata);
		if ($result) {
			redirect(site_url('manage-penerbit'));
		} else {
			echo "gagal update";
		}
	}
	public function delete()
	{
		$id = $this->input->get('no');
		$result = $this->penerbit_m->delete($id);
		if ($result) {
			redirect(site_url('manage-penerbit'));
		} else {
			echo "gagal menghapus penerbit";
		}
	}
}