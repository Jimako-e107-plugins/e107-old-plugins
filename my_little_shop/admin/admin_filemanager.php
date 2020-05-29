<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/my_little_shop/admin/admin_playerstable_config.php $
|		$Revision: 0.01 $
|		$Date: 2008/06/08 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

//$lan_file = e_PLUGIN."my_little_shop/languages/".e_LANGUAGE."/admin_stadions_lan.php";
//require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."my_little_shop/languages/German/admin_stadions_lan.php");
//require_once("../functionen.php");
/////////////////////////////
//---------------------------------------------------------------
require_once(e_ADMIN."auth.php");
require_once("../handler/form_handler.php");
$pageid = "filemanager";  
$configtitle="Dateimanager";
$text="<iframe src='".e_PLUGIN."my_little_shop/ajaxfilemanagerrc4/ajaxfilemanager/ajaxfilemanager.php' style='border:1px #888888 none;' name='meinIFrame' scrolling='auto' frameborder='0' align=middle marginheight='0px' marginwidth='0px' height='600' width='100%'></iframe>";
//$text.="<br/><br/>".powered_by();
$text.="";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");

///////////////////////////////////////////////////////////////////////////////

?>