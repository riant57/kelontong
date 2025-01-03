<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_bill extends CI_Model
{
    var $table = 'bill';
	var $column_order = array(null,'name'); 
	var $column_search = array('name'); 
	var $order = array('id' => 'desc'); 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function getRows($params = array()){
	    
	    $ids = $this->getBillsId();
	
        $this->db->select('sale.id, sale.member_id,sale.total_price, sale.discount, sale.total,sale.created_at, members.name');
        $this->db->join('members', 'members.id = sale.member_id', 'left');
        $this->db->from('sale');
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
		//$this->db->where('is_returned',0);
		
        //get records
        //$query = $this->db->get();
        //return fetched data
        //return ($query->num_rows() > 0)?$query->result_array(): array();
        
        $data = $this->db->get();
        if($data->num_rows()>0)
        {
            foreach($data->result_array() as $val){
                $resultsarray[] = array(
                    'sale'     => $val,
                    'payment'  => $this->_getPayment($val['id']),
                    'detail'  => $this->_get_by_sale_id($val['id']),
                );
            }
            return $resultsarray; 
        }
        else
        {
            return array();
        }
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
            
            // $newArray = array();
            // foreach($var in $oldArray){
            //     $newArray[] = $var;
            // }
            
            // $result = [];

            // foreach ($resultsarray as $value) {
            //     $result = array_merge($result, $value);
            // }
            
            // return $result;
                        
            
        }
        else
        {
            return array();
        }
    }
    
    
    public function _get_by_sale_id($id)
	{
		$this->db->from('sale_detail');
		$this->db->where('sale_id',$id);
		$query = $this->db->get();

		return $query->result_array();
	}
	
    
    function getSumPrice($params = array()){
        $this->db->select_sum('total_price');
        
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
        return $ret->total_price;
        
    }
    function getSumPayment($params = array()){
        $this->db->select_sum('total');
        
        if(!empty($params['search']['member_id'])){
            $this->db->like('member_id',$params['search']['member_id']);
        }
        
        if(!empty($params['search']['date_from'])){
            $this->db->where('payments.created_at >=', $params['search']['date_from']);
        }
        if(!empty($params['search']['date_until'])){
            $this->db->where('payments.created_at <=', $params['search']['date_until']);
        }
        //get records
        $query = $this->db->get('payments');
        $ret = $query->row();
        return $ret->total;
        
    }
    
    private function _getPayment($id)
    {
        $this->db->select_sum('total');
        $this->db->where('sales_id',$id);
        $query = $this->db->get('payments'); 
        //return $query->row();
        $ret = $query->row();
        return $ret->total;
    }
	
	public function get_bill_paid_yet()
	{
		$this->db->from($this->table);
		$this->db->where('status', 0);
		$query = $this->db->get();
		return $query->result_array();
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
	
	
	
}