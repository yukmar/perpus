<?php
/**
 * 
 */
class Pengarang_model extends CI_Model
{
	private $table = 'pengarang';
	private $tabletotal = 'pengarang_bukutotal';

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
		$this->nama = preg_replace("/_/", " ", $this->nama);
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

	public function insert($newdata)
	{
		$existnama = $this->search_data($this->field_nama, $newdata);
		if (!$existnama) {
			$this->nama = preg_replace("/ /", "_", (ucwords($newdata)));
			return $this->insert_data();
		} else {
			return null;
		}
	}

	public function update($newdata)
	{
		$this->id = $newdata[$this->alias_id];
		return $this->update_data($newdata);
	}

	public function delete($id)
	{
		$this->id = $id;
		return $this->delete_data();
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
		$result_set = null;
		if ($field == $this->field_nama) {
			$firstname = strtolower(preg_replace("/ /", "_", $value));
			// $firstname = strtolower((explode(" ", $value))[0]);
			// $result_set = $this->db->like($this->field_nama, $firstname, 'after')->get($this->table)->result();
			$result_set = $this->db->get_where($this->table, array($this->field_nama => $firstname))->result();
			if ($result_set) {
				$value = preg_replace("/ /", "_", (ucwords($result_set[0]->{$this->field_nama})));
				$result_match = array();
				if (count($result_set) == 1) {
					foreach ($result_set as $key => $value) {
						$this->id = $value->{$this->field_id};
						$this->nama = $value->{$this->field_nama};
						$result_match[] = $this->reconstruct($returnfield);
					}
				} else {
					foreach ($result_set as $key => $valueresult) {
						$nama_pengarang = strtolower(preg_replace("/[^a-zA-Z]/", "", $valueresult->{$this->field_nama}));
						if ($nama_pengarang == $value) {
							$this->id = $valueresult->{$this->field_id};
							$this->nama = $valueresult->{$this->field_nama};
							$result_match[] = $this->reconstruct($returnfield);
						}
					}
				}
				return $result_match;
			} else {
				return null;
			}
		} else {
			$result_set = $this->db->get_where($this->table, array($field => $value))->result();
			if ($result_set) {
				$data = array();
				foreach ($result_set as $key => $value) {
					$this->id = $value->{$this->field_id};
					$this->nama = preg_replace("/_/", " ", $value->{$this->field_nama});
					$data[] = $this->reconstruct($returnfield);
				}
				return $data;
			} else {
				return null;
			}
		}
	}

	private function insert_data()
	{
		$prep_data = array(
			$this->field_nama => $this->nama
		);
		return $this->db->insert($this->table, $prep_data);
	}

	private function update_data($newdata)
	{
		$prep_data = array(
			$this->field_id => $newdata[$this->alias_id],
			$this->field_nama => $newdata[$this->alias_nama]
		);
		return $this->db->update($this->table, $prep_data, array($this->field_id => $this->id));
	}

	private function delete_data()
	{
		return $this->db->delete($this->table, array($this->field_id => $this->id));
	}

	public function all_total()
	{
		$result = $this->db->get($this->tabletotal)->result();
		$data = array();
		foreach ($result as $key => $value) {
			$this->id = $value->id;
			$this->nama = $value->pengarang;
			$data[$key] = $this->reconstruct();
			$data[$key]['total'] = $value->total;
		}
		return $data;
	}
	// end query
}