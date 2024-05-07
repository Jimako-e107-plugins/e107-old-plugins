<?php
/*
+---------------------------------------------------------------+
| Contact Form by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: E:/cvs/cvsrepo/YHA/e107_plugins/contactform_menu/help.php,v $
| $Revision: 1.5 $
| $Date: 2005/06/05 14:23:09 $
| $Author: Neil $
+---------------------------------------------------------------+
*/


	$helptitle = "Instructions";

	$helpcapt[] = "Block";
	$helptext[] = "Leave blank if option is un-wanted";


	$text2 = "";
	for ($i=0; $i<count($helpcapt); $i++) {
		$text2 .= "<b>".$helpcapt[$i]."</b><br />";
	   $text2 .= $helptext[$i]."<br /><br />";
	};

   $ns -> tablerender($helptitle, $text2);
?>