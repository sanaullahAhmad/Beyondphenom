<?php $this->load->view('frontend/header'); ?>
<!-- <link rel="stylesheet" href="bootstrap.min.css" /> -->
</head>
<body style="min-height: 100vh">
<div class="container">
	<div class="header" style="margin-bottom: 20px">
		<h1>Beyond Phenom <small>Product Configurator</small></h1>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="row">
				<?php if(!validation_errors_array())
				{?>
				<div class="container error_message">
					<div class="row">
						<div class="col-md-4 col-md-offset-4 text-center">
							<div class="alert  alert-warning"  style="background:white">
								<?=validation_errors_array()?>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="login_wrapper">
						<div id="register" class="animate form registration_form">
							<section class="login_content">
								<form action="<?=site_url('login/login_action')?>" method="post">
									<h1>Login</h1>
									<div class="form-group">
										<label for="username">
											User Name:
										</label>
										<input type="text" id="username" class="form-control" name="username" placeholder="Username" required="" />
									</div>
									<div class="form-group">
										<label for="password">
											Password:
										</label>
										<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="" />
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-default submit">Log in</button>
										&nbsp;&nbsp;&nbsp;
										<!-- <a class="" href="<?= base_url('signup')?>">Create Account</a> -->
									</div>
									<div class="clearfix"></div>
								</form>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- // <script src="../../js/three.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/3d/three.js'); ?>"></script>
<!-- // <script src="../../js/jquery-3.0.0.min.js"></script> -->
<!-- // <script src="../../js/js/loaders/DDSLoader.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/3d/DDSLoader.js'); ?>"></script>
<!-- // <script src="../../js/OBJLoader.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/3d/OBJLoader.js'); ?>"></script>
<!-- // <script src="../../js/js/loaders/MTLLoader.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/3d/MTLLoader.js'); ?>"></script>
<!-- // <script src="../../js/controls/OrbitControls.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/3d/controls/OrbitControls.js'); ?>"></script>
<script src="<?php echo base_url('assets/3d/custom/three-custom.js')?>"></script>
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/fabric/fabric.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootbox.min.js'); ?>"></script>
<!-- // <script src="dist/fabric.min.js"></script> -->
<!-- // <script src="script.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/3d/custom/script.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/3d/jquery.noty.packaged.min.js'); ?>"></script>
<link href="<?php echo base_url('assets/3d/animate.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/3d/buttons.css'); ?>" rel="stylesheet" />
<script type="text/javascript">
	function noti(type, text) {
// if(type=='default') icon = '<i class="fa fa-bell" aria-hidden="true"></i>';
// if(type=='warning') icon = '<i class="fa fa-exclamation" aria-hidden="true"></i>';
// if(type=='success') icon = '<i class="fa fa-check" aria-hidden="true"></i>';
// if(type=='danger') icon = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';
icon = null;
var n = noty({
text        : '<div class="activity-item"> '+icon+' <div class="activity"> '+text+' </div> </div>',
type        : type,
dismissQueue: true,
layout      : 'topRight',
// closeWith   : ['click'],
timeout: 3000,
theme       : 'relax',
maxVisible  : 10,
animation   : {
open  : 'animated bounceInRight',
close : 'animated bounceOutRight',
easing: 'swing',
speed : 500
}
});
// console.log('html: ' + n.options.id);
}
</script>
</body>
</html>