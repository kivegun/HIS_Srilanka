<?php

class m_canned_text extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'canned_text';
        $this->primary_key = 'CTEXTID';
    }
}