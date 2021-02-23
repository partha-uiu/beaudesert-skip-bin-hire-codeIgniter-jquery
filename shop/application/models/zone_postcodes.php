<?php

class Zone_postcodes extends App_model {

    public $_table_name = 'product_zone_postcodes';
    public $_alias = 'Postcode';
    public $_validate = array();

    function __construct() {
        parent::__construct();
        $this->setup();
    }


}

?>