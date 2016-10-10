<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//print_r($user_menu);
// $mdsPermission = MDSPermission::GetInstance();
$menu = "";
$menu .= "<div id='left-sidebar1'>\n";
$menu .= "<div class='list-group'>";
$menu .= "<a href='' class='list-group-item active'>";
$menu .= "Commands";
$menu .= "</a>";
if (isset($admission["OutCome"]) && ($admission["OutCome"])) {
    if (isset($_GET["BACK"])) {
        $menu .= "<a href='" . site_url($_GET["BACK"]) . "' class='list-group-item'><span class='glyphicon glyphicon-circle-arrow-left'></span>&nbsp;Back to ward</a>";
    }
    $menu .= "<a href='" . base_url() . "index.php/patient/view/" . $pid . "' class='list-group-item'><span class='glyphicon glyphicon-user'></span>&nbsp;Patient overview</a>";
} else {
    if (isset($_GET["BACK"])) {
        $menu .= "<a href='" . site_url($_GET["BACK"]) . "' class='list-group-item'><span class='glyphicon glyphicon-circle-arrow-left'></span>&nbsp;Back to ward</a>";
    }
    $menu .= "<a href='" . base_url() . "index.php/patient/view/" . $pid . "' class='list-group-item'><span class='glyphicon glyphicon-user'></span>&nbsp;Patient overview</a>";
//    $menu .= "<a href='" . base_url() . "index.php/patient_history/add/" . $pid . "/?CONTINUE=admission/view/" . $admid . "' class='list-group-item'><span class='glyphicon glyphicon-header'></span>&nbsp;Add History</a>";
//    $menu .= "<a href='" . base_url() . "index.php/patient_allergy/add/" . $pid . "/?CONTINUE=admission/view/" . $admid . "' class='list-group-item'><span class='glyphicon glyphicon-bell'></span>&nbsp;Add Allergy</a>";
//    $menu .= "<a href='" . base_url() . "index.php/patient_examination/add/" . $pid . "/?CONTINUE=admission/view/" . $admid . "' class='list-group-item'><span class='glyphicon glyphicon-check'></span>&nbsp;Add Examination</a>";
    if (Modules::run('permission/check_permission', 'order_lab_test', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/patient_lab_order/create_adm_lab_order/" . $admid . "/?CONTINUE=admission/view/" . $admid . "' class='list-group-item'><span class='glyphicon glyphicon-tint'></span>&nbsp;New Order Lab</a>";
    }

//    $menu .= "<a href='" . base_url() . "index.php/form/create/admission_diagnosis/" . $admid . "/" . $pid . "/?CONTINUE=admission/view/" . $admid . "' class='list-group-item'><span class='glyphicon glyphicon-question-sign'></span>&nbsp;Diagnosis</a>";
    if (Modules::run('permission/check_permission', 'prescribe_drug', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/patient_prescription/prescribe/adm/" . $admid . "/?CONTINUE=admission/view/" . $admid . "' class='list-group-item'><span class='glyphicon glyphicon-list-alt'></span>&nbsp;Order Drug</a>";
    }

//    $menu .= "<a href='" . base_url() . "index.php/admission/drug_chart/" . $order_id . "/?CONTINUE=admission/view/" . $admid . "' class='list-group-item'><span class='glyphicon glyphicon-indent-left'></span>&nbsp;Nursing drug chart</a>";
    if (Modules::run('permission/check_permission', 'order_treatment', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/treatment_order/create_adm_treatment/" . $admid . "/?CONTINUE=admission/view/" . $admid . "' class='list-group-item'><span class='glyphicon glyphicon-list'></span>&nbsp;Treatments</a>";
    }
    if (Modules::run('permission/check_permission', 'order_injection', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/patient_injection/create_adm_injection/" . $admid . "/?CONTINUE=admission/view/" . $admid . "' class='list-group-item'><span class='glyphicon glyphicon-pushpin'></span>&nbsp;Order an Injection</a>";
    }
//    $menu .= "<a href='" . base_url() . "index.php/patient_note/add_adm_note/" . $pid . "/" . $admid . "/?CONTINUE=admission/view/" . $admid . "' class='list-group-item'><span class='glyphicon glyphicon-leaf'></span>&nbsp;Add Admission Nursing notes</a>";
    if (Modules::run('permission/check_permission', 'ward_transfer', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/admission/ward_transfer/" . $admid . "/" . "?CONTINUE=admission/view/" . $admid . "' class='list-group-item'><span class='glyphicon glyphicon-transfer'></span>&nbsp;Ward Transfer</a>";
    }
    if (Modules::run('permission/check_permission', 'order_discharge', 'create')) {
        $menu .= "<a href='" . base_url() . "index.php/order_discharge/create_adm_discharge/" . $admid . "/?CONTINUE=admission/view/" . $admid . "' class='list-group-item'><span class='glyphicon glyphicon-folder-close'></span>&nbsp;Discharge</a>";
    }
}
$menu .= "</div>";
$menu .= "</div>";
echo $menu;
?>