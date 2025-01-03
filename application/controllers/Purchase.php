<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_purchase','purchase');
        $this->load->model('m_product','product');
        $this->load->model('m_suppliers','supplier');
        $this->load->library('Ajax_pagination');
        $this->perPage = 50;
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
        $group = array('admin');
        if (!$this->ion_auth->in_group($group)){
        	$this->session->set_flashdata('message', 'You must be a gangsta OR a hoodrat to view this page');
            show_error('You must be an administrator to view this page.');
        }
    }
    
    public function index(){
        $data = array();
        
        //total rows count
        $totalRec = count($this->purchase->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'purchase/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['suppliers'] = $this->db->get("suppliers")->result_array();
        //$data['products']  = $this->db->get("product")->result_array();
        $data['products']  = $this->product->getRows();
        $data['purchase']  = $this->purchase->getRows(array('limit'=>$this->perPage));
        
        // echo "<pre>";
        // print_r($data['products']);
        // echo "</pre>"; exit;
        
        $data['sum_purchase']     = $this->purchase->getSumPurchase();
        
        //load the view
        $this->load->view('admin/purchase', $data);
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
        //$keywords = $this->input->post('keywords');
        //echo $keywords; exit;
        
        $date_from   = $this->input->post('date_from');
        $date_until  = $this->input->post('date_until');
        $supplier_id = ($this->input->post('supplier_id') < 1 ? "" : $this->input->post('supplier_id'));
        $product_id  = ($this->input->post('product_id') < 1 ? "" : $this->input->post('product_id'));
        
        
        $sortBy = $this->input->post('sortBy');
        if(!empty($date_from)){
            $conditions['search']['date_from'] = $date_from;
        }
        if(!empty($date_until)){
            $conditions['search']['date_until'] = $date_until;
        }
        if(!empty($supplier_id)){
            $conditions['search']['supplier_id'] = $supplier_id;
        }
        if(!empty($product_id)){
            $conditions['search']['product_id'] = $product_id;
        }
        
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->purchase->getRows($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'purchase/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['purchase'] = $this->purchase->getRows($conditions);
        $data['sum_purchase']     = $this->purchase->getSumPurchase($conditions);
        $data['product_name']     = ($product_id)? $this->product->getProductName($product_id): "Semua Produk";
        $data['supplier_name']    = ($supplier_id)? $this->supplier->getSupplierName($supplier_id): "Semua Supplier";
        $data['date_from']   = $date_from;
        $data['date_until']  = $date_until;
        
        //load the view
        $this->load->view('admin/purchase-paging', $data, false);
    }
// 	public function ajax_edit($id)
// 	{
// 	 	$data = $this->purchase->get_by_id($id);
// 	 	echo json_encode($data);
// 	}
	
	public function edit($id)
	{
	 	$data['purchase'] = $this->purchase->get_by_id($id);
	 	$data['suppliers'] = $this->db->get("suppliers")->result_array();
        //$data['products']  = $this->db->get("product")->result_array();
        $data['products']  = $this->product->getRows();
	 	$this->load->view('admin/purchase_edit', $data, false);
// 	 	print_r($data['purchase']); exit;
// 	 	echo json_encode($data);
	}
	
	
	
	
	public function ajax_add()
	 {
	 	$this->_validate();
	 	$data = array(
			'date' 		 => $this->input->post('date'),
			'expired' 	 => $this->input->post('expired'),
			'supplier_id'=> $this->input->post('supplier_id'),
			'product_id' => $this->input->post('product_id'),
			'price' 	 => $this->input->post('price'),
			'quantity' 	 => $this->input->post('quantity'),
			'total' 	 => $this->input->post('total'),
			'note' 		 => $this->input->post('note'),
			'created_at' => date("Y-m-d H:i:s"),
		);
	 	$insert = $this->purchase->save($data);
		echo json_encode(array("status" => TRUE));
	 }

	public function ajax_update()
	{
	 	$this->_validate();
	 	$data = array(
			'date' 		 => $this->input->post('date'),
			'expired' 	 => $this->input->post('expired'),
			'supplier_id'=> $this->input->post('supplier_id'),
			'product_id' => $this->input->post('product_id'),
			'price' 	 => $this->input->post('price'),
			'quantity' 	 => $this->input->post('quantity'),
			'total' 	 => $this->input->post('total'),
			'note' 		 => $this->input->post('note'),
			'updated_at' => date("Y-m-d H:i:s"),
		);
	 	$this->purchase->update(array('id' => $this->input->post('id')), $data);
	 	echo json_encode(array("status" => TRUE));
	}
	public function ajax_delete($id)
	{
	 	$this->purchase->delete_by_id($id);
	 	echo json_encode(array("status" => TRUE));
	}
	public function ajax_return($id)
	{
	 	$this->purchase->return_by_id($id);
	 	echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		$this->form_validation->set_rules('date','Date','required');
		if($this->form_validation->run() == FALSE)
		{
			$data['inputerror'][] = 'date';
			$data['error_string'][] = form_error('date',' ',' ');
			$data['status'] = FALSE;
		}
		$this->form_validation->set_rules('product_id','Produk','required');
		if($this->form_validation->run() == FALSE)
		{
			$data['inputerror'][] = 'product_id';
			$data['error_string'][] = form_error('product_id',' ',' ');
			$data['status'] = FALSE;
		}


		$this->form_validation->set_rules('supplier_id','Supplier','required');
		if($this->form_validation->run() == FALSE)
		{
			$data['inputerror'][] = 'supplier_id';
			$data['error_string'][] = form_error('supplier_id',' ',' ');
			$data['status'] = FALSE;
		}


		$this->form_validation->set_rules('price','Price','required');
		if($this->form_validation->run() == FALSE)
		{
			$data['inputerror'][] = 'price';
			$data['error_string'][] = form_error('price',' ',' ');
			$data['status'] = FALSE;
		}
		$this->form_validation->set_rules('quantity','Quantity','required');
		if($this->form_validation->run() == FALSE)
		{
			$data['inputerror'][] = 'quantity';
			$data['error_string'][] = form_error('quantity',' ',' ');
			$data['status'] = FALSE;
		}
		$this->form_validation->set_rules('total','Total','required');
		if($this->form_validation->run() == FALSE)
		{
			$data['inputerror'][] = 'total';
			$data['error_string'][] = form_error('total',' ',' ');
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
