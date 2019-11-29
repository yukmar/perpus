<?php
/**
 * 
 */
class Detailbuku_model extends CI_Model
{
	// variabel menampung nama tabel database
	private $table = 'detail_buku';

	// variabel menampung nilai field/atribut
	private $isbn = null;
	private $idpenerbit = null;
	private $judul = null;
	private $pengarang = null;

	// variabel menampung nama field/atribut
	private $field_isbn = "isbn";
	private $field_idpenerbit = "id_penerbit";
	private $field_judul = "judul";
	private $field_pengarang = "pengarang";

	// variabel menampung nama baru (altering) field/atribut 
	private $newprop_isbn = "isbn";
	private $newprop_idpenerbit = "idpenerbit";
	private $newprop_judul = "judul";
	private $newprop_pengarang = "pengarang";

	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'Buku_model' => 'buku_m',
			'Penerbit_model' => 'penerbit_m'
		));
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
			case $this->field_isbn:
				return $this->isbn;
				break;
			case $this->field_idpenerbit:
				return $this->idpenerbit;
				break;
			case $this->field_judul:
				return $this->judul;
				break;
			case $this->field_pengarang:
				return $this->pengarang;
				break;
			
			default:
				return array(
					$this->newprop_isbn => $this->isbn,
					$this->newprop_idpenerbit => $this->idpenerbit,
					$this->newprop_judul => $this->judul,
					$this->newprop_pengarang => $this->pengarang
				);
				break;
		}
	}

	// start represent
	public function get_all()
	{
		$lists = $this->all();
		foreach ($lists as $key => $value) {
			$lists[$key]['total_eksemplar'] = $this->buku_m->count_eksemplar($value['isbn']);
			$lists[$key]['penerbit'] = $this->penerbit_m->search('id', $value[$this->newprop_idpenerbit], 'nama');
		}

		return $lists;
	}

	public function search($fieldalias, $search_value, $returnfieldalias)
	{
		$field = null;
		$returnfield = null;

		switch ($fieldalias) {
			case $this->newprop_isbn:
				$field = $this->field_isbn;
				break;

			case $this->newprop_idpenerbit:
				$field = $this->field_idpenerbit;
				break;

			case $this->newprop_judul:
				$field = $this->field_judul;
				break;

			case $this->newprop_pengarang:
				$field = $this->field_pengarang;
				break;
			
			default:
				return null;
				break;
		}

		switch ($returnfieldalias) {
			case $this->newprop_isbn:
				$returnfield = $this->field_isbn;
				break;

			case $this->newprop_idpenerbit:
				$returnfield = $this->field_idpenerbit;
				break;

			case $this->newprop_judul:
				$returnfield = $this->field_judul;
				break;

			case $this->newprop_pengarang:
				$returnfield = $this->field_pengarang;
				break;

			default:
				$returnfield = null;
				break;
		}

		return $this->search_data($field, $search_value, $returnfield);
	}

	public function insert($newdata)
	{
		$this->isbn = $newdata['isbn'];
		$this->judul = $newdata['judul'];
		$this->pengarang = $newdata['pengarang'];
		$this->idpenerbit = $newdata['idpenerbit'];
		return $this->insert_data();
	}

	public function update($isbn, $newdata)
	{
		$this->isbn = $isbn;
		$prepdata = array(
			$this->field_isbn => $newdata['isbn'],
			$this->field_judul => $newdata['judul'],
			$this->field_pengarang => $newdata['pengarang'],
			$this->field_idpenerbit => $newdata['idpenerbit']
		);
		return $this->update_data($prepdata);
	}

	public function delete($isbn)
	{
		$this->isbn = $isbn;
		return $this->delete_data();
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
			$this->isbn = $value->{$this->field_isbn};
			$this->idpenerbit = $value->{$this->field_idpenerbit};
			$this->judul = $value->{$this->field_judul};
			$this->pengarang = $value->{$this->field_pengarang};
			$data[] = $this->reconstruct();
		}
		return $data;
	}

	private function search_data($field, $value, $returnfield = null)
	{
		$result_set = $this->db->get_where($this->table, array($field => $value))->result();
		if ($result_set) {
			foreach ($result_set as $key => $value) {
				$this->isbn = $value->{$this->field_isbn};
				$this->idpenerbit = $value->{$this->field_idpenerbit};
				$this->judul = $value->{$this->field_judul};
				$this->pengarang = $value->{$this->field_pengarang};
			}
			return $this->reconstruct($returnfield);
		} else {
			return null;
		}
	}

	private function insert_data()
	{
		$newdata = array(
			$this->field_isbn => $this->isbn,
			$this->field_judul => $this->judul,
			$this->field_pengarang => $this->pengarang,
			$this->field_idpenerbit => $this->idpenerbit
		);
		return $this->db->insert($this->table, $newdata);
	}

	public function update_data($newdata)
	{
		return $this->db->update($this->table, $newdata, array($this->field_isbn => $this->isbn));
	}

	private function delete_data()
	{
		return $this->db->delete($this->table, array($this->field_isbn => $this->isbn));
	}
	// end query
}