<?php $this->load->view('base_template/frontpage/header_view');?>
        <div class="nav-pad">
          <div class="search-gap"></div>
          <div class="section-break">
            <div class="linebreak"></div>
            <h1 class="text-center caption-landing">PENCARIAN BUKU</h1>
            <div class="linebreak"></div>
          </div>
        <div class="container-search">
          <div class="">
            <div class="container border-form">
            <h5>Pencarian: "<?=$judul?>"</h5>
            <hr />
            <br />
          <?php if ($hasil) { ?>
            <table class="table databook">
              <thead>
                <tr>
                  <th>#</th>
                  <th>ISBN</th>
                  <th>Judul</th>
                  <th>Terbitan</th>
                  <th>Penerbit</th>
                  <th>Genre</th>
                  <th>Pengarang</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($hasil as $key => $value) { ?>
                <tr>
                  <td><?=$key+1?></td>
                  <td><?=$value->isbn?></td>
                  <td><?=$value->judul?></td>
                  <td><?=$value->tahun_terbit?></td>
                  <td><?=$value->penerbit?></td>
                  <td><?=$value->genre?></td>
                  <td><?=$value->pengarang?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          <?php } else { ?>
            <h4>Tidak ada buku dengan kata kunci "<?=$judul?>"</h4>
          <?php } ?>
          </div>
          </div>
        </div>
        </div>
        
    </div>
    <?php $this->load->view('base_template/frontpage/footer_view');?>
    <div class="modal__login loginform">
        <div class="modal__login-content">
            <span class="modal__login-close" onclick="toggleModal('login')">×</span>
            <form action="<?=site_url('login')?>" method="post" id="form-login">
              <label>LOGIN</label>
                <div class="modal__login-forms-group">
                    <input type="text" placeholder="Masukkan NIP/NIS" class="modal__login-forms-control" name="txtuser" id="tuser" data-role="NIP/NIS" />
                </div>
                <small class="form-text text-danger" id="user-message"></small>
                <div class="modal__login-forms-group">
                    <input type="password" placeholder="Masukkan password" class="modal__login-forms-control" name="txtpass" id="tpass" data-role="Password" />
                </div>
                <small class="form-text text-danger" id="pass-message"></small>
                <button type="submit" class="modal__login-btn btn-primary" id="btn-login" disabled>Login</button>
            </form>
        </div>
    </div>
    <div class="modal__daftar daftarform">
      <div class="modal__daftar-content">
        <span class="modal__daftar-close" onclick="toggleModal('daftar')">×</span>
        <form action="<?=site_url('daftar')?>" id="form-daftar" method="post" onsubmit="return daftar()">
          <label>DAFTAR</label>
          <div class="modal__daftar-forms-group">
             <input type="text" placeholder="Masukkan Nomor Induk Siswa" class="modal__daftar-forms-control" name="dtxtuser" id="tduser" data-role="Nomor Induk Siswa" />
          </div>
          <small class="form-text text-danger"></small>
          <div class="modal__daftar-forms-group">
             <input type="text" placeholder="Masukkan Nama" class="modal__daftar-forms-control" name="dtxtnama" id="tdnama" data-role="Nama" />
          </div>
          <small class="form-text text-danger"></small>
          <div class="modal__daftar-forms-group">
             <!-- <input type="text" placeholder="Masukkan Kelas" class="modal__daftar-forms-control" name="dtxtkelas" id="tdkelas" data-role="Kelas" /> -->
             <label>Kelas: </label>
             <select name="kelas" class="custom-select">
              <?php foreach ($kelas as $key => $value) { ?>
               <option value="<?=$value['id']?>"><?=$value['nama']?></option>
              <?php } ?>
             </select>
          </div>
          <small class="form-text text-danger"></small>
          <div class="modal__daftar-forms-group">
            <input type="password" placeholder="Masukkan password" class="modal__daftar-forms-control" name="dtxtpass" id="tdpass" data-role="Password" />
          </div>
          <small class="form-text text-danger"></small>
          <button type="submit" class="modal__daftar-btn btn-primary" id="btn-daftar" disabled>daftar</button>
        </form>
      </div>
    </div>
    <script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
    <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
    <script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
    <script src="<?=base_url('assets/js/custom/')?>frontpage.js"></script>
</body>
</html>