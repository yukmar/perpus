<?php
/**
 * 
 */
class Buku_model extends CI_Model
{
	// variabel menampung nama tabel database
	private $table = 'buku';

	// variabel menampung nilai field/atribut
	private $id = null;
	private $isbn = null;
	private $terbit = null;
	private $harga = null;
	private $tgl_beli = null;

	// variabel menampung nama field/atribut
	private $field_id = "id_buku";
	private $field_isbn = "isbn";
	private $field_terbit = "tahun_terbit";
	private $field_harga = "harga";
	private $field_tgl_beli = "tgl_pembelian";

	// variabel menampung nama baru (altering) field/atribut 
	private $newprop_id = "id";
	private $newprop_isbn = "isbn";
	private $newprop_terbit = "terbit";
	private $newprop_harga = "harga";
	private $newprop_tgl_beli = "tgl_beli";

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
			case $this->field_isbn:
				return $this->isbn;
				break;
			case $this->field_terbit:
				return $this->terbit;
				break;
			case $this->field_harga:
				return $this->harga;
				break;
			case $this->field_tgl_beli:
				return $this->tgl_beli;
				break;
			
			default:
				return array(
					$this->newprop_id => $this->id,
					$this->newprop_isbn => $this->isbn,
					$this->newprop_terbit => $this->terbit,
					$this->newprop_harga => $this->harga,
					$this->newprop_tgl_beli => $this->tgl_beli
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
		$result_set = $this->db->get($this->table);
		$data = array();
		foreach ($result_set as $key => $value) {
			$this->id = $value->{$this->field_id};
			$this->isbn = $value->{$this->field_isbn};
			$this->terbit = $value->{$this->field_terbit};
			$this->harga = $value->{$this->field_harga};
			$this->tgl_beli = $value->{$this->field_tgl_beli};
			$data[] = $this->reconstruct();
		}
		return $data;
	}
	// end query
}