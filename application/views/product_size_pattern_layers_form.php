<div class="container dash-unit">
<div class="row">
    <div class="col-md-7">
        <h2 style="margin-top:0px">Product Size Layers <small><?php echo $button ?></small></h2>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
            <label for="varchar">VectorTitle <?php echo form_error('vectorTitle') ?></label>
            <input type="text" class="form-control" name="vectorTitle" id="vectorTitle" placeholder="VectorTitle" value="<?php echo $vectorTitle; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Vector File <?php echo form_error('vectorFileUrl') ?></label>
            <input type="file" class="form-control" name="vectorFileUrl" id="vectorFileUrl" placeholder="VectorFileUrl" value="<?php echo $vectorFileUrl; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">VectorOrderNo <?php echo form_error('vectorOrderNo') ?></label>
            <input type="text" class="form-control" name="vectorOrderNo" id="vectorOrderNo" placeholder="VectorOrderNo" value="<?php echo $vectorOrderNo; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Product Size <?php echo form_error('patternFileId') ?></label>
            <select class="form-control" name="patternFileId" id="patternFileId" >
                <?php
                if($product_sizes)
                {
                    foreach ($product_sizes as $size)
                    {
                        ?>
                        <option value="<?php echo $size->sizeId; ?>" <?php if($size->sizeId==$patternFileId){ echo "selected";} ?> ><?php echo $size->sizeTitle; ?></option>
                        <?php
                    }
                }

                ?>
            </select>

        </div>
	    <div class="form-group hidden">
            <label for="datetime">Created Date <?php echo form_error('created_date') ?></label>
            <input type="text" class="form-control" name="created_date" id="created_date" placeholder="Created Date" value="<?php echo $created_date; ?>" />
        </div>
	    <div class="form-group hidden">
            <label for="int">Created By <?php echo form_error('created_by') ?></label>
            <input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>" />
        </div>
	    <div class="form-group hidden">
            <label for="datetime">Modified Date <?php echo form_error('modified_date') ?></label>
            <input type="text" class="form-control" name="modified_date" id="modified_date" placeholder="Modified Date" value="<?php echo $modified_date; ?>" />
        </div>
	    <div class="form-group hidden">
            <label for="int">Modified By <?php echo form_error('modified_by') ?></label>
            <input type="text" class="form-control" name="modified_by" id="modified_by" placeholder="Modified By" value="<?php echo $modified_by; ?>" />
        </div>
	    <input type="hidden" name="vectorId" value="<?php echo $vectorId; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('product_size_pattern_layers') ?>" class="btn btn-default">Cancel</a>
	</form>
    </div>
    </div>
</div>