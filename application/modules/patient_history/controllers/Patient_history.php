<?php

/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 12-Oct-15
 * Time: 9:10 PM
 */
class Patient_History extends FormController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_patient_history');
//        $this->load_form_language();
    }

    public function add($pid)
    {
//        if (!Modules::run('permission/check_permission', 'patient_history', 'create'))
//            die('You do not have permission!');
        $data = array();
        $data['id'] = '';
        $data['pid'] = $pid;
        $data['default_date'] = '';
        $data['default_icd'] = '';
        $data['default_immr'] = '';
        $data['default_remarks'] = '';
        $data['default_active'] = '';

        $data['default_create_date'] = date("Y-m-d H:i:s");
        $data['default_create_user'] = $this->session->userdata('name') . ' ' . $this->session->userdata('other_name');
        $data['default_last_update'] = '';
        $data['default_last_update_user'] = '';

        $this->form_validation->set_rules('ICD_Text', 'ICD Text', 'trim|required');
        $this->form_validation->set_rules('IMMR_Text', 'IMMR Text', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {

            $data = array(
                'PID' => $pid,
                'ICD_Code' => $this->input->post('ICD_Code'),
                'ICD_Text' => $this->input->post('ICD_Text'),
                'IMMR_Code' => $this->input->post('IMMR_Code'),
                'IMMR_Text' => $this->input->post('IMMR_Text'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
                'CreateUser' => $this->session->userdata('name') . ' ' . $this->session->userdata('other_name')
            );
            $this->m_patient_history->insert($data);
            $this->session->set_flashdata(
                'msg', 'Added'
            );
            $this->redirect_if_no_continue(site_url('/patient/view/' . $pid));
        }
    }

    public function edit($history_id)
    {
//        if (!Modules::run('permission/check_permission', 'patient_history', 'edit'))
//            die('You do not have permission!');
        $history = $this->m_patient_history->get($history_id);
        if (empty($history)) {
            die('Id wrong');
        }
        $data = array();
        $data['id'] = $history_id;
        $data['pid'] = $history->PID;
        $data['default_history_of_complaint'] = $history->HistoryOfComplaint;
        $data['default_other_complaint'] = $history->OtherComplaint;
        $data['default_systemic'] = explode(',', $history->SystemicReview);
        $data['default_past_medical_history'] = explode(',', $history->PastMedicalHistory);
        $data['default_surgical_history'] = $history->SurgicalHistory;
        $data['default_family_history'] = $history->FamilyHistory;
        $data['default_travel_history'] = $history->TravelHistory;
        $data['default_social_history'] = $history->SocialHistory;
        $data['default_remarks'] = $history->Remarks;
        $data['default_active'] = $history->Active;

        $this->form_validation->set_rules('active', 'Examination Date', 'trim|xss_clean|required');

//        var_dump($_POST);
//        return;

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            if ($this->input->post('systemic_review') == FALSE) {
                $systemic_review = '';
            } else {
                $systemic_review = implode(',', $this->input->post('systemic_review'));
            }
            $update_data = array(
                'HistoryOfComplaint' => $this->input->post('history_of_complaint'),
                'OtherComplaint' => $this->input->post('other_complaint'),
                'SystemicReview' => $systemic_review,
                'PastMedicalHistory' => implode(',', $this->input->post('past_medical_history')),
                'SurgicalHistory' => $this->input->post('surgical_history'),
                'FamilyHistory' => $this->input->post('family_history'),
                'TravelHistory' => $this->input->post('travel_history'),
                'SocialHistory' => $this->input->post('social_history'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
            );
            $this->m_medical_history->update($history_id, $update_data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue(site_url('/patient/view/' . $history->PID));
        }
    }

    public function load_history($pid)
    {
        $qry
            = "SELECT HID, SUBSTRING(CreateDate,1,10) as dte, HistoryOfComplaint
	FROM medical_history
	where (PID ='" . $pid . "') and (Active = 1)";
        $this->load->model('mpager', 'history_page');
        $history_page = $this->history_page;
        $history_page->setSql($qry);
        $history_page->setDivId("his_cont"); //important
        $history_page->setDivClass('');
        $history_page->setRowid('HID');
        $history_page->setCaption("History");
        $history_page->setShowHeaderRow(false);
        $history_page->setShowFilterRow(false);
        $history_page->setShowPager(false);
        $history_page->setColNames(array("PID", "", ""));
        $history_page->setRowNum(25);
        $history_page->setColOption("HID", array("search" => false, "hidden" => true));
        $history_page->setColOption("dte", array("search" => false, "hidden" => false, "width" => 70));
        $history_page->gridComplete_JS = "function() {
        $('#his_cont .jqgrow').mouseover(function(e) {
            var rowId = $(this).attr('id');
            $(this).css({'cursor':'pointer'});
        }).mouseout(function(e){
        }).click(function(e){
            var rowId = $(this).attr('id');
           window.location='" . site_url("patient_history/edit") . "/'+rowId+'?CONTINUE=patient/view/" . $pid . "';
        });
        }";
        $history_page->setOrientation_EL("L");
        echo $history_page->render(false);
    }

    public function get_previous_history($pid, $continue, $mode = 'HTML')
    {
        $data["patient_history_list"] = $this->m_medical_history->as_array()->order_by('CreateDate', 'DESC')->get_many_by(array('PID' => $pid));
        $data["continue"] = $continue;
        if ($mode == "HTML") {
            $this->load->vars($data);
            $this->load->view('patient_previous_history');
        } else {
            return $data["patient_history_list"];
        }
    }
}