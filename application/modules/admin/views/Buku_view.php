<?=$this->load->view('header_view.php')?>
<div class="containers">
  <input data-function="swipe" id="swipe" type="checkbox">
  <label data-function="swipe" for="swipe"><i class="fa">&#xf057;</i></label>
  <label data-function="swipe" for="swipe"><i class="fa">&#xf0c9;</i></label>
<!--    <div class="row">-->
	<div class="headings section-break">
		<div class="linebreak"></div>
		<h2 class="caption-page">PENGELOLAAN BUKU</h2>
		<div class="linebreak"></div>
	</div>
  <div class="headings container-fluid row justify-content-center">
  	<section class="col-sm-11">
  		<div class="row container-fluid">
  			<div class="container border-form">
  				<h5 id="caption-buku">Form Tambah Info Buku</h5>
		  		<div class="forms-group">
		  			<form action="<?=site_url('manage-buku/addinfo')?>" method="post" id="forms-infobuku" onreset="resetforminfo()" data-role="tambah">
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">ISBN</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="txtisbn" id="tisbn" />
									<small class="form-text text-danger"></small>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Judul</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="txtjudul" id="tjudul"></textarea>
									<small class="form-text text-danger"></small>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Pengarang</label>
								<div class="col-sm-10">
									<div class="form-inline mb-2">
										<input type="text" name="txtpengarang[]" class="tpengarang form-control col-sm-9" />
									</div>
									<button onclick="return addpengarang()" class="btn btn-primary">tambah pengarang</button>
									<small class="form-text text-danger"></small>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Penerbit</label>
								<div class="col-sm-10">
									<select class="form-control" name="opsipenerbit" id="tpenerbit">
									<?php foreach ($list_penerbit as $key => $value) { ?>								
										<option value="<?=$value['id']?>"><?=$value['nama']?></option>
									<?php } ?>
									</select>
									<small class="form-text text-muted"><a href="<?=site_url('manage-penerbit')?>">Tambah Penerbit</a></small>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Tahun Terbitan</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="txtterbitan" id="tterbitan" />
									<small class="form-text text-danger"></small>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Genre</label>
								<div class="col-sm-10">
									<select name="genre" class="custom-select">
										<?php foreach ($genre as $key => $value) { ?>
										<option value="<?=$value['id']?>"><?=$value['nama']?></option>
										<?php } ?>
									</select>
									<small class="form-text text-primary"><a onclick="toggleModal('login')">Tambah Genre</a></small>
								</div>
							</div>
							<button class="btn btn-primary" type="submit" id="btninfosubmit">tambah</button>
							<button class="btn btn-danger" type="reset">reset</button>
						</form>
		  		</div>
		  	</div>
  		</div>
  	</section>
  	<!-- 
  	<section class="col-sm-5">
  		<div class="row container-fluid">
  			<div class="container border-form">
  				<h5>Form Tambah Item Buku</h5>
  				<form action="<?=site_url('manage-buku/additem')?>" method="post" id='forms-item'>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Kode Buku</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="txtiditem"/>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">ISBN</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="txtitemisbn" id="itemisbn" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Harga</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="txtharga" id="tharga">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Tanggal Pembelian</label>
							<div class="col-sm-10">
								<input type="date" class="form-control" name="txttglbeli">
							</div>
						</div>
						<button class="btn btn-primary" type="submit" id="btnitem">Tambah Item Buku</button>
  				</form>
  			</div>
  		</div>
  	</section> -->
	</div>
	<div class="headings row container-fluid justify-content-center">
		<section class="col-sm-11">
			<div>
				<h3 class="text-center">DATA BUKU</h3>
				<table id="table-info" class="databook table">
					<thead>
						<tr>
							<th>#</th>
							<th>ISBN</th>
							<th>Judul</th>
							<th>Pengarang</th>
							<th>Penerbit</th>
							<th>Tahun Terbit</th>
							<th>Genre</th>
							<th>total eksemplar</th>
							<th>aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($info_buku as $key => $value) {
						?>
						<tr>
							<td><?=$key+1?></td>
							<td><a href="<?=site_url('item-buku/?isbn=').$value['isbn']?>"><?=$value['isbn']?></a></td>
							<td><?=$value['judul']?></td>
							<td><?=$value['pengarang']?></td>
							<td><?=$value['penerbit']?></td>
							<td><?=$value['tahunterbit']?></td>
							<td><?=$value['genre']?></td>
							<td><?=$value['eksemplar']?></td>
							<td>
								<div class="btn-group" role="group">
									<button class="btn btn-outline-success" data-genre="<?=$value['idgenre']?>" onclick="editinfo(<?=$value['idpenerbit']?>)">edit</button>
									<a class="btn btn-outline-danger" href="<?=site_url('manage-buku/delete/?no=').$value['isbn']?>">delete</a>
								</div>
							</td>
						</tr>
					<?php }
					?>
					</tbody>
				</table>
			</div>
		</section>
  </div>
  <div class="headings row container-fluid justify-content-center">
		<section class="col-sm-11">
			<div>
				<h3 class="text-center">DAFTAR GENRE</h3>
				<table class="table databook" id="table-genre">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Genre</th>
							<th>Total Info Buku</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($genre as $key => $value) { ?>
						<tr>
							<td><?=$key+1?></td>
							<td><?=$value['nama']?></td>
							<td><?=$value['total']?></td>
							<td>
								<div class="btn-group" role="group">
									<button class="btn btn-outline-success" data-genre="<?=$value['id']?>" onclick="toggleModal('daftar')">edit</button>
									<a class="btn btn-outline-danger" href="<?=site_url('manage-buku/delete-genre/?g=').$value['id']?>">delete</a>
								</div>
							</td>
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

<div class="modal__login loginform">
  <div class="modal__login-content">
    <span class="modal__login-close" onclick="toggleModal('login')">×</span>
		<form action="<?=site_url('manage-buku/add-genre')?>" method="post" id="form-login">
			<label>TAMBAH GENRE</label>
			<div class="modal__login-forms-group">
				<input type="text" placeholder="Masukkan Nama Genre" class="modal__login-forms-control" name="newgenre" id="tgenre" data-role="tambah" />
			</div>
			<button type="submit" class="modal__login-btn btn-primary" id="btn-login">TAMBAH GENRE</button>
		</form>
	</div>
</div>

<div class="modal__daftar daftarform">
  <div class="modal__daftar-content">
    <span class="modal__daftar-close" onclick="toggleModal('daftar')">×</span>
    <form action="<?=site_url('manage-buku/edit-genre/')?>" id="form-daftar" method="post">
      <label>EDIT GENRE</label>
      <div class="modal__daftar-forms-group">
         <input type="text" class="modal__daftar-forms-control" name="editgenre" id="tedgenre" />
         <input type="hidden" name="nogenre" id="hidgenre" />
      </div>
      <small class="form-text text-danger"></small>
      <button type="submit" class="modal__daftar-btn btn-primary" id="btn-daftar">EDIT GENRE</button>
    </form>
  </div>
</div>

	<script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
	<script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
	<script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
	<script src="<?=base_url('assets/js/custom/')?>buku.js"></script>
</body>
</html>