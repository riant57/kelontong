<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    var $table = 'members';
	var $column_order = array(null,'name'); 
	var $column_search = array('name'); 
	var $order = array('id' => 'desc'); 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function getSumSales($params = array()){
        $this->db->select_sum('total');
        
        if(!empty($params['search']['member_id'])){
            $this->db->like('member_id',$params['search']['member_id']);
        }
        
        if(!empty($params['search']['date_from'])){
            $this->db->where('sale.created_at >=', $params['search']['date_from']);
        }
        if(!empty($params['search']['date_until'])){
            $this->db->where('sale.created_at <=', $params['search']['date_until']);
        }
        //get records
        $query = $this->db->get('sale');
        $ret = $query->row();
        return $ret->total;
        
    }
    
    function getSumPurchase($params = array()){
        $this->db->select_sum('total');
        
        if(!empty($params['search']['member_id'])){
            $this->db->like('member_id',$params['search']['member_id']);
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
    
    function getSumPurchaseReturn($params = array()){
        $this->db->select_sum('total');
        
        if(!empty($params['search']['member_id'])){
            $this->db->like('member_id',$params['search']['member_id']);
        }
        
        if(!empty($params['search']['date_from'])){
            $this->db->where('purchase_return.created_at >=', $params['search']['date_from']);
        }
        if(!empty($params['search']['date_until'])){
            $this->db->where('purchase_return.created_at <=', $params['search']['date_until']);
        }
        //get records
        $query = $this->db->get('purchase_return');
        $ret = $query->row();
        return $ret->total;
        
    }
    
    function getCountSales($params = array()){
        $this->db->select('count(*) as count_sales');
        
        if(!empty($params['search']['member_id'])){
            $this->db->like('member_id',$params['search']['member_id']);
        }
        
        if(!empty($params['search']['date_from'])){
            $this->db->where('sale.created_at >=', $params['search']['date_from']);
        }
        if(!empty($params['search']['date_until'])){
            $this->db->where('sale.created_at <=', $params['search']['date_until']);
        }
        //get records
        $query = $this->db->get('sale');
        $ret = $query->row();
        return $ret;
        
    }
    
    
    function getCountBill($params = array()){
	    
	    $ids = $this->getBillsId();
	
        $this->db->select('count(*) as count_bill');
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('desk',$params['search']['keywords']);
        }
        if(!empty($params['search']['member_id'])){
            $this->db->where('sale.member_id',$params['search']['member_id']);
        }
        
        if(!empty($params['search']['date_from'])){
            $this->db->where('sale.created_at >=', $params['search']['date_from']);
        }
        if(!empty($params['search']['date_until'])){
            $this->db->where('sale.created_at <=', $params['search']['date_until']);
        }
        if(!empty($ids)){
            $this->db->where_in('sale.id', $ids );
        }
        
        
        $query = $this->db->get('sale');
        $ret = $query->row();
        return $ret;
    }
    
    public function getBillsId(){
        $this->db->select('sale.id, sale.total, sum(payments.total) as payment_total');
        $this->db->join('payments','sale.id = payments.sales_id', 'left');
        $this->db->from('sale');
        $this->db->group_by('sale.id'); 
        $data = $this->db->get();
        if($data->num_rows()>0)
        {
            
            foreach($data->result_array() as $val){
                if($val['total'] > $val['payment_total']){
                    $result[] = $val['id'];
                }else{
                    $result[] = "";
                }
                    
            }
            return $result; 
        }
        else
        {
            return array();
        }
    }
    
    function getSalesDateChart(){
        $this->db->select('SUM(total) as sales_total, created_at');
        $this->db->where('created_at BETWEEN date_sub(now(),INTERVAL 1 WEEK) and now()');
        $this->db->group_by('created_at'); 
        $this->db->from('sale');

        $data = $this->db->get();
        if($data->num_rows()>0)
        {
            foreach($data->result_array() as $val){
                $resultsarray[] = tanggal($val['created_at']);
            }
            return $resultsarray; 
        }
        else
        {
            return array();
        }
    }
    
    function getSalesChart(){
        $this->db->select('SUM(total) as sales_total, created_at');
        $this->db->where('created_at BETWEEN date_sub(now(),INTERVAL 1 WEEK) and now()');
        $this->db->group_by('created_at'); 
        $this->db->from('sale');

        $data = $this->db->get();
        if($data->num_rows()>0)
        {
            foreach($data->result_array() as $val){
                $resultsarray[] = $val['sales_total'];
            }
            return $resultsarray; 
        }
        else
        {
            return array();
        }
    }
    
    function getPurchaseChart(){
        $this->db->select('SUM(total) as purchase_total, date');
        $this->db->where('date BETWEEN date_sub(now(),INTERVAL 1 WEEK) and now()');
        $this->db->group_by('date'); 
        $this->db->from('purchase');

        $data = $this->db->get();
        if($data->num_rows()>0)
        {
            foreach($data->result_array() as $val){
                $resultsarray[] = $val['purchase_total'];
            }
            return $resultsarray; 
        }
        else
        {
            return array();
        }
    }
    
    function getPurchaseDateChart(){
        $this->db->select('SUM(total) as purchase_total, date');
        $this->db->where('date BETWEEN date_sub(now(),INTERVAL 1 WEEK) and now()');
        $this->db->group_by('date'); 
        $this->db->from('purchase');

        $data = $this->db->get();
        if($data->num_rows()>0)
        {
            foreach($data->result_array() as $val){
                $resultsarray[] = tanggal($val['date']);
            }
            return $resultsarray; 
        }
        else
        {
            return array();
        }
    }
    
    function getMinimStockProduct(){
        $this->db->select('*');
        $this->db->order_by('stock');
        $this->db->limit(10);
        $this->db->from('product');
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array(): array();
    }
    
    function getProductOrderByExpired(){
        $this->db->select('purchase.product_id, product.name,product.stock, purchase.expired');
        $this->db->join('product','product.id = purchase.product_id', 'left');
        $this->db->where('product.stock > 0');
        $this->db->order_by('purchase.expired');
        $this->db->limit(10);
        $this->db->from('purchase');
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array(): array();
    }

// 	function getRows($params = array()){
//         $this->db->select('*');
//         $this->db->from($this->table);
//         //filter data by searched keywords
//         if(!empty($params['search']['keywords'])){
//             $this->db->like('name',$params['search']['keywords']);
//         }
//         //sort data by ascending or desceding order
//         if(!empty($params['search']['sortBy'])){
//             //$this->db->order_by('name',$params['search']['sortBy']);
// 			$this->db->order_by('id','desc');
//         }else{
//             $this->db->order_by('id','desc');
//         }
//         //set start and limit
//         if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
//             $this->db->limit($params['limit'],$params['start']);
//         }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
//             $this->db->limit($params['limit']);
//         }
//         //get records
//         $query = $this->db->get();
//         //return fetched data
//         return ($query->num_rows() > 0)?$query->result_array(): array();
//     }
	
// 	public function get_by_id($id)
// 	{
// 		$this->db->from($this->table);
// 		$this->db->where('id',$id);
// 		$query = $this->db->get();

// 		return $query->row();
// 	}
// 	public function getMemberName($id)
// 	{
// 		$this->db->from($this->table);
// 		$this->db->where('id',$id);
// 		$query = $this->db->get();
//         $ret = $query->row();
//         return $ret->name;
// 	}
// 	public function save($data)
// 	{
// 		$this->db->insert($this->table, $data);
// 		return $this->db->insert_id();
// 	}

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
}