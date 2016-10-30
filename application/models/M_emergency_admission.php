<?php
/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 20-Oct-15
 * Time: 2:44 PM
 */
class m_emergency_admission extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'emergency_admission';
        $this->primary_key = 'EMRID';
    }
}