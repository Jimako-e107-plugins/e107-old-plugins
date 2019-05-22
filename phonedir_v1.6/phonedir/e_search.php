<?php
if (!defined('e107_INIT'))
{
    exit;
}
if(e_LANGUAGE != "English" && file_exists(e_PLUGIN."phonedir/languages/".e_LANGUAGE.".php"))
{
	include_once(e_PLUGIN."phonedir/languages/".e_LANGUAGE.".php");
}
else
{
	include_once(e_PLUGIN."phonedir/languages/English.php");
}
$pd_title = LAN_phonedir_1;
$search_info[]=array( 'sfile' => e_PLUGIN.'phonedir/search.php', 'qtype' => $pd_title, 'refpage' => 'phonedir.php');
?>