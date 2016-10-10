<?php
/**
 * Created by PhpStorm.
 * User: qch
 * Date: 11/21/15
 * Time: 6:50 AM
 */

class m_complaints extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->_table = 'complaints';
        $this->primary_key = 'COMPID';
    }
}