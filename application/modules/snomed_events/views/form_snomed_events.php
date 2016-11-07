<div class='content' xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">SNOMED Event</div>

            <?php
            $form_generator = new MY_Form('SNOMED Events');
            $form_generator->form_open_current_url();
            $form_generator->input('*Code', 'code', $default_code, 'Code');
            $form_generator->text_area('*Term', 'term', $default_term, 'Term');
            $form_generator->dropdown('*Status', 'status', array('0' => 'No', '1' => 'Yes'), $default_status);
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

