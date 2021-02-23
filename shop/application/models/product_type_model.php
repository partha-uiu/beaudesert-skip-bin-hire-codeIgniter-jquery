<?php

class Product_type_model extends App_model {

    public $_table_name = 'product_type';
    public $_alias = 'ProductType';
    public $_validate = array();

    function __construct() {
        parent::__construct();
        $this->setup();
    }

//	function getFeedArticles(){	
//        $this->db->select("id,p_title,p_description");
//        $this->db->from('products');				
//        $query = $this->db->get();		
//        return $query->result();			
//    }

}

?>