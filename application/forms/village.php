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
$form["OBJID"] = "VGEID";
$form["TABLE"] = "village";
$form["FORM_CAPTION"] = "Village";
$form["SAVE"] = "";
$form["NEXT"]  = "preference/load/village";
//pager starts
$form["CAPTION"]  = "Village";
$form["ACTION"]  = base_url()."index.php/Village/edit/";
$form["ROW_ID"]="VGEID";
$form["COLUMN_MODEL"] = array (
    'VGEID' => array (
        "width" => "35px"
    ),
    'District',
    'DSDivision',
    'GNDivision',
    'Code',
    'Active' => array (
        'stype' => 'select',
        'editoptions' => array (
            'value' => ':All;1:Yes;0:No'
        )
    )
);
$form ["ORIENT"] = "L";
$form ["LIST"] = array (
    'VGEID',
    'District',
    'DSDivision',
    'GNDivision',
    'Code',
    'Active'
);
$form ["DISPLAY_LIST"] = array (
    'VGEID',
    'District',
    'DSDivision',
    'GNDivision',
    'Code',
    'Active'
);

$patient["JS"] = "
<script>
function ForceSave(){
}
</script>
";
////////Configuration for patient form END;
?>