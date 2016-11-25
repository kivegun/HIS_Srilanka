<?php
/**
 * Created by PhpStorm.
 * User: kivegun
 * Date: 10/5/16
 * Time: 7:31 PM
 */
class Lab_test extends FormController
{
    var $FORM_NAME = 'form_lab_tests';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_lab_test');
        $this->load->model('m_lab_test_department');
        $this->load->model('m_lab_test_group');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function create()
    {
        //var_dump($_POST);
        $data = array();
        $data['id'] = 0;
        $data['default_department'] = '';
        $data['default_group_name'] = '';
        $data['default_name'] = '';
        $data['default_refvalue'] = '';
        $data['default_value'] = '';
        $data['default_active'] = '';
        $data['default_create_date'] = date("Y-m-d H:i:s");
        $data['default_create_user'] = 'a';
        $data['default_last_update'] = '';
        $data['default_last_update_user'] = '';

        $data['dropdown_department'] = $this->get_dropdown_department('result');
        $data['dropdown_group_name'] = $this->get_dropdown_group_name('result');


        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Department' => $this->input->post('department'),
                'GroupName' => $this->input->post('group_name'),
                'Name' => $this->input->post('name'),
                'RefValue' => $this->input->post('refvalue'),
                'DefValue' => $this->input->post('default_value'),
                'Active' => $this->input->post('active'),
            );
            $this->m_lab_test->insert($data);
            $this->session->set_flashdata(
                'msg', 'Created'
            );
            $this->redirect_if_no_continue('preference/load/lab_test');
        }

    }

    public function edit($id)
    {
        $lab_test = $this->m_lab_test->get($id);
        if (empty($lab_test))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_name'] = $lab_test->Name;
        $data['default_active'] = $lab_test->Active;
        $data['default_create_date'] = $lab_test->CreateDate;
        $data['default_create_user'] = $lab_test->CreateUser;
        $data['default_last_update'] = $lab_test->LastUpDate;
        $data['default_last_update_user'] = $lab_test->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Name' => $this->input->post('name'),
                'Active' => $this->input->post('active'),
            );
            $this->m_lab_test->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('preference/load/lab_test');
        }
    }

    public function get_dropdown_group_name($type = 'json')
    {
        $this->load->model('m_lab_test_group');
        $result = $this->m_lab_test_group->order_by('Name')->dropdown('Name', 'Name');
        if ($type == 'json') {
            print(json_encode($result));
        }
        return $result;
    }

    public function get_dropdown_department($type = 'json')
    {
        $this->load->model('m_lab_test_department');
        $result = $this->m_lab_test_department->order_by('Name')->dropdown('Name', 'Name');
        if ($type == 'json') {
            print(json_encode($result));
        }
        return $result;
    }

    public function redirect_if_no_continue($uri)
    {
        if ($this->input->get('CONTINUE') === null) {
            redirect($uri);
        } else {
            redirect($this->input->get('CONTINUE'));
        }
    }

    private function set_common_validation()
    {
        $this->form_validation->set_rules('department', 'Department', 'trim|xss_clean|required');
        $this->form_validation->set_rules('group_name', 'Group Name', 'trim|xss_clean|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
        $this->form_validation->set_rules('refvalue', 'RefValue', 'trim|xss_clean');
        $this->form_validation->set_rules('default_value', 'Default value', 'trim|xss_clean');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');
    }

}