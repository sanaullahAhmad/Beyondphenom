<?php 

/*----
This is the authentication controller, 
used to verify login, logout, check login status
----*/

class MyAdmin extends CI_Controller {

    protected $adminid = "adminId";
    protected $adminname = "adminName";
    protected $adminemail = "adminEmail";
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

  function __construct(){
    parent::__construct();
    $this->load->model('myadmin_model');
  }

     
	public function index($message=FALSE)
	{
        
        if(!$this->session->userdata($this->adminid))
        {
          if($message){$data['title']="$message";}
          else{$data['title']="Welcome to Admin Panel";}
          $data['main']="admin/login_box";
          $this->load->view('admin/template', $data);
        }
        else{
          
                $data['title']="Successfully Logged In";
                $data['admin_name'] = $this->session->userdata($this->adminname);
                $data['admin_id'] = $this->session->userdata($this->adminid);
                // $data['stat'] = $this->count_vars();
                $data['main']="admin/dashboard";
                // $data['stats']=$this->stats();
                $this->load->view('admin/template',$data);
            }        
	}
    
     function stats(){
//$abc['franchise_stats'] = $this->myadmin_model->franchise_stats();
  //          $abc['payment_stats'] = $this->myadmin_model->payment_stats();
            $abc['users_stats'] = $this->myadmin_model->users_stats();
    //        $abc['package_stats'] = $this->myadmin_model->package_stats();



            return $abc;
        }
    
    function login(){
        // session_start();
        if($this->input->post('email') && $this->input->post('password'))
        {
            $uemail = $this->input->post('email');
            $upassword = md5($this->input->post('password'));
            $this->load->model('myadmin_model','auth');
            $row = $this->auth->login($uemail, $upassword);
            if($row)
            {
                $this->session->set_userdata($row);
               $this->index();

            }
            else redirect('myadmin/index', 'refresh');
        }
         else redirect('myadmin/index', 'refresh');
        
    }
    
    function logout(){
         $this->session->sess_destroy();
         // $message = "You have been successfully Logged Out!";
              // $this->index($message);
         redirect('myadmin','refresh');
        
    }      
    

    function do_upload()
  {
    // $file = $this->input->post('userfile');
    // $config['upload_path'] = './uploads/';
    // $config['allowed_types'] = 'gif|jpg|png';
    // $config['max_size'] = '0';
    // $config['max_width']  = '0';
    // $config['max_height']  = '0';

    // $this->load->library('upload', $config);

    // if ( ! $this->upload->do_upload($file))
    // {
    //   $error = array('error' => $this->upload->display_errors());

    //   echo json_encode($error);
    // }
    // else
    // {
    //   $data = array('upload_data' => $this->upload->data());
    //   echo json_encode($data);
    // }

      if(is_uploaded_file($_FILES['userfile']['tmp_name']))
      { 
            $dir = "../../uploads/projects";
            $filename = time().$_FILES['userfile']['name'];
            if(!move_uploaded_file($_FILES['userfile']['tmp_name']," $dir/$filename"))
            {
              echo "File could not be moved to its specified location";
            }
      }
      else echo "File could not be uploaded";
   
    
    
}

   function count_vars()
   {  
    
      $stat['projects']['total'] = $this->myadmin_model->count_all_projects();
      $stat['projects']['developing'] = $this->myadmin_model->count_developing_projects();
      $stat['projects']['completed'] = $this->myadmin_model->count_completed_projects();

      $stat['notes'] = $this->myadmin_model->count_notes();

      $stat['clients']['total'] = $this->myadmin_model->count_clients();
      $stat['clients']['active'] = $this->myadmin_model->count_active_clients();
      $stat['clients']['inactive'] = $this->myadmin_model->count_inactive_clients();
      
      $stat['news'] = $this->myadmin_model->count_news();

      $stat['files'] = $this->myadmin_model->count_files();

      $stat['publications'] = $this->myadmin_model->count_pubs();

      $stat['team'] = $this->myadmin_model->count_team();

      return $stat;
   }
}