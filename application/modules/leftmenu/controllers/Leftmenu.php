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


    public function patient($id = null, $module = null)
    {
        $data['id'] = $id;
        $data['module'] = $module;
        $this->load->vars($data);
        $this->load->view('left_menu_patient');
    }


    public function opd($opdid = null, $pid = null, $opd_info = null)
    {

        $data['pid'] = $pid;
        $data['opdid'] = $opdid;
        $data['opd_info'] = $opd_info;

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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */