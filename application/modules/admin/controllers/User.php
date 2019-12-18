<?php
/**
 * 
 */
class User extends CI_Controller
{
	private $tipe=null;
	private $iduser = null;
	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'Siswa_model' => 'siswa_m',
			'Petugas_model'=> 'petugas_m',
			'Kelas_model' => 'kelas_m'
		));
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
		$this->load->view('User_view', $data);
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

		var_dump($tipe, $iduser);
	}

	public function logout()
	{
		session_destroy();
		redirect(site_url());
	}

	public function checknis()
	{
		$nis = $this->input->get('nis');
		$result = $this->siswa_m->search('nis', $nis);
		if ($result) {
			echo json_encode(array("ada" => "NIS telah terdaftar"));
		} else {
			echo json_encode(array("tidak" => "tidak ada"));
		}
	}

	public function checknip()
	{
		$nip = $this->input->get('nip');
		$result = $this->petugas_m->search('nip', $nip);
		if ($result) {
			echo json_encode(array("ada" => "NIP telah terdaftar"));
		} else {
			echo json_encode(array("tidak" => "tidak ada"));
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
		// var_dump($nokelas, $kelas);

		redirect(site_url('manage-user'));
	}

	public function deletekelas()
	{
		$kelas = $this->input->get('k');
		$result = $this->kelas_m->delete($kelas);

		redirect(site_url('manage-user'));
	}
}