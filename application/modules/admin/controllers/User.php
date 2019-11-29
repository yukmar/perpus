<?php
/**
 * 
 */
class User extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Siswa_model', 'siswa_m');
		$this->load->model('Petugas_model', 'petugas_m');
	}

	public function index()
	{
		$data['data_siswa'] = $this->siswa_m->get_all();
		$data['data_petugas'] = $this->petugas_m->get_all();
		$this->load->view('User_view', $data);
	}

	public function create()
	{
		$result = null;

		$tipe_user = $this->input->get('t');
		$iduser = $this->input->post('txtiduser');
		$nama = $this->input->post('txtnama');

		switch ($tipe_user) {
			case '1':
				$result = $this->petugas_m->insert($iduser, $nama, DEFAULT_PASSWORD);
				break;
			case '2':
				$result = $this->siswa_m->insert($iduser, $nama, DEFAULT_PASSWORD);
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
		$iduser = $this->input->post('txtiduser');
		$nama = $this->input->post('txtnama');
		$password = $this->input->post('txtpass');

		$newdata = array(
			'nama' => $nama
		);

		if ($password) {
			$newdata = array_merge($newdata, array('password' => $password));
		}

		switch ($tipe_user) {
			case '1':
				$this->petugas_m->update($iduser, $newdata);
				redirect(site_url('manage-user'));
				break;
			
			case '2':
				$this->siswa_m->update($iduser, $newdata);
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

		var_dump($tipe, $iduser);
	}

}