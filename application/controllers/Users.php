<?php 

/*----
This is the authentication controller, 
used to verify login, logout, check login status
----*/

class Users extends CI_Controller {

    protected $adminid = "userId";
    protected $adminname = "userName";
    protected $adminemail = "userEmail";
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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
     
	public function index($message=FALSE)
	{
        
        // if(!$this->session->userdata($this->adminid))
        // {
        //   if($message){$data['title']="$message";}
        //   else{$data['title']="Welcome to User Panel";}
        //   $data['main']="user/login_box";
        //   $this->load->view('user/template', $data);
        // }
        // else{
        //         $data['title']="Successfully Logged In";
        //         $data['user_name'] = $this->session->userdata($this->adminname);
        //         $data['user_id'] = $this->session->userdata($this->adminid);
        //         $data['main']="admin/welcome_message";
        //         $this->load->view('admin/template',$data);
        //     }        
	}
    
    public function designer()
    {
      $this->load->view('user/index'); 
    }
    public function designer2()
    {
      $this->load->view('user/designer'); 
    }
    function login(){
        session_start();
        if($this->input->post('email') && $this->input->post('password'))
        {
            $uemail = $this->input->post('email');
            $upassword = $this->input->post('password');
            $this->load->model('myadmin_model','auth');
            $row = $this->auth->login($uemail, $upassword);
            if($row)
            {
                $this->session->set_userdata($row);
                 $this->load->model('system_activity_model');
              $u_name = $row['userName'];
              date_default_timezone_set('Asia/Karachi');
              $a = $system_activity_model->add_activity($u_name.' logged into System @ '.date('d-m-Y h:i:s'));
              if($a)echo 'activity added'; else echo $a.' activity not added';
               // $this->index();

            }
            else redirect('myadmin/index', 'refresh');
        }
         else redirect('myadmin/index', 'refresh');
        
    }
    
    public function test()
    {
      $this->load->helper('file');

      $data['src'] = read_file(base_url('public/uploads/templates/6060b2ed7725ed90498049bbe1e27eef_image.json'));
      $this->load->view('users/test', $data); 
    }
    function logout(){
         $this->session->sess_destroy();
         $message = "You have been successfully Logged Out!";
              $this->index($message);
        
    }      
    

    function registration()
    {
      if($this->input->post('sub')){

            if(in_array('jobscentral', $this->input->post('chckbox')))
              {/**/ 
                $one=new JobsCentralSignUp();
                $one->signup($_POST);   
                echo 'jobs central signup ended....<br>';
              }

            if(in_array('monster', $this->input->post('chckbox')))
              {/**/  
                $two=new MosnterSignUp();
                $two->signup($_POST);   
                echo 'monster signup ended....<br>';
              }

            if(in_array('jobsstreet', $this->input->post('chckbox')))
              {/**/  
                $three=new JobsStreetSignUp();
                $three->signup($_POST);   
                echo 'jobsstreet signup ended....<br>';
              }

            if(in_array('monster', $this->input->post('chckbox')))
              {/**/  
                $four=new JobsDbSignUp();
                $four->signup($_POST);    
                echo 'jobsdb signup ended....<br>';
              }
        }


    }
	
	
   
    
    
}
