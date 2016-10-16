<div class='content' xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">Drug dosage edit/new</div>

            <?php
            $form_generator = new MY_Form('Drugs_dosage');
            $form_generator->form_open_current_url();
            $form_generator->input('*Dosage', 'dosage', $default_dosage, 'Dosage');
            $type_option = array(
                'Liquid' => 'Liquid',
                'Tablets' => 'Tablets',
                'Multidose' => 'Multidose',
                'Other' => 'Other'
            );
            $form_generator->dropdown('*Type', 'type', $type_option, $default_type);
            $form_generator->input('Factor', 'factor', $default_factor, 'Multiply factor');
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

