<div id='left-sidebar'>
    <div class='basic' style='float:left;'  id='list1'>
        <a class='LeftMenuItem' href=''>System Tables</a>
        <div>
            <input type='button' class='submenuBtn' value='Add/Edit Users'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference'" >
            <input type='button' class='submenuBtn' value='Add/Edit Group'  onclick=loadDataTable('','') >
            <input type='button' class='submenuBtn' value='Permission Allocation' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/permission'">
            <input type='button' class='submenuBtn' value='Add/Edit Visit Type'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/visit_type'"  >
            <input type='button' class='submenuBtn' value='Hospital Settings'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/hospital_settings'" >
            <input type='button' class='submenuBtn' value='Institutions'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/institutions'" >
            <input type='button' class='submenuBtn' value='Menu Bar'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/user_menu'"  >
        </div>
        <a class='LeftMenuItem' href=''>Clinical Tables</a>
        <div>
            <input type='button' class='submenuBtn' value='Complaints' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/complaints'"  >
            <input type='button' class='submenuBtn' value='Treatments' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/treatment'" >
            <input type='button' class='submenuBtn' value='Drugs' onclick=loadDataTable('','')>
            <input type='button' class='submenuBtn' value='My Drugs' onclick="javascript:location.href='<?php echo base_url() ?>index.php/my_drug'" >
            <input type='button' class='submenuBtn' value='Drugs Dosage' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/drugs_dosage'" >
            <input type='button' class='submenuBtn' value='Drugs Frequency' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/drugs_frequency'" >
            <input type='button' class='submenuBtn' value='Canned Text' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/canned_text'" >
            <input type='button' class='submenuBtn' value='Lab Test' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/lab_tests'" >
            <input type='button' class='submenuBtn' value='Lab Test Group' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/lab_test_group'" >
            <input type='button' class='submenuBtn' value='Lab Test Department' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/lab_test_department'" >
            <input type='button' class='submenuBtn' value='Wards' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/wards'" >
            <input type='button' class='submenuBtn' value='Questionnaires' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/questionnaires'" >
        </div>
        <a class='LeftMenuItem' href=''>Application Tables</a>
        <div>
            <input type='button' class='submenuBtn' value='SNOMED Findings' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/findings'" >
            <input type='button' class='submenuBtn' value='SNOMED Disorders' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/disorders'" >
            <input type='button' class='submenuBtn' value='SNOMED Events' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/events'" >
            <input type='button' class='submenuBtn' value='SNOMED Procedures' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/procedures'" >
            <input type='button' class='submenuBtn' value='ICD 10' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/icd10'" >
            <input type='button' class='submenuBtn' value='IMMR' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/immr'" >
            <input type='button' class='submenuBtn' value='Village' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/village'" >
        </div>
    </div>
</div>
