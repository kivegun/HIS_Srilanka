<?php
$tools= "<img  src='".base_url()."images/patient_edit.png' style='cursor:pointer;' title='Edit record'    
        onmousedown=self.document.location='".base_url()."index.php/patient/edit/".$patient_info['PID']."'>";
$tools .= "&nbsp;<img   src='".base_url()."images/patient_screen.png' style='cursor:pointer;' title='Open' onclick=openPatient('".$patient_info['PID']."')><br>";
$patInfo = "";
$patInfo .= "<div id ='patientBanner' class='patientBanner'>\n";
    $patInfo .= "<table width=100% border=0 class='tblPatientBanner'>\n";
        $patInfo .= "<tr><td>Full Name: </td><td><b>".$patient_info['Personal_Used_Name']." ".$patient_info['Full_Name_Registered']."</b></td><td>Registration No: </td><td><b>".$patient_info['PID']."</b></td><td  rowspan=5 valign=top align=right>".$tools."</td></tr>\n";
        $patInfo .= "<tr><td>Gender: </td><td>".$patient_info['Gender']."</td><td>NIC: </td><td>".$patient_info['NIC']."</td></tr>\n";
            $address = '';
            if ($patient_info["Address_Street"]!="") $address .= $patient_info["Address_Street"].", ";
            if ($patient_info["Address_Street1"]!="") $address .= $patient_info["Address_Street1"].", ";
            $address .= $patient_info["Address_Village"].",<br>";
            $address .= $patient_info["Address_DSDivision"].",<br>";
            $address .= $patient_info["Address_District"];
        $patInfo .= "<tr><td>Date of birth: </td><td>~".$patient_info['DateOfBirth']."</td><td >Address: </td><td rowspan=3 valign=top>".$address."</td></tr>\n";
            $age = '';
            if ($patient_info["Age"]["years"] > 0) {
                $age = $patient_info["Age"]["years"] . " Yrs&nbsp;";
            }
            $age .= $patient_info["Age"]["months"] . " Mths&nbsp;";
            $age .= $patient_info["Age"]["days"] . " Dys&nbsp;";
        $patInfo .= "<tr><td>Age: </td><td>~<b>".$age."</b></td><td></td></tr>\n";
        $patInfo .= "<tr><td>Civil Status: </td><td>".$patient_info['Personal_Civil_Status']."</td><td></td></tr>\n";
        $patInfo .= "</table></div>\n";



echo $patInfo;
?>;
