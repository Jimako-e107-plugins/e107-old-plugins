<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
+----------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
$ecal_dir	= e_PLUGIN . "sport_league_e107/";
require_once($ecal_dir.'ecal_class.php');
$ecal_class3 = new ecal_class2;
$act_class = new ecal_class2;
define("HOME_COLOR", "#f6b822");
define("GAST_COLOR", "#448ccb");
define("HOME_TEXT", "#444");
define("GAST_TEXT", "#eee");
if(file_exists("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/calender_lan.php")){
require_once("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/calender_lan.php");
}




global $ecal_dir, $tp;
require_once("functionen.php");

if (is_readable(THEME."calendar_template.php"))
{
 require(THEME."/calendar_template.php");
}
else
{
 require($ecal_dir."templates/calendar_template.php");
}

$aktuelle_datum	= $act_class->cal_date;
$aktuelle_monat	= $aktuelle_datum['mon'];

$qs = $_GET['ligamonnav'];
if($qs == "")
{	// Show current month
  $kalender_datum	= $ecal_class3->cal_date;
} 
else
{	// Get date from query
  $kalender_datum	= getdate($qs);
}
////////////  Wenn Kalender Monat == Aktueller Monat ist...
if($aktuelle_datum['mon']==$kalender_datum['mon'])
	{
	$kalender_datum	= $ecal_class3->cal_date;	
	}
	$kalender_current_tag	= $kalender_datum['mday'];
  $kalender_current_monat	= $kalender_datum['mon'];
  $kalender_current_jahr	= $kalender_datum['year'];
///////////// Vormonat festlegen    ////////////////
$vormonat	= ($kalender_current_monat-1);
$vorjahr		= $kalender_current_jahr;
if ($vormonat == 0)
{
 $vormonat	= 12;
 $vorjahr	= ($vorjahr-1);
}
$previous = mktime(0, 0, 0, $vormonat, 1, $vorjahr);
///////////// NÃ¤chstes Monat festlegen   /////////
$nextmonat		= ($kalender_current_monat + 1);
$nextjahr		= $kalender_current_jahr;
if ($nextmonat == 13)
{
 $nextmonat	= 1;
 $nextjahr	++;
} 
$next			= mktime(0, 0, 0, $nextmonat, 1, $nextjahr); 
//////////////////////////////////////////////////////////////////////////////
$calmonth	= $datearray['mon'];     //  ?????
$calday		= $datearray['mday'];     //  ?????
$calyear	= $datearray['year'];     //  ?????

$tage_im_monat	= date("t",$qs);

$kalender_monatstart		= mktime(0, 0, 0, $kalender_current_monat, 1, $kalender_current_jahr);// Datum fÃ¼r Monatanfang
$kalender_erstes_tag	= getdate($kalender_monatstart);
$kalender_letztes_tag		= mktime(0, 0, 0, $kalender_current_monat + 1, 1, $kalender_current_jahr) -1;		//Datum fÃ¼r Monatende
//////////////////////////////////////////////////////////////////////////////
$qry1="
  	SELECT a.*, ab.* FROM ".MPREFIX."league_leagues AS a
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ab ON ab.leagueteam_league_id=a.league_id     
   	WHERE a.league_saison_id=".$pref['league_my_saison']." AND ab.leagueteam_my_team='1'
   			";
$sql->db_Select_gen($qry1);	
$myteamscount=0;
while($row = $sql-> db_Fetch())
		{
		$myteam[$myteamscount]['id']=$row['leagueteam_id'];
		$myteamscount++;
		}

$kalender_qry="
   	SELECT a.*, ab.*, bh.*, he.* FROM ".MPREFIX."league_games AS a
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ab ON ab.leagueteam_id=a.game_home_id   
   	LEFT JOIN ".MPREFIX."league_teams AS bh ON bh.team_id=ab.leagueteam_team_id 
   	LEFT JOIN ".MPREFIX."league_leagues AS he ON he.league_id=a.game_league_id 
   	WHERE a.game_date >= ".$kalender_monatstart." 
   		AND a.game_date <= ".$kalender_letztes_tag." 
   		AND he.league_saison_id=".$pref['league_my_saison']." ORDER BY a.game_date";
   		
$MYWERT=0;
$spiele = 0;
if ($spiele = $sql->db_Select_gen($kalender_qry))
{
 $gamescount=0;
  while ($kalender_row = $sql->db_Fetch())
  {
 	$termine[$gamescount]['home_name'] = $kalender_row['team_name'];
	$termine[$gamescount]['home_kurzname']= $kalender_row['team_kurzname'];
	$termine[$gamescount]['home_ID']= $kalender_row['game_home_id'];
	$termine[$gamescount]['home_image'] = $kalender_row['team_icon'];
	$termine[$gamescount]['games_id']= $kalender_row['game_id'];
	$termine[$gamescount]['games_saison_id']= $kalender_row['game_league_id'];
	$termine[$gamescount]['games_goals_home']= $kalender_row['game_goals_home'];
	$termine[$gamescount]['games_goals_gast']= $kalender_row['game_goals_gast'];
	$termine[$gamescount]['games_un']= $kalender_row['game_un'];
	$termine[$gamescount]['games_time']= $kalender_row['game_time'];
	$termine[$gamescount]['games_enable']= $kalender_row['game_enable'];
	$termine[$gamescount]['gast_id']= $kalender_row['game_gast_id'];	
	$termine[$gamescount]['game_date']= $kalender_row['game_date'];
	$gamescount++;
	}
//////////------------------------
for($i=0; $i <= $gamescount ; $i++)
	{
		$kalender_qry="
   	SELECT b.*, ba.* FROM ".MPREFIX."league_leagueteams AS b
   	LEFT JOIN ".MPREFIX."league_teams AS ba ON ba.team_id=b.leagueteam_team_id 
   	WHERE b.leagueteam_id =".$termine[$i]['gast_id']."
   			";	
	$sql->db_Select_gen($kalender_qry);
	$kalender_row = $sql-> db_Fetch();
	$termine[$i]['gast_name'] = $kalender_row['team_name'];
	$termine[$i]['gast_kurzname']= $kalender_row['team_kurzname'];
	$termine[$i]['gast_image'] = $kalender_row['team_icon'];	
	}
for($i=0; $i <= $gamescount ; $i++)
	{              //// alle Spiele durchlaufen
	for($j=0; $j <= $myteamscount ; $j++)
		{             ///// Meine Teams durchlaufen
		if($termine[$i]['home_ID']==$myteam[$j]['id'])
			{
			$termine[$i]['myteam_who']=1;break;  /// ist ein HEIMSPIEL!
			}
		elseif($termine[$i]['gast_id']==$myteam[$j]['id'])
			{
			$termine[$i]['myteam_who']=2;break;  /// ist ein AUSWÃ„RTSSPIEL!!
			}
		else
			{
			$termine[$i]['myteam_who']=0;break;  /// ist gar nicht unsere SPIEL!!!!
			}
		}	
	}
////////////////////////////////////////////////////////////////////////////////
$kalender_termine = array();
$heimspiele=0;
$auswaetrsspiele=0;
$termiene_insgesammt=0;
$cc=0;
for($i=0; $i <= $gamescount ; $i++)
	{
	if($termine[$i]['myteam_who']!=0)
		{
		$GAME['ID']=$termine[$i]['games_id'];
		if($termine[$i]['games_un']==1)
		{$RT="&nbsp;&nbsp;n.P";}
		else{$RT="";}
		if($termine[$i]['games_enable']==1)
			{$Link ="".e_PLUGIN."sport_league_e107/game_report.php?game_id=".$GAME['ID']."";
			$RESULT_TEXT="<tr><td style=\'font-size:20px;text-align:right;background:transparent;\'><b>".$termine[$i]['games_goals_home']."<\/b><\/td><td style=\'font-size:20px;text-align:center;background:transparent;\'>&nbsp;:&nbsp;<\/td><td style=\'font-size:20px;text-align:left;background:transparent;\'><b>".$termine[$i]['games_goals_gast']."<\/b> ".$RT."<\/td><\/tr>";
			}
		else{$Link ="".e_PLUGIN."sport_league_e107/league_stats.php?team_a=".$termine[$i]['home_ID']."&team_b=".$termine[$i]['gast_id']."";
			$RESULT_TEXT="";
			}
		if($termine[$i]['myteam_who']==1)
			{
			$Tool_Tip_Text="<table cellpadding=\'0\' cellspacing=\'0\'><tr><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tl.png) no-repeat;\'></td><td style=\'height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tc.png) repeat-x;\'></td><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tr.png) no-repeat;\'></td></tr><tr><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/bl.png) no-repeat;background-position:bottom;\'></td><td style=\'background:transparent url(".e_PLUGIN."sport_league_e107/images/bc.png) repeat-x;background-position:bottom;padding-bottom:10px;font-weight:bold;\'><table border=\'0\' cellspacing=\'0\'><tr><th colspan=\'3\' style=\'text-align:center;background:transparent\'>".LAN_LEAGUE_CALENDER_44."<\/th><\/tr><tr><td style=\'text-align:right;background:transparent\'><img src=".e_PLUGIN."sport_league_e107/logos/big/".$termine[$i]['home_image']." width=100 /><\/td><td style=\'text-align:center;background:transparent\'>@<\/td><td style=\'text-align:left;background:transparent\'><img src=".e_PLUGIN."sport_league_e107/logos/big/".$termine[$i]['gast_image']." width=100 /><\/td><\/tr><tr><td style=\'text-align:right;background:transparent\'><b>".$termine[$i]['home_name']."<\/b><\/td><td style=\'text-align:center;background:transparent\'>&nbsp;".LAN_LEAGUE_CALENDER_40."&nbsp;<\/td><td style=\'text-align:left;background:transparent\'><b>".$termine[$i]['gast_name']."<\/b><\/td><\/tr>".$RESULT_TEXT."<tr><td colspan=\'3\' style=\'text-align:center;background:transparent\'>".LAN_LEAGUE_CALENDER_41."<b>".strftime("%a %d %b %Y",$termine[$i]['game_date'])."<\/b><\/td><\/tr><tr><td colspan=\'3\' style=\'text-align:center;background:transparent\'>".LAN_LEAGUE_CALENDER_42."<b>".strftime("%H:%M",$termine[$i]['game_date'])."<\/b><\/td><\/tr><\/table></td><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/br.png) no-repeat;background-position:bottom;\'></td></tr></table>";
			$Link_ico = "<img style='width:30px;border:0px;' src='".e_PLUGIN."sport_league_e107/logos/".$termine[$i]['gast_image']."' alt='' />";
			$GAME[$cc]['wo']=1;
			$heimspiele++;
			if($termine[$i]['games_goals_home']>$termine[$i]['games_goals_gast'] && $termine[$i]['games_enable'])
				{
				$RESULT_TEXT=LAN_LEAGUE_CALENDER_36; // Siege Zeigen S
				}
			elseif($termine[$i]['games_goals_home']< $termine[$i]['games_goals_gast']&& $termine[$i]['games_enable'])
				{
				$RESULT_TEXT=LAN_LEAGUE_CALENDER_37; // Niederlagen Zeigen N
				}
			else{
				$RESULT_TEXT=" ";
				$termine[$i]['games_goals_home']="x";
				$termine[$i]['games_goals_gast']="x";
				}
			}
		elseif($termine[$i]['myteam_who']==2)
				{		
			$Tool_Tip_Text="<table cellpadding=\'0\' cellspacing=\'0\'><tr><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tl.png) no-repeat;\'></td><td style=\'height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tc.png) repeat-x;\'></td><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."sport_league_e107/images/tr.png) no-repeat;\'></td></tr><tr><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/bl.png) no-repeat;background-position:bottom;\'></td><td style=\'background:transparent url(".e_PLUGIN."sport_league_e107/images/bc.png) repeat-x;background-position:bottom;padding-bottom:10px;font-weight:bold;\'><table border=\'0\' cellspacing=\'0\'><tr><th colspan=\'3\' style=\'text-align:center;background:transparent;\'>".LAN_LEAGUE_CALENDER_45."<\/th><\/tr><tr><td style=\'text-align:right;background:transparent;\'><img src=".e_PLUGIN."sport_league_e107/logos/big/".$termine[$i]['home_image']." width=100 /><\/td><td style=\'text-align:center;background:transparent;\'>@<\/td><td style=\'text-align:left;background:transparent;\'><img src=".e_PLUGIN."sport_league_e107/logos/big/".$termine[$i]['gast_image']." width=100 /><\/td><\/tr><tr><td style=\'text-align:right;background:transparent;\'><b>".$termine[$i]['home_name']."<\/b><\/td><td style=\'text-align:center;background:transparent;\'>&nbsp;".LAN_LEAGUE_CALENDER_40."&nbsp;<\/td><td style=\'text-align:left;background:transparent;\'><b>".$termine[$i]['gast_name']."<\/b><\/td><\/tr>".$RESULT_TEXT."<tr><td colspan=\'3\' style=\'text-align:center;background:transparent;\'>".LAN_LEAGUE_CALENDER_41."<b>".strftime("%a %d %b %Y",$termine[$i]['game_date'])."<\/b><\/td><\/tr><tr><td colspan=\'3\' style=\'text-align:center;background:transparent;\'>".LAN_LEAGUE_CALENDER_42."<b>".strftime("%H:%M",$termine[$i]['game_date'])."<\/b><\/td><\/tr><\/table></td><td style=\'width:17px;background:transparent url(".e_PLUGIN."sport_league_e107/images/br.png) no-repeat;background-position:bottom;\'></td></tr></table>";
			$Link_ico = "<img style='width:30px;border:0px;' src='".e_PLUGIN."sport_league_e107/logos/".$termine[$i]['home_image']."' alt=''/>";
			$GAME[$cc]['wo']=2;
			$auswaetrsspiele++;
			if($termine[$i]['games_goals_home']>$termine[$i]['games_goals_gast'] && $termine[$i]['games_enable'])
				{
				$RESULT_TEXT=LAN_LEAGUE_CALENDER_37; // Niederlagen Zeigen
				}
			elseif($termine[$i]['games_goals_home']< $termine[$i]['games_goals_gast'] && $termine[$i]['games_enable'])
				{
				$RESULT_TEXT=LAN_LEAGUE_CALENDER_36; // Siege Zeigen
				}
			else{
				$RESULT_TEXT=" ";
				$termine[$i]['games_goals_home']="x";
				$termine[$i]['games_goals_gast']="x";
				}
			}
		$termiene_insgesammt++;														
		$Link_table="<table style='padding:0px;width:100%;background:transparent;' cellspacing='0' cellpadding='0'>
								 	<tr>
								 		<td style='text-align:center;font-size:9px'>
								 			<a href=\"".$Link."\" onmouseover=\"Tip('$Tool_Tip_Text')\" onmouseout=\"UnTip()\" > ".$Link_ico." \n
								 			".$RESULT_TEXT."(".$termine[$i]['games_goals_home'].":".$termine[$i]['games_goals_gast'].")</a></td>
								 	</tr>
								 </table>";
		$GAME[$cc]['text']=$Link_table;
		$GAME[$cc]['day']=$termine[$i]['game_date'];
		$GAME[$cc]['tag']=date("j",$termine[$i]['game_date']);
		$cc++;
		}	
	}
}

//<a href='index.htm' onmouseover=\"Tip($Link_table)\" onmouseout=\"UnTip()\">Homepage </a> 

///////////////////////////////////============================================================================
if ($pref['eventpost_weekstart'] == 'sun')
{
 $kalender_wochentag	= array(LAN_LEAGUE_CALENDER_7, LAN_LEAGUE_CALENDER_1, LAN_LEAGUE_CALENDER_2, LAN_LEAGUE_CALENDER_3, LAN_LEAGUE_CALENDER_4, LAN_LEAGUE_CALENDER_5, LAN_LEAGUE_CALENDER_6);
}
else
{
 $kalender_wochentag	= array(LAN_LEAGUE_CALENDER_1, LAN_LEAGUE_CALENDER_2, LAN_LEAGUE_CALENDER_3, LAN_LEAGUE_CALENDER_4, LAN_LEAGUE_CALENDER_5, LAN_LEAGUE_CALENDER_6, LAN_LEAGUE_CALENDER_7);
}
$kalender_monaten	= array(LAN_LEAGUE_CALENDER_8b, LAN_LEAGUE_CALENDER_9b, LAN_LEAGUE_CALENDER_10b, LAN_LEAGUE_CALENDER_11b, LAN_LEAGUE_CALENDER_12b, LAN_LEAGUE_CALENDER_13b, LAN_LEAGUE_CALENDER_14b, LAN_LEAGUE_CALENDER_15b, LAN_LEAGUE_CALENDER_16b, LAN_LEAGUE_CALENDER_17b, LAN_LEAGUE_CALENDER_18b, LAN_LEAGUE_CALENDER_19b);
///////////////////////////////////============================================================================
$kalender_title ="<table style='width:100%;height:20px;border:0px;' cellpadding='0' cellspacing='0'>
	<tr>
		<td style='text-align:left; vertical-align:middle; width:30%;'><a href='".e_SELF."?ligamonnav=".$previous."'>&lt;&lt; ".$kalender_monaten[($vormonat-1)]."</a></td>
		<td style='text-align:center;vertical-align:middle;width:40%;'><a class='forumlink' style='font-weight:bold;' href='".e_PLUGIN."sport_league_e107/league_calendar.php?Liga=".$termine[0]['games_saison_id']."'>".$kalender_monaten[($kalender_current_monat)-1]." ".$kalender_current_jahr."</a></td>
		<td style='text-align:right;vertical-align:middle;width:30%;'><a href='".e_SELF."?ligamonnav=".$next."'> ".$kalender_monaten[($nextmonat-1)]." &gt;&gt;</a></td>
	</tr>
</table>";
///////////////////////////////////============================================================================	
$inhalt_text="<script type=\"text/javascript\" src=\"".e_PLUGIN."sport_league_e107/handler/wz_tooltip.js\"></script>";
$inhalt_text.=$kalender_title;

$inhalt_text .= $CALENDAR_MENU_START;
if($termiene_insgesammt > 0)
  {
  $inhalt_text .="".LAN_LEAGUE_CALENDER_33."".$termiene_insgesammt ." ".LAN_LEAGUE_CALENDER_34."";
  }
else
  {
  $inhalt_text .=LAN_LEAGUE_CALENDER_32;
  }
  $inhalt_text .= "<br/>";

///////////////////////////  Tabelle-Anfang  /////////////////
$inhalt_text .= $CALENDAR_MENU_TABLE_START;
$inhalt_text.="<tr>";
for($i=0; $i < 7 ; $i++)
	{
	$inhalt_text.="".$CALENDAR_MENU_HEADER_FRONT."".$kalender_wochentag[$i]."".$CALENDAR_MENU_HEADER_BACK."";  /// Wochentage anzeigen
	}
$firstdayoffset = ($kalender_erstes_tag['wday'] == 0 ? $kalender_erstes_tag['wday'] + 6 : $kalender_erstes_tag['wday']-1);
$inhalt_text.="</tr><tr>";
for ($kalender_feld = 0; $kalender_feld < $firstdayoffset; $kalender_feld++)
	{
	$inhalt_text .= "".$CALENDAR_MENU_DAY_START['4']."&nbsp;".$CALENDAR_MENU_DAY_END['4']."";
	}
$kal_loop = $firstdayoffset;
for($kalender_feld = 1; $kalender_feld <= 31; $kalender_feld++)
{
if($kal_loop > 4){$DAY_CLASS=$CALENDAR_MENU_DAY_START['3'];}else{$DAY_CLASS=$CALENDAR_MENU_DAY_START['5'];}
$termine_text="";
if($kalender_feld==$aktuelle_datum['mday'] && $aktuelle_datum['mon']==$kalender_datum['mon'])
	{$DAY_CLASS=$CALENDAR_MENU_DAY_START['1'];$termine_text .=LAN_LEAGUE_CALENDER_35;} // Heute anzeigen
$inhalt_text .= $DAY_CLASS;
$WO=0;
for($i=0; $i <= $cc ; $i++)
	{
	if($GAME[$i]['tag']==$kalender_feld)
		{
		$termine_text .=$GAME[$i]['text'];
		$WO=$GAME[$i]['wo'];
		}
	}
if($termine_text==""){$termine_text .="&nbsp;";}	
 $inhalt_text .=day_table($kalender_feld,$termine_text,$WO);
 $inhalt_text .= "</td>";
 $kal_loop++;
 if ($kal_loop == 7)
  {
  $inhalt_text .= "</tr><tr>";	
  $kal_loop = 0;
	}
if($kalender_feld==$tage_im_monat)	
	{
	break;
	}
}
if($kal_loop!=0)
	{
	for($j=$kal_loop; $j< 7;$j++)
		{
		$inhalt_text .= "<td class='forumheader2'>&nbsp;</td>";	
		}
	}
///////////////////////////  Tabelle-Ende   /////////////////
$inhalt_text.="</tr></table>";

$inhalt_text.="<table style='padding:0px;width:100%;background:transparent;' cellspacing='0' cellpadding='0'>
								<tr>
									<td colspan='4' style='text-align:left;'>
										<div style='vertical-align:midle; color:".HOME_COLOR.";font-weight:bold;'>".$heimspiele."-".LAN_LEAGUE_CALENDER_22." </div>
										<div style='vertical-align:midle; color:".GAST_COLOR.";font-weight:bold;'>".$auswaetrsspiele."-".LAN_LEAGUE_CALENDER_23." </div>
									</td>
									<td colspan='3' style='text-align:left;'>".LAN_LEAGUE_CALENDER_25."<br/>".LAN_LEAGUE_CALENDER_27."
									</td>
								</tr>
							</table><br/>";
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernÃ¼nftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$inhalt_text .=powered_by();
/// =========================================================================================
$inhalt_text .="</div>";

$kalender_title="";


$ns->tablerender($kalender_title, $inhalt_text, '');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function day_table($tag,$termine_text,$WO)
{

if($WO==1){$FARBE1="background-color: ".HOME_COLOR.";border:".HOME_COLOR." 2px solid;color:".HOME_TEXT.";";
					 $FARBE2="border:".HOME_COLOR." 2px solid;";}
elseif($WO==2){$FARBE1="background-color: ".GAST_COLOR.";border:".GAST_COLOR." 2px solid;color:".GAST_TEXT.";";
					 		 $FARBE2="border:".GAST_COLOR." 2px solid;";}
else{$FARBE="";}
$ausgabe="<table style='width:100%;border:0px;' cellpadding='0' cellspacing='0'>
						<tr>
							<td style='".$FARBE1." height:5px; text-align:center;'>".$tag."</td>
						</tr>
						<tr>
							<td style='".$FARBE2." height:25px;text-align:center;padding:2px;'>".$termine_text."</td>
						</tr>
					</table>";
return $ausgabe;
}
?>