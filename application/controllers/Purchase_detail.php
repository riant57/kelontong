<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_detail extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_purchase_detail','purchase_detail');
        $this->load->library('Ajax_pagination');
        $this->perPage = 1;
    }
    
    public function index(){
		//$this->session->unset_userdata('purchase_id');
		//exit;
        $data = array();
        
        //total rows count
        $totalRec = count($this->purchase_detail->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'purchase_detail/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
		//$data['purchase_id']	 = $this->uri->segment(3);
        //get the posts data
        $data['purchase_detail'] = $this->purchase_detail->getRows(array('limit'=>$this->perPage));
        //load the view
        $this->load->view('admin/purchase-detail', $data);
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
        $totalRec = count($this->purchase_detail->getRows($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'purchase_detail/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
		//$data['purchase_id']	 = $this->uri->segment(3);
        //get posts data
        $data['purchase_detail'] = $this->purchase_detail->getRows($conditions);
        
        //load the view
        $this->load->view('admin/purchase-detail-paging', $data, false);
    }
	public function ajax_edit($id)
	{
	 	$data = $this->purchase_detail->get_by_id($id);
	 	echo json_encode($data);
	}
	public function ajax_add()
	 {
	 	$this->_validate();
	 	$data = array(
			'purchase_id' => $this->session->userdata('purchase_id'),
			'detail' 	=> $this->input->post('detail'),
			'price' 	=> $this->input->post('price'),
			'quantity' 	=> $this->input->post('quantity'),
			'total' 	=> $this->input->post('total'),
			'note' 		=> $this->input->post('note'),
		);
	 	$insert = $this->purchase_detail->save($data);
		echo json_encode(array("status" => TRUE));
	 }

	public function ajax_update()
	{
	 	$this->_validate();
	 	$data = array(
			'purchase_id' => $this->session->userdata('purchase_id'),
			'detail' 	=> $this->input->post('detail'),
			'price' 	=> $this->input->post('price'),
			'quantity' 	=> $this->input->post('quantity'),
			'total' 	=> $this->input->post('total'),
			'note' 		=> $this->input->post('note'),
		);
	 	$this->purchase_detail->update(array('id' => $this->input->post('id')), $data);
	 	echo json_encode(array("status" => TRUE));
	}
	public function ajax_delete($id)
	{
	 	$this->purchase_detail->delete_by_id($id);
	 	echo json_encode(array("status" => TRUE));
	}
	public function ajax_return($id)
	{
	 	$this->purchase_detail->return_by_id($id);
	 	echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		$this->form_validation->set_rules('detail','Detail','required');
		if($this->form_validation->run() == FALSE)
		{
			$data['inputerror'][] = 'detail';
			$data['error_string'][] = form_error('detail',' ',' ');
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
	
	public function detail($id){
		$this->session->set_userdata('purchase_id', $id);
		//echo $this->session->userdata('purchase_id');
		//exit;
		redirect('purchase_detail');
	}

}
