<?php
/**
 * 
 */
class Siswa_model extends CI_Model
{
	// variabel menampung nama tabel database
	private $table = 'siswa';

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

	private $options = [
		'cost' => COST_HASHING
	];

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
					$this->newprop_nisn => $this->nisn,
					$this->newprop_nama => $this->nama,
					$this->newprop_password => $this->password
				);
				break;
		}
	}

	// start represent
	public function get_all()
	{
		return $this->all();
	}

	public function verify($nisn, $password)
	{
		$existing_password = $this->search($this->field_nisn, $nisn, $this->field_password);
		if ($existing_password) {
			if (password_verify($password, $existing_password)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function search($search_field, $value, $return_field = null)
	{
		$field = null;
		$returnfield = null;
		switch ($search_field) {
			case $this->newprop_nisn:
				$field = $this->field_nisn;
				break;
				case $this->newprop_nama:
				$field = $this->field_nama;
				break;
			
			default:
				return null;
				break;
		}
		switch ($return_field) {
			case $this->newprop_nisn:
				$returnfield = $this->field_nisn;
				break;
			case $this->newprop_nama:
				$returnfield = $this->field_nama;
				break;
			case $this->newprop_password:
				$returnfield = $this->field_password;
				break;
			
			default:
				$returnfield = null;
				break;
		}
		return $this->search_data($field, $value, $returnfield);
	}

	public function insert($nisn, $nama, $password)
	{
		$hashed = password_hash($password, PASSWORD_DEFAULT, $this->options);
		
		$this->nisn = ($nisn) ? $nisn : null ;
		$this->nama = ($nama) ? $nama : null ;
		$this->password = $hashed;

		return $this->insert_data();
	}

	public function update($nisn, $newdata)
	{
		$existing_nisn = $this->search_data($this->field_nisn, $nisn);
		if ($existing_nisn) {
			$prep_newdata = array(
				$this->field_nama => $newdata[$this->newprop_nama]
			);
			if ($newdata[$this->newprop_password]) {
				$prep_newdata = array_merge($prep_newdata, array(
					$this->field_password => password_hash(
						$newdata[$this->newprop_password],
						PASSWORD_DEFAULT,
						$this->options
					)
				)
			);
			}
			return $this->update_data($prep_newdata);
		} else {
			return null;
		}
	}

	public function delete($nisn)
	{
		$this->nisn = $nisn;
		$existing_nisn = $this->search_data($this->field_nisn, $nisn);
		if ($existing_nisn) {
			return $this->delete_data();
		} else {
			return null;
		}
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
			$this->nisn = $value->{$this->field_nisn};
			$this->nama = $value->{$this->field_nama};
			$this->password = $value->{$this->field_password};
			$data[] = $this->reconstruct();
		}
		return $data;
	}

	private function search_data($field, $search_value, $returnfield = null)
	{
		$result_set = $this->db->get_where($this->table, array($field => $search_value))->result();
		if ($result_set) {
			foreach ($result_set as $key => $value) {
				$this->nisn = $value->{$this->field_nisn};
				$this->nama = $value->{$this->field_nama};
				$this->password = $value->{$this->field_password};
			}
			return $this->reconstruct($returnfield);
		} else {
			return null;
		}
	}

	private function insert_data()
	{
		$data = array(
			$this->field_nisn => $this->nisn,
			$this->field_nama => $this->nama,
			$this->field_password => $this->password
		);

		// $result = $this->db->set($data)->get_compiled_insert($this->table);
		$result = $this->db->insert($this->table, $data);
		return $result;
	}

	private function update_data($newdata)
	{
		return $this->db->update($this->table, $newdata, array($this->field_nisn => $this->nisn));
	}

	private function delete_data()
	{
		$data = array(
			$this->field_nisn => $this->nisn
		);

		return $this->db->delete($this->table, array($this->field_nisn => $this->nisn));

	}
	// end query
}