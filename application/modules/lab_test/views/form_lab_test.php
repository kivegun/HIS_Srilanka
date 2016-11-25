<div class='content' xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">LabTest edit/new</div>

            <?php
            $form_generator = new MY_Form('LabTest edit/new');
            $form_generator->form_open_current_url();
            $form_generator->dropdown('*Department', 'department', $dropdown_department, $default_department);
            $form_generator->dropdown('*Group Name', 'group_name', $dropdown_group_name, $default_group_name);
            $form_generator->input('*Name', 'name', $default_name, 'Test name');
            $form_generator->text_area('RefValue', 'refvalue', $default_refvalue, 'Reference value');
            $form_generator->input('Default Value', 'default_value', $default_value, 'Default value');
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

