<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends My_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'User');
        $this->load->model('products_model', 'Product');
	$this->load->model('type_model', 'Type');
	$this->load->model('product_settings_model', 'Common');  
        $this->load->model('cart_model', 'Cart');
        $this->load->model('invoice_number','Invoice');
        
//        $this->load->model('order_model', 'Order');		
//	$this->load->model('transaction_model','Transaction');
    }

    public function index() {

        $this->layout = "index";
        $this->title_for_layout = 'Cart';
        
        $crt_id = unserialize($_COOKIE['cart_cookie']);
        if (!empty($crt_id)) {
            $prodTable = $this->db->dbprefix . 'products';
            $cartTable = $this->db->dbprefix . 'cart';
            $cartIdStr = implode(',', $crt_id);
            $this->params['all_cart'] = $this->Cart->query("SELECT * FROM $cartTable as cart LEFT JOIN $prodTable as product ON cart.p_id = product.id WHERE cart.cart_id IN($cartIdStr) GROUP BY cart.cart_id ORDER BY cart.cart_id DESC")->result() ;
//            pr($this->params['all_cart']);      
         
        $matches = implode(',', $crt_id);      
        $amount= $this->db->query(" SELECT SUM(price) as amount from $cartTable where cart_id IN ($matches)")->row();
        $this->params['amount'] = $amount->amount;  
        }
        // $this->params['all_cart'] = $this->Cart->result((array('conditions'=>array('id'=>$crt_id))));
               
           
    }
    
    public function cancel_cart() {

        $this->layout = FALSE;
       
        $cart_id = $this->ahrform->get('cart_id');
        $crt_cookie = unserialize($_COOKIE['cart_cookie']);
        if(!empty($crt_cookie)){
         foreach($crt_cookie as $carti=>$cookie){
            if($cookie == $cart_id){
                unset($crt_cookie[$carti]);
            }            
         } 
         $cart_cookie = serialize($crt_cookie);
         $_COOKIE['cart_cookie']= $cart_cookie;
        }
        
        $this->db->delete('cart', array('cart_id' => $cart_id)); 
        
        exit(json_encode(array('status'=>true,'msg'=>'success')));
              
    }
    public function check_log_in() {

        $this->layout = FALSE;
        
       if($this->session->userdata('user_id') && $this->session->userdata('group_id')==2){
          $rand_num = $this->randomAlphaNumber(4);
          $this->Invoice->set('invoice_num', $rand_num);
          $this->Invoice->set('user_id', $this->session->userdata('user_id'));
          $this->Invoice->set('status', 1);
          $this->Invoice->save(NULL,FALSE);
          
          $invoice_id = $this->Invoice->id;
//          $invoice_num = $this->Invoice->invoice_num;
//          $invoice_no = $invoice_id;
          if($invoice_id < 10){
              $invoice_no = '1000'.$invoice_id;
          }
          elseif($invoice_id >= 10 && $invoice_id < 100){
              $invoice_no = '100'.$invoice_id;
          }
          else{
              $invoice_no = '10'.$invoice_id;
          }
          
          $data2 = array(
                    'invoice' => $invoice_no
                    );
            $this->session->set_userdata($data2);
          
           exit(json_encode(array('status'=>true,'msg'=>'success')));
       }
       else{
           exit(json_encode(array('status'=>false,'msg'=>'success')));
       }
                      
    }
    
}
