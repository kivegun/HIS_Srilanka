<?php


class snomed_findings extends FormController
{
    var $FORM_NAME = 'form_snomed_findings';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_snomed_findings');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function edit($id)
    {
        $snomed_findings = $this->m_snomed_findings->get($id);
        if (empty($snomed_findings))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_code'] = $snomed_findings->CONCEPTID;
        $data['default_term'] = $snomed_findings->TERM;
        $data['default_status'] = $snomed_findings->DESCRIPTIONSTATUS;
        $data['default_active'] = $snomed_findings->Active;
        $data['default_create_date'] = $snomed_findings->CreateDate;
        $data['default_create_user'] = $snomed_findings->CreateUser;
        $data['default_last_update'] = $snomed_findings->LastUpDate;
        $data['default_last_update_user'] = $snomed_findings->LastUpDateUser;

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
            $this->m_snomed_findings->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/snomed_findings');
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