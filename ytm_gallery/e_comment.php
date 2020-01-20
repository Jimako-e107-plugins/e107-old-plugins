<?php
/*
+---------------------------------------------------------------+
|        YouTube Gallery v4.01 - by Erich Radstake
|        http://www.erichradstake.nl
|        info@erichradstake.nl
|
|        This is a module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

//This is set to the table name you have decided to use.
$e_comment['eplug_comment_ids'] = "er_ytm_gallery_movies";

//This is set to the location you'd like the user to return to after replying to a comment.
$e_comment['reply_location'] = e_PLUGIN."ytm_gallery/ytm.php?view=.{NID}";

//A name for your plugin. It will be used in links to comments, in list_new/new.php.
$e_comment['plugin_name'] = "ytm_gallery";

//The path of the plugin folder
$e_comment['plugin_path'] = "ytm_gallery";

//This is the name of the field in your plugin's db table that corresponds to it's name or title.
$e_comment['db_title'] = "movie_title";

//This is the name of the field in your plugin's db table that correspond to it's unique id number.
$e_comment['db_id'] = "movie_id";
?>
