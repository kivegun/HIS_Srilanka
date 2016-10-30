<?php

class m_snomed_findings extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'finding';
        $this->primary_key = 'FINDID';
    }
}