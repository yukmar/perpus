var $tisbn = $('#tisbn');
var $tjudul = $('#tjudul');
var $tpengarang = $('#trpengarang');
var $tpenerbit = $('#tpenerbit');
var $finfo = $('#form-infobuku');
var i = 2;
var daftar_pengarang = null;

$(document).ready(function(){
	$.get(window.location.origin + '/manage-buku/daftar_pengarang').done(function(data) {
		daftar_pengarang = JSON.parse(data);
		$('.tpengarang').autocomplete({
		source: daftar_pengarang
	});
	});
});

function editinfo(no) {
	var $selected_row = event.target.closest('tr');
	var $isbn = selected_row.children[1].innerHTML;
	var $judul = selected_row.children[2].innerHTML;

	$finfo.firstChild.nextSibling.caption.innerHTML = 'EDIT INFO BUKU';
	$finfo.action = "<?=site_url('manage-buku/edit/?no=')?>" + isbn;
	$finfo.querySelector('button').innerHTML = 'edit';

	$tisbn.value = isbn;
	$tjudul.value = judul;
	$tpenerbit.value = no;
}

function resetforminfo() {
	var $caption = event.target.querySelector('caption');
	var $title = event.target.querySelector('caption').innerHTML.split(" ");
	event.target.querySelector('caption').innerHTML = 'CREATE '+title[1];
	event.target.action = "<?=site_url('manage-buku/addinfo')?>";
	event.target.querySelector('button').innerHTML = 'tambah';
}

function addpengarang(e) {
	event.preventDefault();
	var $newpengarang = document.createElement("input");
	$('#form-infobuku tbody tr').eq(i).after("<tr><td></td><td><input type='text' name='txtpengarang[]'> <button onclick='removepengarang()' class='btnremove'>hapus</button></td><tr/>");
	i++;
	return false;
}

function removepengarang(e) {
	event.preventDefault();
	i--;
	event.target.closest('tr').remove();
}