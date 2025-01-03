<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_product extends CI_Model
{
    var $table = 'product';
	var $column_order = array(null,'name'); 
	var $column_search = array('name'); 
	var $order = array('id' => 'desc'); 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getRows($params = array()){
        $this->db->select('c.name as category_name, p.id as product_id, p.name as product_name,p.hpp,p.sale_price, p.stock,p.weight,pu.name as product_unit, p.note, p.image, p.is_active');
		$this->db->join('category as c', 'c.id = p.category_id', 'left');
		$this->db->join('product_unit as pu', 'pu.id = p.product_unit_id', 'left');
        $this->db->from($this->table. ' as p');
        //filter data by searched keywords
        if(!empty($params['search']['product'])){
            $this->db->like('p.name',$params['search']['product']);
        }
        if(!empty($params['search']['category_id'])){
            $this->db->like('c.id',$params['search']['category_id']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            //$this->db->order_by('name',$params['search']['sortBy']);
			$this->db->order_by('p.id','desc');
        }else{
            $this->db->order_by('p.id','desc');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        //$query = $this->db->get();
        //return fetched data
        //return ($query->num_rows() > 0)?$query->result_array(): array();
        
        $data = $this->db->get();
        if($data->num_rows()>0)
        {
            foreach($data->result_array() as $val){
                $stock = $this->_getQuantityPurchase($val['product_id']) - $this->_getQuantitySales($val['product_id']) - $this->_getQuantityPurchaseReturn($val['product_id']);
                $resultsarray[] = array(
                    'product'   => $val,
                    'purchase'  => $this->_getQuantityPurchase($val['product_id']),
                    'sales'     => $this->_getQuantitySales($val['product_id']),
                    'stock'     => $this->_getQuantityPurchase($val['product_id']) - $this->_getQuantitySales($val['product_id']) - $this->_getQuantityPurchaseReturn($val['product_id']),
                    'total_weight' => $stock * $val['weight'],
                );
                
                
                $this->_update_stock($stock, $val['product_id']);
                
            }
            return $resultsarray; 
        }
        else
        {
            return array();
        }
        
    }
    
    // Untuk get produk menu kasir
    function getActiveRows($params = array()){
        $this->db->select('c.name as category_name, p.id as product_id, p.name as product_name,p.hpp,p.sale_price, p.stock,p.weight,pu.name as product_unit, p.note, p.image, p.is_active');
		$this->db->join('category as c', 'c.id = p.category_id', 'left');
		$this->db->join('product_unit as pu', 'pu.id = p.product_unit_id', 'left');
		$this->db->where('is_active', 1);
        $this->db->from($this->table. ' as p');
        //filter data by searched keywords
        if(!empty($params['search']['product'])){
            $this->db->like('p.name',$params['search']['product']);
        }
        if(!empty($params['search']['category_id'])){
            $this->db->like('c.id',$params['search']['category_id']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            //$this->db->order_by('name',$params['search']['sortBy']);
			$this->db->order_by('p.id','desc');
        }else{
            $this->db->order_by('p.id','desc');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        //$query = $this->db->get();
        //return fetched data
        //return ($query->num_rows() > 0)?$query->result_array(): array();
        
        $data = $this->db->get();
        if($data->num_rows()>0)
        {
            foreach($data->result_array() as $val){
                $stock = $this->_getQuantityPurchase($val['product_id']) - $this->_getQuantitySales($val['product_id']) - $this->_getQuantityPurchaseReturn($val['product_id']);
                $resultsarray[] = array(
                    'product'   => $val,
                    'purchase'  => $this->_getQuantityPurchase($val['product_id']),
                    'purchase_return'  => $this->_getQuantityPurchaseReturn($val['product_id']),
                    'sales'     => $this->_getQuantitySales($val['product_id']),
                    'stock'     => $this->_getQuantityPurchase($val['product_id']) - $this->_getQuantitySales($val['product_id'])- $this->_getQuantityPurchaseReturn($val['product_id']),
                    'total_weight' => $stock * $val['weight'],
                );
                
                
                $this->_update_stock($stock, $val['product_id']);
                
            }
            return $resultsarray; 
        }
        else
        {
            return array();
        }
        
    }
    
    private function _update_stock($stock, $id){
        $this->db->set('stock',$stock);
        $this->db->where('id', $id);
        $this->db->update('product');
        $result =  $this->db->affected_rows(); 
        return $result;
   }
    
    private function _getQuantityPurchase($id)
    {
        $this->db->select_sum('quantity');
        $this->db->where('product_id',$id);
        $query = $this->db->get('purchase'); 
        //return $query->row();
        $ret = $query->row();
        return $ret->quantity;
    }
    
    
    private function _getQuantityPurchaseReturn($id)
    {
        $this->db->select_sum('quantity');
        $this->db->where('product_id',$id);
        $query = $this->db->get('purchase_return'); 
        //return $query->row();
        $ret = $query->row();
        return $ret->quantity;
    }
    
    
    private function _getQuantitySales($id)
    {
        $this->db->select_sum('quantity');
        $this->db->where('product_id',$id);
        $this->db->where('status',1);
        $query = $this->db->get('sale_detail'); 
        //return $query->row();
        $ret = $query->row();
        return $ret->quantity;
    }
	
	 public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$data = $this->db->get();

		//return $query->row();
		
		if($data->num_rows()>0)
        {
            foreach($data->result_array() as $val){
                $resultsarray[] = array(
                    'product'   => $val,
                    'purchase'  => $this->_getQuantityPurchase($val['id']),
                    'sales'     => $this->_getQuantitySales($val['id']),
                    'stock'     => $this->_getQuantityPurchase($val['id']) - $this->_getQuantitySales($val['id']),
                );
            }
            return $resultsarray; 
        }
        else
        {
            return array();
        }
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
	
	public function getProductName($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
        $ret = $query->row();
        return $ret->name;
	}
	
	public function getImageName($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
        $ret = $query->row();
        return $ret->image;
	}
	
	public function checkActive($id)
    {
        $this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
        $ret = $query->row();
        return $ret->is_active;
    }
}