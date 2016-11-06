<?php
    
    class Myadmin_model extends CI_Model{
        protected $table_name = "admins";
        function __construct(){
            parent::__construct();
            
        }
        
        function login($uemail, $upassword){
        
        $q = $this->db->get_where($this->table_name, array('adminEmail'=>$uemail,
                                         'adminPassword'=>$upassword));
         if($q->num_rows()>0){
            $row = $q->row_array();
                return $row;
                }else{
                return array();
                    }
        }
        

        function users_stats(){
            return $this->db->count_all('users');
        }
    /*    function franchise_stats(){
            
            return $this->db->count_all('pr_franchise');
            
        }
        function jobs_stats(){
            return $this->db->count_all('pr_jobs');
        }
        function package_stats(){
            return $this->db->count_all('pr_packages');
        }
        function payment_stats(){
            $q = $this->db->query('select sum(payment_price) as sss from pr_payments');
            foreach($q->result() as $res){
                $total = $res->sss;
            }

            
            $q = $this->db->query('select sum(payment_price) as sss from pr_payments where payment_type="1"');
            foreach($q->result() as $res){
                $total_franchise_payments = $res->sss;

            }

            $t = array();
            $t['total_payments']= $total;
            $t['total_franchise_payments'] = $total_franchise_payments;
            return $t;



        }
        
       */
        

    function count_all_notes()
    {
        $this->db->from('notes');
        return $this->db->count_all_results();
    }

    function count_all_projects()
    {
        $this->db->from('projects');
        return $this->db->count_all_results();
    }
    
    function count_developing_projects()
    {
        $this->db->where('projectStatus','0');
        $this->db->from('projects');
        return $this->db->count_all_results();
    }

    function count_completed_projects()
    {
        $this->db->where('projectStatus','1');
        $this->db->from('projects');
        return $this->db->count_all_results();
    }

    function count_notes()
    {
        $this->db->from('notes');
        return $this->db->count_all_results();
    }

    function count_clients()
    {
        $this->db->from('users');
        return $this->db->count_all_results();
    }

     function count_active_clients()
    {
        $this->db->where('userStatus','1');
        $this->db->from('users');
        return $this->db->count_all_results();
    }

     function count_inactive_clients()
    {
        $this->db->where('userStatus','0');
        $this->db->from('users');
        return $this->db->count_all_results();
    }

    function count_team()
    {
        $this->db->from('team');
        return $this->db->count_all_results();
    }

    function count_files()
    {
        $this->db->from('files');
        return $this->db->count_all_results();
    }

    function count_pubs()
    {
        $this->db->from('publications');
        return $this->db->count_all_results();
    }

    function count_news()
    {
        $this->db->where('pageType','1');
        $this->db->from('pages');
        return $this->db->count_all_results();
    }



}

?>
