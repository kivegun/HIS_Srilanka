<?php

/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 12-Oct-15
 * Time: 9:10 PM
 */
class Patient_Lab_Order extends FormController
{
    var $call_back_items = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_lab_test');
        $this->load->model('m_lab_test_department');
        $this->load->model('m_lab_test_group');
        $this->load->model('m_lab_order');
        $this->load->model('m_lab_order_items');
//        $this->load_form_language();
        $this->load->model('m_user');
        $this->load->model('m_patient');
        $this->load->model('m_opd_visit');
    }

    public function get_lab_test_by_group($lab_test_group_id)
    {
        if (!$lab_test_group_id) {
            echo '[]';
            return;
        }
        $lab_test_group_name = $this->m_lab_test_group->get(urldecode($lab_test_group_id))->Name;
        $data = $this->m_lab_test->get_many_by(array('GroupName' => $lab_test_group_name));
        $results['lab_test'] = array();
        foreach ($data as $row) {
            $tmp_result['LABID'] = $row->LABID;
            $tmp_result['Name'] = $row->Name;
//            $tmp_result['RefValue'] = $row->RefValue;
            $tmp_result['Department'] = $row->Department;
            $tmp_result['Group'] = $row->GroupName;
            array_push($results['lab_test'], $tmp_result);
        }
//        echo json_encode($results);
        return $this->load->view('lab_test_by_group', $results);
    }

    public function create_adm_lab_order($adm_id)
    {
        $this->load->model('m_admission');
        $opd_visit = $this->m_admission->get($adm_id);
        $pid = $opd_visit->PID;
        $this->create($pid, 'ADM', $adm_id);

    }

    public function create_emr_lab_order($emr_id)
    {
        $this->load->model('m_emergency_admission');
        $opd_visit = $this->m_emergency_admission->get($emr_id);
        $pid = $opd_visit->PID;
        $this->create($pid, 'EMR', $emr_id);

    }

    public function create_opd_lab_order($opd_id)
    {
        $this->load->model('m_opd_visit');
        $opd_visit = $this->m_opd_visit->get($opd_id);
        $pid = $opd_visit->PID;
        $this->create($pid, 'OPD', $opd_id);

    }

    public function create($pid, $opdid)
    {
        $data['lab_test_group'][0] = 'Select...';
        foreach ($this->m_lab_test_group->get_all() as $lab_test_group) {
            $data['lab_test_group'][$lab_test_group->LABGRPTID] = $lab_test_group->Name;
        }

        $patient = $this->m_patient->get($pid);
        if (empty($patient))
            die('Pid not exist');

        $opd_visit = $this->m_opd_visit->get($opdid);
        if (empty($opd_visit))
            die('Pid not exist');

        $data['opdid'] = $opdid;
        $data['pid'] = $pid;
        $data['default_lab_order_id'] = '';
        $data['default_order_by'] = $this->session->userdata('name') . ' ' . $this->session->userdata('other_name');
        $data['default_order_date'] = date("Y-m-d");
        $data['default_patient_name'] = $patient->Personal_Title . ' ' . $patient->Personal_Used_Name . ' ' . $patient->Full_Name_Registered . ' ('. $pid .')';
        $data['default_gender'] = $patient->Gender;
        $data['default_age'] = $this->get_age($patient->DateOfBirth);
        $data['default_complaints'] = $opd_visit->Complaint;
        $data['default_doctor'] = $this->session->userdata('title') . $this->session->userdata('name') . ' ' . $this->session->userdata('other_name');

        $this->form_validation->set_rules('OrderDate', 'OrderDate', 'trim|xss_clean|required');

        if ($this->form_validation->run($this) == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Dept' => 'OPD',
                'OBJID' => $opdid,
                'PID' => $pid,
                'OrderDate' => Date('Y-m-d@H:m:s'),
                'OrderBy' => $this->session->userdata('name') . ' ' . $this->session->userdata('other_name'),
                'Status' => 'Pending',
                'Priority' => $this->input->post('Priority'),
                'TestGroupName' => $this->input->post('labTest'),
                'CollectionDateTime' => $this->input->post('CollectionDateTime'),
                'CollectionStatus' => 'Pending',
                'Active' => True
            );
            $lab_order_id = $this->m_lab_order->insert($data);
            foreach ($this->input->post('lab_test') as $lab_id) {
                $item = array(
                    'LAB_ORDER_ID' => $lab_order_id,
                    'Status' => 'Pending',
                    'LABID' => $lab_id,
                    'Active' => True
                );
                $this->m_lab_order_items->insert($item);
            }
            $this->session->set_flashdata(
                'msg', 'Created'
            );
            $this->redirect_if_no_continue('/opd_visit/view/' . $opdid);
        }
    }

    public function get_age($dob)
    {
        $date1 = $dob;
        $date2 = date('Y/m/d');

        $diff = abs(strtotime($date2) - strtotime($date1));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        return array('years' => $years, 'months' => $months, 'days' => $days);
    }

    public function check_pass2($pass2)
    {
        require 'application/config/database.php';
        if ($pass2 != $db['default']['password_2'])
        {
            $this->form_validation->set_message('check_pass2', 'The password 2 you supplied does not match your existing password 2.');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    public function update($order_id)
    {
        $lab_order = $this->m_lab_order->with('group')->get($order_id);
        $data['lab_order'] = $lab_order;
        $data['pid'] = $lab_order->PID;
        $data['default_priority'] = $lab_order->Priority;
        $data['default_test_group'] = $lab_order->group->Name;
        $data['default_create_time'] = $lab_order->CreateDate;
        $data['lab_order_items'] = array();
        foreach ($this->m_lab_order_items->with('lab_test')->get_many_by(array('LAB_ORDER_ID' => $order_id)) as $row) {
            $tmp['ID'] = $row->LAB_ORDER_ITEM_ID;
            $tmp['Name'] = $row->lab_test->Name;
            $tmp['TestResult'] = $row->TestValue;
            $tmp['RefValue'] = $row->lab_test->RefValue;
            array_push($data['lab_order_items'], $tmp);
        }
        $this->call_back_items = $data['lab_order_items'];
        $this->form_validation->set_rules('example', 'Test Result', 'callback_check_result');

        if ($this->form_validation->run($this) == FALSE) {
            $this->load_form($data);
        } else {
            $this->m_lab_order->update($order_id, array('Status' => 'Done'));
            foreach ($this->input->post('result') as $key => $result) {
                $item = array(
                    'Status' => 'Done',
                    'TestValue' => $result,
                );
                $this->m_lab_order_items->update($key, $item);
            }
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('patient_lab_order/search');
        }
    }

    public function update_result($order_id)
    {
        $lab_order = $this->m_lab_order->with('group')->get($order_id);
        $data['lab_order'] = $lab_order;
        $data['pid'] = $lab_order->PID;
        $data['default_priority'] = $lab_order->Priority;
        $data['default_test_group'] = $lab_order->group->Name;
        $data['default_create_time'] = $lab_order->CreateDate;
        $data['lab_order_items'] = array();
        foreach ($this->m_lab_order_items->with('lab_test')->get_many_by(array('LAB_ORDER_ID' => $order_id)) as $row) {
            $tmp['ID'] = $row->LAB_ORDER_ITEM_ID;
            $tmp['Name'] = $row->lab_test->Name;
            $tmp['TestResult'] = $row->TestValue;
            $tmp['RefValue'] = $row->lab_test->RefValue;
            array_push($data['lab_order_items'], $tmp);
        }
        $this->call_back_items = $data['lab_order_items'];
        $this->form_validation->set_rules('example', 'Test Result', 'callback_check_result');
        $this->form_validation->set_rules('password2', 'Password 2', 'trim|required|callback_check_pass2');

        if ($this->form_validation->run($this) == FALSE) {
            $this->qch_template->load_form_layout('update_lab_order', $data);
        } else {
            $this->m_lab_order->update($order_id, array('Status' => 'Done'));
            foreach ($this->input->post('result') as $key => $result) {
                $item = array(
                    'Status' => 'Done',
                    'TestValue' => $result,
                );
                $this->m_lab_order_items->update($key, $item);
            }
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('patient_lab_order/search');
        }
    }

    public function view_result($order_id)
    {
        $lab_order = $this->m_lab_order->with('group')->get($order_id);
        $data['lab_order'] = $lab_order;
        $data['pid'] = $lab_order->PID;
        $data['default_priority'] = $lab_order->Priority;
        $data['default_test_group'] = $lab_order->group->Name;
        $data['default_create_time'] = $lab_order->CreateDate;
        $data['lab_order_items'] = array();
        foreach ($this->m_lab_order_items->with('lab_test')->get_many_by(array('LAB_ORDER_ID' => $order_id)) as $row) {
            $tmp['ID'] = $row->LAB_ORDER_ITEM_ID;
            $tmp['Name'] = $row->lab_test->Name;
            $tmp['TestResult'] = $row->TestValue;
            $tmp['RefValue'] = $row->lab_test->RefValue;
            array_push($data['lab_order_items'], $tmp);
        }
        $this->call_back_items = $data['lab_order_items'];
        $this->form_validation->set_rules('example', 'Test Result', 'callback_check_result');

        if ($this->form_validation->run($this) == FALSE) {
            $this->qch_template->load_form_layout('view_lab_order', $data);
        } else {
            $this->m_lab_order->update($order_id, array('Status' => 'Done'));
            foreach ($this->input->post('result') as $key => $result) {
                $item = array(
                    'Status' => 'Done',
                    'TestValue' => $result,
                );
                $this->m_lab_order_items->update($key, $item);
            }
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('patient_lab_order/search');
        }
    }

    public function check_result($str)
    {
        if (!is_array($this->input->post('result'))) {
            $this->form_validation->set_message('check_result', "Result can't empty");
            return FALSE;
        }
        foreach ($this->call_back_items as $item) {
            if (!array_key_exists($item['ID'], $this->input->post('result'))) {
                $this->form_validation->set_message('check_result', 'Not enough result');
                return FALSE;
            }
        }
        foreach ($this->input->post('result') as $id => $value) {
            if (empty($value)) {
                $this->form_validation->set_message('check_result', 'Result can not empty');
                return FALSE;
            }
        }
        return TRUE;
    }

    public function check_lab_test_param($lab_test)
    {
        if (empty($lab_test) || count($lab_test) <= 0) {
            $this->form_validation->set_message('lab_test', 'Please select lab test');
            return FALSE;
        }
        return TRUE;
    }

    public function get_previous_lab($pid, $continue, $mode = 'HTML')
    {
        $this->load->model("mpatient");
        $data = array();
        $data["patient_lab_order_list"] = $this->m_lab_order->with('group')->with('order_by')->order_by('CreateDate', 'DESC')->get_many_by(array('PID' => $pid));
        $data["continue"] = $continue;
        if ($mode == "HTML") {
            $this->load->vars($data);
            $this->load->view('patient_previous_lab');
        } else {
            return $data["patient_lab_order_list"];
        }
    }

    public function search()
    {
        $this->set_top_selected_menu('patient_lab_order/search');
        $qry = "SELECT
                lab_order.CreateDate,
                LAB_ORDER_ID,
                RefType,
                patient.PID,
                CONCAT(patient.Name,' ',patient.OtherName) AS Patient,
                lab_test_group.Name,
                CONCAT(user.Title, ' ', user.Name,' ',user.OtherName) AS Doctor,
                Priority,
                lab_order.Status
                FROM lab_order
                LEFT JOIN lab_test_group ON lab_test_group.LABGRPTID = lab_order.TestGroupID
                LEFT JOIN patient ON patient.PID = lab_order.PID
                LEFT JOIN user ON user.UID = lab_order.OrderBy
                WHERE (lab_order.Active = 1)";
        $this->load->model('mpager', "page");
        $page = $this->page;
        $page->setSql($qry);
        $page->setDivId("patient_list"); //important
        $page->setDivClass('');
        $page->setRowid('LAB_ORDER_ID');
        $page->setCaption("");
        $page->setShowHeaderRow(true);
        $page->setShowFilterRow(true);
        $page->setShowPager(true);
        $page->setColNames(array(lang("Time"), lang("Order ID"), lang("Department"), lang("Patient ID"), lang("Patient Name"), lang("Lab Test Group"), lang("Doctor"), lang("Priority"), lang("Status")));
        $page->setRowNum(25);
        $page->setColOption("CreateDate", $page->getDateSelector(date('Y-m-d')));
        $page->setColOption("Patient", array("search" => false, "hidden" => false));
        $page->setColOption("PID", array('width' => '100'));
        $page->setColOption("LAB_ORDER_ID", array('width' => '100'));
        $page->setColOption('RefType', array('stype' => 'select',
            'editoptions' => array(
                'value' => ':All;EMR:EMR;OPD:OPD;ADM:ADM'
            ), 'width' => '50'));
        $page->setColOption('Status', array('stype' => 'select',
            'editoptions' => array(
                'value' => ':All;Pending:Pending;Done:Done'
            ), 'width' => '70'));
        $page->setColOption('Priority', array('stype' => 'select',
            'editoptions' => array(
                'value' => ':All;Urgent:Urgent;Normal:Normal'
            ), 'width' => '70'));
        $page->setAfterInsertRow('function(rowid, data){
        var alertText = \'\';
        for (property in data) {
            alertText +=data[property];
        }
        if (alertText.match(/^.*Pending/))
        {
            $(\'#\'+rowid).css({\'background\':\'#ea7d7d\'});
        }
        if (alertText.match(/^.*Done/))
        {
            $(\'#\'+rowid).css({\'background\':\'#7deaea\'});
        }
       }');
        $page->gridComplete_JS
            = "function() {
            $('#patient_list .jqgrow').mouseover(function(e) {
                var rowId = $(this).attr('id');
                $(this).css({'cursor':'pointer'});
            }).mouseout(function(e){
            }).click(function(e){
                var rowId = $(this).attr('id');
                window.location='" . site_url("/patient_lab_order/update_result") . "/'+rowId+'';
            });
            }";
        $page->setOrientation_EL("L");
        $data['pager'] = $page->render(false);
        $this->qch_template->load_form_layout('search', $data);
    }
}