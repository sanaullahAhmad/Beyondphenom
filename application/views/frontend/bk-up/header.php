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
/*$this->session->sess_destroy();*/
/*echo '<pre>';
print_r($this->session);
echo '</pre>';
exit;*/
$original_products = array(
				0 => 
						['product_name'=>'athlete-shorts', 'base_svg'=>'Base-v2', 'middle_svg'=>'Design-v2', 'top_svg'=>'Logo-v2', 
						 'model_obj'=>'Athletic_Shorts', 'model_mtl' =>'Athletic_Shorts', 'generate_file_name'=>'Shorts.jpg'],
				1 => 
						['product_name'=>'female-tights','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'FemaleTightsc4D1', 'model_mtl' =>'FemaleTightsc4D1', 'generate_file_name'=>'FemaleTights.jpg'], 
				2 => 	
						['product_name'=>'female-tank','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'FemapleTankC4D1', 'model_mtl' =>'FemapleTankC4D1', 'generate_file_name'=>'FemaleTank.jpg'], 
				3 => 
						['product_name'=>'sports-bra','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'SportsBraC4D', 'model_mtl' =>'SportsBraC4D', 'generate_file_name'=>'SportsBraMAT.jpg'], 
				4 => 
						['product_name'=>'female-short-sleeves','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'FemaleShortSleevesC4DA', 'model_mtl' =>'FemaleShortSleevesC4DA', 'generate_file_name'=>'FSS.jpg'], 
				5 => 
						['product_name'=>'female-long-sleeves','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'FemaleLongSleevesC4D1', 'model_mtl' =>'FemaleLongSleevesC4D1', 'generate_file_name'=>'FLS1.jpg'], 
				6 => 
						['product_name'=>'female-mid-sleeves','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'FemaleMidSleevesC4DA', 'model_mtl' =>'FemaleMidSleevesC4DA', 'generate_file_name'=>'FMS.jpg'], 

				7 => 
						['product_name'=>'male-tights','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'MaleTightsC4D1', 'model_mtl' =>'MaleTightsC4D1', 'generate_file_name'=>'MaleTights.jpg'], 
				8 => 
						['product_name'=>'male-sleeveless','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'MaleSleevelessC4D', 'model_mtl' =>'MaleSleevelessC4D', 'generate_file_name'=>'MaleSleeveless.jpg'], 
				9 => 
						['product_name'=>'male-mid-sleeves','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'MaleMidSleevesC4D', 'model_mtl' =>'MaleMidSleevesC4D', 'generate_file_name'=>'MalemidSleeve.jpg'], 
				10 => 
						['product_name'=>'male-short-sleeves','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'MaleShortSleevesC4D', 'model_mtl' =>'MaleShortSleevesC4D', 'generate_file_name'=>'MaleShortSleeve.jpg'], 
				11 => 
						['product_name'=>'male-long-sleeves','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'MaleLongSleevesC4D', 'model_mtl' =>'MaleLongSleevesC4D', 'generate_file_name'=>'MaleLongSleeves.jpg'], 
				

				 );

if(!$this->session->userdata('sid')){
	$uid = time();
	$this->session->set_userdata('sid', $uid);
	$sid=$this->session->userdata('sid');
}else{
	$sid=$this->session->userdata('sid');
}
//create current product id
$product_from_url = intval($this->uri->segment(2));
//get current product
$product = $original_products[ $product_from_url ];
//check if the product is in session 
if($this->session->userdata('product_'.$product_from_url)){
//do nothing
}else{

$file_url = './assets/3d/products/'.$product["product_name"].'/';

copy($file_url.$product["model_mtl"].'.mtl', './assets/3d/products/'.$product['product_name'].'/session_'.$sid.'.mtl');
$data = file_get_contents($file_url.'session_'.$sid.'.mtl');
$data = str_replace($product['generate_file_name'], 'session_'.$sid.'.jpg', $data);

write_file($file_url.'session_'.$sid.'.mtl', $data);

copy($file_url.$product['generate_file_name'], './assets/3d/products/'.$product['product_name'].'/session_'.$sid.'.jpg');

// create session products
$this->session->set_userdata('product_'.$product_from_url , $product);
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