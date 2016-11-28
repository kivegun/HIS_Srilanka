<div class="content">
    <div id="mdsHead" class="mdshead">Add / Edit Allergy</div>
    <?php echo Modules::run('patient/banner', $pid);?>

            <?php
            $form_generator = new MY_Form('Patient Allergy');
            $form_generator->form_open_current_url();

            $form_generator->input('*Allergy', 'name', $default_name, 'Name of allergy');
            $form_generator->dropdown('Status', 'status', array('Past' => 'Past', 'Current' => 'Current'), $default_status);
            $form_generator->text_area('Remarks', 'remarks', $default_remarks, 'Any Remarks');
            $form_generator->dropdown('Active', 'active', array('1' => 'Yes', '0' => 'No'), $default_active);

            $form_generator->button_submit_reset($id);
            $form_generator->date_created($default_create_date, $default_create_user, $default_last_update, $default_last_update_user);
            $form_generator->form_close();
            ?>
        </form>
    </div>
</div>
</article>
</body>
</html>