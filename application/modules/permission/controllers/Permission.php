<?php


class Permission extends LoginCheckController
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('m_user_group_have_permission');
        $this->load->helper('form');
        $this->load->model('m_permission');
        //$this->load->model('m_user_group');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function edit($prmid)
    {

//        if (!Modules::run('permission/check_permission', 'system', 'edit')) {
//            die('You do not have permission!');
//        }
        $this->load->model('m_permission');
        //$this->load->model('m_user_group');

        $permission = $this->m_permission->get($prmid);

        $data['user_group'] = $this->m_permission->get($prmid);
        if (empty($permission))
            die('User group not found');

        $data['id'] = $prmid;
        $data['default_user_group'] = $permission->UserGroup;
        $data['default_permission'] = $permission->UserAccess;
        $data['default_remarks'] = $permission->Remarks;
        $data['default_create_date'] = $permission->CreateDate;
        $data['default_create_user'] = $permission->CreateUser;
        $data['default_last_update'] = $permission->LastUpDate;
        $data['default_last_update_user'] = $permission->LastUpDateUser;

//        $data['all_permission'] = $this->m_permission->order_by('Name', 'ASC')->get_all();
//        $data['all_user_group_have_permission'] = $this->m_user_group_have_permission->get_many_by(array('UGID' => $ugid));
        $this->form_validation->set_rules('permission[]', 'Permission', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->qch_template->load_form_layout('view_permission', $data);
        } else {
            $this->qch_template->load_form_layout('view_permission', $data);
            $data = array(
                'UserGroup' => $this->input->post('user_group'),
                'UserAccess' => $this->input->post('UserAccess'),
                'Remarks' => $this->input->post('remarks'),
            );
            $this->m_permission->update($prmid, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
//            var_dump($data['default_user_group']);
            );
            $this->redirect_if_no_continue('preference/load/permission');
        }
    }

    public function button($data = array()){
        var_dump($data);
    }

    private function openByGroup() {

        $this->load->database();
        $result = $this->db->query('select PRMID,UserAccess from permission where UserGroup = "'.$this->session->userdata('user_group_name').'" ' );
        $count = $result->num_rows();
        if ($count!=1) return NULL;
        foreach ($result->result_array() as $row){
            return $row["UserAccess"];
        }
//        $row = $result->result_array();
//        if ($row["PRMID"]) {
//            return $row["UserAccess"];
//        }
//        else return null;
    }

    public function check_permission($access) {

        $mdsPermission = $this->openByGroup();
        var_dump($mdsPermission);
        $obj = json_decode($mdsPermission);
        if ($obj->{$access}) {
            return true;
        }
        else {
            return false;
        }
    }

//    public function mdsError() {
//        $data = '';
////        $this->render('permission_error', $data);
//        $this->load->view('permission_error');
//    }

}