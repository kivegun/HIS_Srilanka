<?php


class Drugs_dosage extends FormController
{
    var $FORM_NAME = 'form_drugs_dosage';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_drugs_dosage');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function create()
    {
        //var_dump($_POST);
        $data = array();
        $data['id'] = 0;
        $data['default_dosage'] = '';
        $data['default_type'] = '';
        $data['default_factor'] = '';
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
                'Dosage' => $this->input->post('dosage'),
                'Type' => $this->input->post('type'),
                'Factor' => $this->input->post('factor'),
                'Active' => $this->input->post('active'),
            );
            $this->m_drugs_dosage->insert($data);
            $this->session->set_flashdata(
                'msg', 'Created'
            );
            $this->redirect_if_no_continue('preference/load/drugs_dosage');
        }

    }

    public function edit($id)
    {
        $drugs_dosage = $this->m_drugs_dosage->get($id);
        if (empty($drugs_dosage))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_dosage'] = $drugs_dosage->Dosage;
        $data['default_type'] = $drugs_dosage->Type;
        $data['default_factor'] = $drugs_dosage->Factor;
        $data['default_active'] = $drugs_dosage->Active;
        $data['default_create_date'] = $drugs_dosage->CreateDate;
        $data['default_create_user'] = $drugs_dosage->CreateUser;
        $data['default_last_update'] = $drugs_dosage->LastUpDate;
        $data['default_last_update_user'] = $drugs_dosage->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Dosage' => $this->input->post('dosage'),
                'Type' => $this->input->post('type'),
                'Factor' => $this->input->post('factor'),
                'Active' => $this->input->post('active'),
            );
            $this->m_drugs_dosage->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/drugs_dosage');
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
        $this->form_validation->set_rules('dosage', 'Dosage', 'trim|xss_clean|required');
        $this->form_validation->set_rules('type', 'Type', 'trim|xss_clean|required');
        $this->form_validation->set_rules('factor', 'Factor', 'trim|xss_clean');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');
    }

}