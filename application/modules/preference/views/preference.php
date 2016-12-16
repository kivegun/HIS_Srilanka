<!--<div class="container-fluid">-->
<!--    <div class="row">-->
<!--        <div class="col-md-2">-->
<!--            --><?php //echo Modules::run('leftmenu/preference'); //runs the available left menu for preferance ?>
<!--        </div>-->
<!--        <div class="col-md-10 ">-->
<!--            --><?php
//            echo "<div id='prefCont'></div>";
//            echo $pager; // runs the preferance home module by default
//            ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


        <div class='content' xmlns="http://www.w3.org/1999/html">
        <div id="mdsHead" class="mdshead">System User</div>
        <?php echo Modules::run('leftmenu/preference'); //runs the available left menu for preferance ?>
<!--        <div id="prefOps"><input type="button" value="Add new User / Staff" onclick="self.document.location='home.php?page=preferences&amp;mod=UserNew'"></div>-->
            </div>
    </article>
            <div id="prefCont"></div>
        <?php echo $pager; ?>
            </html>
            </body>

<!--</div>-->