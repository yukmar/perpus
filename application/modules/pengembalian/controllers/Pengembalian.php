<?php
/**
 * 
 */
class Pengembalian extends CI_Controller
{
	private $tipe=null;
	private $iduser = null;
	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			"buku/Itembuku_model" => "item_m",
			"peminjaman/Detailpeminjaman_model" => "detpinjam",
			"users/Siswa_model" => "siswa_m",
			"users/Kelas_model" => 'kelas_m'
		));
		$this->iduser = $this->session->userdata('iduser');
		if ($this->session->userdata('tipe') !== 'petugas') {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function index()
	{	
		$this->load->view('pengembalian/Pengembalian_view');
	}

	public function cek_tagihan()
	{
		$nis = preg_replace('/\s+/', '', $this->input->post('txtnis'));
		$data_siswa = $this->siswa_m->search('nis', $nis);

		$tagihan_buku['items'] = $this->item_m->tagihan_buku($nis);
		$tagihan_buku['nis'] = $nis;
		$tagihan_buku['nama'] = $data_siswa['nama'];
		$tagihan_buku['kelas'] = $this->kelas_m->search('id', $data_siswa['idkelas'], 'nama')[0];
		$denda = null;
		if ($tagihan_buku['items']) {
			foreach ($tagihan_buku['items'] as $key => $value) {
				$denda += (int)($value->denda);
				$tglbatas = date_create($value->tgl_bataspinjam);
				$date2 = new DateTime();
				$result = date_diff($date2, $tglbatas)->format("%R%a");
				$dendatagihan = 0;
				if ($result < 0) {
					$dendatagihan = abs($result)*500;
				}
				$tagihan_buku['items'][$key]->newdenda = $dendatagihan;
			}
		}
		$tagihan_buku['total_denda'] = $denda;
		$this->load->view('Pengembalian_view', $tagihan_buku);
	}

	public function kembali()
	{
		$iddet = $this->input->post("nopinjam[]");
		foreach ($iddet as $key) {
			$result = $this->detpinjam->update_kembali($key);
		}
		redirect('pengembalian');
	}
}