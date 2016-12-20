<div class="content">
    <div id="mdsHead" class="mdshead">Add / Edit Past history</div>
    <?php echo Modules::run('patient/banner', $pid, 'style="left:20;"');?>
    <?php
            $form_generator = new MY_Form(lang('Patient History'));
            $form_generator->form_open_current_url();
            $form_generator->input('Date/Age/Year', 'HistoryDate', $default_date, 'Date or age or period');
            ?>
            <div id="fcICD_Code" class="fieldCont">
                <input name="ICD_Code" id="ICD_Code" type="hidden" value="">
            </div>
            <?php
            $form_generator->text_area_lookup('*ICD Diagnosis', 'ICD_Text', $default_icd);
            ?>
            <div id="fcIMMR_Code" class="fieldCont">
                <input name="IMMR_Code" id="IMMR_Code" type="hidden" value="">
            </div>
            <div id="fcIMMR_Text" class="fieldCont">
                <div class="caption">*IMMR Diagnosis</div>
                <textarea name="IMMR_Text" id="IMMR_Text" pos="5" rows="2" class="input" style="width:450px;" readonly><?php echo $default_immr; ?></textarea>
                <img src="<?php echo base_url(); ?>images/clear.png" title="Clear field" width="15" height="15" valign="top" style="cursor:pointer" onclick="$('#IMMR_Text').val('')">
                <lable id="hIMMR_Text" class="fieldHelp" style="visibility: hidden;"> </lable>
                <div id="immrDiv" title="IMMR lookup"></div>
            </div>
            <?php
            $form_generator->text_area('Remarks', 'remarks', $default_remarks, 'Any remarks (Canned text enabled)');
            $form_generator->dropdown('Active', 'active', array('1' => 'Yes', '0' => 'No'), $default_active);
            $form_generator->date_created($default_create_date, $default_create_user, $default_last_update, $default_last_update_user);
            $form_generator->button_submit_reset($id);
            $form_generator->form_close();
            ?>
    </form>
</div>
</div>
</article>
</body>
</html>

