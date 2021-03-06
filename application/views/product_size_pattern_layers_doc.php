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
        <h2>Product_size_pattern_layers List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>VectorTitle</th>
		<th>VectorFileUrl</th>
		<th>VectorOrderNo</th>
		<th>PatternFileId</th>
		<th>Created Date</th>
		<th>Created By</th>
		<th>Modified Date</th>
		<th>Modified By</th>
		
            </tr><?php
            foreach ($product_size_pattern_layers_data as $product_size_pattern_layers)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $product_size_pattern_layers->vectorTitle ?></td>
		      <td><?php echo $product_size_pattern_layers->vectorFileUrl ?></td>
		      <td><?php echo $product_size_pattern_layers->vectorOrderNo ?></td>
		      <td><?php echo $product_size_pattern_layers->patternFileId ?></td>
		      <td><?php echo $product_size_pattern_layers->created_date ?></td>
		      <td><?php echo $product_size_pattern_layers->created_by ?></td>
		      <td><?php echo $product_size_pattern_layers->modified_date ?></td>
		      <td><?php echo $product_size_pattern_layers->modified_by ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>