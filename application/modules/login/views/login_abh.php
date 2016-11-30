<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
/*
--------------------------------------------------------------------------------
HHIMS - Hospital Health Information Management System
Copyright (c) 2011 Information and Communication Technology Agency of Sri Lanka
http: www.hhims.org
----------------------------------------------------------------------------------
This program is free software: you can redistribute it and/or modify it under the
terms of the GNU Affero General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License along
with this program. If not, see http://www.gnu.org/licenses or write to:
Free Software  HHIMS
C/- Lunar Technologies (PVT) Ltd,
15B Fullerton Estate II,
Gamagoda, Kalutara, Sri Lanka
----------------------------------------------------------------------------------
Author: Mr. Thurairajasingam Senthilruban   TSRuban[AT]mdsfoss.org
Consultant: Dr. Denham Pole                 DrPole[AT]gmail.com
URL: http: www.hhims.org
----------------------------------------------------------------------------------
*/
?>
<html>
<head>
    <title>e-Health Information System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/login.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>css/login1.css" />
    <link rel="icon" type="image/ico" href="<?php echo base_url() ?>images/govt_logo.png">
    <link rel="shortcut icon" href="<?php echo base_url() ?>images/govt_logo.png">

    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.cookie.js"></script>
<!--    --><?php
//    include 'include/class/MDSLicense.php';
//    $license = new MDSLicense();
//    $license->readKey("mdsfoss.key");
//    if ($_GET['err']) {
//        $err = $_GET['err'];
//    }
//    if ($err>0){
//        echo " <script language='javascript'> \n" ;
//        echo "jQuery().ready(function(){ \n";
//        echo " $('#MDSError').html('Username or Password incorrect!'); \n";
//        echo "}); \n";
//        echo " </script>\n";
//    }
//    ?>
    <script language='javascript'>
        jQuery().ready(function(){
            $('#myusername').focus();
        });
    </script>
</head>
<body >

<div id="paneOuter">
    <div class="pane">

        <div class="left">
            <span class="img2"><img src="<?php echo base_url('images/logo11.png'); ?>" /></span>
            <span class="img1"><img src="<?php echo base_url('images/clinicicon.png'); ?>" /></span>

        </div>
        <div class="right">
            <form action="<?php echo base_url(); ?>index.php/login/auth" method="post">
                <?php
                if ($this->input->get('NEXT')) {
                    echo form_hidden("NEXT", $this->input->get('NEXT'));
                }
                ?>

                <table class="login" cellpadding="0" cellspacing="0">
                    <thead>
                    <th colspan="4" style="font-weight:bold;" >User Login</th>
                    </thead>
                    <tr style="height:10px;"></tr>
                    <tr>
                        <td style="width:5%"></td>
                        <td style="width:25%; font-weight:bold;" align="left">User Name</td>
                        <td><input id="myusername" class="uname" name="username" type="text"  value="" tabindex="1" lang="en"></td>

                        <td style="width:10%"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="font-weight:bold;"align="left">Password</td>
                        <td><input id="mypassword" class="password" name="password" type="password" value="" tabindex="2" autocomplete="off" lang="en"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2"><button id="login_submit" type="submit">Login</button></td>
                        <td></td>
                    </tr>
                    <tr style="height:10px;"></tr>
                </table>


            </form>
        </div>
<!--        <p align="center" width="595">-->
<!--            <input type="radio" name="department" value="1" checked="checked"/> Clinics-->
<!--            <input type="radio" name="department" value="2" /> OPD-->
<!--            <input type="radio" name="department" value="3" /> PCU-->
<!--        </p>-->
    </div>
</div>
</body>
</html>
