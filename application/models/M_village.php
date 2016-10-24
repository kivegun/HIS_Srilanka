<?php

class m_village extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'village';
        $this->primary_key = 'VGEID';
    }
}