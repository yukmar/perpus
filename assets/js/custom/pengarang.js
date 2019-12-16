var $tpengarang = $('#table-pengarang');
var $tnama = $('#tnama');

function edit_pengarang(no) {
	event.preventDefault();
	var nama = event.currentTarget.closest('tr').children[1].innerText;
	$tnama.val(nama);
	$('#btn-form').text('Edit');
	$('#title-form').text("Form Edit Pengarang");
	$('#tid').val(no);
	$('#form-pengarang').attr('action', window.location.origin + '/manage-pengarang/edit/?no=' + no);
}

function reset_form() {
	$('#btn-form').text('Tambah');
	$('#title-form').text("Form Tambah Pengarang");
}

$(document).ready(function() {
	$tpengarang.DataTable();

});