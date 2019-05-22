<?php
/*
+---------------------------------------------------------------+
|        Inbox Email - v 2 by Mohamed Anouar Achoukhy
|        only for e107 website system
|        http://e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN.'contact/languages/'.e_LANGUAGE.'.php');
$contact = $sql->db_count("contact","(*)","");


$text .= "<div style='padding-bottom: 2px;'>
          <img src='".e_PLUGIN."contact/images/contact_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' /> ".LAN_CONTACT_22." : ".$contact."</div>";
?>