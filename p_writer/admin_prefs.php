<?php
/*
+------------------------------------------------------------------------------+
|  P_Writer - a plugin by Paul Kater
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
require_once('../../class2.php');
require_once(e_ADMIN."auth.php");
if (!defined('e107_INIT')) { exit(); }

// Check to see if the current user has admin permissions for this plugin
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }

include_lan(e_PLUGIN.'/p_writer/languages/'.e_LANGUAGE.'.php');

$eplug_admin = true;
global $pref;
$pageid = 'admin_menu_03';
$parms = explode(".", e_QUERY);

// -------------------------------------------------------------------
// Check parameters:
// -------------------------------------------------------------------

// -------------------------------------------------------------------
// pw_up_pref
// -------------------------------------------------------------------
if ($parms[0] == 'pw_up_pref' )
{
	$pref['pw_nr_chapters'] = intval($_POST['pw_nr_chapters']);
	$pref['pw_auto_double'] = intval($_POST['pw_auto_double']);
	$pref['pw_use_groups']  = intval($_POST['pw_use_groups']);
	$pref['pw_use_physical_delete']  = intval($_POST['pw_use_physical_delete']);
	save_prefs();
	header('location:'.e_SELF.'?ok');
}

// -------------------------------------------------------------------
// MAIN
// -------------------------------------------------------------------

$selected1 = "selected='selected'";
$selected2 = "";
if ($pref['pw_nr_chapters'] == '2')
{
	$selected2 = "selected='selected'";
	$selected1 = "";
}

$Spinner = "
	<select name='pw_nr_chapters'>
	<option value='1' ". $selected1." >1</option>
	<option value='2' ". $selected2." >2</option>
	</select>";

$text = "
	<div align=center>
	<form action=".e_SELF."?pw_up_pref method=post>
	<table width=70% border=0 cellspacing=20>";

$checked = "";
if (intval($pref['pw_use_groups']) == '1')
{
	$checked=" checked ";
}

$text .= "<tr><td width=70% style='text-align:right;' valign=bottom>Use storygroups:</td><td valign=bottom><input type='checkbox' name='pw_use_groups' ".$checked ." value='1'></td></tr>";

$text .= "<tr><td width=70% style='text-align:right;' valign=bottom>Number of chapter columns in overview:</td><td valign=bottom>". $Spinner."</td></tr>";

$text .= "<tr><td width=70% style='text-align:right;' valign=bottom>After how many chapters should p_writer start putting two chapters per row on the overview automatically (0 = ignore):</td><td valign=bottom><input type='text' size=3 maxlenght=3 name='pw_auto_double' value='".$pref['pw_auto_double']."'></td></tr>";

$text .= "<tr><td colspan = 2 style='text-align:center;'><br /><input type='submit' value='submit'></td></tr>";
$text .= "<tr><td colspan=2 style='text-align:center;'><br />";

if (isset($_GET['ok']))
{
	$text .= "New settings are saved.";
}
$text .= "</td></tr>";
$text .= "</table></form></div>";


$title=PADMENU_03;
$ns -> tablerender($title, $text);
require_once(e_ADMIN."footer.php");

