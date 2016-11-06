    <div class="container dash-unit" style="height: auto">
    <div class="row">
        <div class="col-md-6">
        <h2 style="margin-top:0px">Products <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
            <label for="varchar">Product Title <?php echo form_error('productTitle') ?></label>
            <input type="text" class="form-control" name="productTitle" id="productTitle" placeholder="ProductTitle" value="<?php echo $productTitle; ?>" />
        </div>
	    <div class="form-group">
            <label for="productDescription">Product Description <?php echo form_error('productDescription') ?></label>
            <textarea class="form-control" rows="3" name="productDescription" id="productDescription" placeholder="ProductDescription"><?php echo $productDescription; ?></textarea>
        </div>
        <?php if($this->uri->segment(2)=='update') {?>
        <input type="hidden" value="<?php echo $ProductThumbnail; ?>" name="old_thumb">
        <div class="row">
            <div class="col-md-2">
                <a href="<?php echo base_url('public/uploads/products/'.$ProductThumbnail); ?>">
                    <img src="<?php echo base_url('public/uploads/products/'.$ProductThumbnail); ?>" style="border: 2px solid white; height:90px" />
                </a>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="varchar">Product Thumbnail <?php echo form_error('ProductThumbnail') ?></label>
                    <input type="file" class="form-control" name="ProductThumbnail" id="ProductThumbnail" placeholder="ProductThumbnail" value="<?php echo $ProductThumbnail; ?>" />
                </div>
            </div>
        </div>
        <br>
        <?php }else{?>
            <div class="form-group">
                <label for="varchar">Product Thumbnail <?php echo form_error('ProductThumbnail') ?></label>
                <input type="file" class="form-control" name="ProductThumbnail" id="ProductThumbnail" placeholder="ProductThumbnail" value="<?php echo $ProductThumbnail; ?>" />
            </div>
        <?php } ?>

        <?php if($this->uri->segment(2)=='update') {?>
        <input type="hidden" value="<?php echo $productImageUrl; ?>" name="old_image">
        <div class="row">
            <div class="col-md-2">
                <a href="<?php echo base_url('public/uploads/products/'.$productImageUrl); ?>">
                    <img src="<?php echo base_url('public/uploads/products/'.$productImageUrl); ?>" style="border: 2px solid white; height:90px" />
                </a>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="varchar">Product Canvas Image <?php echo form_error('productImageUrl') ?></label>
                    <input type="file" class="form-control" name="productImageUrl" id="productImageUrl" placeholder="productImageUrl" value="<?php echo $productImageUrl; ?>" />
                </div>
            </div>
        </div>
        <br>
        <?php }else{?>
            <div class="form-group">
                <label for="varchar">Product Canvas Image <?php echo form_error('productImageUrl') ?></label>
                <input type="file" class="form-control" name="productImageUrl" id="productImageUrl" placeholder="productImageUrl" value="<?php echo $productImageUrl; ?>" />
            </div>
        <?php } ?>
<!-- 
        <div class="form-group">
            <label for="varchar">Product Canvas Image <?php echo form_error('productImageUrl') ?></label>
            <input type="file" class="form-control" name="productImageUrl" id="productImageUrl" placeholder="productImageUrl" value="<?php echo $productImageUrl; ?>" />
        </div> -->
	    <!-- <input type="hidden" class="form-control" name="productImageUrl" id="productImageUrl" placeholder="productImageUrl" value="<?php echo $productImageUrl; ?>" /> -->
        <input type="hidden" class="form-control" name="productJson" id="productJson" placeholder="productJson" value="<?php if($productJson) echo $productJson; else echo 'null'; ?>" />
	    <div class="form-group">
            <label for="int">Product Price <?php echo form_error('productPrice') ?></label>
            <input type="text" class="form-control" name="productPrice" id="productPrice" placeholder="ProductPrice" value="<?php echo $productPrice; ?>" />
        </div>
	    <div class="form-group">
            <!-- <label for="int"><?php echo form_error('productType') ?></label> -->
            <input type="hidden" class="form-control" name="productType" id="productType" placeholder="ProductType" value="<?php if($productType) echo $productType; else echo '0'; ?>" />
            <!-- <label for="datetime"><?php echo form_error('productDate') ?></label> -->
            <input type="hidden" class="form-control" name="productDate" id="productDate" placeholder="productDate" value="<?php if(!$productDate) echo date("Y-m-d H:i:s"); else echo $productDate; ?>" />
            <!-- <label for="int"><?php echo form_error('adminId') ?></label> -->
            <input type="hidden" class="form-control" name="adminId" id="adminId" placeholder="AdminId" value="<?php if(!$adminId) echo $this->session->userdata('adminId'); else echo $adminId; ?>" />
        </div>
        <div class="form-group">
	    <input type="hidden" name="productId" value="<?php echo $productId; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('products') ?>" class="btn btn-default">Cancel</a>
        </div> 

        <?php if($this->uri->segment(2)=='update') {?>
        <p><strong>Note: </strong> Uploading new thumbnail or image will replace the previous images. If you do not select any image it will not be changed!</p>
        <?php } ?>
	</form>
    </div>
    </div>
    </div>