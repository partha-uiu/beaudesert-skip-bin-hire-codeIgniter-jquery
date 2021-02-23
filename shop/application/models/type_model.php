<?php

class Type_model extends App_model {

    public $_table_name = 'product_type';
    public $_alias = 'product_type';
    public $_validate = array();

    function __construct() {
        parent::__construct();
        $this->setup();
    }
	
}
?>