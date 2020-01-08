<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Plugin file :  e107_plugins/userlanguage_flags_menu/plugin.php
|        Revision    1.5
|        Date        26.07.2013
|        Author      JmoRava, Oxigen ( www.e107.funsite.cz ) 
+----------------------------------------------------------------------------------------------------+
*/
if (!getperms("P"))
{
    header("location:". e_BASE ."index.php");
    exit;
}
include_lan(e_PLUGIN ."userlanguage_flags_menu/languages/". e_LANGUAGE.".php");
$text = "<table width='97%' class='fborder'>";
    $text .= "<tr><td class='forumheader2'>".USLFM_H_3."<br /></td></tr>";
    $text .= "<tr><td class='forumheader2'>".USLFM_H_4."<br /></td></tr>"; 
    $text .= "<tr><td class='forumheader2'>".USLFM_H_5."<br /></td></tr>";
    $text .= "<tr><td class='forumheader2'>".USLFM_H_6."<br /></td></tr>";
    $text .= "<tr><td class='forumheader2'>".USLFM_H_7."<br /></td></tr>";
$text .= "</table>";
$ns->tablerender(USLFM_H_1, $text);