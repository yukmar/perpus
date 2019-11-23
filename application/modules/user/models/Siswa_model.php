<?php
/**
 * 
 */
class Siswa_model extends CI_Model
{
	// variabel menampung nama tabel database
	private $$table = 'siswa';

	private $nisn = null;
	private $nama = null;
	private $password = null;

	// variabel menampung nama field/atribut
	private $field_nisn = "nisn";
	private $field_nama = "nama_siswa";
	private $field_password = "password";

	// variabel menampung nama baru (altering) field/atribut
	private $newprop_nisn = "nisn";
	private $newprop_nama = "nama";
	private $newprop_password = "password";

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
			case $this->field_nisn:
				return $this->nisn;
				break;
			case $this->field_nama:
				return $this->nama;
				break;
			case $this->field_password:
				return $this->password;
				break;
			
			default:
				return array(
					$this->newprop_nisn = $this->nisn,
					$this->newprop_nama = $this->nama,
					$this->newprop_password = $this->password
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
			$this->nisn = $value->{$this->field_nisn};
			$this->nama = $value->{$this->field_nama};
			$this->password = $value->{$this->field_password};
			$data[] = $this->reconstruct();
		}
		return $data;
	}
	// end query
}