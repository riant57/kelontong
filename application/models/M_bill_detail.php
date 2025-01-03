<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_bill_detail extends CI_Model
{
    var $table = 'bill_detail';

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
	public function get_by_bill_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('bill_id',$id);
		$query = $this->db->get();

		return $query->result_array();
	}
}