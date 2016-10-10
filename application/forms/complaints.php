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
__________________________________________________________________________________
Private Practice configuration :

Date : July 2015		ICT Agency of Sri Lanka (www.icta.lk), Colombo
Author : Laura Lucas
Programme Manager: Shriyananda Rathnayake
Supervisors : Jayanath Liyanage, Erandi Hettiarachchi
URL: http://www.govforge.icta.lk/gf/project/hhims/
----------------------------------------------------------------------------------
*/

////////Configuration for patient form
$form = array();
$form["OBJID"] = "COMPID";
// $form["TABLE"] will be used in SQL query
$form["TABLE"] = "complaints";
$form["FORM_CAPTION"] = "Complaints";
$form["SAVE"] = "";
$form["NEXT"]  = "preference/load/complaints";	
//pager starts
$form["CAPTION"]  = "Complaints <input type=\'button\' class=\'btn btn-xs btn-success\' onclick=self.document.location=\'" . site_url ( 'complaints/create/' ) . "\' value=\'Add new complaint\'>";
$form["ACTION"]  = base_url()."index.php/complaints/edit/";
$form["ROW_ID"]="COMPID";
//add ICPC Name and code
$form ["COLUMN_MODEL"] = array (
    'COMPID' => array (
        "width" => "35px"
    ),
    'Name',
    'Type',
    'isNotify' => array (
        'stype' => 'select',
        'editoptions' => array (
            'value' => ':All;1:Yes;0:No'
        )
    ),
    'ICDLink',
    'Remarks'
);
$form ["ORIENT"] = "L";
$form ["LIST"] = array (
    'COMPID',
    'Name',
    'Type',
    'isNotify',
    'ICDLink',
    'Remarks'
);
$form ["DISPLAY_LIST"] = array (
    'COMPID',
    'Name',
    'Type',
    'isNotify',
    'ICDLink',
    'Remarks'
);
//pager ends



$patient["JS"] = "
<script>
function ForceSave(){
}
</script>
";  									
////////Configuration for patient form END;                   
?>