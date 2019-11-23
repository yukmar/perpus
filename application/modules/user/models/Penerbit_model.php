<?php
/**
 * 
 */
class Penerbit_model extends CI_Model
{
	// variabel menampung nama tabel database
	private $table = 'penerbit';

	private $id = null;
	private $nama = null;
	private $kota = null;

	// variabel menampung nama field/atribut
	private $field_id = "id_penerbit";
	private $field_nama = "nama_penerbit";
	private $field_kota = "kota";

	// variabel menampung nama baru (altering) field/atribut
	private $newprop_id = "id";
	private $newprop_nama = "nama";
	private $newprop_kota = "kota";

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
			case $this->field_nama:
				return $this->nama;
				break;
			case $this->field_kota:
				return $this->kota;
				break;
			
			default:
				return array(
					$this->newprop_id => $this->id,
					$this->newprop_nama => $this->nama,
					$this->newprop_kota => $this->kota
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
			$this->nama = $value->{$this->field_nama};
			$this->kota = $value->{$this->field_kota};
			$data[] = $this->reconstruct();
		}
		return $data;
	}
	// end query
}