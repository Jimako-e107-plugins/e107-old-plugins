<?php

 /*----------------------------------------------------------------------------------------------------------\
 |                                                                                                            |
 |                         [ ANOTHER ONLINE MENU ] [ © RICHARD PERRY FROM GREYCUBE.COM ]                      |
 |                                                                                                            |
 |    Released under the terms and conditions of the GNU General Public License Version 3 (http://gnu.org)    |
 |                                                                                                            |
 |-------------------------------------------------------------------------------------------------------------
 |        [ EDITOR STYLE SETTINGS: LUCIDA CONSOLE, SIZE 10, TAB = 2 SPACES, BOLD GLOBALLY TURNED OFF ]        |
 \-----------------------------------------------------------------------------------------------------------*/

//------------------------------------------------------------------------------------------------------------+

  $aonline_setting        = unserialize(base64_decode($pref['aonline_settings']));
  $aonline_member_total   = 0;
  $aonline_guest_total    = 0;
  $aonline_cache          = array();
  $aonline_cache_lastseen = array();
  $aonline_cache_newusers = array();

  global $PLUGINS_DIRECTORY;
  global $ADMIN_DIRECTORY;
  global $e107;

//-----------------------------------------------------------------------------------------------------------+

  $mysql_query  = "SELECT * FROM ".MPREFIX."online ORDER BY `online_timestamp` DESC";
  $mysql_result = mysql_query($mysql_query) or die(mysql_error());

  while($mysql_row = mysql_fetch_array($mysql_result, MYSQL_ASSOC))
  {
    // GET RAW ONLINE DATA WHICH IS PROVIDED BY e107's CORE CODE

    $aonline_user_ip    = $mysql_row['online_ip'];
    $aonline_user_array = explode(".", $mysql_row['online_user_id'], 2);
    $aonline_user_id    = $aonline_user_array[0] ? $aonline_user_array[0] : "";               // CHANGE GUEST ID OF ZERO TO BLANK
    $aonline_user_name  = $aonline_user_array[0] ? $aonline_user_array[1] : $aonline_user_ip; // FOR GUEST USE THE IP FOR A USERNAME
    $aonline_url_path   = str_replace(".php.", ".php?", $mysql_row['online_location']);       // CORRECTS E107 REPLACING ? WITH .
    $aonline_url_path   = str_replace("/index.php", "/", $aonline_url_path);                  // NO NEED TO SHOW INDEX FILES

    // SEPERATE QUERIES SO THEY DONT SCREW UP PATHINFO AND FILTER GUESTS TO REMOVE BOT QUERY SPAM

    $tmp = explode("?", $aonline_url_path, 2);

    if (!$aonline_user_id)
    {
      if     (preg_match("/^[a-z]+\.[a-z]+\.[0-9]+/i", $tmp[1], $match)) { $tmp[1] = $match[0]; }
      elseif (preg_match("/^[a-z]+\.[0-9]+/i",         $tmp[1], $match)) { $tmp[1] = $match[0]; }
      elseif (preg_match("/^[0-9]+/i",                 $tmp[1], $match)) { $tmp[1] = $match[0]; }
      else                                                               { $tmp[1] = "";        }

      $aonline_url_path = $tmp[1] ? $tmp[0]."?".$tmp[1] : $tmp[0];
    }

    $aonline_url_info = pathinfo($tmp[0]);

    // IF ADMIN THE POPUP SHOWS FULL IP AND HOSTNAME

    if (ADMIN)
    {
      $aonline_user_popup = $aonline_setting['lookup_hostnames'] ? $aonline_user_ip." \r\n( ".$e107->get_host_name($aonline_user_ip)." )" : $aonline_user_ip;
    }

    // ELSE IF MEMBER AND THEMSELVES THE POPUP SHOWS FULL IP

    elseif ($aonline_user_id && $aonline_user_ip == $e107->getip())
    {
      $aonline_user_popup = $aonline_user_ip;
    }

    // ELSE IF MEMBER THE POPUP SHOWS MASKED IP

    elseif ($aonline_user_id)
    {
      $aonline_ip_masked  = explode(".", $aonline_user_ip);
      $aonline_ip_masked  = "{$aonline_ip_masked[0]}.{$aonline_ip_masked[1]}.x.x";
      $aonline_user_popup = $aonline_ip_masked;
    }

    // ELSE FOR GUESTS THE POPUP IS BLANK AND USERNAME IS MASKED IP

    else
    {
      $aonline_ip_masked  = explode(".", $aonline_user_ip);
      $aonline_ip_masked  = "{$aonline_ip_masked[0]}.{$aonline_ip_masked[1]}.x.x";
      $aonline_user_popup = "";
      $aonline_user_name  = $aonline_ip_masked;
    }

    // IF ALWAYS HIDE ADMIN IS ON THEN WE MUST DO A USER_ID LOOKUP

    if ($aonline_setting['always_hide_admin'] && !ADMIN && $aonline_user_id && aonline_is_admin($aonline_user_id))
    {
      $aonline_url_path = e_BASE;
      $aonline_url_name = AONLINE_LAN_ADMIN_HIDDEN;
    }

    // OTHERWISE ONLY MASK THE LOCATION WHEN ANYONE IS IN THE ADMIN AREA

    elseif (!ADMIN && strpos($aonline_url_info['dirname']."/", "/".$ADMIN_DIRECTORY) !== FALSE)
    {
      $aonline_url_path = e_BASE;
      $aonline_url_name = AONLINE_LAN_ADMIN_AREA;
    }

    // IF THE LOCATION IS THE e107 PLUGINS FOLDER THEN USE THE FOLDER NAME

    elseif (strpos($aonline_url_info['dirname'], "/".$PLUGINS_DIRECTORY) !== FALSE)
    {
      $aonline_url_name = array_pop(explode("/".$PLUGINS_DIRECTORY, $aonline_url_info['dirname']));

      if (substr($aonline_url_name, -5) == "_menu")
      {
        $aonline_url_name = substr($aonline_url_name, 0, -5);
      }
    }

    // ELSE USE THE FILE NAME WITHOUT EXTENSION OR QUERY

    else
    {
      $aonline_url_name = array_shift(explode('.php', $aonline_url_info['basename']));
    }

    // MENU SPACE IS TIGHT SO LONG NAMES NEED TO BE SHORTENED

    if (strlen($aonline_user_name) > $aonline_setting['max_user_name'])
    {
      $aonline_user_name = substr($aonline_user_name, 0, $aonline_setting['max_user_name'] - 2) . "..";
    }
    if (strlen($aonline_url_name) > $aonline_setting['max_url_name'])
    {
      $aonline_url_name = substr($aonline_url_name, 0, $aonline_setting['max_url_name'] - 2) . "..";
    }

    // SET INDEX AND IGNORE DUPLICATES WHILE COUNTING TOTALS

    if ($aonline_user_id)
    {
      $aonline_user_index = $aonline_user_id;

      if (!isset($aonline_cache[$aonline_user_index]))
      {
        $aonline_member_total++;
      }
    }
    else
    {
      $aonline_user_index = $aonline_user_ip;

      if (!isset($aonline_cache[$aonline_user_index]))
      {
        $aonline_guest_total++;
      }
    }

    // ADD TO CACHE

    $aonline_cache[$aonline_user_index]['user_ip']   = $aonline_user_ip;
    $aonline_cache[$aonline_user_index]['user_host'] = $aonline_user_popup;
    $aonline_cache[$aonline_user_index]['user_id']   = $aonline_user_id;
    $aonline_cache[$aonline_user_index]['user_name'] = $aonline_user_name;
    $aonline_cache[$aonline_user_index]['url_path']  = $aonline_url_path;
    $aonline_cache[$aonline_user_index]['url_name']  = $aonline_url_name;
  }

//-----------------------------------------------------------------------------------------------------------+

  // GET RECENT VISITORS WHILE SKIPPING THOSE CURRENTLY ONLINE

  $mysql_query  = "SELECT * FROM ".MPREFIX."user ORDER BY user_currentvisit DESC LIMIT $aonline_member_total , ".intval($aonline_setting['max_lastseen']);
  $mysql_result = mysql_query($mysql_query) or die(mysql_error());

  while($mysql_row = mysql_fetch_array($mysql_result, MYSQL_ASSOC))
  {
    $aonline_user_index = $mysql_row['user_id'];
    $aonline_user_name  = $mysql_row['user_name'];
    $aonline_user_date  = $mysql_row['user_currentvisit'];

    if (strlen($aonline_user_name) > $aonline_setting['max_user_name'])
    {
      $aonline_user_name = substr($aonline_user_name, 0, $aonline_setting['max_user_name'] - 2) . "..";
    }

    $aonline_cache_lastseen[$aonline_user_index]['user_id']   = $aonline_user_index;
    $aonline_cache_lastseen[$aonline_user_index]['user_name'] = $aonline_user_name;
    $aonline_cache_lastseen[$aonline_user_index]['user_date'] = $aonline_user_date;
  }

//-----------------------------------------------------------------------------------------------------------+

  // GET NEWEST USER ACCOUNTS

  $mysql_query  = "SELECT * FROM ".MPREFIX."user WHERE `user_ban` = 0 ORDER BY user_id DESC LIMIT ".intval($aonline_setting['max_newusers']);
  $mysql_result = mysql_query($mysql_query) or die(mysql_error());

  while($mysql_row = mysql_fetch_array($mysql_result, MYSQL_ASSOC))
  {
    $aonline_user_index = $mysql_row['user_id'];
    $aonline_user_name  = $mysql_row['user_name'];
    $aonline_user_date  = $mysql_row['user_join'];

    if (strlen($aonline_user_name) > $aonline_setting['max_user_name'])
    {
      $aonline_user_name = substr($aonline_user_name, 0, $aonline_setting['max_user_name'] - 2) . "..";
    }

    $aonline_cache_newusers[$aonline_user_index]['user_id']   = $aonline_user_index;
    $aonline_cache_newusers[$aonline_user_index]['user_name'] = $aonline_user_name;
    $aonline_cache_newusers[$aonline_user_index]['user_date'] = $aonline_user_date;
  }


//-----------------------------------------------------------------------------------------------------------+

  $text = "

  <div class='button' style='width:100%;cursor:pointer' onclick=\"expandit('aonline_members')\">
    ".($aonline_setting['collapse_members'] && $aonline_member_total ? AONLINE_LAN_EXPAND : "")."
    ".AONLINE_LAN_MEMBERS."$aonline_member_total
  </div>
  <div style='width:100%;".($aonline_setting['collapse_members'] || !$aonline_member_total ? ";display:none":"")."' id='aonline_members'>
    <div style='width:$aonline_setting[menu_width]px'>
      <br />
    </div>
    ".aonline_render_members($aonline_cache)."
  </div>

  <br />

  <div class='button' style='width:100%;cursor:pointer' onclick=\"expandit('aonline_guests')\">
    ".($aonline_setting['collapse_guests'] && $aonline_guest_total ? AONLINE_LAN_EXPAND : "")."
    ".AONLINE_LAN_GUESTS."$aonline_guest_total
  </div>
  <div style='width:100%".($aonline_setting['collapse_guests'] || !$aonline_guest_total ? ";display:none":"")."' id='aonline_guests'>
    <div style='width:$aonline_setting[menu_width]px'>
      <br />
    </div>
    ".aonline_render_guests($aonline_cache)."
  </div>

  <br />

  <div class='button' style='width:100%;cursor:pointer' onclick=\"expandit('aonline_lastseen')\">
    ".($aonline_setting['collapse_lastseen'] ? AONLINE_LAN_EXPAND : "")."
    ".AONLINE_LAN_LASTSEEN."
  </div>

  <div style='width:100%".($aonline_setting['collapse_lastseen'] ? ";display:none":"")."' id='aonline_lastseen'>
    <div style='width:$aonline_setting[menu_width]px'>
      <br />
    </div>
    ".aonline_render_lastseen($aonline_cache_lastseen)."
  </div>

  <br />

  <div class='button' style='width:100%;cursor:pointer' onclick=\"expandit('aonline_newusers')\">
    ".($aonline_setting['collapse_newusers'] ? AONLINE_LAN_EXPAND : "")."
    ".AONLINE_LAN_NEWUSERS."
  </div>

  <div style='width:100%".($aonline_setting['collapse_newusers'] ? ";display:none":"")."' id='aonline_newusers'>
    <div style='width:$aonline_setting[menu_width]px'>
      <br />
    </div>
    ".aonline_render_lastseen($aonline_cache_newusers)."
  </div>

  ";

  $ns -> tablerender(AONLINE_LAN_TITLE, $text);

//-----------------------------------------------------------------------------------------------------------+

  function aonline_is_admin($aonline_user_id)
  {
    if (!$aonline_user_id) { return FALSE; }

    $mysql_query  = "SELECT `user_admin` FROM ".MPREFIX."user WHERE `user_id` = '".mysql_real_escape_string($aonline_user_id)."' LIMIT 1";
    $mysql_result = mysql_query($mysql_query) or die(mysql_error());
    $mysql_row    = mysql_fetch_array($mysql_result, MYSQL_ASSOC);

    return $mysql_row['user_admin'] ? TRUE : FALSE;
  }

//-----------------------------------------------------------------------------------------------------------+

  function aonline_render_members($cache)
  {
    foreach ($cache as $index => $data)
    {
      if (!$data['user_id']) { continue; }

      $string .= "<span style='float:left' title='$data[user_host]'>
                    <a href='".e_BASE."user.php?id.$data[user_id]'>$data[user_name]</a>
                  </span>
                  <span style='float:right'>
                    <a href='$data[url_path]'>$data[url_name]</a>
                  </span>
                  <br />";
    }

    return $string;
  }

//-----------------------------------------------------------------------------------------------------------+

  function aonline_render_guests($cache)
  {
    foreach ($cache as $index => $data)
    {
      if ($data['user_id']) { continue; }

      $string .= "<span style='float:left' title='$data[user_host]'>
                    $data[user_name]
                  </span>
                  <span style='float:right'>
                    <a href='$data[url_path]'>$data[url_name]</a>
                  </span>
                  <br />";
    }

    return $string;
  }

//-----------------------------------------------------------------------------------------------------------+

  function aonline_render_lastseen($cache)
  {
    foreach ($cache as $index => $data)
    {
      $string .= "<span style='float:left'>
                    <a href='".e_BASE."user.php?id.$data[user_id]' title='".AONLINE_LAN_PROFILE_POPUP."'>$data[user_name]</a>
                  </span>
                  <span style='float:right'>
                    ".aonline_timezone($data['user_date'])."
                  </span>
                  <br />";
    }

    return $string;
  }

//-----------------------------------------------------------------------------------------------------------+

  function aonline_render_newusers($cache)
  {
    foreach ($cache as $index => $data)
    {
      $string .= "<span style='float:left'>
                    <a href='".e_BASE."user.php?id.$data[user_id]' title='".AONLINE_LAN_PROFILE_POPUP."'>$data[user_name]</a>
                  </span>
                  <span style='float:right'>
                    ".aonline_timezone($data['user_date'])."
                  </span>
                  <br />";
    }

    return $string;
  }

//-----------------------------------------------------------------------------------------------------------+

  function aonline_timezone($timestamp)
  {
    $timestamp  = strftime(AONLINE_LAN_DATE_FORMAT, $timestamp + TIMEOFFSET);

    return $timestamp;
  }

//-----------------------------------------------------------------------------------------------------------+

?>
