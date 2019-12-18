var modalLogin = document.querySelector(".loginform");
var modalDaftar = document.querySelector(".daftarform");
var $tisbn = $('#tisbn');
var $tjudul = $('#tjudul');
var $tpengarang = $('#trpengarang');
var $tpenerbit = $('#tpenerbit');
var $finfo = $('#forms-infobuku');
var $tharga = $('#tharga');
var $tterbitan = $('#tterbitan');
var $tableinfo = $('#table-info');
var i = 2;
var daftar_pengarang = null;
var daftar_isbn = null;
var $warning = "<tr id='warningitem'><td></td><td>silahkan daftarkan info isbn terlebih dahulu</td></tr>";
var olddata = null;

var temp = null;

function toggleModal(key) {
  switch(key){
    case 'login':
      modalLogin.classList.toggle("modal__login-show");
      break;

    case 'daftar':
      modalDaftar.classList.toggle("modal__daftar-show");
      $('#tedgenre').val(event.target.closest('tr').children[1].innerHTML);
      $('#hidgenre').val(event.target.getAttribute('data-genre'));
      break;
    default:
      break;
  }
}

function windowOnClick(event) {
  toggleModal('close');
}

function editgenre(no) {
	// body...
}

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
	$('#table-genre').DataTable();
	$('#forms-infobuku').submit(function() {
		$(this).find('small').text('');

		var newisbn = false;
		if ($tisbn.val().length !== 13) {
			console.log($tisbn.val().length);
			event.preventDefault();
			$tisbn.next('small').text('ISBN harus 13 angka');
		}
		if ($(this).data('role') == 'tambah') {
			for (var i = 0; i < daftar_isbn.length; i++) {
				if ($tisbn.val() == daftar_isbn[i]) {
					newisbn = false;
					break;
				} else {
					newisbn = true;
				}
			}
		} else {
			console.log('edit');
			if ($tisbn.val() == $tisbn.data('old')) {
				newisbn = true;
			} else {
				console.log('else');
				for (var i = 0; i < daftar_isbn.length; i++) {
					if ($tisbn.val() == daftar_isbn[i]) {
						newisbn = false;
						break;
					} else {
						newisbn = true;
					}
				}
			}
		}
		console.log(newisbn);
		
		if (!newisbn) {
			event.preventDefault();
			console.log(newisbn);
			$tisbn.next('small').text('ISBN telah ada');
		}
		submitinfo();
		$(this).find("input[name='txtpengarang[]']").each(function() {
			if ($(this).val().length == 0) {
				event.preventDefault();
				console.log($(this).parent());
				temp = $(this);
				$(this).parent().next().next('small').text('Tidak boleh kosong');
			}
		});
	});
	
	/**
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
				$('#itemisbn').closest('small').val('silahkan daftarkan info isbn terlebih dahulu');
				$('tr:empty').remove();
			}
		} else {
		}
	});
	**/

	$tableinfo.DataTable();
});

function submitinfo() {
	var filled = false;
		if(!$tisbn.val()) {
			console.log(1);
			event.preventDefault();
			temp = $(this);
			$tisbn.next('small').text("Tidak boleh kosong");
		}
		if (($tterbitan.val().length !== 4) || isNaN($tterbitan.val())) {
			console.log(2);
			event.preventDefault();
			$tterbitan.next('small').text("Tahun tidak valid");
		}
	$('#form-infobuku input, textarea').each(function() {
		console.log($(this));
		if ($(this).val()) {
			filled = true;
		} else {
			filled = false;
			$(this).next('small').text("Tidak boleh kosong");
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
				event.preventDefault();
				return false;
			} else {
				return true;
			}
		} else {
			return true;
		}
	} else {
		event.preventDefault();
		return false;
	}
}

function editinfo(no) {
	var $selected_row = event.target.closest('tr');
	var isbn = $selected_row.children[1].innerText;
	var judul = $selected_row.children[2].innerText;
	var terbitan = $selected_row.children[5].innerHTML;
	var pengarang = null;
	$finfo.data('role', 'edit');
	$tisbn.data('old', isbn);

	resetpengarang();

	$.get(window.location.origin + '/manage-buku/search/?isbn=' + isbn).done(function(data) {
		pengarang = JSON.parse(data);
		$('.tpengarang').val(pengarang[0]);
		if (pengarang.length > 1) {
			for (var x = 1; x < pengarang.length; x++) {
				var el = "<div class='form-inline mb-2'><input type='text' class='tpengarang form-control col-sm-9' name='txtpengarang[]' value='"+pengarang[x]+"'><button class='btn btn-danger ml-2' onclick='removepengarang()'>hapus</button></div>";
				$(el).insertAfter($('.tpengarang').closest('div').last());
			}
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
	$finfo.append(input);
	$("tr:empty").remove();
	});

	$('#caption-buku').text('Form Edit Info Buku');
	$finfo.attr('action', window.location.origin + "/manage-buku/edit/");
	$finfo.find('button').eq(1).text('edit');

	$tisbn.val(isbn);
	$tjudul.val(judul);
	$tpenerbit.val(no);
	$tterbitan.val(terbitan);
	$finfo.find("select[name='genre']").val(event.currentTarget.getAttribute('data-genre'));
}

function resetforminfo() {
	resetpengarang();
	$('#caption-buku').text('Form Tambah Info Buku');
	$finfo.attr('action', window.location.origin + "/manage-buku/addinfo");
	$finfo.find('button').eq(1).text('tambah');
}

function resetpengarang() {
	if ($('input[name^="txtpengarang"]').length > 1) {
		$('input[name^="txtpengarang"]').closest('div').not(':first').remove();
		i = 2;
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
	var el = "<div class='form-inline mb-2'><input type='text' class='tpengarang form-control col-sm-9' name='txtpengarang[]'><button class='btn btn-danger ml-2' onclick='removepengarang()'>hapus</button></div>";
	$(el).insertAfter($('.tpengarang').closest('div').last());
	$('.tpengarang').autocomplete({
		source: daftar_pengarang
	});
	return false;
}

function removepengarang(e) {
	event.preventDefault();
	event.target.closest('div').remove();
}