<?php

class m_icd10 extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'icd10';
        $this->primary_key = 'ICDID';
    }
}