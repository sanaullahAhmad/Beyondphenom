<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pattern_collections_model extends CI_Model
{

    public $table = 'pattern_collections';
    public $id = 'collectionId';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('collectionId', $q);
	$this->db->or_like('collectionTitle', $q);
	$this->db->or_like('collectionDescription', $q);
	$this->db->or_like('collectionImage', $q);
	$this->db->or_like('collectionDate', $q);
	$this->db->or_like('adminId', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('collectionId', $q);
	$this->db->or_like('collectionTitle', $q);
	$this->db->or_like('collectionDescription', $q);
	$this->db->or_like('collectionImage', $q);
	$this->db->or_like('collectionDate', $q);
	$this->db->or_like('adminId', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Pattern_collections_model.php */
/* Location: ./application/models/Pattern_collections_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-17 12:44:45 */
/* http://harviacode.com */