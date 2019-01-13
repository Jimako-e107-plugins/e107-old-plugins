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

  require_once("../../class2.php");

  if(!getperms("P")) { echo "You do not have permission"; exit; }

  $mysql_table = MPREFIX."rwar";

//-----------------------------------------------------------------------------------------------------------+

  if (!$_GET[action]) { require_once(HEADERF); message_handler("MESSAGE", "Action Missing"); require_once(FOOTERF); exit; }

//-----------------------------------------------------------------------------------------------------------+

  if ($_GET[action] == "backup")
  {
    $timestamp   = time() + ($pref[time_offset] * 3600);
    $backup_time = date("ymd", $timestamp);

    // HEADER MUST BE COMMENTED WHEN DEBUGGING

    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"rwar_backup_".$backup_time.".rwr\"");

//-----------------------------------------------------------------------------------------------------------+

    unset($convert);
    
    if (file_exists("rwar_config.php"))  // CHECK FOR 0.6 BY LOOKING FOR OLD FILE NAME
    {
      $convert = TRUE;
      
      // UPDATE CALENDAR CATEGORY ICON
      
      $mysql_result = mysql_query("UPDATE ".MPREFIX."event_cat SET event_cat_icon = '../../rwar_menu/images/other/calendar.gif' WHERE event_cat_name = 'War'");
      
      foreach ($pref as $key=>$value)
      {
        if (substr($key, 0, 5) == "rwar_")
        {
          unset($pref[$key]); // CLEAR ALL PREVIOUS RWAR PREFERENCES
        }
      }

      save_prefs(); // SAVE PREFERENCES
    }

//-----------------------------------------------------------------------------------------------------------+

    $mysql_result      = mysql_query("SELECT * FROM $mysql_table ORDER BY id DESC") or die(mysql_error());
    $mysql_result_size = mysql_num_rows($mysql_result);

    for ($i=1; $i<= $mysql_result_size; $i++)
    {
      $mysql_row = mysql_fetch_array($mysql_result, MYSQL_ASSOC); // ASSOC SKIPS DUPLICATE NUMBER KEYS
      
      if ($convert) { $mysql_row = rwar_convert($mysql_row); } // CONVERT 0.6 TO 1.0

      echo base64_encode(serialize($mysql_row))."\r\n";  // SERIALIZE ARRAY AND BASE64 SO ITS ONE WAR PER LINE
    }
  }

//------------------------------------------------------------------------------------------------------------+
  
  if ($_GET[action] == "restore")
  {
    if ($_FILES[rwar_restore])
    {
      if (substr($_FILES[rwar_restore][name], -4) != ".rwr") { require_once(HEADERF); message_handler("MESSAGE", "Invalid File"); require_once(FOOTERF); exit; }

      $lines = file($_FILES[rwar_restore][tmp_name]);

      foreach ($lines as $line_number => $line)
      {
        $mysql_row = unserialize(base64_decode($line));

        // ESCAPE SYMBOLS
        
        foreach ($mysql_row as $key => $value)
        {
          $mysql_row[$key] = mysql_real_escape_string($value);
        }

        // USE GAMENAME TO VERIFY CONTENT OTHERWISE COULD END UP WITH BLANK ENTRIES

        if ($mysql_row[gamename])
        {
          // NOTE TO SELF: EXACT COPY OF LINE FROM DETAILS.PHP
          
          $mysql_query  = "REPLACE INTO $mysql_table (id,gamename,gametype,league,tag1,tag2,team1,team2,maps,sides,scores1,scores2,result,players1,players2,server,serverpass,contact,website,irc,rules,info,screenshots,demos,calendar,timestamp) VALUES ('$mysql_row[id]','$mysql_row[gamename]','$mysql_row[gametype]','$mysql_row[league]','$mysql_row[tag1]','$mysql_row[tag2]','$mysql_row[team1]','$mysql_row[team2]','$mysql_row[maps]','$mysql_row[sides]','$mysql_row[scores1]','$mysql_row[scores2]','$mysql_row[result]','$mysql_row[players1]','$mysql_row[players2]','$mysql_row[server]','$mysql_row[serverpass]','$mysql_row[contact]','$mysql_row[website]','$mysql_row[irc]','$mysql_row[rules]','$mysql_row[info]','$mysql_row[screenshots]','$mysql_row[demos]','$mysql_row[calendar]','$mysql_row[timestamp]')";
          $mysql_result = mysql_query($mysql_query) or die(mysql_error());

          // echo "Restored War ID: $mysql_row[id] <br />"; // FOR DEBUGGING ONLY
        }
      }
      
      header("Location:".e_PLUGIN."rwar_menu/"); exit; // FINISHED SO REDIRECT TO WAR LIST
    }
    else
    {
      require_once(HEADERF);

      $text .= "	<form method='post' action='$_SERVER[PHP_SELF]?action=restore' enctype='multipart/form-data'>
      				<div style='text-align:center'>
      					<br />
      					File <input type='file' name='rwar_restore' /><br /><br /><br />
      					<input type='submit' name='upload' value='Upload and Restore Backup' />
      					<br /><br />
      				</div>
    			</form>";

      $ns -> tablerender("RWar Restore", $text);

      require_once(FOOTERF);
    }
  }
    
//------------------------------------------------------------------------------------------------------------+

  function rwar_convert($mysql_row)
  {
    $tmp[id]          = $mysql_row[id];

    $tmp[gamename]    = $mysql_row[gamename];
    $tmp[gametype]    = $mysql_row[gametype];
    $tmp[league]      = $mysql_row[league];

    $tmp[tag1]        = substr($mysql_row[team1], 0, 8);
    $tmp[tag2]        = substr($mysql_row[team2], 0, 8);
    $tmp[team1]       = $mysql_row[team1];
    $tmp[team2]       = $mysql_row[team2];

    $tmp[maps]        = str_replace(" ","", $mysql_row[map]); // REMOVE SPACING AND NOTE 0.6=MAP 1.0=MAPS
    $tmp[maps]        = explode(",",",$tmp[maps]");           // COMMA ADDED TO BUMP UP ARRAY INDEX
                        unset($tmp[maps][0]);                 // REMOVE BLANK BUMP INDEX
    $tmp[maps]        = serialize($tmp[maps]);                // SERIALIZE ARRAY
    
    $tmp[sides]       = ""; // BLANK NEW FIELD

    $tmp[scores1][1]  = $mysql_row[score1];       // PUT TOTAL INTO FIRST MAP
    $tmp[scores1]     = serialize($tmp[scores1]); // SERIALIZE ARRAY
    $tmp[scores2][1]  = $mysql_row[score2];       // 0.6=SCORE 1.0=SCORES
    $tmp[scores2]     = serialize($tmp[scores2]);

    if ($mysql_row[score1] > $mysql_row[score2])  { $tmp[result] = "won";       }
    if ($mysql_row[score1] < $mysql_row[score2])  { $tmp[result] = "lost";      }
    if ($mysql_row[score1] == $mysql_row[score2]) { $tmp[result] = "draw";      }
    if ($mysql_row[comment] == "challenge")       { $tmp[result] = "challenge"; }
		
    $tmp[players1]    = ""; // BLANK NEW FIELD
    $tmp[players2]    = ""; // BLANK NEW FIELD

    $tmp[server]      = $mysql_row[server];
    $tmp[serverpass]  = $mysql_row[serverpass];

    $tmp[contact]     = $mysql_row[contact];
    $tmp[website]     = "http://".eregi_replace("http://", "", trim($mysql_row[website]));
    $tmp[irc]         = "irc://"; // BLANK NEW FIELD SO NO POINT USING EREGI

    $tmp[rules]       = $mysql_row[rules];
    $tmp[info]        = $mysql_row[comment];

    $tmp[screenshots] = ""; // BLANK NEW FIELD
    $tmp[demos]       = ""; // BLANK NEW FIELD
    $tmp[calendar]    = ""; // BLANK NEW FIELD

    $tmp[timestamp]   = $mysql_row[timestamp];
    
    return $tmp;
  }

//------------------------------------------------------------------------------------------------------------+

?>