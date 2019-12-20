var $tpengarang = $('#table-pengarang');
var $tnama = $('#tnama');
var $form = $('#form-pengarang');
var oldnama = null;
var $btnform = $('#btn-form');

function edit_pengarang(no) {
	event.preventDefault();
	var nama = event.currentTarget.closest('tr').children[1].innerText;
	oldnama = nama;
	$tnama.val(nama);
	$btnform.text('Edit');
	$('#title-form').text("Form Edit Pengarang");
	$('#tid').val(no);
	$form.attr('action', window.location.origin + '/manage-pengarang/edit/?no=' + no);
	$form.data('role', 'edit');
}

function reset_form() {
	oldnama = null;
	$('#btn-form').text('Tambah');
	$('#title-form').text("Form Tambah Pengarang");
	$('#form-pengarang').attr('action', window.location.origin + '/manage-pengarang/add');
}

$(document).ready(function() {
	$tpengarang.DataTable();
	$btnform.prop('disabled', true);
	$tnama.keyup(function() {
		console.log($tnama.next('small'));
		$.get(window.location.origin + '/manage-pengarang/cek', {nama: $tnama.val()}).done(function(data) {
			var dt = JSON.parse(data);
			if (dt.ada) {
				console.log(dt.ada);
				if ($tnama.val() == oldnama) {
					$btnform.prop('disabled', false);
					$tnama.next('small').text('');
				} else {
					$btnform.prop('disabled', true);
					$tnama.next('small').text(dt.ada);
				}
			} else {
				$btnform.prop('disabled', false);
				$tnama.next('small').text('');
			}
		});
	});
});