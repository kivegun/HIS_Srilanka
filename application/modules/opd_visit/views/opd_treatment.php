<div class='content' xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">Aadd/Edit treatment orders</div>
        <?php
        echo Modules::run('patient/banner', $pid, 'style="left:20;"');
        ?>
        <?php
        $form_generator = new MY_Form('OPD Treatment');
        $form_generator->form_open_current_url();
        $form_generator->dropdown_treatment('*Treatment', 'treatment', $dropdown_treatment, $default_treatment);
        $form_generator->text_area('Remarks', 'remarks', $default_remarks, '', 'onkeyup="getCannedText(this)"');
        $form_generator->dropdown('Active', 'active', array('1' => 'Yes', '0' => 'No'), $default_active);
        $form_generator->button_submit_reset();
        ?>