<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashier extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_cashier','cashier');
		$this->load->model('m_product','product');
		//$this->load->model('m_bill_detail','bill_detail');
		$this->load->model('m_sale','sale');
		$this->load->model('m_sale_detail','sale_detail');
		$this->load->library('Ajax_pagination');
        $this->perPage = 100;
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    public function index(){
//         echo "<pre>";
//         print_r($this->cart->contents());
// 		echo "</pre>"; exit;
		$this->cart->destroy();
		$data['desk'] = $this->db->get("desk")->result_array();
        $this->load->view('admin/cashier', $data);
    }
    
    public function add_order($id = null ){
        $this->cart->destroy();
		//echo $id; exit;
		if ($this->uri->segment(3)!== null){
			$desk_no = $this->uri->segment(3);
		}
		else{
			redirect('cashier');
			exit();
		}
		
		
		//total rows count
        $totalRec = count($this->product->getActiveRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'product/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
		
		
		$bill_id = $this->input->get('bill_id', TRUE);
		$products = $this->sale_detail->get_by_sale_id($bill_id);
		if(!empty($bill_id) && empty($this->cart->contents())){
			foreach($products as $product){
				$data = array(
					'id'    => $product['product_id'], 
					'name'  => $product['product'], 
					'price' => $product['price'], 
					'qty'   => $product['quantity'], 
				);
				$this->cart->insert($data);
			}
			
		}
		
		$data['cart']	 = $this->cart->contents();
		//$data['product'] = $this->db->get("product")->result_array();
        $data['product'] = $this->product->getActiveRows(array('limit'=>$this->perPage));
		$data['desk_no'] = $desk_no;
		$this->load->view('admin/add-order', $data);
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
        
        
        $product     = $this->input->post('keywords');
        $category_id = ($this->input->post('category') < 1 ? "" : $this->input->post('category'));
        
        
        $sortBy = $this->input->post('sortBy');
        if(!empty($product)){
            $conditions['search']['product'] = $product;
        }
        if(!empty($category_id)){
            $conditions['search']['category_id'] = $category_id;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->product->getActiveRows($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'cashier/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        $data['cart']	 = $this->cart->contents();
        //get posts data
        $data['product'] = $this->product->getActiveRows($conditions);
        
        //load the view
        $this->load->view('admin/add-order-paging', $data, false);
    }
	
	function add_to_cart($id){ 
	
		$product = $this->product->get_by_id($id);
        $data = array(
            'id'    => $product[0]['product']['id'],
            'name'  => $product[0]['product']['name'], 
            'price' => $product[0]['product']['sale_price'], 
            'qty'   => 1, 
            'hpp'   => $product[0]['product']['hpp'], 
            'stock' => $product[0]['stock'], 
        );
        $this->cart->insert($data); 
		echo json_encode($this->get()); 
    }
    
    function updateCartItem(){
        $data = array(
                    'rowid'=>$this->input->post('rowid',FALSE),
                    'qty'=> $this->input->post('qty',TRUE)
                );
        if ($this->cart->update($data)) {
            echo json_encode($this->get());
        }else{
            echo "Faliure";
        }
    }
	function get(){
		$data = array();
		$data['id'] 	  = array();
		$data['rowid'] 	  = array();
		$data['qty'] 	  = array();
		$data['hpp'] 	  = array();
		$data['stock'] 	  = array();
		$data['subtotal'] = $this->cart->total();
		foreach($this->cart->contents() as $item){
			$data['id'][]    = $item['id'];
			$data['rowid'][] = $item['rowid'];
			$data['qty'][]   = $item['qty'];
			$data['hpp'][]   = $item['hpp'];
			$data['stock'][] = $item['stock'];
		}
		return $data;
	}

	function delete_cart()
	{
		$data = array(
			'rowid' => $this->input->post('row_id'),
			'qty' 	=> 0,
		);
		$this->cart->update($data);
		
		$response = array(
			'rowid' 	=> $this->input->post('row_id'),
			'subtotal'  => $this->cart->total(),
		);
		
		echo json_encode($response);	
	}
	
	function confirmation()
	{ 
		$data['cart'] = $this->cart->contents();		
		$data = $this->load->view('admin/order_confirmation',$data, TRUE);
		echo $data; 
	}
	
	/* function clear()
	{
	  echo "<pre>";
        print_r($this->cart->contents());
		echo "</pre>"; exit;
	  $this->cart->destroy();
	} */
	

	 

}
