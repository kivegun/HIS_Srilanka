<?php

/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 10-Oct-15
 * Time: 12:08 PM
 */
class User extends FormController
{
    var $FORM_NAME = 'form_create_user';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mpersistent');
        $this->load->model('m_user');
        $this->load->model('m_user_post');
        $this->load->model('m_user_group');
        $this->load->model('m_user_has_user_group');
        $this->load_form_language();
    }

    private function set_common_validation()
    {
        $this->form_validation->set_rules('title', 'Tilte', 'trim|xss_clean');
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
        $this->form_validation->set_rules('other_name', 'Other Name', 'trim|xss_clean|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|xss_clean|required');
        $this->form_validation->set_rules('post', 'Post', 'trim|xss_clean|required');
        $this->form_validation->set_rules('speciality', 'Speciality', 'trim|xss_clean');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim|xss_clean');
        $this->form_validation->set_rules("address_1", "Address 1", "trim|xss_clean");
        $this->form_validation->set_rules("user_group", "User Groups", "xss_clean|required");
        $this->form_validation->set_rules("password", "Password", "trim|xss_clean");
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');
    }

    public function create()
    {
        $data = array();
        $data['id'] = 0;
        $data['default_user_name'] = '';
        $data['default_title'] = '';
        $data['default_name'] = '';
        $data['default_other_name'] = '';
        $data['default_gender'] = '';
        $data['default_speciality'] = '';
        $data['default_telephone'] = '';
        $data['default_address_1'] = '';
        $data['default_password'] = '';
        $data['default_active'] = '';
        $data['default_post'] = '';
        $data['default_user_group'] = '';
        $data['default_create_date'] = date("Y-m-d H:i:s");
        $data['default_create_user'] = 'a';
        $data['default_last_update'] = '';
        $data['default_last_update_user'] = '';

        $data['post_dropdown'] = $this->get_dropdown_post('result');

        $data['user_group_dropdown'] = $this->get_dropdown_user_group('result');


        $this->form_validation->set_rules("user_name", "User Name", 'trim|xss_clean|required|is_unique[user.UserName]');
        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->render('form_create_user', $data);
        } else {
            $this->insert();
        }
    }

    public function edit($uid)
    {

        $data = array();
        $data['id'] = $uid;
        $user = $this->m_user->get($uid);
        $data['uid'] = $uid;
        $data['default_user_name'] = $user->UserName;
        $data['default_title'] = $user->Title;
        $data['default_name'] = $user->FirstName;
        $data['default_other_name'] = $user->OtherName;
        $data['default_gender'] = $user->Gender;
        $data['default_post'] = $user->Post;
        $data['default_speciality'] = '';
        $data['default_telephone'] = $user->Telephone;
        $data['default_address_1'] = $user->Address_Street;
        $data['default_user_group'] = $user->UserGroup;
        $data['default_password'] = '';
        $data['default_active'] = $user->Active;
        $data['default_create_date'] = $user->CreateDate;
        $data['default_create_user'] = $user->CreateUser;
        $data['default_last_update'] = $user->LastUpDate;
        $data['default_last_update_user'] = $user->LastUpDateUser;

        $data['post_dropdown'] = $this->get_dropdown_post('result');

        $data['user_group_dropdown'] = $this->get_dropdown_user_group('result');

        if($this->input->post('user_name') != $data['default_user_name']) {
            $is_unique =  '|is_unique[user.UserName]';
        } else {
            $is_unique =  '';
        }

        $this->form_validation->set_rules('user_name', 'User Name', 'required|trim|xss_clean'.$is_unique);
        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->render('form_edit_user', $data);
        } else {
            $edit_user = array(
                'UserName' => $this->input->post('user_name'),
                'Title' => $this->input->post('title'),
                'FirstName' => $this->input->post('name'),
                'OtherName' => $this->input->post('other_name'),
                'Gender' => $this->input->post('gender'),
                'Post' => $this->input->post('post'),
                'Telephone' => $this->input->post('telephone'),
                'Address_Street' => $this->input->post('address_1'),
                'UserName' => $this->input->post('user_name'),
                'UserGroup' => $this->input->post('user_group'),
//            'Password' => md5($this->input->post('password')),
                'Active' => $this->input->post('active')
            );
            $this->m_user->update($uid, $edit_user);
//        $this->m_user_has_user_group->updateUserGroups($uid, $this->get_selected_user_groups());
            //redirect
            $this->session->set_flashdata(
                'msg', 'REC: ' . ucfirst(strtolower($this->input->post("user_name"))) . ' updated'
            );
            header("Status: 200");
            header("Location: " . site_url('preference/load/user'));
        }
    }

    public function get_dropdown_post($type = 'json')
    {
        $this->load->model('m_user_post');
        $result = $this->m_user_post->order_by('Name')->dropdown('Name', 'Name');
        if ($type == 'json') {
            print(json_encode($result));
        }
        return $result;
    }

    public function get_dropdown_user_group($type = 'json')
    {
        $this->load->model('m_user_group');
        $result = $this->m_user_group->order_by('Name')->dropdown('Name', 'Name');
        if ($type == 'json') {
            print(json_encode($result));
        }
        return $result;
    }

//Starts Passwords Management
    public function change_password($uid)
    {
        $data = array();
        $user = $this->m_user->get($uid);
        if (empty($user))
            die('Id not exist');

        $data['uid'] = $user->UID;

        $this->form_validation->set_rules('oldp', 'Old password', 'required|callback_check_oldp[$uid]');
        $this->form_validation->set_rules('newp1', 'Password confirmation', 'required');
        $this->form_validation->set_rules('newp2', 'The New Password confirmation', 'required|matches[newp1]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('form_change_password', $data);
        } else {
            //First checks if the Password is for Order Items
            $new_passw = array(
                'Password' => md5($this->input->post('newp1')),
            );
//            echo $uid;
            $this->m_user->update($uid, $new_passw);
            //  $this->m_user_has_user_group->updateUserGroups($uid, $this->get_selected_user_groups());
            //redirect
            $this->session->set_flashdata(
                'msg',  ' updated'
            );
            header("Status: 200");
            header("Location: " . site_url('user/change_password/'.$uid));

        }

    }

    public function check_oldp($oldp, $uid)
    {
        $old_pw = md5($oldp);

        $user = $this->m_user->get($uid);
        $old_pw_db = $user->Password;

        if ($old_pw != $old_pw_db)
        {
            $this->form_validation->set_message('check_oldp', 'The password you supplied does not match your existing password.');
            return FALSE;
        }
        else {return TRUE;}
    }

    private function show_passw_form($data)
    {
        $sql = "SELECT UGID, user_group.Name AS UG_NAME, department.DEPID AS DEPID, department.Name AS DEP_NAME FROM user_group INNER JOIN department ON user_group.DEPID = department.DEPID";
        $user_groups = $this->mpersistent->table_select($sql);
        $departments = array();
        foreach ($user_groups as $row) {
            array_push($departments, $row ['DEP_NAME']);
        }
        $departments = array_unique($departments);

        $data['departments'] = $departments;
        $data['userGroups'] = $user_groups;
        $this->render('form_change_password', $data);
    }


    private function update_pwd($uid)
    {
        $new_passw = array(
            'Password' => md5($this->input->post('new_password')),
        );
        echo $uid;
        $this->m_user->update($uid, $new_passw);
        //  $this->m_user_has_user_group->updateUserGroups($uid, $this->get_selected_user_groups());
        //redirect
        $this->session->set_flashdata(
            'msg', 'REC: ' . ucfirst(strtolower($this->input->post("username"))) . ' updated'
        );
        header("Status: 200");
        header("Location: " . site_url('preference/load/user'));
    }

    private function update_pwdOrder($uid)
    {
        $new_passw = array(
            'OrderPassword' => md5($this->input->post('new_password')),
        );
        echo $uid;
        $this->m_user->update($uid, $new_passw);
        //  $this->m_user_has_user_group->updateUserGroups($uid, $this->get_selected_user_groups());
        //redirect
        $this->session->set_flashdata(
            'msg', 'REC: ' . ucfirst(strtolower($this->input->post("username"))) . ' updated'
        );
        header("Status: 200");
        header("Location: " . site_url('preference/load/user'));
    }


    //End Passwords Management

//    private function show_form($data)
//    {
//        $sql = "SELECT UGID, user_group.Name AS UG_NAME, department.DEPID AS DEPID, department.Name AS DEP_NAME FROM user_group INNER JOIN department ON user_group.DEPID = department.DEPID";
//        $user_groups = $this->mpersistent->table_select($sql);
//        $departments = array();
//        foreach ($user_groups as $row) {
//            array_push($departments, $row ['DEP_NAME']);
//        }
//        $departments = array_unique($departments);
//
//        $data['departments'] = $departments;
//        $data['userGroups'] = $user_groups;
//
//    }

    private function update($uid)
    {
        $edit_user = array(
            'Title' => $this->input->post('title'),
            'FirstName' => $this->input->post('name'),
            'OtherName' => $this->input->post('other_name'),
            'Gender' => $this->input->post('gender'),
            'Post' => $this->input->post('post'),
            'Telephone' => $this->input->post('telephone'),
            'Address_Street' => $this->input->post('address_1'),
            'UserName' => $this->input->post('user_name'),
            'UserGroup' => $this->input->post('user_group'),
//            'Password' => md5($this->input->post('password')),
            'Active' => $this->input->post('active')
        );
        $this->m_user->update($uid, $edit_user);
//        $this->m_user_has_user_group->updateUserGroups($uid, $this->get_selected_user_groups());
        //redirect
        $this->session->set_flashdata(
            'msg', 'REC: ' . ucfirst(strtolower($this->input->post("user_name"))) . ' updated'
        );
        header("Status: 200");
        header("Location: " . site_url('preference/load/user'));
    }

    private function insert()
    {
        $new_user = array(
            'Title' => $this->input->post('title'),
            'FirstName' => $this->input->post('name'),
            'OtherName' => $this->input->post('other_name'),
            'Gender' => $this->input->post('gender'),
            'Post' => $this->input->post('post'),
            'Telephone' => $this->input->post('telephone'),
            'Address_Street' => $this->input->post('address_1'),
            'UserName' => $this->input->post('user_name'),
            'UserGroup' => $this->input->post('user_group'),
            'Password' => md5($this->input->post('password')),
            'Active' => $this->input->post('active')
        );
        $userId = $this->m_user->insert($new_user);
//        $this->m_user_has_user_group->insert_($userId, $this->get_selected_user_groups());
        //redirect
        $this->session->set_flashdata(
            'msg', 'REC: ' . ucfirst(strtolower($this->input->post("user_name"))) . ' created'
        );
        $this->redirect_if_no_continue('preference/load/user');
    }

    private function get_selected_user_groups()
    {
        $selected_groups = array();
        foreach ($this->input->post('user_groups') as $key => $value) {
            array_push($selected_groups, $value);
        }
        return $selected_groups;
    }
}