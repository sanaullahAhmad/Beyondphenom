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
        <h2>Templates List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>TemplateTitle</th>
		<th>TemplateDescription</th>
		<th>TemplateThumbnail</th>
		<th>TemplateImageUrl</th>
		<th>TemplateJson</th>
		<th>TemplatePrice</th>
		<th>TemplateType</th>
		<th>TemplateDate</th>
		<th>ProductId</th>
		<th>AdminId</th>
		
            </tr><?php
            foreach ($templates_data as $templates)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $templates->templateTitle ?></td>
		      <td><?php echo $templates->templateDescription ?></td>
		      <td><?php echo $templates->templateThumbnail ?></td>
		      <td><?php echo $templates->templateImageUrl ?></td>
		      <td><?php echo $templates->templateJson ?></td>
		      <td><?php echo $templates->templatePrice ?></td>
		      <td><?php echo $templates->templateType ?></td>
		      <td><?php echo $templates->templateDate ?></td>
		      <td><?php echo $templates->productId ?></td>
		      <td><?php echo $templates->adminId ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>