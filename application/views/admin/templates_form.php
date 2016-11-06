<style>

  #panel-title-black{color: #000000!important;}
  #panel-title-black a{color: #000000!important;}
</style>
<div class="container dash-unit" style="height: auto">

  <?php

  if(!isset($new)){
   if($this->uri->segment(2)=='create' || $this->uri->segment(3)=='create' ){?>
   <br>
   <h1>Choose the Product</h1>
   <h3>for which you want to create template</h3>
   <br>
   <hr>
   <br>
   <div class="row">
    <?php  foreach($products as $product){?>
    <a href="<?php echo site_url('templates/create/'.$product->productId); ?>">
      <div class="col-md-3 text-center">
        <div><img src="<?php echo base_url('public/uploads/products/'.$product->ProductThumbnail); ?>" alt="Product Image" style="height: 150px;"></div>
        <div><?php echo $product->productTitle; ?></div>
      </div>
    </a>
    <?php } ?>
  </div>
  <br>
  <?php } 
}else {?>
<div class="row">
  <div class="col-md-3" id="template_detail">
    <h2 style="margin-top:0px"><?php echo $button ?> Template  <?php if(isset($new) && $this->uri->segment(2)!='update')echo " <small><br>for <strong><a href='".site_url('products/read/'.$selected_product->productId)."' target='_blank'>".$selected_product->productTitle."</a></strong></small>"; ?></h2>
    <form action="<?php echo $action; ?>" method="post" id="template_form">
     <div class="form-group">
      <label for="varchar">Template Title <?php echo form_error('templateTitle') ?></label>
      <input type="text" class="form-control" name="templateTitle" id="templateTitle" placeholder="TemplateTitle" value="<?php echo $templateTitle; ?>" required/>
    </div>
    <div class="form-group">
      <label for="templateDescription">Template Description <?php echo form_error('templateDescription') ?></label>
      <textarea class="form-control" rows="3" name="templateDescription" id="templateDescription" placeholder="TemplateDescription"><?php echo $templateDescription; ?></textarea>
    </div>
<!--     <div class="form-group">
  <label for="varchar">Template Thumbnail <?php echo form_error('templateThumbnail') ?></label>
  <input type="text" class="form-control" name="templateThumbnail" id="templateThumbnail" placeholder="TemplateThumbnail" value="<?php echo $templateThumbnail; ?>" />
</div> -->
      <!-- <div class="form-group">
            <label for="varchar">Template ImageUrl <?php echo form_error('templateImageUrl') ?></label>
            <input type="text" class="form-control" name="templateImageUrl" id="templateImageUrl" placeholder="TemplateImageUrl" value="<?php echo $templateImageUrl; ?>" />
        </div>
      <div class="form-group">
            <label for="templateJson">Template Json <?php echo form_error('templateJson') ?></label>
            <textarea class="form-control" rows="3" name="templateJson" id="templateJson" placeholder="TemplateJson"><?php echo $templateJson; ?></textarea>
          </div> -->
          <input type="hidden" class="form-control" name="templateThumbnail" id="templateThumbnail" placeholder="TemplateThumbnail" value="<?php if(!$templateThumbnail) echo 'null'; else echo $templateThumbnail; ?>" />
          <input type="hidden" class="form-control" name="templateJsonUrl" id="templateJsonUrl" placeholder="templateJsonUrl" value="<?php echo $templateJsonUrl; ?>" />
          <input type="hidden" class="form-control" name="templateImageUrl" id="templateImageUrl" placeholder="templateImageUrl" value="<?php echo $templateImageUrl; ?>" />
          <input type="hidden" class="form-control" name="templateLayerUrl" id="templateLayerUrl" placeholder="templateLayerUrl" value="<?php echo $templateLayerUrl; ?>" />

          <div class="form-group">
            <label for="int">Template Price <?php echo form_error('templatePrice') ?></label>
            <input type="text" class="form-control" name="templatePrice" id="templatePrice" placeholder="TemplatePrice" value="<?php echo $templatePrice; ?>"  required/>
          </div>
          <div class="form-group">
            <label for="int">Template Type <?php echo form_error('templateType') ?></label>
            <!-- <input type="text" class="form-control" name="templateType" id="templateType" placeholder="TemplateType" value="<?php if(!$templateType) echo '1'; else echo $templateType; ?>" /> -->
            <select class="form-control" name="templateType" id="templateType">
              <option value="">Select</option>
              <option value="0">Draft</option>
              <option value="1">Published</option>
              <!-- <option value=""></option> -->
            </select>
          </div>

          <input type="hidden" class="form-control" name="productId" id="productId" placeholder="ProductId" value="<?php echo $new; ?>" />
     <!--  <div class="form-group">
            <label for="int">Product <?php echo form_error('productId') ?></label>
            <select  name="productId" id="productId" class="form-control" >
            <option value="">Select</option>
            <?php 
            if(count($products)>0){
            foreach ($products as $pro) {?>
                <option value="<?php echo $pro->productId; ?>"><?php echo $pro->productTitle; ?></option>
            <?php }
            }else{?>
                <option value="">Select</option>
                <option value="null">0 Products - Create Prodcut First</option>
            <?php } ?>
            </select>
        </div>
      -->
      <div class="form-group">
        <input type="hidden" class="form-control" name="templateDate" id="templateDate" placeholder="templateDate" value="<?php if(!$templateDate) echo date("Y-m-d H:i:s"); else echo $templateDate; ?>" />
        <input type="hidden" class="form-control" name="adminId" id="adminId" placeholder="AdminId" value="<?php if(!$adminId) echo $this->session->userdata('adminId'); else echo $adminId; ?>" />
      </div>
      <div class="form-group">
      <input type="hidden" name="templateId" value="<?php echo $templateId; ?>" /> 
      <button type="submit" class="btn btn-primary" id="form_submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"><?php echo $button ?></button> 
      <a href="<?php echo site_url('templates') ?>" class="btn btn-warning">Cancel</a>
      </div>
      
      <div class="form-group">
      <a class="btn btn-default " id="hide-btn">&laquo; Hide Column</a>
      </div>
    </form>

    <div id="json_div" style="display: none"></div>
    <div id="image_div" style="display: none"></div>
    <div id="image_layer_div" style="display: none"></div>
    <div id="json_div_back" style="display: none"></div>
    <div id="image_div_back" style="display: none"></div>
    <div id="image_layer_div_back" style="display: none"></div>

  </div>

  <div class="col-md-9" id="editor">
    <div class="row">
      <div class="col-md-8" style="border: 1px solid white; height: 580px; margin:0px;padding:0px; background: white;">
        <!-- canvas here -->
        <center>
          <canvas id="mycanvas"></canvas>

        </center>
        <!-- </div> -->
      </div>
      <div class="col-md-4" style="border: 1px solid white; height: 580px; background: white; overflow-y: scroll;">
        <div id="dom-target" style="display: none;">
          <?php if($selected_product) echo base_url('public/uploads/products/'.$selected_product->productImageUrl); ?>
        </div>
        <!-- toolbox -->
        <div class="panel-group" id="accordion" style="color: #444;">

<!-- TEXT SECTION START -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title" id="panel-title-black">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                  <span class="fa-stack">
                    <i class="fa fa-square-o fa-stack-2x"></i>
                    <i class="fa fa-font fa-stack-1x"></i>
                  </span> ADD TEXT</a>
                </h4>
              </div>
              <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="comment">Insert Text: </label>
                        <textarea class="form-control" rows="5" id="textarea1" style="height: 60px;"></textarea>
                      </div>
                    </div>
                  </div>

                   <div class="row"style="margin-top: -15px;">
                    <div class="col-md-12">
                      <button type="button" class="btn btn-primary" id="addtext"><i class="fa fa-plus"></i> Add Text</button> &nbsp;
                      <button class="btn btn-default" id="lock" type="button" data-type="lock">
                        <i class="fa fa-lock"></i>
                      </button>
                      <button class="btn btn-default btn-primary"  id="unlock"type="button" data-type="unlock">
                        <i class="fa fa-unlock"></i>
                      </button>

                    </div>
                  </div>

                  <div class="row"style="margin-top: 6px;">
                    <div class="col-md-12">
                      <div class="btn-group" style="display: inline-block;">
                        <a href="#" class="btn btn-default" id="italic"><i class="fa fa-italic"></i></a>
                        <a href="#" class="btn btn-default" id="bold"><i class="fa fa-bold"></i></a>
                        <a href="#" class="btn btn-default" id="underline"><i class="fa fa-underline"></i></a>
                      </div>
                      <select id="fontsize" class="browser-default form-control" style="display: inline; width: 65px;">
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

                  <div class="row" style="margin-top: 6px">
                    <div class="col-md-12">
      
                      
                      <div id="editor-textAlign" role="group" class="btn-group" style="display: inline-block;">
                        <button data-type="left" id="alignleft"class="btn btn-default" type="button"><i class="fa fa-align-left"></i></button>
                        <button data-type="center" id="aligncenter"class="btn btn-default" type="button"><i class="fa fa-align-center"></i></button>
                        <button data-type="right" id="alignright"class="btn btn-default" type="button"><i class="fa fa-align-right"></i></button>
                        <button data-type="justify" id="justify"class="btn btn-default" type="button"><i class="fa fa-align-justify"></i></button>
                      </div>

                      <button type="button" class="btn btn-danger"id="removetext"  data-toggle="tooltip" data-placement="right" title="Remove Text"><i class="fa fa-trash fa-lg" ></i></button>
                      
                    </div>
                  </div>

                  <div class="row"style="margin-top: 6px;">
                    <div class="col-md-12">
                      <div class="col-md-2" style="padding: 0; margin: 0; margin-top: 6px"><label for="comment">Font: </label></div>
                      <div class="col-md-10" style="padding: 0; margin: 0;"><select id="txtfont" class="browser-default form-control">
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
                  </div>
                  <div class="row" style="margin-top: 6px;">
                    <div class="col-md-4" align="left">
                      <label for="shirt_color">Color:</label>
                    </div>
                    <div class="col-md-8">
                      <div id = "colorpicker7">
                        <div class="color-box" style="z-index:1;">
                        </div>
                      </div>
                    </div>
                  </div>

               
                  <div class="row" style="margin-top: 6px;">
                    <div class="col-md-3">
                      <label for="test5b">Opacity:</label>
                    </div>
                    <div class="col-md-9">
                      <input style="width: 100%; background-color: lightcyan;height: 24px; margin-bottom: 0;"  id="test5b" id="ex17a" type="text" />
                    </div>
                  </div>

                  <div class="row" style="margin-top: 6px;">
                    <div class="col-md-12">
                      <button id="editor-sendBack" class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Send to Back">
                        <img class="imageIcon" src="<?php echo base_url('assets/img/layered-bottom.png'); ?>" style="height: 16px; ">
                      </button>
                      <button id="editor-bringFront" class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Bring to Front">
                        <img class="imageIcon" src="<?php echo base_url('assets/img/layered-top.png'); ?>" style="height: 16px; ">
                      </button>
                    </div>
                  </div>


                </div>
              </div>
            </div>

<!-- IMAGES SECTION START -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title" id="panel-title-black">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                      <span class="fa-stack">
                    <i class="fa fa-square-o fa-stack-2x"></i>
                    <i class="fa fa-image fa-stack-1x"></i>
                  </span>
                        ADD Image</a>
                      </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                      <div class="panel-body">
                       <div class="row">
                        <div class="col-md-5">
                          <button type="button" class="btn btn-primary" id="browse-img">Upload File</button>
                          <input type="file" id="hidden-input-img" multiple style="display:none;"/>
                        </div>
                        <div class="col-md-6">                              
                          <button type="button" class="btn btn-default"id="imgrotationleft" data-toggle="tooltip" data-placement="bottom" title="Rotate Left"><i class="fa fa-undo"></i></button>                                                           
                          <button type="button" class="btn btn-default"id="imgrotationright"  data-toggle="tooltip" data-placement="bottom" title="Rotate Right"><i class="fa fa-repeat"></i></button>                                                                                      
                          
                        </div>
                      </div>
                      <div class="row"style="margin-top: 6px;">
                      <div class="col-md-3">
                        <label for="test5b">Opacity:</label>
                      </div>
                      <div class="col-md-9">
                        <input style="width: 100%;
                        background-color: lightcyan;height: 24px;" id="test5c" id="ex17a" type="text" />
                      </div>
                    </div>
                    <div class="row" style="padding: 0px;margin: 0px;">
                      <button class="btn btn-default" id ="lockimg" type="button" data-type="lock">
                        <i class="fa fa-lock"></i>
                      </button>
                      <button class="btn btn-default btn-primary" id ="unlockimg" type="button" data-type="unlock">
                        <i class="fa fa-unlock"></i>
                      </button>
                      <button id="editor-sendBackimg" class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Send to Back">
                        <img class="imageIcon" src="<?php echo base_url('assets/img/layered-bottom.png'); ?>" style="height: 16px; ">
                      </button>
                      <button id="editor-bringFrontimg" class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Bring to Front">
                        <img class="imageIcon" src="<?php echo base_url('assets/img/layered-top.png'); ?>" style="height: 16px; ">
                      </button>
                      <button type="button" class="btn btn-danger"id="removesvg"><i class="fa fa-trash"></i></button>
                    </div>
                    </div>
                    
                  </div>
                </div>
<!-- vectorS SECTION START -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title" id="panel-title-black">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                  <span class="fa-stack">
                    <i class="fa fa-square-o fa-stack-2x"></i>
                    <i class="fa fa-bars fa-stack-1x"></i>
                  </span>
                    Vectors/Layers</a>
                  </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-7" style="padding-right: 0;">
                      <button type="button" class="btn btn-primary" id="browse-svg">Upload Vectors</button>
                        <input type="file" id="hidden-input-svg" multiple style="display:none;"/>
                      </div>
                      <div class="col-md-5" style="padding-right: 0; padding-left: 5px;">                              
                        <button type="button" class="btn btn-default"id="svgrotationleft" data-toggle="tooltip" data-placement="bottom" title="Rotate Left"><i class="fa fa-undo"></i></button>                                                           
                        <button type="button" class="btn btn-default"id="svgrotationright"  data-toggle="tooltip" data-placement="bottom" title="Rotate Right"><i class="fa fa-repeat"></i></button>                                                                                      
                      </div>
                    </div>
                    <div class="row"style="margin-top: 6px;">
                      <div class="col-md-3">
                        <label for="test5d">Opacity:</label>
                      </div>
                      <div class="col-md-9">
                        <input style="width: 100%;
                        background-color: lightcyan;height: 24px;" id="test5d" id="ex17a" type="text" />
                      </div>
                    </div>
                    <div class="row" style="margin-top: 6px;">
                      <div class="col-md-4" align="left">
                        <label for="shirt_color">Color:</label>
                      </div>
                      <div class="col-md-8">
                        <div id = "colorpicker8">
                          <div class="color-box" style="z-index:1;">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="margin-top: 6px;">
                      <div class="col-md-7"><label for="allow-patterns" style="display: inline-block; padding-top: 10px">Allow Patterns </label></div>
                      <div class="col-md-2"><input id="allow-patterns" type="checkbox" class="form-control"></div>
                    </div>
                    <div class="row"style="padding: 0px;margin: 0px;">
                    <button class="btn btn-default"id="locksvg" type="button" data-type="lock">
                        <i class="fa fa-lock"></i>
                      </button>
                      <button class="btn btn-default btn-primary" id="unlocksvg"type="button" data-type="unlock">
                        <i class="fa fa-unlock"></i>
                      </button>
                      <button id="editor-sendBacksvg" class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Send to Back">
                        <img class="imageIcon" src="<?php echo base_url('assets/img/layered-bottom.png'); ?>" style="height: 16px; ">
                      </button>
                      <button id="editor-bringFrontsvg" class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Bring to Front">
                        <img class="imageIcon" src="<?php echo base_url('assets/img/layered-top.png'); ?>" style="height: 16px; ">
                      </button>
                      <button type="button" class="btn btn-danger"id="removesvg1"><i class="fa fa-trash"></i></button>
                    </div>
                  </div>
                  </div>
                </div>            
<!-- PATTERNS SECTION START -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title" id="panel-title-black">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse-patterns" id="load_patterns">
                      <span class="fa-stack">
                    <i class="fa fa-square-o fa-stack-2x"></i>
                    <i class="fa fa-th fa-stack-1x"></i>
                  </span>
                        Patterns</a>
                      </h4>
                    </div>
                    <div id="collapse-patterns" class="panel-collapse collapse">
                      <div class="panel-body">

                        <div class="row" style="margin-bottom: 10px;">
                          <div class="col-md-12">
                            <div id="patterns_div"></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <label>
                               Width
                            </label>
                          </div>
                          <div class="col-md-8" align="left">
                            <input type="range" id="myRange" min="50" max="1000" value="200" style="width: 130px" align="left"/>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <label>
                               Angle  
                            </label>
                          </div>
                          <div class="col-md-8">
                             <input type="range" id="img-angle" min="50" max="1000" value="200" style="width: 130px"/>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <label>
                               Move <small>(Horizontal)</small>
                            </label>
                          </div>
                          <div class="col-md-8">
                           <input type="range" id="img-offset-x" min="50" max="1000" value="200" style="width: 130px"/>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <label>
                               Move <small>(Vertical) </small>
                            </label>
                          </div>
                          <div class="col-md-8">
                            <input type="range" id="img-offset-y" min="50" max="1000" value="200" style="width: 130px"/>
                          </div>
                        </div>
                        <div class="row"style="margin-top: 6px;">
                          <div class="col-md-3">
                            <label for="test5d">Repeat Patteren</label>
                          </div>
                          <div class="col-md-9">
                            <input type="checkbox" id="img-repeat"name="vehicle" value="Car">
                          </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                        <button type="button" class="btn btn-primary" id="browse-pattern">Upload Pattern </button>
                          <input type="file" id="hidden-input-pattern" style="display:none;"/>
                          <button type="button" class="btn btn-danger"id="removepattern"  data-toggle="tooltip" data-placement="bottom" title="Remove Pattern"><i class="fa fa-trash fa-lg" ></i></button>
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>
<!-- OPTIONS SECTION START -->
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title" id="panel-title-black">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse-options">
                            <span class="fa-stack">
                              <i class="fa fa-square-o fa-stack-2x"></i>
                              <i class="fa fa-cog fa-stack-1x"></i>
                              </span>
                            Options</a>
                          </h4>
                        </div>
                        <div id="collapse-options" class="panel-collapse collapse">
                          <div class="panel-body">
                            <div class="row">
                              <button type="button" class="btn btn-primary" id="front_shirt">Front </button>
                              <button type="button" class="btn btn-primary" id="back_shirt">Back </button>
                              <button type="button" class="btn btn-primary" id="Pattren_file">Pattren </button>
                            </div>
                            <!-- <div class="row">
                                <div class="col m6 s12">
                                    <div class="form-group">
                                            <label class="active" for="NewWidthEx">Export Width</label>
                                        <input id="NewWidthEx" type="text" value="500" />
                                    </div>                                    
                                </div>
                                <div class="col m6 s12">
                                    <div class="form-group">
                                        <label class="active" for="NewHeightEx">
                                            Export Height
                                        </label>
                                        <input id="NewHeightEx" type="text" value="600"/>
                                    </div>
                                </div>
                                <a class="waves-effect waves-light btn" align="right"id="Exportbtn" style="background-color:purple; font-size:10px;">
                                        Export
                                    </a>
                                    <a class="waves-effect waves-light btn" align="right"id="Explayer" style="background-color:orange; font-size:10px;">
                                        ExpLayer
                                    </a>
                                    <a href="#" id="to_object">Get Object</a>
                            </div> 
                            <div class="row">
                              <div class="form-group">
                                <button type="button" class="btn btn-primary" id="json">Json </button>
                              </div>
                            </div>-->
                               <div class="row"style="margin-left: 1px;margin-top: 6px;">
                    <div calss="col-md-12">
                      <div class="col-md-4" style="padding: 0; margin: 0; margin-top: 6px"><label for="shirt_color">Shirt color:</label></div>
                      <div class="col-md-8" style="padding: 0; margin: 0; padding-right: 15px;">
                        <select id="shirt_color" class="icons form-control">
                          <option value="" disabled selected>Shirt Color</option>
                          <option value="Red">Red</option>
                          <option value="Green">Green</option>
                          <option value="Blue">Blue</option>
                          <option value="lightgray">lightgray</option>
                          <option value="brown">brown</option>
                          <option value="black">black</option>
                          <option value="gray">gray</option>
                          <option value="skyblue">skyblue</option>
                          <option value="Yellow">Yellow</option>
                          <option value="#FFA500"> Orange</option>
                          <option value="Purple">Purple</option>
                          <option value="White">White</option>
                          <option value="#FF4500">OrangeRed</option>
                          <option value="Gold">Gold</option>
                          <option value="SteelBlue">SteelBlue</option>
                          <option value="Silver">Silver</option>
                        </select>
                      </div>
                    </div>
                  </div>
<br>
                            <div>
                              <a href="#" class="btn btn-default" id="show-btn" style="display:none" >&raquo; Show Side Panel</a>  
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <br>
                      <br>
                    </div>
                  </div>
                </div>  
              </div>
            </div>
            <?php } 
            ?>
          </div>
          <script type="text/javascript" src="<?php echo base_url('assets/js/fabric/fabric.min.js'); ?>"></script>
          <script type="text/javascript" src="<?php echo base_url('assets/js/bootbox.min.js'); ?>"></script>
          <?php if($this->uri->segment(2)=='update'){?>
          <script type="text/javascript">
          var front = '<?php echo htmlspecialchars_decode($templateJson); ?>'; </script>
          <script type="text/javascript" src="<?php echo base_url('assets/js/fabric/template_fabric_update.js'); ?>"></script>
          <script type="text/javascript" src="<?php echo base_url('assets/js/fabric/template_update.js'); ?>"></script>
          <?php }else {?>
          <script type="text/javascript" src="<?php echo base_url('assets/js/fabric/templates_read.js'); ?>"></script>
          <script type="text/javascript" src="<?php echo base_url('assets/js/fabric/templates-fabric.js'); ?>"></script>
          <?php } ?>
          <script type="text/javascript" src="<?php echo base_url('assets/js/colpick.js'); ?>"></script>
          <script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js">
          </script>
          <script>
            WebFont.load({
              google: {
                families: ['Open Sans',
                'Roboto',
                'Lato',
                'Oswald',
                'Lora',
                'Source Sans Pro',
                'Montserrat',
                'Raleway',
                'Ubuntu',
                'Droid Serif',
                'Merriweather',
                'Indie Flower',
                'Titillium Web',
                'Poiret One',
                'Oxygen',
                'Yanone Kaffeesatz',
                'Lobster',
                'Playfair Display',
                'Fjalla One',
                'Inconsolata',
                'Droid Sans',
                'Droid Serif']
              }
            });

            var site_url = "<?php echo site_url(); ?>";
          var base_url = "<?php echo base_url(); ?>";

          // $(document).ready(function() {
          //   // alert();
          //    prototypefabric.createOverlay_front(url);
          // });
          

            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })

            $('#hide-btn').click(function(){
              $('#editor').attr('class','col-md-12');
              $('#template_detail').hide();
              $('#show-btn').show();
            })

            $('#show-btn').click(function(){
              $('#editor').attr('class','col-md-9');
              $('#template_detail').fadeIn();
              $('#show-btn').hide();
            })

            $('#load_patterns').on('click', function(event) {
              // event.preventDefault();
              $.ajax({
                url: site_url+'/patterns/get_all_patterns',
                type: 'default',
                // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                // data: {param1: 'value1'},
                success: function(res){
                  
                  var obj = $.parseJSON(res);
                  $('#collapse-patterns .panel-body #patterns_div').html("<div></div>");
                  for(n = 0; n<obj.length; n++)
                  {
                    // alert(n);
                    $('#collapse-patterns .panel-body #patterns_div').append('<img class="pattern_click" id="pattern'+obj[0].patternId+'" src="'+base_url+'/public/uploads/patterns/'+obj[n].patternImage+'" height="50px" width="50px" />&nbsp;');
                  }
                  // alert(obj[0].patternImage);

                  

                },
                error: function(res){}
              });
              

            });
          </script>
        </body>
        </html>