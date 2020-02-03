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
			'buku/Buku_model' => 'buku_m',
			'buku/Itembuku_model' => 'item_m',
			'peminjaman/Peminjaman_model' =>'peminjaman_m',
			'peminjaman/Detailpeminjaman_model' => 'detpeminjaman_m',
			'users/Petugas_model' =>'petugas_m',
			'users/Siswa_model' => 'siswa_m',
			'users/Kelas_model' => 'kelas_m'
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
				$data['list_item'] = $this->item_m->get_allitem();
				$this->load->view('Petugas_view', $data);
				break;
			case 'siswa':
				redirect('siswa');
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

}