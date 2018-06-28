<?php

 /*----------------------------------------------------------------------------------------------------------\
 |                                                                                                            |
 |                               [ PM ALERT ] [ © RICHARD PERRY FROM GREYCUBE.COM ]                           |
 |                                                                                                            |
 |    Released under the terms and conditions of the GNU General Public License Version 3 (http://gnu.org)    |
 |                                                                                                            |
 |-------------------------------------------------------------------------------------------------------------
 |        [ EDITOR STYLE SETTINGS: LUCIDA CONSOLE, SIZE 10, TAB = 2 SPACES, BOLD GLOBALLY TURNED OFF ]        |
 \-----------------------------------------------------------------------------------------------------------*/

//------------------------------------------------------------------------------------------------------------+

  if (!USER || !USERID) { return; }

  if (!isset($pref['pm_alert_title']) || !isset($pref['pm_alert_hover']) || !isset($pref['pm_alert_ignore']) || !isset($pref['pm_alert_direct']))
  {
    $ns -> tablerender("PM Alert", "SETTING MISSING - UPGRADE IN PLUGIN MANAGER");
    return;
  }

//------------------------------------------------------------------------------------------------------------+

  if (!isset($pref['shortcode_list']['pm'])) // e107 0.7.7
  {
    if (strpos($pref['plug_sc'], "SENDPM:") === FALSE) // e107 0.7.0
    {
      $ns -> tablerender("PM Alert", "PM PLUGIN NOT INSTALLED");
      return;
    }
  }

//------------------------------------------------------------------------------------------------------------+

  $pm_link         = e_PLUGIN."pm/pm.php";
  $pm_to           = intval(USERID);
  $pm_ignore_after = time() - $pref['pm_alert_ignore'] * 86400;
  $pm_being_viewed = 0;

  if (strpos($_SERVER['SCRIPT_NAME'], "/pm.php") !== FALSE && preg_match("/show\.([0-9]+)/i", e_QUERY, $match))
  {
    $pm_being_viewed = intval($match[1]);
  }

//------------------------------------------------------------------------------------------------------------+

  switch ($pref['pm_alert_direct'])
  {
    case 2:  $mysql_query = "SELECT `pm_id` FROM ".MPREFIX."private_msg WHERE `pm_to` = {$pm_to} AND `pm_read` = 0 AND `pm_sent` > {$pm_ignore_after} AND `pm_id` != {$pm_being_viewed} ORDER BY `pm_sent` ASC LIMIT 2"; break;
    case 1:  $mysql_query = "SELECT `pm_id` FROM ".MPREFIX."private_msg WHERE `pm_to` = {$pm_to} AND `pm_read` = 0 AND `pm_sent` > {$pm_ignore_after} AND `pm_id` != {$pm_being_viewed} ORDER BY `pm_sent` ASC LIMIT 1"; break;
    default: $mysql_query = "SELECT `pm_id` FROM ".MPREFIX."private_msg WHERE `pm_to` = {$pm_to} AND `pm_read` = 0 AND `pm_sent` > {$pm_ignore_after} AND `pm_id` != {$pm_being_viewed} LIMIT 1";
  }

//------------------------------------------------------------------------------------------------------------+

  $mysql_result = mysql_query($mysql_query) or die(mysql_error());
  $mysql_row    = mysql_fetch_array($mysql_result, MYSQL_ASSOC);

  if (!$mysql_row) { return; }

  switch ($pref['pm_alert_direct'])
  {
    case 2: if (!mysql_fetch_array($mysql_result, MYSQL_ASSOC)) { $pm_link .= "?show.{$mysql_row['pm_id']}"; } break;
    case 1: $pm_link .= "?show.{$mysql_row['pm_id']}";
  }

//------------------------------------------------------------------------------------------------------------+

  $output = "
  <div style='text-align:center'>
    <a href='{$pm_link}'>
      <img src='".e_PLUGIN."pm_alert_menu/new_pm.gif' alt='' title='{$pref['pm_alert_hover']}' style='border:none' />
    </a>
  </div>";

  $ns -> tablerender($pref['pm_alert_title'], $output);

//------------------------------------------------------------------------------------------------------------+

?>