<?php
//if ($this->session->flashdata('msg')) {
//    echo '<div class="row">';
//    echo '<div class="col-lg-4">';
//    echo '</div>';
//    echo '<div class="col-lg-4">';
//    echo '</div>';
//    echo '<div class="col-lg-4">';
//    echo '<div class="alert alert-warning alert-dismissable" id="top_message" style="position:absolute;z-index:999999;">';
//    echo '<button type="button" class="close" data-dismiss="alert">×</button>';
//    echo $this->session->flashdata('msg');
//    echo '</div>';
//    echo '</div>';
//    echo '</div>';
//}
//?>
<!---->
<!--<div class="page-header">-->
<!--    <div class="logo">-->
<!--        <img src="--><?php //echo base_url('images/logo_moz.png') ?><!--">-->
<!---->
<!--        <div class="pull-right" style="height: 61px; padding-top: 10px;">-->
<!--            <span class="pull-right" style="color: #999">--><?php //echo date('Y-m-d'); ?>
<!--                <span class="label label-danger">--><?php //echo $this->session->userdata('department'); ?><!-- Department</span></span><br>-->
<!--            <span-->
<!--                style="color: #999">Hello <b>--><?php //echo $this->session->userdata('title') . ' ' . $this->session->userdata('name') . ' ' . $this->session->userdata('other_name'); ?><!--</b></span>-->
<!--            <span class="label label-primary">--><?php //echo $this->session->userdata('user_group_name'); ?><!--</span>-->
<!--        </div>-->
<!--    </div>-->
<!--    <nav class="navbar navbar-default">-->
<!--        <div class="container-fluid">-->
<!--            <div class="row">-->
<!--                <ul class="nav navbar-nav">-->
<!--                    --><?php
//                    foreach ($top_menu as $menu) {
//                        if (strtolower($menu['Link']) === strtolower($active_menu_link)) {
//                            echo '<li class="active">';
//                        } else {
//                            echo '<li>';
//                        }
//                        echo '<a class="top-menu" href="' . site_url() . '/' . $menu['Link'] . '">' . $this->lang->line($menu['Name']) . '</a>';
//                        echo '</li>';
//                    }
//                    ?>
<!---->
<!--                </ul>-->
<!--                <ul class="nav navbar-nav navbar-right pull-right">-->
<!--                    <li><a-->
<!--                            href="--><?php //echo site_url('hhims') ?><!--">Home</a>-->
<!--                    </li>-->
<!--                    --><?php
//                    if ('user_config' === strtolower($active_menu_link)) {
//                        echo '<li class="active">';
//                    } else {
//                        echo '<li>';
//                    } ?>
<!--                    <a href="--><?php //echo site_url('user_config') ?><!--">--><?php //echo $this->lang->line('Configure'); ?><!--</a>-->
<!--                    </li>-->
<!--                    <li class="pull-right"><a-->
<!--                            href="--><?php //echo site_url('login/logout') ?><!--">--><?php //echo $this->lang->line('Logout'); ?><!--</a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </nav>-->
<!--</div>-->

<div id='header'>
    <table border=0 width=100% cellspacing=0 style='margin-left:5px'>
        <tr>
            <td class='user' width=100px><span class='mds'><img src='<?php echo base_url() ?>images/hhims1.png' /></span></td>
            <td class='user' >
                <table border=0 width=100% cellspacing=0 >
                    <tr>
                        <td >
                            <div class='menu'>
                                <input type='button' class='menuBtn'  value='Home' onmousedown=execute(String(''),this)>
                                <input type='button' class='menuBtn'  value='Preference' onmousedown=execute(String(''),this)>
                                <input type='button' class='menuBtn'  value='New Patient' onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient/create'">
                                <input type='button' class='menuBtn'  value='Search' onmousedown=execute(String(''),this)>
                                <input type='button' class='menuBtn'  value='Pharmacy' onmousedown=execute(String(''),this)>
                                <input type='button' class='menuBtn'  value='Laboratory' onmousedown=execute(String(''),this)>
                                <input type='button' class='menuBtn'  value='Procedure Room' onmousedown=execute(String(''),this)>
                                <input type='button' class='menuBtn'  value='Wards' onmousedown=execute(String(''),this)>
                                <input type='button' class='menuBtn'  value='Reports' onmousedown=execute(String(''),this)>
                                <input type='button' class='menuBtn'  value='Notifications' onmousedown=execute(String(''),this)>
                                <input type='button' class='menuBtn'  value='Messages' onmousedown=execute(String(''),this)>
                                <input type='button' class='menuBtn'  value='Log out' onmousedown=execute(String(''),this)>
                                <img src='<?php echo base_url() ?>images/ecg.gif' width=30 height=25  valign=bottom />
                            </div>
                        </td >
                    </tr>
                </table>
            </td>
            <td class='user' valign=top align=right >
			<span style='padding-right:10px;'>
				&nbsp;&nbsp;&nbsp;
				<img style='cursor:pointer;' title='Change language' src='<?php echo base_url() ?>images/language.png' width=20 height=20 valign=bottom
                     onclick='changeLanguage(this.value,".$mdsfoss->Uid.")' >
				<img style='cursor:pointer;' title='Help' src='<?php echo base_url() ?>images/help1.png' width=20 height=20 valign=bottom onclick=openLocation('help/index.php') >
				<img style='cursor:pointer;' title='Refresh' src='<?php echo base_url() ?>images/refresh.png' width=20 height=20 valign=bottom onclick=refreshContent(); >
				<img style='cursor:pointer;' title='About MDSFoss' src='<?php echo base_url() ?>images/info.png' width=20 height=20 valign=bottom onclick=openLocation('about/index.php') >
				<img style='cursor:pointer;' title='Send suggestions / opinions / bugs' src='<?php echo base_url() ?>images/mail.png' width=20 height=20 valign=bottom
                     onclick='loadMailer(\"".$mdsfoss->FullName."\",\"".$mdsfoss->UserGroup."\",\"".$mdsfoss->Hospital."\")' >
			</span>
                <div class="pull-right" style="height: 100%; padding-top: 10px; padding-right:10px; font-size:14px;">
                    <span class="pull-right" style="color: green">1991-01-31</span><br>
                    <span style="color: green">Hello <b>Mr.Trung</b></span>
                    <span class="label-primary" style=" background-color: #428bca; display: inline; padding: .2em .6em .3em; font-size: 75%; font-weight: bold;
													line-height: 1; color: #fff; text-align: center; white-space: nowrap; vertical-align: baseline;
													border-radius: .25em;">Admin</span>
                </div>
            </td>
        </tr>
    </table>
</div>

