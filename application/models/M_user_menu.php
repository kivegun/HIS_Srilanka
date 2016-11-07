<?php

class m_user_menu extends MY_CRUD {
    function __construct() {
        parent::__construct ();
        $this->_table = 'user_menu';
        $this->primary_key = 'UMID';
    }
}