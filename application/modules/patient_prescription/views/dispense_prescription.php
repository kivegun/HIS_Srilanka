<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php echo Modules::run('patient/banner', $pid); ?>
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">Dispense Drug</div>
                <form action="" method="post" role="form">
                    <!-- Table -->
                    <table class="table input-sm" id="table_drug" style="margin-bottom: 0px">
                        <tbody>
                        <tr bgcolor="#e2e2e2">
                            <th><b>#</b></th>
                            <th><b>Name</b></th>
                            <th><b>Dose</b></th>
                            <th><b>Frequency</b></th>
                            <th><b>Period</b></th>
                            <th><b>Quantity</b></th>
                        </tr>
                        </tbody>
                        <tbody>
                        <?php
                        echo '<tr>' . validation_errors() . '</tr>';
                        foreach ($drug_list as $drug_order) {
                            echo '<tr>';
                            echo '<td>' . $drug_order['order'] . '</td>';
                            echo '<td>' . $drug_order['drug_info'] . '</td>';
                            echo '<td>' . $drug_order['dose'] . '</td>';
                            echo '<td>' . $drug_order['frequency'] . '</td>';
                            echo '<td>' . $drug_order['period'] . '</td>';
                            if (isset($drug_order['quantity'])) {
                                echo '<td>' . $drug_order['quantity'] . '</td>';
                            } else {
                                echo '<td>' . '<input type="number" name="quantity[' . $drug_order['order'] . ']" min="0" max="130" value="0" step="1">' . '</td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    if ($patient_prescription->Status === 'Dispensed') {
                        ?>
                        <div class="form-group" style="text-align: center">
                            <button type="button" class="btn btn-primary" onclick="window.history.back()">Back</button>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="form-group" style="text-align: center">
                            <button type="submit" class="btn btn-primary">Dispense</button>
                        </div>
                        <?php
                    }
                    ?>

                </form>
            </div>
        </div>
    </div>
</div>