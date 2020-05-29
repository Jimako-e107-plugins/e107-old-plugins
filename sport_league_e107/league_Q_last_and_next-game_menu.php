<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|                                          
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
if(file_exists("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/last_next_menu_lan.php")){
require_once("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/last_next_menu_lan.php");
}
require_once(e_PLUGIN."sport_league_e107/functionen.php");
$text="<table style='width:100%;background:transparent;' cellspacing='0' cellpadding='0'>
				<tr>";
$expand_autohide = "display:none; ";

	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagues AS a 
   	LEFT JOIN ".MPREFIX."league_saison AS ae ON ae.saison_id=a.league_saison_id   
   	WHERE a.league_saison_id=".$pref['league_my_saison']."
   			";
$sql->db_Select_gen($qry1);
$saisoncount=0;
while($row = $sql-> db_Fetch())
	 		{
			$SAISON[$saisoncount]['league_name']=$row['league_name'];
			$SAISON[$saisoncount]['saison_name']=$row['saison_name'];
			$SAISON[$saisoncount]['saison_id']=$row['saison_id'];
			$SAISON[$saisoncount]['league_id']=$row['league_id'];
			$saisoncount++;
			}
if($saisoncount > 0)
	{
	for($JS=0; $JS < $saisoncount;$JS++ )
		{
//////////////////////////////////////////// Last Games  /////////////////////////////////////
 	  $menu_lasg_qry="
   	SELECT a.*, ab.*, ac.* FROM ".MPREFIX."league_games AS a
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ab ON ab.leagueteam_id=a.game_home_id
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ac ON ac.leagueteam_id=a.game_gast_id  
   	WHERE a.game_date < ".$A=(time()-86400)." AND ab.leagueteam_league_id='".$SAISON[$JS]['league_id']."' OR a.game_date < ".$A=(time()-86400)." AND ac.leagueteam_league_id='".$SAISON[$JS]['league_id']."' ORDER BY a.game_date DESC  LIMIT ".$pref['sport_league_last_games']."
		";
///   	WHERE a.game_date < ".$A=(time()-86400)." AND ab.leagueteam_league_id='".$SAISON[$JS]['league_id']."' AND ab.leagueteam_my_team='1' OR a.game_date < ".$A=(time()-86400)." AND ac.leagueteam_league_id='".$SAISON[$JS]['league_id']."' AND ac.leagueteam_my_team='1' ORDER BY a.game_date DESC  LIMIT 1

		$sql->db_Select_gen($menu_lasg_qry);	
		
	 	$gamecount[$JS]=0;
	 	while($row = $sql-> db_Fetch())
	 			{
					$GAME[$JS][$gamecount[$JS]]['game_id']=$row['game_id'];
  				$GAME[$JS][$gamecount[$JS]]['game_league_id']=$row['game_league_id'];
  				$GAME[$JS][$gamecount[$JS]]['game_week']=$row['game_week'];
  				$GAME[$JS][$gamecount[$JS]]['game_date']=$row['game_date'];
 					$GAME[$JS][$gamecount[$JS]]['game_time']=$row['game_time'];
  				$GAME[$JS][$gamecount[$JS]]['game_home_id']=$row['game_home_id'];
  				$GAME[$JS][$gamecount[$JS]]['game_gast_id']=$row['game_gast_id'];
  				$GAME[$JS][$gamecount[$JS]]['game_goals_home']=$row['game_goals_home'];
  				$GAME[$JS][$gamecount[$JS]]['game_goals_gast']=$row['game_goals_gast'];
  				$GAME[$JS][$gamecount[$JS]]['game_un']=$row['game_un'];
  				$GAME[$JS][$gamecount[$JS]]['game_enable']=$row['game_enable'];
  				if(!$GAME[$JS][$gamecount[$JS]]['game_enable']){$GAME[$JS][$gamecount[$JS]]['game_goals_home']="x";$GAME[$JS][$gamecount[$JS]]['game_goals_gast']="x";}
  				$GAME[$JS][$gamecount[$JS]]['game_news_id']=$row['game_news_id'];
					$gamecount[$JS]++;
				}
if($gamecount[$JS] > 0)
	{
	for($i=0; $i < $gamecount[$JS]; $i++)
		{
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$GAME[$JS][$i]['game_home_id']."
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();	
		  $GAME[$JS][$i]['home_team_id']=$row['team_id'];       				// Home Mannschaft  ID
      $GAME[$JS][$i]['home_team_icon']=$row['team_icon'];     			// Home Mannschaft  Logo
      $GAME[$JS][$i]['home_team_url']=$row['team_url'];     				// Home Mannschaft  URL
     	$GAME[$JS][$i]['home_team_name']=$row['team_name'];    			// Home Mannschaft  Name
			$GAME[$JS][$i]['home_team_kurzname']=$row['team_kurzname'];  // Home Mannschaft  Name
			$GAME[$JS][$i]['leagueteam_league_id']=$row['leagueteam_league_id'];  // leagueteam_league_id  
			$GAME[$JS][$i]['home_my_team']=$row['leagueteam_my_team'];  // leagueteam_league_id  
	  
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$GAME[$JS][$i]['game_gast_id']."
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();	
		  $GAME[$JS][$i]['gast_team_id']=$row['team_id'];       				// Gast Mannschaft  ID
      $GAME[$JS][$i]['gast_team_icon']=$row['team_icon'];     			// Gast Mannschaft  Logo
      $GAME[$JS][$i]['gast_team_url']=$row['team_url'];     				// Gast Mannschaft  URL
     	$GAME[$JS][$i]['gast_team_name']=$row['team_name'];    			// Gast Mannschaft  Name
			$GAME[$JS][$i]['gast_team_kurzname']=$row['team_kurzname'];  // Gast Mannschaft  Name	
			$GAME[$JS][$i]['gast_my_team']=$row['leagueteam_my_team'];  // leagueteam_league_id  		
		}
		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$lastgame_text[$JS] =LAN_LAST_NEXT_GAME_25;

if($pref['sport_league_gamesmenu_scroll']=="0")
	{
$lastgame_text[$JS] .="<MARQUEE border='0' style='' scrollamount='2' scrolldelay='2' DIRECTION='up' align='top' onMouseover='this.scrollAmount=0' onMouseout='this.scrollAmount=2'><center>";
	}
for($i=0; $i < $gamecount[$JS]; $i++)
	{
$lastgame_text[$JS] .="<table style='width:100%;background:transparent;' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:100%;' colspan='3'>
							am ".strftime("%a %d %b %Y",$GAME[$JS][$i]['game_date'])." um ".strftime("%H:%M",$GAME[$JS][$i]['game_date'])."
							</td>
						</tr>";
if(($pref['sport_league_L_N_logo_menu']==1) || ($pref['sport_league_L_N_logo_menu']==3))
	{$lastgame_text[$JS] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;'>
								<a target='_blank' href='".$GAME[$JS][$i]['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME[$JS][$i]['home_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$GAME[$JS][$i]['home_team_icon']."' width='50px' height='50px'>
								</a>
							</td>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:10%;'>";
if($pref['sport_league_menu_Stats_link']=="0")
	{
	$lastgame_text[$JS] .="<a href='".e_PLUGIN."sport_league_e107/lique_stats.php?team_a=".$GAME[$JS][$i]['game_home_id']."&&team_b=".$GAME[$JS][$i]['game_gast_id']."' title='".LAN_LAST_NEXT_GAME_27."'>
							".LAN_LAST_NEXT_GAME_14."</a>";
	}
else{$lastgame_text[$JS] .=LAN_LAST_NEXT_GAME_14;}						
$lastgame_text[$JS] .="</td>
							<td style='vertical-align: middle; text-align:left; background:transparent; width:45%;'>
								<a target='_blank' href='".$GAME[$JS][$i]['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME[$JS][$i]['gast_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$GAME[$JS][$i]['gast_team_icon']."' width='50px' height='50px'>
								</a>
							</td>
						</tr>";
	}
if($pref['sport_league_L_N_logo_menu']==2||$pref['sport_league_L_N_logo_menu']==3)
	{$lastgame_text[$JS] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;'>
								<a target='_blank' href='".$GAME[$JS][$i]['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1."".$GAME[$JS][$i]['home_team_name']."'>";
if($pref['sport_league_teamname_menu']==2)
	{$lastgame_text[$JS] .="".$GAME[$JS][$i]['home_team_kurzname']." ";}
else{$lastgame_text[$JS] .="".$GAME[$JS][$i]['home_team_name']." ";}
$lastgame_text[$JS] .="</a>
							</td>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:10%;'>";
if($pref['sport_league_menu_Stats_link']=="0")
	{
	$lastgame_text[$JS] .="<a href='".e_PLUGIN."sport_league_e107/lique_stats.php?team_a=".$GAME[$JS][$i]['game_home_id']."&&team_b=".$GAME[$JS][$i]['game_gast_id']."' title='".LAN_LAST_NEXT_GAME_27."'>
							".LAN_LAST_NEXT_GAME_15."</a>";
	}
else{$lastgame_text[$JS] .=LAN_LAST_NEXT_GAME_15;}		
		
$lastgame_text[$JS] .="</td>
							<td style='vertical-align: middle; text-align:left; background:transparent; width:45%;'>
								<a target='_blank' href='".$GAME[$JS][$i]['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME[$JS][$i]['gast_team_name']."'>";
if($pref['sport_league_teamname_menu']==2)
	{$lastgame_text[$JS] .=" ".$GAME[$JS][$i]['gast_team_kurzname']."";}
else{$lastgame_text[$JS] .=" ".$GAME[$JS][$i]['gast_team_name']."";}
$lastgame_text[$JS] .="</a>
							</td>
						</tr>";
	}
	
if(($GAME[$JS][$i]['gast_my_team'])||($GAME[$JS][$i]['home_my_team']))
	{$GAME[$JS][$i]['my_game']=1;}
else{$GAME[$JS][$i]['my_game']=0;}
if(($pref['sport_league_menu_report_link']==2) || ($GAME[$JS][$i]['my_game']==1))
	{$lastgame_text[$JS] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:right;'>
							<a target='_blank' href='".e_PLUGIN."sport_league_e107/gameinfo.php?game_id=".$GAME[$JS][$i]['game_id']."' title='".LAN_LAST_NEXT_GAME_24."'>
							".$GAME[$JS][$i]['game_goals_home']."</a></td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:10%;font-size:18px;font-weight:bold;text-align:center;'>:</td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:left;'>
							<a target='_blank' href='".e_PLUGIN."sport_league_e107/gameinfo.php?game_id=".$GAME[$JS][$i]['game_id']."' title='".LAN_LAST_NEXT_GAME_24."'>
							".$GAME[$JS][$i]['game_goals_gast']."</a></td></tr>";		
	}
else{	
$lastgame_text[$JS] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:right;'>
							".$GAME[$JS][$i]['game_goals_home']."</td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:10%;font-size:18px;font-weight:bold;text-align:center;'>:</td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:left;'>
							".$GAME[$JS][$i]['game_goals_gast']."</td></tr>";
		}						
if(ADMIN){
	$AD="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_games_config.php?edit.".$GAME[$JS][0]['leagueteam_league_id'].".".$GAME[$JS][0]['game_id']."' title='".LAN_LAST_NEXT_GAME_7."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";
					}else{$AD="";}
$lastgame_text[$JS] .=($GAME[$JS][0]['game_un']) ? "<tr>
							<td style='text-align:center;' colspan='3'> (n.P.) ".$AD."</td></tr>" : "";							
$lastgame_text[$JS] .="</table><br/>";
		}			
if($pref['sport_league_gamesmenu_scroll']=="0")
	{
$lastgame_text[$JS] .="</MARQUEE>";
	}					
 }else
 	{
 	$lastgame_text[$JS] ="<b>".LAN_LAST_NEXT_GAME_26."<br/><br/><br/><br/><br/><br/>".LAN_LAST_NEXT_GAME_23."<b/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
 	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////																				Next Game!!!!
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 	  $menu_lasg_qry="
   	SELECT a.*, ab.*, ac.* FROM ".MPREFIX."league_games AS a
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ab ON ab.leagueteam_id=a.game_home_id
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ac ON ac.leagueteam_id=a.game_gast_id  
   	WHERE a.game_date > ".$A=(time()-86400)." AND ab.leagueteam_league_id='".$SAISON[$JS]['league_id']."' OR a.game_date > ".$A=(time()-86400)." AND ab.leagueteam_league_id='".$SAISON[$JS]['league_id']."' ORDER BY a.game_date LIMIT ".$pref['sport_league_next_games']."
		";
//   	WHERE a.game_date > ".$A=(time()-86400)." AND ab.leagueteam_league_id='".$SAISON[$JS]['league_id']."' AND ab.leagueteam_my_team='1' OR a.game_date > ".$A=(time()-86400)." AND ab.leagueteam_league_id='".$SAISON[$JS]['league_id']."' AND ac.leagueteam_my_team='1' ORDER BY a.game_date LIMIT 1

		$sql->db_Select_gen($menu_lasg_qry);	
	 	$gamecount2[$JS]=0;
	 	while($row = $sql-> db_Fetch())
	 			{
					$GAME2[$gamecount2[$JS]]['game_id']=$row['game_id'];
  				$GAME2[$gamecount2[$JS]]['game_league_id']=$row['game_league_id'];
  				$GAME2[$gamecount2[$JS]]['game_week']=$row['game_week'];
  				$GAME2[$gamecount2[$JS]]['game_date']=$row['game_date'];
 					$GAME2[$gamecount2[$JS]]['game_time']=$row['game_time'];
  				$GAME2[$gamecount2[$JS]]['game_home_id']=$row['game_home_id'];
  				$GAME2[$gamecount2[$JS]]['game_gast_id']=$row['game_gast_id'];
  				$GAME2[$gamecount2[$JS]]['game_goals_home']=$row['game_goals_home'];
  				$GAME2[$gamecount2[$JS]]['game_goals_gast']=$row['game_goals_gast'];
  				$GAME2[$gamecount2[$JS]]['game_un']=$row['game_un'];
  				$GAME2[$gamecount2[$JS]]['game_enable']=$row['game_enable'];
  				if(!$GAME2[$gamecount2[$JS]]['game_enable']){$GAME2[$gamecount2[$JS]]['game_goals_home']="x";$GAME2[$gamecount2[$JS]]['game_goals_gast']="x";}
  				$GAME2[$gamecount2[$JS]]['game_news_id']=$row['game_news_id'];
					$gamecount2[$JS]++;
				}
if($gamecount2[$JS] > 0)
	{
	for($i=0; $i < $gamecount2[$JS]; $i++)
		{
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$GAME2[$i]['game_home_id']."
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();	
		  $GAME2[$i]['home_team_id']=$row['team_id'];       				// Home Mannschaft  ID
      $GAME2[$i]['home_team_icon']=$row['team_icon'];     			// Home Mannschaft  Logo
      $GAME2[$i]['home_team_url']=$row['team_url'];     				// Home Mannschaft  URL
     	$GAME2[$i]['home_team_name']=$row['team_name'];    			// Home Mannschaft  Name
			$GAME2[$i]['home_team_kurzname']=$row['team_kurzname'];  // Home Mannschaft  Name
	  
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$GAME2[$i]['game_gast_id']."
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();	
		  $GAME2[$i]['gast_team_id']=$row['team_id'];       				// Gast Mannschaft  ID
      $GAME2[$i]['gast_team_icon']=$row['team_icon'];     			// Gast Mannschaft  Logo
      $GAME2[$i]['gast_team_url']=$row['team_url'];     				// Gast Mannschaft  URL
     	$GAME2[$i]['gast_team_name']=$row['team_name'];    			// Gast Mannschaft  Name
			$GAME2[$i]['gast_team_kurzname']=$row['team_kurzname'];  // Gast Mannschaft  Name
		}
///////////////////////////////////////////////////////////////////////////////////////////////////////
/// 										Ausgabe Nextgame
///////////////////////////////////////////////////////////////////////////////////////////////////////
$nextgame_text[$JS] .=LAN_LAST_NEXT_GAME_25;

if($pref['sport_league_gamesmenu_scroll']=="0")
	{
$nextgame_text[$JS] .="<MARQUEE border='0' style='' scrollamount='2' scrolldelay='2' DIRECTION='up' align='top' onMouseover='this.scrollAmount=0' onMouseout='this.scrollAmount=2'><center>";
	}
for($i=0; $i < $gamecount2[$JS]; $i++)
	{
$nextgame_text[$JS] .="<table style='width:100%;background:transparent;' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:100%;' colspan='3'>
							am ".strftime("%a %d %b %Y",$GAME2[$i]['game_date'])." um ".strftime("%H:%M",$GAME2[$JS][$i]['game_date'])."
							</td>
						</tr>";
if(($pref['sport_league_L_N_logo_menu']==1) || ($pref['sport_league_L_N_logo_menu']==3))
	{$nextgame_text[$JS] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;'>
								<a target='_blank' href='".$GAME2[$i]['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME2[$i]['home_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$GAME2[$i]['home_team_icon']."' width='50px' height='50px'>
								</a>
							</td>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:10%;'>";
if($pref['sport_league_menu_Stats_link']=="0")
	{
	$nextgame_text[$JS] .="<a href='".e_PLUGIN."sport_league_e107/lique_stats.php?team_a=".$GAME2[$i]['game_home_id']."&&team_b=".$GAME2[$i]['game_gast_id']."' title='".LAN_LAST_NEXT_GAME_27."'>
							".LAN_LAST_NEXT_GAME_14."</a>";
	}
else{$nextgame_text[$JS] .=LAN_LAST_NEXT_GAME_14;}						
$nextgame_text[$JS] .="</td>
							<td style='vertical-align: middle; text-align:left; background:transparent; width:45%;'>
								<a target='_blank' href='".$GAME2[$i]['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME2[$i]['gast_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$GAME2[$i]['gast_team_icon']."' width='50px' height='50px'>
								</a>
							</td>
						</tr>";
	}
if($pref['sport_league_L_N_logo_menu']==2||$pref['sport_league_L_N_logo_menu']==3)
	{$nextgame_text[$JS] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;'>
								<a target='_blank' href='".$GAME2[$i]['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1."".$GAME2[$i]['home_team_name']."'>";
if($pref['sport_league_teamname_menu']==2)
	{$nextgame_text[$JS] .="".$GAME2[$i]['home_team_kurzname']." ";}
else{$nextgame_text[$JS] .="".$GAME2[$i]['home_team_name']." ";}
$nextgame_text[$JS] .="</a>
							</td>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:10%;'>";
if($pref['sport_league_menu_Stats_link']=="0")
	{
	$nextgame_text[$JS] .="<a href='".e_PLUGIN."sport_league_e107/lique_stats.php?team_a=".$GAME2[$i]['game_home_id']."&&team_b=".$GAME2[$i]['game_gast_id']."' title='".LAN_LAST_NEXT_GAME_27."'>
							".LAN_LAST_NEXT_GAME_15."</a>";
	}
else{$nextgame_text[$JS] .=LAN_LAST_NEXT_GAME_15;}		
		
$nextgame_text[$JS] .="</td>
							<td style='vertical-align: middle; text-align:left; background:transparent; width:45%;'>
								<a target='_blank' href='".$GAME2[$i]['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME2[$i]['gast_team_name']."'>";
if($pref['sport_league_teamname_menu']==2)
	{$nextgame_text[$JS] .=" ".$GAME2[$i]['gast_team_kurzname']."";}
else{$nextgame_text[$JS] .=" ".$GAME2[$i]['gast_team_name']."";}
$nextgame_text[$JS] .="</a>
							</td>
						</tr>";
	}
	
if(($GAME2[$i]['gast_my_team'])||($GAME2[$i]['home_my_team']))
	{$GAME2[$i]['my_game']=1;}
else{$GAME2[$i]['my_game']=0;}
if(($pref['sport_league_menu_report_link']==2) || ($GAME2[$i]['my_game']==1))
	{$nextgame_text[$JS] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:right;'>
							<a target='_blank' href='".e_PLUGIN."sport_league_e107/gameinfo.php?game_id=".$GAME2[$i]['game_id']."' title='".LAN_LAST_NEXT_GAME_24."'>
							".$GAME2[$i]['game_goals_home']."</a></td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:10%;font-size:18px;font-weight:bold;text-align:center;'>:</td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:left;'>
							<a target='_blank' href='".e_PLUGIN."sport_league_e107/gameinfo.php?game_id=".$GAME2[$i]['game_id']."' title='".LAN_LAST_NEXT_GAME_24."'>
							".$GAME2[$i]['game_goals_gast']."</a></td></tr>";		
	}
else{	
$nextgame_text[$JS] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:right;'>
							".$GAME2[$i]['game_goals_home']."</td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:10%;font-size:18px;font-weight:bold;text-align:center;'>:</td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:left;'>
							".$GAME2[$i]['game_goals_gast']."</td></tr>";
		}						
if(ADMIN){
	$AD="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_games_config.php?edit.".$GAME[$JS][0]['leagueteam_league_id'].".".$GAME[$JS][0]['game_id']."' title='".LAN_LAST_NEXT_GAME_7."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";
					}else{$AD="";}
$nextgame_text[$JS] .=($GAME[$JS][0]['game_un']) ? "<tr>
							<td style='text-align:center;' colspan='3'> (n.P.) ".$AD."</td></tr>" : "";							
$nextgame_text[$JS] .="</table><br/>";
		}			
if($pref['sport_league_gamesmenu_scroll']=="0")
	{
$nextgame_text[$JS] .="</MARQUEE>";
	}					
 }else
 	{
 	$nextgame_text[$JS] ="<b>".LAN_LAST_NEXT_GAME_8."<b/><br/><br/>";
 	}
////////////////////////////////////////////////////////////////
$ausgabe[$JS] .= "<div style='text-align:center;'><b>";
if(ADMIN){
	$ausgabe[$JS] .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_games_config.php?list.".$GAME[$JS][0]['leagueteam_league_id']."' title='".LAN_LAST_NEXT_GAME_9."'>
						".$SAISON[$JS]['league_name']." (".$SAISON[$JS]['saison_name'].")</a>";
					}	
else{
	$ausgabe[$JS] .= "".$SAISON[$JS]['league_name']." (".$SAISON[$JS]['saison_name'].")";
		}	
$ausgabe[$JS] .= "</b><br/></div>
			<div id='exp_m_lastgame_".$JS."'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>	
						<td class='forumheader' style='text-align:center; width:50%; height: 10px'>
							<div style='cursor:pointer' onclick=\"expandit('exp_m_lastgame_".$JS."'), expandit('exp_m_nextgame_".$JS."')\"><b>".LAN_LAST_NEXT_GAME_26."</b></div>
						</td>
						<td class='forumheader2' style='text-align:center; width:50%; height: 10px'>
							<b>".LAN_LAST_NEXT_GAME_25."</b>
						</td>
					</tr>
				</table>
					<div style='width:100%; text-align:center'><br/>";
$ausgabe[$JS] .=$nextgame_text[$JS];
$ausgabe[$JS] .="</div></div>";
/////////////////////////////////////////////////////////////////
$ausgabe[$JS] .= "<div id='exp_m_nextgame_".$JS."' style='$expand_autohide'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>	
						<td class='forumheader2' style='text-align:center; width:50%; height: 10px'>
							<b>".LAN_LAST_NEXT_GAME_26."</b>
						</td>
						<td class='forumheader' style='text-align:center; width:50%; height: 10px'>
							<div style='cursor:pointer' onclick=\"expandit('exp_m_nextgame_".$JS."'), expandit('exp_m_lastgame_".$JS."')\"><b>".LAN_LAST_NEXT_GAME_25."</b></div>
						</td>
					</tr>
				</table>
					<div style='width:100%; text-align:center'><br/>";
$ausgabe[$JS] .= $lastgame_text[$JS];		
$ausgabe[$JS] .="</div></div>";
//////////////////////////////////////////////////////////////////
	$ausgabe[$JS] .="<div style='width:100%; text-align:center'><a href='".e_PLUGIN."sport_league_e107/lique_games.php'>".LAN_LAST_NEXT_GAME_3."</a><br/></div>";
	if($saisoncount > 1)
		{
		$ausgabe[$JS] .="<div style='width:100%; text-align:center'>-----<br/></div>";
		}
	$text .="<td class='forumheader2'style='width:50%;pading:5px;'>";	
	$text .=$ausgabe[$JS];
	$text .="</td>";	
	}
$text .="</tr></table>";
}
else
{
$text=LAN_LAST_NEXT_GAME_12; ///Keine Date liegen vor oder der Saison nicht ausgewÃƒÂ¤hlt!!!
}
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernÃ¼nftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================		                                                                                                                                                                                                                                                                                   
$title = "<b>".LAN_LAST_NEXT_GAME_13."</b>";
$ns -> tablerender($title, $text);
?>