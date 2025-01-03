<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_sale extends CI_Model
{
    var $table = 'sale';
	var $column_order = array(null,'detail'); 
	var $column_search = array('detail'); 
	var $order = array('id' => 'desc'); 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

// 	function getRows($params = array()){
//         $this->db->select('*');
//         $this->db->from($this->table);
//         //filter data by searched keywords
//         if(!empty($params['search']['keywords'])){
//             $this->db->like('desk',$params['search']['keywords']);
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
// 		$this->db->where('is_returned',0);
//         //get records
//         $query = $this->db->get();
//         //return fetched data
//         return ($query->num_rows() > 0)?$query->result_array(): array();
//     }
    
    function getRows($params = array()){
        $this->db->select('sale.id, sale.member_id,sale.total_price, sale.discount, sale.discount_nominal, sale.total,sale.created_at, members.name');
        $this->db->join('members', 'members.id = sale.member_id', 'left');
        $this->db->from($this->table);
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
		$this->db->where('is_returned',0);
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
                    'payment'  => $this->getPayment($val['id']),
                    'detail'   => $this->get_by_sale_id($val['id']),
                );
            }
            return $resultsarray; 
        }
        else
        {
            return array();
        }
    }
    
    public function get_by_sale_id($id)
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
        $query = $this->db->get($this->table);
        $ret = $query->row();
        return $ret->total_price;
        
    }
    function getSumPurchase($params = array()){
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
    
    public function getPayment($id)
    {
        $this->db->select_sum('total');
        $this->db->where('sales_id',$id);
        $query = $this->db->get('payments'); 
        //return $query->row();
        $ret = $query->row();
        return $ret->total;
    }
    
    public function getPaymentById($id)
    {
        $this->db->where('sales_id',$id);
        $query = $this->db->get('payments'); 
		//return $query->result_array()[0];
		return $query->result_array();
    }
	
	public function get_bill_paid_yet()
	{
		$this->db->from($this->table);
		$this->db->where('status', 0);
		$query = $this->db->get();
		return $query->result_array();
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
	
	public function get_bill_id($desk_no)
	{
		$this->db->select('id');
		$this->db->where('desk', $desk_no);
		$this->db->where('status',0);
		$query = $this->db->get($this->table);

		$singleArray = []; 
		foreach ($query->result_array() as $childArray) 
		{ 
			foreach ($childArray as $value) 
			{ 
				$singleArray[] = $value; 
			} 
		}
				
		return $singleArray;
	}
	public function update_count_desk($where, $data)
	{
		$this->db->update('desk', $data, $where);
		return $this->db->affected_rows();
	}
	public function getMemberIdBySaleId($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
        $ret = $query->row();
        return $ret->member_id;
	}
	public function getDiscount($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
        $ret = $query->row();
        return $ret->discount;
	}
	public function getDiscountNominal($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
        $ret = $query->row();
        return $ret->discount_nominal;
	}
}