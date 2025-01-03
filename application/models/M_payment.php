<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_payment extends CI_Model
{
    var $table = 'payments';
	var $column_order = array(null,'name'); 
	var $column_search = array('name'); 
	var $order = array('id' => 'desc'); 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_member_and_sales_id($member_id,$sale_id)
	{
	    $this->db->select('*, payments.id as payment_id,members.name as member_name, payments.created_at as payment_date');
	    $this->db->join('members', 'members.id = payments.member_id', 'left');
		$this->db->from($this->table);
		$this->db->where('member_id',$member_id);
		$this->db->where('sales_id',$sale_id);
		//$query = $this->db->get();
		//return $query->row();
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
	
	public function delete_by_sales_id($id)
	{
		$this->db->where('sales_id', $id);
		$this->db->delete($this->table);
	}

	
}