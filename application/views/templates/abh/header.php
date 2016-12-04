
<!-- styles for pager ends-->-->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>HHIMS</title>
    <link rel="icon" type="image/ico" href="<?php echo base_url() ?>images/mds-icon.png">
    <link rel="shortcut icon" href="<?php echo base_url() ?>images/mds-icon.png">
    <link href="<?php echo base_url() ?>css/mdstheme1.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() ?>css/jquery.alerts.css" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url() ?>css/demo.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() ?>css/jquery-ui-1.8.9.custom.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() ?>css/jquery.ui.datetimepicker.css" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url() ?>css/mds_k.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() ?>css/layout_k.css" rel="stylesheet" type="text/css">

    <!-- styles for pager starts-->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>css/themes/ui.jqgrid.css" />
    <!-- styles for pager ends-->

    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.4.2.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.event.drag.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.RightClik.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.hotkeys-0.7.9.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.UI.Min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.print.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/chili-1.7.pack.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.accordion.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.alerts.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.ui.datetimepicker.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url() ?>js/mdsCore.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/mdsmailer.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/prompt.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/sketch.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.text.js"></script>

    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery.ui.datepicker.js"></script>

    <!--        scripts for pager starts-->
    <script src="<?php echo base_url() ?>js/jquery.layout.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>js/i18n/grid.locale-en.js" type="text/javascript"></script>
    <script type="text/javascript">
        $.jgrid.no_legacy_api = true;
        $.jgrid.useJSON = true;
    </script>
    <script src="<?php echo base_url() ?>js/jquery.jqGrid.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>js/jquery.tablednd.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>js/jquery.contextmenu.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>js/ui.multiselect.js" type="text/javascript"></script>
    <!--        scripts for pager ends-->

    <link href="<?php echo base_url() ?>css/demo_page.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() ?>css/demo_table.css" rel="stylesheet" type="text/css">

    <style type="text/css" title="currentStyle">

        .mybold td {font-weight : bold !important}
        th {font-weight:  normal;font-size: 12;}
    </style>
    <script language="javascript">
        parent.window.onbeforeunload = 'void(0)';


        $(document).ready(function(){


            $("#loading").remove();
            //jQuery(document).bind('keydown', 'Ctrl+s',function (evt){evt.preventDefault( ); $('#SaveBtn').trigger('click'); return false;});
            //jQuery(document).bind('keydown', 'alt+s',function (evt){evt.preventDefault( );  $('#SaveBtn').trigger('click').click( function(){return true}); return false;});
            jQuery(document).bind('keydown', 'alt+n',function (evt){evt.preventDefault( ); self.document.location='home.php?page=patient&action=New'; return false;});
            jQuery(document).bind('keydown', 'alt+h',function (evt){evt.preventDefault( ); self.document.location='home.php'; return false;});
            jQuery(document).bind('keydown', 'Ctrl+f',function (evt){evt.preventDefault( ); getSearchText('patient'); return false;});
            jQuery(document).bind('keydown', 'Alt+f',function (evt){evt.preventDefault( ); getSearchText('patient'); return false;});
            $(document).keyup(function (e) {
                if (( e.which == 13 )){
                    //$(this).next().text('ss');
                    //$(".input[pos='"+(parseInt($(this).attr('pos'))+1)+"']").first().focus();
                }

            })

            $('INPUT[value=Home]').focus();
            char0 = new Array("§", "32");
            char1 = new Array("˜", "732");
            characters = new Array(char0, char1);
            //$(document).BarcodeListener(characters, function(code) {
            //});
        });
        function execute( st ) {
            self.document.location = st;
        }

        function removedrug($ddid)
        {

            var checkstr =  confirm('Are you really want to delete this Drug from your list?');
            if(checkstr == true){
                $.ajax({
                    type :'POST',
                    url: 'deletemydrug.php',
                    dataType : 'json',
                    data:{
                        seid:$ddid
                    },
                    success: function(){
                        alert('Drug removed from your list');
                        window.history.back();
                    }
                });
            }
            else{
                return false;
            }

        }

        function canvas_save($pid,$date)
        {
            // converting the canvas to data URI
            var canvas  = document.getElementById("tools_sketch");
            var strImageData = canvas.toDataURL("image/png");
            //var a=encodeURIComponent(strImageData);
            //alert(strImageData);
            //var dataUrl = canvas.toDataURL();

            $.ajax({

                type :'POST',
                url : document.location.origin + "/HIS_Srilanka/index.php/patient_examination/testSave",
                dataType : 'json',
                data:{

                    seid:strImageData,
                    seid1:$pid,
                    seid2:$date
                },
                success: function(data)
                {

                }
            });

        }



        function canvas_save1($pid,$date)
        {
            // converting the canvas to data URI
            var canvas  = document.getElementById("tools_sketch");
            var strImageData = canvas.toDataURL("image/png");
            //var a=encodeURIComponent(strImageData);
            //alert(strImageData);
            //var dataUrl = canvas.toDataURL();

            $.ajax({

                type :'POST',
                url :'testSave1.php',
                dataType : 'json',
                data:{

                    seid:strImageData,
                    seid1:$pid,
                    seid2:$date
                },
                success: function(data)
                {

                }
            });
        }

        function canvas_save2($pid,$date)
        {
            // converting the canvas to data URI
            var canvas  = document.getElementById("tools_sketch");
            var strImageData = canvas.toDataURL("image/png");
            //var a=encodeURIComponent(strImageData);
            //alert(strImageData);
            //var dataUrl = canvas.toDataURL();

            $.ajax({
                type :'POST',
                url :'testSave2.php',
                dataType : 'json',
                data:{

                    seid:strImageData,
                    seid1:$pid,
                    seid2:$date
                },

                success: function(data)
                {

                }
            });
        }

    </script>
</head>
<body>
<form method="post" action="">
<article role="main">