<?php $this->load->view('base_template/admin/header_view'); ?>
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
	  </nav>
	</div>
</div>
<?php $this->load->view('base_template/admin/footer_view.php');?>
	<script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
	<script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
	<script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
  <script src="<?=base_url('assets/js/custom/')?>petugas.js"></script>
</body>
</html>