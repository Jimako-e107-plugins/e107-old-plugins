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

if($_GET['team_a']){$TEAM1=$_GET['team_a'];}
else{
$TEAM1=$_POST['team_a'];
}
if($_GET['team_b']){$TEAM2=$_GET['team_b'];}
else{
$TEAM2=$_POST['team_b'];
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
$team_2=team_data_stats($TEAM2);
///////////////////////////Teams-Liste///////////////////
$qry1="
   SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   WHERE a.leagueteam_league_id='".$team_2['leagueteam_league_id']."'
   		";
	$sql->db_Select_gen($qry1);
$listcount=0;
  while($row = $sql-> db_Fetch()){
		$team_list['leagueteam_id'][$listcount]=$row['leagueteam_id'];
    if($pref['sport_league_teamname_menu']==2){$team_list['team_name'][$listcount]=$row['team_kurzname'];}
    else{$team_list['team_name'][$listcount]=$row['team_name'];}
		$listcount++;
		}
$team__liste1=" <select name='team_a' size='1' style='width:98%;text-align:right;vertical-align:top;' onChange='this.form.submit()'>";
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

$team__liste2="<select name='team_b' size='1' style='width:98%;text-align:left;vertical-align:top;' onChange='this.form.submit()'>";
for($i=0; $i < $listcount; $i++)
		{
		$team__liste2.="<option ";
		if($team_list['leagueteam_id'][$i]==$team_2['leagueteam_id'])
			{
			$team__liste2.="selected ";
			}
		$team__liste2.="value='".$team_list['leagueteam_id'][$i]."'>";
		$team__liste2.="".$team_list['team_name'][$i]."</option>";
		}
$team__liste2.="</select>";
//////////////////////////1 Team Spiele Daten/////////////
///                           Home Spiele
$Team1_Home_count=0;
$Team1_Home_Data['eigene_tore']=0;
$Team1_Home_Data['gegen_tore']=0;
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
$Team1_Gast_Data['gegen_tore']=0;
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
///                           Home Spiele
$Team2_Home_count=0;
$Team2_Home_Data['eigene_tore']=0;
$Team2_Home_Data['gegen_tore']=0;
$Team2_Home_Data['siege']=0;
$Team2_Home_Data['lost']=0;
$Team2_Home_Data['spiele']=0;
$Team2_Home_Data['Alle_spiele']=0;
$Team2_Home_Data['hoestes_sieg']['A']=0;
$Team2_Home_Data['hoestes_sieg']['B']=0;
$Team2_Home_Data['hoeste_niederlage']['A']=0;
$Team2_Home_Data['hoeste_niederlage']['B']=0;
$Team2_Home_Data['hoestes_sieg']['gegner_id']=0;
$Team2_Home_Data['hoestes_sieg']['gegner']="";
$Team2_Home_Data['hoeste_niederlage']['gegner_id']=0;
$Team2_Home_Data['hoeste_niederlage']['gegner']="";
$sql -> db_Select("league_games","*","game_home_id=".$team_2['leagueteam_id']."");
				while($row = $sql-> db_Fetch())
				{
				$Team2_Home_Data['Alle_spiele']++;
				}
$sql -> db_Select("league_games","*","game_enable=1 AND game_home_id=".$team_2['leagueteam_id']."");
				while($row = $sql-> db_Fetch())
				{
				$Team2_Home['game_id'][$Team2_Home_count]=$row['game_id'];
				$Team2_Home['gegner_id'][$Team2_Home_count]=$row['game_gast_id'];
				$Team2_Home['eigene_tore'][$Team2_Home_count]=$row['game_goals_home'];
				$Team2_Home['gegen_tore'][$Team2_Home_count]=$row['game_goals_gast'];
				if($Team2_Home['gegner_id'][$Team2_Home_count]==$team_2['leagueteam_id'])
					{$a++;		}
				$Team2_Home_Data['eigene_tore']=$Team2_Home_Data['eigene_tore']+$Team2_Home['eigene_tore'][$Team2_Home_count];
				$Team2_Home_Data['gegen_tore']=$Team2_Home_Data['gegen_tore']+$Team2_Home['gegen_tore'][$Team2_Home_count];
				if($Team2_Home['eigene_tore'][$Team2_Home_count]> $Team2_Home['gegen_tore'][$Team2_Home_count])
					{$Team2_Home_Data['siege']++;
						if(($Team2_Home['eigene_tore'][$Team2_Home_count]-$Team2_Home['gegen_tore'][$Team2_Home_count])>($Team2_Home_Data['hoestes_sieg']['A']-$Team2_Home_Data['hoestes_sieg']['B']))
								{
								$Team2_Home_Data['hoestes_sieg']['A']=$Team2_Home['eigene_tore'][$Team2_Home_count];
								$Team2_Home_Data['hoestes_sieg']['B']=$Team2_Home['gegen_tore'][$Team2_Home_count];
								$Team2_Home_Data['hoestes_sieg']['gegner_id']=$row['game_gast_id'];
								}	
					}
				else{
						$Team2_Home_Data['lost']++;
						if(($Team2_Home['gegen_tore'][$Team2_Home_count]-$Team2_Home['eigene_tore'][$Team2_Home_count])>($Team2_Home_Data['hoeste_niederlage']['B']-$Team2_Home_Data['hoeste_niederlage']['B']))
							{
							$Team2_Home_Data['hoeste_niederlage']['A']=$Team2_Home['eigene_tore'][$Team2_Home_count];
							$Team2_Home_Data['hoeste_niederlage']['B']=$Team2_Home['gegen_tore'][$Team2_Home_count];
							$Team2_Home_Data['hoeste_niederlage']['gegner_id']=$row['game_gast_id'];
							}
						}
				$Team2_Home_Data['spiele']++;
				$Team2_Home_count++;	
				}
$qry1="
SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
WHERE a.leagueteam_id='".$Team2_Home_Data['hoestes_sieg']['gegner_id']."'
";
$sql->db_Select_gen($qry1);
$row = $sql-> db_Fetch();
$Team2_Home_Data['hoestes_sieg']['gegner']=$row['team_name'];

$qry1="
SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
WHERE a.leagueteam_id='".$Team2_Home_Data['hoeste_niederlage']['gegner_id']."'
";
$sql->db_Select_gen($qry1);
$row = $sql-> db_Fetch();
$Team2_Home_Data['hoeste_niederlage']['gegner']=$row['team_name'];

///                           Gast Spiele
$Team2_Gast_count=0;
$Team2_Gast_Data['eigene_tore']=0;
$Team2_Gast_Data['gegen_tore']=0;
$Team2_Gast_Data['siege']=0;
$Team2_Gast_Data['lost']=0;
$Team2_Gast_Data['spiele']=0;
$Team2_Gast_Data['Alle_spiele']=0;
$Team2_Gast_Data['hoestes_sieg']['A']=0;
$Team2_Gast_Data['hoestes_sieg']['B']=0;
$Team2_Gast_Data['hoeste_niederlage']['A']=0;
$Team2_Gast_Data['hoeste_niederlage']['B']=0;
$Team2_Gast_Data['hoestes_sieg']['gegner_id']=0;
$Team2_Gast_Data['hoestes_sieg']['gegner']="";
$Team2_Gast_Data['hoeste_niederlage']['gegner_id']=0;
$Team2_Gast_Data['hoeste_niederlage']['gegner']="";
$sql -> db_Select("league_games","*","game_gast_id=".$team_2['leagueteam_id']."");
				while($row = $sql-> db_Fetch())
				{
				$Team2_Gast_Data['Alle_spiele']++;
				}
$sql -> db_Select("league_games","*","game_enable=1 AND game_gast_id=".$team_2['leagueteam_id']."");
				while($row = $sql-> db_Fetch())
				{
				$Team2_Gast['game_id'][$Team2_Gast_count]=$row['game_id'];
				$Team2_Gast['gegner_id'][$Team2_Gast_count]=$row['game_gast_id'];
				$Team2_Gast['eigene_tore'][$Team2_Gast_count]=$row['game_goals_gast'];
				$Team2_Gast['gegen_tore'][$Team2_Gast_count]=$row['game_goals_home'];

				$Team2_Gast_Data['eigene_tore']=$Team2_Gast_Data['eigene_tore']+$Team2_Gast['eigene_tore'][$Team2_Gast_count];
				$Team2_Gast_Data['gegen_tore']=$Team2_Gast_Data['gegen_tore']+$Team2_Gast['gegen_tore'][$Team2_Gast_count];
				if($Team2_Gast['eigene_tore'][$Team2_Gast_count]> $Team2_Gast['gegen_tore'][$Team2_Gast_count])
					{
					$Team2_Gast_Data['siege']++;
					if(($Team2_Gast['eigene_tore'][$Team2_Gast_count]-$Team2_Gast['gegen_tore'][$Team2_Gast_count])>($Team2_Gast_Data['hoestes_sieg']['A']-$Team2_Gast_Data['hoestes_sieg']['B']))
								{
								$Team2_Gast_Data['hoestes_sieg']['A']=$Team2_Gast['eigene_tore'][$Team2_Gast_count];
								$Team2_Gast_Data['hoestes_sieg']['B']=$Team2_Gast['gegen_tore'][$Team2_Gast_count];
								$Team2_Gast_Data['hoestes_sieg']['gegner_id']=$row['game_home_id'];
								}
					}
				else{
					$Team2_Gast_Data['lost']++;
					if(($Team2_Gast['gegen_tore'][$Team2_Gast_count]-$Team2_Gast['eigene_tore'][$Team2_Gast_count])>($Team2_Gast_Data['hoeste_niederlage']['B']-$Team2_Gast_Data['hoeste_niederlage']['B']))
							{
							$Team2_Gast_Data['hoeste_niederlage']['A']=$Team2_Gast['eigene_tore'][$Team2_Gast_count];
							$Team2_Gast_Data['hoeste_niederlage']['B']=$Team2_Gast['gegen_tore'][$Team2_Gast_count];
							$Team2_Gast_Data['hoeste_niederlage']['gegner_id']=$row['game_home_id'];
							}
					}
				$Team2_Gast_Data['spiele']++;
				$Team2_Gast_count++;	
				}
$qry1="
SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
WHERE a.leagueteam_id='".$Team2_Gast_Data['hoestes_sieg']['gegner_id']."'
";
$sql->db_Select_gen($qry1);
$row = $sql-> db_Fetch();
$Team2_Gast_Data['hoestes_sieg']['gegner']=$row['team_name'];

$qry1="
SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
WHERE a.leagueteam_id='".$Team2_Gast_Data['hoeste_niederlage']['gegner_id']."'
";
$sql->db_Select_gen($qry1);
$row = $sql-> db_Fetch();
$Team2_Gast_Data['hoeste_niederlage']['gegner']=$row['team_name'];
///                           Summe Spiele
$Team2_Summe_Data['eigene_tore']=$Team2_Home_Data['eigene_tore']+$Team2_Gast_Data['eigene_tore'];
$Team2_Summe_Data['gegen_tore']=$Team2_Home_Data['gegen_tore']+$Team2_Gast_Data['gegen_tore'];
$Team2_Summe_Data['siege']=$Team2_Home_Data['siege']+$Team2_Gast_Data['siege'];
$Team2_Summe_Data['lost']=$Team2_Home_Data['lost']+$Team2_Gast_Data['lost'];
$Team2_Summe_Data['spiele']=$Team2_Home_Data['spiele']+$Team2_Gast_Data['spiele'];
$Team2_Summe_Data['Alle_spiele']=$Team2_Home_Data['Alle_spiele']+$Team2_Gast_Data['Alle_spiele'];
if($Team2_Gast_Data['hoeste_niederlage']['B']-$Team2_Gast_Data['hoeste_niederlage']['A']> $Team2_Home_Data['hoeste_niederlage']['B']-$Team2_Home_Data['hoeste_niederlage']['A'])
		{
		$Team2_Summe_Data['hoeste_niederlage']['A']=$Team2_Gast_Data['hoeste_niederlage']['A'];
		$Team2_Summe_Data['hoeste_niederlage']['B']=$Team2_Gast_Data['hoeste_niederlage']['B'];
		$Team2_Summe_Data['hoeste_niederlage']['gegner_id']=$Team2_Gast_Data['hoeste_niederlage']['gegner_id'];
		$Team2_Summe_Data['hoeste_niederlage']['gegner']=$Team2_Gast_Data['hoeste_niederlage']['gegner'];				
		}
else
		{
		$Team2_Summe_Data['hoeste_niederlage']['A']=$Team2_Home_Data['hoeste_niederlage']['A'];
		$Team2_Summe_Data['hoeste_niederlage']['B']=$Team2_Home_Data['hoeste_niederlage']['B'];		
		$Team2_Summe_Data['hoeste_niederlage']['gegner_id']=$Team2_Home_Data['hoeste_niederlage']['gegner_id'];
		$Team2_Summe_Data['hoeste_niederlage']['gegner']=$Team2_Home_Data['hoeste_niederlage']['gegner'];			
		}
if($Team2_Gast_Data['hoestes_sieg']['B']-$Team2_Gast_Data['hoestes_sieg']['A']< $Team2_Home_Data['hoestes_sieg']['B']-$Team2_Home_Data['hoestes_sieg']['A'])
		{
		$Team2_Summe_Data['hoestes_sieg']['A']=$Team2_Gast_Data['hoestes_sieg']['A'];
		$Team2_Summe_Data['hoestes_sieg']['B']=$Team2_Gast_Data['hoestes_sieg']['B'];
		$Team2_Summe_Data['hoestes_sieg']['gegner_id']=$Team2_Gast_Data['hoestes_sieg']['gegner_id'];
		$Team2_Summe_Data['hoestes_sieg']['gegner']=$Team2_Gast_Data['hoestes_sieg']['gegner'];				
		}
else
		{
		$Team2_Summe_Data['hoestes_sieg']['A']=$Team2_Home_Data['hoestes_sieg']['A'];
		$Team2_Summe_Data['hoestes_sieg']['B']=$Team2_Home_Data['hoestes_sieg']['B'];		
		$Team2_Summe_Data['hoestes_sieg']['gegner_id']=$Team2_Home_Data['hoestes_sieg']['gegner_id'];
		$Team2_Summe_Data['hoestes_sieg']['gegner']=$Team2_Home_Data['hoestes_sieg']['gegner'];			
		}
///////////////////////////////////////////////////
$expand_autohide = "display:none";

$text .= "<div style='text-align:center'><table style='width:100%' cellspacing='0' cellpadding='0' background='transparent'>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' width='100%'>
				<tr>
					<td style='text-align:right; width:40%;'><img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$team_1['team_icon']."' width='80%'></td>
					<td><form action='".e_SELF."' method='post' id='neu'></td>
					<td style='text-align:left; width:40%;'><img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$team_2['team_icon']."' width='80%'></td>
				</tr>
				<tr>
					<td class='fcaption' style='text-align:right;width:40%;vertical-align:top;'>";
						$text .=$team__liste1;	
						$text .="</td>
					<td class='fcaption' style='text-align:center;width:20%'><b>Team</b></td>
					<td class='fcaption' style='text-align:left;width:40%;vertical-align:top;'>";
						$text .=$team__liste2;	
						$text .="
					</td>
				</tr></form>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<div style='cursor:pointer' onclick=\"expandit('exp_Spiele')\">	
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader' style='text-align:right; width:35%'><b>".$Team1_Summe_Data['spiele']."</b> von ".$Team1_Summe_Data['Alle_spiele']." sind ".$A=sprintf("%10.2f", ($Team1_Summe_Data['spiele']/($Team1_Summe_Data['Alle_spiele']/100)))."%</td>
						<td class='forumheader' style='text-align:center; width:30%'><b>Gespielte Spiele</b></td>
						<td class='forumheader' style='text-align:left; width:35%'><b>".$Team2_Summe_Data['spiele']."</b> von ".$Team2_Summe_Data['Alle_spiele']." sind ".$B=sprintf("%10.2f", ($Team2_Summe_Data['spiele']/($Team2_Summe_Data['Alle_spiele']/100)))."%</td>
					</tr>
				</table>
			</div>	
			<div id='exp_Spiele' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader2' style='text-align:right; width:35%'><b>".$Team1_Home_Data['spiele']."</b> von ".$Team1_Home_Data['Alle_spiele']." sind ".$A=sprintf("%10.2f", ($Team1_Home_Data['spiele']/($Team1_Home_Data['Alle_spiele']/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:30%'>Heim</td>
						<td class='forumheader2' style='text-align:left; width:35%'><b>".$Team2_Home_Data['spiele']."</b> von ".$Team2_Home_Data['Alle_spiele']." sind ".$B=sprintf("%10.2f", ($Team2_Home_Data['spiele']/($Team2_Home_Data['Alle_spiele']/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader2' style='text-align:right; width:35%'><b>".$Team1_Gast_Data['spiele']."</b> von ".$Team1_Gast_Data['Alle_spiele']." sind ".$A=sprintf("%10.2f", ($Team1_Gast_Data['spiele']/($Team1_Gast_Data['Alle_spiele']/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:30%'>Gast</td>
						<td class='forumheader2' style='text-align:left; width:35%'><b>".$Team2_Gast_Data['spiele']."</b> von ".$Team2_Gast_Data['Alle_spiele']." sind ".$B=sprintf("%10.2f", ($Team2_Gast_Data['spiele']/($Team2_Gast_Data['Alle_spiele']/100)))."%</td>
					</tr>
				</table>
			</div>
		</td>
	<tr>
		<td>
			<div style='cursor:pointer' onclick=\"expandit('exp_Siege')\">	
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader' style='text-align:right; width:35%'><b>".$Team1_Summe_Data['siege']."</b> von ".$Team1_Summe_Data['spiele']." sind ".$A=sprintf("%10.2f", ($Team1_Summe_Data['siege']/($Team1_Summe_Data['spiele']/100)))."%</td>
						<td class='forumheader' style='text-align:center; width:30%'><b>Siege</b></td>
						<td class='forumheader' style='text-align:left; width:35%'><b>".$Team2_Summe_Data['siege']."</b> von ".$Team2_Summe_Data['spiele']." sind ".$B=sprintf("%10.2f", ($Team2_Summe_Data['siege']/($Team2_Summe_Data['spiele']/100)))."%</td>
					</tr>
				</table>
			</div>	
			<div id='exp_Siege' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader2' style='text-align:right; width:35%'><b>".$Team1_Home_Data['siege']."</b> von ".$Team1_Home_Data['spiele']." sind ".$A=sprintf("%10.2f", ($Team1_Home_Data['siege']/($Team1_Home_Data['spiele']/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:30%'>Heim</td>
						<td class='forumheader2' style='text-align:left; width:35%'><b>".$Team2_Home_Data['siege']."</b> von ".$Team2_Home_Data['spiele']." sind ".$B=sprintf("%10.2f", ($Team2_Home_Data['siege']/($Team2_Home_Data['spiele']/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader2' style='text-align:right; width:35%'><b>".$Team1_Gast_Data['siege']."</b> von ".$Team1_Gast_Data['spiele']." sind ".$A=sprintf("%10.2f", ($Team1_Gast_Data['siege']/($Team1_Gast_Data['spiele']/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:30%'>Gast</td>
						<td class='forumheader2' style='text-align:left; width:35%'><b>".$Team2_Gast_Data['siege']."</b> von ".$Team2_Gast_Data['spiele']." sind ".$B=sprintf("%10.2f", ($Team2_Gast_Data['siege']/($Team2_Gast_Data['spiele']/100)))."%</td>
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
						<td class='forumheader' style='text-align:right; width:35%'><b>".$Team1_Summe_Data['lost']."</b> von ".$Team1_Summe_Data['spiele']." sind ".$A=sprintf("%10.2f", ($Team1_Summe_Data['lost']/($Team1_Summe_Data['spiele']/100)))."%</td>
						<td class='forumheader' style='text-align:center; width:30%'><b>Niederlagen</b></td>
						<td class='forumheader' style='text-align:left; width:35%'><b>".$Team2_Summe_Data['lost']."</b> von ".$Team2_Summe_Data['spiele']." sind ".$B=sprintf("%10.2f", ($Team2_Summe_Data['lost']/($Team2_Summe_Data['spiele']/100)))."%</td>
					</tr>
				</table>
			</div>	
			<div id='exp_Niederlagen' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader2' style='text-align:right; width:35%'><b>".$Team1_Home_Data['lost']."</b> von ".$Team1_Home_Data['spiele']." sind ".$A=sprintf("%10.2f", ($Team1_Home_Data['lost']/($Team1_Home_Data['spiele']/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:30%'>Heim</td>
						<td class='forumheader2' style='text-align:left; width:35%'><b>".$Team2_Home_Data['lost']."</b> von ".$Team2_Home_Data['spiele']." sind ".$B=sprintf("%10.2f", ($Team2_Home_Data['lost']/($Team2_Home_Data['spiele']/100)))."%</td>
					</tr>
					<tr>
						<td class='forumheader2' style='text-align:right; width:35%'><b>".$Team1_Gast_Data['lost']."</b> von ".$Team1_Gast_Data['spiele']." sind ".$A=sprintf("%10.2f", ($Team1_Gast_Data['lost']/($Team1_Gast_Data['spiele']/100)))."%</td>
						<td class='forumheader2' style='text-align:center; width:30%'>Gast</td>
						<td class='forumheader2' style='text-align:left; width:35%'><b>".$Team2_Gast_Data['lost']."</b> von ".$Team2_Gast_Data['spiele']." sind ".$A=sprintf("%10.2f", ($Team2_Gast_Data['lost']/($Team2_Gast_Data['spiele']/100)))."%</td>
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
						<td class='forumheader' style='text-align:right; width:35%'><b>".$Team1_Summe_Data['hoestes_sieg']['A']."</b>:<b>".$Team1_Summe_Data['hoestes_sieg']['B']."</b> gegen ".$Team1_Summe_Data['hoestes_sieg']['gegner']."</td>
						<td class='forumheader' style='text-align:center; width:30%'>Höchstes Sieg</td>
						<td class='forumheader' style='text-align:left; width:35%'><b>".$Team2_Summe_Data['hoestes_sieg']['A']."</b>:<b>".$Team2_Summe_Data['hoestes_sieg']['B']."</b> gegen ".$Team2_Summe_Data['hoestes_sieg']['gegner']."</td>
					</tr>
				</table>
			</div>	
			<div id='exp_HSieg' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader2' style='text-align:right; width:35%'><b>".$Team1_Home_Data['hoestes_sieg']['A']."</b>:<b>".$Team1_Home_Data['hoestes_sieg']['B']."</b> gegen ".$Team1_Home_Data['hoestes_sieg']['gegner']."</td>
						<td class='forumheader2' style='text-align:center; width:30%'>Heim</td>
						<td class='forumheader2' style='text-align:left; width:35%'><b>".$Team2_Home_Data['hoestes_sieg']['A']."</b>:<b>".$Team2_Home_Data['hoestes_sieg']['B']."</b> gegen ".$Team2_Home_Data['hoestes_sieg']['gegner']."</td>
					</tr>
					<tr>
						<td class='forumheader2' style='text-align:right; width:35%'><b>".$Team1_Gast_Data['hoestes_sieg']['A']."</b>:<b>".$Team1_Gast_Data['hoestes_sieg']['B']."</b> gegen ".$Team1_Gast_Data['hoestes_sieg']['gegner']."</td>
						<td class='forumheader2' style='text-align:center; width:30%'>Gast</td>
						<td class='forumheader2' style='text-align:left; width:35%'><b>".$Team2_Gast_Data['hoestes_sieg']['A']."</b>:<b>".$Team2_Gast_Data['hoestes_sieg']['B']."</b> gegen ".$Team2_Gast_Data['hoestes_sieg']['gegner']."</td>
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
						<td class='forumheader' style='text-align:right; width:35%'><b>".$Team1_Summe_Data['hoeste_niederlage']['A']."</b>:<b>".$Team1_Summe_Data['hoeste_niederlage']['B']."</b> gegen ".$Team1_Summe_Data['hoeste_niederlage']['gegner']."</td>
						<td class='forumheader' style='text-align:center; width:30%'>Höchste Niederlage</td>
						<td class='forumheader' style='text-align:left; width:35%'><b>".$Team2_Summe_Data['hoeste_niederlage']['A']."</b>:<b>".$Team2_Summe_Data['hoeste_niederlage']['B']."</b> gegen ".$Team2_Summe_Data['hoeste_niederlage']['gegner']."</td>
					</tr>
				</table>
			</div>	
			<div id='exp_HNiederlage' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class='forumheader2' style='text-align:right; width:35%'><b>".$Team1_Home_Data['hoeste_niederlage']['A']."</b>:<b>".$Team1_Home_Data['hoeste_niederlage']['B']."</b> gegen ".$Team1_Home_Data['hoeste_niederlage']['gegner']."</td>
						<td class='forumheader2' style='text-align:center; width:30%'>Heim</td>
						<td class='forumheader2' style='text-align:left; width:35%'><b>".$Team2_Home_Data['hoeste_niederlage']['A']."</b>:<b>".$Team2_Home_Data['hoeste_niederlage']['B']."</b> gegen ".$Team2_Home_Data['hoeste_niederlage']['gegner']."</td>
					</tr>
					<tr>
						<td class='forumheader2' style='text-align:right; width:35%'><b>".$Team1_Gast_Data['hoeste_niederlage']['A']."</b>:<b>".$Team1_Gast_Data['hoeste_niederlage']['B']."</b> gegen ".$Team1_Gast_Data['hoeste_niederlage']['gegner']."</td>
						<td class='forumheader2' style='text-align:center; width:30%'>Gast</td>
						<td class='forumheader2' style='text-align:left; width:35%'><b>".$Team2_Gast_Data['hoeste_niederlage']['A']."</b>:<b>".$Team2_Gast_Data['hoeste_niederlage']['B']."</b> gegen ".$Team2_Gast_Data['hoeste_niederlage']['gegner']."</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
";


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
	
$title = "Mannschaftenvergleich in der ".$LigaName." (".$SaisonName.")";
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
?>