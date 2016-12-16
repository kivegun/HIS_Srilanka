<?php
if (!$OPDID) {
echo " <script language='javascript'> \n" ;
    echo " jQuery().ready(function(){ \n";
    echo " $('#MDSError').html('Patient not found!'); \n";
    echo "}); \n";
    echo " </script>\n";
return "";
}
            ?>
<div class='content'>
    <div id="mdsHead" class="mdshead">Patient Visit Information</div>
    <?php echo Modules::run('leftmenu/opd', $OPDID, $PID, $opd_visits_info); //runs the available left menu for preferance ?>
    <script language="javascript">
        $('#list1a').accordion({navigation: true,active: false,header: '.LeftMenuItem'});
        $('.LeftMenuItem').click(function(event){  window.location.hash=this.hash;});
    </script>
            <!--Patient Info-->
            <?php echo Modules::run('patient/banner', $PID) ?>
            <!--End Patient Info-->

</div>
            <!-- OPD INFO-->
            <?php echo Modules::run('opd_visit/info', $OPDID); ?>
            <!-- END OPD INFO-->

            <!-- LAB-->
<!--            --><?php //echo Modules::run('patient_lab_order/get_previous_lab', $PID, 'opd_visit/view/' . $opd_visits_info["OPDID"], "HTML"); ?>
<!--            <!-- END LAB-->
<!---->
<!--            <!-- Radiology-->
<!--            --><?php //echo Modules::run('patient_radiology_order/get_previous', $PID, 'opd_visit/view/' . $opd_visits_info["OPDID"], "HTML"); ?>
<!--            <!-- END Radiology-->
<!---->
<!--            <!-- TREATMENT-->
<!--            --><?php //echo Modules::run('treatment_order/get_previous_treatment_list', 'opd', $opd_visits_info["OPDID"], 'opd_visit/view/' . $opd_visits_info["OPDID"], "HTML"); ?>
<!--            <!-- END TREATMENT-->
<!---->
<!--            <!-- Injection-->-
<!--            --><?php //echo Modules::run('patient_injection/get_previous_injection', $PID, 'opd_visit/view/' . $opd_visits_info["OPDID"], "HTML"); ?>
<!--            <!-- END Injection-->
<!---->
<!--            <!-- PRESCRIPTION-->
<!--            --><?php
//            echo Modules::run('patient_prescription/get_previous_prescription', 'opd', $opd_visits_info["OPDID"], 'opd_visit/view/' . $opd_visits_info["OPDID"], "HTML");
//            ?>
<!---->
<!--            <!-- NOTES-->
<!--            --><?php //echo Modules::run('patient_note/get_previous_notes_list', $PID, 'opd', $opd_visits_info["OPDID"], 'opd_visit/view/' . $opd_visits_info["OPDID"], "HTML"); ?>
<!--            <!-- END NOTES-->
<!---->
<!--            <!-- ALLERGY-->
<!--            --><?php //echo Modules::run('patient_allergy/get_previous_allergy', $PID, 'opd_visit/view/' . $opd_visits_info["OPDID"], "HTML"); ?>
<!--            <!-- END ALLERGY-->
<!---->
<!--            <!-- PAST HISTORY-->
<!--            --><?php //echo Modules::run('patient_history/get_previous_history', $PID, 'opd_visit/view/' . $opd_visits_info["OPDID"], "HTML"); ?>
<!--            <!-- END PAST HISTORY-->
<!---->
<!--            <!-- EXAMINATION-->
<!--            --><?php //echo Modules::run('patient_examination/get_previous_exams', $PID, 'opd_visit/view/' . $opd_visits_info["OPDID"], "HTML"); ?>
            <!-- END EXAMINATION-->
</article>
</body>
</html>
