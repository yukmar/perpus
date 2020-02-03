var $tnis = $('#tnis');
var $ttagihan = $('#table-tagihan');
var $stotal = $('#span-total');

function cek_nis() {
	var nis = $tnis.val().replace(/\s/g, '');
	var ini = event;
	var i = false;
	// event.preventDefault();
	$.get(window.location.origin + '/pengembalian/cek-siswa/?nis=' + nis).done(function(data) {
		if (data == 'ada') {
			// $.post(window.location.origin + '/pengembalian/cek-siswa/', {txtnis: nis});
			i = true;
		} else {
			$('#form-kembali').find("input:first").next('small').text('NIS tidak terdaftar');
			// ini.preventDefault();
			i = false;
		}
		return i;
	});
	// console.log(i);
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
	$('#form-kembali').submit(function() {
		// return cek_nis();
	});
});