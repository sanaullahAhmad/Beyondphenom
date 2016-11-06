<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Pattern_collections Read</h2>
        <table class="table">
	    <tr><td>CollectionTitle</td><td><?php echo $collectionTitle; ?></td></tr>
	    <tr><td>CollectionDescription</td><td><?php echo $collectionDescription; ?></td></tr>
	    <tr><td>CollectionImage</td><td><?php echo $collectionImage; ?></td></tr>
	    <tr><td>CollectionDate</td><td><?php echo $collectionDate; ?></td></tr>
	    <tr><td>AdminId</td><td><?php echo $adminId; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pattern_collections') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>