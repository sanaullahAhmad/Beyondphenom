<?php $this->load->view('frontend/header'); ?>
<style>
	.more_settings, #more_settings{
		background:  #fff;
		display: none;
		position: absolute;
		right: 10px;
		top: 34px;
		box-shadow: 0px 4px 4px gray;

	}
	.more_settings label, #more_settings label{
		font-size: 14px;
	}
	.more_settings input, #more_settings input{
		font-size: 14px;
	}

</style>

<!-- <link rel="stylesheet" href="bootstrap.min.css" /> -->


</head>

<body>

	

	<div class="container">	
		<div class="header" style="margin-bottom: 20px">
		<div class="row">
		<div class="col-md-8">
			<h1>Beyond Phenom <small>Product Configurator</small></h1>
			</div>
			<div class="col-md-4 text-right">
			<br>
				<h4 class="block">Shopping Cart<small><strong><?php if($this->session->userdata('cart') && $this->session->userdata('cart')!=""){ count($this->session->userdata('cart')).' Items';}else {echo ' Cart is empty';} ?></strong></small></h4>
				<ul>
				<?php if($this->session->userdata('cart') && $this->session->userdata('cart')!=""){
					foreach($this->session->userdata('cart') as $val){
						echo '<li>'.$val['product_name'].' &nbsp;&nbsp;>> '.$val['product_qty'].'</li>';
					   }
					   echo '<li><a href="javascript:void(0)" id="empty_cart" class="pull-right">Clear cart</a></li>';
					}
				 ?>
				</ul>
			</div>
			</div>
		</div>

		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- <a class="navbar-brand" href="#">Project name</a> -->
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
								<?php foreach($categories as $category)
								{
									?>
									<li><a href="<?=base_url('design/').'/'.$category->categoryId?>"><?php echo str_replace('-',' ',$category->categoryTitle);?></a></li>
									<?php
								}?>
								<!--<li><a href="<?/*=base_url('design/0')*/?>">Atheletic Shorts</a></li>
								<li><a href="<?/*=base_url('design/7')*/?>">Tights</a></li>
								<li><a href="<?/*=base_url('design/8')*/?>">Male Sleevesless</a></li>
								<li><a href="<?/*=base_url('design/10')*/?>">Male Short Sleeves</a></li>
								<li><a href="<?/*=base_url('design/9')*/?>">Male Mid Sleeves</a></li>
								<li><a href="<?/*=base_url('design/11')*/?>">Male Long Sleeves</a></li>
								<li role="separator" class="divider"></li>
								<li class="dropdown-header">For Women</li>
								<li><a href="<?/*=base_url('design/3')*/?>">Sports Bra</a></li>
								<li><a href="<?/*=base_url('design/1')*/?>">Female Tights</a></li>
								<li><a href="<?/*=base_url('design/2')*/?>">Female Tank</a></li>
								<li><a href="<?/*=base_url('design/4')*/?>">Short Sleeves</a></li>
								<li><a href="<?/*=base_url('design/6')*/?>">Mid Sleeves</a></li>
								<li><a href="<?/*=base_url('design/5')*/?>">Long Sleeves</a></li>-->
							</ul>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="">Customize <span class="sr-only">(current)</span></a></li>
						<li><a href="">Featured Products</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div><!--/.container-fluid -->
		</nav>
	</div>
	
	<div class="container">
		<div class="">

		<!-- <div class="row">
			<div class="col-md-12">
				<div class="well">
				<pre>
					<?=$this->session->__ci_last_regenerate?>
					</pre>
				</div>		
			</div>
		</div> -->

			<div class="row">
				<div class="col-md-9 col-sm-9 tjs_canvas col-xs-12">
					<div id="loading">Loading...</div>
					<canvas id="tjs" style="width: 100%; height:400px;"></canvas>
					<div class="row">
						<div class="col-md-12">
							<div>
								<canvas id="fabric" width="521px" height="521px" style="border:1px solid black; display:none;"></canvas>

							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div style="padding: 20px; border: 1px solid #ccc; background: rgba(255,255,255,0.5);width: auto; margin-top: 20px; font-size:18px; line-height:40px;">
						Base Color: <input type="color" id="color_svg_1" value="" oninput="changeSVGColor1()" /> 
						<button id="0" class="base_settings settings btn btn-primary" onclick="update_current_obj(0)"><i class="fa fa-settings fa-cog"></i></button>
						<br>
						Design Color: <input type="color" id="color_svg_2" value=""  oninput="changeSVGColor2()" />
						<button class="design_settings settings btn btn-primary" id="1" onclick="update_current_obj(1)"><i class="fa fa-settings fa-cog"></i></button>
						<br>
						Logo Color: <input type="color" id="color_svg_3" value="" oninput="changeSVGColor3()" />
						<br>
						<div class="more_settings row">
							<div class="col-md-12">
								<div class="">
									<strong><span class="title"></span> Pattern Options</strong>
									<button class="settings_close btn btn-danger pull-right" style="margin-top: 8px;" id="settings_close"> <i class="fa fa-times"></i> </button>
								</div>
								<div class="">

									<div class="row" style="margin-bottom: 10px;">
										<div class="col-md-12">
											<div id="patterns_div"><div></div><img class="pattern_click" id="pattern2" src="<?php echo base_url();?>/public/uploads/patterns/pattern22.png" width="50px" height="50px">&nbsp;<img class="pattern_click" id="pattern2" src="<?php echo base_url();?>/public/uploads/patterns/p1.png" width="50px" height="50px">&nbsp;</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label>
												Width
											</label>
										</div>
										<div class="col-md-8" align="left">
											<input id="myRange" min="50" max="1000" value="200" style="width: 130px" type="range" align="left">
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label>
												Angle  
											</label>
										</div>
										<div class="col-md-8">
											<input id="img-angle" min="50" max="1000" value="200" style="width: 130px" type="range">
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label>
												Move <small>(Horizontal)</small>
											</label>
										</div>
										<div class="col-md-8">
											<input id="img-offset-x" min="50" max="1000" value="200" style="width: 130px" type="range">
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label>
												Move <small>(Vertical) </small>
											</label>
										</div>
										<div class="col-md-8">
											<input id="img-offset-y" min="50" max="1000" value="200" style="width: 130px" type="range">
										</div>
									</div>
									<div class="row" style="margin-top: 6px;">
										<div class="col-md-3">
											<label for="test5d">Repeat Patteren</label>
										</div>
										<div class="col-md-9">
											<input id="img-repeat" name="vehicle" value="Car" type="checkbox">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<button type="button" class="btn btn-primary" id="browse-pattern">Upload Pattern </button>
											<input id="hidden-input-pattern" style="display:none;" type="file">
											<button type="button" class="btn btn-danger" id="removepattern" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Pattern"><i class="fa fa-trash" aria-hidden="true"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						Sizes: 
						<label style="font-weight: normal; font-size: 16px;">XS <input type="checkbox" name="sizes" class="sizes" value="xs" id="xs"> <input type="number" class="quntity_xs" id="quantity_xs" value="0" min="0" max="20" style="width:45px; font-size: 14px; height: 20px;"></label>
						<label style="font-weight: normal; font-size: 16px;">SM <input type="checkbox" name="sizes" class="sizes" value="sm" id="sm"> <input type="number" class="quntity_sm" id="quantity_sm" value="0"  min="0" max="20" style="width:45px; font-size: 14px; height: 20px;"></label>
						<label style="font-weight: normal; font-size: 16px;">M <input type="checkbox" name="sizes" class="sizes" value="md" id="md"> <input type="number" class="quntity_md" id="quantity_md" value="0"  min="0" max="20" style="width:45px; font-size: 14px; height: 20px;"></label>
						<label style="font-weight: normal; font-size: 16px;">LG <input type="checkbox" name="sizes" class="sizes" value="lg" id="lg"> <input type="number" class="quntity_lg" id="quantity_lg" value="0"  min="0" max="20" style="width:45px; font-size: 14px; height: 20px;"></label>
						<label style="font-weight: normal; font-size: 16px;">XL <input type="checkbox" name="sizes" class="sizes" value="xl" id="xl"> <input type="number" class="quntity_xl" id="quantity_xl" value="0"  min="0" max="20" style="width:45px; font-size: 14px; height: 20px;"></label>
						<label  style="font-weight: normal; font-size: 16px;">XXL <input type="checkbox" name="sizes" class="sizes" value="xxl" id="xxl"> <input type="number" class="quntity_xxl" id="quantity_xxl"  min="0" max="20"  value="0" style="width:45px; font-size: 14px; height: 20px;"></label>

						<label  style="font-weight: normal; font-size: 16px;">XXXL <input type="checkbox" name="sizes" class="sizes" value="xxxl" id="xxxl"> <input type="number" class="quntity_xxxl" id="quantity_xxxl" value="0" style="width:45px; font-size: 14px; height: 20px;"></label>
						<br>

						<button class="btn btn-success" id="clear">Clear</button>
						<a href='javascript:void(0);' id="add_to_cart" class="btn btn-primary">Add to Cart</a>
						<button class="btn btn-primary" id="export_JPEG_image">Check out</button>
						<div style="display: none;" id="jsn"><?=json_encode($this->session->userdata('jsn'))?></div>
					</div>
					<div id="json" style="display: none"></div>
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
        $(document).ready(function(){
        	$('#add_to_cart').on('click', function(event){
        		var prodID='<?php echo $this->uri->segment(2); ?>';
        		$.ajax({
				url:'<?php echo base_url(); ?>design/cart',
				type : 'POST',
				data: {"cart":prodID},
					success:function(result){
							window.location.href = "<?php echo base_url(); ?>design/<?php echo $this->uri->segment(2); ?>";
						},
					error: function () {
						alert('Some error!');
					}
				});	
        	});
        	$('#empty_cart').on('click', function(event){
        		//var prodID='<?php echo $this->uri->segment(2); ?>';
        		var prodID='all';
        		$.ajax({
				url:'<?php echo base_url(); ?>design/emptycart',
				type : 'POST',
				data: {"emptycart":prodID},
					success:function(result){
							window.location.href = "<?php echo base_url(); ?>design/<?php echo $this->uri->segment(2); ?>";
						},
					error: function () {
						alert('Some error!');
					}
				});	
        	});
        });
        </script>

    </body>
    </html>
