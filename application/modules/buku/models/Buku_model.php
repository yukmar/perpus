<?php
/**
 * 
 */
class Buku_model extends CI_Model
{
	// variabel menampung nama tabel database
	private $table = 'buku';
// isbn
// judul
// tahun_terbit
// pengarang
// penerbit
// genre
	// variabel menampung nilai field/atribut
	private $isbn = null;
	private $judul = null;
	private $thn_terbit = null;
	// revisi variabel dari atribut
	private $pengarang = null;
	private $penerbit = null;
	private $genre = null;
	// end revisi

	// variabel menampung nama field/atribut
	private $field_isbn = "isbn";
	private $field_judul = "judul";
	private $field_thn_terbit = "tahun_terbit";
	// revisi variabel dari atribut
	private $field_pengarang = "pengarang";
	private $field_penerbit = "penerbit";
	private $field_genre = "genre";
	// end revisi

	// variabel menampung nama baru (altering) field/atribut
	// atau mewakili nilai input indikator dari luar class
	// yang dapat terdeteksi oleh class ini
	private $alias_isbn = "isbn";
	private $alias_judul = "judul";
	private $alias_thn_terbit = "tahunterbit";
	// end revisi
	// revisi alias variabel dari atribut
	private $alias_pengarang = "pengarang";
	private $alias_penerbit = "penerbit";
	private $alias_genre = "genre";
	// end revisi

	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'buku/Itembuku_model' => 'item_m',
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
			case $this->field_judul:
				return $this->judul;
				break;
			case $this->field_thn_terbit:
				return $this->thn_terbit;
				break;

			// revisi dari perubahan database
			case $this->field_pengarang:
				return $this->pengarang;
				break;

			case $this->field_penerbit:
				return $this->penerbit;
				break;

			case $this->field_genre:
				return $this->genre;
				break;
			// end revisi
			
			default:
				return array(
					$this->alias_isbn => $this->isbn,
					$this->alias_judul => $this->judul,
					$this->alias_thn_terbit => $this->thn_terbit,
					// revisi dari perubahan tabel buku
					$this->alias_pengarang => $this->pengarang,
					$this->alias_penerbit => $this->penerbit,
					$this->alias_genre => $this->genre
					// end revisi
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

			case $this->alias_judul:
				$field = $this->field_judul;
				break;

			case $this->alias_thn_terbit:
				$field = $this->field_thn_terbit;
				break;
			
			// revisi dari perubahan database
			case $this->alias_pengarang:
				return $this->field_pengarang;
				break;

			case $this->alias_penerbit:
				return $this->field_penerbit;
				break;

			case $this->alias_genre:
				return $this->field_genre;
				break;
			// end revisi
			
			default:
				return null;
				break;
		}

		switch ($returnfield_alias) {
			case $this->alias_isbn:
				$returnfield = $this->field_isbn;
				break;

			case $this->alias_judul:
				$returnfield = $this->field_judul;
				break;

			case $this->alias_thn_terbit:
				$returnfield = $this->field_thn_terbit;
				break;

			// revisi dari perubahan database
			case $this->alias_pengarang:
				$returnfield = $this->field_pengarang;
				break;

			case $this->alias_penerbit:
				$returnfield = $this->field_penerbit;
				break;

			case $this->alias_genre:
				$returnfield = $this->field_genre;
				break;
			// end revisi

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
		// revisi dari perubahan tabel buku
		$this->pengarang = $newdata[$this->alias_pengarang];
		$this->penerbit = $newdata[$this->alias_penerbit];
		$this->genre = $newdata[$this->alias_genre];
		// end revisi
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
		// revisi dari perubahan tabel buku
		if (isset($newdata[$this->alias_pengarang])) {
			$prepdata[$this->field_pengarang] = $newdata[$this->alias_pengarang];
		}
		if (isset($newdata[$this->alias_penerbit])) {
			$prepdata[$this->field_penerbit] = $newdata[$this->alias_penerbit];
		}
		if (isset($newdata[$this->alias_genre])) {
			$prepdata[$this->field_genre] = $newdata[$this->alias_genre];
		}
		// end revisi
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
			case $this->alias_judul:
				$field = $this->field_judul;
				break;
			case $this->alias_thn_terbit:
				$field = $this->field_thn_terbit;
				break;
			// revisi dari perubahan tabel buku
			case $this->alias_pengarang:
				$field = $this->field_pengarang;
				break;
			case $this->alias_penerbit:
				$field = $this->field_penerbit;
				break;
			case $this->alias_genre:
				$field = $this->field_genre;
				break;
			// end revisi
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
			$this->judul = $value->{$this->field_judul};
			$this->thn_terbit = $value->{$this->field_thn_terbit};
			// revisi dari perubahan tabel buku
			$this->pengarang = $value->{$this->field_pengarang};
			$this->penerbit = $value->{$this->field_penerbit};
			$this->genre = $value->{$this->field_genre};
			// end revisi
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
				$this->judul = $value->{$this->field_judul};
				$this->thn_terbit = $value->{$this->field_thn_terbit};
			// revisi dari perubahan tabel buku
				$this->pengarang = $value->{$this->field_pengarang};
				$this->penerbit = $value->{$this->field_penerbit};
				$this->genre = $value->{$this->field_genre};
			// end revisi
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
			// revisi dari perubahan tabel buku
			$this->field_pengarang => $this->pengarang,
			$this->field_penerbit => $this->penerbit,
			$this->field_genre => $this->genre
			// end revisi
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
		}

		if ($q) {
			return $q;
		} else {
			return null;
		}
	}
	
	// end query
}