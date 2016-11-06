<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admins extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('adminId')) redirect('myadmin','refresh');
        $this->load->model('Admins_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $admins = $this->Admins_model->get_all();

        $data = array(
            'admins_data' => $admins
        );
        $data['main']="admin/admins_list";
        $this->load->view('admin/template',$data);
    }

    public function read($id) 
    {
        $row = $this->Admins_model->get_by_id($id);
        if ($row) {
            $data = array(
		'adminId' => $row->adminId,
		'adminName' => $row->adminName,
		'adminEmail' => $row->adminEmail,
		'adminPassword' => $row->adminPassword,
		'adminDate' => $row->adminDate,
	    );

            $data['main']="admin/admins_read";
            $this->load->view('admin/template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admins'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admins/create_action'),
	    'adminId' => set_value('adminId'),
	    'adminName' => set_value('adminName'),
	    'adminEmail' => set_value('adminEmail'),
	    'adminPassword' => set_value('adminPassword'),
	    'adminDate' => set_value('adminDate'),
	);
        $data['main']="admin/admins_form";
        $this->load->view('admin/template',$data);

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'adminName' => $this->input->post('adminName',TRUE),
		'adminEmail' => $this->input->post('adminEmail',TRUE),
		'adminPassword' => md5($this->input->post('adminPassword',TRUE)),
		'adminDate' => $this->input->post('adminDate',TRUE),
	    );

            $this->Admins_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admins'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Admins_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admins/update_action'),
		'adminId' => set_value('adminId', $row->adminId),
		'adminName' => set_value('adminName', $row->adminName),
		'adminEmail' => set_value('adminEmail', $row->adminEmail),
		'adminPassword' => set_value('adminPassword', $row->adminPassword),
		'adminDate' => set_value('adminDate', $row->adminDate),
	    );
            // $this->load->view('admin/admins_form', $data);
            $data['main']="admin/admins_form";
        $this->load->view('admin/template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admins'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('adminId', TRUE));
        } else {
            $data = array(
		'adminName' => $this->input->post('adminName',TRUE),
		'adminEmail' => $this->input->post('adminEmail',TRUE),
		'adminPassword' => md5($this->input->post('adminPassword',TRUE)),
		'adminDate' => $this->input->post('adminDate',TRUE),
	    );

            $this->Admins_model->update($this->input->post('adminId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admins'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Admins_model->get_by_id($id);

        if ($row) {
            $this->Admins_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admins'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admins'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('adminName', 'adminname', 'trim|required');
	$this->form_validation->set_rules('adminEmail', 'adminemail', 'trim|required');
	$this->form_validation->set_rules('adminPassword', 'adminpassword', 'trim|required');
	$this->form_validation->set_rules('adminDate', 'admindate', 'trim|required');

	$this->form_validation->set_rules('adminId', 'adminId', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "admins.xls";
        $judul = "admins";
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
	xlsWriteLabel($tablehead, $kolomhead++, "AdminName");
	xlsWriteLabel($tablehead, $kolomhead++, "AdminEmail");
	xlsWriteLabel($tablehead, $kolomhead++, "AdminPassword");
	xlsWriteLabel($tablehead, $kolomhead++, "AdminDate");

	foreach ($this->Admins_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->adminName);
	    xlsWriteLabel($tablebody, $kolombody++, $data->adminEmail);
	    xlsWriteLabel($tablebody, $kolombody++, $data->adminPassword);
	    xlsWriteLabel($tablebody, $kolombody++, $data->adminDate);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=admins.doc");

        $data = array(
            'admins_data' => $this->Admins_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/admins_doc',$data);
    }

}

/* End of file Admins.php */
/* Location: ./application/controllers/Admins.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-17 12:18:48 */
/* http://harviacode.com */