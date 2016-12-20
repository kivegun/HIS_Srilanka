<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Leftmenu extends LoginCheckController
{

    function __construct()
    {
        parent::__construct();
        $this->lang->load('menu/left_menu', $this->get_user_default_language());
    }

    public function preference()
    {
        $this->load->view('left_menu_preference');
    }

    public function pharmacy()
    {
        $this->load->view('left_menu_pharmacy');
    }

    public function lab()
    {
        $this->load->view('left_menu_lab');
    }

    public function procedure_room()
    {
        $this->load->view('left_menu_procedure_room');
    }

    public function questionnaire()
    {
        $this->load->view('left_menu_questionnaire');
    }

    public function ward()
    {
        $this->load->view('left_menu_ward');
    }

    public function ward_admission()
    {
        $this->load->view('left_menu_ward_admission');
    }

    public function chat()
    {
        $this->load->view('left_menu_chat');
    }

    public function report()
    {
        $this->load->view('left_menu_report');
    }

    public function notification()
    {
        $this->load->view('left_menu_notification');
    }

    public function registry()
    {
        $this->load->view('left_menu_registry');
    }

    public function doctor()
    {
        $this->load->view('left_menu_doctor');
    }

    public function patient($pid = null, $module = null)
    {
        $data['pid'] = $pid;
//        $data['opdid'] = $opdid;
        $data['module'] = $module;

        $this->load->database();
        $sql = 'SELECT ADMID FROM admission
                WHERE (PID = "'. $pid .'") AND (DischargeDate = "")';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $data['have_any_opened_admission'] = true;
        }
        else {
            $data['have_any_opened_admission'] = false;
        }

        $this->load->vars($data);
        $this->load->view('left_menu_patient');
    }


    public function opd($opdid = null, $pid = null, $opd_info = null)
    {

        $data['pid'] = $pid;
        $data['opdid'] = $opdid;
        $data['opd_info'] = $opd_info;

        $data["opd_visits_info"] = $this->m_opd_visit->as_array()->get($opdid);
        $visit_date = $data["opd_visits_info"]["DateTimeOfVisit"];

        if ($this->isOneDayOld($visit_date) >= 1 ) $data['isOpened'] = false;
        else $data['isOpened'] = true;

        if ($data['isOpened']) $data['css_menu_time'] =  "";
        else $data['css_menu_time'] =  "style='color:#cccccc;cursor:not-allowed;'  disabled";

        $data["d_day"] = $opd_info["days"];
        $this->load->vars($data);
        $this->load->view('left_menu_opd');
    }

    public function emr($emr_id = null, $pid = null, $emr_info = null)
    {
        $data['pid'] = $pid;
        $data['emrid'] = $emr_id;
        $data['emr_info'] = $emr_info;

        $this->load->vars($data);
        $this->load->view('left_menu_emr');
    }

    public function clinic($clinic_id = null, $pid = null, $clinic_patient_info = null, $module = null)
    {

        $data['pid'] = $pid;
        $data['clinic_id'] = $clinic_id;
        $data['clinic_patient_info'] = $clinic_patient_info;
        $data['module'] = $module;
        $this->load->vars($data);
        $this->load->view('left_menu_clinic');
    }

    public function clinic_new($clinic_id = null, $pid = null, $clinic_patient_info = null, $module = null)
    {

        $data['pid'] = $pid;
        $data['clinic_id'] = $clinic_id;
        $data['clinic_patient_info'] = $clinic_patient_info;
        $data['module'] = $module;
        $this->load->vars($data);
        $this->load->view('left_menu_clinic_new');
    }

    public function clinic_patient()
    {
        //$this->load->vars($data);
        $this->load->view('left_menu_clinic_patient');
    }

    public function admission($admission = null, $pid = null)
    {

        $data['pid'] = $pid;
        $data['admid'] = $admission["ADMID"];
        $data['admission'] = $admission;
        $this->load->view('left_menu_admission', $data);
    }

    public function triage()
    {
        $this->load->view('left_menu_triage');;
    }

    public function active_list($department)
    {
        $data['department'] = $department;
        $this->load->view('left_menu_active_list', $data);
    }

    public function user_config()
    {
        $this->load->view('left_menu_user_config');
    }

    private function isOneDayOld($visit_date = ''){

        // First we need to break these dates into their constituent parts:
        $gd_a = getdate(  strtotime($visit_date));
        $gd_b = getdate(  strtotime(date('Y/m/d')) );

        // Now recreate these timestamps, based upon noon on each day
        // The specific time doesn't matter but it must be the same each day
        $a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
        $b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );

        // Subtract these two numbers and divide by the number of seconds in a
        //  day. Round the result since crossing over a daylight savings time
        //  barrier will cause this time to be off by an hour or two.

        return  round( abs( $a_new - $b_new ) / 86400 ) ;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */