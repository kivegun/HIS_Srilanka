<?php
// //////Configuration for patient form
$form = array ();
$form ["OBJID"] = "INSTID"; //primary key
$form ["TABLE"] = "institution"; //data table
$form ["FORM_CAPTION"] = "Institutes";
$form ["SAVE"] = "user/save";  //save URI
$form ["NEXT"] = "preference/load/institutions";
// pager starts
$form ["CAPTION"] = "Institutes <input type=\'button\' class=\'btn btn-xs btn-success\' onclick=self.document.location=\'" . site_url ( 'user/create/' ) . "\' value=\'Add new institutions\'>";
$form ["ACTION"] = base_url () . "index.php/institutions/edit/";
$form ["ROW_ID"] = "INSTID";
$form ["COLUMN_MODEL"] = array (
    'INSTID' => array (
        "width" => "35px"
    ),
    'Name',
    'Code',
    'Type',
    'Email',
    'Telephone',
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
    'INSTID',
    'Name',
    'Type',
    'Email1',
    'Telephone1',
    'Address_Village',
    'Active'
);
$form ["DISPLAY_LIST"] = array (
    'ID',
    'Name',
    'Type',
    'Email',
    'Telephone',
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