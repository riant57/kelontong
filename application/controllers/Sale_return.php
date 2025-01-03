<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale_return extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_sale','sale');
        $this->load->model('m_sale_detail','sale_detail');
        $this->load->model('m_sale_return','sale_return');
        $this->load->model('m_sale_detail_return','sale_detail_return');
        $this->load->model('m_payment_return','payment_return');
        $this->load->model('m_members','member');
        $this->load->library('Ajax_pagination');
        $this->perPage = 100;
    }
    
    public function index(){
        $this->cart->destroy();
        $data = array();
        
        $data = $this->sale_return->getSalesId();
        echo "<pre>";
        print_r($data);
        echo "</pre>"; exit;
        
        //total rows count
        $totalRec = count($this->sale_return->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'sale_return/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['sale_return'] = $this->sale_return->getRows(array('limit'=>$this->perPage));
        $data['sales'] = $this->sale->getRows();
        $data['members']   = $this->db->get("members")->result_array();
        $data['sum_price']   = $this->sale_return->getSumPrice();
        
        // echo "<pre>";
        // print_r( $data['sale_return'] );
        // echo "</pre>"; exit;
        // //load the view
        $this->load->view('admin/sale-return', $data);
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
        
        $date_from   = $this->input->post('date_from');
        $date_until  = $this->input->post('date_until');
        $member_id   = ($this->input->post('member_id') < 1 ? "" : $this->input->post('member_id'));
        
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
        $totalRec = count($this->sale_return->getRows($conditions));
        
        $data['member_name'] = ($member_id)? $this->member->getMemberName($member_id): "Semua Pelanggan"; 
        $data['date_from']   = $date_from;
        $data['date_until']  = $date_until;
        $data['sum_price']   = $this->sale_return->getSumPrice($conditions);
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'sale_return/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['sale_return'] = $this->sale_return->getRows($conditions);
        
        //load the view
        $this->load->view('admin/sale-return-paging', $data, false);
    }
    
    public function get_sale_detail_by_id($id)
	{
	 	
	    $this->cart->destroy();
	 	
	 	$products = $this->sale_detail->get_by_sale_id($id);
	 	//print_r($products); exit;
		if(!empty($id) && empty($this->cart->contents())){
			foreach($products as $product){
				$data = array(
					'id'    => $product['product_id'], 
					'name'  => $product['product'], 
					'price' => $product['price'], 
					'qty'   => $product['quantity'], 
					'hpp'   => $product['hpp'], 
                    'stock' => $product['quantity'],
				);
				$this->cart->insert($data);
			}
			
		}
	 	$data['cart']	 = $this->cart->contents();
	 	$data['sales']   = $this->sale->get_by_id($id);
 	 	//print_r($data['sales']); exit;
// 	 	echo json_encode($data);
        $html = $this->load->view('admin/sales_return_product_ajax', $data,FALSE);
    	//echo $data;
    	echo json_encode(array("status" => TRUE, 'html' => $html));
	}
    
	/* public function ajax_edit($id)
	{
	 	$data = $this->purchase_return->get_by_id($id);
	 	echo json_encode($data);
	} */
	public function ajax_add()
	 {
	 	$this->_validate();
	 	$data = array(
			'sale_id' 	 => $this->input->post('sales_id'),
			'member_id'  => $this->sale->getMemberIdBySaleId($this->input->post('sales_id')),
			'total_price'=> $this->cart->total(),
			'discount'   => $this->sale->getDiscount($this->input->post('sales_id')),
			'discount_nominal'   => $this->sale->getDiscountNominal($this->input->post('sales_id')),
			'total'      => $this->cart->total() - $this->sale->getDiscountNominal($this->input->post('sales_id')),
			'user_id'	 => $this->ion_auth->get_user_id(), //ambil dari session user
			'created_at' => date("Y-m-d"),
		);
		//print_r($data); exit;
	 	$insert = $this->sale_return->save($data);
	 	$sale_id = $this->db->insert_id();
		foreach($this->cart->contents() as $item){
			$data = array(
				'sale_id'    => $sale_id,
				'member_id'  => $this->sale->getMemberIdBySaleId($this->input->post('sales_id')),
				'product_id' => $item['id'],
				'quantity' 	 => $item['qty'],
				'product' 	 => $item['name'],
				'hpp' 	     => $item['hpp'],
				'price' 	 => $item['price'],
				'total' 	 => $item['subtotal'],
				'margin' 	 => ($item['price'] - $item['hpp']) * $item['qty'],
				'status' 	 => 1,
				'created_at' => date("Y-m-d"),
			);
			$this->sale_detail_return->save($data);
		}
		    $discount = $this->sale->getDiscount($this->input->post('sales_id'));
		    $discount_nominal = $this->cart->total() * ($discount / 100);
		
		    $data = array(
				'sales_id'    => $sale_id,
				'member_id'   => $this->sale->getMemberIdBySaleId($this->input->post('sales_id')),
				'total'       => $this->cart->total() - $discount_nominal ,
				'created_at' => date("Y-m-d"),
			);
			$this->payment_return->save($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_delete($id)
	{
	 	$this->sale_return->delete_by_id($id);
	 	$this->sale_detail_return->delete_by_sale_id($id);
	 	$this->payment_return->delete_by_sales_id($id);
	 	echo json_encode(array("status" => TRUE));
	} 
	 public function ajax_return($id)
	{
	 	$this->sale_return->return_by_id($id);
	 	echo json_encode(array("status" => TRUE));
	}
	
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		$this->form_validation->set_rules('sales_id','Sales Id','required');
		if($this->form_validation->run() == FALSE)
		{
			$data['inputerror'][] = 'sales_id';
			$data['error_string'][] = form_error('sales_id',' ',' ');
			$data['status'] = FALSE;
		}
		
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	} 

}
