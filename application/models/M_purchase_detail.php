<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_purchase_detail extends CI_Model
{
    var $table = 'purchase_detail';
	var $column_order = array(null,'detail'); 
	var $column_search = array('detail'); 
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
            $this->db->like('detail',$params['search']['keywords']);
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
		$this->db->where('purchase_id',$this->session->userdata('purchase_id'));
        //get records
		//$this->db->where('purchase_id',$this->uri->segment(3));
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
	public function return_by_id($id)
	{
		$this->db->set('is_returned',1);
		$this->db->where('id', $id);
		$this->db->update($this->table);
	}
}