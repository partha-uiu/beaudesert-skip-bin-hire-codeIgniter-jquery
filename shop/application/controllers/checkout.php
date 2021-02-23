<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Checkout extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'User');
        $this->load->model('products_model', 'Product');
        $this->load->model('type_model', 'Type');
        $this->load->model('product_settings_model', 'Common');
        $this->load->model('cart_model', 'Cart');
        $this->load->model('order_model', 'Order');
        $this->load->model('order_transaction_rel', 'Relation');
        $this->load->model('transaction_model', 'Transaction');
        $this->load->model('paypal_model', 'Paypal');
        $this->load->library('email');
    }

   public function index() {

        $this->layout = "index";
        $this->title_for_layout = 'Checkout';
        
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
        if($this->session->userdata('group_id')==2){
            $this->params['session_name'] = $this->session->userdata('user_name');  
            $this->params['session_mail'] = $this->session->userdata('e_mail');
            $this->params['session_invoice'] = $this->session->userdata('invoice');
        }
        else{
            $this->params['session_name'] = $this->session->userdata('username');  
            $this->params['session_mail'] = $this->session->userdata('email'); 
            $this->params['session_invoice'] = $this->session->userdata('invoice_no'); 
        }
                    
        }
        // $this->params['all_cart'] = $this->Cart->result((array('conditions'=>array('id'=>$crt_id))));
               
                   
    }

    public function place_order() {

        $this->layout = FALSE;          
        $crt_id = unserialize($_COOKIE['cart_cookie']); 
        $this->template = FALSE;
        
        //cookie        
        ///if Empty       
        //if ! empty        
            //$crt_id loop
                //if check already booked or not
                    //booked message exit with msg
                    
        if(!empty($crt_id)){
            $cart_err_validate = array();
           $prodTable = $this->db->dbprefix . 'products';
            $cartTable = $this->db->dbprefix . 'cart';
            $cartIdStr = implode(',', $crt_id);
            $for_order1 = $this->params['all_cart'] = $this->Cart->query("SELECT * FROM $cartTable as cart LEFT JOIN $prodTable as product ON cart.p_id = product.id WHERE cart.cart_id IN($cartIdStr) GROUP BY cart.cart_id ORDER BY cart.cart_id DESC")->result() ; 
            foreach ($for_order1 as $order) {
               $cart_id = $order->cart_id;
               $bin_quantity = $order->p_bin_quantity;
               $available_bin = $order->p_available_bin;
               //if available
               if($available_bin <= $bin_quantity && $available_bin > 0){

               }
               else{
                   $cart_err_validate[$cart_id] = 'Not Available';
               }
              
            }
            if(!empty($cart_err_validate)){
                exit(json_encode(array('status'=>false,'msg'=>'error', 'cart_error'=>$cart_err_validate)));  
            }
            
        }         
          
// --------  insert into transaction table --------------
          $cartTable = $this->db->dbprefix . 'cart';
          $matches = implode(',', $crt_id);      
          $amount= $this->db->query(" SELECT SUM(price) as amount from $cartTable where cart_id IN ($matches)")->row();
          $t_amount = $amount->amount;
        
          $transaction_type = $this->ahrform->get('transaction_type');
          if($this->session->userdata('group_id')==2){
              $get_user_id  = $this->session->userdata('user_id');
              $get_user_name  = $this->session->userdata('user_name');
              $get_invoice_no  = $this->session->userdata('invoice');
          }
          else{
              $get_user_id  = $this->session->userdata('userid');
              $get_user_name  = $this->session->userdata('username');
              $get_invoice_no  = $this->session->userdata('invoice_no');
          }
          
          $this->Transaction->set('user_id', $get_user_id);
          $this->Transaction->set('invoice_no', $get_invoice_no);
          $this->Transaction->set('customer_name', $get_user_name);
          $this->Transaction->set('transaction_type', $transaction_type);
          $this->Transaction->set('total_amount', $t_amount);
          
          $this->Transaction->save();
          $get_trans_id = $this->Transaction->id;

        // --------  insert into order table --------------     

        $crt_id = unserialize($_COOKIE['cart_cookie']);
        if (!empty($crt_id)) {
            $prodTable = $this->db->dbprefix . 'products';
            $cartTable = $this->db->dbprefix . 'cart';
            $cartIdStr = implode(',', $crt_id);
            $for_order = $this->params['all_cart'] = $this->Cart->query("SELECT * FROM $cartTable as cart LEFT JOIN $prodTable as product ON cart.p_id = product.id WHERE cart.cart_id IN($cartIdStr) GROUP BY cart.cart_id ORDER BY cart.cart_id DESC")->result() ;
//            $get_user_id  = $this->User->id;
            $order_date = date('Y-m-d H:i:s');
           foreach ($for_order as $order) {
               $today_saveAll[] = array(
                   'cart_id' => $order->cart_id,
                   'p_id' => $order->p_id,
                   'p_type' => $order->p_type,
                   'tyre_removal' => $order->tyre_removal,
                   'mattress_removal' => $order->mattress_removal,
                   'gas_bottle' => $order->gas_bottle,
                   'tv_monitor' => $order->tv_monitor,
                   'delivery_date' => $order->delivery_date,
                   'extra_day' => $order->extra_day,
                   'collection_date' => $order->collection_date,
                   'bin_placement' => $order->bin_placement,
                   'total_amount' => $order->price
               );
               $this->Order->set('user_id' , $get_user_id);
               $this->Order->set('cart_id' , $order->cart_id);
               $this->Order->set('p_id', $order->p_id);
               $this->Order->set('p_type', $order->p_type);
               $this->Order->set('tyre_removal', $order->tyre_removal);
               $this->Order->set('mattress_removal', $order->mattress_removal);
               $this->Order->set('gas_bottle', $order->gas_bottle);
               $this->Order->set('tv_monitor', $order->tv_monitor);
               $this->Order->set('delivery_date', $order->delivery_date);
               $this->Order->set('extra_day', $order->extra_day);
               $this->Order->set('collection_date', $order->collection_date);
               $this->Order->set('bin_placement', $order->bin_placement);
               $this->Order->set('total_amount', $order->price);
               $this->Order->set('order_date', $order_date);
               $this->Order->save(null, False);
               $order_id = $this->Order->id;

//      -----insert into order transaction relation table-------- 
               $this->Relation->set('transaction_id' , $get_trans_id);
               $this->Relation->set('order_id' , $order_id);
               $this->Relation->save(null, False);

                unset($this->Order->id);
                unset($this->Relation->id);
                
                //check hte availability of bin and update in products table     
               $product_id = $order->id;
               $bin_quantity = $order->p_bin_quantity;
               $available_bin = $order->p_available_bin;
               
               if($available_bin <= $bin_quantity && $available_bin > 0){
                   $available = $bin_quantity - 1 ;
                         $data = array(
                       'p_available_bin' => $available
                        );

                    $this->db->where('id', $product_id);
                    $this->db->update($prodTable, $data);

               }
               else{
                   $available = 0 ;
                         $data = array(
                       'p_available_bin' => $available
                        );

                    $this->db->where('id', $product_id);
                    $this->db->update($prodTable, $data);
               }
            }
        }
        $sess_array = array(
                        'userid' => '',
                        'username' => '',
                        'email' => '',
                        'invoice_no' => ''
                        );
        $this->session->unset_userdata($sess_array);
        
        $crt_cookie = serialize(array());
        $_COOKIE['cart_cookie'] = $crt_cookie;
        
        $get_trans_details = $this->Transaction->row(array('conditions'=>array('id'=>$get_trans_id))); 
        $user_id= $get_trans_details->user_id;
        $get_user = $this->User->row(array('conditions'=>array('id'=>$user_id)));
        $get_user_mail = $get_user->email;
        
//        $this->params['trans_id'] = $get_trans_details->id ;    
         $this->params['invoice_no'] = $get_trans_details->invoice_no; 
         $get_invoice = $get_trans_details->invoice_no; 
        
        $link = site_url('checkout/print_order').'/'.$get_invoice;

     //sent mail to user      
    $to = $get_user_mail;
    $subject = "Your Order is Successfully Completed";

    $message = '<html>
    <head>
    <title>HTML email</title>
    </head>
    <body>
    Your Order is Successfully Completed.Your invoice number is '.$get_invoice.'. You can print your order list from the given link '.$link.'
    </body>
    </html>';

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // More headers
    $headers .= 'From: <skips@beaudesertareaskipbinhire.com>' . "\r\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";

    @mail($to,$subject,$message,$headers);
    //sent mail to admin
    $to = 'dk@beaudesertareaskipbinhire.com';
    $subject = "Successful Order Notification";
    $message = '<html>
    <head>
    <title>HTML email</title>
    </head>
    <body>
    An Order is Successfully Completed in your site.The order invoice number is '.$get_invoice.'. You can see and print the order list from the given link '.$link.'
    </body>
    </html>';
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // More headers
    $headers .= 'From: <skips@beaudesertareaskipbinhire.com>' . "\r\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";

    @mail($to,$subject,$message,$headers);


        exit(json_encode(array('status' => true, 'msg' => 'success', 'cart_cookie' => $crt_cookie, 'transaction_type' => $transaction_type,'transaction_id'=>$get_trans_id ,'invoice_id'=>$get_invoice_no)));
    }
    
    public function print_order($invoice_number) {
        $this->load->helper('pdf_helper');
         $this->title_for_layout = 'Print Order';
         
         $test = $this->params['transactions'] = $this->Transaction->row(array('conditions'=>array('invoice_no'=>$invoice_number)));
         $get_t_id = $test->id;
         $get_invoice = $test->invoice_no;
         $link = site_url('checkout/print_order').'/'.$get_invoice;
         $get_user_id = $test->user_id;
         $this->params['user'] = $this->User->row(array('conditions'=>array('id'=>$get_user_id)));
         $get_user_mail = $this->params['user']->email;
         
         $for_order_id =$this->params['trans_rel'] = $this->Relation->result(array('conditions'=>array('transaction_id'=>$get_t_id)));
         $ord = array();
         foreach ($for_order_id as $trans_rel) {
             $ord[] = $trans_rel->order_id;
         }
         $ordS = implode(',', $ord);
         $orderTable = $this->db->dbprefix . 'order';
         $productTable = $this->db->dbprefix . 'products';

         $for_pro_id = $this->params['all_order'] = $this->db->query("select o.*, p.p_title as product_title from $orderTable as o LEFT JOIN $productTable as p ON p.id = o.p_id  where o.id IN($ordS) GROUP BY o.id")->result();
//         $pro = array();
//         foreach ($for_pro_id as $pro_details) {
//             $pro[] = $pro_details->p_id;
//         }
//         $this->params['all_product'] = $this->db->query("select * from wb_users where id=$pro")->result();
//         
//         pr($this->params['all_product']);
//         exit();
         
                 
    }

    ///--------------- paypal test-------------------

    function infotuts_ipn($im_debut_ipn) {

        define('SSL_P_URL', 'https://www.paypal.com/cgi-bin/webscr');
        define('SSL_SAND_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
        $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        if (!preg_match('/paypal\.com$/', $hostname)) {
            $ipn_status = 'Validation post isn\'t from PayPal';
            if ($im_debut_ipn == true) {
                // mail test
            }

            return false;
        }

        // parse the paypal URL
        $paypal_url = ($_REQUEST['test_ipn'] == 1) ? SSL_SAND_URL : SSL_P_URL;
        $url_parsed = parse_url($paypal_url);

        $post_string = '';
        foreach ($_REQUEST as $field => $value) {
            $post_string .= $field . '=' . urlencode(stripslashes($value)) . '&';
        }
        $post_string.="cmd=_notify-validate"; // append ipn command
        // get the correct paypal url to post request to
        $paypal_mode_status = $im_debut_ipn; //get_option('im_sabdbox_mode');
        if ($paypal_mode_status == true)
            $fp = fsockopen('ssl://www.sandbox.paypal.com', "443", $err_num, $err_str, 60);
        else
            $fp = fsockopen('ssl://www.paypal.com', "443", $err_num, $err_str, 60);

        $ipn_response = '';

        if (!$fp) {
// could not open the connection.  If loggin is on, the error message
// will be in the log.
            $ipn_status = "fsockopen error no. $err_num: $err_str";
            if ($im_debut_ipn == true) {
                echo 'fsockopen fail';
            }
            return false;
        } else {
// Post the data back to paypal
            fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n");
            fputs($fp, "Host: $url_parsed[host]\r\n");
            fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
            fputs($fp, "Content-length: " . strlen($post_string) . "\r\n");
            fputs($fp, "Connection: close\r\n\r\n");
            fputs($fp, $post_string . "\r\n\r\n");

// loop through the response from the server and append to variable
            while (!feof($fp)) {
                $ipn_response .= fgets($fp, 1024);
            }
            fclose($fp); // close connection
        }

// Invalid IPN transaction.  Check the $ipn_status and log for details.
        if (!preg_match("/VERIFIED/s", $ipn_response)) {
            $ipn_status = 'IPN Validation Failed';

            if ($im_debut_ipn == true) {
                echo 'Validation fail';
                print_r($_REQUEST);
            }
            return false;
        } else {
            $ipn_status = "IPN VERIFIED";
            if ($im_debut_ipn == true) {
                echo 'SUCCESS';
            }

            return true;
        }
    }

    function ipn_response() {
        $request = $_REQUEST;
        mail("dk@beaudesertareaskipbinhire.com", "Paypal", print_r($request, true));
        $im_debut_ipn = true;
        if ($this->infotuts_ipn($im_debut_ipn)) {

            // if paypal sends a response code back let's handle it        
            if ($im_debut_ipn == true) {
                $sub = 'PayPal IPN Debug Email Main';
                $msg = print_r($request, true);
                $aname = 'infotuts';
                //mail send
            }

            // process the membership since paypal gave us a valid +
            $this->insert_data($request);
        }
    }

    function issetCheck($post, $key) {
        if (isset($post[$key])) {
            $return = $post[$key];
        } else {
            $return = '';
        }
        return $return;
    }

    function insert_data($request) {
        //require_once('dbconnect.php');


        $post = $request;
        $item_name = $this->issetCheck($post, 'item_name');
        $amount = $this->issetCheck($post, 'mc_gross');
        $currency = $this->issetCheck($post, 'mc_currency');
        $payer_email = $this->issetCheck($post, 'payer_email');
        $first_name = $this->issetCheck($post, 'first_name');
        $last_name = $this->issetCheck($post, 'last_name');
        $country = $this->issetCheck($post, 'residence_country');
        $txn_id = $this->issetCheck($post, 'txn_id');
        $txn_type = $this->issetCheck($post, 'txn_type');
        $payment_status = $this->issetCheck($post, 'payment_status');
        $payment_type = $this->issetCheck($post, 'payment_type');
        $payer_id = $this->issetCheck($post, 'payer_id');
        $create_date = date('Y-m-d H:i:s');
        $payment_date = date('Y-m-d H:i:s');
       // print_r($request);

//$fname = $this->ahrform->get('fname');
//          $lname = $this->ahrform->get('lname');
//          $username = $this->ahrform->get('fname').' '.$this->ahrform->get('lname');
//          $company_name = $this->ahrform->get('company_name');
//          $address = $this->ahrform->get('address');
//          $city = $this->ahrform->get('city');
//          $state = $this->ahrform->get('state');
//          $postcode = $this->ahrform->get('postcode');
//          $email = $this->ahrform->get('email');
//          $phone = $this->ahrform->get('phone');
$request = (object) $request;
        $this->Paypal->set('item_name', $request->item_name);
        $this->Paypal->set('amount', $request->payment_gross);
        $this->Paypal->set('payment_fee', $request->payment_fee);
        $this->Paypal->set('currency', $request->mc_currency);
        $this->Paypal->set('payer_email', $request->payer_email);
        $this->Paypal->set('first_name', $request->first_name);
        $this->Paypal->set('last_name', $request->last_name);
        $this->Paypal->set('country', $request->residence_country);
        $this->Paypal->set('txn_id', $request->txn_id);

        $this->Paypal->set('txn_type', $request->txn_type);
        $this->Paypal->set('payment_status', $request->payment_status);
        $this->Paypal->set('payment_type', $request->payment_type);
        $this->Paypal->set('payer_id', $request->payer_id);
        $this->Paypal->set('create_date', $create_date);
        $this->Paypal->set('payment_date', $payment_date);
        $this->Paypal->set('transaction_id', $request->custom);

//print_r($request);
//exit();
        $this->Paypal->save();
       $get_t_id =  $this->Paypal->transaction_id;
        $data = array(
               'status' => 1
            );

$this->db->where('id', $get_t_id);
$this->db->update('Transaction', $data);
//mysqli_query($con,"INSERT INTO infotuts_transection_tbl (item_name,payer_email,first_name,last_name,amount,currency,country,txn_id,txn_type,payer_id,payment_status,payment_type,create_date,payment_date) 
//VALUES ('$item_name','$payer_email','$first_name','$last_name','$amount','$currency','$country','$txn_id','$txn_type','$payer_id','$payment_status','$payment_type','$create_date','$payment_date')");
//mysqli_close($con);
    }

}