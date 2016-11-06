<?php

class Users_model extends CI_Model{
    protected $table_name = "users";
    function __construct(){
        parent::__construct();
        
    }
    
    function subscribe_users($data)
    {
        if($this->db->insert('user_subscription', $data))
            return true; 
            else 
            return false;
    }

    function notifications($userId)
    {
        $this->db->select('*');
        $this->db->where('userId', $userId);
        $this->db->order_by('notificationId', 'desc');
        $this->db->from('user_notifications');
        $q = $this->db->get();
        if($q->num_rows()>0)
        {
            return $q->result_array();
        }
        else
        {
            return 0;
        }
    }

    function followers($userId)
    {
        $q = $this->db->query('select * from users u where 
                        u.userId in (select userId as Ids from user_following where followUserId='.$userId.') 
                        ');        
        if($q->num_rows()>0)
        {
            return $q->result_array();
        }
        else
        {
            return 0;
        }
    }

      function following($userId)
    {
        $q = $this->db->query('select * from users u where 
                        u.userId in (select followUserId as Ids from user_following where userId='.$userId.') 
                        ');        
        if($q->num_rows()>0)
        {
            return $q->result_array();
        }
        else
        {
            return 0;
        }
    }

    function user_view($userId)
    {
       $q=$this->db->query('select * from decisions d, users u where d.userId in (select followUserId as Ids from user_following where userId='.$userId.') and d.userId=u.userId');
       if($q->num_rows()>0)
       {
        return $q->result_array();
       }
       else
       {
        return 0;
       }
    }
    
    function login($uemail, $upassword){

        $q = $this->db->get_where($this->table_name, array('userEmail'=>$uemail,
         'userPassword'=>$upassword));
        if($q->num_rows()>0){
            $row = $q->row_array();
            return $row;
        }else{
            return false;
        }
    }

    function get_users()
    {
        $this->db->limit('9');
        $q =  $this->db->get('users');
        return $q->result_array();
    }

    function user_following($userId)
    {
        $this->db->where('userId', $userId);
        $this->db->from('user_following');
        $q = $this->db->get();
        return $q->result_array();
    }

    function user_followers($userId)
    {
        $this->db->where('followUserId', $userId);
        $this->db->from('user_following');
        $q = $this->db->get();
        return $q->result_array();
    }


        function user_following_count($userId)
    {
        $this->db->where('userId', $userId);
        $this->db->from('user_following');
        $q = $this->db->get();
        return $q->num_rows();
    }

    function user_followers_count($userId)
    {
        $this->db->where('followUserId', $userId);
        $this->db->from('user_following');
        $q = $this->db->get();
        return $q->num_rows();
    }

    function user_total_decisions($userId)
    {
        $this->db->where('userId', $userId);
        $this->db->from('decisions');
        $q = $this->db->get();
        return $q->num_rows();
    }

    function user_decisions($userId)
    {    
        $this->db->where('userId', $userId);
        $this->db->from('decisions');
        $q = $this->db->get();
        return $q->result_array();
    }

    function user_recent_decisions($userId)
    {
        $this->db->limit('5');
        $this->db->where('userId', $userId);        
        $this->db->from('decisions');
        $q = $this->db->get();
        return $q->result_array();
    }
    

    function check_if_email_exists($email)
    {
        $query = $this->db->get_where('users',array('userEmail'=>$email),1);
            //print $query->result();
        if($query->result())
        {
                //print "query has result";
            foreach ($query->result() as $row)
            {
                $userIdd = $row->userId;
            }
            
            if($userIdd){
                return $userIdd;
            }
        }
        else return FALSE;
    }
    
    function register($data){
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
        
    }
    
    function update_user($data, $userId)
    {
        $this->db->where('userId',$userId);
        $q = $this->db->update($this->table_name, $data);
        return true;
    }

    function change_password($data, $userId)
    {
        $this->db->where('userId',$userId);
        $q = $this->db->update($this->table_name, $data);
        return true;
    }    


    function get_user($userId)
    {
        $this->db->where('userId', $userId);
        $this->db->from($this->table_name);
        $q = $this->db->get();
        return $q->result_array();

    }

    function insert_reset_token($userId, $token)
    {
        $arr = array('token' => $token, 'tokenDate' => date("Y-m-d h:i:s"), 'tokenStatus' => 0, 'userId' => $userId);
        $this->db->insert('password_reset_tokens', $arr);
        return $this->db->insert_id();
    }

    function check_token_exists($token)
    {
        $this->db->where('token', $token);
        $this->db->from('password_reset_tokens');
        $q = $this->db->get();
        $arr = $q->result_array();
        if($arr) return $arr[0]['userId']; else return false;

    }

    function email_verify_token_exists($token)
    {
        $this->db->where('userVerificationCode', $token);
        $this->db->where('userStatus', '0');
        $this->db->from('users');
        $q = $this->db->get();
        $arr = $q->result_array();
        if($arr) return $arr[0]['userId']; else return false;

    }

    function reset_password($userId, $pass){
        $arr = array('userPassword' => $pass);
        $this->db->where('userId', $userId);
        if($this->db->update('users', $arr)) return true; else return false;

    }

    function email_verify($userId){
        $arr = array('userStatus' => '1');
        $this->db->where('userId', $userId);
        if($this->db->update('users', $arr)) return true; else return false;

    }


    function remove_token($token)
    {
        $this->db->delete('password_reset_tokens',array('token'=>$token));
        return TRUE;
    }


    function settings($data){
      $userEmail = $this->session->userdata('userId');
      if($userId){
        $this->db->where('userId',$userId);
        $this->db->update($this->table_name,$data);
			  //return $this->db->insert_id();
        return TRUE;
    }
    else return FALSE;
}

function add_portal_signup_record($portal, $arr)
{
    	// if($portal == 'jobstreet')
    	// 	{
    	// 		$this->db->insert('hiak_user_$portal',$arr);
    	// 	}
    	// if($portal == 'jobscentral')
    	// 	{}
	    // if($portal == 'jobsdb')
	    // 	{}
	    // if($portal == 'monster')
	    // 	{}
 $this->db->insert('hiak_user_'.$portal, $arr);
 return $this->db->insert_id();
}



function signed_in_from($portal, $userEmail, $userId)
{

  $this->db->where('userEmail', $userEmail);
  $this->db->from('hiak_user_settings');
  $count = $this->db->count_all();

  if($portal == 'jobstreet')
  {
      if($count>0)
      {
       $arr = array('userId' => $userId, 'loggedInFromJobstreet'=> 1, 'jobstreetConnected'=>1);
       $this->db->where('userEmail', $userEmail);
       if($this->db->update('hiak_user_settings', $arr))
        {return true;}
    else return false;
}
else{
    $arr = array('loggedInFromJobstreet'=> 1);
    $this->db->where('userEmail', $userEmail);
    if($this->db->insert('hiak_user_settings', $arr))
        {return true;}
    else return false;  
}
}

if($portal == 'jobscentral')
{
  if($count>0)
  {
   $arr = array('loggedInFromJobscentral'=> 1);
   $this->db->where('userEmail', $userEmail);
   $this->db->update('hiak_user_settings', $arr);
}
else{
    $arr = array('loggedInFromJobscentral'=> 1);
    $this->db->where('userEmail', $userEmail);
    $this->db->insert('hiak_user_settings', $arr);
}
}

if($portal == 'jobsdb')
{
  if($count>0)
  {
   $arr = array('loggedInFromJobsDb'=> 1);
   $this->db->where('userEmail', $userEmail);
   $this->db->update('hiak_user_settings', $arr);
}
else{
    $arr = array('loggedInFromJobsDb'=> 1);
    $this->db->where('userEmail', $userEmail);
    $this->db->insert('hiak_user_settings', $arr);
}
}

if($portal == 'monster')
{
  if($count>0)
  {
   $arr = array('loggedInFromMonster'=> 1);
   $this->db->where('userEmail', $userEmail);
   $this->db->update('hiak_user_settings', $arr);
}
else{
    $arr = array('loggedInFromMonster'=> 1);
    $this->db->where('userEmail', $userEmail);
    $this->db->insert('hiak_user_settings', $arr);
}
}
}



function show_all()
{
    $this->db->select("*");
    $this->db->from("users");
    $q = $this->db->get();
    return $q->result_array();
}

function user_search($name){
    $this->db->select("*");
    $this->db->or_like("userFirstName",$name);
    $this->db->or_like("userLastName",$name);
    $this->db->from("users");
    $q = $this->db->get();
    return $q->result_array();
}

    function check_if_follow($followerId, $followringUserId)
    {
        $this->db->select('*');
        $this->db->from("user_following");
        $ar = array('followUserId' => $followringUserId, 'userId'=> $followerId);
        $this->db->where($ar);
        $num = $this->db->count_all_results();
        if($num>0) return true; else return false;
    }

    function follow_user($arr)
    {
        $this->db->insert('user_following', $arr);
        return $this->db->insert_id();
    }

    function unfollow_user($arr)
    {
        if($this->db->delete('user_following', $arr))return true; else return false;
    }

    function check_if_following($u, $f)
    {
        $this->db->select("*");
        $this->db->from("user_following");
        $arr = array('userId' => $u, 'followUserId'=>$f);
        $this->db->where($arr);
        $num = $this->db->count_all_results();
        if($num>0) return true; else return false;
    }

    function save_notification($arr)
    {
        if($this->db->insert('user_notifications', $arr)) return true; else return false;
    }

    function get_notifications($userId)
    {
         $this->db->select("*");
        $this->db->from("user_notifications");
        $this->db->order_by('notificationId', 'desc');
        $this->db->where('userId',$userId);
        $q = $this->db->get();
        return $q->result_array();
    }

    function get_unread_count($userId)
    {
        $this->db->select("*");
        $this->db->from("user_notifications");
        $arr = array('userId' => $userId, 'notificationStatus'=>'0' );
        $this->db->where($arr);
        return $this->db->count_all_results();
    }

    function reset_notifications($userId)
    {
        $data = array('notificationStatus' => 1);
        $this->db->where('userId',$userId);
        if($this->db->update('user_notifications', $data))return true; else return false;

    }

    function twitter_update_token($ar)
    {
        if($this->db->insert('twitter_profiles', $ar)) return true; else return false;
    }

    function check_twitter_account($user)
    {
        $this->db->where('userId', $user);
        $this->db->from('twitter_profiles');
        $q = $this->db->get();
        if($q->num_rows==1)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    function update_settings($arr)
    {
        // if($this->db->ge)
        $this->db->where('userId', $arr['userId']);
        $this->db->from('user_settings');
        $count = $this->db->count_all_results();
        if($count<1) {$this->db->insert('user_settings', $arr);  return true;}
        else {
            $this->db->update('user_settings', $arr); return true;
        }
    }


    function add_connected_profile($arr, $network, $userId)
    {
        // if($this->db->ge)
        $this->db->where('userId', $userId);
        $this->db->from($network.'_profiles');
        $count = $this->db->count_all_results();
        if($count<1) {$this->db->insert($network.'_profiles', $arr);  return true;}
        else {
            $this->db->update($network.'_profiles', $arr); return true;
        }
    }

    function get_user_from_twitter($sname)
    {
        $this->db->select('userId');
        $this->db->where('tprofileUsername', $sname);
        $this->db->from('twitter_profiles');
        $q = $this->db->get();
        $t = $q->result_array();  
        $userId = $t[0]['userId'];

        $user = $this->get_user($userId);
        return $user[0];
    }

    function check_already_connected($sname, $network)
    {
         $this->db->select('userId');
        $this->db->where('tprofileUsername', $sname);
        $this->db->from($network.'_profiles');
        $count = $this->db->count_all_results();
        if($count>0) return true; else return false;
    }

    function get_tokens($userId)
    {
        $this->db->select('*');
        $this->db->where('userId', $userId);
        $this->db->from('twitter_profiles');
        $q = $this->db->get();
        $r = $q->result_array();
        return $r[0];

    }

// class ends here

}
?>