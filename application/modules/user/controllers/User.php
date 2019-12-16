<?php
/**
 * 
 */
class User extends CI_Controller
{
	private $iduser = null;
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Itembuku_model' => 'item_m', 'Siswa_model' => 'siswa_m'));
		$this->iduser = $this->session->userdata('iduser');
		if ($this->session->userdata('tipe') !== 'siswa') {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function index()
	{
		$data['profile'] = $this->siswa_m->search('nis', $this->iduser);
		$data['riwayat'] = $this->item_m->history_siswa($this->iduser);
		$this->load->view('User_view', $data);
	}

	public function edit()
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
			redirect('user');
		} else {
			echo "Terjadi kesalahan, mohon menghubungi admin";
		}
	}
}