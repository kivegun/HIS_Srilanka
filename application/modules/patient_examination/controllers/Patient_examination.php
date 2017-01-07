<?php

/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 12-Oct-15
 * Time: 9:10 PM
 */
class Patient_Examination extends FormController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_patient_examination');
//        $this->load_form_language();
    }

    public function add($pid)
    {
        $data = array();
        $data['id'] = '';
        $data['pid'] = $pid;
        $data['default_exam_date'] = date("Y-m-d");
        $data['default_weight'] = '';
        $data['default_height'] = '';
        $data['default_sys_bp'] = '';
        $data['default_diast_bp'] = '';
        $data['default_temperature'] = '';
        $data['default_sketch'] = '';
        $data['default_active'] = '';

        $data['default_create_date'] = date("Y-m-d H:i:s");
        $data['default_create_user'] = $this->session->userdata('name') . ' ' . $this->session->userdata('other_name');
        $data['default_last_update'] = '';
        $data['default_last_update_user'] = '';

        $this->form_validation->set_rules('examination_date', 'Examination Date', 'trim|xss_clean|required');
        $this->form_validation->set_rules('weight', 'Weight', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('height', 'Height', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('sys_bp', 'sys BP', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('diast_bp', 'diast BP', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('temperature', 'Temperature', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'ExamDate' => $this->input->post('examination_date'),
                'Weight' => $this->input->post('weight'),
                'Height' => $this->input->post('height'),
                'sys_BP' => $this->input->post('sys_BP'),
                'diast_BP' => $this->input->post('diast_BP'),
                'Temprature' => $this->input->post('temperature'),
                'Active' => $this->input->post('active'),
                'PID' => $pid
            );
            $this->m_patient_examination->insert($data);
            $this->session->set_flashdata(
                'msg', 'REC: Examination created for ' . $pid
            );
            $this->redirect_if_no_continue('/patient/view/' . $pid);
        }
    }

    public function edit($examination_id)
    {
        $exam = $this->m_patient_examination->get($examination_id);
        if (empty($exam)) {
            die('Id wrong');
        }
        $data = array();
        $data['id'] = $examination_id;
        $data['pid'] = $exam->PID;
        $data['default_exam_date'] = substr($exam->ExamDate, 0, 10);
        $data['default_weight'] = $exam->Weight;
        $data['default_height'] = $exam->Height;
        $data['default_sys_bp'] = $exam->sys_BP;
        $data['default_diast_bp'] = $exam->diast_BP;
        $data['default_temperature'] = $exam->Temperature;
        $data['default_active'] = $exam->Active;

        $this->form_validation->set_rules('weight', 'Weight', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('height', 'Height', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('sys_bp', 'sys BP', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('diast_bp', 'diast BP', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('temperature', 'Temperature', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $update_data = array(
                'ExamDate' => $this->input->post('examination_date'),
                'Weight' => $this->input->post('weight'),
                'Height' => $this->input->post('height'),
                'sys_BP' => $this->input->post('sys_bp'),
                'diast_BP' => $this->input->post('diast_bp'),
                'Temperature' => $this->input->post('temperature'),
                'Active' => $this->input->post('active'),
            );
            $this->m_patient_examination->update($examination_id, $update_data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/patient/view/' . $pid);
        }
    }

    public function get_previous_exams($pid, $continue, $mode = 'HTML')
    {
        $data = array();
        $data["patient_exams_list"] = $this->m_patient_examination->as_array()->order_by('CreateDate', 'DESC')->get_many_by(array('PID' => $pid));
        $data["continue"] = $continue;
        if ($mode == "HTML") {
            $this->load->vars($data);
            $this->load->view('patient_previous_exam');
        } else {
            return $data["patient_exams_list"];
        }
    }

    public function testSave()
    {
        require 'application/config/database.php';

        $gaSql['user']       = $db['default']['username'];
        $gaSql['password']   = $db['default']['password'];
        $gaSql['db']         = $db['default']['database'];
        $gaSql['server']     = $db['default']['hostname'];

        $con = mysqli_connect( $gaSql['server'], $gaSql['user'], $gaSql['password']  );

        mysqli_select_db($con, $gaSql['db'] );

        define('UPLOAD_DIR', 'patient_exam/');
        $img = $_POST['seid'];
        $pid=$_POST['seid1'];

        $res1="SELECT PATEXAMID FROM patient_exam WHERE PID=$pid ORDER BY LastUpDate DESC LIMIT 1";
        $result1 = mysqli_query($con, $res1);
//print $success ? $file : 'Unable to save the file.';

        while ($row= mysqli_fetch_assoc($result1)){
            $patexamid=$row['PATEXAMID'];
        }
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        if(isset($patexamid)){
            $file = UPLOAD_DIR . $patexamid . '.png';
            $success = file_put_contents($file, $data);
        }

        $sql="UPDATE patient_exam SET exam_sketch='patient_exam/$patexamid.png' WHERE PATEXAMID=$patexamid";
        //$sql="UPDATE patient_exam SET exam_sketch='patient_exam/$res.png' WHERE PID=$pid AND LastUpDate='$date'";
        $result = mysqli_query($con, $sql);
//print $success ? $file : 'Unable to save the file.';

        echo json_encode($result);
    }
}