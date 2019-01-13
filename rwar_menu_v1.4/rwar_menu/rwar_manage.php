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

  if (!ADMIN && !check_class('RWAR')) { echo "You do not have permission"; exit; }

  ob_start(); // STORE DATA UNTIL FINISHED TO FIX REDIRECTION
  require_once(HEADERF);
  require_once("magic_quotes_handler.php");

  $mysql_table = MPREFIX."rwar";

  unset($text);
  unset($form);

//------------------------------------------------------------------------------------------------------------+

  if (!$_GET[action]) { message_handler("MESSAGE", "Action Missing"); require_once(FOOTERF); exit; }

//------------------------------------------------------------------------------------------------------------+

  // SET CALENDAR TABLES
   
  if ($pref[rwar_calendartype] == "1") { $cal_cat = "ecal_cats"; $cal_event = "ecal_events"; }
  else                                 { $cal_cat = "event_cat"; $cal_event = "event";       }

//------------------------------------------------------------------------------------------------------------+

  // LOAD DEFAULT FIELDS INTO THE FORM

  foreach ($pref as $key => $value)
  {
    if (substr($key, 0, 13) == "rwar_default_")
    {
      $key = substr($key, 13); // REMOVE RWAR_DEFAULT_ PREFIX
      $form[$key] = $value;    // SET DEFAULT FORM DATA
    }
  }

  // CONVERT ANY $_POST WHICH ARE PREFIXED WITH _rwar INTO $form WHICH OVERWRITES THE DEFAULTS ABOVE

  foreach ($_POST as $key => $value)
  {
    if (substr($key, 0, 5) == "rwar_")
    {
      $key = substr($key, 5); // REMOVE RWAR_DEFAULT_ PREFIX
      $form[$key] = $value;   // SET DEFAULT FORM DATA
    }
  }

  // LOAD CLAN SQUAD LIST AND SET THE TAG AND TEAM

  $rwar_squads = unserialize($pref[rwar_squads]);
  $form[tag1]  = $rwar_squads[$form[squad]][tag];
  $form[team1] = $rwar_squads[$form[squad]][name];

//------------------------------------------------------------------------------------------------------------+

  if ($form[hour])
  {
    $form[timestamp] = mktime($form[hour], $form[minute], 0, $form[month], $form[day], $form[year]);
  }
  else
  {
    $form[timestamp] = time() + ($pref[time_offset] * 3600);
  }

//------------------------------------------------------------------------------------------------------------+

  if ($_GET[action] == "delete")
  {
    $mysql_result = mysql_query("DELETE FROM $mysql_table WHERE id = '$_GET[id]' LIMIT 1") or die(mysql_error());

    // TODO: LOOK UP ID STORED WITHIN THE WAR AND USE THAT TO DELETE ENTRY - REMOVE WAR ID FROM CALENDAR ENTRY
    
    if ($pref[rwar_addtocalendar])
    {
      $mysql_result = mysql_query("DELETE FROM ".MPREFIX."$cal_event WHERE event_datestamp = '$_GET[id]' LIMIT 1") or die(mysql_error());
    }

    header("Location:index.php"); exit;
  }

//------------------------------------------------------------------------------------------------------------+

  // IF THE CUSTOM MAP FIELD IS USED OVERIDE THE DROPDOWN WHILE ALSO FILTERING THE NAME FOR SYMBOLS

  if ($form[custom_map])
  {
    $form[custom_map] = strtolower(preg_replace("/[^0-9a-z_-]/i","", $form[custom_map]));
    $form[maps][$form[custom_map_id]] = $form[custom_map];
  }

//------------------------------------------------------------------------------------------------------------+

  // REMOVE MAPS AND RE-INDEX WHILE MAKING SURE THAT SCORES ARE A NUMBER

  unset($tmp);
  unset($form_index);

  foreach ($form[maps] as $key=>$value)
  {
    if ($value)
    { 
      $form_index++;
      
      $tmp[maps][$form_index]    = $form[maps][$key];
      $tmp[sides][$form_index]   = $form[sides][$key];
      $tmp[scores1][$form_index] = intval($form[scores1][$key]);
      $tmp[scores2][$form_index] = intval($form[scores2][$key]);
    }
  }

  $form[maps]    = $tmp[maps];
  $form[sides]   = $tmp[sides];
  $form[scores1] = $tmp[scores1];
  $form[scores2] = $tmp[scores2];
  
//------------------------------------------------------------------------------------------------------------+

  // REMOVE AND ARRAY SORT PLAYERS

  foreach ($form[players1] as $key=>$value)
  {
    if (!$value)
    {
      unset($form[players1][$key]);
    }
  }
  
  asort($form[players1]);

//------------------------------------------------------------------------------------------------------------+

  if ($_GET[action] == "add")
  {
    if ($_POST[rwar_submit_add])
    {

//------------------------------------------------------------------------------------------------------------+

      if (!$form[tag1])  { $form[tag1]  = "Unknown"; }
      if (!$form[tag2])  { $form[tag2]  = "Unknown"; }    
      if (!$form[team1]) { $form[team1] = "Unknown"; }
      if (!$form[team2]) { $form[team2] = "Unknown"; }
    
      $form[website]     = "http://".eregi_replace("http://", "", trim($form[website]));
      $form[irc]         = "irc://".eregi_replace("irc://", "", trim($form[irc]));

      $form[maps]        = serialize($form[maps]);
      $form[sides]       = serialize($form[sides]);
      $form[scores1]     = serialize($form[scores1]);
      $form[scores2]     = serialize($form[scores2]);
      $form[players1]    = serialize($form[players1]);
      $form[players2]    = serialize($form[players2]);
      
      $form[screenshots] = explode("\r", $form[screenshots]);
      foreach ($form[screenshots] as $key => $value)
      {
        if (!trim($value)) { unset($form[screenshots][$key]); }
        else               { $form[screenshots][$key] = "http://".eregi_replace("http://", "", trim($value)); }
      }      

      $form[demos] = explode("\r", $form[demos]);
      foreach ($form[demos] as $key => $value)
      {
        if (!trim($value)) { unset($form[demos][$key]); }
        else               { $form[demos][$key] = "http://".eregi_replace("http://", "", trim($value)); }
      }    

      $form[screenshots] = serialize($form[screenshots]);
      $form[demos]       = serialize($form[demos]);

//------------------------------------------------------------------------------------------------------------+

      // ESCAPE CONTENT TO STOP SYMBOLS CAUSING MYSQL ERRORS

      foreach ($form as $key => $value)
      {
        $form[$key] = mysql_real_escape_string($value);
      }

//------------------------------------------------------------------------------------------------------------+

      // PUT IN PLACE HOLDER SO THAT THE CALENDAR ENTRY ID CAN BE ADDED TO RWAR

      if ($pref[rwar_addtocalendar] && !$form[calendar])
      {
        $mysql_query  = "REPLACE INTO ".MPREFIX."$cal_event (event_id,event_title) VALUES ('','PLACE HOLDER')";
        $mysql_result = mysql_query($mysql_query) or die(mysql_error());
        $form[calendar] = mysql_insert_id();
      }

      // ADD OR UPDATE THE WAR

      $mysql_query  = "REPLACE INTO $mysql_table (id,gamename,gametype,league,tag1,tag2,team1,team2,maps,sides,scores1,scores2,result,players1,players2,server,serverpass,contact,website,irc,rules,info,screenshots,demos,calendar,timestamp) VALUES ('$form[id]','$form[gamename]','$form[gametype]','$form[league]','$form[tag1]','$form[tag2]','$form[team1]','$form[team2]','$form[maps]','$form[sides]','$form[scores1]','$form[scores2]','$form[result]','$form[players1]','$form[players2]','$form[server]','$form[serverpass]','$form[contact]','$form[website]','$form[irc]','$form[rules]','$form[info]','$form[screenshots]','$form[demos]','$form[calendar]','$form[timestamp]')";
      $mysql_result = mysql_query($mysql_query) or die(mysql_error());
      $rwar_id      = mysql_insert_id();

//------------------------------------------------------------------------------------------------------------+

      if ($pref[rwar_addtocalendar])
      {
        // FIND EXISTING CALENDAR CATEGORY OR CREATE NEW

        $mysql_result = mysql_query("SELECT * FROM ".MPREFIX."$cal_cat WHERE event_cat_name = 'War' LIMIT 1") or die(mysql_error());
        $mysql_row    = mysql_fetch_array($mysql_result);
        
        if (!$mysql_row[event_cat_id])
        {
          $mysql_result = mysql_query("REPLACE INTO ".MPREFIX."$cal_cat (event_cat_id,event_cat_name,event_cat_icon) VALUES ('','War','../../rwar_menu/images/other/calendar.gif')") or die(mysql_error());
          $rwar_calendar_category = mysql_insert_id();
        }
        else
        {
          $rwar_calendar_category = $mysql_row[event_cat_id];
        }

        // CONTENT FOR THE CALENDAR ENTRY

        $cal_team1 = htmlspecialchars($form[tag1], ENT_QUOTES);
        $cal_team2 = htmlspecialchars($form[tag2], ENT_QUOTES);

        $calendar_title   = "[WAR] $cal_team1 vs $cal_team2";
        $calendar_subject = "<br /><a href=\'".e_PLUGIN."rwar_menu/details.php?id=$rwar_id'>View War Details</a><br /><br />";

        $calendar_title   = mysql_real_escape_string($calendar_title);
        $calendar_subject = mysql_real_escape_string($calendar_subject);

        // REPLACE PLACE HOLDER OR UPDATE EXISTING ENTRY

        $mysql_query  = "REPLACE INTO ".MPREFIX."$cal_event (event_id,event_start,event_end,event_datestamp,event_title,event_location,event_details,event_author,event_category) VALUES ('$form[calendar]','$form[timestamp]','$form[timestamp]','$rwar_id','$calendar_title','$form[server]','$calendar_subject','1.RWar','$rwar_calendar_category')";
        $mysql_result = mysql_query($mysql_query) or die(mysql_error());
      }

//------------------------------------------------------------------------------------------------------------+

      // SEND EMAIL TO ALL CLAN MEMBERS PROVIDED IF ITS A NEW WAR

      if ($pref[rwar_email_pending] && $form[result] == "pending_open" && !$form[id])
      {
        // EMAIL CONTENT

        $rwar_folder    = SITEURL.$PLUGINS_DIRECTORY."rwar_menu/details.php?id=$rwar_id";
        $mail_message   = "A new war has been added\r\n\r\nFor details goto:\r\n$rwar_folder\r\n\r\n";
        $mail_from      = $pref[rwar_email];
        $mail_from_name = "RWAR ADMIN";
        $mail_subject   = "[WAR] Added and Open to Players ".date($pref[rwar_date_format], $form[timestamp]);

        // GET THE ID FOR THE CLAN USERCLASS

        $mysql_query       = "SELECT * FROM ".MPREFIX."userclass_classes WHERE userclass_name = 'CLAN' LIMIT 1";
        $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
        $mysql_row         = mysql_fetch_array($mysql_result);  
        $userclass_id      = $mysql_row[userclass_id];
  
        // SELECT ALL USERS WHO HAVE A USERCLASS SET AND RUN CHECK_CLASS LATER

        $mysql_query       = "SELECT * FROM ".MPREFIX."user WHERE user_class != '' ORDER BY user_id ASC";
        $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
        $mysql_result_size = mysql_num_rows($mysql_result);

        for ($i=1; $i<=$mysql_result_size; $i++)
        {
          $mysql_row = mysql_fetch_array($mysql_result);
    
          if (check_class($userclass_id, $mysql_row[user_class]))
          {
            $mail_to = $mysql_row[user_email];

            require_once(e_HANDLER."mail.php");
            sendemail($mail_to, $mail_subject, $mail_message, $mail_to, $mail_from, $mail_from_name);
          }
        }
      }

//------------------------------------------------------------------------------------------------------------+

      // SEND EMAIL TO CHOSEN PLAYERS

      if ($pref[rwar_email_chosen] && $form[result] == "pending_closed")
      {
        // EMAIL CONTENT
      
        $rwar_folder    = SITEURL.$PLUGINS_DIRECTORY."rwar_menu/details.php?id=$rwar_id";
        $mail_message   = "You have been chosen to play in a War\r\n\r\nFor details goto:\r\n$rwar_folder\r\n\r\n";
        $mail_from      = $pref[rwar_email];
        $mail_from_name = "RWAR ADMIN";
        $mail_subject   = "[WAR] Reminder ".date($pref[rwar_date_format], $form[timestamp]);
 
        $form[players1] = stripslashes($form[players1]); // BECAUSE OF MYSQL_REAL_ESCAPE_STRING EARLIER
        $form[players1] = unserialize($form[players1]);  // PUT PLAYERS BACK INTO AN ARRAY
        
        foreach ($form[players1] as $key=>$value)
        {
          $user_bits    = explode(".", $value, 2);
          $user_id      = $user_bits[0];
          
          $mysql_result = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id = '$user_id' LIMIT 1") or die(mysql_error());
          $mysql_row    = mysql_fetch_array($mysql_result);
          $mail_to      = $mysql_row[user_email];

          require_once(e_HANDLER."mail.php");
          sendemail($mail_to, $mail_subject, $mail_message, $mail_to, $mail_from, $mail_from_name);
        }
      }
     
      header("Location:details.php?id=$rwar_id"); exit;

    }
  }
  
//------------------------------------------------------------------------------------------------------------+

  if ($_GET[action] == "edit")
  {
    if (!$_GET[id]) { message_handler("MESSAGE", "War ID Missing"); require_once(FOOTERF); exit; }

    $mysql_query  = "SELECT * FROM $mysql_table WHERE id = '$_GET[id]' LIMIT 1";
    $mysql_result = mysql_query($mysql_query) or die(mysql_error());
    $mysql_row    = mysql_fetch_array($mysql_result);
    
    if (!$mysql_row[id]) { message_handler("MESSAGE", "War Does Not Exist"); require_once(FOOTERF); exit; }

    $form              = $mysql_row;
    $form[maps]        = unserialize($form[maps]);
    $form[sides]       = unserialize($form[sides]);
    $form[scores1]     = unserialize($form[scores1]);
    $form[scores2]     = unserialize($form[scores2]);
    $form[players1]    = unserialize($form[players1]);
    $form[players2]    = unserialize($form[players2]);
    $form[screenshots] = implode("\r", unserialize($form[screenshots]));
    $form[demos]       = implode("\r", unserialize($form[demos]));
  }

//------------------------------------------------------------------------------------------------------------+

  // CONVERT FORM SYMBOLS INTO ENTITIES OTHERWISE THE BROWSER WILL MIX THEM UP WITH THE HTML
  // THIS GOES TWO ARRAYS DEEP

  foreach ($form as $key => $value)
  {
    if (!is_array($value))
    {
      $form[$key] = htmlspecialchars($value, ENT_QUOTES);
    }
    else
    {
      foreach ($form[$key] as $key2 => $value2)
      {
        if (!is_array($value2))
        {
          $form[$key][$key2] = htmlspecialchars($value2, ENT_QUOTES);
        }
      }
    }
  }

//------------------------------------------------------------------------------------------------------------+

  // STOPS JUMPING TO MAPS WHEN FIRST SETTING THE GAMENAME OR EDITING AN EXISTING WAR
  
  unset($form_jump);
  
  if ($_POST[rwar_gamename] || $_GET[action] == "edit")
  {
    $form_jump = "#maps";
  }

//------------------------------------------------------------------------------------------------------------+

  $text .= "

  	<div style='text-align:center'>
  
  	<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
		<tr>
			<td class='forumheader3' style='text-align:center'><a href='index.php' style='text-decoration:none'>WAR LIST</a></td>
			<td class='forumheader3' style='text-align:center'><a href='rwar_manage.php?action=add' style='text-decoration:none'>NEW WAR</a></td>
		</tr>
	</table>
	<br />

	<form method='post' action='$_SERVER[PHP_SELF]?action=add$form_jump'>
		<div>
			<input type='hidden' name='rwar_id' value='$form[id]' />
			<input type='hidden' name='rwar_calendar' value='$form[calendar]' />
		</div>

		<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='forumheader3'>Date and Time</td>
				<td class='forumheader3' style='white-space:nowrap'>";

//------------------------------------------------------------------------------------------------------------+
  $text .= "<select class='tbox' name='rwar_day'>";
  for ($i=1; $i<= 31; $i++)
  {
    if ($i < 10) { $ii = "0".$i; } else { $ii = $i; }
    unset($selected); if ($ii == date("d",$form[timestamp])) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$ii'>$ii</option>";
  }
  $text .= "</select>";
//------------------------------------------------------------------------------------------------------------+
  $text .= "<select class='tbox' name='rwar_month'>";
  for ($i=1; $i<= 12; $i++)
  {
    if ($i < 10) { $ii = "0".$i; } else { $ii = $i; }
    unset($selected); if ($ii == date("m",$form[timestamp])) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$ii'>$ii</option>";
  }
  $text .= "</select>";
//------------------------------------------------------------------------------------------------------------+
  $text .= "<select class='tbox' name='rwar_year'>";
  for ($i=3; $i<= 50; $i++)
  {
    if ($i < 10) { $ii = "0" . $i; } else { $ii = $i; }
    unset($selected); if ($ii == date("y",$form[timestamp])) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$ii'>$ii</option>";
  }
  $text .= "</select> - ";
//------------------------------------------------------------------------------------------------------------+
  $text .= "<select class='tbox' name='rwar_hour'>";
  for ($i=0; $i<= 23; $i++)
  {
    if ($i < 10) { $ii = "0".$i; } else { $ii = $i; }
    unset($selected); if ($ii == date("H",$form[timestamp])) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$ii'>$ii</option>";
  }
  $text .= "</select>:";
//------------------------------------------------------------------------------------------------------------+
  $text .= "<select class='tbox' name='rwar_minute'>";
  for ($i=0; $i<= 59; $i+=15)
  {
    if ($i < 10) { $ii = "0".$i; } else { $ii = $i; }
    unset($selected); if ($ii == date("i",$form[timestamp])) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$ii'>$ii</option>";
  }
  $text .= "</select>";
//------------------------------------------------------------------------------------------------------------+

  $text .= "			</td>
			</tr>
			
			<tr><td colspan='2'><br /></td></tr>";

//------------------------------------------------------------------------------------------------------------+
  $text .= "		<tr>
				<td class='forumheader3'>Game</td>
				<td class='forumheader3'>
					<select class='tbox' style='width:95%' name='rwar_gamename'>";
  $fh = opendir("images/game/");
  while($fn = readdir($fh)) 
  {
    if ($fn == "." || $fn == ".." || !is_dir("images/game/$fn")) { continue; }
    
    unset($selected); if ($fn == $form[gamename]) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$fn'>$fn</option>";
  }
  closedir($fh);
  $text .= "				</select>
  				</td>
  			</tr>";
//-----------------------------------------------------------------------------------------------------------+
  if (!$_POST[rwar_gamename] && $_GET[action] != "edit") // STOP HERE UNTIL GAME IS SET WHICH EFFECTS WHAT MAPS ARE LOADED
  {
    $text .= "		<tr><td colspan='2'><br /></td></tr>

    			<tr>
				<td class='forumheader3' style='text-align:center' colspan='2'>
					<input class='tbox' type='submit' name='rwar_submit_update' value='Set Game' />
				</td>
			</tr>
		</table>
	</form>

	</div>";
    
    $ns -> tablerender("RWar Manage", $text);
    unset($fh); // e107 0.616 Footer Bug Fix
    require_once(FOOTERF); exit;
  }
//-----------------------------------------------------------------------------------------------------------+
  $text .= "		<tr>
				<td class='forumheader3'>Type</td>
				<td class='forumheader3'>
					<select class='tbox' style='width:95%' name='rwar_gametype'>";
  $fh = opendir("images/type/");
  while($fn = readdir($fh)) 
  {
    if ($fn == "." || $fn == "..") { continue; }
    
    $fn = substr($fn, 0, -4);  // REMOVE THE .GIF FROM THE FILENAME

    unset($selected); if ($fn == $form[gametype]) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$fn'>$fn</option>";
  }
  closedir($fh);
  $text .= "				</select>
				</td>
			</tr>";
//-----------------------------------------------------------------------------------------------------------+
  $text .= "		<tr>
				<td class='forumheader3'>League</td>
				<td class='forumheader3'>
					<select class='tbox' style='width:95%' name='rwar_league'>";
  $fh = opendir("images/league/");
  while($fn = readdir($fh)) 
  {
    if ($fn == "." || $fn == "..") { continue; }
    
    $fn = substr($fn, 0, -4);  // REMOVE THE .GIF FROM THE FILENAME

    unset($selected); if ($fn == $form[league]) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$fn'>$fn</option>";
  }
  closedir($fh);
  $text .= "				</select>
				</td>
			</tr>";
//-----------------------------------------------------------------------------------------------------------+

  $text .= "		<tr><td colspan='2'><br /></td></tr>
  
  			<tr>
  				<td class='forumheader3'>Clan Squad</td>
				<td class='forumheader3'>
					<select class='tbox' style='width:95%' name='rwar_squad'>
						<option value=''> -------- Select Squad -------- </option>";

  foreach ($rwar_squads as $key=>$value)  // $RWAR_SQUADS IS UNSERIALIZED AT THE TOP
  {
    $value[tag]  = htmlspecialchars($value[tag],  ENT_QUOTES); // SYMBOLS TO ENTITIES
    $value[name] = htmlspecialchars($value[name], ENT_QUOTES); // SYMBOLS TO ENTITIES
  
    unset($selected); if ($form[tag1] == $value[tag] && $form[team1] == $value[name]) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$key'>$value[tag] - $value[name]</option>";
  }
 
  $text .= "				</select>
				</td>
			</tr>";

//-----------------------------------------------------------------------------------------------------------+

  $text .= "		<tr><td colspan='2'><br /></td></tr>

			<tr>
			<td class='forumheader3' style='white-space:nowrap'> Opponent Tag and Name</td>
			<td class='forumheader3'>
			<input class='tbox' style='width:25%' maxlength='20'  type='text' name='rwar_tag2'  value='$form[tag2]'  />
			<input class='tbox' style='width:68%' maxlength='128' type='text' name='rwar_team2' value='$form[team2]' />
			</td>
			</tr>

			<tr><td class='forumheader3'> Opponent Contact </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_contact' value='$form[contact]' /></td></tr>
			<tr><td class='forumheader3'> Opponent Website </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_website' value='$form[website]' /></td></tr>
			<tr><td class='forumheader3'> Opponent IRC     </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_irc'     value='$form[irc]'     /></td></tr>

			<tr><td colspan='2'><br /></td></tr>

  			<tr><td class='forumheader3'> Rules       </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_rules'      value='$form[rules]'      /></td></tr>
			<tr><td class='forumheader3'> Server      </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_server'     value='$form[server]'     /></td></tr>
			<tr><td class='forumheader3'> Server Pass </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_serverpass' value='$form[serverpass]' /></td></tr>

  			<tr><td colspan='2'><br /></td></tr>

			<tr><td class='forumheader3'> Info </td>
			<td class='forumheader3'> <textarea class='tbox'name='rwar_info' rows='' cols='' style='width:95%;height:100px'>$form[info]</textarea></td></tr>

		</table>

		<div id='maps'><br /></div>";

//-----------------------------------------------------------------------------------------------------------+

  $text .= "	<table style='width:95%;border-collapse:collapse;' cellspacing='0' cellpadding='0'>
  			<tr>
				<td><br /></td>
				<td class='forumheader3'>Clan Side</td>
				<td class='forumheader3'>Clan Score</td>
				<td class='forumheader3'>Opponent Score</td>
			</tr>";

  unset($form_index);
  
  foreach ($form[maps] as $key=>$value)
  {
    $text .= "		<tr>
				<td class='forumheader3'>
					<select class='tbox' style='width:200px' name='rwar_maps[$key]'>
						<option selected='selected' value='$value'>$value</option>
						<option value=''>Remove Map</option>
					</select>
				</td>";

//-----------------------------------------------------------------------------------------------------------+
    $text .= "			<td class='forumheader3'>
  					<select class='tbox' name='rwar_sides[$key]'>";

    $rwar_sides_list = unserialize($pref[rwar_sides]);
    
    foreach ($rwar_sides_list as $key2 => $value2)
    {
      $value2 = htmlspecialchars($value2, ENT_QUOTES); // SYMBOLS TO ENTITIES
    
      unset($selected); if ($form[sides][$key] == $value2) { $selected="selected='selected'"; }
      $text .= "<option $selected value='$value2'>$value2</option>";
    }
    
    unset($selected); if (!$form[sides][$key]) { $selected="selected='selected'"; }
    $text .= "<option $selected value=''>Not Used</option>";

    $text .= "				</select>
  				</td>";
//-----------------------------------------------------------------------------------------------------------+

    $text .= "			<td class='forumheader3'>
					<input class='tbox' type='text' name='rwar_scores1[$key]' value='{$form[scores1][$key]}' style='width:70px' maxlength='128' />
				</td>
				<td class='forumheader3'>
					<input class='tbox' type='text' name='rwar_scores2[$key]' value='{$form[scores2][$key]}' style='width:70px' maxlength='128' />
				</td>
			</tr>";
  }
  
  $form_index = count($form[maps]) + 1; // CARRY ON INDEX FROM LAST NUMBER OF MAPS
  
  $text .= "		<tr>
				<td class='forumheader3'>
					<select class='tbox' style='width:200px' name='rwar_maps[$form_index]'>
						<option selected='selected' value=''> -------- Select Map -------- </option>";

//-----------------------------------------------------------------------------------------------------------+
  $fh = opendir("images/game/$form[gamename]/");
  while($fn = readdir($fh)) 
  {
    if ($fn == "." || $fn == ".." || (substr($fn, -4) != ".jpg")) { continue; }
    
    $map_list[] = substr($fn, 0, -4); // REMOVE .JPG AND PUT INTO ARRAY
  }
  closedir($fh);

  sort($map_list); // SORT THE MAPS INTO ALPHABETICAL ORDER
  
  foreach($map_list as $key=>$value)
  {
    $text .= "<option value='$value'>$value</option>"; // ADD TO DROPDOWN MENU
  }
//-----------------------------------------------------------------------------------------------------------+

  $text .= "				</select>

					<br /><br />
					<input type='hidden' name='rwar_custom_map_id' value='$form_index' />
					<input title='or type in a Map Name' class='tbox' type='text' name='rwar_custom_map' value='' style='width:195px' maxlength='128' />
				</td>";

//-----------------------------------------------------------------------------------------------------------+
  $text .= "			<td class='forumheader3'>
  					<select class='tbox' name='rwar_sides[$form_index]'>";

  $rwar_sides_list = unserialize($pref[rwar_sides]);

  foreach ($rwar_sides_list as $key => $value)
  {
    $value = htmlspecialchars($value, ENT_QUOTES); // SYMBOLS TO ENTITIES

    $text .= "<option value='$value'>$value</option>";
  }				

  $text .= "<option selected='selected' value=''>Not Used</option>";

  $text .= "				</select>
  				</td>";
//-----------------------------------------------------------------------------------------------------------+

  $text .= "			<td class='forumheader3'>
					<input class='tbox' type='text' name='rwar_scores1[$form_index]' value='' style='width:70px' maxlength='128' />
				</td>
				<td class='forumheader3'>
					<input class='tbox' type='text' name='rwar_scores2[$form_index]' value='' style='width:70px' maxlength='128' />
				</td>
			</tr>

  			<tr><td colspan='4'><br /></td></tr>			

			<tr>
				<td class='forumheader3' style='text-align:center' colspan='4'>
					<input class='tbox' type='submit' name='rwar_submit_update' value='Update Maps and Players' />
				</td>
			</tr>

  			<tr><td colspan='3'><br /></td></tr>";		
		
//-----------------------------------------------------------------------------------------------------------+

  $form_index = count($form[players1]) + 1;

  $text .= "		<tr>
				<td class='forumheader3'>
					<select class='tbox' style='width:200px' name='rwar_players1[$form_index]'>";

//-----------------------------------------------------------------------------------------------------------+

  // GET THE ID FOR THE CLAN USERCLASS

  $mysql_query       = "SELECT * FROM ".MPREFIX."userclass_classes WHERE userclass_name = 'CLAN' LIMIT 1";
  $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
  $mysql_row         = mysql_fetch_array($mysql_result);  
  $userclass_id      = $mysql_row[userclass_id];
  
  // SELECT ALL USERS WHO HAVE A USERCLASS SET AND RUN CHECK_CLASS LATER

  $mysql_query       = "SELECT * FROM ".MPREFIX."user WHERE user_class != '' ORDER BY user_id ASC";
  $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
  $mysql_result_size = mysql_num_rows($mysql_result);

//-----------------------------------------------------------------------------------------------------------+

  $text .= "<option selected='selected' value=''> -------- Select Player -------- </option>";

  for ($i=1; $i<=$mysql_result_size; $i++)
  {
    $mysql_row = mysql_fetch_array($mysql_result);
    
    if (check_class($userclass_id, $mysql_row[user_class]))
    {
      if (!in_array("$mysql_row[user_id].$mysql_row[user_name]", $form[players1]))
      {
        $text .= "<option value='$mysql_row[user_id].$mysql_row[user_name]'>$mysql_row[user_id].$mysql_row[user_name]</option>";
      }
    }
  }

  $text .= "				</select>
				</td>
				<td colspan='2'><br /></td>
			</tr>";
  unset($form_index);
  
  foreach ($form[players1] as $key=>$value)
  {
    $form_index++;
    
    $user_bits = explode(".", $value, 2);
    $user_id   = $user_bits[0];
    $user_name = $user_bits[1];
  
    $text .= "		<tr>
				<td class='forumheader3'>
					<select class='tbox' style='width:200px' name='rwar_players1[$form_index]'>
						<option selected='selected' value='$value'>$value</option>
						<option value=''>Remove Player</option>
					</select>
				</td>
				<td class='forumheader3' style='text-align:center' colspan='2'>
					<a rel='external' href='../../user.php?id.$user_id'>Profile</a>
				</td>
			</tr>";
  }

  $text .= "	</table>

  		<div><br /><br /></div>";


//-----------------------------------------------------------------------------------------------------------+
		
  $text .= "	<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
	  		<tr>
				<td class='forumheader3'>
					War Status
				</td>
				<td class='forumheader3' colspan='3'>
					<select class='tbox' style='width:95%' name='rwar_result'>";
  
  unset($selected); if ($form[result] == "pending_open") { $selected="selected='selected'"; }
  $text .= "<option $selected value='pending_open'> Pending </option>";

  unset($selected); if ($form[result] == "pending_closed") { $selected="selected='selected'"; }
  $text .= "<option $selected value='pending_closed'> Pending with Players Chosen </option>";

  unset($selected); if ($form[result] == "won") { $selected="selected='selected'"; }
  $text .= "<option $selected value='won'> Won </option>";

  unset($selected); if ($form[result] == "lost") { $selected="selected='selected'"; }
  $text .= "<option $selected value='lost'> Lost </option>";

  unset($selected); if ($form[result] == "draw") { $selected="selected='selected'"; }
  $text .= "<option $selected value='draw'> Draw </option>";

  unset($selected); if ($form[result] == "cancelled") { $selected="selected='selected'"; }
  $text .= "<option $selected value='cancelled'> Cancelled </option>";

  unset($selected); if ($form[result] == "challenge") { $selected="selected='selected'"; }
  $text .= "<option $selected value='challenge'> Challenge </option>";

  $text .= "				</select>
				</td>
			</tr>
			<tr><td class='forumheader3'> Screenshots </td><td class='forumheader3'> <textarea class='tbox' name='rwar_screenshots' rows='' cols='' style='width:95%;height:40px'>$form[screenshots]</textarea> </td></tr>
			<tr><td class='forumheader3'> Demos       </td><td class='forumheader3'> <textarea class='tbox' name='rwar_demos'       rows='' cols='' style='width:95%;height:40px'>$form[demos]</textarea>       </td></tr>
		</table>
		
		<div><br /><br /></div>
		
  		<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='forumheader3' style='text-align:center'>
					<input class='tbox' type='submit' name='rwar_submit_add' value='Add or Update War' />
				</td>
			</tr>
		</table>
	</form>
	


	<br />
	<br />
	<br />
	</div>";

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
//-- PLEASE MAKE A DONATION OR SIGN THE GUESTBOOK AT WWW.GREYCUBE.COM IF YOU REMOVE THIS CREDIT ----------------------------------------------------------------------------------------------------+
  $text .= "<div style='text-align:center;font-family:tahoma;font-size:9px'><a rel='external' href='http://www.greycube.com' style='text-decoration:none'>RWar 1.4 By Richard Perry</a></div>";
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

  $ns -> tablerender("RWar Manage", $text);

  unset($fh); // e107 0.616 Footer Bug Fix

  require_once(FOOTERF);

?>