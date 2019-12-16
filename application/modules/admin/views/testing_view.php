<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="<?=site_url('admin/testing/test')?>" method="post">
		<input type="checkbox" name="checklist[]" value="check1"/>
		<br/>
		<input type="checkbox" name="checklist[]" value="check2"/>
		<br/>
		<input type="checkbox" name="checklist[]" value="check3"/>
		<button type="submit">submit</button>
	</form>
</body>
</html>