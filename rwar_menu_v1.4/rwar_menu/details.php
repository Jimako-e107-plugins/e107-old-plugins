<?php

   /*
   -----------------------------------------------------------------------------------------------------------+
   |
   |	e107 website system
   |	RWAR PLUGIN
   |
   |	©Richard Perry 2004
   |	http://www.greycube.com
   |
   |	Released under the terms and conditions of the
   |	GNU General Public License (http://gnu.org).
   |
   +----------------------------------------------------------------------------------------------------------+
   */

//------------------------------------------------------------------------------------------------------------+

  require_once("../../class2.php");

  ob_start(); // STORE DATA UNTIL FINISHED TO FIX REDIRECTION
  require_once(HEADERF);

  unset($text);

  $mysql_table = MPREFIX."rwar";
  
  $map_image_size = "style='width:80px;height:60px'"; // BROWSER RESIZE SO LGSL IMAGES CAN JUST BE COPIED

  $timestamp = time() + ($pref[time_offset] * 3600);

//------------------------------------------------------------------------------------------------------------+

  $_GET[id] = intval($_GET[id]);

  if (!$_GET[id]) { message_handler("MESSAGE", "War ID Missing"); require_once(FOOTERF); exit; }

  $mysql_result = mysql_query("SELECT * FROM $mysql_table WHERE id ='$_GET[id]' LIMIT 1") or die(mysql_error());

  $mysql_result_size = mysql_num_rows($mysql_result);

  if ($mysql_result_size < 1) { message_handler("MESSAGE", "War Does Not Exist"); require_once(FOOTERF); exit; }

  $mysql_row = mysql_fetch_array($mysql_result);

//------------------------------------------------------------------------------------------------------------+

  if ($_POST[rwar_submit_player_add] || $_POST[rwar_submit_player_remove])
  {
    if (check_class('CLAN') && $mysql_row[result] == "pending_open")
    {
      unset($form_index);
      
      $mysql_row[players1] = unserialize($mysql_row[players1]);
  
      foreach ($mysql_row[players1] as $key=>$value)
      {
        $form_index++;

        if ($value != USERID.".".USERNAME)
        {
          $rwar_players[$form_index] = $value;
        }
      }

      if ($_POST[rwar_submit_player_add])
      {
        $form_index++;
        $rwar_players[$form_index] = USERID.".".USERNAME;
      }
      
      asort($rwar_players);
     
      $mysql_row[players1] = serialize($rwar_players);

      // ESCAPE CONTENT TO STOP SYMBOLS CAUSING MYSQL ERRORS

      foreach ($mysql_row as $key => $value)
      {
        $mysql_row[$key] = mysql_real_escape_string($value);
      }

      // NOTE TO SELF - MYSQL_QUERY BELOW USES $MYSQL ARRAY NOT $POST

      $mysql_query  = "REPLACE INTO $mysql_table (id,gamename,gametype,league,tag1,tag2,team1,team2,maps,sides,scores1,scores2,result,players1,players2,server,serverpass,contact,website,irc,rules,info,screenshots,demos,calendar,timestamp) VALUES ('$mysql_row[id]','$mysql_row[gamename]','$mysql_row[gametype]','$mysql_row[league]','$mysql_row[tag1]','$mysql_row[tag2]','$mysql_row[team1]','$mysql_row[team2]','$mysql_row[maps]','$mysql_row[sides]','$mysql_row[scores1]','$mysql_row[scores2]','$mysql_row[result]','$mysql_row[players1]','$mysql_row[players2]','$mysql_row[server]','$mysql_row[serverpass]','$mysql_row[contact]','$mysql_row[website]','$mysql_row[irc]','$mysql_row[rules]','$mysql_row[info]','$mysql_row[screenshots]','$mysql_row[demos]','$mysql_row[calendar]','$mysql_row[timestamp]')";
      $mysql_result = mysql_query($mysql_query) or die(mysql_error());
      $mysql_id     = mysql_insert_id();

      header("Location:$_SERVER[PHP_SELF]?id=$mysql_id#players"); exit;
    }
  }

//------------------------------------------------------------------------------------------------------------+

  $mysql_row[maps]        = unserialize($mysql_row[maps]);
  $mysql_row[sides]       = unserialize($mysql_row[sides]);
  $mysql_row[scores1]     = unserialize($mysql_row[scores1]);
  $mysql_row[scores2]     = unserialize($mysql_row[scores2]);
  $mysql_row[players1]    = unserialize($mysql_row[players1]);
  $mysql_row[players2]    = unserialize($mysql_row[players2]);
  $mysql_row[screenshots] = unserialize($mysql_row[screenshots]);
  $mysql_row[demos]       = unserialize($mysql_row[demos]);

  if (!check_class('CLAN') && !check_class('RWAR'))
  {
    $mysql_row[serverpass] = "Restricted to clan";
    $mysql_row[contact]    = "Restricted to clan";
    
    if ($mysql_row[result] != "won" && $mysql_row[result] != "lost" && $mysql_row[result] != "draw"  && $mysql_row[result] != "cancelled")
    {
      $mysql_row[info]     = "Restricted to clan until war has finished";
    }
  }

  // CONVERT SYMBOLS INTO BROWSER HTML ENTITIES

  foreach ($mysql_row as $key => $value)
  {
    if (!is_array($value))
    {
      $mysql_row[$key] = htmlspecialchars($value, ENT_QUOTES);
    }
  }

/*----------------------------------------------------------------------+
  // REVERSE ENTITIES FOR INFO TO ALLOW HTML CODE - DISABLED BY DEFAULT
  $trans_table = array_flip(get_html_translation_table(HTML_ENTITIES));
  $mysql_row[info] = strtr($mysql_row[info], $trans_table);
+----------------------------------------------------------------------*/

  // NEWLINE TO BR TAG HERE TO AVOID BEING MADE AN ENTITY

  $mysql_row[info] = nl2br($mysql_row[info]);
  
//------------------------------------------------------------------------------------------------------------+

  $text .= "	<div style='text-align:center'>

		<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='forumheader3' style='text-align:center'><a href='index.php' style='text-decoration:none'>WAR LIST</a></td>";

  if (ADMIN || check_class(RWAR))
  {
    $text .= "			<td class='forumheader3' style='text-align:center'><a href='rwar_manage.php?action=add' style='text-decoration:none'>NEW WAR</a></td>
				<td class='forumheader3' style='text-align:center'><a href='rwar_manage.php?action=edit"."&amp;"."id=$_GET[id]' style='text-decoration:none'>EDIT</a></td>
				<td class='forumheader3' style='text-align:center'><a href='rwar_manage.php?action=delete"."&amp;"."id=$_GET[id]' style='text-decoration:none'>DELETE</a></td>";
  }

  if ($pref[rwar_challenge] && $pref[rwar_challenge_show])
  {
    $text .= "			<td class='forumheader3' style='text-align:center'><a href='challenge.php' style='text-decoration:none'>CHALLENGE US</a></td>";
  }
  
  $text .= "		</tr>
		</table>

		<br />
		<br />";

//------------------------------------------------------------------------------------------------------------+

  $text .= "	<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>

			<tr><td class='forumheader3' style='white-space:nowrap'> Date and Time    </td><td class='forumheader3'> ".date("d-m-y H:i ( l )",$mysql_row[timestamp])." </td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Game             </td><td class='forumheader3'> $mysql_row[gamename]</td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Type             </td><td class='forumheader3'> $mysql_row[gametype]</td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> League           </td><td class='forumheader3'> $mysql_row[league] </td></tr>

			<tr><td colspan='2'><br /></td></tr>

			<tr><td class='forumheader3' style='white-space:nowrap'> Clan Squad Tag   </td><td class='forumheader3'> $mysql_row[tag1] </td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Clan Squad Name  </td><td class='forumheader3'> $mysql_row[team1] </td></tr>

			<tr><td colspan='2'><br /></td></tr>

			<tr><td class='forumheader3' style='white-space:nowrap'> Opponent Tag     </td><td class='forumheader3'> $mysql_row[tag2] </td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Opponent Name    </td><td class='forumheader3'> $mysql_row[team2] </td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Opponent Contact </td><td class='forumheader3'> $mysql_row[contact]  </td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Opponent Website </td><td class='forumheader3'> <a rel='external' href='$mysql_row[website]'>$mysql_row[website]</a> </td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Opponent IRC     </td><td class='forumheader3'> <a rel='external' href='$mysql_row[irc]'>$mysql_row[irc]</a> </td></tr>

			<tr><td colspan='2'><br /></td></tr>

			<tr><td class='forumheader3' style='white-space:nowrap'> Rules            </td><td class='forumheader3'> $mysql_row[rules] </td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Server           </td><td class='forumheader3'> $mysql_row[server] </td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Server Pass      </td><td class='forumheader3'> $mysql_row[serverpass]  </td></tr>

			<tr>
				<td class='forumheader3'> Info / Report </td>
				<td class='forumheader3'>
					<div class='tbox' style='width:95%;height:100px;overflow:auto'>$mysql_row[info]</div>
				</td>
			</tr>

		</table>
		
		<br />
		<br />";

//------------------------------------------------------------------------------------------------------------+

  $text .= "	<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='forumheader3'> Map </td>
				<td class='forumheader3'> Clan Side </td>
   				<td class='forumheader3'> Clan Score </td>
				<td class='forumheader3'> Opponent Score </td>
			</tr>";

  foreach ($mysql_row[maps] as $key => $value)
  {
    $map_image = e_PLUGIN."rwar_menu/images/game/$mysql_row[gamename]/$value.jpg";
    
    if (file_exists($map_image))
    {
      $map_image = "<img src='$map_image' alt='' title='$value' $map_image_size />";
    }
    else
    {
      $map_image = "<br />$value<br /><br />";
    }
    
    $mysql_row[sides][$key] = htmlspecialchars($mysql_row[sides][$key], ENT_QUOTES); // SYMBOLS TO ENTITIES

    $text .= "		<tr>
				<td class='forumheader3'> $map_image </td>
				<td class='forumheader3'> {$mysql_row[sides][$key]} </td>
				<td class='forumheader3' style='font-size:15px'> {$mysql_row[scores1][$key]} </td>
				<td class='forumheader3' style='font-size:15px'> {$mysql_row[scores2][$key]} </td>
			</tr>";
  }
  
  $rwar_total_score1 = array_sum($mysql_row[scores1]);
  $rwar_total_score2 = array_sum($mysql_row[scores2]);
  
  if ($mysql_row[result] == "pending_open")   { $rwar_result = "Pending";                     }
  if ($mysql_row[result] == "pending_closed") { $rwar_result = "Pending with Players Chosen"; }
  if ($mysql_row[result] == "won")            { $rwar_result = "Won";                         }
  if ($mysql_row[result] == "lost")           { $rwar_result = "Lost";                        }
  if ($mysql_row[result] == "draw")           { $rwar_result = "Draw";                        }
  if ($mysql_row[result] == "cancelled")      { $rwar_result = "Cancelled";                   }
  if ($mysql_row[result] == "challenge")      { $rwar_result = "Challenge";                   }

  $text .= "		<tr>
  				
  				<td class='forumheader3' colspan='2'> Total </td>
				<td class='forumheader3' style='font-size:18px'> $rwar_total_score1 </td>
				<td class='forumheader3' style='font-size:18px'> $rwar_total_score2 </td>
			</tr>
			<tr>

				<td class='forumheader3'> Result </td>
				<td class='forumheader3' style='font-size:18px' colspan='3'> $rwar_result </td>
			</tr>
		</table>
		
		<br />";


//------------------------------------------------------------------------------------------------------------+

  $text .= "	<div id='players'><br /></div>
  
  		<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>

  			<tr><td class='forumheader3' colspan='2'> Players </td></tr>";

  foreach ($mysql_row[players1] as $key=>$value)
  {
    $user_bits = explode(".", $value, 2);
    $user_id   = $user_bits[0];
    $user_name = $user_bits[1];
  
    $text .= "		<tr>
				<td class='forumheader3'>$user_name</td>
				
				<td class='forumheader3' style='text-align:center'>
					<a rel='external' href='../../user.php?id.$user_id'>Profile</a>
				</td>
			</tr>";
  }

//------------------------------------------------------------------------------------------------------------+

  if (check_class('CLAN') && $mysql_row[result] == "pending_open")
  {
    $text .= "		<tr>
  				<td><br /></td>
				<td class='forumheader3' style='text-align:center'>
					<form method='post' action='$_SERVER[PHP_SELF]?id=$_GET[id]'>
				
				
				";

    if (in_array(USERID.".".USERNAME, $mysql_row[players1]))
    {
      $text .= "<input class='tbox' type='submit' name='rwar_submit_player_remove' value='Remove Me' />";
    }
    else
    {
      $text .= "<input class='tbox'  type='submit' name='rwar_submit_player_add' value='Add Me' />";
    }

    $text .= "				</form>
  				</td>
			</tr>";
  }

//------------------------------------------------------------------------------------------------------------+
  
  $text .= "	</table>
  
  		<br />
  		<br />";

//------------------------------------------------------------------------------------------------------------+

  $text .= "	<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>";

  if ($mysql_row[screenshots])
  {
    $text .= "	<tr><td class='forumheader3'> Screenshots </td></tr>";

    foreach ($mysql_row[screenshots] as $key => $value)
    {
      // SHORTEN LONG LINKS TO AVOID SITE STRETCHING
      if (strlen($value) > 55) { $value_short = " ...".substr($value, -55); } else { $value_short = $value; }

      $text .= "<tr><td class='forumheader3'><a rel='external' href='$value'> $value_short </a></td></tr>";
    }
  }

  if ($mysql_row[demos])
  {
    $text .= "	<tr><td class='forumheader3'> Demos </td></tr>";

    foreach ($mysql_row[demos] as $key => $value)
    {
      // SHORTEN LONG LINKS TO AVOID SITE STRETCHING
      if (strlen($value) > 55) { $value_short = " ...".substr($value, -55); } else { $value_short = $value; }

      $text .= "<tr><td class='forumheader3'><a rel='external' href='$value'> $value_short </a></td></tr>";
    }
  }

  $text .= "	</table>



		<br />
		<br />
		<br />
		</div>";

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
//-- PLEASE MAKE A DONATION OR SIGN THE GUESTBOOK AT WWW.GREYCUBE.COM IF YOU REMOVE THIS CREDIT ----------------------------------------------------------------------------------------------------+
  $text .= "<div style='text-align:center;font-family:tahoma;font-size:9px'><a rel='external' href='http://www.greycube.com' style='text-decoration:none'>RWar 1.4 By Richard Perry</a></div>";
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

  $ns -> tablerender("RWar Details", $text);

  require_once(FOOTERF);

?>