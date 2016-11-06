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
        <h2>Product_categories List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>CategoryTitle</th>
		<th>CategoryThumbnail</th>
		<th>CategoryObjFile</th>
		<th>CategoryMTLFile</th>
		<th>CategoryModelPatternFile</th>
		<th>Created Date</th>
		<th>Created By</th>
		<th>Modified Date</th>
		<th>Modified By</th>
		
            </tr><?php
            foreach ($product_categories_data as $product_categories)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $product_categories->categoryTitle ?></td>
		      <td><?php echo $product_categories->categoryThumbnail ?></td>
		      <td><?php echo $product_categories->categoryObjFile ?></td>
		      <td><?php echo $product_categories->categoryMTLFile ?></td>
		      <td><?php echo $product_categories->categoryModelPatternFile ?></td>
		      <td><?php echo $product_categories->created_date ?></td>
		      <td><?php echo $product_categories->created_by ?></td>
		      <td><?php echo $product_categories->modified_date ?></td>
		      <td><?php echo $product_categories->modified_by ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>