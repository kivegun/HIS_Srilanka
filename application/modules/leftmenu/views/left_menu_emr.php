<?php
/*Discharge*/
if (!defined('BASEPATH')) exit('No direct script access allowed');
//print_r($user_menu);
// $mdsPermission = MDSPermission::GetInstance();
$menu = "";
$menu .= "<div id='left-sidebar1'>\n";


$menu .= "<div class='list-group'>";
$menu .= "<a href='' class='list-group-item active'>Commands</a>";
$menu .= "<a href='" . base_url() . "index.php/patient/view/" . $pid . "' class='list-group-item'><span class='glyphicon glyphicon-user'></span>&nbsp;".lang('Patient overview')."</a>";
//if ($this->config->item('block_opd_after') >= $d_day) {
//    if (($emergency_visits_info["referred_admission_id"] == 0) && ($emergency_visits_info["is_refered"] == 0)) {

//    }

//    $menu .= "<a href='" . base_url() . "index.php/patient_history/add/" . $pid . "/?CONTINUE=emergency_visit/view/" . $emrid . "' class='list-group-item'><span class='glyphicon glyphicon-header'></span>&nbsp;Add History</a>";
//    $menu .= "<a href='" . base_url() . "index.php/patient_allergy/add/" . $pid . "/?CONTINUE=emergency_visit/view/" . $emrid . "' class='list-group-item'><span class='glyphicon glyphicon-bell'></span>&nbsp;Add Allergy</a>";
//    $menu .= "<a href='" . base_url() . "index.php/patient_examination/add/" . $pid . "/?CONTINUE=emergency_visit/view/" . $emrid . "' class='list-group-item'><span class='glyphicon glyphicon-check'></span>&nbsp;Add Examination</a>";

if ($emr_info['refer_to_adm_id'] == 0 && $emr_info['discharge_order'] == 0 && $emr_info['Status'] == 'Observe') {

    if (Modules::run('permission/check_permission', 'order_lab_test', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/patient_lab_order/create_emr_lab_order/" . $emrid . "/?CONTINUE=emergency_visit/view/" . $emrid . "' class='list-group-item'><span class='glyphicon glyphicon-tint'></span>&nbsp;".lang("Order Lab Test")."</a>";
    }
    if (Modules::run('permission/check_permission', 'order_radiology_test', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/patient_radiology_order/create_emr_radiology_order/" . $emrid . "/?CONTINUE=emergency_visit/view/" . $emrid . "' class='list-group-item'><span class='glyphicon glyphicon-flash'></span>&nbsp;".lang("Order Radiology Test")."</a>";
    }
    if (Modules::run('permission/check_permission', 'prescribe_drug', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/patient_prescription/prescribe/emr/" . $emrid . "/?CONTINUE=emergency_visit/view/" . $emrid . "' class='list-group-item'><span class='glyphicon glyphicon-list-alt'></span>&nbsp;".lang("Prescribe Drugs")."</a>";
    }
    if (Modules::run('permission/check_permission', 'order_treatment', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/treatment_order/create_emr_treatment/" . $emrid . "/?CONTINUE=emergency_visit/view/" . $emrid . "' class='list-group-item'><span class='glyphicon glyphicon-list'></span>&nbsp;".lang("Order Treatment")."</a>";
    }
    if (Modules::run('permission/check_permission', 'order_injection', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/patient_injection/create_emr_injection/" . $emrid . "/?CONTINUE=emergency_visit/view/" . $emrid . "' class='list-group-item'><span class='glyphicon glyphicon-pushpin'></span>&nbsp;".lang("Order an Injection")."</a>";
    }
//$menu .= "<a href='" . base_url() . "index.php/patient_note/add_emr_note/" . $pid . "/" . $emrid . "/?CONTINUE=emergency_visit/view/" . $emrid . "' class='list-group-item' ><span class='glyphicon glyphicon-leaf'></span>&nbsp;Add Emergency nursing notes</a>";
    if (Modules::run('permission/check_permission', 'refer_to_admission', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/emergency_visit/refer_to_adm/" . $emrid . "' class='list-group-item '><span class='glyphicon glyphicon-export'></span>&nbsp;".lang("Refer to admission")."</a>";
    }
    if (Modules::run('permission/check_permission', 'order_discharge', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/order_discharge/create_emr_discharge/" . $emrid . "/?CONTINUE=emergency_visit/view/" . $emrid . "' class='list-group-item'><span class='fa fa-sign-out'></span>&nbsp;".lang("Order Discharge")."</a>";
    }
}
//}
$menu .= "</div>";

$menu .= " </div> \n";
echo $menu;
?>