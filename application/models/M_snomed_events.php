<?php

class m_snomed_events extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'event';
        $this->primary_key = 'EVENTID';
    }
}