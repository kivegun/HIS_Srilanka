<html>
<head>
    <title>e-Health Information System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/pub.css" />

    <script type="text/javascript"
            src="<?php echo base_url() ?>js/jquery-1.5.2.min.js"></script>


</head>
<body >
<div id="screen">
    <?php
    //session_start();
    require 'application/config/database.php';
    $con = mysqli_connect('localhost', 'root', '310191', 'mds62');
//    mysqli_select_db($con, $con);
    $date=date("Y-m-d");
    $uid=101;
    //$res="SELECT PID FROM opd_presciption WHERE (CreateDate LIKE '$date%') AND (Status='ready') ORDER BY LastUpDate DESC LIMIT 1";
    $res="SELECT opd_presciption.PID AS id,patient.Full_Name_Registered AS Name FROM opd_presciption,patient 
          WHERE (opd_presciption.PID=patient.PID) AND (opd_presciption.CreateDate 
          LIKE '$date%') AND (opd_presciption.Status='Ready') AND (opd_presciption.LastUpDateUID=$uid) 
          ORDER BY opd_presciption.LastUpDate DESC LIMIT 1";

    $result = mysqli_query($con, $res);
    if(mysqli_num_rows($result)==1){
        while($row = mysqli_fetch_array($result)) {
            ?>
            <div id="waiting">
                <table >


                    <tr ><td id="wbase2" class="qtext" ><?php echo $row['Name'];?></td><td id="wbase1" class="texts" height="768" ><?php echo $row['id'];?></td></tr>


                </table>
            </div>

        <?php }
    } else {?>

        <div id="waiting">
            <p class="blocktext" style="font-family:arial;color:red;font-size:180px;" align="center">කරුණාකර  ඔබගේ වාරය එනතෙක්  රැඳී සිටින්න. </p>

        </div>



        <?php
    }
    ?>
    <div id="screen_footer" >

        <img src="<?php echo base_url() ?>images/footer.jpg" width="99.9%">
    </div>
</div>

</body>
</html>
