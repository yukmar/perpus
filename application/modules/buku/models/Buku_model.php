<?php
/**
 * 
 */
class Buku_model extends CI_Model
{
	// variabel menampung nama tabel database
	private $table = 'buku';

	// variabel menampung nilai field/atribut
	private $isbn = null;
	private $idpenerbit = null;
	private $judul = null;
	private $thn_terbit = null;
	private $idgenre = null;

	// variabel menampung nama field/atribut
	private $field_isbn = "isbn";
	private $field_idpenerbit = "id_penerbit";
	private $field_judul = "judul";
	private $field_thn_terbit = "tahun_terbit";
	private $field_idgenre = 'id_genre';

	// variabel menampung nama baru (altering) field/atribut 
	private $alias_isbn = "isbn";
	private $alias_idpenerbit = "idpenerbit";
	private $alias_judul = "judul";
	private $alias_thn_terbit = "tahunterbit";
	private $alias_idgenre = 'idgenre';

	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'buku/Itembuku_model' => 'item_m',
			'buku/Penerbit_model' => 'penerbit_m',
			'buku/Detailpengarang_model' => 'detpengarang_m',
			'buku/Genre_model' => 'genre_m'
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
			case $this->field_thn_terbit:
				return $this->thn_terbit;
				break;
			case $this->field_idgenre:
				return $this->idgenre;
				break;
			
			default:
				return array(
					$this->alias_isbn => $this->isbn,
					$this->alias_idpenerbit => $this->idpenerbit,
					$this->alias_judul => $this->judul,
					$this->alias_thn_terbit => $this->thn_terbit,
					$this->alias_idgenre => $this->idgenre
				);
				break;
		}
	}

	// start represent
	public function get_all()
	{
		$lists = $this->all();
		foreach ($lists as $key => $value) {
			$lists[$key]['eksemplar'] = $this->item_m->count($this->alias_isbn, $value[$this->alias_isbn]);
			$lists[$key]['penerbit'] = $this->penerbit_m->search('id', $value[$this->alias_idpenerbit], 'nama')[0];
			$lists[$key]['idpengarang'] = $this->detpengarang_m->search($this->alias_isbn, $value[$this->alias_isbn], 'idpengarang');
			$lists[$key]['pengarang'] = ($lists[$key]['idpengarang'])? (implode(', ', $this->detpengarang_m->get_set($value[$this->alias_isbn]))) : "";
			$lists[$key]['genre'] = $this->genre_m->search('id', $value[$this->alias_idgenre], 'nama')[0];
		}
		return $lists;
	}

	public function search($field_alias, $search_value, $returnfield_alias = null)
	{
		$field = null;
		$returnfield = null;

		switch ($field_alias) {
			case $this->alias_isbn:
				$field = $this->field_isbn;
				break;

			case $this->alias_idpenerbit:
				$field = $this->field_idpenerbit;
				break;

			case $this->alias_judul:
				$field = $this->field_judul;
				break;

			case $this->alias_thn_terbit:
				$field = $this->field_thn_terbit;
				break;
			
			default:
				return null;
				break;
		}

		switch ($returnfield_alias) {
			case $this->alias_isbn:
				$returnfield = $this->field_isbn;
				break;

			case $this->alias_idpenerbit:
				$returnfield = $this->field_idpenerbit;
				break;

			case $this->alias_judul:
				$returnfield = $this->field_judul;
				break;

			case $this->alias_thn_terbit:
				$returnfield = $this->field_thn_terbit;
				break;

			default:
				$returnfield = null;
				break;
		}

		return $this->search_data($field, $search_value, $returnfield);
	}

	public function insert($newdata)
	{
		$this->isbn = $newdata[$this->alias_isbn];
		$this->judul = $newdata[$this->alias_judul];
		$this->thn_terbit = $newdata[$this->alias_thn_terbit];
		$this->idpenerbit = $newdata[$this->alias_idpenerbit];
		$this->idgenre = $newdata[$this->alias_idgenre];
		$existedisbn = $this->search_data($this->field_isbn, $this->isbn);
		if ($existedisbn) {
			// return "info buku telah ada";
			return null;
		} else {
			return $this->insert_data();
		}
	}

	public function update($isbn, $newdata)
	{
		$this->isbn = $isbn;
		$prepdata = array();
		if (isset($newdata[$this->alias_isbn])) {
			$prepdata[$this->field_isbn] = $newdata[$this->alias_isbn];
		}
		if (isset($newdata[$this->alias_judul])) {
			$prepdata[$this->field_judul] = $newdata[$this->alias_judul];
		}
		if (isset($newdata[$this->alias_thn_terbit])) {
			$prepdata[$this->field_thn_terbit] = $newdata[$this->alias_thn_terbit];
		}
		if (isset($newdata[$this->alias_idpenerbit])) {
			$prepdata[$this->field_idpenerbit] = $newdata[$this->alias_idpenerbit];
		}
		if (isset($newdata[$this->alias_idgenre])) {
			$prepdata[$this->field_idgenre] = $newdata[$this->alias_idgenre];
		}
		
		return $this->update_data($prepdata);
	}

	public function delete($isbn)
	{
		$this->isbn = $isbn;
		return $this->delete_data();
	}

	public function get_field($fieldalias)
	{
		$field = null;
		switch ($fieldalias) {
			case $this->alias_isbn:
				$field = $this->field_isbn;
				break;
			case $this->alias_idpenerbit:
				$field = $this->field_idpenerbit;
				break;
			case $this->alias_judul:
				$field = $this->field_judul;
				break;
			case $this->alias_thn_terbit:
				$field = $this->field_thn_terbit;
				break;
			
			default:
				return null;
				break;
		}
		return $this->get_fielddata($field);
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
			$this->thn_terbit = $value->{$this->field_thn_terbit};
			$this->idgenre = $value->{$this->field_idgenre};
			$data[] = $this->reconstruct();
		}
		return $data;
	}

	private function search_data($field, $value, $returnfield = null)
	{
		$result_set = $this->db->get_where($this->table, array($field => $value))->result();
		if ($result_set) {
			$data = array();
			foreach ($result_set as $key => $value) {
				$this->isbn = $value->{$this->field_isbn};
				$this->idpenerbit = $value->{$this->field_idpenerbit};
				$this->judul = $value->{$this->field_judul};
				$this->thn_terbit = $value->{$this->field_thn_terbit};
				$data[] = $this->reconstruct($returnfield);
			}
			return $data;
		} else {
			return null;
		}
	}

	private function insert_data()
	{
		$newdata = array(
			$this->field_isbn => $this->isbn,
			$this->field_judul => $this->judul,
			$this->field_thn_terbit => $this->thn_terbit,
			$this->field_idpenerbit => $this->idpenerbit,
			$this->field_idgenre => $this->idgenre
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

	private function get_fielddata($field)
	{
		$result = $this->db->select($field)->from($this->table)->get()->result();
		$data = array();
		foreach ($result as $key => $value) {
			$this->{$field} = $value->{$field};
			$data[] = $this->reconstruct($field);
		}
		return $data;
	}

	public function search_word($word)
	{
		$q = $this->db->like($this->field_judul, $word, 'both')->get($this->table)->result();
		foreach ($q as $key => $value) {
			$q[$key]->penerbit = $this->penerbit_m->search('id', $value->{$this->field_idpenerbit}, 'nama')[0];
			$q[$key]->genre = $this->genre_m->search('id', $value->{$this->field_idgenre}, 'nama')[0];
			$q[$key]->idpengarang = $this->detpengarang_m->search('isbn', $value->{$this->field_isbn}, 'idpengarang');
			$q[$key]->pengarang = ($q[$key]->idpengarang)? (implode(', ', $this->detpengarang_m->get_set($value->{$this->field_isbn}))) : "";
		}

		if ($q) {
			return $q;
		} else {
			return null;
		}
	}
	
	// end query
}