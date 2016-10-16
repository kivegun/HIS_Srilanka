<?php
/**
 * Created by PhpStorm.
 * User: kivegun
 * Date: 10/5/16
 * Time: 7:31 PM
 */
class Treatments extends FormController
{
    var $FORM_NAME = 'form_treatments';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_treatments');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function create()
    {
        //var_dump($_POST);
        $data = array();
        $data['id'] = 0;
        $data['default_treatment'] = '';
        $data['default_treatment_type'] = '';
        $data['default_active'] = '';
        $data['default_remarks'] = '';
        $data['default_create_date'] = date("Y-m-d H:i:s");
        $data['default_create_user'] = 'a';
        $data['default_last_update'] = '';
        $data['default_last_update_user'] = '';

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Treatment' => $this->input->post('treatment'),
                'Type' => $this->input->post('treatment_type'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
            );
            $this->m_treatments->insert($data);
            $this->session->set_flashdata(
                'msg', 'Created'
            );
            $this->redirect_if_no_continue('preference/load/treatment');
        }

    }

    public function edit($id)
    {
        $treatment = $this->m_treatments->get($id);
        if (empty($treatment))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_treatment'] = $treatment->Treatment;
        $data['default_treatment_type'] = $treatment->Type;
        $data['default_active'] = $treatment->Active;
        $data['default_remarks'] = $treatment->Remarks;
        $data['default_create_date'] = $treatment->CreateDate;
        $data['default_create_user'] = $treatment->CreateUser;
        $data['default_last_update'] = $treatment->LastUpDate;
        $data['default_last_update_user'] = $treatment->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Treatment' => $this->input->post('treatment'),
                'Type' => $this->input->post('treatment_type'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
            );
            $this->m_treatments->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/treatment');
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
        $this->form_validation->set_rules('treatment', 'Treatment', 'trim|xss_clean|required');
        $this->form_validation->set_rules('treatment_type', 'Type', 'trim|xss_clean|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');
    }

}