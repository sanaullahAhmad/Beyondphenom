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
        <h2>Admins List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>AdminName</th>
		<th>AdminEmail</th>
		<th>AdminPassword</th>
		<th>AdminDate</th>
		
            </tr><?php
            foreach ($admins_data as $admins)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $admins->adminName ?></td>
		      <td><?php echo $admins->adminEmail ?></td>
		      <td><?php echo $admins->adminPassword ?></td>
		      <td><?php echo $admins->adminDate ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>