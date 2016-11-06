<div class="container dash-unit">
<div class="row">
    <div class="col-md-7">

        <h2 style="margin-top:0px">Product Sizes <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">SizeTitle <?php echo form_error('sizeTitle') ?></label>
            <input type="text" class="form-control" name="sizeTitle" id="sizeTitle" placeholder="SizeTitle" value="<?php echo $sizeTitle; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Size <?php echo form_error('size') ?></label>
            <input type="text" class="form-control" name="size" id="size" placeholder="Size" value="<?php echo $size; ?>" />
        </div>
	    <?php /*/ <div class="form-group">
            <label for="varchar">SizeFIleSVG <?php echo form_error('sizeFIleSVG') ?></label>
            <input type="text" class="form-control" name="sizeFIleSVG" id="sizeFIleSVG" placeholder="SizeFIleSVG" value="<?php echo $sizeFIleSVG; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">SizeFilePNG <?php echo form_error('sizeFilePNG') ?></label>
            <input type="text" class="form-control" name="sizeFilePNG" id="sizeFilePNG" placeholder="SizeFilePNG" value="<?php echo $sizeFilePNG; ?>" />
        </div>
    /*/ ?>
	    <div class="form-group">
            <label for="int">CategoryId <?php echo form_error('categoryId') ?></label>
            <select class="form-control" name="categoryId" id="categoryId" >
                <?php
                if($product_categories)
                {
                    foreach ($product_categories as $category)
                    {
                        ?>
                        <option value="<?php echo $category->categoryId; ?>" <?php if($category->categoryId==$categoryId){ echo "selected";} ?> ><?php echo $category->categoryTitle; ?></option>
                        <?php
                    }
                }

                ?>
            </select>
        </div>
<?php /*<div class="form-group">
            <label for="datetime">Created Date <?php echo form_error('created_date') ?></label>
            <input type="text" class="form-control" name="created_date" id="created_date" placeholder="Created Date" value="<?php echo $created_date; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Created By <?php echo form_error('created_by') ?></label>
            <input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Modified Date <?php echo form_error('modified_date') ?></label>
            <input type="text" class="form-control" name="modified_date" id="modified_date" placeholder="Modified Date" value="<?php echo $modified_date; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Modified By <?php echo form_error('modified_by') ?></label>
            <input type="text" class="form-control" name="modified_by" id="modified_by" placeholder="Modified By" value="<?php echo $modified_by; ?>" />
        </div>*/ ?>
	    <input type="hidden" name="sizeId" value="<?php echo $sizeId; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('product_sizes') ?>" class="btn btn-default">Cancel</a>
	</form>
    </div>
    </div>
</div>