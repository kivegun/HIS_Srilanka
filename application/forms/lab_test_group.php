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
$form["OBJID"] = "LABGRPTID";
$form["TABLE"] = "lab_test_group";
$form["FORM_CAPTION"] = "Lab Test Group";
$form["SAVE"] = "";
$form["NEXT"]  = "preference/load/lab_test_group";	
//pager starts
$form["CAPTION"]  = "Lab test group <input type=\'button\' class=\'btn btn-xs btn-success\' onclick=self.document.location=\'".site_url('lab_test_group/create')."\' value=\'Add new Lab Group\'>";
$form["ACTION"]  = base_url()."index.php/lab_test_group/edit/";
$form["ROW_ID"]="LABGRPTID";
$form ["COLUMN_MODEL"] = array (
    'LABGRPTID' => array (
        "width" => "35px"
    ),
    'Name',
    'Active' => array (
        'stype' => 'select',
        'editoptions' => array (
            'value' => ':All;1:Yes;0:No'
        )
    ),
);
$form ["ORIENT"] = "L";
$form ["LIST"] = array (
    'LABGRPTID',
    'Name',
    'Active',
);
$form ["DISPLAY_LIST"] = array (
    'LABGRPTID',
    'Name',
    'Active',
);

$patient["JS"] = "
<script>
function ForceSave(){
}
</script>
";  									
////////Configuration for patient form END;                   
?>