<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Pattern_collections List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('pattern_collections/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('pattern_collections/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('pattern_collections/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>CollectionTitle</th>
		    <th>CollectionDescription</th>
		    <th>CollectionImage</th>
		    <th>CollectionDate</th>
		    <th>AdminId</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($pattern_collections_data as $pattern_collections)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $pattern_collections->collectionTitle ?></td>
		    <td><?php echo $pattern_collections->collectionDescription ?></td>
		    <td><?php echo $pattern_collections->collectionImage ?></td>
		    <td><?php echo $pattern_collections->collectionDate ?></td>
		    <td><?php echo $pattern_collections->adminId ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('pattern_collections/read/'.$pattern_collections->collectionId),'Read'); 
			echo ' | '; 
			echo anchor(site_url('pattern_collections/update/'.$pattern_collections->collectionId),'Update'); 
			echo ' | '; 
			echo anchor(site_url('pattern_collections/delete/'.$pattern_collections->collectionId),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
    </body>
</html>