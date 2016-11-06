    <div class="container dash-unit" style="height: auto">
    <div class="row">
        <div class="col-md-6">
    
        <h2 style="margin-top:0px">Fonts <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Title <?php echo form_error('fontTitle') ?></label>
            <input type="text" class="form-control" name="fontTitle" id="fontTitle" placeholder="FontTitle" value="<?php echo $fontTitle; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Url <?php echo form_error('fontUrl') ?></label>
            <input type="text" class="form-control" name="fontUrl" id="fontUrl" placeholder="FontUrl" value="<?php echo $fontUrl; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Family <?php echo form_error('fontFamily') ?></label>
            <input type="text" class="form-control" name="fontFamily" id="fontFamily" placeholder="FontFamily" value="<?php echo $fontFamily; ?>" />
        </div>
	    <!-- <div class="form-group"> -->
            <!-- <label for="datetime">Date <?php echo form_error('fontDate') ?></label> -->
            <input type="hidden" class="form-control" name="fontDate" id="fontDate" placeholder="FontDate" value="<?php if(!$fontDate) echo date("Y-m-d H:i:s"); else echo $fontDate; ?>" />
            <input type="hidden" class="form-control" name="adminId" id="adminId" placeholder="AdminId" value="<?php if(!$adminId) echo $this->session->userdata('adminId'); else echo $adminId; ?>" />
        <!-- </div> -->
	    <!-- <div class="form-group"> -->
            <!-- <label for="int">AdminId <?php echo form_error('adminId') ?></label> -->
            
        <!-- </div> -->
        <div class="form-group">
	    <input type="hidden" name="fontId" value="<?php echo $fontId; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('fonts') ?>" class="btn btn-default">Cancel</a>
        </div>
	</form>
    </div>
    </div>
    </div>
  