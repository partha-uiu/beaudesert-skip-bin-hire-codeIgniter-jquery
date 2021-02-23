<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Signup extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'User');
        $this->load->model('products_model', 'Product');
	$this->load->model('type_model', 'Type');
	$this->load->model('product_settings_model', 'Common');  
        $this->load->model('cart_model', 'Cart');
         $this->load->model('invoice_number','Invoice');
    }

    public function index() {
        $this->layout = 'index';
        $this->title_for_layout = 'SignUp';
        $this->params['postcode'] =  $this->session->userdata('postcode');

    }
    
    public function sign_up_user() {

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
          $password = md5($this->ahrform->get('password'));
         
          $this->User->set('fname', $fname);
          $this->User->set('lname', $lname);
          $this->User->set('username', $username);
          $this->User->set('company_name', $company_name);
          $this->User->set('address', $address);
          $this->User->set('suburb', $suburb);
          $this->User->set('postcode', $postcode);
          $this->User->set('email', $email);
          $this->User->set('password', $password);
          $this->User->set('phone', $phone);
          $this->User->set('group_id', 2);
          
          $this->User->save();
          $sess_array3 = array(
                        'postcode' => ''
                        );
          $this->session->unset_userdata($sess_array3);
          
          exit(json_encode(array('status'=>true,'msg'=>'success')));

       }
}
