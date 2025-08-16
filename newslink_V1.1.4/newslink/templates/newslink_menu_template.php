<?php

if (!defined('e107_INIT'))
{
    exit;
}
// *
// * Newslinks menu
// *
// *
if (!isset($NEWSLINK_MENU_HEAD))
{
    $NEWSLINK_MENU_HEAD = NEWSLINK_51 . " {NEWSLINK_MENU_COUNT} " . NEWSLINK_52 . " " . NEWSLINK_53 . " {NEWSLINK_MENU_CATCOUNT} " . NEWSLINK_54 . " " . NEWSLINK_55;
}
if (!isset($NEWSLINK_MENU_DETAIL))
{
    // The main heading for the newslink list
    // displayed second
    $NEWSLINK_MENU_DETAIL = "
 		<br /><br />{NEWSLINK_MENU_BULLET} <span class='smalltext'><strong>{NEWSLINK_MENU_URL}</strong></span>
		<br /><span class='smallblacktext'>{NEWSLINK_MENU_BODY}</span>
		<br /><span class='smalltext'>" . NEWSLINK_116 . ": {NEWSLINK_MENU_CATNAME}</span>
		<br /><span class='smalltext'><em>" . NEWSLINK_117 . ": {NEWSLINK_MENU_POSTERNAME} " . NEWSLINK_57 . "{NEWSLINK_MENU_POSTED}</em></span>";
}
// *
// * Newslinks random menu
// *
// *

if (!isset($NEWSLINK_RANDOM))
{
    // The main heading for the newslink list
    // displayed second
    $NEWSLINK_RANDOM =  "	<div style='text-align:center;'>".NEWSLINK_128 . "
		<br /><span class='smalltext'>{NEWSLINK_MENU_BULLET} <strong>{NEWSLINK_MENU_URL}</strong></span><br />
		<br /><span class='smallblacktext'>{NEWSLINK_MENU_BODY}</span>
		<br /><span class='smalltext'>" . NEWSLINK_116 . ": {NEWSLINK_MENU_CATNAME}</span>
		<br /><span class='smalltext'><em>" . NEWSLINK_117 . ": {NEWSLINK_MENU_POSTERNAME} " . NEWSLINK_57 . "{NEWSLINK_MENU_POSTED}</em></span>
	</div>";
}

?>