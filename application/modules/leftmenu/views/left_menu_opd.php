<?php
/*
--------------------------------------------------------------------------------
HHIMS - Hospital Health Information Management System
Copyright (c) 2011 Information and Communication Technology Agency of Sri Lanka
<http: www.hhims.org/>
----------------------------------------------------------------------------------
This program is free software: you can redistribute it and/or modify it under the
terms of the GNU Affero General Public License as published by the Free Software 
Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,but WITHOUT ANY 
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR 
A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License along 
with this program. If not, see <http://www.gnu.org/licenses/> or write to:
Free Software  HHIMS
C/- Lunar Technologies (PVT) Ltd,
15B Fullerton Estate II,
Gamagoda, Kalutara, Sri Lanka
---------------------------------------------------------------------------------- 
Author: Mr. Thurairajasingam Senthilruban   TSRuban[AT]mdsfoss.org
Consultant: Dr. Denham Pole                 DrPole[AT]gmail.com
URL: http: www.hhims.org
----------------------------------------------------------------------------------
*/
if (!defined('BASEPATH')) exit('No direct script access allowed');
//print_r($user_menu);
// $mdsPermission = MDSPermission::GetInstance();
$menu = "";
$menu .= "<div id='left-sidebar1'>\n";


$menu .= "<div class='list-group'>";
$menu .= "<a href='' class='list-group-item active'>";
$menu .= "Commands";
$menu .= "</a>";
$menu .= "<a href='" . base_url() . "index.php/patient/view/" . $pid . "' class='list-group-item'><span class='glyphicon glyphicon-user'></span>&nbsp;Patient overview</a>";
//if ($this->config->item('block_opd_after') >= $d_day) {


//    $menu .= "<a href='" . base_url() . "index.php/patient_history/add/" . $pid . "/?CONTINUE=opd_visit/view/" . $opdid . "' class='list-group-item'><span class='glyphicon glyphicon-header'></span>&nbsp;Add History</a>";
//    $menu .= "<a href='" . base_url() . "index.php/patient_allergy/add/" . $pid . "/?CONTINUE=opd_visit/view/" . $opdid . "' class='list-group-item'><span class='glyphicon glyphicon-bell'></span>&nbsp;Add Allergy</a>";
//    $menu .= "<a href='" . base_url() . "index.php/patient_examination/add/" . $pid . "/?CONTINUE=opd_visit/view/" . $opdid . "' class='list-group-item'><span class='glyphicon glyphicon-check'></span>&nbsp;Add Examination</a>";
if ($opd_info['refer_to_adm_id'] == 0) {
    if (Modules::run('permission/check_permission', 'order_lab_test', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/patient_lab_order/create_opd_lab_order/" . $opdid . "/?CONTINUE=opd_visit/view/" . $opdid . "' class='list-group-item'><span class='glyphicon glyphicon-tint'></span>&nbsp;New Order Lab</a>";
    }
    if (Modules::run('permission/check_permission', 'order_radiology_test', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/patient_radiology_order/create_opd_radiology_order/" . $opdid . "/?CONTINUE=opd_visit/view/" . $opdid . "' class='list-group-item'><span class='glyphicon glyphicon-flash'></span>&nbsp;Order Radiology</a>";
    }
    if (Modules::run('permission/check_permission', 'prescribe_drug', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/patient_prescription/prescribe/opd/" . $opdid . "/?CONTINUE=opd_visit/view/" . $opdid . "' class='list-group-item'><span class='glyphicon glyphicon-list-alt'></span>&nbsp;New Prescription</a>";
    }
    if (Modules::run('permission/check_permission', 'order_treatment', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/treatment_order/create_opd_treatment/" . $opdid . "/?CONTINUE=opd_visit/view/" . $opdid . "' class='list-group-item'><span class='glyphicon glyphicon-list'></span>&nbsp;Treatments</a>";
    }
    if (Modules::run('permission/check_permission', 'order_injection', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/patient_injection/create_opd_injection/" . $opdid . "/?CONTINUE=opd_visit/view/" . $opdid . "' class='list-group-item'><span class='glyphicon glyphicon-pushpin'></span>&nbsp;Order an Injection</a>";
    }
//$menu .= "<a href='" . base_url() . "index.php/patient_note/add_opd_note/" . $pid . "/" . $opdid . "/?CONTINUE=opd_visit/view/" . $opdid . "' class='list-group-item'><span class='glyphicon glyphicon-leaf'></span>&nbsp;Add OPD nursing notes</a>";
    if (Modules::run('permission/check_permission', 'refer_to_admission', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/opd_visit/refer_to_adm/" . $opdid . "' class='list-group-item '><span class='glyphicon glyphicon-export'></span>&nbsp;Refer to admission</a>";
    }
    if (Modules::run('permission/check_permission', 'order_discharge', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/order_discharge/create_opd_discharge/" . $opdid . "/?CONTINUE=opd_visit/view/" . $opdid . "' class='list-group-item'><span class='fa fa-sign-out'></span>&nbsp;Order Discharge</a>";
    }
}
$menu .= "</div>";


//$menu .= "<div class='list-group'>";
//$menu .= "<a href='' class='list-group-item active'>";
//$menu .= "Prints";
//$menu .= "</a>";
//// Print patient slip
//$menu .= "<a class='list-group-item' onclick=\"openWindow('" . site_url(
//        "report/pdf/patientSlip/print/$pid"
//    ) . "')\" href='#'>Print patient slip</a>";
//
//// Print patient card
//$menu .= "<a class='list-group-item' onclick=\"openWindow('" . site_url(
//        "report/pdf/patientCard/print/$pid"
//    ) . "')\" href='#'>Print patient card</a>";
//
//// Print patient summery
//$menu .= "<a class='list-group-item' onclick=\"openWindow('" . site_url(
//        "report/pdf/patientSummery/print/$pid"
//    ) . "')\" href='#'>Print patient summary</a>";
//
//// Print visit summery
//$menu .= "<a class='list-group-item' onclick=\"openWindow('" . site_url(
//        "report/pdf/patientSummery/print/$pid"
//    ) . "')\" href='#'>Print visit summary</a>";
//
//// Print OPD Prescription
////$menu .= "<a class='list-group-item' onclick=\"openWindow('" . site_url(
////    "report/pdf/opdPrescription/print/$opdid"
////) . "')\" href='#'>Prescription</a>";
//
//// Print OPD Labtests
//$menu .= "<a class='list-group-item' onclick=\"openWindow('" . site_url(
//        "report/pdf/opdLabtests/print/$opdid"
//    ) . "')\" href='#'>Lab test</a>";
//
//// Print clinic book
//$menu .= "<a class='list-group-item' onclick=\"openWindow('" . site_url(
//        "report/pdf/clinicBook/print/$opdid"
//    ) . "')\" href='#'>Print Clinic Book</a>";
//
//$menu .= "</div>";

//$menu .= "<div class='list-group'>";
//$menu .= "<a href='' class='list-group-item active'>";
//$menu .= "Generic Modules";
//$menu .= "</a>";
//$menu .= "</div>";

$menu .= " </div> \n";
echo $menu;
?>