<div id='left-sidebar'>
    <div class='basic' style='float:left;'  id='list1'>
        <a class='LeftMenuItem' href=''>Commands</a>
        <div>
            <input type='button' class='submenuBtn' value='My Clinic Patients'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_list/opd_patient'" >
            <input type='button' class='submenuBtn' value='My Clinic lab Orders'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_list/lab_result'">
            <input type='button' class='submenuBtn' value='My Prescribe' onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_list/pres_order'">
        </div>
    </div>
</div>

