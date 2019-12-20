<?php
/**
 * 
 */
class Buku extends CI_Controller
{
	private $tipe=null;
	private $iduser = null;
	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'Buku_model' => 'buku_m',
			'Itembuku_model' => 'item',
			'Penerbit_model' => 'penerbit_m',
			'Pengarang_model' => 'pengarang_m',
			'Detailpengarang_model' => 'detpengarang_m',
			'Genre_model' => 'genre_m'
		));
		$this->iduser = $this->session->userdata('iduser');
		if ($this->session->userdata('tipe') !== 'petugas') {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function index()
	{
		$data['info_buku'] = $this->buku_m->get_all();
		$data['list_penerbit'] = $this->penerbit_m->get_all();
		$data['genre'] = $this->genre_m->get_all();
		$this->load->view('Buku_view', $data);
	}

	public function search()
	{
		$isbn = $this->input->get('isbn');
		print json_encode($this->detpengarang_m->get_set($isbn));
	}

	public function daftar_pengarang()
	{
		$daftar = array();
		foreach ($this->pengarang_m->get_all() as $key => $value) {
			$daftar[] = $value['nama'];
		}
		print json_encode($daftar);
	}

	public function daftar_isbn()
	{
		$daftar = array();
		foreach ($this->buku_m->get_all() as $key => $value) {
			$daftar[] = $value['isbn'];
		}
		print json_encode($daftar);
	}

	public function addinfo()
	{
		$newdata['isbn'] = $this->input->post('txtisbn');
		$newdata['judul'] = $this->input->post('txtjudul');
		$newdata['pengarang'] = $this->input->post('txtpengarang[]');
		$newdata['idpenerbit'] = $this->input->post('opsipenerbit');
		$newdata['tahunterbit'] = $this->input->post('txtterbitan');
		$newdata['idgenre'] = $this->input->post('genre');

		$prep_pengarang_buku = array();

		$exist_idpenerbit = $this->penerbit_m->search('id', $newdata['idpenerbit']);
		if (!$exist_idpenerbit) {
			redirect(site_url('manage-buku'));
		}

		// check isbn exist, if not exist => next step
		$exist_isbn = $this->buku_m->search('isbn', $newdata['isbn']);
		if (!$exist_isbn && ($newdata['judul'])) {
			$prep_datadet['isbn'] = $newdata['isbn'];
			$prep_datadet['judul'] = $newdata['judul'];
			$prep_datadet['tahunterbit'] = $newdata['tahunterbit'];
			$prep_datadet['idpenerbit'] = $newdata['idpenerbit'];
			$prep_datadet['idgenre'] = $newdata['idgenre'];
			$this->buku_m->insert($prep_datadet);
		} else {
			redirect(site_url('manage-buku'));
		}

		// check pengarang, if pengarang exist => lanjut else insert pengarang
		foreach ($newdata['pengarang'] as $key => $value) {
			$exist_pengarang = $this->pengarang_m->search('nama', $value, 'id');
			if (!$exist_pengarang) {
				$result = $this->pengarang_m->insert($value);
				if ($result) {
					$prep_pengarang_buku['idpengarang'] = $this->pengarang_m->search('nama', $value, 'id')[0];
					$prep_pengarang_buku['isbn'] = $newdata['isbn'];
					$result = $this->detpengarang_m->insert($prep_pengarang_buku);
					if (!$result) {						
						echo "ada kesalahan silahkan hubungi admin";
					}
				} else {
					echo "ada yang salah pada insert pengarang baru";
				}
			} else {
				$prep_pengarang_buku['idpengarang'] = $this->pengarang_m->search('nama', $value, 'id')[0];
				$prep_pengarang_buku['isbn'] = $newdata['isbn'];
				$result = $this->detpengarang_m->insert($prep_pengarang_buku);
				if (!$result) {
					echo "ada kesalahan silahkan hubungi admin";
				}
			}
		}

		redirect(site_url('manage-buku'));
	}

	public function additem()
	{
		$newdata['id'] = $this->input->post('txtiditem');
		$newdata['isbn'] = $this->input->post('txtitemisbn');
		$newdata['harga'] = $this->input->post('txtharga');
		$newdata['tgl_beli'] = $this->input->post('txttglbeli');

		$existedisbn = $this->buku_m->search('isbn', $newdata['isbn']);
		if ($existedisbn) {
			$result = $this->item->insert($newdata);
			if ($result) {
				redirect(site_url('manage-buku'));
			} else {
				echo "gagal menambahkan item buku";
			}
		} else {
			echo "isbn belum terdaftar, silahkan tambah info buku terlebih dahulu";
		}
	}

	public function update()
	{
		// atribut old data: isbn, judul, pengarang, tahun, penerbit
		$old = json_decode($this->input->post('old'));

		$new['isbn'] = $this->input->post('txtisbn');
		$new['judul'] = $this->input->post('txtjudul');
		$new['pengarang'] = $this->input->post('txtpengarang[]');
		$new['tahunterbit'] = $this->input->post('txtterbitan');
		$new['idpenerbit'] = $this->input->post('opsipenerbit');
		$new['idgenre'] = $this->input->post('genre');

		// print json_encode(array('old' => $old, 'new' => $new));
		

		// replace seluruh pengarang lama dengan pengarang baru di isbn lama
		// bukan melalui update melainkan delete -> create
		// isbn yang ada di pengarang akan mengikuti isbn baru
		if ($old) {
			$delete_detpengarang = $this->detpengarang_m->delete($old->isbn);
		}
		
		// atribut isbn, judul, tahun terbit, dan idpenerbit berada di dalam satu tabel dan model: buku
		// maka dilakukan update bersamaan
		$prep_data = array(
			'isbn' => $new['isbn'],
			'idpenerbit' => $new['idpenerbit'],
			'judul' => $new['judul'],
			'tahunterbit' => $new['tahunterbit'],
			'idgenre' => $new['idgenre']
		);
		// update buku
		$result = $this->buku_m->update($old->isbn, $prep_data);

		// insert pengarang baru
		foreach ($new['pengarang'] as $key => $nama) {
			$exist_pengarang = $this->pengarang_m->search('nama', $nama, 'id');
			if ($exist_pengarang) {
				$id_pengarang = $exist_pengarang;
				$prep_isbn = $new['isbn'];
				$prep_data = array(
					'idpengarang' => $id_pengarang[0],
					'isbn' => $prep_isbn
				);
				$insert_detpengarang = $this->detpengarang_m->insert($prep_data);
			} else {
				$new_pengarang = $this->pengarang_m->insert($nama);
				if ($new_pengarang) {
					$id_newpengarang = $this->pengarang_m->search('nama', $nama, 'id');
					$prep_data = array(
						'idpengarang' => $id_newpengarang[0],
						'isbn' => $new['isbn']
					);
					$insert_detpengarang = $this->detpengarang_m->insert($prep_data);
				}
			}
		}

		redirect('manage-buku');
	}
	
	public function delete()
	{
		$isbn = $this->input->get('no');
		$result = $this->buku_m->delete($isbn);
		if ($result) {
			redirect(site_url('manage-buku'));
		} else {
			echo "gagal hapus";
		}
	}

	public function addgenre()
	{
		$newgenre = $this->input->post('newgenre');
		$result = $this->genre_m->insert($newgenre);

		redirect(site_url('manage-buku'));
	}

	public function editgenre()
	{
		$idgenre = $this->input->post('nogenre');
		$namagenre = $this->input->post('editgenre');

		$result = $this->genre_m->update($idgenre, array('nama' => $namagenre));
		redirect(site_url('manage-buku'));
	}

	public function deletegenre()
	{
		$genre = $this->input->get('g');
		$result = $this->genre_m->delete($genre);
		redirect(site_url('manage-buku'));
	}

	public function testing()
	{
		print json_encode($this->buku_m->get_all());
	}
}