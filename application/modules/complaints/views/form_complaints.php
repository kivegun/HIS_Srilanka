<div class='content' xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">System User</div>

    <?php
    $form_generator = new MY_Form('Complaints');
    $form_generator->form_open_current_url();
    $form_generator->input('*Complaint', 'name', $default_Name, 'Complaint Name');
    $type_option = array(
        'Cause' => 'Cause',
        'Diagnosis' => 'Diagnosis',
        'Findings' => 'Findings',
        'Procedure' => 'Procedure',
        'Symptom' => 'Symptom',
        'Vague' => 'Vague'
    );
    $form_generator->dropdown('Type', 'type', $type_option, $default_Type);
    ?>
<!--    <textarea name="ICDLink" id="ICDLink" pos="2" rows="2" class="input" style="width:450px;" readonly="" onfocus="onclick=lookUpICD('ICDLink','','ICDLink',$('#SNOMEDmap').val());"></textarea>-->

    <?php

        $form_generator->text_area_lookup('ICD Link', 'ICDLink', $default_ICD_link, 'ICD link');
        ?>

    <?php
    $form_generator->dropdown('is Notifiable', 'isNotify', array('1' => 'Yes', '0' => 'No'), $default_isNotify);
    $form_generator->text_area('Remarks', 'remarks', $default_Remarks, 'Any Remarks');
    $form_generator->dropdown('Active', 'active', array('1' => 'Yes', '0' => 'No'), $default_Active);
    $form_generator->date_created($default_create_date, $default_create_user, $default_last_update, $default_last_update_user);
    $form_generator->button_submit_reset();
    $form_generator->form_close();
    ?>
    </form>
</div>
<?php echo Modules::run('leftmenu/preference'); //runs the available left menu for preferance ?>
<div id="prefCont"></div>
</div>
</article>
</body>
</html>