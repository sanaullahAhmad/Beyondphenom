<div class="container dash-unit">
        <h2 style="margin-top:0px">Product Printable Pattern Layers <small>List All</small></h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('product_size_pattern_layers/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('product_size_pattern_layers/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('product_size_pattern_layers'); ?>" class="btn btn-default">Reset</a>
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
		<th>FileUrl</th>
		<th>Sort No</th>
		<th>Size</th>
		<th>Created Date</th>
		<th>Created By</th>
		<th>Action</th>
            </tr><?php
            foreach ($product_size_pattern_layers_data as $product_size_pattern_layers)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $product_size_pattern_layers->vectorTitle ?></td>
			<td><?php echo $product_size_pattern_layers->vectorFileUrl ?></td>
			<td><?php echo $product_size_pattern_layers->vectorOrderNo ?></td>
			<td><?php echo $product_size_pattern_layers->patternFileId ?></td>
			<td><?php echo $product_size_pattern_layers->created_date ?></td>
			<td><?php echo $product_size_pattern_layers->created_by ?></td>
			<!-- <td><?php echo $product_size_pattern_layers->modified_date ?></td>
			<td><?php echo $product_size_pattern_layers->modified_by ?></td> -->
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('product_size_pattern_layers/read/'.$product_size_pattern_layers->vectorId),'Read'); 
				echo ' | '; 
				echo anchor(site_url('product_size_pattern_layers/update/'.$product_size_pattern_layers->vectorId),'Update'); 
				echo ' | '; 
				echo anchor(site_url('product_size_pattern_layers/delete/'.$product_size_pattern_layers->vectorId),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('product_size_pattern_layers/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('product_size_pattern_layers/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>