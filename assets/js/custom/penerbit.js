var tnama = document.getElementById('tnama');
var talamat = document.getElementById('talamat');
var fpenerbit = document.getElementById('fpenerbit');

function editpenerbit(no) {
	var selected_row = event.target.closest('tr');
	var nama = selected_row.children[1].innerHTML;
	var alamat = selected_row.children[2].innerHTML;

	$('#caption-penerbit').val('FORM EDIT PENERBIT');
	fpenerbit.action = "<?=site_url('manage-penerbit/edit/?no=')?>" + no;
	fpenerbit.querySelector('button').innerHTML = 'edit';
	tnama.value = nama;
	talamat.value = alamat;
}

$(document).ready(function() {
	$('#table-penerbit').DataTable();
});