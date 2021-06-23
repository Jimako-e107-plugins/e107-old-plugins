<?php 
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
global $tp;
$pw_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
/*
// ------------------------------------------------

SC_BEGIN PW_STORY_ID
	$item = getcachedvars('pw_story_id');
	return $item;
SC_END
SC_BEGIN PW_STORY2_ID
	$item = getcachedvars('pw_story2_id');
	return $item;
SC_END
SC_BEGIN PW_STORYGROUP
	$item = getcachedvars('pw_storygroup');
	return $item;
SC_END
SC_BEGIN PW_STORY_NAME
	$item = getcachedvars('pw_story_name');
	return $item;
SC_END
SC_BEGIN PW_YEAR_WRITTEN
	$item = getcachedvars('pw_year_written');
	return $item;
SC_END
SC_BEGIN PW_GENRE_NAME
	$item = getcachedvars('pw_genre_name');
	return $item;
SC_END
SC_BEGIN PW_CHAPTER_NUMBER
	$item = getcachedvars('pw_chapter_number');
	return $item;
SC_END
SC_BEGIN PW_CHAPTER_NUMBER2
	$item = getcachedvars('pw_chapter_number2');
	return $item;
SC_END
SC_BEGIN PW_CHAPTER_NAME
	$item = getcachedvars('pw_chapter_name');
	return $item;
SC_END
SC_BEGIN PW_CHAPTER_NAME2
	$item = getcachedvars('pw_chapter_name2');
	return $item;
SC_END
SC_BEGIN PW_RETURN_OVERVIEW
	$item = getcachedvars('pw_return_overview');
	return $item;
SC_END
SC_BEGIN PW_READ_CHAPTER
	$item = getcachedvars('pw_read_chapter');
	return $item;
SC_END
SC_BEGIN PW_READ_PREVIOUSCHAPTER
	$item = getcachedvars('pw_read_previouschapter' );
	return $item;
SC_END
SC_BEGIN PW_READ_ALLCHAPTER
	$item = getcachedvars('pw_read_allchapters');
	return $item;
SC_END
SC_BEGIN PW_READ_NEXTCHAPTER
	$item = getcachedvars('pw_read_nextchapter');
	return $item;
SC_END

*/

?>
