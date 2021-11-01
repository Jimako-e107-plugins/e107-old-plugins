<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/other_news_menu/other_news2_menu.php $
|     $Revision: 11678 $
|     $Id: other_news2_menu.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

global $e107cache;

// Load Data
if($cacheData = $e107cache->retrieve("nq_othernews2"))
{
	echo $cacheData;
	return;
}


require_once(e_HANDLER."news_class.php");
unset($text);
global $OTHERNEWS2_STYLE;
$ix = new news;

if(!$OTHERNEWS2_STYLE) {
	$OTHERNEWS2_STYLE = "
	<table class='forumheader3' cellpadding='0' cellspacing='0' style='width:100%'>
	<tr><td class='caption2' colspan='2' style='padding:3px;text-decoration:none;'>
	{NEWSCATICON}
	{NEWSCATEGORY}
	</td></tr>
	<tr><td  style='padding:3px;vertical-align:top'>
	{NEWSTITLELINK}
	<br />
	{NEWSSUMMARY}
	</td>
	<td style='padding:3px'>
	{NEWSTHUMBNAIL}
	</td>
	</tr>
	</table>
	";
}

if(!defined("OTHERNEWS2_LIMIT")){
	define("OTHERNEWS2_LIMIT",5);
}

if(!defined("OTHERNEWS2_ITEMLINK")){
	define("OTHERNEWS2_ITEMLINK","");
}
if(!defined("OTHERNEWS2_CATLINK")){
	define("OTHERNEWS2_CATLINK","");
}
if(!defined("OTHERNEWS2_CATICON")){
	define("OTHERNEWS2_CATICON","border:0px");
}
if(!defined("OTHERNEWS2_THUMB")){
	define("OTHERNEWS2_THUMB","border:0px");
}

if(!defined("OTHERNEWS2_COLS")){
	define("OTHERNEWS2_COLS","1");
}

if(!defined("OTHERNEWS2_CELL")){
	define("OTHERNEWS2_CELL","padding:0px;vertical-align:top");
}

if(!defined("OTHERNEWS2_SPACING")){
	define("OTHERNEWS2_SPACING","0");
}

$param['itemlink'] = OTHERNEWS2_ITEMLINK;
$param['thumbnail'] = OTHERNEWS2_THUMB;
$param['catlink'] = OTHERNEWS2_CATLINK;
$param['caticon'] = OTHERNEWS2_CATICON;

$style = OTHERNEWS2_CELL;
$nbr_cols = OTHERNEWS2_COLS;
$GLOBALS['NEWS_CSSMODE'] = "othernews2";  

$query = "SELECT n.*, u.user_id, u.user_name, u.user_customtitle, nc.category_name, nc.category_icon FROM #news AS n
LEFT JOIN #user AS u ON n.news_author = u.user_id
LEFT JOIN #news_category AS nc ON n.news_category = nc.category_id
WHERE n.news_class IN (".USERCLASS_LIST.") AND n.news_start < ".time()." AND (n.news_end=0 || n.news_end>".time().") AND n.news_render_type=3  ORDER BY n.news_datestamp DESC LIMIT 0,".OTHERNEWS2_LIMIT;

if ($sql->db_Select_gen($query)) {
	$text = "<table style='width:100%' cellpadding='0' cellspacing='".OTHERNEWS2_SPACING."'>";
	$t = 0;
	$wid = floor(100/$nbr_cols);
	while ($row = $sql->db_Fetch()) {
		$text .= ($t % $nbr_cols == 0) ? "<tr>" : "";
		$text .= "\n<td style='$style ; width:$wid%;'>\n";

		$text .= $ix->render_newsitem($row, 'return', '', $OTHERNEWS2_STYLE, $param);

		$text .= "\n</td>\n";
		if (($t+1) % $nbr_cols == 0) {
			$text .= "</tr>";
			$t++;
		}
		else {
			$t++;
		}
	}

	while ($t % $nbr_cols != 0){
		$text .= "<td style='width:$wid'>&nbsp;</td>\n";
		$text .= (($t+1) % $nbr_cols == 0) ? "</tr>" : "";
		$t++;

	}
	$text .= "</table>";


	// Save Data
	ob_start();

	$ns->tablerender(TD_MENU_L2, $text, 'other_news2');

	$cache_data = ob_get_flush();
	$e107cache->set("nq_othernews2", $cache_data);

}

?>