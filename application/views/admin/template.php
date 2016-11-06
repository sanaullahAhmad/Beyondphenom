<?php 
	$this->load->view('admin/header'); 
	$this->load->view('admin/navbar'); 
	?>

		   
            
       <div>
            <?php $this->load->view($main); ?>
       </div>  

<?php $this->load->view('admin/footer'); ?> 