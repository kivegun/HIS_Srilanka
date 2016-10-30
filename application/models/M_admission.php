<?php
/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 27-Oct-15
 * Time: 11:23 AM
 */
class m_admission extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'admission';
        $this->primary_key = 'ADMID';
    }

}