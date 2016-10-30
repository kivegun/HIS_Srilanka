<div id='left-sidebar'>
    <div class='basic' style='float:left;'  id='list1'>
        <a class='LeftMenuItem' href='#'>Departments</a>
        <div>
            <input type='button' class='submenuBtn' value='OPD Pharmacy'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_prescription'" >
            <input type='button' class='submenuBtn' value='Clinic Pharmacy'  onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_prescription/clinic_prescription'" >
            <input type='button' class='submenuBtn' value='InPatient' onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_prescription/inpatient_prescription'" >
            <input type='button' class='submenuBtn' value='OPD Pharmacy Screen'  onclick="window.open('patient_prescription/pharmacy_screen','_blank','toolbar=0,location=0,menubar=0')"  >
        </div>
        <a class='LeftMenuItem' href=''>Reports</a>
        <div>
            <input type='button' class='submenuBtn' value='Daily drugs dispensed' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/complaints'"  >
            <input type='button' class='submenuBtn' value='Daily drugs dispensed (Me)' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/treatment'" >
            <input type='button' class='submenuBtn' value='Daily OS Drugs' onclick=loadDataTable('','')>
            <input type='button' class='submenuBtn' value='Current stock balance' onclick="javascript:location.href='<?php echo base_url() ?>index.php/my_drug'" >
            <input type='button' class='submenuBtn' value='Create drug order' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/drugs_dosage'" >
            <input type='button' class='submenuBtn' value='Prescriptions' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/drugs_frequency'" >
            <input type='button' class='submenuBtn' value='Prescription by Drug' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/canned_text'" >
        </div>
        <a class='LeftMenuItem' href=''>Maintain</a>
        <div>
            <input type='button' class='submenuBtn' value='Drugs' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference/load/snomed_findings'" >
        </div>
    </div>
</div>
