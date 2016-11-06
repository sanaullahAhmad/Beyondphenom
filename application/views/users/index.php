<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Beyond Phenom</title>
	<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/user/viewport-bug-workaround.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/user/navbar-fixed-top.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/user/font-awesome.min.css'); ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/js/user/ie-emulation-modes-warning.js'); ?>"></script>
</head>
  <body>

<div class="container">
	<?php $this->load->view('user/incs/header'); ?>
</div>
    <div class="row">
	    <div class="col-md-1">
	    	<div class="row" style="padding: 0px;border-bottom: 1px solid black;padding-left: 15px;text-align: center;">
		    	<ul class="nav navbar-nav" style="width: 100%">
		            <li class="dropdown" style="width: 100%">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-file-image-o fa-2x" aria-hidden="true"></i>&nbsp;<br/> File</a>
		              <ul class="dropdown-menu">
		                <li><a href="#">Action</a></li>
		                <li><a href="#">Another action</a></li>
		                <li><a href="#">Something else here</a></li>
		                <li role="separator" class="divider"></li>
		                <li class="dropdown-header">Nav header</li>
		                <li><a href="#">Separated link</a></li>
		                <li><a href="#">One more separated link</a></li>
		              </ul>
		            </li>
		        </ul>
	        </div>
	        <div class="row" style="padding: 0px;border-bottom: 1px solid black;padding-left: 15px;text-align: center;">
		    	<ul class="nav navbar-nav" style="width: 100%">
		            <li class="dropdown" style="width: 100%">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-file-text fa-2x" aria-hidden="true"></i>&nbsp;<br/> Text</a>
		              <ul class="dropdown-menu">
		                <li><a href="#">Action</a></li>
		                <li><a href="#">Another action</a></li>
		                <li><a href="#">Something else here</a></li>
		                <li role="separator" class="divider"></li>
		                <li class="dropdown-header">Nav header</li>
		                <li><a href="#">Separated link</a></li>
		                <li><a href="#">One more separated link</a></li>
		              </ul>
		            </li>
		        </ul>
	        </div>
	        <div class="row" style="padding: 0px;border-bottom: 1px solid black;padding-left: 15px;text-align: center;">
		    	<ul class="nav navbar-nav" style="width: 100%">
		            <li class="dropdown" style="width: 100%">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-clipboard fa-2x" aria-hidden="true"></i>&nbsp;<br/> Clipart</a>
		              <ul class="dropdown-menu">
		                <li><a href="#">Action</a></li>
		                <li><a href="#">Another action</a></li>
		                <li><a href="#">Something else here</a></li>
		                <li role="separator" class="divider"></li>
		                <li class="dropdown-header">Nav header</li>
		                <li><a href="#">Separated link</a></li>
		                <li><a href="#">One more separated link</a></li>
		              </ul>
		            </li>
		        </ul>
	        </div>
	        <div class="row" style="padding: 0px;border-bottom: 1px solid black;padding-left: 15px;text-align: center;">
		    	<ul class="nav navbar-nav" style="width: 100%">
		            <li class="dropdown" style="width: 100%">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-laptop fa-2x" aria-hidden="true"></i>&nbsp;<br/> Background</a>
		              <ul class="dropdown-menu">
		                <li><a href="#">Action</a></li>
		                <li><a href="#">Another action</a></li>
		                <li><a href="#">Something else here</a></li>
		                <li role="separator" class="divider"></li>
		                <li class="dropdown-header">Nav header</li>
		                <li><a href="#">Separated link</a></li>
		                <li><a href="#">One more separated link</a></li>
		              </ul>
		            </li>
		        </ul>
	        </div>
	        <div class="row" style="padding: 0px;border-bottom: 1px solid black;padding-left: 15px;text-align: center;">
		    	<ul class="nav navbar-nav" style="width: 100%">
		            <li class="dropdown" style="width: 100%">
		            	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-undo fa-2x" aria-hidden="true"></i>&nbsp;<br/> Undo</a>
		            </li>
		        </ul>
		    </div>
		    <div class="row" style="padding: 0px;border-bottom: 1px solid black;padding-left: 15px;text-align: center;">
		    	<ul class="nav navbar-nav" style="width: 100%">
		            <li class="dropdown" style="width: 100%">
		            	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-repeat fa-2x" aria-hidden="true"></i>&nbsp;<br/> Redo</a>
		            </li>
		        </ul>
		    </div>
	    </div>
	    <div class="col-md-8" style="margin: 0px;padding: 0px;">
	    	<div align="center" style="overflow: scroll;">
				<canvas id="mycanvas" style="border: 1px solid black;"></canvas>
			</div>
	    </div>
	    <div class="col-md-3" style="border-left: 1px solid black; overflow: scroll; background-color: #FFFFFF;">
	    	<div class="panel-body">
	    		<p>Design</p>
	    		<hr style="color: black;width: 100%; border-top: 1px solid #000000; margin: 0px; margin-bottom: 5px;">
	    		<div class="row" style="margin-bottom: 15px;margin-top: 15px;">
                	<div class="col-md-6" style="padding-top: 5px;">Type</div>
                	<div class="col-md-6" style="text-align: right">Poster</div>    
                </div>
                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
                	<div class="col-md-6" style="padding-top: 5px;">Size</div>
                	<div class="col-md-6" style="text-align: right">
	                	<select id="fontsize" class="browser-default form-control" style="display: inline; width: 65px;">
	                        <option value="8">8</option>
	                        <option value="9">9</option>
	                    </select>
                    </div>    
                </div>
                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
                	<div class="col-md-6" style="padding-top: 5px;">Background</div>
                	<div class="col-md-6" style="text-align: right">
	                	<select id="fontsize" class="browser-default form-control" style="display: inline; width: 65px;">
	                        <option value="">Solid Color</option>
	                        <option value="">Gradiant</option>
	                        <option value="">Upload Background</option>
	                        <option value="">Image</option>
	                        <option value="">Stock Photo</option>
	                    </select>
                    </div>    
                </div>
                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
                	<div class="col-md-6" style="padding-top: 5px;">Color</div>
                	<div class="col-md-6" style="text-align: right">
	                	
                    </div>    
                </div>
                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
                	<div class="col-md-12" style="padding-top: 5px;">Title</div>
                	<div class="col-md-12" style="padding-top: 5px;"><input type="text" class="form-control"></div>
                </div>
                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
                	<div class="col-md-12" style="padding-top: 5px;">Description</div>
                	<div class="col-md-12" style="padding-top: 5px;"><textarea class="form-control" rows="7" id="textarea1" style="height: 100px;"></textarea></div>
                </div>
	    	</div>
	    </div>
    </div>
</body>
</html>
<script type="text/javascript" src="<?php echo base_url('assets/js/user/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/user/ie10-viewport-bug-workaround.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/user/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/user/fabric/fabric.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/user/fabric/custom-fabric.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/user/script.js'); ?>"></script>
