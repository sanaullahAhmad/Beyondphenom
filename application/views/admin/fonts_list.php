<style>
    #mytable_filter{text-align: right;}
    .dash-unit{height: auto;} 
</style>
    <div class="container dash-unit">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Fonts List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('fonts/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('fonts/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('fonts/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Font Title</th>
		    <th>Font Url</th>
		    <th>Font Family</th>
		    <th>Date Added</th>
		    <!-- <th>AdminId</th> -->
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($fonts_data as $fonts)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $fonts->fontTitle ?></td>
		    <td><?php echo $fonts->fontUrl ?></td>
		    <td><?php echo $fonts->fontFamily ?></td>
		    <td><?php echo $fonts->fontDate ?></td>
		    <!-- <td><?php echo $fonts->adminId ?></td> -->
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('fonts/read/'.$fonts->fontId),'Read'); 
			echo ' | '; 
			echo anchor(site_url('fonts/update/'.$fonts->fontId),'Update'); 
			echo ' | '; 
			echo anchor(site_url('fonts/delete/'.$fonts->fontId),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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