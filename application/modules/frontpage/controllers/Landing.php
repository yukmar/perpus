<?php
/**
 * 
 */
class Landing extends CI_Controller
{
	protected $page = null;
	private $tipe = null;

	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'Detailpeminjaman_model' => 'detpeminjaman_m',
			'Peminjaman_model' =>'peminjaman_m',
			'Buku_model' => 'buku_m',
			'Petugas_model' =>'petugas_m',
			'Itembuku_model' => 'item_m',
			'Siswa_model' => 'siswa_m',
			'Kelas_model' => 'kelas_m'
		));
		$this->tipe = $this->session->tipe;
	}

	public function index()
	{
		$data['list_buku'] = $this->buku_m->get_all();
		$data['kelas'] = $this->kelas_m->get_all();
		$page = null;
		$page = $this->input->get('page');

		switch ($this->tipe) {
			case 'petugas':
				$data['list_buku'] = $this->item_m->get_allhistory();
				$this->load->view('Petugas_view', $data);
				break;
			case 'siswa':
				redirect('user');
				break;

			default:
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
			$this->session->set_userdata(array('tipe' => 'petugas', 'iduser' => $iduser));
			redirect(site_url());
		} elseif ($verify_siswa) {
			$this->session->set_userdata(array('tipe' => 'siswa', 'iduser' => $iduser));
			redirect(site_url('user'));
		} else {
			$this->index();
			redirect(site_url());
		}
	}

	public function daftar()
	{
		$nis = $this->input->post('dtxtid');
		$nama = $this->input->post('dtxtnama');
		$kelas = $this->input->post('dtxtkelas');
		$pass = $this->input->post('dtxtpass');

		$existing_nis = $this->siswa_m->search('nis', $nis);
		$result_registrasi = null;
		if ($existing_nis) {
			redirect(site_url());
		} else {
			$result_registrasi = $this->siswa_m->insert($nis, $nama, $kelas, $pass);
			if ($result_registrasi) {
				redirect(site_url());
			} else {
				$this->load->view('Login_view', array('status_regis' => 'Terjadi kesalahan! silahkan mencoba kembali atau menghubungi petugas'));
			}
		}
	}

	public function list_buku()
	{
		$list = $this->buku_m->get_field('judul');
		echo json_encode($list);
	}

	public function search_buku()
	{
		$judul = $this->input->get('search');
		$data['judul'] = $judul;
		$data['hasil'] = $this->buku_m->search_word($judul);
		$this->load->view('Search_view', $data);
	}

	public function checknis()
	{
		$nis = $this->input->get('nis');
		$result = $this->siswa_m->search('nis', $nis);
		if ($result) {
			echo json_encode(array("ada" => "NIS telah terdaftar"));
		} else {
			echo json_encode(array("tidak" => "NIS belum terdaftar"));
		}
	}
	
}