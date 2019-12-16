<?php
/**
 * 
 */
class Peminjaman_model extends CI_Model
{
	// variabel menampung nama tabel database
	private $table = 'peminjaman';

	private $id = null;
	private $nis = null;
	private $nip = null;
	private $tglpeminjaman = null;
	private $tglbatas = null;
	private $tglkembali = null;

	// variabel menampung nama field/atribut
	private $field_id = "id_peminjaman";
	private $field_nis = "nis";
	private $field_nip = "nip";
	private $field_tglpeminjaman = "tgl_peminjaman";
	private $field_tglbatas = "tgl_batas_peminjaman";

	// variabel menampung nama baru (altering) field/atribut
	private $alias_id = "id";
	private $alias_nis = "nis";
	private $alias_nip = "nip";
	private $alias_tglpeminjaman = "tglpeminjaman";
	private $alias_tglbatas = "tglbatas";

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
			case $this->field_nis:
				return $this->nis;
				break;
			case $this->field_nip:
				return $this->nip;
				break;
			case $this->field_tglpeminjaman:
				return $this->tglpeminjaman;
				break;
			case $this->field_tglbatas:
				return $this->tglbatas;
				break;
			
			default:
				return array(
					$this->alias_id => $this->id,
					$this->alias_nis => $this->nis,
					$this->alias_nip => $this->nip,
					$this->alias_tglpeminjaman => $this->tglpeminjaman,
					$this->alias_tglbatas => $this->tglbatas,
				);
				break;
		}
	}

	public function get_all()
	{
		return $this->all();
	}

	public function search($field_alias, $value_search, $returnfield_alias = null)
	{
		$field = null;
		$returnfield = null;

		switch ($field_alias) {
			case $this->alias_id:
				$field = $this->field_id;
				break;

			case $this->alias_nis:
				$field = $this->field_nis;
				break;

			case $this->alias_nip:
				$field = $this->field_nip;
				break;

			case $this->alias_tglpeminjaman:
				$field = $this->field_tglpeminjaman;
				break;

			case $this->alias_tglbatas:
				$field = $this->field_tglbatas;
				break;
			
			default:
				return null;
				break;
		}

		switch ($returnfield_alias) {
			case $this->alias_id:
				$returnfield = $this->field_id;
				break;

			case $this->alias_nis:
				$returnfield = $this->field_nis;
				break;

			case $this->alias_nip:
				$returnfield = $this->field_nip;
				break;

			case $this->alias_tglpeminjaman:
				$returnfield = $this->field_tglpeminjaman;
				break;

			case $this->alias_tglbatas:
				$returnfield = $this->field_tglbatas;
				break;
			
			default:
				$returnfield = null;
				break;
		}

		return $this->search_data($field, $value_search, $returnfield);
	}

	public function insert($newdata)
	{
		$this->nis = $newdata['nis'];
		$this->nip = $newdata['nip'];
		$this->tglbatas = $newdata['tglbatas'];

		return $this->insert_data();
	}

	public function delete($id)
	{
		$this->id = $id;
		return $this->delete();
	}

	public function update($id, $newdata)
	{
		$this->id = $id;
		$prep_data = array();
		if ($this->id) {
			array_push($prep_data, array($this->field => $newdata[$this->alias_id]));
		}
		if ($this->nis) {
			array_push($prep_data, array($this->field => $newdata[$this->alias_nis]));
		}
		if ($this->nip) {
			array_push($prep_data, array($this->field => $newdata[$this->alias_nip]));
		}
		if ($this->tglpeminjaman) {
			array_push($prep_data, array($this->field => $newdata[$this->alias_tglpeminjaman]));
		}
		if ($this->tglbatas) {
			array_push($prep_data, array($this->field => $newdata[$this->alias_tglbatas]));
		}

		return $this->update_data($prep_data);
	}

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
			$this->nis = $value->{$this->field_nis};
			$this->nip = $value->{$this->field_nip};
			$this->tglpeminjaman = $value->{$this->field_tglpeminjaman};
			$this->tglbatas = $value->{$this->field_tglbatas};
			$data[] = $this->reconstruct();
		}
	}

	private function search_data($field, $value_search, $returnfield = null)
	{
		return $this->db->get_where($this->table, array($field => $value_search))->result();
	}

	private function insert_data()
	{
		$prep_data = array(
			$this->field_nis => $this->nis,
			$this->field_nip => $this->nip,
			$this->field_tglbatas => $this->tglbatas,
		);
		$result = $this->db->insert($this->table, $prep_data);
		if ($result) {
			$newid = $this->db->order_by($this->field_id, 'DESC')->limit(1)->get($this->table)->result();			
			foreach ($newid as $key => $value) {
				$this->id = $value->{$this->field_id};
			}
			return $this->reconstruct($this->field_id);
		} else {
			return null;
		}
	}

	private function delete_data()
	{
		return $this->db->delete($this->table, array($this->field_id => $this->id));
	}

	private function update_data($newdata)
	{
		return $this->db->update($this->table, $newdata, array($this->field_id => $this->id));
	}
	// end query
}