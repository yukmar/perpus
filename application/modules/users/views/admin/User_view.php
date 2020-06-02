<?=$this->load->view('base_template/admin/header_view.php')?>
<div class="containers container-fluid">
	<input data-function="swipe" id="swipe" type="checkbox">
  <label data-function="swipe" for="swipe"><i class="fa">&#xf057;</i></label>
  <label data-function="swipe" for="swipe"><i class="fa">&#xf0c9;</i></label>
<!--    <div class="row">-->
	<div class="headings section-break">
		<div class="linebreak"></div>
		<h2 class="caption-page">PENGELOLAAN USER</h2>
		<div class="linebreak"></div>
	</div>
  <div class="headings row">
  	<section class="col-sm-6">
	  	<h3 class="caption-form text-center">SISWA</h3>
  		<div class="row container-fluid">
  			<div class="container border-form">
	  			<form action="<?=site_url('manage-user/add/?t=2')?>" method="post" id="form-siswa" data-role="tambah">
	  			<h5>FORM TAMBAH USER SISWA</h5>
	  				<div class="form-group row">
							<label class="col-sm-2 col-form-label">NIS</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" placeholder="Nomor Induk Siswa" name="txtnis" />
             		<small class="form-text text-danger" id="nis-message"></small>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Nama</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" placeholder="Nama Siswa" name="txtnama" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Kelas</label>
							<div class="col-sm-10">
								<!-- <input type="text" class="form-control" placeholder="Kelas" name="txtkelas" /> -->
								<select name="kelas">
									<?php foreach ($kelas as $key => $value) { ?>
									<option value="<?=$value['id']?>"><?=$value['nama']?></option>
									<?php } ?>
								</select>
             		<small class="form-text text-primary" id="btn-addkelas" data-role="tambah">tambah kelas</small>
							</div>
						</div>
						<div class="form-group row" id="divpass">
							<label class="col-sm-2 col-form-label">Password</label>
							<div class="col-sm-10">
								<input type="password"class="form-control" placeholder="Password"  name="txtpass" />
							</div>
						</div>
						<button class="btn btn-primary" type="submit">TAMBAH</button>
						<button class="btn btn-danger" type="reset">RESET</button>
					</form>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="container pt-2">
					<h4>DATA USER SISWA</h4>
					<table class="databook table" id="table-siswa">
						<thead>
							<tr>
								<th>#</th>
								<th>nis</th>
								<th>Nama Siswa</th>
								<th>Kelas</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php	foreach ($data_siswa as $key => $value) { ?>
							<tr>
								<td><?=$key+1?></td>
								<td><?=$value['nis']?></td>
								<td><?=$value['nama']?></td>
								<td><?=$value['kelas']?></td>
								<td>
									<div class="btn-group" role="group">
										<button class="btn btn-outline-success btn-siswa" data-nis="<?=$value['nis']?>" data-kelas="<?=$value['idkelas']?>">Ubah</button>
										<a class="btn btn-outline-danger" href="<?=site_url('manage-user/delete/?t=2&u='.$value['nis'])?>">Hapus</a>
									</div>
								</td>
							</tr>
							<?php	} ?>
						</tbody>
					</table>
				</div>
  		</div>
  		<br>
  		<div class="row">
  			<div class="container pt-2">
  				<h4>DATA KELAS</h4>
  				<table class="table databook" id="table-kelas">
  					<thead>
  						<tr>
  							<th>#</th>
  							<th>Nama Kelas</th>
  							<th>Total Siswa</th>
  							<th>Aksi</th>
  						</tr>
  					</thead>
  					<tbody>
  						<?php foreach ($kelas as $key => $value) { ?>
  						<tr>
  							<td><?=$key+1?></td>
  							<td><?=$value['nama']?></td>
  							<td><?=$value['total']?></td>
  							<td>
  								<div class="btn-group">
  									<button class="btn btn-outline-success btn-kelas" data-kelas="<?=$value['id']?>" data-role="edit">Ubah</button>
  									<a href="<?=site_url('manage-user/delete-kelas/?k=').$value['id']?>" class="btn btn-outline-danger" >Hapus</a>
  								</div>
  							</td>
  						</tr>
  						<?php } ?>
  					</tbody>
  				</table>
  			</div>
  		</div>
  	</section>
  	<section class="col-sm-6">
	  	<h3 class="caption-form text-center">PETUGAS</h3>
  		<div class="row container-fluid">
  			<div class="container border-form">
	  			<h5 id="caption-petugas">FORM TAMBAH USER PETUGAS</h5>
	  			<form action="<?=site_url('manage-user/add/?t=1')?>" method="post" id="form-petugas" data-role="tambah">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">NIP</label>
							<div class="col-sm-10">
								<input class="form-control" placeholder="Nomor Induk Pegawai" type="textbox" name="txtnip" />
             		<small class="form-text text-danger" id="nip-message"></small>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Nama</label>
							<div class="col-sm-10">
								<input class="form-control" placeholder="Nama Pegawai" type="textbox" name="txtnama" />
							</div>
						</div>
						<div class="form-group row" id="passpetugas">
							<label class="col-sm-2 col-form-label">Password</label>
							<div class="col-sm-10">
								<input class="form-control" placeholder="Password" type="password" name="txtpass" />
							</div>
						</div>
						<button class="btn btn-primary" type="submit">TAMBAH</button>
						<button class="btn btn-danger" type="reset">RESET</button>
					</form>
				</div>
			</div>
			<br>
			<div class="row container-fluid">
				<div class="container pt-2">
					<h4>DATA USER PETUGAS</h4>
					<table class="databook table" id="table-petugas">
						<thead>
							<tr>
								<th>#</th>
								<th>NIP</th>
								<th>Nama Petugas</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php	foreach ($data_petugas as $key => $value) { ?>
							<tr>
								<td><?=$key+1?></td>
								<td><?=$value['nip']?></td>
								<td><?=$value['nama']?></td>
								<td>
									<div class="btn-group" role="group">
										<button class="btn btn-outline-success btn-petugas">ubah</button>
										<a class="btn btn-outline-danger" href="<?=site_url('manage-user/delete/?t=1&u='.$value['nip'])?>">delete</a>
									</div>
								</td>
							</tr>
							<?php	} ?>
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
	  </nav>
	</div>
</div>
<?php $this->load->view('base_template/admin/footer_view.php');?>
<div class="modal__login loginform">
  <div class="modal__login-content">
    <span class="modal__login-close" data-role="tambah">×</span>
		<form action="<?=site_url('manage-user/add-kelas')?>" method="post" id="form-login">
			<label>TAMBAH KELAS</label>
			<div class="modal__login-forms-group">
				<input type="text" placeholder="Masukkan Nama Kelas" class="modal__login-forms-control" name="newkelas" id="tuser" data-role="NIP/NIS" />
			</div>
			<button type="submit" class="modal__login-btn btn-primary" id="btn-login">TAMBAH KELAS</button>
		</form>
	</div>
</div>

<div class="modal__daftar daftarform">
  <div class="modal__daftar-content">
    <span class="modal__daftar-close" data-role="edit">×</span>
    <form action="<?=site_url('manage-user/edit-kelas/')?>" id="form-daftar" method="post">
      <label>EDIT KELAS</label>
      <div class="modal__daftar-forms-group">
         <input type="text" class="modal__daftar-forms-control" name="editkelas"/>
         <input type="hidden" name="nokelas"/>
      </div>
      <small class="form-text text-danger"></small>
      <button type="submit" class="modal__daftar-btn btn-primary" id="btn-daftar">EDIT KELAS</button>
    </form>
  </div>
</div>

	<script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
	<script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
	<script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
  <script src="<?=base_url('assets/js/custom/')?>user.js"></script>
</body>
</html>