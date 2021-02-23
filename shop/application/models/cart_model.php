<?php

class Cart_model extends App_model {

    public $_table_name = 'cart';
    public $_alias = 'cart';
    public $_validate = array();

    function __construct() {
        parent::__construct();
        $this->setup();
    }
	
}

?>