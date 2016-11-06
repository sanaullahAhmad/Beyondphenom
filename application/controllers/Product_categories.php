<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_categories extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_categories_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'product_categories/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'product_categories/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'product_categories/index.html';
            $config['first_url'] = base_url() . 'product_categories/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Product_categories_model->total_rows($q);
        $product_categories = $this->Product_categories_model->get_limit_data($config['per_page'], $start, $q);
        $this->load->model('Admins_model');
        foreach ($product_categories as $key => $category) {
                $cr_by = $this->Admins_model->get_by_id($category->created_by);
                $product_categories{$key}->created_by = $cr_by->adminName;
        }

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'product_categories_data' => $product_categories,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            );
        $data['main'] = 'product_categories_list';
        $this->load->view('admin/template',$data);
    }

    public function read($id) 
    {
        $row = $this->Product_categories_model->get_by_id($id);
        if ($row) {
            $data = array(
              'categoryId' => $row->categoryId,
              'categoryTitle' => $row->categoryTitle,
                'categoryBase' => $row->categoryBase,
                'categoryMiddle' => $row->categoryMiddle,
                'categoryTop' => $row->categoryTop,
              'categoryObjFile' => $row->categoryObjFile,
              'categoryMTLFile' => $row->categoryMTLFile,
              'categoryModelPatternFile' => $row->categoryModelPatternFile,
              'created_date' => $row->created_date,
              'created_by' => $row->created_by,
              'modified_date' => $row->modified_date,
              'modified_by' => $row->modified_by,
              );
            // $this->load->view('product_categories_read', $data);

            $this->load->model('Admins_model');
            $cr_by = $this->Admins_model->get_by_id($data['created_by']);
            $data['created_by'] = $cr_by->adminName;
            $md_by = $this->Admins_model->get_by_id($data['modified_by']);
            if($md_by)
            {
                $data['modified_by'] = $md_by->adminName;
            }
            else{
                $data['modified_by'] = '';
            }

            $data['main'] = 'product_categories_read';
            $this->load->view('admin/template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_categories'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('product_categories/create_action'),
            'categoryId' => set_value('categoryId'),
            'categoryTitle' => set_value('categoryTitle'),
            'categoryBase' => set_value('categoryBase'),
            'categoryMiddle' => set_value('categoryMiddle'),
            'categoryTop' => set_value('categoryTop'),
            'categoryObjFile' => set_value('categoryObjFile'),
            'categoryMTLFile' => set_value('categoryMTLFile'),
            'categoryModelPatternFile' => set_value('categoryModelPatternFile'),
            'created_date' => set_value('created_date'),
            'created_by' => set_value('created_by'),
            'modified_date' => set_value('modified_date'),
            'modified_by' => set_value('modified_by'),
            );
        //echo "<pre>";print_r($data);exit;
        // $this->load->view('product_categories_form', $data);
        $data['main'] = 'product_categories_form';
        $this->load->view('admin/template',$data);
    }
    
    public function create_action() 
    {
        //print_r($_POST);
        //print_r($_FILES); exit;
        $this->_rules();
        $directory = dirname(dirname(dirname(__FILE__))).'/public/uploads/product_categories/'.$this->input->post('categoryTitle',TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            if(!file_exists($directory)){
                mkdir($directory, 0777, true);
            }
          $config['upload_path']          = './public/uploads/product_categories/'.$this->input->post('categoryTitle',TRUE);
            //$config['allowed_types']        = 'gif|jpg|png|svg|obj|mlt|bmp|pat|jpeg';
          $config['allowed_types']        = '*';
          $config['file_ext_tolower'] = TRUE;
          $config['max_size']             = 999000;
          // $config['max_width']            = 3000;
          // $config['max_height']           = 3000;
          $config['remove_spaces'] = TRUE;

          $this->load->library('upload', $config);
          $this->upload->set_allowed_types('*');
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
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('message', $data);
           $data = array(
              'categoryTitle' => $this->input->post('categoryTitle',TRUE),
               'categoryBase' => $files[0]['file_name'],
               'categoryMiddle' => $files[1]['file_name'],
               'categoryTop' => $files[2]['file_name'],
              'categoryObjFile' => $files[3]['file_name'],
              'categoryMTLFile' => $files[4]['file_name'],
              'categoryModelPatternFile' => $files[5]['file_name'],
              'created_date' => date('Y-m-d H:i:s'),
              'created_by' => $this->session->userdata('adminId')/*,
              'modified_date' => $this->input->post('modified_date',TRUE),
              'modified_by' => $this->input->post('modified_by',TRUE),*/
              );

           $this->Product_categories_model->insert($data);
           $this->session->set_flashdata('message', 'Create Record Success');
           redirect(site_url('product_categories'));
           }
            else{
                $this->session->set_flashdata('message', $errors[0]);
                redirect(site_url('product_categories'));
            }
       }
   }

   public function update($id)
   {
    $row = $this->Product_categories_model->get_by_id($id);

    if ($row) {
        $data = array(
            'button' => 'Update',
            'action' => site_url('product_categories/update_action'),
            'categoryId' => set_value('categoryId', $row->categoryId),
            'categoryTitle' => set_value('categoryTitle', $row->categoryTitle),
            'categoryBase' => set_value('categoryBase', $row->categoryBase),
            'categoryMiddle' => set_value('categoryMiddle', $row->categoryMiddle),
            'categoryTop' => set_value('categoryTop', $row->categoryTop),
            'categoryObjFile' => set_value('categoryObjFile', $row->categoryObjFile),
            'categoryMTLFile' => set_value('categoryMTLFile', $row->categoryMTLFile),
            'categoryModelPatternFile' => set_value('categoryModelPatternFile', $row->categoryModelPatternFile),
            'created_date' => Date('Y-m-d H:i:s'),
            'created_by' => $this->session->adminId
            );
// $this->load->view('product_categories_form', $data);
        $data['main'] = 'product_categories_form';
        $this->load->view('admin/template',$data);
    } else {
        $this->session->set_flashdata('message', 'Record Not Found');
        redirect(site_url('product_categories'));
    }
}

public function update_action()
{
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
        $this->update($this->input->post('categoryId', TRUE));
    } else {
        $data = array(
            'categoryTitle' => $this->input->post('categoryTitle', TRUE),
            /* 'categoryThumbnail' => $this->input->post('categoryThumbnail',TRUE),
             'categoryObjFile' => $this->input->post('categoryObjFile',TRUE),
             'categoryMTLFile' => $this->input->post('categoryMTLFile',TRUE),
             'categoryModelPatternFile' => $this->input->post('categoryModelPatternFile',TRUE),*/
            // 'created_date' => $this->input->post('created_date',TRUE),
            // 'created_by' => $this->input->post('created_by',TRUE),
            'modified_date' => Date('Y-m-d H:i:s'),
            'modified_by' => $this->session->adminId
        );


        $config['upload_path'] = './public/uploads/product_categories/';
        $config['allowed_types'] = '*';
        $config['file_ext_tolower'] = TRUE;
        $config['max_size'] = 999000;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->set_allowed_types('*');
        $files = array();
        $errors = array();
        if ($_FILES) {
            foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
            {
                if (!empty($fileObject['name'])) {
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload($fieldname))
                    {
                        $up_data = $this->upload->data();
                        if (!empty($_FILES['categoryBase']['name'])) {
                            $data['categoryBase'] = $up_data['file_name'];
                        }
                        if (!empty($_FILES['categoryMiddle']['name'])) {
                            $data['categoryMiddle'] = $up_data['file_name'];
                        }
                        if (!empty($_FILES['categoryTop']['name'])) {
                            $data['categoryTop'] = $up_data['file_name'];
                        }
                        if (!empty($_FILES['categoryObjFile']['name'])) {
                            $data['categoryObjFile'] = $up_data['file_name'];
                        }
                        if (!empty($_FILES['categoryMTLFile']['name'])) {
                            $data['categoryMTLFile'] = $up_data['file_name'];
                        }
                        if (!empty($_FILES['categoryModelPatternFile']['name'])) {
                            $data['categoryModelPatternFile'] = $up_data['file_name'];
                        }

                    }

                }
            }
        }


        $this->Product_categories_model->update($this->input->post('categoryId', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('product_categories'));
    }
}

public function delete($id)
{
    $row = $this->Product_categories_model->get_by_id($id);

    if ($row) {
        $this->Product_categories_model->delete($id);
        $this->session->set_flashdata('message', 'Delete Record Success');
        redirect(site_url('product_categories'));
    } else {
        $this->session->set_flashdata('message', 'Record Not Found');
        redirect(site_url('product_categories'));
    }
}
    public function alter()
    {
        //$this->db->query('ALTER TABLE `product_categories` ADD `categoryMiddle` VARCHAR(255) NOT NULL AFTER `categoryBase`, ADD `categoryTop` VARCHAR(255) NOT NULL AFTER `categoryBase`;');
        $this->db->query("INSERT INTO `product_categories` (`categoryTitle`, `categoryBase`, `categoryMiddle`, `categoryTop`, `categoryObjFile`, `categoryMTLFile`, `categoryModelPatternFile`, `created_date`, `created_by`) VALUES ('athlete-shorts', 'Base-v2.svg', 'Design-v2.svg', 'Logo-v2.svg', 'Athletic_Shorts.obj', 'Athletic_Shorts.mtl', NULL, '2016-11-05 11:41:45', 1)");
        //$this->db->query('ALTER TABLE `product_categories` CHANGE `categoryThumbnail` `categoryBase` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;');
    }

public function _rules()
{
	$this->form_validation->set_rules('categoryTitle', 'categorytitle', 'trim|required');
	/*$this->form_validation->set_rules('categoryThumbnail', 'categorythumbnail', 'trim');
	$this->form_validation->set_rules('categoryObjFile', 'categoryobjfile', 'trim');
	$this->form_validation->set_rules('categoryMTLFile', 'categorymtlfile', 'trim');
	$this->form_validation->set_rules('categoryModelPatternFile', 'categorymodelpatternfile', 'trim');*/
	// $this->form_validation->set_rules('modified_date', 'modified date', 'trim|required');
	// $this->form_validation->set_rules('modified_by', 'modified by', 'trim|required');

	$this->form_validation->set_rules('categoryId', 'categoryId', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
}

public function excel()
{
    $this->load->helper('exportexcel');
    $namaFile = "product_categories.xls";
    $judul = "product_categories";
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
    xlsWriteLabel($tablehead, $kolomhead++, "CategoryTitle");
    xlsWriteLabel($tablehead, $kolomhead++, "CategoryThumbnail");
    xlsWriteLabel($tablehead, $kolomhead++, "CategoryObjFile");
    xlsWriteLabel($tablehead, $kolomhead++, "CategoryMTLFile");
    xlsWriteLabel($tablehead, $kolomhead++, "CategoryModelPatternFile");
    xlsWriteLabel($tablehead, $kolomhead++, "Created Date");
    xlsWriteLabel($tablehead, $kolomhead++, "Created By");
    xlsWriteLabel($tablehead, $kolomhead++, "Modified Date");
    xlsWriteLabel($tablehead, $kolomhead++, "Modified By");

    foreach ($this->Product_categories_model->get_all() as $data) {
        $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->categoryTitle);
        xlsWriteLabel($tablebody, $kolombody++, $data->categoryBase);
        xlsWriteLabel($tablebody, $kolombody++, $data->categoryMiddle);
        xlsWriteLabel($tablebody, $kolombody++, $data->categoryTop);
        xlsWriteLabel($tablebody, $kolombody++, $data->categoryObjFile);
        xlsWriteLabel($tablebody, $kolombody++, $data->categoryMTLFile);
        xlsWriteLabel($tablebody, $kolombody++, $data->categoryModelPatternFile);
        xlsWriteLabel($tablebody, $kolombody++, $data->created_date);
        xlsWriteNumber($tablebody, $kolombody++, $data->created_by);
        xlsWriteLabel($tablebody, $kolombody++, $data->modified_date);
        xlsWriteNumber($tablebody, $kolombody++, $data->modified_by);

        $tablebody++;
        $nourut++;
    }

    xlsEOF();
    exit();
}

public function word()
{
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=product_categories.doc");

    $data = array(
        'product_categories_data' => $this->Product_categories_model->get_all(),
        'start' => 0
        );

    $this->load->view('product_categories_doc',$data);
}

}

/* End of file Product_categories.php */
/* Location: ./application/controllers/Product_categories.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-09-08 08:42:10 */
/* http://harviacode.com */