<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Wars 1.0                                              |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin\.php\?Screens/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?Screens/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}

$wid = intval($_GET['wid']);

if(ADMIN){
	$action = "admin.php?Upload&wid=$wid";
}else{
	$action = "clanwars.php?Upload&wid=$wid";
}
	
?>
<link rel="stylesheet" href="<?php echo THEME;?>/style.css" />
<style type="text/css">
body{
	margin:0;
	padding:0;
	background-image:url();
	background-color:transparent;
}
div.nowrap{
	width:420px;
	display:block;
	margin:2px;
	padding:2px;
	text-align:left;
	font-weight:bold;
	border:1px solid transparent;
}
form{
	margin:0;
	padding:0;
}
</style>
<script type="text/javascript">
var i= "";
function Uploading(){
	if(i==""){
		document.getElementById('uploadform').style.display='none';
		document.getElementById('uploading').style.display='block';
	}
	document.getElementById('uploading').innerHTML = "Uploading" + i;
	if(i == "..."){
		i = "";
	}else{
		i += ".";
	}
	setTimeout(Uploading,300);
}
</script>
<div class="nowrap" id="uploadform">
<form action="<?php echo $action;?>" method="post" enctype="multipart/form-data" onsubmit="Uploading();"><input type="file" name="screenshot" style="width:300px;">
<input type="submit" class="button" value="<?php echo _WUPLOAD;?>"><input type="hidden" name="e-token" value="<?php echo e_TOKEN; ?>" />
</form></div>
<div class="nowrap" id="uploading" style="display:none;padding-left:100px;">Uploading...</div>
<?php exit;?>