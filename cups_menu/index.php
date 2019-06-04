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

  require_once(HEADERF);

//------------------------------------------------------------------------------------------------------------+
include("cups_config.php");
//------------------------------------------------------------------------------------------------------------+


/*
if (!USER) {
   $ns->tablerender("Error!", "You must login to view this page");
   require_once(FOOTERF);
   exit;
}
*/

  unset($text);

  $mysql_table = MPREFIX."cups";

  $timestamp = time() + ($pref[time_offset] * 3600);

//------------------------------------------------------------------------------------------------------------+

  $cups_image_gold       = "<img src='".e_PLUGIN."cups_menu/images/results/1st_place.gif'       alt='' title='1st Place'       style='vertical-align:bottom; border:none' />";
  $cups_image_silver      = "<img src='".e_PLUGIN."cups_menu/images/results/2nd_place.gif'      alt='' title='2nd Place'      style='vertical-align:bottom; border:none' />";
  $cups_image_bronze      = "<img src='".e_PLUGIN."cups_menu/images/results/3th_place.gif'      alt='' title='3th Place'      style='vertical-align:bottom; border:none' />";
  $cups_image_details   = "<img src='".e_PLUGIN."cups_menu/images/other/details.gif'   alt='' title='Details'   style='vertical-align:bottom; border:none' />";
  $cups_image_CB   	= "<img src='".e_PLUGIN."cups_menu/images/league/ClanBase.gif'  alt='' title='ClanBase'   			style='vertical-align:bottom; border:none' />";
  $cups_image_ESL  	= "<img src='".e_PLUGIN."cups_menu/images/league/ESL.gif'   	alt='' title='Electronic Sports League'   style='vertical-align:bottom; border:none' />";

//------------------------------------------------------------------------------------------------------------+

  $text .= "	<div style='text-align:center'>

		<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='forumheader3' style='text-align:center'><a href='index.php' style='text-decoration:none'>CUP LIST</a></td>";

  if (ADMIN || check_class($cups_admin_class))
  {
    $text .= "			<td class='forumheader3' style='text-align:center'><a href='cups_manage.php?action=add' style='text-decoration:none'>NEW CUP</a></td>";
  }

  $text .= "		</tr>
		</table>

		<br />";

//------------------------------------------------------------------------------------------------------------+

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
//------------------------------------------------------------------------------------------------------------+
/*
  $mysql_result      	= mysql_query("SELECT * FROM $mysql_table WHERE result = '1st_place' AND league = 'ClanBase'") or die(mysql_error());
  $cups_stats_goldCB 		= mysql_num_rows($mysql_result);
  $mysql_result      	= mysql_query("SELECT * FROM $mysql_table WHERE result = '2nd_place' AND league = 'ClanBase'") or die(mysql_error());
  $cups_stats_silverCB	= mysql_num_rows($mysql_result);
  $mysql_result      	= mysql_query("SELECT * FROM $mysql_table WHERE result = '3th_place' AND league = 'ClanBase'") or die(mysql_error());
  $cups_stats_bronzeCB  	= mysql_num_rows($mysql_result);

  $cups_stats_totalCB  = $cups_stats_goldCB + $cups_stats_silverCB + $cups_stats_bronzeCB;

  $cups_stats_goldCBpc  = round( (100 / $cups_stats_totalCB * $cups_stats_goldCB)  ,0);
  $cups_stats_silverCBpc = round( (100 / $cups_stats_totalCB * $cups_stats_silverCB) ,0);
  $cups_stats_bronzeCBpc = round( (100 / $cups_stats_totalCB * $cups_stats_bronzeCB) ,0);

//------------------------------------------------------------------------------------------------------------+
  $mysql_result      	= mysql_query("SELECT * FROM $mysql_table WHERE result = '1st_place' AND league = 'ESL'") or die(mysql_error());
  $cups_stats_goldESL    = mysql_num_rows($mysql_result);
  $mysql_result      	= mysql_query("SELECT * FROM $mysql_table WHERE result = '2nd_place' AND league = 'ESL'") or die(mysql_error());
  $cups_stats_silverESL   = mysql_num_rows($mysql_result);
  $mysql_result      	= mysql_query("SELECT * FROM $mysql_table WHERE result = '3th_place' AND league = 'ESL'") or die(mysql_error());
  $cups_stats_bronzeESL   = mysql_num_rows($mysql_result);

  $cups_stats_totalESL  = $cups_stats_goldESL + $cups_stats_silverESL + $cups_stats_bronzeESL;

  $cups_stats_goldESLpc  = round( (100 / $cups_stats_totalESL * $cups_stats_goldESL)  ,0);
  $cups_stats_silverESLpc = round( (100 / $cups_stats_totalESL * $cups_stats_silverESL) ,0);
  $cups_stats_bronzeESLpc = round( (100 / $cups_stats_totalESL * $cups_stats_bronzeESL) ,0);

*/

  $text .= "	<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
  		<tr>
		<td class='forumheader3' style='text-align:center;border-style:solid none solid solid'>$cups_image_total Total: $cups_stats_total</td>
		<td class='forumheader3' style='text-align:center;border-style:solid none'>            $cups_image_gold    1st Place:  $cups_stats_gold  ( $cups_stats_goldpc% )</td>
		<td class='forumheader3' style='text-align:center;border-style:solid none'>            $cups_image_silver  2nd Place:  $cups_stats_silver ( $cups_stats_silverpc% )</td>
		<td class='forumheader3' style='text-align:center;border-style:solid solid solid none'>$cups_image_bronze  3th Place:  $cups_stats_bronze ( $cups_stats_bronzepc% )</td>
		</tr>
		</table>
		
		<br />";
 /*
  $text .= "	<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>
  		<tr>
		<td class='forumheader3' style='text-align:left;border-style:solid none solid solid'>$cups_image_CB 		ClanBase:   $cups_stats_totalCB</td>
		<td class='forumheader3' style='text-align:center;border-style:solid none'>               	1st Place:  $cups_stats_goldCB  ( $cups_stats_goldCBpc% )</td>
		<td class='forumheader3' style='text-align:center;border-style:solid none'>            	2nd Place:  $cups_stats_silverCB ( $cups_stats_silverCBpc% )</td>
		<td class='forumheader3' style='text-align:center;border-style:solid solid solid none'>	3th Place:  $cups_stats_bronzeCB ( $cups_stats_bronzeCBpc% )</td>
		</tr>
  		<tr>
		<td class='forumheader3' style='text-align:left;border-style:solid none solid solid'>$cups_image_ESL		Electronic Sports League:   $cups_stats_totalESL</td>
		<td class='forumheader3' style='text-align:center;border-style:solid none'>                1st Place:  $cups_stats_goldESL  ( $cups_stats_goldESLpc% )</td>
		<td class='forumheader3' style='text-align:center;border-style:solid none'>                2nd Place:  $cups_stats_silverESL ( $cups_stats_silverESLpc% )</td>
		<td class='forumheader3' style='text-align:center;border-style:solid solid solid none'>    3th Place:  $cups_stats_bronzeESL ( $cups_stats_bronzeESLpc% )</td>
		</tr>
		</table>
		
		<br />";
*/
//------------------------------------------------------------------------------------------------------------+

  $mysql_query       = "SELECT * FROM $mysql_table WHERE result = '1st_place' OR result = '2nd_place' OR result = '3th_place' ";
  $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
  $mysql_result_size = mysql_num_rows($mysql_result);

  $paging_items  = 10;
  $paging_page   = intval($_GET[page]); if ($paging_page < 1) { $paging_page = 1; }
  $paging_offset = $paging_items * ($paging_page - 1);
  $paging_total  = ceil($mysql_result_size / $paging_items);

  $text .= "	<div id='cups'><br /></div>
  		<div style='width:95%; text-align:left'><b>Competition</b><br /><br /></div>
    		<table style='width:95%;border-collapse:collapse' cellspacing='0' cellpadding='0'>";

  $mysql_query       = "SELECT * FROM $mysql_table WHERE result = '1st_place' OR result = '2nd_place' OR result = '3th_place' ORDER BY timestamp DESC LIMIT $paging_offset,$paging_items";
  $mysql_result      = mysql_query($mysql_query) or die(mysql_error());
  $mysql_result_size = mysql_num_rows($mysql_result);

  for ($i=1; $i<= $mysql_result_size; $i++)
  {
    $mysql_row = mysql_fetch_array($mysql_result);

    $cups_result         = "$mysql_row[result]";
	if ($cups_result == '1st_place')
	{  $cups_result = '<b>1st</b>';  }
	if ($cups_result == '2nd_place')
	{  $cups_result = '<b>2nd</b>';  }
	if ($cups_result == '3th_place')
	{  $cups_result = '<b>3th</b>';  }

    
//------------------------------------------------------------------------------------------------------------+
      $cups_image_result   = "images/results/$mysql_row[result].gif";
      $cups_image_gamename = "images/game/$mysql_row[gamename]/icon.png";
      $cups_image_league = "images/league/$mysql_row[league].gif";

      if (!file_exists($cups_image_result))   { $cups_image_result = "images/other/unknown.gif"; }
      if (!file_exists($cups_image_gamename)) { $cups_image_gamename = "images/other/unknown.gif"; }
      if (!file_exists($cups_image_league))   { $cups_image_league = "images/other/unknown.gif"; }

      $cups_image_result = "<img style='width:16px;height:16px' src='$cups_image_result' alt='' title='$mysql_row[result]' />";
      $cups_image_gamename = "<img style='width:16px;height:16px' src='$cups_image_gamename' alt='' title='$mysql_row[gamename]' />";
      $cups_image_league = "<img style='width:16px;height:16px' src='$cups_image_league' alt='' title='$mysql_row[league]' />";

//------------------------------------------------------------------------------------------------------------+
      foreach ($mysql_row as $key => $value) { if (!is_array($value)) { $mysql_row[$key] = htmlspecialchars($value, ENT_QUOTES); } }
//------------------------------------------------------------------------------------------------------------+
include("cups_config.php");
//------------------------------------------------------------------------------------------------------------+

    $text .= "	<tr>
		<td class='forumheader3' style='white-space:nowrap;text-align:center;width:60px'> $cups_image_gamename $cups_image_result $cups_result</td>
		<td class='forumheader3' style='white-space:nowrap;text-align:left'> $mysql_row[league] - $mysql_row[event] </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:center'> $cups_image_league </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:center;width:90px'> <div title='".date("l H:i",$mysql_row[timestamp])."'> ".date($pref[cups_date_format],$mysql_row[timestamp])." </div> </td>
		<td class='forumheader3' style='white-space:nowrap;text-align:center;width:18px'> <a href='details.php?id=$mysql_row[id]'>$cups_image_details</a> </td>
		</tr>";
  }

  if ($mysql_result_size < 1) { $text .= "<tr><td class='forumheader3'><br /></td></tr>"; } // XHTML COMPLIANCE

  $text .= "	</table>
  		<br />
  		<br />";

//------------------------------------------------------------------------------------------------------------+
  $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=1#cups'> &laquo;] </a>";

  if ($paging_page > 3) { $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=".($paging_page - 3)."#cups'> [".($paging_page - 3)."] </a>"; }
  if ($paging_page > 2) { $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=".($paging_page - 2)."#cups'> [".($paging_page - 2)."] </a>"; }
  if ($paging_page > 1) { $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=".($paging_page - 1)."#cups'> [".($paging_page - 1)."] </a>"; }

  $text .= " $paging_page ";

  if ($paging_page < ($paging_total - 0)) { $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=".($paging_page + 1)."#cups'> [".($paging_page + 1)."] </a>"; }
  if ($paging_page < ($paging_total - 1)) { $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=".($paging_page + 2)."#cups'> [".($paging_page + 2)."] </a>"; }
  if ($paging_page < ($paging_total - 2)) { $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=".($paging_page + 3)."#cups'> [".($paging_page + 3)."] </a>"; }

  $text .= "<a style='text-decoration:none' href='$_SERVER[PHP_SELF]?page=$paging_total#cups'> [&raquo; </a>";
//------------------------------------------------------------------------------------------------------------+

  $text .= "	<br />
  		<br />
  		<br />
  		</div>";

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
//-- PLEASE MAKE A DONATION OR SIGN THE GUESTBOOK AT WWW.TEAM-AERO.CO.NR IF YOU REMOVE THIS CREDIT ----------------------------------------------------------------------------------------------------+
  $text .= "<div style='text-align:center;font-family:tahoma;font-size:9px'><a rel='external' href='http://www.team-aero.co.nr' style='text-decoration:none'>Cups v1.2 By Crytiqal.Aero</a></div>";
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

  $ns -> tablerender("Cups", $text);

  require_once(FOOTERF);

?>