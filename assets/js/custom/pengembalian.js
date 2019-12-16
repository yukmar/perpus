var $tnis = $('#tnis');
var $ttagihan = $('#table-tagihan');
var $stotal = $('#span-total');

function cek_nis() {
	$.get(window.location.origin + '/pengembalian/cek-siswa/?no=' + $tnis.val()).done(function(data) {
		if (data == 'ada') {
			alert("ada");
		} else {
			alert("Nomor Induk Siswa tidak terdaftar");
		}
	});
}

function kembalidanbayar() {
	$.get(window.location.origin + '/pengembalian/submit/?no=' + $tnis.val()).done(function(data) {
		if (data == 'berhasil') {
			alert("Pengembalian buku dan pembayaran denda berhasil");
			window.location.href = window.location.origin;
		} else {
			alert("Terdapat kesalahan, mohon menghubungi admin");
		}
	});
}

$(document).ready(function(e) {
	$("input[type='checkbox']").change(function() {
		var dendaselect = $(this).closest('tr').find('td:eq(4)').text();
		var total = parseInt($stotal.text());
		var dendasel = parseInt(dendaselect);
		if (this.checked) {
			var result = total + dendasel;
			$stotal.text(result);
		} else {
			var result = total-dendasel; 
			if (result < 0) {
				$stotal.text(0);
			} else {
				$stotal.text(result);
			}
		}
	});
});