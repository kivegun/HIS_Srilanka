<?php
// //////Configuration for patient form
$form = array ();
$form ["OBJID"] = "HID"; //primary key
$form ["TABLE"] = "hospital"; //data table
$form ["FORM_CAPTION"] = "Hosital Settings";
$form ["SAVE"] = "user/save";  //save URI
$form ["NEXT"] = "preference/load/hospital_settings";
// pager starts
$form ["CAPTION"] = "Hospital Settings";
$form ["ACTION"] = base_url () . "index.php/hospital_settings/edit/";
$form ["ROW_ID"] = "HID";
$form ["COLUMN_MODEL"] = array (
    'HID' => array (
        "width" => "35px"
    ),
    'Name',
    'Code',
    'Type',
    'Village',
    'Active' => array (
    'stype' => 'select',
    'editoptions' => array (
        'value' => ':All;1:Yes;0:No'
    )
),
);
$form ["ORIENT"] = "L";
$form ["LIST"] = array (
    'HID',
    'Name',
    'Code',
    'Type',
    'Address_Village',
    'Active'
);
$form ["DISPLAY_LIST"] = array (
    'ID',
    'Name',
    'Code',
    'Type',
    'Village',
    'Active'
);
// Address_Street Address_Village Address_DSDivision Address_District
$patient ["JS"] = "
<script>
function ForceSave(){
}
</script>
";
// //////Configuration for patient form END;
?>