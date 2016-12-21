<?php


class Wards extends FormController
{
    var $FORM_NAME = 'form_wards';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_wards');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

//    public function index()
//    {
//        //$this->load->view('patient');
//        $this->ward_search();
//    }

    public function create()
    {
        //var_dump($_POST);
        $data = array();
        $data['id'] = 0;
        $data['default_name'] = '';
        $data['default_type'] = '';
        $data['default_telephone'] = '';
        $data['default_bed_count'] = '';
        $data['default_remarks'] = '';
        $data['default_active'] = '';
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
                'Telephone' => $this->input->post('telephone'),
                'BedCount' => $this->input->post('bed_count'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
            );
            $this->m_wards->insert($data);
            $this->session->set_flashdata(
                'msg', 'Created'
            );
            $this->redirect_if_no_continue('preference/load/wards');
        }

    }

    public function edit($id)
    {
        $wards = $this->m_wards->get($id);
        if (empty($wards))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_name'] = $wards->Name;
        $data['default_type'] = $wards->Type;
        $data['default_telephone'] = $wards->Telephone;
        $data['default_bed_count'] = $wards->BedCount;
        $data['default_remarks'] = $wards->Remarks;
        $data['default_active'] = $wards->Active;
        $data['default_create_date'] = $wards->CreateDate;
        $data['default_create_user'] = $wards->CreateUser;
        $data['default_last_update'] = $wards->LastUpDate;
        $data['default_last_update_user'] = $wards->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Name' => $this->input->post('name'),
                'Type' => $this->input->post('type'),
                'Telephone' => $this->input->post('telephone'),
                'BedCount' => $this->input->post('bed_count'),
                'Remarks' => $this->input->post('remarks'),
                'Active' => $this->input->post('active'),
            );
            $this->m_wards->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/wards');
        }
    }

    public function search()
    {
        $this->set_top_selected_menu('wards/search');

        $qry = 'SELECT w.`WID`,
				w.`Name`,
				w.`Type`,
				w.Telephone,
				w.BedCount, count(ad.ADMID) as pcount
				FROM ward as w
				LEFT JOIN (admission as ad) ON (w.WID=ad.Ward and ad.DischargeDate=\'\')
				where w.Active =1 GROUP BY w.`Name`';
        $this->load->model('mpager', 'page');
        $page = $this->page;
        $page->setSql($qry);
        $page->setDivId('ward_cont');
        $page->setDivClass('ward_cont');
        $page->setRowid('WID');
        $page->setSortorder('asc');
        $page->setCaption("Ward List");
        $page->setColOption('WID',array('width'=>200, 'search'=>false));
        $page->setColOption('pcount',array('width'=>75, 'search'=>false));
        $page->setShowHeaderRow(true);
        $page->setShowFilterRow(true);
        $page->setShowPager(true);
        $page->setColNames(array("ID","Ward Name","Type","Telephone","Nos.Bed","Patients"));
        $page->setRowNum(25);

        //default group
        $page->gridComplete_JS
            = "function() {
            var c = null;
            $('.jqgrow').mouseover(function(e) {
                var rowId = $(this).attr('id');
                c = $(this).css('background');
                $(this).css({'background':'yellow','cursor':'pointer'});
            }).mouseout(function(e){
                $(this).css('background',c);
            }).click(function(e){
                var rowId = $(this).attr('id');
			   	window.location='" . site_url("/wards/view") . "/'+rowId;
            });
            }";
        $page->setOrientation_EL("L");
        $data['pager'] = $page->render(false);
        $this->render_search($data);

    }

    public function view($wid, $ops = null)
    {
        $qry = " SELECT admission.ADMID,
                patient.PID,
                patient.Full_Name_Registered,
                admission.AdmissionDate,
                admission.BHT,                
                admission.Complaint
                FROM admission,patient 
                where (admission.Ward =" . $wid . ") 
                    and (admission.DischargeDate = '') 
                    AND (admission.PID =patient.PID) ";

        $this->load->model('mpager', 'page');
        $pager2 = $this->page;

        $pager2->setSql($qry);
        $pager2->setDivId('ward_cont'); //important
        $pager2->setDivClass('ward_cont');
        $pager2->setDivStyle('position:absolute');
        $pager2->setRowid('ADMID');
        $pager2->setHeight(400);
        $pager2->setCaption("Patient list");
        //$pager->setSortname("AdmissionDate");
        $pager2->setColOption("ADMID", array("search"=>true,"hidden" => true,"height"=>100));
        $pager2->setColNames(array("","PID", "Patient","Date", "BHT",  "Complaint"));
        $pager2->setColOption("ADMID", array("search" => false, "width" => 50));
        $pager2->setColOption("AdmissionDate", $pager2->getDateSelector(''));
        //$pager2->setColOption("PrescribeDate", array("stype" => "text", "searchoptions" => array("dataInit_JS" => "datePicker_REFID","defaultValue"=>date("Y-m-d"))));
        //$pager2->setColOption("Status", array("stype" => "select", "searchoptions" => array("value" => ":All;Pending:Pending;Dispensed:Dispensed","defaultValue"=>"Pending")));

        $pager2->gridComplete_JS = "function() {
            var c =null;
            $('.jqgrow').mouseover(function(e) {
                var rowId = $(this).attr('id');
                c = $(this).css('background');
                $(this).css({'background':'yellow','cursor':'pointer'});
            }).mouseout(function(e){
                $(this).css('background',c);
            }).click(function(e){
                var rowId = $(this).attr('id');
                window.location='" . site_url("/admission/view") . "/'+rowId;
            });
            }";

        $wards = $this->m_wards->get($wid);
        $data['id'] = $wid;
        $data['name'] = $wards->Name;
        $data['type'] = $wards->Type;

        $pager2->setOrientation_EL("L");
        $data['pager'] = $pager2->render(false);
        $this->render('ward_view', $data);


//        $this->load->model('mpersistent');
//        $data["ward_info"] = $this->mpersistent->open_id($wid, "ward", "WID");
//        $qry = "SELECT
//        admission.ADMID,
//        admission.AdmissionDate,
//        admission.PID,
//        patient.Name,
//        patient.OtherName,
//        admission.Complaint,
//        admission.BedNo
//        from admission
//        LEFT JOIN `patient` ON patient.PID = admission.PID
//        where (admission.Active =1) and (admission.Ward= '$wid')
//            ";
//        if ($ops == "discharged") {
//            $qry .= " and (admission.OutCome != '') ";
//        }
//
//        $this->load->model('mpager', "page");
//
//        $page = $this->page;
//        $page->setSql($qry);
//        $page->setDivId("patient_list"); //important
//        $page->setDivClass('');
//        $page->setRowid('ADMID');
//        $page->setCaption("Patient list");
//        $page->setShowHeaderRow(true);
//        $page->setShowFilterRow(true);
//        $page->setShowPager(true);
//        $page->setColNames(array("", "Admission Date", "Patient ID", "Patient Name", "Patient Other Name", "Complaint", "Bed No"));
//        $page->setRowNum(25);
//        $page->setColOption("ADMID", array("search" => false, "hidden" => true));
//        if ($ops != "discharged") {
////		    $page->setColOption("DischargeDate", array("search" => true, "hidden" => true));
////            $page->setColOption("OutCome", array("search" => true, "hidden" => true));
//        }
//        $page->gridComplete_JS
//            = "function() {
//        $('#patient_list .jqgrow').mouseover(function(e) {
//            var rowId = $(this).attr('id');
//            $(this).css({'cursor':'pointer'});
//        }).mouseout(function(e){
//        }).click(function(e){
//            var rowId = $(this).attr('id');
//            window.location='" . site_url("/admission/view") . "/'+rowId+'?BACK=ward/view/$wid';
//        });
//        }";
//        $page->setOrientation_EL("L");
//        $data['pager'] = $page->render(false);
//        $this->load->vars($data);
//        $this->load->view('patient_list');
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
        $this->form_validation->set_rules('type', 'Type', 'trim|xss_clean');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim|xss_clean');
        $this->form_validation->set_rules('bed_count', 'Number of beds', 'trim|xss_clean|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');
    }

    public function ward_search()
    {

        $new_page = base_url() . "index.php/search/ward/";
        header("Status: 200");
        header("Location: " . $new_page);
    }

}