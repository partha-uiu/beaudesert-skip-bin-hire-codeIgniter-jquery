<?php

class Transaction_model extends App_model {

    public $_table_name = 'transaction';
    public $_alias = 'transaction';
    public $_validate = array();

    function __construct() {
        parent::__construct();
        $this->setup();
    }


}

?>