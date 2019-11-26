<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php
	if (isset($status_regis)) {
		echo $status_regis;
	}
	?>
	<form action="<?=site_url('registrasi')?>" method="post">
		<table>
			<caption>REGISTRASI</caption>
			<tbody>
				<tr>
					<td><?=rand(1000000000, 9999999999)?></td>
				</tr>
				<tr>
					<td>NISN: </td>
					<td>
						<input type="textbox" name="regis_nisn"/>
					</td>
				</tr>
				<tr>
					<td>Nama: </td>
					<td>
						<input type="textbox" name="regis_nama" />
					</td>
				</tr>
				<tr>
					<td>Password: </td>
					<td>
						<input type="password" name="regis_pass"/>
					</td>
				</tr>
				<tr>
					<td>
						<button type="submit">Registrasi</button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<a href="<?=site_url()?>" title="">Back</a>
</body>
</html>