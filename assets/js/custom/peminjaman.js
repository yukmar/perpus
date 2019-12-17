var $tglbatas = $('#tgl_batas');
var tglbatas_def = new Date();
var $idbuku = $('#tidbuku');
var $judul = $('#tjudul');
var $nis = $('#tnis');
var $tglbatas = $('#tgl_batas');
var $btnpinjam = $('#btn_pinjam');
var $fpinjam = $('#fpinjam');
var $tketerangan = $('#keterangan-idbuku');
var $tketnis = $('#keterangan-nis');
var $btnbuku = $('#btn-kodebuku');
var infobuku = null;
var daftar_pinjaman = new Array();
var $btntambah = $('#btn-tambah');
var $tdaftar = $('#daftar-pinjam tbody');

function cek_buku(e) {
	event.preventDefault();
	$tketerangan.text('');
	$.get(window.location.origin + '/peminjaman/cek-ketersediaan/?no=' + $idbuku.val()).done(function(data) {
		var result = JSON.parse(data);
		if (result) {
			if ((result['status'] == 'tersedia' || result['status'] == 'baru') && (!daftar_pinjaman.includes($idbuku.val()))) {
				$judul.val(result['judul']);
				$tglbatas.prop('disabled', false);
				$btntambah.prop('disabled', false);
				infobuku = result['info_buku'];
				console.log(infobuku);
			} else {
				$judul.prop('disabled', true);
				$tglbatas.prop('disabled', true);
				$btnpinjam.prop('disabled', true);
				$tketerangan.html('<a href="'+ window.location.origin +'">Buku masih dipinjam</a>');
			}
		} else {
			$judul.val('');
			$judul.prop('disabled', true);
			$tglbatas.prop('disabled', true);
			$btnpinjam.prop('disabled', true);
			$tketerangan.text('Kode tidak ditemukan');
		}
	});
}

function cek_nis(e) {
	event.preventDefault();
	$.get(window.location.origin + '/peminjaman/cek-siswa/?nis=' + $nis.val()).done(function(dt) {
		console.log('check_nis enter get');
		if (dt !== "null") {
			$idbuku.prop('disabled', false);
			$btnbuku.prop('disabled', false);
			console.log('dt: '+dt);
			$tketnis.empty();
			$('#hidden-nis').val($nis.val());
		} else {
			$idbuku.prop('disabled', true);
			$btnbuku.prop('disabled', true);
			$judul.prop('disabled', true);
			$tglbatas.prop('disabled', true);
			$btnpinjam.prop('disabled', true);
			console.log('dt: '+dt);
			// $fpinjam.trigger('reset');
			$tketnis.text('Nomor Induk Siswa Tidak Terdaftar');
		}
	});
}

function tambah() {
	console.log(infobuku);
	daftar_pinjaman[daftar_pinjaman.length] = infobuku['idbuku'];
	console.log(daftar_pinjaman);
	var addrow = "<tr><td>"+infobuku['idbuku']+"<input type='hidden' name='id[]' value='"+infobuku['idbuku']+"'/></td><td>"+infobuku['isbn']+"</td><td>"+infobuku['judul']+"</td><td>"+infobuku['pengarang']+"</td><td><button class='btn btn-danger' onclick='hapus()'>hapus</button></td><tr>";
	$tdaftar.append(addrow);
	$btntambah.prop('disabled', true);
	$judul.val('');
	$idbuku.val('');
}

function hapus(e) {
	event.preventDefault();
	$tketerangan.text('');
	$idbuku.val('');
	$judul.val('');
	daftar_pinjaman.splice(daftar_pinjaman.indexOf(event.currentTarget.closest('tr').children[0].innerText), 1);
	event.currentTarget.closest('tr').remove();
	console.log(daftar_pinjaman);
}

function kembali(e) {
	
}

$(document).ready(function(e) {
	$('#tablepeminjaman').DataTable();
	$nis.keypress(function() {
		if (e.keyCode == 13) {
			cek_nis();
		}
	});
	$idbuku.keypress(function(e) {
		console.log('idbuku entered');
		if (e.keyCode == 13) {
			cek_buku();
		}
	});
	$tglbatas.change(function(e) {
		console.log('tgl batas changed');
		$btnpinjam.prop('disabled', false);
	});
	$btntambah.click(function() {
		tambah();
	})
});