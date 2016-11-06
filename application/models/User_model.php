<?php
    
    class User_model extends CI_Model{
        protected $table_name = "users";
        function __construct(){
            parent::__construct();
            
        }
        
        function login($uemail, $upassword){
        
        $q = $this->db->get_where($this->table_name, array('userEmail'=>$uemail,
                                         'userPassword'=>$upassword));
         if($q->num_rows()>0){
            $row = $q->row_array();
                return $row;
                }else{
                return array();
                    }
    }

    function get_expense($month=NULL)
    {
      $this->db->select_sum('entryAmount', 'sum');
      $this->db->from('entries');
      $this->db->where('entryType', 1);      
      $this->db->where('MONTH(entryDate)', $month);      
      $q=$this->db->get();
      return $q->result_array();
    }

    function get_diff()
    {
      $q = $this->db->query("SELECT DATEDIFF(MAX(entryDate),MIN(entryDate)) AS datediff from entries");
      return $q->row('datediff');
    }    

    function get_received($month=NULL)
    {
      $this->db->select_sum('entryAmount', 'sum');
      $this->db->from('entries');
      $this->db->where('entryType', 2);      
      $this->db->where('MONTH(entryDate)', $month);      
      $q=$this->db->get();
      return $q->result_array();
    }

    function get_paid($month=NULL)
    {
      $this->db->select_sum('entryAmount', 'sum');
      $this->db->from('entries');
      $this->db->where('entryType', 3);      
      $this->db->where('MONTH(entryDate)', $month);      
      $q=$this->db->get();
      return $q->result_array();
    }
	
	function register($data){
			 $this->db->insert($this->table_name,$data);
			  return $this->db->insert_id();
				
			}
			
		function settings($data){
		$userId = $this->session->userdata('userId');
		if($userId){
			$this->db->where('userId',$userId);
			 $this->db->update($this->table_name,$data);
			  //return $this->db->insert_id();
			  return TRUE;
			}
			else return FALSE;
			}

	 function show_all(){
    // $this->db->query('select * from entries join use')
                $this->db->select('*');
                $this->db->from('entries');
                $this->db->where(array('MONTH(entryDate)'=>date('m')));
                $this->db->join('users', 'users.userId = entries.userId');                
                $this->db->order_by('entries.entryDate','desc');
                // $this->db->select('*')->from('entries','users')->where('userId','entryId')->	order_by('entryId','desc');
                $q = $this->db->get();
                 return $q->result_array();
            }

    function select_dates($start, $end){                
                $this->db->select('*');
                $this->db->from('entries');
                $this->db->where(array('entryDate >='=>$start, 'entryDate <='=>$end));
                $this->db->join('users', 'users.userId = entries.userId');                
                $this->db->order_by('entries.entryDate','desc');
                // $this->db->select('*')->from('entries','users')->where('userId','entryId')-> order_by('entryId','desc');
                $q = $this->db->get();
                 return $q->result_array();
    }


    function get_users()
    {
      $this->db->select('*')->from('users');
      $q = $this->db->get();
      return $q->result_array();

    }

   function show_entry($id){
        $this->db->select('*')->from('entries')->where('entryId',$id);
        $q = $this->db->get();
         return $q->result_array();
    }

    function show_user($id){
                $this->db->select('*')->from('users')->where('userId',$id);
                $q = $this->db->get();
                 return $q->result_array();
            }

    function show_comments($id){
                $this->db->select('*');
				$this->db->from('comments');
				$this->db->join('users', 'users.userId = comments.userId')->where('comments.entryId',$id);
                $q = $this->db->get();
                 return $q->result_array();
            }

     function entry_post($data){
			 $this->db->insert('entries',$data);
			  return $this->db->insert_id();
				
			}


	function entry_comments($entryId)
        {

              $this->db->select('*')->from('comments')->where('entryId',$entryId);
                  $q = $this->db->get();
                  return $q->result_array();
        }

      function comment_post($c,$u,$e)
      {
      
        date_default_timezone_set('Asia/Karachi');

        $d = date('y-m-d');
        $t = date('h:i:s');
        $insert_array = array(
      'comment'=>$c,
      'commentDate'=>date('Y-m-d h:i:s'),
      // 'commentTime'=> $t, 
      // 'commentBy'=>$by, 
      
      'entryId'=>$e,
      'userId'=>$this->session->userdata('userId'));

        $this->db->insert('comments',$insert_array);
        return $this->db->insert_id();
        // return 1;
      }    


  function select_users_to_email($e)
  {
    // $query = $this->db->query('select distinct(userId) from comments where entryId = '.$e);
    $this->db->select('distinct(userId)')->from('comments')->where('entryId',$e);
    $q = $this->db->get();
    return $q->result_array();
  }

  function get_emails($id)
  {
    $this->db->select('userEmail')->from('users')->where('userId',$id);
    $q = $this->db->get();
    $rows =  $q->result_array();
    if(count($rows)>0) return $rows[0]['userEmail'];

  }

  function select_all_users()
  {
    $this->db->select('*')->from('users');
    $q = $this->db->get();
    return $q->result_array();

  }


   function load_paid(){
    // $this->db->query('select * from entries join use')
                $this->db->select('*');
                $this->db->from('entries');
                $this->db->join('users', 'users.userId = entries.userId');
                $this->db->where('entryType','3');
                $this->db->where(array('entryDate >'=>date('Y-m-d', strtotime('-1 month'))));
                $this->db->order_by('entries.entryDate','desc');
                // $this->db->select('*')->from('entries','users')->where('userId','entryId')-> order_by('entryId','desc');
                $q = $this->db->get();
                 return $q->result_array();
            }

   function load_kharcha(){
    // $this->db->query('select * from entries join use')
                $this->db->select('*');
                $this->db->from('entries');
                $this->db->join('users', 'users.userId = entries.userId');
                $this->db->where('entryType','1');
                $this->db->where(array('entryDate >'=>date('Y-m-d', strtotime('-1 month'))));
                $this->db->order_by('entries.entryDate','desc');
                // $this->db->select('*')->from('entries','users')->where('userId','entryId')-> order_by('entryId','desc');
                $q = $this->db->get();
                 return $q->result_array();
            }

   function load_recieved(){
    // $this->db->query('select * from entries join use')
                $this->db->select('*');
                $this->db->from('entries');
                $this->db->join('users', 'users.userId = entries.userId');
                $this->db->where('entryType','2');
                $this->db->where(array('entryDate >'=>date('Y-m-d', strtotime('-1 month'))));
                $this->db->order_by('entries.entryDate','desc');
                // $this->db->select('*')->from('entries','users')->where('userId','entryId')-> order_by('entryId','desc');
                $q = $this->db->get();
                 return $q->result_array();
            }

    function load_my_khata($id){
    // $this->db->query('select * from entries join use')
                $this->db->select('*');
                $this->db->from('entries');
                $this->db->join('users', 'users.userId = entries.userId');
                // $w = array('userId' => $id);
                $this->db->where('users.userId', $id);
                $this->db->order_by('entries.entryDate','desc');
                // echo $this->db->last_query();
                // $this->db->select('*')->from('entries','users')->where('userId','entryId')-> order_by('entryId','desc');
                $q = $this->db->get();
                // echo $this->db->last_query();
                 return $q->result_array();
            }


      function show_attendance_entries()
      {
        $this->db->select('*')->from('attendance');
        $this->db->join('users', 'users.userId = attendance.userId');
        $this->db->order_by('attendance.id','desc');

        $q = $this->db->get();
        return $q->result_array();
      }

      function post_attendance($ar)
      {
        $this->db->insert('attendance',$ar);
        return $this->db->insert_id();
      }

      function check_attendance($userId, $type)
      {
        $this->db->select('*')->from('attendance')->where(array('userId'=>$userId, 'type'=>$type, 'DAY(date)'=>date('d'), 'MONTH(date)'=>date('m'), 'YEAR(date)'=>date('Y')));
      $q = $this->db->get();
      if(count($q->result_array())>0) return true; else return false;
      }

        
    }
?>