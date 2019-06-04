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

//------------------------------------------------------------------------------------------------------------+
include("cups_config.php");
//------------------------------------------------------------------------------------------------------------+

  if (!ADMIN && !check_class($cups_admin_class)) { echo "You do not have permission"; exit; }

  ob_start(); // STORE DATA UNTIL FINISHED TO FIX REDIRECTION
  require_once(HEADERF);
  require_once("magic_quotes_handler.php");

  $mysql_table = MPREFIX."cups";

  unset($text);
  unset($form);

//------------------------------------------------------------------------------------------------------------+

  if (!$_GET[action]) { message_handler("MESSAGE", "Action Missing"); require_once(FOOTERF); exit; }

//------------------------------------------------------------------------------------------------------------+

  // SET CALENDAR TABLES
   
  if ($pref[cups_calendartype] == "1") { $cal_cat = "ecal_cats"; $cal_event = "ecal_events"; }
  else                                 { $cal_cat = "event_cat"; $cal_event = "event";       }

//------------------------------------------------------------------------------------------------------------+

  // LOAD DEFAULT FIELDS INTO THE FORM

  foreach ($pref as $key => $value)
  {
    if (substr($key, 0, 13) == "cups_default_")
    {
      $key = substr($key, 13); // REMOVE CUPS_DEFAULT_ PREFIX
      $form[$key] = $value;    // SET DEFAULT FORM DATA
    }
  }

  // CONVERT ANY $_POST WHICH ARE PREFIXED WITH _CUPS INTO $form WHICH OVERWRITES THE DEFAULTS ABOVE

  foreach ($_POST as $key => $value)
  {
    if (substr($key, 0, 5) == "cups_")
    {
      $key = substr($key, 5); // REMOVE CUPS_DEFAULT_ PREFIX
      $form[$key] = $value;   // SET DEFAULT FORM DATA
    }
  }

  // LOAD CLAN SQUAD LIST AND SET THE TAG AND TEAM

  $cups_squads = unserialize($pref[cups_squads]);
  $form[tag1]  = $cups_squads[$form[team]][tag];
  $form[team1] = $cups_squads[$form[team]][name];

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

    // TODO: LOOK UP ID STORED WITHIN THE CUP AND USE THAT TO DELETE ENTRY - REMOVE CUP ID FROM CALENDAR ENTRY
    
    if ($pref[cups_addtocalendar])
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
    if ($_POST[cups_submit_add])
    {

//------------------------------------------------------------------------------------------------------------+

      if (!$form[tag1])  { $form[tag1]  = "Unknown"; }
      if (!$form[team1]) { $form[team1] = "Unknown"; }
    
      $form[players1]    = serialize($form[players1]);
      
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

      // PUT IN PLACE HOLDER SO THAT THE CALENDAR ENTRY ID CAN BE ADDED TO CUPS

      if ($pref[cups_addtocalendar] && !$form[calendar])
      {
        $mysql_query  = "REPLACE INTO ".MPREFIX."$cal_event (event_id,event_title) VALUES ('','PLACE HOLDER')";
        $mysql_result = mysql_query($mysql_query) or die(mysql_error());
        $form[calendar] = mysql_insert_id();
      }

      // ADD OR UPDATE THE CUP

      $mysql_query  = "REPLACE INTO $mysql_table (id,gamename,gametype,league,event,rules,tag1,team1,result,players1,info,screenshots,demos,calendar,timestamp) VALUES ('$form[id]','$form[gamename]','$form[gametype]','$form[league]','$form[event]','$form[rules]','$form[tag1]','$form[team1]','$form[result]','$form[players1]','$form[info]','$form[screenshots]','$form[demos]','$form[calendar]','$form[timestamp]')";
      $mysql_result = mysql_query($mysql_query) or die(mysql_error());
      $cups_id      = mysql_insert_id();

//------------------------------------------------------------------------------------------------------------+
include("cups_config.php");
//------------------------------------------------------------------------------------------------------------+

      if ($pref[cups_addtocalendar])
      {
        // FIND EXISTING CALENDAR CATEGORY OR CREATE NEW

        $mysql_result = mysql_query("SELECT * FROM ".MPREFIX."$cal_cat WHERE event_cat_name = '$cups_cal_category' LIMIT 1") or die(mysql_error());
        $mysql_row    = mysql_fetch_array($mysql_result);

        if (!$mysql_row[event_cat_id])
        {
          $mysql_result = mysql_query("REPLACE INTO ".MPREFIX."$cal_cat (event_cat_id,event_cat_name,event_cat_icon) VALUES ('','$cups_cal_category','../../cups_menu/images/other/calendar.gif')") or die(mysql_error());
          $cups_calendar_category = mysql_insert_id();
        }
        else
        {
          $cups_calendar_category = $mysql_row[event_cat_id];
        }

        // CONTENT FOR THE CALENDAR ENTRY

     // $cal_team1 = htmlspecialchars($form[tag1], ENT_QUOTES);
        $cal_cups_league = htmlspecialchars($form[league], ENT_QUOTES);
        $cal_cups_event = htmlspecialchars($form[event], ENT_QUOTES);

        $calendar_title   = "[CUP] $cal_cups_league - $cal_cups_event";
        $calendar_subject = "<br /><a href='".e_PLUGIN."cups_menu/details.php?id=$cups_id'>View Cup Details</a><br /><br />";

        $calendar_title   = mysql_real_escape_string($calendar_title);
        $calendar_subject = mysql_real_escape_string($calendar_subject);

        // REPLACE PLACE HOLDER OR UPDATE EXISTING ENTRY

        $mysql_query  = "REPLACE INTO ".MPREFIX."$cal_event (event_id,event_start,event_end,event_datestamp,event_title,event_location,event_details,event_author,event_category) VALUES ('$form[calendar]','$form[timestamp]','$form[timestamp]','$cups_id','$calendar_title','$form[server]','$calendar_subject','1.Cups','$cups_calendar_category')";
        $mysql_result = mysql_query($mysql_query) or die(mysql_error());
      }

//------------------------------------------------------------------------------------------------------------+

      // SEND EMAIL TO ALL CLAN MEMBERS PROVIDED IF ITS A NEW CUP

      if ($pref[cups_email_all] && !$form[id])
      {
        // EMAIL CONTENT

        $cups_folder    = SITEURL.$PLUGINS_DIRECTORY."cups_menu/details.php?id=$cups_id";
        $mail_message   = "A new Cup has been added\r\n\r\nFor details goto:\r\n$cups_folder\r\n\r\n";
        $mail_from      = $pref[cups_email];
        $mail_from_name = "Team-Aero.co.nr";
        $mail_subject   = "[CUP] A new Cup has been added".date($pref[cups_date_format], $form[timestamp]);

        // GET THE ID FOR THE CLAN USERCLASS

        $mysql_query       = "SELECT * FROM ".MPREFIX."userclass_classes WHERE userclass_name = '$cups_player_class' LIMIT 1";
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

      if ($pref[cups_email_chosen])
      {
        // EMAIL CONTENT
      
        $cups_folder    = SITEURL.$PLUGINS_DIRECTORY."cups_menu/details.php?id=$cups_id";
        $mail_message   = "You have won a new Cup\r\n\r\nFor details goto:\r\n$cups_folder\r\n\r\n";
        $mail_from      = $pref[cups_email];
        $mail_from_name = "Team-Aero.co.nr";
        $mail_subject   = "[CUP] Congratulations! ".date($pref[cups_date_format], $form[timestamp]);
 
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
     
      header("Location:details.php?id=$cups_id"); exit;

    }
  }
  
//------------------------------------------------------------------------------------------------------------+

  if ($_GET[action] == "edit")
  {
    if (!$_GET[id]) { message_handler("MESSAGE", "Cup ID Missing"); require_once(FOOTERF); exit; }

    $mysql_query  = "SELECT * FROM $mysql_table WHERE id = '$_GET[id]' LIMIT 1";
    $mysql_result = mysql_query($mysql_query) or die(mysql_error());
    $mysql_row    = mysql_fetch_array($mysql_result);
    
    if (!$mysql_row[id]) { message_handler("MESSAGE", "Cup Does Not Exist"); require_once(FOOTERF); exit; }

    $form              = $mysql_row;
    $form[players1]    = unserialize($form[players1]);
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

  // STOPS JUMPING TO PLAYERS WHEN FIRST SETTING THE GAMENAME OR EDITING AN EXISTING CUP
  
  unset($form_jump);
  
  if ($_POST[cups_gamename] || $_GET[action] == "edit")
  {
    $form_jump = "#team";
  }

//------------------------------------------------------------------------------------------------------------+

  $text .= "

  	<div style='text-align:center'>
  
  	<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
		<tr>
			<td class='forumheader3' style='text-align:center'><a href='index.php' style='text-decoration:none'>CUP LIST</a></td>
			<td class='forumheader3' style='text-align:center'><a href='cups_manage.php?action=add' style='text-decoration:none'>NEW CUP</a></td>
		</tr>
	</table>
	<br />

	<form method='post' action='$_SERVER[PHP_SELF]?action=add$form_jump'>
		<div>
			<input type='hidden' name='cups_id' value='$form[id]' />
			<input type='hidden' name='cups_calendar' value='$form[calendar]' />
		</div>

		<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='forumheader3'>Date</td>
				<td class='forumheader3' style='white-space:nowrap'>";

//------------------------------------------------------------------------------------------------------------+
  $text .= "<select class='tbox' name='cups_day'>";
  for ($i=1; $i<= 31; $i++)
  {
    if ($i < 10) { $ii = "0".$i; } else { $ii = $i; }
    unset($selected); if ($ii == date("d",$form[timestamp])) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$ii'>$ii</option>";
  }
  $text .= "</select>";
//------------------------------------------------------------------------------------------------------------+
  $text .= "<select class='tbox' name='cups_month'>";
  for ($i=1; $i<= 12; $i++)
  {
    if ($i < 10) { $ii = "0".$i; } else { $ii = $i; }
    unset($selected); if ($ii == date("m",$form[timestamp])) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$ii'>$ii</option>";
  }
  $text .= "</select>";
//------------------------------------------------------------------------------------------------------------+
  $text .= "<select class='tbox' name='cups_year'>";
  for ($i=3; $i<= 50; $i++)
  {
    if ($i < 10) { $ii = "0" . $i; } else { $ii = $i; }
    unset($selected); if ($ii == date("y",$form[timestamp])) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$ii'>$ii</option>";
  }
  $text .= "</select> - ";
//------------------------------------------------------------------------------------------------------------+
  $text .= "<select class='tbox' name='cups_hour'>";
  for ($i=0; $i<= 23; $i++)
  {
    if ($i < 10) { $ii = "0".$i; } else { $ii = $i; }
    unset($selected); if ($ii == date("H",$form[timestamp])) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$ii'>$ii</option>";
  }
  $text .= "</select>:";
//------------------------------------------------------------------------------------------------------------+
  $text .= "<select class='tbox' name='cups_minute'>";
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
					<select class='tbox' style='width:95%' name='cups_gamename'>";
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
  if (!$_POST[cups_gamename] && $_GET[action] != "edit") // STOP HERE UNTIL GAME IS SET WHICH EFFECTS WHAT MAPS ARE LOADED
  {
    $text .= "		<tr><td colspan='2'><br /></td></tr>

    			<tr>
				<td class='forumheader3' style='text-align:center' colspan='2'>
					<input class='tbox' type='submit' name='cups_submit_update' value='Set Game' />
				</td>
			</tr>
		</table>
	</form>

	</div>";
    
    $ns -> tablerender("Cups Manage", $text);
    unset($fh); // e107 0.616 Footer Bug Fix
    require_once(FOOTERF); exit;
  }
//-----------------------------------------------------------------------------------------------------------+
  $text .= "	<tr>
				<td class='forumheader3'>Type</td>
				<td class='forumheader3'>
					<select class='tbox' style='width:95%' name='cups_gametype'>";
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
  $text .= "	<tr>
				<td class='forumheader3'>League</td>
				<td class='forumheader3'>
					<select class='tbox' style='width:95%' name='cups_league'>";
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
			</tr>
    			<tr><td class='forumheader3'> Event       </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='cups_event'      value='$form[event]'      /></td></tr>
    			<tr><td class='forumheader3'> Rules       </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='cups_rules'      value='$form[rules]'      /></td></tr>";
//-----------------------------------------------------------------------------------------------------------+
  $text .= "	<tr><td colspan='2'><br /></td></tr>
  			<tr>
  				<td class='forumheader3'>Team</td>
				<td class='forumheader3'>
					<select class='tbox' style='width:95%' name='cups_team'>
						<option value=''> -------- Select Team -------- </option>";

  foreach ($cups_squads as $key=>$value)  // $CUPS_SQUADS IS UNSERIALIZED AT THE TOP
  {
    $value[tag]  = htmlspecialchars($value[tag],  ENT_QUOTES); // SYMBOLS TO ENTITIES
    $value[name] = htmlspecialchars($value[name], ENT_QUOTES); // SYMBOLS TO ENTITIES
  
    unset($selected); if ($form[tag1] == $value[tag] && $form[team1] == $value[name]) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$key'>$value[tag] - $value[name]</option>";
  }
 
  $text .= "			</select>
				</td>
			</tr>";
//-----------------------------------------------------------------------------------------------------------+
include("cups_config.php");
//-----------------------------------------------------------------------------------------------------------+

  $text .= "	<tr><td colspan='2'><br /></td></tr>
    			<tr>
  				<td class='forumheader3'>Squad</td>
				<td class='forumheader3'>$cups_userclass</td>
			</tr>";

//-----------------------------------------------------------------------------------------------------------+

  $text .= "		<tr><td colspan='2'><br /></td></tr>

  			<tr><td colspan='2'><br /></td></tr>

			<tr><td class='forumheader3'> Info </td>
			<td class='forumheader3'> <textarea class='tbox'name='cups_info' rows='' cols='' style='width:95%;height:100px'>$form[info]</textarea></td></tr>

		</table>

		<div id='team'><br /></div>";

//-----------------------------------------------------------------------------------------------------------+

  $text .= "	<table style='width:95%;border-collapse:collapse;' cellspacing='0' cellpadding='0'>";

//-----------------------------------------------------------------------------------------------------------+

  $text .= "	<tr><td colspan='4'><br /></td></tr>			

			<tr>
				<td class='forumheader3' style='text-align:center' colspan='4'>
					<input class='tbox' type='submit' name='cups_submit_update' value='Update Game and Players' />
				</td>
			</tr>

  			<tr><td colspan='3'><br /></td></tr>";		
		
//-----------------------------------------------------------------------------------------------------------+

  $form_index = count($form[players1]) + 1;

  $text .= "		<tr>
				<td class='forumheader3'>
					<select class='tbox' style='width:200px' name='cups_players1[$form_index]'>";

//-----------------------------------------------------------------------------------------------------------+

  // GET THE ID FOR THE CLAN USERCLASS

  $mysql_query       = "SELECT * FROM ".MPREFIX."userclass_classes WHERE userclass_name = '$cups_userclass' LIMIT 1";
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
					<select class='tbox' style='width:200px' name='cups_players1[$form_index]'>
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
					Cup Status
				</td>
				<td class='forumheader3' colspan='3'>
					<select class='tbox' style='width:95%' name='cups_result'>";
  
  unset($selected); if ($form[result] == "1st_place") { $selected="selected='selected'"; }
  $text .= "<option $selected value='1st_place'> 1st Place </option>";

  unset($selected); if ($form[result] == "2nd_place") { $selected="selected='selected'"; }
  $text .= "<option $selected value='2nd_place'> 2nd Place </option>";

  unset($selected); if ($form[result] == "3th_place") { $selected="selected='selected'"; }
  $text .= "<option $selected value='3th_place'> 3th Place </option>";

  $text .= "				</select>
				</td>
			</tr>
			<tr><td class='forumheader3'> Screenshots </td><td class='forumheader3'> <textarea class='tbox' name='cups_screenshots' rows='' cols='' style='width:95%;height:40px'>$form[screenshots]</textarea> </td></tr>
			<tr><td class='forumheader3'> Demos       </td><td class='forumheader3'> <textarea class='tbox' name='cups_demos'       rows='' cols='' style='width:95%;height:40px'>$form[demos]</textarea>       </td></tr>
		</table>
		
		<div><br /><br /></div>
		
  		<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='forumheader3' style='text-align:center'>
					<input class='tbox' type='submit' name='cups_submit_add' value='Add or Update Cup' />
				</td>
			</tr>
		</table>
	</form>
	


	<br />
	<br />
	<br />
	</div>";

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
//-- PLEASE MAKE A DONATION OR SIGN THE GUESTBOOK AT WWW.TEAM-AERO.CO.NR IF YOU REMOVE THIS CREDIT ----------------------------------------------------------------------------------------------------+
  $text .= "<div style='text-align:center;font-family:tahoma;font-size:9px'><a rel='external' href='http://www.team-aero.co.nr' style='text-decoration:none'>Cups v1.2 By Crytiqal.Aero</a></div>";
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

  $ns -> tablerender("Cups Manage", $text);

  unset($fh); // e107 0.616 Footer Bug Fix

  require_once(FOOTERF);

?>