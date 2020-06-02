<?=$this->load->view('base_template/admin/header_view.php')?>
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
		  			<form action="<?=site_url('manage-buku/add')?>" method="post" id="forms-infobuku" data-role="tambah">
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
									<textarea class="form-control" name="txtpengarang" id="tpengarang"></textarea>
									<small class="form-text text-danger"></small>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Penerbit</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="txtpenerbit" id="tpenerbit"></textarea>
									<small class="form-text text-danger"></small>
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
									<textarea class="form-control" name="txtgenre" id="tgenre"></textarea>
									<small class="form-text text-danger"></small>
								</div>
							</div>
							<button class="btn btn-primary" type="submit" id="btninfosubmit">tambah</button>
							<button class="btn btn-danger" type="reset">reset</button>
						</form>
		  		</div>
		  	</div>
  		</div>
  	</section>
	</div>
	<div class="headings row container-fluid justify-content-center">
		<section class="col-sm-11">
			<div>
				<h2 class="text-center">DATA BUKU</h2>
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
									<button class="btn btn-outline-success btn-edit" data-genre="<?=$value['isbn']?>">edit</button>
									<a class="btn btn-outline-danger" href="<?=site_url('manage-buku/delete/?isbn=').$value['isbn']?>">delete</a>
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
<?php $this->load->view('base_template/footer_view.php');?>

	<script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
	<script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
	<script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
	<script src="<?=base_url('assets/js/custom/')?>buku.js"></script>
</body>
</html>