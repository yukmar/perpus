<?php
require_once(__DIR__ . '/User.php');
/**
 * 
 */
class Siswa extends User
{
	private $iduser = null;

	function __construct()
	{
		parent::__construct();
		$this->load->model([
			'buku/Itembuku_model' => 'item_m',
		]);
		$this->iduser = $this->session->userdata('iduser');
		if ($this->session->userdata('tipe') !== 'siswa') {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function index()
	{
		$data['profile'] = $this->siswa_m->search('nis', $this->iduser);
		$data['profile']['kelas'] = $this->kelas_m->search('id', $data['profile']['idkelas'], 'nama')[0];
		$data['riwayat'] = $this->item_m->history_siswa($this->iduser);
		$this->load->view('users/siswa/User_view', $data);
	}

	public function edit_profile()
	{
		$prep_data = array();
		$oldnis = $this->input->post('oldnis');
		$pass = $this->input->post('txtpass');
		if ($pass) {
			$prep_data['password'] = $pass;
		}
		$prep_data['nis'] = $this->input->post('txtnis');
		$prep_data['nama'] = $this->input->post('txtnama');

		$result = $this->siswa_m->update($oldnis, $prep_data);
		if ($result) {
			redirect('siswa');
		} else {
			echo "Terjadi kesalahan, mohon menghubungi admin";
		}
	}
}