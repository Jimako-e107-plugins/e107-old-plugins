<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|		Links plugin - help
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/links_page/e_help.php $
|     $Revision: 11758 $
|     $Id: e_help.php 11758 2010-09-07 12:18:00Z e107steved $
|     $Author: e107steved $
+----------------------------------------------------------------------------+
*/


if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN.'links_page/languages/'.e_LANGUAGE.'_help.php');

if(!e_QUERY){
	$text = LAN_ADMIN_HELP_1;
}else{
	if(e_QUERY){
		$qs = explode(".", e_QUERY);

		if(is_numeric($qs[0])){
			$from = array_shift($qs);
		}else{
			$from = "0";
		}
	}

	//##### LINK --------------------------------------------------
		//manage Link items
		if($qs[0] == "link" && !isset($qs[1]) ){
			$text = LAN_ADMIN_HELP_3;
		//edit
		}elseif($qs[0] == "link" && $qs[1] == "edit" && is_numeric($qs[2]) ){
			$text = LAN_ADMIN_HELP_9;
		//view links in cat
		}elseif($qs[0] == "link" && $qs[1] == "view" && (is_numeric($qs[2]) || $qs[2] == "all") ){
			$text = LAN_ADMIN_HELP_8;
		//create
		}elseif($qs[0] == "link" && $qs[1] == "create" && !isset($qs[2])){
			$text = LAN_ADMIN_HELP_4;
		//create/post submitted
		}elseif($qs[0] == "link" && $qs[1] == "sn" && is_numeric($qs[2])){
			$text = LAN_ADMIN_HELP_10;

	//##### SUBMITTED --------------------------------------------------
		}elseif($qs[0] == "sn" && !isset($qs[1]) ){
			$text = LAN_ADMIN_HELP_5;

	//##### OPTION --------------------------------------------------
		}elseif($qs[0] == "opt" && !isset($qs[1]) ){
			$text = LAN_ADMIN_HELP_6;

	//##### CATEGORY --------------------------------------------------
		}elseif($qs[0] == "cat" && $qs[1] == "create" ){
			$text = LAN_ADMIN_HELP_2;
		}elseif($qs[0] == "cat" && $qs[1] == "edit" && is_numeric($qs[2]) ){
			$text = LAN_ADMIN_HELP_7;
		}
}
$ns -> tablerender(LAN_ADMIN_HELP_0, $text);

?>