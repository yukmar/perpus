<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library</title>
    <link rel="stylesheet" href="<?=base_url('assets/css/')?>style.css">
    <link rel="stylesheet" href="<?=base_url('assets/css/')?>owl.carousel.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/css/')?>owl.theme.default.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/css/')?>jquery.dataTables.min.css">
</head>
<body>
    <header id="split">
        <div class="split__left">
            <a><h4>LOGO</h4></a>
        </div>
        <div class="split__center">
            <form>
                <div class="search">
                    <input class="form-control" type="search" placeholder="Tulis judul disini">
                    <input class="form-control" type="button" value="Cari">
                </div>
            </form>
        </div>
        <div class="split__right">
            <a onclick="toggleModal('login')" href="#login">Login</a>
        </div>
    </header>
    <div class="nav nav-pad">
        <div class="nav__menu">
            <a href="#" class="nav__menu-item">Home</a>
            <a href="#book" class="nav__menu-item">Book</a>
        </div>
    </div>
    <div class="main">
        <div class="owl-carousel" id="carousel">
            <div class="carousel__item"> Your Content </div>
            <div class="carousel__item"> Your Content </div>
            <div class="carousel__item"> Your Content </div>
            <div class="carousel__item"> Your Content </div>
            <div class="carousel__item"> Your Content </div>
            <div class="carousel__item"> Your Content </div>
            <div class="carousel__item"> Your Content </div>
        </div>
        <div class="nav-pad">
            <table id="databook" class="databook">
                <thead>
                <tr>
                    <th>#</th>
										<th>ISBN</th>
										<th>Judul</th>
										<th>Pengarang</th>
										<th>Penerbit</th>
										<th>total eksemplar</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($list_buku as $key => $value) { ?>
                <tr>
                    <td><?=$key+1?></td>
										<td><?=$value['isbn']?></td>
										<td><?=$value['judul']?></td>
										<td><?=$value['pengarang']?></td>
										<td><?=$value['penerbit']?></td>
										<td><?=$value['eksemplar']?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal__login loginform">
        <div class="modal__login-content">
            <span class="modal__login-close" onclick="toggleModal('login')">×</span>
            <form action="<?=site_url('login')?>" method="post">
                <div class="modal__login-form-group">
                    <input type="text" placeholder="Masukkan username" class="modal__login-form-control" name="txtid"/>
                </div>
                <div class="modal__login-form-group">
                    <input type="password" placeholder="Masukkan password" class="modal__login-form-control" name="txtpass"/>
                </div>
                <button type="submit" class="modal__login-btn btn-primary" value="Login">Login</button>
            </form>
        </div>
    </div>
    <script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
    <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
    <script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
    <script>
        var modalLogin = document.querySelector(".loginform");
        function toggleModal(key) {
            if (key == 'login') {
                modalLogin.classList.toggle("modal__login-show");
            } else {
                modalLogin.classList.toggle("modal__login-show");
            }
        }
        function windowOnClick(event) {
            toggleModal('close');
        }
        $(document).ready(function(){
            $('#carousel').owlCarousel({
                autoplay:true,
                autoplayTimeout:3000,
                loop:true,
                margin:10,
                items: 1
            })
            $('#book').owlCarousel({
                margin:10,
                items: 7
            })
            $('#databook').DataTable();

        });
    </script>
</body>
</html>