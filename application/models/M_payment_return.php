<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_payment_return extends CI_Model
{
    var $table = 'payment_return';
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
	
	public function delete_by_sales_id($id)
	{
		$this->db->where('sales_id', $id);
		$this->db->delete($this->table);
	}
}