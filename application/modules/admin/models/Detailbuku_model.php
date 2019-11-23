<?php
/**
 * 
 */
class Detailbuku extends CI_Model
{
	// variabel menampung nama tabel database
	private $table = 'detail_buku';

	// variabel menampung nilai field/atribut
	private $isbn = null;
	private $idpenerbit = null;
	private $judul = null;
	private $pengarang = null;

	// variabel menampung nama field/atribut
	private $field_isbn = "isbn";
	private $field_idpenerbit = "id_penerbit";
	private $field_judul = "judul";
	private $field_pengarang = "pengarang";

	// variabel menampung nama baru (altering) field/atribut 
	private $newprop_isbn = "isbn";
	private $newprop_idpenerbit = "idpenerbit";
	private $newprop_judul = "judul";
	private $newprop_pengarang = "pengarang";

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
			case $this->field_isbn:
				return $this->isbn;
				break;
			case $this->field_idpenerbit:
				return $this->idpenerbit;
				break;
			case $this->field_judul:
				return $this->judul;
				break;
			case $this->field_pengarang:
				return $this->pengarang;
				break;
			
			default:
				return array(
					$this->newprop_isbn => $this->isbn,
					$this->newprop_idpenerbit => $this->idpenerbit,
					$this->newprop_judul => $this->judul,
					$this->newprop_pengarang => $this->pengarang
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
			$this->isbn = $value->{$this->field_isbn};
			$this->idpenerbit = $value->{$this->field_idpenerbit};
			$this->judul = $value->{$this->field_judul};
			$this->pengarang = $value->{$this->field_pengarang};
			$data[] = $this->reconstruct();
		}
		return $data;
	}
	// end query
}