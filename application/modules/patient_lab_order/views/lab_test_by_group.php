
<hr>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="font-size: 12;" >
    <tbody>
<?php
foreach ($lab_test as $lab) {
    echo '<tr>';
    if($lab['Group'] == 'Sugar') {
        echo '<td><input type="checkbox" value="' . $lab["LABID"] . '" id="' . $lab["LABID"] . '" name="lab_test[]"></td>';
    } else {
    echo '<td><input type="checkbox" checked value="' . $lab["LABID"] . '" id="' . $lab["LABID"] . '" name="lab_test[]"></td>';
    }
    echo '<td>' . $lab["Name"] . '</td>';
    echo '<td>' . $lab["Group"] . '</td>';
    echo '<td>' . $lab["Department"] . '</td>';
    echo '</tr>';
}
?>
    </tbody>
</table>
<hr>