<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 ">
            <?php
            echo Modules::run('leftmenu/patient', $id); //runs the available left menu for preferance
            ?>
        </div>
        <div class="col-md-10 ">
            <?php
            echo Modules::run('patient/banner_full', $id);
            ?>
            <?php if (has_permission('patient_all_history', 'view')) { ?>
                <div class="container-fluid">
                    <div class="panel panel-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="emr_cont" style='padding: 5px;'><?php echo $previous_emergency_visit; ?></div>
                                <div id="opd_cont" style='padding: 5px;'><?php echo $previous_opd_visits; ?></div>
                                <div id="adm_cont" style='padding: 5px;'><?php echo $admissions; ?></div>
                            </div>
                            <div class="col-md-6">
                                <div id="exam_cont" style='padding: 5px;'><?php echo $exams; ?></div>
                                <div id="his_cont" style='padding: 5px;'><?php echo $patient_history; ?></div>
                                <div id="alergy_cont" style='padding: 5px;'><?php echo $allergy; ?></div>
<!--                                <div id="pre_cont" style='padding: 5px;'>--><?php //echo $prescriptions; ?><!--</div>-->
<!--                                <div id="lab_cont" style='padding: 5px;'>--><?php //echo $lab_orders; ?><!--</div>-->
                                <div id="notes_cont" style='padding: 5px;'><?php print_r($notes); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    $("#add_to_active_list").click(function () {
        event.preventDefault();
        $.getJSON("<?php echo base_url() . 'index.php/active_list/is_in_active_list/' . $id ?>", function (data) {
            if (data.is_in_active_list) {
                alert('This patient on active list');
            } else {
                window.location.href = $("#add_to_active_list").attr("href");
            }
        })
    })
</script>