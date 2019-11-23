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
		$existing_password = $this->search('nip', $nip, 'password');
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
		$options = [
			'cost' => COST_HASHING
		];
		$hashed = password_hash($password, PASSWORD_DEFAULT, $options);
		
		$this->nip = $nip;
		$this->nama = $nama;
		$this->password = $hashed;

		return $this->insert_data();
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

	private function search_data($field, $value, $return_field)
	{
		$result_set = $this->db->get_where($this->table, array($field => $value))->result();
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

		// $result = $this->db->set($data)->get_compiled_insert($this->table);
		$result = $this->db->insert($this->table, $data);
		return $result;
	}
}