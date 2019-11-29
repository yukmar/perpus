<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="<?=site_url('manage-penerbit/add')?>" method="post" id="fpenerbit">
		<table>
			<caption>Tambah Penerbit</caption>
			<tbody>
				<tr>
					<td>Nama Penerbit: </td>
					<td>
						<textarea name="txtnama" id="tnama"></textarea>
					</td>
				</tr>
				<tr>
					<td>Kota: </td>
					<td>
						<input type="text" name="txtkota" id="tkota"/>
					</td>
				</tr>
				<tr>
					<td>
						<button type="submit">Tambah</button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<table>
		<caption>Data Penerbit</caption>
		<thead>
			<tr>
				<th>#</th>
				<th>Nama Penerbit</th>
				<th>Kota</th>
				<th>aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($info_penerbit as $key => $value) { ?>
			<tr>
				<td><?=$key+1?></td>
				<td><?=$value['nama']?></td>
				<td><?=$value['kota']?></td>
				<td>
					<button onclick="editpenerbit(<?=$value['id']?>)">Edit</button>
				</td>
				<td>
					<a href="<?=site_url('manage-penerbit/delete/?no=').$value['id']?>">Delete</a>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<script>
		var tnama = document.getElementById('tnama');
		var tkota = document.getElementById('tkota');
		var fpenerbit = document.getElementById('fpenerbit');

		function editpenerbit(no) {
			var selected_row = event.target.closest('tr');
			var nama = selected_row.children[1].innerHTML;
			var kota = selected_row.children[2].innerHTML;

			fpenerbit.firstChild.nextSibling.caption.innerHTML = 'EDIT PENERBIT';
			fpenerbit.action = "<?=site_url('manage-penerbit/edit/?no=')?>" + no;
			fpenerbit.querySelector('button').innerHTML = 'edit';
			tnama.value = nama;
			tkota.value = kota;
		}
	</script>
</body>
</html>