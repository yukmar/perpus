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
		<a href="<?=site_url()?>"><img src="<?=base_url('assets/images/logo.png')?>" /></a>
	</div>
	<div class="split__center">
		<form action="<?=site_url('search')?>" method="get" id="form-search">
			<div class="search">
				<input class="forms-control" type="search" placeholder="Tulis judul disini" id="search-box" name="search">
				<!-- <input class="forms-control" type="button" value="Cari"> -->
				<span id="click-search"><i class="fas fa-search forms-control button"></i></span>
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
<!--    <div class="row">-->
	<div class="headings section-break">
		<div class="linebreak"></div>
		<h2 class="caption-page">ADMIN</h2>
		<div class="linebreak"></div>
	</div>
  <div class="headings row container-fluid justify-content-center">
		<section class="col-sm-11">
			<div>
  			<h5 class="text-center">Daftar Peminjaman</h5>
  			<table class="table databook" id="tablepeminjaman">
						<thead>
							<tr>
								<th>#</th>
								<th>Kode Buku</th>
								<th>ISBN</th>
								<th>Judul</th>
								<th>Nama Siswa</th>
								<th>Nama Petugas</th>
								<th>Tanggal Pinjam</th>
								<th>Tanggal Batas Pinjam</th>
								<th>Tanggal Kembali</th>
								<th>Denda</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($list_buku as $key => $value) { ?>
							<tr>
								<td><?=$key+1?></td>
								<td><a href="<?=site_url('item-buku/detail/?no=').$value->idbuku?>"><?=$value->idbuku?></a></td>
								<td><a href="<?=site_url('item-buku/?isbn=').$value->isbn?>"><?=$value->isbn?></a></td>
								<td><?=$value->judul?></td>
								<td><?=$value->nama_siswa?></td>
								<td><?=$value->nama_petugas?></td>
								<td><?=$value->tgl_pinjam?></td>
								<td><?=$value->tgl_bataspinjam?></td>
								<td><?=$value->tgl_kembali?></td>
								<td><?=$value->denda?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
  		</div>
  	</section>
	</div>
	<div class="headings row container-fluid justify-content-center">
		<section class="col-sm-11">
			<div>
  			<h5 class="text-center">Daftar Item Buku</h5>
  			<table class="table databook" id="table-item">
  				<thead>
  					<tr>
  						<th>#</th>
  						<th>Kode Buku</th>
  						<th>ISBN</th>
  						<th>Judul</th>
  						<th>Tahun Terbit</th>
  					</tr>
  				</thead>
  				<tbody>
  					<?php foreach ($list_item as $key => $value) { ?>
  					<tr>
  						<td><?=$key+1?></td>
  						<td><a href="<?=site_url('item-buku/detail/?no=').$value->idbuku?>" title=""><?=$value->idbuku?></a></td>
							<td><a href="<?=site_url('item-buku/?isbn=').$value->isbn?>" title=""><?=$value->isbn?></a></td>
							<td><?=$value->judul?></td>
							<td><?=$value->tahun?></td>
  					</tr>
  					<?php } ?>
  				</tbody>
  			</table>
  		</div>
		</section>
	</div>
<!--    </div>-->
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
<?php $this->load->view('footer_view.php');?>
	<script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
	<script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
	<script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
  <script src="<?=base_url('assets/js/custom/')?>petugas.js"></script>
</body>
</html>