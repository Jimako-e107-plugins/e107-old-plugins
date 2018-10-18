<?php

 /*----------------------------------------------------------------------------------------------------------\
 |                                                                                                            |
 |                          [ ENEMY DOWN RANK ] [ © RICHARD PERRY FROM GREYCUBE.COM ]                         |
 |                                                                                                            |
 |    Released under the terms and conditions of the GNU General Public License Version 3 (http://gnu.org)    |
 |                                                                                                            |
 |-------------------------------------------------------------------------------------------------------------
 |        [ EDITOR STYLE SETTINGS: LUCIDA CONSOLE, SIZE 10, TAB = 2 SPACES, BOLD GLOBALLY TURNED OFF ]        |
 \-----------------------------------------------------------------------------------------------------------*/

//-----------------------------------------------------------------------------------------------------------+

  $eplug_admin = TRUE;

  require_once "../../class2.php";

  if (!getperms("P")) { echo "YOU DO NOT HAVE PERMISSION TO CONFIGURE ENEMY DOWN RANK"; exit; }

  require_once e_ADMIN."auth.php";

//-----------------------------------------------------------------------------------------------------------+

  if ($_POST['enemydownrank_update'])
  {
    $mysql_result = mysql_query("TRUNCATE `".MPREFIX."enemydownrank`") or die(mysql_error());

    foreach ($_POST['form_clan'] as $form_key => $not_used)
    {
      $clan_id   = mysql_real_escape_string(intval(trim($_POST['form_clan'][$form_key])));
      $ladder_id = mysql_real_escape_string(intval(trim($_POST['form_ladder'][$form_key])));

      if (!$clan_id || !$ladder_id) { continue; }

      $mysql_query  = "INSERT INTO `".MPREFIX."enemydownrank` (`clan_id`,`ladder_id`) VALUES ('{$clan_id}', '{$ladder_id}')";
      $mysql_result = mysql_query($mysql_query) or die(mysql_error());
    }
  }

//-----------------------------------------------------------------------------------------------------------+

  $output .= "
  <form method='post' action='{$_SERVER['PHP_SELF']}'>

    <div style='text-align:center'>
      <br />
      Remove an entry by clearing the fields.
      <br />
      <br />
      <br />
    </div>

    <table cellspacing='5' cellpadding='0' style='margin:auto'>

      <tr>
        <td style='white-space:nowrap'> [ Clan ID ]         </td>
        <td style='white-space:nowrap'> [ Ladder ID ]       </td>
      </tr>";

//-----------------------------------------------------------------------------------------------------------+

  $mysql_result = mysql_query("SELECT * FROM `".MPREFIX."enemydownrank` ORDER BY `id` ASC");

  while($mysql_row = mysql_fetch_array($mysql_result, MYSQL_ASSOC))
  {
    $output .= "
      <tr>
        <td> <input class='tbox' type='text' name='form_clan[]'   value='{$mysql_row['clan_id']}'   size='10'  maxlength='10' /> </td>
        <td> <input class='tbox' type='text' name='form_ladder[]' value='{$mysql_row['ladder_id']}' size='10'  maxlength='10' /> </td>
      </tr>";
  }

//-----------------------------------------------------------------------------------------------------------+

  $output .= "

      <tr>
        <td> <input class='tbox' type='text' name='form_clan[]'   value='' size='10'  maxlength='10' /> </td>
        <td> <input class='tbox' type='text' name='form_ladder[]' value='' size='10'  maxlength='10' /> </td>
      </tr>

      <tr>
        <td colspan='2' style='text-align:center'>
          <br />
          <input class='tbox'  type='submit' name='enemydownrank_update' value='Update and Empty Cache' />
        </td>
      </tr>

    </table>

  </form>";

//-----------------------------------------------------------------------------------------------------------+

  $ns -> tablerender("Enemy Down Rank", $output);

  require_once e_ADMIN."footer.php";

//-----------------------------------------------------------------------------------------------------------+

?>
