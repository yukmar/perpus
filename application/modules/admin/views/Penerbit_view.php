<?=$this->load->view('header_view.php')?>
<div class="containers">
  <input data-function="swipe" id="swipe" type="checkbox">
  <label data-function="swipe" for="swipe"><i class="fa">&#xf057;</i></label>
  <label data-function="swipe" for="swipe"><i class="fa">&#xf0c9;</i></label>

  <div class="headings section-break">
		<div class="linebreak"></div>
		<h2 class="caption-page">PENGELOLAAN PENERBIT</h2>
		<div class="linebreak"></div>
	</div>

  <div class="headings container-fluid row justify-content-center">
  	<section class="col-sm-11">
  		<div class="row container-fluid">
  			<div class="container border-form">
	  			<h5 id="caption-penerbit">FORM TAMBAH PENERBIT</h5>
  				<form action="<?=site_url('manage-penerbit/add')?>" method="post" id="fpenerbit">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Nama Penerbit</label>
							<div class="col-sm-10">
								<textarea class="form-control" placeholder="Nama Penerbit" name="txtnama" id="tnama"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Alamat</label>
							<div class="col-sm-10">
								<input class="form-control" placeholder="Alamat" type="text" name="txtalamat" id="talamat"/>
							</div>
						</div>
						<button class="btn btn-primary" type="submit">Tambah</button>
					</form>
  			</div>
  		</div>
  		<div class="row">
  			<div class="container pt-2">
  				<h5>Table Data Penerbit</h5>
	  			<table class="table databook">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Penerbit</th>
								<th>alamat</th>
								<th>aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($info_penerbit as $key => $value) { ?>
							<tr>
								<td><?=$key+1?></td>
								<td><?=$value['nama']?></td>
								<td><?=$value['alamat']?></td>
								<td>
									<div class="btn-group">
										<button class="btn btn-outline-success" onclick="editpenerbit(<?=$value['id']?>)">Edit</button>
										<a class="btn btn-outline-danger" href="<?=site_url('manage-penerbit/delete/?no=').$value['id']?>">Delete</a>
									</div>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
  			</div>
  		</div>
  	</section>
	</div>
	

	<div class="sidebar">
	  <nav class="menu">
		  <li><a href="<?=site_url()?>">Home</a></li>
	    <li><a href="<?=site_url('peminjaman')?>">Peminjaman</a></li>
	    <li><a href="<?=site_url('pengembalian')?>">Pengembalian</a></li>
	    <li><a href="<?=site_url('manage-buku')?>">Data Buku</a></li>
	    <li><a href="<?=site_url('manage-user')?>">Data User</a></li>
	    <li><a href="<?=site_url('manage-penerbit')?>">Data Penerbit</a></li>
	    <li><a href="<?=site_url('manage-pengarang')?>">Data Pengarang</a></li>
	  </nav>
	</div>
</div>

	<script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
	<script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
	<script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
  <script>
		var tnama = document.getElementById('tnama');
		var talamat = document.getElementById('talamat');
		var fpenerbit = document.getElementById('fpenerbit');

		function editpenerbit(no) {
			var selected_row = event.target.closest('tr');
			var nama = selected_row.children[1].innerHTML;
			var alamat = selected_row.children[2].innerHTML;

			console.log('nama '+nama);
			console.log('alamat '+alamat);

			$('#caption-penerbit').val('FORM EDIT PENERBIT');
			fpenerbit.action = "<?=site_url('manage-penerbit/edit/?no=')?>" + no;
			fpenerbit.querySelector('button').innerHTML = 'edit';
			tnama.value = nama;
			talamat.value = alamat;
		}
	</script>
</body>
</html>