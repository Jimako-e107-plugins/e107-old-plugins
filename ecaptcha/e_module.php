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

/*------------------------------------------------------------------------------------------------------------+

    "TRIGGER $_POST" => array("REQUIRED $_POST SHOWN ON ECAPTCHA PREVIEW", "ANOTHER REQUIRED $_POST");


  - The trigger $_POST is used to avoid conflicts between forms that have similar $_POST names for content.

  - The display $_POST is shown in the box just above the captcha, it reminds people what they are posting.

  - If a required $_POST is blank, ecaptcha is not activated, as it should be rejected by the webpage,
    this avoids people passing the captcha only to be told they left a required field blank.

//-----------------------------------------------------------------------------------------------------------*/

  global $pref, $ecaptcha_triggers, $ecaptcha_type;


  $ecaptcha_triggers = array(


  "ecaptcha_force"    => array("ecaptcha_force"),
  "chat_submit"       => array("cmessage"),
  "commentsubmit"     => array("comment"),
  "replysubmit"       => array("comment"),
  "submit"            => array("comment"),
  "newthread"         => array("post","subject"),
  "reply"             => array("post"),
  "update_reply"      => array("post"),
  "report_download"   => array("report_download"),
  "submitnews_submit" => array("submitnews_title", "submitnews_item"),
  "create_content"    => array("content_heading", "content_text"),
  "add_link"          => array("link_url", "link_name", "link_description")


  );


//------------------------------------------------------------------------------------------------------------+

  if ($pref['ecaptcha_login'])
  {
    $ecaptcha_triggers['userlogin']  = array("username", "userpass");
    $ecaptcha_triggers['authsubmit'] = array("authname", "authpass");
  }

  if ($pref['ecaptcha_fpw'])
  {
    $ecaptcha_triggers['pwsubmit'] = array("username", "email");
  }

  if ($pref['ecaptcha_contactform'])
  {
    $ecaptcha_triggers['send-contactus'] = array("subject","body","email_send");
  }

//------------------------------------------------------------------------------------------------------------+

  if ($pref['ecaptcha_type_signup'] && stristr($_SERVER['SCRIPT_NAME'], "signup.php"))
  {
    $ecaptcha_triggers['register']        = array("loginname", "password1", "password2");
    if ($pref['displayname_class']       == "0") { $ecaptcha_triggers['register'][] = "name"; }
    if ($pref['disable_emailcheck']      == "0") { $ecaptcha_triggers['register'][] = "email"; }
    if ($pref['disable_emailcheck']      == "0") { $ecaptcha_triggers['register'][] = "email_confirm"; }
    if ($pref['signup_option_realname']  == "2") { $ecaptcha_triggers['register'][] = "realname"; }
    if ($pref['signup_option_signature'] == "2") { $ecaptcha_triggers['register'][] = "signature"; }
    if ($pref['signup_option_image']     == "2") { $ecaptcha_triggers['register'][] = "image"; }
    if ($pref['signup_option_class']     == "2") { $ecaptcha_triggers['register'][] = "class"; }

    require_once e_HANDLER."user_extended_class.php";
    $extended_class = new e107_user_extended;
	  $extended_list  = $extended_class->user_extended_get_fieldList();

	  foreach($extended_list as $e)
	  {
      if ($e['user_extended_struct_required'] == "1")
      {
        $ecaptcha_triggers['register']['ue'][] = "user_".$e['user_extended_struct_name'];
      }
    }
  }

//------------------------------------------------------------------------------------------------------------+

  if ($pref['ecaptcha_notify_check'])
  {
    $pref['ecaptcha_notify_check'] = "0"; save_prefs();

    $mysql_query  = "SELECT COUNT(`comment_id`) FROM ".MPREFIX."comments WHERE `comment_comment` LIKE '[ecaptcha={$search}%' LIMIT 1";
    $mysql_result = mysql_query($mysql_query) or die(mysql_error());
    $mysql_row    = mysql_fetch_array($mysql_result, MYSQL_ASSOC);
    $comments     = $mysql_row['COUNT(`comment_id`)'];

    if ($comments < 1)
    {
      $mysql_query  = "SELECT COUNT(`thread_id`) FROM ".MPREFIX."forum_t WHERE `thread_thread` LIKE '[ecaptcha={$search}%' LIMIT 1";
      $mysql_result = mysql_query($mysql_query) or die(mysql_error());
      $mysql_row    = mysql_fetch_array($mysql_result, MYSQL_ASSOC);
      $forum        = $mysql_row['COUNT(`thread_id`)'];
    }

    if ($comments > 0 || $forum > 0)
    {
      global $e_event; $null = ""; $e_event->trigger("ecaptcha_moderate", $null);
    }
  }

//------------------------------------------------------------------------------------------------------------+

  init_session(); // DEFINES USER AND USERNAME

  if (ADMIN && $pref['ecaptcha_immunity'])
  {
    $ecaptcha_type = "";
  }
  elseif (USER)
  {
    $ecaptcha_type = $pref['ecaptcha_type_members'];
  }
  else
  {
    if (stristr($_SERVER['SCRIPT_NAME'], "signup.php"))
    {
      $ecaptcha_type = $pref['ecaptcha_type_signup'];
    }
    else
    {
      $ecaptcha_type = $pref['ecaptcha_type_guests'];
    }
  }

//------------------------------------------------------------------------------------------------------------+

  $pref['cb_layer'] = ($pref['ecaptcha_ajax'] && !$ecaptcha_type) ? 2 : 0; // CHATBOX AJAX CONTROL

//------------------------------------------------------------------------------------------------------------+

  if (!$_POST || !$ecaptcha_type) { return; }

  require_once e_PLUGIN."ecaptcha/ecaptcha_class.php";

  if ($_POST['ecaptcha_reload'])
  {
    $ecaptcha_key = mysql_real_escape_string($_POST['ecaptcha_reload']);
    $mysql_result = mysql_query("SELECT * FROM ".MPREFIX."ecaptcha WHERE `key` = '{$ecaptcha_key}' LIMIT 1") or die(mysql_error());
    $mysql_row    = mysql_fetch_array($mysql_result, MYSQL_ASSOC);

    if ($mysql_row)
    {
      $_POST = unserialize($mysql_row['post']);
      ecaptcha_clear($ecaptcha_key);
    }
    else
    {
      $_POST = "";
    }
  }

  if ($_POST['ecaptcha_key'])
  {
    ecaptcha_validate();
  }
  else
  {
    ecaptcha_scan();
  }

//------------------------------------------------------------------------------------------------------------+

?>