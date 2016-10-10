<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$menu = "";
$menu .= "<div id='left-sidebar1' style='position:fixed1;'>\n";
$menu .= "<div class='list-group'>";
$menu .= "<a href='' class='list-group-item active'>";
$menu .= "Command";
$menu .= "</a>";
if (Modules::run('permission/check_permission', 'active_patient', 'view')) {
    $menu .= "<a href='" . base_url() . "index.php/active_list' class='list-group-item'>".lang('Active Patient'). "</a>";
}
if (Modules::run('permission/check_permission', 'confirm_discharge', 'view')) {
    $menu .= "<a href='" . base_url() . "index.php/order_discharge' class='list-group-item'>".lang('Discharge Order'). "</a>";
}

$menu .= "</div>";
$menu .= " </div> \n";
echo $menu;
?>