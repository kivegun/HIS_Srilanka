<div class="content">
    <div id="mdsHead" class="mdshead">Add OPD Lab Order</div>
    <div id="MDSError" class="mdserror"><?php echo validation_errors() ?></div>
    <div id="formCont" class="formCont">
    <div class="prescriptionHead" style="font-size:23px;">Lab Order</div>
    <div class="prescriptionInfo">
        <form id="frm" method="post">
        <table border="0" width="100%" class="PrescriptionInfo">
            <tbody>
            <tr>
                <td>Hospital : </td>
                <td></td>
                <td nowrap="">Order ID : </td>
                <td nowrap=""><?php echo $default_lab_order_id ?></td>
            </tr>
            <tr>
                <td>Ordering By: </td>
                <td><?php echo $default_order_by; ?></td>
                <td>Test Date : </td>
                <td nowrap=""><?php echo form_input(array('id' => 'OrderDate', 'name' => 'OrderDate'), set_value('OrderDate', $default_order_date)
                        ,'onmousedown="onmousedown=$(\'#OrderDate\').datepicker({changeMonth: true,changeYear: true,yearRange: \'c-40:c+40\',dateFormat: \'yy-mm-dd\',minDate: \'-0D\'});"');?>
                </td>
            </tr>
            <tr>
                <td colspan="4"><hr style="border:0;color: #000000;background-color: #000000;height:1px;"></td>
            </tr>
            <tr>
                <td>Patient: </td>
                <td><?php echo $default_patient_name; ?> </td>
                <td nowrap="">Sex/Age : </td>
                <td nowrap=""><?php echo $default_gender; ?>&nbsp;/&nbsp;
                    <?php if ($default_age["years"]>0){
                        echo  $default_age["years"]."yrs&nbsp;";
                    }
                    echo  $default_age["months"]."mths&nbsp;";
                    echo  $default_age["days"]."dys&nbsp;"; ?> </td>
            </tr>
            <tr>
                <td colspan="4"><hr style="border:0;color: #000000;background-color: #000000;height:1px;"></td>
            </tr>
            <tr>
                <td>Complaints / Injuries: </td>
                <td><?php echo $default_complaints; ?></td>
                <td nowrap="">Doctor : </td><td nowrap=""><?php echo $default_doctor; ?></td>
            </tr>
            <tr>
                <td colspan="4"><hr style="border:0;color: #000000;background-color: #000000;height:1px;"></td>
            </tr>
            <tr>
                <td>Priority: </td>
                <td><select id="Priority" name="Priority" class="input"><option value="Normal">Normal</option><option value="Urgent">Urgent</option></select></td>
                <td nowrap="">Test : </td>
                <td nowrap=""><select id="labTest" name="labTest" class="input" onchange="show_available_test();">
                        <?php
                        foreach ($lab_test_group as $id => $name) {
                            echo '<option value="' . $id . '">' . $name . '</option>';
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td colspan="4">
                    <div id="lab_test_list" style="background:#FFFFFF;"></div>
                </td>
            </tr>
            <tr id="dcont" style="display: none;">
                <td>Sample collection Date : </td>
                <td><?php echo form_input(array('id' => 'dd', 'style' => 'width:100;'), set_value('dd', $default_order_date)
                        ,'onmousedown="onmousedown=$(\'#dd\').datepicker({changeMonth: true, changeYear: true, yearRange: \'c-40:c+40\', dateFormat: \'yy-mm-dd\', maxDate: \'+0D\'});"');?>
                    &nbsp;Time : <select id="hh" name="hh" class="input" style="width:60;" onchange="updateDateTime('CollectionDateTime');">
                        <option value=""></option>
                        <option value="00" selected="">00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                    </select> HH : <select id="mm" name="mm" class="input" style="width:60;" onchange="updateDateTime('CollectionDateTime');">
                        <option value=""></option>
                        <option value="00" selected="">00</option>
                        <option value="05">05</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="30">30</option>
                        <option value="35">35</option>
                        <option value="40">40</option>
                        <option value="45">45</option>
                        <option value="50">50</option>
                        <option value="55">55</option>
                    </select> MM </td>
                <td nowrap=""><input type="hidden" id="CollectionDateTime" class="input" style="width:100;"></td>
                <td nowrap=""></td>
            </tr>
            </tbody>
        </table>
        <div align="center">
            <button class="formButton" name="SaveBtn" id="SaveBtn" type="submit" value="Save" onclick="error();">Create Order</button>
            <input id="okBtn" type="button" value="Cancel" class="formButton" onclick="window.history.back()">
        </div>
        </form>
    </div>
    <script>
        function show_available_test() {
            var dis = document.getElementById('labTest');
            if(dis.options[dis.selectedIndex].value != '0'){
                $("#dcont").attr('style', 'display: table-row');
            } else {
                $("#dcont").attr('style', 'display: none');
            }

            var lab_test_group_id = $("#labTest").val();
            var ihtml = $.ajax({
                url : "<?php echo base_url(); ?>index.php/patient_lab_order/get_lab_test_by_group/" + lab_test_group_id, //+ "?arg=" + arg + "",
                global : false,
                type : "GET",
                async : false
            }).responseText;
            $("#lab_test_list").html(ihtml);

//            var lab_test_group_id = $("#labTest").val();
//            console.log(lab_test_group_id);
//            $("#lab_test_list").html('');
//            var request = $.ajax({
//                url: "<?php //echo base_url(); ?>//index.php/patient_lab_order/get_lab_test_by_group/" + lab_test_group_id,
//                type: "post",
//                dataType: "json"
//            });
//
//            request.done(function (response, textStatus, jqXHR) {
//                var data = eval('(' + response + ')');
////                var data = JSON.parse(response);
//                if (data.length > 0) {
//                    try {
//                        var html = '';
//                        html += '<hr>';
//                        html += '<table border="0" cellspacing="0" cellpadding="0" width="100%" style="font-size: 12;" >';
//                        html += '<tbody>';
//
//                        for (var i = 0; i < data.length; i++) {
//                            html += '<tr>';
//                            html += '<td><input type="checkbox" checked value="' + data[i]["LABID"] + '" id="' + data[i]["LABID"] + '" name="lab_test[]"></td>';
//                            html += '<td>' + data[i]["Name"] + '</td>';
//                            html += '<td>' + data[i]["Group"] + '</td>';
//                            html += '<td>' + data[i]["Department"] + '</td>';
//                            html += '</tr>';
//                        }
//
//                        html += '</tbody>';
//                        html += '</table>';
//                        html += '<hr>';
//                        $("#lab_test_list").html(html);
//                    } catch (e) {
//                    }
//                }
//                else {
//                }
//            });
        }
    </script>
    </div>