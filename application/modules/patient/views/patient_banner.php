<?php
echo '<div id="patientBanner" class="patientTinny Tinny" '.$extra.'>';
	echo '<table width="100%" border="0" class="tblPatientBannerTinny">';
        echo '<tbody>';
        echo '<tr>';
			echo '<td>';
				echo '<span style="font-size:18px;cursor:pointer;" onclick="javascript:location.href=\''.site_url().'/patient/view/'.$patient_info['PID'].'\'">';
					echo  '<b>'. $patient_info["Personal_Title"] . ' ' . $patient_info["Personal_Used_Name"].' 
						<span>'.$patient_info["Full_Name_Registered"].'</span>  / '.$patient_info["Gender"].' / ';
						if ($patient_info["Age"]["years"]>0){
							echo  $patient_info["Age"]["years"]."yrs&nbsp;";
						}
						echo  $patient_info["Age"]["months"]."mths&nbsp;";
						echo  $patient_info["Age"]["days"]."dys&nbsp;/&nbsp;";
						echo  $patient_info["Personal_Civil_Status"];

				echo '</span>';
			echo  '</td>';
			echo  '<td>PID:&nbsp;'.$patient_info["PID"].'</td>';
			echo  '<td>DOB:&nbsp;'.$patient_info["DateOfBirth"].'</td>';
			echo '<td>Village:&nbsp;'.$patient_info["Address_Village"].'</td>';
			echo  '<td align="right">';
				echo '<img src="'.base_url().'images/edit-icon.png" style="cursor:pointer;" title="Edit record" 
				onmousedown="self.document.location=\''.base_url().'index.php/patient/edit/'.$patient_info['PID'].'/?CONTINUE=patient/view/'.$patient_info['PID'].'\'">';
			echo  '</td>';
		echo  '</tr>';
		echo '</tbody>';
	echo '</table>';
echo '</div>';
?>
<!---->
<?php
//echo '<a href="'.site_url("patient/view/".$patient_info["PID"]).'"><div class="alert alert-info" style="margin-bottom:1px;padding-top:8px;padding-bottom:8px">';
//echo '<b style="font-size:16px;">';
//echo $patient_info["Personal_Title"] . ' ' . $patient_info["Name"];
//if (!empty($patient_info["OtherName"]))
//	echo ' / ' . $patient_info["OtherName"];
//echo '</b>';
//echo '&nbsp;/&nbsp;';
//echo  $patient_info["Gender"];
//echo '&nbsp;/&nbsp;';
//if ($patient_info["Age"]["years"]>0){
//	echo  $patient_info["Age"]["years"]."Yrs&nbsp;";
//}
//echo  $patient_info["Age"]["months"]."Mths&nbsp;";
//echo  $patient_info["Age"]["days"]."Dys&nbsp;";
//echo '&nbsp;/&nbsp;';
//echo  $patient_info["Personal_Civil_Status"];
//echo '&nbsp;/&nbsp;';
//echo  $patient_info["Address_Street"];
//echo  '<span class="pull-right"><b>Patient ID:&nbsp;'.$patient_info["PID"].'</b></span>';
//echo '</div></a>';
//?>


