<?php
/**
 * Created by PhpStorm.
 * User: kivegun
 * Date: 10/5/16
 * Time: 7:34 PM
 */
class m_visit_type extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'visit_type';
        $this->primary_key = 'VTYPID';
    }
}