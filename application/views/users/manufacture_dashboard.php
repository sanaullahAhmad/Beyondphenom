<?php $this->load->view('frontend/header'); ?>
<!-- <link rel="stylesheet" href="bootstrap.min.css" /> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<style>
	table{
		background: white;
	}
</style>
</head>
<body>
<div class="container">
	<div class="header" style="margin-bottom: 20px">
		<h1>Beyond Phenom <small>Product Configurator</small></h1>
	</div>
	<!-- 	<nav class="navbar navbar-default">
				<div class="container-fluid">
																			<div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="#">Project name</a>
																			</div>
																			<div id="navbar" class="navbar-collapse collapse">
																																		<ul class="nav navbar-nav">
																																																	<li class="active"><a href="">Home</a></li>
																																																	<li><a href="#">Shop</a></li>
																																																	<li><a href="#">Contact</a></li>
																																																	<li class="dropdown">
																																																																<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Choose Product <span class="caret"></span></a>
																																																																<ul class="dropdown-menu">
																																																																															<li class="dropdown-header">For Men</li>
							<li><a href="<?=base_url('design/0')?>">Atheletic Shorts</a></li>
							<li><a href="<?=base_url('design/7')?>">Tights</a></li>
							<li><a href="<?=base_url('design/8')?>">Male Sleevesless</a></li>
							<li><a href="<?=base_url('design/10')?>">Male Short Sleeves</a></li>
							<li><a href="<?=base_url('design/9')?>">Male Mid Sleeves</a></li>
							<li><a href="<?=base_url('design/11')?>">Male Long Sleeves</a></li>
							<li role="separator" class="divider"></li>
							<li class="dropdown-header">For Women</li>
							<li><a href="<?=base_url('design/3')?>">Sports Bra</a></li>
							<li><a href="<?=base_url('design/1')?>">Female Tights</a></li>
							<li><a href="<?=base_url('design/2')?>">Female Tank</a></li>
							<li><a href="<?=base_url('design/4')?>">Short Sleeves</a></li>
							<li><a href="<?=base_url('design/6')?>">Mid Sleeves</a></li>
							<li><a href="<?=base_url('design/5')?>">Long Sleeves</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="">Customize <span class="sr-only">(current)</span></a></li>
					<li><a href="">Featured Products</a></li>
				</ul>
			</div>/.nav-collapse
		</div>/.container-fluid
	</nav> -->
	<div class="container" style="min-height: 100vh;">
		<h4>Welcome Manufacture <em><a href="<?=site_url('logout')?>">Logout</a></em></h4>
		<hr>
		<div class="col-md-12 ">
			<button class="btn pull-right"> Print</button>
			<button class="btn pull-right"> Download</button>
		</div>
		<br>
		<br>
		<div class="col-md-12">
			<table id="table_id" class="display">
				<thead>
					<tr>
						<th>Title</th>
						<th>Size</th>
						<th>Image</th>
						<th>Download Print Files</th>
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
						<td><a href="">Download File(s)</a></td>
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
</body>	
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
<!-- Datatable -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
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
	$(document).ready(function(){
	$('#table_id').DataTable();
	});
</script>

</html>