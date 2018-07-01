<?php
  /*
  +---------------------------------------------------------------+
  |
  |	e107 website system
  |	GUESTBOOK PLUGIN V4.0
  |
  |	Released under the terms and conditions of the
  |	GNU General Public License Version 2 (http://gnu.org).
  |
  +---------------------------------------------------------------+
  | original: ©Andrew Rockwell 2003
  |	      http://2sdw.com
  |           chavo@2sdw.com
  +---------------------------------------------------------------+
  | updates:  ©Richard Perry 2005
  |           http://www.greycube.com
  |           code@greycube.com
  +---------------------------------------------------------------+
  | updates:  ©Titanik 2007
  |          http://upc.utc.sk
  |           tomasss@inmail.sk
  +---------------------------------------------------------------+
  | updates:  ©Smarti October 2007
  |          http://www.platinwebservice.de
  |           webmaster@platinwebservice.de
  +---------------------------------------------------------------+
  */
if (!defined('e107_INIT')) { exit; }

@include_once(e_PLUGIN."guestbook/languages/".e_LANGUAGE.".php");
@include_once(e_PLUGIN."guestbook/languages/English.php");
 

$guestbook_newentries = $sql->db_Count("guestbook WHERE block='0'");

$text .= "<div style='padding-bottom: 2px;'><img src='".e_PLUGIN."/guestbook/icon_small.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' /> ".GB_LAN_ADM_21.": ".$guestbook_newentries."</div>";

?>