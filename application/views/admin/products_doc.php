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
        <h2>Products List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>ProductTitle</th>
		<th>ProductDescription</th>
		<th>ProductThumbnail</th>
		<th>ProductImageUrl</th>
		<th>ProductJson</th>
		<th>ProductPrice</th>
		<th>ProductType</th>
		<th>ProductDate</th>
		<th>AdminId</th>
		
            </tr><?php
            foreach ($products_data as $products)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $products->productTitle ?></td>
		      <td><?php echo $products->productDescription ?></td>
		      <td><?php echo $products->ProductThumbnail ?></td>
		      <td><?php echo $products->productImageUrl ?></td>
		      <td><?php echo $products->productJson ?></td>
		      <td><?php echo $products->productPrice ?></td>
		      <td><?php echo $products->productType ?></td>
		      <td><?php echo $products->productDate ?></td>
		      <td><?php echo $products->adminId ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>