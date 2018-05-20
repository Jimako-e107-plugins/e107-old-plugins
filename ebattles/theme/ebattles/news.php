<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     �Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.7/news.php,v $
|     $Revision: 1.92 $
|     $Date: 2006/01/31 04:55:00 $
|     $Author: qnome $
+----------------------------------------------------------------------------+
*/
require_once("class2.php");
require_once(e_HANDLER."news_class.php");
require_once(e_HANDLER."comment_class.php");
$cobj = new comment;

if (isset($NEWSHEADER)) {
	require_once(HEADERF);
	require_once(FOOTERF);
	exit;
}
$cacheString = 'news.php_'.e_QUERY;
$action = '';
if (!defined("ITEMVIEW")){
	if ($pref['newsposts']==""){
		define("ITEMVIEW", 15);
	} else {
		define("ITEMVIEW", $pref['newsposts']);
	}
}
if(ADMIN && file_exists("install.php")){ echo "<div class='installe' style='text-align:center'><b>*** ".LAN_NEWS_3." ***</b><br />".LAN_NEWS_4."</div><br /><br />"; }

if (e_QUERY) {
	$tmp = explode(".", e_QUERY);
	$action = $tmp[0];
	$sub_action = $tmp[1];
	$id = $tmp[2];
}

$from = (!is_numeric($action) || !e_QUERY ? 0 : ($action ? $action : e_QUERY));
if (isset($tmp[1]) && $tmp[1] == 'list') {
	$action = 'list';
	$from = intval($tmp[0]);
	$sub_action = intval($tmp[2]);
}
if ($action == 'all' || $action == 'cat') {
	$from = intval($tmp[2]);
	$sub_action = intval($tmp[1]);
}

$ix = new news;
if ($action == 'cat' || $action == 'all'){

	// --> Cache
	if($tmp = checkCache($cacheString)){
		require_once(HEADERF);
		renderCache($tmp, TRUE);
	}
	// <-- Cache

	$qs = explode(".", e_QUERY);

	$category = intval($qs[1]);
	if ($action == 'cat' && $category != 0)	{
		$gen = new convert;
		$sql->db_Select("news_category", "*", "category_id='$category'");
		$row = $sql->db_Fetch();
		extract($row);  // still required for the table-render.  :(
	}
	if ($action == 'all'){
		if(!defined("NEWSALL_LIMIT")){ define("NEWSALL_LIMIT",10); }
		// show archive of all news items using list-style template.
		$news_total = $sql->db_Count("news", "(*)", "WHERE news_class REGEXP '".e_CLASS_REGEXP."'");
		$query = "SELECT n.*, u.user_id, u.user_name, u.user_customtitle, nc.category_name, nc.category_icon FROM #news AS n
		LEFT JOIN #user AS u ON n.news_author = u.user_id
		LEFT JOIN #news_category AS nc ON n.news_category = nc.category_id
		WHERE n.news_class REGEXP '".e_CLASS_REGEXP."' AND n.news_start < ".time()." AND (n.news_end=0 || n.news_end>".time().")  ORDER BY n.news_datestamp DESC LIMIT ".intval($from).",".NEWSALL_LIMIT;
		$category_name = "All";
	}
	elseif ($action == 'cat'){
		// show archive of all news items in a particular category using list-style template.
		$news_total = $sql->db_Count("news", "(*)", "WHERE news_class REGEXP '".e_CLASS_REGEXP."' AND news_start < ".time()." AND (news_end=0 || news_end>".time().") AND news_category=".intval($sub_action));
		if(!defined("NEWSLIST_LIMIT")){ define("NEWSLIST_LIMIT",10); }
		$query = "SELECT n.*, u.user_id, u.user_name, u.user_customtitle, nc.category_name, nc.category_icon FROM #news AS n
		LEFT JOIN #user AS u ON n.news_author = u.user_id
		LEFT JOIN #news_category AS nc ON n.news_category = nc.category_id
		WHERE n.news_class REGEXP '".e_CLASS_REGEXP."' AND n.news_start < ".time()." AND (n.news_end=0 || n.news_end>".time().") AND n.news_category=".intval($sub_action)." ORDER BY n.news_datestamp DESC LIMIT ".intval($from).",".NEWSLIST_LIMIT;
	}

	if($category_name){
		define("e_PAGETITLE", $category_name);
	}

	require_once(HEADERF);

	if(!$NEWSLISTSTYLE){
		$NEWSLISTSTYLE = "
		<div style='padding:3px;width:100%'>
		<table style='border-bottom:1px solid black;width:100%' cellpadding='0' cellspacing='0'>
		<tr>
		<td style='vertical-align:top;padding:3px;width:20px'>
		{NEWSCATICON}
		</td><td style='text-align:left;padding:3px'>
		{NEWSTITLELINK}
		<br />
		{NEWSSUMMARY}
		<span class='smalltext'>
		{NEWSDATE}
		{NEWSCOMMENTS}
		</span>
		</td><td style='width:55px'>
		{NEWSTHUMBNAIL}
		</td></tr></table>
		</div>\n";

	}
	$param['itemlink'] = (defined("NEWSLIST_ITEMLINK")) ? NEWSLIST_ITEMLINK : "";
	$param['thumbnail'] =(defined("NEWSLIST_THUMB")) ? NEWSLIST_THUMB : "border:0px";
	$param['catlink']  = (defined("NEWSLIST_CATLINK")) ? NEWSLIST_CATLINK : "";
	$param['caticon'] =  (defined("NEWSLIST_CATICON")) ? NEWSLIST_CATICON : ICONSTYLE;
	$sql->db_Select_gen($query);
	$newsList = $sql->db_getList();
	foreach($newsList as $row)
	{
		$text .= $ix->render_newsitem($row, 'return', '', $NEWSLISTSTYLE, $param);
	}

	$amount = ($action == "all") ? NEWSALL_LIMIT : NEWSLIST_LIMIT;

	$icon = ($row['category_icon']) ? "<img src='".e_IMAGE."icons/".$row['category_icon']."' alt='' />" : "";
	$parms = $news_total.",".$amount.",".$from.",".e_SELF.'?'.$action.".".$sub_action.".[FROM]";
	$text .= ($news_total > $amount) ? LAN_NEWS_22."&nbsp;".$tp->parseTemplate("{NEXTPREV={$parms}}") : "";

	ob_start();
	$ns->tablerender(LAN_82." '{$category_name}'", $text);
	$cache_data = ob_get_flush();
	setNewsCache($cacheString, $cache_data);
	require_once(FOOTERF);
	exit;
}

if ($action == "extend") {

	// --> Cache
	if($tmp = checkCache($cacheString)){
		require_once(HEADERF);
		renderCache($tmp, TRUE);
	}
	// <-- Cache

	$query = "SELECT n.*, u.user_id, u.user_name, u.user_customtitle, nc.category_name, nc.category_icon FROM #news AS n
		LEFT JOIN #user AS u ON n.news_author = u.user_id
		LEFT JOIN #news_category AS nc ON n.news_category = nc.category_id
		WHERE n.news_class REGEXP '".e_CLASS_REGEXP."' AND n.news_start < ".time()." AND (n.news_end=0 || n.news_end>".time().") AND n.news_id=".intval($sub_action);
	$sql->db_Select_gen($query);
	$news = $sql->db_Fetch();

	if($news['news_title']){
		define("e_PAGETITLE",$news['news_title']);
	}

	require_once(HEADERF);
	ob_start();
	$ix->render_newsitem($news, "extend");
	$cache_data = ob_get_contents();
	ob_end_flush();
	setNewsCache($cacheString, $cache_data);
	require_once(FOOTERF);
	exit;
}

if (empty($order)){
	$order = "news_datestamp";
}
$order = $tp -> toDB($order, true);

$interval = 10;
if ($action == "list"){
	$sub_action = intval($sub_action);
	$news_total = $sql->db_Count("news", "(*)", "WHERE news_category=$sub_action AND news_class REGEXP '".e_CLASS_REGEXP."' AND news_render_type!=2");
	$query = "SELECT n.*, u.user_id, u.user_name, u.user_customtitle, nc.category_name, nc.category_icon FROM #news AS n
		LEFT JOIN #user AS u ON n.news_author = u.user_id
		LEFT JOIN #news_category AS nc ON n.news_category = nc.category_id
		WHERE n.news_class REGEXP '".e_CLASS_REGEXP."' AND n.news_start < ".time()." AND (n.news_end=0 || n.news_end>".time().") AND n.news_render_type!=2 AND n.news_category={$sub_action} ORDER BY ".$order." DESC LIMIT ".intval($from).",".ITEMVIEW;
}
elseif($action == "item")
{
	$sub_action = intval($sub_action);
	$query = "SELECT n.*, u.user_id, u.user_name, u.user_customtitle, nc.category_name, nc.category_icon FROM #news AS n
		LEFT JOIN #user AS u ON n.news_author = u.user_id
		LEFT JOIN #news_category AS nc ON n.news_category = nc.category_id
		WHERE n.news_class REGEXP '".e_CLASS_REGEXP."' AND n.news_start < ".time()." AND (n.news_end=0 || n.news_end>".time().") AND n.news_id={$sub_action}";
}
elseif(strstr(e_QUERY, "month"))
{
	$tmp = explode(".", e_QUERY);
	$item = $tp -> toDB($tmp[1]);
	$year = substr($item, 0, 4);
	$month = substr($item, 4);
	$startdate = mktime(0, 0, 0, $month, 1, $year);
	$lastday = date("t", $startdate);
	$enddate = mktime(23, 59, 59, $month, $lastday, $year);
	$query = "SELECT n.*, u.user_id, u.user_name, u.user_customtitle, nc.category_name, nc.category_icon FROM #news AS n
		LEFT JOIN #user AS u ON n.news_author = u.user_id
		LEFT JOIN #news_category AS nc ON n.news_category = nc.category_id
		WHERE n.news_class REGEXP '".e_CLASS_REGEXP."' AND n.news_start < ".time()." AND (n.news_end=0 || n.news_end>".time().") AND n.news_render_type<2 AND n.news_datestamp > $startdate AND n.news_datestamp < $enddate ORDER BY ".$order." DESC LIMIT ".intval($from).",".ITEMVIEW;
}
elseif(strstr(e_QUERY, "day"))
{
	$tmp = explode(".", e_QUERY);
	$item = $tp -> toDB($tmp[1]);
	$year = substr($item, 0, 4);
	$month = substr($item, 4, 2);
	$day = substr($item, 6, 2);
	$startdate = mktime(0, 0, 0, $month, $day, $year);
	$lastday = date("t", $startdate);
	$enddate = mktime(23, 59, 59, $month, $day, $year);
	$query = "SELECT n.*, u.user_id, u.user_name, u.user_customtitle, nc.category_name, nc.category_icon FROM #news AS n
		LEFT JOIN #user AS u ON n.news_author = u.user_id
		LEFT JOIN #news_category AS nc ON n.news_category = nc.category_id
		WHERE n.news_class REGEXP '".e_CLASS_REGEXP."' AND n.news_start < ".time()." AND (n.news_end=0 || n.news_end>".time().") AND n.news_render_type<2 AND n.news_datestamp > $startdate AND n.news_datestamp < $enddate ORDER BY ".$order." DESC LIMIT ".intval($from).",".ITEMVIEW;
}
else
{
	$news_total = $sql->db_Count("news", "(*)", "WHERE news_class REGEXP '".e_CLASS_REGEXP."' AND news_start < ".time()." AND (news_end=0 || news_end>".time().") AND news_render_type<2" );

	if(!isset($pref['newsposts_archive']))
	{
		$pref['newsposts_archive'] = 0;
	}
	$interval = $pref['newsposts']-$pref['newsposts_archive'];

	// Get number of news item to show
	if(isset($pref['trackbackEnabled']) && $pref['trackbackEnabled']) {
		$query = "SELECT COUNT(tb.trackback_pid) AS tb_count, n.*, u.user_id, u.user_name, u.user_customtitle, nc.category_name, nc.category_icon, COUNT(*) AS tbcount FROM #news AS n
		LEFT JOIN #user AS u ON n.news_author = u.user_id
		LEFT JOIN #news_category AS nc ON n.news_category = nc.category_id
		LEFT JOIN #trackback AS tb ON tb.trackback_pid  = n.news_id
		WHERE n.news_class REGEXP '".e_CLASS_REGEXP."'
		AND n.news_start < ".time()."
		AND (n.news_end=0 || n.news_end>".time().")
		AND n.news_render_type<2
		GROUP by n.news_id
		ORDER BY news_sticky DESC, ".$order." DESC LIMIT ".intval($from).",".$pref['newsposts'];
	}
	else
	{
		$query = "SELECT n.*, u.user_id, u.user_name, u.user_customtitle, nc.category_name, nc.category_icon FROM #news AS n
		LEFT JOIN #user AS u ON n.news_author = u.user_id
		LEFT JOIN #news_category AS nc ON n.news_category = nc.category_id
		WHERE n.news_class REGEXP '".e_CLASS_REGEXP."'
		AND n.news_start < ".time()."
		AND (n.news_end=0 || n.news_end>".time().")
		AND n.news_render_type<2
		ORDER BY n.news_sticky DESC, ".$order." DESC LIMIT ".intval($from).",".$pref['newsposts'];
	}
	// #### END ---------------------------------------------------------------------------------------------------
}

if($tmp_cache = checkCache($cacheString)){
	require_once(HEADERF);

	if(!$action){
		render_wmessage();
		if (isset($pref['fb_active'])){  // --->feature box
			require_once(e_PLUGIN."featurebox/featurebox.php");
		}
		if (isset($pref['nfp_display']) && $pref['nfp_display'] == 1){
			require_once(e_PLUGIN."newforumposts_main/newforumposts_main.php");
		}

	}
	renderCache($tmp_cache, TRUE);
}


if (!$sql->db_Select_gen($query)) {
	require_once(HEADERF);
	echo "<br /><br /><div style='text-align:center'><b>".(strstr(e_QUERY, "month") ? LAN_462 : LAN_83)."</b></div><br /><br />";
	require_once(FOOTERF);
	exit;
} else {
	$newsAr = $sql -> db_getList();
}



$p_title = ($action == "item") ? $newsAr[1]['news_title'] : $newsAr[1]['category_name'];
if($action != "" && !is_numeric($action)){
	define("e_PAGETITLE", $p_title);
}

require_once(HEADERF);
if(!$action){
	render_wmessage();   // --> wmessage.
	if (isset($pref['fb_active'])){   // --->feature box
		require_once(e_PLUGIN."featurebox/featurebox.php");
	}

	if (isset($pref['nfp_display']) && $pref['nfp_display'] == 1){
		require_once(e_PLUGIN."newforumposts_main/newforumposts_main.php");
	}
}


/*
changes by jalist 03/02/2005:
news page templating

*/
if($pref['news_unstemplate'] && file_exists(THEME."news_template.php")) {
	// theme specific template required ...
	require_once(THEME."news_template.php");

	if($ALTERNATECLASS1){
		return TRUE;
	}

	$newscolumns = (isset($NEWSCOLUMNS) ? $NEWSCOLUMNS : 1);
	$newspercolumn = (isset($NEWSITEMSPERCOLUMN) ? $NEWSITEMSPERCOLUMN : 10);
	$newsdata = array();
	$loop = 1;
	foreach($newsAr as $news) {

		if(is_array($ALTERNATECLASSES)) {
			$newsdata[$loop] .= "<div class='{$ALTERNATECLASSES[0]}'>".$ix->render_newsitem($news, "return")."</div>";
			$ALTERNATECLASSES = array_reverse($ALTERNATECLASSES);
		} else {
			$newsdata[$loop] .= $ix->render_newsitem($news, "return");
		}
		$loop ++;
		if($loop > $newscolumns) {
			$loop = 1;
		}
	}
	$loop = 1;
	foreach($newsdata as $data) {
		$var = "ITEMS{$loop}";
		$$var = $data;
		$loop ++;
	}
	$text = preg_replace("/\{(.*?)\}/e", '$\1', $NEWSCLAYOUT);

	require_once(HEADERF);
	echo $text;
	setNewsCache($cacheString, $text);

} else {
	/*
	changes by jalist 22/01/2005:
	added ability to add a new date header to news posts, turn on and off from news->prefs
	*/

	ob_start();

	$newpostday = 0;
	$thispostday = 0;
	$pref['newsHeaderDate'] = 1;
	$gen = new convert();

	if (!defined("DATEHEADERCLASS")) {
		define("DATEHEADERCLASS", "nextprev");
		// if not defined in the theme, default class nextprev will be used for new date header
	}

	// #### normal newsitems, rendered via render_newsitem(), the $query is changed above (no other changes made) ---------

	$i= 1;
	while(isset($newsAr[$i]) && $i <= $interval) {
		$news = $newsAr[$i];
		//        render new date header if pref selected ...
		$thispostday = strftime("%j", $news['news_datestamp']);
		if ($newpostday != $thispostday && (isset($pref['news_newdateheader']) && $pref['news_newdateheader'])) {
			echo "<div class='".DATEHEADERCLASS."'>".strftime("%A %d %B %Y", $news['news_datestamp'])."</div>";
		}
		$newpostday = $thispostday;
		$news['category_id'] = $news['news_category'];
		if ($action == "item") {
			unset($news['news_render_type']);
		}

		$ix->render_newsitem($news);
		$i++;
	}

	$cache_data = ob_get_clean();
	require_once(HEADERF);
	echo $cache_data;
	setNewsCache($cacheString, $text);
}

// ##### --------------------------------------------------------------------------------------------------------------

// #### new: news archive ---------------------------------------------------------------------------------------------
if ($action != "item" && $action != 'list' && $pref['newsposts_archive']) {
	// do not show the newsarchive on the news.php?item.X page (but only on the news mainpage)
	require_once(e_FILE.'shortcode/batch/news_archives.php');

	$i = $interval + 1;
	while(isset($newsAr[$i]))
	{
		$news2 = $newsAr[$i];
		// Code from Lisa
		// copied from the rss creation, but added here to make sure the url for the newsitem is to the news.php?item.X
		// instead of the actual hyperlink that may have been added to a newstitle on creation
		$search = array();
		$replace = array();
		$search[0] = "/\<a href=\"(.*?)\">(.*?)<\/a>/si";
		$replace[0] = '\\2';
		$search[1] = "/\<a href='(.*?)'>(.*?)<\/a>/si";
		$replace[1] = '\\2';
		$search[2] = "/\<a href='(.*?)'>(.*?)<\/a>/si";
		$replace[2] = '\\2';
		$search[3] = "/\<a href=&quot;(.*?)&quot;>(.*?)<\/a>/si";
		$replace[3] = '\\2';
		$search[4] = "/\<a href=&#39;(.*?)&#39;>(.*?)<\/a>/si";
		$replace[4] = '\\2';
		$news2['news_title'] = preg_replace($search, $replace, $news2['news_title']);
		// End of code from Lisa

		$gen = new convert;
		$news2['news_datestamp'] = $gen->convert_date($news2['news_datestamp'], "short");


		if(!$NEWSARCHIVE){
			$NEWSARCHIVE ="<div>
					<table style='width:98%;'>
					<tr>
					<td>
					<div>{ARCHIVE_BULLET} <b>{ARCHIVE_LINK}</b> <span class='smalltext'><i>{ARCHIVE_AUTHOR} @ ({ARCHIVE_DATESTAMP}) ({ARCHIVE_CATEGORY})</i></span></div>
					</td>
					</tr>
					</table>
					</div>";

		}
		$textnewsarchive .= $tp->parseTemplate($NEWSARCHIVE, FALSE, $news_archive_shortcodes);
		$i++;
	}
	$ns->tablerender($pref['newsposts_archive_title'], $textnewsarchive, 'news_archive');
}
// #### END -----------------------------------------------------------------------------------------------------------

if ($action != "item") {
	if (is_numeric($action)){
		$action = "";
	}
	$parms = $news_total.",".ITEMVIEW.",".$from.",".e_SELF.'?'."[FROM].".$action.(isset($sub_action) ? ".".$sub_action : "");
	$nextprev = ($news_total > ITEMVIEW) ? LAN_NEWS_22."&nbsp;".$tp->parseTemplate("{NEXTPREV={$parms}}") : "";
	echo ($nextprev ? "<div class='nextprev'>".$nextprev."</div>" : "");
}

if(is_dir("remotefile")) {
	require_once(e_HANDLER."file_class.php");
	$file = new e_file;
	$reject = array('$.','$..','/','CVS','thumbs.db','*._$', 'index', 'null*', 'Readme.txt');
	$crem = $file -> get_files(e_BASE."remotefile", "", $reject);
	if(count($crem)) {
		foreach($crem as $loadrem) {
			if(strstr($loadrem['fname'], "load_")) {
				require_once(e_BASE."remotefile/".$loadrem['fname']);
			}
		}
	}
}

if (isset($pref['nfp_display']) && $pref['nfp_display'] == 2) {
	require_once(e_PLUGIN."newforumposts_main/newforumposts_main.php");
}

render_newscats();

require_once(FOOTERF);


// =========================================================================
function setNewsCache($cache_tag, $cache_data) {
	global $e107cache;
	$e107cache->set($cache_tag, $cache_data);
	$e107cache->set($cache_tag."_title", e_PAGETITLE);
}

function checkCache($cacheString){
	global $pref,$e107cache;
	$cache_data = $e107cache->retrieve($cacheString);
	$cache_title = $e107cache->retrieve($cacheString."_title");
	$etitle = ($cache_title != "e_PAGETITLE") ? $cache_title : "";
	if($etitle){
		define(e_PAGETITLE,$etitle);
	}
	if ($cache_data) {
		return $cache_data;
	} else {
		return false;
	}
}

function renderCache($cache, $nfp = FALSE){
	global $pref,$tp,$sql;
	echo $cache;
	if ($nfp && $pref['nfp_display'] == 2) {
		require_once(e_PLUGIN."newforumposts_main/newforumposts_main.php");
	}
	render_newscats();
	require_once(FOOTERF);
	exit;
}



function render_wmessage(){

	global $pref,$sql,$ns,$tp;
	if (!$pref['wmessage_sc']) {
		if (!defined("WMFLAG")) {
			$sql->db_Select("generic", "gen_chardata", "gen_type='wmessage' AND gen_intdata REGEXP '".e_CLASS_REGEXP."' ORDER BY gen_intdata ASC");
			while ($row = $sql->db_Fetch()){
				$wmessage .= $tp->toHTML($row['gen_chardata'], TRUE, 'parse_sc', 'admin')."<br />";
			}
		}
		if (isset($wmessage)) {
			if ($pref['wm_enclose']) {
				$ns->tablerender("", $wmessage, "wm");
			} else {
				echo $wmessage;
			}
		}
	}
}


function render_newscats(){  // --  CNN Style Categories. ----
	global $pref,$ns,$tp;
	if (isset($pref['news_cats']) && $pref['news_cats'] == '1') {
		$text3 = $tp->toHTML("{NEWS_CATEGORIES}", TRUE, 'parse_sc,nobreak');
		$ns->tablerender(LAN_NEWS_23, $text3, 'news_cat');
	}
}

?>