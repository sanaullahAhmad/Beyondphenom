    <div class="container dash-unit" style="height: auto">
      <div class="row">
      <div class="col-md-6">
          <h2 style="margin-top:10px">Template Detail <small><?php echo $templateTitle; ?></small></h2>
          <br>
          <table class="table">
           <tr><td>Title</td><td><?php echo $templateTitle; ?></td></tr>
           <tr><td>Description</td><td><?php echo $templateDescription; ?></td></tr>
           <tr><td>Thumbnail</td><td><?php echo $templateThumbnail; ?></td></tr>
           <tr><td>Image</td><td><a href="<?php echo $templateImageUrl; ?>" target="_blank">Click Here</a></td></tr>
           <tr><td>Layer</td><td><a href="<?php echo$templateLayerUrl; ?>" target="_blank">Click Here</a></td></tr>
           <tr><td>Json</td><td><a href="<?php echo base_url('public/uploads/templates/'.$templateJsonUrl); ?>" target="_blank">Click Here</a></td></tr>
           <tr><td>Price</td><td><?php echo $templatePrice; ?></td></tr>
           <tr><td>Status</td><td><?php if($templateType==0) echo "Draft"; else echo "Published"; ?></td></tr>
           <tr><td>Date</td><td><?php echo $templateDate; ?></td></tr>
           <tr><td>Product</td><td><a href="<?php echo site_url('products/read/'.$productId); ?>" target="_blank"><?php echo $product->productTitle; ?></a> </td></tr>
           <!-- <tr><td>AdminId</td><td><?php echo $adminId; ?></td></tr> -->
           <tr><td colspan="2"><a href="<?php echo site_url('templates') ?>" class="btn btn-default">Go Back</a></td></tr>
         </table>
       </div>
       <div class="col-md-6">
       <img src="<?php echo $templateImageUrl; ?>" alt="<?php echo $templateTitle; ?>" width="100%"/>
       </div>
     </div>
   </div>