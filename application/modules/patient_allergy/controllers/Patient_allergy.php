<?php

/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 12-Oct-15
 * Time: 9:10 PM
 */
class Patient_Allergy extends FormController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_patient_allergy');
    }

    public function add($pid)
    {
        $data = array();
        $data['id'] = '';
        $data['pid'] = $pid;
        $data['default_name'] = '';
        $data['default_status'] = '';
        $data['default_active'] = '';
        $data['default_remarks'] = '';

        $data['default_create_date'] = date("Y-m-d H:i:s");
        $data['default_create_user'] = 'a';
        $data['default_last_update'] = '';
        $data['default_last_update_user'] = '';

        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|xss_clean|required');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Name' => $this->input->post('name'),
                'Status' => $this->input->post('status'),
                'Active' => $this->input->post('active'),
                'Remarks' => $this->input->post('remarks'),
                'PID' => $pid
            );
            $this->m_patient_allergy->insert($data);
            $this->session->set_flashdata(
                'msg', 'REC: Allergy created for ' . $pid
            );
            $this->redirect_if_no_continue('/patient/view/' . $pid);
        }
    }

    public function edit($allergy_id)
    {
        $allergy = $this->m_patient_allergy->get($allergy_id);
        if (empty($allergy)) {
            die('Id wrong');
        }
        $data = array();
        $data['id'] = $allergy_id;
        $data['pid'] = $allergy->PID;
        $data['default_name'] = $allergy->Name;
        $data['default_status'] = $allergy->Status;
        $data['default_active'] = $allergy->Active;
        $data['default_remarks'] = $allergy->Remarks;

        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
        $this->form_validation->set_rules('status', 'Status', 'trWim|xss_clean|required');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $update_data = array(
                'Name' => $this->input->post('name'),
                'Status' => $this->input->post('status'),
                'Active' => $this->input->post('active'),
                'Remarks' => $this->input->post('remarks'),
            );
            $this->m_patient_allergy->update($allergy_id, $update_data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/patient/view/' . $allergy->PID);
        }
    }

    public function get_previous_allergy($pid, $continue, $mode = 'HTML')
    {
        $data = array();
        $data["patient_allergy_list"] = $this->m_patient_allergy->as_array()->order_by('CreateDate', 'DESC')->get_many_by(array('PID' => $pid, 'Active' => 1));
        $data["continue"] = $continue;
        if ($mode == "HTML") {
            $this->load->vars($data);
            $this->load->view('patient_previous_allergy');
        } else {
            return $data["patient_allergy_list"];
        }
    }
}