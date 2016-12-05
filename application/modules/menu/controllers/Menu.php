<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends LoginCheckController
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mmenu');
        $this->lang->load('menu/top_menu');
    }

    public function index($active_menu_link = '')
    {
        $ugid = $this->session->userdata('user_group_name');
        $uid = $this->session->userdata('uid');
        $data['inbox'] = $this->Mmenu->message($uid);
        $data['top_menu'] = $this->Mmenu->get_active_menu($ugid);
        $data['active_menu_link'] = $active_menu_link;
        $this->load->vars($data);
        $this->load->view('top_menu');
    }

    public function top()
    {
        $ugid = $this->session->userdata('user_group_name');
        $uid = $this->session->userdata('uid');
        $data['inbox'] = $this->Mmenu->message($uid);
        $data['top_menu'] = $this->Mmenu->get_active_menu($ugid);
        $data['active_menu_link'] = $this->session->userdata('selected_menu');
        $this->load->view('top_menu', $data);
    }



}