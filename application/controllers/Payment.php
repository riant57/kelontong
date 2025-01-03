<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_cashier','cashier');
		$this->load->model('m_sale','sale');
		$this->load->model('m_sale_detail','sale_detail');
		$this->load->model('m_material_product','material_product');
		$this->load->model('m_material','material');
		$this->load->model('m_payment','payment');
    }
    
    
    public function index(){	
		$data['cart']	 = $this->cart->contents();
		//print_r($data['cart']); exit;
		$data['members']   = $this->db->get("members")->result_array();
        $this->load->view('admin/payment', $data);
    }
	public function save()
	{
		$bill_id    = $this->input->post('bill_id');
		$discount   = $this->input->post('discount');
		$discount_nominal   = $this->input->post('discount_rp');
		$refund   = $this->input->post('refund');
		$total    = $this->input->post('total') ;
		$desk_no    = $this->input->post('desk_no');
		$member_id  = $this->input->post('member_id');
		//Coba payment di tabel terpisah
		$payment    = $this->input->post('nominal');
		
		//Untuk update bahan baku ketika ada penjualan
		//$this->update_material();
		
		if(empty($bill_id)){
			$data = array(
				'desk'    	 => $desk_no,
				'discount'   => $discount,
				'discount_nominal'   => $discount_nominal,
				'member_id'  => $member_id,
				//'payment'    => $payment,
				'total_price'=> $this->cart->total(),
				'total'      => $total,
				'status'	 => 1,
				'user_id'	 => $this->ion_auth->get_user_id(),
				'created_at' => date("Y-m-d"),
			);
			$insert = $this->sale->save($data);
			$sale_id = $this->db->insert_id();
			foreach($this->cart->contents() as $item){
				$data = array(
					'sale_id'    => $sale_id,
					'member_id'  => $member_id,
					'product_id' => $item['id'],
					'quantity' 	 => $item['qty'],
					'product' 	 => $item['name'],
					'hpp' 	     => $item['hpp'],
					'price' 	 => $item['price'],
					'total' 	 => $item['subtotal'],
					'margin' 	 => ($item['price'] - $item['hpp']) * $item['qty'],
					'status' 	 => 1,
					//'created_at' => date("Y-m-d H:i:s"),
					'created_at' => date("Y-m-d"),
				);
				$this->sale_detail->save($data);
			}
			//$this->update_quantity_desk($desk_no);
			//$this->cart->destroy();
			$data = array(
				'sales_id'    => $sale_id,
				'member_id'   => $member_id,
				'nominal'     => $payment,
				//'sisa'        => $sisa ,
				//'total'       => $payment - $sisa,
				'sisa'        => $refund ,
				'total'       => ($this->input->post('nominal') < $this->input->post('total')) ? $this->input->post('nominal') : $this->input->post('total'),
				//'created_at'  => date("Y-m-d H:i:s"),
				'created_at' => date("Y-m-d"),
			);
			$this->payment->save($data);
			echo json_encode(array("status" => TRUE, "sales_id" => $sale_id));
		}else{
// 			$data = array(
// 				'desk'    	 => $desk_no,
// 				'discount'   => $discount,
// 				'member_id'  => $member_id,
// 				//'payment'    => $payment,
// 				'total_price'=> $this->cart->total(),
// 				'total'      => ($discount)? $subtotal - $after_discount : $subtotal ,
// 				'status'	 => 1,
// 				'user_id'	 => 1,
// 				'updated_at' => date("Y-m-d H:i:s"),
// 			);
// 			$this->sale->update(array('id' => $bill_id), $data);
// 			$this->sale_detail->delete_by_sale_id($bill_id);
// 			//print_r($this->cart->contents()); exit;
// 			foreach($this->cart->contents() as $item){
// 				$data = array(
// 					'sale_id'    => $bill_id,
// 					'product_id' => $item['id'],
// 					'quantity' 	 => $item['qty'],
// 					'product' 	 => $item['name'],
// 					'hpp' 	     => $item['hpp'],
// 					'price' 	 => $item['price'],
// 					'total' 	 => $item['subtotal'],
// 					'status' 	 => 1,
// 					'created_at' => date("Y-m-d H:i:s"),
// 				);
// 				$this->sale_detail->save($data);
// 			} 
// 			//$this->update_quantity_desk($desk_no);
// 			//$this->cart->destroy();
// 			$data = array(
// 				'sales_id'    => $bill_id,
// 				'nominal'     => $payment,
// 				'sisa'        => $sisa ,
// 				'total'       => $payment - $sisa,
// 				'created_at'  => date("Y-m-d H:i:s"),
// 			);
// 			$this->payment->save($data);
			
		}	
		$this->cart->destroy();
	}
	
	public function update_material()
	{
		$material = $this->material->get_material();
		foreach($this->cart->contents() as $item)
		{
			//print_r($this->cart->contents()); exit;
			$material_by_product = $this->material_product->get_material_by_product($item['id']);
			foreach($material as $m)
			{
				foreach($material_by_product as $data)
				{
					if($m['id'] == $data['id'] )
					{
						$data_material =  $m['quantity'] - ($data['quantity'] * $item['qty']); 
						//echo $data_material; echo "<br>"; 
						$data = array(
							'quantity'    => $data_material,
						);
						$this->material->update(array('id' => $m['id']), $data);
					}
				}
			}
		}
	}
	
	function update_quantity_desk($desk_no){
		$bill 	  = $this->sale->get_bill_id($desk_no);
			$desk_sum = $this->sale_detail->get_desk_sum($bill);
			$data_desk = array(
				'count_order'=> $desk_sum,
				'updated_at' => date("Y-m-d H:i:s"),
			);
		$this->sale->update_count_desk(array('desk_number' => $desk_no), $data_desk);
	}
	
	public function edit_payment(){
	    $member_id = $this->input->post('member_id');
	    $sale_id = $this->input->post('sale_id');
	    //echo $sale_id;
	    $data['payments'] = $this->payment->get_by_member_and_sales_id($member_id,$sale_id);
	    $data['sales']    = $this->sale->get_by_id($sale_id);
	    $data['member_id']= $member_id;
	    $data['sale_id']  = $sale_id;
	   // echo "<pre>";
	   // print_r($data['sales']);
	   // echo "</pre>"; exit;
	   //$html = $this->load->view('admin/table-category', array('category'=>$this->category->getRows(array('limit'=>$this->perPage))), true);
	   $html = $this->load->view('admin/payment_list_ajax', $data,FALSE);
	   //echo $data;
	   echo json_encode(array("status" => TRUE, 'html' => $html));
	}
	
	public function ajax_add()
	 {
	 	//$this->_validate();
	 	$data = array(
	 	    'nominal'    => $this->input->post('nominal'),
			'total'      => $this->input->post('nominal'),
			'created_at' => $this->input->post('created_at'),
			'member_id'  => $this->input->post('member_id'),
			'sales_id'   => $this->input->post('sales_id'),
			
		);
	 	$insert = $this->payment->save($data);
		//$html = $this->load->view('admin/table-category', array('category'=>$this->category->getRows(array('limit'=>$this->perPage))), true);
	 	//echo json_encode(array("status" => TRUE, 'html' => $html));
		echo json_encode(array("status" => TRUE));
	 }
	 
	public function ajax_edit($id)
	{
	 	$data = $this->payment->get_by_id($id);
	 	echo json_encode($data);
	}

	public function ajax_update()
	{
	 	$data = array(
			'total'   => $this->input->post('total'),
			'nominal' => $this->input->post('total'),
		);
	 	$this->payment->update(array('id' => $this->input->post('payment_id')), $data);
	 	echo json_encode(array("status" => TRUE));
	}
	public function ajax_delete($id)
	{
	 	$this->payment->delete_by_id($id);
	 	echo json_encode(array("status" => TRUE));
	}
	
// 	private function _validate()
// 	 {
// 	 	$data = array();
// 	 	$data['error_string'] = array();
// 	 	$data['inputerror'] = array();
// 	 	$data['status'] = TRUE;
// 	 	$this->form_validation->set_rules('nominal','Total','required');
// 	 	if($this->form_validation->run() == FALSE)
// 	 	{
// 	 		$data['inputerror'][] = 'nominal';
// 	 		$data['error_string'][] = form_error('nominal',' ',' ');
// 	 		$data['status'] = FALSE;
// 	 	}
	 	
// 	 	if($data['status'] === FALSE)
// 	 	{
// 	 		echo json_encode($data);
// 	 		exit();
// 	 	}
// 	 }
	    
	
	
    
   
	

	 

}
