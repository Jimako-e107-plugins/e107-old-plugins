<?php
require_once("../../class2.php");

require_once(e_HANDLER."userclass_class.php");

if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

require_once(e_ADMIN."auth.php");

include_lan(e_PLUGIN.'alt_rank/languages/Admin/'.e_LANGUAGE.'.php');
require_once( e_PLUGIN."alt_rank/alt_rank_ver.php");

$pageid = "admin_config_01";

//-------------------------------------------------------------------------------------------------------------------
$text = "<br /><div style='width:100% text-align:left'>".ALT_ADMIM_03."<br /><br /></div><br />";
$title = "<b>".ALT_ADMIM_00." v".ALTRANK_VER."</b>";
$ns -> tablerender($title, $text);
require_once(e_ADMIN."footer.php");
?>