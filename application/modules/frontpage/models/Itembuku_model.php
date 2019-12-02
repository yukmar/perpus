<?php
/**
 * 
 */
class Itembuku_model extends CI_Model
{
	// variabel menampung nama tabel database
	private $table = 'item_buku';

	// variabel menampung nilai field/atribut
	private $id = null;
	private $isbn = null;
	private $harga = null;
	private $tgl_beli = null;

	// variabel menampung nama field/atribut
	private $field_id = "id_buku";
	private $field_isbn = "isbn";
	private $field_harga = "harga";
	private $field_tgl_beli = "tgl_pembelian";

	// variabel menampung nama baru (altering) field/atribut 
	private $alias_id = "id";
	private $alias_isbn = "isbn";
	private $alias_harga = "harga";
	private $alias_tgl_beli = "tgl_beli";

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
			case $this->field_harga:
				return $this->harga;
				break;
			case $this->field_tgl_beli:
				return $this->tgl_beli;
				break;
			
			default:
				return array(
					$this->alias_id => $this->id,
					$this->alias_isbn => $this->isbn,
					$this->alias_harga => $this->harga,
					$this->alias_tgl_beli => $this->tgl_beli
				);
				break;
		}
	}

	// start represent
	public function get_all()
	{
		return $this->all();
	}

	public function search($field_alias, $search_value, $returnfield_alias = null)
	{
		$field = null;
		$returnfield = null;

		switch ($field_alias) {
			case $this->alias_id:
				$field = $this->field_id;
				break;

			case $this->alias_isbn :
				$field = $this->field_isbn ;
				break;

			case $this->alias_harga:
				$field = $this->field_harga;
				break;

			case $this->alias_tgl_beli:
				$field = $this->field_tgl_beli;
				break;

			default:
				return null;
				break;
		}

		switch ($returnfield_alias) {
			case $this->alias_id:
				$returnfield = $this->field_id;
				break;
			case $this->alias_isbn :
				$returnfield = $this->field_isbn ;
				break;
			case $this->alias_harga:
				$returnfield = $this->field_harga;
				break;
			case $this->alias_tgl_beli:
				$returnfield = $this->field_tgl_beli;
				break;
			default:
				$returnfield = null;
				break;
		}

		return $this->search_data($field, $search_value, $returnfield);
	}

	public function insert($newdata)
	{
		$this->id = $newdata[$this->alias_id];
		$this->isbn = $newdata[$this->alias_isbn];
		$this->harga = $newdata[$this->alias_harga];
		$this->tgl_beli = $newdata[$this->alias_tgl_beli];

		return $this->insert_data();
	}

	public function count($field_alias = null, $value= null)
	{
		$field = null;
		switch ($field_alias) {
			case $this->alias_id:
				$field = $this->field_id;
				break;

			case $this->alias_isbn :
				$field = $this->field_isbn ;
				break;

			case $this->alias_harga:
				$field = $this->field_harga;
				break;

			case $this->alias_tgl_beli:
				$field = $this->field_tgl_beli;
				break;

			default:
				$field = null;
				break;
		}
		return $this->count_data($field, $value);
	}
	
	// end represent

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
			$this->isbn = $value->{$this->field_isbn};
			$this->harga = $value->{$this->field_harga};
			$this->tgl_beli = $value->{$this->field_tgl_beli};
			$data[] = $this->reconstruct();
		}
		return $data;
	}

	private function search_data($field, $value, $returnfield = null)
	{
		$result_set = $this->db->get_where($this->table, array($field => $value))->result();
		if ($result_set) {
			foreach ($result_set as $key => $value) {
				$this->id = $value->{$this->field_id};
				$this->isbn  = $value->{$this->field_isbn };
				$this->harga = $value->{$this->field_harga};
				$this->tgl_beli = $value->{$this->field_tgl_beli};
			}
			return $this->reconstruct($returnfield);
		} else {
			return null;
		}
	}

	private function insert_data()
	{
		$newdata = array(
			$this->field_id => $this->id,
			$this->field_isbn => $this->isbn,
			$this->field_harga => $this->harga,
			$this->field_tgl_beli => $this->tgl_beli
		);
		return $this->db->insert($this->table, $newdata);
	}

	public function count_data($field = null, $value = null)
	{
		if ($value) {
			return $this->db->get_where($this->table, array($field => $value))->num_rows();
		} else {
			return $this->db->count_all($this->table);
		}
	}
	// end query
}