
<html>
<head>
    <title>Change Password</title>
</head>
<body style='background:#e0edfe;' cz-shortcut-listen="true">
<form method='POST' action='<?php echo base_url() ?>index.php/user/change_password/<?php echo $uid; ?>'>
    <table border=0>
        <tr>
            <td >Old password:</td>
            <td >
                <input type='password' class='input' id='oldp' name='oldp' value='' >
                <input type='hidden' class='input' id='uid' name='uid' value='<?php echo $uid; ?>'>
            </td>
        </tr>
        <tr>
            <td >New password:</td>
            <td ><input type='password' class='input' id='newp1' name='newp1'></td>
        </tr>
        <tr>
            <td >New password again:</td>
            <td ><input type='password' class='input' id='newp2' name='newp2'></td>
        </tr>
        <tr>
            <td ></td>
            <td ><input type='submit' class='input' id='sbtn' name='sbtn' value='Change'>
                <input type='submit' class='input' id='cbtn' value='Close' onclick=self.window.close()>
            </td>
        </tr>
    </table>
</form>
</body>
</html>



<!--<div class="container-fluid">-->
<!--    <div class="row">-->
<!--        <div class="col-md-8 col-md-offset-2">-->
<!--            --><?php
//
//            if (isset($_REQUEST['password_type']) && ($_REQUEST['password_type'] == 2)) {
//                $form_name = "Order";
//                echo '<input type="hidden" value=$_REQUEST["password_type"] name="password_type">';
//            } else {
//                $form_name = "User";
//            }
//            $form_generator = new MY_Form($form_name . ' Password Management');
//            $form_generator->form_open_current_url();
//            if (isset($id) && ($id > 0))
//
//                $form_generator->input('*' . $this->lang->line('form_label_username'), 'username', $default_username, 'User name', 'disabled');
//            $form_generator->password('*' . $this->lang->line('form_label_password'), 'password', '', 'Your Current user Password');
//            $form_generator->password('*New Password' . $this->lang->line('form_label_new_password'), 'new_password', '', 'New Password');
//            $form_generator->password('Confirmation', 'password_check', '', 'New Password Confirmation');
//
//
//            ?>
<!--            --><?php
//            $form_generator->button_submit_reset($id);
//            $form_generator->form_close();
//            ?>
<!--        </div>-->
<!--    </div>-->
