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
			<h3>Wellcome <em><a href="<?=site_url('logout')?>">Logout</a></em></h3>
		</div>
	</div>
	<div class="row">
				<div class="col-md-12">
					<h4>Orders</h4>
					<table id="table_id" class="display">
				<thead>
					<tr>
						<th>Title</th>
						<th>Size</th>
						<th>Image</th>
						<th>View Order</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i=0; $i < 7; $i++) {
						# code...
					?>
					<tr>
						<td>
							Order <?=$i?>
						</td>
						<td>Row 2 Data 1</td>
						<td>Image <?=$i?></td>
						<td><a href="<?=site_url('design/0')?>">Click here to view</a></td>
						<td>
							<div class="form-group">
								<select class="form-control" name="" id="">
									<option value="pending">Pending</option>
									<option value="inprocess">Inprocess</option>
									<option value="compelete">Compelete</option>
								</select>
							</div>
						</td>
					</tr>
					<?php }	?>
				</tbody>
			</table>
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