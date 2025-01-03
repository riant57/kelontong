<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_report extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_sale','sale');
        $this->load->model('m_members','member');
        $this->load->model('m_payment_report','payment_report');
        $this->load->library('Ajax_pagination');
        $this->perPage = 20;
    }
    
    public function index(){
        $data = array();
        
        //total rows count
        $totalRec = count($this->payment_report->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'payment_report/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['payment_report'] = $this->payment_report->getRows(array('limit'=>$this->perPage));
        // echo "<pre>";
        // print_r($data['payment_report']);
        // echo "</pre>";
        // exit;
        $data['members']   = $this->db->get("members")->result_array();
        //load the view
        
        //$data['sum_price']   = $this->sale->getSumPrice();
        $data['sum_payment'] = $this->payment_report->getSumPayment();
        //$data['payment_yet'] = $data['sum_price'] - $data['sum_payment'];
        
        $this->load->view('admin/payment_report', $data);
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
        $sortBy = $this->input->post('sortBy');
        
        $date_from   = $this->input->post('date_from');
        $date_until  = $this->input->post('date_until');
        $member_id   = ($this->input->post('member_id') < 1 ? "" : $this->input->post('member_id'));
        //$member_id   = $this->input->post('member_id');
        
        if(!empty($date_from)){
            $conditions['search']['date_from'] = $date_from;
        }
        if(!empty($date_until)){
            $conditions['search']['date_until'] = $date_until;
        }
        if(!empty($member_id)){
            $conditions['search']['member_id'] = $member_id;
        }
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->payment_report->getRows($conditions));
        
        $data['member_name'] = ($member_id)? $this->member->getMemberName($member_id): "Semua Pelanggan"; 
        $data['date_from']   = $date_from;
        $data['date_until']  = $date_until;
        //$data['sum_price']   = $this->payment_report->getSumPrice($conditions);
        $data['sum_payment'] = $this->payment_report->getSumPayment($conditions);
        //$data['payment_yet'] = $data['sum_price'] - $data['sum_payment'];
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'payment_report/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['payment_report'] = $this->payment_report->getRows($conditions);
        
        // echo "<pre>";
        // print_r($data['sale']);
        // echo "</pre>";
        
        //load the view
        $this->load->view('admin/payment-report-paging', $data, false);
    }
	public function ajax_edit($id)
	{
	 	$data = $this->sale->get_by_id($id);
	 	echo json_encode($data);
	}
	public function ajax_add()
	 {
	 	$this->_validate();
	 	$data = array(
			'date' 		=> $this->input->post('date'),
			'detail' 	=> $this->input->post('detail'),
			'price' 	=> $this->input->post('price'),
			'quantity' 	=> $this->input->post('quantity'),
			'total' 	=> $this->input->post('total'),
			'note' 		=> $this->input->post('note'),
		);
	 	$insert = $this->sale->save($data);
		echo json_encode(array("status" => TRUE));
	 }

	public function ajax_update()
	{
	 	$this->_validate();
	 	$data = array(
			'date' 		=> $this->input->post('date'),
			'detail' 	=> $this->input->post('detail'),
			'price' 	=> $this->input->post('price'),
			'quantity' 	=> $this->input->post('quantity'),
			'total' 	=> $this->input->post('total'),
			'note' 		=> $this->input->post('note'),
		);
	 	$this->sale->update(array('id' => $this->input->post('id')), $data);
	 	echo json_encode(array("status" => TRUE));
	}
	public function ajax_delete($id)
	{
	 	$this->sale->delete_by_id($id);
	 	echo json_encode(array("status" => TRUE));
	}
	public function ajax_return($id)
	{
	 	$this->sale->return_by_id($id);
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

}