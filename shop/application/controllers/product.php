<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends My_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'User');
        $this->load->model('products_model', 'Product');
	$this->load->model('type_model', 'Type');
	$this->load->model('product_settings_model', 'Common');  
        $this->load->model('cart_model', 'Cart');
        $this->load->model('zone_postcodes', 'Postcode');
        $this->load->model('bin_prices', 'Bin');
        
//        $this->load->model('order_model', 'Order');		
//	$this->load->model('transaction_model','Transaction');
    }

    public function index() {

        $this->layout = "index";
        $this->title_for_layout = 'Product';
        $this->params['TNActive'] = 'TNHome'; //active top menu;
        $pro_table = $this->db->dbprefix . 'products';
//        $this->params['products'] = $this->Product->result(array('order'=>array('p_title' => "ASC")));
        $this->params['products'] = $this->db->query("select * from $pro_table order by cast(p_title as decimal(38,10))")->result();
//            pr($this->params['products']);
              
    }
    
    public function product_details($p_id){
        $this->title_for_layout = 'Product';
        //$product_id = $this->ahrform->get('p_id');
        $binPrice = $this->db->dbprefix . 'bin_prices';
        $prodType = $this->db->dbprefix . 'product_type';
        
        $this->params['product_details'] = $this->Product->result(array('conditions'=>array('id'=>$p_id)));
        
//        $this->params['product_type'] = $this->Type->result(array('conditions'=>array('product_id'=>$p_id)));
      $this->params['product_type'] = $this->db->query("select o.*, p.p_type_title as product_type from $binPrice as o LEFT JOIN $prodType as p ON p.id = o.product_type_id  where o.product_id=$p_id GROUP BY o.id")->result();
//pr($this->params['product_type']) ;
//exit();
// $this->params['product_type'] = $this->Type->result(array('conditions'=>array('product_id'=>$p_id)));
        
        
        $this->params['common_settings'] = $this->Common->result(array('order'=>array('quantity'=>"ASC")));
        $this->params['all_postcodes'] = $this->Postcode->result(array('order'=>array('postcode' => "ASC")));

    }
    
     public function waste_type_details(){
          $this->layout = FALSE;
          $id= $this->ahrform->get('id');
          if($id==NULL){
              exit();
          }
          else{
            $this->params['product_type'] = $this->Type->row(array('conditions'=>array('id'=>$id)));
          }
        }   
     public function add_to_cart(){
          $this->layout = FALSE;
          $p_id = $this->ahrform->get('p_id');
          $postcode = $this->ahrform->get('postcode');
          $waste_type = $this->ahrform->get('waste_type');
          $tyre_removal = $this->ahrform->get('t_removal');
          $mattress_removal = $this->ahrform->get('m_removal');
          $gas_bottle = $this->ahrform->get('g_bottle');
          $tv_monitor = $this->ahrform->get('t_monitor');
          $delivery_date = $this->ahrform->get('d_date');
          $extra_day = $this->ahrform->get('xtra_day');
          $collection_date = $this->ahrform->get('c_date');
          $bin_placement = $this->ahrform->get('b_placement');
          $price  = $this->ahrform->get('total');
          
          $orderTable = $this->db->dbprefix . 'order';
         // $count_product = $this->db->query("SELECT COUNT(p_id) as product from $orderTable where p_id =$p_id AND (delivery_date BETWEEN '$delivery_date' AND '$collection_date')")->row();
          $count_product = $this->Product->row(array('conditions'=>array('id'=>$p_id)));
          $bin_quantity = $count_product->p_bin_quantity;
          $available_bin = $count_product->p_available_bin;
          
          if($available_bin <= $bin_quantity && $available_bin > 0){
              $this->Cart->set('p_id', $p_id);          
              $this->Cart->set('postcode', $postcode);
              $this->Cart->set('p_type', $waste_type);
              $this->Cart->set('tyre_removal', $tyre_removal);
              $this->Cart->set('mattress_removal', $mattress_removal);
              $this->Cart->set('gas_bottle', $gas_bottle);
              $this->Cart->set('tv_monitor', $tv_monitor);
              $this->Cart->set('delivery_date', $delivery_date);
              $this->Cart->set('extra_day', $extra_day);
              $this->Cart->set('collection_date', $collection_date);
              $this->Cart->set('bin_placement', $bin_placement);
              $this->Cart->set('price', $price);

              $this->Cart->save();

              $get_id = $this->Cart->id;
              $get_postcode = $this->Cart->postcode;
              $data = array(
                    'postcode' => $get_postcode
                    );
               $this->session->set_userdata($data);
               
              $cart_cookie = array();
              if(empty($_COOKIE['cart_cookie'])){

              $cart_cookie = array($get_id);
              }  else {
                  $e_cart_cookie = empty($_COOKIE['cart_cookie']) ? array() : unserialize($_COOKIE['cart_cookie']);
                  if(!empty($e_cart_cookie) && is_array($e_cart_cookie)){
                      $cart_cookie = $e_cart_cookie;
                      $cart_cookie[] = $get_id;
                  }            
              }
              $cart_cookie_id = $cart_cookie;
              $cart_cookie = array_unique($cart_cookie);
              $_COOKIE['cart_cookie'] = serialize($cart_cookie);

              exit(json_encode(array('cart_id'=>$cart_cookie_id,'status'=>true,'msg'=>'success','cart_cookie'=> $_COOKIE['cart_cookie'])));

          }
          else {
              exit(json_encode(array('status'=>false,'msg'=>'error')));
          }
          
        }   
    
}