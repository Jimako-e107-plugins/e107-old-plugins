<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        Plugin: Tutorial Archiver
|        Version: 2.0
|        Original plugin by: Jordan 'Glasseater' Mellow, 2007
|
|        Modded and Revised by: e107 Italia in 2013
|        Email: info@e107italia.org
|        Website: www.e107italia.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+----------------------------------------------------------------------------------------------------+
*/
$TABLE_START = '
<table class="fborder" width="99%" border=0 cellpadding=0 cellspacing=0>';

$TABLE_ROW_BASIC = "
	<tr>
		<td class='fcaption'>{FORM_TOPIC}</td>
		<td class='forumheader3'>{FORM_FIELD}</td>
	</tr>";
	
$TABLE_END = '
</table>';

function fill_in($table_type){
	global $FORM_TOPIC, $FORM_FIELD;
	return preg_replace("/\{(.*?)\}/e", '$\1', $table_type);
}

function getAuthor($auth_id){
	//global $sql;
	$sql = new db();
	if(!$sql->db_Select("user", "user_id, user_name, user_email", "user_id=".$auth_id)){
		$getauthor = array(
			'user_id' => "0",
			'user_name' => "Unknown",
			'user_email' => "Unknown"
		);
	}else{
		$getauthor = $sql->db_Fetch();
	}
	return $getauthor;
}
function getCategory($catID){
	//global $sql;
	$sql = new db();
	if(!$sql->db_Select("tutsplugin_cats", "*", "id=".$catID)){
		$getcat = array(
			'id' => '0',
			'name' => 'Unknown',
			'icon' => '',
			'indexed' => '0'
		);
	}else{
		$getcat = $sql->db_Fetch();
	}
	return $getcat;
}

function show_breadcrumb(){
	global $sql, $pdir;
	if(e_QUERY){
		$qs = explode(".", e_QUERY);
		$bc = '<a href="'.$pdir.'/tutorials.php">'.TUT_TITLE.'</a>';
		if($qs[0] == "cat" && is_numeric($qs[1])){
			$sql->db_Select("tutsplugin_cats", "*", "id=".$qs[1]);
			$r=$sql->db_Fetch();
			$bc .= ' -> <a href="'.$pdir.'/tutorials.php?cat.'.$qs[1].'">'.$r['name'].'</a>';
		}else if($qs[0] == "view" && is_numeric($qs[1])){
			$sql->db_Select("tutsplugin_tutorial", "*", "id=".$qs[1]);
			$r=$sql->db_Fetch();
			$sql->db_Select("tutsplugin_cats", "*", "id=".$r['catID']);
			$s=$sql->db_Fetch();
			$bc .= ' -> <a href="'.$pdir.'/tutorials.php?cat.'.$r['catID'].'">'.$s['name'].'</a> -> <a href="'.$pdir.'/tutorials.php?view.'.$qs[1].'">'.$r['name'].'</a>';
		}
		return $bc;
	}else{
		return '<a href="'.$pdir.'/tutorials.php">'.TUT_TITLE.'</a>';
	}
}

function getComment($pluginid, $id) {
	global $pref, $e107cache, $tp;
	
	// Include the comment class. Normally, this file is included at a global level, so we need to make the variable
	// it decalares global so it is available inside the comment class
	require_once(e_HANDLER."comment_class.php");
	$GLOBALS["comment_shortcodes"] = $comment_shortcodes;
	
	$pid = 0; // What is this w.r.t. comment table? Parent ID?
	
	// Define a comment object
	$cobj = new comment();
	
	// See if we need to post a comment to the database
	if (isset($_POST['commentsubmit'])) {
		$cobj->enter_comment($_POST['author_name'], $_POST['comment'], $pluginid, $id, $pid, $_POST['subject']);
		if($pref['cachestatus']){
			$e107cache->clear("comment.$pluginid.{$sub_action}");
		}
	}
	$sql = new db();
	$sql -> db_Select("comments", "*", "comment_item_id=".$id);
	while($sql -> db_Fetch()){
		$text .= $cobj->render_comment($row, $pluginid, "comment", $id, $width, $subject, true);
		$text .= "Comment-&gt;<br />";
	}
	if (ADMIN && getperms("B")) {
		$text .= "<div style='text-align:right'><a href='".e_ADMIN."modcomment.php?$pluginid.$id'>".LAN_314."</a></div>";
	}
	
	// Get comment form - e107 sends this to the output buffer so we must grab it and assign to our return string
	ob_start();
	$cobj->compose_comment($pluginid, "comment", $id, $width, $subject, $showrate=false);
	$text = ob_get_contents();
	ob_end_clean();
	
	return $text;
}

function getRating($pluginid, $id, $allowRating=true) {
	require_once(e_HANDLER."rate_class.php");
	$rater = new rater();
	
	$text = "";
	//$text .= "<table><tr><td colspan='2' style='text-align:right'>";
	if ($ratearray = $rater->getrating($pluginid, $id)) {
		for($c = 1; $c <= $ratearray[1]; $c++) {
			$text .= "<img src='".e_IMAGE."rate/".IMODE."/star.png' alt='' />";
		}
		if ($ratearray[2]) {
			$text .= "<img src='".e_IMAGE."rate/".IMODE."/".$ratearray[2].".png'  alt='' />";
		}
		if ($ratearray[2] == "") {
			$ratearray[2] = 0;
		}
		$text .= "&nbsp;".$ratearray[1].".".$ratearray[2]." - ".$ratearray[0]."&nbsp;";
		$text .= ($ratearray[0] == 1 ? TUT_RATELAN_0 : TUT_RATELAN_1);
	} else {
		$text .= TUT_RATELAN_4;
	}
	
	
	if ($allowRating) {
		if (!$rater->checkrated($pluginid, $id) && USER) {
		$ratetext = $rater->rateselect("&nbsp;&nbsp;&nbsp;&nbsp;<b>".TUT_RATELAN_2, $pluginid, $id)."</b>";
		$text .= $ratetext;
		} else if(!USER) {
			$text .= "&nbsp;";
		} else {
			$text .= "&nbsp;-&nbsp;".TUT_RATELAN_3;
		}
	}
	
	return $text;
}
?>