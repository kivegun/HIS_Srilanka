<?php
class m_ward extends MY_CRUD {
  public function __construct() {
    parent::__construct();
    $this->_table = 'ward';
    $this->primary_key = 'WID';
  }
}