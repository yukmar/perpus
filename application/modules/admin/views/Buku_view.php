<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?=rand(9878798798987, 999999999999)?>
	<form action="<?=site_url('manage-buku/addinfo')?>" method="post" id="form-infobuku" onreset="resetforminfo()">
		<table>
			<caption>Tambah Info Buku</caption>
			<tbody>
				<tr>
					<td>ISBN: </td>
					<td>
						<textarea name="txtisbn" id="tisbn"></textarea>
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
						<input type="text" name="txtpengarang[]" class="tpengarang"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><button onclick="return addpengarang()">tambah pengarang</button></td>
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
					<td>
						<button type="submit">tambah</button>
					</td>
					<td>
						<button type="reset">reset</button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<br/>
	<form action="<?=site_url('manage-buku/additem')?>" method="post">
		<table>
			<caption>Tambah Item Buku</caption>
			<tbody>
				<tr>
					<td>
						ISBN: 
					</td>
					<td>
						<input type="text" name="txtitemisbn" />
					</td>
				</tr>
				<tr>
					<td>
						Harga: 
					</td>
					<td>
						<input type="text" name="txtharga">
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
						<button type="submit">Tambah Item Buku</button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<br/>
	<table>
		<caption>Data Info Buku</caption>
		<thead>
			<tr>
				<th>#</th>
				<th>ISBN</th>
				<th>Judul</th>
				<th>Pengarang</th>
				<th>Penerbit</th>
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
				<td><?=$value['isbn']?></td>
				<td><?=$value['judul']?></td>
				<td><?=$value['pengarang']?></td>
				<td><?=$value['penerbit']?></td>
				<td><?=$value['eksemplar']?></td>
				<td>
					<button onclick="editinfo(<?=$value['idpenerbit']?>)">edit</button>
				</td>
				<td>
					<a href="<?=site_url('manage-buku/delete/?no=').$value['isbn']?>">delete</a>
				</td>
			</tr>
			<?php }
			?>
		</tbody>
	</table>

	<script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
	<script src="<?=base_url('assets/js/jquery-ui-1.12.1/')?>jquery-ui.min.js"></script>
	<script src="<?=base_url('assets/js/custom/')?>buku.js"></script>
</body>
</html>