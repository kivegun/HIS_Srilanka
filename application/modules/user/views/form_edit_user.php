<div class='content' xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">System user edit/new</div>
    <?php
    $form_generator = new MY_Form('System user edit/new');
    $form_generator->form_open_current_url();
    $title_dropdown = array(
        'Mr.' => 'Mr.',
        'Ms.' => 'Ms.',
        'Mrs.' => 'Mrs.',
        'Baby' => 'Baby.',
    );
    $form_generator->dropdown('Title', 'title', $title_dropdown, $default_title);
    $form_generator->input('*First name', 'name', $default_name, 'First Name / Initials of the user');
    $form_generator->input('*Other Name', 'other_name', $default_other_name, 'Other Name of user');
    $form_generator->dropdown('*Gender', 'gender', array('Male' => 'Male', 'Female' => 'Female'), $default_gender);
    $form_generator->dropdown('*Post', 'post', $post_dropdown, $default_post);
    $speciality_dropdown = array(
        'No data' => 'No data'
    );
    $form_generator->dropdown('Speciality', 'speciality', $speciality_dropdown, $default_speciality);
    $form_generator->input('Contact telephone', 'telephone', $default_telephone, 'Contact Telephone Number');
    $form_generator->input('Address 1', 'address_1', $default_address_1, 'eg. 32/2 Kovil Road.');

    echo '<div id="fc_" class="fieldCont"><br></div>';

    $form_generator->dropdown('*User Group', 'user_group', $user_group_dropdown, $default_user_group);
    $form_generator->input('*User name', 'user_name', $default_user_name, 'Login user name');
    ?>
    <div id="fcPassword" class="fieldCont">
        <div class="caption">Current password</div>
        <?php echo '<input autocomplete="OFF" name="Password" id="Password" pos="13" type="password" class="input" value="" readonly="" onmousedown="changePassword('.$id.')" placeholder="****************************************">'  ?>
        <lable id="hPassword" class="fieldHelp" style="visibility: hidden;">Password</lable>
    </div>
    <?php
    echo '<div id="fc_" class="fieldCont"><br></div>';
    $form_generator->dropdown('*Active', 'active', array('1' => 'Yes', '0' => 'No'), $default_active);
    $form_generator->date_created($default_create_date, $default_create_user, $default_last_update, $default_last_update_user);
    $form_generator->button_submit_reset();
    $form_generator->form_close();
    ?>
    <script language="javascript">
        $('.fieldHelp').css({'visibility':'hidden'});
        $('#MDSError').hide();

        $('#Title').focus( function(){
            $('#hTitle').css({'visibility':'visible'});
        });
        $('#Title').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#FirstName').focus( function(){
            $('#hFirstName').css({'visibility':'visible'});
        });
        $('#FirstName').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#OtherName').focus( function(){
            $('#hOtherName').css({'visibility':'visible'});
        });
        $('#OtherName').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#Gender').focus( function(){
            $('#hGender').css({'visibility':'visible'});
        });
        $('#Gender').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#Post').focus( function(){
            $('#hPost').css({'visibility':'visible'});
        });
        $('#Post').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#Speciality').focus( function(){
            $('#hSpeciality').css({'visibility':'visible'});
        });
        $('#Speciality').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#Telephone').focus( function(){
            $('#hTelephone').css({'visibility':'visible'});
        });
        $('#Telephone').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#Address_Street').focus( function(){
            $('#hAddress_Street').css({'visibility':'visible'});
        });
        $('#Address_Street').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#_').focus( function(){
            $('#h_').css({'visibility':'visible'});
        });
        $('#_').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#Address_DSDivision').focus( function(){
            $('#hAddress_DSDivision').css({'visibility':'visible'});
        });
        $('#Address_DSDivision').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#Address_District').focus( function(){
            $('#hAddress_District').css({'visibility':'visible'});
        });
        $('#Address_District').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#UserGroup').focus( function(){
            $('#hUserGroup').css({'visibility':'visible'});
        });
        $('#UserGroup').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#UserName').focus( function(){
            $('#hUserName').css({'visibility':'visible'});
        });
        $('#UserName').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#Password').focus( function(){
            $('#hPassword').css({'visibility':'visible'});
        });
        $('#Password').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#_').focus( function(){
            $('#h_').css({'visibility':'visible'});
        });
        $('#_').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#HID').focus( function(){
            $('#hHID').css({'visibility':'visible'});
        });
        $('#HID').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#Active').focus( function(){
            $('#hActive').css({'visibility':'visible'});
        });
        $('#Active').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });


        function getNormal(obj,val) {

            $('#'+obj).val(val);

        }

        function saveData(ops,redir) {
            var ok = '';
            if ($('#FirstName').val() =='') { $('#fcFirstName').addClass('fieldContError'); ok +='First Name,' ; } else { $('#fcFirstName').removeClass('fieldContError'); }
            if ($('#Gender').val() =='') { $('#fcGender').addClass('fieldContError'); ok +='Gender,' ; } else { $('#fcGender').removeClass('fieldContError'); }
            if ($('#Post').val() =='') { $('#fcPost').addClass('fieldContError'); ok +='Post,' ; } else { $('#fcPost').removeClass('fieldContError'); }
            if ($('#UserGroup').val() =='') { $('#fcUserGroup').addClass('fieldContError'); ok +='User Group,' ; } else { $('#fcUserGroup').removeClass('fieldContError'); }
            if ($('#UserName').val() =='') { $('#fcUserName').addClass('fieldContError'); ok +='User name,' ; } else { $('#fcUserName').removeClass('fieldContError'); }
            if ($('#Active').val() =='') { $('#fcActive').addClass('fieldContError'); ok +='Active,' ; } else { $('#fcActive').removeClass('fieldContError'); }
            if (ok!='') { $('#MDSError').show().html('Missing fields: '+ok); return;};
            $('#SaveBtn').attr('disabled','true').val('Saving..');
            var resM=$.ajax({
                url: 'include/data_save.php?',
                global: false,
                type: 'POST',
                data:({Title:$('#Title').val(),FirstName:$('#FirstName').val(),OtherName:$('#OtherName').val(),Gender:$('#Gender').val(),Post:$('#Post').val(),Speciality:$('#Speciality').val(),Telephone:$('#Telephone').val(),Address_Street:$('#Address_Street').val(),Address_DSDivision:$('#Address_DSDivision').val(),Address_District:$('#Address_District').val(),UserGroup:$('#UserGroup').val(),UserName:$('#UserName').val(),Password:$('#Password').val(),HID:$('#HID').val(),Active:$('#Active').val(),FORM:"userForm" }),
                async:false
            }).responseText;
            eval(resM);
            if (!Error) {
                if (redir) {
                    self.document.location=''+redir+res+'' ; return ;
                } else {
                    self.document.location='home.php?page=preferences&mod=Users&UID='+res+'' ;
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
    <?php echo Modules::run('leftmenu/preference'); //runs the available left menu for preferance ?>
    <div id="prefCont"></div>
</div>
</article>
</body>
</html>