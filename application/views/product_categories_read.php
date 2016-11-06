    <div class="container dash-unit">
        <h2 style="margin-top:0px">Product Categories <small>View Detail</small></h2>
        <table class="table">
	    <tr><td>Title</td><td><?php echo $categoryTitle; ?></td></tr>
	    <tr><td>Thumbnail</td><td><?php echo $categoryBase; ?></td></tr>
	    <tr><td>ObjFile</td><td><?php echo $categoryObjFile; ?></td></tr>
	    <tr><td>MTLFile</td><td><?php echo $categoryMTLFile; ?></td></tr>
	    <tr><td>ModelPatternFile</td><td><?php echo $categoryModelPatternFile; ?></td></tr>
	    <tr><td>Created Date</td><td><?php echo $created_date; ?></td></tr>
	    <tr><td>Created By</td><td><?php echo $created_by; ?></td></tr>
	    <tr><td>Modified Date</td><td><?php echo $modified_date; ?></td></tr>
	    <tr><td>Modified By</td><td><?php echo $modified_by; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('product_categories') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </div>