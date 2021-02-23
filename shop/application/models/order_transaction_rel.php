<?php

class Order_transaction_rel extends App_model {

    public $_table_name = 'order_trans_rel';
    public $_alias = 'order_trans_rel';
    public $_validate = array();

    function __construct() {
        parent::__construct();
        $this->setup();
    }


}

?>