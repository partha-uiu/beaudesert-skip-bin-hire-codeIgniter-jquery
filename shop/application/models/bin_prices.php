<?php

class Bin_prices extends App_model {

    public $_table_name = 'bin_prices';
    public $_alias = 'Bin';
    public $_validate = array();

    function __construct() {
        parent::__construct();
        $this->setup();
    }


}

?>