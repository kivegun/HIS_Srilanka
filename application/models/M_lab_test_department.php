<?php

class m_lab_test_department extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'lab_test_department';
        $this->primary_key = 'LABDEPTID';
    }
}