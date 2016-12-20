<?php
$out = "";
$tools = "<img   src='".base_url()."images/edit-icon.png' width=15 height=15  style='cursor:pointer;' title='Edit record'  onclick=self.document.location='".base_url()."index.php/opd_visit/edit/".$opd_visits_info['PID'].'/'.$opd_visits_info["OPDID"]."'>";
//$tools .= "<img   src='images/add_note.jpg' style='cursor:pointer;' title='Add Notes'  />";

$out .= "<div class='".$css_Cont_class."' >\n";
$out .= "<div class='opdBody' >\n";
$out .= "<table border=0 width=100% cellspacing=0   class='opdTbl'>\n";
    $out .= "<tr>\n";
    $out .= "<td>Type: </td><td>".$opd_visits_info["VisitType"]."</td><td align=center>Date and Time of visit: ".$opd_visits_info["DateTimeOfVisit"]."</td><td>Onset Date: ".$opd_visits_info["OnSetDate"]."</td><td>Doctor: ".$this->session->userdata('title') . ' ' . $this->session->userdata('name') . ' ' . $this->session->userdata('other_name')."</td><td align='right'>".$tools."</td>\n";
    $out .= "</tr>\n";
    $out .= "<tr>\n";
    $out .= "<td valign=top>Complaints: </td><td colspan=3>".$opd_visits_info["Complaint"]."</td>\n";
    $out .= "</tr>\n";
    $out .= "<tr>\n";
    $out .= "<td >Remarks: </td><td>".$opd_visits_info["Remarks"]."</td><td colspan=3 align=right>";
    if ($opd_visits_info["LastUpDateUser"]) {
        $out .= "<i>Last Access By : ".$opd_visits_info["LastUpDateUser"]."(".$opd_visits_info["LastUpDate"].")</i>";
    }
    else {
        $out .= "&nbsp;";
    }
    $out .= "</td>\n";
    $out .= "</tr>\n";
$out .= "</table>\n";
$out .= "</div>\n";
$out .= "</div>\n";
$out .= "<div class='notesCont'>\n";
$out .= "</div>\n";

echo $out;
