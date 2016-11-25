<div id='left-sidebar'>
    <div class='basic' style='float:left;'  id='list1'>
        <a class='LeftMenuItem' href=''>Commands</a>
        <div>
            <input type='button' class='submenuBtn' value='Create a visit'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference'" >
            <input type='button' class='submenuBtn' value='Give an Appointment'  onclick=loadDataTable('','') >
            <input type='button' class='submenuBtn' value='Add history' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/permission'">
            <input type='button' class='submenuBtn' value='Add allergy'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/visit_type'"  >
            <input type='button' class='submenuBtn' value='Hospital Settings'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/hospital_settings'" >
            <input type='button' class='submenuBtn' value='Examination'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/institutions'" >
            <input type='button' class='submenuBtn' value='Attach file'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/user_menu'"  >
        </div>
        <a class='LeftMenuItem' href=''>Prints</a>
        <div>
            <input type='button' class='submenuBtn' value='Print patient slip' onclick="openWindow('<?php echo site_url("report/pdf/patientSlip/print/$id") ?>');"  >
            <input type='button' class='submenuBtn' value='Print patient cards' onclick="printReport('<?php echo $id?>','PatientCard');" >
            <input type='button' class='submenuBtn' value='Print patient summary' onclick="printReport('<?php echo $id?>','PatientHistory');">
        </div>
    </div>
</div>



<?php
///*
//--------------------------------------------------------------------------------
//HHIMS - Hospital Health Information Management System
//Copyright (c) 2011 Information and Communication Technology Agency of Sri Lanka
//<http: www.hhims.org/>
//----------------------------------------------------------------------------------
//This program is free software: you can redistribute it and/or modify it under the
//terms of the GNU Affero General Public License as published by the Free Software
//Foundation, either version 3 of the License, or (at your option) any later version.
//
//This program is distributed in the hope that it will be useful,but WITHOUT ANY
//WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
//A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.
//
//You should have received a copy of the GNU Affero General Public License along
//with this program. If not, see <http://www.gnu.org/licenses/> or write to:
//Free Software  HHIMS
//C/- Lunar Technologies (PVT) Ltd,
//15B Fullerton Estate II,
//Gamagoda, Kalutara, Sri Lanka
//----------------------------------------------------------------------------------
//Author: Mr. Thurairajasingam Senthilruban   TSRuban[AT]mdsfoss.org
//Consultant: Dr. Denham Pole                 DrPole[AT]gmail.com
//URL: http: www.hhims.org
//----------------------------------------------------------------------------------
//*/
//if (!defined('BASEPATH')) exit('No direct script access allowed');
////print_r($user_menu);
//// $mdsPermission = MDSPermission::GetInstance();
//
//$menu = "";
//$menu .= "<div id='left-sidebar1' style='position:fixed1;'>\n";
//$menu .= "<div class='list-group'>";
//$menu .= "<a href='' class='list-group-item active'>";
//$menu .= "Commands";
//$menu .= "</a>";
//
//if (Modules::run('permission/check_permission', 'active_patient', 'create')) {
//    $menu .= "<a id='add_to_active_list' href='" . base_url() . "index.php/active_list/create/" . $id . "' class='list-group-item'><i class='fa fa-plus-square'></i>&nbsp;" . lang('Add to Active List') . "</a>";
//}
//
////$menu .= "<a href='" . base_url() . "index.php/emergency_visit/create/" . $id . "' class='list-group-item'><span class='glyphicon glyphicon-eye-open'></span>&nbsp;Create a Emergency Visit</a>";
////$menu .= "<a href='" . base_url() . "index.php/opd_visit/create/" . $id . "' class='list-group-item'><span class='glyphicon glyphicon-eye-open'></span>&nbsp;Create a OPD Visit</a>";
////$menu .= "<a href='" . base_url() . "index.php/form/create/admission/" . $id . "' class='list-group-item'><span class='glyphicon glyphicon-inbox'></span>&nbsp;Give an Admission</a>";
////$menu .= "<a href='" . base_url() . "index.php/patient/clinic/" . $id . "' class='list-group-item '><span class='glyphicon glyphicon-export'></span>&nbsp;Clinic management*</a>";
////$menu .= "<a href='" . base_url() . "index.php/form/create/appointment/" . $id . "/?CONTINUE=patient/view/" . $id . "' class='list-group-item'><span class='glyphicon glyphicon-time'></span>&nbsp;Give an appointment</a>";
////history, allergy, exam and attachement for All
//if (Modules::run('permission/check_permission', 'patient_history', 'create')) {
//    $menu .= "<a href='" . base_url() . "index.php/patient_history/add/" . $id . "/?CONTINUE=patient/view/" . $id . "' class='list-group-item'><span class='glyphicon glyphicon-header'></span>&nbsp;" . lang('Add History') . "</a>";
//}
//if (Modules::run('permission/check_permission', 'patient_allergy', 'create')) {
//    $menu .= "<a href='" . base_url() . "index.php/patient_allergy/add/" . $id . "/?CONTINUE=patient/view/" . $id . "' class='list-group-item'><span class='glyphicon glyphicon-bell'></span>&nbsp;" . lang('Add Allergy') . "</a>";
//}
//if (Modules::run('permission/check_permission', 'patient_examination', 'create')) {
//    $menu .= "<a href='" . base_url() . "index.php/patient_examination/add/" . $id . "' class='list-group-item'><span class='glyphicon glyphicon-check'></span>&nbsp;" . lang('Add Examination') . "</a>";
//}
//if (Modules::run('permission/check_permission', 'patient_note', 'create')) {
//    $menu .= "<a href='" . base_url() . "index.php/patient_note/add_general_note/" . $id . "/?CONTINUE=patient/view/" . $id . "' class='list-group-item'><span class='glyphicon glyphicon-leaf'></span>&nbsp;" . lang('Add Nursing notes') . "</a>";
//}
//
//$menu .= "</div>";
//$menu .= "<div class='list-group'>";
//$menu .= "<a href='' class='list-group-item active'>";
//
//$menu .= lang("Prints");
//$menu .= "</a>";
//// Print patient slip
////$menu .= "<a class='list-group-item' onclick=\"openWindow('" . site_url(
////        "report/pdf/patientSlip/print/$id"
////    ) . "')\" href='#'>Print patient slip</a>";
//
//// Print patient card
//$menu .= "<a class='list-group-item' onclick=\"openWindow('" . site_url(
//        "report/pdf/patientCard/print/$id"
//    ) . "')\" href='#'>" . lang('Print patient card') . "</a>";
//
//// Print patient summery
////$menu .= "<a class='list-group-item' onclick=\"openWindow('" . site_url(
////        "report/pdf/patientSummery/print/$id"
////    ) . "')\" href='#'>Print patient summary</a>";
////$menu .= "<a class='list-group-item' onclick=\"openWindow('" . site_url(
////        "patient/notes/$id"
////    ) . "')\" href='#'>Print nursing notes</a>";
//$menu .= "</div>";
//$menu .= " </div> \n";
//echo $menu;
//?>