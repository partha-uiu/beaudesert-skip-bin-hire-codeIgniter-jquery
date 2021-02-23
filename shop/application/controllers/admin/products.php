<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->ahruser->Admin('RequireAccess');
        $this->load->model('user_model', 'User');
        $this->load->model('products_model', 'Products');
        $this->load->model('product_type_model', 'ProductType');
        $this->load->model('product_settings_model', 'CommonSettings');
        $this->load->model('order_model', 'order');
        $this->load->model('order_transaction_rel', 'order_trans_rel');
        $this->load->model('paypal_model', 'paypal_tbl');

        $this->load->model('zone_postcodes', 'Postcode');
        $this->load->model('bin_prices', 'Bin');
        $this->load->model('transaction_model', 'Transaction');
    }

    public function products_add($id = NULL) {
        $this->title_for_layout = $this->params['hTitle'] = 'Add  Products';
        $this->params['index'] = $id;

        if (isset($_POST['data']) || (!empty($id))) {
            $this->title_for_layout = $this->params['hTitle'] = (empty($id) ? 'Add' : 'Edit') . ' Products';
            $validationsRoles = array(
                array(
                    'field' => 'p_title',
                    'label' => 'Product title',
                    'rules' => 'required',
                    'field' => 'p_price',
                    'label' => 'Product price',
                    'rules' => 'number'
                )
            );

            if ($validate = $this->Products->load_input_value()->validate($validationsRoles)) {
                $date = date("Y_m_d_H_i_s");
                /* ------------------Start Image Upload App Icon---------------- */
                $config['upload_path'] = 'assets/uploads/';
                //print_r($config);
                $config['allowed_types'] = 'gif|jpg|png|ogg|ico';
                $config['file_name'] = $this->ahrform->get('image') . '_' . $date;
                $error = '';
                $udata = '';
                $this->load->library('upload');
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $udata = array('upload_data' => $this->upload->data());
//                    $app_icon = $config['upload_path'] . $udata['upload_data']['file_name'];
                    $p_image = site_url() . "assets/uploads/" . $udata['upload_data']['file_name'];
//                    $this->Products->set('image', //$app_icon);
                    $this->Products->set('p_image_url', $p_image);
                }


                if (empty($id)) {
                    $this->Products->created_date = $date;
                    $this->Products->modified_date = $date;
                } else {
                    $this->Products->modified_date = $date;
                }

                if ($this->Products->save(NULL, false)) {

                    $id = $this->Products->id;

                    $this->ahrsession->set_flash('Informations has been ' . (empty($_POST['id']) ? 'created' : 'updated') . ' successfully.', 'default', array(), 'success');

//                    $this->params['items'] = $this->ProductsCommon->result(array('conditions' => array(), 'order' => array('product_list' => "ASC")));

                    redirect(site_url(CPREFIX . '/products/product_list/'));
                } else {
                    $this->ahrsession->set_flash('Informations could not saved. Please try again.', 'default', array(), 'warning');
                }
            }

            if (!empty($id)) {
                $this->ahrform->set($this->Products->row($id));
            }
            //$this->params['Prents'] = $this->ProductsCommon->get_list(array('conditions' => array('parent_id' => 0), 'fields' => array('id')));
        }

//        $this->params['items'] = $this->Products->result(array('conditions' => array(), 'order' => array('p_title' => "ASC")));
    }
        public function bin_add($id = NULL) {
        $this->title_for_layout = $this->params['hTitle'] = 'Add  Bins';
        $this->params['index'] = $id;

        if (isset($_POST['data']) || (!empty($id))) {
            $this->title_for_layout = $this->params['hTitle'] = (empty($id) ? 'Add' : 'Edit') . ' Bins';
            $validationsRoles = array(
                array(
                    'field' => 'p_title',
                    'label' => 'Product title',
                    'rules' => 'required',
                    'field' => 'p_price',
                    'label' => 'Product price',
                    'rules' => 'number'
                )
            );

            if ($validate = $this->Products->load_input_value()->validate($validationsRoles)) {
                $date = date("Y_m_d_H_i_s");


                if (empty($id)) {
                    $this->Products->created_date = $date;
                    $this->Products->modified_date = $date;
                } else {
                    $this->Products->modified_date = $date;
                }

                if ($this->Products->save(NULL, false)) {

                    $id = $this->Products->id;

                    $this->ahrsession->set_flash('Informations has been ' . (empty($_POST['id']) ? 'created' : 'updated') . ' successfully.', 'default', array(), 'success');

//                    $this->params['items'] = $this->ProductsCommon->result(array('conditions' => array(), 'order' => array('product_list' => "ASC")));

                    redirect(site_url(CPREFIX . '/products/available_bins/'));
                } else {
                    $this->ahrsession->set_flash('Informations could not saved. Please try again.', 'default', array(), 'warning');
                }
            }

            if (!empty($id)) {
                $this->ahrform->set($this->Products->row($id));
            }
            //$this->params['Prents'] = $this->ProductsCommon->get_list(array('conditions' => array('parent_id' => 0), 'fields' => array('id')));
        }

//        $this->params['items'] = $this->Products->result(array('conditions' => array(), 'order' => array('p_title' => "ASC")));
    }
            
  
    public function product_type($id = NULL) {
        $this->title_for_layout = $this->params['hTitle'] = 'Product Waste ';
        $this->params['index'] = $id;


        if (isset($_POST['data']) || (!empty($id))) {
            $this->title_for_layout = $this->params['hTitle'] = (empty($id) ? 'Add' : 'Edit') . ' Products';
            $validationsRoles = array(
                array(
                    'field' => 'p_type_title',
                    'label' => 'Product Type Name',
                    'rules' => 'required'
                )
            );

            if ($validate = $this->ProductType->load_input_value()->validate($validationsRoles)) {
                $date = date("Y_m_d_H_i_s");

                if (empty($id)) {
                    $this->ProductType->created_date = $date;
                    $this->ProductType->modified_date = $date;
                } else {
                    $this->ProductType->modified_date = $date;
                }
                if ($this->ProductType->save(NULL, false)) {

                    $id = $this->ProductType->id;
                    $this->ahrsession->set_flash('Informations has been ' . (empty($_POST['id']) ? 'created' : 'updated') . ' successfully.', 'default', array(), 'success');

//                    $this->params['items'] = $this->ProductsCommon->result(array('conditions' => array(), 'order' => array('product_list' => "ASC")));

                    redirect(site_url(CPREFIX . '/products/product_type_list/'));
                } else {
                    $this->ahrsession->set_flash('Informations could not saved. Please try again.', 'default', array(), 'warning');
                }
            }

            if (!empty($id)) {
                $this->ahrform->set($this->ProductType->row($id));
            }
            //$this->params['Prents'] = $this->ProductsCommon->get_list(array('conditions' => array('parent_id' => 0), 'fields' => array('id')));
        }

        $this->params['itemsProduct'] = $this->Products->result(array('conditions' => array(), 'order' => array('p_title' => "ASC")));
        $this->params['product_list'] = $this->Products->get_list(array('conditions' => array(), 'order' => array('p_title' => "ASC"), 'fields' => array('id', 'p_title')));
    }                  

    public function product_settings($id = NULL) {
        $this->title_for_layout = $this->params['hTitle'] = 'Product Settings';
        $this->params['index'] = $id;
        if (isset($_POST['data']) || (!empty($id))) {
            $this->title_for_layout = $this->params['hTitle'] = (empty($id) ? 'Add' : 'Edit') . ' Products';
            $validationsRoles = array(
                array(
                    'field' => 'title',
                    'label' => 'Product title',
                    'rules' => 'required'
                )
            );

            if ($validate = $this->CommonSettings->load_input_value()->validate($validationsRoles)) {
                $date = date("Y_m_d_H_i_s");


                if (empty($id)) {
                    $this->CommonSettings->created_date = $date;
                    $this->CommonSettings->modified_date = $date;
                } else {
                    $this->CommonSettings->modified_date = $date;
                }
                if ($this->CommonSettings->save(NULL, false)) {


                    $id = $this->CommonSettings->id;
                    $this->ahrsession->set_flash('Informations has been ' . (empty($_POST['id']) ? 'created' : 'updated') . ' successfully.', 'default', array(), 'success');

//                    $this->params['items'] = $this->ProductsCommon->result(array('conditions' => array(), 'order' => array('product_list' => "ASC")));

                    redirect(site_url(CPREFIX . '/products/product_settings_list/'));
                } else {
                    $this->ahrsession->set_flash('Informations could not saved. Please try again.', 'default', array(), 'warning');
                }
            }

            if (!empty($id)) {
                $this->ahrform->set($this->CommonSettings->row($id));
            }
            //$this->params['Prents'] = $this->ProductsCommon->get_list(array('conditions' => array('parent_id' => 0), 'fields' => array('id')));
        }

//        $this->params['items'] = $this->CommonSettings->result(array('conditions' => array(), 'order' => array('id' => "ASC")));
    }

    public function product_list($id = NULL) {
        $this->title_for_layout = $this->params['hTitle'] = 'Product List';
        $this->params['index'] = $id;
        $this->params['items'] = $this->Products->result(array('conditions' => array(), 'order' => array('p_title' => "ASC")));
       }
 public function available_bins() {
        $this->title_for_layout = $this->params['hTitle'] = 'Available Bins';
        $this->params['items'] =  $this->Products->result(array('conditions' => array(), 'order' => array('p_title' => "ASC")));
       
    }
    public function product_type_list() {
        $this->title_for_layout = $this->params['hTitle'] = 'Product Waste Type List';
        $this->params['items'] = $this->ProductType->result(array('conditions' => array(), 'order' => array('p_type_title' => "ASC")));
    }

    public function product_settings_list() {
        $this->title_for_layout = $this->params['hTitle'] = 'Product Settings List';
        $this->params['items'] = $this->CommonSettings->result(array('conditions' => array(), 'order' => array('title' => "ASC")));
    }

    public function order_cash() {
        $this->title_for_layout = $this->params['hTitle'] = 'Orders In Cash';
            $orderTable = $this->db->dbprefix . 'order';
            $transactionTable=$this->db->dbprefix . 'transaction';
            $tranRelTable=$this->db->dbprefix . 'order_trans_rel';
//            $result3 = $this->db->query(" SELECT * FROM $transactionTable 
//
//                                 
//                JOIN $tranRelTable ON $transactionTable.id =$tranRelTable.transaction_id AND $transactionTable.transaction_type='cash' 
//                LEFT JOIN $orderTable as o ON o.id =  $tranRelTable.order_id 
//                GROUP BY $transactionTable.invoice_no");
            $result3 = $this->db->query(" SELECT * FROM $orderTable 
                              
                JOIN $tranRelTable ON $orderTable.id =$tranRelTable.order_id  
                LEFT JOIN $transactionTable  ON $transactionTable.id =  $tranRelTable.transaction_id AND $transactionTable.transaction_type='Cash'
                GROUP BY $transactionTable.invoice_no");

         $this->params['invoice'] = $result3->result();
//         pr($this->params['invoice']);
//         exit();
      
    }

    public function order_paypal() {
            $this->title_for_layout = $this->params['hTitle'] = 'Orders In Paypal';
            $orderTable = $this->db->dbprefix . 'order';
            $transactionTable=$this->db->dbprefix . 'transaction';
            $tranRelTable=$this->db->dbprefix . 'order_trans_rel';
            
            
//            $result3 = $this->db->query(" SELECT * FROM $transactionTable 
//
//                                 
//                JOIN $tranRelTable ON $transactionTable.id =$tranRelTable.transaction_id AND $transactionTable.transaction_type='paypal' 
//                LEFT JOIN $orderTable as o ON o.id =  $tranRelTable.order_id 
//                GROUP BY $transactionTable.invoice_no");
           $result3 = $this->db->query(" SELECT * FROM $orderTable 
                              
                JOIN $tranRelTable ON $orderTable.id =$tranRelTable.order_id  
                LEFT JOIN $transactionTable  ON $transactionTable.id =  $tranRelTable.transaction_id AND $transactionTable.transaction_type='Paypal'
                GROUP BY $transactionTable.invoice_no");
         
         

         $this->params['invoice'] = $result3->result();    
    }

    public function order() {
        $this->title_for_layout = $this->params['hTitle'] = 'Order List';


          $products = $this->db->dbprefix('products');
          $users = $this->db->dbprefix('users');
          $order = $this->db->dbprefix('order');

          $this->params['order'] = $this->db->query(" SELECT *, product.id AS p_id, user.id  AS u_id    
                                           FROM $order as o                                     
                 LEFT JOIN  $products as product ON o.p_id = product.id 
                 LEFT JOIN  $users AS user  ON o.user_id = user.id" )->result();
        }


        
    public function order_cash_edit($id=NULL) {
       
            $this->title_for_layout = $this->params['hTitle'] = 'Orders In Cash';
           
            
//           $this->title_for_layout = $this->params['hTitle'] = 'Add Zone Postcode';
        $this->params['index'] = $id;
        if (isset($_POST['data']) || (!empty($id))) {
            $this->title_for_layout = $this->params['hTitle'] = (empty($id) ? 'Add' : 'Edit') . ' Order';
            $validationsRoles = array(
                array(
                    'field' => 'customer_name',
                    'label' => 'Customer Name',
                    'rules' => 'required'
                )
            );

            if ($validate = $this->order->load_input_value()->validate($validationsRoles)) {
                $date = date("Y_m_d_H_i_s");


                if (empty($id)) {
                    $this->order->created_date = $date;
                    $this->order->modified_date = $date;
                } else {
                    $this->order->modified_date = $date;
                }
                $transactionTable = $this->db->dbprefix . 'transaction';
                $customer_name = $this->ahrform->get('customer_name');
                $invoice_number = $this->ahrform->get('invoice_no');
                $total_amount = $this->ahrform->get('total_amount');
                
                $data = array(
                           'customer_name' => $customer_name,
                           'invoice_no' => $invoice_number,
                           'total_amount' => $total_amount
                        );

                $this->db->where('id', $id);
                $this->db->update($transactionTable, $data);
                
                
                if ($this->order->save(NULL, false)) {


                    $id = $this->order->id;
                     $id = $this->Transaction->id;
                    $this->ahrsession->set_flash('Informations has been ' . (empty($_POST['id']) ? 'created' : 'updated') . ' successfully.', 'default', array(), 'success');

//                    $this->params['items'] = $this->ProductsCommon->result(array('conditions' => array(), 'order' => array('product_list' => "ASC")));

                    redirect(site_url(CPREFIX . '/products/order_cash/'));
                } else {
                    $this->ahrsession->set_flash('Informations could not saved. Please try again.', 'default', array(), 'warning');
                }
            }

            if (!empty($id)) {
//                $this->ahrform->set($this->order->row($id));
            $this->ahrform->set($this->Transaction->row($id));
            
             $this->params['invoice1'] = $this->order_trans_rel->row(array('conditions' => array('transaction_id' => $id)));
             $get_order_id = $this->params['invoice1']->order_id;
             $this->ahrform->set($this->order->row($get_order_id));
                             
            } 
            
           
    }
        
         }   
         
     public function order_cash_delete($id = null) {
        $this->layout = FALSE;
        $this->template = FALSE;
        $this->params['invoice1'] = $this->order_trans_rel->row(array('conditions' => array('transaction_id' => $id)));
        $get_order_id = $this->params['invoice1']->order_id;

        $redirect = site_url('/' . CPREFIX . '/products/order_cash');
        $id = $this->ahrform->get('id') ? $this->ahrform->get('id') : $id;

        if (empty($id) && !$this->input->is_ajax_request()) {
            $this->ahrsession->set_flash('Invalid id. Information could not delete. Please try agin', 'default', array(), 'warning');
            redirect($redirect);
        }
        $this->Transaction->deleteAll(array('conditions' => array('id' => $id)));
        $this->order->deleteAll(array('conditions' => array('id' => $get_order_id)));
        if ($this->input->is_ajax_request()) {
            exit(json_encode(array('status' => true, 'msg' => "Information has been deleted")));
        }
        redirect($redirect);
    }
        
    
    public function order_paypal_delete($id = null) {
        $this->layout = FALSE;
        $this->template = FALSE;
        $this->params['invoice1'] = $this->order_trans_rel->row(array('conditions' => array('transaction_id' => $id)));
        $get_order_id = $this->params['invoice1']->order_id;

        $redirect = site_url('/' . CPREFIX . '/products/order_paypal');
        $id = $this->ahrform->get('id') ? $this->ahrform->get('id') : $id;

        if (empty($id) && !$this->input->is_ajax_request()) {
            $this->ahrsession->set_flash('Invalid id. Information could not delete. Please try agin', 'default', array(), 'warning');
            redirect($redirect);
        }
        $this->Transaction->deleteAll(array('conditions' => array('id' => $id)));
        $this->order->deleteAll(array('conditions' => array('id' => $get_order_id)));
        if ($this->input->is_ajax_request()) {
            exit(json_encode(array('status' => true, 'msg' => "Information has been deleted")));
        }
        redirect($redirect);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
       
      public function order_paypal_edit($id = NULL) {
       
            $this->title_for_layout = $this->params['hTitle'] = 'Orders In paypal';
           
            
//           $this->title_for_layout = $this->params['hTitle'] = 'Add Zone Postcode';
        $this->params['index'] = $id;
        if (isset($_POST['data']) || (!empty($id))) {
            $this->title_for_layout = $this->params['hTitle'] = (empty($id) ? 'Add' : 'Edit') . ' Order';
            $validationsRoles = array(
                array(
                    'field' => 'customer_name',
                    'label' => 'Customer Name',
                    'rules' => 'required'
                )
            );

            if ($validate = $this->order->load_input_value()->validate($validationsRoles)) {
                $date = date("Y_m_d_H_i_s");


                if (empty($id)) {
                    $this->order->created_date = $date;
                    $this->order->modified_date = $date;
                } else {
                    $this->order->modified_date = $date;
                }
                $transactionTable = $this->db->dbprefix . 'transaction';
                $customer_name = $this->ahrform->get('customer_name');
                $invoice_number = $this->ahrform->get('invoice_no');
                $total_amount = $this->ahrform->get('total_amount');
                
                $data = array(
                           'customer_name' => $customer_name,
                           'invoice_no' => $invoice_number,
                           'total_amount' => $total_amount
                        );

                $this->db->where('id', $id);
                $this->db->update($transactionTable, $data);
                
                
                if ($this->order->save(NULL, false)) {


                    $id = $this->order->id;
                     $id = $this->Transaction->id;
                    $this->ahrsession->set_flash('Informations has been ' . (empty($_POST['id']) ? 'created' : 'updated') . ' successfully.', 'default', array(), 'success');

//                    $this->params['items'] = $this->ProductsCommon->result(array('conditions' => array(), 'order' => array('product_list' => "ASC")));

                    redirect(site_url(CPREFIX . '/products/order_paypal/'));
                } else {
                    $this->ahrsession->set_flash('Informations could not saved. Please try again.', 'default', array(), 'warning');
                }
            }

            if (!empty($id)) {
//                $this->ahrform->set($this->order->row($id));
            $this->ahrform->set($this->Transaction->row($id));
            
             $this->params['invoice1'] = $this->order_trans_rel->row(array('conditions' => array('transaction_id' => $id)));
             $get_order_id = $this->params['invoice1']->order_id;
             $this->ahrform->set($this->order->row($get_order_id));
                             
            } 
            
            
            $Oid=$id;
            $orderTable = $this->db->dbprefix . 'order';
            $transactionTable=$this->db->dbprefix . 'transaction';
            $tranRelTable=$this->db->dbprefix . 'order_trans_rel';
//            $result3 = $this->db->query(" SELECT * FROM $orderTable                                 
//                LEFT JOIN $tranRelTable ON $tranRelTable.order_id =$Oid 
//
//
//                ");
            

//            $this->params['invoice'] = $this->order->result(array('conditions' => array('id' => $Oid)));
//            $this->params['invoice1'] = $this->order_trans_rel->row(array('conditions' => array('order_id' => $Oid)));
//            $ab = $this->params['invoice1']->transaction_id;
//            $this->params['invoice2'] = $this->Transaction->row(array('conditions' => array('id' => $ab)));
            
            
//         $this->params['invoice'] = $result3->result();
//         pr($this->params['invoice2']);
//         pr($ab);
//         exit();
    }
        
         }    
            
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
        
        
 public function status() {
     
     $id = $this->ahrform->get('id');
     $value = $this->ahrform->get('value');
      
     $order = $this->db->dbprefix('order');
    $this->db->query(" UPDATE  $order
                         SET delivery_status= $value  
                             WHERE id= $id ");
          exit(json_encode(array('status'=>true,'msg'=>'success')));
 }
 public function change_status_cash($id = NULL) {
     
       $this->title_for_layout = $this->params['hTitle'] = 'Change Delivery Status';
           
       
//       //   //                LEFT JOIN  $transactionTable where $transactionTable.transaction_type='cash'                LEFT JOIN  $transactionTable       as o ON o.id =  $tranRelTable.order_id       $this->title_for_layout = $this->params['hTitle'] = 'Product Waste Type';
        $this->params['index'] = $id;


        if (isset($_POST['data']) || (!empty($id))) {
            $this->title_for_layout = $this->params['hTitle'] = (empty($id) ? 'Add' : 'Edit') . ' Delivery Status';
            $validationsRoles = array(
                array(
                    'field' => 'delivery_status',
                    'label' => 'Delivery Status',
                    'rules' => 'required'
                )
            );

            if ($validate = $this->order->load_input_value()->validate($validationsRoles)) {
                $date = date("Y_m_d_H_i_s");

                if (empty($id)) {
                    $this->order->created_date = $date;
                    $this->order->modified_date = $date;
                } else {
                    $this->order->modified_date = $date;
                }
                if ($this->order->save(NULL, false)) {

                    $id = $this->order->id;
                    $this->ahrsession->set_flash('Informations has been ' . (empty($_POST['id']) ? 'created' : 'updated') . ' successfully.', 'default', array(), 'success');

//                    $this->params['items'] = $this->ProductsCommon->result(array('conditions' => array(), 'order' => array('product_list' => "ASC")));
                    
                    redirect(site_url(CPREFIX . '/products/order_cash/'));
                } else {
                    $this->ahrsession->set_flash('Informations could not saved. Please try again.', 'default', array(), 'warning');
                }
            }

            if (!empty($id)) {
                $this->ahrform->set($this->order->row($id));
            }
            //$this->params['Prents'] = $this->ProductsCommon->get_list(array('conditions' => array('parent_id' => 0), 'fields' => array('id')));
        }
   
       } 
       
       
        public function change_status_paypal($id = NULL) {
     
       $this->title_for_layout = $this->params['hTitle'] = 'Change Delivery Status';
        $this->params['index'] = $id;


        if (isset($_POST['data']) || (!empty($id))) {
            $this->title_for_layout = $this->params['hTitle'] = (empty($id) ? 'Add' : 'Edit') . ' Delivery Status';
            $validationsRoles = array(
                array(
                    'field' => 'delivery_status',
                    'label' => 'Product Type Name',
                    'rules' => 'required'
                )
            );

            if ($validate = $this->order->load_input_value()->validate($validationsRoles)) {
                $date = date("Y_m_d_H_i_s");

                if (empty($id)) {
                    $this->order->created_date = $date;
                    $this->order->modified_date = $date;
                } else {
                    $this->order->modified_date = $date;
                }
                if ($this->order->save(NULL, false)) {

                    $id = $this->order->id;
                    $this->ahrsession->set_flash('Informations has been ' . (empty($_POST['id']) ? 'created' : 'updated') . ' successfully.', 'default', array(), 'success');

//                    $this->params['items'] = $this->ProductsCommon->result(array('conditions' => array(), 'order' => array('product_list' => "ASC")));
                    
                    redirect(site_url(CPREFIX . '/products/order_paypal/'));
                } else {
                    $this->ahrsession->set_flash('Informations could not saved. Please try again.', 'default', array(), 'warning');
                }
            }

            if (!empty($id)) {
                $this->ahrform->set($this->order->row($id));
            }
            //$this->params['Prents'] = $this->ProductsCommon->get_list(array('conditions' => array('parent_id' => 0), 'fields' => array('id')));
        }
   
       } 
       
      
     
     

    public function paypal_list() {
        $this->title_for_layout = $this->params['hTitle'] = 'PayPal';
        $this->params['paypal'] = $this->paypal_tbl->result(array('conditions' => array(), 'order' => array('TID' => "ASC")));
    }



    public function zone_postcode($id = NULL) {
        $this->title_for_layout = $this->params['hTitle'] = 'Add Zone Postcode';
        $this->params['index'] = $id;
        if (isset($_POST['data']) || (!empty($id))) {
            $this->title_for_layout = $this->params['hTitle'] = (empty($id) ? 'Add' : 'Edit') . ' Products';
            $validationsRoles = array(
                array(
                    'field' => 'product_zone',
                    'label' => 'Product Zone',
                    'rules' => 'required'
                )
            );

            if ($validate = $this->Postcode->load_input_value()->validate($validationsRoles)) {
                $date = date("Y_m_d_H_i_s");


                if (empty($id)) {
                    $this->Postcode->created_date = $date;
                    $this->Postcode->modified_date = $date;
                } else {
                    $this->Postcode->modified_date = $date;
                }
                if ($this->Postcode->save(NULL, false)) {


                    $id = $this->Postcode->id;
                    $this->ahrsession->set_flash('Informations has been ' . (empty($_POST['id']) ? 'created' : 'updated') . ' successfully.', 'default', array(), 'success');

//                    $this->params['items'] = $this->ProductsCommon->result(array('conditions' => array(), 'order' => array('product_list' => "ASC")));

                    redirect(site_url(CPREFIX . '/products/zone_postcode_list/'));
                } else {
                    $this->ahrsession->set_flash('Informations could not saved. Please try again.', 'default', array(), 'warning');
                }
            }

            if (!empty($id)) {
                $this->ahrform->set($this->Postcode->row($id));
            }
            //$this->params['Prents'] = $this->ProductsCommon->get_list(array('conditions' => array('parent_id' => 0), 'fields' => array('id')));
        }

//        $this->params['items'] = $this->CommonSettings->result(array('conditions' => array(), 'order' => array('id' => "ASC")));
    }

    public function zone_postcode_list() {
        $this->title_for_layout = $this->params['hTitle'] = 'Product Zone Postcode List';
        $this->params['postcode'] = $this->Postcode->result(array('conditions' => array(), 'order' => array('id' => "ASC")));
    }

    public function bin_price($id = NULL) {
        $this->title_for_layout = $this->params['hTitle'] = 'Add Zone Postcode';
        $this->params['index'] = $id;
        if (isset($_POST['data']) || (!empty($id))) {
            $this->title_for_layout = $this->params['hTitle'] = (empty($id) ? 'Add' : 'Edit') . ' Products';
            $validationsRoles = array(
                array(
                    'field' => 'price',
                    'label' => 'Price',
                    'rules' => 'required'
                )
            );

            if ($validate = $this->Bin->load_input_value()->validate($validationsRoles)) {
                $date = date("Y_m_d_H_i_s");


                if (empty($id)) {
                    $this->Bin->created_date = $date;
                    $this->Bin->modified_date = $date;
                } else {
                    $this->Bin->modified_date = $date;
                }
                if ($this->Bin->save(NULL, false)) {


                    $id = $this->Bin->id;
                    $this->ahrsession->set_flash('Informations has been ' . (empty($_POST['id']) ? 'created' : 'updated') . ' successfully.', 'default', array(), 'success');

//                    $this->params['items'] = $this->ProductsCommon->result(array('conditions' => array(), 'order' => array('product_list' => "ASC")));

                    redirect(site_url(CPREFIX . '/products/bin_price_list/'));
                } else {
                    $this->ahrsession->set_flash('Informations could not saved. Please try again.', 'default', array(), 'warning');
                }
            }

            if (!empty($id)) {
                $this->ahrform->set($this->Bin->row($id));
            }
            //$this->params['Prents'] = $this->ProductsCommon->get_list(array('conditions' => array('parent_id' => 0), 'fields' => array('id')));
        }

        $this->params['itemsProduct'] = $this->Products->result(array('conditions' => array(), 'order' => array('p_title' => "ASC")));
        $this->params['product_list'] = $this->ProductType->get_list(array('conditions' => array(), 'order' => array('p_type_title' => "ASC"), 'fields' => array('id', 'p_type_title')));
        $this->params['product'] = $this->Products->get_list(array('conditions' => array(), 'order' => array('p_title' => "ASC"), 'fields' => array('id', 'p_title')));
        $this->params['product_zone'] = $this->Postcode->get_list(array('conditions' => array(), 'order' => array('product_zone' => "ASC"), 'fields' => array('product_zone', 'product_zone')));

//        $this->params['product_zone'] = $this->Postcode->get_list(array('conditions' => array(), 'order' => array('product_zone' => "ASC"),'fields' => array('product_zone')));
//        $this->params['items'] = $this->CommonSettings->result(array('conditions' => array(), 'order' => array('id' => "ASC")));
    }

    public function bin_price_list() {
        $this->title_for_layout = $this->params['hTitle'] = 'Bin Price List';
        $binPrice = $this->db->dbprefix('bin_prices');
        $productType = $this->db->dbprefix('product_type');
        $products = $this->db->dbprefix('products');
     
//        $this->params['binprice'] = $this->db->query(" SELECT *            
//                FROM $binPrice  LEFT JOIN  $productType as productType
//                ON $binPrice.product_type_id=productType.id
//                LEFT JOIN  $products as products ON $binPrice.product_id = products.id"
//                )->result();
        $this->params['binprice'] = $this->db->query(" SELECT *,$binPrice.id as b_id,$productType.id as p_id       
                FROM $binPrice    JOIN  $productType 
                ON $binPrice.product_type_id=$productType.id 
                LEFT JOIN  $products as products ON $binPrice.product_id = products.id 
                    ORDER BY $binPrice.id DESC  
                  "
                )->result();
//        $this->params['binprice'] = $this->db->query(" SELECT *            
//                FROM $binPrice  LEFT JOIN  $productType as productType
//                ON $binPrice.product_type_id=productType.id")->result();
        //pr($this->params['binprice']);
//        exit();
//        
//        $result3 = $this->db->query(" SELECT * FROM wb_transaction 
////
////                                 
////                   JOIN wb_order_trans_rel
////            
////                 ON wb_transaction.id =wb_order_trans_rel.transaction_id AND wb_transaction.transaction_type='cash'")->result();
////         
////        $this->params['invoice'] = (object) $result3;
        
//        $this->params['binprice'] = $this->Bin->result(array('conditions' => array(), 'order' => array('id' => "ASC")));
//            $price = array();
//                            foreach ($this->params['binprice'] as $binPrice) {
//                                $price[] = $binPrice->product_type_id;                          
//                             }
////                       $this->params['binprice'] = $this->Bin->result(array('conditions' => array(), 'order' => array('id' => "ASC")));
//       
//$priceS = implode(',', $price);
//$this->params['productType'] = $this->ProductType->result(array('conditions' => array('id'=>$price)));

//                    pr($this->params['productType']);
//                    exit();
    }

    function check_sort_order() {
        $response = $this->Category->is_field_exist(array('conditions' => array_filter(array(
                'sort_order' => $this->ahrform->get('sort_order'),
                'id !=' => $this->ahrform->get('id') ? $this->ahrform->get('id') : '',
            ))));

        if ('jquery_validator' == ($requestby = $this->ahrform->get('requestby'))) {
            exit($response ? 'false' : 'true');
        }
        $this->form_validation->set_message('check_sort_order', 'This order already exist.');
        return $response ? false : true;
    }

    public function add($id = null) {

        $this->params['products'] = $this->Product->result(array('conditions' => array(), 'order' => array('name' => "ASC")));
        $this->title_for_layout = $this->params['hTitle'] = (empty($id) ? 'Add' : 'Edit') . ' Campaign';

        //  $this->params['user'] = $this->User->result(array('conditions' => array(), 'order' => array('id' => "DESC"), 'fields' => array('id', 'email as name')));
        $validationsRoles = array();
        if (!$this->ahrform->get('id')) {
            $validationsRoles = array(
                array(
                    'field' => 'title',
                    'label' => 'Title',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'project_slug',
                    'label' => 'Alias URL',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'short_description',
                    'label' => 'Short Description',
                    'rules' => 'required'
                )
            );
        }

        if ($validate = $this->ProductsCommon->load_input_value()->validate($validationsRoles)) {
            $date = date("Y_m_d_H_i_s");
            /* ------------------Start Image Upload App Icon---------------- */
            $config['upload_path'] = 'assets/uploads/product_image/';
            //echo site_url();
            $config['allowed_types'] = 'gif|jpg|png|ogg|ico';
            // $config['max_width']  = '1024';
            // $config['max_height']  = '768';
            $config['file_name'] = $date;
            $error = '';
            $udata = '';
            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('media_url')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $udata = array('upload_data' => $this->upload->data());
                $app_icon = site_url() . $config['upload_path'] . $udata['upload_data']['file_name'];
                $this->ProductsCommon->set('media_url', $app_icon);
            }
            if (empty($id)) {
                $this->ProductsCommon->created_date = $date;
                $this->ProductsCommon->modified_date = $date;
            } else {
                $this->ProductsCommon->modified_date = $date;
            }
            $product_id = $this->ahrform->get('product_id');

            if (!empty($product_id)) {
                $categories = "";
                foreach ($product_id as $category) {
                    $categories .= $category;
                    $categories .=", ";
                }
                $categories = rtrim($categories, ', ');

                $this->ProductsCommon->set('product_id', $categories);
            }

            if ($this->ProductsCommon->save(NULL, false)) {
                $id = $this->ahrform->get('product_id');
                $product_title =
                        $this->ahrform->get('product_title');
                $tyre_removal = $this->ahrform->get('tyre_removal');
                $matress_removal = $this->ahrform->get('matress_removal');
                $lpg_gas_bottle = $this->ahrform->get('lpg_gas_bottle');
                $tv_monitors = $this->ahrform->get('tv_monitors');
                $extra_day_hire = $this->ahrform->get('extra_day_hire');
                $product_quantity = $this->ahrform->get('product_quantity');
                $product_price = $this->ahrform->get('product_price');
                $product_image = $this->ahrform->get('product_image');

                $data = array(
                    'product_title' => $product_title,
                    'tyre_removal' => $tyre_removal,
                    'matress_removal' => $matress_removal,
                    'lpg_gas_bottle' => $lpg_gas_bottle,
                    'tv_monitors' => $tv_monitors,
                    'extra_day_hire' => $extra_day_hire,
                    'product_quantity' => $product_quantity,
                    'product_price' => $product_price,
                    'product_image' => $product_image
                );

                $this->db->insert('products_common', $data);
                //}
                // }

                $this->params['success'] = 'Informations has been ' . (empty($_POST['id']) ? 'created' : 'updated') . ' successfully.';
                redirect(CPREFIX . '/products');
            } else {
                $this->params['success'] = 'Informations could not saved. Please try again.';
            }
        }
    }

    function check_title() {
        $this->template = false;
        $this->layout = false;
        $response = $this->Campaign->is_field_exist(array('conditions' => array_filter(array(
                'title' => $this->ahrform->get('title'),
                'id !=' => $this->ahrform->get('id') ? $this->ahrform->get('id') : '',
            ))));

        if ('jquery_validator' == ($requestby = $this->ahrform->get('requestby'))) {
            exit($response ? 'false' : 'true');
        }
        $this->form_validation->set_message('check_title', 'This Campaign already exist!!!');
        return $response ? false : true;
    }

    public function delete_product($id = null) {
        $this->layout = FALSE;
        $this->template = FALSE;
        $redirect = site_url('/' . CPREFIX . '/products/product_list');
        $id = $this->ahrform->get('id') ? $this->ahrform->get('id') : $id;
        if (empty($id) && !$this->input->is_ajax_request()) {
            $this->ahrsession->set_flash('Invalid id. Information could not delete. Please try agin', 'default', array(), 'warning');
            redirect($redirect);
        }
        $this->Category->deleteAll(array('conditions' => array('id' => $id)));
        if ($this->input->is_ajax_request()) {
            exit(json_encode(array('status' => true, 'msg' => "Information has been deleted")));
        }
        redirect($redirect);
    }

    public function delete($id = null) {
        $this->layout = FALSE;
        $this->template = FALSE;

        $redirect = site_url('/' . CPREFIX . '/products/product_list');
        //get id/IDs from ajax request
        $id = $this->ahrform->get('id') ? $this->ahrform->get('id') : $id;

        if (empty($id) && !$this->input->is_ajax_request()) {
            $this->ahrsession->set_flash('Invalid id. Information could not delete. Please try agin', 'default', array(), 'warning');
            redirect($redirect);
        }
        $this->Products->deleteAll(array('conditions' => array('id' => $id)));

        if ($this->input->is_ajax_request()) {
            exit(json_encode(array('status' => true, 'msg' => "Information has been deleted")));
        }
        redirect($redirect);
    }

    public function deleteType($id = null) {
        $this->layout = FALSE;
        $this->template = FALSE;

        $redirect = site_url('/' . CPREFIX . '/products/product_type_list');
        $id = $this->ahrform->get('id') ? $this->ahrform->get('id') : $id;

        if (empty($id) && !$this->input->is_ajax_request()) {
            $this->ahrsession->set_flash('Invalid id. Information could not delete. Please try agin', 'default', array(), 'warning');
            redirect($redirect);
        }
        $this->ProductType->deleteAll(array('conditions' => array('id' => $id)));
        if ($this->input->is_ajax_request()) {
            exit(json_encode(array('status' => true, 'msg' => "Information has been deleted")));
        }
        redirect($redirect);
    }

    public function deleteBinPrice($id = null) {
        $this->layout = FALSE;
        $this->template = FALSE;

        $redirect = site_url('/' . CPREFIX . '/products/bin_price_list');
        $id = $this->ahrform->get('id') ? $this->ahrform->get('id') : $id;

        if (empty($id) && !$this->input->is_ajax_request()) {
            $this->ahrsession->set_flash('Invalid id. Information could not delete. Please try agin', 'default', array(), 'warning');
            redirect($redirect);
        }
        $this->Bin->deleteAll(array('conditions' => array('id' => $id)));
        if ($this->input->is_ajax_request()) {
            exit(json_encode(array('status' => true, 'msg' => "Information has been deleted")));
        }
        redirect($redirect);
    }

    public function deleteZone($id = null) {
        $this->layout = FALSE;
        $this->template = FALSE;

        $redirect = site_url('/' . CPREFIX . '/products/product_zone_list');
        $id = $this->ahrform->get('id') ? $this->ahrform->get('id') : $id;

        if (empty($id) && !$this->input->is_ajax_request()) {
            $this->ahrsession->set_flash('Invalid id. Information could not delete. Please try agin', 'default', array(), 'warning');
            redirect($redirect);
        }
        $this->Postcode->deleteAll(array('conditions' => array('id' => $id)));
        if ($this->input->is_ajax_request()) {
            exit(json_encode(array('status' => true, 'msg' => "Information has been deleted")));
        }
        redirect($redirect);
    }

    public function deletecashOrder($id = null) {
        $this->layout = FALSE;
        $this->template = FALSE;

        $redirect = site_url('/' . CPREFIX . '/products/order_cash');
        $id = $this->ahrform->get('id') ? $this->ahrform->get('id') : $id;

        if (empty($id) && !$this->input->is_ajax_request()) {
            $this->ahrsession->set_flash('Invalid id. Information could not delete. Please try agin', 'default', array(), 'warning');
            redirect($redirect);
        }
        $this->order->deleteAll(array('conditions' => array('id' => $id)));
        if ($this->input->is_ajax_request()) {
            exit(json_encode(array('status' => true, 'msg' => "Information has been deleted")));
        }
        redirect($redirect);
    }

    public function deletepaypalOrder($id = null) {
        $this->layout = FALSE;
        $this->template = FALSE;

        $redirect = site_url('/' . CPREFIX . '/products/order_paypal');
        $id = $this->ahrform->get('id') ? $this->ahrform->get('id') : $id;

        if (empty($id) && !$this->input->is_ajax_request()) {
            $this->ahrsession->set_flash('Invalid id. Information could not delete. Please try agin', 'default', array(), 'warning');
            redirect($redirect);
        }
        $this->Order->deleteAll(array('conditions' => array('id' => $id)));
        if ($this->input->is_ajax_request()) {
            exit(json_encode(array('status' => true, 'msg' => "Information has been deleted")));
        }
        redirect($redirect);
    }

    public function deleteSettings($id = null) {
        $this->layout = FALSE;
        $this->template = FALSE;

        $redirect = site_url('/' . CPREFIX . '/products/product_settings_list');
        //get id/IDs from ajax request
        $id = $this->ahrform->get('id') ? $this->ahrform->get('id') : $id;

        if (empty($id) && !$this->input->is_ajax_request()) {
            $this->ahrsession->set_flash('Invalid id. Information could not delete. Please try agin', 'default', array(), 'warning');
            redirect($redirect);
        }
        $this->CommonSettings->deleteAll(array('conditions' => array('id' => $id)));

        if ($this->input->is_ajax_request()) {
            exit(json_encode(array('status' => true, 'msg' => "Information has been deleted")));
        }
        redirect($redirect);
    }

}
