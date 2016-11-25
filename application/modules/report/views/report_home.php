<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
echo Modules::run('template/header');
echo Modules::run('menu', 'report'); //runs the available menu option to that usergroup
?>
<div style="width:95%;">
    <div class="row">
        <div class="col-md-2 ">
            <?php echo Modules::run('leftmenu/report'); //runs the available left menu for preferance ?>
        </div>
        <div class="col-md-10 ">

            <div class="panel panel-default"  >
                <div class="panel-heading"><b>Reports</b></div>
                <?php
                echo $calendar;
                ?>
                <div class="modal fade" id="encounter-stats" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true"></div>
                <div class="modal fade" id="visit-details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true"></div>
                <div class="modal fade" id="visit-complaints" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true"></div>
                <div class="modal fade" id="daily" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true"></div>
                <div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true"></div>
                <div class="modal fade" id="immr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true"></div>
                <div class="modal fade" id="performance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        window.prettyPrint && prettyPrint();
        $('#mydate').datepicker({
            viewMode: 'years',
            minViewMode: 'months',
            format: 'yyyy-mm'
        });
    });
</script>