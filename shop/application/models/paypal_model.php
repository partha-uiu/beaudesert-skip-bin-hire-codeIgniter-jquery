<?php

class Paypal_model extends App_model {

    public $_table_name = 'paypal_tbl';
    public $_alias = 'paypal_tbl';
    public $_validate = array();

    function __construct() {
        parent::__construct();
        $this->setup();
    }
	
}

?>