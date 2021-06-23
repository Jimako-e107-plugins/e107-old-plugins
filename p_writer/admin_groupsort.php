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
$pageid = 'admin_menu_04';
$parms = explode(".", e_QUERY);

// -------------------------------------------------------------------
// Check parameters:
// -------------------------------------------------------------------

// -------------------------------------------------------------------
// DoSort
// -------------------------------------------------------------------
if ($parms[0] == 'DoSort' )
{
	//	header('location:'.e_SELF);
	// $_POST['radio'] contains the group we will sort
	
	$sql = new db();
	$sql->db_Select_Gen("SELECT story_id, story_name, sort_order FROM #pw_stories where storygroup='".$_POST['radio']."' order by sort_order ");

	$text = "
		<div align=center>
		<form action=".e_SELF."?WriteSort method=post>
		<table border=0>";

	$text .= "
		<tr><td colspan=2><u>".$_POST['radio']."</u><br /></td></tr>";

	while ($row = $sql->db_Fetch())
	{
		$text .= "
			<tr>
			<td>". $row['story_name'] . "</td>
			<td><input type='text' size=6 maxlengt=6 name='sosid_".$row['story_id']. "' value='". $row['sort_order'] . "'></td>
			</tr>";
	}

	$text .= "<tr><td style='text-align:center;'><br /><input type='submit' value='".P_SGS_02."'></td></tr>
	<tr><td style='text-align:center;'><br />".P_SGS_04."</td></tr>
	</table></form>";

	$title = PADMENU_04;
	$ns -> tablerender($title, $text);
	require_once(e_ADMIN."footer.php");
	exit;
}

// -------------------------------------------------------------------
// WriteSort
// -------------------------------------------------------------------
if ($parms[0] == 'WriteSort' )
{
	$sql = new db();
	foreach( $_POST as $key=>$value )
	{
		if (substr($key,0,5) == "sosid")
		{ 
			$sql->db_Update("pw_stories","sort_order='".$value."' where story_id='".substr($key,6)."' limit 1 ");
		}
	}
	header("location: admin_pwconf.php");
}

// -------------------------------------------------------------------
// MAIN
// -------------------------------------------------------------------

$sql = new db();
$sql->db_Select_Gen("SELECT distinct(storygroup), count(storygroup) as nNumber FROM #pw_stories group by storygroup order by storygroup ");

$text = "
	<div align=center>
	<form action=".e_SELF."?DoSort method=post>
	<table border=0 cellspacing=20>";
	$text .= "<tr><td>".P_SGS_01."</td></tr><tr><td>";

	while ($row = $sql->db_Fetch())
	{
		if ($row['nNumber'] > 1 )
		{
			$text .= "<input type='radio' name='radio' value='".$row['storygroup']."'>".$row['storygroup']."<br>";
		}
	}
$text .= "</td></tr>";
$text .= "<tr><td style='text-align:center;'><br /><input type='submit' value='".P_SGS_02."'></td></tr>
<tr><td style='text-align:center;'>".P_SGS_03."</td></tr>
</table></form></div>";

$title=PADMENU_04;
$ns -> tablerender($title, $text);
require_once(e_ADMIN."footer.php");

?>
