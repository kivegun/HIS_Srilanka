<?php


class Immr extends FormController
{
    var $FORM_NAME = 'form_immr';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_immr');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function edit($id)
    {
        $immr = $this->m_immr->get($id);
        if (empty($immr))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_code'] = $immr->Code;
        $data['default_name'] = $immr->Name;
        $data['default_category'] = $immr->Category;
        $data['default_icdcode'] = $immr->ICDCODE;
        $data['default_create_date'] = $immr->CreateDate;
        $data['default_create_user'] = $immr->CreateUser;
        $data['default_last_update'] = $immr->LastUpDate;
        $data['default_last_update_user'] = $immr->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Code' => $this->input->post('code'),
                'Name' => $this->input->post('name'),
                'Category' => $this->input->post('category'),
                'ICDCODE' => $this->input->post('icdcode'),
            );
            $this->m_immr->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/immr');
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
        $this->form_validation->set_rules('code', 'Code', 'trim|xss_clean|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|xss_clean|required');
        $this->form_validation->set_rules('icdcode', 'ICDCODE', 'trim|xss_clean');
    }

}