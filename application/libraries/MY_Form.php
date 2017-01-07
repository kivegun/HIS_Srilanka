<?php

/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 12-Oct-15
 * Time: 2:26 PM
 */
class MY_Form extends FormController
{
    var $_name;
    var $type;
    private $FrmObj = NULL;
    public $Fields = array();

    public function __construct($name = 'Form')
    {
        $this->_name = $name;
        $this->load->model('mpersistent');
    }

    /**
     * Submit form to current URL including GET parameters
     */
    public function form_open_current_url($style = 'left:100;', $class = 'formcont')
    {
        echo '<div id="MDSError" class="mdserror" style="display: none;" onload="error();">'.validation_errors().'</div>';
        echo '<script type="text/javascript">';
        echo 'function error(){';
        echo 'var a = document.getElementById("MDSError");';
        echo 'a.style.display = "block";';
//        echo '    a.style.display="block" }';
//        echo 'else {';
//        echo '    a.style.display="none" }';
        echo '}';
        echo '</script>';
        echo '<div id="formCont" class="'.$class.'" style="'.$style.'">';
        echo '<form id="frm" method="post" action="">';

    }

    /**
     * Close a form
     */
    public function form_close()
    {
        //echo '</fieldset>';
        echo form_close();
        echo '</div>';
    }

    public function input($label = '', $name = '', $default_value = '', $place_holder = '', $extra = '')
    {
        $data_label = array(
            'class' => 'caption',
        );

        $data_text = array(
            'class' => 'input',
            'name' => $name,
            'id' => $name,
            'placeholder' => $place_holder
        );
        echo '<div class="fieldCont">';
        echo form_label($label, $name, $data_label);
        echo form_input($data_text, set_value($name, $default_value), $extra);
        echo form_error($name);
        echo '</div>';
    }

    public function input_date($label = '', $name = '', $default_value = '', $place_holder = '')
    {
        $js = 'onmousedown="onmousedown=$(\'#' . $name . '\').datepicker({changeMonth: true,changeYear: true,yearRange: \'c-40:c+40\',dateFormat: \'yy-mm-dd\',maxDate: \'+0D\'});"';
        $this->input($label, $name, $default_value, $place_holder, $js);
    }

    public function input_inline_checkbox($label = '', $name = '', $default_value = '', $place_holder = '', $checkbox_label, $default_checked)
    {
        $data_label = array(
            'class' => 'col-sm-2 control-label',
        );
        $data_text = array(
            'class' => 'form-control input-sm',
            'name' => $name,
            'id' => $name,
            'placeholder' => $place_holder
        );
        echo '<div class="form-group">';
        echo form_label($label, $name, $data_label);
        echo '<div class="col-sm-10">';
        echo '<div class="input-group">';
        echo form_input($data_text, set_value($name, $default_value));
        echo '<span class="input-group-addon">';
        echo form_hidden($name . '_checkbox', 0);
        echo form_checkbox($name . '_checkbox', 1, set_value($name . '_checkbox', $default_checked), 'id="' . $name . '_checkbox' . '"');

        echo ' ' . $checkbox_label;
        echo '</span>';
        echo '</div>';
        echo form_error($name);
        echo form_error($name . '_checkbox');
        echo '</div>';
        echo '</div>';
        echo '
        <script>
            if ($("#' . $name . '_checkbox' . '").prop("checked")) {
            $(":input[name=\'' . $name . '\']").prop("disabled", true);
        }
        </script>';
    }

    public function hidden_field($name = '', $default_value = '')
    {
        echo form_hidden($name, $default_value);
    }

    public function input_with_default_value_button($label = '', $name = '', $default_value = '', $setting_number = '', $button_click_value = '')
    {
        $data_label = array(
            'class' => 'caption',
        );

        echo '<div class="fieldCont">';
        echo form_label($label, $name, $data_label);
        echo '<input name="'.$name.'" id="'.$name.'" type="number" class="input" '.$setting_number.' value="'.$default_value.'">';
        echo '<img src="'.base_url().'images/thumbup.png" title="click to enter normal value" valign="bottom" style="cursor:pointer;" onclick="getNormal(\''.$name.'\',\''.$button_click_value.'\')">';
        echo form_error($name);
        echo '</div>';
    }

    public function input_number($label = '', $name = '', $default_value = '', $setting_number = '', $placeholder = '')
    {
        $data_label = array(
            'class' => 'caption',
        );

        echo '<div class="fieldCont">';
        echo form_label($label, $name, $data_label);
        echo '<input name="'.$name.'" id="'.$name.'" type="number" class="input" '.$setting_number.' value="'.$default_value.'" placeholder="'.$placeholder.'">';
        echo form_error($name);
        echo '</div>';
    }

    public function textar($default_value = 'images/human_body.jpg')
    {
        $data_label = array(
            'class' => 'caption',
        );

        echo '<div class="fieldCont">';
        echo form_label('Sketch of Injury points','', $data_label);
        echo '    <div class="tools">';
        echo '        <a href="#tools_sketch" data-tool="marker">Marker</a>';
        echo '        <a href="#tools_sketch" data-tool="eraser">Eraser</a>';
        echo '    </div>';
        echo '    <canvas id=\'tools_sketch\' width=\'300\' height=\'300\' style=\'background:no-repeat center center;border:black 1px solid\'></canvas>';
        echo '    <script type=\'text/javascript\'>
                        var sigCanvas = document.getElementById(\'tools_sketch\');
                        var context = sigCanvas.getContext(\'2d\');  
                        var imageObj = new Image();
                            imageObj.src = \''.base_url().$default_value.'\';
                            imageObj.onload = function() {
                            context.drawImage(this, 0, 0,sigCanvas.width,sigCanvas.width);
                            };                    
                            $(function() {
                            $(\'#tools_sketch\').sketch({defaultColor: \'#FF0000\'});
                            });';
        echo '</script>';
        echo '</div>';
    }

    public function input_nic($label = '', $name = '', $default_value = '', $place_holder = '', $extra = '')
    {
        $data_label = array(
            'class' => 'caption',
        );
        $data_text = array(
            'class' => 'input',
            'name' => 'NIC',
            'id' => 'NIC',
            'placeholder' => $place_holder,
            'style' => 'width:200;',
            'pos' => '7',
        );
        echo '<div class="fieldCont">';
        echo form_label($label, $name, $data_label);
        echo form_input($data_text, set_value($name, $default_value), $extra);
        echo form_error($name);
        echo '<img src="'.base_url().'images/search.png" title="Search for this NIC" valign="bottom" style="cursor:pointer;" onclick="checkBeforeSave({data:({NIC:$(\'#NIC\').val(),})});">';
        echo '</div>';
    }

    public function input_bed($label = '', $name = '', $default_value = '', $place_holder = '', $extra = '')
    {
        $data_label = array(
            'class' => 'caption',
        );
        $data_text = array(
            'class' => 'input',
            'name' => $name,
            'id' => $name,
            'placeholder' => $place_holder,
            'style' => 'width:200;',
            'pos' => '2',
        );
        echo '<div class="fieldCont">';
        echo form_label($label, $name, $data_label);
        echo form_input($data_text, set_value($name, $default_value), $extra);
        echo form_error($name);
        echo '<img src="'.base_url().'images/refresh.png" width="20" height="20" valign="middle" style="cursor:pointer" onclick="getBHT(\'BHT\')">';
        echo '</div>';
    }

    public function input_patient_name($label = '', $name = '', $default_value = '', $place_holder = '', $extra = '')
    {
        $data_label = array(
            'class' => 'caption',
        );
        $data_text = array(
            'class' => 'input',
            'name' => $name,
            'id' => $name,
            'placeholder' => $place_holder,
            'style' => 'font-weight:bold;font-size:16;height:25px;width:400px;',
            'pos' => '7',
        );
        echo '<div class="fieldCont">';
        echo form_label($label, $name, $data_label);
        echo form_input($data_text, set_value($name, $default_value), $extra);
        echo form_error($name);
        echo '<script language="javascript">';
        echo '$( document).ready(function() {';
        echo '    $(\'#Full_Name_Registered\').keyup(function(){';
        echo '        ajaxLookUp($(this)) ;';
        echo '    })';
        echo '                  })';
        echo '</script>';
        echo '</div>';
    }

    public function text_area($label = '', $name = '', $default_value = '', $place_holder = '', $extra = '')
    {
        $data_label = array(
            'class' => 'caption',
        );
        $data_text_area = array(
            'class' => 'input',
            'name' => $name,
            'id' => $name,
            'rows' => 3,
            'placeholder' => $place_holder,
            'style' => 'width:450;'
        );
        echo '<div class="fieldCont">';
        echo form_label($label, $name, $data_label);
        echo form_textarea($data_text_area, set_value($name, $default_value), $extra);
        echo form_error($name);
        echo '</div>';
    }

    public function text_area_lookup($label = '', $name = '', $default_value = '', $place_holder = '', $extra = '')
    {
        $data_label = array(
            'class' => 'caption',
        );
        $data_text_area = array(
            'class' => 'input',
            'name' => $name,
            'id' => $name,
            'rows' => 2,
            'placeholder' => $place_holder,
            'style' => 'width:450;',
            'pos' => '2',
            'readonly' => NULL,
            'onfocus' => 'onclick=lookUpICD(\''.$name.'\',\'\',\''.$name.'\',$(\'#SNOMEDmap\').val());'
        );
        echo '<div class="fieldCont">';
        echo form_label($label, $name, $data_label);
        echo form_textarea($data_text_area, set_value($name, $default_value), $extra);
        echo form_error($name);
        echo '<img src="'.base_url().'images/clear.png" title="Clear field" width="15" height="15" valign="top" style="cursor:pointer" onclick="$(\'#'.$name.'\').val(\'\')">';
        echo '<lable id="hICDLink" class="fieldHelp" style="visibility: hidden;">ICD link</lable>';
        echo '<div id="icdDiv" title="ICD lookup"></div>';
    }

    public function text_area_complaints($label = '', $name = '', $default_value = '', $place_holder = '', $complaint = '')
    {
        $data_label = array(
            'class' => 'caption',
        );
        $data_text_area = array(
            'class' => 'input ui-autocomplete-input',
            'name' => $name,
            'id' => $name,
            'rows' => 4,
            'placeholder' => $place_holder,
            'style' => 'width:450;height:40',
            'pos' => '2',
            'autocomplete' => 'off',
            'role' => 'textbox',
            'aria-autocomplete' => 'list',
            'aria-haspopup' => 'true'
        );
        echo '<div id="fcComplaint" class="fieldCont">';
        echo form_label($label, $name, $data_label);
        echo form_textarea($data_text_area, set_value($name, $default_value));
        echo form_error($name);
        echo '<img src="'.base_url().'images/search.png" title="Search for complaint" valign="top" style="cursor:pointer;" onclick="lookUpComplaints(\'Complaint\',\'\');">';
        echo '<lable id="hComplaint" class="fieldHelp" style="visibility: hidden;">Complaint/Injury </lable>';
        echo '<div id="complaintDiv" title="Complaints lookup"></div>';
        echo '<script language="javascript">
                function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}
                    
         var data = '.$complaint.';
         $(document).ready(function() {
        $(\'#Complaint\').bind( \'keydown\', function( event ) {
                        if ( event.keyCode === $.ui.keyCode.TAB &&
                                $( this ).data( \'autocomplete\' ).menu.active ) {
                            event.preventDefault();
                        }
                    }).autocomplete({
            minLength: 2,
                                focus: function() {return false;},
                                select: function( event, ui ) {
                                    var terms = split( this.value );
                            terms.pop();
                            terms.push( ui.item.value );
                            terms.push( \'\' );
                            this.value = terms.join( \',\' );
                            return false;
                                },
        
        source:function( request, response ) {
                                response( $.ui.autocomplete.filter(
                                data, extractLast( request.term ) ) );
                        }});
         });
        </script>';
    }

    public function password($label = '', $name = '', $default_value = '', $place_holder = '')
    {
        $data_label = array(
            'class' => 'caption',
        );
        $data_text = array(
            'class' => 'form-control input-sm',
            'name' => $name,
            'id' => $name,
            'placeholder' => $place_holder,
            'style' => 'width:200px'
        );
        echo '<div class="form-group">';
        echo form_label($label, $name, $data_label);
        echo '<div class="col-sm-10">';
        echo form_password($data_text, set_value($name, $default_value));
        echo form_error($name);
        echo '</div>';
        echo '</div>';
    }

    public function button($label = '', $content = '', $class = '', $url = '#')
    {
        $data_label = array(
            'class' => 'col-sm-2 control-label',
        );
        $data_button = array(
            'class' => 'btn ' . $class,
        );
        echo '<div class="form-group">';
        echo form_label($label, $content, $data_label);
        echo '<div class="col-sm-10">';
        echo '<a href="' . $url . '">';
        echo form_button($data_button, $content);
        echo '</a>';
        echo '</div>';
        echo '</div>';
    }

    public function dropdown($label = '', $name = '', $option = array(), $selected_value = '', $extra = '')
    {
        $data_label = array(
            'class' => 'caption',
        );
        $dropdown_extra = 'class="input" id="' . $name . '" ' . $extra;
        echo '<div class="fieldCont">';
        echo form_label($label, $name, $data_label);
        echo form_dropdown($name, $option, $selected_value, $dropdown_extra);
        echo form_error($name);
        echo '</div>';
    }

    public function dropdown_treatment($label = '', $name = '', $option = array(), $selected_value = '', $extra = '')
    {
        $data_label = array(
            'class' => 'caption',
        );
        $dropdown_extra = 'class="input" id="' . $name . '" ' . $extra;
        echo '<div class="fieldCont">';
        echo form_label($label, $name, $data_label);
        echo form_dropdown($name, $option, $selected_value, $dropdown_extra);
        echo '<img src="'.base_url().'images/add.png" width="15" height="15" valign="middle" style="cursor:pointer;" onclick="javascript:location.href=\''.site_url().'/treatments/create\'">';
        echo form_error($name);
        echo '</div>';
    }

    public function checkboxes($label = '', $name = '', $options = array(), $checked_value = array())
    {
        $data_label = array(
            'class' => 'col-sm-2 control-label'
        );
        $data_checkbox = array(
            'name' => $name . '[]',
        );
        echo '<div class="form-group">';
        echo form_label($label, $name, $data_label);
        echo '<div class="col-sm-10">';
        echo '<div class="well well-sm" style="background: white">';
        foreach ($options as $id => $value) {
            echo '<div class = "checkbox">';
            echo '<label>';
            echo form_checkbox($data_checkbox, $id, set_checkbox($name, $id, in_array($id, $checked_value)));
            echo $value;
            echo '</label>';
            echo '</div>';
        }
        echo form_error($name);
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function usergroup_checkboxes($label = '', $name = '', $options = array(), $checked_value = '', $val)
    {
        $data_label = array(
            'class' => 'caption'
        );
        $data_checkbox = array(
            'name' => $name . '[]',
        );
        echo '<div id="fcUserGroup" class="fieldCont">';
        echo form_label($label, $name, $data_label);
        echo '<div>';
        echo '<input type="hidden" class="input" id="UserGroup" name="UserGroup" value="'. $val .'">';
        foreach ($options as $id => $value) {
            echo '<label>';
            echo form_checkbox($data_checkbox, $id, set_checkbox($name, $id, check_abc($checked_value, $id)), 'onclick="updateUG(this)"');
            echo $value;
            echo '</label>';
        }
        echo '</div>';
        echo '<lable id="hUserGroup" class="fieldHelp" style="visibility: hidden;">User group</lable>';
        echo form_error($name);
        echo '</div>';

    }

    public function button_submit_reset()
    {
        echo '<div id="fieldCont" class="fieldCont">';
        echo '    <div class="caption">&nbsp;</div>';
        echo '    <div>';
        echo '        <table>';
        echo '        <tbody>';
        echo '            <tr>';
        echo '                <td>';
        echo '<button class="formButton" name="SaveBtn" id="SaveBtn" type="submit" value="Save" onclick="error();">Save</button>';
        echo '<button class="formButton" name="CancelBtn" id="CancelBtn" type="button" value="Cancel" onclick="window.history.back()">Cancel</button>';
        echo '                </td>';
        echo '            </tr>';
        echo '        </tbody>';
        echo '        </table>';
        echo '    </div>';
        echo '</div>';
    }

    public function button_submit_sketch($pid)
    {
        $date = date("Y-m-d H:i:s");
        echo '<div id="fieldCont" class="fieldCont">';
        echo '    <div class="caption">&nbsp;</div>';
        echo '    <div>';
        echo '        <table>';
        echo '        <tbody>';
        echo '            <tr>';
        echo '                <td>';
        echo '<button class="formButton" name="SaveBtn" id="SaveBtn" type="submit" value="Save" onclick=\'canvas_save('.$pid.','.json_encode($date).');\'>Save</button>';
        echo '<button class="formButton" name="CancelBtn" id="CancelBtn" type="button" value="OK" onclick="window.history.back()">OK</button>';
        echo '                </td>';
        echo '            </tr>';
        echo '        </tbody>';
        echo '        </table>';
        echo '    </div>';
        echo '</div>';
    }

    public function button_opd()
    {
        echo '<div id="fieldCont" class="fieldCont">';
        echo '    <div class="caption">&nbsp;</div>';
        echo '    <div>';
        echo '        <table>';
        echo '        <tbody>';
        echo '            <tr>';
        echo '                <td>';
        echo '<button class="formButton" name="SaveBtn" id="SaveBtn" type="submit" value="Save" onclick="error();">Save</button>';
        echo '<button class="formButton" name="CancelBtn" id="CancelBtn" type="button" value="Cancel" onclick="window.history.back()">Cancel</button>';
        echo '                </td>';
        echo '            </tr>';
        echo '            <tr>';
        echo '                <td>';
        echo '<button class="formButton" value="Labtests" name="SaveBtn" id="SaveBtn1" type="submit">Labtests</button>';
        echo '<button class="formButton" value="Prescription" name="SaveBtn" id="SaveBtn2" type="submit">Prescription</button>';
        echo '<button class="formButton" value="Treatment" name="SaveBtn" id="SaveBtn3" type="submit">Treatment</button>';
        echo '<button class="formButton" value="Allergies" name="SaveBtn" id="SaveBtn4" type="submit">Allergies</button>';
        echo '<button class="formButton" value="History" name="SaveBtn" id="SaveBtn5" type="submit">History</button>';
        echo '<button class="formButton" value="Examination" name="SaveBtn" id="SaveBtn6" type="submit">Examination</button>';
        echo '                </td>';
        echo '            </tr>';
        echo '        </tbody>';
        echo '        </table>';
        echo '    </div>';
        echo '</div>';
    }

    public function multiple_select_box($label = '', $name = '', $option = array(), $selected_value = '')
    {
        $data_label = array(
            'class' => 'col-sm-2 control-label',
        );
        $extra = 'class="form-control input-sm" id="' . $name . '"';
        echo '<div class="form-group">';
        echo form_label($label, $name, $data_label);
        echo '<div class="col-sm-10">';
        echo form_multiselect($name, $option, $selected_value, $extra);
        echo form_error($name);
        echo '</div>';
        echo '</div>';
    }

    public function checkbox_confirm($label = '', $name = '', $default_value)
    {
        $data_label = array(
            'class' => 'col-sm-2 control-label',
        );
        echo '<div class="form-group">';
        echo form_label($label, $name, $data_label);
        echo '<div class="col-sm-10">';
        echo form_checkbox($name, '1', $default_value);
        echo form_error($name);
        echo '</div>';
        echo '</div>';
    }

    public function date_created($created_date, $create_user = '', $last_update = '', $last_update_user = '')
    {

        echo '</br>';
        echo '<div id ="fieldCont" class="fieldCont" style="color:#333333;">';
        echo '<div class="caption" >Data created:</div>';
        echo '<input  name="CreateDate"  id="CreateDate"  type="text" class="auditCont" disabled readonly value="' . $created_date . '"\n>&nbsp;';
        echo '<input  name="CreateUser"  id="CreateUser"  type="text" class="auditCont" disabled readonly value="' . $create_user . '"  \n>';
        echo '</div>';

        if ($last_update !== '') {
            echo '<div id ="fieldCont" class="fieldCont" style="color:#333333;">';
            echo '<div class="caption" >Data accessed on:</div>';
            echo '<input name="_" id="_" type="text" disabled="" readonly="" value="' . $last_update . '" class="auditCont">';
            echo '<input name="LastUpDate" id="LastUpDate" type="hidden" class="auditCont" disabled="" readonly="" value="' . $last_update_user . '">';
            echo '</div>';
        }
    }

}
?>
