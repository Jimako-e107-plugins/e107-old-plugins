<?php
/*
+---------------------------------------------------------------+
|        CreativeWriter Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

 

if (!defined('e107_INIT')) {   exit;   }
 
e107::lan('creative_writer'); 

if(is_string($parm)) // unserailize the v2.x e_menu.php preferences.
{
	parse_str($parm, $parms); // if it fails, use legacy method. (query string format)
}
 

if($parms['template']) {
  $template = $parms['template'];
}
else $template = "challenge_menu";
 
$challenge = e107::getSingleton('challenge_writer',e_PLUGIN.'creative_writer/includes/challenge.class.php');
 
$challenge->init();

if($parms['limit']) {
  $challenge->setLimit($parms['limit']);
}
else $challenge->setLimit(4);
 
$challenge->render('menu', $template);
 
 
?>
 