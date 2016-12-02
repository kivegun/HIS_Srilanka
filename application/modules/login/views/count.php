<?php
/**
 * Created by PhpStorm.
 * User: kivegun
 * Date: 11/30/16
 * Time: 6:36 AM
 */
?>
<div style='position:absolute;width:90%;height:50px;border:2px solid red;text-align:center;background-color:#f1f1f1;'>
                Please try to login again in <span id='time'>15</span>sec.
                <div id='link'></div>
                </div>
                <script language='javascript'>
                    var countdownfrom=15;
                    var time = document.getElementById('time');
                    var currentsecond=parseInt(time.innerHTML);
                    var t=setTimeout('display()',15000);
                    countredirect();
                    var t1=null;
                    function countredirect(){
                        if (currentsecond!=1){
                            currentsecond-=1
                            var time = document.getElementById('time');
                            time.innerHTML=currentsecond;
                            t1=setTimeout('countredirect()',1000) ;
                        }
                        else{
                            var l = document.getElementById('link');
                            l.innerHTML= '<a id=\'link\' href=\'<?php echo base_url()."index.php/login?NEXT=" ?>\'>Login</a>';
                            clearTimeout(t1);
                            t1=null;
                            self.document.location='<?php echo base_url()."index.php/login?NEXT=" ?>';
                            return;
                        }
                    }
                </script>
