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
        <h2>Patterns List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>PatternTitle</th>
		<th>PatternImage</th>
		<th>PatternDate</th>
		<th>CollectionId</th>
		<th>AdminId</th>
		
            </tr><?php
            foreach ($patterns_data as $patterns)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $patterns->patternTitle ?></td>
		      <td><?php echo $patterns->patternImage ?></td>
		      <td><?php echo $patterns->patternDate ?></td>
		      <td><?php echo $patterns->collectionId ?></td>
		      <td><?php echo $patterns->adminId ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>