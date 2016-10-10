<?php
/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 14-Oct-15
 * Time: 10:56 AM
 */
class m_top_menu extends MY_CRUD {
    function __construct() {
        parent::__construct ();
        $this->_table = 'top_menu';
        $this->primary_key = 'MID';
    }
}