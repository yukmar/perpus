<?php
/**
 * 
 */
class Validasi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Petugas_model', 'petugas_m');
		$this->load->model('Siswa_model', 'siswa_m');
	}

	public function testing()
	{
		$username = 'Beni Kurniawan';
		$password = 'ini beni';
		// $nisn = mt_rand(1000000000,9999999999);
		$nisn = "4408623260";
		echo "username: ".$username;
		echo "<br/>";
		echo "password: ".$password;
		echo "<br/>";
		echo "hashed: ".$hashed;
		echo "<br/>";
		echo "<br/>";

		$gethash = $this->siswa_m->search('nisn', $nisn, 'password');
		echo "password: ".$password;
		echo "<br/>";
		echo "gethash: ".$gethash;
		echo "<br/>verify function: ";
		$result = $this->siswa_m->verify($nisn, $password);
		var_dump($result);
		echo "<br/>verify biasa: ";
		var_dump(password_verify($password, $gethash));
		
		echo "<br/>";
		echo "PETUGAS";
		$nama = 'Wahyudi Setiawan';
		$nip = '883952488698869853';
		$password = 'ini wahyudi';
		echo "<br/>";
		echo "nama petugas: $nama <br/>nip: $nip <br/>password: $password";
		echo "<br/>";
		echo "search:";
		$gethash = $this->petugas_m->search('nip', $nip, 'password');
		echo "password: $gethash";
		$verify = $this->petugas_m->verify($nip, $password);
		echo "<br/>";
		echo "verify: ";
		var_dump($verify);
	}
}