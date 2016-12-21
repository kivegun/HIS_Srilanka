<?php

class m_opd_treatment extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'opd_treatment';
        $this->primary_key = 'OPDTREATMENTID';
    }

}