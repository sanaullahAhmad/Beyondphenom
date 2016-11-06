<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_size_pattern_layers extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_size_pattern_layers_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'product_size_pattern_layers/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'product_size_pattern_layers/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'product_size_pattern_layers/index.html';
            $config['first_url'] = base_url() . 'product_size_pattern_layers/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Product_size_pattern_layers_model->total_rows($q);
        $product_size_pattern_layers = $this->Product_size_pattern_layers_model->get_limit_data($config['per_page'], $start, $q);



        $this->load->model('Admins_model');
        $this->load->model('Product_sizes_model');
        foreach ($product_size_pattern_layers as $key => $layer) {
            $cr_by = $this->Admins_model->get_by_id($layer->created_by);
            $product_size_pattern_layers{$key}->created_by = $cr_by->adminName;

            $size_info = $this->Product_sizes_model->get_by_id($layer->patternFileId);
            $product_size_pattern_layers{$key}->patternFileId = $size_info->sizeTitle;
        }

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'product_size_pattern_layers_data' => $product_size_pattern_layers,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('product_size_pattern_layers_list', $data);
        $data['main'] = 'product_size_pattern_layers_list';
            $this->load->view('admin/template',$data);
    }

    public function read($id) 
    {
        $row = $this->Product_size_pattern_layers_model->get_by_id($id);
        if ($row) {
            $data = array(
		'vectorId' => $row->vectorId,
		'vectorTitle' => $row->vectorTitle,
		'vectorFileUrl' => $row->vectorFileUrl,
		'vectorOrderNo' => $row->vectorOrderNo,
		'patternFileId' => $row->patternFileId,
		'created_date' => $row->created_date,
		'created_by' => $row->created_by,
		'modified_date' => $row->modified_date,
		'modified_by' => $row->modified_by,
	    );
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
            // $this->load->view('product_size_pattern_layers_read', $data);
            $data['main'] = 'product_size_pattern_layers_read';
            $this->load->view('admin/template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_size_pattern_layers'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('product_size_pattern_layers/create_action'),
	    'vectorId' => set_value('vectorId'),
	    'vectorTitle' => set_value('vectorTitle'),
	    'vectorFileUrl' => set_value('vectorFileUrl'),
	    'vectorOrderNo' => set_value('vectorOrderNo'),
	    'patternFileId' => set_value('patternFileId'),
	    'created_date' => set_value('created_date'),
	    'created_by' => set_value('created_by'),
	    'modified_date' => set_value('modified_date'),
	    'modified_by' => set_value('modified_by'),
	);
        $this->load->model('Product_sizes_model');
        $product_sizes = $this->Product_sizes_model->get_all();
        // $this->load->view('product_size_pattern_layers_form', $data);

        $data['product_sizes'] = $product_sizes;
        $data['main'] = 'product_size_pattern_layers_form';
            $this->load->view('admin/template',$data);
    }
    
    public function create_action() 
    {

        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $directory = dirname(dirname(dirname(__FILE__))).'/public/uploads/product_size_pattern_layers/';
            if(!file_exists($directory)){
                mkdir($directory, 0777, true);
            }
            $config['upload_path']          = './public/uploads/product_size_pattern_layers/';
            $config['allowed_types']        = '*';
            $config['file_ext_tolower'] = TRUE;
            $config['max_size']             = 999000;
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
                    'vectorTitle' => $this->input->post('vectorTitle',TRUE),
                    'vectorFileUrl' =>  $files[0]['file_name'],
                    'vectorOrderNo' => $this->input->post('vectorOrderNo',TRUE),
                    'patternFileId' => $this->input->post('patternFileId',TRUE),
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('adminId')
                );

                $this->Product_size_pattern_layers_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('product_size_pattern_layers'));
            }
            else{
                $this->session->set_flashdata('message', $errors[0]);
                redirect(site_url('product_size_pattern_layers'));
            }

        }
    }
    
    public function update($id) 
    {
        $row = $this->Product_size_pattern_layers_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('product_size_pattern_layers/update_action'),
		'vectorId' => set_value('vectorId', $row->vectorId),
		'vectorTitle' => set_value('vectorTitle', $row->vectorTitle),
		'vectorFileUrl' => set_value('vectorFileUrl', $row->vectorFileUrl),
		'vectorOrderNo' => set_value('vectorOrderNo', $row->vectorOrderNo),
		'patternFileId' => set_value('patternFileId', $row->patternFileId),
		'created_date' => set_value('created_date', $row->created_date),
		'created_by' => set_value('created_by', $row->created_by),
		'modified_date' => set_value('modified_date', $row->modified_date),
		'modified_by' => set_value('modified_by', $row->modified_by),
	    );
            //$this->load->view('product_size_pattern_layers_form', $data);
            $this->load->model('Product_sizes_model');
            $product_sizes = $this->Product_sizes_model->get_all();
            $data['product_sizes'] = $product_sizes;

            $data['main'] = 'product_size_pattern_layers_form';
            $this->load->view('admin/template',$data);

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_size_pattern_layers'));
        }
    }
    
    public function update_action() 
    {
        //print_r($_POST);exit;
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('vectorId', TRUE));
        } else {
            $data = array(
		'vectorTitle' => $this->input->post('vectorTitle',TRUE),
		'vectorOrderNo' => $this->input->post('vectorOrderNo',TRUE),
		'patternFileId' => $this->input->post('patternFileId',TRUE),
                'modified_date' => Date('Y-m-d H:i:s'),
                'modified_by' => $this->session->adminId
	    );

            $config['upload_path'] = './public/uploads/product_size_pattern_layers/';
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
                            if (!empty($_FILES['vectorFileUrl']['name'])) {
                                $data['vectorFileUrl'] = $up_data['file_name'];
                            }

                        }

                    }
                }
            }

            $this->Product_size_pattern_layers_model->update($this->input->post('vectorId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('product_size_pattern_layers'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Product_size_pattern_layers_model->get_by_id($id);

        if ($row) {
            $this->Product_size_pattern_layers_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('product_size_pattern_layers'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_size_pattern_layers'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('vectorTitle', 'vectortitle', 'trim|required');
	//$this->form_validation->set_rules('vectorFileUrl', 'vectorfileurl', 'trim|required');
        if (empty($_FILES['vectorFileUrl']['name']))
        {
            if(!isset($_POST['vectorId']))
            {
                $this->form_validation->set_rules('vectorFileUrl', 'Document', 'required');
            }

        }
	$this->form_validation->set_rules('vectorOrderNo', 'vectororderno', 'trim|required');
	$this->form_validation->set_rules('patternFileId', 'patternfileid', 'trim|required');
	/*$this->form_validation->set_rules('created_date', 'created date', 'trim|required');
	$this->form_validation->set_rules('created_by', 'created by', 'trim|required');
	$this->form_validation->set_rules('modified_date', 'modified date', 'trim|required');
	$this->form_validation->set_rules('modified_by', 'modified by', 'trim|required');

	$this->form_validation->set_rules('vectorId', 'vectorId', 'trim');*/
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "product_size_pattern_layers.xls";
        $judul = "product_size_pattern_layers";
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
	xlsWriteLabel($tablehead, $kolomhead++, "VectorTitle");
	xlsWriteLabel($tablehead, $kolomhead++, "VectorFileUrl");
	xlsWriteLabel($tablehead, $kolomhead++, "VectorOrderNo");
	xlsWriteLabel($tablehead, $kolomhead++, "PatternFileId");
	xlsWriteLabel($tablehead, $kolomhead++, "Created Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Modified Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Modified By");

	foreach ($this->Product_size_pattern_layers_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->vectorTitle);
	    xlsWriteLabel($tablebody, $kolombody++, $data->vectorFileUrl);
	    xlsWriteNumber($tablebody, $kolombody++, $data->vectorOrderNo);
	    xlsWriteNumber($tablebody, $kolombody++, $data->patternFileId);
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
        header("Content-Disposition: attachment;Filename=product_size_pattern_layers.doc");

        $data = array(
            'product_size_pattern_layers_data' => $this->Product_size_pattern_layers_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('product_size_pattern_layers_doc',$data);
    }

}

/* End of file Product_size_pattern_layers.php */
/* Location: ./application/controllers/Product_size_pattern_layers.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-09-08 09:01:52 */
/* http://harviacode.com */