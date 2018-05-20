<?php
/**
* e_comment.php
*
* When a plugin allows comments to be posted,
* e107 needs to be told some information about the comments to allow,
* for example, the "Reply to" feature to function correctly
*
*/
if (!defined('e107_INIT')) { exit; }
require_once(e_PLUGIN."ebattles/include/main.php");

/*
$e_plug_table = "ebmatches"; //This is set to the table name you have decided to use.
$reply_location= e_PLUGIN."ebattles/matchinfo.php?matchid={NID}"; //This is set to the location you'd like the user to return to after replying to a comment.
$db_table = TBL_MATCHS_SHORT; //This is the name of your plugins database table.
$link_name = "MatchID"; //This is the name of the field in your plugin's db table that corresponds to it's name or title.
$db_id = "MatchID"; // This is the name of the field in your plugin's db table that correspond to it's unique id number.
$plugin_name = EB_L1; // A name for your plugin. It will be used in links to comments, in list_new/new.php.
*/

$e_comment['eplug_comment_ids'] = "ebmatches"; //TBL_MATCHS_SHORT; //This is set to the table name you have decided to use.
$e_comment['plugin_path'] = "ebattles"; //The path of your plugin
$e_comment['plugin_name'] = EB_L1; //A name for your plugin. It will be used in links to comments, in list_new/new.php.

//This is set to the location you'd like the user to return to after replying to a comment. NID will be replaced by your unique id
$e_comment['reply_location'] = e_PLUGIN."ebattles/matchinfo.php?matchid={NID}"; 
$e_comment['db_title'] = "Name"; // This is the name of the field in your plugin's db table that corresponds to it's name or title
$e_comment['db_id']    = "MatchID"; // This is the name of the field in your plugin's db table that correspond to it's unique id number.

//qry must be set with a select_gen query.
//the main reason would be to check if a category from another table has a class restriction
//the id of the item should be provided as {NID}
//returned fields should at least contain the 'link_id' and 'db_id' fields set above
$e_comment['qry'] = "
SELECT m.*, e.*
FROM #".TBL_MATCHS_SHORT." as m
LEFT JOIN #".TBL_EVENTS_SHORT." as e ON m.Event = e.EventID
WHERE m.MatchID='{NID}'";

?>