<?php

 /*----------------------------------------------------------------------------------------------------------\
 |                                                                                                            |
 |                        [ ECAPTCHA PLUGIN ] [ © RICHARD PERRY FROM GREYCUBE.COM ]                           |
 |                                                                                                            |
 |    Released under the terms and conditions of the GNU General Public License Version 3 (http://gnu.org)    |
 |                                                                                                            |
 |-------------------------------------------------------------------------------------------------------------
 |        [ EDITOR STYLE SETTINGS: LUCIDA CONSOLE, SIZE 10, TAB = 2 SPACES, BOLD GLOBALLY TURNED OFF ]        |
 \-----------------------------------------------------------------------------------------------------------*/

//------------------------------------------------------------------------------------------------------------+

  $eplug_admin = TRUE;
  require_once "../../class2.php"; if(!getperms("P")) { echo "You do not have permission"; exit; }
  require_once e_ADMIN."auth.php";
  require_once "ecaptcha_class.php";

//------------------------------------------------------------------------------------------------------------+

  if ($_POST['ecaptcha_admin_submit'])
  {
    $pref['ecaptcha_type_signup']            = $_POST['ecaptcha_type_signup'];
    $pref['ecaptcha_type_guests']            = $_POST['ecaptcha_type_guests'];
    $pref['ecaptcha_type_members']           = $_POST['ecaptcha_type_members'];
    $pref['ecaptcha_login']                  = $_POST['ecaptcha_login'];
    $pref['ecaptcha_fpw']                    = $_POST['ecaptcha_fpw'];
    $pref['ecaptcha_contactform']            = $_POST['ecaptcha_contactform'];
    $pref['ecaptcha_cookie']                 = $_POST['ecaptcha_cookie'];
    $pref['ecaptcha_links_comments_guests']  = intval($_POST['ecaptcha_links_comments_guests']);
    $pref['ecaptcha_links_forum_guests']     = intval($_POST['ecaptcha_links_forum_guests']);
    $pref['ecaptcha_links_comments_members'] = intval($_POST['ecaptcha_links_comments_members']);
    $pref['ecaptcha_links_forum_members']    = intval($_POST['ecaptcha_links_forum_members']);
    $pref['ecaptcha_style']                  = $_POST['ecaptcha_style'];
    $pref['ecaptcha_immunity']               = $_POST['ecaptcha_immunity'];
    $pref['ecaptcha_ajax']                   = $_POST['ecaptcha_ajax'];
    $pref['ecaptcha_hotfix_charset']         = $_POST['ecaptcha_hotfix_charset'];
    $pref['ecaptcha_file_bypass']            = $_POST['ecaptcha_file_bypass'];
    $pref['ecaptcha_length_min']             = $_POST['ecaptcha_length_min'];
    $pref['ecaptcha_length_max']             = $_POST['ecaptcha_length_max'];
    $pref['ecaptcha_recaptcha_public']       = trim($_POST['ecaptcha_recaptcha_public']);
    $pref['ecaptcha_recaptcha_private']      = trim($_POST['ecaptcha_recaptcha_private']);

    save_prefs();
  }

  $ecaptcha_types = array(
  ""            => LAN_ECAP_ADM_OFF,
  "recaptcha"   => LAN_ECAP_ADM_RECAPTCHA,
  "image"       => LAN_ECAP_ADM_IMAGE,
  "image_audio" => LAN_ECAP_ADM_IMAGE_AUDIO,
  "button"      => LAN_ECAP_ADM_BUTTON,
  "invisible"   => LAN_ECAP_ADM_INVISIBLE);

//------------------------------------------------------------------------------------------------------------+

  $text = "
  <form method='post' action=''>
    <div style='text-align:center'>
      <table class='fborder' width='95%' border='0'>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_SIGNUP."</td>
		<td class='forumheader3'>
      <select class='tbox' name='ecaptcha_type_signup'>";

      foreach ($ecaptcha_types as $key => $value)
      {
        if ($key == "invisible") { continue; }

        $selected = ($pref['ecaptcha_type_signup'] == $key) ? $selected = "selected='selected'" : "";
        $text .= "<option {$selected} value='{$key}'>{$value}</option>";
      }

      $text .= "
      </select>
	  </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_GUESTS."</td>
		<td class='forumheader3'>
      <select class='tbox' name='ecaptcha_type_guests'>";

      foreach ($ecaptcha_types as $key => $value)
      {
        $selected = ($pref['ecaptcha_type_guests'] == $key) ? $selected = "selected='selected'" : "";
        $text .= "<option {$selected} value='{$key}'>{$value}</option>";
      }

      $text .= "
      </select>
	  </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_MEMBERS."</td>
		<td class='forumheader3'>
      <select class='tbox' name='ecaptcha_type_members'>";

      foreach ($ecaptcha_types as $key => $value)
      {
        $selected = ($pref['ecaptcha_type_members'] == $key) ? $selected = "selected='selected'" : "";
        $text .= "<option {$selected} value='{$key}'>{$value}</option>";
      }

      $text .= "
      </select>
	  </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_LOGIN."</td>
    <td class='forumheader3'>
      <input type='checkbox' name='ecaptcha_login' value='1' ".($pref['ecaptcha_login']?"checked='checked'":"")." />
    </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_FPW."</td>
    <td class='forumheader3'>
      <input type='checkbox' name='ecaptcha_fpw' value='1' ".($pref['ecaptcha_fpw']?"checked='checked'":"")." />
    </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_CONTACTFORM."</td>
    <td class='forumheader3'>
      <input type='checkbox' name='ecaptcha_contactform' value='1' ".($pref['ecaptcha_contactform']?"checked='checked'":"")." />
    </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_COOKIE."</td>
		<td class='forumheader3'>
      <input type='checkbox' name='ecaptcha_cookie' value='1' ".($pref['ecaptcha_cookie'] ? "checked='checked'" : "")." />
    </td>
  </tr>

  <tr>
    <td colspan='2'>
      <br /><br />
      ".LAN_ECAP_ADM_LINKS_INFO." [ <a href='".e_PLUGIN."ecaptcha/ecaptcha_moderate.php'>".LAN_ECAP_ADM_LINKS_MODERATE."</a> ]
      <br /><br />
    </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_LINKS_COMMENTS_GUESTS."</td>
    <td class='forumheader3'>
      <input class='tbox' type='text' name='ecaptcha_links_comments_guests' value='{$pref['ecaptcha_links_comments_guests']}' size='4' />
    </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_LINKS_FORUM_GUESTS."</td>
    <td class='forumheader3'>
      <input class='tbox' type='text' name='ecaptcha_links_forum_guests' value='{$pref['ecaptcha_links_forum_guests']}' size='4' />
    </td>
  </tr>


  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_LINKS_COMMENTS_MEMBERS."</td>
    <td class='forumheader3'>
      <input class='tbox' type='text' name='ecaptcha_links_comments_members' value='{$pref['ecaptcha_links_comments_members']}' size='4' />
    </td>
  </tr>


  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_LINKS_FORUM_MEMBERS."</td>
    <td class='forumheader3'>
      <input class='tbox' type='text' name='ecaptcha_links_forum_members' value='{$pref['ecaptcha_links_forum_members']}' size='4' />
    </td>
  </tr>


  <tr>
    <td colspan='2'>
      <br /><br />
    </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_STYLE."</td>
		<td class='forumheader3'>
      <select class='tbox' name='ecaptcha_style'>";

      $ecaptcha_styles = array(
      "0" => LAN_ECAP_ADM_STYLE_0,
      "1" => LAN_ECAP_ADM_STYLE_1,
      "2" => LAN_ECAP_ADM_STYLE_2);

      foreach ($ecaptcha_styles as $key => $value)
      {
        $selected = ($pref['ecaptcha_style'] == $key) ? $selected = "selected='selected'" : "";
        $text .= "<option {$selected} value='{$key}'>{$value}</option>";
      }

      $text .= "
      </select>
	  </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_IMMUNITY."</td>
    <td class='forumheader3'>
      <input type='checkbox' name='ecaptcha_immunity' value='1' ".($pref['ecaptcha_immunity']?"checked='checked'":"")." />
    </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_AJAX."</td>
    <td class='forumheader3'>
      <input type='checkbox' name='ecaptcha_ajax' value='1' ".($pref['ecaptcha_ajax']?"checked='checked'":"")." />
    </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_FILE_BYPASS."</td>
		<td class='forumheader3'>
      <input type='checkbox' name='ecaptcha_file_bypass' value='1' ".($pref['ecaptcha_file_bypass'] ? "checked='checked'" : "")." />
    </td>
	</tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_HOTFIX_CHARSET."</td>
    <td class='forumheader3'>
      <input type='checkbox' name='ecaptcha_hotfix_charset' value='1' ".($pref['ecaptcha_hotfix_charset']?"checked='checked'":"")." />
    </td>
  </tr>

  <tr>
    <td colspan='2'>
      <br /><br />
    </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_LENGTH_MIN."</td>
		<td class='forumheader3'>
      <select class='tbox' name='ecaptcha_length_min'>";

      for ($i=1; $i<=8; $i++)
      {
        $selected = ($pref['ecaptcha_length_min'] == $i) ? $selected = "selected='selected'" : "";
        $text .= "<option {$selected} value='{$i}'>{$i}</option>";
      }

      $text .= "
      </select>
	  </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_LENGTH_MAX."</td>
		<td class='forumheader3'>
      <select class='tbox' name='ecaptcha_length_max'>";

      for ($i=1; $i<=8; $i++)
      {
        $selected = ($pref['ecaptcha_length_max'] == $i) ? $selected = "selected='selected'" : "";
        $text .= "<option {$selected} value='{$i}'>{$i}</option>";
      }

      $text .= "
      </select>
	  </td>
  </tr>


  <tr>
    <td colspan='2'>
      <br /><br />
      ".LAN_ECAP_ADM_RECAPTCHA_INFO." <a href='http://recaptcha.net/api/getkey'>http://recaptcha.net/api/getkey</a>
      <br /><br />
    </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_RECAPTCHA_PUBLIC."</td>
    <td class='forumheader3'>
      <input class='tbox' type='text' name='ecaptcha_recaptcha_public' value='{$pref['ecaptcha_recaptcha_public']}' size='60' />
    </td>
  </tr>

  <tr>
    <td class='forumheader3'>".LAN_ECAP_ADM_RECAPTCHA_PRIVATE."</td>
    <td class='forumheader3'>
      <input class='tbox' type='text' name='ecaptcha_recaptcha_private' value='{$pref['ecaptcha_recaptcha_private']}' size='60' />
    </td>
  </tr>

  <tr>
    <td colspan='2'>
      <br /><br />
    </td>
  </tr>

  <tr>
    <td colspan='2' style='text-align:center'>
      <input class='button' type='submit' name='ecaptcha_admin_submit' value='".LAN_ECAP_ADM_SUBMIT."' />
      <br />
      <br />
      <br />
      [ <a href='http://www.greycube.com/help/readme/ecaptcha/'>".LAN_ECAP_ADM_README."</a> ]
      <br />
      <br />
    </td>
  </tr>

      </table>
    </div>
  </form>";

  $ns -> tablerender(LAN_ECAP_ADM_TITLE, $text);

//------------------------------------------------------------------------------------------------------------+

  $text = "<div style='text-align:center'>
             <br />
             ".LAN_ECAP_ADM_LANGUAGE_BY_NAME."<br />
             <br />
             <a rel='external' href='http://".LAN_ECAP_ADM_LANGUAGE_WEBSITE."'>".LAN_ECAP_ADM_LANGUAGE_WEBSITE."</a><br />
             <br />
             ".LAN_ECAP_ADM_LANGUAGE_CONTACT."<br />
             <br />
           </div>";

  $ns -> tablerender(LAN_ECAP_ADM_LANGUAGE_CREDIT, $text);

//------------------------------------------------------------------------------------------------------------+

  require_once(e_ADMIN."footer.php");

?>
