<?php

class m_drugs_frequency extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'drugs_frequency';
        $this->primary_key = 'DFQYID';
    }
}