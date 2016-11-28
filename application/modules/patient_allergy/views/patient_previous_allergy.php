<?php
if ((isset($patient_allergy_list)) && (!empty($patient_allergy_list))) {
    echo '<div class="panel  panel-default" >';
    echo '<div class="panel-heading" " ><b>Allergies</b></div>';
    echo '<table class="table table-condensed table-hover"  style="font-size:0.95em;margin-bottom:0px;cursor:pointer;">';
    for ($i = 0; $i < count($patient_allergy_list); ++$i) {
        echo '<tr onclick="self.document.location=\'' . site_url("patient_allergy/edit/" . $patient_allergy_list[$i]["ALLERGYID"]) . '?CONTINUE=' . $continue . '\';">';
        echo '<td>';
        echo $patient_allergy_list[$i]["CreateDate"];
        echo '</td>';
        echo '<td>';
        echo $patient_allergy_list[$i]["Name"];
        echo '</td>';
        echo '<td>';
        echo $patient_allergy_list[$i]["Remarks"];
        echo '</td>';

        echo '<td style="text-align: right">';
        if ($patient_allergy_list[$i]["Status"] == "Current") {
            echo '<span class="fa fa-check"></span><span style="color: red;"> ' . $patient_allergy_list[$i]["Status"] . '</span>';
        } else {
            echo '<span class="fa fa-clock-o"></span><span style="color: green;"> ' . $patient_allergy_list[$i]["Status"] . '</span>';
        }
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
}
?>		