<?php
/**
 * Created by PhpStorm.
 * User: kivegun
 * Date: 1/6/17
 * Time: 8:36 AM
 */
class m_hospital extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'hospital';
        $this->primary_key = 'HID';
    }
}