<?php
/**
 * 
 */
class Detailpeminjaman_model extends CI_Model
{

	// variabel menampung nama tabel database
	private $table = 'detail_peminjaman';

	private $id = null;
	private $idbuku = null;
	private $idpeminjaman = null;

	// variabel menampung nama field/atribut
	private $field_id = "id";
	private $field_idbuku = "id_buku";
	private $field_idpeminjaman = "id_peminjaman";

	// variabel menampung nama baru (altering) field/atribut
	private $newprop_id = "id";
	private $newprop_idbuku = "idbuku";
	private $newprop_idpeminjaman = "idpeminjaman";

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
			case $this->field_idbuku:
				return $this->idbuku;
				break;
			case $this->field_idpeminjaman:
				return $this->idpeminjaman;
				break;
			
			default:
				return array(
					$this->newprop_id => $this->id,
					$this->newprop_idbuku => $this->idbuku,
					$this->newprop_idpeminjaman => $this->idpeminjaman
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
			$this->idbuku = $value->{$this->field_idbuku};
			$this->idpeminjaman = $value->{$this->field_idpeminjaman};
			$data[] = $this->reconstruct();
		}
		return $data;
	}

	// end start
}