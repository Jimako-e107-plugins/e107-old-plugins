<?php
/*
+---------------------------------------------------------------+
| ePlayer by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: E:/cvs/cvsrepo/eplayer/help.php,v $
| $Revision: 1.5 $
| $Date: 2005/08/01 22:25:29 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require_once(e_PLUGIN."eplayer/eplayer_variables.php");

	$helptitle = EPLAYER_LAN_HELP_00;

	$helpcapt[] = EPLAYER_LAN_HELP_01;
	$helptext[] = EPLAYER_LAN_HELP_02;

	$helpcapt[] = EPLAYER_LAN_HELP_07;
	$helptext[] = EPLAYER_LAN_HELP_08;

	$helpcapt[] = EPLAYER_LAN_HELP_09;
	$helptext[] = EPLAYER_LAN_HELP_10;

	$helpcapt[] = EPLAYER_LAN_HELP_11;
	$helptext[] = EPLAYER_LAN_HELP_12;

	$helpcapt[] = EPLAYER_LAN_HELP_03;
	$helptext[] = EPLAYER_LAN_HELP_04;

	$helpcapt[] = EPLAYER_LAN_HELP_05;
	$helptext[] = EPLAYER_LAN_HELP_06;

	$text2 = "";
	for ($i=0; $i<count($helpcapt); $i++) {
		$text2 .= "<b>".$helpcapt[$i]."</b><br />";
	   $text2 .= $helptext[$i]."<br /><br />";
	};

   $ns -> tablerender($helptitle, $text2);
?>