<div class='content' xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">Edit ICD</div>

            <?php
            $form_generator = new MY_Form('ICD10');
            $form_generator->form_open_current_url();
            $form_generator->input('*Code', 'code', $default_code, 'ICD Code');
            $form_generator->text_area('*Name', 'name', $default_name, 'Name');
            $form_generator->dropdown('*is Notifiable', 'isnotify', array('1' => 'Yes', '0' => 'No'), $default_isnotify);
            $form_generator->text_area('Remarks', 'remarks', $default_remarks, 'Any Remarks');
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

