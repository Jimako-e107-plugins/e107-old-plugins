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
$pageid = 'admin_menu_01';
$parms = explode(".", e_QUERY);

include "p_writer.js";

// --------------------------
// Procedures for parameters:
// --------------------------
//
// -------------------------------------------------------------------
// AddStory - Add a new story.
// -------------------------------------------------------------------
if ($parms[0] == 'AddStory' )
{
	include "AddUpd_checks.php";
	
	// if a storygroup has been entered, we use that. Otherwise we take what was on the
	// storygroup spinner.
	if ( ! empty ($_POST['newgroup']) )
	{
		$group = $_POST['newgroup'];
	}
	else
	{
		$group = $_POST['storygroupspinner'];
	}
	$image = $_POST['newimage'];

	// Okay, let's add story:
	$sql = new db();
	$sql->db_Insert("pw_stories",
		"0, '" 
		.$tp->toDB($_POST['newstory']). "', " 
		.$_POST['newyear']. ", '" 
		.$_POST['genrespinner']. "', '" 
		.$tp->toDB($group). "', '"
		.$_POST['sortorder']. "', '"
		.$tp->toDB($image) . "', '" 
		.$_POST['hide']."'");

	header ('location: '.e_SELF);
}

// -------------------------------------------------------------------
// DelStory - delete story and all its chapters
// -------------------------------------------------------------------
if ($parms[0] == 'DelStory')
{
	// as we are deleting a whole story, chapters and all, we will ask
	// confirmation first:
	if ( $parms[2] == "cf")
	{
		$sql = new db();
		$sql->db_Select_Gen("SELECT * FROM #pw_stories as ps left outer join #pw_chapter as pc on ps.story_id=pc.story_id where ps.story_id = '" . $parms[1] . "' order by pc.chapter_number desc limit 1 ");
		$row = $sql->db_Fetch();
		if (empty($row['chapter_number']))
		{
			$row['chapter_number'] = "no";
		}
		$text .= "Story: " . $row['story_name'] . " with " . $row['chapter_number'] . " chapters.<br />";
		$text .= "<form action=". e_SELF."?DelStory method=post>".
					PADM_21 . 
					"<input type='hidden' name='storyid' value='" .$parms[1]. "'
					<input class='button' type='submit' name='DelStory' value='".PADM_22."' />
					</form></div>";
		$text .= BackButton();
		$title=$story_name;
		$ns -> tablerender($title, $text);
		require_once(e_ADMIN."footer.php");
		exit;
	}

	if ( $_POST['DelStory'] )
	{	// delete
		$sql = new db();
		$sql->db_Delete("pw_chapter", "story_id='" .$_POST['storyid']. "'");
		$sql->db_Delete("pw_stories", "story_id='" .$_POST['storyid']. "'");
	}
	header ('location: '.e_SELF);
}

// -------------------------------------------------------------------
// DoChapter - input/edit of chapter content
// -------------------------------------------------------------------
if ($parms[0] == 'DoChapter' )
{
	$text = "";

	$story_id = $parms[1];
	$chapter_number = $parms[2];
	$sql = new db();
	
	$text = "<table  class='fborder'>";	

	// collect story information from tables:
	$query ="SELECT * FROM #pw_stories as ps ";

	if ($chapter_number > 0)
	{
		$query .= "join #pw_chapter as pc on ps.story_id=pc.story_id
								and pc.chapter_number='" .$chapter_number. "' ";
	}
	$query .= " where ps.story_id = '" . $story_id . "'  LIMIT 1";

	$sql->db_Select_Gen($query);
	$row = $sql->db_Fetch();

	if ($chapter_number == "")
	{
		$row['chapter_id'] = "0";
		$chapter_name = "";
		$chapter_text = "";
	}

	$text .= "<form action=". e_SELF."?StoreData method=post>";
	$text .= PADM_27 . " ";
	$chapter_name = $tp->toDB($row['chapter_name']);
	$text .= "<input type='text' size='4' maxlength='4' name='chapter_number' value='". $row['chapter_number'] ."' />. ";		
	$text .= "<input type='text' size='40' maxlength='128' name='chapter_name' value='". $chapter_name ."' />";

	$text .= "<textarea rows='25' cols='80' name='chapter_text'>". $row['chapter_text']."</textarea>";
	$text .= "<tr><td class='forumheader3'>
						<input class='button' type='submit' name='DoStore' value='Save' />
						<input type='hidden' name='story_id' value='".$story_id."' />
						<input type='hidden' name='chapter_id' value='".$row['chapter_id']."' />
						</td></tr>";
	$text .= "</table></form>" . BackButton();
	
	$title = PADM_23.": " . $row['story_name'];
	$ns -> tablerender($title, $text);
	require_once(e_ADMIN."footer.php");
	exit;
}

// -------------------------------------------------------------------
// DoStory - display chapters. Option to add or edit one.
// -------------------------------------------------------------------
if ( $parms[0] == 'DoStory' )
{
	$sid = $parms[1];
	$text = "";
	$text .= "<div style='text-align: center;'>
				<form action=". e_SELF."?DoChapter.".$sid.".0 method=post>
				<input class='button' type='submit' name='EditStory' value='".PADM_24."' />";

	$text .= "<table  class='fborder' cellpadding=10><th class='fcaption'>".PADM_27."</th><th class='fcaption'>".PADM_28."</th><th class='fcaption'>".PADM_29."</th>";	
	$sql = new db();

	$sql->db_Select_Gen("SELECT story_id, story_name FROM #pw_stories where story_id = '" . $sid . "' ");
	if (!$row_s = $sql->db_Fetch())
	{	// no valid sid - bail out.
		header("location:" . e_SELF);
	}
	// how many chapters are there?
	$sql->db_Select_Gen("SELECT chapter_number FROM #pw_chapter where story_id='".$sid."' order by chapter_number desc limit 1");
	$row = $sql->db_Fetch();
	$Jumps = FALSE;
	$MaxChap = $row['chapter_number'];
	if ($MaxChap > 15)
	{	// we'll add quick jump links if there are more than 15 chapters
		$Jumps = TRUE;
	}
	
	// list all chapters:
	$sql->db_Select_Gen("SELECT story_id, chapter_id, chapter_number, chapter_name FROM #pw_chapter where story_id='".$sid."' order by chapter_number");
	while ($row = $sql->db_Fetch())
	{
		if ($Jumps && $row['chapter_number'] == '1' )
		{
			$text .= "<tr><td class='forumheader3' colspan=3><a href='#tablebottom'>
			<img src='".e_PLUGIN."/p_writer/images/down.png' alt='' border='0' />
			</a>".PADM_31."</td></tr>";
		}
		$text .= "<tr><td class='forumheader3' style='text-align: right;'>" . $row['chapter_number'] . "</td><td class='forumheader3'>" . $row['chapter_name'] . "</td>";

		$text .= "<td class='forumheader3' style='text-align: center;'><a href=" . e_SELF . "?DoChapter." . $row['story_id'] . "." . $row['chapter_number'] . "><img src=". e_IMAGE . "/admin_images/edit_16.png></a>";
		$LastChap = $row['chapter_number'];
		if ( $LastChap == $MaxChap )
		{
			$text .= "<a name='tablebottom'>";
		}
		$text .= "</td>";
	}

	if ($Jumps )
	{
		$text .= "<tr><td class='forumheader3' colspan=3><a href='#tabletop'>
		<img src='".e_PLUGIN."/p_writer/images/up.png' alt='' border='0' />
		</a>".PADM_32."</td></tr>";
	}

	$text .= "</table>";
	$text .= "<div style='text-align: center;'>
				<form action=". e_SELF."?DoChapter.".$sid.".0 method=post>
				<input class='button' type='submit' name='EditStory' value='".PADM_24."' />
				</form></div>";

	$title = PADM_23.": " . $row_s['story_name'] . "<a name='tabletop'>";
	$ns -> tablerender($title, $text);
	require_once(e_ADMIN."footer.php");
	exit;
}

// -------------------------------------------------------------------
// StoreData - save chapter contents.
// -------------------------------------------------------------------
if ($parms[0] == 'StoreData' )
{
	$chapter_name = $tp->toDB($_POST['chapter_name']);
	$chapter_text = $tp->toDB($_POST['chapter_text']);

	$sql = new db();
	if ( $_POST['chapter_id'] == 0 )
	{	// new - insert
		$sql->db_Insert("pw_chapter", "0, '".$_POST['story_id']. "', '" .$_POST['chapter_number']. "', '" .$chapter_name. "', '" .$chapter_text."'");
	}
	else
	{	// existing - update.
		$sql->db_Update("pw_chapter", "chapter_number='".$_POST['chapter_number']."', chapter_name='".$chapter_name."', chapter_text='".$chapter_text."' where chapter_id='" .$_POST['chapter_id'] . "'" );
	}
	// return to add/edit chapters:
	header("location: ".e_SELF."?DoStory.".$_POST['story_id']);
}

// -------------------------------------------------------------------
// UpdStory - update story-data
// -------------------------------------------------------------------
if ($parms[0] == 'UpdStory' )
{
	include "AddUpd_checks.php";

	if ( ! empty ($_POST['newgroup']) )
	{
		$group = $_POST['newgroup'];
	}
	else
	{
		$group = $_POST['storygroupspinner'];
	}

	$sql = new db();
	$sql->db_Update("pw_stories","
		story_name='".  $tp->toDB($_POST['newstory'])."',
		year_written='".$_POST['newyear']."',
		genre_id='".    $_POST['genrespinner']."',
		storygroup='".  $tp->toDB($group)."',
		imagelink='".   $tp->toDB($_POST['newimage'])."',
		hide='".        $_POST['hide']."'
		where story_id='" .$parms[1] . "'" );

	header ("location:".e_SELF);

}

// -------------------------------------------------------------------
// Mainline of the program.
// -------------------------------------------------------------------

$text = '';

// Are there genres lined up already? If not, inform user to first create at least 1 genre:
$sql = new db();

//$sql->db_select_gen("SELECT user_class FROM `".MPREFIX."user` WHERE `".MPREFIX."user`.`user_id` = '".$_POST['user_id']."'"); 
//$row = $sql->db_fetch(); 

$sql->db_Select_Gen("SELECT count(*) FROM #pw_genre ");
if (! $row = $sql->db_Fetch())
{
	$text .= PADM_08;
}

// parms[0] = ModDets: Prepare form for update
if ($parms[0] == "ModDet")
{
	$sql->db_Select_Gen("SELECT * FROM #pw_stories where story_id='". $parms[1] ."'");
	$row = $sql->db_Fetch();
	$text .= "<form action=". e_SELF."?UpdStory.".$parms[1]." method=post id='StoryEdit' enctype='multipart/form-data'>
				<table class='fborder'><tr><th  class='fcaption'colspan=2>".PADM_17."</th></tr>
				<tr><td class='forumheader3'>".PADM_06."</td><td class='forumheader3'><input type='text' size='40' maxlength='128' name='newstory' value='".$row['story_name']."' /></td></tr>
				<tr><td class='forumheader3'>".PADM_30."</td>
				<td class='forumheader3'><input type='text' size='4' maxlength='4' name='newyear' value='".$row['year_written']."' /></td></tr>
				<tr><td class='forumheader3'>".P_GNR_02."</td><td class='forumheader3'>";
				$ButtonText=PADM_17;
}
else // parms[0] = Not ModDets: Prepare form for Add
{
	$text .= "<form action=". e_SELF."?AddStory method=post id='StoryEdit' enctype='multipart/form-data'>
				<table class='fborder'><tr><th class='fcaption' colspan=2>".PADM_14."</th></tr>
				<tr><td class='forumheader3'>".PADM_06."</td><td class='forumheader3'><input type='text' size='40' maxlength='128' name='newstory' value='' /></td></tr>
				<tr><td class='forumheader3'>".PADM_30."</td>
				<td class='forumheader3'><input type='text' size='4' maxlength='4' name='newyear' value='".date('Y')."' /></td></tr>
				<tr><td class='forumheader3'>".P_GNR_02."</td><td class='forumheader3'>";
				$ButtonText=PADM_11;
}

// genre dropdown
$Genres .= GenreSpinner($row['genre_id']);
if (empty($Genres))
{
	$text .= PADM_07;
}
else
{
	$text .= $Genres;
}

// storygroup dropdown, in case we use storygroups
if ($pref['pw_use_groups'] == 1)
{
	$text .= "<tr><td class='forumheader3'>".PADM_09.":</td><td class='forumheader3'>";
	$SG_spinner .= StorygroupSpinner($row['storygroup']);
	if ( $SG_spinner <> "")
	{
		$text .= $SG_spinner;
		$text .= "<br />".PADM_13.":";
	}
	$text .= "<input type='text' size='32' maxlength='32' id='newgroup' name='newgroup' value='' />";

	$text .= "<br />Storygroup sequence number: <input type='text' size='4' maxlength='4' name='groupnumber' value='".$row['sort_order']."' />";
	$text .= "</td></tr>";
}
else
{
	$text .= "<input type='hidden' name='newgroup' value='' />";
}

$checked = "";
if ( $row['hide'] == '1')
{
	$checked=" checked ";
}

$text .= "<tr><td class='forumheader3'>Hide story:</td><td class='forumheader3'><input type='checkbox' name='hide' ".$checked ." value='1'><input type='hidden' name='newimage' value='' /></td></tr>";
//Choose a file: <input name='uploadedfile' type='file'/>
//$text .= "<tr>
//	<td class='forumheader3'>".PADM_12."</td>
//	<td class='forumheader3'><input type='text' size='40' maxlength='128' name='newimage' value='".$row['imagelink']."' />
//	</td></tr>";

$text .= "<tr><td class='forumheader3' colspan=2><input class='button' type='submit' name='EditStory' value='".$ButtonText."' />";

if ($parms[0] == "ModDet")
{
	$text .= BackButton(PCONS_03);
}
$text .= "</td></tr>";
$text .= "</td></tr></table><br />";

// build table to select a story for editting:
$text .= "<table  class='fborder' cellpadding=10>
	<th class='fcaption'>".PADM_06."</th>
	<th class='fcaption'>".PADM_04."</th>
	<th class='fcaption'>".PADM_16."</th>
	<th class='fcaption'>".PADM_05."</th>
	<th class='fcaption'>".PADM_25."</th>";

$sql = new db();
$sql1 = new db();

$sql->db_Select_Gen("SELECT story_id, story_name, storygroup, sort_order, hide FROM #pw_stories order by storygroup, sort_order ");
$t_group = "";

while ($row = $sql->db_Fetch())
{
	if ($t_group <> $row['storygroup'] && $pref['pw_use_groups']==1 )
	{
		$text .= "<tr><td class='forumheader3' style='background-color:lightgrey;' colspan=5><div style='margin-left:30px; padding:1px;'>".PADM_09.": ".$row['storygroup']."</div></td></tr>";
		$t_group = $row['storygroup'];
	}
	$text .= "<tr>
		<td class='forumheader3'>
		<a href='".e_PLUGIN."p_writer/p_writer.php?sid=".$row['story_id']."'>" . $row['story_name'] . "</a>
		</td>";

	// edit chapters
	$text .= "<td class='forumheader3' style='text-align: center;'><a href=" . e_SELF . "?DoStory." . $row['story_id'] . "><img src=". e_IMAGE . "/admin_images/edit_16.png></a></td>";

	// edit details
	$text .= "<td  class='forumheader3' style='text-align: center;'><a href=" . e_SELF . "?ModDet." . $row['story_id'] . "><img src=". e_IMAGE . "/admin_images/edit_16.png></a></td>";

	// delete story
	$text .= "
			<td  class='forumheader3' style='text-align: center;'>
			<a href=" . e_SELF . "?DelStory." . $row['story_id'] . ".cf>
			<img src=". e_IMAGE . "/admin_images/delete_16.png></a>
			</td>";

	$text .= "<td class='forumheader3' style='text-align:center;'>" . (($row['hide'] == 1)?"&#10008;":"") . "</td></tr>";
}

//$sql->db_Select_Gen("SELECT sort_order, hide FROM #pw_stories order by distinct storygroup, sort_order desc  ");
//	<input type='hidden' id='".$row['storygroup']."_".$row['sort_order']."' value='".$row['sort_order']. "'/>

$text .= "</table></form><br />";


$title=PADMENU_02;
$ns -> tablerender($title, $text);
require_once(e_ADMIN."footer.php");

// -------------------------------------------------------------------
// Function BackButton
// -------------------------------------------------------------------
function BackButton($text = NULL)
{
	if ($text == NULL)
	{
		$text = "Go Back";
	}
	$button = "	<form action=". e_SELF." method=post>
					<input class='button' type='submit' name='back' value='".$text."' />
					</form></div>";
	return $button;
}

// -------------------------------------------------------------------
// Function GenreSpinner
// -------------------------------------------------------------------
function GenreSpinner($Genre)
{
	$sql = new db();
	$sql->db_Select_Gen("SELECT * FROM #pw_genre ");
	$Spin = 0;
	$Spinner = '<select name="genrespinner">';
	while ($row = $sql->db_Fetch())
	{
		$selected = "";
		if ($row['genre_id'] == $Genre)
		{
			$selected = " selected='selected' ";
		}
		$Spinner .= "<option value='" . $row['genre_id'] . "'".$selected.">" . $row['genre_name'] . "</option>";
		$Spin = 1;
	}
	$Spinner .= "</select>";

	unset ($row);
	if ($Spin == 0)
	{
		$Spinner = "<b>".PADM_26."</b>";
	}
	return $Spinner;
}

// -------------------------------------------------------------------
// Function StorygroupSpinner
// -------------------------------------------------------------------
function StorygroupSpinner($Group)
{
	$sql = new db();
	$sql->db_Select_Gen("SELECT distinct(storygroup) FROM #pw_stories order by storygroup ");
	$Spin = 0;
	$Spinner = '<select name="storygroupspinner" id="storygroupspinner">';
	while ($row = $sql->db_Fetch())
	{
		$selected = "";
		if ($row['storygroup'] == $Group)
		{
			$selected = " selected='selected' ";
		}
		$Spinner .= "<option value='" . $row['storygroup']. "' " .$selected." >" . $row['storygroup'] . "</option>";
		$Spin = 1;
	}
	$Spinner .= "</select>";
	if ($Spin == 0)
	{
		$Spinner = "";
	}
	unset ($row);
	return $Spinner;
}

?>
