<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_report extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_purchase_report','purchase_report');
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
        $totalRec = count($this->purchase_report->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'purchase_report/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['suppliers'] = $this->db->get("suppliers")->result_array();
        //$data['products']  = $this->db->get("product")->result_array();
        $data['products']  = $this->product->getRows();
        $data['purchase']  = $this->purchase_report->getRows(array('limit'=>$this->perPage));
        
        // echo "<pre>";
        // print_r($data['products']);
        // echo "</pre>"; exit;
        
        $data['sum_purchase']     = $this->purchase_report->getSumPurchase() -  $this->purchase_report->getSumPurchaseReturn();
        
        //load the view
        $this->load->view('admin/purchase_report', $data);
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
        $totalRec = count($this->purchase_report->getRows($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'purchase_report/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['purchase'] = $this->purchase_report->getRows($conditions);
        $data['sum_purchase']     = $this->purchase_report->getSumPurchase($conditions) -  $this->purchase_report->getSumPurchaseReturn();
        $data['product_name']     = ($product_id)? $this->product->getProductName($product_id): "Semua Produk";
        $data['supplier_name']    = ($supplier_id)? $this->supplier->getSupplierName($supplier_id): "Semua Supplier";
        $data['date_from']   = $date_from;
        $data['date_until']  = $date_until;
        
        //load the view
        $this->load->view('admin/purchase-report-paging', $data, false);
    }


}
