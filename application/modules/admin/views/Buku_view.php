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
	<form action="<?=site_url('manage-buku/addinfo')?>" method="post" id="form-infobuku">
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
				<tr>
					<td>Pengarang: </td>
					<td>
						<textarea name="txtpengarang" id="tpengarang"></textarea>
					</td>
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
					<td>data</td>
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
				<td><?=$value['total_eksemplar']?></td>
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

	<script>
		var tisbn = document.getElementById('tisbn');
		var tjudul = document.getElementById('tjudul');
		var tpengarang = document.getElementById('tpengarang');
		var tpenerbit = document.getElementById('tpenerbit');
		var finfo = document.getElementById('form-infobuku');

		function editinfo(no) {
			var selected_row = event.target.closest('tr');
			var isbn = selected_row.children[1].innerHTML;
			var judul = selected_row.children[2].innerHTML;
			var pengarang = selected_row.children[3].innerHTML;

			finfo.firstChild.nextSibling.caption.innerHTML = 'EDIT INFO BUKU';
			finfo.action = "<?=site_url('manage-buku/edit/?no=')?>" + isbn;
			finfo.querySelector('button').innerHTML = 'edit';

			tisbn.value = isbn;
			tjudul.value = judul;
			tpengarang.value = pengarang;
			tpenerbit.value = no;
		}
	</script>
</body>
</html>