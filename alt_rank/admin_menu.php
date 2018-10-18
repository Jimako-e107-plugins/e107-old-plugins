<?php
if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN.'alt_rank/languages/Admin/'.e_LANGUAGE.'.php');

$menutitle  = ALT_ADMIM_01;
	
$butname[] = ALT_ADMIM_02;
$butlink[] = "admin_config.php";
$butid[]   = "admin_config_01";
	
global $pageid;
for ($i=0; $i<count($butname); $i++)
{
$var[$butid[$i]]['text'] = $butname[$i];
$var[$butid[$i]]['link'] = $butlink[$i];
};
	
show_admin_menu($menutitle, $pageid, $var);
?>