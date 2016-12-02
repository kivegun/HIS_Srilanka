<?php
/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 23-Oct-15
 * Time: 2:41 PM
 */
class m_patient_examination extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'patient_exam';
        $this->primary_key = 'PATEXAMID';
    }
}