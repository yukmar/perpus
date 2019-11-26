<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="<?=site_url('login')?>" method="post">
		<table>
			<caption>LOGIN</caption>
			<tbody>
				<tr>
					<td>id:</td>
					<td>
						<input type="textbox" name="txtid"/>
					</td>
				</tr>
				<tr>
					<td>password:</td>
					<td>
						<input type="password" name="txtpass">
					</td>
				</tr>
				<tr>
					<td>
						<button type="submit">login</button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<a href="<?=site_url().'?page=daftar'?>" title="">Daftar</a>
</body>
</html>