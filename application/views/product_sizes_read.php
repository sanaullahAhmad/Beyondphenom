<div class="container dash-unit">
        <h2 style="margin-top:0px">Product_sizes <small>View Detail</small></h2>
        <table class="table">
	    <tr><td>Title</td><td><?php echo $sizeTitle; ?></td></tr>
	    <tr><td>Size</td><td><?php echo $size; ?></td></tr>
	    <?php /* <tr><td>FIleSVG</td><td><?php echo $sizeFIleSVG; ?></td></tr>
	    <tr><td>FilePNG</td><td><?php echo $sizeFilePNG; ?></td></tr>*/?>
	    <tr><td>Category</td><td><?php echo $categoryId; ?></td></tr>
	    <tr><td>Created Date</td><td><?php echo $created_date; ?></td></tr>
	    <tr><td>Created By</td><td><?php echo $created_by; ?></td></tr>
	    <tr><td>Modified Date</td><td><?php echo $modified_date; ?></td></tr>
	    <tr><td>Modified By</td><td><?php echo $modified_by; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('product_sizes') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</div>