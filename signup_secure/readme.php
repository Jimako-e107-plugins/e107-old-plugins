<?php
/*
*************************************
*        Signup Secure				*
*									*
*        (C)Oyabunstyle.de			*
*        http://oyabunstyle.de		*
*        info@oyabunstyle.de		*
*************************************
*/
$eplug_admin = TRUE;
require_once("../../class2.php");
include_lan(e_PLUGIN."signup_secure/languages/".e_LANGUAGE.".php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
	header("location:".e_BASE."index.php");
	 exit ;
}
require_once(e_ADMIN . "auth.php");

// Title des Adminbereichs
$title = "Read Me";

$text = "<table class='fborder' style='width:90%'><tr><td class='forumheader3'>".SS_README."</td></tr></table>";


$ns -> tablerender($title, $text);
require_once(e_ADMIN."footer.php");


?>