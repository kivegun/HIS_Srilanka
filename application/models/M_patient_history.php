<?php
/**
 * Created by PhpStorm.
 * User: kivegun
 * Date: 12/1/16
 * Time: 10:57 PM
 */
class m_patient_history extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'patient_history';
        $this->primary_key = 'PATHISTORYID';
    }
}