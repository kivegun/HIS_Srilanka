<?php


class snomed_events extends FormController
{
    var $FORM_NAME = 'form_snomed_events';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_snomed_events');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function edit($id)
    {
        $snomed_events = $this->m_snomed_events->get($id);
        if (empty($snomed_events))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_code'] = $snomed_events->CONCEPTID;
        $data['default_term'] = $snomed_events->TERM;
        $data['default_status'] = $snomed_events->DESCRIPTIONSTATUS;
        $data['default_active'] = $snomed_events->Active;
        $data['default_create_date'] = $snomed_events->CreateDate;
        $data['default_create_user'] = $snomed_events->CreateUser;
        $data['default_last_update'] = $snomed_events->LastUpDate;
        $data['default_last_update_user'] = $snomed_events->LastUpDateUser;

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
            $this->m_snomed_events->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/snomed_events');
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