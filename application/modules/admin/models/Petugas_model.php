<?php
/**
 * 
 */
class Petugas_model extends CI_Model
{
	// variabel menampung nama tabel database
	private $table = 'petugas';

	private $nip = null;
	private $nama = null;
	private $password = null;

	// variabel menampung nama field/atribut
	private $field_nip = "nip";
	private $field_nama = "nama_petugas";
	private $field_password = "password";

	// variabel menampung nama baru (altering) field/atribut
	private $newprop_nip = "nip";
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
			case $this->field_nip:
				return $this->nip;
				break;
			case $this->field_nama:
				return $this->nama;
				break;
			case $this->field_password:
				return $this->password;
				break;
			
			default:
				return array(
					$this->newprop_nip => $this->nip,
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

	public function verify($nip, $password)
	{	
		$existing_password = $this->search_data($this->field_nip, $nip, $this->field_password);
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

	public function search($field_alias, $search_value, $returnfield_alias = null)
	{
		$searchfield = null;
		$returnfield = null;

		switch ($field_alias) {
			case $this->newprop_nip:
				$searchfield = $this->field_nip;
				break;
			case $this->newprop_nama:
				$searchfield = $this->field_nama;
				break;
			
			default:
				return null;
				break;
		}

		switch ($returnfield_alias) {
			case $this->newprop_nip:
				$returnfield = $this->field_nip;
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

		return $this->search_data($searchfield, $search_value, $returnfield);
	}

	public function insert($nip, $nama, $password)
	{
		$hashed = password_hash($password, PASSWORD_DEFAULT, $this->options);
		
		$this->nip = $nip;
		$this->nama = $nama;
		$this->password = $hashed;

		return $this->insert_data();
	}

	public function update($nip, $newdata)
	{
		$existing_nip = $this->search_data($this->field_nip, $nip);
		if ($existing_nip) {
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

	public function delete($nip)
	{
		$this->nisn = $nip;
		$existing_nip = $this->search_data($this->field_nip, $nip);
		if ($existing_nip) {
			return $this->delete_data();
		} else {
			return null;
		}
	}
	// end represent

	/**
	 * mengambil semua data dari tabel buku dengan nama atribut/field yang telah diubah
	 * @return array [description]
	 */
	private function all()
	{
		$result_set = $this->db->get($this->table)->result();
		$data = array();
		foreach ($result_set as $key => $value) {
			$this->nip = $value->{$this->field_nip};
			$this->nama = $value->{$this->field_nama};
			$this->password = $value->{$this->field_password};
			$data[] = $this->reconstruct();
		}
		return $data;
	}

	private function search_data($field, $value, $return_field = null)
	{
		$result_set = $this->db->get_where($this->table, array($field => $value))->result();
		var_dump($field, $value);
		if ($result_set) {
			foreach ($result_set as $key => $value) {
				$this->nip = $value->{$this->field_nip};
				$this->nama = $value->{$this->field_nama};
				$this->password = $value->{$this->field_password};
			}
			return $this->reconstruct($return_field);
		}
	}

	private function insert_data()
	{
		$data = array(
			$this->field_nip => $this->nip,
			$this->field_nama => $this->nama,
			$this->field_password => $this->password
		);

		$result = $this->db->insert($this->table, $data);
		return $result;
	}
	
	private function update_data($newdata)
	{
		return $this->db->update($this->table, $newdata, array($this->field_nip => $this->nip));
	}

	private function delete_data()
	{
		$data = array(
			$this->field_nip => $this->nip
		);
		return $this->db->delete($this->table, array($this->field_nip => $this->nip));
	}
}