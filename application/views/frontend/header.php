<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product Configurator</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<style>
		body {
			font-family: Monospace;
			background-color: #C1C5C7;
			background: #C1C5C7 url('<?=base_url("assets/3d/images/bg.png")?>')  no-repeat; 
			background-size: 100% 100%;
			color: #fff;
			margin: 0px;
			min-height: 500px;
		}
		/* #tjs{background: #fff;} */
		#info {
			color: #fff;
			position: absolute;
			top: 10px;
			width: 100%;
			text-align: center;
			z-index: 100;
			display:block;
		}
		#info a, .button { color: #f00; font-weight: bold; text-decoration: underline; cursor: pointer; }
		#loading{

			text-align: center;
			width: 100%;
			height: 100%;
			margin: 0 auto;
			position: absolute;
			vertical-align: middle;
			top: 0;
			left: 0;
			background: rgba(255,255,255,0.9);
			z-index: 1000;
			padding-top: 21%;
			font-size: 32px!important;
			font-weight: bold;
			position: absolute;


		}
		#fabric{}
	</style>
	<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
		        
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
	<script>

		jQuery(document).ready(function($) {

			if (typeof(Storage) !== "undefined") 
			{
								// alert('anything?');
								var base = sessionStorage.getItem('base');
								// alert(base);
								if (base != 'undefined') {$('#color_svg_1').val(base);}

								var middle = sessionStorage.getItem('middle');
								if (middle != 'undefined') $('#color_svg_2').val(middle);

								var top = sessionStorage.getItem('top');
								if (top != 'undefined') $('#color_svg_3').val(top);
							}else alert('Local Storage Not Found. Please use chrome or firefox for best experience.');

						});
	</script>


<?php 
/*$this->session->sess_destroy();
echo '<pre>';
print_r($this->session);
echo '</pre>';
exit;
*/
$original_products = $this->allProd;
//$this->session->sess_destroy();
//exit;
if(!$this->session->userdata('sid')){
	$uid = time();
	$this->session->set_userdata('sid', $uid);
	$sid=$this->session->userdata('sid');
}else{
	$sid=$this->session->userdata('sid');
}
//create current product id
$data_cat = $this->Product_categories_model->get_by_id($this->uri->segment(2));
$product_from_url = intval($this->uri->segment(2));
//get current product
$product = array('product_name'=>$data_cat->categoryTitle,
    'base_svg'=>pathinfo($data_cat->categoryBase, PATHINFO_FILENAME),
    'middle_svg'=>pathinfo($data_cat->categoryMiddle, PATHINFO_FILENAME),
    'top_svg'=>pathinfo($data_cat->categoryTop, PATHINFO_FILENAME),
    'model_obj'=>pathinfo($data_cat->categoryObjFile, PATHINFO_FILENAME),
    'model_mtl' =>pathinfo($data_cat->categoryMTLFile, PATHINFO_FILENAME),
    'generate_file_name'=>$data_cat->categoryModelPatternFile);
//check if the product is in session
if(isset($this->session->userdata('product')[$product_from_url])){
	//echo "success";
//do nothing
}else{

$file_url = './public/uploads/product_categories/'.$product["product_name"].'/';

copy($file_url.$product["model_mtl"].'.mtl', './public/uploads/product_categories/'.$product['product_name'].'/session_'.$sid.'.mtl');
$data = file_get_contents($file_url.'session_'.$sid.'.mtl');
$data = str_replace($product['generate_file_name'], 'session_'.$sid.'.jpg', $data);

write_file($file_url.'session_'.$sid.'.mtl', $data);

copy($file_url.$product['generate_file_name'], './public/uploads/product_categories/'.$product['product_name'].'/session_'.$sid.'.jpg');
    //$current_prod[$product_from_url]=$original_products[$product_from_url];
    $current_prod[$product_from_url]=$product;
// create session products
push_session_array('product',$current_prod);
}
/*echo '<pre>';
print_r($this->session);
echo '</pre>';*/
$session_product = Array(['product_name'=>$product['product_name'], 
				  'base_svg'=>$product['base_svg'], 
				  'middle_svg'=>$product['middle_svg'], 
				  'top_svg'=>$product['top_svg'], 
				  
				  'model_obj'=>$product['model_obj'], 
				  'model_mtl' =>'session_'.$sid, 
				  'generate_file_name'=>'session_'.$sid.'.jpg']);
$product = $session_product[0];
// print_r($product); 
?>

	<script>


		var site_url = '<?=site_url()?>';
		var base_url = '<?=base_url()?>';



		base_svg = "<?=$product['base_svg']?>";
		middle_svg = "<?=$product['middle_svg']?>";
		top_svg = "<?=$product['top_svg']?>";

		model_obj = "<?=$product['model_obj']?>";
		model_mtl = "<?=$product['model_mtl']?>";

		generate_file_name = "<?=$product['generate_file_name']?>";
		productss = "<?=$product['product_name']?>";

	</script>