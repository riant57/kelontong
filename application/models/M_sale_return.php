<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_sale_return extends CI_Model
{
    var $table = 'sale_return';
	var $column_order = array(null,'detail'); 
	var $column_search = array('detail'); 
	var $order = array('id' => 'desc'); 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getRows($params = array()){
        //$this->db->select('*');
        $this->db->select('sale_return.id, sale_return.sale_id, sale.member_id,sale_return.total_price, sale_return.discount, sale_return.discount_nominal, sale_return.total,sale_return.created_at, members.name');
        $this->db->join('members', 'members.id = sale_return.member_id', 'left');
        $this->db->join('sale', 'sale.id = sale_return.sale_id', 'left');
        $this->db->from($this->table);
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('desk',$params['search']['keywords']);
        }
        if(!empty($params['search']['member_id'])){
            $this->db->where('sale_return.member_id',$params['search']['member_id']);
        }
        
        if(!empty($params['search']['date_from'])){
            $this->db->where('sale_return.created_at >=', $params['search']['date_from']);
        }
        if(!empty($params['search']['date_until'])){
            $this->db->where('sale_return.created_at <=', $params['search']['date_until']);
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
		//$this->db->where('is_returned',1);
        //get records
        //$query = $this->db->get();
        //return fetched data
        //return ($query->num_rows() > 0)?$query->result_array(): array();
        $data = $this->db->get();
        if($data->num_rows()>0)
        {
            foreach($data->result_array() as $val){
                $resultsarray[] = array(
                    'sale_return'  => $val,
                    'payment'  => "",
                    'detail'   => $this->get_by_sale_return_id($val['id']),
                );
            }
            return $resultsarray; 
        }
        else
        {
            return array();
        }
    }
    
    function getSumPrice($params = array()){
        $this->db->select_sum('total_price');
        
        if(!empty($params['search']['member_id'])){
            $this->db->like('member_id',$params['search']['member_id']);
        }
        
        if(!empty($params['search']['date_from'])){
            $this->db->where('sale_retun.created_at >=', $params['search']['date_from']);
        }
        if(!empty($params['search']['date_until'])){
            $this->db->where('sale_retun.created_at <=', $params['search']['date_until']);
        }
        //get records
        $query = $this->db->get($this->table);
        $ret = $query->row();
        return $ret->total_price;
        
    }
    
     public function get_by_sale_return_id($id)
	{
		$this->db->from('sale_detail_return');
		$this->db->where('sale_id',$id);
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
		$this->db->set('is_returned',0);
		$this->db->where('id', $id);
		$this->db->update($this->table);
	}
	
	public function getSalesId()
	{
        $this->db->select('sale_id'); 
        $this->db->from($this->table);   
        //$this->db->where('res_id', $res_id);
        $data =  $this->db->get()->result_array();
        $singleArray = array();
        foreach ($data as $key => $value){
            $singleArray[$key] = $value['sale_id'];
        }
        return $singleArray;
	}
}