<?php

class Product_settings_model extends App_model {

    public $_table_name = 'common_settings';
    public $_alias = 'CommonSettings';
    public $_validate = array();

    function __construct() {
        parent::__construct();
        $this->setup();
    }


}

?>