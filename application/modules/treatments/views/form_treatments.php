<div class='content' xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">System User</div>

            <?php
            $form_generator = new MY_Form('Visit_type');
            $form_generator->form_open_current_url();
            $form_generator->input('*Treatment name', 'treatment', $default_treatment, 'Treatment name');
            $treatment_type_option = array(
                'OPD' => 'OPD',
                'Admission' => 'Admission',
            );
            $form_generator->dropdown('*Treatment type', 'treatment_type', $treatment_type_option, $default_treatment_type);
            $form_generator->text_area('Remarks', 'remarks', $default_remarks, 'Any remarks (canned text enables)');
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

