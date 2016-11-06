<?php

class Login_model extends CI_Model{
    public $table = 'users';
    function __construct(){
        parent::__construct();
        
    }
        // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
       // $this->db->insert('user_profile', array('userId' => $this->db->insert_id()));
    }

    function login_action($user, $pass)
    {
        if($pass!== ""){
            $this->db->select('*');
            $this->db->where(['username' => $user, 'userPassword' => $pass]);
            return $this->db->get($this->table)->result_array();
        }else return false;
    }
    public function signup_action($value='')
    {
        # code...
    }

}