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

  require_once("../../class2.php");

//------------------------------------------------------------------------------------------------------------+
include("cups_config.php");
//------------------------------------------------------------------------------------------------------------+

  if(!getperms("P")) { echo "You do not have permission"; exit; }

  $mysql_table = MPREFIX."cups";

//-----------------------------------------------------------------------------------------------------------+

  if (!$_GET[action]) { require_once(HEADERF); message_handler("MESSAGE", "Action Missing"); require_once(FOOTERF); exit; }

//-----------------------------------------------------------------------------------------------------------+

  if ($_GET[action] == "backup")
  {
    $timestamp   = time() + ($pref[time_offset] * 3600);
    $backup_time = date("ymd", $timestamp);

    // HEADER MUST BE COMMENTED WHEN DEBUGGING

    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"cups_backup_".$backup_time.".rwr\"");

//-----------------------------------------------------------------------------------------------------------+

    unset($convert);
    
    if (file_exists("cups_config.php"))  // CHECK FOR 0.6 BY LOOKING FOR OLD FILE NAME
    {
      $convert = TRUE;
      
      // UPDATE CALENDAR CATEGORY ICON
      
      $mysql_result = mysql_query("UPDATE ".MPREFIX."event_cat SET event_cat_icon = '../../cups_menu/images/other/calendar.gif' WHERE event_cat_name = $cups_cal_category");
      
      foreach ($pref as $key=>$value)
      {
        if (substr($key, 0, 5) == "cups_")
        {
          unset($pref[$key]); // CLEAR ALL PREVIOUS CUPS PREFERENCES
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
      
      if ($convert) { $mysql_row = cups_convert($mysql_row); } // CONVERT 0.6 TO 1.0

      echo base64_encode(serialize($mysql_row))."\r\n";  // SERIALIZE ARRAY AND BASE64 SO ITS ONE CUP PER LINE
    }
  }

//------------------------------------------------------------------------------------------------------------+
  
  if ($_GET[action] == "restore")
  {
    if ($_FILES[cups_restore])
    {
      if (substr($_FILES[cups_restore][name], -4) != ".rwr") { require_once(HEADERF); message_handler("MESSAGE", "Invalid File"); require_once(FOOTERF); exit; }

      $lines = file($_FILES[cups_restore][tmp_name]);

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
          
          $mysql_query  = "REPLACE INTO $mysql_table (id,gamename,gametype,league,event,rules,tag1,team1,result,players1,info,screenshots,demos,calendar,timestamp) VALUES ('$mysql_row[id]','$mysql_row[gamename]','$mysql_row[gametype]','$mysql_row[league]','$mysql_row[event]','$mysql_row[rules]','$mysql_row[tag1]','$mysql_row[team1]','$mysql_row[result]','$mysql_row[players1]','$mysql_row[info]','$mysql_row[screenshots]','$mysql_row[demos]','$mysql_row[calendar]','$mysql_row[timestamp]')";
          $mysql_result = mysql_query($mysql_query) or die(mysql_error());

          // echo "Restored Cup ID: $mysql_row[id] <br />"; // FOR DEBUGGING ONLY
        }
      }
      
      header("Location:".e_PLUGIN."cups_menu/"); exit; // FINISHED SO REDIRECT TO CUP LIST
    }
    else
    {
      require_once(HEADERF);

      $text .= "	<form method='post' action='$_SERVER[PHP_SELF]?action=restore' enctype='multipart/form-data'>
      				<div style='text-align:center'>
      					<br />
      					File <input type='file' name='cups_restore' /><br /><br /><br />
      					<input type='submit' name='upload' value='Upload and Restore Backup' />
      					<br /><br />
      				</div>
    			</form>";

      $ns -> tablerender("Cups Restore", $text);

      require_once(FOOTERF);
    }
  }
    
//------------------------------------------------------------------------------------------------------------+

  function cups_convert($mysql_row)
  {
    $tmp[id]          = $mysql_row[id];

    $tmp[gamename]    = $mysql_row[gamename];
    $tmp[gametype]    = $mysql_row[gametype];
    $tmp[league]      = $mysql_row[league];
    $tmp[event]       = $mysql_row[event];
    $tmp[rules]       = $mysql_row[rules];

    $tmp[tag1]        = substr($mysql_row[team1], 0, 8);
    $tmp[team1]       = $mysql_row[team1];

    $tmp[players1]    = ""; // BLANK NEW FIELD

    $tmp[info]        = $mysql_row[comment];
    $tmp[screenshots] = ""; // BLANK NEW FIELD
    $tmp[demos]       = ""; // BLANK NEW FIELD
    $tmp[calendar]    = ""; // BLANK NEW FIELD

    $tmp[timestamp]   = $mysql_row[timestamp];
    
    return $tmp;
  }

//------------------------------------------------------------------------------------------------------------+

?>