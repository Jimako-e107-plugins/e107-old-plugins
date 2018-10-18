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
| $Source: e:\_repository\e107_plugins/contactform_menu/help.php,v $
| $Revision: 1.6 $
| $Date: 2006/06/01 22:27:23 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   if (file_exists(e_PLUGIN."contactform_menu/languages/".e_LANGUAGE.".php")){
      require_once(e_PLUGIN."contactform_menu/languages/".e_LANGUAGE.".php");
   } else {
      require_once(e_PLUGIN."contactform_menu/languages/English.php");
   }

	$helptitle = CONTACTFORM_HELP_00;

	$helpcapt[] = CONTACTFORM_HELP_01;
	$helptext[] = CONTACTFORM_HELP_02;

	$helpcapt[] = CONTACTFORM_HELP_03;
	$helptext[] = CONTACTFORM_HELP_04;

	$helpcapt[] = CONTACTFORM_HELP_05;
	$helptext[] = CONTACTFORM_HELP_06;

	$text2 = "";
	for ($i=0; $i<count($helpcapt); $i++) {
		$text2 .= "<b>".$helpcapt[$i]."</b><br />";
	   $text2 .= $helptext[$i]."<br /><br />";
	};

   $ns -> tablerender($helptitle, $text2);
?>