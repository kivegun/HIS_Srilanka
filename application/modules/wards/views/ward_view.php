<div class="content">
    <div id="mdsHead" class="mdshead"><?php echo $name . ' (' .$type. ')'  ?></div>
    <?php echo Modules::run('leftmenu/ward_admission'); ?>
</div>
</article>

<div id="ward_cont" style="position:absolute" class="ward_cont"></div>
<?php echo $pager; ?>
</body>
</html>
