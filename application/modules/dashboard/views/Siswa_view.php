<?php $this->load->view('header_view'); ?>
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