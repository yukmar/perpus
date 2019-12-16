<?php
/**
 * 
 */
class Peminjaman_model extends CI_Model
{
	// variabel menampung nama tabel database
	private $table = 'peminjaman';

	private $id = null;
	private $nis = null;
	private $nip = null;
	private $tglpeminjaman = null;
	private $tglbatas = null;

	// variabel menampung nama field/atribut
	private $field_id = "id_peminjaman";
	private $field_nis = "nis";
	private $field_nip = "nip";
	private $field_tglpeminjaman = "tgl_peminjaman";
	private $field_tglbatas = "tgl_batas_peminjaman";

	// variabel menampung nama baru (altering) field/atribut
	private $newprop_id = "id";
	private $newprop_nis = "nis";
	private $newprop_nip = "nip";
	private $newprop_tglpeminjaman = "tglpeminjaman";
	private $newprop_tglbatas = "tglbatas";

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * method untuk merekonstruksi data dengan merubah nama atribut dengan nama atribut baru
	 * @param  string $field nama field/atribut
	 * @return string        single / satu string
	 * @return array 				 satu set row data dengan format nama field baru berasosiasi dengan nilai target
	 */
	private function reconstruct($field = null)
	{
		switch ($field) {
			case $this->field_id:
				return $this->id;
				break;
			case $this->field_nis:
				return $this->nis;
				break;
			case $this->field_nip:
				return $this->nip;
				break;
			case $this->field_tglpeminjaman:
				return $this->tglpeminjaman;
				break;
			case $this->field_tglbatas:
				return $this->tglbatas;
				break;
			
			default:
				return array(
					$this->newprop_id => $this->id,
					$this->newprop_nis => $this->nis,
					$this->newprop_nip => $this->nip,
					$this->newprop_tglpeminjaman => $this->tglpeminjaman,
					$this->newprop_tglbatas => $this->tglbatas
				);
				break;
		}
	}

	// start query
	/**
	 * mengambil semua data dari tabel buku dengan nama atribut/field yang telah diubah
	 * @return array [description]
	 */
	private function all()
	{
		$result_set = $this->db->get($this->table)->result();
		$data = array();
		foreach ($result_set as $key => $value) {
			$this->id = $value->{$this->field_id};
			$this->nis = $value->{$this->field_nis};
			$this->nip = $value->{$this->field_nip};
			$this->tglpeminjaman = $value->{$this->field_tglpeminjaman};
			$this->tglbatas = $value->{$this->field_tglbatas};
			$data[] = $this->reconstruct();
		}
	}
	// end query
}