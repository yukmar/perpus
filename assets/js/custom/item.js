var $fedit = document.querySelector("#fedit");
var $ftambah = document.querySelector("#ftambah");
var $kodebuku = $('#tkodebuku');
var $tglbeli = $('#ttglbeli');
var $harga = $('#tharga');
var $status = $('#tstatus');

function toggleModal(key) {
	switch(key){
    case 'tambah':
      $ftambah.classList.toggle("modal__login-show");
      break;
    case 'edit':
      $fedit.classList.toggle("modal__login-show");
      $kodebuku.val(event.target.closest('tr').children[1].innerHTML);
			$tglbeli.val(event.target.closest('tr').children[2].innerHTML);
			$harga.val(event.target.closest('tr').children[3].innerHTML);
		  $('#kodeold').val(event.target.closest('tr').children[1].innerHTML);
      break;
    default:
      break;
  }
}
function windowOnClick(event) {
  toggleModal('close');
}

$(document).ready(function() {
  $('#table-item').DataTable();
});