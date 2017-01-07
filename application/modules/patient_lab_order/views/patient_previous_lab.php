<?php
if ((isset($patient_lab_order_list)) && (!empty($patient_lab_order_list))) {
    echo '<div class="panel panel-default" >';
    echo '<div class="panel-heading"  ><b>' .lang('Previous Lab Orders'). '</b></div>';

    echo '<table class="table table-condensed table-hover"   style="font-size:0.95em;margin-bottom:0px;cursor:pointer;">';
    for ($i = 0; $i < count($patient_lab_order_list); ++$i) {
        if ($patient_lab_order_list[$i]->Status === 'Done') {
            echo '<tr onclick="self.document.location=\'' . site_url("patient_lab_order/view_result/" . $patient_lab_order_list[$i]->LAB_ORDER_ID) . '?CONTINUE=' . $continue . '\'; " >';
        } else {
            echo '<tr onclick="">';
        }
//        echo '<tr onclick="">';
        echo '<td width=10px>';
        echo '<a title="Click here to open the related record" class="btn btn-xs ';
        if ($this->uri->segment(3) == $patient_lab_order_list[$i]->RefID) {
            echo ' btn-warning"';
        } else {
            echo ' btn-default"';
        }
        if ($patient_lab_order_list[$i]->RefType == "OPD") {
            echo ' href="' . site_url("opd_visit/view/" . $patient_lab_order_list[$i]->RefID) . '" ';
        }
        if ($patient_lab_order_list[$i]->RefType == "ADM") {
            echo ' href="' . site_url("admission/view/" . $patient_lab_order_list[$i]->RefID) . '" ';
        } else {
            echo ' href="#" ';
        }
        echo '>' . $patient_lab_order_list[$i]->RefType . '</a>';
        echo '</td>';
        echo '<td>';
        echo $patient_lab_order_list[$i]->CreateDate;
        echo '</td>';
        echo '<td>';
//        if ($patient_lab_order_list[$i]->Status === 'Done') {
//            echo '<a title="Click here to view the lab test result" href="' . site_url("patient_lab_order/update/" . $patient_lab_order_list[$i]->LAB_ORDER_ID) . '?CONTINUE=' . $continue . ' " >';
//            echo $patient_lab_order_list[$i]->group->Name;
//            echo '</a>';
//        } else {
            echo $patient_lab_order_list[$i]->group->Name;
//        }
        echo '</td>';
        echo '<td>';
        if (!empty($patient_lab_order_list[$i]->order_by)) {
            echo 'Order By: ' . $patient_lab_order_list[$i]->order_by->Title . ' ' . $patient_lab_order_list[$i]->order_by->Name . ' ' . $patient_lab_order_list[$i]->order_by->OtherName;
        }
        echo '</td>';
        echo '<td style="text-align: right">';
        if ($patient_lab_order_list[$i]->Status == "Pending") {

            echo '<span class="glyphicon glyphicon-time"></span>';
            echo '<span style="color: red"> Pending</span>';
        } else {
            echo '<span class="glyphicon glyphicon-check"></span>';
            echo '<span style="color: green"> ' . $patient_lab_order_list[$i]->Status . '</span>';
        }
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
}
?>