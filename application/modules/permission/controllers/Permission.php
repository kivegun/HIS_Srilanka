<?php

/**
 * Created by PhpStorm.
 * User: manhdx
 * Date: 11/19/15
 * Time: 10:59 AM
 */
class Permission extends LoginCheckController
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('m_user_group_have_permission');
    }

    public function edit($prmid)
    {

//        if (!Modules::run('permission/check_permission', 'system', 'edit')) {
//            die('You do not have permission!');
//        }
        $this->load->model('m_permission');
        $this->load->model('m_user_group');

        $permission = $this->m_permission->get($prmid);

        $data['user_group'] = $this->m_permission->get($prmid);
        if (empty($permission)
            die('User group not found');

        $data['id'] = $prmid;
        $data['default_user_group'] = $permission->UserGroup;
        $data['default_permission'] = $permission->UserAccess;
        $data['default_active'] = $permission->Active;
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
            $data = array(
                'UserGroup' => $this->input->post('user_group'),
                'UserAccess' => $this->input->post('permission'),
                'Remarks' => $this->input->post('remarks'),
            );
            $this->m_visit_type->update($prmid, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('preference/load/permission');
        }

    }

//    public function check_permission($name, $type) {
//        $ugid = $this->session->userdata('user_group_id');
//        if (empty($ugid))
//            return false;
//        $this->load->database();
//        $sql = 'SELECT * FROM user_group_have_permission
//                LEFT JOIN permission ON permission.PERID = user_group_have_permission.PERID
//                WHERE permission.Name = "'.$name.'" AND UGID = '. $ugid. ' AND Type = "'.$type. '" AND Active = 1';
//        $query = $this->db->query($sql);
//        if ($query->num_rows() > 0) {
//            return true;
//        }
//        return false;
//    }
}