    <div class="container dash-unit" style="height: auto">
    <div class="row">
        <div class="col-md-6">
        <h2 style="margin-top:10px">Product Detail <small><?php echo $productTitle; ?></small></h2>
        <br>
        <table class="table">
	    <tr><td>Title</td><td><?php echo $productTitle; ?></td></tr>
	    <tr><td>Description</td><td><?php echo $productDescription; ?></td></tr>
	    <tr><td>Thumbnail</td><td>
	    <a href="<?php echo base_url('public/uploads/products/'.$ProductThumbnail); ?>">
	    	<img src="<?php echo base_url('public/uploads/products/'.$ProductThumbnail); ?>" alt="<?php echo $ProductThumbnail; ?>" height="120px" />
    	</a>
	    	 </td></tr>
	    <!-- <tr><td>ImageUrl</td><td><?php echo $productImageUrl; ?></td></tr> -->
	    <tr><td>Json</td><td><?php echo $productJson; ?></td></tr>
	    <tr><td>Price</td><td><?php echo $productPrice; ?></td></tr>
	    <tr><td>Type</td><td><?php echo $productType; ?></td></tr>
	    <tr><td>ProductDate</td><td><?php echo $productDate; ?></td></tr>
	    <!-- <tr><td>AdminId</td><td><?php echo $adminId; ?></td></tr> -->
	    <tr><td><a href="<?php echo site_url('products/update/'.$productId) ?>" class="btn btn-warning">Edit Product</a></td><td><a href="<?php echo site_url('products') ?>" class="btn btn-default">Go Back</a></td></tr>
	</table>
             </div>

             <div class="col-md-6 text-center" style="padding: 10px">
             	<canvas id="mycanvas"></canvas>
             </div>
       </div>
       </div> 
       <div id="dom-target" style="display: none;">
           <?php echo base_url('public/uploads/products/'.$productImageUrl); ?>
          </div>
    <script type="text/javascript" src="<?php echo base_url('assets/js/fabric/fabric.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/fabric/custom-fabric.js'); ?>"></script>
  	<script type="text/javascript" src="<?php echo base_url('assets/js/fabric/products_read.js'); ?>"></script>