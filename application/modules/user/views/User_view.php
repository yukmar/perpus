<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Library</title>
  <link rel="stylesheet" href="<?=base_url('assets/css/custom/')?>font.css">
  <link rel="stylesheet" href="<?=base_url('assets/css/custom/')?>custom.css">
	<link rel="stylesheet" href="<?=base_url('assets/css/')?>jquery.dataTables.min.css"/>
	<link rel="stylesheet" href="<?=base_url('assets/css/')?>dataTables.bootstrap4.min.css"/>
	<link rel="stylesheet" href="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.css"/>
  <link rel="stylesheet" href="<?=base_url('assets/icons/fontawesome/css/all.min.css')?>">
</head>
<body>
<header id="split">
	<div class="split__left">
		<a><img src="<?=base_url('assets/images/logo.png')?>" /></a>
	</div>
	<div class="split__center">
		<form>
		<div class="search">
		<input class="forms-control" type="search" placeholder="Tulis judul disini">
		<i class="fas fa-search forms-control button"></i>
		</div>
		</form>
	</div>
	<div class="split__right">
		<a class="btn-menu" href="<?=site_url('logout')?>">Logout</a>
	</div>
</header>
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
	  			<form action="<?=site_url('user/edit')?>" method="post">
	  				<input type="hidden" name="oldnis" value="<?=$profile[0]['nis']?>" />
	  				<div class="form-group row">
	  					<label class="col-sm-2 col-form-label">NIS</label>
	  					<div class="col-sm-10">
	  						<input type="text" class="form-control" name="txtnis" id="tnis" value="<?=$profile[0]['nis']?>">
	  					</div>
	  				</div>
	  				<div class="form-group row">
	  					<label class="col-sm-2 col-form-label">Nama</label>
	  					<div class="col-sm-10">
	  						<input type="text" class="form-control" name="txtnama" id="tnama" value="<?=$profile[0]['nama']?>"/>
	  					</div>
	  				</div>
	  				<div class="form-group row">
	  					<label class="col-sm-2 col-form-label">Kelas</label>
	  					<div class="col-sm-10">
	  						<input type="text" class="form-control" name="txtkelas" id="tkelas" value="<?=$profile[0]['kelas']?>" disabled/>
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

	<script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
	<script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
	<script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
</body>
</html>