<?php


class m_complaints extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->_table = 'questionnaire';
        $this->primary_key = 'QUES_ID';
    }
}