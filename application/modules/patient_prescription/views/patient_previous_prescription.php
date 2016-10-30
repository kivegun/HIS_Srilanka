<?php
if ((isset($previous_prescription_list)) && (!empty($previous_prescription_list))) {
    echo '<div class="panel panel-default" >';
    echo '<div class="panel-heading" ><b>Prescriptions for this visit</b></div>';
    echo '<table class="table table-condensed table-hover"  style="font-size:0.95em;margin-bottom:0px;cursor:pointer;">';
    for ($i = 0; $i < count($previous_prescription_list); ++$i) {
        echo '<tr onclick="self.document.location=\'' . site_url("patient_prescription/view/" . $previous_prescription_list[$i]->PrescriptionID) . '?CONTINUE='. $continue . '\';">';
        echo '<td>';
        echo $previous_prescription_list[$i]->CreateDate;
        echo '</td>';
        echo '<td>';
        if (!empty($previous_prescription_list[$i]->order_by)){
            echo 'Order By: '.$previous_prescription_list[$i]->order_by->Title.' '.$previous_prescription_list[$i]->order_by->Name. ' '.$previous_prescription_list[$i]->order_by->OtherName;
        }
        echo '</td>';

        echo '<td style="text-align: right">';
        switch ($previous_prescription_list[$i]->Status) {
            case 'Pending':
                echo '<span class="glyphicon glyphicon-time"></span>';
                echo '<span style="color: red"> Pending</span>';
                break;
            case 'Dispensed':
                echo '<span class="glyphicon glyphicon-check"></span>';
                echo '<span style="color: green"> Dispensed</span>';
                break;
        }
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
}
?>