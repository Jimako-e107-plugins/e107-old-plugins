<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+----------------------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);
if(file_exists("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/calender_lan.php")){
require_once("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/calender_lan.php");
}else{require_once("".e_PLUGIN."sport_league_e107/languages/German/calender_lan.php");}
require_once("functionen.php");

$ecal_dir	= e_PLUGIN . "sport_league_e107/";
require_once($ecal_dir.'ecal_class.php');
$ecal_class4 = new ecal_class2;
$ecal_class2 = new ecal_class2;
global $ecal_dir, $tp;

$LIGA=$_GET['Liga'];

$qry1="
  	SELECT a.*, ab.* FROM ".MPREFIX."league_leagues AS a
   	LEFT JOIN ".MPREFIX."league_saison AS ab ON ab.saison_id=a.league_saison_id     
   	WHERE a.league_id=".$LIGA."
   			";
$sql->db_Select_gen($qry1);	
$liga_row = $sql-> db_Fetch();
$LIGA_NAME = $liga_row['league_name'];
$SAISON_NAME= $liga_row['saison_name'];
$SAISON= $liga_row['saison_id'];

$LOGO_X="20";
$LOGO_Y="20";

if (is_readable(THEME."calendar_template.php"))
{
  require(THEME."calendar_template.php");
}
else
{  // 
  require($ecal_dir."templates/calendar_template.php");
}

$act_datearray	= $act_class2->cal_date;
$act_month	= $act_datearray['mon'];

$qs = $_GET['lcalnav'];
if($qs == "")
{	// Show current month
  $cal_datearray	= $ecal_class4->cal_date;
} 
else
{	// Get date from query
  $cal_datearray	= getdate($qs);
}
if($act_datearray['mon']==$cal_datearray['mon'])
	{
	$cal_datearray	= $ecal_class4->cal_date;	
	}
	$cal_current_day	= $cal_datearray['mday'];
  $cal_current_month	= $cal_datearray['mon'];
  $cal_current_year	= $cal_datearray['year'];



$prevmonth		= ($cal_current_month-1);
$prevyear		= $cal_current_year;
if ($prevmonth == 0)
{
    $prevmonth	= 12;
    $prevyear	= ($year-1);
} 
$previous = mktime(0, 0, 0, $prevmonth, 1, $prevyear);		// Used by nav


$nextmonth		= ($cal_current_month + 1);
$nextyear		= $cal_current_year;
if ($nextmonth == 13)
{
    $nextmonth	= 1;
    $nextyear	= ($cal_current_year + 1);
} 
$next			= mktime(0, 0, 0, $nextmonth, 1, $nextyear);


$numberdays	= date("t", $ecal_class2->cal_date); // anzahl der Tage in diesem Monat


$cal_monthstart		= mktime(0, 0, 0, $cal_current_month, 1, $cal_current_year);			// Time stamp for first day of month
$cal_firstdayarray	= getdate($cal_monthstart);
$cal_monthend		= mktime(0, 0, 0, $cal_current_month + 1, 1, $cal_current_year) -1;		// Time stamp for last day of month

$ZUGF=0;



 	  $cal_qry="
   	SELECT a.*, ab.*, bh.* FROM ".MPREFIX."league_games AS a
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ab ON ab.leagueteam_id=a.game_home_id   
   	LEFT JOIN ".MPREFIX."league_teams AS bh ON bh.team_id=ab.leagueteam_team_id 
   	WHERE a.game_date >= ".$cal_monthstart." AND a.game_date <= ".$cal_monthend." AND a.game_league_id=".$LIGA." ORDER BY a.game_date
   			";
$GAMES_CONT=0;
$cal_events = array();
$cal_totev = 0;
$TODAY_CONT=0;
$last=0;
if ($cal_totev = $sql->db_Select_gen($cal_qry))
{
  while ($cal_row = $sql->db_Fetch())
  {$GAMES_CONT++;
      $cal_tmp = getdate($cal_row['game_date']);
      if ($cal_tmp['mon'] == $cal_current_month)  /// Wenn Spiel im diesem Monat...
      {
        $cal_start_day = $cal_tmp['mday'];      /// dann Wird Datum als Index der Arry genohmen
        if($cal_start_day == $last)
        		{
        		$TODAY_CONT++;		
        		}
        else{$TODAY_CONT=1;$last=$cal_start_day;}
      }
      else
      {
        $cal_start_day = 1;
        $TODAY_CONT=0;
      }

  $cal_events[$cal_start_day]['events'] = $TODAY_CONT;    
  
	$GAMEDATA[$cal_start_day][$TODAY_CONT]['home_name'] = $cal_row['team_name'];
	$GAMEDATA[$cal_start_day][$TODAY_CONT]['home_kurzname']= $cal_row['team_kurzname'];
	$GAMEDATA[$cal_start_day][$TODAY_CONT]['home_ID']= $cal_row['game_home_id'];
	$GAMEDATA[$cal_start_day][$TODAY_CONT]['home_image'] = $cal_row['team_icon'];

	$GAMEDATA[$cal_start_day][$TODAY_CONT]['game_id']= $cal_row['game_id'];
	$GAMEDATA[$cal_start_day][$TODAY_CONT]['game_saison_id']= $cal_row['game_saison_id'];
	$GAMEDATA[$cal_start_day][$TODAY_CONT]['game_goals_home']= $cal_row['game_goals_home'];
	$GAMEDATA[$cal_start_day][$TODAY_CONT]['game_goals_gast']= $cal_row['game_goals_gast'];
	$GAMEDATA[$cal_start_day][$TODAY_CONT]['game_un']= $cal_row['game_un'];
	$GAMEDATA[$cal_start_day][$TODAY_CONT]['game_enable']= $cal_row['game_enable'];
  $GAMEDATA[$cal_start_day][$TODAY_CONT]['game_date']= $cal_row['game_date'];
	$GAMEDATA[$cal_start_day][$TODAY_CONT]['gast_id']= $cal_row['game_gast_id'];
	$ZUGF++;
	}
}

for($i=1; $i <= $cal_start_day ; $i++)
	{
	$INHALT_FUR_DEN_TAG[$i]="<table>";	
	for($j=0; $j < $cal_events[$i]['events']+1 ; $j++)
		{
	if($GAMEDATA[$i][$j]['game_id']!='')
		{	
		$cal_qry="
   	SELECT b.*, ba.* FROM ".MPREFIX."league_leagueteams AS b
   	LEFT JOIN ".MPREFIX."league_teams AS ba ON ba.team_id=b.leagueteam_team_id 
   	WHERE b.leagueteam_id =".$GAMEDATA[$i][$j]['gast_id']."
   			";	

	$sql->db_Select_gen($cal_qry);
	$row = $sql-> db_Fetch();
	$GAMEDATA[$i][$j]['gast_name'] = $row['team_name'];
	$GAMEDATA[$i][$j]['gast_kurzname']= $row['team_kurzname'];
	$GAMEDATA[$i][$j]['gast_image'] = $row['team_icon'];	

	$RESULT_TEXT = "<tr><td style=\'font-size:20px;text-align:center;background:#fff;\' colspan=\'3\'><b>";
	if($GAMEDATA[$i][$j]['game_enable']==1)
		{
		$Link="".e_PLUGIN."sport_league_e107/game_report.php?game_id=".$GAMEDATA[$i][$j]['game_id']."";	
		$RESULT_TEXT .="".$GAMEDATA[$i][$j]['game_goals_home']." : ".$GAMEDATA[$i][$j]['game_goals_gast']."";
		if($GAMEDATA[$i][$j]['game_un']==1)
			{
			$RESULT_TEXT .=" n.P.";
			}	
		}
	else
		{
		$Link="".e_PLUGIN."sport_league_e107/league_stats.php?team_a=".$GAMEDATA[$i][$j]['home_ID']."&&team_b=".$GAMEDATA[$i][$j]['gast_id']."";	
		$RESULT_TEXT .="x : x";
		}
	$RESULT_TEXT .="<\/td><\/tr>";
	
	
	$GAMEDATA[$i][$j]['desc']="<table border=\'0\' cellspacing=\'0\'><tr><th colspan=\'3\' style=\'text-align:center;background:#fff;\'><\/th><\/tr><tr><td style=\'text-align:right;background:#fff;\'><img src=".e_PLUGIN."sport_league_e107/logos/big/".$GAMEDATA[$i][$j]['home_image']." width=100 /><\/td><td style=\'text-align:center;background:#fff;\'>@<\/td><td style=\'text-align:left;background:#fff;\'><img src=".e_PLUGIN."sport_league_e107/logos/big/".$GAMEDATA[$i][$j]['gast_image']." width=100 /><\/td><\/tr><tr><td style=\'text-align:right;background:#fff;\'><b>".$GAMEDATA[$i][$j]['home_name']."<\/b><\/td><td style=\'text-align:center;background:#fff;\'>&nbsp;".LAN_LEAGUE_CALENDER_40."&nbsp;<\/td><td style=\'text-align:left;background:#fff;\'><b>".$GAMEDATA[$i][$j]['gast_name']."<\/b><\/td><\/tr>".$RESULT_TEXT."<tr><td colspan=\'3\' style=\'text-align:center;background:#fff;\'>".LAN_LEAGUE_CALENDER_41."<b>".strftime("%a %d %b %Y",$GAMEDATA[$i][$j]['game_date'])."<\/b><\/td><\/tr><tr><td colspan=\'3\' style=\'text-align:center;background:#fff;\'>".LAN_LEAGUE_CALENDER_42."<b>".strftime("%H:%M",$GAMEDATA[$i][$j]['game_date'])."<\/b><\/td><\/tr><\/table>";	
	$GAMEDATA[$i][$j]['image']= "<a href=\"".$Link."\" onmouseover=\"Tip('".$GAMEDATA[$i][$j]['desc']."', TITLE, '".LAN_LEAGUE_CALENDER_43."', WIDTH, 225, SHADOW, true, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true, TITLEBGCOLOR, '#000', TITLEFONTCOLOR, '#fff', BGCOLOR, '#fff', BORDERCOLOR, '#000')\" onmouseout=\"UnTip()\" ><img style='border:0; height='".$LOGO_Y."' width='".$LOGO_X."; vertical-align: middle;' src='".e_PLUGIN."sport_league_e107/logos/".$GAMEDATA[$i][$j]['home_image']."'/><img style='border:0; height='".$LOGO_Y."' width='".$LOGO_X."; vertical-align: middle;' src='".e_PLUGIN."sport_league_e107/logos/".$GAMEDATA[$i][$j]['gast_image']."'/></a>";
 	$INHALT_FUR_DEN_TAG[$i].="<tr><td>".$GAMEDATA[$i][$j]['image']."</td></tr>";
 		}
 	}
 $INHALT_FUR_DEN_TAG[$i].="</table>";
 }



if ($pref['eventpost_weekstart'] == 'sun')
{
  $cal_week	= array(LAN_LEAGUE_CALENDER_7, LAN_LEAGUE_CALENDER_1, LAN_LEAGUE_CALENDER_2, LAN_LEAGUE_CALENDER_3, LAN_LEAGUE_CALENDER_4, LAN_LEAGUE_CALENDER_5, LAN_LEAGUE_CALENDER_6);
}
else
{
  $cal_week	= array(LAN_LEAGUE_CALENDER_1, LAN_LEAGUE_CALENDER_2, LAN_LEAGUE_CALENDER_3, LAN_LEAGUE_CALENDER_4, LAN_LEAGUE_CALENDER_5, LAN_LEAGUE_CALENDER_6, LAN_LEAGUE_CALENDER_7);
}

$cal_months	= array(LAN_LEAGUE_CALENDER_8, LAN_LEAGUE_CALENDER_9, LAN_LEAGUE_CALENDER_10, LAN_LEAGUE_CALENDER_11, LAN_LEAGUE_CALENDER_12, LAN_LEAGUE_CALENDER_13, LAN_LEAGUE_CALENDER_14, LAN_LEAGUE_CALENDER_15, LAN_LEAGUE_CALENDER_16, LAN_LEAGUE_CALENDER_17, LAN_LEAGUE_CALENDER_18, LAN_LEAGUE_CALENDER_19);


$caletitle ="<table style='border:0;width:100%;'>
	<tr>
		<td style='width:20%;text-align:left;color:#fff'>
		<a href='".e_SELF."?Liga=".$LIGA."&&lcalnav=".$previous."'>&lt;&lt; ".$cal_months[($prevmonth-1)]."</a>
		</td>								
		<td style='width:60%;text-align:center;'>
		<a class=' ' style='font-weight:bold;' href='".e_SELF."'>";

 $caletitle .= $cal_months[$cal_datearray['mon']-1] ." ". $cal_current_year . "</a>";

$caletitle .= "</td>
		<td style='width:20%;text-align:right;color:#fff'>
		<a href='".e_SELF."?Liga=".$LIGA."&&lcalnav=".$next."'> ".$cal_months[($nextmonth-1)]." &gt;&gt;</a>
		</td>
	</tr>
</table>";
$cal_text = $BIGCALENDAR_MENU_START;

if ($pref['eventpost_showeventcount']=='1')
{
  if ($cal_totev)
  {
    $cal_text .= LAN_LEAGUE_CALENDER_31 . "<a href='league_teams.php?".$SAISON.".".$LIGA."'> ".$LIGA_NAME." (".$SAISON_NAME.") </a> : " . $cal_totev;
  }
  else
  {
    $cal_text .= LAN_LEAGUE_CALENDER_32;
  }
  $cal_text .= "<br /><br />";
}

$cal_start	= $cal_monthstart;		// First day of month as time stamp


// Start the table
$cal_text .= $BIGCALENDAR_MENU_TABLE_START;
// Open header row
$cal_text .= $BIGCALENDAR_MENU_HEADER_START;
// Now do the headings

foreach($cal_week as $cal_day)
{
    $cal_text .= $BIGCALENDAR_MENU_HEADER_FRONT;
	$cal_text .= $tp->text_truncate($cal_day, $pref['eventpost_lenday'], '');
    $cal_text .= $BIGCALENDAR_MENU_HEADER_BACK;
}
$cal_text .= $BIGCALENDAR_MENU_HEADER_END;  // Close off header row, open first date row


$cal_thismonth	= $cal_datearray['mon'];
$cal_thisday	= $cal_datearray['mday'];	// Today


if ($pref['eventpost_weekstart'] == 'mon')
{
    $firstdayoffset = ($cal_firstdayarray['wday'] == 0 ? $cal_firstdayarray['wday'] + 6 : $cal_firstdayarray['wday']-1);
}
else
{
    $firstdayoffset = $cal_firstdayarray['wday'];
}


for ($cal_c = 0; $cal_c < $firstdayoffset; $cal_c++)
{
	$cal_text .= $BIGCALENDAR_MENU_DAY_NON;
}
$cal_loop = $firstdayoffset;

// Now do the days of the month
for($cal_c = 1; $cal_c <= 31; $cal_c++)
{   // Four cases to decode:
	//    1 - Today, no events
	//		2 - Some other day, no events (or no icon defined)
	//		3 - Today with events (and icon defined)
	//		4 - Some other day with events (and icon defined)
  $cal_dayarray = getdate($cal_start + (($cal_c-1) * 86400));
	$cal_css = 2;		// The default - not today, no events
    if ($cal_dayarray['mon'] == $cal_thismonth)
    	{// Dates match for this month
      $cal_img = $cal_c;// Default 'image' is the day of the month
      $title = "";
      if ($cal_thisday == $cal_c) $cal_css = 1;
      if($cal_loop > 4) $cal_css = 6;
      
      if($cal_events[$cal_c]['events'] > 0)
      	{
      //	$cal_img="".$cal_c."<table>";
      		$cal_img .= $INHALT_FUR_DEN_TAG[$cal_c];
      //	for($i=0; $i < $cal_events[$cal_c]['events']+1; $i++)
      //		{
      	//		$cal_event_icon = $INHALT_FUR_DEN_TAG[$cal_c];
      			
      			//$cal_event_icon = $GAMEDATA[$cal_c][$i]['image'];
      			//$cal_img .= "<tr><td style='vertical-align: middle; font-weight: bold; '>".$cal_event_icon." ".$GAMEDATA[$cal_c][$i]['game_time']."</td></tr>";
      	//		$cal_img .= "<tr><td style='vertical-align: middle; font-weight: bold; '>".$cal_event_icon."</td></tr>";
      	//	}
				//	$cal_img .="</table>";
	 	   		$cal_text .= $BIGCALENDAR_MENU_DAY_START[$cal_css]."{$cal_img}";
					}
	 	  else
	 	  		{ 
        $cal_text .= $BIGCALENDAR_MENU_DAY_START[$cal_css]."{$cal_img}";
					}
        $cal_text .= $BIGCALENDAR_MENU_DAY_END[$cal_css];
        $cal_loop++;
        if ($cal_loop == 7)
       		 {  // Start next row
            $cal_loop = 0;
						if ($cal_c != $numberdays)
							{
       				$cal_text .= $BIGCALENDAR_MENU_WEEKSWITCH;
							}
     				}
    		}
  }

if ($cal_loop != 0)
{
for($cal_a = ($cal_loop + 1); $cal_a <= 7; $cal_a++)
{
	$cal_text .= $BIGCALENDAR_MENU_DAY_NON;
}
}
// Close table
$cal_text .= $BIGCALENDAR_MENU_END;

/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernÃ¼nftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$cal_text .=powered_by();
/// =========================================================================================
$ns->tablerender($caletitle, $cal_text);
require_once(FOOTERF);
?>
