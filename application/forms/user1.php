<?php

// //////Configuration for patient form
$form = array ();
$form ["OBJID"] = "UID"; //primary key
$form ["TABLE"] = "user"; //data table
$form ["FORM_CAPTION"] = "User";
$form ["SAVE"] = "user/save";  //save URI
$form ["NEXT"] = "preference/load/user";
// pager starts
$form ["CAPTION"] = "Available user <input type=\'button\' class=\'btn btn-xs btn-success\' onclick=self.document.location=\'" . site_url ( 'user/create/' ) . "\' value=\'Add new\'>";
$form ["ACTION"] = base_url () . "index.php/user/edit/";
$form ["ROW_ID"] = "UID";
$form ["COLUMN_MODEL"] = array (
		'UID' => array (
				"width" => "35px" 
		),
		'Name',
		'OtherName',
		'DateOfBirth',
		'Active' => array (
				'stype' => 'select',
				'editoptions' => array (
						'value' => ':All;1:Yes;0:No' 
				) 
		),
		'Gender' => array (
				'stype' => 'select',
				'editoptions' => array (
						'value' => ':All;Male:Male;Female:Female' 
				) 
		),
		'UserName',
		'Address_Village'
);
$form ["ORIENT"] = "L";
$form ["LIST"] = array (
		'UID',
		'FirstName',
		'OtherName',
		'DateOfBirth',
		'Active',
		'Gender',
		'UserName',
		'Address_Village'
);
$form ["DISPLAY_LIST"] = array (
		'Id',
		'First name',
		'Other name',
		'Date of birth',
		'Active',
		'Gender',
		'User name',
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