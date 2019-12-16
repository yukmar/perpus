var $tisbn = $('#tisbn');
var $tjudul = $('#tjudul');
var $tpengarang = $('#trpengarang');
var $tpenerbit = $('#tpenerbit');
var $finfo = $('#form-infobuku');
var $tharga = $('#tharga');
var $tterbitan = $('#tterbitan');
var $tableinfo = $('#table-info');
var i = 2;
var daftar_pengarang = null;
var daftar_isbn = null;
var $warning = "<tr id='warningitem'><td></td><td>silahkan daftarkan info isbn terlebih dahulu</td></tr>";
var olddata = null;

$(document).ready(function(){
	$.get(window.location.origin + '/manage-buku/daftar_pengarang').done(function(data) {
		daftar_pengarang = JSON.parse(data);
		$('.tpengarang').autocomplete({
			source: daftar_pengarang
		});
	});
	$.get(window.location.origin + '/manage-buku/daftar_isbn').done(function(data) {
		daftar_isbn = JSON.parse(data);
		$('#itemisbn').autocomplete({
			source: daftar_isbn,
			select: function (event,ui) {
				$('#btnitem').prop('disabled', false);
			},
		});
	});
	$('#itemisbn').keyup(function() {
		if ($('#itemisbn').val().length == 13) {
			var notexist = null;
			for (var i = 0; i < daftar_isbn.length; i++) {
				if ($('#itemisbn').val() == daftar_isbn[i]) {
					$('#btnitem').prop('disabled', false);
				} else {
					$('#btnitem').prop('disabled', true);
					notexist = true;
				}
			}
			if (notexist) {
				$('#itemisbn').closest('tr').after($warning);
				$('tr:empty').remove();
			}
		} else {
			if ($('#warningitem').length) {
				$('#form-item').find('#warningitem').remove();
			}
			$('#btnitem').prop('disabled', true);
		}
	});

	$tableinfo.DataTable();
});

function submitinfo() {
	var filled = false;
	$('#form-infobuku input, textarea').each(function() {
		if ($(this).val()) {
			filled = true;
		} else {
			filled = false;
		}
	});
	if (filled) {
		var $title = $('#form-infobuku caption').text().split(" ");
		if ($title[0] == "TAMBAH") {
			var isbnexist = false;
			for (var i = 0; i < daftar_isbn.length; i++) {
				if ($('#tisbn').val() == daftar_isbn[i]) {
					isbnexist = true;
				}
			}
			if (isbnexist) {
				return false;
				console.log(isbnexist);
			} else {
				return true;
			}
		} else {
			return true;
		}
	} else {
		return false;
		console.log('filled: ' + filled);
	}
}

function editinfo(no) {
	var $selected_row = event.target.closest('tr');
	var isbn = $selected_row.children[1].innerHTML;
	var judul = $selected_row.children[2].innerHTML;
	var terbitan = $selected_row.children[5].innerHTML;
	var pengarang = null;


	resetpengarang();

	$.get(window.location.origin + '/manage-buku/search/?isbn=' + isbn).done(function(data) {
		pengarang = JSON.parse(data);
		$('#form-infobuku tbody tr:eq('+i+') input').val(pengarang[0]);
		if (pengarang.length > 1) {
			var numloop = 0;
			i = 2;
			for (var x = 1; x < pengarang.length; x++) {
			$('#form-infobuku tbody tr').eq(i).after("<tr><td></td><td><input type='text' name='txtpengarang[]' value='"+pengarang[x]+"' class='tpengarang'> <button onclick='removepengarang()' class='btnremove'>hapus</button></td><tr/>");
			numloop++;
			i++;
			}
			console.log(numloop);
			console.log(i);
		}
		$('.tpengarang').autocomplete({
			source: daftar_pengarang
		});
	olddata = {
		isbn: isbn,
		judul: judul,
		pengarang: pengarang,
		tahun: terbitan,
		penerbit: no
	};
	var input = $('<input>').attr('type', 'hidden').attr('name', 'old').attr('id', 'txold').val(JSON.stringify(olddata));
	$('#form-infobuku').append(input);
	$("tr:empty").remove();
	});

	$finfo.find('caption').text('EDIT INFO BUKU');
	$finfo.attr('action', window.location.origin + "/manage-buku/edit/?no=" + isbn);
	$finfo.find('button').eq(1).text('edit');

	$tisbn.val(isbn);
	$tjudul.val(judul);
	$tpenerbit.val(no);
	$tterbitan.val(terbitan);
}

function resetforminfo() {
	var $title = event.target.querySelector('caption').innerHTML.split(" ");
	resetpengarang();
	$title[0] = 'TAMBAH';
	event.target.querySelector('caption').innerHTML = $title.join(" ");
	$finfo.attr('action', window.location.origin + "/manage-buku/addinfo");
	$finfo.find('button').eq(1).text('tambah');
}

function resetpengarang() {
	if ($('input[name^="txtpengarang"]').length > 1) {
		$('input[name^="txtpengarang"]').closest('tr').remove();
		i = 2;
		$('#form-infobuku tbody tr:eq(1)').after("<tr><td>Pengarang: </td><td><input type='text' name='txtpengarang[]' class='tpengarang'></td><tr/>");
	}
	if ($('input[type^="hidden"]').length >= 1) {
		$('input[type^="hidden"]').remove();
	}
	$("tr:empty").remove();
	$('.tpengarang').autocomplete({
		source: daftar_pengarang
	});
}

function addpengarang(e) {
	event.preventDefault();
	var $newpengarang = document.createElement("input");
	$('#form-infobuku tbody tr').eq(i).after("<tr><td></td><td><input type='text' name='txtpengarang[]' class='tpengarang'> <button onclick='removepengarang()' class='btnremove'>hapus</button></td><tr/>");
	$('.tpengarang').autocomplete({
		source: daftar_pengarang
	});
	i++;
	return false;
}

function removepengarang(e) {
	event.preventDefault();
	event.target.closest('tr').remove();
	i--;
}