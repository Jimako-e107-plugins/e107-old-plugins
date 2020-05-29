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
|		$Source: ../e107_plugins/sport_league_e107/league_stats.php $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);
require_once("functionen.php");

if($_GET['Saison']){$Saison=$_GET['Saison'];}
else{
$Saison=$pref['league_my_saison'];
}
if($_GET['Liga']){$LIGAID=$_GET['Liga'];}

if($_GET['team']){$TEAM1=$_GET['team'];}
else{
$TEAM1=$_POST['team'];
}

// ============= START OF THE BODY ====================================
$Ligencount=0;
$sql -> 
db_Select("league_leagues","*","league_saison_id='".$Saison."'");
while($row = 
$sql-> db_Fetch())
  {
  $Ligencount++;	
  }

///////////////////////////////////Anzahl der gespilter Spiele///////////////////////////////////////
$gamesenable=0;
$sql -> db_Select("league_games","*","game_saison_id='".$LIGAID."' AND game_enable=1");
while($row = $sql-> db_Fetch())
  {
  $gamesenable++;	
  }
///////////////////////////////////Anzahl alle Spiele //////////////////////////////////////////////
$gamesinsg=0;
$sql -> db_Select("league_games","*","game_saison_id='".$LIGAID."'");
while($row = $sql-> db_Fetch())
  {
  $gamesinsg++;	
  }
//////////////////////////////1 Team Daten/////////////////////////
$team_1=team_data_stats($TEAM1);


$LIGAID=$team_1['leagueteam_league_id'];

$sql->db_Select("league_leagues","*","league_id='".$LIGAID."'");
while($row =$sql-> db_Fetch())
  {
  $Saison=$row['league_saison_id'];
  }
//////////////////////////////2 Team Daten/////////////////////////
///////////////////////////Teams-Liste///////////////////
$qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   WHERE a.leagueteam_league_id='".$team_1['leagueteam_league_id']."'
   		";
	$sql->db_Select_gen($qry1);
$listcount=0;
  while($row = $sql-> db_Fetch()){
		$team_list['leagueteam_id'][$listcount]=$row['leagueteam_id'];
    if($pref['sport_league_teamname_menu']==2){$team_list['team_name'][$listcount]=$row['team_kurzname'];}
    else{$team_list['team_name'][$listcount]=$row['team_name'];}
		$listcount++;
		}
$team__liste1=" <select name='team' size='1' style='width:98%;text-align:right;vertical-align:top;' onChange='this.form.submit()'>";
for($i=0; $i < $listcount; $i++)
		{
		$team__liste1.="<option ";
		if($team_list['leagueteam_id'][$i]==$team_1['leagueteam_id'])
			{
			$team__liste1.="selected ";
			}
		$team__liste1.="value='".$team_list['leagueteam_id'][$i]."'>";
		$team__liste1.="".$team_list['team_name'][$i]."</option>";
		}
$team__liste1.="</select>";

//////////////////////////1 Team Spiele Daten/////////////
///                           Home Spiele
$Team1_Home_count=0;
$Team1_Home_Data['eigene_tore']=0;
$Team1_Home_Data['PPs']=0;
$Team1_Home_Data['UPs']=0;
$Team1_Home_Data['PP_eigene_tore']=0;
$Team1_Home_Data['PP_gegen_tore']=0;
$Team1_Home_Data['gegen_tore']=0;
$Team1_Home_Data['UP_eigene_tore']=0;
$Team1_Home_Data['UP_gegen_tore']=0;
$Team1_Home_Data['siege']=0;
$Team1_Home_Data['lost']=0;
$Team1_Home_Data['spiele']=0;
$Team1_Home_Data['Alle_spiele']=0;
$Team1_Home_Data['hoestes_sieg']['A']=0;
$Team1_Home_Data['hoestes_sieg']['B']=0;
$Team1_Home_Data['hoeste_niederlage']['A']=0;
$Team1_Home_Data['hoeste_niederlage']['B']=0;
$Team1_Home_Data['hoestes_sieg']['gegner_id']=0;
$Team1_Home_Data['hoestes_sieg']['gegner']="";
$Team1_Home_Data['hoeste_niederlage']['gegner_id']=0;
$Team1_Home_Data['hoeste_niederlage']['gegner']="";

$Team1_Home_Data['1dr_my']=0;
$Team1_Home_Data['1dr_gg']=0;
$Team1_Home_Data['2dr_my']=0;
$Team1_Home_Data['2dr_gg']=0;
$Team1_Home_Data['3dr_my']=0;
$Team1_Home_Data['3dr_gg']=0;

$sql -> db_Select("league_games","*","game_home_id=".$team_1['leagueteam_id']."");
				while($row = $sql-> db_Fetch())
				{
				$Team1_Home_Data['Alle_spiele']++;
				}
$sql -> db_Select("league_games","*","game_enable=1 AND game_home_id=".$team_1['leagueteam_id']."");
				while($row = $sql-> db_Fetch())
				{
				$Team1_Home['game_id'][$Team1_Home_count]=$row['game_id'];
				$Team1_Home['gegner_id'][$Team1_Home_count]=$row['game_gast_id'];
				$Team1_Home['eigene_tore'][$Team1_Home_count]=$row['game_goals_home'];
				$Team1_Home['gegen_tore'][$Team1_Home_count]=$row['game_goals_gast'];
				
				$Team1_Home_PP=pp_data_get($row['game_id'],$team_1['leagueteam_id'],$row['game_gast_id']);
				
				$Team1_Home_Data['PPs']=$Team1_Home_Data['PPs']+$Team1_Home_PP['pps'];
				$Team1_Home_Data['UPs']=$Team1_Home_Data['UPs']+$Team1_Home_PP['ups'];				
				$Team1_Home_Data['PP_eigene_tore']=$Team1_Home_Data['PP_eigene_tore']+$Team1_Home_PP['pp_eigene_tore'];
				$Team1_Home_Data['PP_gegen_tore']=$Team1_Home_Data['PP_gegen_tore']+$Team1_Home_PP['pp_gegen_tore'];
				$Team1_Home_Data['UP_eigene_tore']=$Team1_Home_Data['UP_eigene_tore']+$Team1_Home_PP['up_eigene_tore'];
				$Team1_Home_Data['UP_gegen_tore']=$Team1_Home_Data['UP_gegen_tore']+$Team1_Home_PP['up_gegen_tore'];
				
				$Team1_Home_DTV=dtv_data_get($row['game_id'],$team_1['leagueteam_id'],$row['game_gast_id']);
				
				$Team1_Home_Data['1dr_my']=$Team1_Home_Data['1dr_my']+$Team1_Home_DTV[1]['MY'];
				$Team1_Home_Data['1dr_gg']=$Team1_Home_Data['1dr_gg']+$Team1_Home_DTV[1]['GG'];
				$Team1_Home_Data['2dr_my']=$Team1_Home_Data['2dr_my']+$Team1_Home_DTV[2]['MY'];
				$Team1_Home_Data['2dr_gg']=$Team1_Home_Data['2dr_gg']+$Team1_Home_DTV[2]['GG'];				
				$Team1_Home_Data['3dr_my']=$Team1_Home_Data['3dr_my']+$Team1_Home_DTV[3]['MY'];
				$Team1_Home_Data['3dr_gg']=$Team1_Home_Data['3dr_gg']+$Team1_Home_DTV[3]['GG'];				
								
				if($Team1_Home['gegner_id'][$Team1_Home_count]==$team_2['leagueteam_id'])
					{$a++;		}
				$Team1_Home_Data['eigene_tore']=$Team1_Home_Data['eigene_tore']+$Team1_Home['eigene_tore'][$Team1_Home_count];
				$Team1_Home_Data['gegen_tore']=$Team1_Home_Data['gegen_tore']+$Team1_Home['gegen_tore'][$Team1_Home_count];
				if($Team1_Home['eigene_tore'][$Team1_Home_count]> $Team1_Home['gegen_tore'][$Team1_Home_count])
					{$Team1_Home_Data['siege']++;
						if(($Team1_Home['eigene_tore'][$Team1_Home_count]-$Team1_Home['gegen_tore'][$Team1_Home_count])>($Team1_Home_Data['hoestes_sieg']['A']-$Team1_Home_Data['hoestes_sieg']['B']))
								{
								$Team1_Home_Data['hoestes_sieg']['A']=$Team1_Home['eigene_tore'][$Team1_Home_count];
								$Team1_Home_Data['hoestes_sieg']['B']=$Team1_Home['gegen_tore'][$Team1_Home_count];
								$Team1_Home_Data['hoestes_sieg']['gegner_id']=$row['game_gast_id'];
								}	
					}
				else{
						$Team1_Home_Data['lost']++;
						if(($Team1_Home['gegen_tore'][$Team1_Home_count]-$Team1_Home['eigene_tore'][$Team1_Home_count])>($Team1_Home_Data['hoeste_niederlage']['B']-$Team1_Home_Data['hoeste_niederlage']['B']))
							{
							$Team1_Home_Data['hoeste_niederlage']['A']=$Team1_Home['eigene_tore'][$Team1_Home_count];
							$Team1_Home_Data['hoeste_niederlage']['B']=$Team1_Home['gegen_tore'][$Team1_Home_count];
							$Team1_Home_Data['hoeste_niederlage']['gegner_id']=$row['game_gast_id'];
							}
						}
				$Team1_Home_Data['spiele']++;
				$Team1_Home_count++;	
				}
$qry1="
SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
WHERE a.leagueteam_id='".$Team1_Home_Data['hoeste_niederlage']['gegner_id']."'
";
$sql->db_Select_gen($qry1);
$row = $sql-> db_Fetch();
$Team1_Home_Data['hoeste_niederlage']['gegner']=$row['team_name'];

$qry1="
SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
WHERE a.leagueteam_id='".$Team1_Home_Data['hoestes_sieg']['gegner_id']."'
";
$sql->db_Select_gen($qry1);
$row = $sql-> db_Fetch();
$Team1_Home_Data['hoestes_sieg']['gegner']=$row['team_name'];
  							
///                           Gast Spiele
$Team1_Gast_count=0;
$Team1_Gast_Data['eigene_tore']=0;
$Team1_Gast_Data['PPs']=0;
$Team1_Gast_Data['UPs']=0;
$Team1_Gast_Data['PP_eigene_tore']=0;
$Team1_Gast_Data['PP_gegen_tore']=0;
$Team1_Gast_Data['gegen_tore']=0;
$Team1_Gast_Data['UP_eigene_tore']=0;
$Team1_Gast_Data['UP_gegen_tore']=0;
$Team1_Gast_Data['siege']=0;
$Team1_Gast_Data['lost']=0;
$Team1_Gast_Data['spiele']=0;
$Team1_Gast_Data['Alle_spiele']=0;
$Team1_Gast_Data['hoestes_sieg']['A']=0;
$Team1_Gast_Data['hoestes_sieg']['B']=0;
$Team1_Gast_Data['hoeste_niederlage']['A']=0;
$Team1_Gast_Data['hoeste_niederlage']['B']=0;
$Team1_Gast_Data['hoestes_sieg']['gegner_id']=0;
$Team1_Gast_Data['hoestes_sieg']['gegner']="";
$Team1_Gast_Data['hoeste_niederlage']['gegner_id']=0;
$Team1_Gast_Data['hoeste_niederlage']['gegner']="";

$Team1_Gast_Data['1dr_my']=0;
$Team1_Gast_Data['1dr_gg']=0;
$Team1_Gast_Data['2dr_my']=0;
$Team1_Gast_Data['2dr_gg']=0;
$Team1_Gast_Data['3dr_my']=0;
$Team1_Gast_Data['3dr_gg']=0;



$sql -> db_Select("league_games","*","game_gast_id=".$team_1['leagueteam_id']."");
				while($row = $sql-> db_Fetch())
				{
				$Team1_Gast_Data['Alle_spiele']++;
				}
$sql -> db_Select("league_games","*","game_enable=1 AND game_gast_id=".$team_1['leagueteam_id']."");
				while($row = $sql-> db_Fetch())
				{
				$Team1_Gast['game_id'][$Team1_Gast_count]=$row['game_id'];
				$Team1_Gast['gegner_id'][$Team1_Gast_count]=$row['game_gast_id'];
				$Team1_Gast['eigene_tore'][$Team1_Gast_count]=$row['game_goals_gast'];
				$Team1_Gast['gegen_tore'][$Team1_Gast_count]=$row['game_goals_home'];
						
				$Team1_Gast_PP=pp_data_get($row['game_id'],$team_1['leagueteam_id'],$row['game_home_id']);
				
				$Team1_Gast_Data['PPs']=$Team1_Gast_Data['PPs']+$Team1_Gast_PP['pps'];
				$Team1_Gast_Data['UPs']=$Team1_Gast_Data['UPs']+$Team1_Gast_PP['ups'];				
				$Team1_Gast_Data['PP_eigene_tore']=$Team1_Gast_Data['PP_eigene_tore']+$Team1_Gast_PP['pp_eigene_tore'];
				$Team1_Gast_Data['PP_gegen_tore']=$Team1_Gast_Data['PP_gegen_tore']+$Team1_Gast_PP['pp_gegen_tore'];
				$Team1_Gast_Data['UP_eigene_tore']=$Team1_Gast_Data['UP_eigene_tore']+$Team1_Gast_PP['up_eigene_tore'];
				$Team1_Gast_Data['UP_gegen_tore']=$Team1_Gast_Data['UP_gegen_tore']+$Team1_Gast_PP['up_gegen_tore'];
				
				$Team1_Gast_DTV=dtv_data_get($row['game_id'],$team_1['leagueteam_id'],$row['game_home_id']);
				
				$Team1_Gast_Data['1dr_my']=$Team1_Gast_Data['1dr_my']+$Team1_Gast_DTV[1]['MY'];
				$Team1_Gast_Data['1dr_gg']=$Team1_Gast_Data['1dr_gg']+$Team1_Gast_DTV[1]['GG'];
				$Team1_Gast_Data['2dr_my']=$Team1_Gast_Data['2dr_my']+$Team1_Gast_DTV[2]['MY'];
				$Team1_Gast_Data['2dr_gg']=$Team1_Gast_Data['2dr_gg']+$Team1_Gast_DTV[2]['GG'];				
				$Team1_Gast_Data['3dr_my']=$Team1_Gast_Data['3dr_my']+$Team1_Gast_DTV[3]['MY'];
				$Team1_Gast_Data['3dr_gg']=$Team1_Gast_Data['3dr_gg']+$Team1_Gast_DTV[3]['GG'];
				
				$Team1_Gast_Data['eigene_tore']=$Team1_Gast_Data['eigene_tore']+$Team1_Gast['eigene_tore'][$Team1_Gast_count];
				$Team1_Gast_Data['gegen_tore']=$Team1_Gast_Data['gegen_tore']+$Team1_Gast['gegen_tore'][$Team1_Gast_count];
				if($Team1_Gast['eigene_tore'][$Team1_Gast_count]> $Team1_Gast['gegen_tore'][$Team1_Gast_count])
						{
						$Team1_Gast_Data['siege']++;
						if(($Team1_Gast['eigene_tore'][$Team1_Gast_count]-$Team1_Gast['gegen_tore'][$Team1_Gast_count])>($Team1_Gast_Data['hoestes_sieg']['A']-$Team1_Gast_Data['hoestes_sieg']['B']))
								{
								$Team1_Gast_Data['hoestes_sieg']['A']=$Team1_Gast['eigene_tore'][$Team1_Gast_count];
								$Team1_Gast_Data['hoestes_sieg']['B']=$Team1_Gast['gegen_tore'][$Team1_Gast_count];
								$Team1_Gast_Data['hoestes_sieg']['gegner_id']=$row['game_home_id'];
								}	
						}
				else{
						$Team1_Gast_Data['lost']++;
						if(($Team1_Gast['gegen_tore'][$Team1_Gast_count]-$Team1_Gast['eigene_tore'][$Team1_Gast_count])>($Team1_Gast_Data['hoeste_niederlage']['B']-$Team1_Gast_Data['hoeste_niederlage']['B']))
							{
							$Team1_Gast_Data['hoeste_niederlage']['A']=$Team1_Gast['eigene_tore'][$Team1_Gast_count];
							$Team1_Gast_Data['hoeste_niederlage']['B']=$Team1_Gast['gegen_tore'][$Team1_Gast_count];
							$Team1_Gast_Data['hoeste_niederlage']['gegner_id']=$row['game_home_id'];
							}
						}
				$Team1_Gast_Data['spiele']++;
				$Team1_Gast_count++;	
				}
$qry1="
SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
WHERE a.leagueteam_id='".$Team1_Gast_Data['hoeste_niederlage']['gegner_id']."'
";
$sql->db_Select_gen($qry1);
$row = $sql-> db_Fetch();
$Team1_Gast_Data['hoeste_niederlage']['gegner']=$row['team_name'];

$qry1="
SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
WHERE a.leagueteam_id='".$Team1_Gast_Data['hoestes_sieg']['gegner_id']."'
";
$sql->db_Select_gen($qry1);
$row = $sql-> db_Fetch();
$Team1_Gast_Data['hoestes_sieg']['gegner']=$row['team_name'];
  

///                           Summe Spiele
$Team1_Summe_Data['eigene_tore']=$Team1_Home_Data['eigene_tore']+$Team1_Gast_Data['eigene_tore'];
$Team1_Summe_Data['gegen_tore']=$Team1_Home_Data['gegen_tore']+$Team1_Gast_Data['gegen_tore'];
$Team1_Summe_Data['siege']=$Team1_Home_Data['siege']+$Team1_Gast_Data['siege'];
$Team1_Summe_Data['lost']=$Team1_Home_Data['lost']+$Team1_Gast_Data['lost'];
$Team1_Summe_Data['spiele']=$Team1_Home_Data['spiele']+$Team1_Gast_Data['spiele'];




$Team1_Summe_Data['Alle_spiele']=$Team1_Home_Data['Alle_spiele']+$Team1_Gast_Data['Alle_spiele'];
if($Team1_Gast_Data['hoeste_niederlage']['B']-$Team1_Gast_Data['hoeste_niederlage']['A']> $Team1_Home_Data['hoeste_niederlage']['B']-$Team1_Home_Data['hoeste_niederlage']['A'])
		{
		$Team1_Summe_Data['hoeste_niederlage']['A']=$Team1_Gast_Data['hoeste_niederlage']['A'];
		$Team1_Summe_Data['hoeste_niederlage']['B']=$Team1_Gast_Data['hoeste_niederlage']['B'];
		$Team1_Summe_Data['hoeste_niederlage']['gegner_id']=$Team1_Gast_Data['hoeste_niederlage']['gegner_id'];
		$Team1_Summe_Data['hoeste_niederlage']['gegner']=$Team1_Gast_Data['hoeste_niederlage']['gegner'];				
		}
else
		{
		$Team1_Summe_Data['hoeste_niederlage']['A']=$Team1_Home_Data['hoeste_niederlage']['A'];
		$Team1_Summe_Data['hoeste_niederlage']['B']=$Team1_Home_Data['hoeste_niederlage']['B'];		
		$Team1_Summe_Data['hoeste_niederlage']['gegner_id']=$Team1_Home_Data['hoeste_niederlage']['gegner_id'];
		$Team1_Summe_Data['hoeste_niederlage']['gegner']=$Team1_Home_Data['hoeste_niederlage']['gegner'];			
		}
if($Team1_Gast_Data['hoestes_sieg']['B']-$Team1_Gast_Data['hoestes_sieg']['A']< $Team1_Home_Data['hoestes_sieg']['B']-$Team1_Home_Data['hoestes_sieg']['A'])
		{
		$Team1_Summe_Data['hoestes_sieg']['A']=$Team1_Gast_Data['hoestes_sieg']['A'];
		$Team1_Summe_Data['hoestes_sieg']['B']=$Team1_Gast_Data['hoestes_sieg']['B'];
		$Team1_Summe_Data['hoestes_sieg']['gegner_id']=$Team1_Gast_Data['hoestes_sieg']['gegner_id'];
		$Team1_Summe_Data['hoestes_sieg']['gegner']=$Team1_Gast_Data['hoestes_sieg']['gegner'];				
		}
else
		{
		$Team1_Summe_Data['hoestes_sieg']['A']=$Team1_Home_Data['hoestes_sieg']['A'];
		$Team1_Summe_Data['hoestes_sieg']['B']=$Team1_Home_Data['hoestes_sieg']['B'];		
		$Team1_Summe_Data['hoestes_sieg']['gegner_id']=$Team1_Home_Data['hoestes_sieg']['gegner_id'];
		$Team1_Summe_Data['hoestes_sieg']['gegner']=$Team1_Home_Data['hoestes_sieg']['gegner'];			
		}
//////////////////////////2 Team Spiele Daten/////////////

$Ueberzahlsituationen=$Team1_Home_Data['PPs']+$Team1_Gast_Data['PPs'];
$Ueberzahltore_S=$Team1_Home_Data['PP_eigene_tore']+$Team1_Gast_Data['PP_eigene_tore'];
$Ueberzahltore_S_proz= round((($Ueberzahltore_S*100) / $Ueberzahlsituationen),2);


$Ueberzahltore_H_proz= round((($Team1_Home_Data['PP_eigene_tore']*100) / $Team1_Home_Data['PPs']),2);
$Ueberzahltore_G_proz= round((($Team1_Gast_Data['PP_eigene_tore']*100) / $Team1_Gast_Data['PPs']),2);


$Ueberzahltore2_S=$Team1_Home_Data['PP_gegen_tore']+$Team1_Gast_Data['PP_gegen_tore'];
$Ueberzahltore2_S_proz = round((($Ueberzahltore2_S*100) / $Ueberzahlsituationen),2);

$Ueberzahltore2_H_proz= round((($Team1_Home_Data['PP_gegen_tore']*100) / $Team1_Home_Data['PPs']),2);
$Ueberzahltore2_G_proz= round((($Team1_Gast_Data['PP_gegen_tore']*100) / $Team1_Gast_Data['PPs']),2);


$Unterzahlsituationen=$Team1_Home_Data['UPs']+$Team1_Gast_Data['UPs'];
$Unterzahtore_S=$Team1_Home_Data['UP_eigene_tore']+$Team1_Gast_Data['UP_eigene_tore'];
$Unterzahtore_S_proz= round((($Unterzahtore_S*100) / $Unterzahlsituationen),2);


$Unterzahtore_H_proz= round((($Team1_Home_Data['UP_eigene_tore']*100) / $Team1_Home_Data['UPs']),2);
$Unterzahtore_G_proz= round((($Team1_Gast_Data['UP_eigene_tore']*100) / $Team1_Gast_Data['UPs']),2);


$Unterzahtore2_S=$Team1_Home_Data['UP_gegen_tore']+$Team1_Gast_Data['UP_gegen_tore'];
$Unterzahtore2_S_proz = round((($Unterzahtore2_S*100) / $Unterzahlsituationen),2);

$Unterzahtore2_H_proz= round((($Team1_Home_Data['UP_gegen_tore']*100) / $Team1_Home_Data['UPs']),2);
$Unterzahtore2_G_proz= round((($Team1_Gast_Data['UP_gegen_tore']*100) / $Team1_Gast_Data['UPs']),2);


$Team_Data['1dr_my_S']=$Team1_Gast_Data['1dr_my']+$Team1_Home_Data['1dr_my'];
$Team_Data['1dr_gg_S']=$Team1_Gast_Data['1dr_gg']+$Team1_Home_Data['1dr_gg'];
$Team_Data['2dr_my_S']=$Team1_Gast_Data['2dr_my']+$Team1_Home_Data['2dr_my'];
$Team_Data['2dr_gg_S']=$Team1_Gast_Data['2dr_gg']+$Team1_Home_Data['2dr_gg'];
$Team_Data['3dr_my_S']=$Team1_Gast_Data['3dr_my']+$Team1_Home_Data['3dr_my'];
$Team_Data['3dr_gg_S']=$Team1_Gast_Data['3dr_gg']+$Team1_Home_Data['3dr_gg'];


$Team_Data['H_my_S']=$Team1_Home_Data['1dr_my']+$Team1_Home_Data['2dr_my']+$Team1_Home_Data['3dr_my'];
$Team_Data['H_gg_S']=$Team1_Home_Data['1dr_gg']+$Team1_Home_Data['2dr_gg']+$Team1_Home_Data['3dr_gg'];

$Team_Data['G_my_S']=$Team1_Gast_Data['1dr_my']+$Team1_Gast_Data['2dr_my']+$Team1_Gast_Data['3dr_my'];
$Team_Data['G_gg_S']=$Team1_Gast_Data['1dr_gg']+$Team1_Gast_Data['2dr_gg']+$Team1_Gast_Data['3dr_gg'];

$Team_Data['my_S']=$Team_Data['H_my_S']+$Team_Data['G_my_S'];
$Team_Data['gg_S']=$Team_Data['H_gg_S']+$Team_Data['G_gg_S'];

$text = "<div style='text-align:center'>
			<table cellpadding='0' cellspacing='0' width='100%'>
				<tr>
					<td style='text-align:right; width:40%; height:100px'><img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$team_1['team_icon']."' style='height:200px'></td>
					<td><form action='".e_SELF."' method='post' id='neu'></td>
				</tr>
				<tr><td class='fcaption' style='text-align:center;width:20%'><b>Team</b></td>
					<td class='fcaption' style='text-align:right;width:40%;vertical-align:top;'>";
						$text .=$team__liste1;	
						$text .="</td></tr>
					</form>
			</table>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader' style='text-align:center; width:30%'><b>Gespielte Spiele</b></td>
						<td class='forumheader' style='text-align:left; width:35%'><b>".$Team1_Summe_Data['spiele']."</b> von ".$Team1_Summe_Data['Alle_spiele']." sind ".$B=sprintf("%10.2f", ($Team1_Summe_Data['spiele']/($Team1_Summe_Data['Alle_spiele']/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Heim</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Home_Data['spiele']."</b> von ".$Team1_Home_Data['Alle_spiele']." sind ".$B=sprintf("%10.2f", ($Team1_Home_Data['spiele']/($Team1_Home_Data['Alle_spiele']/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Gast</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Gast_Data['spiele']."</b> von ".$Team1_Gast_Data['Alle_spiele']." sind ".$B=sprintf("%10.2f", ($Team1_Gast_Data['spiele']/($Team1_Gast_Data['Alle_spiele']/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader' style='text-align:center; width:30%'><b>Siege</b></td>
						<td class='forumheader' style='text-align:left; width:35%'><b>".$Team1_Summe_Data['siege']."</b> von ".$Team1_Summe_Data['spiele']." sind ".$B=sprintf("%10.2f", ($Team1_Summe_Data['siege']/($Team1_Summe_Data['spiele']/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Heim</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Home_Data['siege']."</b> von ".$Team1_Home_Data['spiele']." sind ".$B=sprintf("%10.2f", ($Team1_Home_Data['siege']/($Team1_Home_Data['spiele']/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Gast</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Gast_Data['siege']."</b> von ".$Team1_Gast_Data['spiele']." sind ".$B=sprintf("%10.2f", ($Team1_Gast_Data['siege']/($Team1_Gast_Data['spiele']/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader' style='text-align:center; width:30%'><b>Niederlagen</b></td>
						<td class='forumheader' style='text-align:left; width:35%'><b>".$Team1_Summe_Data['lost']."</b> von ".$Team1_Summe_Data['spiele']." sind ".$B=sprintf("%10.2f", ($Team1_Summe_Data['lost']/($Team1_Summe_Data['spiele']/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Heim</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Home_Data['lost']."</b> von ".$Team1_Home_Data['spiele']." sind ".$B=sprintf("%10.2f", ($Team1_Home_Data['lost']/($Team1_Home_Data['spiele']/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Gast</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Gast_Data['lost']."</b> von ".$Team1_Gast_Data['spiele']." sind ".$A=sprintf("%10.2f", ($Team1_Gast_Data['lost']/($Team1_Gast_Data['spiele']/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader' style='text-align:center; width:30%'>Höchster Sieg</td>
						<td class='forumheader' style='text-align:left; width:35%'><b>".$Team1_Summe_Data['hoestes_sieg']['A']."</b>:<b>".$Team1_Summe_Data['hoestes_sieg']['B']."</b> gegen ".$Team1_Summe_Data['hoestes_sieg']['gegner']."</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Heim</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Home_Data['hoestes_sieg']['A']."</b>:<b>".$Team1_Home_Data['hoestes_sieg']['B']."</b> gegen ".$Team1_Home_Data['hoestes_sieg']['gegner']."</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Gast</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Gast_Data['hoestes_sieg']['A']."</b>:<b>".$Team1_Gast_Data['hoestes_sieg']['B']."</b> gegen ".$Team1_Gast_Data['hoestes_sieg']['gegner']."</td>
					</tr>
					<tr>
						<td class='forumheader' style='text-align:center; width:30%'>Höchste Niederlage</td>
						<td class='forumheader' style='text-align:left; width:35%'><b>".$Team1_Summe_Data['hoeste_niederlage']['A']."</b>:<b>".$Team1_Summe_Data['hoeste_niederlage']['B']."</b> gegen ".$Team1_Summe_Data['hoeste_niederlage']['gegner']."</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Heim</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Home_Data['hoeste_niederlage']['A']."</b>:<b>".$Team1_Home_Data['hoeste_niederlage']['B']."</b> gegen ".$Team1_Home_Data['hoeste_niederlage']['gegner']."</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Gast</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Gast_Data['hoeste_niederlage']['A']."</b>:<b>".$Team1_Gast_Data['hoeste_niederlage']['B']."</b> gegen ".$Team1_Gast_Data['hoeste_niederlage']['gegner']."</td>
					</tr>
					<tr>
						<td class='forumheader' style='text-align:center; width:30%'>Überzahlspiel<br/>pro Spiel ca. ".(round(($Ueberzahlsituationen/$Team1_Summe_Data['spiele']),2))." mal</td>
						<td class='forumheader' style='text-align:left; width:35%'><b>".$Ueberzahlsituationen."</b> mal Überzahlsituationen<br/><b>".$Ueberzahltore_S."</b> Tore geschossen (".$Ueberzahltore_S_proz."%) <br/> <b>".$Ueberzahltore2_S."</b> Gegentore kassiert (".$Ueberzahltore2_S_proz."%) </td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Heim <b>".$Team1_Home_Data['spiele']."</b> Spiele<br/>pro Spiel ca. ".(round(($Team1_Home_Data['PPs']/$Team1_Home_Data['spiele']),2))." mal</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Home_Data['PPs']."</b> mal Überzahlsituationen<br/><b>".$Team1_Home_Data['PP_eigene_tore']."</b> Tore geschossen(".$Ueberzahltore_H_proz."%)<br/><b>".$Team1_Home_Data['PP_gegen_tore']."</b> Gegentore kassiert(".$Ueberzahltore2_H_proz."%)</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Gast <b>".$Team1_Gast_Data['spiele']."</b> Spiele<br/>pro Spiel ca. ".(round(($Team1_Gast_Data['PPs']/$Team1_Gast_Data['spiele']),2))." mal</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Gast_Data['PPs']."</b> mal Überzahlsituationen<br/><b>".$Team1_Gast_Data['PP_eigene_tore']."</b> Tore geschossen(".$Ueberzahltore_G_proz."%)<br/><b>".$Team1_Gast_Data['PP_gegen_tore']."</b> Gegentore kassiert(".$Ueberzahltore2_G_proz."%)</td>
					</tr>
						<td class='forumheader' style='text-align:center; width:30%'>Unterzahlspiel<br/>pro Spiel ca. ".(round(($Unterzahlsituationen/$Team1_Summe_Data['spiele']),2))." mal</td>
						<td class='forumheader' style='text-align:left; width:35%'><b>".$Unterzahlsituationen."</b> mal Unterzahlsituationen<br/><b>".$Unterzahtore_S."</b> Tore geschossen(".$Unterzahtore_S_proz."%) <br/> <b>".$Unterzahtore2_S."</b> Gegentore kassiert(".$Unterzahtore2_S_proz."%) </td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Heim <b>".$Team1_Home_Data['spiele']."</b> Spiele<br/>pro Spiel ca. ".(round(($Team1_Home_Data['UPs']/$Team1_Home_Data['spiele']),2))." mal</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Home_Data['UPs']."</b> mal Unterzahlsituationen<br/><b>".$Team1_Home_Data['UP_eigene_tore']."</b> Tore geschossen(".$Unterzahtore_H_proz."%)<br/><b>".$Team1_Home_Data['UP_gegen_tore']."</b> Gegentore kassiert(".$Unterzahtore2_H_proz."%)</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Gast <b>".$Team1_Gast_Data['spiele']."</b> Spiele<br/>pro Spiel ca. ".(round(($Team1_Gast_Data['UPs']/$Team1_Gast_Data['spiele']),2))." mal</td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>".$Team1_Gast_Data['UPs']."</b> mal Unterzahlsituationen<br/><b>".$Team1_Gast_Data['UP_eigene_tore']."</b> Tore geschossen(".$Unterzahtore_G_proz."%)<br/><b>".$Team1_Gast_Data['UP_gegen_tore']."</b> Gegentore kassiert(".$Unterzahtore2_G_proz."%)</td>
					</tr>

					<tr>				
						<td class='forumheader' style='text-align:center; width:30%'>Tore pro Spiel ca.<b>".round(($Team_Data['my_S']/$Team1_Summe_Data['spiele']),2).":".round(($Team_Data['gg_S']/$Team1_Summe_Data['spiele']),2)."</b> <br/>   Tore pro Drittel:</td>
						<td class='forumheader' style='text-align:left; width:35%'><b>(".$Team_Data['1dr_my_S'].":".$Team_Data['1dr_gg_S']." - ".$Team_Data['2dr_my_S'].":".$Team_Data['2dr_gg_S']." - ".$Team_Data['3dr_my_S'].":".$Team_Data['3dr_gg_S'].")</b><br/><br/>
																																				1. Drittel:  ".round($Team_Data['1dr_my_S']/($Team_Data['my_S']/100),2)."% : ".round($Team_Data['1dr_gg_S']/($Team_Data['gg_S']/100),2)."% <br/>2. Drittel:  ".round($Team_Data['2dr_my_S']/($Team_Data['my_S']/100),2)."% : ".round($Team_Data['2dr_gg_S']/($Team_Data['gg_S']/100),2)."% <br/>3. Drittel:  ".round($Team_Data['3dr_my_S']/($Team_Data['my_S']/100),2)."% : ".round($Team_Data['3dr_gg_S']/($Team_Data['gg_S']/100),2)."%
						</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Heim  <b>".$Team_Data['H_my_S'].":".$Team_Data['H_gg_S']."</b>  Diff.:<b>".($Team_Data['H_my_S']-$Team_Data['H_gg_S'])."</b></td>
						<td class='forumheader3' style='text-align:left; width:35%'><b>(".$Team1_Home_Data['1dr_my'].":".$Team1_Home_Data['1dr_gg']." - ".$Team1_Home_Data['2dr_my'].":".$Team1_Home_Data['2dr_gg']." - ".$Team1_Home_Data['3dr_my'].":".$Team1_Home_Data['3dr_gg'].")</b><br/><br/>
						1. Drittel:  ".round($Team1_Home_Data['1dr_my']/($Team_Data['H_my_S']/100),2)."% : ".round($Team1_Home_Data['1dr_gg']/($Team_Data['H_gg_S']/100),2)."% <br/>2. Drittel:  ".round($Team1_Home_Data['2dr_my']/($Team_Data['H_my_S']/100),2)."% : ".round($Team1_Home_Data['2dr_gg']/($Team_Data['H_gg_S']/100),2)."% <br/>3. Drittel:  ".round($Team1_Home_Data['3dr_my']/($Team_Data['H_my_S']/100),2)."% : ".round($Team1_Home_Data['3dr_gg']/($Team_Data['H_gg_S']/100),2)."%
						</td>
					</tr>
					<tr>
						<td class='forumheader3' style='text-align:center; width:30%'>Gast  <b>".$Team_Data['G_my_S'].":".$Team_Data['G_gg_S']."</b>  Diff.:<b>".($Team_Data['G_my_S']-$Team_Data['G_gg_S'])."</b></td>
									<td class='forumheader3' style='text-align:left; width:35%'><b>(".$Team1_Gast_Data['1dr_my'].":".$Team1_Gast_Data['1dr_gg']." - ".$Team1_Gast_Data['2dr_my'].":".$Team1_Gast_Data['2dr_gg']." - ".$Team1_Gast_Data['3dr_my'].":".$Team1_Gast_Data['3dr_gg'].")</b><br/><br/>
						1. Drittel:  ".round($Team1_Gast_Data['1dr_my']/($Team_Data['G_my_S']/100),2)."% : ".round($Team1_Gast_Data['1dr_gg']/($Team_Data['G_gg_S']/100),2)."% <br/>2. Drittel:  ".round($Team1_Gast_Data['2dr_my']/($Team_Data['G_my_S']/100),2)."% : ".round($Team1_Gast_Data['2dr_gg']/($Team_Data['G_gg_S']/100),2)."% <br/>3. Drittel:  ".round($Team1_Gast_Data['3dr_my']/($Team_Data['G_my_S']/100),2)."% : ".round($Team1_Gast_Data['3dr_gg']/($Team_Data['G_gg_S']/100),2)."%
						</td>
					</tr>

				</table>";

$text .= "<br/><b><a href=league_teams.php?".$Saison.">Zu Ligaübersicht</b><br/><br/>";
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
	
$title = "Mannschaftsstatistik in der ".$LigaName." (".$SaisonName.")";
$ns -> tablerender($title, $text);
require_once(FOOTERF);

////////////

function team_data_stats($TEAM_ID)
{
global $sql;
$qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   WHERE a.leagueteam_id='".$TEAM_ID."' LIMIT 1
   		";
	$sql->db_Select_gen($qry1);
  $row = $sql-> db_Fetch();
    $team_data=$row;
    if($pref['sport_league_teamname_menu']==2){$team_data['team_name']=$team_data['team_kurzname'];}
return 	$team_data;
}
////////////////
function pp_data_get($game_id,$team_1,$team_2)
{
$PP['pps']=0;
$PP['ups']=0;
$PP['pp_eigene_tore']=0;
$PP['pp_gegen_tore']=0;
$PP['up_eigene_tore']=0;
$PP['up_gegen_tore']=0;
	

global $sql2;
/////////////////////Team1 Daten ///////////////////
$qry1="
   SELECT a.*, b.* FROM ".MPREFIX."league_points AS a 
   LEFT JOIN ".MPREFIX."league_points_value AS b ON b.points_value_id=a.points_value   
   WHERE a.points_game_id='".$game_id."' AND a.points_team_id='".$team_1."'
   		";
	$sql2->db_Select_gen($qry1);
	$list1count=0;
  while($row = $sql2-> db_Fetch()){
	$team_1_data[$list1count]=$row;
	$list1count++;
	}
/////////////////////Team2 Daten ///////////////////
$qry1="
   SELECT a.*, b.* FROM ".MPREFIX."league_points AS a 
   LEFT JOIN ".MPREFIX."league_points_value AS b ON b.points_value_id=a.points_value   
   WHERE a.points_game_id='".$game_id."' AND a.points_team_id='".$team_2."'
   		";
	$sql2->db_Select_gen($qry1);
	$list2count=0;
  while($row = $sql2-> db_Fetch()){
	$team_2_data[$list2count]=$row;
	$list2count++;	
	}
if($list1count>0)
	{
for($i=0; $i< $list1count;$i++)
		{
		if($team_1_data[$i]['points_value']==2||$team_1_data[$i]['points_value']==5||$team_1_data[$i]['points_value']==6){continue;}
		if($team_1_data[$i]['points_value']>2 && $team_1_data[$i]['points_value']!='')
			{$PP['ups']++;
			if(pruefe_UP_eigene_tore($team_1_data[$i]['points_time'],time_math($team_1_data[$i]['points_time'],$team_1_data[$i]['points_value_mat']), $team_1_data))	
				{
				$PP['up_eigene_tore']++;
				}	
			if(pruefe_UP_eigene_tore($team_1_data[$i]['points_time'],time_math($team_1_data[$i]['points_time'],$team_1_data[$i]['points_value_mat']), $team_2_data))	
				{
				$PP['up_gegen_tore']++;
				}		
			}
		}
	}
//++++++++++++++	
if($list2count>0)
	{
for($i=0; $i< $list2count;$i++)
		{
		if($team_2_data[$i]['points_value']==2){continue;}
		if($team_2_data[$i]['points_value']>2 && $team_2_data[$i]['points_value']!='')
			{$PP['pps']++;
			if(pruefe_UP_eigene_tore($team_2_data[$i]['points_time'],time_math($team_2_data[$i]['points_time'],$team_2_data[$i]['points_value_mat']), $team_1_data))	
				{
				$PP['pp_eigene_tore']++;
				}	
			if(pruefe_UP_eigene_tore($team_2_data[$i]['points_time'],time_math($team_2_data[$i]['points_time'],$team_2_data[$i]['points_value_mat']), $team_2_data))	
				{
				$PP['pp_gegen_tore']++;
				}	
			}
		}
	}	
//+++++++++++++++++++++++++
return $PP;
}

/////////////////////////////////////////////////////////////////////
function time_math($wert1,$wert2)
{
list($min, $sek) = explode(":", $wert1);
$min = intval($min);
$NewMin=$min+$wert2;
if($NewMin < 10)
	{$Ausgabe="0";}
$Ausgabe.="".$NewMin.":".$sek."";
return $Ausgabe;
}
///////////////////////////////////////////////////////////////////////
function pruefe_UP_eigene_tore($von,$bis,$team_data)
{
$cc=count($team_data);
for($i=0; $i< $cc;$i++)
	{
		if ($team_data[$i]['points_time'] > $von && $team_data[$i]['points_time'] < $bis && $team_data[$i]['points_value']==1)
		{return true;}
	}
return false;
}
///////////////////

///////////////////////////////////////////////////////////////////////
function dtv_data_get($game_id,$team_id,$gegner_id)
{
global $sql2;	
$goals[1]['MY']=0;	
$goals[1]['GG']=0;	

$goals[2]['MY']=0;	
$goals[2]['GG']=0;

$goals[3]['MY']=0;	
$goals[3]['GG']=0;

$qry1="
   SELECT a.*, b.* FROM ".MPREFIX."league_points AS a 
   LEFT JOIN ".MPREFIX."league_points_value AS b ON b.points_value_id=a.points_value   
   WHERE a.points_game_id='".$game_id."' AND a.points_value='1' AND a.points_time < '20:00'
   		";
	$sql2->db_Select_gen($qry1);
	$list1count=0;
  while($row = $sql2-> db_Fetch()){
	if ($row['points_team_id']==$team_id)
		{
		$goals[1]['MY']++;	
		}
	if ($row['points_team_id']==$gegner_id)
		{
		$goals[1]['GG']++;	
		}	
	$list1count++;
	}
if($list1count!=($goals[1]['MY']+$goals[1]['GG']))
	{
	echo	"1 hallo, falsche daten, es wurde ".$list1count."-Tore geschossen instesammt, aber gezhlt sind ".$goals[1]['MY'].":".$goals[1]['GG']."<br/>";
	}

$qry1="
   SELECT a.*, b.* FROM ".MPREFIX."league_points AS a 
   LEFT JOIN ".MPREFIX."league_points_value AS b ON b.points_value_id=a.points_value   
   WHERE a.points_game_id='".$game_id."' AND a.points_value='1' AND a.points_time > '19:59' AND a.points_time < '40:00'
   		";
	$sql2->db_Select_gen($qry1);
	$list1count=0;
  while($row = $sql2-> db_Fetch()){
	if ($row['points_team_id']==$team_id)
		{
		$goals[2]['MY']++;	
		}
	if ($row['points_team_id']==$gegner_id)
		{
		$goals[2]['GG']++;	
		}	
	$list1count++;
	}
if($list1count!=($goals[2]['MY']+$goals[2]['GG']))
	{
	echo	"2 hallo, falsche daten, es wurde ".$list1count."-Tore geschossen instesammt, aber gezhlt sind ".$goals[1]['MY'].":".$goals[1]['GG']."<br/>";
	}

$qry1="
   SELECT a.*, b.* FROM ".MPREFIX."league_points AS a 
   LEFT JOIN ".MPREFIX."league_points_value AS b ON b.points_value_id=a.points_value   
   WHERE a.points_game_id='".$game_id."' AND a.points_value='1' AND a.points_time > '39:59' AND a.points_time < '60:00'
   		";
	$sql2->db_Select_gen($qry1);
	$list1count=0;
  while($row = $sql2-> db_Fetch()){
	if ($row['points_team_id']==$team_id)
		{
		$goals[3]['MY']++;	
		}
	if ($row['points_team_id']==$gegner_id)
		{
		$goals[3]['GG']++;	
		}	
	$list1count++;
	}
if($list1count!=($goals[3]['MY']+$goals[3]['GG']))
	{
	echo	"3 hallo, falsche daten, es wurde ".$list1count."-Tore geschossen instesammt, aber gezhlt sind ".$goals[1]['MY'].":".$goals[1]['GG']."<br/>";
	}	
return 	$goals;
}
///////////////////
?>