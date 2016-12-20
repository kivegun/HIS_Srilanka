<?php

/**
 * Created by PhpStorm.
 * User: qch
 * Date: 11/21/15
 * Time: 6:40 AM
 */
class Complaints extends FormController
{
    var $FORM_NAME = 'form_complaints';

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('m_patient');
        $this->load->model('m_complaints');

    }

    public function create()
    {

        $data = array();
        $data['id'] = 0;
        $data['default_Name'] = '';
        $data['default_Type'] = '';
        $data['default_ICD_link'] = '';
        $data['default_isNotify'] = '';
        $data['default_Remarks'] = '';
        $data['default_Active'] = '';
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
                'ICDLink' => $this->input->post('ICDLink'),
                'isNotify' => $this->input->post('isNotify'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
            );
            $this->m_complaints->insert($data);
            $this->session->set_flashdata(
                'msg', 'Created'
            );
            $this->redirect_if_no_continue('/preference/load/complaints');
        }
    }

    public function edit($id)
    {
        $complaints = $this->m_complaints->get($id);
        if (empty($complaints))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_Name'] = $complaints->Name;
        $data['default_Type'] = $complaints->Type;
        $data['default_ICD_link'] = $complaints->ICDLink;
        $data['default_isNotify'] = $complaints->isNotify;
        $data['default_Remarks'] = $complaints->Remarks;
        $data['default_Active'] = $complaints->Active;
        $data['default_create_date'] = $complaints->CreateDate;
        $data['default_create_user'] = $complaints->CreateUser;
        $data['default_last_update'] = $complaints->LastUpDate;
        $data['default_last_update_user'] = $complaints->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Name' => $this->input->post('name'),
                'Type' => $this->input->post('type'),
                'ICDLink' => $this->input->post('ICDLink'),
                'isNotify' => $this->input->post('isNotify'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
            );
            $this->m_complaints->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/complaints');
        }
    }

    private function set_common_validation()
    {
        $this->form_validation->set_rules('name', 'Complaint', 'trim|xss_clean|required');
        $this->form_validation->set_rules('type', 'Type', 'trim|xss_clean');
        $this->form_validation->set_rules('ICDLink', 'ICDLink', 'trim|xss_clean');
        $this->form_validation->set_rules('isNotifiable', 'isNotify', 'trim|xss_clean');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');
    }

    public function search($term)
    {
        $sql = 'SELECT * FROM complaints WHERE Name LIKE "%' . $term . '%"';
        $query = $this->db->query($sql);
        $inc = 0;
        foreach ($query->result_array() as $row) {
            $result[$inc]['id'] = $row['COMPID'];
            $result[$inc]['name'] = $row['Name'];
            $result[$inc]['value'] = $row['Name'];
            $inc++;
        }
        echo json_encode($result);
    }

    public function lookup_complaints()
    {
        $this->load->view('lookup_complaints');
    }

}