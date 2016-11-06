<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Templates extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('adminId')) redirect('myadmin','refresh');
        $this->load->model('Templates_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $templates = $this->Templates_model->get_all();
        $this->load->helper('file');

        $data = array(
            'templates_data' => $templates,
            // 'product' => $product
            );

        $data['main']="admin/templates_list";
        $this->load->view('admin/template',$data);

    }

    public function read($id) 
    {
        $row = $this->Templates_model->get_by_id($id);
        if ($row) {
            $this->load->helper('file');
            $this->load->model('Products_model');
            $product = $this->Products_model->get_by_id($row->productId);
            $data = array(
              'templateId' => $row->templateId,
              'templateTitle' => $row->templateTitle,
              'templateDescription' => $row->templateDescription,
              'templateThumbnail' => $row->templateThumbnail,
              'templateImageUrl' => read_file('public/uploads/templates/'.$row->templateImageUrl),
              'templateJsonUrl' => $row->templateJsonUrl,
              'templateLayerUrl' => read_file('public/uploads/templates/'.$row->templateLayerUrl),
              'templatePrice' => $row->templatePrice,
              'templateType' => $row->templateType,
              'templateDate' => $row->templateDate,
              'productId' => $row->productId,
              'product' => $product,
              'adminId' => $row->adminId,
              );
            $data['main']="admin/templates_read";
            $this->load->view('admin/template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('templates'));
        }
    }

    public function create($new=null) 
    {
        $products = $this->Templates_model->get_all_products(); 
        if($new) $selected_product = $this->Templates_model->get_product_by_id($new); 
        else $selected_product = null;

        $data = array(
            'button' => 'Create',
            'action' => site_url('templates/create_action'),
            'templateId' => set_value('templateId'),
            'templateTitle' => set_value('templateTitle'),
            'templateDescription' => set_value('templateDescription'),
            'templateThumbnail' => set_value('templateThumbnail'),
	        'templateImageUrl' => set_value('templateImageUrl'),
            'templateLayerUrl' => set_value('templateLayerUrl'),
            'templateJsonUrl' => set_value('templateJson'),
            'templatePrice' => set_value('templatePrice'),
            'templateType' => set_value('templateType'),
            'templateDate' => set_value('templateDate'),
            'productId' => set_value('productId'),
            'products' => $products,
            'new' => $new,
            'selected_product' => $selected_product,
            'adminId' => set_value('adminId'),
            );
        $data['main']="admin/templates_form";
        $this->load->view('admin/template',$data);
    }
    
    private function clean_string($str)
    {
        $str = strtolower(htmlentities($str)); 
        $str = str_replace(get_html_translation_table(), "-", $str);
        $str = str_replace(" ", "-", $str);
        $str = preg_replace("/[-]+/i", "-", $str);
        return $str;
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

             $data = array(
                'templateTitle' => $this->input->post('templateTitle',TRUE),
                'templateDescription' => $this->input->post('templateDescription',TRUE),
                'templateThumbnail' => $this->input->post('templateThumbnail',TRUE),
                'templateImageUrl' => $this->input->post('templateImageUrl',TRUE),
                'templateLayerUrl' => $this->input->post('templateLayerUrl',TRUE),
                'templateJsonUrl' => $this->input->post('templateJsonUrl',TRUE),
                'templatePrice' => $this->input->post('templatePrice',TRUE),
                'templateType' => $this->input->post('templateType',TRUE),
                'templateDate' => $this->input->post('templateDate',TRUE),
                'productId' => $this->input->post('productId',TRUE),
                'adminId' => $this->input->post('adminId',TRUE),
                );

             $this->Templates_model->insert($data);
             $this->session->set_flashdata('message', 'Create Record Success');
             redirect(site_url('templates'));

     }
 }

 public function base64_to_img()
 {
    // $base64 = 'data:image/png;base64,iVBORw0KGgoAAAANS';
    
    if($this->input->post('json'))
    {

       $this->load->helper('file');
       $output_file_without_extentnion = md5(time().uniqid());

        $canvas_json = $this->input->post('json');
        $canvas_image = $this->input->post('image');
        $canvas_layer = $this->input->post('image_layer');

        $errors = array();
        //saving json for image
        if(!write_file('./public/uploads/templates/'.$output_file_without_extentnion.'_canvas.json', htmlspecialchars_decode($canvas_json))) 
            {echo 'json file write failed'; array_push($errors, 'json file write failed');}

        //saving canvas image
        if(!write_file('./public/uploads/templates/'.$output_file_without_extentnion.'_image.json', htmlspecialchars_decode($this->input->post('image'))))
            {echo 'json image file write failed';array_push($errors, 'json image file write failed');}

        //saving canvas layer
        if(!write_file('./public/uploads/templates/'.$output_file_without_extentnion.'_image_layer.json', htmlspecialchars_decode($this->input->post('image_layer'))))
            {echo 'json layer file write failed'; array_push($errors, 'json layer file write failed');}

        if(count($errors)<1) echo $output_file_without_extentnion; else echo 'error';
       /*
/////// IMPORTANT CODE DO NOT REMOVE BELOW
    
        $base64 = htmlspecialchars_decode($this->input->post('image'));
        $splited = explode(',', substr( $base64 , 5 ) , 2);
        $mime=$splited[0];
        $data=base64_decode($splited[1]);
        write_file('./public/uploads/templates/'.$output_file_without_extentnion.'_image.json', $splited[1]);

        $mime_split_without_base64=explode(';', $mime,2);
        $mime_split=explode('/', $mime_split_without_base64[0],2);
        if(count($mime_split)==2)
        {
            $extension=$mime_split[1];
            if($extension=='jpeg')$extension='jpg';
            $output_file_with_extentnion=$output_file_without_extentnion.'_image.'.$extension;
        }
        else echo 'problem with json'; 

        if(!write_file('./public/uploads/templates/'.$output_file_with_extentnion, $data))
        echo "cannot write canvas image";

        //saving canvas layer
        $base64 = htmlspecialchars_decode($this->input->post('image_layer'));
        $splited = explode(',', substr( $base64 , 5 ) , 2);
        $mime=$splited[0];
        $data=base64_decode($splited[1]);
        write_file('./public/uploads/templates/'.$output_file_without_extentnion.'_image_layer.json', $splited[1]);

        $mime_split_without_base64=explode(';', $mime,2);
        $mime_split=explode('/', $mime_split_without_base64[0],2);
        if(count($mime_split)==2)
        {
            $extension=$mime_split[1];
            if($extension=='jpeg')$extension='jpg';
            $output_file_with_extentnion=$output_file_without_extentnion.'_layer.'.$extension;
        }
        else echo 'problem with json'; 

        if(!write_file('./public/uploads/templates/'.$output_file_with_extentnion, $data))
        echo "cannot write canvas image";
   

    /////// IMPORTANT CODE DO NOT REMOVE ABOVE
*/
 }
    else echo 'no base64 sent';
}

// public function rcv_json()
// {
//     $this->load->helper('file');
//     $file_name = md5(time().uniqid()).'.json';
//     if (write_file('./public/uploads/templates/'.$file_name, $this->input->post('json')))
//     {
//         $this->base64_export($file_name);
//     }


    
// }

public function template_export()
{

}

public function update($id) 
{
    $row = $this->Templates_model->get_by_id($id);



    if ($row) {


        $this->load->helper('file');
        $file_name = $row->templateJson;
        $json = read_file('./public/uploads/templates/'.$file_name);

        $data = array(
            'button' => 'Update',
            'action' => site_url('templates/update_action'),
            'templateId' => set_value('templateId', $row->templateId),
            'templateTitle' => set_value('templateTitle', $row->templateTitle),
            'templateDescription' => set_value('templateDescription', $row->templateDescription),
            'templateThumbnail' => set_value('templateThumbnail', $row->templateThumbnail),
            'templateImageUrl' => read_file('public/uploads/templates/'.$row->templateImageUrl),
            'templateJsonUrl' => $row->templateJsonUrl,
            'templateJson' => read_file('public/uploads/templates/'.$row->templateJsonUrl),
            'templateLayerUrl' => read_file('public/uploads/templates/'.$row->templateLayerUrl),
            'templatePrice' => set_value('templatePrice', $row->templatePrice),
            'templateType' => set_value('templateType', $row->templateType),
            'templateDate' => set_value('templateDate', $row->templateDate),
            'productId' => set_value('productId', $row->productId),
            'new' => $id,
            'selected_product' => $this->Templates_model->get_product_by_id($row->productId),
            'adminId' => set_value('adminId', $row->adminId),
            );
$data['main']="admin/templates_form";
$this->load->view('admin/template',$data);
} else {
    $this->session->set_flashdata('message', 'Record Not Found');
    redirect(site_url('templates'));
}
}

public function update_action() 
{
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
        $this->update($this->input->post('templateId', TRUE));
    } else {
        $data = array(
          'templateTitle' => $this->input->post('templateTitle',TRUE),
          'templateDescription' => $this->input->post('templateDescription',TRUE),
          'templateThumbnail' => $this->input->post('templateThumbnail',TRUE),
          'templateImageUrl' => $this->input->post('templateImageUrl',TRUE),
          'templateJson' => $this->input->post('templateJson',TRUE),
          'templatePrice' => $this->input->post('templatePrice',TRUE),
          'templateType' => $this->input->post('templateType',TRUE),
          'templateDate' => $this->input->post('templateDate',TRUE),
          'productId' => $this->input->post('productId',TRUE),
          'adminId' => $this->input->post('adminId',TRUE),
          );

        $this->Templates_model->update($this->input->post('templateId', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('templates'));
    }
}

public function delete($id) 
{
    $row = $this->Templates_model->get_by_id($id);

    if ($row) {
        $this->Templates_model->delete($id);
        $this->session->set_flashdata('message', 'Delete Record Success');
        redirect(site_url('templates'));
    } else {
        $this->session->set_flashdata('message', 'Record Not Found');
        redirect(site_url('templates'));
    }
}

public function _rules() 
{
	$this->form_validation->set_rules('templateTitle', 'templatetitle', 'trim|required');
	$this->form_validation->set_rules('templateDescription', 'templatedescription', 'trim|required');
	$this->form_validation->set_rules('templateThumbnail', 'templatethumbnail', 'trim|required');
	// $this->form_validation->set_rules('templateImageUrl', 'templateimageurl', 'trim|required');
	// $this->form_validation->set_rules('templateJson', 'templatejson', 'trim|required');
	$this->form_validation->set_rules('templatePrice', 'templateprice', 'trim|required');
	$this->form_validation->set_rules('templateType', 'templatetype', 'trim|required');
	$this->form_validation->set_rules('templateDate', 'templatedate', 'trim|required');
	$this->form_validation->set_rules('productId', 'productid', 'trim|required');
	$this->form_validation->set_rules('adminId', 'adminid', 'trim|required');

	$this->form_validation->set_rules('templateId', 'templateId', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
}

public function excel()
{
    $this->load->helper('exportexcel');
    $namaFile = "templates.xls";
    $judul = "templates";
    $tablehead = 0;
    $tablebody = 1;
    $nourut = 1;
        //penulisan header
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment;filename=" . $namaFile . "");
    header("Content-Transfer-Encoding: binary ");

    xlsBOF();

    $kolomhead = 0;
    xlsWriteLabel($tablehead, $kolomhead++, "No");
    xlsWriteLabel($tablehead, $kolomhead++, "TemplateTitle");
    xlsWriteLabel($tablehead, $kolomhead++, "TemplateDescription");
    xlsWriteLabel($tablehead, $kolomhead++, "TemplateThumbnail");
    xlsWriteLabel($tablehead, $kolomhead++, "TemplateImageUrl");
    xlsWriteLabel($tablehead, $kolomhead++, "TemplateJson");
    xlsWriteLabel($tablehead, $kolomhead++, "TemplatePrice");
    xlsWriteLabel($tablehead, $kolomhead++, "TemplateType");
    xlsWriteLabel($tablehead, $kolomhead++, "TemplateDate");
    xlsWriteLabel($tablehead, $kolomhead++, "ProductId");
    xlsWriteLabel($tablehead, $kolomhead++, "AdminId");

    foreach ($this->Templates_model->get_all() as $data) {
        $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->templateTitle);
        xlsWriteLabel($tablebody, $kolombody++, $data->templateDescription);
        xlsWriteLabel($tablebody, $kolombody++, $data->templateThumbnail);
        xlsWriteLabel($tablebody, $kolombody++, $data->templateImageUrl);
        xlsWriteLabel($tablebody, $kolombody++, $data->templateJson);
        xlsWriteNumber($tablebody, $kolombody++, $data->templatePrice);
        xlsWriteNumber($tablebody, $kolombody++, $data->templateType);
        xlsWriteLabel($tablebody, $kolombody++, $data->templateDate);
        xlsWriteNumber($tablebody, $kolombody++, $data->productId);
        xlsWriteNumber($tablebody, $kolombody++, $data->adminId);

        $tablebody++;
        $nourut++;
    }

    xlsEOF();
    exit();
}

public function word()
{
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=templates.doc");

    $data = array(
        'templates_data' => $this->Templates_model->get_all(),
        'start' => 0
        );

    $this->load->view('admin/templates_doc',$data);
}

}

/* End of file Templates.php */
/* Location: ./application/controllers/Templates.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-17 12:26:02 */
/* http://harviacode.com */