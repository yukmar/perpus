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
		// var_dump($new['pengarang']);
		

		// replace seluruh pengarang lama dengan pengarang baru di isbn lama
		// bukan melalui update melainkan delete -> create
		// isbn yang ada di pengarang akan mengikuti isbn baru
		if ($old) {
			$delete_detpengarang = $this->detpengarang_m->delete($old->isbn);
		}
		// insert pengarang lama dan baru dengan memakai isbn lama
		foreach ($new['pengarang'] as $key => $nama) {
			$exist_pengarang = $this->pengarang_m->search('nama', $nama, 'id');
			if ($exist_pengarang) {
				var_dump("exist:", $exist_pengarang);
				$id_pengarang = $exist_pengarang;
				$prep_isbn = ($old)? $old->isbn : $new['isbn'];
				$prep_data = array(
					'idpengarang' => $id_pengarang[0],
					'isbn' => $prep_isbn
				);
				$insert_detpengarang = $this->detpengarang_m->insert($prep_data);
			} else {
				$new_pengarang = $this->pengarang_m->insert($nama);
				if ($new_pengarang) {
					$id_newpengarang = $this->pengarang_m->search('nama', $nama, 'id');
					var_dump("newid:", $id_newpengarang);
					$prep_data = array(
						'idpengarang' => $id_newpengarang[0],
						'isbn' => $old->isbn
					);
					$insert_detpengarang = $this->detpengarang_m->insert($prep_data);
				}
			}
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
		if (!$result) {
			echo "Terjadi kesalahan, mohon menghubungi admin";
		} else {
			redirect('manage-buku');
		}
	}

/**
	public function update()
	{
		$oldisbn = $this->input->get('no');
		$olddata = json_decode($this->input->post('old'));
		$newdata['isbn'] = $this->input->post('txtisbn');
		$newdata['judul'] = $this->input->post('txtjudul');
		$newdata['pengarang'] = $this->input->post('txtpengarang[]');
		$newdata['tahunterbit'] = $this->input->post('txtterbitan');
		$newdata['idpenerbit'] = $this->input->post('opsipenerbit');

		$prep_data = array();
		$prep_datapenerbit = array();

		echo "<br/>";
		print_r($newdata);
		echo "<br/>";

		// check new isbn matched old isbn
		if ($newdata['isbn'] !== $olddata->isbn) {
			$prep_data['isbn'] = $newdata['isbn'];
		}
		// check new judul matched old judul
		if ($newdata['judul'] !== $olddata->judul) {
			$prep_data['judul'] = $newdata['judul'];
		}
		// check if old pengarang matched new pengarang
		if (count($newdata['pengarang']) > 1) {
			// tampung new pengarang
			$newdt =$newdata['pengarang'];
			// tampung old pengarang
			$olddt = $olddata->pengarang;
					echo "<br/>";
			print_r($olddata);
					echo "<br/>";
			// tampung index yang sama dari sisi newdt (new pengarang)
			$x1 = array();
			// tampung index yang sama dari sisi olddt (old pengarang)
			$y1 = array();
			// cross checking olddt & newdt
			foreach ($newdt as $newidx => $newval) {
				foreach ($olddt as $oldidx => $oldval) {
					if ($newval == $oldval) {
						array_push($x1, $newidx);
						array_push($y1, $oldidx);
					}
				}
			}
					echo "<br/>";
					echo "x1;";
					var_dump($x1, $y1);
					echo "<br/>";

			// tampung index abnormal sisi newdt
			$x2 = array();
			// tampung index abnormal sisi olddt
			$y2 = array();
			// linier checking newdt index
			$x22 = $newdt;
			foreach ($x22 as $newidx => $newval) {
				if (!empty($x1)) {
					$lastx1  = end($x1);
					foreach ($x1 as $idx => $value) {
						if (empty($x1)) {
							break 2;
						} else {
							if ($newidx == $value) {
								// unset($x1[$idx]);
								continue;
							} else {
								if ($value == $lastx1) {
									array_push($x2, $newidx);
								}
							}
						}
					}
				} else {
					break;
				}
			}
			// linier checking olddt index
			$y22 = $olddt;
			foreach ($y22 as $idxy => $oldval) {
				if (!empty($y1)) {
					foreach ($y1 as $idx => $value) {
						if (empty($y1)) {
							break 2;
						} else {
							if ($idxy == $value) {
								unset($y22[$idx]);
								unset($y1[$idx]);
							} else {
								array_push($y2, $idxy);
							}
						}
					}
				} else {
					break;
				}
			}
			
					echo "<br/>";
					echo "2:";
					var_dump($x2,$y2);
					echo "<br/>";
			// fetch last item
			$lastx2 = end($x2);
			// tampung dibedakan index mana yang update dan mana yang create baru
			$pengarang_update = array();
			$pengarang_newcreate = array();
			// linier checking x2 y2 value
			// loop ini difokuskan ke x2 dan y2 sebagai pembanding
			foreach ($x2 as $idxx => $valx) {
				// $lasty2 = end($y2);
				foreach ($y2 as $idxy => $valy) {
					// jika nilai valx sama dengan nilai terakhir x2 disimpan di lastx2 (n verse versa)
					if ($valx == $lastx2 && $valy == $lasty2) {
						if ($valx !== $valy) {
							array_push($pengarang_newcreate, $valx, $valy);
						} else {
							array_push($pengarang_update, $valx);
						}
						break 2;
					}
					// jika valx sama dengan valy simpan di pengarang update dan unset valy dari y2
					if ($valx == $valy) {
						array_push($pengarang_update, $valx);
						unset($y2[$idxy]);
						continue 2;
					}
					// jika sampai akhir tidak sama maka valx masuk ke pengarang_newcreate
					// 1. check apakah valy adalah value terakhir
					if ($valy == $lasty2) {
						// karena diatas ketika valx dan valy sama maka unset y2 diskip ke foreach pertama
						// kalau sampai sini berarti kemungkinan nilai valy dan valx berbeda
						// kemungkinan pengarang baru
						// 2. simpan valx di pengarang_newcreate
						array_push($pengarang_newcreate, $valx);
					}
				}
			}

			// pengarang_update dan pengarang_newcreate hanya berisikan index yang disimpan 
			// bukan value berupa nama pengarang
			
			// update untuk pengarang
			// jika pengarang_update ada maka update pengarang
			if (!empty($pengarang_update)) {				
				foreach ($pengarang_update as $key => $value) {
					$newidpengarang = $this->pengarang_m->search('nama', $newdt[$value], 'id');
					$oldidpengarang = $this->pengarang_m->search('nama', $olddt[$value], 'id');
					echo "<br/>";
					var_dump($newidpengarang, $oldidpengarang);
					echo "<br/>";
					$prep_pengarangupdate = array(
						'id' => $newidpengarang
					);
					$prep_conditionupdate = array(
						'idpengarang' => $oldidpengarang,
						'isbn' => $olddata->isbn
					);
					$result = $this->detpengarang_m->update($prep_conditionupdate, $prep_pengarangupdate);
					if (!$result) {
						echo "pengarang update";
						print json_encode(array($prep_pengarangupdate, $prep_conditionupdate, $result));
					}
				}
			}
			// add new pengarang untuk pengarang baru
			// jika ada penambahan pengarang baru, pengarang_newcreate tidak kosong
			if (!empty($pengarang_newcreate)) {
				foreach ($pengarang_newcreate as $key => $value) {
					$prep_newpengarang = $newdt[$value];
					$result = $this->pengarang_m->insert($prep_newpengarang);
					if ($result) {
						// bila telah memasukan pengarang baru
						// fetch idpengarang yang telah dibuat otomatis di dalam database
						// lalu masukan idpengarang dan isbn ke dalam Detailpengarang_model
						$newid = $this->pengarang_m->search('nama', $prep_newpengarang, 'id');
						// bila id beneran sudah dibuat maka bisa dimulai proses penambahan pengarang baru dan isbnnya
						if ($newid) {
							$prep_datanewdet = array(
								"idpengarang" => $newid,
								"isbn" => $olddata->isbn
							);
							$result = $this->detpengarang_m->insert($prep_datanewdet);
							if (!$result) {
								echo "terdapat kesalahan mohon menghubungi admin";
								var_dump($prep_datanewdetail, $result);
							}
						} else {
							echo "pengarang baru gagal terdaftarkan[last]";
						}
					} else {
						echo "pengarang baru gagal terdaftarkan[-1]";
					}
				}
			}
		} else {
			if ($newdata['pengarang'][0] !== $olddt->pengarang) {
				$current_pengarang = $newdata['pengarang'][0];
				$prep_datapengarang = null;
				$pengarang_exist = $this->pengarang_m->search('nama', $newdata['pengarang'][0]);
				if (!$pengarang_exist) {
					$prep_datanewpengarang = $current_pengarang;
					$result = $this->pengarang_m->insert($prep_datanewpengarang);
					// setelah mendaftar pengarang baru selanjutnya memasukkan idpengarang baru beserta isbnnya
					if ($result) {
						$newid = $this->pengarang_m->search('nama', $prep_datanewpengarang);
						if ($newid) {
								$prep_datanewdetail = array(
									'idpengarang' =>$newid,
									'isbn' => $newdata['isbn']
								);
								$result = $this->detpengarang_m->insert($prep_datanewdet);
								if (!$result) {
									echo "terjadi kesalahan saat mendaftarkan pengarang baru dengan buku";
									var_dump($prep_datanewdetail, $result);
								}
						} else {
							echo "terdapat kesalahan silahkan menghubungi admin";
							var_dump($newid);
						}
					} else {
						echo "terjadi kesalahan";
					}
				}
			}
		}
		// check if new idpenerbit matched new idpenerbit
		if ($newdata['idpenerbit'] !== $olddata->penerbit) {
			$prep_data['idpenerbit'] = $newdata['idpenerbit'];
		}
		// check if new old terbitan matched new terbitan
		if ($newdata['tahunterbit'] !== $olddata->tahun) {
			$prep_data['tahunterbit'] = $newdata['tahunterbit'];
		}

		// update info buku
		$result = $this->buku_m->update($olddata->isbn, $prep_data);
		if (!$result) {
			echo "terjadi kesalahan pada pembaharuan info buku silahkan menghubungi admin";
		} else {
			// redirect(site_url('manage-buku'));
		}
	}
**/
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