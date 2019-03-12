<?php
//============================= Notice-Board v4.0 ===============================
//	author: ComPolyS team, http://e107.compolys.ru, sunout@compolys.ru		
//	coders: Sunout, Geo						
//	language officer Georgy Pyankov
//	license GNU GPL									
//================================== Deсember 2011 =============================
if (!defined('e107_INIT')) { exit; }

$e_plug_table	= "nboard"; //This is set to the table name you have decided to use.
$reply_location	= e_PLUGIN."nboard/nboard.php?view{NID}"; //This is set to the location you'd like the user to return to after replying to a comment.
$db_table	= "nb_gnl"; //This is the name of your plugins database table.
$link_name	= "gnl_name"; //This is the name of the field in your plugin's db table that corresponds to it's name or title.
$db_id		= "gnl_id"; // This is the name of the field in your plugin's db table that correspond to it's unique id number.
$plugin_name	= "nboard"; // A name for your plugin. It will be used in links to comments, in list_new/new.php.

/*
$e_comment['eplug_comment_ids'] = "pnboard"; //This is set to the table name you have decided to use.
$e_comment['plugin_path'] = "nboard"; //The path of your plugin.
$e_comment['plugin_name'] = "nboard"; //A name for your plugin. It will be used in links to comments, in list_new/new.php.
//This is set to the location you'd like the user to return to after replying to a comment.
$e_comment['reply_location'] = e_PLUGIN_ABS."nboard/nboard.php?{NID}"; 
$e_comment['db_title'] = "nboard_heading"; //This is the name of the field in your plugin's db table that corresponds to it's name or title.
$e_comment['db_id'] = "nboard_id"; // This is the name of the field in your plugin's db table that correspond to it's unique id number.

//qry must be set with a select_gen query.
//the main reason would be to check if a category from another table has a class restriction
//the id of the item should be provided as {NID}
//returned fields should at least contain the 'link_id' and 'db_id' fields set above
$e_comment['qry']				= "
SELECT c.*
FROM #pnboard as c
WHERE c.nboard_id='{NID}' AND c.nboard_refer !='sa' AND c.nboard_datestamp < ".time()." AND (c.nboard_enddate=0 || c.nboard_enddate>".time().") AND c.nboard_class REGEXP '".e_CLASS_REGEXP."' ";
*/
?>