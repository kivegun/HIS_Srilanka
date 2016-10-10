<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php
            $form_generator = new MY_Form('Top Menu');
            $form_generator->form_open_current_url();
            $form_generator->input('*Name', 'name', $default_name, 'Name');
            $form_generator->checkboxes('User Group', 'user_groups', $user_group_options, $selected_group);
            $form_generator->input('Link', 'link', $default_link, 'eg: home.php?page=home');
            $form_generator->input('*Menu Order', 'menu_order', $default_menu_order, 'eg: 1');
            $form_generator->dropdown('Active', 'active', array('1' => 'Yes', '0' => 'No'), $default_active);
            $form_generator->button_submit_reset($id);
            $form_generator->form_close();
            ?>
        </div>
    </div>
</div>