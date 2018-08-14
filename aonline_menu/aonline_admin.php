<?php

 /*----------------------------------------------------------------------------------------------------------\
 |                                                                                                            |
 |                         [ ANOTHER ONLINE MENU ] [ © RICHARD PERRY FROM GREYCUBE.COM ]                      |
 |                                                                                                            |
 |    Released under the terms and conditions of the GNU General Public License Version 3 (http://gnu.org)    |
 |                                                                                                            |
 |-------------------------------------------------------------------------------------------------------------
 |        [ EDITOR STYLE SETTINGS: LUCIDA CONSOLE, SIZE 10, TAB = 2 SPACES, BOLD GLOBALLY TURNED OFF ]        |
 \-----------------------------------------------------------------------------------------------------------*/

//------------------------------------------------------------------------------------------------------------+

  $eplug_admin = TRUE;
  require_once "../../class2.php";
  if(!getperms("P")) { echo "You do not have permission."; exit; }
  require_once e_ADMIN."auth.php";

//------------------------------------------------------------------------------------------------------------+

  @include_once(e_PLUGIN."aonline_menu/languages/".e_LANGUAGE.".php");
  @include_once(e_PLUGIN."aonline_menu/languages/English.php");

//------------------------------------------------------------------------------------------------------------+

  $setting = unserialize(base64_decode($pref['aonline_settings']));

  if ($_POST)
  {
    $setting['collapse_members']  = $_POST['collapse_members'];
    $setting['collapse_guests']   = $_POST['collapse_guests'];
    $setting['collapse_lastseen'] = $_POST['collapse_lastseen'];
    $setting['collapse_newusers'] = $_POST['collapse_newusers'];
    $setting['lookup_hostnames']  = $_POST['lookup_hostnames'];
    $setting['always_hide_admin'] = $_POST['always_hide_admin'];

    $setting['max_lastseen']  = intval($_POST['max_lastseen']);
    $setting['max_newusers']  = intval($_POST['max_newusers']);
    $setting['max_user_name'] = intval($_POST['max_user_name']);
    $setting['max_url_name']  = intval($_POST['max_url_name']);
    $setting['menu_width']    = intval($_POST['menu_width']);

    if ($setting['max_lastseen']  < 1) { $setting['max_lastseen']  = 5;   }
    if ($setting['max_user_name'] < 3) { $setting['max_user_name'] = 16;  }
    if ($setting['max_url_name']  < 3) { $setting['max_url_name']  = 12;  }
    if ($setting['menu_width']    < 1) { $setting['menu_width']    = 160; }

    $pref['aonline_settings'] = base64_encode(serialize($setting));
    save_prefs();
    
    // ADMIN LOG ENTRY
    $e_admin_log = new e_admin_log(); $e_admin_log->log_event("ANOTHER ONLINE MENU", AONLINE_LAN_ADM_LOG_SETTINGS_SAVED, 4);
  }

//------------------------------------------------------------------------------------------------------------+

  $text = "

  <form method='post' action='$_SERVER[PHP_SELF]'>
    <table style='text-align:center' cellspacing='5px'>

      <tr>
        <td>".AONLINE_LAN_ADM_COLLAPSE_MEMBERS."</td>
        <td><input class='tbox' type='checkbox' name='collapse_members' value='1' ".($setting['collapse_members'] ? "checked='checked'" : "")." /></td>
      </tr>

      <tr>
        <td>".AONLINE_LAN_ADM_COLLAPSE_GUESTS."</td>
        <td><input type='checkbox' name='collapse_guests' value='1' ".($setting['collapse_guests'] ? "checked='checked'" : "")." /></td>
      </tr>

      <tr>
        <td>".AONLINE_LAN_ADM_COLLAPSE_LASTSEEN."</td>
        <td><input type='checkbox' name='collapse_lastseen' value='1' ".($setting['collapse_lastseen'] ? "checked='checked'" : "")." /></td>
      </tr>

      <tr>
        <td>".AONLINE_LAN_ADM_COLLAPSE_NEWUSERS."</td>
        <td><input type='checkbox' name='collapse_newusers' value='1' ".($setting['collapse_newusers'] ? "checked='checked'" : "")." /></td>
      </tr>

      <tr>
        <td>".AONLINE_LAN_ADM_LOOKUP_HOSTNAMES."</td>
        <td><input type='checkbox' name='lookup_hostnames' value='1' ".($setting['lookup_hostnames'] ? "checked='checked'" : "")." /></td>
      </tr>
 
      <tr>
        <td>".AONLINE_LAN_ADM_ALWAYS_HIDE_ADMIN."</td>
        <td><input type='checkbox' name='always_hide_admin' value='1' ".($setting['always_hide_admin'] ? "checked='checked'" : "")." /></td>
      </tr>

      <tr>
        <td>".AONLINE_LAN_ADM_MAX_LASTSEEN."</td>
        <td><input class='tbox' type='text' name='max_lastseen' value='$setting[max_lastseen]' size='3' maxlength='2' /></td>
      </tr>
      
      <tr>
        <td>".AONLINE_LAN_ADM_MAX_NEWUSERS."</td>
        <td><input class='tbox' type='text' name='max_newusers' value='$setting[max_newusers]' size='3' maxlength='2' /></td>
      </tr>
      
      <tr>
        <td>".AONLINE_LAN_ADM_MAX_USER_NAME."</td>
        <td><input class='tbox' type='text' name='max_user_name' value='$setting[max_user_name]' size='3' maxlength='2' /></td>
      </tr>

      <tr>
        <td>".AONLINE_LAN_ADM_MAX_URL_NAME."</td>
        <td><input class='tbox' type='text' name='max_url_name' value='$setting[max_url_name]' size='3' maxlength='2' /></td>
      </tr>

      <tr>
        <td>".AONLINE_LAN_ADM_MENU_WIDTH."</td>
        <td><input class='tbox' type='text' name='menu_width' value='$setting[menu_width]' size='3' maxlength='3' /></td>
      </tr>
                
      <tr>
        <td colspan='2' style='text-align:center'>
          <br />
          <input class='tbox' type='submit' name='submit' value='".AONLINE_LAN_ADM_SAVE_SETTINGS."' /><br />
          <br />
        </td>
      </tr>

    </table>
  </form>";

  $ns -> tablerender(AONLINE_LAN_ADM_TITLE, $text);

//------------------------------------------------------------------------------------------------------------+

  $text = " <div style='text-align:center'>
              <br />
              ".AONLINE_LAN_ADM_LANGUAGE_BY_NAME."<br />
              <br />
              <a rel='external' href='http://".AONLINE_LAN_ADM_LANGUAGE_WEBSITE."'>".AONLINE_LAN_ADM_LANGUAGE_WEBSITE."</a><br />
              <br />
              ".AONLINE_LAN_ADM_LANGUAGE_CONTACT."<br />
              <br />
            </div>";

  $ns -> tablerender(AONLINE_LAN_ADM_LANGUAGE_CREDIT, $text);
  
//------------------------------------------------------------------------------------------------------------+

  require_once(e_ADMIN."footer.php");

//------------------------------------------------------------------------------------------------------------+

?>
