<?php
/**
 * 
 */
class Buku_model extends CI_Model
{
	// variabel menampung nama tabel database
	private $table = 'buku';

	// variabel menampung nilai field/atribut
	private $id = null;
	private $isbn = null;
	private $terbit = null;
	private $harga = null;
	private $tgl_beli = null;

	// variabel menampung nama field/atribut
	private $field_id = "id_buku";
	private $field_isbn = "isbn";
	private $field_terbit = "tahun_terbit";
	private $field_harga = "harga";
	private $field_tgl_beli = "tgl_pembelian";

	// variabel menampung nama baru (altering) field/atribut 
	private $newprop_id = "id";
	private $newprop_isbn = "isbn";
	private $newprop_terbit = "terbit";
	private $newprop_harga = "harga";
	private $newprop_tgl_beli = "tgl_beli";

	function __construct()
	{
		parent::__construct();
		$this->load->model('Detail_buku', 'detbuku_m');
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
			case $this->field_isbn:
				return $this->isbn;
				break;
			case $this->field_terbit:
				return $this->terbit;
				break;
			case $this->field_harga:
				return $this->harga;
				break;
			case $this->field_tgl_beli:
				return $this->tgl_beli;
				break;
			
			default:
				return array(
					$this->newprop_id => $this->id,
					$this->newprop_isbn => $this->isbn,
					$this->newprop_terbit => $this->terbit,
					$this->newprop_harga => $this->harga,
					$this->newprop_tgl_beli => $this->tgl_beli
				);
				break;
		}
	}

	// start represent
	public function get_all()
	{
		return $this->all();
	}

	public function search($fieldalias, $search_value, $returnfieldalias = null)
	{
		$field = null;
		$returnfield = null;

		switch ($fieldalias) {
			case $this->newprop_id:
				$field = $this->field_id;
				break;

			case $this->newprop_isbn :
				$field = $this->field_isbn ;
				break;

			case $this->newprop_terbit:
				$field = $this->field_terbit;
				break;

			case $this->newprop_harga:
				$field = $this->field_harga;
				break;

			case $this->newprop_tgl_beli:
				$field = $this->field_tgl_beli;
				break;

			default:
				return null;
				break;
		}

		switch ($returnfieldalias) {
			case $this->newprop_id:
				$returnfield = $this->field_id;
				break;
			case $this->newprop_isbn :
				$returnfield = $this->field_isbn ;
				break;
			case $this->newprop_terbit:
				$returnfield = $this->field_terbit;
				break;
			case $this->newprop_harga:
				$returnfield = $this->field_harga;
				break;
			case $this->newprop_tgl_beli:
				$returnfield = $this->field_tgl_beli;
				break;
			default:
				$returnfield = null;
				break;
		}

		return $this->search_data($field, $search_value, $returnfield);
	}

	public function get_allwithdetails()
	{
		$lists = array();
		foreach ($this->all() as $key => $value) {
			$lists[$key] = $this->detbuku_m->search('isbn', $value['isbn'], 'judul');
		}

		return $lists;
	}
	// end represent

	// start query
	
	/**
	 * mengambil semua data dari tabel buku dengan nama atribut/field yang telah diubah
	 * @return array [description]
	 */
	private function all()
	{
		$result_set = $this->db->get($this->table);
		$data = array();
		foreach ($result_set as $key => $value) {
			$this->id = $value->{$this->field_id};
			$this->isbn = $value->{$this->field_isbn};
			$this->terbit = $value->{$this->field_terbit};
			$this->harga = $value->{$this->field_harga};
			$this->tgl_beli = $value->{$this->field_tgl_beli};
			$data[] = $this->reconstruct();
		}
		return $data;
	}

	private function search_data($field, $value, $returnfield = null)
	{
		$result_set = $this->db->get_where($this->table, array($field => $value))->result();
		if ($result_set) {
			foreach ($result_set as $key => $value) {
				$this->id = $value->{$this->field_id};
				$this->isbn  = $value->{$this->field_isbn };
				$this->terbit = $value->{$this->field_terbit};
				$this->harga = $value->{$this->field_harga};
				$this->tgl_beli = $value->{$this->field_tgl_beli};
			}
			return $this->reconstruct($returnfield);
		} else {
			return null;
		}
	}
	// end query
}