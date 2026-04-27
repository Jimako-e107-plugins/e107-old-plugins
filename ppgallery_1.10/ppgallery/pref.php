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
require_once(e_HANDLER."ren_help.php");
$_userid=USERID;
$_username=USERNAME;
if (isset($_GET['id'])) {$id=$_GET['id'];}
if (isset($_POST['id'])) {$id=$_POST['id'];}
//Voreinstellungen
$pp_check=mysql_query("SELECT * FROM ".MPREFIX."ppgallery_pref WHERE width>'0'");
$pp_check=mysql_fetch_array($pp_check);
$show=$pp_check['pshow'];
$breite_max=$pp_check['width'];
$hoehe_max=$pp_check['width'];
$width=$pp_check['width'];
$zshow=$pp_check['zshow'];
// Standards
if (isset($_GET['page'])){$page=$_GET['page'];}
else {$page=1;}
$start=$page*$show-$show;
?>