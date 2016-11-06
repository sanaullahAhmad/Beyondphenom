<style>
    #mytable_filter{text-align: right;}
    .dash-unit{height: auto;} 
</style>
    <div class="container dash-unit">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Admins List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('admins/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('admins/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('admins/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Admin Name</th>
		    <th>Admin Email</th>
		    <!-- <th>AdminPassword</th> -->
		    <th>Account Added Date</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($admins_data as $admins)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $admins->adminName ?></td>
		    <td><?php echo $admins->adminEmail ?></td>
		    <!-- <td><?php echo $admins->adminPassword ?></td> -->
		    <td><?php echo $admins->adminDate ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('admins/read/'.$admins->adminId),'Read'); 
			echo ' | '; 
			echo anchor(site_url('admins/update/'.$admins->adminId),'Update'); 
			echo ' | '; 
			echo anchor(site_url('admins/delete/'.$admins->adminId),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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