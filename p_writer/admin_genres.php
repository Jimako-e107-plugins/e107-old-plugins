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

$parms = explode(".", e_QUERY);

$eplug_admin = true;
$pageid = 'admin_menu_02';
// -------------------------------------------------------------------
// Check parameters:
// -------------------------------------------------------------------

// -------------------------------------------------------------------
// Delete Genre (dg)
// -------------------------------------------------------------------
if ( $parms[0] == 'dg' )
{
	// genre in $parms[1].
	$sql = new db();
	$sql->db_Delete("pw_genre","genre_id='" . $parms[1] . "' ");
	header ("location: " . e_SELF );	
}

// -------------------------------------------------------------------
// Edit Genre (eg)
// -------------------------------------------------------------------
if ( $parms[0] == 'eg' )
{
	// genre in $parms[1]. 0=new. Prevent 'edit' of non-existent non-zero genre-id.
	$sql = new db();
	if ($parms[1] > '0')
	{
		$sql->db_Select_Gen("SELECT * FROM #pw_genre where genre_id='" . $parms[1] . "' ");
		$row = $sql->db_Fetch();
	}
	else
	{
		$row['genre_id'] = "0";
		$row['genre_name'] = "- new genre -";
	}

	$text .= '<form action='. e_SELF.'?StoreGenre method=post>';
	$text .= "<input size='32' maxlength='32' type='text' name='genre_name' value='". $row['genre_name'] . "' />
						<input class='button' type='submit' name='StoreGenre' value='".PCONS_02."' />
						<input type='hidden' name='genre_id' value='". $parms[1] . "'>
						</form>";
	$text .= "<form action=". e_SELF." method=post>
						<input class='button' type='submit' name='GoBack' value='".PCONS_03."' />
						</form>";
	
	$title=P_GNR_07;
	$ns -> tablerender($title, $text);
	require_once(e_ADMIN."footer.php");

}

// -------------------------------------------------------------------
// Store Genre (StoreGenre)
// -------------------------------------------------------------------
if ( $parms[0] == 'StoreGenre' )
{
	// Store genre. genre_id is in post genre_id,genre name in post genre_name

	// echo $_POST['genre_id'] . " / " . $_POST['genre_name'] ;

	$sql = new db();
	if ($_POST['genre_id'] == 0)
	{ // new - insert
		$sql->db_Insert("pw_genre", "'" . $_POST['genre_id'] . "', '" . $_POST['genre_name'] . "'");
	}
	else
	{ // exists - update
		$sql->db_Update("pw_genre","genre_name='" . $_POST['genre_name'] . "' where genre_id='" . $_POST['genre_id'] . "'");
	}
	header ("location: " . e_SELF );
}

// -------------------------------------------------------------------
// Mainline of the program.
// -------------------------------------------------------------------
$text = "<table  class='fborder' cellpadding=10><th class='fcaption'>".P_GNR_02."</th><th class='fcaption'>".P_GNR_03."</th><th class='fcaption'>".P_GNR_04."</th>";	
$sql = new db();
$sql1 = new db();

$sql->db_Select_Gen("SELECT * FROM #pw_genre ");
while ($row = $sql->db_Fetch())
{
	$text .= "<tr><td class='forumheader3'>" . $row['genre_name'] . "</td>";
	$text .= "<td  class='forumheader3' style='text-align: center;'><a href=" . e_SELF . "?eg." . $row['genre_id'] . "><img src=". e_IMAGE . "/admin_images/edit_16.png></a></td>";
	$text .= "<td  class='forumheader3' style='text-align: center;'>";
	// only allow deletion of a genre when it is not in use:
	$sql1->db_Select_Gen("SELECT genre_id FROM #pw_stories where genre_id='" . $row['genre_id'] . "'");
	if (! $row1 = $sql1->db_Fetch())
	{
		$text .= "<a href=" . e_SELF . "?dg." . $row['genre_id'] . "><img src=". e_IMAGE . "/admin_images/delete_16.png></a>";
	}
	else
	{
		$text .= P_GNR_05;
	}	
	$text .= "</td></tr>";
}

$text .= "</table>";

$text .= "<div style='text-align: center;'><br \>
			<form action=". e_SELF."?eg.0 method=post>
			<input class='button' type='submit' name='EditGenre' value='".P_GNR_06."' />
			</form></div>";

$title=PADMENU_01;
$ns -> tablerender($title, $text);
require_once(e_ADMIN."footer.php");
?>

