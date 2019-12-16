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
		if ($list_idpengarang) {
			foreach ($list_idpengarang as $key => $value) {
				$list_pengarang[] = $this->pengarang_m->search('id', $value, 'nama')[0];
			}
			return $list_pengarang;
		} else {
			echo "ada kesalahan silahkan menghubungi admin";
			var_dump($list_idpengarang);
		}
	}

	public function insert($newdata)
	{
		$this->idpengarang = $newdata[$this->alias_idpengarang];
		$this->isbn = $newdata[$this->alias_isbn];

		return $this->insert_data();
	}

	public function update($conditions, $newdata)
	{
		$this->idpengarang = $conditions[$this->alias_idpengarang];
		$this->isbn = $conditions[$this->alias_isbn];

		$prep_data = null;
		if (isset($newdata[$this->alias_idpengarang])) {
			$prep_data[$this->field_idpengarang] = $newdata[$this->alias_idpengarang];
		}
		if (isset($newdata[$this->alias_isbn])) {
			$prep_data[$this->field_isbn] = $newdata[$this->alias_isbn];
		}

		var_dump($prep_data, $this->idpengarang, $this->isbn);

		// return $this->update_data($prep_data);
	}

	public function delete($isbn)
	{
		$this->isbn = $isbn;
		return $this->delete_data();
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

	private function insert_data()
	{
		$prep_data = array(
			$this->field_idpengarang => $this->idpengarang,
			$this->field_isbn => $this->isbn
		);
		return $this->db->insert($this->table, $prep_data);
	}

	public function update_data($newdata)
	{
		// UPDATE `detail_pengarangbuku` SET `id_pengarang`='2' WHERE `id_pengarang` = '1' AND `isbn` = '5010580803133' 
		$prep_conditions = array(
			$this->field_idpengarang => $this->idpengarang,
			$this->field_isbn => $this->isbn
		);

		return $this->db->update($this->table, $newdata, $prep_conditions);
	}

	private function delete_data()
	{
		return $this->db->delete($this->table, array($this->field_isbn => $this->isbn));
	}
	// end query
}