<?php
require_once(__DIR__ . '/User.php');
/**
 * 
 */
class Kelola_users extends User
{
	private $tipe=null;
	private $iduser = null;
	
	function __construct()
	{
		parent::__construct();
		$this->iduser = $this->session->userdata('iduser');
		if ($this->session->userdata('tipe') !== 'petugas') {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function index()
	{
		$data['data_siswa'] = $this->siswa_m->get_all();
		$data['kelas'] = $this->kelas_m->get_all();
		$data['data_petugas'] = $this->petugas_m->get_all();
		$this->load->view('users/admin/User_view', $data);
	}

	public function create()
	{
		$result = null;

		$tipe_user = $this->input->get('t');
		$newdata['nama'] = $this->input->post('txtnama');
		$newdata['password'] = DEFAULT_PASSWORD;
	
		switch ($tipe_user) {
			case '1':
				$newdata['nip'] = $this->input->post('txtnip');
				$result = $this->petugas_m->insert($newdata);
				break;
			case '2':
				$newdata['nis'] = $this->input->post('txtnis');
				$newdata['idkelas'] = $this->input->post('kelas');
				$result = $this->siswa_m->insert($newdata);
				break;
			
			default:
				show_404();
				break;
		}

		redirect(site_url('manage-user'));
	}

	public function update()
	{
		$status_edit = null;
		$existing_iduser = null;
		$check_tipeuser = null;

		$tipe_user = $this->input->get('t');
		$newdata['nama'] = $this->input->post('txtnama');
		$password = $this->input->post('txtpass');

		if ($password) {
			$newdata['password'] = $password;
		}

		switch ($tipe_user) {
			case '1':
				$newdata['nip'] = $this->input->post('txtnip');
				$oldnip = $this->input->post('oldnip');
				$this->petugas_m->update($oldnip, $newdata);
				redirect(site_url('manage-user'));
				break;
			
			case '2':
				$oldnis = $this->input->post('oldnis');
				$newdata['nis'] = $this->input->post('txtnis');
				$newdata['idkelas'] = $this->input->post('kelas');
				$result = $this->siswa_m->update($oldnis, $newdata);
				redirect(site_url('manage-user'));
				break;

			default:
				redirect(site_url('manage-user'));
				break;
		}

	}

	public function delete()
	{
		$tipe = $this->input->get('t');
		$iduser = $this->input->get('u');
		
		switch ($tipe) {
			case '1':
				$this->petugas_m->delete($iduser);
				redirect(site_url('manage-user'));
				break;
			
			case '2':
				$this->siswa_m->delete($iduser);
				redirect(site_url('manage-user'));
				break;

			default:
				return null;
				break;
		}
	}
}