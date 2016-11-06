<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patterns extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('adminId')) redirect('myadmin','refresh');
        $this->load->model('Patterns_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $patterns = $this->Patterns_model->get_all();

        $data = array(
            'patterns_data' => $patterns
        );

        $data['main']="admin/patterns_list";
        $this->load->view('admin/template',$data);

    }

    public function read($id) 
    {
        $row = $this->Patterns_model->get_by_id($id);
        if ($row) {
            $data = array(
		'patternId' => $row->patternId,
		'patternTitle' => $row->patternTitle,
		'patternImage' => $row->patternImage,
		'patternDate' => $row->patternDate,
		'collectionId' => $row->collectionId,
		'adminId' => $row->adminId,
	    );
            $data['main']="admin/patterns_read";
            $this->load->view('admin/template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('patterns'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('patterns/create_action'),
	    'patternId' => set_value('patternId'),
	    'patternTitle' => set_value('patternTitle'),
	    'patternImage' => set_value('patternImage'),
	    'patternDate' => set_value('patternDate'),
	    'collectionId' => set_value('collectionId'),
	    'adminId' => set_value('adminId'),
	);
        $data['main'] = "admin/patterns_form";
        $this->load->view('admin/template', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $config['upload_path']          = './public/uploads/patterns/';
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

                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('message', $data);

            
            $data = array(
		'patternTitle' => $this->input->post('patternTitle',TRUE),
		'patternImage' => $files[0]['file_name'],
		'patternDate' => $this->input->post('patternDate',TRUE),
		'collectionId' => $this->input->post('collectionId',TRUE),
		'adminId' => $this->input->post('adminId',TRUE),
	    );

            $this->Patterns_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('patterns'));

            }
            else{
                $this->session->set_flashdata('message', $errors[0]);
                redirect(site_url('patterns'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Patterns_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('patterns/update_action'),
		'patternId' => set_value('patternId', $row->patternId),
		'patternTitle' => set_value('patternTitle', $row->patternTitle),
		'patternImage' => set_value('patternImage', $row->patternImage),
		'patternDate' => set_value('patternDate', $row->patternDate),
		'collectionId' => set_value('collectionId', $row->collectionId),
		'adminId' => set_value('adminId', $row->adminId),
	    );
            $data['main'] = "admin/patterns_form";
            $this->load->view('admin/template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('patterns'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('patternId', TRUE));
        } else {
            $files = array();
            $errors = array();

            if($_FILES['patternImage']['name']!='')
            {    
                        $config['upload_path']          = './public/uploads/patterns/';
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

                        if(file_exists('./public/uploads/patterns/'.$this->input->post('old_image'))) 
                            unlink('./public/uploads/patterns/'.$this->input->post('old_image'));

                        $data = array(
                          'patternTitle' => $this->input->post('patternTitle',TRUE),
                          'patternImage' => $files[0]['file_name'],
                          'patternDate' => $this->input->post('patternDate',TRUE),
                          'collectionId' => $this->input->post('collectionId',TRUE),
                          'adminId' => $this->input->post('adminId',TRUE),
                          );

                        $this->Patterns_model->update($this->input->post('patternId', TRUE), $data);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('patterns'));

                    }
                    else{
                        $this->session->set_flashdata('message', $errors[0]);
                        redirect(site_url('patterns'));
                    }
            }
            else{
                 $data = array(
                          'patternTitle' => $this->input->post('patternTitle',TRUE),
                          'patternImage' => $this->input->post('old_image'),
                          'patternDate' => $this->input->post('patternDate',TRUE),
                          'collectionId' => $this->input->post('collectionId',TRUE),
                          'adminId' => $this->input->post('adminId',TRUE),
                          );

                        $this->Patterns_model->update($this->input->post('patternId', TRUE), $data);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('patterns'));
            }

        
    }
}

    public function delete($id) 
    {
        $row = $this->Patterns_model->get_by_id($id);

        if ($row) {
            $this->Patterns_model->delete($id);
            $file = './public/uploads/patterns/'.$row->patternImage;
            if(file_exists($file)) unlink($file);

            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('patterns'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('patterns'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('patternTitle', 'patterntitle', 'trim|required');
	// $this->form_validation->set_rules('patternImage', 'patternimage', 'trim|required');
	$this->form_validation->set_rules('patternDate', 'patterndate', 'trim|required');
	// $this->form_validation->set_rules('collectionId', 'collectionid', 'trim|required');
	$this->form_validation->set_rules('adminId', 'adminid', 'trim|required');

	$this->form_validation->set_rules('patternId', 'patternId', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "patterns.xls";
        $judul = "patterns";
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
	xlsWriteLabel($tablehead, $kolomhead++, "PatternTitle");
	xlsWriteLabel($tablehead, $kolomhead++, "PatternImage");
	xlsWriteLabel($tablehead, $kolomhead++, "PatternDate");
	xlsWriteLabel($tablehead, $kolomhead++, "CollectionId");
	xlsWriteLabel($tablehead, $kolomhead++, "AdminId");

	foreach ($this->Patterns_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->patternTitle);
	    xlsWriteLabel($tablebody, $kolombody++, $data->patternImage);
	    xlsWriteLabel($tablebody, $kolombody++, $data->patternDate);
	    xlsWriteNumber($tablebody, $kolombody++, $data->collectionId);
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
        header("Content-Disposition: attachment;Filename=patterns.doc");

        $data = array(
            'patterns_data' => $this->Patterns_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/patterns_doc',$data);
    }

    public function get_all_patterns()
    {
        echo json_encode($this->Patterns_model->get_all());
    }

    public function get_all_collections()
    {}

    public function get_collection_patterns($collectionId)
    {}

    



}

/* End of file Patterns.php */
/* Location: ./application/controllers/Patterns.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-17 12:44:52 */
/* http://harviacode.com */