            <!---NAVIGATION BAR STARTS--->
            <!---NAVIGATION BAR STARTS-->
                   
     
     
        <?php if($this->session->userdata('adminId')){ ?>

            <!-- NAVIGATION MENU -->

    <div class="navbar-nav navbar-inverse navbar-fixed-top">
        <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url('index.php/myadmin'); ?>"><img src="<?php echo base_url('assets/img/logo30.png'); ?>" alt=""> Beyond Phenom Dashboard</a>
        </div> 
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <!-- <li class="active"><a href="<?php echo base_url('index.php/myadmin'); ?>"><i class="icon-home icon-white"></i> Home</a></li> -->
               <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products <span class="caret"></span></a>
          <ul class="dropdown-menu">
              <!-- <li>
              <a href="<?php echo base_url('index.php/products'); ?>"><i class="icon-folder-open icon-white"></i> Products</a>
                <ul> -->
                  <li>
                    <a href="<?=site_url('product_categories')?>">Product Categories</a>
                    <a href="<?=site_url('product_sizes')?>">Product Sizes</a>
                    <a href="<?=site_url('product_size_pattern_layers')?>">Product Printable Size Layers</a>
                    <a href="<?=site_url('product_categories')?>"></a>
                  </li>
                </ul>
              </li>

              <li><a href="<?php echo base_url('index.php/templates'); ?>"><i class="icon-calendar icon-white"></i> Templates</a></li>
              <li><a href="<?php echo base_url('index.php/patterns'); ?>"><i class="icon-th icon-white"></i> Patterns</a></li>
              <li><a href="<?php echo base_url('index.php/fonts'); ?>"><i class="icon-th icon-white"></i> Fonts</a></li>
              <li><a href="<?php echo base_url('index.php/admins'); ?>"><i class="icon-th icon-white"></i> Admins</a></li>
              <li><a href="<?php echo base_url('index.php/myadmin/logout'); ?>"><i class="icon-lock icon-white"></i> Logout</a></li>

            </ul>
          </div><!--/.nav-collapse -->
        </div>
    </div>


    <?php } else{?>
       <div class="navbar-nav navbar-inverse navbar-fixed-top">
        <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php base_url('index.php/myadmin'); ?>"><img src="<?php echo base_url('assets/img/logo30.png'); ?>" alt=""> Beyond Phenom Dashboard</a>
        </div> 
         
        </div>
    </div>
    <?php } ?>
          <!---NAVIGATION BAR ENDS--->
            <!---NAVIGATION BAR ENDS--->
            