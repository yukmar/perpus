<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Library</title>
  <link rel="stylesheet" href="<?=base_url('assets/css/custom/')?>custom.css">
	<link rel="stylesheet" href="<?=base_url('assets/css/')?>jquery.dataTables.min.css"/>
	<link rel="stylesheet" href="<?=base_url('assets/css/')?>dataTables.bootstrap4.min.css"/>
	<link rel="stylesheet" href="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.css"/>
  <link rel="stylesheet" href="<?=base_url('assets/icons/fontawesome/css/all.min.css')?>">
</head>
<body>
<header id="split">
	<div class="split__left">
		<a><img src="<?=base_url('assets/images/logo.png')?>" /></a>
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
</div>
<!--    </div>-->
	<div class="sidebar">
	  <nav class="menu">
	    <li><a href="<?=site_url()?>">Home</a></li>
	    <li><a href="<?=site_url()?>">Tagihan</a></li>
	  </nav>
	</div>
</div>

	<script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
	<script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
	<script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
</body>
</html>