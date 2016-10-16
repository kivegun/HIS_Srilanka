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
    public function form_open_current_url()
    {
        echo '<div id="MDSError" class="mdserror" style="display: block;">'.validation_errors().'</div>';
        $form_attributes = array(
            'class' => 'form-horizontal',
            'role' => 'form'
        );

        echo '<div id="formCont" class="formCont" style="left:100;">';
        echo '<form id="frm" method="post">';

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

    public function input_with_default_value_button($label = '', $name = '', $default_value = '', $button_click_value)
    {
        $data_label = array(
            'class' => 'col-sm-2 control-label',
        );
        $data_text = array(
            'class' => 'form-control input-sm',
            'name' => $name,
            'id' => $name,
        );
        echo '<div class="form-group">';
        echo form_label($label, $name, $data_label);
        echo '<div class="col-sm-10">';
        echo '<div class="input-group">';
        echo form_input($data_text, set_value($name, $default_value));
        echo '<span class="input-group-btn">';
        echo '<button type="button" class="btn btn-default" onclick="$(\'#' . $name . '\').val(' . $button_click_value . ');">';
        echo '<span class="glyphicon glyphicon-thumbs-up pull-right"></span>';
        echo '</button>';
        echo '</span>';
        echo '</div>';
        echo '</div>';
        echo form_error($name);
        echo '</div>';
    }

    public function input_date($label = '', $name = '', $default_value = '', $place_holder = '')
    {
        $js = 'onmousedown="onmousedown=$(\'#' . $name . '\').datepicker({changeMonth: true,changeYear: true,yearRange: \'c-40:c+40\',dateFormat: \'yy-mm-dd\',maxDate: \'+0D\'});"';
        $this->input($label, $name, $default_value, $place_holder, $js);
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
            'rows' => 3,
            'placeholder' => $place_holder,
            'style' => 'width:450;'
        );
        echo '<div class="fieldCont">';
        echo form_label($label, $name, $data_label);
        echo form_textarea($data_text_area, set_value($name, $default_value), $extra);
        echo form_error($name);
        echo '<img src="'.base_url().'images/clear.png" title="Clear field" width="15" height="15" valign="top" style="cursor:pointer" onclick="$(\'#ICDLink\').val(\'\')">';
        echo '<lable id="hICDLink" class="fieldHelp" style="visibility: hidden;">ICD link</lable>';
        echo '<div id="icdDiv" title="ICD lookup"></div>';
        echo '</div>';
    }

    public function password($label = '', $name = '', $default_value = '', $place_holder = '')
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

    public function button_submit_reset($id = '')
    {
        echo '<div id="fieldCont" class="fieldCont">';
        echo '    <div class="caption">&nbsp;</div>';
        echo '    <div>';
        echo '        <table>';
        echo '        <tbody>';
        echo '            <tr>';
        echo '                <td>';
        echo '<button class="formButton" name="SaveBtn" id="SaveBtn" type="submit" value="Save">Save</button>';
        echo '<button class="formButton" name="CancelBtn" id="CancelBtn" type="button" value="Cancel" onclick="window.history.back()">Cancel</button>';
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
