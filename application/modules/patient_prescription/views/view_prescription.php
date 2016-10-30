<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">Drug Prescription</div>
                <form action="" method="post" role="form">
                    <!-- Table -->
                    <table class="table input-sm" id="table_drug">
                        <tbody>
                        <tr bgcolor="#e2e2e2">
                            <th><b>#</b></th>
                            <th><b>Name</b></th>
                            <th><b>Dose</b></th>
                            <th><b>Frequency</b></th>
                            <th><b>Period</b></th>
                        </tr>

                        </tbody>
                        <tbody>
                        <?php
                        foreach ($drug_list as $drug_order) {
                            echo '<tr>';
                            echo '<td>' . $drug_order['order'] . '</td>';
                            echo '<td>' . $drug_order['drug_info'] . '</td>';
                            echo '<td>' . $drug_order['dose'] . '</td>';
                            echo '<td>' . $drug_order['frequency'] . '</td>';
                            echo '<td>' . $drug_order['period'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        <button class="btn btn-primary" onclick="window.history.back()"> Back </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>