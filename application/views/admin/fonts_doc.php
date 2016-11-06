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
        <h2>Fonts List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>FontTitle</th>
		<th>FontUrl</th>
		<th>FontFamily</th>
		<th>FontDate</th>
		<th>AdminId</th>
		
            </tr><?php
            foreach ($fonts_data as $fonts)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $fonts->fontTitle ?></td>
		      <td><?php echo $fonts->fontUrl ?></td>
		      <td><?php echo $fonts->fontFamily ?></td>
		      <td><?php echo $fonts->fontDate ?></td>
		      <td><?php echo $fonts->adminId ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>