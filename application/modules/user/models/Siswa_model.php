<?php
/**
 * 
 */
class Siswa_model extends CI_Model
{
	// variabel menampung nama tabel database
	private $table = 'siswa';
	private $history = 'history_itembuku';

	private $nis = null;
	private $nama = null;
	private $idkelas = null;
	private $password = null;

	// variabel menampung nama field/atribut
	private $field_nis = "nis";
	private $field_nama = "nama_siswa";
	private $field_idkelas = "id_kelas";
	private $field_password = "password";

	// variabel menampung nama baru (altering) field/atribut
	private $alias_nis = "nis";
	private $alias_nama = "nama";
	private $alias_idkelas = "idkelas";
	private $alias_password = "password";

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
			case $this->field_nis:
				return $this->nis;
				break;
			case $this->field_nama:
				return $this->nama;
				break;
			case $this->field_password:
				return $this->password;
				break;
			case $this->field_idkelas:
				return $this->idkelas;
			
			default:
				return array(
					$this->alias_nis => $this->nis,
					$this->alias_nama => $this->nama,
					$this->alias_idkelas => $this->idkelas,
					$this->alias_password => $this->password
				);
				break;
		}
	}

	// start represent
	public function get_all()
	{
		return $this->all();
	}

	public function verify($nis, $password)
	{
		$existing_password = $this->search($this->field_nis, $nis, $this->field_password);
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
			case $this->alias_nis:
				$field = $this->field_nis;
				break;
			case $this->alias_nama:
				$field = $this->field_nama;
				break;
			case $this->alias_idkelas:
				$field = $this->field_idkelas;
				break;
			
			default:
				return null;
				break;
		}
		switch ($return_field) {
			case $this->alias_nis:
				$returnfield = $this->field_nis;
				break;
			case $this->alias_nama:
				$returnfield = $this->field_nama;
				break;
			case $this->alias_password:
				$returnfield = $this->field_password;
				break;
			case $this->alias_idkelas:
				$returnfield = $this->field_idkelas;
				break;
			
			default:
				$returnfield = null;
				break;
		}
		return $this->search_data($field, $value, $returnfield);
	}

	public function insert($nis, $nama, $idkelas, $password)
	{
		$hashed = password_hash($password, PASSWORD_DEFAULT, $this->options);
		
		$this->nis = ($nis) ? $nis : null ;
		$this->nama = ($nama) ? $nama : null ;
		$this->password = $hashed;
		$this->idkelas = $idkelas;

		return $this->insert_data();
	}

	public function update($nis, $newdata)
	{
		$prep_newdata = array();
		$existing_nis = $this->search_data($this->field_nis, $nis);
		if ($existing_nis) {
			if (isset($newdata[$this->alias_nama])) {
				$prep_newdata[$this->field_nama] = $newdata[$this->alias_nama];
			}
			if (isset($newdata[$this->alias_idkelas])) {
				$prep_newdata[$this->field_idkelas] = $newdata[$this->alias_idkelas];
			}
			if ($newdata[$this->alias_password]) {
				$prep_newdata = array_merge($prep_newdata, array(
					$this->field_password => password_hash(
						$newdata[$this->alias_password],
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

	public function delete($nis)
	{
		$this->nis = $nis;
		$existing_nis = $this->search_data($this->field_nis, $nis);
		if ($existing_nis) {
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
			$this->nis = $value->{$this->field_nis};
			$this->nama = $value->{$this->field_nama};
			$this->idkelas = $value->{$this->field_idkelas};
			$this->password = $value->{$this->field_password};
			$data[] = $this->reconstruct();
		}
		return $data;
	}

	private function search_data($field, $search_value, $returnfield = null)
	{
		$q = $this->db->select("s.nis, s.nama_siswa, s.password, k.id_kelas, k.nama_kelas")
									->from("siswa s")
									->join("kelas k", "s.id_kelas = k.id_kelas",'left');
		$result_set = $q->get_where($this->table, array('s.nis' => $search_value))->result();
		if ($result_set) {
			$data = array();
			foreach ($result_set as $key => $value) {
				$this->nis = $value->{$this->field_nis};
				$this->nama = $value->{$this->field_nama};
				$this->idkelas = $value->{$this->field_idkelas};
				$this->password = $value->{$this->field_password};
				$data[$key] = $this->reconstruct($returnfield);
				$data[$key]['kelas'] = $value->nama_kelas;
			}
			return $data;
		} else {
			return null;
		}
	}

	private function insert_data()
	{
		$data = array(
			$this->field_nis => $this->nis,
			$this->field_nama => $this->nama,
			$this->field_password => $this->password,
			$this->field_idkelas => $this->idkelas
		);
		return $this->db->insert($this->table, $data);
	}

	private function update_data($newdata)
	{
		return $this->db->update($this->table, $newdata, array($this->field_nis => $this->nis));
	}

	private function delete_data()
	{
		return $this->db->delete($this->table, array($this->field_nis => $this->nis));

	}

	public function history_peminjaman($nis)
	{
		return $this->db->order_by('idpinjam', 'desc')->get_where($this->history, array('nis' => $nis))->result();
	}
	// end query
}