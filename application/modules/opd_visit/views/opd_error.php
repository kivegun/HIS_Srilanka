
<script language="javascript">
	$('<div id="mds_msg" title="<?php echo $head ?>"></div>').appendTo("body");
	$("#mds_msg").html("Getting information...");

	$("#mds_msg").html("<?php echo $text ?>");
	$("#mds_msg").dialog({
	 width:<?php echo $w ?>,
	 height:<?php echo $h ?>,
	 autoOpen:true,
	 modal: true,
	 resizable:false,
	 position:"center",
	 close: function(event, ui){
	 history.back()
	 }
	 });
	 </script>