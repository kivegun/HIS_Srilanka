
<?php

require 'application/config/database.php';
$con = mysqli_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password']);
$el_id = $_GET["ELID"];
$type ="";
$type = $_GET["TYPE"];
if (!$con)  {
    die('Could not connect: ' );
}
mysqli_select_db($con, $db['default']['database']) or die("cannot select DB");

$out = "";
$sql=" SELECT Name,isNotify ";
$sql .= " FROM complaints WHERE Active = TRUE " ;
if ($type!="") {
    $sql .= " AND Type = '".$type."'";
}
$sql .= " ORDER BY Name ";
$result = mysqli_query($con, $sql);
if (!$result) {
    echo  $sql ;
}
$out .="Press CTRL key for mutiple select.<br>\n";
$out .="<div>";
$out .="<select class='input' style='width:400;'  onChange=lookUpComplaints('".$el_id ."',this.value) >";
if ($type!="") {
    $out .="<option value='' selected>".$type."</option> ";
}
$out .="<option value='' >Category-All</option> ";
$out .="<option value='Cause' >Cause</option> ";
$out .="<option value='Diagnosis' >Diagnosis</option> ";
$out .="<option value='Findings' >Findings</option> ";
$out .="<option value='Procedure' >Procedure</option> ";
$out .="<option value='Symptom' >Symptom</option> ";
$out .="<option value='Vague' >Vague Term</option> ";
$out .="</select>";
$out .="</div>";
$out .="<select class='input' style='width:400;'  id=''   name=''  multiple='multiple' size='20' onclick=updateComplaint(this,'".$el_id."'); >\n";
while($row = mysqli_fetch_array($result))  {
    if($row["isNotify"] == 1) {
        $out .="<option value='".$row["Name"]."' style='color:#FF0000;'>".$row["Name"]."</option>\n";
    }
    else {
        $out .="<option value='".$row["Name"]."' >".$row["Name"]."</option>\n";
    }

}
$jq = "\n";
$jq .= "<script language='javascript'>\n";
$jq .= "</script>\n";
$out .="</select>\n";
$btns="<br><input type='button' value='Ok' onclick=closeOPDDialog('opdDialog')>";
echo $out.$btns;

