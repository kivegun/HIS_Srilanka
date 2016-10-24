<?php

class m_immr extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'immr';
        $this->primary_key = 'IMMRID';
    }
}