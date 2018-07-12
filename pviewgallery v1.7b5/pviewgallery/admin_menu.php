<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        http://e107.org
|
|        PView Gallery by R.F. Carter
|        ronald.fuchs@hhweb.de
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

if (file_exists(e_PLUGIN . "pviewgallery/languages/" . e_LANGUAGE . ".php")){
	include_once(e_PLUGIN."pviewgallery/languages/".e_LANGUAGE.".php");
}
else
{
    include_once(e_PLUGIN . "pviewgallery/languages/German.php");
} 

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = LAN_ADMIN_2;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_startpage']['text'] = LAN_ADMIN_169;
$var['admin_startpage']['link'] = "admin_startpage.php";

$var['admin_view']['text'] = LAN_ADMIN_143;
$var['admin_view']['link'] = "admin_view.php";

$var['admin_cat']['text'] = LAN_ADMIN_62;
$var['admin_cat']['link'] = "admin_cat.php";

$var['admin_usergal']['text'] = LAN_ADMIN_3;
$var['admin_usergal']['link'] = "admin_usergal.php";

$var['admin_rate']['text'] = LAN_ADMIN_4;
$var['admin_rate']['link'] = "admin_rate.php";

$var['admin_comment']['text'] = LAN_ADMIN_5;
$var['admin_comment']['link'] = "admin_comment.php";

$var['admin_menuconfig']['text'] = LAN_ADMIN_6;
$var['admin_menuconfig']['link'] = "admin_menuconfig.php";

$var['admin_feature']['text'] = LAN_ADMIN_216;
$var['admin_feature']['link'] = "admin_feature.php";

$var['admin_profile']['text'] = LAN_ADMIN_199;
$var['admin_profile']['link'] = "admin_profile.php";

$var['admin_activate']['text'] = LAN_ADMIN_37;
$var['admin_activate']['link'] = "admin_activate.php";

$var['admin_emailprint']['text'] = LAN_ADMIN_113;
$var['admin_emailprint']['link'] = "admin_emailprint.php";

$var['admin_uploads']['text'] = LAN_ADMIN_173;
$var['admin_uploads']['link'] = "admin_batch.php";

$var['admin_watermark']['text'] = LAN_ADMIN_240;
$var['admin_watermark']['link'] = "admin_watermark.php";

$var['admin_chmod']['text'] = LAN_ADMIN_126;
$var['admin_chmod']['link'] = "admin_chmod.php";

$var['admin_cache']['text'] = LAN_ADMIN_279;
$var['admin_cache']['link'] = "admin_cache.php";

$var['admin_readme']['text'] = LAN_ADMIN_26;
$var['admin_readme']['link'] = "admin_readme.php";


show_admin_menu(LAN_ADMIN_1, $action, $var);

?>
