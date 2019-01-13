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

  $text .= "	<table style='width:100%' cellspacing='2' cellpadding='0'>";

//------------------------------------------------------------------------------------------------------------+

  if ($pref[rwar_menu_pending])
  {
    $mysql_query       = "SELECT * FROM $mysql_table WHERE result = 'pending_open' OR result = 'pending_closed' ORDER BY timestamp ASC LIMIT $pref[rwar_menu_pending]";
    $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
    $mysql_result_size = mysql_num_rows($mysql_result);

    for ($i=1; $i<= $mysql_result_size; $i++)
    {
      $mysql_row = mysql_fetch_array($mysql_result);

      $text .= "	<tr>
				<td style='text-align:left;width:10px'>$rwar_image_pending</td>
				<td style='white-space:nowrap' colspan='5'><a href='".e_PLUGIN."rwar_menu/details.php?id=$mysql_row[id]' style='text-decoration:none'>$mysql_row[tag2]</a></td>
			</tr>
			<tr>
				<td style='text-align:left;width:10px'>-</td>
				<td style='white-space:nowrap' colspan='5'><a href='".e_PLUGIN."rwar_menu/details.php?id=$mysql_row[id]' style='text-decoration:none'>".date($pref[rwar_date_format],$mysql_row[timestamp])."</a></td>
			</tr>";
    }
  }

//------------------------------------------------------------------------------------------------------------+

  if ($pref[rwar_menu_stats])
  {
    $text .= "<tr><td colspan='6'><br /></td></tr>";
  
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

    $text .= "	<tr><td style='text-align:left;width:10px'>$rwar_image_pending </td><td style='text-align:left'> Total </td><td> $rwar_stats_total </td><td colspan='3' style='text-align:center'><br /></td></tr>
		<tr><td style='text-align:left;width:10px'>$rwar_image_won     </td><td style='text-align:left'> Won   </td><td> $rwar_stats_won   </td><td colspan='3' style='text-align:right'> $rwar_stats_wonpc%  </td></tr>
		<tr><td style='text-align:left;width:10px'>$rwar_image_lost    </td><td style='text-align:left'> Lost  </td><td> $rwar_stats_lost  </td><td colspan='3' style='text-align:right'> $rwar_stats_lostpc% </td></tr>
		<tr><td style='text-align:left;width:10px'>$rwar_image_draw    </td><td style='text-align:left'> Draw  </td><td> $rwar_stats_draw  </td><td colspan='3' style='text-align:right'> $rwar_stats_drawpc% </td></tr>";
  }

//------------------------------------------------------------------------------------------------------------+

  if ($pref[rwar_menu_previous])
  {
    $text .= "<tr><td colspan='6'><br /></td></tr>";

    $mysql_query       = "SELECT * FROM $mysql_table WHERE result = 'won' OR result = 'lost' OR result = 'draw' OR result = 'cancelled' ORDER BY timestamp DESC LIMIT $pref[rwar_menu_previous]";
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

      $text .= "	<tr>
      				<td style='text-align:left;width:10px'>$rwar_image_result</td>
				<td style='white-space:nowrap' colspan='2'><a href='".e_PLUGIN."rwar_menu/details.php?id=$mysql_row[id]' style='text-decoration:none'>$mysql_row[tag2]</a></td>
				<td style='text-align:right'>$rwar_total_score1</td>
				<td style='text-align:center'>-</td>
				<td style='text-align:left'>$rwar_total_score2</td>
			</tr>";
    }
  }

//------------------------------------------------------------------------------------------------------------+

  $text .= "		<tr>
  				<td style='text-align:center' colspan='6'><br /><a href='".e_PLUGIN."rwar_menu/'>More...</a></td>
  			</tr>
  		</table>";

//------------------------------------------------------------------------------------------------------------+

  $ns -> tablerender("War Info", $text);

?>