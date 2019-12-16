<?php
/**
 * 
 */
class User extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Petugas_model', 'petugas_m');
		$this->load->model('Siswa_model', 'siswa_m');
	}

	public function login()
	{
		$username = $this->input->post('txtuser');
		$password = $this->input->post('txtpass');

		if ($this->petugas_m->search('nip', $username)) {			
			$verify_petugas = $this->petugas_m->verify($username, $password);
			if ($verify_petugas) {
				$this->session->set_userdata(array('tipe' => 'petugas', 'iduser' => $username));
				echo json_encode(array("status" => "berhasil"));
			} else {
				echo json_encode(array("password" => "Password salah"));
			}
		} elseif ($this->siswa_m->search('nis', $username)) {
			$verify_siswa = $this->siswa_m->verify($username, $password);
			if ($verify_siswa) {
				$this->session->set_userdata(array('tipe' => 'siswa', 'iduser' => $username));
				echo json_encode(array("status" => "berhasil"));
			} else {
				echo json_encode(array("password" => "Password salah"));
			}
		} else {
			echo json_encode(array("username" => "Username tidak terdaftar"));
		}		
	}

	public function daftar()
	{
		$data['nis'] = $this->input->post('dtxtuser');
		$data['nama'] = $this->input->post('dtxtnama');
		$data['idkelas'] = $this->input->post('kelas');
		$data['password'] = $this->input->post('dtxtpass');

		$result = $this->siswa_m->insert($data);
		echo json_encode($result);
	}
}