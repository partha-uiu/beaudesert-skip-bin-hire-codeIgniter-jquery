<?php

class Invoice_number extends App_model {

    public $_table_name = 'invoice_number';
    public $_alias = 'Invoice';
    public $_validate = array();

    function __construct() {
        parent::__construct();
        $this->setup();
    }


}

?>