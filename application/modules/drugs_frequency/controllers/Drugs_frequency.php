<?php


class Drugs_frequency extends FormController
{
    var $FORM_NAME = 'form_drugs_frequency';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_drugs_frequency');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function create()
    {
        //var_dump($_POST);
        $data = array();
        $data['id'] = 0;
        $data['default_frequency'] = '';
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
                'Frequency' => $this->input->post('frequency'),
                'Factor' => $this->input->post('factor'),
                'Active' => $this->input->post('active'),
            );
            $this->m_drugs_frequency->insert($data);
            $this->session->set_flashdata(
                'msg', 'Created'
            );
            $this->redirect_if_no_continue('preference/load/drugs_frequency');
        }

    }

    public function edit($id)
    {
        $drugs_frequency = $this->m_drugs_frequency->get($id);
        if (empty($drugs_frequency))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_frequency'] = $drugs_frequency->Frequency;
        $data['default_factor'] = $drugs_frequency->Factor;
        $data['default_active'] = $drugs_frequency->Active;
        $data['default_create_date'] = $drugs_frequency->CreateDate;
        $data['default_create_user'] = $drugs_frequency->CreateUser;
        $data['default_last_update'] = $drugs_frequency->LastUpDate;
        $data['default_last_update_user'] = $drugs_frequency->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Frequency' => $this->input->post('frequency'),
                'Factor' => $this->input->post('factor'),
                'Active' => $this->input->post('active'),
            );
            $this->m_drugs_frequency->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/drugs_frequency');
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
        $this->form_validation->set_rules('frequency', 'Frequency', 'trim|xss_clean|required');
        $this->form_validation->set_rules('factor', 'Factor', 'trim|xss_clean');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');
    }

}