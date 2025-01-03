<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prints extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_sale','sales');
        $this->load->library('Ajax_pagination');
        $this->perPage = 25;
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    public function index(){
        $sales_id = $this->input->get('sales_id', TRUE);
        //echo $sales_id; exit;
        $data['sales'] = $this->sales->get_by_id($sales_id);
        $data['sales_detail'] = $this->sales->get_by_sale_id($sales_id);
        $data['payment'] = $this->sales->getPaymentById($sales_id);
        // echo "<pre>";
        // print_r($data['payment']);
        // echo "</pre>";
        $this->load->view('admin/print', $data);
    }
    
    

}
