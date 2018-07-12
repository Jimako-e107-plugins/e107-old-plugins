<?php

if (!defined('e107_INIT')) { exit; }

$e_plug_table	= "my_gallery"; //This is set to the table name you have decided to use.
$reply_location	= e_PLUGIN."my_gallery/my_gallery.php?comm_id=$nid"; //This is set to the location you'd like the user to return to after replying to a comment.
$db_table		= "my_gallery"; //This is the name of your plugins database table.
$link_name		= "img_title"; //This is the name of the field in your plugin's db table that corresponds to it's name or title.
$db_id			= "img_id"; // This is the name of the field in your plugin's db table that correspond to it's unique id number.
$plugin_name	= "my_gallery"; // A name for your plugin. It will be used in links to comments, in list_new/new.php.


//This is set to the table name you have decided to use.
$e_comment['eplug_comment_ids'] = "my_gallery";

//This is set to the location you'd like the user to return to after replying to a comment.
$e_comment['reply_location'] = e_PLUGIN."my_gallery/my_gallery.php?comm_id={NID}";

//A name for your plugin. It will be used in links to comments, in list_new/new.php.
$e_comment['plugin_name'] = "my_gallery";

//The path of the plugin folder
$e_comment['plugin_path'] = "my_gallery";

//This is the name of the field in your plugin's db table that corresponds to it's name or title.
$e_comment['db_title'] = "img_name";

//This is the name of the field in your plugin's db table that correspond to it's unique id number.
$e_comment['db_id'] = "img_id";

//qry must be set with a select_gen query.
//the main reason would be to check if a category from another table has a class restriction
//the id of the item should be provided as {NID}
//returned fields should at least contain the 'link_id' and 'db_id' fields set above
$e_comment['qry'] = "
SELECT *
FROM my_gallery
WHERE img_id='{NID}' ";

?>