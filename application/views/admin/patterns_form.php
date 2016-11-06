    <div class="container dash-unit" style="height: auto">
    <div class="row">
        <div class="col-md-6">
        <h2 style="margin-top:0px">Patterns <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
            <label for="varchar">Title <?php echo form_error('patternTitle') ?></label>
            <input type="text" class="form-control" name="patternTitle" id="patternTitle" placeholder="PatternTitle" value="<?php echo $patternTitle; ?>" />
        </div>
        <?php if($this->uri->segment(2)=='update') {?>
        <a href="<?php echo base_url('public/uploads/patterns/'.$patternImage); ?>">
            <img src="<?php echo base_url('public/uploads/patterns/'.$patternImage); ?>" style="border: 2px solid white; height:120px" />
        </a>
        <?php } ?>
	    <div class="form-group">
            <label for="varchar">Image <?php echo form_error('patternImage') ?></label>
            <input type="file" class="form-control" name="patternImage" id="patternImage" placeholder="PatternImage" value="<?php echo $patternImage; ?>" />
        </div>
        <input type="hidden" name="old_image" value="<?php echo $patternImage ?>" />
        <?php if($this->uri->segment(2)=='update') {?>
        <p><strong>Note: </strong> Uploading new image will replace the previous image. If you do not select any image it will not be changed!</p>
        <?php } ?>
	   
	    <!-- <div class="form-group">
            <label for="int">CollectionId <?php echo form_error('collectionId') ?></label>
            <input type="text" class="form-control" name="collectionId" id="collectionId" placeholder="CollectionId" value="<?php echo $collectionId; ?>" />
        </div> -->
	    <div class="form-group">
           <input type="hidden" class="form-control" name="patternDate" id="patternDate" placeholder="patternDate" value="<?php if(!$patternDate) echo date("Y-m-d H:i:s"); else echo $patternDate; ?>" />
            <input type="hidden" class="form-control" name="adminId" id="adminId" placeholder="AdminId" value="<?php if(!$adminId) echo $this->session->userdata('adminId'); else echo $adminId; ?>" />
        
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('patterns') ?>" class="btn btn-default">Cancel</a>
        <input type="hidden" name="patternId" value="<?php echo $patternId; ?>" /> 
        </div>
	</form>
    </div>
    </div>
    </div>

