<div class="content">
    <div id="mdsHead" class="mdshead">Add / Edit Patient examination</div>
    <?php echo Modules::run('patient/banner', $pid, 'style="left:20;"');?>
    <?php
    $date = date("Y-m-d H:i:s");
            $form_generator = new MY_Form('Patient Examination');
            $form_generator->form_open_current_url();

            $form_generator->input_date('*Examination Date', 'examination_date', $default_exam_date);
            $form_generator->input_number('Weight in KG', 'weight', $default_weight, 'min=0 max=300 step=0.5', 'E.g. 50');
            $form_generator->input_number('Height in M', 'height', $default_height, 'min=0 max=2.5 step=0.01', 'E.g. 1.7');
            echo '</br>';
            $form_generator->input_with_default_value_button('sys BP', 'sys_BP', $default_sys_bp, 'min=50 max=300 step=5 normal=120', '120');
            $form_generator->input_with_default_value_button('diast BP', 'diast_BP', $default_diast_bp, 'min=20 max=200 step=5 normal=80', '80');
            echo '</br>';
            $form_generator->input_with_default_value_button('Temperature in *C', 'temperature', $default_temperature, 'min=15 max=50 step=0.1 normal=36.6', '36.6');
            $form_generator->textar();
            $form_generator->dropdown('Active', 'active', array('1' => 'Yes', '0' => 'No'), $default_active);

            $form_generator->button_submit_sketch($pid);
            $form_generator->date_created($default_create_date, $default_create_user, $default_last_update, $default_last_update_user);
            $form_generator->form_close();
            ?>
<!--    <script>-->
<!--        document.getElementById("SaveBtn").onclick = function() {canvas_save(--><?php //echo $pid; ?><!--//, --><?php //echo json_encode($date); ?><!--//)};-->
<!--//    </script>-->
    </form>
</div>
</div>
</article>
</body>
</html>