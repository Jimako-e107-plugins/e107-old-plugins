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

  $eplug_admin = TRUE;

  require_once "../../class2.php";

  if (!getperms("P")) { exit("YOU DO NOT HAVE PERMISSION TO CONFIGURE THIS PLUGIN"); }

  require_once e_ADMIN."auth.php";

//-----------------------------------------------------------------------------------------------------------+

  if ($_POST['form_update'])
  {
    $pref['pm_alert_title']  = htmlspecialchars($_POST['form_pm_alert_title'], ENT_QUOTES);
    $pref['pm_alert_hover']  = htmlspecialchars($_POST['form_pm_alert_hover'], ENT_QUOTES);
    $pref['pm_alert_ignore'] = intval($_POST['form_pm_alert_ignore']);
    $pref['pm_alert_direct'] = intval($_POST['form_pm_alert_direct']);

    save_prefs();
  }

//-----------------------------------------------------------------------------------------------------------+

  $output .= "
  <form method='post' action=''>
    <div style='text-align:center; overflow:auto'>
      <table cellspacing='5' cellpadding='0' style='margin:auto'>
        <tr>
          <td style='text-align:left'> ALERT MENU TITLE </td>
          <td style='text-align:left'> <input type='text' name='form_pm_alert_title' value='{$pref['pm_alert_title']}' size='40' maxlength='255' /> </td>
        </tr>
        <tr>
          <td style='text-align:left'> ALERT MENU HOVER TEXT </td>
          <td style='text-align:left'> <input type='text' name='form_pm_alert_hover' value='{$pref['pm_alert_hover']}' size='40' maxlength='255' /> </td>
        </tr>
        <tr>
          <td><br /></td>
        </tr>
        <tr>
          <td style='text-align:left'> IGNORE UNREAD PM AFTER ? DAYS </td>
          <td style='text-align:left'> <input type='text' name='form_pm_alert_ignore' value='{$pref['pm_alert_ignore']}' size='40' maxlength='255' /> </td>
        </tr>
        <tr>
          <td style='text-align:left'> ALERT LINK GOES TO </td>
          <td style='text-align:left'>
            <select name='form_pm_alert_direct'>
              <option value='2' ".($pref['pm_alert_direct'] == 2 ? "selected='selected'" : "")."> Auto          </option>
              <option value='1' ".($pref['pm_alert_direct'] == 1 ? "selected='selected'" : "")."> Oldest Unread </option>
              <option value='0' ".($pref['pm_alert_direct'] == 0 ? "selected='selected'" : "")."> Inbox         </option>
            </select>
          </td>
        </tr>
      </table>
      <table cellspacing='20' cellpadding='0' style='text-align:center;margin:auto'>
        <tr>
          <td><input type='submit' name='form_update' value='Update' /></td>
        </tr>
      </table>
    </div>
  </form>";

//-----------------------------------------------------------------------------------------------------------+

  $ns -> tablerender("Configuration", $output);

  require_once e_ADMIN."footer.php";

//-----------------------------------------------------------------------------------------------------------+

?>