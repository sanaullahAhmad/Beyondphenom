<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Pattern_collections List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>CollectionTitle</th>
		<th>CollectionDescription</th>
		<th>CollectionImage</th>
		<th>CollectionDate</th>
		<th>AdminId</th>
		
            </tr><?php
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
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>