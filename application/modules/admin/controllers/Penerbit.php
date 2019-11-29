<?php
/**
 * 
 */
class Penerbit extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Penerbit_model', 'penerbit_m');
	}

	public function index()
	{
		$data['info_penerbit'] = $this->penerbit_m->get_all();
		$this->load->view('Penerbit_view', $data);
	}

	public function add()
	{
		$nama = $this->input->post('txtnama');
		$kota = $this->input->post('txtkota');
		$result = $this->penerbit_m->insert($nama, $kota);
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
		$newdata['kota'] = $this->input->post('txtkota');
		
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