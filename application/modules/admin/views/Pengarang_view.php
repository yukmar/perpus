<?=$this->load->view('header_view.php')?>
<div class="containers">
  <input data-function="swipe" id="swipe" type="checkbox">
  <label data-function="swipe" for="swipe"><i class="fa">&#xf057;</i></label>
  <label data-function="swipe" for="swipe"><i class="fa">&#xf0c9;</i></label>

  <div class="headings section-break">
		<div class="linebreak"></div>
		<h2 class="caption-page">PENGELOLAAN PENGARANG</h2>
		<div class="linebreak"></div>
	</div>

  <div class="headings container-fluid row justify-content-center">
  	<section class="col-sm-9">
  		<div class="row container-fluid">
  			<div class="container border-form">
  				<h5 id="title-form">Form Tambah Pengarang</h5>
  				<form action="<?=site_url('manage-pengarang/add')?>" onreset="reset_form()" method="post" id="form-pengarang" data-role="tambah">
  					<div class="form-group row">
  						<label class="col-sm-3 col-form-label">Nama Pengarang</label>
  						<textarea class="col-sm-9" name="txtnama" id="tnama"></textarea>
              <small class="form-text text-danger"></small>
  					</div>
  					<input type="hidden" name="txid" id="tid" />
  					<button type="submit" class="btn btn-primary" id="btn-form">Tambah</button>
  					<button type="reset" class="btn btn-danger">Reset</button>
  				</form>	
  			</div>
  		</div>
  		<div class="row  container-fluid justify-content-center">
  			<table class="table databook" id="table-pengarang">
  				<thead>
  					<tr>
  						<th>#</th>
  						<th>Nama Pengarang</th>
  						<th>Total</th>
  						<th>Aksi</th>
  					</tr>
  				</thead>
  				<tbody>
  					<?php foreach ($item as $key => $value) { ?>
  					<tr>
  						<td><?=$key+1?></td>
  						<td><?=$value['nama']?></td>
  						<td><?=$value['total']?></td>
  						<td>
  							<div class="btn-group">
  								<button class="btn btn-outline-success" onclick="edit_pengarang(<?=$value['id']?>)">Edit</button>
  								<a class="btn btn-outline-danger" href="<?=site_url('manage-pengarang/delete/?no=').$value['id']?>">Hapus</a>
  							</div>
  						</td>
  					</tr>
  					<?php } ?>
  				</tbody>
  			</table>
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
  <script src="<?=base_url('assets/js/custom/')?>pengarang.js"></script>
</body>
</body>
</html>