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

  unset($text);
  
  $mysql_table = MPREFIX."cups";

  $timestamp = time() + ($pref[time_offset] * 3600);

//------------------------------------------------------------------------------------------------------------+

  $cups_image_total     = "<img src='".e_PLUGIN."'  alt='' title='Total'  style='vertical-align:bottom; border:none' />";
  $cups_image_gold      = "<img src='".e_PLUGIN."cups_menu/images/results/1st_place.gif'  alt='' title='1st Place'  style='vertical-align:bottom; border:none' />";
  $cups_image_silver    = "<img src='".e_PLUGIN."cups_menu/images/results/2nd_place.gif'  alt='' title='2nd Place'  style='vertical-align:bottom; border:none' />";
  $cups_image_bronze    = "<img src='".e_PLUGIN."cups_menu/images/results/3th_place.gif'  alt='' title='3th Place'  style='vertical-align:bottom; border:none' />";
  $cups_image_details   = "<img src='".e_PLUGIN."cups_menu/images/other/details.gif'      alt='' title='Details'    style='vertical-align:bottom; border:none' />";

//------------------------------------------------------------------------------------------------------------+

  $text .= "	<table style='width:100%' cellspacing='2' cellpadding='0'>";

//------------------------------------------------------------------------------------------------------------+

  if ($pref[cups_menu_stats])
  {
    $text .= "<tr><td colspan='6'><br /></td></tr>";
  
    $mysql_result      = mysql_query("SELECT * FROM $mysql_table WHERE result = '1st_place'") or die(mysql_error());
    $cups_stats_gold    = mysql_num_rows($mysql_result);
    $mysql_result      = mysql_query("SELECT * FROM $mysql_table WHERE result = '2nd_place'") or die(mysql_error());
    $cups_stats_silver   = mysql_num_rows($mysql_result);
    $mysql_result      = mysql_query("SELECT * FROM $mysql_table WHERE result = '3th_place'") or die(mysql_error());
    $cups_stats_bronze   = mysql_num_rows($mysql_result);

    $cups_stats_total  = $cups_stats_gold + $cups_stats_silver + $cups_stats_bronze;

    $cups_stats_goldpc  = round( (100 / $cups_stats_total * $cups_stats_gold)  ,0);
    $cups_stats_silverpc = round( (100 / $cups_stats_total * $cups_stats_silver) ,0);
    $cups_stats_bronzepc = round( (100 / $cups_stats_total * $cups_stats_bronze) ,0);

    $text .= "<tr><td style='text-align:left;width:10px'></td><td style='text-align:left'> Total </td><td> $cups_stats_total </td><td colspan='3' style='text-align:center'><br /><br /></td></tr>
		<tr><td style='text-align:left;width:10px'>$cups_image_gold      </td><td style='text-align:left'> 1st Place  </td><td> $cups_stats_gold    </td><td  style='text-align:right'> $cups_stats_goldpc%  </td></tr>
		<tr><td style='text-align:left;width:10px'>$cups_image_silver    </td><td style='text-align:left'> 2nd Place  </td><td> $cups_stats_silver  </td><td colspan='3' style='text-align:right'> $cups_stats_silverpc% </td></tr>
		<tr><td style='text-align:left;width:10px'>$cups_image_bronze    </td><td style='text-align:left'> 3th Place  </td><td> $cups_stats_bronze  </td><td colspan='3' style='text-align:right'> $cups_stats_bronzepc% </td></tr>";
  }

//------------------------------------------------------------------------------------------------------------+

  $text .= "	</table>	";
  $text .= "	<table style='width:100%' cellspacing='2' cellpadding='0'>";

//------------------------------------------------------------------------------------------------------------+

  if ($pref[cups_menu_previous])
  {
    $text .= "<tr><td colspan='4'><br /></td></tr>";

    $mysql_query       = "SELECT * FROM $mysql_table WHERE result = '1st_place' OR result = '2nd_place' OR result = '3th_place' ORDER BY timestamp DESC LIMIT $pref[cups_menu_previous]";
    $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
    $mysql_result_size = mysql_num_rows($mysql_result);

    for ($i=1; $i<= $mysql_result_size; $i++)
    {
      $mysql_row = mysql_fetch_array($mysql_result);

      $cups_image_gamename       = "<img src='".e_PLUGIN."cups_menu/images/game/$mysql_row[gamename]/icon.png' alt='' title='$mysql_row[gamename]' style='vertical-align:bottom; border:none' />";

      if      ($mysql_row[result] == "1st_place")      { $cups_image_result = $cups_image_gold;        }
      else if ($mysql_row[result] == "2nd_place")      { $cups_image_result = $cups_image_silver;      }
      else 							       { $cups_image_result = $cups_image_bronze;      }

    $cups_result         = "$mysql_row[result]";
	if ($cups_result == '1st_place')
	{  $cups_result = '<b>1st</b>';  }
	if ($cups_result == '2nd_place')
	{  $cups_result = '<b>2nd</b>';  }
	if ($cups_result == '3th_place')
	{  $cups_result = '<b>3th</b>';  }

      $text .= "<tr>
				<td> $cups_image_gamename $cups_image_result $cups_result </td>
				<td> <a href='".e_PLUGIN."cups_menu/details.php?id=$mysql_row[id]' style='text-decoration:none'>$mysql_row[league]</a> </td>
			</tr>";
    }
  }

  $text .= "<tr>
  			<td style='text-align:center' colspan='6'><br /><a href='".e_PLUGIN."cups_menu/'>More...</a></td>
  		 </tr>
		 </table>";

//------------------------------------------------------------------------------------------------------------+

  $ns -> tablerender("Cups Info", $text);

?>