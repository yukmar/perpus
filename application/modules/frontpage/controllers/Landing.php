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
		$this->load->model(array(
			'Siswa_model' => 'siswa_m',
			'Petugas_model' => 'petugas_m',
			'Buku_model' => 'buku_m'
		));
	}

	public function index()
	{
		$data['list_buku'] = $this->buku_m->get_all();
		$page = $this->input->get('page');
		switch ($page) {
			case 'login':
				$this->load->view('Login_view', $data);
				break;
			case 'daftar':
				$this->load->view('Daftar_view');
				break;
			default:
				$this->load->view('Login_view', $data);
				break;
		}
	}

	public function login()
	{
		$iduser = $this->input->post('txtid');
		$password = $this->input->post('txtpass');
		// check id
		$verify_petugas = $this->petugas_m->verify($iduser, $password);
		$verify_siswa = $this->siswa_m->verify($iduser, $password);

		if ($verify_petugas) {
			$this->load->view('Petugas_view');
		} elseif ($verify_siswa) {
			$this->load->view('Siswa_view');
		} else {
			$this->index();
		}
	}

	public function daftar()
	{
		$nisn = $this->input->post('daftar_nisn');
		$nama = $this->input->post('daftar_nama');
		$password = $this->input->post('daftar_pass');

		$existing_nisn = $this->siswa_m->search('nisn', $nisn);
		$result_registrasi = null;
		if ($existing_nisn) {
			$this->load->view('Login_view', array('status_regis' => 'NISN telah terdaftar'));
		} else {
			$result_registrasi = $this->siswa_m->insert($nisn, $nama, $password);
			if ($result_registrasi) {
				$this->load->view('Login_view', array('status_regis' => 'Registrasi Berhasil'));
			} else {
				$this->load->view('Login_view', array('status_regis' => 'Terjadi kesalahan! silahkan mencoba kembali atau menghubungi petugas'));
			}
		}
	}

	public function testing()
	{
	}
}