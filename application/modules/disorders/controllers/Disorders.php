<?php


class disorders extends FormController
{
    var $FORM_NAME = 'form_disorders';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_disorders');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function edit($id)
    {
        $disorders = $this->m_disorders->get($id);
        if (empty($disorders))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_code'] = $disorders->CONCEPTID;
        $data['default_term'] = $disorders->TERM;
        $data['default_status'] = $disorders->DESCRIPTIONSTATUS;
        $data['default_active'] = $disorders->Active;
        $data['default_create_date'] = $disorders->CreateDate;
        $data['default_create_user'] = $disorders->CreateUser;
        $data['default_last_update'] = $disorders->LastUpDate;
        $data['default_last_update_user'] = $disorders->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'CONCEPTID' => $this->input->post('code'),
                'TERM' => $this->input->post('term'),
                'DESCRIPTIONSTATUS' => $this->input->post('status'),
                'Active' => $this->input->post('active'),
            );
            $this->m_disorders->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/disorders');
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
        $this->form_validation->set_rules('term', 'Term', 'trim|xss_clean|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|xss_clean|required');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');
    }

}