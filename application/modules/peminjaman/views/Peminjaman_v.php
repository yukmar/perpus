<?=$this->load->view('base_template/admin/header_view.php')?>
<div class="containers">
  <input data-function="swipe" id="swipe" type="checkbox">
  <label data-function="swipe" for="swipe"><i class="fa">&#xf057;</i></label>
  <label data-function="swipe" for="swipe"><i class="fa">&#xf0c9;</i></label>

  <div class="headings section-break">
		<div class="linebreak"></div>
		<h2 class="caption-page">PEMINJAMAN</h2>
		<div class="linebreak"></div>
	</div>

  <div class="headings container-fluid row justify-content-center">
  	<section class="col-sm-11 border-form">
  		<div class="row container-fluid">
  			<div class="container">
  				<h3>CEK BUKU</h3>
	  			<form id="fpinjam" onsubmit="return false">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">NIS</label>
							<div class="col-sm-10">
								<div class="form-inline">
									<input type="text" class="form-control col-sm-6" placeholder="Nomor Induk Siswa" name="txtnis" id="tnis">
									<button class="btn btn-primary ml-2" onclick="cek_nis()">Cek Nomor Induk Siswa</button>
								</div>
								<small class="form-text text-danger" id="keterangan-nis"></small>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Kode Buku</label>
							<div class="col-sm-10">
								<div class="form-inline">
									<input type="text" class="form-control col-sm-6" placeholder="Kode Buku" name="txtidbuku" id="tidbuku" disabled/>
									<button class="btn btn-primary ml-2" onclick="cek_buku()" id='btn-kodebuku' disabled>Cek Ketersediaan Buku</button>
								</div>
								<small class="form-text text-danger" id="keterangan-idbuku"></small>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Judul</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="txtjudul" id="tjudul" disabled/></textarea>
							</div>
						</div>
						<button class="btn btn-primary" id="btn-tambah" disabled>Tambah</button>
					</form>
				</div>
			</div>
			<br>
			<div class="row container-fluid">
				<div class="container">
					<h3>DAFTAR KERANJANG BUKU</h3>
					<form action="<?=site_url('peminjaman/pinjam')?>" method="post">
						<input type="hidden" name="txnis" id="hidden-nis" />
						<table class="table databook" id="daftar-pinjam">
							<thead>
								<tr>
									<th>Kode Buku</th>
									<th>ISBN</th>
									<th>Judul Buku</th>
									<th>Pengarang</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Tanggal Batas Peminjaman:</label>
							<div class="col-sm-10">
								<input class="form-control" type="date" name="tglbatas" id="tgl_batas" disabled/>
							</div>
						</div>
						<button class="btn btn-primary" type="submit" id="btn_pinjam" disabled>Pinjam</button>
					</form>
				</div>
			</div>
  	</section>
  </div>
  <div class="second-linebreak"></div>
  <div class="headings row container-fluid justify-content-center">
		<section class="col-sm-11">
			<div>
				<h2 class="text-center">DATA PEMINJAMAN</h2>
				<table class="table databook" id="tablepeminjaman">
						<caption>Daftar Peminjaman</caption>
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
								<th>Aksi</th>
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
								<td>
								<?php if (!$value->tgl_kembali) { ?>
									<a class="btn btn-primary" href="<?=site_url('pengembalian')?>">Kembali</a>
								<?php } ?>
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
<?php $this->load->view('base_template/footer_view.php');?>

	<script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
	<script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
	<script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
	<script src="<?=base_url('assets/js/custom/')?>peminjaman.js"></script>
</body>
</html>