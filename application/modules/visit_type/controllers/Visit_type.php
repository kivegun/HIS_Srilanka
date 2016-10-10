<?php
/**
 * Created by PhpStorm.
 * User: kivegun
 * Date: 10/5/16
 * Time: 7:31 PM
 */
class Visit_type extends FormController
{
    var $FORM_NAME = 'form_visit_type';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_visit_type');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function create()
    {
        //var_dump($_POST);
        $data = array();
        $data['id'] = 0;
        $data['default_name'] = '';
        $data['default_stock'] = '';
        $data['default_active'] = '';
        $data['default_remarks'] = '';
        $data['default_create_date'] = date("Y-m-d H:i:s");
        $data['default_create_user'] = 'a';
        $data['default_last_update'] = '';
        $data['default_last_update_user'] = '';

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Name' => $this->input->post('name'),
                'Stock' => $this->input->post('pharmacy_stock'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
            );
            $id = $this->m_visit_type->insert($data);
            $this->session->set_flashdata(
                'msg', 'Created'
            );
            $this->redirect_if_no_continue('preference/load/visit_type');
        }

    }

    public function edit($id)
    {
        $visit_type = $this->m_visit_type->get($id);
        if (empty($visit_type))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_name'] = $visit_type->Name;
        $data['default_stock'] = $visit_type->Stock;
        $data['default_active'] = $visit_type->Active;
        $data['default_remarks'] = $visit_type->Remarks;
        $data['default_create_date'] = $visit_type->CreateDate;
        $data['default_create_user'] = $visit_type->CreateUser;
        $data['default_last_update'] = $visit_type->LastUpDate;
        $data['default_last_update_user'] = $visit_type->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Name' => $this->input->post('name'),
                'Stock' => $this->input->post('pharmacy_stock'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
            );
            $this->m_visit_type->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/visit_type');
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
        $this->form_validation->set_rules('pharmacy_stock', 'Pharmacy_stock', 'trim|xss_clean|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');
    }

}