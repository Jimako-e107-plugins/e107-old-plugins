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
// check called correctly
if (!defined('e107_INIT')) { exit; }
// get the language file for your plugin
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");
// THe title of the plugin to be displayed in the main admin search page
$comments_title = 'Reviewer';
// the id that is used to identify comments for this plugin in the e107_comments table
$comments_type_id = 'reviewer';
// fields to be returned from the search for this plugin
$comments_return['reviewer'] = "p.reviewer_reviewer_id, p.reviewer_reviewer_review,p.reviewer_reviewer_itemid";
// a join from the comments table to your table in order that the search query can identify and return
// both the comment and the record in your plugin to which it refers
$comments_table['reviewer'] = "LEFT JOIN #reviewer_reviewer AS p ON c.comment_type='reviewer' AND p.reviewer_reviewer_id = c.comment_item_id";
// function to handle the results which are then displayed - see the name has com_search_ prefixing the plugin dname
function com_search_reviewer($row) {
	global $con;
	// convert the comments datestamp
	$datestamp = $con -> convert_date($row['comment_datestamp'], "long");
	// link to the plugins record that has the comment made on it
	$res['link'] = e_PLUGIN."reviewer/reviewer.php?0.view.".$row['reviewer_reviewer_id'];
	// pre title for example "comment found in -"
	$res['pre_title'] = REVIEWER_S03.': ';
	// the title or name of the plugin record
	$res['title'] = $row['reviewer_reviewer_review'];
	// the contents of the comment
	$res['summary'] = $row['comment_comment'];
	// get the user name for the commentator
	preg_match("/([0-9]+)\.(.*)/", $row['comment_author'], $user);
	// detailed information to be passedback, in this case a link to membership details of the commentator
	$res['detail'] = LAN_SEARCH_7."<a href='user.php?id.".$user[1]."'>".$user[2]."</a>".LAN_SEARCH_8.$datestamp;
	return $res;
}
?>