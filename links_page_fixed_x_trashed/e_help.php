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

// e107::lan('links_page',e_LANGUAGE."_help.php"); 
include_lan(e_PLUGIN.'links_page/languages/'.e_LANGUAGE.'/'.e_LANGUAGE.'_help.php');

 
if(!e_QUERY){
	$text = LAN_ADMIN_HELP_1;
}else{
	if(e_QUERY){
		$qs = explode("&amp;", e_QUERY);
	}

	//##### LINK --------------------------------------------------
		//manage Link items
		if($qs[0] == "mode=main" && $qs[1] == "action=list"  ){
			$text = LAN_ADMIN_HELP_8;
		//edit
		}elseif($qs[0] == "mode=main" && $qs[1] == "action=create"  ){
			$text = LAN_ADMIN_HELP_9;
		//view links in cat
		}elseif($qs[0] == "mode=main" && $qs[1] == "view" ){
			$text = LAN_ADMIN_HELP_8;
		//create
		}elseif($qs[0] == "mode=main" && $qs[1] == "action=edit" ){
			$text = LAN_ADMIN_HELP_4;
		//create/post submitted
		}elseif($qs[0] == "mode=main" && $qs[1] == "sn"  ){
			$text = LAN_ADMIN_HELP_10;

	//##### SUBMITTED --------------------------------------------------
		}elseif($qs[0] == "sn" && !isset($qs[1]) ){
			$text = LAN_ADMIN_HELP_5;

	//##### OPTION --------------------------------------------------
		}elseif($qs[0] == "mode=main" &&   $qs[1] == "action=prefs"  ){
			$text = LAN_ADMIN_HELP_6;

	//##### CATEGORY --------------------------------------------------
		}elseif($qs[0] == "mode=cat" && $qs[1] == "action=create" ){
			$text = LAN_ADMIN_HELP_2;
		}elseif($qs[0] == "mode=cat"  && $qs[1] == "action=list"  ){
			$text = LAN_ADMIN_HELP_1.LAN_ADMIN_HELP_7;
		}
}
$ns -> tablerender(LAN_ADMIN_HELP_0, $text);

?>