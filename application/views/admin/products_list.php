<style>
    #mytable_filter{text-align: right;}
    .dash-unit{height: auto!important;}
</style>

    <div class="container dash-unit">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Products List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('products/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('products/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('products/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Thumbnail</th>
		    <th>Title</th>
		    <th>Description</th>
		    
		    <!-- <th>ImageUrl</th> -->
		    <!-- <th>Json</th> -->
		    <th>Price</th>
		    <!-- <th>Type</th> -->
		    <th>Date</th>
		    <!-- <th>AdminId</th> -->
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($products_data as $products)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
            <td>      <a taget="_blank" href="<?php echo site_url('products/read/'.$products->productId) ?>">
            <img src="<?php echo base_url('public/uploads/products/'.$products->ProductThumbnail); ?>" alt="<?php echo $products->ProductThumbnail; ?>" height="90px" />
        </a></td>
		    <td><?php echo $products->productTitle ?></td>
		    <td><?php echo $products->productDescription ?></td>
		    
		    <!-- <td><?php echo $products->productImageUrl ?></td> -->
		    <!-- <td><?php echo $products->productJson ?></td> -->
		    <td><?php echo $products->productPrice ?></td>
		    <!-- <td><?php echo $products->productType ?></td> -->
		    <td><?php echo $products->productDate ?></td>
		    <!-- <td><?php echo $products->adminId ?></td> -->
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('products/read/'.$products->productId),'Read'); 
			echo ' | '; 
			echo anchor(site_url('products/update/'.$products->productId),'Update'); 
			echo ' | '; 
			echo anchor(site_url('products/delete/'.$products->productId),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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