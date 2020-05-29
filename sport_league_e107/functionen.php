<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        ©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/funktionen.php,v $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/form_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/English/form_lan.php");
require_once("constants.php");

function delete_player($id)
	{
		
$ImageUPDATET['PFAD']=e_PLUGIN."sport_league_e107/images/system/check.png";
$ImageUPDATET['LINK']="<div style='border: #009900 1px solid;color:#009900;background:#dfffdf;padding:10px;text-align:left;'>
<img border='0' style='vertical-align: middle;flit:left;' title='' src='".$ImageUPDATET['PFAD']."'>";

$ImageERROR['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_32.png";
$ImageERROR['LINK']="<div style='border: #BB4444 1px solid;color:#BB4444;background:#ffcccc;padding:10px;text-align:left;'>
<img border='0' style='vertical-align: middle;flit:left;' title='' src='".$ImageERROR['PFAD']."'>";
  $DELPLsql =& new db;		
	if($DELPLsql -> db_Delete("league_players", "players_id='".$id."' "))
			{
			$DELPLsql -> db_Select("league_roster", "*", "roster_player_id='".$id."'");
			$temppl="";
			$rostercount=0;
			while($DELrow = $DELPLsql-> db_Fetch())
				{
				$temppl .=delete_player_roster($DELrow['roster_id']);
				$rostercount++;	
				}		
			return $ImageUPDATET['LINK']."[".$id."]-Player ist gelöscht und: <br/>".$temppl."</div>";	
			}
	else return $ImageUPDATET['LINK']."[".$id."]-Player nicht gelöscht</div>";
	}
	
//////+++++++++++++++++++++++++++
function delete_player_roster($id)
	{
	$ROSTtemp="";	
  $DELROSTsql =& new db;	
	if($DELROSTsql -> db_Delete("league_roster", "roster_id='".$id."' "))
		{
		$ROSTtemp.="<br/>[".$id."]-Roster ist gelöscht (anw: ";
		$ROSTtemp.= delete_player_anw($id);	
		$ROSTtemp.=" points: ";
		$ROSTtemp.= delete_player_points($id);
		$ROSTtemp.=" penaltys: ";
		$ROSTtemp.= delete_player_penalty($id);
		return "".$ROSTtemp.")";	
		}
		else return "[".$id."]-Roster nicht gelöscht";
	}
//////+++++++++++++++++++++++++++
function delete_liga_team($id)
	{
	$TEAMtemp="";	
  $DELTEAMsql =& new db;
  $DELROSTERSsql =& new db;
  $DELGAMESsql =& new db;
  
	if($DELTEAMsql -> db_Delete("league_leagueteams", "leagueteam_id='".$id."' "))
		{
		$TEAMtemp.="[".$id."]-Team ist aus der Liga gelöscht mit: <br/>(Roster: ";
		//////////////  alle Spieler der Mannschaft löschen  +++++++++++++++++++++++++
		$DELROSTERScount=0;
		$DELROSTERSsql -> db_Select("league_roster", "*", "roster_team_id='".$id."'");
		while($ROSrow = $DELROSTERSsql-> db_Fetch())
		{
		$TEAMtemp.= delete_player_roster($ROSrow['roster_id']);
		$DELROSTERScount++;
		}
		if($DELROSTERScount==0)
			{
			$TEAMtemp.="Kein Kader war vorhanden.";
			}
		//////////////  und alle Spiele der Mannschaft löschen  +++++++++++++++++++++++++
		$TEAMtemp.=") <br/>(Spiele der Mannschaft: ";
		$DELGAMEScount=0;
		$DELGAMESsql -> db_Select("league_games", "*", "game_home_id='".$id."' OR game_gast_id='".$id."'");
		while($GAMrow = $DELGAMESsql-> db_Fetch())
		{
		$TEAMtemp.= delete_games($GAMrow['game_id']);
		$DELGAMEScount++;
		}
		if($DELGAMEScount>0)
			{
			return "".$TEAMtemp.")<br/>";		
			}
		else return "".$TEAMtemp." Keine Spiele waren vorhanden.)<br/>";
		}
		else return "[".$id."]-Team ist aus der Liga nicht gelöscht";
	}
//////+++++++++++++++++++++++++++
function delete_team($id)
	{
	
	}
//////+++++++++++++++++++++++++++
function delete_player_points($id)
	{
	$DELPOsql =& new db;	
	$DELPOsql -> db_Select("league_anw", "*", "anw_player_id='".$id."'");
	$POtemp="";
	$POcount=0;
	$POcount2=0;
	while($POrow = $DELPOsql-> db_Fetch())
		{
		$PO_LIST[$POcount]= $POrow['anw_id'];
		$DELPOsql -> db_Select("league_roster", "*", "roster_player_id='".$id."'");
		$POcount++;
		}
	for($i=0;$i < $POcount; $i++)				
		{
		if($DELPOsql -> db_Delete("league_anw", "anw_id='".$PO_LIST[$i]."' "))
			{
			$POtemp.="".$PO_LIST[$i].",";
			$POcount2++;
			}
		}
	if($POcount2 >0)
		{	
		return 	$POtemp;
		}
	else return "0";
	}
//////+++++++++++++++++++++++++++
function delete_player_anw($id)
	{
	$DELPLsql =& new db;	
	$DELPLsql -> db_Select("league_anw", "*", "anw_player_id='".$id."'");
	$ANWtemp="";
	$ANWcount=0;
	$ANWcount2=0;
	while($ANWrow = $DELPLsql-> db_Fetch())
		{
		$ANW_LIST[$ANWcount]= $ANWrow['anw_id'];
		$DELPLsql -> db_Select("league_roster", "*", "roster_player_id='".$id."'");
		$ANWcount++;
		}
	for($i=0;$i < $ANWcount; $i++)				
		{
		if($DELPLsql -> db_Delete("league_anw", "anw_id='".$ANW_LIST[$i]."' "))
			{
			$ANWtemp.="".$ANW_LIST[$i].",";
			$ANWcount2++;
			}
		}
	if($ANWcount2 >0)
		{	
		return 	$ANWtemp;
		}
	else return "0";
	}
//////+++++++++++++++++++++++++++
function delete_player_penalty($id)
	{
	$DELPENsql =& new db;	
	$DELPENsql -> db_Select("league_anw", "*", "anw_player_id='".$id."'");
	$PENtemp="";
	$PENcount=0;
	$PENcount2=0;
	while($PENrow = $DELPENsql-> db_Fetch())
		{
		$PEN_LIST[$PENcount]= $PENrow['anw_id'];
		$DELPENsql -> db_Select("league_roster", "*", "roster_player_id='".$id."'");
		$PENcount++;
		}
	for($i=0;$i < $PENcount; $i++)				
		{
		if($DELPENsql -> db_Delete("league_anw", "anw_id='".$PEN_LIST[$i]."' "))
			{
			$PENtemp.="".$PEN_LIST[$i].",";
			$PENcount2++;
			}
		}
	if($PENcount2 >0)
		{	
		return 	$PENtemp;
		}
	else return "0";
	}
//////+++++++++++++++++++++++++++
function delete_games($id)
	{
  $DELGAMsql =& new db;		
	if($DELGAMsql -> db_Delete("league_games", "game_id='".$id."' "))
			{
			$tempgame.="<br/>[".$id."]-Spiel gelöscht und :(anw: ";
			$tempgame.= delete_player_anw($id);	
			$tempgame.=" points: ";
			$tempgame.= delete_player_points($id);
			$tempgame.=" penaltys: ";
			$tempgame.= delete_player_penalty($id);
			return "".$ROSTtemp.")";	
			}
	else return "[".$id."]-Spiel nicht gelöscht";
	}
//////+++++++++++++++++++++++++++

function druckansicht($von_der_Seite, $S_id, $T_id)
{
if($von_der_Seite=="league_games.php")
	{
	$printinhalt="
			<a  target='_blank' href='print/print_games_table.php?Liga=".$S_id."&&Team=".$T_id."'>
				<img src='".e_PLUGIN."sport_league_e107/images/printer.png' alt='Drucken' name='Drucken' border='0'/>
				</a>";
	}
if($von_der_Seite=="roster.php")
	{
	$printinhalt="
			<a  target='_blank' href='print/print_roster_table.php?Team=".$T_id."'>
				<img src='".e_PLUGIN."sport_league_e107/images/printer.png' alt='Drucken' name='Drucken' border='0'/>
				</a>";
	}
return $printinhalt;
}
//////+++++++++++++++++++++++++++
function team_links($id, $name, $liga, $teamurl)
{
$linkstext="
<a href='".e_PLUGIN."sport_league_e107/league_games.php?Liga=".$liga."&&team=".$id."' title='".LAN_LEAGUE_TEAM_LINKS_1."".$name."'><img border='0' src='".e_PLUGIN."sport_league_e107/images/calendar_icon.gif'></a>
<a href='".e_PLUGIN."sport_league_e107/roster.php?team=".$id."' title='".LAN_LEAGUE_TEAM_LINKS_2."".$name."'><img border='0' src='".e_PLUGIN."sport_league_e107/images/team_icon.gif'></a>
<a href='".$teamurl."' title='".LAN_LEAGUE_TEAM_LINKS_3."".$name."'><img border='0' src='".e_PLUGIN."sport_league_e107/images/mail.gif'></a>
<a href='".e_PLUGIN."sport_league_e107/roster_points.php?team=".$id."' title='".LAN_LEAGUE_TEAM_LINKS_4."".$name."'><img border='0' src='".e_PLUGIN."sport_league_e107/images/curve_icon.gif'></a>
<a href='".e_PLUGIN."sport_league_e107/league_teaminfo.php?".$id."'><img border='0' src='".e_PLUGIN."sport_league_e107/images/teaminfo_icon.gif' alt='' title='".LAN_LEAGUE_TEAM_LINKS_12." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'>
											</a>";
return $linkstext;	
}
//////+++++++++++++++++++++++++++
function team_links_H($id, $name, $saison, $teamurl)
{
	$linkstext="<table style='width:100%' cellspacing='0' cellpadding='0'>
									<tr>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/league_games.php?Liga=".$saison."&&team=".$id."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/calendar_icon.gif' alt='' title='".LAN_LEAGUE_TEAM_LINKS_6." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'>
											</a>
										</td>
										<td><a href='league_games.php?Liga=".$saison."&&team=".$id."'><b>&nbsp;&nbsp;".LAN_LEAGUE_TEAM_LINKS_5."</b></a>
										</td>
									</tr>
									<tr>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/roster.php?team=".$id."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/team_icon.gif' alt='' title='".LAN_LEAGUE_TEAM_LINKS_15." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'>
											</a>
										</td>
										<td><a href='roster.php?team=".$id."'><b>&nbsp;&nbsp;".LAN_LEAGUE_TEAM_LINKS_14."</b></a>
										</td>
									</tr>
									<tr>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/roster_points.php?team=".$id."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/curve_icon.gif' alt='' title='".LAN_LEAGUE_TEAM_LINKS_8." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'>
											</a>
										</td>
										<td><a href='".e_PLUGIN."sport_league_e107/roster_points.php?team=".$id."' title='".LAN_LEAGUE_TEAM_LINKS_8." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'><b>&nbsp;&nbsp;".LAN_LEAGUE_TEAM_LINKS_7."</b></a>
										</td>
									</tr>
									<tr>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/penalty.php?team=".$id."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/foults_icon.gif' alt='' title='".LAN_LEAGUE_TEAM_LINKS_17." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'>
											</a>
										</td>
										<td><a href='".e_PLUGIN."sport_league_e107/penalty.php?team=".$id."' title='".LAN_LEAGUE_TEAM_LINKS_17." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'><b>&nbsp;&nbsp;".LAN_LEAGUE_TEAM_LINKS_16."</b></a>
										</td>
									</tr>
									<tr>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/league_teaminfo.php?".$id."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/teaminfo_icon.gif' alt='' title='".LAN_LEAGUE_TEAM_LINKS_12." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'>
											</a>
										</td>
										<td><a href='".e_PLUGIN."sport_league_e107/league_teaminfo.php?".$id."'><b>&nbsp;&nbsp;".LAN_LEAGUE_TEAM_LINKS_11."</b></a>
										</td>
									</tr>
									<tr>
										<td style='width: 10%; text-align: center'>
											<a href='".$teamurl."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/mail.gif' alt='' title='".LAN_LEAGUE_TEAM_LINKS_10." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'>
											</a>
										</td>
										<td><a href='".$teamurl."'><b>&nbsp;&nbsp;".LAN_LEAGUE_TEAM_LINKS_9."</b></a>
										</td>
									</tr>
								</table>";
	return $linkstext;
								
	}
//////+++++++++++++++++++++++++++
function team_links_Q($id, $name, $saison, $teamurl)
{
	$linkstext="<table style='width:100%' cellspacing='0' cellpadding='0'>
									<tr>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/league_games.php?Liga=".$saison."&&team=".$id."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/calendar_icon.gif' alt='' title='".LAN_LEAGUE_TEAM_LINKS_6." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'>
											</a>
										</td>
										<td><a href='league_games.php?Liga=".$saison."&&team=".$id."'><b>&nbsp;&nbsp;".LAN_LEAGUE_TEAM_LINKS_5."</b></a>
										</td>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/roster.php?team=".$id."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/team_icon.gif' alt='' title='".LAN_LEAGUE_TEAM_LINKS_15." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'>
											</a>
										</td>
										<td><a href='roster.php?team=".$id."'><b>&nbsp;&nbsp;".LAN_LEAGUE_TEAM_LINKS_14."</b></a>
										</td>
									</tr>
									<tr>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/roster_points.php?team=".$id."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/curve_icon.gif' alt='' title='".LAN_LEAGUE_TEAM_LINKS_8." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'>
											</a>
										</td>
										<td><a href='".e_PLUGIN."sport_league_e107/roster_points.php?team=".$id."' title='".LAN_LEAGUE_TEAM_LINKS_8." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'><b>&nbsp;&nbsp;".LAN_LEAGUE_TEAM_LINKS_7."</b></a>
										</td>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/penalty.php?team=".$id."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/foults_icon.gif' alt='' title='".LAN_LEAGUE_TEAM_LINKS_17." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'>
											</a>
										</td>
										<td><a href='".e_PLUGIN."sport_league_e107/penalty.php?team=".$id."' title='".LAN_LEAGUE_TEAM_LINKS_17." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'><b>&nbsp;&nbsp;".LAN_LEAGUE_TEAM_LINKS_16."</b></a>
										</td>
									</tr>
									<tr>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/league_teaminfo.php?".$id."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/teaminfo_icon.gif' alt='' title='".LAN_LEAGUE_TEAM_LINKS_12." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'>
											</a>
										</td>
										<td><a href='".e_PLUGIN."sport_league_e107/league_teaminfo.php?".$id."'><b>&nbsp;&nbsp;".LAN_LEAGUE_TEAM_LINKS_11."</b></a>
										</td>
										<td style='width: 10%; text-align: center'>
											<a href='".$teamurl."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/mail.gif' alt='' title='".LAN_LEAGUE_TEAM_LINKS_10." ".$name." ".LAN_LEAGUE_TEAM_LINKS_13."'>
											</a>
										</td>
										<td><a href='".$teamurl."'><b>&nbsp;&nbsp;".LAN_LEAGUE_TEAM_LINKS_9."</b></a>
										</td>
									</tr>
								</table>";
	return $linkstext;							
	}
//////+++++++++++++++++++++++++++
function team_data($tid, $name, $sais, $logo, $LOGO_Y, $LOGO_X, $teamurl)
	{
	$ausg .="<table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>
					<tr>
						<td class='forumheader' colspan='2' style='width:100%;'><b>".$name."</b>
						</td>
					</tr>
					<tr>
						<td class='forumheader3' style='width:".$LOGO_X.";border-right:0px;border-top:0px;text-align:center;'><img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$logo."' height='".$LOGO_Y."' width='".$LOGO_X."'></td>
						<td class='forumheader3' style='border-left:0px;border-top:0px;text-align:left;'>";
	$ausg .=team_links_Q($tid, $name, $sais, $teamurl);
	$ausg .="</td></tr></table>";
	return	$ausg;
}
//////+++++++++++++++++++++++++++
function powered_by()
{
$linkinhalt="<div class='' style='width:100%;text-align:center;font-size:60%;'>:: Powered by <a target='_blank' href='http://www.e107.4xa.de' title='".LAN_LEAGUE_POWERED_LINK."'>e107 LIGA</a> - v".LAN_LEAGUE_VERSION." for <a target='_blank' href='http://www.e107.org' title='home of the e107 website System'>e107-CMS</a>::</div>";
return $linkinhalt;
}
//////+++++++++++++++++++++++++++
function saison_liga_name($ID)
{
global $sql;
 $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagues AS a 
   	LEFT JOIN ".MPREFIX."league_saison AS ae ON ae.saison_id=a.league_saison_id   
   	WHERE a.league_id =".$ID."  LIMIT 1
   			";
	$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();
	$ausgabe=$row['league_name']."(".$row['saison_name'].")";
return $ausgabe;
}
///////////////////////////////////
function get_archiv_data($player)
{
global $sql;
$table_total = $sql-> db_Select("league_player_points", "*","player_points_roster_id='".$player."'");
if($table_total)
	{	
	$row = $sql-> db_Fetch();
	return $row;
	}
else {return false;}
}
///////////////////////////////////
function player_games_count($ID)
{
global $sql;
$ausgabe=0;
$sql -> db_Select("league_anw", "*","anw_player_id='".$ID."'");
while($row = $sql-> db_Fetch())
	{
	$ausgabe++;
	}
return $ausgabe;
}
//////////////////////////////////////////////////
function player_goals_count($ID)
{
global $sql;
$ausgabe=0;
$sql -> db_Select("league_points", "*","points_player_id='".$ID."' AND points_value= 1");
while($row = $sql-> db_Fetch())
	{
	$ausgabe++;
	}
return $ausgabe;
}
//////////////////////////////////////////////////
function player_assist_count($ID)
{
global $sql;
$ausgabe=0;
$sql -> db_Select("league_points", "*","points_player_id='".$ID."' AND points_value= 2");
while($row = $sql-> db_Fetch())
	{
	$ausgabe++;
	}
return $ausgabe;
}
//////////////////////////////////////////////////
function player_strafe_count($ID)
{
global $sql,$value_list_arry;
$ausgabe=0;
$sql -> db_Select("league_points", "*","points_player_id='".$ID."' AND points_value> 2");
while($row = $sql-> db_Fetch())
	{
	$ausgabe=$ausgabe+$value_list_arry[$row['points_value']]['value'];
	}
return $ausgabe;
}
//////////////////////////////////////////////////
function player_strafe_count2($ID,$typ)
{
global $sql,$value_list_arry;
$ausgabe['summe']=0;
$ausgabe['anzahl'];
if(!$typ)
	{
	$sql -> db_Select("league_points", "*","points_player_id='".$ID."' AND points_value> 2");
	while($row = $sql-> db_Fetch())
		{
		$ausgabe=$ausgabe+$value_list_arry[$row['points_value']]['value'];
		}
	return $ausgabe;
	}
else{
	$sql -> db_Select("league_points", "*","points_player_id='".$ID."' AND points_value=".$typ."");
	while($row = $sql-> db_Fetch())
		{
		$ausgabe['summe']=$ausgabe['summe']+$value_list_arry[$row['points_value']]['value'];
		$ausgabe['anzahl']++;
		}
	return $ausgabe;

	}
}
////////////////////////////////////
function time_conver($time,$T,$periode)
{
global $pref;
$a=$pref["sport_league_periods"]*$pref["sport_league_times"];
$C=$pref["sport_league_periods"];
$P=$pref["sport_league_times"];
echo "gaz:".$a."-.".$pref["sport_league_periods"]."-".$pref["sport_league_times"];
//$time_art=
//1=Durchlafend 0-$a;
//2=pro Spielabschnitt 0-$P
//3=Rükwärts durchlafend $a-0
//4=Rükwärts pro Spielabschnitt $p-0

//$time_art=x; 1-4
//$periode=$C; 1-3

 switch($T){

// --------------------------------- Radio buttons --------------------------------
	case 1:
			$time_out=$time;
			return $time_out;
			break;

	case 2:
			$time_ms=explode(":",$time);
			$time_m=$time_ms[0];
			$time_s=$time_ms[1];
			$time_m=$time_m+($P*($periode-1));
			if($time_m < 10){$time_m2="0".$time_m;$time_m=$time_m2;}
			if($time_s < 10){$time_s2="0".$time_s;$time_s=$time_s2;}
			$time_out=$time_m.":".$time_s;
			return $time_out;
			break;
			
	case 3:
			$time_ms=explode(":",$time);
			$time_m=$a-$time_ms[0];
			if($time_ms[1]>0)
      	{$time_m--;}
			$time_s=60-$time_ms[1];
			if($time_m < 10){$time_m2="0".$time_m;$time_m=$time_m2;}
			if($time_s < 10){$time_s2="0".$time_s;$time_s=$time_s2;}
			$time_out=$time_m.":".$time_s;
			return $time_out;
			break;
			
	case 4:
			$time_ms=explode(":",$time);
			$time_m=$P-$time_ms[0];
			if($time_ms[0]>0)
      	{$time_m--;}
			$time_s=60-$time_ms[1];
			$time_m=$time_m+($P*($periode-1));
			if($time_m < 10){$time_m2="0".$time_m;$time_m=$time_m2;}
			if($time_s < 10){$time_s2="0".$time_s;$time_s=$time_s2;}
			$time_out=$time_m.":".$time_s;
			return $time_out;
			break;
			
	default:
			return $time;
			break;			
	}
}
//////////////////////////////////////////////////
function get_games_count($roster_id)
	{$sqldat =& new db;
	$zaehler=0;
	$sqldat -> db_Select("league_anw", "*","anw_player_id='".$roster_id."'");
	while($row = $sqldat-> db_Fetch())
	 		{
			$zaehler++;
			}
	return $zaehler;
	}
function get_goals_count($roster_id)
	{$sqldat =& new db;
	$zaehler=0;
	$sqldat -> db_Select("league_points", "*","points_player_id='".$roster_id."' AND points_value='1'");
	while($row = $sqldat-> db_Fetch())
	 		{
			$zaehler++;
			}
	return $zaehler;
	}
function get_assis_count($roster_id)
	{$sqldat =& new db;
	$zaehler=0;
	$sqldat -> db_Select("league_points", "*","points_player_id='".$roster_id."' AND points_value='2'");
	while($row = $sqldat-> db_Fetch())
	 		{
			$zaehler++;
			}
	return $zaehler;
	}
?>
