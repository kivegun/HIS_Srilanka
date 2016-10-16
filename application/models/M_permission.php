<?php


class m_permission extends MY_CRUD {
    function __construct() {
        parent::__construct ();
        $this->_table = 'permission';
        $this->primary_key = 'PERID';
    }
}