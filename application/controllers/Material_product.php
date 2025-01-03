<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_product extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_material_product','material_product');
        $this->load->library('Ajax_pagination');
        $this->perPage = 5;
    }
    
    public function index(){
        $data = array();
        
        //total rows count
        $totalRec = count($this->material_product->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'material_product/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['material_product'] = $this->material_product->getRows(array('limit'=>$this->perPage));
        
		$data['material'] = $this->db->get("material")->result_array();
        //load the view
        $this->load->view('admin/material-product', $data);
    }
    
    function ajaxPaginationData(){
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->material_product->getRows($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'material_product/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['material_product'] = $this->material_product->getRows($conditions);
        
        //load the view
        $this->load->view('admin/material-product-paging', $data, false);
    }
	public function ajax_edit($id)
	{
	 	$data = $this->material_product->get_by_id($id);
	 	echo json_encode($data);
	}
	public function ajax_add()
	 {
	 	$this->_validate();
	 	$data = array(
			'material_id' => $this->input->post('material_id'),
			'product_id'  => $this->session->userdata('product_id'),
			'quantity'    => $this->input->post('quantity'),
		);
	 	$insert = $this->material_product->save($data);
		echo json_encode(array("status" => TRUE));
	 }

	public function ajax_update()
	{
	 	$this->_validate();
	 	$data = array(
			'material_id' => $this->input->post('material_id'),
			'product_id'  => $this->session->userdata('product_id'),
			'quantity'    => $this->input->post('quantity'),
		);
	 	$this->material_product->update(array('id' => $this->input->post('id')), $data);
	 	echo json_encode(array("status" => TRUE));
	}
	public function ajax_delete($id)
	{
	 	$this->material_product->delete_by_id($id);
	 	echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
	 	$data = array();
	 	$data['error_string'] = array();
	 	$data['inputerror'] = array();
	 	$data['status'] = TRUE;
	 	$this->form_validation->set_rules('material_id','Material','required');
	 	if($this->form_validation->run() == FALSE)
	 	{
	 		$data['inputerror'][] = 'material_id';
	 		$data['error_string'][] = form_error('material_id',' ',' ');
	 		$data['status'] = FALSE;
	 	}
		$this->form_validation->set_rules('quantity','Quantity','required');
	 	if($this->form_validation->run() == FALSE)
	 	{
	 		$data['inputerror'][] = 'quantity';
	 		$data['error_string'][] = form_error('quantity',' ',' ');
	 		$data['status'] = FALSE;
	 	}
	 	
	 	if($data['status'] === FALSE)
	 	{
	 		echo json_encode($data);
	 		exit();
	 	}
	} 
	
	public function detail($id){
		$this->session->set_userdata('product_id', $id);
		//echo $this->session->userdata('purchase_id');
		//exit;
		redirect('material_product');
	}

}
