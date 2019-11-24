<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="<?=site_url('manage-user/add/?t=2')?>" method="post" id="form_siswa" onreset="resethandling(2)">
		<table>
			<caption>CREATE SISWA</caption>
			<tbody>
				<tr>
					<td><?=rand(1000000000, 9999999999)?></td>
				</tr>
				<tr>
					<td>nisn: </td> 
					<td>
						<input type="textbox" name="txtiduser" id="tnisn" />
					</td>
				</tr>
				<tr>
					<td>nama: </td>
					<td>
						<input type="textbox" name="txtnama" id="tnama_siswa" />
					</td>
				</tr>
				<tr style="display: none">
					<td>password: </td>
					<td>
						<input type="password" name="txtpass" />
					</td>
				</tr>
				<tr>
					<td>
						<button type="submit">create</button>
					</td>
					<td>
						<button type="reset">reset</button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<form action="<?=site_url('manage-user/add/?t=1')?>" method="post" id="form_petugas" onreset="resethandling(1)">
		<table>
			<caption>CREATE PEGAWAI</caption>
			<tbody>
				<tr>
					<td><?=rand(100000000000000000, 999999999999999999)?></td>
				</tr>
				<tr>
					<td>nip:</td>
					<td>
						<input type="textbox" name="txtiduser" id="tnip" />
					</td>
				</tr>
				<tr>
					<td>nama:</td>
					<td>
						<input type="textbox" name="txtnama" id="tnama_petugas"/>
					</td>
				</tr>
				<tr style="display: none">
					<td>password: </td>
					<td>
						<input type="password" name="txtpass" />
					</td>
				</tr>
				<tr>
					<td>
						<button type="submit">create</button>
					</td>
					<td>
						<button>reset</button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
<br/>
<br/>
	<table>
		<caption>DATA SISWA</caption>
		<thead>
			<tr>
				<th>#</th>
				<th>NISN</th>
				<th>Nama Siswa</th>
			</tr>
		</thead>
		<tbody>
			<?php	foreach ($data_siswa as $key => $value) { ?>
			<tr>
				<td><?=$key+1?></td>
				<td><?=$value['nisn']?></td>
				<td><?=$value['nama']?></td>
				<td><button onclick="editsiswa(<?=$value['nisn']?>)">edit</button></td>
				<td><a href="<?=site_url('manage-user/delete/?t=2&u='.$value['nisn'])?>">delete</a></td>
			</tr>
			<?php	} ?>
		</tbody>
	</table>
<br/>
<br/>
	<table>
		<caption>DATA PETUGAS</caption>
		<thead>
			<tr>
				<th>#</th>
				<th>NIP</th>
				<th>Nama Petugas</th>
			</tr>
		</thead>
		<tbody>
			<?php	foreach ($data_petugas as $key => $value) { ?>
			<tr>
				<td><?=$key+1?></td>
				<td><?=$value['nip']?></td>
				<td><?=$value['nama']?></td>
				<td><button onclick="editpetugas(<?=$value['nip']?>)">edit</button></td>
				<td><a href="<?=site_url('manage-user/delete/?t=1&u='.$value['nip'])?>">delete</a></td>
			</tr>
			<?php	} ?>
		</tbody>
	</table>

	<script>
		var form_siswa = document.getElementById('form_siswa');
		var form_petugas = document.getElementById('form_petugas');
		var tnisn = document.getElementById('tnisn');
		var tnama_siswa = document.getElementById('tnama_siswa');
		var tnip = document.getElementById('tnip');
		var tnama_petugas = document.getElementById('tnama_petugas');

		function editsiswa(u) {
			var selected_row = event.target.closest('tr');
			var nisn = selected_row.children[1].innerHTML;
			var nama = selected_row.children[2].innerHTML;

			form_siswa.firstChild.nextSibling.caption.innerHTML = 'EDIT SISWA';
			form_siswa.action = "<?=site_url('manage-user/edit/?t=2&u=')?>" + u;
			tnisn.value = nisn;
			tnama_siswa.value = nama;
			form_siswa.querySelector('button').innerHTML = 'edit';
			form_siswa.childNodes[1].children[1].children[3].style.display = 'table-row';
			console.log(form_siswa.childNodes[1].children[1].children[3]);
		}

		function editpetugas(u) {
			var selected_row = event.target.closest('tr');
			var nip = selected_row.children[1].innerHTML;
			var nama = selected_row.children[2].innerHTML;
			var nipnya = u.toString();
			form_petugas.firstChild.nextSibling.caption.innerHTML = 'EDIT SISWA';
			console.log(nipnya);
			// console.log("test");
			form_petugas.action = "<?=site_url('manage-user/edit/?t=1&u=')?>" + u;
			tnip.value = nip;
			tnama_petugas.value = nama;
			form_petugas.querySelector('button').innerHTML = 'edit';
			form_petugas.childNodes[1].children[1].children[3].style.display = 'table-row';
			console.log(form_petugas.childNodes[1].children[1].children[3]);
		}

		function resethandling(t) {
			var caption = event.target.querySelector('caption');
			var title = event.target.querySelector('caption').innerHTML.split(" ");
			event.target.querySelector('caption').innerHTML = 'CREATE '+title[1];
			event.target.childNodes[1].children[1].children[3].style.display = 'none';
			event.target.action = "<?=site_url('manage-user/add/?t=')?>"+t;
		}
	</script>
</body>
</html>