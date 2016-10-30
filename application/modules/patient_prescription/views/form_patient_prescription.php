<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php
            echo Modules::run('patient/banner', $PID);
            switch ($ref_type) {
                case 'EMR':
                    echo Modules::run('emergency_visit/info', $ref_id);
                    break;
                case 'ADM':
                    echo Modules::run('admission/info', $ref_id);
                    break;
                case 'OPD':
                    echo Modules::run('opd_visit/info', $ref_id);
                    break;
                default:
                    echo 'Wrong department';
                    break;
            }
            ?>

            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">Drug Prescription</div>
                <form action="" method="post" role="form" class="form-horizontal" style="padding-top: 10px;">
                    <?php
                    echo validation_errors();
                    $form_generator = new MY_Form();
//                    $form_generator->dropdown('Oder Confirmation Doctor', 'order_confirm_user', Modules::run('order_confirmation/get_doctor'), $this->session->userdata('uid'));
//                    $form_generator->password('Order Confirmation Password', 'order_confirm_password');
                    ?>
                    <!-- Table -->
                    <table class="table input-sm" id="table_drug">
                        <tbody>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Dose</th>
                            <th>Frequency</th>
                            <th>Period</th>
                            <th></th>
                        </tr>
                        </tbody>
                        <tbody>
                        <tr>
                            <td></td>
                            <td><?php echo Modules::run('drug/view_select_drug') ?></td>
                            <td><?php echo Modules::run('drug/view_select_dose') ?></td>
                            <td><?php echo Modules::run('drug/view_select_frequency') ?></td>
                            <td><?php echo Modules::run('drug/view_select_period') ?></td>
                            <td align="center" style="vertical-align: middle;">
                                <button type="button" class="btn btn-info" id="add_drug_button" onclick="add_drug()">
                                    <span class="glyphicon glyphicon-plus-sign"></span> Add
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="row"> &nbsp;
                    </div>
                    <div class="form-group" style="text-align: center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-warning" onclick="window.history.back()">Back</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script language="javascript">
    var index = 0;

    function add_drug() {
        index++;

        var selected_drug_text = $("#drug_select :selected").text();
        var selected_dose_text = $("#dose_select :selected").text();
        var selected_frequency_text = $("#frequency_select :selected").text();
        var selected_period_text = $("#period_select :selected").text();

        var html = '<tr>';
        html += '<td>' + index + '</td>';
        html += '<td>' + selected_drug_text + '</td>';
        html += '<td>' + selected_dose_text + '</td>';
        html += '<td>' + selected_frequency_text + '</td>';
        html += '<td>' + selected_period_text + '</td>';
        html += '<td align="center">' + '<button class="btn btn-danger btn_delete_drug" type="button"> Delete</button>' + '</td>';

        html += '<input type="hidden" name="drug_id_selected[' + index + ']" value = "' + $("#drug_select :selected").val() + '">' + '</input>';
        html += '<input type="hidden" name="dose_id_selected[' + index + ']" value = "' + $("#dose_select :selected").val() + '">' + '</input>';
        html += '<input type="hidden" name="frequency_id_selected[' + index + ']" value = "' + $("#frequency_select :selected").val() + '">' + '</input>';
        html += '<input type="hidden" name="period_id_selected[' + index + ']" value = "' + $("#period_select :selected").val() + '">' + '</input>';

        html += '</tr>';

        $("#drug_id").val($("#drug_id").val() + ',' + $("#drug_select :selected").val());

        $('#table_drug > tbody:first-child').append(html);
    }

    $('#table_drug').on('click', '.btn_delete_drug', function () {
        $(this).closest('tr').remove();
    });

</script>