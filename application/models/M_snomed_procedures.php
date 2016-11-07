<?php

class m_snomed_procedures extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'procedures';
        $this->primary_key = 'PROCEDUREID';
    }
}