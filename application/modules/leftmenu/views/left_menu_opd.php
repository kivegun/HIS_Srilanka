<div id='left-sidebar'>
    <div class='basic' style='float:left;'  id='list1'>
        <a class='LeftMenuItem' href=''>Commands</a>
        <div>
            <input type='button' class='submenuBtn' value='&laquo; Patient overview'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient/view/<?php echo $pid ?>'" >
            <input type='button' class='submenuBtn' <?php echo $css_menu_time ?> value='Add history' onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_history/add/<?php echo $pid ?>/?CONTINUE=patient/view/<?php echo $pid ?>'"  >
            <input type='button' class='submenuBtn' <?php echo $css_menu_time ?> value='Add allergy'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_allergy/add/<?php echo $pid ?>/?CONTINUE=patient/view/<?php echo $pid ?>'"  >
            <input type='button' class='submenuBtn' <?php echo $css_menu_time ?> value='Examination'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_examination/add/<?php echo $pid ?>'">
            <input type='button' class='submenuBtn' <?php echo $css_menu_time ?> value='Order LabTest'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_examination/add/<?php echo $pid ?>'">
            <input type='button' class='submenuBtn' <?php echo $css_menu_time ?> value='Order ECG'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_examination/add/<?php echo $pid ?>'">
            <input type='button' class='submenuBtn' <?php echo $css_menu_time ?> value='Prescribe drugs'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_examination/add/<?php echo $pid ?>'">
            <input type='button' class='submenuBtn' <?php echo $css_menu_time ?> value='Treatments'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_examination/add/<?php echo $pid ?>'">
        </div>
        <a class='LeftMenuItem' href=''>Questionnaire</a>
        <div>
            <input type='button' class='submenuBtn' value='Complaints' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/complaints'"  >
            <input type='button' class='submenuBtn' value='Treatments' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/treatment'" >
        </div>
        <a class='LeftMenuItem' href=''>Prints</a>
        <div>
            <input type='button' class='submenuBtn' value='Prescription' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/snomed_findings'" >
            <input type='button' class='submenuBtn' value='Lab test' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/disorders'" >
            <input type='button' class='submenuBtn' value='Print patient slip' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/snomed_events'" >
            <input type='button' class='submenuBtn' value='Print patient cards' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/snomed_procedures'" >
            <input type='button' class='submenuBtn' value='Visit Summary' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/icd10'" >
        </div>
    </div>
</div>


