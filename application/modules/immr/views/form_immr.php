<div class='content' xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">Edit IMMR</div>

            <?php
            $form_generator = new MY_Form('IMMR');
            $form_generator->form_open_current_url();
            $form_generator->input('**Code', 'code', $default_code, 'IMMR Code');
            $form_generator->text_area('*Name', 'name', $default_name, 'Name');
            $form_generator->text_area('*Category', 'category', $default_category, 'Category');
            $form_generator->text_area('ICDCODE', 'icdcode', $default_icdcode, 'ICDCODE');
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

