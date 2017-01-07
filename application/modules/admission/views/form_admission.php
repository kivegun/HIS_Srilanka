<div class="content">
    <div id="mdsHead" class="mdshead">New admission</div>
    <?php echo Modules::run('patient/banner', $pid, 'style="left:20;"');?>
    <?php
        $date = date("Y-m-d H:i:s");
        $form_generator = new MY_Form('Patient Examination');
        $form_generator->form_open_current_url();

        $form_generator->input('Date and time of admission', 'admission_date', $default_admission_date, '', 'disabled');
        $form_generator->input_date('*Onset Date', 'onset_date', $default_onset_date);
        $form_generator->input_bed('*Bed Head No', 'BHT', $default_BHT, '', '');
        $form_generator->input('*Doctor', 'doctor', $default_doctor, '', 'readonly');
        $form_generator->text_area_complaints('*Complaint / Injury', 'Complaint', $default_complaint, '', $complaint);
        $form_generator->textar();
        $form_generator->dropdown('*Ward', 'ward', $dropdown_ward, $default_ward);
        $form_generator->text_area('Remarks', 'remarks', $default_remarks, '', 'onkeyup="getCannedText(this)"');

        $form_generator->button_submit_sketch($pid, '2');
        $form_generator->date_created($default_create_date, $default_create_user, $default_last_update, $default_last_update_user);
        $form_generator->form_close();
    ?>
    </form>
</div>
</div>
</article>
</body>
</html>