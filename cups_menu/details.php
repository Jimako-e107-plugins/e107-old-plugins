<?php

   /*
   -----------------------------------------------------------------------------------------------------------+
   |
   |	e107 website system
   |	CUPS PLUGIN
   |
   |	©Crytiqal.Aero 2010
   |	http://www.team-aero.co.nr
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

/*
if (!USER) {
   $ns->tablerender("Error!", "You must login to view this page");
   require_once(FOOTERF);
   exit;
}
*/

  unset($text);

  $mysql_table = MPREFIX."cups";
  
  $timestamp = time() + ($pref[time_offset] * 3600);

//------------------------------------------------------------------------------------------------------------+

  $_GET[id] = intval($_GET[id]);

  if (!$_GET[id]) { message_handler("MESSAGE", "Cup ID Missing"); require_once(FOOTERF); exit; }

  $mysql_result = mysql_query("SELECT * FROM $mysql_table WHERE id ='$_GET[id]' LIMIT 1") or die(mysql_error());

  $mysql_result_size = mysql_num_rows($mysql_result);

  if ($mysql_result_size < 1) { message_handler("MESSAGE", "Cup Does Not Exist"); require_once(FOOTERF); exit; }

  $mysql_row = mysql_fetch_array($mysql_result);

//------------------------------------------------------------------------------------------------------------+
include("cups_config.php");
//------------------------------------------------------------------------------------------------------------+


  if ($_POST[cups_submit_player_add] || $_POST[cups_submit_player_remove])
  {
    if (check_class($cups_player_class) && $mysql_row[result] == "pending_open")
    {
      unset($form_index);
      
      $mysql_row[players1] = unserialize($mysql_row[players1]);
  
      foreach ($mysql_row[players1] as $key=>$value)
      {
        $form_index++;

        if ($value != USERID.".".USERNAME)
        {
          $cups_players[$form_index] = $value;
        }
      }

      if ($_POST[cups_submit_player_add])
      {
        $form_index++;
        $cups_players[$form_index] = USERID.".".USERNAME;
      }
      
      asort($cups_players);
     
      $mysql_row[players1] = serialize($cups_players);

      // ESCAPE CONTENT TO STOP SYMBOLS CAUSING MYSQL ERRORS

      foreach ($mysql_row as $key => $value)
      {
        $mysql_row[$key] = mysql_real_escape_string($value);
      }

      // NOTE TO SELF - MYSQL_QUERY BELOW USES $MYSQL ARRAY NOT $POST

      $mysql_query  = "REPLACE INTO $mysql_table (id,gamename,gametype,league,event,rules,tag1,team1,result,players1,info,screenshots,demos,calendar,timestamp) VALUES ('$mysql_row[id]','$mysql_row[gamename]','$mysql_row[gametype]','$mysql_row[league]','$mysql_row[event]','$mysql_row[rules]','$mysql_row[tag1]','$mysql_row[team1]','$mysql_row[result]','$mysql_row[players1]','$mysql_row[info]','$mysql_row[screenshots]','$mysql_row[demos]','$mysql_row[calendar]','$mysql_row[timestamp]')";
      $mysql_result = mysql_query($mysql_query) or die(mysql_error());
      $mysql_id     = mysql_insert_id();

      header("Location:$_SERVER[PHP_SELF]?id=$mysql_id#players"); exit;
    }
  }

//------------------------------------------------------------------------------------------------------------+

  $mysql_row[players1]    = unserialize($mysql_row[players1]);
  $mysql_row[screenshots] = unserialize($mysql_row[screenshots]);
  $mysql_row[demos]       = unserialize($mysql_row[demos]);

  if (!check_class('$cups_player_class'))
  {
    if ($mysql_row[result] != "1st_place" && $mysql_row[result] != "2nd_place" && $mysql_row[result] != "3th_place")
    {
      $mysql_row[info]     = "Restricted to clan until cup has finished";
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
				<td class='forumheader3' style='text-align:center'><a href='index.php' style='text-decoration:none'>CUP LIST</a></td>";

  if (ADMIN || check_class($cups_admin_class))
  {
    $text .= "			<td class='forumheader3' style='text-align:center'><a href='cups_manage.php?action=add' style='text-decoration:none'>NEW CUP</a></td>
				<td class='forumheader3' style='text-align:center'><a href='cups_manage.php?action=edit"."&amp;"."id=$_GET[id]' style='text-decoration:none'>EDIT</a></td>
				<td class='forumheader3' style='text-align:center'><a href='cups_manage.php?action=delete"."&amp;"."id=$_GET[id]' style='text-decoration:none'>DELETE</a></td>";
  }

  $text .= "		</tr>
		</table>

		<br />
		<br />";

//------------------------------------------------------------------------------------------------------------+

  if ($mysql_row[result] == "1st_place")  	{ $cups_result = "1st Place"; }
  if ($mysql_row[result] == "2nd_place") 	{ $cups_result = "2nd Place"; }
  if ($mysql_row[result] == "3th_place")  	{ $cups_result = "3th Place"; }

  $cups_image_result   = "images/results/$mysql_row[result].gif";
      if (!file_exists($cups_image_result)) { $cups_image_result = "images/other/unknown.gif"; }
      $cups_image_result = "<img style='width:16px;height:16px' src='$cups_image_result' alt='' title='$mysql_row[result]' />";

  $text .= "<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
			<tr><td class='forumheader3' style='text-align:center;font-size:24px' colspan='3'> $cups_result $cups_image_result </td></tr>
			<tr><td class='forumheader3' style='text-align:center;font-size:14px' colspan='3'> $mysql_row[event] </td></tr>
		</table>
		
		<br />";


//------------------------------------------------------------------------------------------------------------+

  $text .= "	<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>

			<tr><td class='forumheader3' style='white-space:nowrap'> Date    	</td><td class='forumheader3'> ".date("d-m-y H:i ( l )",$mysql_row[timestamp])." </td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Game       	</td><td class='forumheader3'> $mysql_row[gamename]</td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Type       	</td><td class='forumheader3'> $mysql_row[gametype]</td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> League - Event   </td><td class='forumheader3'> $mysql_row[league] - $mysql_row[event]</td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Rules            </td><td class='forumheader3'> $mysql_row[rules] </td></tr>

			<tr><td colspan='2'><br /></td></tr>

			<tr><td class='forumheader3' style='white-space:nowrap'> Clan Tag   </td><td class='forumheader3'> $mysql_row[tag1] </td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Clan Name  </td><td class='forumheader3'> $mysql_row[team1] </td></tr>
			<tr><td class='forumheader3' style='white-space:nowrap'> Squad Name  </td><td class='forumheader3'> $cups_squad </td></tr>

		</table>";

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

  $text .= "	</table>";

//------------------------------------------------------------------------------------------------------------+

  $text .= "	<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
			<tr><td colspan='2'><br /></tr>
			<tr>
				<td class='forumheader3' style='text-align:center'> Info / Report </td>
			</tr>
			<tr>
				<td class='forumheader3'><center><div class='tbox' style='width:95%;height:100px;text-align:center;overflow:auto'><br />$mysql_row[info]</div><center></td>
			</tr>
			</table>
		
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
//-- PLEASE MAKE A DONATION OR SIGN THE GUESTBOOK AT WWW.TEAM-AERO.CO.NR IF YOU REMOVE THIS CREDIT ----------------------------------------------------------------------------------------------------+
  $text .= "<div style='text-align:center;font-family:tahoma;font-size:9px'><a rel='external' href='http://www.team-aero.co.nr' style='text-decoration:none'>Cups v1.2 By Crytiqal.Aero</a></div>";
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

  $ns -> tablerender("Cup Details", $text);

  require_once(FOOTERF);

?>