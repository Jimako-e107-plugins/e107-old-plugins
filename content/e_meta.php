<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Steve Dunstan 2001-2002
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/content/e_meta.php $
|     $Revision: 12136 $
|     $Id: e_meta.php 12136 2011-04-15 18:04:06Z e107steved $
|     $Author: e107steved $
+----------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

if (substr(e_PAGE, 0, 7) != 'content') return;

echo "<script type='text/javascript' src='".e_FILE."popup.js'></script>\n";

if(e_QUERY){
	$qs = explode(".", e_QUERY);

	if(is_numeric($qs[0])){
		$from = array_shift($qs);
	}else{
		$from = "0";
	}
}
if(isset($qs[0]) && $qs[0] == "content" && isset($qs[1]) && is_numeric($qs[1]) ){
	$add_meta_keywords = '';
	//meta keywords from content item
	if($sql -> db_Select('pcontent', "content_meta", "content_id='".intval($qs[1])."'")){
		list($row['content_meta']) = $sql -> db_Fetch();
		$exmeta = $row['content_meta'];
		if($exmeta != ""){
			$exmeta = str_replace(", ", ",", $exmeta);
			$exmeta = str_replace(" ", ",", $exmeta);
			$exmeta = str_replace(",", ", ", $exmeta);
			$add_meta_keywords = $exmeta;
		}
	}
	if($add_meta_keywords){
		define("META_MERGE", TRUE);
		define("META_KEYWORDS", " ".$add_meta_keywords);
	}
}


?>