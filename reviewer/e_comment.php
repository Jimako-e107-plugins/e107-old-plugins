<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
// This is set to the table name you have decided to use.
$e_comment['eplug_comment_ids'] = "reviewer";
// This is set to the location you'd like the user to return to after replying to a comment.
$e_comment['reply_location'] = e_PLUGIN . "reviewer/reviewer.php?0.view.{NID}";
// A name for your plugin. It will be used in links to comments, in list_new/new.php.
$e_comment['plugin_name'] = "reviewer";
// The path of the plugin folder
$e_comment['plugin_path'] = "reviewer";
// This is the name of the field in your plugin's db table that corresponds to it's name or title.
$e_comment['db_title'] = "reviewer_reviewer_review";
// This is the name of the field in your plugin's db table that correspond to it's unique id number.
$e_comment['db_id'] = "reviewer_reviewer_id";
// qry must be set with a select_gen query.
// the main reason would be to check if a category from another table has a class restriction
// the id of the item should be provided as {NID}
// returned fields should at least contain the 'link_id' and 'db_id' fields set above
$e_comment['qry'] = "
SELECT reviewer_reviewer_id,reviewer_reviewer_review
FROM #reviewer_reviewer left join reviewer_items on reviewer_reviewer_itemid=reviewer_items_id
where  reviewer_reviewer_id='{NID}'";

?>