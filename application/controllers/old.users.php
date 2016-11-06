<?php 

/*----
This is the authentication controller, 
used to verify login, logout, check login status
----*/

class Users extends CI_Controller {

  protected $userId = "userId";
  protected $userName = "userName";
  protected $userEmail = "userEmail";
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

  function __construct()
  {
    parent::__construct();

    $data['follow_users'] = $this->get_users();
    //$data['profile_pic']=NULL;
    $data['profile_pic']=$this->get_profile_pic();
    $this->config->set_item('notifications', $this->get_notifications());
    $this->config->set_item('unread_count', $this->get_unread_count());

    $this->load->vars($data);
  }

  public function index($message=FALSE)
  {

    if(!$this->session->userdata($this->userId))
    {

      if($message){$data['message']="$message";}else{$data['message']="";}
          // else{$data['message']="Could not login";}
          // $data['main']="user/dashboard";
      $this->load->view('frontend/login_box',$data);
          // $this->load->view('frontend/home');
    }
    else $this->dashboard();      
  }

  public function dashboard()
  {
    if($this->session->userdata('userId'))
    {

      $this->load->model('users_model');

    $userId = $this->session->userdata('userId');

    $query = $this->users_model->user_view($userId);
    
    if($query==0)
    {
      $data['user_view'] = "1";
    }
    else
    {
      $data['user_view'] = $query;
    }
         // $data['message']="Successfully Logged In";
    // $data['userName'] = $this->session->userdata($this->userName);
    // $data['userId'] = $this->session->userdata($this->userId);

      $this->load->model('decisions_model','dm');
      $data['recent_decisions'] = $this->dm->get_recent();

    // $data['main']="user/dashboard";
    // $this->load->view('user/template',$data);
      $data['main']="user/dashboard";

      $this->load->view('user/template',$data);
    }
    else redirect(base_url());
  }

  function login(){
        // session_start();
        // print_r($_POST);
    if($this->input->post('email') && $this->input->post('password'))
    {
      $uemail = $this->input->post('email');
      $upassword = $this->input->post('password');
      $this->load->model('users_model','auth');
      $row = $this->auth->login($uemail, $upassword);
      if($row)
      {

        if($row['userStatus']=='0')
        {
          show_error("You have not verified your Email. Please check your Email Inbox or Spam folder!");
          return;
        }
        $this->session->set_userdata($row);
        redirect(base_url("index.php/users/dashboard"),'location');
        //$this->index($message="");

      }
                    // else redirect('users/index', 'refresh');
      else {
        $data['message'] = "Your Login Credentials are Invalid!";
        $this->load->view('frontend/login_box', $data);
      }
    }
    else redirect('users/signin');
  }


  function send_email($arr)
  {
    $this->load->library('email');

    $to = $arr['to'];
    $subject = $arr['subject'];
    $message = $arr['message'];

    $this->email->from('info@decisions.pk', 'Decisions.pk');
    $this->email->to($to);

    $this->email->subject($subject);

    $this->email->set_mailtype("html");


    $this->email->message($message);


    if($this->email->send()) return true; else return false;

  }

  function create_reset_password_token($userId)
  {
    $user = $this->users_model->get_user($userId);
      // echo "<script>alert(".print_r($user).");</script>";
    $token = md5($user[0]['userFirstName'].$user[0]['userId'].$user[0]['userEmail'].date('h:i:s'));

    if($this->users_model->insert_reset_token($userId, $token))
    {
      $arr2['to'] = $user[0]['userEmail'];
      $arr2['token'] = $token;
      $arr2['username'] = $user[0]['userFirstName'].' '.$user[0]['userLastName'];
      return $arr2; 
    }
    else return false;
  }

  function forget_password()
  {
    $this->load->model('users_model');
    if($this->input->post('email'))
    {
      if($userId = $this->users_model->check_if_email_exists($this->input->post('email')))
      {

        $arr = $this->create_reset_password_token($userId);

        $token = $arr['token'];
        $arr2['to'] = $arr['to'];



        $arr2['subject'] = 'Password Reset Information - Decisions.pk';
        $username = $arr['username'];


        $message = '<div style="width: 70%; backbground: #f6f6f6; border: '.
        '1px solid #dddddd; margin: 5px auto 5px; padding: 15px;">'.
        '<div style="font-family: verdana; text-align: left;">'.
        '<table style="width: 100%; background: #2B469F; padding:5px"><tr><td><img src="http://decisions.pk/beta/incs/images/logo.jpg" height="30px" alt="Logo" valign="top" /></td><td><h3 style=" display: inline; font-size: 14px; text-transform: capitalize; color: white; width: 100% "> Password Reset Information</h3></td></tr></table>'.
        '</div><h3>Dear '.$username.',</h3><p>Please follow following link to reset your password,</p>'.
        '<br /><p><a href="'.base_url().'index.php/users/reset_password/'.$token.'">Reset Password</p><br /><div style="background: #eee; font-family: arial; font-size: 11px; padding: 5px; text-align: left">'.
        '<p>*This Email has been sent to you by Decisions.pk <br />'.
        '*Errors & Omissions can be expected. In case of a mistake please email us at support@decisions.pk</p></div></div>';

        $arr2['message'] = $message;

        if($this->send_email($arr2))
        {
          $data['message'] = 'Instructions have been sent to your email please check.';
          $data['message_type'] = 'success';
          $this->load->view('frontend/login_box', $data);  
        }
        else
        {
         $data['message'] = 'Instructions have been sent to your email please check.';
         $data['message_type'] = 'success';
         $this->load->view('frontend/login_box', $data);  
       }


     }
     else
     {
      $data['message'] = 'Something went wrong! Please try again later!';
      $this->load->view('frontend/login_box', $data);
    }

  }else redirect(base_url('index.php/users/signin'));

}

function remove_token($token)
{
  $this->load->model('users_model');
  $this->users_model->remove_token($token);
}

function reset_password($token = NULL)
{
  $this->load->model('users_model');
  if($this->input->post('token'))
  {
    if($this->input->post('password') == $this->input->post('cpassword'))
    {
      if($userId = $this->users_model->check_token_exists($this->input->post('token')))
      {
        if($this->users_model->reset_password($userId, $this->input->post('password')))
        {
          $this->remove_token($this->input->post('token'));
          $data['message'] = 'Your Password Has Been Change Successfuly!';
          $data['message_type'] = 'success';
          $this->load->view('frontend/login_box', $data);
        }
      }
      else{
        $data['message'] = 'Link Wrong or Expired! Reset Again!';
        $this->load->view('frontend/login_box', $data);
      }

    }else{
      $data['message'] = 'Password & Confirm Password Does Not Match!';
      $this->load->view('frontend/login_box', $data);
    }

  }
  else {
    $data['token'] = $token;
    $data['message'] = NULL;
    $this->load->view('frontend/reset_password');
  }
}

function indirect_login(){
  session_start();
        // if($e== NULL && $p==NULL)
        // {
  if($this->input->post('email') && $this->input->post('password'))
  {

    $uemail = $this->input->post('email');
    $upassword = $this->input->post('password');
    $portal =  $this->input->post('portal');
  }
  else redirect('users/signin', 'refresh');
          // }
}

function get_users()
{
  $this->load->model('users_model');
  return $this->users_model->get_users();
}

function user_notifications()
{
  $this->load->model('users_model');
  $this->load->model('decisions_model', 'dm');

  $userId = $this->session->userdata('userId');

  $query = $this->users_model->notifications($userId);

  if($query==0)
  {
    $data['user_not'] = "1";
  }
  else
  {
    $data['user_not'] = $query;
  }


  $data['main'] = "user/notifications.php";
  $data['recent_decisions'] = $this->dm->get_recent();
  $this->load->view('user/template',$data);
}

function user_followers()
{
  $this->load->model('users_model');
  $this->load->model('decisions_model', 'dm');

  $userId = $this->uri->segment(3);

  $query = $this->users_model->followers($userId);

  if($query==0)
  {
    $data['follower'] = "1";
  }
  else
  {
    $data['follower'] = $query;
  }


  $data['main'] = "user/followers.php";
  $data['recent_decisions'] = $this->dm->get_recent();
  $this->load->view('user/template',$data);
}


function user_following()
{
  $this->load->model('users_model');
  $this->load->model('decisions_model', 'dm');

  $userId = $this->uri->segment(3);

  $query = $this->users_model->following($userId);

  if($query==0)
  {
    $data['following'] = "1";
  }
  else
  {
    $data['following'] = $query;
  }


  $data['main'] = "user/following.php";
  $data['recent_decisions'] = $this->dm->get_recent();
  $this->load->view('user/template',$data);
}


function my_profile()
{

redirect(base_url("index.php/users/profile").'/'.$this->session->userdata('userId'),'location');

  /* simply redirect to profile page with user id instead of repeating stuff
  $this->load->model('decisions_model');      
  $this->load->model('users_model');

  $data['main']="user/profile";
  $userId = $this->session->userdata('userId'); 
  $data['user'] = $this->users_model->get_user($userId);
  $data['total_decisions']=$this->users_model->user_total_decisions($userId);    
  $data['followers']=$this->users_model->user_followers($userId);
  $data['following']=$this->users_model->user_following($userId);      
  $data['recent_decisions'] = $this->decisions_model->get_recent();
  $data['user_decisions'] = $this->users_model->user_decisions($userId);  
  $data['current_user'] = $this->session->userdata('userId');
  $this->load->view('user/template',$data);
  */
}

function check_if_following($u, $f)
{
  $this->load->model('users_model', 'um');
  if($this->um->check_if_following($u, $f)) return 'true'; else return 'false';
}

function check_if_logged_in()
{
  if($this->session->userdata('userId')) return true; else return false;
}

function profile($userId)
{
  $this->load->model('decisions_model');      
  $this->load->model('users_model');

  $data['main']="user/profile";
  $data['following_user'] = $this->check_if_following($this->session->userdata('userId'), $userId);
  $data['user'] = $this->users_model->get_user($userId);
  $data['total_decisions']=$this->users_model->user_total_decisions($userId);    
  $data['followers_count']=$this->users_model->user_followers_count($userId);
  $data['following_count']=$this->users_model->user_following_count($userId);      
  $data['recent_decisions'] = $this->decisions_model->get_recent();
  $data['user_decisions'] = $this->users_model->user_decisions($userId);
  $data['followers'] = $this->users_model->followers($userId);
  $data['following'] = $this->users_model->following($userId);
  $data['current_user'] = $this->session->userdata('userId');

//print_r($data);
//exit;
      if(empty($data['user'][0]['userProfilePicture']))
        $data['user_profile_pic'] = base_url().'incs/images/user.png';
      else
        $data['user_profile_pic'] = base_url().'uploads/users/'.$data['user'][0]['userProfilePicture'];

  $this->load->view('user/template',$data);
}

function edit_profile()
{
  $this->load->model('users_model');

  $userId = $this->session->userdata('userId'); 
  $data['main']="user/edit_profile";
  $data['user'] = $this->users_model->get_user($userId);
  $this->load->view('user/template',$data);
}

function change_password()
{
  $this->load->model('users_model');

  $userId = $this->session->userdata('userId'); 
  $data['main']="user/change_password";
  $data['user'] = $this->users_model->get_user($userId);
  $data['error'] = "";  
  $this->load->view('user/template',$data);
}

function update_password() 
{
   $data['error']="";
  $this->load->model('users_model');
  $userId = $this->session->userdata('userId'); 
  $a = $this->users_model->get_user($userId);
  $old_password = $a[0]['userPassword'];    
  $userId = $this->session->userdata('userId');
  $password = $this->input->post('password');
  $cpassword = $this->input->post('cpassword');

  if($old_password == $this->input->post('opassword'))
  {
    if($password == $cpassword)
    {      
      $change_pass = array(
        'userPassword' => $this->input->post('password'), 
        );

      $change = $this->users_model->change_password($change_pass, $userId);  

      if($change)
      {
        $this->load->model('decisions_model','dm');
        $data['recent_decisions'] = $this->dm->get_recent();
        $data['main']="user/dashboard";
        $this->load->view('user/template',$data);

      }
    }
    else
      $data['error'] = "Make sure that your passwords match";
    $data['main']="user/change_password";
    $this->load->view('user/template',$data);

  }
  else
  {
    $data['error'] = "Please enter correct password";
    $data['main']="user/change_password";
    $this->load->view('user/template',$data);
  }
}

function update_profile() 
{
  $this->load->model('users_model');
  $userId = $this->session->userdata('userId'); 
  $update_array = array(
    'userFirstName' => $this->input->post('firstname'), 
    'userLastName' => $this->input->post('lastname'), 
    'userDob' =>  $this->input->post('dob'),
    'userInfo' => $this->input->post('info'),
    );
  $update = $this->users_model->update_user($update_array, $userId);

  if($update)
  {
    redirect (base_url("index.php/users/profile".DIRECTORY_SEPARATOR.$userId));
  }
}
function signin()
{
  if(!$this->session->userdata('userId'))
  {
    $data['message']="";
    $this->load->view('frontend/login_box',$data);
  }
  else {
    $base_url = base_url();
    redirect($base_url.'index.php/users/dashboard');
  }
}

function login_ajax()
{
  if($this->input->post('email') && $this->input->post('password'))
  {
    $uemail = $this->input->post('email');
    $upassword = $this->input->post('password');
    $this->load->model('users_model','auth');
    $row = $this->auth->login($uemail, $upassword);
    if($row)
    {
      $this->session->set_userdata($row);
      return true;

    }
  }
}

function login_direct($email, $password)
{

  $this->load->model('users_model','auth');
  $row = $this->auth->login($email, $password);
  if($row)
  {
    $this->session->set_userdata($row);
    $this->signin();
  }
  else echo "Email or Password Wrong";

}

function logout(){
 $this->session->sess_destroy();
 redirect('welcome/index', 'refresh');
         //$this->load->view('frontend/home');

}   

function signup()
{
  $this->load->view('frontend/manual_signup');
}   

function signup_request($f, $l, $e, $p, $t)
{
  $this->load->model('users_model');

  $userRegDate = date('y-m-d');

  $insert_array = array(
    'userFirstName' => $f, 
    'userLastName' => $l, 
    'userEmail' => $e, 
    'userPassword' => $p, 
    'userRegistrationDate' => $userRegDate,      
    'userStatus' => '0',
    'userVerificationCode'=>$t
    );
  if($this->users_model->register($insert_array)){
    return true;
  }
  else return false;
}   

function registration($user = NULL)
{
  $this->load->model('users_model');
  if($userId=$this->users_model->check_if_email_exists($this->input->post('email')))
  {
    show_error("Signup Failed. A user with this Email Address already exists!");
    return;
  }


  $token = md5($this->input->post('firstname').date('h:i:s').$this->input->post('email').'RaND0MStRiNg29845');
  $arr['to'] = $this->input->post('email');
  $arr['username'] = $this->input->post('firstname').' '.$this->input->post('lastname');
  $password = $this->input->post('password');
  $cpassword = $this->input->post('cpassword');

    if($this->signup_request($this->input->post('firstname'), $this->input->post('lastname'), $this->input->post('email'), $this->input->post('password'),$token))
    {

      $arr2['to'] = $arr['to'];

      $arr2['subject'] = 'Email Verification - Decisions.pk';
      $username = $arr['username'];


      $message = '<div style="width: 70%; backbground: #f6f6f6; border: '.
      '1px solid #dddddd; margin: 5px auto 5px; padding: 15px;">'.
      '<div style="font-family: verdana; text-align: left;">'.
      '<table style="width: 100%; background: #2B469F; padding:5px"><tr><td><img src="http://decisions.pk/beta2/incs/images/logo.jpg" height="30px" alt="Logo" valign="top" /></td><td><h3 style=" display: inline; font-size: 14px; text-transform: capitalize; color: white; width: 100% "> Email Verification</h3></td></tr></table>'.
      '</div><h3>Dear '.$username.',</h3><p>Please follow the link below to complete your registration,</p>'.
      '<br /><p><a href="'.base_url().'index.php/users/verify_email/'.$token.'">Verify Email</p><br /><div style="background: #eee; font-family: arial; font-size: 11px; padding: 5px; text-align: left">'.
      '<p>*This Email has been sent to you by Decisions.pk <br />'.
      '*Errors & Omissions can be expected. In case of a mistake please email us at support@decisions.pk</p></div></div>';

      $arr2['message'] = $message;

      if($this->send_email($arr2))
      {
      //$data['message'] = 'Verification link has been sent to your email please check.';
      //$data['message_type'] = 'success';
      //$this->load->view('frontend/login_box', $data);  
       $data['message']='<div class="text-center"><h3 class="text-success" style="">Signup on Decisions.pk Successful!</h3>'.
                        '<h4 class="gray">A verificaiton link has been sent to your email. Please click the link to verify your account.</h4></div>';
     }
   }
   else{
    $data['message']="Signup on Decisions.pk Couldn't be Completed!";
  }
$this->load->view('frontend/signup_response',$data);

}

function check_profile_connection($network)
{
  return 'Profile Connected';
}

function connect_profiles($network)
{
  if($network)
  {
    $message = $this->check_profile_connection($network);
    $data['message'] = $message;
    $data['network'] = $network;
    $data['main'] = 'user/connect_profiles';
    $this->load->view('user/template', $data);
  }
}

function save_notification($userId, $notification)
{
  $this->load->model('users_model');

    $arr = array('notificationText' => $notification, 'notificationDate'=> date('Y-m-d h:i:s'), 'notificationStatus'=>0, 'userId'=>$userId);
  if($this->users_model->save_notification($arr)) return true; else return false;
}

function send_notification($userId, $notification)
{

//         $client = new Client(base_url());
// // Send an asynchronous request.
//     $req = $client->createRequest('http://push-decisions.herokuapp.com/notify');
//     $response = $client->post($req);
//   }

  if($this->save_notification($userId, $notification))
  {
    $this->load->library('curl');
    $curl = new Curl();
    $curl->postForm('http://push-decisions.herokuapp.com/notify', ['user'=>$userId, 'notification'=>$notification]);
  }
  
}

function get_notifications()
{
  $this->load->model('users_model');
  return $this->users_model->get_notifications($this->session->userdata('userId'));

}

function reset_notifications($userId)
{
  $this->config->set_item('unread_count', 0);
  $this->load->model('users_model');
  echo $this->users_model->reset_notifications($userId);
}

function get_unread_count()
{
  $this->load->model('users_model');
  return $this->users_model->get_unread_count($this->session->userdata('userId'));

}

function google_request()
{
  $provider = new League\OAuth2\Client\Provider\Google(array(
    'clientId'  =>  '    365760964165-sufekf9guug596tr16ahipt1qdg59fp4.apps.googleusercontent.com',
    'clientSecret'  =>  'G3zocVdXDC4qp_BAQtqFg5yY',
    'redirectUri'   =>  ' http://decisions.pk/beta2/index.php/users/google_request ',
    // 'scopes' => array('email', '...', '...'),
    ));

  if ( ! isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    header('Location: '.$provider->getAuthorizationUrl());
    exit;

  } else {

    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
      'code' => $_GET['code']
      ]);

    // If you are using Eventbrite you will need to add the grant_type parameter (see below)
    $token = $provider->getAccessToken('authorization_code', [
      'code' => $_GET['code'],
      'grant_type' => 'authorization_code'
      ]);

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
      $userDetails = $provider->getUserDetails($token);

        // Use these details to create a new profile
      printf('Hello %s!', $userDetails->firstName);

    } catch (Exception $e) {

        // Failed to get user details
      exit('Oh dear...');
    }

    // Use this to interact with an API on the users behalf
    echo $token->accessToken;

    // Use this to get a new access token if the old one expires
    echo $token->refreshToken;

    // Number of seconds until the access token will expire, and need refreshing
    echo $token->expires;
  }
}

function linkedin_request()
{

  $provider = new League\OAuth2\Client\Provider\LinkedIn(array(
    'clientId'  =>  '75x35tzrhap08f',
    'clientSecret'  =>  'f52rPQNO3G4HLeg7',
    'redirectUri'   =>  'http://decisions.pk/beta/index.php/users/linkedin_request',
    // 'scopes' => array('email', '...', '...'),
    ));

  if ( ! isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    header('Location: '.$provider->getAuthorizationUrl());
    exit;

  } else {

    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
      'code' => $_GET['code']
      ]);

    // If you are using Eventbrite you will need to add the grant_type parameter (see below)
    $token = $provider->getAccessToken('authorization_code', [
      'code' => $_GET['code'],
      'grant_type' => 'authorization_code'
      ]);

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
      $userDetails = $provider->getUserDetails($token);

        // Use these details to create a new profile
      printf('Hello %s!', $userDetails->firstName);

    } catch (Exception $e) {

        // Failed to get user details
      exit('Oh dear...');
    }

    // Use this to interact with an API on the users behalf
    echo $token->accessToken;

    // Use this to get a new access token if the old one expires
    echo $token->refreshToken;

    // Number of seconds until the access token will expire, and need refreshing
    echo $token->expires;
  }
  
}



function facebook_request()
{

  $provider = new League\OAuth2\Client\Provider\Facebook(array(
    'clientId'  =>  '342379032604718',
    'clientSecret'  =>  'edfe8f035e99d7c56522b49d2fb8eba5',
    'redirectUri'   =>  'http://decisions.pk/beta2/index.php/users/facebook_request',
    // 'scopes' => array('email', '...', '...'),
    ));

  if ( ! isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    header('Location: '.$provider->getAuthorizationUrl());
    exit;

  } else {

    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
      'code' => $_GET['code']
      ]);

    // If you are using Eventbrite you will need to add the grant_type parameter (see below)
    $token = $provider->getAccessToken('authorization_code', [
      'code' => $_GET['code'],
      'grant_type' => 'authorization_code'
      ]);

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
      $userDetails = $provider->getUserDetails($token);

        // Use these details to create a new profile
      printf('Hello %s!', $userDetails->firstName);

    } catch (Exception $e) {

        // Failed to get user details
      exit('Oh dear...');
    }

    // Use this to interact with an API on the users behalf
    echo $token->accessToken;

    // Use this to get a new access token if the old one expires
    echo $token->refreshToken;

    // Number of seconds until the access token will expire, and need refreshing
    echo $token->expires;
  }
  
}


function verify_email($token = NULL)
{

  if($token==NULL || $token=='' || strlen($token)<5 || strlen($token)>32){
    show_error('Invalid Token Specified!');
  }

  $this->load->model('users_model');



  if($userId = $this->users_model->email_verify_token_exists($token))
  {
    if($this->users_model->email_verify($userId))
    {
          //$this->remove_token($this->input->post('token'));
      $data['message'] = 'Your Email has been verified Successfuly!';
      $data['message_type'] = 'success';
      $this->load->view('frontend/login_box', $data);
    }else{
      show_error('Error verifying your email!');
    }
  }
  else{
    $data['message'] = 'Link Wrong or Expired! Try Again!';
    $this->load->view('frontend/login_box', $data);
  }


}

function check_if_follow($followerId, $followringUserId)
{
  $this->load->model('users_model', 'um');
  if($this->um->check_if_follow($followerId, $followringUserId))return true; else return true;
}

function follow_user($followerId, $followringUserId)
{
  $this->load->model('users_model', 'um');
  $arr = array('userId' => $followerId, 'followUserId'=>$followringUserId, 'followingDateTime'=> date("Y-m-d h:i:s"));

  // if($this->check_if_follow($followerId, $followringUserId)) //returns false if you are following
  // {
    if($this->um->follow_user($arr)!='false')
    {
      $user = $this->um->get_user($followerId);
      $username = $user[0]['userFirstName'].' '.$user[0]['userLastName'];
      $id = $user[0]['userId'];
      $url = base_url('index.php/users/profile/').'/'.$id;
      $this->send_notification($followringUserId, 'You have been followed by <a target="_blank" href="'.$url.'">'.$username.'</a>!');
      echo 'done';
    }  else echo 'error';
  // }

}


function unfollow_user($followerId, $followringUserId)
{
  $this->load->model('users_model', 'um');
  $arr = array('userId' => $followerId, 'followUserId'=>$followringUserId);

  if($this->check_if_follow($followerId, $followringUserId))
  {
    if($this->um->unfollow_user($arr))
    {
      echo 'done';
    }  else echo 'error';
  }

}

function change_profile_pic()
{
  $a=$this->input->post('submit');
  if(!empty($a))
  { 
    $this->load->model('users_model');
    $userId = $this->session->userdata('userId'); 
    if(is_uploaded_file($_FILES['profile_pic']['tmp_name'])){ 
      $dir = "./uploads/users";
      $filename = md5(time().$_FILES['profile_pic']['name']).'.jpg';
      if(!move_uploaded_file($_FILES['profile_pic']['tmp_name'],"$dir/$filename"))
      {
       show_error('Unable to move uploaded file!');
     }
   }
   else show_error('Unable to upload file!');

   if(!in_array($_FILES['profile_pic']['type'],array('image/gif','image/png','image/jpeg')))
    show_error('You can only upload JPEG, PNG and GIF Images!');
        //file_put_contents("$dir/$filename",$this->resize_image("$dir/$filename",205,200));
   $this->resize_image("$dir/$filename",205,200,$_FILES['profile_pic']['type']);

   $update_array = array(
    'userProfilePicture' => $filename
    );
   $update = $this->users_model->update_user($update_array, $userId);

   $tmp=$this->session->all_userdata();
   $tmp['userProfilePicture']=$filename;
   $this->session->set_userdata($tmp);

   if($update)
   {
    redirect(base_url("index.php/users/dashboard"),'location');
  }
}else{
  $data['main'] = 'user/change_profile_pic';
  $this->load->view('user/template', $data);
}
}

function resize_image($file, $w, $h, $type, $crop=FALSE) {
  list($width, $height) = getimagesize($file);
  $r = $width / $height;
  if ($crop) {
    if ($width > $height) {
      $width = ceil($width-($width*abs($r-$w/$h)));
    } else {
      $height = ceil($height-($height*abs($r-$w/$h)));
    }
    $newwidth = $w;
    $newheight = $h;
  } else {
    if ($w/$h > $r) {
      $newwidth = $h*$r;
      $newheight = $h;
    } else {
      $newheight = $w/$r;
      $newwidth = $w;
    }
  }

  switch( $type){
    case 'image/gif':
  $src = imagecreatefromgif($file);
    break;
    case 'image/jpeg':
  $src = imagecreatefromjpeg($file);
    break;
    case 'image/png':
  $src = imagecreatefrompng($file);
    break;
    default:
    show_error('You can only upload JPEG, PNG and GIF Images!');
  }

  $dst = imagecreatetruecolor($newwidth, $newheight);
  imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

  imagejpeg($dst, $file);  
    //return $dst;
}

function get_profile_pic()
{
        $profile_pic=$this->session->userdata('userProfilePicture');

      if(empty($profile_pic))
        return base_url().'incs/images/user.png';
      else
        return base_url().'uploads/users/'.$profile_pic;
}


function add_connected_profile($ar)
{
  $this->load->model('users_model');

  if($ar['network']=='twitter')
  {
    $userId = $ar['userId'];
    $network = $ar['network'];
    unset($ar['network']);
    // unset($ar['network']);
    if($this->users_model->add_connected_profile($ar, $network, $userId)) return true; else return false;
  }
}

function update_settings($arr)
{
  $this->load->model('users_model');
  if($this->users_model->update_settings($arr)) return true; else return false;
}

function check_already_connected($sname)
{
  $this->load->model('users_model', 'um');
  if($this->um->check_already_connected($sname, 'twitter')) return true; else return false;
}

function login_with_twitter($sname)
{
  $this->load->model('users_model', 'um');
  $user = $this->um->get_user_from_twitter($sname);
  $user['login_from'] = 'twitter';

  $this->session->set_userdata($user); // loggin in with userId
  redirect(base_url());
}

function check_twitter_connect()
{
  $this->load->model('users_model', 'um');
  $userId = $this->session->userdata('userId');
  
  $user = $this->um->check_twitter_account($userId);
  if($user==0)
  {
    $this->config->set_item('twitter_connect', 0);
  }
  else
  {
    $this->config->set_item('twitter_connect', 1);
  }
}

function twitter_request()
{
$this->load->helper('tmhoauth_utilities');
$config=array(
// change the values below to ones for your application
'consumer_key' => 'XhfvYqLXCmp1dDkQ6J6CsoxtZ',
'consumer_secret' => 'Cu2yDtoqnRDigGu4DX23LWGhmSBvr9Ash2rttYZEVqcA5VtpI5'
);

$tmhOAuth=new tmhOAuth($config);

$params = uri_params();

if (!isset($params['oauth_token'])) {
// Step 1: Request a temporary token and
// Step 2: Direct the user to the authorize web page
request_token($tmhOAuth);

} else {
// Step 3: This is the code that runs when Twitter redirects the user to the callback. Exchange the temporary token for a permanent access token

$res = access_token($tmhOAuth);
if(count($res)>0){

  if(!$this->check_already_connected($res['screen_name'])){


// print_r($res);
$tmh = new tmhOAuth(array('token' =>$res["oauth_token"], 
                          'secret'=>$res['oauth_token_secret'], 
                          'consumer_key' => 'XhfvYqLXCmp1dDkQ6J6CsoxtZ',
                          'consumer_secret' => 'Cu2yDtoqnRDigGu4DX23LWGhmSBvr9Ash2rttYZEVqcA5VtpI5'));

// echo "<br />";
$code = $tmh->user_request(array(
'url' => $tmh->url('1.1/account/verify_credentials')
));
// echo "<br />";echo "<br />";
$user_profile = json_decode($tmh->response['response'], true);


$this->load->model('users_model');
$name = explode(' ', $user_profile['name']);

if($this->check_if_logged_in()){ // if logged in 
  $userId = $this->session->userdata('userId'); // then get user Id 
}
else 
{
  
if(!isset($name[1])) $name[1] = '';
  $signup_array = array('userFirstName'=>$name[0], 
    'userLastName'=>$name[1], 
    'userStatus'=>'1', 
    'userProfilePicture'=>$user_profile['profile_image_url_https'], 
    'userRegistrationDate'=>date('Y-m-d h:i:s'),
    'userInfo'=>$user_profile['description']
    );

    $userId = $this->users_model->register($signup_array); // registering and getting userId

    $this->session->set_userdata(array('userId'=> $userId, 'userFirstName'=>$name[0], 'userLastName'=>$name[1], 'login_from'=>'twitter')); // loggin in with userId

    if($userId) $this->load->view('user/twitter_connect'); // asking email and password

}

 $this->update_settings(array('userId'=>$userId, 'twitterConnected'=>'1')); // update settings

$d = date('Y-m-d H:i:s', strtotime($user_profile['created_at']));

if(!isset($name[1])) $name[1] = '';

 $profile_arr = array(
    'userId'=>$userId, 
    'network'=> 'twitter',
    'tprofileFirstname'=>$name[0], 
    'tprofileLastname'=>$name[1],
    'tprofileUsername' => $user_profile['screen_name'],
    'tprofileJoinedDate'=> $d,
    'verified' => $user_profile['verified'],
    'tprofileLocation' => $user_profile['profile_location'],
    'tprofilePicture'=>$user_profile['profile_image_url_https'], 
    'date'=>date('Y-m-d h:i:s'),
    'token' =>$res["oauth_token"], 
    'token_secret'=>$res['oauth_token_secret']
    );

$token = $res["oauth_token"]; $token_secret = $res['oauth_token_secret'];

 $this->load->library('curl');
    $curl = new Curl();
  $c_req = $curl->get('https://monitor-decisions.herokuapp.com/twitter?userid=$userId&key=XhfvYqLXCmp1dDkQ6J6CsoxtZ&secret=Cu2yDtoqnRDigGu4DX23LWGhmSBvr9Ash2rttYZEVqcA5VtpI5&token=$token&token_secret=$token_secret');

  file_put_contents('tweet_subscription.txt', $c_req.'\n', FILE_APPEND);
  
  if($this->add_connected_profile($profile_arr)) redirect(base_url());



}
else {
  $this->login_with_twitter($res['screen_name']);
}






}
else{redirect(base_url('index.php/users/connect_error/twitter')) ;}

}

}
// class ends

}