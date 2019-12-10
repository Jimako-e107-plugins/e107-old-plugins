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
 
$creative_writer = e107::getSingleton('creative_writer',e_PLUGIN.'creative_writer/includes/creative_writer.class.php'); 

$creative_writer->init();
 
$creative_writer->render('homefilter');
 
 
?>
 