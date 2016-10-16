<?php


class Canned_text extends FormController
{
    var $FORM_NAME = 'form_canned_text';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_canned_text');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function create()
    {
        //var_dump($_POST);
        $data = array();
        $data['id'] = 0;
        $data['default_code'] = '';
        $data['default_text'] = '';
        $data['default_remarks'] = '';
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
                'Code' => $this->input->post('code'),
                'Text' => $this->input->post('text'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
            );
            $this->m_canned_text->insert($data);
            $this->session->set_flashdata(
                'msg', 'Created'
            );
            $this->redirect_if_no_continue('preference/load/canned_text');
        }

    }

    public function edit($id)
    {
        $canned_text = $this->m_canned_text->get($id);
        if (empty($canned_text))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_code'] = $canned_text->Code;
        $data['default_text'] = $canned_text->Text;
        $data['default_remarks'] = $canned_text->Remarks;
        $data['default_active'] = $canned_text->Active;
        $data['default_create_date'] = $canned_text->CreateDate;
        $data['default_create_user'] = $canned_text->CreateUser;
        $data['default_last_update'] = $canned_text->LastUpDate;
        $data['default_last_update_user'] = $canned_text->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Code' => $this->input->post('code'),
                'Text' => $this->input->post('text'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
            );
            $this->m_canned_text->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/canned_text');
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
        $this->form_validation->set_rules('text', 'Text', 'trim|xss_clean|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');
    }

}