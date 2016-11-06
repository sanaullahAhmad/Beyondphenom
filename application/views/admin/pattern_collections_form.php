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
        <h2 style="margin-top:0px">Pattern_collections <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">CollectionTitle <?php echo form_error('collectionTitle') ?></label>
            <input type="text" class="form-control" name="collectionTitle" id="collectionTitle" placeholder="CollectionTitle" value="<?php echo $collectionTitle; ?>" />
        </div>
	    <div class="form-group">
            <label for="collectionDescription">CollectionDescription <?php echo form_error('collectionDescription') ?></label>
            <textarea class="form-control" rows="3" name="collectionDescription" id="collectionDescription" placeholder="CollectionDescription"><?php echo $collectionDescription; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">CollectionImage <?php echo form_error('collectionImage') ?></label>
            <input type="text" class="form-control" name="collectionImage" id="collectionImage" placeholder="CollectionImage" value="<?php echo $collectionImage; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">CollectionDate <?php echo form_error('collectionDate') ?></label>
            <input type="text" class="form-control" name="collectionDate" id="collectionDate" placeholder="CollectionDate" value="<?php echo $collectionDate; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">AdminId <?php echo form_error('adminId') ?></label>
            <input type="text" class="form-control" name="adminId" id="adminId" placeholder="AdminId" value="<?php echo $adminId; ?>" />
        </div>
	    <input type="hidden" name="collectionId" value="<?php echo $collectionId; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pattern_collections') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>