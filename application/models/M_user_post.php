<?php
/**
 * Created by PhpStorm.
 * User: kivegun
 * Date: 11/1/16
 * Time: 10:18 PM
 */
class m_user_post extends MY_CRUD {
    public function __construct() {
        parent::__construct();
        $this->_table = 'user_post';
        $this->primary_key = 'id';
    }
}