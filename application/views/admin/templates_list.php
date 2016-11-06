<style>
    #mytable_filter{text-align: right;}
    .dash-unit{height: auto;} 
</style>
    <div class="container dash-unit">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Templates List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('templates/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('templates/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('templates/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Title</th>
		    <th>Description</th>
		    <th>Thumbnail</th>
		    <!-- <th>ImageUrl</th> -->
		    <!-- <th>Json</th> -->
		    <th>Price</th>
		    <th>Status</th>
		    <th>Date</th>
		    <th>Product</th>
		    <!-- <th>AdminId</th> -->
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($templates_data as $templates)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $templates->templateTitle ?></td>
		    <td><?php echo $templates->templateDescription ?></td>
		    <td><a href="<?php echo base_url('templates/read/'.$templates->templateId); ?>"><?php echo "<img src='".read_file('public/uploads/templates/'.$templates->templateImageUrl)."' height='90px' />"; ?></a></td>
		    <!-- <td><?php // echo $templates->templateImageUrl ?></td> -->
		    <!-- <td><?php // echo $templates->templateJson ?></td> -->
		    <td>$<?php echo $templates->templatePrice ?></td>
		    <td><?php if($templates->templateType==0) echo "Draft"; else echo "Published"; ?></td>
		    <td><?php echo $templates->templateDate ?></td>
		    <td><a href="<?php echo site_url('products/read/'.$templates->productId); ?>" target="_blank"><?php echo $templates->productTitle; ?></a> </td>
		    <!-- <td><?php // echo $templates->adminId ?></td> -->
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('templates/read/'.$templates->templateId),'Read'); 
			echo ' | '; 
			echo anchor(site_url('templates/update/'.$templates->templateId),'Update'); 
			echo ' | '; 
			echo anchor(site_url('templates/delete/'.$templates->templateId),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
    </div>