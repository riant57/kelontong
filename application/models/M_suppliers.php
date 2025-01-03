<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_suppliers extends CI_Model
{
    var $table = 'suppliers';
	var $column_order = array(null,'name'); 
	var $column_search = array('name'); 
	var $order = array('id' => 'desc'); 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->table);
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('name',$params['search']['keywords']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            //$this->db->order_by('name',$params['search']['sortBy']);
			$this->db->order_by('id','desc');
        }else{
            $this->db->order_by('id','desc');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array(): array();
    }
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
	
	public function getSupplierName($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
        $ret = $query->row();
        return $ret->name;
	}
}