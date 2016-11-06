<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('session_array_helper');
        $this->load->model('Product_categories_model');
        $categories = $this->Product_categories_model->get_all();
        //echo "<pre>";print_r($categories);exit;
		$this->allProd = array(
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
	}
	public function index($product=null)
	{
        $this->load->model('Product_categories_model');
        $categories = $this->Product_categories_model->get_all();
        $data['indexx'] = $product;
        $data['categories'] = $categories;
		$this->load->view('frontend/landing_page', $data);
	}
	//add to cart
    function addTocart(){
    	if(isset($_POST['cart'])){
    		$prod=$this->input->post('cart');
    		if(is_numeric($prod)){
    			$curerntQty="";
    			if(!$this->session->userdata('cart')){
    				$activeProd=$this->allProd[$prod];
    				$activeProd['session_user']=$this->session->userdata('sid');
    				$activeProd['product_qty']=1;
    				$cartProd[$prod]=$activeProd;
    			}else{
    				if(array_key_exists($prod,$this->session->userdata('cart'))){
    					$oldProd=$this->session->userdata('cart')[$prod];
    				    $oldProd['product_qty']=$oldProd['product_qty']+1;
    				    if($oldProd['session_user']!=$this->session->userdata('sid')){
    				    	$this->session->unset_userdata('cart');
    				    	$cartProd="";
    				    }else{
    				    	$cartProd[$prod]=$oldProd;
    				    }
    				}else{
    				$activeProd=$this->allProd[$prod];
    				$activeProd['session_user']=$this->session->userdata('sid');
    				$activeProd['product_qty']=1;
    				$cartProd[$prod]=$activeProd;
    				}
    			}
    			if($cartProd!=""){
    				//push to session array
    				push_session_array('cart',$cartProd);
    			}else{
    				echo 'error';
    			}
    			//echo '<pre>';
    			//print_r($this->session->userdata('cart'));
    		}
    	}

    }
    function emptyCart(){
    	if(isset($_POST['emptycart'])){
    		$this->session->unset_userdata('cart');
    	}
    }
	function save_image($product=null)
	{
	    //echo "success";
		if(isset($_POST['json']))
		{
			$json = $_POST['json'];
			$this->session->set_userdata('jsn', $this->input->post('jsn'));
			$base64 = htmlspecialchars_decode($json);
			$splited = explode(',', substr( $base64 , 5 ) , 2);
        // print_r($splited); exit;
        // $mime=$splited[0];
			$data=base64_decode($splited[1]);
        // write_file('./public/uploads/templates/'.$output_file_without_extentnion.'_image.json', $splited[1]);
        // echo $data; exit;
        // $mime_split_without_base64=explode(';', $mime,2);
        // $mime_split=explode('/', $mime_split_without_base64[0],2);
        // if(count($mime_split)==2)
        // {
            // $extension=$mime_split[1];
            // if($extension=='jpeg')$extension='jpg';
            // if(file_exists('shorts.jpg')) unlink('shorts.jpg');

            // $output_file_with_extentnion= 'shorts.png';
            // echo 'done';
        // }
        // else echo 'problem with json'; 

			$myfile = fopen("./assets/3d/products/".$this->input->post('product')."/".$this->input->post('file'), "w") or die("Unable to open file!");
			if(fwrite($myfile, $data)) echo 'done';
			else echo 'unable to write';
			fclose($myfile);


        // if(!write_file('./'.$output_file_with_extentnion, $data)) echo "cannot write canvas image";
    	// else echo 'done';
		}else echo 'no post request';

	}
}
