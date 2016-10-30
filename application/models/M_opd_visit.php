<?php
/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 27-Oct-15
 * Time: 11:23 AM
 */
class m_opd_visit extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'opd_visits';
        $this->primary_key = 'OPDID';
    }

}