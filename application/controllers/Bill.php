<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill extends CI_Controller {

	function __construct() {
        parent::__construct();
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
        $this->load->model('m_bill','bill');
		$this->load->model('m_bill_detail','bill_detail');
		$this->load->model('m_sale','sale');
		$this->load->model('m_sale_detail','sale_detail');
		$this->load->library('Ajax_pagination');
        $this->perPage = 10;
    }
    
// 	public function index(){	
// 		$this->cart->destroy();
// 		$data['bill'] = $this->sale->get_bill_paid_yet();
// 		$this->load->view('admin/bill',$data);
//     }


    public function index(){
        $data = array();
        
        //total rows count
        $totalRec = count($this->bill->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'bill/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['sale'] = $this->bill->getRows(array('limit'=>$this->perPage));
        // echo "<pre>";
        // print_r($this->bill->getBillsId());
        // echo "</pre>";
        // exit;
        $data['members']   = $this->db->get("members")->result_array();
        //load the view
        
        $data['sum_price']   = $this->bill->getSumPrice();
        $data['sum_payment'] = $this->bill->getSumPayment();
        $data['payment_yet'] = $data['sum_price'] - $data['sum_payment'];
        //print_r($data['sum_price']); echo "<br>"; 
        //print_r($data['sum_payment']); exit;
        
        $this->load->view('admin/bill', $data);
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
        //$member_id   = ($this->input->post('member_id') < 1 ? "" : $this->input->post('member_id'));
        $member_id   = $this->input->post('member_id');
        
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
        $totalRec = count($this->bill->getRows($conditions));
        //print_r($totalRec); exit;
        
        $data['member_name'] = ($member_id)? $this->member->getMemberName($member_id): "Semua Pelanggan"; 
        $data['date_from']   = $date_from;
        $data['date_until']  = $date_until;
        $data['sum_price']   = $this->bill->getSumPrice($conditions);
        $data['sum_payment'] = $this->bill->getSumPayment($conditions);
        $data['payment_yet'] = $data['sum_price'] - $data['sum_payment'];
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'bill/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['sale'] = $this->bill->getRows($conditions);
        
        //load the view
        $this->load->view('admin/bill-paging', $data, false);
    }
	
	public function save($desk_no)
	{	
		$bill_id = $this->input->get('bill_id', TRUE);	
		if(!empty($bill_id)){
			$data = array(
				'desk'    	 => $desk_no,
				'total_price'=> $this->cart->total(),
				'status'	 => 0,
				'user_id'	 => 1,
				'updated_at' => date("Y-m-d H:i:s"),
			);
			$this->sale->update(array('id' => $bill_id), $data);
			$this->sale_detail->delete_by_sale_id($bill_id);
			//print_r($this->cart->contents()); exit;
			foreach($this->cart->contents() as $item){
				$data = array(
					'sale_id'    => $bill_id,
					'product_id' => $item['id'],
					'quantity' 	 => $item['qty'],
					'product' 	 => $item['name'],
					'price' 	 => $item['price'],
					'total' 	 => $item['subtotal'],
					'status' 	 => 0,
					'created_at' => date("Y-m-d H:i:s"),
				);
				$this->sale_detail->save($data);
			} 
			$this->update_quantity_desk($desk_no);
			$this->cart->destroy();
			redirect('cashier');
		}else{
			$data = array(
				'desk'    	 => $desk_no,
				'total_price'=> $this->cart->total(),
				'status'	 => 0,
				'user_id'	 => 1,
				'created_at' => date("Y-m-d H:i:s"),
			);
			$insert = $this->sale->save($data);
			$sale_id = $this->db->insert_id();
			foreach($this->cart->contents() as $item){
				$data = array(
					'sale_id'    => $sale_id,
					'product_id' => $item['id'],
					'quantity' 	 => $item['qty'],
					'product' 	 => $item['name'],
					'price' 	 => $item['price'],
					'total' 	 => $item['subtotal'],
					'status' 	 => 0,
					'created_at' => date("Y-m-d H:i:s"),
				);
				$this->sale_detail->save($data);
			} 
			$this->update_quantity_desk($desk_no);
			$this->cart->destroy();
			redirect('bill');
		}		
		
	} 
	/* function update($bill_id = null)
	{
		$data = array(
			'total_price'=> $this->cart->total(),
			'user_id'	 => 1,
			'updated_at' => date("Y-m-d H:i:s"),
		);
		$this->bill->update($data);
	} */
	
	function update_quantity_desk($desk_no){
		$bill 	  = $this->sale->get_bill_id($desk_no);
			$desk_sum = $this->sale_detail->get_desk_sum($bill);
			$data_desk = array(
				'count_order'=> $desk_sum,
				'updated_at' => date("Y-m-d H:i:s"),
			);
		$this->sale->update_count_desk(array('desk_number' => $desk_no), $data_desk);
	}
    
    
	

	 

}
