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


////////Configuration for patient form
$form = array();
$form["OBJID"] = "UMID";
$form["TABLE"] = "user_menu";
$form["FORM_CAPTION"] = "User Menus";
$form["SAVE"] = "";
$form["NEXT"]  = "preference/load/user_menu";
//pager starts
$form["CAPTION"]  = "User Menus <input type=\'button\' class=\'btn btn-xs btn-success\' onclick=self.document.location=\'".site_url('/top_menu/create')."\' value=\'Add new menu\'>";
$form["ACTION"]  = base_url()."index.php/user_menu/edit/";
$form["ROW_ID"]="UMID";
$form["COLUMN_MODEL"] = array(
    'UMID'=>array("width"=>"35px"),
    'Name',
    'Link',
    'MenuOrder',
    'Active'=> array(
        'stype' => 'select',
        'editoptions' => array(
            'value' => ':All;1:Yes;0:No')));

$form["ORIENT"] = "L";
$form["LIST"] = array( 'UMID', 'Name', 'UserGroup', 'Link', 'MenuOrder', 'Active');
$form["DISPLAY_LIST"] = array( 'Id', 'Name', 'User Group', 'Link', 'Menu Order', 'Active');
//pager ends

$patient["JS"] = "
<script>
function ForceSave(){
}
</script>
";  									
////////Configuration for patient form END;                   
?>