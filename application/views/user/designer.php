<?php $this->load->view('user/incs/main_header.php'); ?>
  <body>


	<?php $this->load->view('user/incs/navbar'); ?>
    <div class="container" style="margin-top: 20px;">
    
	    
	    <div class="col-md-8" style="margin: 0px;padding: 0px; background-color: #EEEEEE;min-height: 482px;max-height: 482px;">
	    	<div align="center" style="overflow:auto;">
				<canvas id="mycanvas" style="border: 1px solid black;"></canvas>
			</div>
	    </div>
	    
	    <div class="col-md-4" style="textoverflow: auto; background-color: #FFFFFF;">
	    	
	    	<div id="Background" style="min-height: 482px;">
	    			    	<div class="panel-body">
		    		<p>Design</p>
		    		<hr style="color: black;width: 100%; border-top: 1px solid #000000; margin: 0px; margin-bottom: 5px;">
		    		<div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-4 col-md-4" style="padding-top: 5px;">Type</div>
	                	<div class="col-xs-8 col-md-8" style="text-align: right">Poster</div>    
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-4 col-md-4" style="padding-top: 5px;">Size</div>
	                	<div class="col-xs-8 col-md-8" style="padding: 0px;margin:0px;text-align: right">
		                	<select id="fontsize" class="browser-default form-control" style="display: inline;">
		                        <option value="8">8</option>
		                        <option value="9">9</option>
		                    </select>
	                    </div>    
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-4 col-md-4" style="padding-top: 5px;">Background</div>
	                	<div class="col-xs-8 col-md-8" style="padding: 0px;margin:0px;text-align: right">
		                	<select id="fontsize" class="browser-default form-control" style="display: inline;">
		                        <option value="">Solid Color</option>
		                        <option value="">Gradiant</option>
		                        <option value="">Upload Background</option>
		                        <option value="">Image</option>
		                        <option value="">Stock Photo</option>
		                    </select>
	                    </div>    
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-4 col-md-4" align="left">Color</div>
	                	<div class="col-xs-8 col-md-8" style="text-align: right;padding: 0px;margin:0px;">
		                	<div id = "colorpicker-background" class="browser-default form-control">
		                        <div class="color-box" style="z-index:1;">
		                        </div>
	                    	</div>
	                    </div>    
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-12 col-md-12" style="padding-top: 5px;">Title</div>
	                	<div class="col-xs-12 col-md-12" style="padding-top: 5px;"><input type="text" class="form-control"></div>
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-12 col-md-12" style="padding-top: 5px;">Description</div>
	                	<div class="col-xs-12 col-md-12" style="padding-top: 5px;"><textarea class="form-control" rows="7" id="textarea1" style="height: 100px;"></textarea></div>
	                </div>
		    	</div>
		    </div>
		    <div id="Text" style="display: none; min-height: 482px; max-height: 482px; overflow:auto;">
		    	<div class="panel-body">
		    		<p>Edit Text</p>
		    		<hr style="color: black;width: 100%; border-top: 1px solid #000000; margin: 0px; margin-bottom: 5px;">
		    		<div class="row" style="margin-bottom: 15px;margin-top: 15px;">
		    		<div class="col-md-12">
		    			<textarea id="textarea-text" class="form-control" rows="5" id="textarea" style="height: 80px;"></textarea>
		    		</div>
		    			
		    		</div>
		    		<div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-1 col-md-1"></div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="sendfront-text" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><img class="imageIcon" src="<?php echo base_url('assets/img/layered-bottom.png'); ?>" style="height: 30px; "><br/> Send Front</a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="sendback-text" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><img class="imageIcon" src="<?php echo base_url('assets/img/layered-top.png'); ?>" style="height: 30px; "><br/> Send Back</a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="lock-text" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-lock fa-2x" aria-hidden="true"></i><br/> Lock Text</a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="unlock-text" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-unlock fa-2x" aria-hidden="true"></i><br/> Unlock Text</a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="delete-text" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-trash fa-2x" aria-hidden="true"></i><br/> Delete Text</a>
	                	</div>
	                	<div class="col-xs-1 col-md-1"></div>    
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-4 col-md-4" style="padding-top: 6px;" align="center">
	                		Alignment
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="alignleft-text" class="btn btn-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-align-left"></i></a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="aligncenter-text" class="btn btn-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-align-center"></i></a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="alignright-text" class="btn btn-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-align-right"></i></a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="justify-text" class="btn btn-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-align-justify"></i></a>
	                	</div>    
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;" align="right">
	                	<div class="col-xs-6 col-md-6" style="padding: 0px;margin:0px;"></div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;">
	                		<a href="#" id="bold-text" class="btn btn-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-bold"></i></a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;">
	                		<a href="#" id="italic-text" class="btn btn-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-italic"></i></a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;">
	                		<a href="#" id="underline-text" class="btn btn-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-underline"></i></a>
	                	</div>    
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-4 col-md-4" style="padding: 0px;margin:0px;padding-top: 6px;" align="center">Font Size</div>
	                	<div class="col-xs-8 col-md-8" style="padding: 0px;margin:0px;">
		                	<select id="fontsize-text" class="browser-default form-control" style="display: inline; width: 100%;">
		                        <option value="8">8</option>
		                        <option value="9">9</option>
		                        <option value="10">10</option>
		                        <option value="11">11</option>
		                        <option value="12">12</option>
		                        <option value="14">14</option>
		                        <option value="16">16</option>
		                        <option value="18">18</option>
		                        <option value="20">20</option>
		                        <option value="22">22</option>
		                        <option value="24">24</option>
		                        <option value="26">26</option>
		                        <option value="28">28</option>
		                        <option value="36">36</option>
		                        <option value="48">48</option>
		                        <option value="72">72</option>
		                    </select>
	                    </div>    
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-4 col-md-4" style="padding: 0px;margin:0px;padding-top: 6px;" align="center">Font Family</div>
	                	<div class="col-xs-8 col-md-8" style="padding: 0px;margin:0px;">
		                	<select id="fontfamily-text" class="browser-default form-control">
		                        <option value="Times New Romans">Times New Romans</option>
		                        <option value="Open Sans">Open Sans</option>
		                        <option value="Roboto">Roboto</option>
		                        <option value="Lato">Lato</option>
		                        <option value="Oswald">Oswald</option>
		                        <option value="Lora">Lora</option>
		                        <option value="Source Sans Pro">Source Sans Pro</option>
		                        <option value="Montserrat">Montserrat</option>
		                        <option value="Raleway">Raleway</option>
		                        <option value="Ubuntu">Ubuntu</option>
		                        <option value="Droid Serif">Droid Serif</option>
		                        <option value="Merriweather">Merriweather</option>
		                        <option value="Indie Flower">Indie Flower</option>
		                        <option value="Titillium Web">Titillium Web</option>
		                        <option value="Poiret One">Poiret One</option>
		                        <option value="Oxygen">Oxygen</option>
		                        <option value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
		                        <option value="Lobster">Lobster</option>
		                        <option value="Playfair Display">Playfair Display</option>
		                        <option value="Fjalla One">Fjalla One</option>
		                        <option value="Inconsolata">Inconsolata</option>
		                      </select>
	                    </div>    
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-4 col-md-4" style="padding: 0px;margin:0px;padding-top: 6px;" align="center">Background</div>
	                	<div class="col-xs-8 col-md-8" style="padding: 0px;margin:0px;">
		                	<select id="" class="browser-default form-control">
		                        <option value="">Solid Color</option>
		                        <option value="">Gradiant</option>
		                        <option value="">Upload Background</option>
		                        <option value="">Image</option>
		                        <option value="">Stock Photo</option>
		                    </select>
	                    </div>    
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-4 col-md-4" style="padding-top: 6px;" align="center">Color</div>
	                	<div class="col-xs-8 col-md-8" style="padding: 0px;margin:0px;text-align: right;">
		                	<div id = "colorpicker-text" class="browser-default form-control">
		                        <div class="color-box" style="z-index:1;">
		                        </div>
	                    	</div>
	                    </div>    
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
		                <div class="col-xs-4 col-md-4" style="padding: 0px;margin:0px;padding-top: 6px;" align="center">Opacity</div>
		                <div class="col-xs-8 col-md-8" >
		                	<input id="slider-text" type="range" min="0" max="100" step="10" style="width: 100%"/>
		                </div>
	                </div>
		    	</div>
		    </div>
		    <div id="Image" style="display: none; min-height: 482px;">
		    	<div class="panel-body">
		    		<p>Edit Image</p>
		    		<hr style="color: black;width: 100%; border-top: 1px solid #000000; margin: 0px; margin-bottom: 5px;">
		    		<div class="row">
                        <div class="col-md-12" align="center">
                          <button type="button" class="btn btn-primary" id="browse-image">Upload Image </button>
                          <input type="file" id="hidden-input-image" style="display:none;"/>
                        </div>
                    </div>
		    		<div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-1 col-md-1"></div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="sendfront-image" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><img class="imageIcon" src="<?php echo base_url('assets/img/layered-bottom.png'); ?>" style="height: 30px; "><br/> Send Front</a>
	                	</div>
	                	<div class="col-xs-2 col-md-2"  style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="sendback-image" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><img class="imageIcon" src="<?php echo base_url('assets/img/layered-top.png'); ?>" style="height: 30px; "><br/> Send Back</a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" id="lock-image" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-lock fa-2x" aria-hidden="true"></i><br/> Lock Image</a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" id="unlock-image" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-unlock fa-2x" aria-hidden="true"></i><br/> Unlock Image</a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" id="delete-image" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-trash fa-2x" aria-hidden="true"></i><br/> Delete Image</a>
	                	</div>
	                	<div class="col-xs-1 col-md-1"></div>    
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
		                <div class="col-xs-4 col-md-4" align="center">Opacity</div>
		                <div class="col-xs-8 col-md-8" >
		                	<input id="slider-image" type="range" min="0" max="100" step="10" style="width: 100%"/>
		                </div>
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-4 col-md-4" style="padding-top: 5px;" align="center">Color</div>
	                	<div class="col-xs-8 col-md-8" style="text-align: right">
		                	<div id = "colorpicker-image" class="browser-default form-control">
		                        <div class="color-box" style="z-index:1;"></div>
	                    	</div>
	                    </div>    
	                </div>  
		    	</div>
		    </div>
		    <div id="Shape" style="display: none;min-height: 482px;">
		    	<div class="panel-body">
		    		<p>Edit Shape</p>
		    		<hr style="color: black;width: 100%; border-top: 1px solid #000000; margin: 0px; margin-bottom: 5px;">
		    		<div class="row">
                        <div class="col-md-12" align="center">
                          <button type="button" class="btn btn-primary" id="browse-shape">Upload Shape </button>
                          <input type="file" id="hidden-input-Shape" style="display:none;"/>
                        </div>
                    </div>
		    		<div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-1 col-md-1"></div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="sendfront-shape" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><img class="imageIcon" src="<?php echo base_url('assets/img/layered-bottom.png'); ?>" style="height: 30px; "><br/> Send Front</a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="sendback-Shape" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><img class="imageIcon" src="<?php echo base_url('assets/img/layered-top.png'); ?>" style="height: 30px; "><br/> Send Back</a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="lock-Shape" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-lock fa-2x" aria-hidden="true"></i><br/> Lock Image</a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="unlock-Shape" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-unlock fa-2x" aria-hidden="true"></i><br/> Unlock Image</a>
	                	</div>
	                	<div class="col-xs-2 col-md-2" style="padding: 0px;margin:0px;" align="center">
	                		<a href="#" id="delete-Shape" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 100%"><i class="fa fa-trash fa-2x" aria-hidden="true"></i><br/> Delete Image</a>
	                	</div>
	                	<div class="col-xs-1 col-md-1"></div>    
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
		                <div class="col-xs-4 col-md-4" align="center">Opacity</div>
		                <div class="col-xs-8 col-md-8" >
		                	<input id="slider-shape" type="range" min="0" max="100" step="10" style="width: 100%"/>
		                </div>
	                </div>
	                <div class="row" style="margin-bottom: 15px;margin-top: 15px;">
	                	<div class="col-xs-4 col-md-4" style="padding-top: 5px;" align="center">Color</div>
	                	<div class="col-xs-8 col-md-8" style="text-align: right">
		                	<div id = "colorpicker-shape" class="browser-default form-control">
		                        <div class="color-box" style="z-index:1;"></div>
	                    	</div>
	                    </div>    
	                </div>  
		    	</div>
		    </div>
	    </div></div>
    </div>
<?php $this->load->view('user/incs/main_footer'); ?>