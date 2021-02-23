<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_success extends My_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'User');
        $this->load->model('products_model', 'Product');
	$this->load->model('type_model', 'Type');
	$this->load->model('product_settings_model', 'Common');  
        $this->load->model('cart_model', 'Cart');
        
//        $this->load->model('order_model', 'Order');		
//	$this->load->model('transaction_model','Transaction');
    }

    public function index() {

        $this->layout = "index";
        $this->title_for_layout = 'Order Successfull';
        
              
    }  
    
}
