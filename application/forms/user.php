<?php

// //////Configuration for patient form
$form = array ();
$form ["OBJID"] = "UID"; //primary key
$form ["TABLE"] = "user"; //data table
$form ["FORM_CAPTION"] = "User";
$form ["SAVE"] = "user/save";  //save URI
$form ["NEXT"] = "preference/load/user";
// pager starts
$form ["CAPTION"] = "Users";
$form ["ACTION"] = base_url () . "index.php/user/edit/";
$form ["ROW_ID"] = "UID";
$form ["COLUMN_MODEL"] = array (
		'UID' => array (
				"width" => "35px" 
		),
		'FirstName',
		'OtherName',
		'DateOfBirth',
		'Gender' => array (
				'stype' => 'select',
				'editoptions' => array (
						'value' => ':All;Male:Male;Female:Female' 
				) 
		),
        'Post',
		'UserName',
        'UserGroup',
		'Address_Village'
);
$form ["ORIENT"] = "L";
$form ["LIST"] = array (
		'UID',
		'FirstName',
		'OtherName',
		'DateOfBirth',
		'Gender',
        'Post',
		'UserName',
        'UserGroup',
		'Address_Village'
);
$form ["DISPLAY_LIST"] = array (
		'Id',
		'First name',
		'Other name',
		'Date of birth',
		'Gender',
        'Post',
		'User name',
        'User Group',
		'Village'
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