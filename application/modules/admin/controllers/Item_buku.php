<?php
/**
 * 
 */
class Item_buku extends CI_Controller
{
	private $tipe=null;
	private $iduser = null;
	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'Itembuku_model' => 'item_m',
			'Buku_model' => 'buku_m',
			'Pengarang_model' => 'pengarang_m',
			'Detailpengarang_model' => 'detpengarang_m',
			'Detailpeminjaman_model' => 'detpinjam_m',
			'Penerbit_model' => 'penerbit_m',
			'Peminjaman_model' =>'peminjaman_m'
		));
		$this->iduser = $this->session->userdata('iduser');
		if ($this->session->userdata('tipe') !== 'petugas') {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function index()
	{
		$isbn = $this->input->get('isbn');
		if (!$isbn) {
			show_404();
		}
		$infobuku = $this->buku_m->search('isbn', $isbn)[0];
		$data['item'] = $this->item_m->search('isbn', $isbn);
		$data['pengarang'] = implode(', ',$this->detpengarang_m->get_set($isbn));
		$data['isbn'] = $isbn;
		$data['judul'] = $infobuku['judul'];
		$data['tahun'] = $infobuku['tahunterbit'];
		$data['penerbit'] = $this->penerbit_m->search('id', $infobuku['idpenerbit'], 'nama')[0];

		foreach ($data['item'] as $key => $value) {
			$status = null;
			$pernah_dipinjam = $this->detpinjam_m->search('idbuku', $value['id']);
			if ($pernah_dipinjam) {
				$tgl_kembali = $this->item_m->last_status($value['id'])[0]->tgl_kembali;
				$status = ($tgl_kembali) ? "tersedia" : "dipinjam";
			} else {
				$status = "tersedia";
			}
			$data['item'][$key]['status'] = $status;
		}

		$this->load->view('Itembuku_v', $data);
	}

	public function create()
	{
		$isbn = $this->input->post('isbn');
		$newdata['id'] = $this->input->post('tambahkodebuku');
		$newdata['tgl_beli'] = $this->input->post('tambahtglbeli');
		$newdata['harga'] = $this->input->post('tambahharga');
		$newdata['isbn'] = $isbn;

		$exist_item = $this->item_m->search('id', $newdata['id']);
		if (!$exist_item) {
			$result = $this->item_m->insert($newdata);
			if ($result) {
				redirect(site_url("item-buku/?isbn=$isbn"));
			} else {
				echo "terjadi kesalahan, mohon menghubungi admin";
			}
		} else {
			echo "Item buku telah ada, silahkan mencoba dengan kode yang lain <a href='".site_url("item-buku/?isbn=$isbn")."'>Kembali</a>";
		}
	}

	public function edit()
	{
		$newdata['id'] = $this->input->post('txtkodebuku');
		$newdata['tgl_beli'] = $this->input->post('txttglbeli');
		$newdata['harga'] = $this->input->post('txtharga');
		$kodeold = $this->input->post('kodeold');
		$isbn = $this->input->post('isbn');

		$result = $this->item_m->update($kodeold, $newdata);
		if ($result) {
			redirect(site_url("item-buku/?isbn=$isbn"));
		} else {
			echo "terjadi kesalahan, mohon menghubungi admin";
		}
	}

	public function delete()
	{
		$idbuku = $this->input->get('no');
		$isbn = $this->input->get('isbn');
		$result = $this->item_m->delete($idbuku);
		if ($result) {
			redirect(site_url("item-buku/?isbn=$isbn"));
		} else {
			echo "terjadi kesalahan, mohon menghubungi admin";
		}
	}

	public function history()
	{
		$idbuku = $this->input->get('no');
		$info_item = $this->item_m->info($idbuku)[0];
		$history_item = $this->item_m->history($idbuku);
		$data['info'] = $info_item;
		$data['data'] = $history_item;
		$this->load->view('Detailitem_view', $data);
	}
}