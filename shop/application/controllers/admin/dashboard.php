<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->ahruser->Admin('RequireAccess');
        $this->load->model('user_model', 'User');
        $this->load->model('products_model', 'Products');
        $this->load->model('order_model', 'order');
        $this->load->model('transaction_model', 'transaction');
        $this->load->model('tran_rel', 'Relation');
    }

    public function index() {
        $this->title_for_layout = $this->params['hTitle'] = 'Dashboard';

        
        $this->params['users'] = $this->User->result(array(
            'conditions' => array('group_id!=1'),
            'order' => array('id' => "DESC"),
            'limit' => 10));
       
            $this->title_for_layout = $this->params['hTitle'] = 'Orders In Cash';
            $orderTable = $this->db->dbprefix . 'order';
            $transactionTable=$this->db->dbprefix . 'transaction';
            $tranRelTable=$this->db->dbprefix . 'order_trans_rel';
            
            
            $result3 = $this->db->query(" SELECT * FROM $transactionTable                                  
                   JOIN $tranRelTable ON $transactionTable.id =$tranRelTable.transaction_id  
                 LEFT JOIN $orderTable as o ON o.id =  $tranRelTable.order_id 
                GROUP BY $transactionTable.invoice_no desc LIMIT 10 " );
            $this->params['invoice'] = $result3->result();
            
         foreach ($this->params['invoice'] as $i => $product) {
//             pr($product->p_id);
             $product->transaction_id;
             $prd = array();
             $titleQStr = $this->db->query(" SELECT o.p_id  as product_id  FROM wb_order as o, wb_order_trans_rel as otr  WHERE otr.order_id = o.id AND otr.transaction_id = '$product->transaction_id'  ")->result();
             foreach ($titleQStr as $titleQ) {
                 $prd[] = $titleQ->product_id;
             }
//             pr($prd);
             
                    $ptitles = $this->Products->get_list(array('conditions' => array('id'=> $prd), 'fields' => array('id', 'p_title')));
//                   pr($ptitles);
                     $this->params['invoice'][$i]->product_titles = empty($ptitles) ? '' : implode(',<br/>', $ptitles);
//                    $ss = $this->Products->get_list(array('conditions' => array('id'=> $product->p_id), 'fields' => array('id', 'p_title')));
//             pr($ss);
//             $pord[] = $products->p_id;
         }
//         
//         pr($this->params['invoice']);
//         exit();

         
         
         
//        pr($this->params['invoice']);
        
        
// $test = $this->params['transactions'] = $this->transaction->row();
//
//         $get_t_id = $test->id;
//
//
//$for_order_id = $this->params['tran_rel'] = $this->Relation->result(array('conditions'=>array('transaction_id'=>$get_t_id)));
//pr($for_order_id);
//exit();
//$ord = array();
//         foreach ($for_order_id as $trans_rel) {
//             $ord[] = $trans_rel->order_id;
//         }
//         $ordS = implode(',', $ord);
//
//         
//         $orderTable = $this->db->dbprefix . 'order';
//         $productTable = $this->db->dbprefix . 'products';
//         //         $for_pro_id = 
//         $this->params['all_order'] = $this->db->query("select o.*, p.p_title as product_title from $orderTable as o LEFT JOIN $productTable as p ON p.id = o.p_id  where o.id IN($ordS) GROUP BY o.id")->result();
//       pr($this->params['all_order']);
//exit();
        
        $this->params['order'] = $this->order->result(array(
            'conditions' => array(),
            'order' => array('id' => "DESC"),
            'limit' => 10));
        $this->params['transactions'] = $this->transaction->result(array(
            'conditions' => array(),
            'order' => array('id' => "DESC"),
            'limit' => 10));
        
        
        
        
    }

}