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
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);
require_once("functionen.php");

if($_GET['team_a'])
{$team_1=team_datas($_GET['team_a']);}
else{
$team_1=team_datas2($_POST['team_a']);
}
if($_GET['team_b'])
{$team_2=team_datas($_GET['team_b']);}
else{
$team_2=team_datas2($_POST['team_b']);
}
// ============= START OF THE BODY ====================================
///////////////////////////////////Anzahl der gespilter Spiele//////////////////////////////////////
///////////////////////////////////////Anzahl alle Spiele //////////////////////////////////////////
/////////////////////////////////////////1 Team Daten///////////////////////////////////////////////

$team_1_home=team_data_stats_home($team_1['team_id']);
$team_1_home_stats=home_games_stat($team_1_home);
$team_1_gast=team_data_stats_gast($team_1['team_id']);
$team_1_gast_stats=gast_games_stat($team_1_gast);
$team_1['games_home']=count($team_1_home);
$team_1['games_gast']=count($team_1_gast);
$team_1['games_summa']=$team_1['games_home']+$team_1['games_gast'];
if($team_1_gast_stats['HS_GT']-$team_1_gast_stats['HS_HT'] > $team_1_home_stats['HS_HT']-$team_1_home_stats['HS_GT'])
	{
	$team_1['HS_HT']=$team_1_gast_stats['HS_HT'];$team_1['HS_GT']=$team_1_gast_stats['HS_GT'];
	$team_1['HS_ID']=$team_1_gast_stats['HS_GID'];
	}
else{
$team_1['HS_HT']=$team_1_home_stats['HS_HT'];$team_1['HS_GT']=$team_1_home_stats['HS_GT'];$team_1['HS_ID']=$team_1_home_stats['HS_GID'];		
}
//////****************************
if($team_1_gast_stats['HL_HT']-$team_1_gast_stats['HL_GT'] > $team_1_home_stats['HL_GT']-$team_1_home_stats['HL_HT'])
	{
	$team_1['HL_HT']=$team_1_gast_stats['HL_HT'];$team_1['HL_GT']=$team_1_gast_stats['HL_GT'];
	$team_1['HL_ID']=$team_1_gast_stats['HL_GID'];
	}
else{
$team_1['HL_HT']=$team_1_home_stats['HL_HT'];$team_1['HL_GT']=$team_1_home_stats['HL_GT'];$team_1['HL_ID']=$team_1_home_stats['HL_GID'];		
}
//////////////////////////////2 Team Daten/////////////////////////
$team_2_home=team_data_stats_home($team_2['team_id']);
$team_2_home_stats=home_games_stat($team_2_home);
$team_2_gast=team_data_stats_gast($team_2['team_id']);
$team_2_gast_stats=gast_games_stat($team_2_gast);
$team_2['games_home']=count($team_2_home);
$team_2['games_gast']=count($team_2_gast);
$team_2['games_summa']=$team_2['games_home']+$team_2['games_gast'];

if($team_2_home_stats['HS_HT']-$team_2_home_stats['HS_GT']	> $team_2_gast_stats['HS_GT']-$team_2_gast_stats['HS_HT'])
	{
	
	$team_2['HS_HT']=$team_2_home_stats['HS_HT'];$team_2['HS_GT']=$team_2_home_stats['HS_GT'];
	$team_2['HS_ID']=$team_2_home_stats['HS_GID'];
	}
else{
$team_2['HS_HT']=$team_2_gast_stats['HS_GT'];$team_2['HS_GT']=$team_2_gast_stats['HS_HT'];$team_2['HS_ID']=$team_2_gast_stats['HS_GID'];		
}
//////****************************
if($team_2_gast_stats['HL_HT']-$team_2_gast_stats['HL_GT'] > $team_2_home_stats['HL_GT']-$team_2_home_stats['HL_HT'])
	{
	$team_2['HL_HT']=$team_2_gast_stats['HL_HT'];$team_2['HL_GT']=$team_2_gast_stats['HL_GT'];
	$team_2['HL_ID']=$team_2_gast_stats['HL_GID'];
	}
else{
$team_2['HL_HT']=$team_2_home_stats['HL_HT'];$team_2['HL_GT']=$team_2_home_stats['HL_GT'];$team_2['HL_ID']=$team_2_home_stats['HL_GID'];		
}
////////////////////////////////////////////////////////
$beide_home=get_home_begegnungen($team_1_home, $team_2['team_id']);
$beide_gast=get_gast_begegnungen($team_1_gast, $team_2['team_id']);

///////////////////////////Teams-Liste///////////////////
$teamlist_count=0;
$sql-> db_Select("league_teams", "*","team_name!='' ORDER BY team_name");
while($row = $sql-> db_Fetch())
	{
	$team_list[$teamlist_count]=$row;
	$teamlist_count++;
	}
$team_liste1=" <select name='team_a' size='1' style='width:98%;text-align:right;vertical-align:top;' onChange='this.form.submit()'>";
/// Liste 1
for($i=0; $i < $teamlist_count; $i++)
		{
		$team_liste1.="<option ";
		if($team_list[$i]['team_id']==$team_1['team_id'])
			{
			$team_liste1.="selected ";
			}
		$team_liste1.="value='".$team_list[$i]['team_id']."'>";
		$team_liste1.="".$team_list[$i]['team_name']."</option>";
		}
$team_liste1.="</select>";
/// Liste 2
$team_liste2=" <select name='team_b' size='1' style='width:98%;text-align:right;vertical-align:top;' onChange='this.form.submit()'>";
for($i=0; $i < $teamlist_count; $i++)
		{
		$team_liste2.="<option ";
		if($team_list[$i]['team_id']==$team_2['team_id'])
			{
			$team_liste2.="selected ";
			}
		$team_liste2.="value='".$team_list[$i]['team_id']."'>";
		$team_liste2.="".$team_list[$i]['team_name']."</option>";
		}
$team_liste2.="</select>";
///////////////////////////////////////////////////////////
$expand_autohide = "display:none";

$text .= "<div style='text-align:center'>
			<table style='width:100%' cellspacing='0' cellpadding='0' background='transparent'>
				<tr>
					<td style='text-align:right; width:40%; height:100px'><img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$team_1['team_icon']."' style='height:200px'></td>
					<td><form action='".e_SELF."' method='post' id='neu'></td>
					<td style='text-align:left; width:40%; height:100px'><img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$team_2['team_icon']."' style='height:200px'></td>
				</tr>
				<tr>
					<td class='fcaption' style='text-align:right;width:40%;vertical-align:top;'>";
						$text .=$team_liste1;	
						$text .="</td>
					<td class='fcaption' style='text-align:center;width:20%'><b>Team</b></td>
					<td class='fcaption' style='text-align:left;width:40%;vertical-align:top;'>";
						$text .=$team_liste2;	
						$text .="
					</td>
				</tr></form>
			</table><br/><br/>";

$text .= "<table style='width:100%' cellspacing='0' cellpadding='0' background='transparent'>
	<tr>
		<td class='fcaption' style='text-align:center;'>Werte, die in unserem System erfasst sind.</td>
	</tr>
	<tr>
		<td>
			<div style='cursor:pointer' onclick=\"expandit('exp_Spiele')\">	
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader' style='text-align:right; width:40%'><b>".($team_1['games_summa'])."</b></td>
						<td class='forumheader' style='text-align:center; width:20%'><b>gespielte Spiele</b></td>
						<td class='forumheader' style='text-align:left; width:40%'><b>".($team_2['games_summa'])."</td>
					</tr>
				</table>
			</div>	
			<div id='exp_Spiele' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".($team_1['games_home'])."</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Heim</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".($team_2['games_home'])."</td>
					</tr>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".($team_1['games_gast'])."</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Gast</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".($team_2['games_gast'])."</td>
					</tr>
				</table>
			</div>
		</td>
	<tr>
		<td>
			<div style='cursor:pointer' onclick=\"expandit('exp_Siege')\">	
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader' style='text-align:right; width:40%'><b>".($team_1_home_stats['winns']+$team_1_gast_stats['winns'])."</b> von ".($team_1['games_summa'])." sind ".$A=sprintf("%10.2f", (($team_1_home_stats['winns']+$team_1_gast_stats['winns'])/(($team_1['games_summa'])/100)))."%</td>
						<td class='forumheader' style='text-align:center; width:20%'><b>Siege</b></td>
						<td class='forumheader' style='text-align:left; width:40%'><b>".($team_2_home_stats['winns']+$team_2_gast_stats['winns'])."</b> von ".($team_2['games_summa'])." sind ".$A=sprintf("%10.2f", (($team_2_home_stats['winns']+$team_2_gast_stats['winns'])/(($team_2['games_summa'])/100)))."%</td>
					</tr>
				</table>
			</div>	
			<div id='exp_Siege' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_home_stats['winns']."</b> von ".($team_1['games_home'])." sind ".$A=sprintf("%10.2f", ($team_1_home_stats['winns']/(($team_1['games_home'])/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Heim</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_home_stats['winns']."</b> von ".($team_2['games_home'])." sind ".$B=sprintf("%10.2f", ($team_2_home_stats['winns']/(($team_2['games_home'])/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_gast_stats['winns']."</b> von ".($team_1['games_gast'])." sind ".$A=sprintf("%10.2f", ($team_1_gast_stats['winns']/(($team_1['games_gast'])/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Gast</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_gast_stats['winns']."</b> von ".($team_2['games_gast'])." sind ".$B=sprintf("%10.2f", ($team_2_gast_stats['winns']/(($team_2['games_gast'])/100)))."%</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div style='cursor:pointer' onclick=\"expandit('exp_Siege_np')\">	
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader' style='text-align:right; width:40%'><b>".($team_1_home_stats['winns_np']+$team_1_gast_stats['winns_np'])."</b> von ".($team_1['games_summa'])." sind ".$A=sprintf("%10.2f", (($team_1_home_stats['winns_np']+$team_1_gast_stats['winns_np'])/(($team_1['games_summa'])/100)))."%</td>
						<td class='forumheader' style='text-align:center; width:20%'><b>Siege n.P.</b></td>
						<td class='forumheader' style='text-align:left; width:40%'><b>".($team_2_home_stats['winns_np']+$team_2_gast_stats['winns_np'])."</b> von ".($team_2['games_summa'])." sind ".$A=sprintf("%10.2f", (($team_2_home_stats['winns_np']+$team_2_gast_stats['winns_np'])/(($team_2['games_summa'])/100)))."%</td>
					</tr>
				</table>
			</div>	
			<div id='exp_Siege_np' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_home_stats['winns_np']."</b> von ".($team_1['games_home'])." sind ".$A=sprintf("%10.2f", ($team_1_home_stats['winns_np']/(($team_1['games_home'])/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Heim</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_home_stats['winns_np']."</b> von ".($team_2['games_home'])." sind ".$B=sprintf("%10.2f", ($team_2_home_stats['winns_np']/(($team_2['games_home'])/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_gast_stats['winns_np']."</b> von ".($team_1['games_gast'])." sind ".$A=sprintf("%10.2f", ($team_1_gast_stats['winns_np']/(($team_1['games_gast'])/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Gast</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_gast_stats['winns_np']."</b> von ".($team_2['games_gast'])." sind ".$B=sprintf("%10.2f", ($team_2_gast_stats['winns_np']/(($team_2['games_gast'])/100)))."%</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div style='cursor:pointer' onclick=\"expandit('exp_Niederlagen')\">	
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader' style='text-align:right; width:40%'><b>".($team_1_home_stats['lost']+$team_1_gast_stats['lost'])."</b> von ".($team_1['games_summa'])." sind ".$A=sprintf("%10.2f", (($team_1_home_stats['lost']+$team_1_gast_stats['lost'])/(($team_1['games_summa'])/100)))."%</td>
						<td class='forumheader' style='text-align:center; width:20%'><b>Niederlagen</b></td>
						<td class='forumheader' style='text-align:left; width:40%'><b>".($team_2_home_stats['lost']+$team_2_gast_stats['lost'])."</b> von ".($team_2['games_summa'])." sind ".$B=sprintf("%10.2f", (($team_2_home_stats['lost']+$team_2_gast_stats['lost'])/(($team_2['games_summa'])/100)))."%</td>
					</tr>
				</table>
			</div>	
			<div id='exp_Niederlagen' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_home_stats['lost']."</b> von ".($team_1['games_home'])." sind ".$A=sprintf("%10.2f", ($team_1_home_stats['lost']/(($team_1['games_home'])/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Heim</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_home_stats['lost']."</b> von ".($team_2['games_home'])." sind ".$B=sprintf("%10.2f", ($team_2_home_stats['lost']/(($team_2['games_home'])/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_gast_stats['lost']."</b> von ".($team_1['games_gast'])." sind ".$A=sprintf("%10.2f", ($team_1_gast_stats['lost']/(($team_2['games_gast'])/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Gast</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_gast_stats['lost']."</b> von ".($team_2['games_gast'])." sind ".$A=sprintf("%10.2f", ($team_2_gast_stats['lost']/(($team_2['games_gast'])/100)))."%</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div style='cursor:pointer' onclick=\"expandit('exp_Niederlagen_np')\">	
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader' style='text-align:right; width:40%'><b>".($team_1_home_stats['lost_np']+$team_1_gast_stats['lost_np'])."</b> von ".($team_1['games_summa'])." sind ".$A=sprintf("%10.2f", (($team_1_home_stats['lost_np']+$team_1_gast_stats['lost_np'])/(($team_1['games_summa'])/100)))."%</td>
						<td class='forumheader' style='text-align:center; width:20%'><b>Niederlagen n.P.</b></td>
						<td class='forumheader' style='text-align:left; width:40%'><b>".($team_2_home_stats['lost_np']+$team_2_gast_stats['lost_np'])."</b> von ".($team_2['games_summa'])." sind ".$A=sprintf("%10.2f", (($team_2_home_stats['lost_np']+$team_2_gast_stats['lost_np'])/(($team_2['games_summa'])/100)))."%</td>
					</tr>
				</table>
			</div>	
			<div id='exp_Niederlagen_np' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_home_stats['lost_np']."</b> von ".($team_1['games_home'])." sind ".$A=sprintf("%10.2f", ($team_1_home_stats['lost_np']/(($team_1['games_home'])/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Heim</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_home_stats['lost_np']."</b> von ".($team_2['games_home'])." sind ".$B=sprintf("%10.2f", ($team_2_home_stats['lost_np']/(($team_2['games_home'])/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_gast_stats['lost_np']."</b> von ".($team_1['games_gast'])." sind ".$A=sprintf("%10.2f", ($team_1_gast_stats['lost_np']/(($team_1['games_gast'])/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Gast</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_gast_stats['lost_np']."</b> von ".($team_2['games_gast'])." sind ".$B=sprintf("%10.2f", ($team_2_gast_stats['lost_np']/(($team_2['games_gast'])/100)))."%</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div style='cursor:pointer' onclick=\"expandit('exp_HSieg')\">	
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader' style='text-align:right; width:40%'><b>".$team_1['HS_HT']."</b>:<b>".$team_1['HS_GT']."</b> gegen ".($A=team_name_link($team_1['HS_ID']))."</td>
						<td class='forumheader' style='text-align:center; width:20%'>höchster Sieg</td>
						<td class='forumheader' style='text-align:left; width:40%'><b>".$team_2['HS_HT']."</b>:<b>".$team_2['HS_GT']."</b> gegen ".($A=team_name_link($team_2['HS_ID']))."</td>
					</tr>
				</table>
			</div>	
			<div id='exp_HSieg' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_home_stats['HS_HT']."</b>:<b>".$team_1_home_stats['HS_GT']."</b> gegen ".($A=team_name_link($team_1_home_stats['HS_GID']))."</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Heim</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_home_stats['HS_HT']."</b>:<b>".$team_2_home_stats['HS_GT']."</b> gegen ".($A=team_name_link($team_2_home_stats['HS_GID']))."</td>
					</tr>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_gast_stats['HS_HT']."</b>:<b>".$team_1_gast_stats['HS_GT']."</b> gegen ".($A=team_name_link($team_1_gast_stats['HS_GID']))."</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Gast</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_gast_stats['HS_HT']."</b>:<b>".$team_2_gast_stats['HS_GT']."</b> gegen ".($A=team_name_link($team_2_gast_stats['HS_GID']))."</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div style='cursor:pointer' onclick=\"expandit('exp_HNiederlage')\">	
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader' style='text-align:right; width:40%'><b>".$team_1['HL_HT']."</b>:<b>".$team_1['HL_GT']."</b> gegen ".($A=team_name_link($team_1['HL_ID']))."</td>
						<td class='forumheader' style='text-align:center; width:20%'>höchste Niederlage</td>
						<td class='forumheader' style='text-align:left; width:40%'><b>".$team_2['HL_HT']."</b>:<b>".$team_2['HL_GT']."</b> gegen ".($A=team_name_link($team_2['HL_ID']))."</td>
					</tr>
				</table>
			</div>	
			<div id='exp_HNiederlage' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_home_stats['HL_HT']."</b>:<b>".$team_1_home_stats['HL_GT']."</b> gegen ".($A=team_name_link($team_1_home_stats['HL_GID']))."</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Heim</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_home_stats['HL_HT']."</b>:<b>".$team_2_home_stats['HL_GT']."</b> gegen ".($A=team_name_link($team_2_home_stats['HL_GID']))."</td>
					</tr>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_gast_stats['HL_HT']."</b>:<b>".$team_1_gast_stats['HL_GT']."</b> gegen ".($A=team_name_link($team_1_gast_stats['HL_GID']))."</td>
						<td class='forumheader2' style='text-align:center; width:20%'>Gast</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_gast_stats['HL_HT']."</b>:<b>".$team_2_gast_stats['HL_GT']."</b> gegen ".($A=team_name_link($team_2_gast_stats['HL_GID']))."</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
	
		<tr>
		<td>
			<div style='cursor:pointer' onclick=\"expandit('exp_eigene_tore')\">	
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader' style='text-align:right; width:40%'><b>".($team_1_home_stats['ET']+$team_1_gast_stats['ET'])."</b> : <b>".($team_1_home_stats['GT']+$team_1_gast_stats['GT'])."</b></td>
						<td class='forumheader' style='text-align:center; width:20%'>Torverhältnis</td>
						<td class='forumheader' style='text-align:left; width:40%' ><b>".($team_2_home_stats['ET']+$team_2_gast_stats['ET'])."</b> : <b>".($team_2_home_stats['GT']+$team_2_gast_stats['GT'])."</b></td>
					</tr>
				</table>
			</div>	
			<div id='exp_eigene_tore' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_home_stats['ET']."</b>:<b>".$team_1_home_stats['GT']."</b></td>
						<td class='forumheader2' style='text-align:center; width:20%'>Heim</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_home_stats['ET']."</b>:<b>".$team_2_home_stats['GT']."</b></td>
					</tr>
					<tr>
						<td class='forumheader2' style='text-align:right; width:40%'><b>".$team_1_gast_stats['ET']."</b>:<b>".$team_1_gast_stats['GT']."</b></td>
						<td class='forumheader2' style='text-align:center; width:20%'>Gast</td>
						<td class='forumheader2' style='text-align:left; width:40%'><b>".$team_2_gast_stats['ET']."</b>:<b>".$team_2_gast_stats['GT']."</b></td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
";

$teamAH_T=0;
$teamBH_T=0;
for($i=0; $i < (count($beide_home)); $i++)
{
$game[$i]=$beide_home[$i];
$game[$i]['home_team']=team_name_link($beide_home[$i]['game_home_id']);
$game[$i]['gast_team']=team_name_link($beide_home[$i]['game_gast_id']);
$teamAH_T=$teamAH_T+$beide_home[$i]['game_goals_home'];
$teamBH_T=$teamBH_T+$beide_home[$i]['game_goals_gast'];

}
$beide_home_stat=home_games_stat($beide_home);

$j=$i;
$teamAG_T=0;
$teamBG_T=0;
for($i=0; $i < (count($beide_gast)); $i++)
{
$game[$j]=$beide_gast[$i];
$game[$j]['home_team']=team_name_link($beide_gast[$i]['game_home_id']);
$game[$j]['gast_team']=team_name_link($beide_gast[$i]['game_gast_id']);
$j++;
$teamAG_T=$teamAG_T+$beide_gast[$i]['game_goals_home'];
$teamBG_T=$teamBG_T+$beide_gast[$i]['game_goals_gast'];
}
$beide_gast_stat=gast_games_stat($beide_gast);
$games_sortiert=sortieren($game,"game_date");

$text .= "<br/><br/><table class='fborder' cellpadding='0' cellspacing='0' width='100%'>";

if((count($games_sortiert)) > 0)
 {
$text .= "<tr><td class='fcaption' style='text-align:center;'>Direkter Vergleich der beiden Mannschaften</td></tr>";
$text .= "<tr><td class='forumheader' style='text-align:left;'><br/>";
$text .= "gegeneinander angetreten: <b>".(count($games_sortiert))."</b>-Mal, <br/>";
$text .= "davon: <b>".(count($beide_home))."</b>-Mal bei den ".$game[0]['home_team']." zu Hause  <br/>";
$text .= "und: <b>".(count($beide_gast))."</b>-Mal bei den ".$game[0]['gast_team']." zu Hause.<br/><br/>";
$text .= "</td></tr>";
$text .= "<tr><td class='forumheader' style='text-align:left;'><br/>";
$text .= "".$game[0]['home_team']." zu Hause: <b>".($beide_home_stat['winns']+$beide_home_stat['winns_np'])."</b> Siege ".(($beide_home_stat['winns_np']!=0)?"davon <b>".$beide_home_stat['winns_np']."</b> n.P. ":"")." und <b>".($beide_home_stat['lost']+$beide_home_stat['lost_np'])."</b> Niederlagen ".(($beide_home_stat['lost_np']!=0)?"davon <b>".$beide_home_stat['lost_np']."</b> n.P. ":"")."<br/>";
$text .= "".$game[0]['home_team']." auswärts: <b>".($beide_gast_stat['winns']+$beide_gast_stat['winns_np'])."</b> Siege ".(($beide_gast_stat['winns_np']!=0)?"davon <b>".$beide_gast_stat['winns_np']."</b> n.P. ":"")." und <b>".($beide_gast_stat['lost']+$beide_gast_stat['lost_np'])."</b> Niederlagen ".(($beide_gast_stat['lost_np']!=0)?"davon <b>".$beide_gast_stat['lost_np']."</b> n.P. ":"")."<br/><br/>";
$text .= "</td></tr>";
$text .= "<tr><td class='forumheader' style='text-align:left;'><br/>";
$text .= "".$game[0]['gast_team']." zu Hause: <b>".($beide_gast_stat['lost']+$beide_gast_stat['lost_np'])."</b> Siege ".(($beide_gast_stat['lost_np']!=0)?"davon <b>".$beide_gast_stat['lost_np']."</b> n.P. ":"")." und <b>".($beide_gast_stat['winns']+$beide_gast_stat['winns_np'])."</b> Niederlagen ".(($beide_gast_stat['winns_np']!=0)?"davon <b>".$beide_gast_stat['winns_np']."</b> n.P. ":"")."<br/>";
$text .= "".$game[0]['gast_team']." auswärts: <b>".($beide_home_stat['lost']+$beide_home_stat['lost_np'])."</b> Siege ".(($beide_home_stat['lost_np']!=0)?"davon <b>".$beide_home_stat['lost_np']."</b> n.P. ":"")." und <b>".($beide_home_stat['winns']+$beide_home_stat['winns_np'])."</b> Niederlagen ".(($beide_home_stat['winns_np']!=0)?"davon <b>".$beide_home_stat['winns_np']."</b> n.P. ":"")."<br/><br/>";
$text .= "</td></tr>";
$text .= "<tr><td class='forumheader' style='text-align:left;'><br/>";
$text .= "<br/> Torebilanz der ".$game[0]['home_team']."  zu Hause:<b>".$teamAH_T."</b>  auswärts:<b>".$teamBG_T."</b>  Summe:<b>".($teamAH_T+$teamBG_T)."</b> ";
$text .= "<br/> Torebilanz der ".$game[0]['gast_team']."  zu Hause:<b>".$teamAG_T."</b>  auswärts:<b>".$teamBH_T."</b>  Summe:<b>".($teamAG_T+$teamBH_T)."</b><br/><br/>";
$text .= "</td></tr>";


$team_home['winns']=0;
$team_home['winns_ids']="";
$team_home['winns_np']=0;
$team_home['winns_np_ids']="";
$team_home['lost']=0;
$team_home['lost_ids']="";
$team_home['lost_np']=0;
$team_home['lost_np_ids']="";

$team_homeHS['HG']=0;
$team_homeHS['GG']=0;
$team_homeHS['GI']=0;
$team_homeHS['GAI']=0;
$team_homeHL['HG']=0;
$team_homeHL['GG']=0;
$team_homeHL['GI']=0;
$team_homeHL['GAI']=0;






$stylesdf[0]="forumheader3";
$stylesdf[1]="forumheader2";

for($i=0; $i < (count($games_sortiert)); $i++)
{$SW=$i%2;
$text .= "<tr>
						<td class='".$stylesdf[$SW]."' style='text-align:left;'>
						am ".strftime("%d.%m.%y",$games_sortiert[$i]['game_date'])." um ".strftime("%H:%M",$games_sortiert[$i]['game_date'])."    <b>".$games_sortiert[$i]['home_team']."</b> vs. <b>".$games_sortiert[$i]['gast_team']."     <a target='_blank' href='game_report.php?game_id=".$games_sortiert[$i]['game_id']."'>(".$games_sortiert[$i]['game_goals_home']." : ".$games_sortiert[$i]['game_goals_gast'].") ".(($games_sortiert[$i]['game_un'])?"n.P.":"")."</a></b> 
						</td>
					<tr>";
}
}
else {$text .= "<br/><br/><br/>Im unseren Datenbank sind bis jeztz noch keine Spiele der Beider Mannschaften vorhanden!!!<br/><br/>";}
$text .= "</table>";

/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================
$text .="</div>";

$qry1="
SELECT a.*, ae.* FROM ".MPREFIX."league_leagues AS a 
LEFT JOIN ".MPREFIX."league_saison AS ae ON ae.saison_id=a.league_saison_id   
WHERE a.league_id='".$LIGAID."'
";
$sql->db_Select_gen($qry1);
$row = $sql-> db_Fetch();                                                                                              

	$SaisonName=$row['saison_name'];
	$LigaName=$row['league_name'];
	
$title = "Mannschaftenvergleich ";
$ns -> tablerender($title, $text);
require_once(FOOTERF);
//////////////////////////////////////////////////////////
function team_datas($id)
{
global $sql;
 $qry1="
   	SELECT a.*, b.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS b ON b.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$id."  LIMIT 1
   			";
	$sql->db_Select_gen($qry1);
  $row = $sql-> db_Fetch();
return 	$row;
}
/////////////////////////////////////////////////////////
function team_datas2($id)
{
global $sql;
$sql-> db_Select("league_teams", "*","team_id='".$id."' ORDER BY team_name LIMIT 1");
$row = $sql-> db_Fetch();
return 	$row;
}
//////////////////////////////////////////////////////////
function team_data_stats_home($team_ID)
{
global $sql;
/// Heimspiele abfragen
 $qry1="
   	SELECT a.*, b.*, c.*, d.*, e.* FROM ".MPREFIX."league_games AS a
   	LEFT JOIN ".MPREFIX."league_leagueteams AS b ON b.leagueteam_id=a.game_home_id
   	LEFT JOIN ".MPREFIX."league_teams AS c ON c.team_id=b.leagueteam_team_id
   	LEFT JOIN ".MPREFIX."league_leagues AS d ON d.league_id=b.leagueteam_league_id
   	LEFT JOIN ".MPREFIX."league_saison AS e ON e.saison_id=d.league_saison_id
   	WHERE c.team_id =".$team_ID." AND a.game_enable='1' ORDER BY e.saison_order, a.game_date
   			";
$sql->db_Select_gen($qry1);
$count=0;$countH=0;
  while($row = $sql-> db_Fetch()){
	$team_home_games_data[$countH]=$row;
	$count++;$countH++;
  }
for($i=0; $i< $countH ; $i++)
	{
	$gast_team=get_gegner_team_data($team_home_games_data[$i]['game_gast_id']);
	$team_home_games_data[$i]['gegner_ID']=$gast_team['id'];
	$team_home_games_data[$i]['gegner_name']=$gast_team['name'];
	}
return $team_home_games_data;
}
//////////////////////////////////////////////////////////
function team_data_stats_gast($team_ID)
{
global $sql;
//// Gastspiele abfragen
 $qry1="
   	SELECT a.*, b.*, c.*, d.*, e.* FROM ".MPREFIX."league_games AS a
   	LEFT JOIN ".MPREFIX."league_leagueteams AS b ON b.leagueteam_id=a.game_gast_id
   	LEFT JOIN ".MPREFIX."league_teams AS c ON c.team_id=b.leagueteam_team_id
   	LEFT JOIN ".MPREFIX."league_leagues AS d ON d.league_id=b.leagueteam_league_id
   	LEFT JOIN ".MPREFIX."league_saison AS e ON e.saison_id=d.league_saison_id
   	WHERE c.team_id =".$team_ID." AND a.game_enable='1' ORDER BY e.saison_order, a.game_date
   			";
	$sql->db_Select_gen($qry1);
$countG=0;
  while($row = $sql-> db_Fetch()){
	$team_gast_games_data[$countG]=$row;
	$count++;$countG++;
  }
for($i=0; $i< $countG ; $i++)
	{
	$gast_team=get_gegner_team_data($team_gast_games_data[$i]['game_home_id']);
	$team_gast_games_data[$i]['gegner_ID']=$gast_team['id'];
	$team_gast_games_data[$i]['gegner_name']=$gast_team['name'];
	}
return $team_gast_games_data;
}
////////////////////////////////////////////////////////
function get_gegner_team_data($id)
{
$Team=team_datas($id);
$Ausgabe['id']=$Team['team_id'];
$Ausgabe['name']=$Team['team_name'];
return $Ausgabe;
}
////////////////////////////////////////////////////////
function get_home_begegnungen($datas,$id2)
{
$new_zahler=0;
for($i=0; $i< (count($datas)); $i++)
	{
	if($datas[$i]['gegner_ID']==$id2)
		{
		 $Ausgabe[$new_zahler]=$datas[$i];
		 $new_zahler++;
		}
	}
return $Ausgabe;
}
////////////////////////////////////////////////////////7
function get_gast_begegnungen($datas,$id2)
{
$new_zahler=0;
for($i=0; $i< (count($datas)); $i++)
	{
	if($datas[$i]['gegner_ID']==$id2)
		{
		 $Ausgabe[$new_zahler]=$datas[$i];
		 $new_zahler++;
		}
	}
return $Ausgabe;
}
/////////////////////////////////////////////////////////
function home_games_stat($games)
{
///  Heimspiele
$team_home['winns']=0;
$team_home['winns_ids']="";
$team_home['winns_np']=0;
$team_home['winns_np_ids']="";
$team_home['lost']=0;
$team_home['lost_ids']="";
$team_home['lost_np']=0;
$team_home['lost_np_ids']="";

$team_homeHS['HG']=0;
$team_homeHS['GG']=0;
$team_homeHS['GI']=0;
$team_homeHS['GAI']=0;
$team_homeHL['HG']=0;
$team_homeHL['GG']=0;
$team_homeHL['GI']=0;
$team_homeHL['GAI']=0;
$team_home['ET']=0;
$team_home['GT']=0;
$countH=count($games);

for($i=0;$i < $countH; $i++)
	{
	$team_home['ET']=$team_home['ET']+$games[$i]['game_goals_home'];
	$team_home['GT']=$team_home['GT']+$games[$i]['game_goals_gast'];
	///echo "nr ".($i+1)." von [".($countG+$countH)." ] - am ".strftime("%a %d %b %Y",$games[$i]['game_date'])." um ".strftime("%H:%M",$games[$i]['game_date'])."  ".$games[$i]['team_name']."  ergebniss( ".$games[$i]['game_goals_home'].":".$games[$i]['game_goals_gast']." (".$games[$i]['game_un'].") )  <a href='admin/admin_games_config.php?edit.".$games[$i]['game_league_id'].".".$games[$i]['game_id']."'> edit </a><br/>";	
	if($games[$i]['game_goals_home'] > $games[$i]['game_goals_gast'] && $games[$i]['game_goals_home'] != $games[$i]['game_goals_gast'] && $games[$i]['game_un']!='1')
		{$team_home['winns']++;
		 $team_home['winns_ids'].=",".$games[$i]['game_id']."";
		 if(($games[$i]['game_goals_home'] - $games[$i]['game_goals_gast']) > ($team_homeHS['HG']-$team_homeHS['GG']))
		 	{
		 	$team_home['Hwinn']="".$games[$i]['game_goals_home'].":".$games[$i]['game_goals_gast']."";
		 	$team_homeHS['HG']=$games[$i]['game_goals_home'];$team_homeHS['GG']=$games[$i]['game_goals_gast'];
		 	$team_homeHS['GI']=$games[$i]['game_gast_id'];
		 	$team_homeHS['GAI']=$games[$i]['game_id'];
		 	}
		 }
	elseif($games[$i]['game_goals_home'] > $games[$i]['game_goals_gast'] && $games[$i]['game_un']=='1')
		{$team_home['winns_np']++;
		 $team_home['winns_np_ids'].="".$games[$i]['game_id'].",";
		}
	elseif($games[$i]['game_goals_home'] < $games[$i]['game_goals_gast'] && $games[$i]['game_un']=='1')
		{$team_home['lost_np']++;
		 $team_home['lost_np_ids'].="".$games[$i]['game_id'].",";	
		}
	else{$team_home['lost']++;
			 $team_home['lost_ids'].=",".$games[$i]['game_id']."";
		if(($games[$i]['game_goals_gast'] - $games[$i]['game_goals_home']) > ($team_homeHL['GG']-$team_homeHL['HG']))
		 	{
		 	$team_home['Hlost']="".$games[$i]['game_goals_home'].":".$games[$i]['game_goals_gast']."";
		 	$team_home['Hwinn']="".$games[$i]['game_goals_home'].":".$games[$i]['game_goals_gast']."";
		 	$team_homeHL['HG']=$games[$i]['game_goals_home'];$team_homeHL['GG']=$games[$i]['game_goals_gast'];
		 	$team_homeHL['GI']=$games[$i]['game_gast_id'];
		 	$team_homeHL['GAI']=$games[$i]['game_id'];
		 	}
		}
	}
///////////// am höstens gewonene heim Spiel
$team_home['HS_HT']=$team_homeHS['HG'];
$team_home['HS_GT']=$team_homeHS['GG'];
$team_home['HS_GID']=$team_homeHS['GI'];
$team_home['HS_SID']=$team_homeHS['GAI'];
///////////// am höstens verlorenes heim Spiel
$team_home['HL_HT']=$team_homeHL['HG'];
$team_home['HL_GT']=$team_homeHL['GG'];
$team_home['HL_GID']=$team_homeHL['GI'];
$team_home['HL_SID']=$team_homeHL['GAI'];


/*
echo "<br/><br/>
			Heim Siege:".$team_home['winns']."<br/>";
			
$HSIDS= explode(",", $team_home['winns_ids']);
for($i=0; $i< count($HSIDS); $i++)
	{
		echo "<a href='game_report.php?game_id=".$HSIDS[$i]."'>".$HSIDS[$i]."</a>, ";
	}
echo "Heim Niederlagen:".$team_home['lost']."<br/>";

$HSIDS= explode(",", $team_home['lost_ids']);
for($i=0; $i< count($HSIDS); $i++)
	{
		echo "<a href='game_report.php?game_id=".$HSIDS[$i]."'>".$HSIDS[$i]."</a>, ";
	}
echo "<br/>
			Heim Siege nP:".$team_home['winns_np']."<br/>
			Heim Niederlagen  nP:".$team_home['lost_np']."<br/>
			Höhste Heim Sieg:".$team_home['Hwinn']." partie <a href='game_report.php?game_id=".$team_homeHS['GAI']."'>".$team_homeHS['GAI']."</a><br/>
			Höhste Heim Niederlage:".$team_home['Hlost']." partie <a href='game_report.php?game_id=".$team_homeHL['GAI']."'>".$team_homeHL['GAI']."</a><br/>
			<br/><br/>";
			
*/
return $team_home;
}
///////////////////////////////////////////////////////////			
function gast_games_stat($games)
{			
/// Gastspiele
$team_gast['winns']=0;
$team_gast['winns_ids']="";
$team_gast['winns_np']=0;
$team_gast['winns_np_ids']="";
$team_gast['lost']=0;
$team_gast['lost_ids']="";
$team_gast['lost_np']=0;
$team_gast['lost_np_ids']="";

$team_gastHS['HG']=0;
$team_gastHS['GG']=0;
$team_gastHS['GI']=0;
$team_gastHS['GAI']=0;
$team_gastHL['HG']=0;
$team_gastHL['GG']=0;
$team_gastHL['GI']=0;
$team_gastHL['GAI']=0;

$team_gast['ET']=0;
$team_gast['GT']=0;

$countG=count($games);

for($i=0  ;$i < $countG; $i++)
	{
	$team_gast['ET']=$team_gast['ET']+$games[$i]['game_goals_gast'];
	$team_gast['GT']=$team_gast['GT']+$games[$i]['game_goals_home'];
		
///	echo "nr ".($i+$countH+1)." von [".($countG+$countH)." ] - am ".strftime("%a %d %b %Y",$games[$i]['game_date'])." um ".strftime("%H:%M",$games[$i]['game_date'])."  ".$games[$i]['team_name']."  ergebniss( ".$games[$i]['game_goals_home'].":".$games[$i]['game_goals_gast']." )  <a href='admin/admin_games_config.php?edit.".$games[$i]['game_league_id'].".".$games[$i]['game_id']."'> edit </a><br/>";	
	if($games[$i]['game_goals_home'] < $games[$i]['game_goals_gast'] && $games[$i]['game_goals_home'] != $games[$i]['game_goals_gast'] && $games[$i]['game_un']!='1')
		{$team_gast['winns']++;
		 $team_gast['winns_ids'].="".$games[$i]['game_id'].",";
		 	if(($games[$i]['game_goals_gast'] - $games[$i]['game_goals_home']) > ($team_gastHS['GG']-$team_gastHS['HG']))
		 	{
		 	$team_gast['Hwinn']="".$games[$i]['game_goals_home'].":".$games[$i]['game_goals_gast']."";
		 	$team_gastHS['HG']=$games[$i]['game_goals_home']; $team_gastHS['GG']=$games[$i]['game_goals_gast'];
		 	$team_gastHS['GI']=$games[$i]['game_home_id'];
		 	$team_gastHS['GAI']=$games[$i]['game_id'];
		 	}
		 }
	elseif($games[$i]['game_goals_home'] < $games[$i]['game_goals_gast'] && $games[$i]['game_un']=='1')
		{$team_gast['winns_np']++;
		 $team_gast['winns_np_ids'].="".$games[$i]['game_id'].",";
			}
	elseif($games[$i]['game_goals_home'] > $games[$i]['game_goals_gast'] && $games[$i]['game_un']=='1')
		{$team_gast['lost_np']++;
		 $team_gast['lost_np_ids'].="".$games[$i]['game_id'].",";
			}
	else{$team_gast['lost']++;
			 $team_gast['lost_ids'].="".$games[$i]['game_id'].",";
		 if(($games[$i]['game_goals_home'] - $games[$i]['game_goals_gast']) > ($team_gastHL['HG']-$team_gastHL['GG']))
		 	{
		 	$team_gast['Hlost']="".$games[$i]['game_goals_home'].":".$games[$i]['game_goals_gast']."";
		 	$team_gastHL['HG']=$games[$i]['game_goals_home']; $team_gastHL['GG']=$games[$i]['game_goals_gast'];
		 	$team_gastHL['GI']=$games[$i]['game_home_id'];
		 	$team_gastHL['GAI']=$games[$i]['game_id'];
		 	}
		}
	}
	
///////////// am höstens gewonene gast Spiel
$team_gast['HS_HT']=$team_gastHS['HG'];
$team_gast['HS_GT']=$team_gastHS['GG'];
$team_gast['HS_GID']=$team_gastHS['GI'];
$team_gast['HS_SID']=$team_gastHS['GAI'];
///////////// am höstens verlorenes gast Spiel
$team_gast['HL_HT']=$team_gastHL['HG'];
$team_gast['HL_GT']=$team_gastHL['GG'];
$team_gast['HL_GID']=$team_gastHL['GI'];
$team_gast['HL_SID']=$team_gastHL['GAI'];	
	
return $team_gast;
}
/////////////////////////////////////////////
function team_name_link($id)
{
$team=team_datas($id);
return "<a href='roster.php?team=".$team['leagueteam_id']."'>".$team['team_name']."</a>";	
}
//////////////////////////////////////////////
function sortieren($game,$nach)
{
$anzahl=count($game);	
for($i=0; $i < ($anzahl-1) ; $i++)
	{
	for($j=$i; $j < $anzahl ; $j++)
		{
		if($game[$j][$nach] < $game[$i][$nach])
			{
			$temp =	$game[$j];$game[$j]=$game[$i];$game[$i]=$temp;
			}
		}
	}
return $game;		
	
}
?>
