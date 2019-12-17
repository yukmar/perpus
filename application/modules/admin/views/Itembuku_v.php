<?=$this->load->view('header_view.php')?>
<div class="containers">
  <input data-function="swipe" id="swipe" type="checkbox">
  <label data-function="swipe" for="swipe"><i class="fa">&#xf057;</i></label>
  <label data-function="swipe" for="swipe"><i class="fa">&#xf0c9;</i></label>
  <div class="headings section-break">
		<div class="linebreak"></div>
		<h2 class="caption-page">ITEM BUKU</h2>
		<div class="linebreak"></div>
	</div>
  <div class="headings container-fluid row justify-content-center">
  	<section class="col-sm-10">
  		<div class="row container-fluid">
  		<div class="container border-form">
  			<table>
				<tbody>
					<tr>
						<td>ISBN</td><td>: <?=$isbn?></td>
					</tr>
					<tr>
						<td>Judul Buku</td><td>: <?=$judul?></td>
					</tr>
					<tr>
						<td>Pengarang</td><td>: <?=$pengarang?></td>
					</tr>
					<tr>
						<td>Penerbit</td><td>: <?=$penerbit?></td>
					</tr>
					<tr>
						<td>Tahun Terbit</td><td>: <?=$tahun?></td>
					</tr>
				</tbody>
			</table>
			<button class="btn btn-primary" id="btn-tambah" data-role="tambah">TAMBAH ITEM BUKU</button>
  		</div>
  		</div>
  		<div class="row">
  			<div class="container">
  				<table class="table databook" id="table-item">
					<thead>
						<tr>
							<th>#</th>
							<th>Kode Buku</th>
							<th>Tanggal Pembelian</th>
							<th>Harga</th>
							<th>Status</th>
							<th>aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($item) { 
						foreach ($item as $key => $value) { ?>
						<tr>
							<td><?=$key+1?></td>
							<td><a href="<?=site_url('item-buku/detail/?no=').$value['id']?>"><?=$value['id']?></a></td>
							<td><?=$value['tgl_beli']?></td>
							<td><?=$value['harga']?></td>
							<td><?=$value['status']?></td>
							<td>
								<div class="btn-group" role="group">
									<button class="btn btn-outline-success btn-edit" data-role="edit">edit</button>
									<a class="btn btn-outline-danger" href="<?=site_url('item-buku/delete/?isbn='.$isbn.'&no='.$value['id'])?>">delete</a>
								</div>
							</td>
						</tr>
						<?php }	
						} ?>
					</tbody>
				</table>
  			</div>
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

<div class="modal__login loginform" id="fedit">
	<div class="modal__login-content">
		<span class="modal__login-close" data-role="edit">×</span>
		<form action="<?=site_url('item-buku/edit')?>" method="post">		
			<label>FORM EDIT</label>
			<div class="modal__login-forms-group">
				<span class="modal__login-forms-control">Kode buku: </span>
				<input type="text" placeholder="Masukkan Kode Buku" class="modal__login-forms-control" name="txtkodebuku" />
			</div>
      <small class="form-text text-danger"></small>
			<div class="modal__login-forms-group">
				<span class="modal__login-forms-control">Tanggal Pembelian: </span>
				<input type="date" placeholder="Masukkan Tanggal Pembelian" class="modal__login-forms-control" name="txttglbeli" />
			</div>
			<div class="modal__login-forms-group">
				<span class="modal__login-forms-control">Harga: </span>
				<input type="text" placeholder="Masukkan Harga" class="modal__login-forms-control" name="txtharga" />
			</div>
			<button type="submit" class="modal__login-btn btn-primary" value="Login">EDIT</button>
			<input type="hidden" name="kodeold"/>
			<input type="hidden" name="isbn" value="<?=$isbn?>" />
		</form>
	</div>
</div>
<div class="modal__login loginform" id="ftambah">
	<div class="modal__login-content">
		<span class="modal__login-close" data-role="tambah">×</span>
		<form action="<?=site_url('item-buku/add')?>" method="post">		
			<label>FORM TAMBAH</label>
			<div class="modal__login-forms-group">
				<span class="modal__login-forms-control">Kode buku: </span>
				<input type="text" placeholder="Masukkan Kode Buku" class="modal__login-forms-control" name="tambahkodebuku" />
			</div>
      <small class="form-text text-danger"></small>
			<div class="modal__login-forms-group">
				<span class="modal__login-forms-control">Tanggal Pembelian: </span>
				<input type="date" placeholder="Masukkan Tanggal Pembelian" class="modal__login-forms-control" name="tambahtglbeli" value="0000-00-00"/>
			</div>
			<div class="modal__login-forms-group">
				<span class="modal__login-forms-control">Harga: </span>
				<input type="text" placeholder="Masukkan Harga" class="modal__login-forms-control" name="tambahharga" />
			</div>
			<button type="submit" class="modal__login-btn btn-primary" value="Login">TAMBAH</button>
			<input type="hidden" name="isbn" value="<?=$isbn?>" />
		</form>
	</div>
</div>
	<script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
	<script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
	<script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
	<script src="<?=base_url('assets/js/custom/')?>item.js"></script>
</body>
</html>