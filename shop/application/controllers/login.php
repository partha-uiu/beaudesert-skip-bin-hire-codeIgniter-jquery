<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends My_Controller {
	
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
        $this->title_for_layout = 'Login';
        $this->layout = 'signup';
    }


    public function login(){
    	$this->title_for_layout = 'Login';
    }

    public function check_login(){
        $this->layout = FALSE;
        
      $email = $this->ahrform->get('e_mail');
      $password = md5($this->ahrform->get('pass_word'));
      $check = $this->User->row(array('conditions'=>array('email'=>$email,'password'=>$password)));
      if($check){
          $rand_num = $this->randomAlphaNumber(4);
          $this->Invoice->set('invoice_num', $rand_num);
          $this->Invoice->set('user_id', $check->id);
          $this->Invoice->set('status', 1);
          $this->Invoice->save();
          
          $invoice_id = $this->Invoice->id;
          $invoice_num = $this->Invoice->invoice_num;
          if($invoice_id < 10){
              $invoice_no = '1000'.$invoice_id;
          }
          elseif($invoice_id >= 10 && $invoice_id < 100){
              $invoice_no = '100'.$invoice_id;
          }
          else{
              $invoice_no = '10'.$invoice_id;
          }
          
          $data1 = array(
                    'user_id' => $check->id,
                    'user_name' => $check->username,
                    'e_mail' => $check->email,
                    'group_id' => $check->group_id,
                    'invoice' => $invoice_no
                    );
            $this->session->set_userdata($data1);
          exit(json_encode(array('status'=>true,'msg'=>'success')));
      }
      else{
          exit(json_encode(array('status'=>false,'msg'=>'error')));
      }
             

    }

    public function logout() {
        $sess_array1 = array(
                        'user_id' => '',
                        'user_name' => '',
                        'e_mail' => '',
                        'group_id' => '',
                        'invoice' => ''
                        );
        $this->session->unset_userdata($sess_array1);
        redirect('product');
    }

}
?>