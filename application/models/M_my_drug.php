<?php
/**
 * Created by PhpStorm.
 * User: kivegun
 * Date: 10/5/16
 * Time: 5:48 AM
 */
class m_who_drug extends MY_CRUD {
    function __construct()
    {
        parent::__construct();
        $this->_table = 'who_drug';
        $this->primary_key = 'wd_id';
    }
}