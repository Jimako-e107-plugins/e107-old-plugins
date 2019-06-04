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

//-----------------------------------------------------------------------------------------------------------+

  $eplug_admin = TRUE;
  require_once "../../class2.php"; if(!getperms("P")) { echo "You do not have permission"; exit; }
  ob_start(); // STORE DATA UNTIL FINISHED TO FIX REDIRECTION
  require_once(e_ADMIN."auth.php");
  require_once("magic_quotes_handler.php");
 
//-----------------------------------------------------------------------------------------------------------+

  if($_POST[cups_submit])
  {
  
//-----------------------------------------------------------------------------------------------------------+

    foreach ($_POST[cups_squads] as $key=>$value)
    {
      if (!$value[tag] || !$value[name])
      {
        unset($_POST[cups_squads][$key]);
      }
    }
    
    $_POST[cups_squads] = serialize($_POST[cups_squads]);

//-----------------------------------------------------------------------------------------------------------+

    foreach ($_POST[cups_sides] as $key=>$value)
    {
      if (!$value)
      {
        unset($_POST[cups_sides][$key]);
      }
    }
    
    $_POST[cups_sides] = serialize($_POST[cups_sides]);

//-----------------------------------------------------------------------------------------------------------+
    
    if ($_POST[cups_addtocalendar])
    {
      if ($_POST[cups_calendartype] == "1") { $cal_cat = "ecal_cats"; }
      else                                  { $cal_cat = "event_cat"; }
    
      $mysql_result = mysql_query("SELECT 1 FROM ".MPREFIX."$cal_cat LIMIT 0");
     
      if (!$mysql_result)
      {
        $_POST[cups_addtocalender] = 0;
        message_handler("MESSAGE", "Calendar Must Be Installed for the ADDTOCALENDAR Option"); require_once(e_ADMIN."footer.php"); exit;
      }
    }

//-----------------------------------------------------------------------------------------------------------+
  
    unset($_POST[cups_submit]);
  
    foreach ($_POST as $key => $value)
    {
      if (substr($key, 0, 5) == "cups_")
      {
        $pref[$key] = $value;
      }
    }

    save_prefs(); // SAVE CUPS PREFERENCES
    
    header("Location:$_SERVER[PHP_SELF]", true); exit; // RELOAD PAGE AFTER SAVING PREFS TO FIX 0.617 HTML ENTITIES BUG
  }

//-----------------------------------------------------------------------------------------------------------+

  $text .= "
	
	<form method='post' action='$_SERVER[PHP_SELF]'>
		<table style='width:95%;border-collapse:collapse;' cellpadding='0' cellspacing='0'>
			<tr>
				<td class='forumheader3' style='text-align:center'>
					<a href='index.php' style='text-decoration:none'>CUPS LIST</a>
				</td>
				<td class='forumheader3' style='text-align:center'>
					<a href='".e_PLUGIN."cups_menu/cups_backup.php?action=backup' style='text-decoration:none'>BACKUP CUPS</a>
				</td>
				<td class='forumheader3' style='text-align:center'>
					<a href='".e_PLUGIN."cups_menu/cups_backup.php?action=restore' style='text-decoration:none'>RESTORE CUPS</a>
				</td>
			</tr>
		</table>

		<div><br /></div>

		<table style='width:95%;border-collapse:collapse;' cellpadding='0' cellspacing='0'>
			<tr>
				<td class='forumheader3'>
					Server Email
				</td>
				<td class='forumheader3'>
					<input class='tbox' type='text' name='cups_email' value='$pref[cups_email]' style='width:95%' maxlength='128' />
				</td>
			</tr>";

  unset($selected); if ($pref[cups_email_all])  { $selected = "selected='selected'"; } $text .= "<tr><td class='forumheader3'> Email New Cups </td><td class='forumheader3'><select class='tbox' name='cups_email_all'>  <option value='0'> NO       </option> <option $selected value='1'> YES       </option> </select></td></tr>";
  unset($selected); if ($pref[cups_email_chosen])   { $selected = "selected='selected'"; } $text .= "<tr><td class='forumheader3'> Email Players   </td><td class='forumheader3'><select class='tbox' name='cups_email_chosen'>   <option value='0'> NO       </option> <option $selected value='1'> YES       </option> </select></td></tr>";
  unset($selected); if ($pref[cups_addtocalendar])  { $selected = "selected='selected'"; } $text .= "<tr><td class='forumheader3'> Add Cups to Calendar   </td><td class='forumheader3'><select class='tbox' name='cups_addtocalendar'>  <option value='0'> NO       </option> <option $selected value='1'> YES       </option> </select></td></tr>";
  unset($selected); if ($pref[cups_calendartype])   { $selected = "selected='selected'"; } $text .= "<tr><td class='forumheader3'> Select Calendar        </td><td class='forumheader3'><select class='tbox' name='cups_calendartype'>   <option value='0'> Standard </option> <option $selected value='1'> ECalendar </option> </select></td></tr>";
  unset($selected); if ($pref[cups_menu_stats])     { $selected = "selected='selected'"; } $text .= "<tr><td class='forumheader3'> Menu Stats             </td><td class='forumheader3'><select class='tbox' name='cups_menu_stats'>     <option value='0'> NO       </option> <option $selected value='1'> YES       </option> </select></td></tr>";

//-----------------------------------------------------------------------------------------------------------+

  $text .= "		<tr>
				<td class='forumheader3'>
					Menu Previous Cups
				</td>
				<td class='forumheader3'>
					<select class='tbox' name='cups_menu_previous'>";

  for ($i=0; $i<= 10; $i++)
  {
    unset($selected); if ($pref[cups_menu_previous] == $i) { $selected = "selected='selected'"; }
    $text .= "<option $selected value='$i'>$i</option>";
  }

  $text .= "				</select>
				</td>
			</tr>";

//-----------------------------------------------------------------------------------------------------------+

  $text .= "		<tr><td colspan='2'><br /></td></tr>
			<tr>
				<td class='forumheader3'> Date Format </td>
				<td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='cups_date_format' value='$pref[cups_date_format]' /></td>
			</tr>
			<tr><td colspan='2'><br /></td></tr>";

//-----------------------------------------------------------------------------------------------------------+
  $text .= "		<tr>
				<td class='forumheader3'>Default Game</td>
				<td class='forumheader3'>
					<select class='tbox' style='width:95%' name='cups_default_gamename'>";
  $fh = opendir("images/game/");
  while($fn = readdir($fh)) 
  {
    if ($fn == "." || $fn == ".." || !is_dir("images/game/$fn")) { continue; }
  
    unset($selected); if ($fn == $pref[cups_default_gamename]) { $selected="selected='selected'"; }
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
					<select class='tbox' style='width:95%' name='cups_default_gametype'>";

  $fh = opendir("images/type/");

  while($fn = readdir($fh)) 
  {
    if ($fn == "." || $fn == "..") { continue; }
    
    $fn = substr($fn, 0, -4);  // REMOVE THE .GIF FROM THE FILENAME

    unset($selected); if ($fn == $pref[cups_default_gametype]) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$fn'>$fn</option>";
  }

  $text .= "				</select>
				</td>
			</tr>";
//-----------------------------------------------------------------------------------------------------------+
  $text .= "		<tr>
				<td class='forumheader3'>Default League</td>
				<td class='forumheader3'>
					<select class='tbox' style='width:95%' name='cups_default_league'>";

  $fh = opendir("images/league/");

  while($fn = readdir($fh)) 
  {
    if ($fn == "." || $fn == "..") { continue; }

    $fn = substr($fn, 0, -4);  // REMOVE THE .GIF FROM THE FILENAME

    unset($selected); if ($fn == $pref[cups_default_league]) { $selected="selected='selected'"; }
    $text .= "<option $selected value='$fn'>$fn</option>";
  }

  $text .= "				</select>
				</td>
			</tr>";

//-----------------------------------------------------------------------------------------------------------+

 $text .= "	<tr><td class='forumheader3'> Default Event       </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='cups_default_event'      value='$pref[cups_default_event]'      /></td></tr>
			<tr><td class='forumheader3'> Default Rules       </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='cups_default_rules'      value='$pref[cups_default_rules]'      /></td></tr>

			<tr><td colspan='2'><br /></td></tr>";

//-----------------------------------------------------------------------------------------------------------+

 $cups_squads = unserialize($pref[cups_squads]);
 
 unset($form_index);
 
 foreach ($cups_squads as $key => $value)
 {
    $form_index++;
    
    $value[tag]  = htmlspecialchars($value[tag],  ENT_QUOTES); // SYMBOLS TO ENTITIES
    $value[name] = htmlspecialchars($value[name], ENT_QUOTES); // SYMBOLS TO ENTITIES
    
    $text .= "		<tr>
				<td><br /></td>
				<td class='forumheader3'>
					<input type='hidden' name='cups_squads[$form_index][tag]' value='$value[tag]' />

					<select class='tbox' style='width:95%' name='cups_squads[$form_index][name]'>
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
					<input class='tbox' style='width:25%' maxlength='10'  type='text' name='cups_squads[$form_index][tag]'  value='' />
					<input class='tbox' style='width:68%' maxlength='128' type='text' name='cups_squads[$form_index][name]' value='' />
				</td>
			</tr>
			
			<tr><td colspan='2'><br /></td></tr>";

//-----------------------------------------------------------------------------------------------------------+

  $text .= "		<tr><td colspan='2'><br /></td></tr>
			<tr>
				<td class='forumheader3'><br /></td>
				<td class='forumheader3'>
					<input class='tbox' type='submit' name='cups_submit' value='Update Configuration' />
				</td>
			</tr>
		</table>
	</form>";

//-----------------------------------------------------------------------------------------------------------+

  $ns -> tablerender("Cups Configuration", $text);

  require_once(e_ADMIN."footer.php");

?>