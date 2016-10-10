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
$form["OBJID"] = "FINDID";
$form["TABLE"] = "finding";
$form["FORM_CAPTION"] = "Findings";
$form["SAVE"] = "";
$form["NEXT"]  = "preference/load/findings";
//pager starts
$form["CAPTION"]  = "Findings";
$form["ACTION"]  = base_url()."index.php/findings/edit/";
$form["ROW_ID"]="FINDID";
$form ["COLUMN_MODEL"] = array (
    'FINDID' => array (
        "width" => "35px"
    ),
    'CONCEPTID',
    'TERM'
);
$form ["ORIENT"] = "L";
$form ["LIST"] = array (
    'FINDID',
    'CONCEPTID',
    'TERM'
);
$form ["DISPLAY_LIST"] = array (
    'ID',
    'CONCEPTID',
    'TERM'
);

$patient["JS"] = "
<script>
function ForceSave(){
}
</script>
";
////////Configuration for patient form END;
?>