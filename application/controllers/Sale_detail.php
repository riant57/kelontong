<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale_detail extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_sale_detail','sale_detail');
        $this->load->model('m_members','member');
        $this->load->model('m_product','product');
        $this->load->library('Ajax_pagination');
        $this->perPage = 10;
    }
    
    public function index(){
		//$this->session->unset_userdata('purchase_id');
		//exit;
        $data = array();
        
        //total rows count
        $totalRec = count($this->sale_detail->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'sale_detail/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
		//$data['purchase_id']	 = $this->uri->segment(3);
        //get the posts data
        $data['sale_detail'] = $this->sale_detail->getRows(array('limit'=>$this->perPage));
        // echo "<pre>";
        // print_r($data['sale_detail']);
        // echo "</pre>";
        // exit;
        //load the view
        $data['sum_hpp']     = $this->sale_detail->getSumHPP();
        $data['sum_price']   = $this->sale_detail->getSumPrice();
        $data['sum_total'] = $this->sale_detail->getSumTotal();
        $data['sum_margin']  = $this->sale_detail->getSumMargin();
        
        $data['members']   = $this->db->get("members")->result_array();
        $data['products']  = $this->product->getRows();
        $this->load->view('admin/sale-detail', $data);
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
        $product_id   = ($this->input->post('product_id') < 1 ? "" : $this->input->post('product_id'));
        
        if(!empty($date_from)){
            $conditions['search']['date_from'] = $date_from;
        }
        if(!empty($date_until)){
            $conditions['search']['date_until'] = $date_until;
        }
        if(!empty($member_id)){
            $conditions['search']['member_id'] = $member_id;
        }
        if(!empty($product_id)){
            $conditions['search']['product_id'] = $product_id;
        }
        
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->sale_detail->getRows($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'sale_detail/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
		//$data['purchase_id']	 = $this->uri->segment(3);
        //get posts data
        $data['sale_detail'] = $this->sale_detail->getRows($conditions);
        
        $data['member_name'] = ($member_id)? $this->member->getMemberName($member_id): "Semua Pelanggan"; 
        $data['product_name'] = ($product_id)? $this->product->getProductName($product_id): "Semua Produk";
        $data['date_from']   = $date_from;
        $data['date_until']  = $date_until;
        $data['sum_hpp']     = $this->sale_detail->getSumHPP($conditions);
        $data['sum_price']   = $this->sale_detail->getSumPrice($conditions);
        $data['sum_total'] = $this->sale_detail->getSumTotal($conditions);
        $data['sum_margin']  = $this->sale_detail->getSumMargin($conditions);

        
        //load the view
        $this->load->view('admin/sale-detail-paging', $data, false);
    }
	
	
	public function detail($id){
		$this->session->set_userdata('purchase_id', $id);
		//echo $this->session->userdata('purchase_id');
		//exit;
		redirect('sale_detail');
	}

}
