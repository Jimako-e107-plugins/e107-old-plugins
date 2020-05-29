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
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_player_stats_import.php $
|		$Revision: 0.87 $
|		$Date: 2011/09/26 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_player_stats_import_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_player_stats_import_lan.php");
require_once("../functionen.php");
$pageid = "admin_games";
require_once(e_ADMIN."auth.php");
require_once("../functionen.php");
$text="";
///////////////////////////////
if(isset($_POST['confirm']))
{

/*
$message=""; $games_coun=0;$flag=false;
echo $_POST['games_data'];
			  $IMPORTGAMES = explode("|",$_POST['games_data']);
				$GAMES_ANZ= count($IMPORTGAMES);
			if($GAMES_ANZ > 1)
				{
				$test_inhalt="";	
				for($i=0; $i < $GAMES_ANZ-1; $i++ )
					{
					$GAMES = explode(";",$IMPORTGAMES[$i]);
					$Liga	=		intval($GAMES[0]);/// Team Home
					$Home	=		intval($GAMES[1]);/// Team Home
					$Gast	= 	intval($GAMES[2]);/// Team Gast		
					$Datum	= $GAMES[3];/// Datum   			Default 01.01.2011
					$Time	= 	$GAMES[4];/// Uhrzeit   		Default 20:00
					$Goal_H	= intval($GAMES[5]);/// Goal Home   	Default 0
					$Goal_G	= intval($GAMES[6]);/// Goal Gast   	Default 0
					$UNENT	= intval($GAMES[7]);/// Goal Home   	Default 0
					$GAME_END	= intval($GAMES[8]);/// Goal Gast  	Default 0

				if($Home < 1 || $Gast < 1)
					{$message.="<br/> Fehler!! ";continue;}
				else{					
					if($Datum !=0 || $Datum!="" || $Datum !='0')
						{
						$DAT=explode(".",$Datum);
						$TIM=explode(":",$Time);
						
						$UNIXZEIT= mktime($TIM[0],$TIM[1],0,$DAT[1],$DAT[0],$DAT[2]);
						$inputstr = "'".$Liga."', '', '".$UNIXZEIT."', '".$UNIXZEIT."','".$Home."', '".$Gast."', '".$Goal_H."', '".$Goal_G."', '".$UNENT."', '".$GAME_END."', '', '', '', '', '', '', '', ''"; 
						}
					else{$inputstr = "'".$Liga."', '', '0', '0','".$Home."', '".$Gast."', '".$Goal_H."', '".$Goal_G."', '".$UNENT."', '".$GAME_END."', '', '', '', '', '', '', '', ''";  }
					$flag= ($sql -> db_Insert("league_games", "0, ".$inputstr." ")) ? true : false;
					if($flag){$games_count++;}
				 	}
				}
			}
		else{$message= LAN_LEAGUE_GAMES_ADMIN_39;}
*/
}
/////////////////////////////////////

if(IsSet($message)){
		$ns -> tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

elseif($_POST['check_data'])
{
$LIGA=$_POST['liga_ID'];
$double_players="";
$no_players="";
$player_table="<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
<tr>
<td class='fcaption'>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_1."</td>
<td class='fcaption'>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_2."</td>
<td class='fcaption'>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_3."</td>
<td class='fcaption'>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_4."</td>
<td class='fcaption'>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_5."</td>
<td class='fcaption'>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_6."</td>
<td class='fcaption'>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_7."</td>
<td class='fcaption'>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_8."</td>
</tr>
<tr>
<td class='fcaption'>System<-Impopt</td>
<td class='fcaption'>System<-Impopt</td>
<td class='fcaption'>(ID-System)<-(ID-Impopt)</td>
<td class='fcaption'>Arch.->Sys.<-Imp.</td>
<td class='fcaption'>Arch.->Sys.<-Imp.</td>
<td class='fcaption'>Arch.->Sys.<-Imp.</td>
<td class='fcaption'>Arch.->Sys.<-Imp.</td>
<td class='fcaption'>Arch.->Sys.<-Imp.</td>
</tr>

<tr>
";

$input_string=$_POST['testbox'];
$input_zeilen=explode(";|",$input_string);
$zeilen_count=count($input_zeilen);
$zeilen_count--;
for($i=0;$i< $zeilen_count;$i++)
	{
	$zeile=explode(";",$input_zeilen[$i]);
	$spieler[$i]['name']=$zeile[0];
	$spieler[$i]['jersey']=$zeile[1];
	$spieler[$i]['team']=$zeile[2];
	$spieler[$i]['games']=$zeile[3];
	$spieler[$i]['goals']=$zeile[4];
	$spieler[$i]['assist']=$zeile[5];
	$spieler[$i]['points']=$zeile[6];
	$spieler[$i]['strafe']=$zeile[7];
	}
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
for($i=0; $i< $zeilen_count; $i++)
	{$TMP=$spieler[$i]['name'];
	$qry1="
   SELECT a.*, b.*, c.*, d.*, e.* FROM ".MPREFIX."league_players AS a 
   LEFT JOIN ".MPREFIX."league_roster AS b ON b.roster_player_id=a.players_id
   LEFT JOIN ".MPREFIX."league_player_points AS c ON c.player_points_roster_id=b.roster_id
   LEFT JOIN ".MPREFIX."league_leagueteams AS d ON d.leagueteam_id=b.roster_team_id
   LEFT JOIN ".MPREFIX."league_teams AS e ON e.team_id=d.leagueteam_team_id
   WHERE a.players_name='$TMP' AND d.leagueteam_league_id=$LIGA
   		";
	$sql->db_Select_gen($qry1);
	$data_count=0;
	  while($row = $sql-> db_Fetch())
		{
		$tmp_data[$data_count]=$row;
		$data_count++;
		}
///--------------------------		
	if($data_count > 1)
		{
		$player_table.=get_double_players($tmp_data,$data_count);	
		}
	elseif($data_count == 0)
		{
		$player_table.=get_no_player($spieler[$i]);	
		}	
	elseif($data_count == 1)
		{
		$data_A=$spieler[$i];				/// zu importierende Daten
		$data_B= sort_data($tmp_data[0]); /// im System erfasste Daten
		$data_C= sort_data_archiv($tmp_data[0]); /// im Archiv erfasste Daten
		$player_table.= vergleich($data_A,$data_B,$data_C);
		}
	else{
		///fehlermeldung;
		}
///--------------------------	
	}
$player_table.="</table>";
$text="<b>Ergebniss der Überprüfung</b><br/><br/>";
$text.=$player_table;

/*
$text.="<form method='post' action='".e_SELF."' id='check_data'>";
$text.="<textarea name='testbox_confirm' cols='60' rows='20'>".$_POST['testbox']."</textarea>";
$text.="<buton name='confirm' id='confirm' value='Daten Speichern!'>";
$text.="</form>";
$text.="</form>";
*/

$text.="<form method='post' action='".e_SELF."' id='cancel'>
				<input class='button'type='submit' id='cancel' name='cancel' value='".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_12."'/><br/>
			</form>";

}
else{

$team_list="<option value='0'></option>";
 $qry1="
   SELECT a.*, d.* FROM ".MPREFIX."league_leagues AS a
   LEFT JOIN ".MPREFIX."league_saison AS d ON d.saison_id=a.league_saison_id
   WHERE a.league_id >0 ORDER BY d.saison_order DESC
   		";
	$sql->db_Select_gen($qry1);
	$data_count=0;
	  while($row = $sql-> db_Fetch())
		{
		$team_list.="<option value='".$row['league_id']."'>";
		$team_list.="(".$row['saison_name']."-".$row['league_name'].")</option>";
		}



$DOCUTEXT="<div style='font-size:130%;color:#f00;font-weight:bold;background:#f99;padding:5px;border:2px #f66 solid;text-align:center;'>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_13."</div><br/><br/>					
<font style='font-size:120%;color:#f66;font-weight:bold;'>1) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_1."</font> <i>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_1a."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>2) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_2."</font> <i>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_2a."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>3) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_3."</font> <i>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_3a."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>4) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_4."</font> <i>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_4a."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>5) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_5."</font> <i>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_5a."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>6) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_6."</font> <i>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_6a."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>7) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_7."</font> <i>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_7a."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>8) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_8."</font> <i>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_8a."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>9) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_15."</font> <i>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_14."</i><br/>
<br/><br/>
<b>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_16.":</b><br/><br/><i>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_17."</i><br/><br/><br/>";

$text="<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
$text.="<tr><td style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:50%;'>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_9." ".$DOCUTEXT."</td><td style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:50%;'>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_10."";
$text.="<form method='post' action='".e_SELF."' id='import_data'>";
$text.="<select class='tbox' name='liga_ID' id='liga_ID' size='1' width='15'>".$team_list."</select><br/>";
$text.="<textarea name='testbox' cols='60' rows='20'></textarea>";
$text.="</td></tr>
<tr><td style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:50%;text-align:right;'>
<input class='button' type='submit' id='check_data' name='check_data' value='".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_11."' />
								</form></td><td style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:50%;text-align:left;>
								<form method='post' action='admin_games_config.php?list.".$_POST['ligaid']."' id='zur'>
										<input class='button'type='submit' id='back' name='back' value='".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_12."'/><br/>
									</form></td></tr></table>";
}

$configtitle = LAN_LEAGUE_PAYERS_IMPORT_ADMIN_0;
$text .= "<div style=\"text-align:center\"><br/><br/><br/>";
$text.=powered_by();
$text.="</div>";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");





/////////////////////////////
function get_double_players($tmp_data,$data_count)
{
$AUSGABE="";
$AUSGABE.="<tr><td class='forumheader2' colspan='8' style='background:#fcc'>
						".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_23." <b>".$data_count."</b>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_24."<br/>";
for($i=0;$i< $data_count;$i++)
	{					
	$AUSGABE.=$tmp_data[$i]['players_name']." (".$tmp_data[$i]['roster_jersy'].") bei ".$tmp_data[$i]['team_name'].", ";
	}
$AUSGABE.="</td></tr>";
return $AUSGABE;
}
/////////////////////////////
function get_no_player($tmp_data)
{
$AUSGABE="";
$AUSGABE.="<tr><td class='forumheader2' colspan='8' style='background:#fcc'>
						".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_21." <b>".$tmp_data['name']."</b>	".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_22."<br/>Team: ";

$AUSGABE.=get_team_name($tmp_data['team']);
$AUSGABE.="</td></tr>";
return $AUSGABE;
}
/////////////////////////////
function get_team_name($team_id)
{
$AUSGABE="";
global $sql2;
 $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$team_id."  LIMIT 1
   			";
	$sql2->db_Select_gen($qry1);
  $row = $sql2-> db_Fetch();

if(!$row['team_name']||$row['team_name']=='')
return "Manschaft mit ID <b>".$team_id."</b> ist im System nicht vorhanden!!!";
else{
$AUSGABE="<img border='0' style='vertical-align: middle;height:15px;' title='".$row['team_name']."' src='../logos/".$row['team_icon']."'> (".$team_id.") ".$row['team_name']."";
return $AUSGABE;
	}
}

/////////////////////////////
function sort_data($data)
{
$Plaer_points=get_spieler_daten($data['roster_id']);

$output['name']=$data['players_name'];
$output['jersey']=$data['roster_jersy'];
$output['team']=$data['roster_team_id'];
$output['team_name']=$data['team_name'];
$output['team_icon']=$data['team_icon'];
$output['games']=$Plaer_points['games'];
$output['goals']=$Plaer_points['goals'];
$output['assist']=$Plaer_points['assist'];
$output['points']=$Plaer_points['points'];
$output['strafe']=$Plaer_points['strafe'];
$output['roster_id']=$data['roster_id'];
$output['roster_league_id']=$data['roster_league_id'];
$output['roster_team_id']=$data['roster_team_id'];
return $output;
}
/////////////////////////////	
function sort_data_archiv($data)
{
$Plaer_points=get_archiv_data($data['roster_id']);
$output['name']=$data['players_name'];
$output['jersey']=$data['roster_jersy'];
$output['team']=$data['roster_team_id'];
$output['team_name']=$data['team_name'];
$output['team_icon']=$data['team_icon'];
$output['games']=0;
$output['goals']=0;
$output['assist']=0;
$output['games']=$Plaer_points['player_points_1'];
$output['goals']=$Plaer_points['player_points_2'];
$output['assist']=$Plaer_points['player_points_3'];
$output['points']=$Plaer_points['player_points_2']+$Plaer_points['player_points_3'];
$output['strafe']=$Plaer_points['player_points_4']+$Plaer_points['player_points_5']+$Plaer_points['player_points_6']+$Plaer_points['player_points_7']+$Plaer_points['player_points_8']+$Plaer_points['player_points_9'];
$output['roster_id']=$data['roster_id'];
$output['roster_league_id']=$data['roster_league_id'];
$output['roster_team_id']=$data['roster_team_id'];
return $output;
}
/////////////////////////////
function vergleich($data_A, $data_B,$data_C)
{
$AUSGABE="<tr>";
$AUSGABE.="<td class='forumheader2' style='background:#";
if($data_A['name'] != $data_B['name'])
	{
	$AUSGABE.="f55'>".$data_B['name']."<-".$data_A['name']."</td><td class='forumheader2' style='background:#";
	}
else{
	$AUSGABE.="0f0'><b><a  target='_blank' href='admin_league_player_archiv.php?neu.".$data_B['roster_id'].".".$data_B['roster_league_id'].".".$data_B['roster_team_id'].".".$data_A['games'].".".$data_A['goals'].".".$data_A['assist']."' title='".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_19."'>".$data_A['name']."</a><b/></td><td class='forumheader2' style='background:#";
	}
if($data_A['jersey'] != $data_B['jersey'])
	{
	$AUSGABE.="f55'><a  target='_blank' href='admin_roster_config.php?edit.".$data_B['roster_id'].".".$data_B['roster_team_id']."' title='".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_20."'>".$data_B['jersey']."<-".$data_A['jersey']."</a></td><td class='forumheader2' style='background:#";
	}
else{
	$AUSGABE.="0f0'><b>".$data_B['jersey']."<b/></td><td class='forumheader2'style='background:#";
	}
if($data_A['team'] != $data_B['team'])
	{
	$AUSGABE.="f55'>";
	$AUSGABE.=get_team_name($data_B['team']);
	$AUSGABE.=" ";
	$AUSGABE.=get_team_name($data_A['team']);
	$AUSGABE.="<b/></td>";
	}
else{
	$AUSGABE.="0f0'><b>";
	$AUSGABE.=get_team_name($data_B['team']);
	$AUSGABE.="<b/></td>";
	}
////-------------------------
$AUSGABE.="<td class='forumheader2' style='background:#";

if($data_A['games'] == $data_B['games'])
	{
	$AUSGABE.="0f0;";
	}
elseif($data_A['games'] == $data_C['games'])
	{
	$AUSGABE.="bfb";
	}	
elseif($data_A['games'] > $data_B['games'])
	{
	$AUSGABE.="0ff";
	}
elseif($data_A['games'] < $data_B['games'])
	{
	$AUSGABE.="ff0";
	}
else{$AUSGABE.="fcc";}
$AUSGABE.="'>".$data_C['games']."->".$data_B['games']."<-".$data_A['games']."</td><td class='forumheader2' style='background:#";
////-------------------------
if($data_A['goals'] == $data_B['goals'])
	{
	$AUSGABE.="0f0";
	}
elseif($data_A['goals'] == $data_C['goals'])
	{
	$AUSGABE.="bfb";
	}		
elseif($data_A['goals'] > $data_B['goals'])
	{
	$AUSGABE.="0ff";
	}
elseif($data_A['goals'] < $data_B['goals'])
	{
	$AUSGABE.="ff0";
	}
else{$AUSGABE.="fcc";}
$AUSGABE.="'>".$data_C['goals']."->".$data_B['goals']."<-".$data_A['goals']."</td><td class='forumheader2' style='background:#";
////-------------------------
if($data_A['assist'] == $data_B['assist'])
	{
	$AUSGABE.="0f0";
	}
elseif($data_A['assist'] == $data_C['assist'])
	{
	$AUSGABE.="bfb";
	}		
elseif($data_A['assist'] > $data_B['assist'])
	{
	$AUSGABE.="0ff";
	}
elseif($data_A['assist'] < $data_B['assist'])
	{
	$AUSGABE.="ff0";
	}
else{$AUSGABE.="fcc";}
$AUSGABE.="'>".$data_C['assist']."->".$data_B['assist']."<-".$data_A['assist']."</td><td class='forumheader2' style='background:#";
////-------------------------
if($data_A['points'] == $data_B['points'])
	{
	$AUSGABE.="0f0";
	}
elseif($data_A['points'] == $data_C['points'])
	{
	$AUSGABE.="bfb";
	}
elseif($data_A['points'] > $data_B['points'])
	{
	$AUSGABE.="0ff";
	}
elseif($data_A['points'] < $data_B['points'])
	{
	$AUSGABE.="ff0";
	}
else{$AUSGABE.="fcc";}
$AUSGABE.="'>".$data_C['points']."->".$data_B['points']."<-".$data_A['points']."</td><td class='forumheader2' style='background:#";
////-------------------------
if($data_A['strafe'] == $data_B['strafe'])
	{
	$AUSGABE.="0f0";
	}
elseif($data_A['strafe'] == $data_C['strafe'])
	{
	$AUSGABE.="bfb";
	}
elseif($data_A['strafe'] > $data_B['strafe'])
	{
	$AUSGABE.="0ff";
	}
elseif($data_A['strafe'] < $data_B['strafe'])
	{
	$AUSGABE.="ff0";
	}
else{$AUSGABE.="fcc";}
$AUSGABE.="'>".$data_C['strafe']."->".$data_B['strafe']."<-".$data_A['strafe']."</td>";
$AUSGABE.="</tr>";
return $AUSGABE;
}
//////////////////////////////////////////////////
function vergleich_get($data_A, $data_B)
{
if($data_A['team'] != $data_B['team'])
	{return false;}
else{$data['team']=$data_B['team'];}
////-------------------------
if($data_A['name'] > $data_B['name'])
	{
	$data['name']=$data_A['name'];
	}
else{$data['name']=$data_B['name'];}
////-------------------------
if($data_A['jersey'] > $data_B['jersey'])
	{
	$data['jersey']=$data_A['jersey'];
	}
else{$data['jersey']=$data_B['jersey'];}
////-------------------------
if($data_A['games'] > $data_B['games'])
	{
	$data['games']=$data_A['games'];
	}	
else{$data['games']=$data_B['games'];}
////-------------------------
if($data_A['goals'] > $data_B['goals'])
	{
	$data['goals']=$data_A['goals'];
	}	
else{$data['goals']=$data_B['goals'];}
////-------------------------
if($data_A['assist'] > $data_B['assist'])
	{
	$data['assist']=$data_A['assist'];
	}	
else{$data['assist']=$data_B['assist'];}
////-------------------------
if($data_A['points'] > $data_B['points'])
	{
	$data['points']=$data_A['points'];
	}	
else{$data['points']=$data_B['points'];}
////-------------------------
if($data_A['strafe'] == $data_B['strafe'])
	{
	$data['strafe']=$data_A['strafe'];
	}	
else{$data['strafe']=$data_B['strafe'];}
return $AUSGABE;
}

//////////////////////////////////////////////////
function get_spieler_daten($roster_id)
{
$output['games']=get_games_count($roster_id);
$output['goals']=get_goals_count($roster_id);
$output['assist']=get_assis_count($roster_id);
$output['points']=$output['goals']+$output['assist'];
///$output['strafe']=$Plaer_points['strafe'];
return $output;
}
?>



