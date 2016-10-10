<?php

/**
 * Copyright (C) 2016 CNL, Inje University - cnl.inje.ac.kr
 * Modified to load view from module
 */
class Qch_Template extends Template
{
    function __construct()
    {
        $this->ci =& get_instance();
        $this->_module_name = CI::$APP->router->fetch_module();
    }

    function load($tpl_view, $body_view = null, $data = null)
    {
        if (!is_null($body_view)) {
            if (file_exists(APPPATH . 'modules/' . $this->_module_name . '/views/' . $body_view . '.php')) {
                $body_view_path = $this->_module_name . '/' . $body_view;
            } else {
                show_error('Unable to load the requested file: ' . APPPATH . 'modules/' . $this->_module_name . '/views/' . $body_view . '.php');
            }
            $body = $this->ci->load->view($body_view_path, $data, TRUE);
            if (is_null($data)) {
                $data = array('body' => $body);
            } else if (is_array($data)) {
                $data['body'] = $body;
            } else if (is_object($data)) {
                $data->body = $body;
            }
        }
        $this->ci->load->view('templates/' . $tpl_view, $data);
    }

    function load_form_layout($view, $data = null)
    {
        $this->load('abh/header', null, $data);
        $this->load('abh/default_form_layout', $view, $data);
    }

    function load_table_layout($data = null)
    {
        $this->load('abh/header', null, $data);
        $this->load('abh/default_table_layout', null, $data);
    }
}