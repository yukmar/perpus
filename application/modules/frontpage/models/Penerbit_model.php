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
	private $alias_id = "id";
	private $alias_nama = "nama";
	private $alias_kota = "kota";

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
					$this->alias_id => $this->id,
					$this->alias_nama => $this->nama,
					$this->alias_kota => $this->kota
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
			case $this->alias_nama:
				$field = $this->field_nama;
				break;
				case $this->alias_kota:
				$field = $this->field_kota;
				break;
			
			default:
				return null;
				break;
		}

		switch ($returnfield_alias) {
			case $this->alias_id:
				$returnfield = $this->field_id;
				break;
			case $this->alias_nama:
				$returnfield = $this->field_nama;
				break;
			case $this->alias_kota:
				$returnfield = $this->field_kota;
				break;
			
			default:
				$returnfield = null;
				break;
		}

		return $this->search_data($field, $search_value, $returnfield);
	}

	public function insert($nama, $kota)
	{
		$this->nama = $nama;
		$this->kota = $kota;

		return $this->insert_data();
	}

	public function update($id, $newdata)
	{
		$this->id = $id;
		$prepdata = array(
			$this->field_nama => $newdata[$this->alias_nama],
			$this->field_kota => $newdata[$this->alias_kota]
		);
		return $this->update_data($prepdata);
	}

	public function delete($id)
	{
		$this->id = $id;
		return $this->delete_data();
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
			$this->nama = $value->{$this->field_nama};
			$this->kota = $value->{$this->field_kota};
			$data[] = $this->reconstruct();
		}
		return $data;
	}

	private function search_data($field, $value, $returnfield = null)
	{
		$result_set = $this->db->get_where($this->table, array($field => $value))->result();
		if ($result_set) {
			$data = array();
			foreach ($result_set as $key => $value) {
				$this->id = $value->{$this->field_id};
				$this->nama = $value->{$this->field_nama};
				$this->kota = $value->{$this->field_kota};
				$data[] = $this->reconstruct($returnfield);
			}
			return $data;
		} else {
			return null;
		}
	}

	private function insert_data()
	{
		$newdata = array(
			$this->field_nama => $this->nama,
			$this->field_kota => $this->kota
		);
		return $this->db->insert($this->table, $newdata);
	}

	private function update_data($newdata)
	{
		return $this->db->update($this->table, $newdata, array($this->field_id => $this->id));
	}

	private function delete_data()
	{
		return $this->db->delete($this->table, array($this->field_id => $this->id));
	}
	// end query
}