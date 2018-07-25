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
switch (substr(strrchr(e_SELF,"/"),1)) {
case "admin_config.php":
    $helptitle = LAN_ADMIN_2;
    $helptext = LAN_HELP_3;
    break;
case "admin_activate.php":
    $helptitle = LAN_ADMIN_37;
    $helptext = LAN_HELP_10;
    break;
case "admin_comment.php":
    $helptitle = LAN_ADMIN_5;
    $helptext = LAN_HELP_7;
    break;
case "admin_menuconfig.php":
    $helptitle = LAN_ADMIN_6;
    $helptext = LAN_HELP_8;
    break;
case "admin_rate.php":
    $helptitle = LAN_ADMIN_4;
    $helptext = LAN_HELP_6;
    break;
case "admin_usergal.php":
    $helptitle = LAN_ADMIN_3;
    $helptext = LAN_HELP_5;
    break;
case "admin_cat.php":
    $helptitle = LAN_ADMIN_62;
    $helptext = LAN_HELP_9;
    break;
case "admin_readme.php":
    $helptitle = "PView Gallery";
    $helptext = LAN_HELP_4;
    $helptext.= "<p><a href='http://programmer.hhweb.de'>".LAN_HELP_22."</a></p>";
    $helptext.= LAN_HELP_21;
    break;
case "admin_emailprint.php":
    $helptitle = LAN_ADMIN_113;
    $helptext = LAN_HELP_11;
    break;
case "admin_batch.php":
    $helptitle = LAN_ADMIN_173;
    $helptext = LAN_HELP_13.LAN_HELP_20;
    break;
case "admin_chmod.php":
    $helptitle = LAN_ADMIN_126;
    $helptext = LAN_HELP_14;
    break; 
case "admin_view.php":
    $helptitle = LAN_ADMIN_143;
    $helptext = LAN_HELP_15;
    break;
case "admin_startpage.php":
    $helptitle = LAN_ADMIN_169;
    $helptext = LAN_HELP_19;
    break;  
case "admin_profile.php":
    $helptitle = LAN_ADMIN_199;
    $helptext = LAN_HELP_23;
    break;  
 case "admin_feature.php":
    $helptitle = LAN_ADMIN_216;
    $helptext = LAN_HELP_24;
    break;
 case "admin_watermark.php":
    $helptitle = LAN_ADMIN_240;
    $helptext = LAN_HELP_25;
    break; 
 case "admin_cache.php":
    $helptitle = LAN_ADMIN_279;
    $helptext = LAN_HELP_27;
    $helptext.= LAN_HELP_26;
    break;       
	     
default:
	$helptitle = "PView Gallery";
    $helptext = LAN_HELP_12;
    break;
}
$helptitle = LAN_HELP_1 . " - " . $helptitle;
if ((substr(strrchr(e_SELF,"/"),1)) != "admin_readme.php") {
	$helptext.= "<p><a href='admin_readme.php'>".LAN_HELP_2."</a></p>";
}

$ns -> tablerender($helptitle, $helptext);
?>