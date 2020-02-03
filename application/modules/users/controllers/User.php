<?php
/**
 * 
 */
class User extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model([
			'users/Kelas_model' => 'kelas_m',
			'users/Petugas_model' => 'petugas_m',
			'users/Siswa_model' => 'siswa_m'
		]);
	}

	public function checknis()
	{
		$nis = $this->input->get('nis');
		$result = $this->siswa_m->search('nis', $nis);
		header('Content-Type: application/json');
		if ($result) {
			echo json_encode(array("ada" => "NIS telah terdaftar"));
		} else {
			echo json_encode(array("tidak" => "NIS belum terdaftar"));
		}
	}

	public function checknip()
	{
		$nip = $this->input->get('nip');
		$result = $this->petugas_m->search('nip', $nip);
		header('Content-Type: application/json');
		if ($result) {
			echo json_encode(array("ada" => "NIP telah terdaftar"));
		} else {
			echo json_encode(array("tidak" => "tidak ada"));
		}
	}

	public function logout()
	{
		session_destroy();
		redirect(site_url());
	}
}