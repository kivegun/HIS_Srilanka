<div class="panel panel-info">
    <div class="panel-heading">
        <?php
        if (Modules::run('permission/check_permission', 'patient', 'edit')) {
            echo '<h4 class="panel-title pull-left"><b>'. lang('Patient Overview'). '</b></h4>';
            echo '<button class="btn btn-warning pull-right btn-sm" onclick="document.location=\'' . site_url('patient/edit') . '/' . $patient_info["PID"] . '/?CONTINUE=patient/view/' . $patient_info["PID"] . '\'">Edit</button>';
            echo '<div class="clearfix"></div>';
        } else {
            echo '<b>'. lang('Patient Overview'). '</b>';
        }
        ?>
    </div>
    <div class="table-responsive well" style="padding-top: 0px;padding-bottom: 0px;">
        <table class="table">
            <tbody>
            <tr>
                <td><?php echo lang('Full Name')?>:</td>
                <td>
                    <b>
                        <?php
                        echo $patient_info["Personal_Title"] . ' ' . $patient_info["Name"];
                        if (!empty($patient_info["OtherName"]))
                            echo ' / ' . $patient_info["OtherName"];
                        ?>
                    </b>
                </td>
                <td><?php echo lang('Patient ID')?>:</td>
                <td><b><?php echo $patient_info["PID"] ?></b></td>
            </tr>
            <tr>
                <td><?php echo lang('Gender')?></td>
                <td><?php echo $patient_info["Gender"] ?></td>
                <td><?php echo lang('Civil Status')?>:</td>
                <td><?php echo $patient_info["Personal_Civil_Status"] ?></td>
            </tr>
            <tr>
                <td><?php echo lang('Date of Birth')?>:</td>
                <td><?php echo $patient_info["DateOfBirth"] ?></td>
                <td><?php echo lang('Age')?>:</td>
                <td><?php if ($patient_info["Age"]["years"] > 0) {
                        echo $patient_info["Age"]["years"] . " Yrs&nbsp;";
                    }
                    echo $patient_info["Age"]["months"] . " Mths&nbsp;";
                    echo $patient_info["Age"]["days"] . " Dys&nbsp;"; ?></td>
            </tr>
            <tr>
                <td><?php echo 'Occupation'?>:</td>
                <td><?php echo $patient_info['Occupation'] ?></td>
                <td><?php echo lang('Address')?>:</td>
                <td><?php echo $patient_info['Address_Street'] ?></td>
            </tr>
            <tr>
                <td><?php echo lang('Remarks')?>:</td>
                <td><?php echo $patient_info['Remarks'] ?></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
