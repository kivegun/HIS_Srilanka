<?php

class m_disorders extends MY_CRUD
{
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'disorder';
        $this->primary_key = 'DISORDERID';
    }
}