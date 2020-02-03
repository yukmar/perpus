<?php
/**
 * 
 */
class Kelas_model extends CI_Model
{
	private $table = 'kelas';

	private $id = null;
	private $nama = null;

	private $field_id = 'id_kelas';
	private $field_nama = 'nama_kelas';

	private $alias_id = 'id';
	private $alias_nama = 'nama';

	private function reconstruct($field = null)
	{
		switch ($field) {
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

	public function search($search_aliasfield, $search_value, $return_aliasfield = null)
	{
		$field = null;
		$returnfield = null;

		switch ($search_aliasfield) {
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

		switch ($return_aliasfield) {
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

		$search_data = array(
			$field => $search_value
		);

		return $this->search_data($search_data, $returnfield);
	}

	public function insert($newdata)
	{
		$this->nama = $newdata;

		return $this->insert_data();
	}

	public function update($id, $newdata)
	{
		$prep_data = array();
		if (isset($newdata[$this->alias_id])) {
			$prep_data[$this->field_id] = $newdata[$this->alias_id];
		}
		if (isset($newdata[$this->alias_nama])) {
			$prep_data[$this->field_nama] = $newdata[$this->alias_nama];
		}

		return $this->update_data($id, $prep_data);
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
		$q = $this->db->select("k.id_kelas, k.nama_kelas, count(s.id_kelas) as total")
									->from("kelas k")
									->join("siswa s", "k.id_kelas = s.id_kelas", "left")
									->group_by("k.id_kelas");
		$result = $q->get()->result();
		$data = array();
		foreach ($result as $key => $value) {
			$this->id = $value->{$this->field_id};
			$this->nama = $value->{$this->field_nama};
			$data[$key] = $this->reconstruct();
			$data[$key]['total'] = $value->total;
		}
		return $data;
	}

	private function search_data($search_data, $returnfield = null)
	{
		$result = $this->db->get_where($this->table, $search_data)->result();
		if ($result) {
			$data = array();
			foreach ($result as $key => $value) {
				$this->id = $value->{$this->field_id};
				$this->nama = $value->{$this->field_nama};
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
			$this->field_id => $this->id,
			$this->field_nama => $this->nama
		);

		$result = $this->db->insert($this->table, $prep_data);
	}

	private function update_data($id, $newdata)
	{
		$result = $this->db->update($this->table, $newdata, array($this->field_id => $id));
		return $result;
	}

	private function delete_data()
	{
		$result = $this->db->delete($this->table, array($this->field_id => $this->id));
	}
	// end query
}