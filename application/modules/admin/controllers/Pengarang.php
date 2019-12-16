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
		$this->load->model(array('Pengarang_model' => 'pengarang_m'));
		$this->iduser = $this->session->userdata('iduser');
		if ($this->session->userdata('tipe') !== 'petugas') {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function index()
	{
		$data['item'] = $this->pengarang_m->all_total();
		$this->load->view('Pengarang_view', $data);
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
}