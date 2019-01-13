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

//-----------------------------------------------------------------------------------------------------------+

  $eplug_admin = TRUE;
  require_once "../../class2.php"; if(!getperms("P")) { echo "You do not have permission"; exit; }
  ob_start(); // STORE DATA UNTIL FINISHED TO FIX REDIRECTION
  require_once(e_ADMIN."auth.php");
  require_once("magic_quotes_handler.php");
 
//-----------------------------------------------------------------------------------------------------------+

  if($_POST[rwar_submit])
  {
  
//-----------------------------------------------------------------------------------------------------------+

    foreach ($_POST[rwar_squads] as $key=>$value)
    {
      if (!$value[tag] || !$value[name])
      {
        unset($_POST[rwar_squads][$key]);
      }
    }
    
    $_POST[rwar_squads] = serialize($_POST[rwar_squads]);

//-----------------------------------------------------------------------------------------------------------+

    foreach ($_POST[rwar_sides] as $key=>$value)
    {
      if (!$value)
      {
        unset($_POST[rwar_sides][$key]);
      }
    }
    
    $_POST[rwar_sides] = serialize($_POST[rwar_sides]);

//-----------------------------------------------------------------------------------------------------------+
    
    if ($_POST[rwar_addtocalendar])
    {
      if ($_POST[rwar_calendartype] == "1") { $cal_cat = "ecal_cats"; }
      else                                  { $cal_cat = "event_cat"; }
    
      $mysql_result = mysql_query("SELECT 1 FROM ".MPREFIX."$cal_cat LIMIT 0");
     
      if (!$mysql_result)
      {
        $_POST[rwar_addtocalender] = 0;
        message_handler("MESSAGE", "Calendar Must Be Installed for the ADDTOCALENDAR Option"); require_once(e_ADMIN."footer.php"); exit;
      }
    }

//-----------------------------------------------------------------------------------------------------------+
  
    unset($_POST[rwar_submit]);
  
    foreach ($_POST as $key => $value)
    {
      if (substr($key, 0, 5) == "rwar_")
      {
        $pref[$key] = $value;
      }
    }

    save_prefs(); // SAVE RWAR PREFERENCES
    
    header("Location:$_SERVER[PHP_SELF]", true); exit; // RELOAD PAGE AFTER SAVING PREFS TO FIX 0.617 HTML ENTITIES BUG
  }

//-----------------------------------------------------------------------------------------------------------+

  $text .= "
	
	<form method='post' action='$_SERVER[PHP_SELF]'>
		<table style='width:95%;border-collapse:collapse;' cellpadding='0' cellspacing='0'>
			<tr>
				<td class='forumheader3' style='text-align:center'>
					<a href='index.php' style='text-decoration:none'>WAR LIST</a>
				</td>
				<td class='forumheader3' style='text-align:center'>
					<a href='".e_PLUGIN."rwar_menu/rwar_backup.php?action=backup' style='text-decoration:none'>BACKUP WARS</a>
				</td>
				<td class='forumheader3' style='text-align:center'>
					<a href='".e_PLUGIN."rwar_menu/rwar_backup.php?action=restore' style='text-decoration:none'>RESTORE WARS</a>
				</td>
			</tr>
		</table>

		<div><br /></div>

		<table style='width:95%;border-collapse:collapse;' cellpadding='0' cellspacing='0'>
			<tr>
				<td class='forumheader3'>
					Admin Email
				</td>
				<td class='forumheader3'>
					<input class='tbox' type='text' name='rwar_email' value='$pref[rwar_email]' style='width:95%' maxlength='128' />
				</td>
			</tr>";

  unset($selected); if ($pref[rwar_email_pending])  { $selected = "selected='selected'"; } $text .= "<tr><td class='forumheader3'> Email New Pending Wars </td><td class='forumheader3'><select class='tbox' name='rwar_email_pending'>  <option value='0'> NO       </option> <option $selected value='1'> YES       </option> </select></td></tr>";
  unset($selected); if ($pref[rwar_email_chosen])   { $selected = "selected='selected'"; } $text .= "<tr><td class='forumheader3'> Email Chosen Players   </td><td class='forumheader3'><select class='tbox' name='rwar_email_chosen'>   <option value='0'> NO       </option> <option $selected value='1'> YES       </option> </select></td></tr>";
  unset($selected); if ($pref[rwar_challenge])      { $selected = "selected='selected'"; } $text .= "<tr><td class='forumheader3'> Challenge Us           </td><td class='forumheader3'><select class='tbox' name='rwar_challenge'>      <option value='0'> DISABLED </option> <option $selected value='1'> ENABLED   </option> </select></td></tr>";
  unset($selected); if ($pref[rwar_challenge_show]) { $selected = "selected='selected'"; } $text .= "<tr><td class='forumheader3'> Challenge Us Option    </td><td class='forumheader3'><select class='tbox' name='rwar_challenge_show'> <option value='0'> HIDDEN   </option> <option $selected value='1'> VISIBLE   </option> </select></td></tr>";
  unset($selected); if ($pref[rwar_challenge_user]) { $selected = "selected='selected'"; } $text .= "<tr><td class='forumheader3'> Challenge Us Access    </td><td class='forumheader3'><select class='tbox' name='rwar_challenge_user'> <option value='0'> GUESTS   </option> <option $selected value='1'> MEMBERS   </option> </select></td></tr>";
  unset($selected); if ($pref[rwar_addtocalendar])  { $selected = "selected='selected'"; } $text .= "<tr><td class='forumheader3'> Add Wars to Calendar   </td><td class='forumheader3'><select class='tbox' name='rwar_addtocalendar'>  <option value='0'> NO       </option> <option $selected value='1'> YES       </option> </select></td></tr>";
  unset($selected); if ($pref[rwar_calendartype])   { $selected = "selected='selected'"; } $text .= "<tr><td class='forumheader3'> Select Calendar        </td><td class='forumheader3'><select class='tbox' name='rwar_calendartype'>   <option value='0'> Standard </option> <option $selected value='1'> ECalendar </option> </select></td></tr>";
  unset($selected); if ($pref[rwar_menu_stats])     { $selected = "selected='selected'"; } $text .= "<tr><td class='forumheader3'> Menu Stats             </td><td class='forumheader3'><select class='tbox' name='rwar_menu_stats'>     <option value='0'> NO       </option> <option $selected value='1'> YES       </option> </select></td></tr>";

//-----------------------------------------------------------------------------------------------------------+

  $text .= "		<tr>
				<td class='forumheader3'>
					Menu Pending Wars
				</td>
				<td class='forumheader3'>
					<select class='tbox' name='rwar_menu_pending'>";
  for ($i=0; $i<= 10; $i++)
  {
    unset($selected); if ($pref[rwar_menu_pending] == $i) { $selected = "selected='selected'"; }
    $text .= "<option $selected value='$i'>$i</option>";
  }

  $text .= "				</select>
				</td>
			</tr>";

//-----------------------------------------------------------------------------------------------------------+

  $text .= "		<tr>
				<td class='forumheader3'>
					Menu Previous Wars
				</td>
				<td class='forumheader3'>
					<select class='tbox' name='rwar_menu_previous'>";

  for ($i=0; $i<= 10; $i++)
  {
    unset($selected); if ($pref[rwar_menu_previous] == $i) { $selected = "selected='selected'"; }
    $text .= "<option $selected value='$i'>$i</option>";
  }

  $text .= "				</select>
				</td>
			</tr>";

//-----------------------------------------------------------------------------------------------------------+

  $text .= "		<tr><td colspan='2'><br /></td></tr>
			<tr>
				<td class='forumheader3'> Date Format </td>
				<td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_date_format' value='$pref[rwar_date_format]' /></td>
			</tr>
			<tr><td colspan='2'><br /></td></tr>";

//-----------------------------------------------------------------------------------------------------------+
  $text .= "		<tr>
				<td class='forumheader3'>Default Game</td>
				<td class='forumheader3'>
					<select class='tbox' style='width:95%' name='rwar_default_gamename'>";
  $fh = opendir("images/game/");
  while($fn = readdir($fh)) 
  {
    if ($fn == "." || $fn == ".." || !is_dir("images/game/$fn")) { continue; }
  
    unset($selected); if ($fn == $pref[rwar_default_gamename]) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$fn'>$fn</option>";
  }
  closedir($fh);
  $text .= "				</select>
  				</td>
  			</tr>";
//-----------------------------------------------------------------------------------------------------------+
  $text .= "		<tr>
				<td class='forumheader3'>Default Type</td>
				<td class='forumheader3'>
					<select class='tbox' style='width:95%' name='rwar_default_gametype'>";

  $fh = opendir("images/type/");

  while($fn = readdir($fh)) 
  {
    if ($fn == "." || $fn == "..") { continue; }
    
    $fn = substr($fn, 0, -4);  // REMOVE THE .GIF FROM THE FILENAME

    unset($selected); if ($fn == $pref[rwar_default_gametype]) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$fn'>$fn</option>";
  }

  $text .= "				</select>
				</td>
			</tr>";
//-----------------------------------------------------------------------------------------------------------+
  $text .= "		<tr>
				<td class='forumheader3'>Default League</td>
				<td class='forumheader3'>
					<select class='tbox' style='width:95%' name='rwar_default_league'>";

  $fh = opendir("images/league/");

  while($fn = readdir($fh)) 
  {
    if ($fn == "." || $fn == "..") { continue; }

    $fn = substr($fn, 0, -4);  // REMOVE THE .GIF FROM THE FILENAME

    unset($selected); if ($fn == $pref[rwar_default_league]) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$fn'>$fn</option>";
  }

  $text .= "				</select>
				</td>
			</tr>";

//-----------------------------------------------------------------------------------------------------------+

 $text .= "		<tr><td class='forumheader3'> Default Rules       </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_default_rules'      value='$pref[rwar_default_rules]'      /></td></tr>
			<tr><td class='forumheader3'> Default Server 	  </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_default_server'     value='$pref[rwar_default_server]'     /></td></tr>
			<tr><td class='forumheader3'> Default Server Pass </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_default_serverpass' value='$pref[rwar_default_serverpass]' /></td></tr>
			<tr><td class='forumheader3'> Default IRC channel </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_default_irc'        value='$pref[rwar_default_irc]'        /></td></tr>

			<tr><td colspan='2'><br /></td></tr>";

//-----------------------------------------------------------------------------------------------------------+

 $rwar_squads = unserialize($pref[rwar_squads]);
 
 unset($form_index);
 
 foreach ($rwar_squads as $key => $value)
 {
    $form_index++;
    
    $value[tag]  = htmlspecialchars($value[tag],  ENT_QUOTES); // SYMBOLS TO ENTITIES
    $value[name] = htmlspecialchars($value[name], ENT_QUOTES); // SYMBOLS TO ENTITIES
    
    $text .= "		<tr>
				<td><br /></td>
				<td class='forumheader3'>
					<input type='hidden' name='rwar_squads[$form_index][tag]' value='$value[tag]' />

					<select class='tbox' style='width:95%' name='rwar_squads[$form_index][name]'>
						<option selected='selected' value='$value[name]'>$value[tag] - $value[name]</option>
						<option value=''>Remove Squad</option>
					</select>
				</td>
			</tr>";
 }
 
 $form_index++;
		
 $text .= "		<tr>
				<td class='forumheader3' style='white-space:nowrap'> Add Squad [TAG] [NAME]</td>
				<td class='forumheader3'> 
					<input class='tbox' style='width:25%' maxlength='10'  type='text' name='rwar_squads[$form_index][tag]'  value='' />
					<input class='tbox' style='width:68%' maxlength='128' type='text' name='rwar_squads[$form_index][name]' value='' />
				</td>
			</tr>
			
			<tr><td colspan='2'><br /></td></tr>";
			
//-----------------------------------------------------------------------------------------------------------+

  $text .= "		<tr>
				<td><br /></td>
				<td class='forumheader3'>";

  $rwar_sides_list = unserialize($pref[rwar_sides]);

  foreach ($rwar_sides_list as $key => $value)
  {
    $form_index++;
    
    $value = htmlspecialchars($value, ENT_QUOTES); // SYMBOLS TO ENTITIES

    $text .= "				<select class='tbox' style='width:95%' name='rwar_sides[$form_index]'>
						<option selected='selected' value='$value'>$value</option>
						<option value=''>Remove Side</option>
					</select>";
  }
  
  $form_index++;

  $text .= "			</td>
			</tr>
			<tr>
				<td class='forumheader3' style='white-space:nowrap'> Add Side </td>
				<td class='forumheader3'>
					<input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_sides[$form_index]' value='' />
				</td>
			</tr>";

//-----------------------------------------------------------------------------------------------------------+

  $text .= "		<tr><td colspan='2'><br /><br /></td></tr>
			<tr>
				<td class='forumheader3'><br /></td>
				<td class='forumheader3'>
					<input class='tbox' type='submit' name='rwar_submit' value='Update Configuration' />
				</td>
			</tr>
		</table>
	</form>";

//-----------------------------------------------------------------------------------------------------------+

  $ns -> tablerender("RWar Configuration", $text);

  require_once(e_ADMIN."footer.php");

?>