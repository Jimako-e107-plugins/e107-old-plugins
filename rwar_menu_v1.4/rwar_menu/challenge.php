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
  require_once("magic_quotes_handler.php");

  $mysql_table = MPREFIX."rwar";

  unset($text);

//------------------------------------------------------------------------------------------------------------+

  $timestamp = time() + ($pref[time_offset] * 3600); // NEEDED FOR CHECKING THE CHALLENGE IS IN THE FUTURE

  $form[info] = "Put other details here, such as maps not listed.\r\n\r\nServer passwords and other details can be arranged after the challenge is accepted.";

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

  // REMOVE MAPS

  foreach ($form[maps] as $key=>$value)
  {
    if (!$value)
    {
      unset($form[maps][$key]);
    }
  }

//------------------------------------------------------------------------------------------------------------+

  if (!$pref[rwar_challenge])                   { message_handler("MESSAGE", "Challenges are not being accepted at this time"); require_once(FOOTERF); exit; }
  if ($pref[rwar_email] == "code@greycube.com") { message_handler("MESSAGE", "Challenges disabled until an admin configures the war email address<br /><br /><a href='index.php'>Return to the War List"); require_once(FOOTERF); exit; }
  if ($pref[rwar_challenge_user] && !USER)      { message_handler("MESSAGE", "You must register and login before you can submit a challenge"); require_once(FOOTERF); exit; }
  
  if ($_POST[rwar_submit_add])
  {

//------------------------------------------------------------------------------------------------------------+

    if ($form[timestamp] < $timestamp) { message_handler("MESSAGE", "The war date must be set in the future"); require_once(FOOTERF); exit; }
    if (!$form[tag2] || !$form[team2]) { message_handler("MESSAGE", "You must enter the clans Tag and Name"); require_once(FOOTERF); exit; }
    if (!$form[contact])               { message_handler("MESSAGE", "You must enter a contact email addresss"); require_once(FOOTERF); exit; }
    if (count($form[maps]) < 1)        { message_handler("MESSAGE", "You must choose atleast one map from the list"); require_once(FOOTERF); exit; }

//------------------------------------------------------------------------------------------------------------+
   
    $form[website] = "http://".eregi_replace("http://", "", trim($form[website]));
    $form[irc]     = "irc://".eregi_replace("irc://", "", trim($form[irc]));
    $form[maps]    = serialize($form[maps]);

//------------------------------------------------------------------------------------------------------------+

    // CLEAR UNUSED FIELDS - THIS IS TO KEEP THE MYSQL_QUERY THE SAME AS THE RWAR_MANAGE.PHP
      
    unset($form[id]);
    unset($form[tag1]);
    unset($form[team1]);
    unset($form[sides]);
    unset($form[scores1]);
    unset($form[scores2]);
    unset($form[players1]);
    unset($form[players2]);
    unset($form[screenshots]);
    unset($form[demos]);
    unset($form[calendar]);
      
    // ADD USER - IP - HOSTNAME TO INFO BOX FOR TRACKING ANY ABUSE ( WILL BE IN REVERSE ORDER )

    $form[info] = "HOSTNAME: ".gethostbyaddr(getip())."\r\n\r\n" .$form[info];
    $form[info] = "IP: ".getip()."\r\n"                          .$form[info];
    $form[info] = "USER: ".USERID.".".USERNAME."\r\n"            .$form[info];
     
    // SET TYPE AS A CHALLENGE

    $form[result] = "challenge";

//------------------------------------------------------------------------------------------------------------+

    // ESCAPE CONTENT TO STOP SYMBOLS CAUSING MYSQL ERRORS

    foreach ($form as $key => $value)
    {
      $form[$key] = mysql_real_escape_string($value);
    }

    // ADD OR UPDATE THE WAR

    $mysql_query  = "REPLACE INTO $mysql_table (id,gamename,gametype,league,tag1,tag2,team1,team2,maps,sides,scores1,scores2,result,players1,players2,server,serverpass,contact,website,irc,rules,info,screenshots,demos,calendar,timestamp) VALUES ('$form[id]','$form[gamename]','$form[gametype]','$form[league]','$form[tag1]','$form[tag2]','$form[team1]','$form[team2]','$form[maps]','$form[sides]','$form[scores1]','$form[scores2]','$form[result]','$form[players1]','$form[players2]','$form[server]','$form[serverpass]','$form[contact]','$form[website]','$form[irc]','$form[rules]','$form[info]','$form[screenshots]','$form[demos]','$form[calendar]','$form[timestamp]')";
    $mysql_result = mysql_query($mysql_query) or die(mysql_error());
    $rwar_id      = mysql_insert_id();

//------------------------------------------------------------------------------------------------------------+

    // SEND EMAIL TO RWAR ADMIN

    $rwar_folder    = SITEURL.$PLUGINS_DIRECTORY."rwar_menu/details.php?id=$rwar_id";
    $mail_message   = "A challenge has been added to RWar\r\n\r\nFor details goto:\r\n$rwar_folder\r\n\r\n";

    $mail_from      = $pref[rwar_email];
    $mail_from_name = "RWAR ADMIN";
    $mail_subject   = "[WAR] Challenge ".date($pref[rwar_date_format], $form[timestamp]);
    $mail_to        = $pref[rwar_email];

    require_once(e_HANDLER."mail.php");
    sendemail($mail_to, $mail_subject, $mail_message, $mail_to, $mail_from, $mail_from_name);

//------------------------------------------------------------------------------------------------------------+

    // THE FINAL STAGE

    message_handler("MESSAGE", "Your challenge has been sent and is waiting for approval<br /><br /><a href='index.php'>Return to the War List"); require_once(FOOTERF);
    exit;
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

  // STOPS FORM JUMPING WHEN FIRST SETTING THE GAMENAME
  
  unset($form_jump);
  
  if ($_POST[rwar_gamename])
  {
    $form_jump = "#maps";
  }

//------------------------------------------------------------------------------------------------------------+

  $text .= "

  	<div style='text-align:center'>
  
  	<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
		<tr>
			<td class='forumheader3' style='text-align:center'><a href='index.php' style='text-decoration:none'>WAR LIST</a></td>
			<td class='forumheader3' style='text-align:center'><a href='challenge.php' style='text-decoration:none'>CHALLENGE US</a></td>
		</tr>
	</table>
	<br />

	<form method='post' action='$_SERVER[PHP_SELF]$form_jump'>

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
  if (!$_POST[rwar_gamename]) // STOP HERE UNTIL GAME IS SET WHICH EFFECTS WHAT MAPS ARE LOADED
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
    
    $ns -> tablerender("RWar Challenge", $text);
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
			<td class='forumheader3' style='white-space:nowrap'> Tag and Name</td>
			<td class='forumheader3'>
			<input class='tbox' style='width:25%' maxlength='20'  type='text' name='rwar_tag2'  value='$form[tag2]'  />
			<input class='tbox' style='width:68%' maxlength='128' type='text' name='rwar_team2' value='$form[team2]' />
			</td>
			</tr>

			<tr><td class='forumheader3'> Contact </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_contact' value='$form[contact]' /></td></tr>
			<tr><td class='forumheader3'> Website </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_website' value='$form[website]' /></td></tr>
			<tr><td class='forumheader3'> IRC     </td><td class='forumheader3'> <input class='tbox' style='width:95%' maxlength='128' type='text' name='rwar_irc'     value='$form[irc]'     /></td></tr>

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

  $text .= "	<table style='width:95%;border-collapse:collapse;' cellspacing='0' cellpadding='0'>";

  unset($form_index);
  
  foreach ($form[maps] as $key=>$value)
  {
    $form_index++;

    $text .= "		<tr>
				<td class='forumheader3'>
					<select class='tbox' style='width:200px' name='rwar_maps[$form_index]'>
						<option selected='selected' value='$value'>$value</option>
						<option value=''>Remove Map</option>
					</select>
				</td>
			</tr>";
  }
  
  $form_index++;

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
				</td>
			</tr>

  			<tr><td><br /></td></tr>			

			<tr>
				<td class='forumheader3' style='text-align:center' colspan='3'>
					<input class='tbox' type='submit' name='rwar_submit_update' value='Update Maps' />
				</td>
			</tr>

  			<tr><td colspan='3'><br /></td></tr>
		</table>
		
		<div><br /><br /></div>
		
  		<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='forumheader3' style='text-align:center'>
					<input class='tbox' type='submit' name='rwar_submit_add' value='Send Challenge' />
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

  $ns -> tablerender("RWar Challenge", $text);

  unset($fh); // e107 0.616 Footer Bug Fix

  require_once(FOOTERF);

?>