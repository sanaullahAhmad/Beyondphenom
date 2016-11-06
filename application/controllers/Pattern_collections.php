<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pattern_collections extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pattern_collections_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $pattern_collections = $this->Pattern_collections_model->get_all();

        $data = array(
            'pattern_collections_data' => $pattern_collections
        );

        // $this->load->view('admin/pattern_collections_list', $data);
        $data['main']="admin/pattern_collections_list";
        $this->load->view('admin/template',$data);
    }

    public function read($id) 
    {
        $row = $this->Pattern_collections_model->get_by_id($id);
        if ($row) {
            $data = array(
		'collectionId' => $row->collectionId,
		'collectionTitle' => $row->collectionTitle,
		'collectionDescription' => $row->collectionDescription,
		'collectionImage' => $row->collectionImage,
		'collectionDate' => $row->collectionDate,
		'adminId' => $row->adminId,
	    );
            $this->load->view('admin/pattern_collections_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pattern_collections'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pattern_collections/create_action'),
	    'collectionId' => set_value('collectionId'),
	    'collectionTitle' => set_value('collectionTitle'),
	    'collectionDescription' => set_value('collectionDescription'),
	    'collectionImage' => set_value('collectionImage'),
	    'collectionDate' => set_value('collectionDate'),
	    'adminId' => set_value('adminId'),
	);
        $this->load->view('admin/pattern_collections_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'collectionTitle' => $this->input->post('collectionTitle',TRUE),
		'collectionDescription' => $this->input->post('collectionDescription',TRUE),
		'collectionImage' => $this->input->post('collectionImage',TRUE),
		'collectionDate' => $this->input->post('collectionDate',TRUE),
		'adminId' => $this->input->post('adminId',TRUE),
	    );

            $this->Pattern_collections_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pattern_collections'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pattern_collections_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pattern_collections/update_action'),
		'collectionId' => set_value('collectionId', $row->collectionId),
		'collectionTitle' => set_value('collectionTitle', $row->collectionTitle),
		'collectionDescription' => set_value('collectionDescription', $row->collectionDescription),
		'collectionImage' => set_value('collectionImage', $row->collectionImage),
		'collectionDate' => set_value('collectionDate', $row->collectionDate),
		'adminId' => set_value('adminId', $row->adminId),
	    );
            $this->load->view('admin/pattern_collections_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pattern_collections'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('collectionId', TRUE));
        } else {
            $data = array(
		'collectionTitle' => $this->input->post('collectionTitle',TRUE),
		'collectionDescription' => $this->input->post('collectionDescription',TRUE),
		'collectionImage' => $this->input->post('collectionImage',TRUE),
		'collectionDate' => $this->input->post('collectionDate',TRUE),
		'adminId' => $this->input->post('adminId',TRUE),
	    );

            $this->Pattern_collections_model->update($this->input->post('collectionId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pattern_collections'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pattern_collections_model->get_by_id($id);

        if ($row) {
            $this->Pattern_collections_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pattern_collections'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pattern_collections'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('collectionTitle', 'collectiontitle', 'trim|required');
	$this->form_validation->set_rules('collectionDescription', 'collectiondescription', 'trim|required');
	$this->form_validation->set_rules('collectionImage', 'collectionimage', 'trim|required');
	$this->form_validation->set_rules('collectionDate', 'collectiondate', 'trim|required');
	$this->form_validation->set_rules('adminId', 'adminid', 'trim|required');

	$this->form_validation->set_rules('collectionId', 'collectionId', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pattern_collections.xls";
        $judul = "pattern_collections";
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
	xlsWriteLabel($tablehead, $kolomhead++, "CollectionTitle");
	xlsWriteLabel($tablehead, $kolomhead++, "CollectionDescription");
	xlsWriteLabel($tablehead, $kolomhead++, "CollectionImage");
	xlsWriteLabel($tablehead, $kolomhead++, "CollectionDate");
	xlsWriteLabel($tablehead, $kolomhead++, "AdminId");

	foreach ($this->Pattern_collections_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->collectionTitle);
	    xlsWriteLabel($tablebody, $kolombody++, $data->collectionDescription);
	    xlsWriteLabel($tablebody, $kolombody++, $data->collectionImage);
	    xlsWriteLabel($tablebody, $kolombody++, $data->collectionDate);
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
        header("Content-Disposition: attachment;Filename=pattern_collections.doc");

        $data = array(
            'pattern_collections_data' => $this->Pattern_collections_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/pattern_collections_doc',$data);
    }

}

/* End of file Pattern_collections.php */
/* Location: ./application/controllers/Pattern_collections.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-17 12:44:45 */
/* http://harviacode.com */