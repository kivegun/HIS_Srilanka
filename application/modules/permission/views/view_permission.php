<?php
//function check_permission($all_user_group_have_permission, $permission_id, $ugid, $type)
//{
//    foreach ($all_user_group_have_permission as $user_group_have_permission) {
//        if ($user_group_have_permission->UGID == $ugid && $user_group_have_permission->PERID == $permission_id
//            && $user_group_have_permission->Type == $type && $user_group_have_permission->Active == True
//        ) {
//            return 'checked="checked"';
//        }
//    }
//    return '';
//}
//
//?>
<div class='content' xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">Permission Settings</div>
<?php
    $this->load->helper('form');
    $form_generator = new MY_Form('Permission Settings');
    $form_generator->form_open_current_url();
    $form_generator->input('*User Group', 'user_group', $default_user_group, 'UserGroup', array ('readonly' => NULL));
?>
<!--<div id="fieldCont" class="fieldCont" style="visibility:hidden;">-->
<!--    <div class="caption">&nbsp; </div>-->
<!--    <input name="_" id="_" type="text" class="input" disabled="" readonly="" value="1" style="background:#e0edff;">-->
<!--</div>-->
<!--<div id="fcUserGroup" class="fieldCont">-->
<!--    <div class="caption">*User Group</div>-->
<!--    <input name="UserGroup" id="UserGroup" pos="0" type="text" class="input" readonly="" style="font-weight:bold;" value="Programmer">-->
<!--    <lable id="hUserGroup" class="fieldHelp" style="visibility: hidden;">User Group</lable>-->
<!--</div>-->
<div id="fcUserAccess" class="fieldCont">
    <div class="caption">*Permission</div>
    <?php
        echo '<div><input type= "hidden" class="input"  id="UserAccess"   name="UserAccess" value=\''.$default_permission.'\'>';
        ?>
            <table  class='input' style='font-size:14px;background:#FFFFFF;width:400;' cellpadding=4px cellspacing=0>
                <tr class='lab_head_cont' style='font-weight:bold;'><td>Module</td><td>Print</td><td>View</td><td>Edit</td><td>Create</td></tr>

<?php
//        $form_generator->input('*User Group', 'user_group', $default_user_group, 'UserGroup');

        $table = array();
        $table = array(
        array("table"=>"patient","display"=>"Patient"),
        array("table"=>"patient_alergy","display"=>"Patient allergy"),
        array("table"=>"patient_history","display"=>"Patient history"),
        array("table"=>"patient_exam","display"=>"Patient exam"),
        array("table"=>"opd_visit","display"=>"Visit"),
        array("table"=>"opd_treatment","display"=>"OPD Treatment"),
        array("table"=>"admission","display"=>"Admission"),
        array("table"=>"admission_diagnosis","display"=>"Admission diagnosis"),
        array("table"=>"admission_procedures","display"=>"Admission surgical procedure"),
        array("table"=>"admission_notes","display"=>"Admission notes"),
        array("table"=>"appointment","display"=>"Appointments"),
        array("table"=>"-","display"=>"-"),
        array("table"=>"lab_order","display"=>"Lab Order"),
        array("table"=>"opd_presciption","display"=>"Prescription Order"),
        array("table"=>"drugs","display"=>"Drugs"),
        array("table"=>"lab_tests","display"=>"Lab Tests"),
        array("table"=>"lab_test_group","display"=>"Lab Tests Groups"),
        array("table"=>"lab_test_department","display"=>"Lab Department"),
        array("table"=>"canned_text","display"=>"Canned Text"),
        array("table"=>"notification","display"=>"Notification"),
        array("table"=>"ward","display"=>"Wards"),
        array("table"=>"-","display"=>"-"),
        array("table"=>"systems_table","display"=>"Systems table"),
        array("table"=>"attach","display"=>"Attach file")
        );
        $id = 'UserAccess';
        for ($i=0; $i < count($table); $i++){
        if ($table[$i]["table"] =="-") {
        echo '<tr class="lab_item"><td  colspan="5"><hr></td><tr>';
            }
            else {
            echo '<tr class="lab_item"><td>'.$table[$i]["display"].'</td>';
            echo '<td><input type="checkbox" mod="Print" name="permission[' . $i . '][1]" value="'.$table[$i]["table"].'" '.checkAccess($table[$i]["table"].'_Print',$default_permission).' onclick=updatePermission("'.$id.'",this) ></td>';
            echo '<td><input type="checkbox" mod="View" name="permission[' . $i . '][2]" value="'.$table[$i]["table"].'" '.checkAccess($table[$i]["table"].'_View',$default_permission).' onclick=updatePermission("'.$id.'",this) ></td>';
            echo '<td><input type="checkbox" mod="Edit" name="permission[' . $i . '][3]" value="'.$table[$i]["table"].'" '.checkAccess($table[$i]["table"].'_Edit',$default_permission).' onclick=updatePermission("'.$id.'",this) ></td>';
            echo '<td><input type="checkbox" mod="New" name="permission[' . $i . '][4]" value="'.$table[$i]["table"].'" '.checkAccess($table[$i]["table"].'_New',$default_permission).' onclick=updatePermission("'.$id.'",this) ></td>';
            }
        }
        echo '</table>';
        echo '</div>';
        echo '<lable id="hUserAccess" class="fieldHelp" style="visibility: hidden;">Modules and permission</lable>';
        echo '</div>';

        $form_generator->text_area('Remarks', 'remarks', $default_remarks, 'Remarks');
        $form_generator->date_created($default_create_date, $default_create_user, $default_last_update, $default_last_update_user);
        $form_generator->button_submit_reset();
        $form_generator->form_close();

        function checkAccess($mod, $default_permission){
            $obj = json_decode($default_permission);
            if ($obj->{$mod}) {
                return "checked";
            }
            else {
                return "";
        }
}

?>
<!--                <button type="button" class="btn btn-success" name="ad" id="ad">Get data</button>-->
                </form>
        </div>
    <?php echo Modules::run('leftmenu/preference'); //runs the available left menu for preferance ?>
    <div id="prefCont"></div>
</div>
</article>
</body>
</html>
<!--    </table>-->
<!--</div>-->
<!---->
<!--<div class="container-fluid">-->
<!--    <div class="row">-->
<!--        <div class="col-md-2">-->
<!--            --><?php //echo Modules::run('leftmenu/preference'); //runs the available left menu for preferance ?>
<!--        </div>-->
<!--        <div class="col-md-10 ">-->
<!--            --><?php
//            $form_generator = new MY_Form($user_group->Name.'`s Permission');
//            $form_generator->form_open_current_url();
//            foreach ($all_permission as $permission) {
//                echo '<div class="form-group">';
//                echo '<div class="col-sm-4">';
//                echo '<label style="margin-top: 6px;">' . $permission->Name . '</label>';
//                echo '</div>';
//                echo '<div class="col-sm-6">';
//                echo '<label class="checkbox-inline"><input type="checkbox" style="margin-top: 2px;" name="permission[' . $permission->PERID . '][1]" ' . check_permission($all_user_group_have_permission, $permission->PERID, $ugid, 'view') . '>View</label>';
//                echo '<label class="checkbox-inline"><input type="checkbox" style="margin-top: 2px;" name="permission[' . $permission->PERID . '][2]" ' . check_permission($all_user_group_have_permission, $permission->PERID, $ugid, 'create') . '>Create</label>';
//                echo '<label class="checkbox-inline"><input type="checkbox" style="margin-top: 2px;" name="permission[' . $permission->PERID . '][3]" ' . check_permission($all_user_group_have_permission, $permission->PERID, $ugid, 'edit') . '>Edit</label>';
//                echo '<label class="checkbox-inline"><input type="checkbox" style="margin-top: 2px;" name="permission[' . $permission->PERID . '][4]" ' . check_permission($all_user_group_have_permission, $permission->PERID, $ugid, 'print') . '>Print</label>';
//                echo '</div>';
//                echo '</div>';
//            }
//            $form_generator->button_submit_reset();
//            $form_generator->form_close();
//            ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!---->
<?php
//echo Modules::run('template/footer');
//?>

