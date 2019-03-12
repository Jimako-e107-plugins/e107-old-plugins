<?php
//============================= Notice-Board v4.0 ===============================
//	author: ComPolyS team, http://e107.compolys.ru, sunout@compolys.ru		
//	coders: Sunout, Geo						
//	language officer Georgy Pyankov
//	license GNU GPL									
//================================== Deсember 2011 =============================
	require_once("../../class2.php");
	require_once(e_HANDLER."form_handler.php");
	require_once(e_HANDLER."userclass_class.php");
//	require_once(e_HANDLER."np_class.php");
	@include_once(e_PLUGIN."nboard/languages/".e_LANGUAGE.".php");
	$ns = new e107table;
	require_once(HEADERF);
		$conf_showcols = $pref['nb_showcols'];
		$conf_showrows = $pref['nb_showrows'];
		$conf_dateformat = $pref['nb_dateformat'];
	$month = date("m");
	$day = date("d");
	$year = date("y");
	$today = mktime(0,0,0,$month,$day,$year);
	$i=0;
	(int)$cat = $_GET['cat'];
	(int)$scat = $_GET['scat'];
	(int)$view = $_GET['view'];
	$add = $_GET['add'];
	$search =$_GET['search'];
	require_once("navigation.php");

//====================NOTICE-BOARD CATEGORY=====================//
if(!IsSet($_GET['view']) && !IsSet($_GET['add']) && !IsSet($_GET['search'])){
	require_once("categories.php");
}

//====================NOTICE-BOARD VIEWADS======================//
if(IsSet($_GET['view']) && $_GET['view'] <> 0){
require_once("viewads.php");
}

//====================NOTICE-BOARD ADD =========================//
if(IsSet($_GET['add'])){
require_once("add.php");
}

//====================NOTICE-BOARD SEARCH======================//
if(IsSet($_GET['search'])){
require_once("search.php");
}

$caption = "<a href='".e_PLUGIN."nboard/nboard.php'>".NB_INFO."</a>$catlink$sublink";
$ns -> tablerender($caption, $text);
require_once(FOOTERF);

function page(){
	if(empty($_GET["page"])){
		$page = 0;
	} else {
		if(!is_numeric($_GET["page"])) die("".NB_MES_09."");
        	$page = $_GET["page"];
	}
	return $page;
}
function sql_result($onpage, $page, $table, $gnl_picbig){
	$begin = $page*$onpage;
	$sql = "SELECT * FROM ".$table." ORDER BY gnl_id DESC LIMIT ".$begin.", ".$onpage;
	while ($row= mysql_fetch_array($sql)){
		$gnl_date_end= $row['gnl_date_end'];
	}
	mysql_query ("DELETE FROM ".MPREFIX."nb_gnl WHERE gnl_date_end='$today'");
	$result = mysql_query($sql) or die(mysql_error());
	return $result;
}
//=================== subcat_select ============================//
function navigation($onpage, $page, $table){
	$return = null;
	$count = mysql_query("SELECT COUNT(*) FROM ".MPREFIX."nb_gnl") or die(mysql_error());
	$count = mysql_fetch_array($count);
	$count = $count[0];
	$pages = $count/$onpage;
	if($page!==0){
	    $prev = "<a href=\"?page=".($page-1)."\">&lt;</a>";
	} else {
	    $prev = "<";
	}
	if($page<round($pages-1)){
	    $next = "<a href=\"?page=".($page+1)."\">&gt;</a>";
	} else {
	    $next = ">";
	}
	for($i=0;$i<$pages;$i++)
	{
	    if($i==$page){
	        $return.="[".($i+1)."]";
	    } else {
	        $return.="<a href=\"?page=".$i."\">[".($i+1)."]</a>";
	    }
	}
	return $prev.$return.$next;
}
//====================== all_select ============================//
function sql_cat($onpage, $page, $cat, $table){
	$begin = $page*$onpage;
	$sql = "SELECT * FROM ".$table." WHERE gnl_scatid in (select cat_id from ".MPREFIX."nb_cat where cat_sub_id='$cat') ORDER BY gnl_id DESC LIMIT ".$begin.", ".$onpage;
	$result_cat = mysql_query($sql) or die(mysql_error());
	return $result_cat;
	echo $result_cat;
}
//====================== cat_select ============================//
function sql_scat($onpage, $page, $scat, $table){
	$begin = $page*$onpage;
	$sql = "SELECT * FROM ".$table." WHERE gnl_scatid='$scat' ORDER BY gnl_id DESC LIMIT ".$begin.", ".$onpage;
	$result_scat = mysql_query($sql) or die(mysql_error());
	return $result_scat;
}
function theme_head() {
 	return "<script type='text/javascript' src='".e_PLUGIN."nboard/js/add.js'></script>
	<script type='text/javascript' src='".e_PLUGIN."nboard/js/add_check.js'></script>\n";
}
function image_getsize($fname){
	if($imginfo = getimagesize($fname)){
		return ":width={$imginfo[0]}&height={$imginfo[1]}";
	}
	else{
		return "";
	}
}
?>