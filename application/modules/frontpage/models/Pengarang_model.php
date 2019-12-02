<?php
/**
 * 
 */
class Pengarang_model extends CI_Model
{
	private $table = 'pengarang';

	private $id = null;
	private $nama = null;

	private $field_id = 'id_pengarang';
	private $field_nama = 'nama_pengarang';

	private $alias_id = 'id';
	private $alias_nama = 'nama';

	function __construct()
	{
		parent::__construct();
	}

	private function reconstruct($returnfield = null)
	{
		switch ($returnfield) {
			case $this->field_id:
				return $this->id;
				break;

			case $this->field_nama:
				return $this->nama;
				break;
			
			default:
				return array(
					$this->alias_id => $this->id,
					$this->alias_nama => $this->nama
				);
				break;
		}
	}

	// start represent
	public function get_all()
	{
		return $this->all();
	}

	public function search($field_alias, $value, $returnfield_alias = null)
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
			
			default:
				$returnfield = null;
				break;
		}

		return $this->search_data($field, $value, $returnfield);
	}
	// end represent
	
	// start query
	private function all()
	{
		$result_set = $this->db->get($this->table)->result();
		$data = array();
		foreach ($result_set as $key => $value) {
			$this->id = $value->{$this->field_id};
			$this->nama = $value->{$this->field_nama};
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
				$data[] = $this->reconstruct($returnfield);
			}
			return $data;
		} else {
			return null;
		}
	}
	// end query
}