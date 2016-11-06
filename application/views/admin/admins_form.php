    <div class="container dash-unit" style="height: auto">
    <div class="row">
    <div class="col-md-12">
        <h2 style="margin-top:0px">Admins <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">AdminName <?php echo form_error('adminName') ?></label>
            <input type="text" class="form-control" name="adminName" id="adminName" placeholder="AdminName" value="<?php echo $adminName; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">AdminEmail <?php echo form_error('adminEmail') ?></label>
            <input type="text" class="form-control" name="adminEmail" id="adminEmail" placeholder="AdminEmail" value="<?php echo $adminEmail; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">AdminPassword <?php echo form_error('adminPassword') ?></label>
            <input type="text" class="form-control" name="adminPassword" id="adminPassword" placeholder="AdminPassword" value="<?php echo $adminPassword; ?>" />
        </div>
        <div class="form-group">
        <input type="hidden" class="form-control" name="adminDate" id="adminDate" placeholder="adminDate" value="<?php if(!$adminDate) echo date("Y-m-d H:i:s"); else echo $adminDate; ?>" />
            <input type="hidden" class="form-control" name="adminId" id="adminId" placeholder="AdminId" value="<?php if(!$adminId) echo $this->session->userdata('adminId'); else echo $adminId; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('admins') ?>" class="btn btn-default">Go Back</a>
        </div>
	</form>
    </div></div>
    </div>