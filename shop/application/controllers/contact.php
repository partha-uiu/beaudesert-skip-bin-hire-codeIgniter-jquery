<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends My_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'User');
//        $this->load->model('products_model', 'Product');
//	$this->load->model('type_model', 'Type');
//        $this->load->model('cart_model', 'Cart');		
//        $this->load->model('order_model', 'Order');		
//	$this->load->model('transaction_model','Transaction');
    }

    public function index() {

        $this->layout = "index";
        $this->title_for_layout = 'Contact';
        $this->params['TNActive'] = 'TNHome'; //active top menu;
              
    }

       
}
