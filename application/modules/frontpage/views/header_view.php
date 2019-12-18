<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Library</title>
  <link rel="stylesheet" href="<?=base_url('assets/css/custom/')?>font.css">
  <link rel="stylesheet" href="<?=base_url('assets/css/custom/')?>custom.css">
  <link rel="stylesheet" href="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.css"/>
  <link rel="stylesheet" href="<?=base_url('assets/css/')?>jquery.dataTables.min.css">
  <link rel="stylesheet" href="<?=base_url('assets/css/')?>dataTables.bootstrap4.min.css"/>
  <link rel="stylesheet" href="<?=base_url('assets/icons/fontawesome/css/all.min.css')?>">
</head>
<body>
    <header id="split">
        <div class="split__left">
            <a href="<?=site_url()?>"><img src="<?=base_url('assets/images/logo.png')?>" /></a>
        </div>
        <div class="split__center">
            <form action="<?=site_url('search')?>" method="get" id="form-search">
                <div class="search">
                    <input class="forms-control" type="search" placeholder="Tulis judul disini" id="search-box" name="search">
                    <!-- <input class="forms-control" type="button" value="Cari"> -->
                    <span id="click-search"><i class="fas fa-search forms-control button"></i></span>
                </div>
            </form>
        </div>
        <div class="split__right">
          <?php if ($this->session->tipe) { ?>
            <a class="btn-menu" href="<?=site_url('logout')?>" data-role="logout">Logout</a>
          <?php } else { ?>
            <a class="btn-menu" onclick="toggleModal('login')">Login</a>
            <a class="btn-menu" onclick="toggleModal('daftar')">Daftar</a>
          <?php } ?>
        </div>
    </header>
    <div class="nav nav-pad">
        <div class="nav__menu">
            <a href="<?=site_url()?>" class="nav__menu-item">Home</a>
            <!-- <a href="#book" class="nav__menu-item">Book</a> -->
        </div>
    </div>
    <div class="main">
        <div class="owl-carousel" id="carousel">
            <div class="carousel__item"><img src="<?=base_url('assets/images/buku1.jpg')?>" alt="wallpaper1" /></div>
            <div class="carousel__item"><img src="<?=base_url('assets/images/buku2.jpg')?>" alt="wallpaper2" /></div>
            <div class="carousel__item"><img src="<?=base_url('assets/images/buku3.jpg')?>" alt="wallpaper3" /></div>
            <div class="carousel__item"><img src="<?=base_url('assets/images/buku4.jpg')?>" alt="wallpaper4" /></div>
        </div>