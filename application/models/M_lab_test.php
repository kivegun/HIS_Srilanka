<?php

class m_lab_test extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'lab_tests';
        $this->primary_key = 'LABID';
    }
}