<?php if($this->session->userdata('adminId')){ ?>
<div id="footerwrap">
      	<footer class="clearfix"></footer>
      	<div class="container">
      		<div class="row">
      			<div class="col-sm-12 col-lg-12">
      			<!-- <p><img src="<?php echo base_url('assets/img/logo.png'); ?>" alt=""></p> -->
      			<p>Powered by <a href="https://bits.host">Bits Host</a> - Developed by <a href="http://pakipreneurs.com">Pakipreneurs</a> - Copyright 2016 <a href="http://beyondphenom.com">Beyond Phenom</a></p>
      			</div>

      		</div><!-- /row -->
      	</div><!-- /container -->		
	</div><!-- /footerwrap -->

<?php } ?>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
	
	<?php if($this->uri->segment(1)=='myadmin'){?>
	<script type="text/javascript" src="<?php echo base_url('assets/js/lineandbars.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/dash-charts.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/gauge.js'); ?>"></script>
	<?php } ?>
	
	<!-- NOTY JAVASCRIPT -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/noty/jquery.noty.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/noty/layouts/top.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/noty/layouts/topLeft.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/noty/layouts/topRight.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/noty/layouts/topCenter.js'); ?>"></script>
	
	<!-- You can add more layouts if you want -->
	<script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js">
    </script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/noty/themes/default.js'); ?>"></script>
    
    <?php if($this->uri->segment(1)=='myadmin'){?>
    <!-- <script type="text/javascript" src="<?php echo base_url('assets/js/dash-noty.js'); ?>"></script> This is a Noty bubble when you init the theme-->
	<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
	<script src="<?php echo base_url('assets/js/jquery.flexslider.js'); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/admin.js'); ?>"></script>
    <?php } ?>
  	

</body></html>