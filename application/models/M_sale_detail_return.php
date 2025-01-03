<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_sale_detail_return extends CI_Model
{
    var $table = 'sale_detail_return';
	var $column_order = array(null,'detail'); 
	var $column_search = array('detail'); 
	var $order = array('id' => 'desc'); 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

// 	function getRows($params = array()){
//         $this->db->select('*, sale_detail.created_at as created_at, members.name as member_name');
//         $this->db->join('members', 'members.id = sale_detail.member_id', 'left');
//         $this->db->from($this->table);
        
//         if(!empty($params['search']['member_id'])){
//             $this->db->where('member_id',$params['search']['member_id']);
//         }
//         if(!empty($params['search']['product_id'])){
//             $this->db->where('product_id',$params['search']['product_id']);
//         }
        
//         if(!empty($params['search']['date_from'])){
//             $this->db->where('sale_detail.created_at >=', $params['search']['date_from']);
//         }
//         if(!empty($params['search']['date_until'])){
//             $this->db->where('sale_detail.created_at <=', $params['search']['date_until']);
//         }
        
//         //filter data by searched keywords
//         if(!empty($params['search']['keywords'])){
//             $this->db->like('product',$params['search']['keywords']);
//         }
//         //sort data by ascending or desceding order
//         if(!empty($params['search']['sortBy'])){
//             //$this->db->order_by('name',$params['search']['sortBy']);
// 			$this->db->order_by('sale_detail.id','desc');
//         }else{
//             $this->db->order_by('sale_detail.id','desc');
//         }
//         //set start and limit
//         if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
//             $this->db->limit($params['limit'],$params['start']);
//         }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
//             $this->db->limit($params['limit']);
//         }
// 		//$this->db->where('sale_id',$this->session->userdata('purchase_id'));
//         //get records
//         $query = $this->db->get();
//         //return fetched data
//         return ($query->num_rows() > 0)?$query->result_array(): array();
//     }
    
//     function getSumHPP($params = array()){
//         $this->db->select_sum('hpp');
        
//         if(!empty($params['search']['member_id'])){
//             $this->db->like('member_id',$params['search']['member_id']);
//         }
//         if(!empty($params['search']['product_id'])){
//             $this->db->like('product_id',$params['search']['product_id']);
//         }
//         if(!empty($params['search']['date_from'])){
//             $this->db->where('sale_detail.created_at >=', $params['search']['date_from']);
//         }
//         if(!empty($params['search']['date_until'])){
//             $this->db->where('sale_detail.created_at <=', $params['search']['date_until']);
//         }
//         //get records
//         $query = $this->db->get($this->table);
//         $ret = $query->row();
//         return $ret->hpp;
        
//     }
    
//     function getSumPrice($params = array()){
//         $this->db->select_sum('price');
        
//         if(!empty($params['search']['member_id'])){
//             $this->db->like('member_id',$params['search']['member_id']);
//         }
//         if(!empty($params['search']['product_id'])){
//             $this->db->like('product_id',$params['search']['product_id']);
//         }
        
//         if(!empty($params['search']['date_from'])){
//             $this->db->where('sale_detail.created_at >=', $params['search']['date_from']);
//         }
//         if(!empty($params['search']['date_until'])){
//             $this->db->where('sale_detail.created_at <=', $params['search']['date_until']);
//         }
//         //get records
//         $query = $this->db->get($this->table);
//         $ret = $query->row();
//         return $ret->price;
        
//     }
//     function getSumTotal($params = array()){
//         $this->db->select_sum('total');
        
//         if(!empty($params['search']['member_id'])){
//             $this->db->like('member_id',$params['search']['member_id']);
//         }
//         if(!empty($params['search']['product_id'])){
//             $this->db->like('product_id',$params['search']['product_id']);
//         }
        
//         if(!empty($params['search']['date_from'])){
//             $this->db->where('sale_detail.created_at >=', $params['search']['date_from']);
//         }
//         if(!empty($params['search']['date_until'])){
//             $this->db->where('sale_detail.created_at <=', $params['search']['date_until']);
//         }
//         //get records
//         $query = $this->db->get($this->table);
//         $ret = $query->row();
//         return $ret->total;
        
//     }
    
//     function getSumMargin($params = array()){
//         $this->db->select_sum('margin');
        
//         if(!empty($params['search']['member_id'])){
//             $this->db->like('member_id',$params['search']['member_id']);
//         }
//         if(!empty($params['search']['product_id'])){
//             $this->db->like('product_id',$params['search']['product_id']);
//         }
        
//         if(!empty($params['search']['date_from'])){
//             $this->db->where('sale_detail.created_at >=', $params['search']['date_from']);
//         }
//         if(!empty($params['search']['date_until'])){
//             $this->db->where('sale_detail.created_at <=', $params['search']['date_until']);
//         }
//         //get records
//         $query = $this->db->get($this->table);
//         $ret = $query->row();
//         return $ret->margin;
        
//     }
	
// 	public function get_by_id($id)
// 	{
// 		$this->db->from($this->table);
// 		$this->db->where('id',$id);
// 		$query = $this->db->get();

// 		return $query->row();
// 	}
	public function save($data)
	{
		$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
	}
	
	public function delete_by_sale_id($id)
	{
		$this->db->where('sale_id', $id);
		$this->db->delete($this->table);
	} 

// 	public function update($where, $data)
// 	{
// 		$this->db->update($this->table, $data, $where);
// 		return $this->db->affected_rows();
// 	}
// 	public function delete_by_id($id)
// 	{
// 		$this->db->where('id', $id);
// 		$this->db->delete($this->table);
// 	}
// 	public function return_by_id($id)
// 	{
// 		$this->db->set('is_returned',1);
// 		$this->db->where('id', $id);
// 		$this->db->update($this->table);
// 	}
// 	public function get_by_sale_id($id)
// 	{
// 		$this->db->from($this->table);
// 		$this->db->where('sale_id',$id);
// 		$query = $this->db->get();

// 		return $query->result_array();
// 	}
	
// 	public function delete_by_sale_id($id)
// 	{
// 		$this->db->where('sale_id', $id);
// 		$this->db->delete($this->table);
// 	} 
// 	public function get_desk_sum($bill)
// 	{
// 	    //echo $bill; exit;
// 		//$desk_sum = $this->db->select_sum('quantity')->where_in('sale_id', $bill)->get('sale_detail')->result_array();
// 		$this->db->select_sum('quantity');
// 		$this->db->where_in('sale_id', $bill);
// 		$this->db->where('status',0);
// 		$query = $this->db->get($this->table);
// 		if($query->num_rows()>0)
// 		{
// 			foreach($query->result_array() as $value){
// 				return $value['quantity'];
// 			}
// 		}
// 		return array();
// 	}
}