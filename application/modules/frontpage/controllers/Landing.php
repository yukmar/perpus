<?php
/**
 * 
 */
class Landing extends CI_Controller
{
	protected $page = null;
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Siswa_model' => 'siswa_m', 'Petugas_model' => 'petugas_m'));
	}

	public function index()
	{
		$page = $this->input->get('page');
		switch ($page) {
			case 'login':
				$this->load->view('Login_view');
				break;
			case 'daftar':
				$this->load->view('Daftar_view');
				break;
			default:
				$this->load->view('Login_view');
				break;
		}
	}

	public function login()
	{
		$iduser = $this->input->post('txtid');
		$password = $this->input->post('txtpass');
		// check id petugas
		if ($this->petugas_m->verify($iduser, $password)) {
			$this->load->view('Petugas_view');
		} elseif ($this->siswa_m->verify($iduser, $password)) {
			$this->load->view('Siswa_view');
		} else {
			$this->index();
		}
	}

	public function registrasi()
	{
		$nisn = $this->input->post('regis_nisn');
		$nama = $this->input->post('regis_nama');
		$password = $this->input->post('regis_password');

		$existing_nisn = $this->siswa_m->search('nisn', $nisn);
		$result_registrasi = null;
		if ($existing_nisn) {
			$this->load->view('login_view', array('status_regis' => 'NISN telah terdaftar'));
		} else {
			$result_registrasi = $this->siswa_m->insert($nisn, $nama, $password);
			if ($result_registrasi) {
				$this->load->view('login_view', array('status_regis' => 'Registrasi Berhasil'));
			} else {
				$this->load->view('login_view', array('status_regis' => 'Terjadi kesalahan! silahkan mencoba kembali atau menghubungi petugas'));
			}
		}
	}

	public function testing()
	{
		echo ENVIRONMENT;
	}
}