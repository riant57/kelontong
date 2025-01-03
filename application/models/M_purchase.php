<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_purchase extends CI_Model
{
    var $table = 'purchase';
	var $column_order = array(null,'product_id'); 
	var $column_search = array('product_id'); 
	var $order = array('id' => 'desc'); 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getRows($params = array()){
	   // echo "<pre>";
	   // print_r($params);
	   // echo "</pre>";
	    //echo $params['search'][0]['product_id'];
        //$this->db->select('*');
        $this->db->select('purchase.id, suppliers.name as supplier_name, product.name as product_name, purchase.date,purchase.expired, purchase.price, purchase.quantity, purchase.total  ');
		$this->db->join('suppliers', 'suppliers.id = purchase.supplier_id', 'left');
		$this->db->join('product', 'product.id = purchase.product_id', 'left');
        $this->db->from($this->table);
        //filter data by searched keywords
        if(!empty($params['search']['supplier_id'])){
            $this->db->like('supplier_id',$params['search']['supplier_id']);
        }
        if(!empty($params['search']['product_id'])){
            $this->db->like('product_id',$params['search']['product_id']);
        }
        
        if(!empty($params['search']['date_from'])){
            $this->db->where('date >=', $params['search']['date_from']);
        }
        if(!empty($params['search']['date_until'])){
            $this->db->where('date <=', $params['search']['date_until']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            //$this->db->order_by('name',$params['search']['sortBy']);
			$this->db->order_by('purchase.id','desc');
        }else{
            $this->db->order_by('purchase.id','desc');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
		$this->db->where('purchase.is_returned',0);
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array(): array();
    }
    
    function getSumPurchase($params = array()){
        $this->db->select_sum('total');
        
        if(!empty($params['search']['supplier_id'])){
            $this->db->like('supplier_id',$params['search']['supplier_id']);
        }
        if(!empty($params['search']['product_id'])){
            $this->db->like('product_id',$params['search']['product_id']);
        }
        
        if(!empty($params['search']['date_from'])){
            $this->db->where('purchase.date >=', $params['search']['date_from']);
        }
        if(!empty($params['search']['date_until'])){
            $this->db->where('purchase.date <=', $params['search']['date_until']);
        }
        //get records
        $query = $this->db->get('purchase');
        $ret = $query->row();
        return $ret->total;
        
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