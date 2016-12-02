<?php
/**
 * Created by PhpStorm.
 * User: kivegun
 * Date: 12/2/16
 * Time: 5:49 AM
 */
$icd_code = $_GET["ICD"];

if (!$icd_code) return null;
require 'application/config/database.php';

$immr = checkICD($icd_code);

if ($immr)	{
    echo $immr;
}
else {
    echo "0245|||Undiagnosed / uncoded";
}
//0049|||Other infectious and parasitic diseases

function checkICD($code){
    $out  = "";
    $data = array();

    if ((!$code) || ($code == "")) return null;

    $mdsDB = mysqli_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password']);;
    $sql =" SELECT * FROM immr WHERE ICDCODE LIKE '%".$code."%' ";
    $result = mysqli_query($sql);;
    if (!$result) return null;
    $i =0;
    while ($row = mysqli_fetch_array($result, MYSQL_BOTH)) {
        $data[$i]=array("code"=>$row["Code"],"immr"=>$row["Name"]);
        $i++;
    }
    if ($i >0) {
        return $data[0]["code"]."|||".$data[0]["immr"];
    }
    else {
        $icd_array = explode(".", $code);
        if (count($icd_array) == 0 ) return null;
        for ($j = 0 ; $j<count($icd_array)-1 ;$j++) {
            $new_icd_code .= $icd_array[$j].".";

        }
        $new_icd_code = substr_replace( $new_icd_code, "", -1 );;
        return checkICD($new_icd_code);
    }
}