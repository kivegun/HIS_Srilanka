<div class='content' xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">Add/Edit Ward</div>

            <?php
            $form_generator = new MY_Form('Wards');
            $form_generator->form_open_current_url();
            $form_generator->input('*Ward name', 'name', $default_name, 'Name of the ward');
            $form_generator->input('Type of the ward', 'type', $default_type, 'Name');
            $form_generator->input('Telephone', 'telephone', $default_telephone, 'Telephone number');
            $form_generator->input('*Number of beds', 'bed_count', $default_bed_count, 'Number of beds in the ward');
            $form_generator->text_area('Remarks', 'remarks', $default_remarks, 'Any Remarks');
            $form_generator->dropdown('Active', 'active', array('1' => 'Yes', '0' => 'No'), $default_active);
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

