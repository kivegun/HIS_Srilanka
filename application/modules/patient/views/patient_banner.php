<?php
echo '<a href="'.site_url("patient/view/".$patient_info["PID"]).'"><div class="alert alert-info" style="margin-bottom:1px;padding-top:8px;padding-bottom:8px">';
	echo '<b style="font-size:16px;">';
        echo $patient_info["Personal_Title"] . ' ' . $patient_info["Name"];
        if (!empty($patient_info["OtherName"]))
            echo ' / ' . $patient_info["OtherName"];
	echo '</b>';
	echo '&nbsp;/&nbsp;';
	echo  $patient_info["Gender"];
	echo '&nbsp;/&nbsp;';
		if ($patient_info["Age"]["years"]>0){
			echo  $patient_info["Age"]["years"]."Yrs&nbsp;";
		}
		echo  $patient_info["Age"]["months"]."Mths&nbsp;";
		echo  $patient_info["Age"]["days"]."Dys&nbsp;";
	echo '&nbsp;/&nbsp;';
	echo  $patient_info["Personal_Civil_Status"];
	echo '&nbsp;/&nbsp;';
	echo  $patient_info["Address_Street"];
	echo  '<span class="pull-right"><b>Patient ID:&nbsp;'.$patient_info["PID"].'</b></span>';
echo '</div></a>';
?>

