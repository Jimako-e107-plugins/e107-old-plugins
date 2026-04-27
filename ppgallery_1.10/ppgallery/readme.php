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
$eplug_admin=TRUE;
require_once("../../class2.php");
if (!defined('e107_INIT')){exit;}
if(!getperms("P")){header("location:".e_BASE."index.php"); exit; }
require_once(e_ADMIN."auth.php");
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/readme.php");

$title=PPGREADME_01;

$text=PPGREADME_02;

$ns -> tablerender($title,$text);
require_once(e_ADMIN."footer.php");
?>