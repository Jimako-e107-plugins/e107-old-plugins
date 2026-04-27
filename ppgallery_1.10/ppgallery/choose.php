<?php
/*
*************************************
*        PPGallery					*
*									*
*        (C)Oyabunstyle.de			*
*        http://oyabunstyle.de		*
*        info@oyabunstyle.de		*
*************************************
*/
require_once("../../class2.php");
require_once("pref.php");
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/choose.php");

$content="
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>".PPGLAN_01."</title>
<link href='stuff/style.css' rel='stylesheet' type='text/css' />

</head>
<body class='ch'>
<div id='ch-spacer'></div>
<a href='javascript:window.close()' id='ch_close' class='ch_button'>".PPGLAN_08."</a>
<div id='choose'>
	<div id='choose_title'>
		".PPGLAN_02."
	</div>
	<br />
	<a href='ch_gallery.php' class='ch_button'>".PPGLAN_03."</a>
	<a href='ch_new.php' class='ch_button'>".PPGLAN_04."</a>
	<br /><br /><br />
	".PPGLAN_05."
	<br /><br />
	".PPGLAN_06."
	<br /><br /><br /><br /><br /><br /><br />
	".PPGLAN_07." <a href='http://oyabunstyle.de' target='_blank'>Oyabunstyle.de</a>
</div>

</body>
</html>";

echo $content;
?>