<?php

class Products_model extends App_model {

    public $_table_name = 'products';
    public $_alias = 'products';
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