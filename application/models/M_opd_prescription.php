<?php

class m_opd_prescription extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'opd_presciption';
        $this->primary_key = 'PRSID';
    }

}