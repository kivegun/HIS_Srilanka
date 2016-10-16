<?php


class Lab_test_department extends FormController
{
    var $FORM_NAME = 'form_lab_test_department';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_lab_test_department');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function create()
    {
        //var_dump($_POST);
        $data = array();
        $data['id'] = 0;
        $data['default_name'] = '';
        $data['default_active'] = '';
        $data['default_create_date'] = date("Y-m-d H:i:s");
        $data['default_create_user'] = 'a';
        $data['default_last_update'] = '';
        $data['default_last_update_user'] = '';

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Name' => $this->input->post('name'),
                'Active' => $this->input->post('active'),
            );
            $this->m_lab_test_department->insert($data);
            $this->session->set_flashdata(
                'msg', 'Created'
            );
            $this->redirect_if_no_continue('preference/load/lab_test_department');
        }

    }

    public function edit($id)
    {
        $lab_test_department = $this->m_lab_test_department->get($id);
        if (empty($lab_test_department))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_name'] = $lab_test_department->Name;
        $data['default_active'] = $lab_test_department->Active;
        $data['default_create_date'] = $lab_test_department->CreateDate;
        $data['default_create_user'] = $lab_test_department->CreateUser;
        $data['default_last_update'] = $lab_test_department->LastUpDate;
        $data['default_last_update_user'] = $lab_test_department->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Name' => $this->input->post('name'),
                'Active' => $this->input->post('active'),
            );
            $this->m_lab_test_department->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('preference/load/lab_test_department');
        }
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
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');
    }

}