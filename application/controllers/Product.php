<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_product','product');
        $this->load->library('Ajax_pagination');
        $this->perPage = 100;
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    }
    
    public function index(){
        $data = array();
        
        //total rows count
        $totalRec = count($this->product->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'product/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['product'] = $this->product->getRows(array('limit'=>$this->perPage));
// 		echo "<pre>";
// 		print_r($data['product']);
// 		echo "</pre>";
// 		exit; 
        
        //load the view
		$data['category'] = $this->db->get("category")->result_array();
		$data['product_unit'] = $this->db->get("product_unit")->result_array();
		//print_r($result);
        $this->load->view('admin/product', $data);
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
        
        
        $product     = $this->input->post('product');
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
        $totalRec = count($this->product->getRows($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'product/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['product'] = $this->product->getRows($conditions);
        
        //load the view
        $this->load->view('admin/product-paging', $data, false);
    }
// 	 public function ajax_edit($id)
// 	{
// 	 	$data = $this->category->get_by_id($id);
// 	 	echo json_encode($data);
// 	}

    public function edit($id)
	{
	 	$data['product']  = $this->product->get_by_id($id);
// 	 	echo "<pre>";
// 	 	print_r($data['product']);
// 	 	echo "</pre>";
// 	 	exit;
	 	$data['category'] = $this->db->get("category")->result_array();
	 	$data['product_unit'] = $this->db->get("product_unit")->result_array();
	 	$this->load->view('admin/product_edit', $data, false);
	}

	public function ajax_add()
	{
	 	$this->_validate();
	 	$data = array(
	 	    'is_active'   => 1,
			'category_id' => $this->input->post('category_id'),
			'name' 		  => $this->input->post('name'),
			'hpp' 	      => $this->input->post('hpp'),
			'sale_price'  => $this->input->post('sale_price'),
			'stock' 	  => $this->input->post('stock'),
			'weight' 	  => $this->input->post('weight'),
			'product_unit_id'=> $this->input->post('product_unit_id'),
			'created_at'  => date("Y-m-d H:i:s"),
		);
		if(!empty($_FILES['photo']['name']))
        {
            $upload = $this->_do_upload();
            $this->do_resize($upload);
            $data['image'] = $upload;
        }
 
	 	$insert = $this->product->save($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_update()
	{
	 	$this->_validate();
	 	$data = array(
			'category_id' => $this->input->post('category_id'),
			'name' 		  => $this->input->post('name'),
			'hpp' 	      => $this->input->post('hpp'),
			'sale_price'  => $this->input->post('sale_price'),
			'stock' 	  => $this->input->post('stock'),
			'weight' 	  => $this->input->post('weight'),
			'product_unit_id'=> $this->input->post('product_unit_id'),
		);
		if(!empty($_FILES['photo']['name']))
        {
            $upload = $this->_do_upload();
            $this->do_resize($upload);
            $data['image'] = $upload;
        }
 
	 	//$insert = $this->product->save($data);
	 	$this->product->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_delete($id)
	{
	 	$image = $this->product->getImageName($id);
        if($image){
            unlink("./assets/uploads/".$image);
            unlink("./assets/uploads/300".$image);
            unlink("./assets/uploads/50".$image);
        }
        $this->product->delete_by_id($id);
	 	echo json_encode(array("status" => TRUE));
	}
	
	private function _do_upload()
    {
        $config['upload_path']          = './assets/uploads';
		//$config['upload_path']          = './assets/images';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|webp';
        //$config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
    
    public function do_resize($upload)
    {
        $sizes = array(300, 50);

        $this->load->library('image_lib');
    
        foreach($sizes as $size)
        { 
           $config['image_library']    = 'gd2';
           $config['source_image']     = './assets/uploads/'.$upload;
           $config['create_thumb']     = false;
           $config['maintain_ratio']   = true;
           $config['width']            = $size;
           $config['height']           = $size;   
           $config['new_image']        = './assets/uploads/' . $size . $upload;
    
           $this->image_lib->clear();
           $this->image_lib->initialize($config);
           $this->image_lib->resize();
        }    
        
    }
	
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		$this->form_validation->set_rules('category_id','Kategori','required');
		if($this->form_validation->run() == FALSE)
		{
			$data['inputerror'][] = 'category_id';
			$data['error_string'][] = form_error('category_id',' ',' ');
			$data['status'] = FALSE;
		}
		$this->form_validation->set_rules('name','Nama Produk','required');
		if($this->form_validation->run() == FALSE)
		{
			$data['inputerror'][] = 'name';
			$data['error_string'][] = form_error('name',' ',' ');
			$data['status'] = FALSE;
		}
		$this->form_validation->set_rules('hpp','Harga beli','required');
		if($this->form_validation->run() == FALSE)
		{
			$data['inputerror'][] = 'hpp';
			$data['error_string'][] = form_error('hpp',' ',' ');
			$data['status'] = FALSE;
		}
		$this->form_validation->set_rules('product_unit_id','Satuan','required');
		if($this->form_validation->run() == FALSE)
		{
			$data['inputerror'][] = 'product_unit_id';
			$data['error_string'][] = form_error('product_unit_id',' ',' ');
			$data['status'] = FALSE;
		}
		
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	} 
	
	public function check_active($id){
	    $is_active = $this->product->checkActive($id); 
	    //echo $is_active;
	    if($is_active == 0){
	        $data = array(
                'is_active' => 1,
            );
            $this->product->update(array('id' => $id), $data);
            echo json_encode(array("status" => TRUE, "note" => "Produk Aktif"));
	    }else{
	        $data = array(
                'is_active' => 0,
            );
            $this->product->update(array('id' => $id), $data);
            echo json_encode(array("status" => TRUE, "note" => "Produk Tidak Aktif"));
	    }
       
	}
}
