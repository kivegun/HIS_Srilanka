<div class='content' xmlns="http://www.w3.org/1999/html">
    <div id="mdsHead" class="mdshead">Edit main menu</div>
            <?php
            $form_generator = new MY_Form('Top Menu');
            $form_generator->form_open_current_url();
            $form_generator->input('*Menu name', 'name', $default_name, 'Menu display name');
            $form_generator->usergroup_checkboxes('*User Group', 'user_groups', $user_group_options, $selected_group, $selected_group);
            $form_generator->input('*Link', 'link', $default_link, 'Link to follow when clicking');
            $form_generator->input('*Menu Order', 'menu_order', $default_menu_order, 'Link to follow when clicking');
            $form_generator->dropdown('*Active', 'active', array('1' => 'Yes', '0' => 'No'), $default_active);
            $form_generator->date_created($default_create_date, $default_create_user, $default_last_update, $default_last_update_user);
            $form_generator->button_submit_reset($id);
            $form_generator->form_close();
            ?>
    </form>
    <script language="javascript">
        $('.fieldHelp').css({'visibility':'hidden'});
        $('#MDSError').hide();

        $('#Name').focus( function(){
            $('#hName').css({'visibility':'visible'});
        });
        $('#Name').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#UserGroup').focus( function(){
            $('#hUserGroup').css({'visibility':'visible'});
        });
        $('#UserGroup').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#Link').focus( function(){
            $('#hLink').css({'visibility':'visible'});
        });
        $('#Link').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#MenuOrder').focus( function(){
            $('#hMenuOrder').css({'visibility':'visible'});
        });
        $('#MenuOrder').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#Active').focus( function(){
            $('#hActive').css({'visibility':'visible'});
        });
        $('#Active').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });
        $('#_').focus( function(){
            $('#h_').css({'visibility':'visible'});
        });
        $('#_').blur( function(){
            $('.fieldHelp').css({'visibility':'hidden'});
        });


        function getNormal(obj,val) {

            $('#'+obj).val(val);

        }

        function saveData(ops,redir) {
            var ok = '';
            if ($('#Name').val() =='') { $('#fcName').addClass('fieldContError'); ok +='Menu name,' ; } else { $('#fcName').removeClass('fieldContError'); }
            if ($('#UserGroup').val() =='') { $('#fcUserGroup').addClass('fieldContError'); ok +='User group,' ; } else { $('#fcUserGroup').removeClass('fieldContError'); }
            if ($('#Link').val() =='') { $('#fcLink').addClass('fieldContError'); ok +='Link,' ; } else { $('#fcLink').removeClass('fieldContError'); }
            if ($('#MenuOrder').val() =='') { $('#fcMenuOrder').addClass('fieldContError'); ok +='Menu order,' ; } else { $('#fcMenuOrder').removeClass('fieldContError'); }
            if ($('#Active').val() =='') { $('#fcActive').addClass('fieldContError'); ok +='Active,' ; } else { $('#fcActive').removeClass('fieldContError'); }
            if (ok!='') { $('#MDSError').show().html('Missing fields: '+ok); return;};
            $('#SaveBtn').attr('disabled','true').val('Saving..');
            var resM=$.ajax({
                url: 'include/data_save.php?',
                global: false,
                type: 'POST',
                data:({Name:$('#Name').val(),UserGroup:$('#UserGroup').val(),Link:$('#Link').val(),MenuOrder:$('#MenuOrder').val(),Active:$('#Active').val(),FORM:"userMenuForm" , UMID:"10" }),
                async:false
            }).responseText;
            eval(resM);
            if (!Error) {
                if (redir) {
                    self.document.location=''+redir+res+'' ; return ;
                } else {
                    self.document.location='home.php?page=preferences&mod=Menu&UMID='+res+'' ;
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
</div>
<?php echo Modules::run('leftmenu/preference'); //runs the available left menu for preferance ?>
<div id="prefCont"></div>
</div>
</article>
</body>
</html>