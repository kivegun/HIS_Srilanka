<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admission extends FormController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_patient');
        $this->load->model('m_admission');
        $this->load->model('m_ward');
        $this->load->model('m_hospital');
    }

    public function index()
    {
        return;
    }

    public function create($pid)
    {
        $group_name = $this->session->userdata('user_group_name');
        if (!Modules::run('permission/check_permission', 'opd_visit_New')) {
//            die('You do not have permission!');
            die($this->mdsError());
        }
        $this->load->database();
        $sql="SELECT UID,Title,FirstName,OtherName ";
        $sql .= ' FROM user WHERE (Active = TRUE) AND ((Post = "OPD Doctor") OR (Post = "Consultant")) AND UserGroup = "'.$group_name.'"';
        $sql .= " ORDER BY OtherName ";
        $result = $this->db->query($sql);
        $count = $result->num_rows();
        if ($count == 1) $doctor = $this->session->userdata('title') . ' ' . $this->session->userdata('name') . ' ' . $this->session->userdata('other_name');
        else $doctor = '';
        foreach ($this->m_ward->dropdown('WID', 'Name') as $wid => $name) {
            $data['dropdown_ward'][$wid] = $name;
        }
        $data['pid'] = $pid;
        $data['default_admission_date'] = date("Y-m-d H:i:s");
        $data['default_onset_date'] = date("Y-m-d");
        $data['default_BHT'] = $this->get_current_BHT();
        $data['default_doctor'] = $doctor;
        $data['default_complaint'] = '';
        $data['complaint'] = $this->getComplaints();
        $data['default_ward'] = '';
        $data['default_remarks'] = '';
        $data['default_bed_no'] = '';

        $data['default_create_date'] = date("Y-m-d H:i:s");
        $data['default_create_user'] = $this->session->userdata('name') . ' ' . $this->session->userdata('other_name');
        $data['default_last_update'] = '';
        $data['default_last_update_user'] = '';

        $this->form_validation->set_rules('BHT', 'Bed No', 'trim|xss_clean|required');
        $this->form_validation->set_rules('onset_date', 'Onset Date', 'trim|xss_clean|required');
        $this->form_validation->set_rules('doctor', 'Doctor', 'trim|xss_clean|required');
        $this->form_validation->set_rules('Complaint', 'Complaint', 'trim|xss_clean|required');
        $this->form_validation->set_rules('ward', 'Ward', 'trim|xss_clean|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $insert_data = array(
                'PID' => $pid,
                'AdmissionDate' => date("Y-m-d H:i:s"),
                'OnSetDate' => $this->input->post('onset_date'),
                'BHT' => $this->input->post('BHT'),
                'Doctor' => $this->session->userdata('uid'),
                'Complaint' => $this->input->post('Complaint'),
                'Remarks' => $this->input->post('remarks'),
                'Ward' => $this->input->post('ward'),
                'AdmitTo' => $this->input->post('ward')
            );
            $this->m_admission->insert($insert_data);
            $update_data = array(
                'Current_BHT' => $this->input->post('BHT'),
            );
            $this->m_hospital->update(1, $update_data);
            $this->redirect_if_no_continue('patient/view/' . $pid);
        }
    }

    public function testSave()
    {
        require 'application/config/database.php';

        $gaSql['user']       = $db['default']['username'];
        $gaSql['password']   = $db['default']['password'];
        $gaSql['db']         = $db['default']['database'];
        $gaSql['server']     = $db['default']['hostname'];

        $con = mysqli_connect( $gaSql['server'], $gaSql['user'], $gaSql['password']  );

        mysqli_select_db($con, $gaSql['db'] );

        define('UPLOAD_DIR', 'admission/');
        $img = $_POST['seid'];
        $pid=$_POST['seid1'];

        $res1="SELECT ADMID FROM admission WHERE PID=$pid ORDER BY LastUpDate DESC LIMIT 1";
        $result1 = mysqli_query($con, $res1);
//print $success ? $file : 'Unable to save the file.';

        while ($row= mysqli_fetch_assoc($result1)){
            $admid=$row['ADMID'];
        }
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        if(isset($admid)){
            $file = UPLOAD_DIR . $admid . '.png';
            $success = file_put_contents($file, $data);
        }

        $sql="UPDATE admission SET exam_sketch='admission/$admid.png' WHERE ADMID=$admid";
        //$sql="UPDATE patient_exam SET exam_sketch='patient_exam/$res.png' WHERE PID=$pid AND LastUpDate='$date'";
        $result = mysqli_query($con, $sql);
//print $success ? $file : 'Unable to save the file.';

        echo json_encode($result);
    }

    public function get_bht()
    {
        $hbht = $_GET["bht"];
//        var_dump($hbht);
        $data = explode('/',$hbht);
        if (count($data) != 3) $bht = "Error";
        $year = date('Y');
        $day = date('d');
        $y = $data[0];
        $y_count = $data[1];
        $m_count = $data[2];
        if ( $day == 1) $m_count = 1;
        if ($y <= $year-1) { $y_count = 0;  $m_count = 0; };
        $bht = $year."/".++$y_count."/".++$m_count;
        echo $bht;
    }

    public function get_current_BHT()
    {
        $cbht = $this->m_hospital->get_by(array('HID' => 1));
        $hbht = $cbht->Current_BHT;
//        var_dump($hbht);
        $data = explode('/',$hbht);
        if (count($data) != 3) $bht = "Error";
        $year = date('Y');
        $day = date('d');
        $y = $data[0];
        $y_count = $data[1];
        $m_count = $data[2];
        if ( $day == 1) $m_count = 1;
        if ($y <= $year-1) { $y_count = 0;  $m_count = 0; };
        $bht = $year."/".++$y_count."/".++$m_count;
        return $bht;
    }

    private function getComplaints(){
        $this->load->database();
        $out = "[ ";
        $rep = array("'",  "&");
        $with   = array("\'", "and");

        $sql = " SELECT Name,isNotify 
                FROM complaints WHERE Active = TRUE 
                ORDER BY Name ";
        $con = mysqli_connect('localhost', 'root', '310191', 'mds62');
        $result = mysqli_query($con, $sql);
        if (!$result) {
            return "[]";
        }
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))  {
            $out .= "'".str_replace($rep, $with, $row["Name"])."', ";
        }
        $out .=" '']";


        return $out;
    }

    public function view($adm_id)
    {
        $data = array();
        $data['admission'] = $this->m_admission->as_array()->get($adm_id);
        $data['PID'] = $data['admission']['PID'];
//        $this->load->model('mpersistent');
//        $this->load->model('madmission');
//        $this->load->model('mpatient');
//        $data["admission_drug_order"]  = null;
//        $data["admission_drug_list"]  = null;
//        $data["admission_info"] = $this->madmission->get_info($adm_id);
//        if (isset($data["admission_drug_order"]["admission_prescription_id"])){
//            $data["admission_drug_list"] = $this->madmission->get_drug_order_list($data["admission_drug_order"]["admission_prescription_id"]);
//        }

//        if ($data["admission_info"]["PID"] >0){
//            $data["patient_info"] = $this->mpersistent->open_id($data["admission_info"]["PID"], "patient", "PID");
//        }
//        else{
//            $data["error"] = "Admission Patient  not found";
//            $this->load->vars($data);
//            $this->load->view('admission_error');
//            return;
//        }
//        if (empty($data["patient_info"])){
//            $data["error"] ="Admission Patient not found";
//            $this->load->vars($data);
//            $this->load->view('admission_error');
//            return;
//        }
//        if (isset($data["patient_info"]["DateOfBirth"])) {
//            $data["patient_info"]["Age"] = Modules::run('patient/get_age',$data["patient_info"]["DateOfBirth"]);
//        }
//        $data["PID"] = $data["admission_info"]["PID"];
//        $data['pid'] = $data["admission_info"]["PID"];;
//        $data["ADMID"] = $adm_id;

        $this->render('admission_view', $data);
    }

    public function info($adm_id)
    {
        $data["admission"] = $this->m_admission->with('Doctor')->get($adm_id);
        $this->load->view('admission_info', $data);
    }

    public function ward_transfer($adm_id)
    {
        $data = array();
        $data['adm_id'] = $adm_id;
        $data['admission'] = $this->m_admission->get($adm_id);
        $data['default_name'] = '';
        $data['default_status'] = '';

        foreach ($this->m_ward->dropdown('WID', 'Name') as $wid => $name) {
            if ($wid != $data['admission']->Ward) {
                $data['ward_options'][$wid] = $name;
            } else {
                $data['from_option'][$wid] = $name;
            }
        }

        $this->form_validation->set_rules('transfer_from', 'Transfer from', 'trim|xss_clean|required');
        $this->form_validation->set_rules('transfer_to', 'Transfer to', 'trim|xss_clean|required');

        if ($this->form_validation->run() == FALSE) {
            $this->render('admission_ward_transfer', $data);
        } else {
            $this->m_admission->update($adm_id, array('Ward' => $this->input->post('transfer_to')));
            $insert_data = array(
                'ADMID' => $adm_id,
                'TransferFrom' => $this->input->post('transfer_from'),
                'TransferTo' => $this->input->post('transfer_to'),
            );
            $this->m_admission_transfer->insert($insert_data);
            $this->session->set_flashdata(
                'msg', 'Transferred'
            );
            $this->redirect_if_no_continue('/admission/view/' . $adm_id);
        }
    }

    public function get_previous_ward_transfer($adm_id, $continue = '#', $mode = 'HTML')
    {
        $data = array();
        $data["transfer_list"] = $this->m_admission_transfer->order_by('CreateDate', 'DESC')->with('transfer_to')->with('transfer_from')->get_many_by(array('ADMID' => $adm_id));
        $data["continue"] = $continue;
        if ($mode == "HTML") {
            $this->load->vars($data);
            $this->load->view('previous_transfer');
        } else {
            return $data["transfer_list"];
        }
    }

    public function refer_to_adm($pid, $ref_type, $ref_id)
    {
        $data['pid'] = $pid;
        $data['ref_type'] = $ref_type;
        $data['ref_id'] = $ref_id;
        if ($ref_type == 'EMR') {
            $this->load->model('m_emergency_admission');
            $visit = $this->m_emergency_admission->get($ref_id);
            $complaint = $visit->Complaint;
        } else {
            $this->load->model('m_opd_visit');
            $visit = $this->m_opd_visit->get($ref_id);
            $complaint = $visit->Complaint;
        }

        $data['default_complaint'] = $complaint;
        $data['default_time'] = date("Y-m-d H:i:s");
        $data['default_remarks'] = '';
        $data['default_active'] = '';

        $this->form_validation->set_rules('refer_time', 'Refer Time', 'trim|xss_clean|required');
//        $this->form_validation->set_rules('order_confirm_password', 'Order Password', 'xss_clean|callback_confirm_password_check');

        if ($this->form_validation->run($this) == FALSE) {
            $this->render('refer_to_adm', $data);
        } else {
            $this->load->model('m_refer_to_adm');
            $insert_data = array(
                'PID' => $pid,
                'RefType' => $ref_type,
                'RefID' => $ref_id,
                'Complaint' => $complaint,
                'RefTime' => $this->input->post('refer_time'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
                'Status' => 'Waiting',
                'ReferBy' => $this->get_session('uid')
            );
            $id = $this->m_refer_to_adm->insert($insert_data);
            switch ($ref_type) {
                case 'EMR':
                    $this->load->model('m_emergency_admission');
                    $update_data = array(
                        'refer_to_adm_id' => $id,
                        'Status' => 'Referred'
                    );
                    $this->m_emergency_admission->update($ref_id, $update_data);
                    $this->redirect_if_no_continue('/emergency_visit/view/' . $ref_id);
                    break;
                case 'OPD':
                    $this->load->model('m_opd_visit');
                    $update_data = array(
                        'refer_to_adm_id' => $id,
                        'Status' => 'Referred'
                    );
                    $this->m_opd_visit->update($ref_id, $update_data);
                    $this->redirect_if_no_continue('/opd_visit/view/' . $ref_id);
                    break;
            }
        }
    }

    public function refer_waiting()
    {
        $this->set_top_selected_menu('admission/refer_waiting');
        $qry = "SELECT
                refer_to_adm.ID,
                refer_to_adm.RefTime,
                refer_to_adm.RefType,
                refer_to_adm.PID,
                CONCAT(patient.Name,' ',patient.OtherName) AS Patient,
                refer_to_adm.Remarks
                FROM refer_to_adm
                LEFT JOIN `patient` ON patient.PID = refer_to_adm.PID
                WHERE Status = 'Waiting'
	            ";
        $this->load->model('mpager', "page");
        $page = $this->page;
        $page->setSql($qry);
        $page->setDivId("patient_list"); //important
        $page->setDivClass('');
        $page->setRowid('ID');
        $page->setCaption("");
        $page->setShowHeaderRow(true);
        $page->setShowFilterRow(true);
        $page->setShowPager(true);
        $page->setColNames(array("", lang("Time"), lang("Department"), lang("Patient ID"), lang("Patient Name"), lang("Remarks")));
        $page->setRowNum(25);
        $page->setColOption("ID", array("hidden" => true));
        $page->setColOption("RefTime", $page->getDateSelector(date('Y-m-d')));
        $page->setColOption("RefType", array('stype' => 'select',
            'editoptions' => array(
                'value' => ':All;EMR:EMR;OPD:OPD'
            )));
        $page->setAfterInsertRow('function(rowid, data){
        var alertText = \'\';

        for (property in data)
            alertText +=data[property];
        if (alertText.match(/^.*Critical/))
        {
            $(\'#\'+rowid).css({\'background\':\'#ea7d7d\'});
        }
        }');
        if (Modules::run('permission/check_permission', 'admission_visit', 'create')) {
            $page->gridComplete_JS
                = "function() {
            $('#patient_list .jqgrow').mouseover(function(e) {
                var rowId = $(this).attr('id');
                $(this).css({'cursor':'pointer'});
            }).mouseout(function(e){
            }).click(function(e){
                var rowId = $(this).attr('id');
                window.location='" . site_url("/admission/create") . "/'+rowId+'';
            });
            }";
        }
        $page->setOrientation_EL("L");
        $data['pager'] = $page->render(false);
        $this->render('refer_list', $data);
    }

    public function get_nursing_notes($admid, $continue, $mode = 'HTML')
    {
        $this->load->model("madmission");
        $data = array();
        $data["nursing_notes_list"] = $this->madmission->get_notes_list($admid);
        $data["continue"] = $continue;
        if ($mode == "HTML") {
            $this->load->vars($data);
            $this->load->view('admission_nursing_notes');
        } else {
            return $data["nursing_notes_list"];
        }
    }

}