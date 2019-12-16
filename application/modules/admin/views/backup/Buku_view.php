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
		<a><h4>LOGO</h4></a>
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
  <label data-function="swipe" for="swipe">&#xf057;</label>
  <label data-function="swipe" for="swipe">&#xf0c9;</label>
<!--    <div class="row">-->
  <div class="headings">
  	<section>
  		<div class="forms-group">
  			<form action="<?=site_url('manage-buku/addinfo')?>" method="post" id="forms-infobuku" onreset="resetforminfo()" onsubmit="return submitinfo()">
					<table>
						<caption>TAMBAH INFO BUKU</caption>
						<tbody>
							<tr>
								<td>ISBN: </td>
								<td>
									<input type="text" name="txtisbn" id="tisbn" />
								</td>
							</tr>
							<tr>
								<td>Judul: </td>
								<td>
									<textarea name="txtjudul" id="tjudul"></textarea>
								</td>
							</tr>
							<tr id="trpengarang">
								<td>Pengarang: </td>
								<td>
									<input type="text" name="txtpengarang[]" class="tpengarang" />
								</td>
							</tr>
							<tr>
								<td></td>
								<td><button onclick="return addpengarang()" class="btn btn-warning">tambah pengarang</button></td>
							</tr>
							<tr>
								<td>Penerbit: </td>
								<td>
									<select name="opsipenerbit" id="tpenerbit">
									<?php foreach ($list_penerbit as $key => $value) { ?>								
										<option value="<?=$value['id']?>"><?=$value['nama']?></option>
									<?php } ?>
									</select>
									<br/>
									<a href="<?=site_url('manage-penerbit')?>">Tambah Penerbit</a>
								</td>
							</tr>
							<tr>
								<td>Tahun Terbitan: </td>
								<td>
									<input type="text" name="txtterbitan" id="tterbitan" />
								</td>
							</tr>
							<tr>
								<td>
									<button type="submit" id="btninfosubmit">tambah</button>
								</td>
								<td>
									<button type="reset">reset</button>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
  		</div>
  		<div class="forms-group">
  			<form action="<?=site_url('manage-buku/additem')?>" method="post" id='forms-item'>
					<table>
						<caption>Tambah Item Buku</caption>
						<tbody>
							<tr>
								<td>
									ID Buku
								</td>
								<td>
									<input type="text" name="txtiditem"/>
								</td>
							</tr>
							<tr>
								<td>
									ISBN: 
								</td>
								<td>
									<input type="text" name="txtitemisbn" id="itemisbn" />
								</td>
							</tr>
							<tr>
								<td>
									Harga: 
								</td>
								<td>
									<input type="text" name="txtharga" id="tharga">
								</td>
							</tr>
							<tr>
								<td>
									Tanggal Pembelian: 
								</td>
								<td>
									<input type="date" name="txttglbeli">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<button type="submit" disabled id="btnitem">Tambah Item Buku</button>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
  		</div>
  	</section>	
	<br/>
	<div class="headings">
		<section>
			<div>
				<table id="table-info" class="databook table">
					<thead>
						<tr>
							<th>#</th>
							<th>ISBN</th>
							<th>Judul</th>
							<th>Pengarang</th>
							<th>Penerbit</th>
							<th>Tahun Terbit</th>
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
							<td><?=$value['eksemplar']?></td>
							<td>
								<div class="btn-group" role="group">
									<button class="btn btn-outline-success" onclick="editinfo(<?=$value['idpenerbit']?>)">edit</button>
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
	  </nav>
	</div>
</div>

	<script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
	<script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
	<script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
	<script src="<?=base_url('assets/js/custom/')?>buku.js"></script>
</body>
</html>