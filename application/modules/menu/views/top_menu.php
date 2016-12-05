<div id='header'>
    <table border=0 width=100% cellspacing=0 style='margin-left:5px'>
        <tr>
            <td class='user' width=100px><span class='mds'><img src='<?php echo base_url() ?>images/hhims1.png' /></span></td>
            <td class='user' >
                <table border=0 width=100% cellspacing=0 >
                    <tr>
                        <td >
                            <div class='menu'>
                                <?php
                                foreach ($top_menu as $menu) {
                                    if (strtolower($menu['Link']) === strtolower($active_menu_link)) {
                                        echo '<input type="button" class="menuBtnSelect"  value="'.$menu["Name"].'" onclick="javascript:location.href=\''.site_url().'/'.$menu['Link'].'\'">';
                                    } else if($menu['Name'] =='Messages' && $inbox>0){
                                        echo '<input type="button" id="BlnkBtn" class="BlnkBtn"  value="'.$menu["Name"].'" onclick="javascript:location.href=\'' . site_url() . '/' . $menu["Link"] . '\'"">';
                                    } else {
                                        echo '<input type="button" class="menuBtn"  value="'.$menu["Name"].'" onclick="javascript:location.href=\'' . site_url() . '/' . $menu["Link"] . '\'">';
                                    }
                                }
                                ?>

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
                    <span class="pull-right" style="color: green"><?php echo date('Y-m-d'); ?></span><br>
                    <span style="color: green">Hello <b><?php echo $this->session->userdata('title') . ' ' . $this->session->userdata('name') . ' ' . $this->session->userdata('other_name'); ?></b></span>
                    <span class="label-primary" style=" background-color: #428bca; display: inline; padding: .2em .6em .3em; font-size: 75%; font-weight: bold;
													line-height: 1; color: #fff; text-align: center; white-space: nowrap; vertical-align: baseline;
													border-radius: .25em;"><?php echo $this->session->userdata('user_group_name'); ?></span>
                </div>
            </td>
        </tr>
    </table>
</div>
<!--
<input type='button' class='menuBtn'  value='Home' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference'">
<input type='button' class='menuBtn'  value='Preference' onclick="javascript:location.href='<?php echo base_url() ?>index.php/preference'">
<input type='button' class='menuBtn'  value='New Patient' onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient/create'">
<input type='button' class='menuBtn'  value='Search' onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient/search'">
<input type='button' class='menuBtn'  value='Pharmacy' onclick="javascript:location.href='<?php echo base_url() ?>index.php/patient_prescription'">
<input type='button' class='menuBtn'  value='Laboratory' onmousedown=execute(String(''),this)>
<input type='button' class='menuBtn'  value='Procedure Room' onmousedown=execute(String(''),this)>
<input type='button' class='menuBtn'  value='Wards' onclick="javascript:location.href='<?php echo base_url() ?>index.php/wards/search'">
<input type='button' class='menuBtn'  value='Reports' onmousedown=execute(String(''),this)>
<input type='button' class='menuBtn'  value='Notifications' onmousedown=execute(String(''),this)>
<input type='button' class='menuBtn'  value='Messages' onmousedown=execute(String(''),this)>
<input type='button' class='menuBtn'  value='Log out' onclick="javascript:location.href='<?php echo base_url() ?>index.php/login/logout'">
<img src='<?php echo base_url() ?>images/ecg.gif' width=30 height=25  valign=bottom />
-->
<!--while($row = $mdsDB->mysqlFetchArray($result))  {-->
<!---->
<!--if ($row["Link"] == "home.php?page=".$mdsfoss->Page) {-->
<!--$menuItems .="<input type='button' class='menuBtnSelect'  value='".getPrompt($row["Name"])."' onmousedown=execute(String('".$row[Link]."'),this)>";-->
<!--}-->
<!--else if($row["Name"] =='Messages' && $inbox>0){-->
<!---->
<!--$menuItems .="<input type='button' id='BlnkBtn' class='BlnkBtn'  value='".getPrompt($row["Name"])."' onmousedown=execute(String('".$row[Link]."'),this)>";-->
<!---->
<!--}-->
<!--else {-->
<!--$menuItems .="<input type='button' class='menuBtn'  value='".getPrompt($row["Name"])."' onmousedown=execute(String('".$row[Link]."'),this)>";-->
<!---->
<!--}-->
<!--}-->

