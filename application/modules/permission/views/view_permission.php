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
    <div id="mdsHead" class="mdshead">System User</div>

<?php
        $form_generator = new MY_Form('Permission Settings');
        $form_generator->form_open_current_url();
?>

        <div><input type= 'hidden' class='input'  id='".$id."'   name='".$id."' value='".$value."'>
            <table  class='input' style='font-size:14px;background:#FFFFFF;width:400;' cellpadding=4px cellspacing=0>
                <tr class='lab_head_cont' style='font-weight:bold;'><td>Module</td><td>Print</td><td>View</td><td>Edit</td><td>Create</td></tr>

<?php
        $form_generator->input('*User Group', 'user_group', $default_user_group, 'UserGroup');

        $table = array();
        $table = array(
        array("table"=>"patient","display"=>"Patient"),
        array("table"=>"patient_alergy","display"=>"Patient alergy"),
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
        array("table"=>"attach","display"=>"Attch file")
        );
        for ($i=0; $i < count($table); $i++){
        if ($table[$i]["table"] =="-") {
        echo '<tr class="lab_item"><td  colspan="5"><hr></td><tr>"';
            }
            else {
            echo '<tr class="lab_item"><td>'.$table[$i]["display"].'</td>';
            echo '<td><input type="checkbox" mod="Print" name="permission[' . $i . '][1]" value="'.$table[$i]["table"].'" '.checkAccess($table[$i]["table"].'_Print',$value).' onclick=updatePermission("'.$id.'",this) ></td>';
            echo '<td><input type="checkbox" mod="View" name="permission[' . $i . '][2]" value="'.$table[$i]["table"].'" '.checkAccess($table[$i]["table"].'_View',$value).' onclick=updatePermission("'.$id.'",this) ></td>';
            echo '<td><input type="checkbox" mod="Edit" name="permission[' . $i . '][3]" value="'.$table[$i]["table"].'" '.checkAccess($table[$i]["table"].'_Edit',$value).' onclick=updatePermission("'.$id.'",this) ></td>';
            echo '<td><input type="checkbox" mod="New" name="permission[' . $i . '][4]" value="'.$table[$i]["table"].'" '.checkAccess($table[$i]["table"].'_New',$value).' onclick=updatePermission("'.$id.'",this) ></td>';
            }
        }
        echo '</table>';
        echo '</div>';
        $form_generator->date_created($default_create_date, $default_create_user, $default_last_update, $default_last_update_user);

        private function checkAccess($mod,$value){
            $obj = json_decode($value);
            if ($obj->{$mod}) {
                return "checked";
            }
            else {
                return "";
        }
}

}
?>
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

