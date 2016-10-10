<?php



$form = array();
$form["OBJID"] = "DDID";
$form["TABLE"] = "Doctor_Drug";
$form["LIST"] = array( 'DDID', 'Name', 'Type','dDosage','dFrequency','Stock','ClinicStock','Active');
$form["DISPLAY_LIST"] = array( 'DDID','DRGID', 'Drug Name','Default Frequency','Default Dosage','Stock','Priority');
$form["DISPLAY_WIDTH"] = array( '10%', '50%', '20%','10%');
$form["NEXT"]  = "home.php?page=preferences&mod=mydrugs&DDID=";
$form["AUDIT_INFO"] = true;
//pager starts
$form["CAPTION"]  = "My drugs list <input type=\'button\' class=\'btn btn-xs btn-success\' onclick=self.document.location=\'".site_url('treatment/create')."\' value=\'Add new Drug to my list\'>";
$form["ACTION"]  = "home.php?page=preferences&mod=mydrugsEdit&DDID=";
$form["ROW_ID"]="DDID";
//$mydrugForm["COLUMN_MODEL"] = array( 'DRGID'=>array("width"=>"75px"),'Active'=>  array("formatter_JS" => "function(cellvalue, options, rowObject){switch(cellvalue){case '1':return 'yes';break;case '0':return 'no';break;default:return 'undefined';}}",'stype' => 'select', 'editoptions' => array('value' => ":All;1:Yes;0:No"),"searchoptions" => array("defaultValue"=>'')));
$form["ORIENT"] = "L";

//pager ends


//$mydrugForm["FLD"][0]=array(
//"Id"=>"DRGID", "Name"=>"Drug name",
//"Type"=>"selectdrug",  "Value"=>"",
//"Help"=>"Drug name", "Ops"=>"",
//"valid"=>"*"
//);
//$mydrugForm["FLD"][1]=array(
//"Id"=>"POSITIONID", "Name"=>"Drug Position",
//"Type"=>"selectdrugposition",  "Value"=>"",
//"Help"=>"Drug position in your list", "Ops"=>""
//
//
//);
//$mydrugForm["FLD"][2]=array(
//"Id"=>"USRID",     "Name"=>"uid",    "Type"=>"hidden",     "Value"=>$UID,
//"Help"=>"", "Ops"=>""
//);
//
//$doctorDrugsForm["BTN"][1]=array(
//"Id"=>"CancelBtn",    "Name"=>"Cancel", "Type"=>"button",  "Value"=>"Cancel",
//"Help"=>"", "Ops"=>"", "onclick"=>"window.history.back()",
//"Next"=>""
//);

?>