<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hhims extends LoginCheckController
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('m_user_group');
    }

    public function index()
    {
//        var_dump($this->session->userdata('uid'));
//        var_dump($this->session->userdata('user_group_id'));
        $user_group = $this->m_user_group->get($this->session->userdata('user_group_id'));
        if (empty($user_group->MainMenu)) {
            die('Menu is not set');
        }
        $home_page = site_url() . '/' . $user_group->MainMenu;
        header("Status: 200");
        header("Location: " . $home_page);
        exit;

    }

    public function get_user_info()
    {
        echo '<span class="usr_info">';
        echo $this->session->userdata('Title') . ' ';
        echo $this->session->userdata('FirstName') . ' ';
        echo '(' . $this->session->userdata('UserGroup') . ')';
        echo '</span>';
    }
}