<?=$this->load->view('header_view.php')?>
<div class="containers">
  <input data-function="swipe" id="swipe" type="checkbox">
  <label data-function="swipe" for="swipe"><i class="fa">&#xf057;</i></label>
  <label data-function="swipe" for="swipe"><i class="fa">&#xf0c9;</i></label>
  <div class="headings section-break">
    <div class="linebreak"></div>
    <h2 class="caption-page">INFO ITEM BUKU</h2>
    <div class="linebreak"></div>
  </div>
  <div class="headings container-fluid row justify-content-center">
    <section class="col-sm-11">
      <div class="row container-fluid">
        <div class="container border-form">
          <table>
            <tbody>
              <tr>
                <td>Kode Buku</td>
                <td>:<?=$info->idbuku?></td>
              </tr>
              <tr>
                <td>ISBN </td>
                <td>:<?=$info->isbn?></td>
              </tr>
              <tr>
                <td>Judul </td>
                <td>:<?=$info->judul?></td>
              </tr>
              <tr>
                <td>Penerbit </td>
                <td>:<?=$info->namapenerbit?></td>
              </tr>
              <tr>
                <td>Tahun Terbit </td>
                <td>:<?=$info->thnterbit?></td>
              </tr>
              <tr>
                <td>Harga Beli </td>
                <td>:<?=$info->harga?></td>
              </tr>
              <tr>
                <td>Tanggal Pembelian </td>
                <td>:<?=$info->tglbeli?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="container">
          <table class="table databook">
            <thead>
              <tr>
                <th>#</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $key => $value) { ?>
              <tr>
                <td><?=$key+1?></td>
                <td><?=$value->nis?></td>
                <td><?=$value->nama_siswa?></td>
                <td><?=$value->tgl_pinjam?></td>
                <td><?=$value->tgl_kembali?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
<!--    </div>-->
  <div class="sidebar">
    <nav class="menu">
      <li><a href="<?=site_url()?>">Home</a></li>
      <li><a href="<?=site_url('peminjaman')?>">Peminjaman</a></li>
      <li><a href="<?=site_url('pengembalian')?>">Pengembalian</a></li>
      <li><a href="<?=site_url('manage-buku')?>">Data Buku</a></li>
      <li><a href="<?=site_url('manage-user')?>">Data User</a></li>
      <li><a href="<?=site_url('manage-penerbit')?>">Data Penerbit</a></li>
      <li><a href="<?=site_url('manage-pengarang')?>">Data Pengarang</a></li>
    </nav>
  </div>
</div>
<?php $this->load->view('footer_view.php');?>
  <script src="<?=base_url('assets/js/')?>jquery-3.4.1.min.js"></script>
  <script src="<?=base_url('assets/js/')?>owl.carousel.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="<?=base_url('assets/js/')?>jquery.dataTables.min.js"></script>
</body>
</html>
</body>
</html>