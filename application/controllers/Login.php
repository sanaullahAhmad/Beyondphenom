<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*----
This is the authentication controller, 
used to verify login, logout, check login status
----*/

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

	public function index($value='')
	{
		
	}
	public function login($value='')
	{
		$data['indexx'] = $value;

		$this->load->view('users/login', $data);
	}
	public function login_action($value='')
	{
		if($this->input->post('username') && $this->input->post('password'))
		{
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			                  // print_r($this->input->post());exit;
			$this->load->model('Login_model', 'lm');
			if( $this->lm->login_action($username, $password)){
				if($this->session->manufacture == 'manufacture'){
					redirect('manufacture_dashboard');	
				}
				else
				{
					redirect('welcome_dashboard');
				}
			}
			else
			{
				$this->session->set_flashdata('message','Incorrent Credentials. Please try again.');
				redirect('login');
			}
		
		}
		else
		{
			$this->session->set_flashdata('message','Enter your data. Please try again.');
            redirect('login');
		}
	}
	public function signup($value='')
	{
		$data['indexx'] = $value;
		$this->load->view('users/signup', $data);
	}
	public function signup_action()
	{   
	    $this->load->library('form_validation');
	    $this->load->model('Login_model', 'lm');

	    $userEmail = $this->input->post('email');

	    $username = $this->input->post('username');
	    /*print_r($username);
	    exit;*/

	    $userPassword = md5($this->input->post('password'));

	    $this->form_validation->set_rules('email', 'User Email', 'required|trim');
	    $this->form_validation->set_rules('username', 'User Name', 'required|trim|min_length[4]|is_unique[users.username]');
	    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]');

	    if ($this->form_validation->run() == FALSE) {

	        $this->session->set_flashdata('message','User name is alread exits name!');
	        $data['indexx'] = '';
	        $this->load->view('users/signup', $data);
	    }
	    else
	    {
	        $data = array(
	            'userEmail' => $userEmail ,
	            'username'=> $username,
	            'userPassword' => $userPassword,
	            );
	        $result = $this->lm->insert($data);
	        if ($result == FALSE) {
	        	/*if ($this->url->segments) {
	        		# code...
	        	}*/

	            redirect('welcome_dashboard');
	                // send varify email link
	        }
	        else
	        {
	            echo "Login failed!";
	        }
	    }
	}
	public function welcome_dashboard()
	{
		$data['indexx'] = '';
	    $this->load->view('users/welcome_dashboard',$data);
	}
	function logout(){
	    $this->session->sess_destroy();
	    redirect(site_url('login'));
	         // $message = "You have been successfully Logged Out!";
	              // $this->index($message);
	}
	public function manufacture($value='')
	{
		$data['indexx'] = '';
		$this->session->set_userdata('manufacture', 'manufacture');
		$this->login();
		
	}
	public function manufacture_dashboard($value='')
	{
		$data['indexx'] = '';
		$this->load->view('users/manufacture_dashboard', $data);
	}
}