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
if (!defined('e107_INIT')) { exit(); }
require_once(HEADERF);
// Template path (relative to this script)
if (file_exists(THEME.'pw_template.php'))
{
	include_once(THEME.'pw_template.php');
}
else
{
	include_once(e_PLUGIN.'/p_writer/pw_template.php');
}
include_once(e_PLUGIN.'/p_writer/pw_shortcodes.php');
include_lan(e_PLUGIN.'/p_writer/languages/'.e_LANGUAGE.'.php');

global $pref;

//*************************************************************************
# Do we have a read request?
//*************************************************************************if ( isset
if ( isset($_GET['read']) )
{
	$read = explode(".", $_GET['read']); 

	// read now contains [0] = story-id, [1] = chapter-number to read
	// determine highest chapternumber of this story:
	$sql = new db();
	$sql->db_Select_Gen("select chapter_number from #pw_chapter where story_id = " . $read[0] . " order by chapter_number desc limit 1");
	$row1 = $sql->db_Fetch();

	// Someone trying to be funny by manually asking a chapter too high?
	if ($read[1] > $row1['chapter_number'])
	{
		header("Location:" . e_SELF);
		exit;
	}
	if (  $read[1] > 1 )
	{
		$txtleft = "<a href=" . e_SELF . "?read=" .$read[0] . '.' . ($read[1]-1) . ">".PCONS_04 ." ". ($read[1]-1) . "</a>";
	}

	if ( $read[1] == '1' && $row1['chapter_number'] == '1' )
	{
		$txtmiddle = "<a href=" . e_SELF . ">".PCONS_00."</a>";
	}
	else
	{
		$txtmiddle = "<a href=" . e_SELF . "?sid=" . $read[0] . ">".PCONS_05."</a>";
	}

	if ( $read[1] < $row1['chapter_number'] )
	{
		$txtright = "<a href=" . e_SELF . "?read=" .$read[0] . '.' . ($read[1]+1) . ">".PCONS_04." ".($read[1]+1) . "</a>";
	}
	$contents = ShowChapter ($read[0], $read[1]);
	if ( $contents[0] == "error")
	{	// Non existent chapter requested
		header("location:" . e_SELF);
	}

	// Is story 1 chapter long?
	if ( $row1['chapter_number'] == '1')
	{	// only show contents
		cachevars('pw_read_chapter', "<br><br>" . $contents[2] );
	}
	else
	{	// show chaptername and contents
		cachevars('pw_read_chapter', $read[1] . ". " . $contents[1] . "<br><br>" . $contents[2] );
	}
	$text .= $tp->parseTemplate( $PW_READ_CHAPTER, FALSE, $pw_shortcodes);
	cachevars('pw_read_previouschapter', $txtleft );
	cachevars('pw_read_allchapters', $txtmiddle);
	cachevars('pw_read_nextchapter', $txtright);
	$text .= $tp->parseTemplate( $PW_CHAPTER_NAVIGATE, FALSE, $pw_shortcodes);

	if (getperms('P'))
	{
		$text .= "<div style='text-align:right;'><a href='".e_PLUGIN."p_writer/admin_pwconf.php?DoChapter.".$read[0].".".$read[1]."'><img src='".e_PLUGIN."/p_writer/images/view.png' alt='' border='0' /></a></div>";
	}


	$title = $contents[0];  // Story-name
	$ns -> tablerender($title, $text);

	// === End of BODY ===
	// use FOOTERF for USER PAGES and e_ADMIN.'footer.php' for admin pages
	require_once(FOOTERF);
	exit;
}

//*************************************************************************
# Show chapters. Do we have a story-id (sid)?
//*************************************************************************
if ( isset($_GET['sid']) )
{
	$sid = $_GET['sid'];

	// Is this a valid SID / Story ID?
	$sql = new db();
	$sql->db_Select_Gen("SELECT chapter_number FROM #pw_chapter WHERE story_id = " . $sid . " LIMIT 1");
	if (! $row1 = $sql->db_Fetch()) 
	{
		// No valid SID, return to overview of stories:
		header ("location: " . e_SELF );
	}

	// show overview of chapters. If only 1 chapter, show chapter.
	$sql->db_Select_Gen("select chapter_number from #pw_chapter where story_id = " . $sid . " order by chapter_number desc limit 1");
	$row1 = $sql->db_Fetch();

	if ($row1['chapter_number'] == 1)
	{
		// we have only 1 chapter, immediately show the chapter.
		header('location:' . e_SELF . '?read=' . $sid . '.1');
	}

	$SingleChapter = 1;
	// If nr-chapters is 2, or auto-double threshold reached on max chapters:
	if ($pref['pw_nr_chapters'] == 2 || $pref['pw_auto_double'] <= $row1['chapter_number'])
	{
		$SingleChapter = 0;
	}
	// we have more chapters: show chapter overview
	$sql->db_Select_Gen("select ps.story_id as story_id, story_name,
								chapter_number, chapter_name
								from #pw_chapter as pc 
								join #pw_stories   as ps on ps.story_id = pc.story_id 
								where ps.story_id = " . $sid . " order by chapter_number");

	$text .= $tp->parseTemplate( $PW_TABLEINIT, FALSE, $pw_shortcodes);
	$text .= $tp->parseTemplate( $PW_HDR_CHAPTER_OVERV, FALSE, $pw_shortcodes);
	$TitleAdded = 0;
	while ( $row = $sql->db_Fetch() )
	{
		if ( $TitleAdded == 0)
		{
			cachevars('pw_story_name', $row['story_name'] );
			$text .= $tp->parseTemplate( $PW_CHAPTER_HDR, FALSE, $pw_shortcodes);
			$TitleAdded = 1;
		}
		cachevars('pw_chapter_number', $row['chapter_number'].". " );
		cachevars('pw_story_id', $row['story_id'] );
		cachevars('pw_chapter_name', $row['chapter_name'] );
		if ($SingleChapter == 1)
		{
			$text .= $tp->parseTemplate( $PW_CHAPTER_LINE_1, FALSE, $pw_shortcodes);
		}
		else
		{
			if ($row = $sql->db_Fetch())
			{
				cachevars('pw_chapter_number2', $row['chapter_number'].". " );
				cachevars('pw_story2_id', $row['story_id'] );
				cachevars('pw_chapter_name2', $row['chapter_name'] );
			}
			else
			{	// clear vars to previous chapter does not repeat.
				cachevars('pw_chapter_number2', '' );
				cachevars('pw_story2_id', '' );
				cachevars('pw_chapter_name2', '' );
			}
			$text .= $tp->parseTemplate( $PW_CHAPTER_LINE_2, FALSE, $pw_shortcodes);
		}
	}

	$text .= $tp->parseTemplate( $PW_BOT, FALSE, $pw_shortcodes);

	// return to overview line
	cachevars('pw_return_overview', PCONS_00);
	$text .= $tp->parseTemplate( $PW_RETURN_OVERVIEW, FALSE, $pw_shortcodes);
	if (getperms('P'))
	{
		$text .= "<div style='text-align:right;'><a href='".e_PLUGIN."p_writer/admin_pwconf.php?DoStory.".$sid."'><img src='".e_PLUGIN."/p_writer/images/view.png' alt='' border='0' /></a></div>";
	}

	$title = $contents[0];  // Story-name

	$ns -> tablerender($title, $text);
	// === End of BODY ===
	// use FOOTERF for USER PAGES and e_ADMIN.'footer.php' for admin pages
	require_once(FOOTERF);
	exit;
}

#################
# M A I N L I N E 
#################
# Select the p_writer_story_names table and display all stories that aren't 'hidden':

$sql = new db();
$sql->db_Select_Gen("SELECT * FROM #pw_stories AS ps
							JOIN #pw_genre AS pg on ps.genre_id = pg.genre_id
							where ps.hide='0'
							order by ps.storygroup, ps.sort_order ");

$text2 = $tp->parseTemplate( $PW_TABLEINIT, FALSE, $pw_shortcodes);
$text2 .= $tp->parseTemplate( $PW_HDR_STORY_OVERV, FALSE, $pw_shortcodes);
$o_storygroup = "";

while ($row = $sql->db_Fetch())
{
	if ( $o_storygroup <> $row['storygroup'] && $pref['pw_use_groups'] == 1)
	{
		$o_storygroup = $row['storygroup'];
		cachevars('pw_storygroup', $row['storygroup'] );
		$text2 .= $tp->parseTemplate( $PW_STORYGROUP, FALSE, $pw_shortcodes);
	}

	cachevars('pw_story_id', $row['story_id'] );
	cachevars('pw_story_name', $row['story_name'] );
	cachevars('pw_genre_name', $row['genre_name'] );
	if ( ! empty ($row['year_written']) )
	{
		cachevars('pw_year_written', $row['year_written'] );
	}
	else
	{
		cachevars('pw_year_written', '' );
	}
	$text2 .= $tp->parseTemplate( $PW_STORYROW, FALSE, $pw_shortcodes);
}

$text2 .= $tp->parseTemplate( $PW_BOT, FALSE, $pw_shortcodes);

if (getperms('P'))
{
	$text2 .= "<div style='text-align:right;'><a href='".e_PLUGIN."p_writer/admin_pwconf.php'><img src='".e_PLUGIN."/p_writer/images/view.png' alt='' border='0' /></a></div>";
}
// Parse the template to put the values eg. {MYSHORTCODE}, into the HTML.

$text2 .= "**".USERID."**";
if (USER)
{ $text2.="Bekende user"; }

// Render the value of $text in a table.
$title = PCONS_01;
$ns -> tablerender($title, $text2);

// === End of BODY ===
// use FOOTERF for USER PAGES and e_ADMIN.'footer.php' for admin pages
require_once(FOOTERF);


// Functions //
#####################################
function ShowChapter($storyid, $chapter_number)
#####################################
{
	$sql = new db();
	$sql->db_Select_Gen("SELECT * FROM #pw_chapter AS pc JOIN #pw_stories AS ps ON ps.story_id = pc.story_id WHERE ps.story_id = '" . $storyid . "' AND chapter_number='" . $chapter_number . "' LIMIT 1");
	if ( $row = $sql->db_Fetch() )
	{
		// $contents: Storyname, chaptername, chapter contents	
		$contents=array($row['story_name'], $row['chapter_name'], '');
		$contents[2] = str_replace("\n", "<br \>", $row['chapter_text'] );
	}
	else
	{
		$contents[0] = "error";
	}
	return $contents;
}

?>
