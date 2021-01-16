<?php
/*
   +---------------------------------------------------------------+
   |        Enhanced Custom Pages for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2009
   |
   |        Released under the terms and conditions of the
   |        GNU General Public License (http://gnu.org).
   |
   +---------------------------------------------------------------+
*/
global $PLUGINS_DIRECTORY,$sql,$id,$nid;
if (!defined('e107_INIT'))
{
    exit;
}
if (!is_object($cpage_obj)) {
	require_once(e_PLUGIN."cpage/includes/cpage_class.php");
	$cpage_obj = new cpage;
}
$cpage_obj->clear_cache();
// get the page title for the url
$sql->db_Select('cpage_page','cpage_link,cpage_id,cpage_title',"where cpage_id={$nid}",'nowhere',false);
extract($sql->db_Fetch());
#die("$nid");
// This is set to the table name you have decided to use.
$e_comment['eplug_comment_ids'] = "cpage";
// This is set to the location you'd like the user to return to after replying to a comment.

#$e_comment['reply_location'] = e_PLUGIN . "cpage/index.php?{NID}";
$e_comment['reply_location'] = e_BASE.$cpage_obj->make_url($cpage_link,'{NID}',0,$cpage_title);
// A name for your plugin. It will be used in links to comments, in list_new/new.php.
$e_comment['plugin_name'] = "cpage";
// The path of the plugin folder
$e_comment['plugin_path'] = "cpage";
// This is the name of the field in your plugin's db table that corresponds to it's name or title.
$e_comment['db_title'] = "cpage_title";
// This is the name of the field in your plugin's db table that correspond to it's unique id number.
$e_comment['db_id'] = "cpage_id";
// qry must be set with a select_gen query.
// the main reason would be to check if a category from another table has a class restriction
// the id of the item should be provided as {NID}
// returned fields should at least contain the 'link_id' and 'db_id' fields set above
$e_comment['qry'] = "
SELECT *
FROM #cpage_page
WHERE  cpage_id='{NID}' ";

?>