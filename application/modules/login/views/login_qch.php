<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>HHIMS - Hospital Health Information Management System</title>
    <style type="text/css">
        fieldset {
            border: 1px solid #999;
            padding: 1em;
            font: 80%/1 sans-serif;

            border-radius: 8px;
            box-shadow: 0 0 10px #999;
            background: #fff;
        }

        legend {
            padding: 0.2em 0.5em;
            border: 1px solid #999;
            box-shadow: 0 0 10px #999;
            color: green;
            font-size: 90%;
            text-align: left;
            background: #fff;
        }

        label {
            float: left;
            width: 25%;
            margin-right: 0.5em;
            padding-top: 0.2em;
            text-align: right;
            font-weight: bold;
        }

        input[type="text"] {
            display: block;
            margin: 0;
            font-family: sans-serif;
            font-size: 12px;
            appearance: none;
            box-shadow: none;
            border-radius: 2px;
            background-repeat: repeat-x;
            border: 1px solid #0cf;
            color: #333333;
            padding: 5px;
            margin-right: 4px;
            margin-bottom: 8px;

        }

        input[type="password"] {
            display: block;
            margin: 0;
            font-family: sans-serif;
            font-size: 12px;
            appearance: none;
            box-shadow: none;
            border-radius: 2px;
            background-repeat: repeat-x;
            border: 1px solid #0cf;
            color: #333333;
            padding: 5px;
            margin-right: 4px;
            margin-bottom: 8px;

        }

        input:focus {
            outline: none;
            border: 1px solid #093;
        }

        .btnOK {
            background-color: #03adad;
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            border: 1px solid #03adad;
            display: inline-block;
            cursor: pointer;
            color: #ffffff;
            font-family: Arial;
            font-size: 17px;
            padding: 5px 30px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #2f6627;
        }

        .btnOK:hover {
            background-color: #5cbf2a;
            border: 1px solid #5cbf2a;
        }

        .btnOK:active {
            position: relative;
            top: 1px;
        }

        .btnDng {
            background-color: #666;
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            border: 1px solid #666;
            display: inline-block;
            cursor: pointer;
            color: #ffffff;
            font-family: Arial;
            font-size: 17px;
            padding: 5px 30px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #2f6627;
        }

        .btnDng:hover {
            background-color: #f30;
            border: 1px solid #f30;
        }

        label {
            vertical-align: middle;
        }
    </style>


</head>

<body bgcolor="#66ccff">
<p>&nbsp; </p>

<p>&nbsp; </p>
<table width="550" border="0" align="center">
    <tr>
        <td>&nbsp;
            <form action="<?php echo base_url(); ?>index.php/login/auth" method="post">
                <?php
                if ($this->input->get('NEXT')) {
                    echo form_hidden("NEXT", $this->input->get('NEXT'));
                }

                ?>
                <fieldset>

                    <table width="550" border="0" align="center">
                        <tr>
                            <td colspan="3" align="center"><img src="<?php echo base_url('images/hhims1.png'); ?>" width="450" height="85"/></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center">

                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">

                                <fieldset>
                                    <legend>User Login</legend>

                                    <table width="75%" border="0" align="center">
                                        <tr>
                                            <td height="32" align="center" valign="middle"><img
                                                    src="<?php echo base_url(); ?>images/patient_registration.png" width="75" height="75"/></td>
                                            <td align="center"><img src="<?php echo base_url(); ?>images/emergence.png" width="75"
                                                                    height="75"/><br/></td>
                                            <td align="center"><img src="<?php echo base_url(); ?>images/opd_referals.png" width="75"
                                                                    height="75"/><br/></td>
                                            <td align="center"><img src="<?php echo base_url(); ?>images/wards.png" width="75" height="75"/><br/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="middle">New Registration</td>
                                            <td align="center">Emergency</td>
                                            <td align="center">OPD Refereals</td>
                                            <td align="center">Wards</td>
                                        </tr>
                                    </table>

                                    <p><label for="name">Username:</label>
                                        <input type="text" size="40" class="box" id="myusername" class="uname"
                                               name="username" type="text" value="<?php echo set_value('username') ?>" tabindex="1" lang="en"/>
                                    </p>

                                    <p>
                                        <label for="mail">Password:</label>
                                        <input type="password" size="40" class="box" id="mypassword" class="password"
                                               name="password" value="" tabindex="2" autocomplete="off" lang="en"/>
                                    </p>

<!--                                    <p align="center">-->
<!--                                        <input type="radio" name="department" value="1" checked="checked"/>Emergency-->
<!--                                        <input type="radio" name="department" value="2" />OPD Refereals-->
<!--                                        <input type="radio" name="department" value="3" /> Wards-->
<!--                                    </p>-->

                                    <?php echo validation_errors(); ?>

                                    <p align="center">
                                        <input type="submit" id="login" value="Login" class="btnOK"/>
                                        &nbsp; &nbsp; <input type="reset" name="reset" id="reset" size="Cancel"
                                                             class="btnDng"/>
                                    </p>
                                </fieldset>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </td>
    </tr>
    <tr>
        <td align="center">&copy;</td>
    </tr>
</table>
</body>
</html>
