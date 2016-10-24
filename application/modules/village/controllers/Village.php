<?php


class Village extends FormController
{
    var $FORM_NAME = 'form_village';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_village');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function create()
    {
        //var_dump($_POST);
        $data = array();
        $data['id'] = 0;
        $data['default_district'] = '';
        $data['default_dsdivision'] = '';
        $data['default_gndivision'] = '';
        $data['default_code'] = '';
        $data['default_active'] = '';
        $data['default_create_date'] = date("Y-m-d H:i:s");
        $data['default_create_user'] = 'a';
        $data['default_last_update'] = '';
        $data['default_last_update_user'] = '';

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'District' => $this->input->post('district'),
                'DSDivision' => $this->input->post('DSDivision'),
                'GNDivision' => $this->input->post('GNDivision'),
                'Code' => $this->input->post('code'),
                'Active' => $this->input->post('active'),
            );
            $this->m_village->insert($data);
            $this->session->set_flashdata(
                'msg', 'Created'
            );
            $this->redirect_if_no_continue('preference/load/village');
        }

    }

    public function edit($id)
    {
        $village = $this->m_village->get($id);
        if (empty($village))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_district'] = $village->District;
        $data['default_dsdivision'] = $village->DSDivision;
        $data['default_gndivision'] = $village->GNDivision;
        $data['default_code'] = $village->Code;
        $data['default_active'] = $village->Active;
        $data['default_create_date'] = $village->CreateDate;
        $data['default_create_user'] = $village->CreateUser;
        $data['default_last_update'] = $village->LastUpDate;
        $data['default_last_update_user'] = $village->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'District' => $this->input->post('district'),
                'DSDivision' => $this->input->post('DSDivision'),
                'GNDivision' => $this->input->post('GNDivision'),
                'Code' => $this->input->post('code'),
                'Active' => $this->input->post('active'),
            );
            $this->m_village->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/village');
        }
    }

    public function redirect_if_no_continue($uri)
    {
        if ($this->input->get('CONTINUE') === null) {
            redirect($uri);
        } else {
            redirect($this->input->get('CONTINUE'));
        }
    }

    private function set_common_validation()
    {
        $this->form_validation->set_rules('district', 'District', 'trim|xss_clean|required');
        $this->form_validation->set_rules('dsdivision', 'DSDivision', 'trim|xss_clean');
        $this->form_validation->set_rules('gndivision', 'GNDivision', 'trim|xss_clean');
        $this->form_validation->set_rules('code', 'Code', 'trim|xss_clean|required');
        $this->form_validation->set_rules('active', 'Active', 'trim|xss_clean');
    }

}