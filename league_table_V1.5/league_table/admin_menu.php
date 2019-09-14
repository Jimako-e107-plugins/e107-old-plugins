<?php

if (!defined('e107_INIT')) { exit; }
if(e_LANGUAGE !="English" && file_exists(e_PLUGIN."league_table/languages/".e_LANGUAGE.".php"))
{
	include_once(e_PLUGIN."league_table/languages/".e_LANGUAGE.".php");
}
else
{
	include_once(e_PLUGIN."league_table/languages/English.php");
}
$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = LEAGUE_M002;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_league']['text'] = LEAGUE_M005;
$var['admin_league']['link'] = "admin_league.php";

$var['admin_teams']['text'] = LEAGUE_M003;
$var['admin_teams']['link'] = "admin_teams.php";

$var['admin_readme']['text'] = LEAGUE_M006;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = LEAGUE_M004;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(LEAGUE_M001, $action, $var);
?>