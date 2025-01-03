<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_material_product extends CI_Model
{
    var $table = 'material_product';
	

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function getRows($params = array()){
		
		//$this->db->select('c.name as category_name, p.id as product_id, p.name as product_name,p.price, p.stock, p.note, p.image');
		$this->db->select('mp.id, mp.material_id , mp.product_id, mp.quantity , m.name');
		$this->db->join('material as m', 'm.id = mp.material_id', 'left');
        $this->db->from($this->table. ' as mp');
        /* $this->db->select('*');
        $this->db->from($this->table); */
        
		//filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('name',$params['search']['keywords']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            //$this->db->order_by('name',$params['search']['sortBy']);
			$this->db->order_by('mp.id','desc');
        }else{
            $this->db->order_by('mp.id','desc');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
		$this->db->where('product_id',$this->session->userdata('product_id'));
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array(): array();
    }

	public function get_material_by_product($id)
	{
		$this->db->from($this->table);
		$this->db->where('product_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
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
}