<?php

class m_treatments extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'treatment';
        $this->primary_key = 'TREATMENTID';
    }
}