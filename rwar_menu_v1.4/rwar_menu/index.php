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

  require_once(HEADERF);

  unset($text);

  $mysql_table = MPREFIX."rwar";

  $timestamp = time() + ($pref[time_offset] * 3600);

//------------------------------------------------------------------------------------------------------------+

  $rwar_image_won       = "<img src='".e_PLUGIN."rwar_menu/images/other/won.gif'       alt='' title='Won'       style='vertical-align:bottom; border:none' />";
  $rwar_image_lost      = "<img src='".e_PLUGIN."rwar_menu/images/other/lost.gif'      alt='' title='Lost'      style='vertical-align:bottom; border:none' />";
  $rwar_image_draw      = "<img src='".e_PLUGIN."rwar_menu/images/other/draw.gif'      alt='' title='Draw'      style='vertical-align:bottom; border:none' />";
  $rwar_image_pending   = "<img src='".e_PLUGIN."rwar_menu/images/other/pending.gif'   alt='' title='Pending'   style='vertical-align:bottom; border:none' />";
  $rwar_image_cancelled = "<img src='".e_PLUGIN."rwar_menu/images/other/cancelled.gif' alt='' title='Cancelled' style='vertical-align:bottom; border:none' />";  
  $rwar_image_details   = "<img src='".e_PLUGIN."rwar_menu/images/other/details.gif'   alt='' title='Details'   style='vertical-align:bottom; border:none' />";

//------------------------------------------------------------------------------------------------------------+

  $text .= "	<div style='text-align:center'>

		<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='forumheader3' style='text-align:center'><a href='index.php' style='text-decoration:none'>WAR LIST</a></td>";

  if (ADMIN || check_class(RWAR))
  {
    $text .= "			<td class='forumheader3' style='text-align:center'><a href='rwar_manage.php?action=add' style='text-decoration:none'>NEW WAR</a></td>";
  }

  if ($pref[rwar_challenge] && $pref[rwar_challenge_show])
  {
    $text .= "			<td class='forumheader3' style='text-align:center'><a href='challenge.php' style='text-decoration:none'>CHALLENGE US</a></td>";
  }
  
  $text .= "		</tr>
		</table>

		<br />";

//------------------------------------------------------------------------------------------------------------+

  $mysql_result      = mysql_query("SELECT * FROM $mysql_table WHERE result = 'won'") or die(mysql_error());
  $rwar_stats_won    = mysql_num_rows($mysql_result);
  $mysql_result      = mysql_query("SELECT * FROM $mysql_table WHERE result = 'lost'") or die(mysql_error());
  $rwar_stats_lost   = mysql_num_rows($mysql_result);
  $mysql_result      = mysql_query("SELECT * FROM $mysql_table WHERE result = 'draw'") or die(mysql_error());
  $rwar_stats_draw   = mysql_num_rows($mysql_result);

  $rwar_stats_total  = $rwar_stats_won + $rwar_stats_lost + $rwar_stats_draw;

  $rwar_stats_wonpc  = round( (100 / $rwar_stats_total * $rwar_stats_won)  ,0);
  $rwar_stats_lostpc = round( (100 / $rwar_stats_total * $rwar_stats_lost) ,0);
  $rwar_stats_drawpc = round( (100 / $rwar_stats_total * $rwar_stats_draw) ,0);

  $text .= "	<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
  		<tr>
		<td class='forumheader3' style='text-align:center;border-style:solid none solid solid'>$rwar_image_pending Total: $rwar_stats_total</td>
		<td class='forumheader3' style='text-align:center;border-style:solid none'>            $rwar_image_won     Won:   $rwar_stats_won  ( $rwar_stats_wonpc% )</td>
		<td class='forumheader3' style='text-align:center;border-style:solid none'>            $rwar_image_lost    Lost:  $rwar_stats_lost ( $rwar_stats_lostpc% )</td>
		<td class='forumheader3' style='text-align:center;border-style:solid solid solid none'>$rwar_image_draw    Draw:  $rwar_stats_draw ( $rwar_stats_drawpc% )</td>
		</tr>
		</table>
		
		<br />
		<br />";

//------------------------------------------------------------------------------------------------------------+

  if ($pref[rwar_challenge] && (ADMIN || check_class(RWAR)))
  {
    $text .= "	<div style='width:95%; text-align:left'>Challenges<br /><br /></div>
		<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>";

    $mysql_query       = "SELECT * FROM $mysql_table WHERE result = 'challenge' ORDER BY timestamp DESC";
    $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
    $mysql_result_size = mysql_num_rows($mysql_result);

    for ($i=1; $i<= $mysql_result_size; $i++)
    {
      $mysql_row = mysql_fetch_array($mysql_result);

//------------------------------------------------------------------------------------------------------------+
      $rwar_image_gamename = "images/game/$mysql_row[gamename]/icon.gif";
      $rwar_image_gametype = "images/type/$mysql_row[gametype].gif";
      $rwar_image_league   = "images/league/$mysql_row[league].gif";

      if (!file_exists($rwar_image_gamename)) { $rwar_image_gamename = "images/other/unknown.gif"; }
      if (!file_exists($rwar_image_gametype)) { $rwar_image_gametype = "images/other/unknown.gif"; }
      if (!file_exists($rwar_image_league))   { $rwar_image_league   = "images/other/unknown.gif"; }

      $rwar_image_gamename = "<img style='width:16px;height:16px' src='$rwar_image_gamename' alt='' title='$mysql_row[gamename]' />";
      $rwar_image_gametype = "<img style='width:16px;height:16px' src='$rwar_image_gametype' alt='' title='$mysql_row[gametype]' />";
      $rwar_image_league   = "<img style='width:16px;height:16px' src='$rwar_image_league'   alt='' title='$mysql_row[league]' />";
//------------------------------------------------------------------------------------------------------------+
      foreach ($mysql_row as $key => $value) { if (!is_array($value)) { $mysql_row[$key] = htmlspecialchars($value, ENT_QUOTES); } }
//------------------------------------------------------------------------------------------------------------+

      $text .= "<tr>
		<td class='forumheader3' style='white-space:nowrap;text-align:center;width:60px'> $rwar_image_gamename $rwar_image_gametype $rwar_image_league </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:left;width:90px'> <div title='".date("l H:i",$mysql_row[timestamp])."'> ".date($pref[rwar_date_format],$mysql_row[timestamp])." </div> </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:center'> $mysql_row[team2] </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:center;width:18px'> <a href='details.php?id=$mysql_row[id]'> $rwar_image_details </a> </td>
		</tr>";
    }

    if ($mysql_result_size < 1) { $text .= "<tr><td class='forumheader3'><br /></td></tr>"; } // XHTML COMPLIANCE
    
    $text .= "	</table>
    		<br />
    		<br />";
  }

//------------------------------------------------------------------------------------------------------------+



//------------------------------------------------------------------------------------------------------------+

  $text .= "	<div style='width:95%; text-align:left'>Pending Wars<br /><br /></div>
  		<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>";

  $mysql_query       = "SELECT * FROM $mysql_table WHERE result = 'pending_open' OR result = 'pending_closed' ORDER BY timestamp DESC";
  $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
  $mysql_result_size = mysql_num_rows($mysql_result);
  
  for ($i=1; $i<= $mysql_result_size; $i++)
  {
    $mysql_row = mysql_fetch_array($mysql_result);

    $mysql_row[maps] = implode(" ", unserialize($mysql_row[maps]));

//------------------------------------------------------------------------------------------------------------+
      $rwar_image_gamename = "images/game/$mysql_row[gamename]/icon.gif";
      $rwar_image_gametype = "images/type/$mysql_row[gametype].gif";
      $rwar_image_league   = "images/league/$mysql_row[league].gif";

      if (!file_exists($rwar_image_gamename)) { $rwar_image_gamename = "images/other/unknown.gif"; }
      if (!file_exists($rwar_image_gametype)) { $rwar_image_gametype = "images/other/unknown.gif"; }
      if (!file_exists($rwar_image_league))   { $rwar_image_league   = "images/other/unknown.gif"; }

      $rwar_image_gamename = "<img style='width:16px;height:16px' src='$rwar_image_gamename' alt='' title='$mysql_row[gamename]' />";
      $rwar_image_gametype = "<img style='width:16px;height:16px' src='$rwar_image_gametype' alt='' title='$mysql_row[gametype]' />";
      $rwar_image_league   = "<img style='width:16px;height:16px' src='$rwar_image_league'   alt='' title='$mysql_row[league]' />";
//------------------------------------------------------------------------------------------------------------+
      foreach ($mysql_row as $key => $value) { if (!is_array($value)) { $mysql_row[$key] = htmlspecialchars($value, ENT_QUOTES); } }
//------------------------------------------------------------------------------------------------------------+

    $text .= "	<tr>
		<td class='forumheader3' style='white-space:nowrap;text-align:center;width:60px'> $rwar_image_gamename $rwar_image_gametype $rwar_image_league </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:left;width:90px'> <div title='".date("l H:i",$mysql_row[timestamp])."'> ".date($pref[rwar_date_format],$mysql_row[timestamp])." </div> </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:right; border-style:solid none'> $mysql_row[tag1] </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:center;width:16px; border-style:solid none'> vs </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:left; border-style:solid none'> $mysql_row[tag2] </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:center'> <div title='$mysql_row[maps]'>Maps</div> </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:center;width:18px'> <a href='details.php?id=$mysql_row[id]'>$rwar_image_details</a> </td>
		</tr>";
  }

  if ($mysql_result_size < 1) { $text .= "<tr><td class='forumheader3'><br /></td></tr>"; } // XHTML COMPLIANCE

  $text .= "	</table>
  		<br />";

//------------------------------------------------------------------------------------------------------------+

  $mysql_query       = "SELECT * FROM $mysql_table WHERE result = 'won' OR result = 'lost' OR result = 'draw' OR result = 'cancelled' ";
  $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
  $mysql_result_size = mysql_num_rows($mysql_result);

  $paging_items  = 10;
  $paging_page   = intval($_GET[page]); if ($paging_page < 1) { $paging_page = 1; }
  $paging_offset = $paging_items * ($paging_page - 1);
  $paging_total  = ceil($mysql_result_size / $paging_items);

  $text .= "	<div id='wars'><br /></div>
  		<div style='width:95%; text-align:left'>Previous Wars<br /><br /></div>
    		<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>";

  $mysql_query       = "SELECT * FROM $mysql_table WHERE result = 'won' OR result = 'lost' OR result = 'draw' or result = 'cancelled' ORDER BY timestamp DESC LIMIT $paging_offset,$paging_items";
  $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
  $mysql_result_size = mysql_num_rows($mysql_result);

  for ($i=1; $i<= $mysql_result_size; $i++)
  {
    $mysql_row = mysql_fetch_array($mysql_result);

    if      ($mysql_row[result] == "won")       { $rwar_image_result = $rwar_image_won;       }
    else if ($mysql_row[result] == "lost")      { $rwar_image_result = $rwar_image_lost;      }
    else if ($mysql_row[result] == "draw")      { $rwar_image_result = $rwar_image_draw;      }
    else if ($mysql_row[result] == "cancelled") { $rwar_image_result = $rwar_image_cancelled; }
    else                                        { $rwar_image_result = $rwar_image_pending;   }

    $rwar_total_score1 = array_sum(unserialize($mysql_row[scores1]));
    $rwar_total_score2 = array_sum(unserialize($mysql_row[scores2]));

//------------------------------------------------------------------------------------------------------------+
      $rwar_image_gamename = "images/game/$mysql_row[gamename]/icon.gif";
      $rwar_image_gametype = "images/type/$mysql_row[gametype].gif";
      $rwar_image_league   = "images/league/$mysql_row[league].gif";

      if (!file_exists($rwar_image_gamename)) { $rwar_image_gamename = "images/other/unknown.gif"; }
      if (!file_exists($rwar_image_gametype)) { $rwar_image_gametype = "images/other/unknown.gif"; }
      if (!file_exists($rwar_image_league))   { $rwar_image_league   = "images/other/unknown.gif"; }

      $rwar_image_gamename = "<img style='width:16px;height:16px' src='$rwar_image_gamename' alt='' title='$mysql_row[gamename]' />";
      $rwar_image_gametype = "<img style='width:16px;height:16px' src='$rwar_image_gametype' alt='' title='$mysql_row[gametype]' />";
      $rwar_image_league   = "<img style='width:16px;height:16px' src='$rwar_image_league'   alt='' title='$mysql_row[league]' />";
//------------------------------------------------------------------------------------------------------------+
      foreach ($mysql_row as $key => $value) { if (!is_array($value)) { $mysql_row[$key] = htmlspecialchars($value, ENT_QUOTES); } }
//------------------------------------------------------------------------------------------------------------+

    $text .= "	<tr>
		<td class='forumheader3' style='white-space:nowrap;text-align:center;width:60px'> $rwar_image_gamename $rwar_image_gametype $rwar_image_league </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:left;width:90px'> <div title='".date("l H:i",$mysql_row[timestamp])."'> ".date($pref[rwar_date_format],$mysql_row[timestamp])." </div> </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:right'> $mysql_row[tag1] </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:right;width:20px; border-style:solid none'>  $rwar_total_score1 </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:center;width:10px; border-style:solid none'> $rwar_image_result </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:left;width:20px; border-style:solid none'>   $rwar_total_score2 </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:left'> $mysql_row[tag2] </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:center;width:18px'> <a href='details.php?id=$mysql_row[id]'>$rwar_image_details</a> </td>
		</tr>";
  }

  if ($mysql_result_size < 1) { $text .= "<tr><td class='forumheader3'><br /></td></tr>"; } // XHTML COMPLIANCE

  $text .= "	</table>
  		<br />
  		<br />";

//------------------------------------------------------------------------------------------------------------+
  $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=1#wars'> &laquo;] </a>";

  if ($paging_page > 3) { $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=".($paging_page - 3)."#wars'> [".($paging_page - 3)."] </a>"; }
  if ($paging_page > 2) { $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=".($paging_page - 2)."#wars'> [".($paging_page - 2)."] </a>"; }
  if ($paging_page > 1) { $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=".($paging_page - 1)."#wars'> [".($paging_page - 1)."] </a>"; }

  $text .= " $paging_page ";

  if ($paging_page < ($paging_total - 0)) { $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=".($paging_page + 1)."#wars'> [".($paging_page + 1)."] </a>"; }
  if ($paging_page < ($paging_total - 1)) { $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=".($paging_page + 2)."#wars'> [".($paging_page + 2)."] </a>"; }
  if ($paging_page < ($paging_total - 2)) { $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=".($paging_page + 3)."#wars'> [".($paging_page + 3)."] </a>"; }

  $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=$paging_total#wars'> [&raquo; </a>";
//------------------------------------------------------------------------------------------------------------+

  $text .= "	<br />
  		<br />
  		<br />
  		</div>";

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
//-- PLEASE MAKE A DONATION OR SIGN THE GUESTBOOK AT WWW.GREYCUBE.COM IF YOU REMOVE THIS CREDIT ----------------------------------------------------------------------------------------------------+
  $text .= "<div style='text-align:center;font-family:tahoma;font-size:9px'><a rel='external' href='http://www.greycube.com' style='text-decoration:none'>RWar 1.4 By Richard Perry</a></div>";
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

  $ns -> tablerender("RWar", $text);

  require_once(FOOTERF);

?>