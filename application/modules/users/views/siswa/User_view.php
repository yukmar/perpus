<?php $this->load->view('base_template/siswa/header_view'); ?>
<div class="containers">
  <input data-function="swipe" id="swipe" type="checkbox">
  <label data-function="swipe" for="swipe"><i class="fa">&#xf057;</i></label>
  <label data-function="swipe" for="swipe"><i class="fa">&#xf0c9;</i></label>

  <div class="headings section-break">
		<div class="linebreak"></div>
		<h2 class="caption-page">USER</h2>
		<div class="linebreak"></div>
	</div>
  <div class="headings container-fluid row justify-content-center">
  	<section class="col-sm-11">
  		<div class="row container-fluid">
  			<div class="container border-form">
	  			<h5 id="caption-penerbit">PROFILE USER</h5>
	  			<form action="<?=site_url('siswa/edit')?>" method="post">
	  				<input type="hidden" name="oldnis" value="<?=$profile['nis']?>" />
	  				<div class="form-group row">
	  					<label class="col-sm-2 col-form-label">NIS</label>
	  					<div class="col-sm-10">
	  						<input type="text" class="form-control" name="txtnis" id="tnis" value="<?=$profile['nis']?>" disabled>
	  					</div>
	  				</div>
	  				<div class="form-group row">
	  					<label class="col-sm-2 col-form-label">Nama</label>
	  					<div class="col-sm-10">
	  						<input type="text" class="form-control" name="txtnama" id="tnama" value="<?=$profile['nama']?>"/>
	  					</div>
	  				</div>
	  				<div class="form-group row">
	  					<label class="col-sm-2 col-form-label">Kelas</label>
	  					<div class="col-sm-10">
	  						<input type="text" class="form-control" name="txtkelas" id="tkelas" value="<?=$profile['kelas']?>" disabled/>
	  					</div>
	  				</div>
	  				<div class="form-group row">
	  					<label class="col-sm-2 col-form-label">Password</label>
	  					<div class="col-sm-10">
	  						<input type="password" class="form-control" name="txtpass" id="tpass"/>
	  					</div>
	  				</div>
	  				<button type="submit" class="btn btn-primary">Edit</button>
	  			</form>
  			</div>
  		</div>
  		<div class="row">
  			<div class="container pt-2">
  				<h5>Table Riwayat Pengembalian</h5>
	  			<table class="table databook">
						<thead>
							<tr>
								<th>#</th>
								<th>Kode Buku</th>
								<th>ISBN</th>
								<th>Judul</th>
								<th>Tanggal Batas Peminjaman</th>
								<th>Tanggal Kembali</th>
								<th>Denda</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($riwayat as $key => $value) { ?>
							<tr>
								<td><?=$key+1?></td>
								<td><?=$value->idbuku?></td>
								<td><?=$value->isbn?></td>
								<td><?=$value->judul?></td>
								<td><?=$value->tgl_bataspinjam?></td>
								<td><?=$value->tgl_kembali?></td>
								<td><?=$value->denda?></td>
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
	  </nav>
	</div>
</div>
<?php $this->load->view('base_template/footer_view.php'); ?>

	<script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
	<script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
	<script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
</body>
</html>