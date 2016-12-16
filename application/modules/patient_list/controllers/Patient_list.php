<?php

/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 12-Oct-15
 * Time: 9:10 PM
 */
class Patient_list extends LoginCheckController
{
    public $data = array();

    function __construct()
    {
        parent::__construct();
//        $this->load_default_paging_config();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function opd_patient()
    {
        $user = $this->session->userdata('uid');
        $name = $this->session->userdata('name').' '.$this->session->userdata('other_name');

        $qry = "SELECT  opd_visits.DateTimeOfVisit,
			opd_visits.OPDID ,
			opd_visits.Complaint,			
			concat('(', patient.PID,')',patient.Personal_Title, ' ',patient.Full_Name_Registered,' ', patient.Personal_Used_Name)  , 
			concat(DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(patient.DateofBirth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(patient.DateofBirth, '00-%m-%d')) ,'Yrs / ',patient.Gender,' / ',patient.Personal_Civil_Status,' / ', patient.Address_Village)as Details
			
			FROM opd_visits, patient 
			where (opd_visits.Doctor ='".$user."') AND (patient.PID = opd_visits.PID ) AND (opd_visits.VisitType != 'OPD Visit')";
        // (opd_visits.Doctor ='".$user->getId()."') AND

        $OBJID = "OPDID";
        $caption = "My Clinic patient list";
        $clmns = array("Visit Date","","Complaint","Name","Details");
        //$status = "Status";
        $dte_field = "DateTimeOfVisit";
        $link ="'home.php?page=opd&action=View&OPDID='+rowId+'&RETURN='+encodeURIComponent('home.php?page=patientlist&show=opdpatient')";

        $this->load->model('mpager', 'mpager');

        $this->mpager->setSql($qry);
        $this->mpager->setDivId('prefCont');
        $this->mpager->setDivClass('');
        //$this->mpager->SetColor($color);
        $this->mpager->setRowid($OBJID);
        //$this->mpager->setRowclass($OBJID);
        $this->mpager->setHeight(400);
        $this->mpager->setCaption($caption);
        $this->mpager->setColNames($clmns);
        $this->mpager->setColOption($OBJID, array("search"=>true,"hidden" => true));
        $this->mpager->setColOption($dte_field, $this->mpager->getDateSelector(date("Y-m-d")));
        //$this->mpager->setColOption("Status", array("width"=>100,"bgcolor"=>'#FF0000',"search"=>true,"hidden" => false));
        $this->mpager->setColOption("Details", array("width"=>300,"search"=>false,"hidden" => false));

        $this->mpager->gridComplete_JS = "function(){        
		
		var c =null;
		$('.jqgrow').mouseover(function(e) {
			var rowId = $(this).attr('id');
			c = $(this).css('background');
			$(this).css({'background':'white','cursor':'pointer'});
		}).mouseout(function(e){
			$(this).css('background',c);
		}).click(function(e){
			var rowId = $(this).attr('id');
			window.location=$link;
		});	
		
		}";

        $data['pager'] = $this->mpager->render(false);
//        $this->load->vars($data);
        $this->render('form_patient_list', $data);
    }

    public function lab_result()
    {
        $user = $this->session->userdata('uid');
        $name = $this->session->userdata('name').' '.$this->session->userdata('other_name');

        $qry = "SELECT  
			lab_order.OrderDate, 
           lab_order.LAB_ORDER_ID, 
           concat('(',lab_order.LAB_ORDER_ID,')',lab_order.TestGroupName),		   
           concat('(', patient.PID,')',patient.Personal_Title, ' ',patient.Full_Name_Registered,' ', patient.Personal_Used_Name)  , 
           concat(DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(patient.DateofBirth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(patient.DateofBirth, '00-%m-%d')) ,'Yrs / ',patient.Gender,' / ',patient.Personal_Civil_Status,' / ', patient.Address_Village)as Details ,
		   lab_order.Status 
           FROM lab_order, patient 
           WHERE ( lab_order.PID = patient.PID ) AND (lab_order.OrderBy = '".$name."' ) AND (lab_order.Dept = 'OPD')";
        // (opd_visits.Doctor ='".$user->getId()."') AND

        $OBJID = "LAB_ORDER_ID";
        $caption = "My lab orders";
        $clmns = array("Order date","","Test name","Name","Details","Status");
        $dte_field = "OrderDate";
        $link ="'home.php?page=opdLabOrder&action=View&LABORDID='+rowId+'&RETURN='+encodeURIComponent('home.php?page=patientlist&show=labresult')";

        $this->load->model('mpager', 'mpager');

        $this->mpager->setSql($qry);
        $this->mpager->setDivId('prefCont');
        $this->mpager->setDivClass('');
        //$this->mpager->SetColor($color);
        $this->mpager->setRowid($OBJID);
        //$this->mpager->setRowclass($OBJID);
        $this->mpager->setHeight(400);
        $this->mpager->setCaption($caption);
        $this->mpager->setColNames($clmns);
        $this->mpager->setColOption($OBJID, array("search"=>true,"hidden" => true));
        $this->mpager->setColOption($dte_field, $this->mpager->getDateSelector(date("Y-m-d")));
        $this->mpager->setColOption("Status", array("stype" => "select", "searchoptions" => array("value" => ":All;Pending:Pending;Done:Done","Default"=>"Pending")));
        $this->mpager->setColOption("Details", array("width"=>300,"search"=>false,"hidden" => false));

        $this->mpager->gridComplete_JS = "function(){        
		
		var c =null;
		$('.jqgrow').mouseover(function(e) {
			var rowId = $(this).attr('id');
			c = $(this).css('background');
			$(this).css({'background':'white','cursor':'pointer'});
		}).mouseout(function(e){
			$(this).css('background',c);
		}).click(function(e){
			var rowId = $(this).attr('id');
			window.location=$link;
		});	
		
		}";
        $this->mpager->setAfterInsertRow('function(rowid, data){
        var alertText = \'\';
        for (property in data) {
            alertText +=data[property];
        }
        if (alertText.match(/^.*Pending/))
        {
            $(\'#\'+rowid).css({\'background\':\'#ea7d7d\'});
        }
       }');

        $data['pager'] = $this->mpager->render(false);
//        $this->load->vars($data);
        $this->render('form_patient_list', $data);
    }

    public function pres_order()
    {
        $user = $this->session->userdata('uid');
        $name = $this->session->userdata('name').' '.$this->session->userdata('other_name');

        $qry = "SELECT   prescribe_items.CreateDate,
			 prescribe_items.PRS_ITEM_ID,
			 opd_presciption.PID,
			 patient.Full_Name_Registered,
			 drugs.Name,
			 prescribe_items.Dosage,
			 prescribe_items.Frequency,
			 prescribe_items.HowLong
			 FROM prescribe_items ,opd_presciption,patient,admission,drugs
			where (opd_presciption.PRSID = prescribe_items.PRES_ID) AND (patient.PID =  opd_presciption.PID) 
			AND (admission.PID =  opd_presciption.PID) AND ( prescribe_items.DRGID =  drugs.DRGID) 
			AND (opd_presciption.Dept = 'ADM') AND (prescribe_items.CreateUser = '".$name."')";
        // (opd_visits.Doctor ='".$user->getId()."') AND

        $OBJID = "PRS_ITEM_ID";
        $caption = "My Prescribe Order list";
        $clmns = array("Order Date","","Patient ID","Patient Name","Drug","Dose","Frequency","HowLong");
        //$status = "Status";
        $dte_field = "CreateDate";
        $link ="'home.php?page=prescribe&action=OrderView&PRS_ITEM_ID='+rowId+'&RETURN='+encodeURIComponent('home.php?page=orderlist&show=orderlist')";

        $this->load->model('mpager', 'mpager');

        $this->mpager->setSql($qry);
        $this->mpager->setDivId('prefCont');
        $this->mpager->setDivClass('');
        //$this->mpager->SetColor($color);
        $this->mpager->setRowid($OBJID);
        //$this->mpager->setRowclass($OBJID);
        $this->mpager->setHeight(400);
        $this->mpager->setCaption($caption);
        $this->mpager->setColNames($clmns);
        $this->mpager->setColOption($OBJID, array("search"=>true,"hidden" => true));
        $this->mpager->setColOption($dte_field, $this->mpager->getDateSelector(date("Y-m-d")));

        $this->mpager->gridComplete_JS = "function(){        
		
		var c =null;
		$('.jqgrow').mouseover(function(e) {
			var rowId = $(this).attr('id');
			c = $(this).css('background');
			$(this).css({'background':'white','cursor':'pointer'});
		}).mouseout(function(e){
			$(this).css('background',c);
		}).click(function(e){
			var rowId = $(this).attr('id');
			window.location=$link;
		});	
		
		}";

        $data['pager'] = $this->mpager->render(false);
//        $this->load->vars($data);
        $this->render('form_patient_list', $data);
    }

    public function load_lab_table()
    {
        $user = $this->session->userdata('uid');
        $name = $this->session->userdata('name').' '.$this->session->userdata('other_name');
        $OBJID = "PID";
        $clmns= array();
        $caption = "Patient list";
        $dte_field = "";
        $status = "";
        $link = "";
        if ($mode == "opdpatient") {
            $qry = "SELECT  opd_visits.DateTimeOfVisit,
			opd_visits.OPDID ,
			opd_visits.Complaint,			
			concat('(', patient.PID,')',patient.Personal_Title, ' ',patient.Full_Name_Registered,' ', patient.Personal_Used_Name)  , 
			concat(DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(patient.DateofBirth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(patient.DateofBirth, '00-%m-%d')) ,'Yrs / ',patient.Gender,' / ',patient.Personal_Civil_Status,' / ', patient.Address_Village)as Details
			
			FROM opd_visits, patient 
			where (opd_visits.Doctor ='".$user."') AND (patient.PID = opd_visits.PID ) AND (opd_visits.VisitType != 'OPD Visit')";
            // (opd_visits.Doctor ='".$user->getId()."') AND
            $OBJID = "OPDID";
            $caption = "My Clinic patient list";
            $clmns = array("Visit Date","","Complaint","Name","Details");
            //$status = "Status";
            $dte_field = "DateTimeOfVisit";
            $link ="'home.php?page=opd&action=View&OPDID='+rowId+'&RETURN='+encodeURIComponent('home.php?page=patientlist&show=opdpatient')";

        }

        else if ($mode == "labresult") {
            $qry = "SELECT  
			lab_order.OrderDate, 
           lab_order.LAB_ORDER_ID, 
           concat('(',lab_order.LAB_ORDER_ID,')',lab_order.TestGroupName),		   
           concat('(', patient.PID,')',patient.Personal_Title, ' ',patient.Full_Name_Registered,' ', patient.Personal_Used_Name)  , 
           concat(DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(patient.DateofBirth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(patient.DateofBirth, '00-%m-%d')) ,'Yrs / ',patient.Gender,' / ',patient.Personal_Civil_Status,' / ', patient.Address_Village)as Details ,
		   lab_order.Status 
           FROM lab_order, patient 
           WHERE ( lab_order.PID = patient.PID ) AND (lab_order.OrderBy = '".$name."' ) AND (lab_order.Dept = 'OPD')";
            $OBJID = "LAB_ORDER_ID";
            $caption = "My lab orders";
            $clmns = array("Order date","","Test name","Name","Details","Status");
            $dte_field = "OrderDate";
            $link ="'home.php?page=opdLabOrder&action=View&LABORDID='+rowId+'&RETURN='+encodeURIComponent('home.php?page=patientlist&show=labresult')";
        }


        else if ($mode == "presorder") {
            $qry = "SELECT   prescribe_items.CreateDate,
			 prescribe_items.PRS_ITEM_ID,
			 opd_presciption.PID,
			 patient.Full_Name_Registered,
			 drugs.Name,
			 prescribe_items.Dosage,
			 prescribe_items.Frequency,
			 prescribe_items.HowLong
			 FROM prescribe_items ,opd_presciption,patient,admission,drugs
			where (opd_presciption.PRSID = prescribe_items.PRES_ID) AND (patient.PID =  opd_presciption.PID) 
			AND (admission.PID =  opd_presciption.PID) AND ( prescribe_items.DRGID =  drugs.DRGID) 
			AND (opd_presciption.Dept = 'ADM') AND (prescribe_items.CreateUser = '".$name."')";


            $OBJID = "PRS_ITEM_ID";
            $caption = "My Prescribe Order list";
            $clmns = array("Order Date","","Patient ID","Patient Name","Drug","Dose","Frequency","HowLong");
            //$status = "Status";
            $dte_field = "CreateDate";
            $link ="'home.php?page=prescribe&action=OrderView&PRS_ITEM_ID='+rowId+'&RETURN='+encodeURIComponent('home.php?page=orderlist&show=orderlist')";
        }

        //$status;

        $pager2 = $this->load->model('mpager');

        $pager2->setDivId('prefCont');
        $pager2->setDivClass('');
        //$pager2->SetColor($color);
        $pager2->setRowid($OBJID);
        //$pager2->setRowclass($OBJID);
        $pager2->setHeight(400);
        $pager2->setCaption($caption);
        $pager2->setColNames($clmns);
        $pager2->setColOption($OBJID, array("search"=>true,"hidden" => true));
        $pager2->setColOption($dte_field, $pager2->getDateSelector(date("Y-m-d")));
        //$pager2->setColOption("Status", array("width"=>100,"bgcolor"=>'#FF0000',"search"=>true,"hidden" => false));
        if (($mode != "presorder")){
            $pager2->setColOption("Details", array("width"=>300,"search"=>false,"hidden" => false));
        }
        //$pager2->setColOption("Status", array("bgcolor"=>"#FF0000","hidden" => false));
        if (($mode == "labresult")||($mode == "admlabresult")) {
            $pager2->setColOption("Status", array("stype" => "select", "searchoptions" => array("value" => ":All;Pending:Pending;Done:Done","Default"=>"Pending")));
        }
        $pager2->gridComplete_JS = "function(){        
		
		var c =null;
		$('.jqgrow').mouseover(function(e) {
			var rowId = $(this).attr('id');
			c = $(this).css('background');
			$(this).css({'background':'white','cursor':'pointer'});
		}).mouseout(function(e){
			$(this).css('background',c);
		}).click(function(e){
			var rowId = $(this).attr('id');
			window.location=$link;
		});	
		
		}";

        //$i++;
        //}

        $this->render('form', $pager2);
    }
}