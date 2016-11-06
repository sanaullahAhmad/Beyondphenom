    <div class="container dash-unit" style="height: auto">
    <div class="row">
        <div class="col-md-6">
        <h2 style="margin-top:0px">Admin Details: <small><?php echo $adminName; ?></small></h2>
        <br>  
        <table class="table">
	    <tr><td>AdminName</td><td><?php echo $adminName; ?></td></tr>
	    <tr><td>AdminEmail</td><td><?php echo $adminEmail; ?></td></tr>
	    <tr><td>AdminPassword</td><td><?php echo $adminPassword; ?></td></tr>
	    <tr><td>AdminDate</td><td><?php echo $adminDate; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('admins/update/'.$adminId) ?>" class="btn btn-default btn-warning">Update Details</a></td><td><a href="<?php echo site_url('admins') ?>" class="btn btn-default">Go Back</a></td></tr>
	</table>
         </div>
       </div>
       </div>