<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php
            $form_generator = new MY_Form(lang('Patient'));
            $form_generator->form_open_current_url();
            $title_dropdown = array(
                'Mr.' => 'Mr.',
                'Ms.' => 'Ms.',
                'Mrs.' => 'Mrs.',
                'Baby' => 'Baby.',
            );
            $form_generator->dropdown('*' . lang('Title'), 'title', $title_dropdown, $default_title);
            $form_generator->input('*' . lang('Name'), 'name', $default_name, 'Name of patient');
            $form_generator->input(lang('Other Name'), 'other_name', $default_other_name, 'Name of patient');
            $form_generator->dropdown('*' . lang('Gender'), 'gender', array('Male' => 'Male', 'Female' => 'Female'), $default_gender);
            $civil_status = array(
                'Single' => 'Single',
                'Married' => 'Married',
                'Divorced' => 'Divorced',
                'Widow' => 'Widow',
                'Unknown' => 'Unknown',
            );
            $form_generator->dropdown(lang('Civil Status'), 'civil_status', $civil_status, $default_civil_status);
            $form_generator->input_inline_checkbox(lang('BI ID'), 'bi_id', $default_bi_id, 'eg. 123456789', 'Do not have', $default_bi_id_checked);
            $form_generator->input_inline_checkbox(lang('NUIT ID'), 'nuit_id', $default_nuit_id, 'eg. 123456789', 'Do not have', $default_nuit_id_checked);
            $form_generator->input_date(lang('Date of Birth'), 'date_of_birth', $default_date_of_birth, 'Date of Birth');
            $form_generator->input('Occupation', 'occupation', /*$default_occupation*/'','Occupation');
            $form_generator->input(lang('Telephone'), 'telephone', $default_telephone, 'Telephone Number');

            $form_generator->dropdown(lang('Province'), 'province', $dropdown_provinces, $default_province);
            $form_generator->dropdown(lang('District'), 'district', $dropdown_district, $default_district);
            $form_generator->dropdown(lang('Health Unit'), 'health_unit', $dropdown_health_unit, $default_health_unit);

            $form_generator->input(lang('Address'), 'address', $default_address, '');
            $form_generator->text_area(lang('Remarks'), 'remarks', $default_remarks, 'Any Remarks');
            $form_generator->button_submit_reset($id);
            $form_generator->form_close();
            ?>
        </div>
    </div>
</div>
<script>
    $('#bi_id_checkbox').change(function () {
        if (this.checked) {
            $(':input[name="bi_id"]').val("");
            $(':input[name="bi_id"]').prop('disabled', true);
        } else {
            $(':input[name="bi_id"]').prop('disabled', false);
        }
    });
    $('#nuit_id_checkbox').change(function () {
        if (this.checked) {
            $(':input[name="nuit_id"]').val("");
            $(':input[name="nuit_id"]').prop('disabled', true);
        } else {
            $(':input[name="nuit_id"]').prop('disabled', false);
        }
    });

    // change province
    $("#province").change(function () {
        district_id = $("#province").val();
        $.ajax({
            url: "<?php echo base_url() ?>index.php/patient/get_district/" + district_id,
            type: "post"
        }).done(function (response) {
            response = JSON.parse(response);
            var html = '';
            for (var i = 0; i < response.length; i++) {
                console.log(response[i]);
                html += '<option value="' + response[i].district_code + '">' + response[i].name + '</option>';
                if (i == 0) {
                    district_id = response[i].district_code;
                }
            }
            $("#district").html(html);

            //update health unit
            $.ajax({
                url: "<?php echo base_url() ?>index.php/patient/get_health_unit/" + district_id,
                type: "post"
            }).done(function (response) {
                response = JSON.parse(response);
                var html = '';
                for (var i = 0; i < response.length; i++) {
                    console.log(response[i]);
                    html += '<option value="' + response[i].id + '">' + response[i].US + '</option>';
                }
                $("#health_unit").html(html);

            }).fail(function () {
                alert('Error');
            });

        }).fail(function () {
            alert('Error');
        });
    });
    // change district
    $("#district").change(function () {
        district_id = $("#district").val();
        $.ajax({
            url: "<?php echo base_url() ?>index.php/patient/get_health_unit/" + district_id,
            type: "post"
        }).done(function (response) {
            response = JSON.parse(response);
            var html = '';
            for (var i = 0; i < response.length; i++) {
                console.log(response[i]);
                html += '<option value="' + response[i].id + '">' + response[i].US + '</option>';
            }
            $("#health_unit").html(html);

        }).fail(function () {
            alert('Error');
        });
    });
</script>
