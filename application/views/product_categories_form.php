    <div class="container dash-unit">
    <div class="row">
        <div class="col-sm-7">
        <h2 style="margin-top:0px">Product Categories <small><?php echo $button ?></small></h2>

        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
            <label for="varchar">Title <?php echo form_error('categoryTitle') ?></label>
            <input type="text" class="form-control" name="categoryTitle" id="categoryTitle" value="<?php echo $categoryTitle; ?>" />
        </div>
            <div class="form-group">
                <label for="varchar">Base <?php echo form_error('categoryBase') ?></label>
                <input type="file" class="form-control" name="categoryBase" id="categoryBase" accept=".png,.jpg,.svg" value="<?php echo $categoryBase; ?>" multiple />
            </div>
            <div class="form-group">
                <label for="varchar">Middle <?php echo form_error('categoryMiddle') ?></label>
                <input type="file" class="form-control" name="categoryMiddle" id="categoryMiddle" accept=".png,.jpg,.svg" value="<?php echo $categoryMiddle; ?>" multiple />
            </div>
            <div class="form-group">
                <label for="varchar">Top <?php echo form_error('categoryTop') ?></label>
                <input type="file" class="form-control" name="categoryTop" id="categoryTop" accept=".png,.jpg,.svg" value="<?php echo $categoryTop; ?>" multiple />
            </div>
	    <div class="form-group">
            <label for="varchar">Obj File <?php echo form_error('categoryObjFile') ?></label>
            <input type="file" class="form-control" name="categoryObjFile" id="categoryObjFile" accept=".obj"  value="<?php echo $categoryObjFile; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">MTL File <?php echo form_error('categoryMTLFile') ?></label>
            <input type="file" class="form-control" name="categoryMTLFile" id="categoryMTLFile" accept=".mtl" value="<?php echo $categoryMTLFile; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Model Pattern File <?php echo form_error('categoryModelPatternFile') ?></label>
            <input type="file" class="form-control" name="categoryModelPatternFile" id="categoryModelPatternFile" accept=".png,.jpg"  value="<?php echo $categoryModelPatternFile; ?>" />
        </div>
	    <input type="hidden" name="categoryId" value="<?php echo $categoryId; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('product_categories') ?>" class="btn btn-default">Cancel</a>
	</form>
    <div class="clearfix clear-both"></div>
    </div>
    </div>
    </div>