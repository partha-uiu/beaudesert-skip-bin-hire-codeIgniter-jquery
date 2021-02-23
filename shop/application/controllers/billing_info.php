<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Billing_info extends My_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'User');
        $this->load->model('products_model', 'Product');
	$this->load->model('type_model', 'Type');
	$this->load->model('product_settings_model', 'Common');  
        $this->load->model('cart_model', 'Cart'); 
        $this->load->model('order_model', 'Order');		
        $this->load->model('order_transaction_rel', 'Relation');		
	$this->load->model('transaction_model','Transaction');
	$this->load->model('invoice_number','Invoice');
    }

    public function index() {

        $this->layout = "index";
        $this->title_for_layout = 'Billing Info';
        $this->params['postcode'] =  $this->session->userdata('postcode');
                                 
    }
    
    public function billing_order() {

           $this->layout = FALSE;      
           
   // --------  insert into user table --------------    
           
          $fname = $this->ahrform->get('fname');
          $lname = $this->ahrform->get('lname');
          $username = $this->ahrform->get('fname').' '.$this->ahrform->get('lname');
          $company_name = $this->ahrform->get('company_name');
          $address = $this->ahrform->get('address');
          $suburb = $this->ahrform->get('suburb');
          $postcode = $this->ahrform->get('postcode');
          $email = $this->ahrform->get('email');
          $phone = $this->ahrform->get('phone');
         
          $this->User->set('fname', $fname);
          $this->User->set('lname', $lname);
          $this->User->set('username', $username);
          $this->User->set('company_name', $company_name);
          $this->User->set('address', $address);
          $this->User->set('suburb', $suburb);
          $this->User->set('postcode', $postcode);
          $this->User->set('email', $email);
          $this->User->set('phone', $phone);
          $this->User->set('group_id', 3);
          
          $this->User->save();
          $user_id = $this->User->id;
          
        // --------  insert into user table --------------      
//          $rand_num = random_string('alnum', 4);
          $rand_num = $this->randomAlphaNumber(4);
          $this->Invoice->set('invoice_num', $rand_num);
          $this->Invoice->set('user_id', $user_id);
          $this->Invoice->set('status', 1);
          $this->Invoice->save();
          
          $invoice_id = $this->Invoice->id;
          $invoice_num = $this->Invoice->invoice_num;
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
          $sess_array3 = array(
                        'postcode' => ''
                        );
        $this->session->unset_userdata($sess_array3);
        
          
          $data = array(
                    'userid' => $user_id,
                    'username' => $username,
                    'email' => $email,
                    'invoice_no' => $invoice_no
                    );
          $this->session->set_userdata($data);
          
          exit(json_encode(array('status'=>true,'msg'=>'success')));

       }  
        
    
}