<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_drug extends LoginCheckController
{
    public $data = array();
    var $SELECTED_MENU = 'preference';

    function __construct()
    {
        parent::__construct();
        //$this->load_default_paging_config();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index($pre_page = NULL)
    {
        $this->load('my_drug');
    }

    public function load($pre_page = NULL)
    {
        $this->loadMDSPager($pre_page);
    }

    public function loadMDSPager($fName)
    {
        $path = 'application/forms/' . $fName . '.php';
        require $path;
        $frm = $form;
        //$UID=$_SESSION["UID"];

        $this->load->model('mpersistent');
        //$data["ward_info"] = $this->mpersistent->open_id(86, "User", "UID");
        $sql = "SELECT  Doctor_Drug.DDID,
			drugs.DRGID ,
			drugs.Name,			
			drugs.dFrequency,
			drugs.dDosage,
			drugs.Stock,
			Doctor_Drug.PRIORITY
			FROM Doctor_Drug, drugs 
			where (Doctor_Drug.DRGID = drugs.DRGID ) AND (Doctor_Drug.USRID = 86)
            ";


        $this->load->model('mpager');
        $this->mpager->setSql($sql);
        $this->mpager->setDivId('prefCont');
        $this->mpager->setSortorder('asc');
        //set colun headings
        $colNames = array();

        foreach ($frm["DISPLAY_LIST"] as $colName) {
            array_push($colNames, $colName);
        }
        //default group
        $this->mpager->setColNames($colNames);

        //set captions
        $this->mpager->setCaption($frm["CAPTION"]);
        //set row id
        $this->mpager->setRowid($frm["ROW_ID"]);

        $testdata = array();

        //set column models
//        foreach ($frm["COLUMN_MODEL"] as $columnName => $model) {
//            if (gettype($model) == "array") {
//                $this->mpager->setColOption($columnName, $model);
//            }
//        }

        //set actions
        $action = $frm["ACTION"];
        $this->mpager->gridComplete_JS = "function() {
            var c = null;
            $('.jqgrow').mouseover(function(e) {
                var rowId = $(this).attr('id');
                c = $(this).css('background');
                $(this).css({'background':'yellow','cursor':'pointer'});
            }).mouseout(function(e){
                $(this).css('background',c);
            }).click(function(e){
                var rowId = $(this).attr('id');
                window.location='$action'+rowId;
            });
            }";


        //report starts
        if (isset($frm["ORIENT"])) {
            $this->mpager->setOrientation_EL($frm["ORIENT"]);
        }
        if (isset($frm["TITLE"])) {
            $this->mpager->setTitle_EL($frm["TITLE"]);
        }

//        $pager->setSave_EL($frm["SAVE"]);
        $this->mpager->setColHeaders_EL(isset($frm["COL_HEADERS"]) ? $frm["COL_HEADERS"] : $frm["DISPLAY_LIST"]);
        //report endss

        $data['pager'] = $this->mpager->render(false);
        $data["pre_page"] = $fName;
//        $this->load->vars($data);
        $this->render('my_drug', $data);
    }


}