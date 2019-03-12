<?php

if (!defined('e107_INIT')) { exit; }
/*
$e_plug_table = "links_page"; //This is set to the table name you have decided to use.
$reply_location= e_PLUGIN."links_page/links.php?comment.$nid"; //This is set to the location you'd like the user to return to after replying to a comment.
$db_table = "links_page"; //This is the name of your plugins database table.
$link_name = "link_name"; //This is the name of the field in your plugin's db table that corresponds to it's name or title.
$db_id = "link_id"; // This is the name of the field in your plugin's db table that correspond to it's unique id number.
$plugin_name = "Links"; // A name for your plugin. It will be used in links to comments, in list_new/new.php.
*/
include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
//This is set to the table name you have decided to use.
$e_comment['eplug_comment_ids'] = "cwbook";

//This is set to the location you'd like the user to return to after replying to a comment.
$e_comment['reply_location'] = e_PLUGIN."creative_writer/cwriter.php?0.precis.{NID}";

//A name for your plugin. It will be used in links to comments, in list_new/new.php.
$e_comment['plugin_name'] = CWRITER_A1;

//The path of the plugin folder
$e_comment['plugin_path'] = "creative_writer";

//This is the name of the field in your plugin's db table that corresponds to it's name or title.
$e_comment['db_title'] = "cw_book_title";

//This is the name of the field in your plugin's db table that correspond to it's unique id number.
$e_comment['db_id'] = "cw_book_id";

//qry must be set with a select_gen query.
//the main reason would be to check if a category from another table has a class restriction
//the id of the item should be provided as {NID}
//returned fields should at least contain the 'link_id' and 'db_id' fields set above
$e_comment['qry'] = "
SELECT *
FROM #cw_book
WHERE cw_book_id='{NID}' AND cw_book_visible > 0 and cw_book_approved > 0 ";

?>