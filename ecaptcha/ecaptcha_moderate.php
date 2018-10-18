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
  $text = "";

//------------------------------------------------------------------------------------------------------------+

  if ($_GET['action'])
  {
    if ($_GET['action'] == "approve") { $_POST['moderate_approve'] = TRUE; }
    if ($_GET['action'] == "delete")  { $_POST['moderate_delete']  = TRUE; }

    $search = mysql_real_escape_string("{$_GET['ip']}_{$_GET['uid']}_{$_GET['area']}_{$_GET['time']}");

    if ($_GET['area'] == "comments")
    {
      $mysql_query  = "SELECT * FROM ".MPREFIX."comments WHERE `comment_comment` LIKE '[ecaptcha={$search}%' LIMIT 1";
      $mysql_result = mysql_query($mysql_query) or die(mysql_error());
      $mysql_row    = mysql_fetch_array($mysql_result, MYSQL_ASSOC);

      $_POST['form_comments'][] = $mysql_row['comment_id'];
    }

    if ($_GET['area'] == "forum")
    {
      $mysql_query  = "SELECT * FROM ".MPREFIX."forum_t WHERE `thread_thread` LIKE '[ecaptcha={$search}%' LIMIT 1";
      $mysql_result = mysql_query($mysql_query) or die(mysql_error());
      $mysql_row    = mysql_fetch_array($mysql_result, MYSQL_ASSOC);

      $_POST['form_forum'][] = $mysql_row['thread_id'];
    }

    if ($_SERVER['HTTP_REFERER'])
    {
      $text .= "<div style='text-align:center'><br /> ".LAN_ECAP_MOD_GO_BACK." <a href='{$_SERVER['HTTP_REFERER']}'>{$_SERVER['HTTP_REFERER']}</a> <br /></div>";
    }
  }

//------------------------------------------------------------------------------------------------------------+

  if ($_POST['moderate_approve'])
  {
    foreach ($_POST['form_comments'] as $comment_id)
    {
      $comment_id      = mysql_real_escape_string($comment_id);
      $mysql_query     = "SELECT `comment_comment` FROM ".MPREFIX."comments WHERE `comment_id` = '{$comment_id}' LIMIT 1";
      $mysql_result    = mysql_query($mysql_query) or die(mysql_error());
      $mysql_row       = mysql_fetch_array($mysql_result, MYSQL_ASSOC);
      $comment_comment = $mysql_row['comment_comment'];
      $comment_comment = preg_replace("/\[ecaptcha.*\]/iU",   "", $comment_comment);
      $comment_comment = preg_replace("/\[\/ecaptcha.*\]/iU", "", $comment_comment);
      $comment_comment = trim($comment_comment);
      $comment_comment = mysql_real_escape_string($comment_comment);
      $mysql_query     = "UPDATE ".MPREFIX."comments SET `comment_comment` = '{$comment_comment}' WHERE `comment_id` = '{$comment_id}' LIMIT 1";
      $mysql_result    = mysql_query($mysql_query) or die(mysql_error());
    }

    foreach ($_POST['form_forum'] as $thread_id)
    {
      $thread_id     = mysql_real_escape_string($thread_id);
      $mysql_query   = "SELECT `thread_thread` FROM ".MPREFIX."forum_t WHERE `thread_id` = '{$thread_id}' LIMIT 1";
      $mysql_result  = mysql_query($mysql_query) or die(mysql_error());
      $mysql_row     = mysql_fetch_array($mysql_result, MYSQL_ASSOC);
      $thread_thread = $mysql_row['thread_thread'];
      $thread_thread = preg_replace("/\[ecaptcha.*\]/iU",   "", $thread_thread);
      $thread_thread = preg_replace("/\[\/ecaptcha.*\]/iU", "", $thread_thread);
      $thread_thread = trim($thread_thread);
      $thread_thread = mysql_real_escape_string($thread_thread);
      $mysql_query   = "UPDATE ".MPREFIX."forum_t SET `thread_thread` = '{$thread_thread}' WHERE `thread_id` = '{$thread_id}' LIMIT 1";
      $mysql_result  = mysql_query($mysql_query) or die(mysql_error());
    }

    $text .= "<div style='text-align:center'><br /> [ ".LAN_ECAP_MOD_APPROVED." ] [ ".LAN_ECAP_MOD_COMMENTS." ".count($_POST['form_comments'])." ] [ ".LAN_ECAP_MOD_FORUM." ".count($_POST['form_forum'])." ] <br /><br /></div>";
  }

//------------------------------------------------------------------------------------------------------------+

  if ($_POST['moderate_delete'])
  {
    foreach ($_POST['form_comments'] as $comment_id)
    {
      ecaptcha_comment_delete($comment_id);
    }

    require_once e_PLUGIN."forum/forum_mod.php";

    foreach ($_POST['form_forum'] as $thread_id)
    {
      forum_delete_thread($thread_id);
    }

    $text .= "<div style='text-align:center'><br /> [ ".LAN_ECAP_MOD_DELETED." ] [ ".LAN_ECAP_MOD_COMMENTS." ".count($_POST['form_comments'])." ] [ ".LAN_ECAP_MOD_FORUM." ".count($_POST['form_forum'])." ] <br /><br /></div>";
  }

//------------------------------------------------------------------------------------------------------------+

  $text .= "
	<form method='post' action='' id='ecaptcha_moderate'>
    <div style='text-align:center'>
      <table class='fborder' width='95%' border='0'>";

      $text .= "
      <tr>
        <td colspan='4'>
          <br />
          ".LAN_ECAP_MOD_WAITING."
          <br />
          <br />
        </td>
      </tr>";

      $mysql_query  = "SELECT * FROM ".MPREFIX."comments WHERE `comment_comment` LIKE '[ecaptcha=%'";
      $mysql_result = mysql_query($mysql_query) or die(mysql_error());

      while ($mysql_row = mysql_fetch_array($mysql_result, MYSQL_ASSOC))
      {
        $text .= "
        <tr>
          <td class='forumheader3'> <input type='checkbox' name='form_comments[]' value='{$mysql_row['comment_id']}' /> </td>
          <td class='forumheader3'> ".strftime("%Y-%m-%d %H:%M", $mysql_row['comment_datestamp'] + TIMEOFFSET)." </td>
          <td class='forumheader3'> ".ecaptcha_html($mysql_row['comment_author'])." </td>
          <td class='forumheader3'> ".ecaptcha_html($mysql_row['comment_comment'])." </td>
        </tr>";
      }

      $mysql_query  = "SELECT * FROM ".MPREFIX."forum_t WHERE `thread_thread` LIKE '[ecaptcha=%'";
      $mysql_result = mysql_query($mysql_query) or die(mysql_error());

      while ($mysql_row = mysql_fetch_array($mysql_result, MYSQL_ASSOC))
      {
        $text .= "
        <tr>
          <td class='forumheader3'> <input type='checkbox' name='form_forum[]' value='{$mysql_row['thread_id']}' /> </td>
          <td class='forumheader3'> ".strftime("%Y-%m-%d %H:%M", $mysql_row['thread_datestamp'] + TIMEOFFSET)." </td>
          <td class='forumheader3'> ".ecaptcha_html($mysql_row['thread_user'])." </td>
          <td class='forumheader3'> ".ecaptcha_html($mysql_row['thread_thread'])." </td>
        </tr>";
      }

      $text .= "

        <tr>
          <td colspan='4' style='text-align:center'>
            <br />
            <br />
            <input class='button' type='submit' name='moderate_approve' value='".LAN_ECAP_MOD_APPROVE_SELECTED."' />
            <input class='button' type='submit' name='moderate_delete'  value='".LAN_ECAP_MOD_DELETE_SELECTED."' />
            <br />
            <br />
            <br />
            [ <a href='".e_SELF."' onclick='setCheckboxes(\"ecaptcha_moderate\", true, \"form_comments[]\"); return false;'>".LAN_ECAP_MOD_SELECT_COMMENTS."</a> ]
            [ <a href='".e_SELF."' onclick='setCheckboxes(\"ecaptcha_moderate\", true, \"form_forum[]\"); return false;'>".LAN_ECAP_MOD_SELECT_FORUM."</a> ]
            <br />
            <br />
          </td>
        </tr>

      </table>
    </div>
  </form>";

  $ns -> tablerender(LAN_ECAP_ADM_TITLE, $text);

//------------------------------------------------------------------------------------------------------------+

  function ecaptcha_comment_delete($comment_id)
  {
    $comment_id   = mysql_real_escape_string($comment_id);

    $mysql_query  = "SELECT * FROM ".MPREFIX."comments WHERE `comment_pid` = '{$comment_id}'";
    $mysql_result = mysql_query($mysql_query) or die(mysql_error());

    while ($mysql_row = mysql_fetch_array($mysql_result, MYSQL_ASSOC))
    {
      ecaptcha_comment_delete($mysql_row['comment_id']);
    }

    $mysql_query  = "SELECT * FROM ".MPREFIX."comments WHERE `comment_id` = '{$comment_id}' LIMIT 1";
    $mysql_result = mysql_query($mysql_query) or die(mysql_error());
    $mysql_row    = mysql_fetch_array($mysql_result, MYSQL_ASSOC);

    if ($mysql_row['comment_type'] === "0")
    {
      $mysql_query  = "UPDATE ".MPREFIX."news SET `news_comment_total` = `news_comment_total` - 1 WHERE `news_id` = '{$mysql_row['comment_item_id']}' LIMIT 1";
      $mysql_result = mysql_query($mysql_query) or die(mysql_error());
    }

    $mysql_query  = "DELETE FROM ".MPREFIX."comments WHERE `comment_id` = '{$comment_id}' LIMIT 1";
    $mysql_result = mysql_query($mysql_query) or die(mysql_error());
  }

//------------------------------------------------------------------------------------------------------------+

  require_once(e_ADMIN."footer.php");

?>
