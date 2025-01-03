<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_material','material');
        $this->load->library('Ajax_pagination');
        $this->perPage = 5;
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    public function index(){
        $data = array();
        
        //total rows count
        $totalRec = count($this->material->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'material/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['material'] = $this->material->getRows(array('limit'=>$this->perPage));
        
        //load the view
        $this->load->view('admin/material', $data);
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
        $totalRec = count($this->material->getRows($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'material/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['material'] = $this->material->getRows($conditions);
        
        //load the view
        $this->load->view('admin/material-paging', $data, false);
    }
	 public function ajax_edit($id)
	{
	 	$data = $this->material->get_by_id($id);
	 	echo json_encode($data);
	}
	public function ajax_add()
	 {
	 	$this->_validate();
	 	$data = array(
			'name' => $this->input->post('name'),
			'quantity' => $this->input->post('quantity'),
		);
	 	$insert = $this->material->save($data);
		//$html = $this->load->view('admin/table-category', array('category'=>$this->category->getRows(array('limit'=>$this->perPage))), true);
	 	//echo json_encode(array("status" => TRUE, 'html' => $html));
		echo json_encode(array("status" => TRUE));
	 }
	
	public function ajax_update()
	{
	 	$this->_validate();
	 	$data = array(
			'name'     => $this->input->post('name'),
			'quantity' => $this->input->post('quantity'),
		);
		//print_r($data); exit;
	 	$this->material->update(array('id' => $this->input->post('id')), $data);
	 	echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_delete($id)
	{
	 	$this->material->delete_by_id($id);
	 	echo json_encode(array("status" => TRUE));
	}
	
	 private function _validate()
	 {
	 	$data = array();
	 	$data['error_string'] = array();
	 	$data['inputerror'] = array();
	 	$data['status'] = TRUE;
	 	$this->form_validation->set_rules('name','Name','required');
	 	if($this->form_validation->run() == FALSE)
	 	{
	 		$data['inputerror'][] = 'name';
	 		$data['error_string'][] = form_error('name',' ',' ');
	 		$data['status'] = FALSE;
	 	}
		
		$this->form_validation->set_rules('quantity','Quantity','required');
	 	if($this->form_validation->run() == FALSE)
	 	{
	 		$data['inputerror'][] = 'quantity';
	 		$data['error_string'][] = form_error('quantity',' ',' ');
	 		$data['status'] = FALSE;
	 	}
	 	
	 	if($data['status'] === FALSE)
	 	{
	 		echo json_encode($data);
	 		exit();
	 	}
	 } 

}
