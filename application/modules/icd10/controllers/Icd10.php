<?php


class icd10 extends FormController
{
    var $FORM_NAME = 'form_icd10';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_icd10');
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
    }

    public function edit($id)
    {
        $icd10 = $this->m_icd10->get($id);
        if (empty($icd10))
            die('Id not exist');
        $data['id'] = $id;
        $data['default_code'] = $icd10->Code;
        $data['default_name'] = $icd10->Name;
        $data['default_isnotify'] = $icd10->isNotify;
        $data['default_remarks'] = $icd10->Remarks;
        $data['default_create_date'] = $icd10->CreateDate;
        $data['default_create_user'] = $icd10->CreateUser;
        $data['default_last_update'] = $icd10->LastUpDate;
        $data['default_last_update_user'] = $icd10->LastUpDateUser;

        $this->set_common_validation();

        if ($this->form_validation->run() == FALSE) {
            $this->load_form($data);
        } else {
            $data = array(
                'Code' => $this->input->post('code'),
                'Name' => $this->input->post('name'),
                'isnotify' => $this->input->post('isnotify'),
                'Remarks' => $this->input->post('remarks'),
            );
            $this->m_icd10->update($id, $data);
            $this->session->set_flashdata(
                'msg', 'Updated'
            );
            $this->redirect_if_no_continue('/preference/load/icd10');
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
        $this->form_validation->set_rules('code', 'Code', 'trim|xss_clean|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
        $this->form_validation->set_rules('isnotify', 'isNotify', 'trim|xss_clean|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean');
    }

    public function lookup_icd()
    {
        $this->load->view('lookup_icd');
    }

    public function server_process()
    {
//        session_start();
//        if (!session_is_registered(username)) {
//            header("location: ../login.php");
//        }
        $allowedForms =  array("findingForm","disorderForm","eventForm","procedureForm","proceduresForm","lookup_icd");
        $ok=0;
        if(in_array($_GET['FORM'], $allowedForms))
        {
            $ok =1;
        }
        if ($ok == 0){
            die("Nothing Here");
        }


        require 'application/config/database.php';
        $fName = $_GET['FORM'];
        require 'application/forms/lookup_icd.php';
        $frm = $ICDForm;
        $aColumns = $frm["LIST"];

        $sIndexColumn = $frm["OBJID"];
        $sTable = $frm["TABLE"];

        $gaSql['user']       = $db['default']['username'];
        $gaSql['password']   = $db['default']['password'];
        $gaSql['db']         = $db['default']['database'];
        $gaSql['server']     = $db['default']['hostname'];


        $gaSql['link'] =  mysqli_connect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
        die( 'Could not open connection to server' );

        mysqli_select_db($gaSql['link'], $gaSql['db'] ) or
        die( 'Could not select database '. $gaSql['db'] );


        $sLimit = "";
        if ( isset( $_GET['iDisplayStart'] ) && ($_GET['iDisplayLength'] != '-1' ))
        {
            $sLimit = "LIMIT ".mysqli_real_escape_string($gaSql['link'] ,$_GET['iDisplayStart'] ).", ".
                mysqli_real_escape_string($gaSql['link'] ,$_GET['iDisplayLength'] );
        }



        if ( isset( $_GET['iSortCol_0'] ) )
        {
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
            {
                if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
                {
                    $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysqli_real_escape_string($gaSql['link'] ,$_GET['sSortDir_'.$i] ) .", ";
                }
            }

            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" )
            {
                $sOrder = "";
                //$sOrder = " ORDER BY ". $sIndexColumn . " DESC";
            }
        }



        $sWhere = "";
        if ( $_GET['sSearch'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i < count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($gaSql['link'] ,$_GET['sSearch'] )."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }


        for ( $i=0 ; $i < count($aColumns) ; $i++ )
        {
            if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
            {
                if ( $sWhere == "" )
                {
                    $sWhere = "WHERE ";
                }
                else
                {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($gaSql['link'] ,$_GET['sSearch_'.$i])."%' ";
            }
        }


        $sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";

        $rResult = mysqli_query( $gaSql['link'],  $sQuery ) or die("");

        $sQuery = "
		SELECT FOUND_ROWS()
	";
        $rResultFilterTotal = mysqli_query($gaSql['link'],  $sQuery ) or die("error");
        $aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0];


        $sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
        $rResultTotal = mysqli_query($gaSql['link'],  $sQuery ) or die("error");
        $aResultTotal = mysqli_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];

        $sOutput = '{';
        $sOutput .= '"sEcho": '.intval($_GET['sEcho']).', ';
        $sOutput .= '"iTotalRecords": '.$iTotal.', ';
        $sOutput .= '"iTotalDisplayRecords": '.$iFilteredTotal.', ';
        $sOutput .= '"aaData": [ ';
        while ( $aRow = mysqli_fetch_array( $rResult ) )
        {
            $sOutput .= "[";
            for ( $i=0 ; $i < count($aColumns) ; $i++ )
            {
                if ( $aColumns[$i] == "version" )
                {

                    $sOutput .= ($aRow[ $aColumns[$i] ]=="0") ?
                        '"-",' :
                        '"'.str_replace("\n", " ",str_replace('"', '\"', $aRow[ $aColumns[$i] ])).'",';
                }
                else if ( $aColumns[$i] != ' ' )
                {

                    $sOutput .= '"'.str_replace("\n", " ",str_replace('"', '\"', $aRow[ $aColumns[$i] ])).'",';
                }
            }
            $btn = "<input type='button' class='patBtn'  value='Edit' onclick=self.document.location='home.php?page=patientnew&PID=".$aRow[0]."'>";
            $btn .= "<input type='button' class='patBtn'  value='Open' onclick=self.document.location='home.php?page=patient&PID=".$aRow[0]."'>";
            $btn .= "<input type='button' class='patBtn'  value='Print' onclick=\"printPatientSlip(".$aRow[0].");\">";
            //$sOutput .= '"'.str_replace('"', '\"', $btn).'",';
            $sOutput = substr_replace( $sOutput, "", -1 );
            $sOutput .= "],";
        }
        $sOutput = substr_replace( $sOutput, "", -1 );
        $sOutput .= '] }';

        echo $sOutput;
    }

}