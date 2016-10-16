<?php

class m_drugs_dosage extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'drugs_dosage';
        $this->primary_key = 'DDSGID';
    }
}