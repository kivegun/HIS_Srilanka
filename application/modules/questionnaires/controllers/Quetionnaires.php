<?php


class Wards extends FormController
{
    var $FORM_NAME = 'form_wards';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_wards');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function create()
    {
        //var_dump($_POST);
        $data = array();
        $data['id'] = 0;
        $data['default_name'] = '';
        $data['default_type'] = '';
        $data['default_telephone'] = '';
        $data['default_bed_count'] = '';
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
                'Name' => $this->input->post('name'),
                'Type' => $this->input->post('type'),
                'Telephone' => $this->input->post('telephone'),
                'BedCount' => $this->input->post('bed_count'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
            );
            $this->m_wards->insert($data);
            $this->session->set_flashdata(
                'msg', 'Created'
            );
            $this->redirect_if_no_continue('preference/load/wards');
        }

    }

    public function edit($id)
    {
        $wards = $this->m_wards->get($id);
        if (empty($wards))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_name'] = $wards->Name;
        $data['default_type'] = $wards->Type;
        $data['default_telephone'] = $wards->Telephone;
        $data['default_bed_count'] = $wards->BedCount;
        $data['default_remarks'] = $wards->Remarks;
        $data['default_active'] = $wards->Active;
        $data['default_create_date'] = $wards->CreateDate;
        $data['default_create_user'] = $wards->CreateUser;
        $data['default_last_update'] = $wards->LastUpDate;
        $data['default_last_update_user'] = $wards->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Name' => $this->input->post('name'),
                'Type' => $this->input->post('type'),
                'Telephone' => $this->input->post('telephone'),
                'BedCount' => $this->input->post('bed_count'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
            );
            $this->m_wards->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/wards');
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
        $this->form_validation->set_rules('type', 'Type', 'trim|xss_clean');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim|xss_clean');
        $this->form_validation->set_rules('bed_count', 'Number of beds', 'trim|xss_clean|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');
    }

}