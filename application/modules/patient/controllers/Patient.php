<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Patient extends FormController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('my_crud');
        $this->load->model('m_patient');
        $this->load->model('m_patient_allergy');
//        $this->load_form_language();
    }

    public function get_full_info($patient_id)
    {
        $patient = $this->m_patient->with('district')->with('province')->get($patient_id);
        return $patient;
    }

    public function create()
    {
//        $this->set_top_selected_menu('patient/create');
//        if (!Modules::run('permission/check_permission', 'patient', 'create'))
//            die('You do not have permission!');
        $data = array();
        $data['id'] = 0;
        $data['default_title'] = '';
        $data['default_name'] = '';
        $data['default_other_name'] = '';
        $data['default_clinic_number'] = '';
        $data['default_gender'] = '';
        $data['default_civil_status'] = '';
        $data['default_date_of_birth'] = '';
        $data['default_nic'] = '';
        $data['default_telephone'] = '';
        $data['default_address_1'] = '';
        $data['default_address_2'] = '';
        $data['default_village'] = '';
        $data['default_remarks'] = '';

        $data['default_create_date'] = date("Y-m-d H:i:s");
        $data['default_create_user'] = 'a';
        $data['default_last_update'] = '';
        $data['default_last_update_user'] = '';

//        $data['default_district'] = '55';
//        $data['dropdown_district'] = $this->get_district(4, 'return');
//        $data['default_province'] = '4';
//        $data['dropdown_provinces'] = $this->get_dsdivision('result');
//        $data['default_health_unit'] = '499';
//        $data['dropdown_health_unit'] = $this->get_gndivision(55, 'return');
        $this->set_common_validation();


        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Personal_Title' => $this->input->post('title'),
                'Full_Name_Registered' => $this->input->post('name'),
                'Personal_Used_Name' => $this->input->post('other_name'),
                'ClinicNo' => $this->input->post('clinic_number'),
                'Gender' => $this->input->post('gender'),
                'Personal_Civil_Status' => $this->input->post('civil_status'),
                'DateOfBirth' => $this->input->post('date_of_birth'),
                'NIC' => $this->input->post('NIC'),
                'Telephone' => $this->input->post('telephone'),
                'Address_Street' => $this->input->post('address_1'),
                'Address_Street1' => $this->input->post('address_2'),
                'Address_Village' => $this->input->post('Address_Village'),
                'Address_DSDivision' => $this->input->post('Address_DSDivision'),
                'Address_District' => $this->input->post('Address_District'),
                'Active' => 0,
                'Remarks' => $this->input->post('remarks'),
            );
            $this->m_patient->insert($data);
            //redirect
            $this->session->set_flashdata(
                'msg', 'created'
            );
            $this->redirect_if_no_continue('/patient/search');
        }
    }

    private function set_common_validation()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|xss_clean');
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required|callback_cleanName');
        $this->form_validation->set_rules('other_name', 'Other Name', 'trim|xss_clean|callback_cleanName');
        $this->form_validation->set_rules('clinic_number', 'Clinic Number', 'trim|xss_clean|callback_cleanAddress');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|xss_clean|required');
        $this->form_validation->set_rules('civil_status', 'Civil Status', 'trim|xss_clean');
        $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|xss_clean|required');
        $this->form_validation->set_rules('NIC', 'NIC', 'trim|xss_clean|callback_checkNIC');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim|xss_clean|callback_cleanNumber');
        $this->form_validation->set_rules('address_1', 'Address 1', 'trim|xss_clean|required|callback_cleanAddress');
        $this->form_validation->set_rules('address_2', 'Address 2', 'trim|xss_clean|callback_cleanAddress');
        $this->form_validation->set_rules('Address_Village', 'Village', 'trim|xss_clean|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean|callback_cleanNumber');

    }

    public function sanitize($data){
        require 'application/config/database.php';
        $link = mysqli_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($link, $data);
        $data = stripslashes($data);
        return $data;
    }

    public function cleanName($text){
        require 'application/config/database.php';
        $link = mysqli_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);
        $text = preg_replace('/[\x00-\x1F\x7F\<\>\,\"\'\(\)\{\}\[\]\/\%\$\#\@\;\:\^\?\/\\\+\-\=\*\&0-9]/', '', $text);
        $possible_injection = array("SCRIPT", "script", "ScRiPt","PHP","php","alert","eval","java","type","hello");
        $replace   = array("", "", "","", "", "","");
        $text = str_replace($possible_injection, $replace, $text);
        $text = trim($text);
        $text = htmlspecialchars($text);
        $text = mysqli_real_escape_string($link, $text);
        $text = stripslashes($text);
        $text = strtoupper($text);
        return $text;
    }

    public function cleanNumber($text){
        require 'application/config/database.php';
        $link = mysqli_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);
        $text = preg_replace('/[\x00-\x1F\x7F\<\>\,\"\'\(\)\{\}\[\]\/\%\$\#\@\;\:\^\?\/\\\+\*\&]/', '', $text);
        $possible_injection = array("SCRIPT", "script", "ScRiPt","PHP","php","alert","eval");
        $replace   = array("", "", "","", "", "","");
        $text = str_replace($possible_injection, $replace, $text);
        $text = trim($text);
        $text = htmlspecialchars($text);
        $text = mysqli_real_escape_string($link, $text);
        $text = stripslashes($text);
        return $text;
    }

    public function cleanAddress($text){
        require 'application/config/database.php';
        $link = mysqli_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);
        $text = preg_replace('/[\x00-\x1F\x7F\<\>\,\"\'\{\}\[\]\%\$\#\@\;\:\^\?\+\*\&]/', '', $text);
        $possible_injection = array("SCRIPT", "script", "ScRiPt","PHP","php","alert","eval");
        $replace   = array("", "", "","", "", "","");
        $text = str_replace($possible_injection, $replace, $text);
        $text = trim($text);
        $text = htmlspecialchars($text);
        $text = mysqli_real_escape_string($link, $text);
        $text = stripslashes($text);
        return $text;
    }
    public function checkNIC($nic)
    {
        $this->form_validation->set_message('checkNIC', 'The NIC is not valid');

        return $nic === '' || (bool) preg_match('/^\d{9}[xXvV]$/', $nic);
    }
    public function checkDOB($dob){
        $reg = '/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/';
        return preg_match($reg,$dob);
    }


//    private function insert()
//    {
//        if (!$this->input->post('bi_id_checkbox') && $this->input->post('bi_id') && strlen($this->input->post('bi_id')) > 0)
//            $bi_id = $this->input->post('bi_id');
//        else
//            $bi_id = NULL;
//        if (!$this->input->post('nuit_id_checkbox') && $this->input->post('nuit_id') && strlen($this->input->post('nuit_id')) > 0)
//            $nuit_id = $this->input->post('nuit_id');
//        else
//            $nuit_id = NULL;
//        $data = array(
//            'Personal_Title' => $this->input->post('title'),
//            'Name' => $this->input->post('name'),
//            'OtherName' => $this->input->post('other_name'),
//            'Gender' => $this->input->post('gender'),
//            'Personal_Civil_Status' => $this->input->post('civil_status'),
//            'DateOfBirth' => $this->input->post('date_of_birth'),
//            'Occupation' => $this->input->post('occupation'),
//            'BI_ID' => $bi_id,
//            'NUIT_ID' => $nuit_id,
//            'Telephone' => $this->input->post('telephone'),
//            'Address_Street' => $this->input->post('address'),
////            'Address_Village' => $this->input->post('village'),
//            'Remarks' => $this->input->post('remarks'),
//            'who_province_id' => $this->input->post('province'),
//            'who_district_id' => $this->input->post('district'),
//            'who_health_unit_id' => $this->input->post('health_unit'),
//        );
//        $id = $this->m_patient->insert($data);
//        //redirect
//        $this->session->set_flashdata(
//            'msg', 'REC: ' . ucfirst(strtolower($this->input->post("name"))) . ' created'
//        );
//        $this->redirect_if_no_continue('/patient/search');
//    }

//    public function get_dropdown_provinces($type = 'json')
//    {
//        $this->load->model('m_who_provinces');
//        $result = $this->m_who_provinces->order_by('name')->dropdown('province_code', 'name');
//        if ($type == 'json') {
//            print(json_encode($result));
//        }
//        return $result;
//    }
//
//    public function get_district($province_id = 4, $type = 'json')
//    {
//        $this->load->model('m_who_district');
//        $result = $this->m_who_district->order_by('name')->get_many_by(array('province_code' => $province_id));
//        if ($type == 'json') {
//            print(json_encode($result));
//        } else {
//            foreach ($result as $item) {
//                $drop_down[$item->district_code] = $item->name;
//            }
//            return $drop_down;
//        }
//    }
//
//    public function get_health_unit($district_id = 55, $type = 'json')
//    {
//        $this->load->model('m_who_health_unit');
//        $result = $this->m_who_health_unit->order_by('US')->get_many_by(array('CD' => $district_id));
//        if ($type == 'json') {
//            print(json_encode($result));
//        } else {
//            foreach ($result as $item) {
//                $drop_down[$item->id] = $item->US;
//            }
//            return $drop_down;
//        }
//    }



    public function edit($id)
    {
//        if (!Modules::run('permission/check_permission', 'patient', 'edit')) {
//            die('You do not have permission');
//        }
        $patient = $this->m_patient->get($id);
        if (empty($patient))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_title'] = $patient->Personal_Title;
        $data['default_name'] = $patient->Full_Name_Registered;
        $data['default_other_name'] = $patient->Personal_Used_Name;
        $data['default_clinic_number'] = $patient->ClinicNo;
        $data['default_gender'] = $patient->Gender;
        $data['default_civil_status'] = $patient->Personal_Civil_Status;
        $data['default_date_of_birth'] = $patient->DateOfBirth;
        $data['default_nic'] = $patient->NIC;
        $data['default_telephone'] = $patient->Telephone;
        $data['default_address_1'] = $patient->Address_Street;
        $data['default_address_2'] = $patient->Address_Street1;
        $data['default_village'] = $patient->Address_Village;
        $data['default_remarks'] = $patient->Remarks;

        $data['default_create_date'] = $patient->CreateDate;
        $data['default_create_user'] = $patient->CreateUser;
        $data['default_last_update'] = $patient->LastUpDate;
        $data['default_last_update_user'] = $patient->LastUpDateUser;

//        $data['default_province'] = $patient->who_province_id;
//        $data['dropdown_provinces'] = $this->get_dropdown_provinces('result');
//        $data['default_district'] = $patient->who_district_id;
//        if ($patient->who_province_id) {
//            $data['dropdown_district'] = $this->get_district($patient->who_province_id, 'return');
//        } else {
//            $data['dropdown_district'] = array();
//        }
//        $data['default_health_unit'] = $patient->who_health_unit_id;
//        if ($patient->who_health_unit_id) {
//            $data['dropdown_health_unit'] = $this->get_health_unit($patient->who_district_id, 'return');
//        } else {
//            $data['dropdown_health_unit'] = array();
//        }

        $this->set_common_validation($id);
        if ($this->form_validation->run($this) == FALSE) {
            $this->render('form_patient_edit', $data);
        } else {
            $this->update($id);
        }
    }

    private function update($id)
    {
//        if (!$this->input->post('bi_id_checkbox') && $this->input->post('bi_id') && strlen($this->input->post('bi_id')) > 0)
//            $bi_id = $this->input->post('bi_id');
//        else
//            $bi_id = NULL;
//        if (!$this->input->post('nuit_id_checkbox') && $this->input->post('nuit_id') && strlen($this->input->post('nuit_id')) > 0)
//            $nuit_id = $this->input->post('nuit_id');
//        else
//            $nuit_id = NULL;
        $data = array(
            'Personal_Title' => $this->input->post('title'),
            'Full_Name_Registered' => $this->input->post('name'),
            'Personal_Used_Name' => $this->input->post('other_name'),
            'ClinicNo' => $this->input->post('clinic_number'),
            'Gender' => $this->input->post('gender'),
            'Personal_Civil_Status' => $this->input->post('civil_status'),
            'DateOfBirth' => $this->input->post('date_of_birth'),
            'NIC' => $this->input->post('NIC'),
            'Telephone' => $this->input->post('telephone'),
            'Address_Street' => $this->input->post('address_1'),
            'Address_Street1' => $this->input->post('address_2'),
            'Address_Village' => $this->input->post('Address_Village'),
            'Address_DSDivision' => $this->input->post('Address_DSDivision'),
            'Address_District' => $this->input->post('Address_District'),
            'Remarks' => $this->input->post('remarks'),
        );
        $this->m_patient->update($id, $data);

        $this->session->set_flashdata(
            'msg', 'REC: ' . ucfirst(strtolower($this->input->post("name"))) . ' updated'
        );
        $this->redirect_if_no_continue('/patient/view/' . $id);
    }

    public
    function check_national_id($national_id, $pid)
    {
//        var_dump('check national ID' . $national_id);
        if ($this->input->post('bi_id_checkbox')) {
            $bi_id = '';
        } else {
            $bi_id = $this->input->post('bi_id');
        }
        if ($this->input->post('nuit_id_checkbox')) {
            $nuit_id = '';
        } else {
            $nuit_id = $this->input->post('nuit_id');
        }
        if (empty($bi_id) && empty($nuit_id)) {
            $this->form_validation->set_message('check_national_id', lang('Patient must have at least one national ID'));
            return false;
        }
        if (!empty($bi_id)) {
            $patient_have_id = $this->m_patient->get_by(array('BI_ID' => $bi_id));
            if (!empty($patient_have_id) && $patient_have_id->PID != $pid) {
                $this->form_validation->set_message('check_national_id', lang('BI is duplicated'));
                return false;
            }
        }
        if (!empty($nuit_id)) {
            $patient_have_id = $this->m_patient->get_by(array('NUIT_ID' => $nuit_id));
            if (!empty($patient_have_id) && $patient_have_id->PID != $pid) {
                $this->form_validation->set_message('check_national_id', lang('NUIT is duplicated'));
                return false;
            }
        }
        return TRUE;
    }

    public function index()
    {
        echo "nothing here";
    }

    public function banner($id, $extra = '')
    {
        if (!isset($id) || (!is_numeric($id))) {
            $data["error"] = "Patien not found";
            $this->load->vars($data);
            $this->load->view('patient_error');
            return;
        }
        $this->load->model('mpersistent');
        $data["patient_info"] = $this->mpersistent->open_id($id, "patient", "PID");
        $data['extra'] = $extra;
        if (empty($data["patient_info"])) {
            $data["text"] = '<br>Patient not found <br><input  class=\'formButton\' type=\'button\' value=\'Ok\' onclick=history.back();>';
            $data["head"] = 'Error';
            $data["w"] = 300;
            $data["h"] = 100;
            $this->load->vars($data);
            $this->load->view('patient_error');
            return;
        }
        if (isset($data["patient_info"]["DateOfBirth"])) {
            $data["patient_info"]["Age"] = $this->get_age($data["patient_info"]["DateOfBirth"]);
        }
//        $data["patient_info"]["HIN"] = $this->print_hin($data["patient_info"]["HIN"]);

        $this->load->vars($data);
        $this->load->view('patient_banner');
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

    public function print_hin($hin)
    {
        return substr($hin, 0, 4) . '-' . substr($hin, 4, 6) . "-" . substr($hin, 10, 1);
    }

    public
    function get_previous_lab($pid, $continue, $mode = 'HTML')
    {
        $this->load->model("mpatient");
        $data = array();
        $data["patient_lab_order_list"] = $this->mpatient->get_lab_order_list($pid);
        $data["continue"] = $continue;
        if ($mode == "HTML") {
            $this->load->vars($data);
            $this->load->view('patient_previous_lab');
        } else {
            return $data["patient_lab_order_list"];
        }
    }

    public
    function open_model($id)
    {
        $this->load->model('mpersistent');
        $this->mpersistent->load('patient');
        $this->mpersistent->open_id($id);
    }

    public
    function reffer_to_clinic($id = null)
    {
        if (!Modules::run('security/check_edit_access', 'clinic_patient', 'can_edit')) {
            $data["error"] = " User group '" . $this->session->userdata('UserGroup') . "' have no rights to edit this data";
            $this->load->vars($data);
            $this->load->view('patient_error');
            exit;
        }
        $this->load->model('mpersistent');
        $data["patient_info"] = $this->mpersistent->open_id($id, "patient", "PID");

        if (empty($data["patient_info"])) {
            $data["error"] = "Patient not found";
            $this->load->vars($data);
            $this->load->view('patient_error');
        }
        if (isset($data["patient_info"]["DateOfBirth"])) {
            $data["patient_info"]["Age"] = $this->get_age($data["patient_info"]["DateOfBirth"]);
        }
        $data["patient_info"]["HIN"] = $this->print_hin($data["patient_info"]["HIN"]);
        $data["id"] = $id;
        $this->load->vars($data);
        $this->load->view('patient_clinic');
    }


    public
    function clinic($id = null)
    {
        if (!Modules::run('security/check_edit_access', 'clinic_patient', 'can_edit')) {
            $data["error"] = " User group '" . $this->session->userdata('UserGroup') . "' have no rights to edit this data";
            $this->load->vars($data);
            $this->load->view('patient_error');
            exit;
        }
        $this->load->model('mpersistent');
        $this->load->model('mclinic');
        $data["patient_info"] = $this->mpersistent->open_id($id, "patient", "PID");

        if (empty($data["patient_info"])) {
            $data["error"] = "Patient not found";
            $this->load->vars($data);
            $this->load->view('patient_error');
        }
        if (isset($data["patient_info"]["DateOfBirth"])) {
            $data["patient_info"]["Age"] = $this->get_age($data["patient_info"]["DateOfBirth"]);
        }
        $data["patient_info"]["HIN"] = $this->print_hin($data["patient_info"]["HIN"]);

        $data["pid"] = $id;
        $data["clinic_list"] = $this->mclinic->get_clinic_list($data["patient_info"]["Gender"]);
        if (!empty($data["clinic_list"])) {
            for ($i = 0; $i < count($data["clinic_list"]); ++$i) {
                $data["clinic_list"][$i]["assigned_clinic"] = $this->mclinic->is_patient_assigned($id, $data["clinic_list"][$i]["clinic_id"]);
            }
        }
        $this->load->vars($data);
        $this->load->view('patient_clinic');
    }

    public
    function view($id = NULL)
    {
        $this->load->model('mpersistent');
//        $this->load->model('mquestionnaire');
        $this->load->helper('file');
        $data["patient_info"] = $this->mpersistent->open_id($id, "patient", "PID");

        if (empty($data["patient_info"])) {
            $data["error"] = "Patient not found";
            $this->load->vars($data);
            $this->load->view('patient_error');
        }
        if (isset($data["patient_info"]["DateOfBirth"])) {
            $data["patient_info"]["Age"] = $this->get_age($data["patient_info"]["DateOfBirth"]);
        }
//        if (get_file_info('./attach/' . $data["patient_info"]["HIN"] . '/' . $data["patient_info"]["HIN"] . '_portrait.jpg')) {
//            $data["image"] = base_url() . 'attach/' . $data["patient_info"]["HIN"] . '/' . $data["patient_info"]["HIN"] . '_portrait.jpg';
//        } else {
//            $data["image"] = base_url() . '/images/patient.jpg';
//        }
        $data["id"] = $id;

//        $data["previous_emergency_visit"] = $this->previous_emergency_visit($id);
//        $data["previous_opd_visits"] = $this->previousVisits($id);
//        $data["admissions"] = $this->loadAdmission($id);
//        $data["exams"] = $this->loadExam($id);
//        $data['patient_history'] = $this->loadHistory($id);
//        $data["allergy"] = $this->loadAlergy($id);
////        $data["lab_orders"] = $this->loadLabOrder($id);
////        $data["prescriptions"] = $this->loadPrescription($id);
//        $data["notes"] = $this->loadNotes($id);

        $this->qch_template->load_form_layout('patient_view', $data);
    }

    private
    function previous_emergency_visit($pid)
    {
        $qry = "SELECT EMRID, SUBSTRING(DateTimeOfVisit,1,10), Severity, Complaint, Status  FROM emergency_admission WHERE PID = " . $pid;
        $this->load->model('mpager', 'emr_visit_page');
        $visit_page = $this->emr_visit_page;
        $visit_page->setSql($qry);
        $visit_page->setDivId("emr_cont"); //important
        $visit_page->setDivClass('');
        $visit_page->setRowid('EMRID');
        $visit_page->setCaption("Previous emergency visits");
        $visit_page->setShowHeaderRow(false);
        $visit_page->setShowFilterRow(false);
        $visit_page->setShowPager(false);
        $visit_page->setColNames(array("", "", "", "", ""));
        $visit_page->setRowNum(25);
        $visit_page->setColOption("EMRID", array("search" => false, "hidden" => true));
        $visit_page->gridComplete_JS
            = "function() {
        $('#emr_cont .jqgrow').mouseover(function(e) {
            var rowId = $(this).attr('id');
            $(this).css({'cursor':'pointer'});
        }).mouseout(function(e){
        }).click(function(e){
            var rowId = $(this).attr('id');
            window.location='" . site_url("emergency_visit/view") . "/'+rowId;
        });
        }";
        $visit_page->setOrientation_EL("L");
        return $visit_page->render(false);
    }

    private
    function previousVisits($pid)
    {
        $qry
            = "SELECT opd_visits.OPDID , SUBSTRING(opd_visits.DateTimeOfVisit,1,10) as dte,opd_visits.Complaint,
	CONCAT(user.Title,user.OtherName )
	FROM opd_visits
	LEFT JOIN `user` ON user.UID = opd_visits.Doctor
	where (opd_visits.PID ='" . $pid . "')";
        $this->load->model('mpager', 'visit_page');
        $visit_page = $this->visit_page;
        $visit_page->setSql($qry);
        $visit_page->setDivId("opd_cont"); //important
        $visit_page->setDivClass('');
        $visit_page->setRowid('OPDID');
        $visit_page->setCaption("Previous OPD visits");
        $visit_page->setShowHeaderRow(false);
        $visit_page->setShowFilterRow(false);
        $visit_page->setShowPager(false);
        $visit_page->setColNames(array("ID", "", "", ""));
        $visit_page->setRowNum(25);
        $visit_page->setColOption("OPDID", array("search" => false, "hidden" => true));
        $visit_page->setColOption("dte", array("search" => false, "hidden" => false, "width" => 75));
        $visit_page->gridComplete_JS
            = "function() {
        $('#opd_cont .jqgrow').mouseover(function(e) {
            var rowId = $(this).attr('id');
            $(this).css({'cursor':'pointer'});
        }).mouseout(function(e){
        }).click(function(e){
            var rowId = $(this).attr('id');
            window.location='" . site_url("opd_visit/view") . "/'+rowId;
        });
        }";
        $visit_page->setOrientation_EL("L");
        return $visit_page->render(false);
    }

    private
    function loadAdmission($pid)
    {
        $qry
            = "SELECT admission.ADMID , SUBSTRING(admission.AdmissionDate,1,10) as dte,admission.Complaint,admission.OutCome,
	CONCAT(user.Title,user.OtherName )
	FROM admission,user
	where (admission.PID ='" . $pid . "') and (user.UID = admission.Doctor) 	";
        $this->load->model('mpager', 'admission_page');
        $admission_page = $this->admission_page;
        $admission_page->setSql($qry);
        $admission_page->setDivId("adm_cont"); //important
        $admission_page->setDivClass('');
        $admission_page->setRowid('ADMID');
        $admission_page->setCaption("Previous admissions");
        $admission_page->setShowHeaderRow(false);
        $admission_page->setShowFilterRow(false);
        $admission_page->setShowPager(false);
        $admission_page->setColNames(array("ID", "", "", "", ""));
        $admission_page->setRowNum(25);
        $admission_page->setColOption("ADMID", array("search" => false, "hidden" => true));
        $admission_page->setColOption("dte", array("search" => false, "hidden" => false, "width" => 75));
        $admission_page->gridComplete_JS
            = "function() {
        $('#adm_cont .jqgrow').mouseover(function(e) {
            var rowId = $(this).attr('id');
            $(this).css({'cursor':'pointer'});
        }).mouseout(function(e){
        }).click(function(e){
            var rowId = $(this).attr('id');
           window.location='" . site_url("admission/view") . "/'+rowId+'';        });
        }";
        $admission_page->setOrientation_EL("L");
        return $admission_page->render(false);
    }

    private
    function loadExam($pid)
    {
        $qry
            = "SELECT patient_exam.PATEXAMID ,
	SUBSTRING(patient_exam.ExamDate,1,10) as dte,
	CONCAT(patient_exam.sys_BP,' / ',patient_exam.diast_BP) as bp,
	CONCAT(patient_exam.Weight,'Kg.') as weight,
	CONCAT(patient_exam.Height,'m') as height,
	CONCAT(patient_exam.Temperature,'`C')
	FROM patient_exam
	where (patient_exam.PID ='" . $pid . "') and(patient_exam.Active = 1)";
        $this->load->model('mpager', 'exam_page');
        $exams_page = $this->exam_page;
        $exams_page->setSql($qry);
        $exams_page->setDivId("exam_cont"); //important
        $exams_page->setDivClass('');
        $exams_page->setRowid('PATEXAMID');
        $exams_page->setCaption("Examinations");
        $exams_page->setShowHeaderRow(false);
        $exams_page->setShowFilterRow(false);
        $exams_page->setShowPager(false);
        $exams_page->setColNames(array("ID", "", "", "", "", ""));
        $exams_page->setRowNum(25);
        $exams_page->setColOption("PATEXAMID", array("search" => false, "hidden" => true));
        $exams_page->setColOption("dte", array("search" => false, "hidden" => false, "width" => 75));
        $exams_page->setColOption("bp", array("search" => false, "hidden" => false, "width" => 100));
        $exams_page->setColOption("weight", array("search" => false, "hidden" => false, "width" => 70));
        $exams_page->gridComplete_JS = "function() {
        $('#exam_cont .jqgrow').mouseover(function(e) {
            var rowId = $(this).attr('id');
            $(this).css({'cursor':'pointer'});
        }).mouseout(function(e){
        }).click(function(e){
            var rowId = $(this).attr('id');
           window.location='" . site_url("patient_examination/edit") . "/'+rowId+'?CONTINUE=patient/view/" . $pid . "';
        });
        }";
        $exams_page->setOrientation_EL("L");
        return $exams_page->render(false);
    }

    private
    function loadAlergy($pid)
    {
        $qry
            = "SELECT patient_allergy.ALLERGYID ,
	SUBSTRING(patient_allergy.CreateDate,1,10) as dte,
	patient_allergy.Name,
	patient_allergy.Status
	FROM patient_allergy
	where (patient_allergy.PID ='" . $pid . "') and (patient_allergy.Active = 1)";
        $this->load->model('mpager', 'alergy_page');
        $alergy_page = $this->alergy_page;
        $alergy_page->setSql($qry);
        $alergy_page->setDivId("alergy_cont"); //important
        $alergy_page->setDivClass('');
        $alergy_page->setRowid('ALLERGYID');
        $alergy_page->setCaption("Allergies");
        $alergy_page->setShowHeaderRow(false);
        $alergy_page->setShowFilterRow(false);
        $alergy_page->setShowPager(false);
        $alergy_page->setColNames(array("ID", "", "", ""));
        $alergy_page->setRowNum(25);
        $alergy_page->setColOption("ALLERGYID", array("search" => false, "hidden" => true));
        $alergy_page->setColOption("dte", array("search" => false, "hidden" => false, "width" => 70));
        $alergy_page->gridComplete_JS = "function() {
        $('#alergy_cont .jqgrow').mouseover(function(e) {
            var rowId = $(this).attr('id');
            $(this).css({'cursor':'pointer'});
        }).mouseout(function(e){
        }).click(function(e){
            var rowId = $(this).attr('id');
           window.location='" . site_url("patient_allergy/edit") . "/'+rowId+'?CONTINUE=patient/view/" . $pid . "';
        });
        }";
        $alergy_page->setOrientation_EL("L");
        return $alergy_page->render(false);
    }

    private
    function loadLabOrder($pid)
    {
        $qry = "SELECT lab_order.LAB_ORDER_ID ,
	SUBSTRING(lab_order.OrderDate,1,10) as dte,
	lab_test_group.Name as TestGroupName,
	lab_order.Status
	FROM lab_order
	LEFT JOIN lab_test_group ON lab_test_group.LABGRPTID = lab_order.TestGroupID
	WHERE (lab_order.PID ='" . $pid . "') and (lab_order.Active = 1)";
        $this->load->model('mpager', 'lab_order_page');
        $lab_order_page = $this->lab_order_page;
        $lab_order_page->setSql($qry);
        $lab_order_page->setDivId("lab_cont"); //important
        $lab_order_page->setDivClass('');
        $lab_order_page->setRowid('LAB_ORDER_ID');
        $lab_order_page->setCaption("Latest lab results");
        $lab_order_page->setShowHeaderRow(false);
        $lab_order_page->setShowFilterRow(false);
        $lab_order_page->setColNames(array("ID", "", "", ""));
        $lab_order_page->setRowNum(25);
        $lab_order_page->setColOption("LAB_ORDER_ID", array("search" => false, "hidden" => false, "width" => 30));
        $lab_order_page->setColOption("dte", array("search" => false, "hidden" => false, "width" => 80));
        $lab_order_page->setColOption("TestGroupName", array("search" => false, "hidden" => false, "width" => 120));
        $lab_order_page->setColOption("Status", array("search" => false, "hidden" => false, "width" => 70));

        $lab_order_page->gridComplete_JS = "function() {
		$('div[id ^= \"pager\"]').hide();
        $('#lab_cont .jqgrow').mouseover(function(e) {
            var rowId = $(this).attr('id');
            $(this).css({'cursor':'pointer'});
        }).mouseout(function(e){
        }).click(function(e){
            var rowId = $(this).attr('id');
            window.location='" . site_url("patient_lab_order/update") . "/'+rowId+'?CONTINUE=patient/view/$pid';
        });
        }";
        $lab_order_page->setOrientation_EL("L");
        return $lab_order_page->render(false);
    }

    private
    function loadPrescription($pid)
    {
        $qry
            = "SELECT
                SUBSTRING(patient_prescription_have_drug.CreateDate,1,10) as dte,
                who_drug.name as Name,
                patient_prescription_have_drug.Period as HowLong,
                drugs_dosage.Dosage as Dosage,
                drugs_frequency.Frequency as Frequency
            FROM patient_prescription_have_drug
			LEFT JOIN who_drug ON who_drug.wd_id = patient_prescription_have_drug.DrugID
			LEFT JOIN drugs_dosage ON drugs_dosage.DDSGID = patient_prescription_have_drug.DoseID
			LEFT JOIN drugs_frequency ON drugs_frequency.DFQYID = patient_prescription_have_drug.FrequencyID
			where PID = " . $pid;
        $this->load->model('mpager', 'prescription_page');
        $prescription_page = $this->prescription_page;
        $prescription_page->setSql($qry);
        $prescription_page->setDivId("pre_cont"); //important
        $prescription_page->setDivClass('');
        //$lab_order_page->setRowid('LAB_ORDER_ID');
        $prescription_page->setCaption("Medication history");
        $prescription_page->setShowHeaderRow(false);
        $prescription_page->setShowFilterRow(false);
        $prescription_page->setColNames(array("ID", "", "", "", ""));
        $prescription_page->setRowNum(25);
        //$lab_order_page->setColOption("LAB_ORDER_ID",array("search"=>false,"hidden" => false,"width"=>30));
        $prescription_page->setColOption("dte", array("search" => false, "hidden" => false, "width" => 50));
        $prescription_page->setColOption("Name", array("search" => false, "hidden" => false, "width" => 190));
        $prescription_page->setColOption("HowLong", array("search" => false, "hidden" => false, "width" => 70));
        $prescription_page->setColOption("Dosage", array("search" => false, "hidden" => false, "width" => 30));
        $prescription_page->setColOption("Frequency", array("search" => false, "hidden" => false, "width" => 40));


        $prescription_page->gridComplete_JS
            = "function() {
		$('div[id ^= \"pager\"]').hide();
        }";
        $prescription_page->setOrientation_EL("L");
        return $prescription_page->render(false);
    }

    private
    function loadNotes($pid)
    {
        $qry
            = "SELECT patient_notes.patient_notes_id ,
	SUBSTRING(patient_notes.CreateDate,1,10) as dte,
	Type,
	patient_notes.notes
	FROM patient_notes
	where (patient_notes.PID ='" . $pid . "') and (patient_notes.Active = 1) ";
        $this->load->model('mpager', 'patient_notes');
        $patient_notes = $this->patient_notes;
        $patient_notes->setSql($qry);
        $patient_notes->setDivId("notes_cont"); //important
        $patient_notes->setDivClass('');
        $patient_notes->setRowid('patient_notes_id');
        $patient_notes->setCaption("Patient nursing notes");
        $patient_notes->setShowHeaderRow(false);
        $patient_notes->setShowFilterRow(false);
        $patient_notes->setShowPager(false);
        $patient_notes->setColNames(array("ID", "", "", ""));
        $patient_notes->setRowNum(25);
        $patient_notes->setColOption("patient_notes_id", array("search" => false, "hidden" => true));
        $patient_notes->setColOption("dte", array("search" => false, "hidden" => false, "width" => 70));
        $patient_notes->setColOption("notes", array("search" => false, "hidden" => false, "width" => 70));
        $patient_notes->gridComplete_JS = "function() {
        $('#notes_cont .jqgrow').mouseover(function(e) {
            var rowId = $(this).attr('id');
            $(this).css({'cursor':'pointer'});
        }).mouseout(function(e){
        }).click(function(e){
            var rowId = $(this).attr('id');
           window.location='" . site_url("patient_note/edit") . "/'+rowId+'?CONTINUE=patient/view/" . $pid . "';
        });
        }";
        $patient_notes->setOrientation_EL("L");
        return $patient_notes->render(false);
    }

    public
    function notes($id = NULL)
    {
        if (!is_numeric($id)) {
            die("Patient ID not valid");
        }
        $this->load->model('mpersistent');
        $this->load->model('mpatient');
        $data["patient_info"] = $this->mpersistent->open_id($id, "patient", "PID");
        if (isset($data["patient_info"]["DateOfBirth"])) {
            $data["patient_info"]["Age"] = $this->get_age($data["patient_info"]["DateOfBirth"]);
        }
        $data["patient_info"]["HIN"] = $this->print_hin($data["patient_info"]["HIN"]);
        $data["patient_notes_list"] = $this->mpatient->get_notes_list($id, "patient");
        $data["opd_notes_list"] = $this->mpatient->get_notes_list($id, "opd");
        //print_r($data["opd_notes_list"]);
        $this->load->vars($data);
        $this->load->view('patient_notes');
    }

    public function search()
    {
        $this->set_top_selected_menu('patient/search');

        $this->load->model('mpager');
        $pager2 = $this->mpager;
        $pager2->setSql(
            "select LPID,PID, Full_Name_Registered, Personal_Used_Name, DateOfBirth, Gender, Personal_Civil_Status, NIC, Address_Village from patient "
        );

        $pager2->setDivId('tablecont1'); //important
        $pager2->setDivStyle('width:95%;margin:0 auto;');
        $pager2->setRowid('PID');
//        $pager2->setWidth("95%");
        $tools = "<input class=\'formButton\' type=\'button\' ID=\'spid\' value=\'Search Patient by ID\'>";
        $pager2->setCaption($tools);
        //$pager->setSortname("CreateDate");
        $pager2->setColNames(array("Id","PId","Name","Initials","Date of Birth", "Gender","Civil Status","NIC","Village"));
        $pager2->setColOption("PID", array("search"=>true,"hidden" => true,"height"=>100));
        $pager2->setColOption("LPID", array("search"=>true,"width"=>50));
        $pager2->setColOption("Full_Name_Registered", array("search"=>true,"width"=>300));
        $pager2->setColOption("Personal_Used_Name", array("search"=>true,"width"=>50));
        //$pager2->setColOption("DateOfBirth", array("stype" => "text", "searchoptions" => array("dataInit_JS" => "datePicker_REFID","defaultValue"=>"")));
        $pager2->setColOption("Gender", array("stype" => "select", "searchoptions" => array("value" => ":All;Male:Male;Female:Female")));
        //"Single","Married","Divorced","Widow","UnKnown"
        $pager2->setColOption("Personal_Civil_Status", array("stype" => "select", "searchoptions" => array("value" => ":All;Single:Single;Married:Married;Divorced:Divorced;Widow:Widow;UnKnown:UnKnown","defaultValue"=>"All")));
        //$pager2->setColOption("CreateDate", array("stype" => "text", "searchoptions" => array("dataInit_JS" => "datePicker_REFID","defaultValue"=>"")));
        $pager2->setSortname('LPID');
        $pager2->gridComplete_JS = "function() {
            var c = null;
            $('.jqgrow').mouseover(function(e) {
                var rowId = $(this).attr('id');
                c = $(this).css('background');
                $(this).css({'background':'#FFFFFF','cursor':'pointer'});
            }).mouseout(function(e){
            $(this).css('background',c);
            }).mousedown(function(e){
                var rowId = $(this).attr('id');
                window.location='patient/view/'+rowId;
            });
                $('#spid').click(function(){
                   getSearchText('patient');
                })
            }";

        $pager2->setOrientation_EL("L");
        $data['pager'] = $pager2->render(false);
        $this->qch_template->load_form_layout('patient_search', $data);

//        $pager2->setDivId('tablecont1'); //important
//        $pager2->setDivStyle('width:100%;margin:0 auto;');
//        $pager2->setRowid('PID');
////        $pager2->setWidth("95%");
//        $tools = "";
//        $pager2->setCaption($tools);
//        $pager2->setSortname("CreateDate");
//        $pager2->setColNames(
//            array("ID", lang("Name"), lang("Other Name"), lang("Date of Birth"), "Occupation", lang("Gender"), lang("Civil Status"), lang("BI ID"), lang("NUIT ID"), lang("Address"))
//        );
//        $pager2->setColOption("PID", array("search" => true, "hidden" => false, "height" => 100, "width" => 50));
//        $pager2->setColOption("Name", array("search" => true, "width" => 200));
//        $pager2->setColOption("OtherName", array("search" => true, "width" => 200));
//        $pager2->setColOption("DateOfBirth", $pager2->getDateSelector());
//        $pager2->setColOption(
//            "Gender", array("stype" => "select", "searchoptions" => array("value" => ":All;Male:Male;Female:Female"))
//        );
//        //"Single","Married","Divorced","Widow","UnKnown"
//        $pager2->setColOption(
//            "Personal_Civil_Status", array("stype" => "select",
//                "searchoptions" => array("value" => ":All;Single:Single;Married:Married;Divorced:Divorced;Widow:Widow;UnKnown:UnKnown",
//                    "defaultValue" => "All"))
//        );
//        //$pager2->setColOption("CreateDate", array("stype" => "text", "searchoptions" => array("dataInit_JS" => "datePicker_REFID","defaultValue"=>"")));
//        $pager2->setSortname('PID');
//        $pager2->gridComplete_JS
//            = "function() {
//
//            var c = null;
//            $('.jqgrow').mouseover(function(e) {
//                var rowId = $(this).attr('id');
//                c = $(this).css('background');
//                $(this).css({'background':'#FFFFFF','cursor':'pointer'});
//            }).mouseout(function(e){
//            $(this).css('background',c);
//            }).mousedown(function(e){
//                var rowId = $(this).attr('id');
//                window.location='" . base_url() . "index.php/patient/view/'+rowId;
//            });
//
//            }
//            ";

    }

    public
    function update_hin()
    {
        if ($this->session->userdata("UserGroup") != "Programmer") {
            echo "-NO ACCESS-";
            return;
        }
        $this->load->model("mpatient");
        $this->load->model("mpersistent");


        $data["Patient_list"] = $this->mpatient->get_all_patient();
        echo "UPDATING HIN " . count($data["Patient_list"]) . "<hr>";
        echo "<table border=1>";
        for ($i = 0; $i < count($data["Patient_list"]); ++$i) {
            echo "<tr>";
            echo "<td>";
            echo $data["Patient_list"][$i]["PID"];
            echo "</td>";
            echo "<td>";
            $HIN = $this->get_hin($data["Patient_list"][$i]["PID"]);
            $hstatus = $this->mpersistent->update("patient", "PID", $data["Patient_list"][$i]["PID"], array("HIN" => $HIN));
            //echo chunk_split($HIN, 4, '-');
            //echo $HIN."--";
            echo $this->print_hin($HIN);
            // substr($HIN, 9);
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    /*********************************END OF MD*******************/
    public
    function get_hin($s)
    {
        $hospital = $this->session->userdata("hospital_info");
        $h_code = $hospital["Code"];
        $pid = sprintf("%06s", $s);
        $hin = $h_code . $pid;
        $hin_number = $hin;
        $hin = $hin . "0";
        $sum = 0;
        $i = strlen($hin);     // Find the last character
        $odd_length = $i % 2;
        while ($i-- > 0) { // Iterate all digits backwards
            $sum += $hin[$i];    // Add the current digit
            // If the digit is even, add it again. Adjust for digits 10+ by subtracting 9.
            ($odd_length == ($i % 2)) ? ($hin[$i] > 4) ? ($sum += ($hin[$i] - 9)) : ($sum += $hin[$i]) : false;
        }
        return $hin_number . (10 - ($sum % 10)) % 10; //returns the luhn check digit
    }

    public
    function save()
    {
        //print_r($_POST);
        $frm = 'patient';
        if (!file_exists('application/forms/' . $frm . '.php')) {
            die("Form " . $frm . "  not found");
        }
        include 'application/forms/' . $frm . '.php';
        $data["form"] = $form;
        //print_r($data);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model("mpersistent");
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
        for ($i = 0; $i < count($form["FLD"]); ++$i) {
            $this->form_validation->set_rules(
                $form["FLD"][$i]["name"], '"' . $form["FLD"][$i]["label"] . '"', $form["FLD"][$i]["rules"]
            );
        }
        $this->form_validation->set_rules($form["OBJID"]);
        $this->form_validation->set_rules("year", "Age", "numeric|xss_clean");
        $this->form_validation->set_rules("month", "Age", "numeric|xss_clean");
        $this->form_validation->set_rules("day", "Age", "numeric|xss_clean");

        if ($this->form_validation->run() == FALSE) {
            $this->load->vars($data);
            echo Modules::run('form/create', 'patient');
        } else {
            //$sve_data = array();
            //for ( $i=0; $i < count($form["FLD"]); ++$i ){
            //$sve_data[$form["FLD"][$i]["name"]] = $this->input->post($form["FLD"][$i]["name"]);
            //}
            $year = $this->input->post("year");
            $month = $this->input->post("month");
            $day = $this->input->post("day");

            if ($this->input->post("DateOfBirth") == "") {
                $dob = date('Y-m-d', mktime(0, 0, 0, date("m") - $month, date("d") - $day, date("Y") - $year));
            } else {
                $dob = $this->input->post("DateOfBirth");
            }
            $sve_data = array(
                'Personal_Title' => $this->input->post("Personal_Title"),
                'Full_Name_Registered' => ucfirst(strtolower($this->input->post("Full_Name_Registered"))),
                'Personal_Used_Name' => strtoupper($this->input->post("Personal_Used_Name")),
                'Gender' => $this->input->post("Gender"),
                'Personal_Civil_Status' => $this->input->post("Personal_Civil_Status"),
                'DateOfBirth' => $dob,
                'NIC' => $this->input->post("NIC"),
                'Telephone' => $this->input->post("Telephone"),
                'occupation' => $this->input->post("occupation"),
                'Address_Street' => $this->input->post("Address_Street"),
                'Address_Street1' => $this->input->post("Address_Street1"),
                'Address_Village' => $this->input->post("Address_Village"),
                'Address_District' => $this->input->post("Address_District"),
                'Address_DSDivision' => $this->input->post("Address_DSDivision"),
                'Remarks' => $this->input->post("Remarks"),
                'HID' => $this->session->userdata('HID')

            );
            $id = $this->input->post($form["OBJID"]);
            $status = false;

            if ($id > 0) {
                $status = $this->mpersistent->update($frm, $form["OBJID"], $id, $sve_data);
                $this->session->set_flashdata(
                    'msg', 'REC: ' . ucfirst(strtolower($this->input->post("Full_Name_Registered"))) . ' Updated'
                );
                if ($status) {
                    header("Status: 200");
                    if (isset($_POST["CONTINUE"])) {
                        header("Location: " . site_url($_POST["CONTINUE"]));
                        return;
                    } else {
                        header("Location: " . site_url($form["NEXT"] . '/' . $status));
                        return;
                    }
                }
            } else {
                $sve_data ['LPID'] = $this->get_unique_id($this->input->post("DateOfBirth"));
                $status = $this->mpersistent->create($frm, $sve_data);
                $HIN = $this->get_hin($status);
                $hstatus = $this->mpersistent->update($frm, "PID", $status, array("HIN" => $HIN));
                $this->session->set_flashdata(
                    'msg', 'REC: ' . ucfirst(strtolower($this->input->post("Full_Name_Registered"))) . $HIN . ' created'
                );
                if ($status > 0) {
                    //echo Modules::run($form["NEXT"], $status);
                    header("Status: 200");
                    if (isset($_POST["CONTINUE"]) && $_POST["CONTINUE"] != '') {
                        header("Location: " . site_url($_POST["CONTINUE"]));
                        return;
                    } else {
                        header("Location: " . site_url($form["NEXT"] . '/' . $status));
                        return;
                    }
                }
            }
            echo "ERROR in saving";
        }
    }

    public
    function get_unique_id($dob)
    {
        $yyyy = substr($dob, 0, 4);
        $mm = substr($dob, 5, 2);
        $dd = substr($dob, 8, 2);
        //echo $yyyy.$mm.$dd.substr(number_format(str_replace(".","",microtime(true)*rand()),0,'',''),0,14);
        //echo $yyyy.$mm.$dd.time();
        //echo $yyyy.$mm.$dd.substr(number_format(str_replace(".","",microtime(true)*rand()),0,'',''),0,8);
        return
            $yyyy . $mm . $dd . substr(number_format(str_replace(".", "", microtime(true) * rand()), 0, '', ''), 0, 8);
    }

    public
    function nic_check($nic)
    {
        if ($nic == "") {
            return TRUE;
        }
        $reg = '/^(\d\d\d\d\d\d\d\d\d)[xXvV]$/';
        if (preg_match($reg, $nic) == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public
    function get_initial()
    {
        return ucwords($this->mpersistent->get_value("Personal_Used_Name"));
    }

    public
    function get_name()
    {
        return ucfirst($this->mpersistent->get_value("Full_Name_Registered"));
    }

    public
    function get_address()
    {
        $address = "";
        if (ucfirst($this->mpersistent->get_value("Address_Street")) != "") {
            $address
                .= ucfirst($this->mpersistent->get_value("Address_Street")) . "<br>";
        }
        if (ucfirst($this->mpersistent->get_value("Address_Street1")) != "") {
            $address
                .= ucfirst($this->mpersistent->get_value("Address_Street1")) . "<br>";
        }
        if (ucfirst($this->mpersistent->get_value("Address_Village")) != "") {
            $address
                .= ucfirst($this->mpersistent->get_value("Address_Village")) . "<br>";
        }
        if (ucfirst($this->mpersistent->get_value("Address_DSDivision")) != "") {
            $address
                .= ucfirst($this->mpersistent->get_value("Address_DSDivision")) . "<br>";
        }
        if (ucfirst($this->mpersistent->get_value("Address_District")) != "") {
            $address
                .= ucfirst($this->mpersistent->get_value("Address_District")) . "<br>";
        }
        return $address;
    }

    public
    function get_full_name()
    {
        $fName = "";
        $fName .= ucwords(
            $this->mpersistent->get_value("Personal_Title") . " " . $this->mpersistent->get_value("Personal_Used_Name")
        );
        $fName .= " " . $this->mpersistent->get_value("Full_Name_Registered") . " ";
        return $fName;
    }

    public
    function get_civil_status()
    {
        //if (!$this->Fields[$this->ObjField]) return NULL;
        return ucwords($this->mpersistent->get_value("Personal_Civil_Status"));
    }

    public
    function get_date_of_birth()
    {
        //if (!$this->Fields[$this->ObjField]) return NULL;
        return $this->mpersistent->get_value("DateOfBirth");
    }

    public
    function get_NIC()
    {
        //if (!$this->Fields[$this->ObjField]) return NULL;
        return $this->mpersistent->get_value("NIC");
    }

    public
    function get_gender()
    {
        //if (!$this->Fields[$this->ObjField]) return NULL;
        return $this->mpersistent->get_value("Gender");
    }

    public function ajaxlookup_patient(){

//        require '../class/MDSPatient.php';
//        require '../class/MDSDataBase.php';
//        require '../config.php';
        if (!$_POST) die ("POST ERROR");
        $Full_Name_Registered = $_POST["Full_Name_Registered"];


        $sql =" SELECT PID, Personal_Title,DateOfBirth,Personal_Used_Name,Gender,Full_Name_Registered,NIC,Address_Village FROM patient  where  ";
        $sql .=" ( Full_Name_Registered like '$Full_Name_Registered%') ";
        $sql .=" order by Full_Name_Registered limit 0,50";

        $result = $this->db->query($sql);
        $i = 0;
        $out  = "PATdata ={ 'patient':[";



        foreach ( $result->result_array() as $row )  {

//            function mysqlFetchArray($result) {
//                Return @mysqli_fetch_array($result, MYSQLI_BOTH);
//            }


            $this->m_patient->get($row["PID"]);

            $out .="{'PID':'".$row["PID"]."', 
                        'Full_Name_Registered':'".$row["Full_Name_Registered"]."',
                        'NIC':'".$row["NIC"]."',
                        'Address_Village':'".$row["Address_Village"]."',
                        'Personal_Title':'".$row["Personal_Title"]."',
                        'Personal_Used_Name':'".$row["Personal_Used_Name"]."',
                        'Gender':'".$row["Gender"]."',
                        'DateOfBirth':'".$row["DateOfBirth"]."'
                        },";
            $i++;
        }
        if ($i>0){
            $out = substr_replace( $out, "", -1 );
        }
        $out  .= "]}";
        $this->db->close();
        echo $out;
    }

    private function show_form($data)
    {
        $this->load->vars($data);
        $this->load->view('form_patient');
    }

    private function loadHistory($pid)
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
        return $history_page->render(false);
    }

    private
    function loadAttachment($pid)
    {
        $qry
            = "SELECT attachment.Attach_Hash ,
	SUBSTRING(attachment.CreateDate,1,10) as dte,
	attachment.Attach_Name,
	attachment.Attach_Type,
	attachment.Attach_Description
	FROM attachment
	where (attachment.PID ='" . $pid . "') and (attachment.Active = 1)";
        $this->load->model('mpager', 'attach_page');
        $attach_page = $this->attach_page;
        $attach_page->setSql($qry);
        $attach_page->setDivId("attach_cont"); //important
        $attach_page->setDivClass('');
        $attach_page->setRowid('Attach_Hash');
        $attach_page->setCaption("Files attached to the patient record");
        $attach_page->setShowHeaderRow(false);
        $attach_page->setShowFilterRow(false);
        $attach_page->setColNames(array("ID", "", "", "", ""));
        $attach_page->setRowNum(25);
        $attach_page->setColOption("Attach_Hash", array("search" => false, "hidden" => true, "width" => 30));
        $attach_page->setColOption("dte", array("search" => false, "hidden" => false, "width" => 60));
        $attach_page->setColOption("Attach_Name", array("search" => false, "hidden" => false, "width" => 70));
        $attach_page->setColOption("Attach_Type", array("search" => false, "hidden" => false, "width" => 60));
        $attach_page->gridComplete_JS
            = "function() {
		$('div[id ^= \"pager\"]').hide();
        $('#attach_cont .jqgrow').mouseover(function(e) {
            var rowId = $(this).attr('id');
            $(this).css({'cursor':'pointer'});
        }).mouseout(function(e){
        }).click(function(e){
            var rowId = $(this).attr('id');
            var params = 'menubar=no,location=no,resizable=yes,scrollbars=yes,status=no,width='+screen.availWidth+',height='+screen.availHeight;
		    var url = '" . site_url("attach/view/") . "/'+rowId;
			window.open('' + url + '', 'lookUpW', params);
        });
    }";
        $attach_page->setOrientation_EL("L");
        return $attach_page->render(false);
    }

    public
    function banner_full($pid)
    {
        $data["patient_info"] = $this->m_patient->as_array()->get($pid);

        if (empty($data["patient_info"])) {
            $data["text"] = '<br>Patient not found <br><input  class=\'formButton\' type=\'button\' value=\'Ok\' onclick=history.back();>';
            $data["head"] = 'Error';
            $data["w"] = 300;
            $data["h"] = 100;
            $this->load->vars($data);
            $this->load->view('patient_error');
            return;
        }
        if (isset($data["patient_info"]["DateOfBirth"])) {
            $data["patient_info"]["Age"] = $this->get_age($data["patient_info"]["DateOfBirth"]);
        }

        $this->load->vars($data);
        $this->load->view('patient_banner_full');
    }

    public function checkID()
    {
        require 'application/config/database.php';
        $id = isset($_POST['id']) ? $_POST['id'] : false;
//        $id = (int)$this->input->post('stext');

        $conn = mysqli_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database'])
        or die ('{error:"bad_request"}');
        $query = mysqli_query($conn, 'select count(*) as count from patient where PID = \"'.  addslashes($id).'"');

        $error = array(
            'error' => 'Success'
        );

        if (!$id){
            $error['error'] = 'Not Found! Try again...';
            die ('{error:"bad_request"}');
        }

//
        if ($query){
            $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
            if ((int)$row['count'] == 0){
                $error['error'] = 'Not Found! Try again...';
            }
            elseif ((int)$row['count'] > 1) {
                $error['error'] = 'Not Found! Try again...';
            }
        }

        die (json_encode($error['error']));

//        if (!$id){
//            echo -1;
//            die(-1);
//        }
//
//        if ($id)
//        {
//            $query = $this->m_patient->get($id);
//
//            if ($query){
////                $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
//                if (mysqli_num_rows($query) == 0){
//                    echo -2;
////                    die(-2);
//                }
//                elseif (mysqli_num_rows($query) == 1){
//                    echo 1;
////                    die(1);
//                }
//                elseif (mysqli_num_rows($query) > 1){
//                    echo -2;
////                    die(-2);
//                }
//            }
//            else{
//                echo -1;
//                die(-1);
//            }
//        }
    }
}


function date_difference($startDate, $endDate)
{

    $startDate = strtotime($startDate);
    $endDate = strtotime($endDate);

    $years = $months = $days = 0;

    $two = $startDate;
    $one = $endDate;
    $invert = false;
    if ($one > $two) {
        list($one, $two) = array($two, $one);
        $invert = true;
    }

    $key = array("y", "m", "d", "h", "i", "s");
    $a = array_combine($key, array_map("intval", explode(" ", date("Y m d H i s", $one))));
    $b = array_combine($key, array_map("intval", explode(" ", date("Y m d H i s", $two))));

    $result = array();
    $result["y"] = $b["y"] - $a["y"];
    $result["m"] = $b["m"] - $a["m"];
    $result["d"] = $b["d"] - $a["d"];
    $result["h"] = $b["h"] - $a["h"];
    $result["i"] = $b["i"] - $a["i"];
    $result["s"] = $b["s"] - $a["s"];
    $result["invert"] = $invert ? 1 : 0;
    $result["days"] = intval(abs(($one - $two) / 86400));

    return array($result["y"], $result["m"], $result["d"]);
}


//////////////////////////////////////////

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */