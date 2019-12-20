<?=$this->load->view('header_view.php')?>
<div class="containers">
  <input data-function="swipe" id="swipe" type="checkbox">
  <label data-function="swipe" for="swipe"><i class="fa">&#xf057;</i></label>
  <label data-function="swipe" for="swipe"><i class="fa">&#xf0c9;</i></label>

  <div class="headings section-break">
    <div class="linebreak"></div>
    <h2 class="caption-page">PENGEMBALIAN BUKU</h2>
    <div class="linebreak"></div>
  </div>

  <div class="headings container-fluid row justify-content-center">
  	<section class="col-sm-11">
  		<div class="row container-fluid">
        <div class="container border-form">
  			FORM PENGEMBALIAN
  			<form action="<?=site_url('pengembalian/cek-tagihanbuku')?>" method="post">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">NIS</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="txtnis" id="tnis" value="<?php if(isset($nis)){echo $nis;}?>" />
            </div>
          </div>
          <?php if (isset($nama)) {?>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Siswa</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="txtnama" value="<?=$nama?>" disabled/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kelas</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="txtkelas" value="<?=$kelas?>" disabled/>
            </div>
          </div>
          <?php } ?>
          <button class="btn btn-primary">Cek Tagihan Buku</button>
  				
  			</form>
        </div>
      </div>
  			<?php if (isset($items)) { ?>
      <div class="row container-fluid">        
        <form action="<?=site_url('pengembalian/submit')?>" method="post">
  			<table class="table databook" id="table-tagihan">
  				<thead>
  					<tr>
  						<th>#</th>
  						<th>Kode Buku</th>
  						<th>Judul</th>
  						<th>Tanggal Batas Peminjaman</th>
  						<th>Denda</th>
              <th>checklist</th>
  					</tr>
  				</thead>
  				<tbody>
  					<?php foreach ($items as $key => $value) { ?>
  					<tr>
  						<td><?=$key+1?></td>
  						<td><?=$value->idbuku?></td>
  						<td><?=$value->judul?></td>
  						<td><?=$value->tgl_bataspinjam?></td>
  						<td><?=$value->newdenda?></td>
              <td>
                <input type="checkbox" name="nopinjam[]" value="<?=$value->nodet?>">
              </td>
  					</tr>
  					<?php } ?>
  					<tr>
  						<td colspan="4">Total Denda</td>
  						<td><span id="span-total">0</span></td>
  					</tr>
  				</tbody>
  			</table>
  			<button type="submit" class="btn btn-primary">Kembalikan Buku dan Bayar Denda</button>
        </form>
      </div>

  			<?php }	?>
  	</section>
  </div>


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
  <script src="<?=base_url('assets/js/custom/')?>pengembalian.js"></script>
</body>
</html>