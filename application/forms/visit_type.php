<?php

// //////Configuration for patient form
$form = array ();
$form["OBJID"] = "VTYPID"; //primary key
$form["TABLE"] = "visit_type"; //data table
$form["FORM_CAPTION"] = "Visit Type";
$form["SAVE"] = "user/save";  //save URI
$form["NEXT"] = "preference/load/visit_type";
// pager starts
$form["CAPTION"] = "Visit Type <input type=\'button\' class=\'btn btn-xs btn-success\' onclick=self.document.location=\'".site_url('visit_type/create')."\' value=\'Add new visit type\'>";
$form["ACTION"] = base_url () . "index.php/visit_type/edit/";
$form["ROW_ID"] = "VTYPID";
$form["COLUMN_MODEL"] = array (
    'VTYPID' => array (
        "width" => "35px"
    ),
    'Name',
    'Remarks',
    'Stock',
    'Active' => array (
        'stype' => 'select',
        'editoptions' => array (
            'value' => ':All;1:Yes;0:No'
        )
    ),
);
$form["ORIENT"] = "L";
$form["LIST"] = array (
    'VTYPID',
    'Name',
    'Remarks',
    'Stock',
    'Active'
);
$form["DISPLAY_LIST"] = array (
    'ID',
    'Name',
    'Remarks',
    'Pharmacy Stock',
    'Active'
);

//$form["FLD"][0]=array(
//    "Id"=>"Name", "Name"=>"Name",
//    "Type"=>"text",  "Value"=>"",
//    "Help"=>"Type", "Ops"=>"",
//    "valid"=>"*"
//);
//$form["FLD"][1]=array(
//    "Id"=>"Stock", "Name"=>"Pharmacy stock",
//    "Type"=>"select",  "Value"=>array("Stock","ClinicStock"),
//    "Help"=>"What stock to be used", "Ops"=>"",
//    "valid"=>"*"
//);
//$form["FLD"][2]=array(
//    "Id"=>"Remarks", "Name"=>"Remarks",    "Type"=>"textarea",
//    "Value"=>"",     "Help"=>"Remarks",   "Ops"=>"",
//    "valid"=>""
//);
//$form["FLD"][3]=array(
//    "Id"=>"Active",    "Name"=>"Active",  "Type"=>"bool",
//    "Value"=>"",   "Help"=>"Active or not",  "Ops"=>"",
//    "valid"=>""
//);
//
//$form["FLD"][4]=array(
//    "Id"=>"_", "Name"=>"",   "Type"=>"line",     "Value"=>"",     "Help"=>"",   "Ops"=>""
//);
//$form["BTN"][0]=array(
//    "Id"=>"SaveBtn",    "Name"=>"Save",   "Type"=>"button", "Value"=>"Save",
//    "Help"=>"",   "Ops"=>"",  "onclick"=>"saveData()",
//    "Next"=>""
//);
//
//$form["BTN"][1]=array(
//    "Id"=>"CancelBtn",    "Name"=>"Cancel", "Type"=>"button",  "Value"=>"Cancel",
//    "Help"=>"", "Ops"=>"", "onclick"=>"window.history.back()",
//    "Next"=>""
//);

//$form["FLD"]=array(
//    array(
//    "Id"=>"Name", "Name"=>"Name",
//    "Type"=>"text",  "Value"=>"",
//    "Help"=>"Type", "Ops"=>"",
//    "valid"=>"*"
//    ),
//    array(
//        "Id"=>"Stock", "Name"=>"Pharmacy stock",
//        "Type"=>"select",  "Value"=>array("Stock","ClinicStock"),
//        "Help"=>"What stock to be used", "Ops"=>"",
//        "valid"=>"*"
//    ),
//    array(
//        "Id"=>"Remarks", "Name"=>"Remarks",    "Type"=>"textarea",
//        "Value"=>"",     "Help"=>"Remarks",   "Ops"=>"",
//        "valid"=>""
//    ),
//    array(
//        "Id"=>"Active",    "Name"=>"Active",  "Type"=>"bool",
//        "Value"=>"",   "Help"=>"Active or not",  "Ops"=>"",
//        "valid"=>""
//    ),
//
//    array(
//        "Id"=>"_", "Name"=>"",   "Type"=>"line",     "Value"=>"",     "Help"=>"",   "Ops"=>""
//    ),
//    array(
//        "Id"=>"SaveBtn",    "Name"=>"Save",   "Type"=>"button", "Value"=>"Save",
//        "Help"=>"",   "Ops"=>"",  "onclick"=>"saveData()",
//        "Next"=>""
//    ),
//
//    array(
//        "Id"=>"CancelBtn",    "Name"=>"Cancel", "Type"=>"button",  "Value"=>"Cancel",
//        "Help"=>"", "Ops"=>"", "onclick"=>"window.history.back()",
//        "Next"=>""
//    ),
//);

// Address_Street Address_Village Address_DSDivision Address_District
$patient ["JS"] = "
<script>
function ForceSave(){
}
</script>
";
// //////Configuration for patient form END;
?>