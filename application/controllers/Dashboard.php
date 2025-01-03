<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_dashboard','dashboard');
        $this->load->model('m_product','product');
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
        $conditions = array();
        $this->product->getRows($conditions); // untuk refresh stock
        $data['sum_sales']    = $this->dashboard->getSumSales($conditions);
        $data['sum_purchase'] = $this->dashboard->getSumPurchase($conditions);
        $data['sum_purchase_return'] = $this->dashboard->getSumPurchaseReturn($conditions);
        $data['count_sales']  = $this->dashboard->getCountSales($conditions);
        $data['count_bill']   = $this->dashboard->getCountBill($conditions);
        $data['sales_chart']   = $this->dashboard->getSalesChart();
        $data['sales_date_chart'] = $this->dashboard->getSalesDateChart();
        $data['purchase_chart']   = $this->dashboard->getPurchaseChart();
        $data['purchase_date_chart']   = $this->dashboard->getPurchaseDateChart();
        $data['minim_stock']   = $this->dashboard->getMinimStockProduct();
        $data['almost_expired']   = $this->dashboard->getProductOrderByExpired();
        
        // echo "<pre>";
        // print_r($data['almost_expired']);
        // echo "</pre>"; exit;
        $data['members']   = $this->db->get("members")->result_array();
        $this->load->view('admin/dashboard', $data);
    }
    
    function ajaxPaginationData(){
        $conditions = array();
        
        //calc offset number
        // $page = $this->input->post('page');
        // if(!$page){
        //     $offset = 0;
        // }else{
        //     $offset = $page;
        // }
        
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
        //$totalRec = count($this->sale->getRows($conditions));
        
        $data['sum_sales']    = $this->dashboard->getSumSales($conditions);
        $data['sum_purchase'] = $this->dashboard->getSumPurchase($conditions);
        $data['sum_purchase_return'] = $this->dashboard->getSumPurchaseReturn($conditions);
        $data['count_sales']  = $this->dashboard->getCountSales($conditions);
        $data['count_bill']   = $this->dashboard->getCountBill($conditions);
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'sale/ajaxPaginationData';
        //$config['total_rows']  = $totalRec;
        //$config['per_page']    = $this->perPage;
        //$config['link_func']   = 'searchFilter';
        //$this->ajax_pagination->initialize($config);
        
        // //set start and limit
        // $conditions['start'] = $offset;
        // $conditions['limit'] = $this->perPage;
        
        // //get posts data
        // $data['sale'] = $this->sale->getRows($conditions);
        
        // echo "<pre>";
        // echo 1; 
        // print_r($data['sum_sales']);
        // echo "</pre>"; exit;
        
        //load the view
        $this->load->view('admin/dashboard-paging', $data, false);
    }

}
