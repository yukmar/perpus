<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<table>
		<caption>Data Info Buku</caption>
		<thead>
			<tr>
				<th>#</th>
				<th>Judul</th>
				<th>Pengarang</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($info_buku as $key => $value) {
			?>
			<tr>
				<td><?=$key+1?></td>
				<td><?=$value['judul']?></td>
				<td><?=$value['pengarang']?></td>
			</tr>
			<?php }
			?>
		</tbody>
	</table>
</body>
</html>