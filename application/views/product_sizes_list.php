<div class="container dash-unit">
        <h2 style="margin-top:0px">Product Sizes <small>List All</small></h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('product_sizes/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('product_sizes/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('product_sizes'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Title</th>
		<th>Size</th>
<?php /*<th>FIleSVG</th>
		<th>FilePNG</th>*/ ?>
		<th>Category</th>
		<th>Created Date</th>
		<th>Created By</th>
		<th>Action</th>
            </tr><?php
            foreach ($product_sizes_data as $product_sizes)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $product_sizes->sizeTitle ?></td>
			<td><?php echo $product_sizes->size ?></td>
                    <?php /*<td><?php echo $product_sizes->sizeFIleSVG ?></td>
			<td><?php echo $product_sizes->sizeFilePNG ?></td>*/ ?>
			<td><?php echo $product_sizes->categoryId ?></td>
			<td><?php echo $product_sizes->created_date ?></td>
			<td><?php echo $product_sizes->created_by ?></td>
<?php /*<td><?php echo $product_sizes->modified_date ?></td>
			<td><?php echo $product_sizes->modified_by ?></td>*/ ?>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('product_sizes/read/'.$product_sizes->sizeId),'Read'); 
				echo ' | '; 
				echo anchor(site_url('product_sizes/update/'.$product_sizes->sizeId),'Update'); 
				echo ' | '; 
				echo anchor(site_url('product_sizes/delete/'.$product_sizes->sizeId),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('product_sizes/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('product_sizes/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
</div>