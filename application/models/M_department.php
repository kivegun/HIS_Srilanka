<?php
/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 12-Oct-15
 * Time: 9:43 PM
 */
class m_department extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->_table = 'department';
        $this->primary_key = 'DEPID';
    }
}