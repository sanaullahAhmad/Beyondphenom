<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fonts extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('adminId')) redirect('myadmin','refresh');
        $this->load->model('Fonts_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $fonts = $this->Fonts_model->get_all();

        $data = array(
            'fonts_data' => $fonts
        );

        // $this->load->view('admin/fonts_list', $data);
        $data['main']="admin/fonts_list";
        $this->load->view('admin/template',$data);
    }

    public function read($id) 
    {
        $row = $this->Fonts_model->get_by_id($id);
        if ($row) {
            $data = array(
		'fontId' => $row->fontId,
		'fontTitle' => $row->fontTitle,
		'fontUrl' => $row->fontUrl,
		'fontFamily' => $row->fontFamily,
		'fontDate' => $row->fontDate,
		'adminId' => $row->adminId,
	    );
             $data['main']="admin/fonts_read";
            $this->load->view('admin/template',$data);
            // $this->load->view('admin/fonts_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fonts'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('fonts/create_action'),
	    'fontId' => set_value('fontId'),
	    'fontTitle' => set_value('fontTitle'),
	    'fontUrl' => set_value('fontUrl'),
	    'fontFamily' => set_value('fontFamily'),
	    'fontDate' => set_value('fontDate'),
	    'adminId' => set_value('adminId'),
	);
        // $this->load->view('admin/fonts_form', $data);
         $data['main']="admin/fonts_form";
        $this->load->view('admin/template',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'fontTitle' => $this->input->post('fontTitle',TRUE),
		'fontUrl' => $this->input->post('fontUrl',TRUE),
		'fontFamily' => $this->input->post('fontFamily',TRUE),
		'fontDate' => $this->input->post('fontDate',TRUE),
		'adminId' => $this->input->post('adminId',TRUE),
	    );

            $this->Fonts_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('fonts'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Fonts_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('fonts/update_action'),
		'fontId' => set_value('fontId', $row->fontId),
		'fontTitle' => set_value('fontTitle', $row->fontTitle),
		'fontUrl' => set_value('fontUrl', $row->fontUrl),
		'fontFamily' => set_value('fontFamily', $row->fontFamily),
		'fontDate' => set_value('fontDate', $row->fontDate),
		'adminId' => set_value('adminId', $row->adminId),
	    );
            // $this->load->view('admin/fonts_form', $data);
            $data['main']="admin/fonts_form";
            $this->load->view('admin/template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fonts'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('fontId', TRUE));
        } else {
            $data = array(
		'fontTitle' => $this->input->post('fontTitle',TRUE),
		'fontUrl' => $this->input->post('fontUrl',TRUE),
		'fontFamily' => $this->input->post('fontFamily',TRUE),
		'fontDate' => $this->input->post('fontDate',TRUE),
		'adminId' => $this->input->post('adminId',TRUE),
	    );

            $this->Fonts_model->update($this->input->post('fontId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('fonts'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Fonts_model->get_by_id($id);

        if ($row) {
            $this->Fonts_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('fonts'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fonts'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('fontTitle', 'fonttitle', 'trim|required');
	$this->form_validation->set_rules('fontUrl', 'fonturl', 'trim|required');
	$this->form_validation->set_rules('fontFamily', 'fontfamily', 'trim|required');
	$this->form_validation->set_rules('fontDate', 'fontdate', 'trim|required');
	$this->form_validation->set_rules('adminId', 'adminid', 'trim|required');

	$this->form_validation->set_rules('fontId', 'fontId', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "fonts.xls";
        $judul = "fonts";
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
	xlsWriteLabel($tablehead, $kolomhead++, "FontTitle");
	xlsWriteLabel($tablehead, $kolomhead++, "FontUrl");
	xlsWriteLabel($tablehead, $kolomhead++, "FontFamily");
	xlsWriteLabel($tablehead, $kolomhead++, "FontDate");
	xlsWriteLabel($tablehead, $kolomhead++, "AdminId");

	foreach ($this->Fonts_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->fontTitle);
	    xlsWriteLabel($tablebody, $kolombody++, $data->fontUrl);
	    xlsWriteLabel($tablebody, $kolombody++, $data->fontFamily);
	    xlsWriteLabel($tablebody, $kolombody++, $data->fontDate);
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
        header("Content-Disposition: attachment;Filename=fonts.doc");

        $data = array(
            'fonts_data' => $this->Fonts_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/fonts_doc',$data);
    }

}

/* End of file Fonts.php */
/* Location: ./application/controllers/Fonts.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-17 12:45:00 */
/* http://harviacode.com */