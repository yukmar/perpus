<?php
/**
 * 
 */
class Peminjaman extends CI_Controller
{
	private $tipe=null;
	private $iduser = null;

	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'peminjaman/Detailpeminjaman_model' => 'detpeminjaman_m',
			'peminjaman/Peminjaman_model' =>'peminjaman_m',
			'buku/Buku_model' => 'buku_m',
			'buku/Itembuku_model' => 'item_m',
			'users/Siswa_model' => 'siswa_m'
		));
		$this->iduser = $this->session->userdata('iduser');
		if ($this->session->userdata('tipe') !== 'petugas') {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function index()
	{
		$data['list_buku'] = $this->item_m->get_allhistory();
		$this->load->view('peminjaman/Peminjaman_v', $data);
	}

	public function create()
	{
		$newpinjam['nis'] = $this->input->post('txnis');
		$newpinjam['tglbatas'] = $this->input->post('tglbatas');
		$newpinjam['nip'] = $this->iduser;
		$newitem['idbuku'] = $this->input->post('id');

		$insertpinjam = $this->peminjaman_m->insert($newpinjam);
		if ($insertpinjam) {
			$newitem['idpeminjaman'] = $insertpinjam;
			foreach ($newitem['idbuku'] as $value) {
				$prep_data = array(
					'idpeminjaman' => $newitem['idpeminjaman'],
					'idbuku' => $value
				);
				$insertdetpinjam = $this->detpeminjaman_m->insert($prep_data);
				if (!$insertdetpinjam) {
					echo "insert detail gagal";
				}
			}
			redirect(site_url('peminjaman'));
		} else {
			echo "insert peminjaman gagal";
		}
	}

	public function cek_ketersediaan()
	{
		$data = null;
		$idbuku = $this->input->get('no');
		$itembuku_exist = $this->item_m->search('id', $idbuku);
		if ($itembuku_exist) {
			$pernah_dipinjam = $this->detpeminjaman_m->search('idbuku', $idbuku);
			if ($pernah_dipinjam) {
				$status = $this->item_m->last_status($idbuku);
				if ($status) {
					$data['status'] = ($status[0]->tgl_kembali) ? 'tersedia' : 'dipinjam';
					$data['judul'] = $status[0]->judul;
					$data['info_buku'] = (array)$this->item_m->info($idbuku)[0];
					$data['info_buku']['pengarang'] = implode(', ', $this->detpengarang_m->get_set($itembuku_exist[0]['isbn']));
				}
			} else {
				$data['status'] = 'baru';
				$data['judul'] = $this->buku_m->search('isbn', $itembuku_exist[0]['isbn'], 'judul');
				$data['info_buku'] = (array)$this->item_m->info($idbuku)[0];
				$data['info_buku']['pengarang'] = implode(', ', $this->detpengarang_m->get_set($itembuku_exist[0]['isbn']));
			}
		}
		echo json_encode($data);
	}

	/*public function detailbuku()
	{
		$idbuku = $this->input->get('no');
		$history_peminjaman = $this->peminjaman_m->detail_history();
	}*/
}