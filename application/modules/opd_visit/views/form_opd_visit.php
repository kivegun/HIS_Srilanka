<div class='content' xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">New OPD Visit</div>
            <?php
            echo Modules::run('patient/banner', $pid, 'style="left:20;"');
            ?>
            <?php
            $form_generator = new MY_Form('OPD Visit');
            $form_generator->form_open_current_url();
            echo '</br>';
            $form_generator->input('Date and time of visit', 'DateTimeOfVisit', $default_visit_time, '', 'readonly');
            if($this->router->fetch_method() == 'create') {
                $form_generator->input_date('*Onset Date', 'OnSetDate', $default_onset_date, '', 'class="input hasDatepicker"');
            } else {
                $form_generator->input('*Onset Date', 'OnSetDate', $default_onset_date, '', 'readonly');
            }

            $form_generator->input('*Doctor', 'doctor', $default_doctor, '', 'readonly');
            $form_generator->dropdown('*Visit type', 'VisitType', $dropdown_visit_type, $default_visit_type);
            $form_generator->text_area_complaints('*Complaint / Injury', 'Complaint', $default_complaint, '', $complaint);
            $form_generator->text_area('Remarks', 'remarks', $default_remarks, '', 'onkeyup="getCannedText(this)"');
            $form_generator->hidden_field('pid', $pid);
            $form_generator->date_created($default_create_date, $default_create_user, $default_last_update, $default_last_update_user);
//            $form_generator->button_submit_reset(0);

            if($this->router->fetch_method() == 'create') {
                $form_generator->button_opd();
            } else {
                $form_generator->button_submit_reset();
            }
            $form_generator->form_close();
            ?>

</div>
<script language="javascript">
    $('.fieldHelp').css({'visibility':'hidden'});
    $('#MDSError').hide();

    $('#DateTimeOfVisit').focus( function(){
        $('#hDateTimeOfVisit').css({'visibility':'visible'});
    });
    $('#DateTimeOfVisit').blur( function(){
        $('.fieldHelp').css({'visibility':'hidden'});
    });
    $('#OnSetDate').focus( function(){
        $('#hOnSetDate').css({'visibility':'visible'});
    });
    $('#OnSetDate').blur( function(){
        $('.fieldHelp').css({'visibility':'hidden'});
    });
    $('#Doctor').focus( function(){
        $('#hDoctor').css({'visibility':'visible'});
    });
    $('#Doctor').blur( function(){
        $('.fieldHelp').css({'visibility':'hidden'});
    });
    $('#VisitType').focus( function(){
        $('#hVisitType').css({'visibility':'visible'});
    });
    $('#VisitType').blur( function(){
        $('.fieldHelp').css({'visibility':'hidden'});
    });
    $('#Complaint').focus( function(){
        $('#hComplaint').css({'visibility':'visible'});
    });
    $('#Complaint').blur( function(){
        $('.fieldHelp').css({'visibility':'hidden'});
    });
    $('#_').focus( function(){
        $('#h_').css({'visibility':'visible'});
    });
    $('#_').blur( function(){
        $('.fieldHelp').css({'visibility':'hidden'});
    });
    $('#_').focus( function(){
        $('#h_').css({'visibility':'visible'});
    });
    $('#_').blur( function(){
        $('.fieldHelp').css({'visibility':'hidden'});
    });
    $('#_').focus( function(){
        $('#h_').css({'visibility':'visible'});
    });
    $('#_').blur( function(){
        $('.fieldHelp').css({'visibility':'hidden'});
    });
    $('#_').focus( function(){
        $('#h_').css({'visibility':'visible'});
    });
    $('#_').blur( function(){
        $('.fieldHelp').css({'visibility':'hidden'});
    });
    $('#Remarks').focus( function(){
        $('#hRemarks').css({'visibility':'visible'});
    });
    $('#Remarks').blur( function(){
        $('.fieldHelp').css({'visibility':'hidden'});
    });
    $('#PID').focus( function(){
        $('#hPID').css({'visibility':'visible'});
    });
    $('#PID').blur( function(){
        $('.fieldHelp').css({'visibility':'hidden'});
    });
    $('#OPDID').focus( function(){
        $('#hOPDID').css({'visibility':'visible'});
    });
    $('#OPDID').blur( function(){
        $('.fieldHelp').css({'visibility':'hidden'});
    });
    $('#LastUpDate').focus( function(){
        $('#hLastUpDate').css({'visibility':'visible'});
    });
    $('#LastUpDate').blur( function(){
        $('.fieldHelp').css({'visibility':'hidden'});
    });

    $('#OnSetDate').datepicker({changeMonth: true,changeYear: true,yearRange: 'c-40:c+40',dateFormat: 'yy-mm-dd',maxDate: '+0D'});

    function getNormal(obj,val) {

        $('#'+obj).val(val);

    }

    function saveData(ops,redir) {
        var ok = '';
        if ($('#OnSetDate').val() =='') { $('#fcOnSetDate').addClass('fieldContError'); ok +='Onset Date,' ; } else { $('#fcOnSetDate').removeClass('fieldContError'); }
        if ($('#Doctor').val() =='') { $('#fcDoctor').addClass('fieldContError'); ok +='Doctor,' ; } else { $('#fcDoctor').removeClass('fieldContError'); }
        if ($('#VisitType').val() =='') { $('#fcVisitType').addClass('fieldContError'); ok +='Visit type,' ; } else { $('#fcVisitType').removeClass('fieldContError'); }
        if ($('#Complaint').val() =='') { $('#fcComplaint').addClass('fieldContError'); ok +='Complaints / Injury,' ; } else { $('#fcComplaint').removeClass('fieldContError'); }
        if (ok!='') { $('#MDSError').show().html('Missing fields: '+ok); return;};
        $('#SaveBtn').attr('disabled','true').val('Saving..');
        var resM=$.ajax({
            url: 'include/data_save.php?',
            global: false,
            type: 'POST',
            data:({DateTimeOfVisit:$('#DateTimeOfVisit').val(),OnSetDate:$('#OnSetDate').val(),Doctor:$('#Doctor').val(),VisitType:$('#VisitType').val(),Complaint:$('#Complaint').val(),Remarks:$('#Remarks').val(),PID:$('#PID').val(),OPDID:$('#OPDID').val(),LastUpDate:$('#LastUpDate').val(),FORM:"opdForm" }),
            async:false
        }).responseText;
        eval(resM);
        if (!Error) {
            if (redir) {
                self.document.location=''+redir+res+'' ; return ;
            } else {
                self.document.location='home.php?page=opd&action=View&OPDID='+res+'' ;
            }

        } else {
            $('#MDSError').show().html(res);
            $('#SaveBtn').removeAttr('disabled').val('Save');
        }

    }
    function updateUG(cb) {
        var ug = '';
        $('input:checked').each(function (i) {
            ug += $(this).val()+',' ;
        })
        $('#UserGroup').val(ug);
    }
</script>
<script language="javascript">
    jQuery(function($){
        $(".input").keyup(function (e) {
            if (( e.which == 13 )){
                //$(this).next().text('ss');
                //$(".input[pos='"+(parseInt($(this).attr('pos'))+1)+"']").first().focus();
            }
        })
    })
</script>
</article>
</body>
</html>


