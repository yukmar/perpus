<?php
/**
 * 
 */
class Testing extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'Itembuku_model' => 'item',
			'Buku_model' => 'buku_m',
			'Penerbit_model' => 'penerbit_m',
			'Pengarang_model' => 'pengarang_m',
			'Detailpengarang_model' => 'detpengarang_m',
			'Peminjaman_model' => 'peminjaman_m',
			'Siswa_model' => 'siswa_m',
			'Kelas_model' => 'kelas_m',
			'Genre_model' => 'genre_m'
		));
	}

	public function index()
	{
		$arr = array('A','B','C','D', 'E');
		$y = array('B', 'A');
		$idx = array(1,4);
		$after = array();
		// foreach ($arr as $key => $value) {
		// 	foreach ($y as $k => $v) {
		// 		if ($value == $v) {
		// 			unset($arr[$key]);
		// 		}
		// 	}
		// }
		// $iarr = array_keys($arr);
		// print_r($iarr);
		// $lastkey = end($idx);
		// foreach ($iarr as $key => $value) {
		// 	foreach ($idx as $k => $v) {
		// 		echo "<br/>";
		// 		echo "$value => $v";
		// 		if ($value == $v) {
		// 			echo "<br/>";
		// 			continue 2;
		// 			echo "$value == $v";
		// 		} else {
		// 			if ($v == $lastkey) {
		// 				echo "$value => $v";
		// 			array_push($after, $value);
		// 			}
		// 		}
		// 	}
		// }
		// print_r(array_unique($after));
		// var_dump($res);
		// print json_encode($this->item_m->search('id', '2')[0]['isbn']);
		// print json_encode($this->siswa_m->search('nis', '2580748322', 'kelas'));
		// $this->load->view('testing_view');
		// $date1 = date_create("01 Dec 2019");
		// $date2 = new DateTime();
		// $result = date_diff($date2, $date1)->format("%R%a");
		
		$q = $this->genre_m->get_all();
		echo json_encode($q);
		
	}

	public function test()
	{
		$list = $this->input->post('checklist');
		print json_encode($list);
	}
}