<?php
/**
 * 
 */
class Detailpengarang_model extends CI_Model
{
	private $table = 'detail_pengarangbuku';

	private $idpengarang = null;
	private $isbn = null;

	private $field_idpengarang = 'id_pengarang';
	private $field_isbn = 'isbn';

	private $alias_idpengarang = 'idpengarang';
	private $alias_isbn = 'isbn';

	function __construct()
	{
		parent::__construct();
		$this->load->model('Pengarang_model', 'pengarang_m');
	}

	private function reconstruct($returnfield = null)
	{
		switch ($returnfield) {
			case $this->field_idpengarang:
				return $this->idpengarang;
				break;

				case $this->field_isbn:
				return $this->isbn;
				break;

			default:
				return array(
					$this->alias_idpengarang => $this->idpengarang,
					$this->alias_isbn => $this->isbn
				);
				break;
		}
	}

	// start represent
	public function get_all()
	{
		return $this->all();
	}

	public function search($field_alias, $value, $returnfield_alias)
	{
		$field = null;
		$returnfield = null;

		switch ($field_alias) {
			case $this->alias_idpengarang:
				$field = $this->field_idpengarang;
				break;

				case $this->alias_isbn:
				$field = $this->field_isbn;
				break;

			default:
				return null;
				break;
		}

		switch ($returnfield_alias) {
			case $this->alias_idpengarang:
				$returnfield = $this->field_idpengarang;
				break;

			case $this->alias_isbn:
				$returnfield = $this->field_isbn;
				break;
			
			default:
				$returnfield = null;
				break;
		}

		return $this->search_data($field, $value, $returnfield);
	}

	public function get_set($isbn)
	{
		$list_idpengarang = $this->search_data($this->field_isbn, $isbn, $this->field_idpengarang);
		$list_pengarang = array();
		foreach ($list_idpengarang as $key => $value) {
			$list_pengarang[] = $this->pengarang_m->search('id', $value, 'nama')[0];
		}
		return $list_pengarang;
	}
	// end represent
	
	// start query
	private function all()
	{
		$result_set = $this->db->get($this->table)->result();
		$data = array();
		foreach ($result_set as $key => $value) {
			$this->idpengarang = $value->{$this->field_idpengarang};
			$this->isbn = $value->{$this->field_isbn};
			$data[] = $this->reconstruct();
		}
		return $data;
	}

	private function search_data($field, $value, $returnfield)
	{
		$result_set = $this->db->get_where($this->table, array($field => $value))->result();
		if ($result_set) {
			$data = array();
			foreach ($result_set as $key => $value) {
				$this->idpengarang = $value->{$this->field_idpengarang};
				$this->isbn = $value->{$this->field_isbn};
				$data[] = $this->reconstruct($returnfield);
			}
			return $data;
		} else {
			return null;
		}
	}
	// end query
}