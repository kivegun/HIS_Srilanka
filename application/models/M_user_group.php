<?php
/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 12-Oct-15
 * Time: 9:12 PM
 */
class m_user_group extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'user_group';
        $this->primary_key = 'UGID';
    }
}