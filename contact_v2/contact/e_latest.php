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
$reported_contact = $sql->db_count('contact', '(*)', "where contact_mod = 1 ");
$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN_ABS."contact/images/contact_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' />
";
if($reported_contact) 
{
	$text .= " <a href='".e_PLUGIN_ABS."contact/admin_config.php?message.unread'>".LAN_CONTACT_29."  : $reported_contact</a>";
} 
else 
{
	$text .= LAN_CONTACT_29." ".$reported_contact;
}
$text .= "</div>";

?>