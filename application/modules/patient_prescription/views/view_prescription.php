<div class="content" xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">Edit IMMR</div>
    <?php

echo  '<div id="formCont" class="formCont" style="left:20;" >\n';
    echo  '<div class="prescriptionHead" style="font-size:23px;">OPD Prescription.</div>';
    echo  '<div class="prescriptionInfo">\n';
        echo  '<table border=0 width=100% class="PrescriptionInfo">\n';
            echo  '<tr>';
                //echo  '<td>Hospital." : </td><td>'.$_SESSION['Hospital'].'</td>';
                echo  '<td nowrap>Prescription ID </td><td nowrap>'.$prescription->getId().'</td>';
                echo  '</tr>';
            echo  '<tr>';
                echo  '<td>Prescribed By </td><td>'.$prescription->getValue("PrescribeBy").'</td>';
                echo  '<td>Prescribed On </td><td nowrap>'.$prescription->getValue("PrescribeDate").'</td>';
                echo  '</tr>';
            //echo  '<tr><td colspan=4><hr style="border:0;color: #000000;background-color: #000000;height:1px;"></td></tr>';
            echo  '<tr>';
                echo  '<td>Patient </td><td>'.$pat->getFullName().' ('.$pat->getId().') </td>';
                list ($yrs,$mths)= $pat->dateDifference($pat->getValue("DateOfBirth,date("Y/m/d);
                echo  '<td nowrap>Gender/Age </td><td nowrap>'.$pat->getValue("Gender").'&nbsp;/&nbsp;'.$yrs.'yrs&nbsp;'.$mths.'mths</td>';
                echo  '</tr>';
            //  echo  '<tr><td colspan=4><hr style="border:0;color: #000000;background-color: #000000;height:1px;"></td></tr>';
            echo  '<tr>';
                echo  '<td>Complaints / Injuries </td><td>'.$opd->getValue("Complaint").'</td>';
                echo  '<td nowrap>Doctor </td><td nowrap>'.$opd->getValue("Doctor").'</td>';
                echo  '</tr>';
            echo  '<tr>';
                echo  '<td>Stock </td><td><b>';
                        if ($prescription->getValue("GetFrom" == "Stock"))
                        echo 'OPD Stock';
                        else
                        echo 'Clinic Stock';
                        echo '</B></td>';
                echo  '<td nowrap>Visit type </td><td nowrap>'.$opd->getValue("VisitType").'</td>';
                echo  '</tr>';
            echo  '<tr><td colspan=4><hr style="border:0;color: #000000;background-color: #000000;height:1px;"></td></tr>';
            echo  '</table>\n';
        echo  '<table border=0 width=100% class="PrescriptionInfo">\n';
            echo  '<tr>';
                echo  '<td class="pTd">#</td><td class="pTd">Drug</td><td nowrap class="pTd">Dosage</td>';
                echo '<td nowrap class="pTd">Frequency</td><td nowrap class="pTd">Period</td>';
                echo '<td nowrap class="pTd">Dispense Quantity</td><td nowrap class="pTd">Prescribed Quantity</td>';
                echo '<td nowrap class="pTd">Left Quantity on '.date("Y-m-d").'</td>';
                echo  '</tr>';
            echo  getPrescriptionItemsForDispense($prescription->getId(),$prescription->getValue("GetFrom");

            echo  '</table>\n';
        echo  '<div align=center>';
$prsid=$prescription->getId();
$check=checkStatus($prsid);

if ($check==1){
    //echo '<input id='okBtn' type='button'  class='formButton' value='Ready' onclick=DrugsReady($prsid);>\n ';
    echo '<input id="okBtn" type="button"  class="formButton" value="Dispense" onclick=saveData();>\n ';
}
if ( $prescription->getValue("Status" == "Ready")) {
    echo '<input id="okBtn" type="button"  class="formButton" value="Dispense" onclick=saveData();>\n ';
}
/* $prsid=$prescription->getId();
$check=checkStatus($prsid);

echo $check; */

echo '<input type="button" value="Back"  class="formButton" onclick=window.history.back();>';
$out .= loadPlugins();
echo '<div>\n ';

echo '</div>\n';
echo '</div>\n '; 
    
    ?>
    
<script language="javascript">
function saveData() {
    var val=''; var txt=''; var pq=''; var lq='';
    $('input[type="number"]').each(function(){
        val += $(this).val()+'|';
    });
    $('input[type="text"]').each(function(){
        pq += $(this).val()+'|';
    });
    $('input[type="tel"]').each(function(){
        lq += $(this).val()+'|';
    });
    $('input:hidden').each(function(){
        txt += $(this).val()+'|';
    });
    $('#okBtn').attr('disabled','true');
    var resM=$.ajax({
url: 'include/prescribe_save.php?',
global: false,
type: 'POST',
data:({txt:txt,val:val,pq:pq,lq:lq,PQ:$('#pq').val(),LQ:$('#lq').val(),PRSID:'97560',LastUpDateUser:'Demop Demo Programmer',LastUpDate:'2016-11-09 06:34:19',Stock:'Stock'}),
async:false
}).responseText;
 eval(resM);
 if ( !Error ) {
     self.document.location='home.php?page=pharmacy' ;
 } else { $('#MDSError').html(res); }
 $('#okBtn').attr('disabled','false');
}
parent.window.onbeforeunload = confirmExit;
</script>

