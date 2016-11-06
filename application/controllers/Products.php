<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('adminId')) redirect('myadmin','refresh');
        $this->load->model('Products_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $products = $this->Products_model->get_all();

        $data = array(
            'products_data' => $products
            );

        $data['main']="admin/products_list";
        $this->load->view('admin/template',$data);
    }

    public function read($id) 
    {
        $row = $this->Products_model->get_by_id($id);
        if ($row) {
            $data = array(
              'productId' => $row->productId,
              'productTitle' => $row->productTitle,
              'productDescription' => $row->productDescription,
              'ProductThumbnail' => $row->ProductThumbnail,
              'productImageUrl' => $row->productImageUrl,
              'productJson' => $row->productJson,
              'productPrice' => $row->productPrice,
              'productType' => $row->productType,
              'productDate' => $row->productDate,
              'adminId' => $row->adminId,
              );
            $data['main']="admin/products_read";
            $this->load->view('admin/template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('products'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('products/create_action'),
            'productId' => set_value('productId'),
            'productTitle' => set_value('productTitle'),
            'productDescription' => set_value('productDescription'),
            'ProductThumbnail' => set_value('ProductThumbnail'),
            'productImageUrl' => set_value('productImageUrl'),
            'productJson' => set_value('productJson'),
            'productPrice' => set_value('productPrice'),
            'productType' => set_value('productType'),
            'productDate' => set_value('productDate'),
            'adminId' => set_value('adminId'),
            );
        $data['main']="admin/products_form";
        $this->load->view('admin/template',$data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {


            $config['upload_path']          = './public/uploads/products/';
            $config['allowed_types']        = 'gif|jpg|png|svg|obj';
            $config['file_ext_tolower'] = TRUE; 
            $config['max_size']             = 10000;
            $config['max_width']            = 3000;
            $config['max_height']           = 3000;
            $config['remove_spaces'] = TRUE;

            $this->load->library('upload', $config);

            $files = array();
            $errors = array();

            foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
            {
                if (!empty($fileObject['name']))
                {
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($fieldname))
                     array_push($errors, $this->upload->display_errors());
                 else array_push($files, $this->upload->data());

             }
            }

        if(count($errors)==0){

                /* if ( ! $this->upload->do_upload('ProductThumbnail'))
                {
                    $error = array('error' => $this->upload->display_errors());   
                    $this->session->set_flashdata('message', $error);
                }
                else 
                { }*/
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('message', $data);

                $data = array(
                    'productTitle' => $this->input->post('productTitle',TRUE),
                    'productDescription' => $this->input->post('productDescription',TRUE),
                    'ProductThumbnail' => $files[0]['file_name'],
                    'productImageUrl' => $files[1]['file_name'],
                    // 'productJson' => $this->input->post('productJson',TRUE),
                    'productPrice' => $this->input->post('productPrice',TRUE),
                    // 'productType' => $this->input->post('productType',TRUE),
                    'productDate' => $this->input->post('productDate',TRUE),
                    'adminId' => $this->input->post('adminId',TRUE),
                    );

                $this->Products_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('products'));
            }
            else{
                $this->session->set_flashdata('message', $errors[0]);
                redirect(site_url('products'));
            }

        }
    }
    
    public function update($id) 
    {
        $row = $this->Products_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('products/update_action'),
                'productId' => set_value('productId', $row->productId),
                'productTitle' => set_value('productTitle', $row->productTitle),
                'productDescription' => set_value('productDescription', $row->productDescription),
                'ProductThumbnail' => set_value('ProductThumbnail', $row->ProductThumbnail),
                'productImageUrl' => set_value('productImageUrl', $row->productImageUrl),
                'productJson' => set_value('productJson', $row->productJson),
                'productPrice' => set_value('productPrice', $row->productPrice),
                'productType' => set_value('productType', $row->productType),
                'productDate' => set_value('productDate', $row->productDate),
                'adminId' => set_value('adminId', $row->adminId),
                );
            // $this->load->view('admin/products_form', $data);
            $data['main']="admin/products_form";
            $this->load->view('admin/template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('products'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('productId', TRUE));
        } else {

            $files = array();
            $errors = array();

            if($_FILES['ProductThumbnail']['name']!='' || $_FILES['productImageUrl']['name']!='')
            {    
                // print_r($_FILES);
                // exit;
                $config['upload_path']          = './public/uploads/products/';
                $config['allowed_types']        = 'gif|jpg|png|svg|obj';
                $config['file_ext_tolower'] = TRUE; 
                $config['max_size']             = 10000;
                $config['max_width']            = 3000;
                $config['max_height']           = 3000;
                $config['remove_spaces'] = TRUE;

                $this->load->library('upload', $config);


                        foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
                        {
                            if (!empty($fileObject['name']))
                            {
                                $this->upload->initialize($config);
                                if (!$this->upload->do_upload($fieldname))
                                   array_push($errors, $this->upload->display_errors());
                               else array_push($files, $this->upload->data());

                           }
                       }

                       if(count($errors)==0){

                        $data = array('upload_data' => $this->upload->data());
                        $this->session->set_flashdata('message', $data);

                        if(!empty($_FILES['ProductThumbnail']['name']))
                        {
                            if(file_exists('./public/uploads/products/'.$this->input->post('old_thumb'))) 
                                unlink('./public/uploads/products/'.$this->input->post('old_thumb'));
                        }

                        if(!empty($_FILES['productImageUrl']['name']))
                        {
                            if(file_exists('./public/uploads/products/'.$this->input->post('old_image'))) 
                                unlink('./public/uploads/products/'.$this->input->post('old_image'));
                        }

                        if($files[0]['file_name']!='')
                        $ft = $files[0]['file_name'];
                        else $ft = $this->input->post('old_thumb');

                        if($files[1]['file_name']!='')
                        $fi = $files[1]['file_name'];
                        else $fi = $this->input->post('old_image');

                        $data = array(
                          'productTitle' => $this->input->post('productTitle',TRUE),
                          'productDescription' => $this->input->post('productDescription',TRUE),
                          'ProductThumbnail' => $ft,
                          'productImageUrl' => $fi,
                          'productJson' => $this->input->post('productJson',TRUE),
                          'productPrice' => $this->input->post('productPrice',TRUE),
                          'productType' => $this->input->post('productType',TRUE),
                          'productDate' => $this->input->post('productDate',TRUE),
                          'adminId' => $this->input->post('adminId',TRUE),
                          );

                        $this->Products_model->update($this->input->post('productId', TRUE), $data);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('products'));


                    }
                    else{
                        $this->session->set_flashdata('message', $errors[0]);
                        redirect(site_url('products'));
                    }
                }
                else{

                //     echo 'no file selcted'.$this->input->post('old_thumb');
                // exit;
                   $data = array(
                          'productTitle' => $this->input->post('productTitle',TRUE),
                          'productDescription' => $this->input->post('productDescription',TRUE),
                          'ProductThumbnail' => $this->input->post('old_thumb'),
                          'productImageUrl' => $this->input->post('old_image'),
                          'productJson' => $this->input->post('productJson',TRUE),
                          'productPrice' => $this->input->post('productPrice',TRUE),
                          'productType' => $this->input->post('productType',TRUE),
                          'productDate' => $this->input->post('productDate',TRUE),
                          'adminId' => $this->input->post('adminId',TRUE),
                          );

                   $this->Products_model->update($this->input->post('productId', TRUE), $data);
                   $this->session->set_flashdata('message', 'Update Record Success');
                   redirect(site_url('products'));
               }

           }
       }

    public function delete($id) 
    {
        $row = $this->Products_model->get_by_id($id);

        if ($row) {
            $this->Products_model->delete($id);
            $file = './public/uploads/products/'.$row->ProductThumbnail;
            if(file_exists($file)) unlink($file);

            $file = './public/uploads/products/'.$row->productImageUrl;
            if(file_exists($file)) unlink($file);
            
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('products'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('products'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('productTitle', 'producttitle', 'trim|required');
       $this->form_validation->set_rules('productDescription', 'productdescription', 'trim|required');
       $this->form_validation->set_rules('ProductThumbnail', 'productthumbnail', 'trim');
	// $this->form_validation->set_rules('productImageUrl', 'productimageurl', 'trim|required');
	// $this->form_validation->set_rules('productJson', 'productjson', 'trim|required');
       $this->form_validation->set_rules('productPrice', 'productprice', 'trim|required');
	// $this->form_validation->set_rules('productType', 'producttype', 'trim|required');
       $this->form_validation->set_rules('productDate', 'productdate', 'trim|required');
       $this->form_validation->set_rules('adminId', 'adminid', 'trim|required');

       $this->form_validation->set_rules('productId', 'productId', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

   public function excel()
   {
    $this->load->helper('exportexcel');
    $namaFile = "products.xls";
    $judul = "products";
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
    xlsWriteLabel($tablehead, $kolomhead++, "ProductTitle");
    xlsWriteLabel($tablehead, $kolomhead++, "ProductDescription");
    xlsWriteLabel($tablehead, $kolomhead++, "ProductThumbnail");
    xlsWriteLabel($tablehead, $kolomhead++, "ProductImageUrl");
    xlsWriteLabel($tablehead, $kolomhead++, "ProductJson");
    xlsWriteLabel($tablehead, $kolomhead++, "ProductPrice");
    xlsWriteLabel($tablehead, $kolomhead++, "ProductType");
    xlsWriteLabel($tablehead, $kolomhead++, "ProductDate");
    xlsWriteLabel($tablehead, $kolomhead++, "AdminId");

    foreach ($this->Products_model->get_all() as $data) {
        $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->productTitle);
        xlsWriteLabel($tablebody, $kolombody++, $data->productDescription);
        xlsWriteLabel($tablebody, $kolombody++, $data->ProductThumbnail);
        xlsWriteLabel($tablebody, $kolombody++, $data->productImageUrl);
        xlsWriteLabel($tablebody, $kolombody++, $data->productJson);
        xlsWriteNumber($tablebody, $kolombody++, $data->productPrice);
        xlsWriteNumber($tablebody, $kolombody++, $data->productType);
        xlsWriteLabel($tablebody, $kolombody++, $data->productDate);
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
    header("Content-Disposition: attachment;Filename=products.doc");

    $data = array(
        'products_data' => $this->Products_model->get_all(),
        'start' => 0
        );

    $this->load->view('admin/products_doc',$data);
}

}

/* End of file Products.php */
/* Location: ./application/controllers/Products.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-17 12:25:55 */
/* http://harviacode.com */