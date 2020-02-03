<?php
/**
 * 
 */
class Kelas extends CI_Controller
{
	private $tipe=null;
	private $iduser = null;

	function __construct()
	{
		parent::__construct();
		$this->load->model('users/Kelas_model', 'kelas_m');
		$this->iduser = $this->session->userdata('iduser');
		if ($this->session->userdata('tipe') !== 'petugas') {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function searchkelas()
	{
		$kelas = $this->input->get('kelas');
		$result = $this->kelas_m->search('nama', $kelas, 'id');
		echo json_encode($result[0]);
	}

	public function addkelas()
	{
		$kelas = $this->input->post('newkelas');
		$result = $this->kelas_m->insert($kelas);

		redirect(site_url('manage-user'));
	}

	public function editkelas()
	{
		$nokelas = $this->input->post('nokelas');
		$kelas = $this->input->post('editkelas');
		$result = $this->kelas_m->update($nokelas, array("nama" => $kelas));

		redirect(site_url('manage-user'));
	}

	public function deletekelas()
	{
		$kelas = $this->input->get('k');
		$result = $this->kelas_m->delete($kelas);

		redirect(site_url('manage-user'));
	}
}