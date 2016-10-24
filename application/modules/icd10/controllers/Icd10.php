<?php


class icd10 extends FormController
{
    var $FORM_NAME = 'form_icd10';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_icd10');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function edit($id)
    {
        $icd10 = $this->m_icd10->get($id);
        if (empty($icd10))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_code'] = $icd10->Code;
        $data['default_name'] = $icd10->Name;
        $data['default_isnotify'] = $icd10->isNotify;
        $data['default_remarks'] = $icd10->Remarks;
        $data['default_create_date'] = $icd10->CreateDate;
        $data['default_create_user'] = $icd10->CreateUser;
        $data['default_last_update'] = $icd10->LastUpDate;
        $data['default_last_update_user'] = $icd10->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Code' => $this->input->post('code'),
                'Name' => $this->input->post('name'),
                'isnotify' => $this->input->post('isnotify'),
                'Remarks' => $this->input->post('remarks'),
            );
            $this->m_icd10->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/icd10');
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
        $this->form_validation->set_rules('isnotify', 'isNotify', 'trim|xss_clean|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean');
    }

}