<?php
/**
 * 
 */
class Detailpeminjaman_model extends CI_Model
{

	// variabel menampung nama tabel database
	private $table = 'detail_peminjaman';

	private $id = null;
	private $idbuku = null;
	private $idpeminjaman = null;

	// variabel menampung nama field/atribut
	private $field_id = "id_detailpeminjaman";
	private $field_idbuku = "id_buku";
	private $field_idpeminjaman = "id_peminjaman";
	private $field_tglkembali = "tgl_pengembalian";

	// variabel menampung nama baru (altering) field/atribut
	private $alias_id = "id";
	private $alias_idbuku = "idbuku";
	private $alias_idpeminjaman = "idpeminjaman";
	private $alias_tglkembali = "tgl_kembali";

	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
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
			case $this->field_idbuku:
				return $this->idbuku;
				break;
			case $this->field_idpeminjaman:
				return $this->idpeminjaman;
				break;
			
			default:
				return array(
					$this->alias_id => $this->id,
					$this->alias_idbuku => $this->idbuku,
					$this->alias_idpeminjaman => $this->idpeminjaman
				);
				break;
		}
	}

	public function search($field_alias, $value_search, $returnfield_alias = null)
	{
		$field = null;
		$returnfield = null;

		// tidak memakai id karena hanya dipakai untuk pengindeksan peminjaman
		switch ($field_alias) {
			case $this->alias_idbuku:
				$field = $this->field_idbuku;
				break;

			case $this->alias_idpeminjaman:
				$field = $this->field_idpeminjaman;
				break;

			default:
				return null;
				break;
		}

		switch ($returnfield_alias) {
			case $this->alias_idbuku:
				$return = $this->field_idbuku;
				break;

			case $this->alias_idpeminjaman:
				$return = $this->field_idpeminjaman;
				break;

			default:
				$returnfield = null;
				break;
		}

		return $this->search_data($field, $value_search, $returnfield);
	}

	public function insert($newdata)
	{
		$this->idbuku = $newdata[$this->alias_idbuku];
		$this->idpeminjaman = $newdata[$this->alias_idpeminjaman];

		return $this->insert_data();
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
			$this->idbuku = $value->{$this->field_idbuku};
			$this->idpeminjaman = $value->{$this->field_idpeminjaman};
			$data[] = $this->reconstruct();
		}
		return $data;
	}

	private function search_data($field, $value_search, $returnfield = null)
	{
		$result_set = $this->db->order_by($this->field_id, 'DESC')->get_where($this->table, array($field => $value_search))->result();
		if ($result_set) {
			$data = array();
			foreach ($result_set as $key => $value) {
				$this->idbuku = $value->{$this->field_idbuku};
				$this->idpeminjaman = $value->{$this->field_idpeminjaman};
				$data[] = $this->reconstruct();
			}
			return $data;
		} else {
			return null;
		}
	}

	private function insert_data()
	{
		$prep_data = array(
			$this->field_idbuku => $this->idbuku,
			$this->field_idpeminjaman => $this->idpeminjaman
		);

		return $this->db->insert($this->table, $prep_data);
	}

	public function update_kembali($id)
	{
		// return $this->db->update($this->table, array($this->field_tglkembali => mdate("%Y-%m-%d")), array($this->field_id => $id));
		return $this->db->query("UPDATE detail_peminjaman SET tgl_pengembalian = CURDATE() WHERE detail_peminjaman.id_detailpeminjaman = ".$id);
	}
	// end start
}