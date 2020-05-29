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
global $pref;
$text="";
$expand_autohide = "display:none; ";
$LOGO_SIZE="";
if($pref['sport_league_L_N_logo_w_menu']!='')
	{
	$LOGO_SIZE.=" width='".$pref['sport_league_L_N_logo_w_menu']."px'";	
	}
if($pref['sport_league_L_N_logo_h_menu']!='')
	{
	$LOGO_SIZE.=" height='".$pref['sport_league_L_N_logo_h_menu']."px'";	
	}
	
if($pref['sport_league_Menu_wat_logo']==1)
	{$LOGO_PFAD="logos/big/";}
else{
	$LOGO_PFAD="logos";
	}

///++++++++++++++++++++++++++++++++++++++++++++
if($pref['league_last_and_next_ligas']!="")
	{
	$ligas = explode("|", $pref['league_last_and_next_ligas']);
	$ligas_count=count($ligas);
	}

	  $menu_lasg_qry="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagues AS a 
   	LEFT JOIN ".MPREFIX."league_saison AS ae ON ae.saison_id=a.league_saison_id   
   	WHERE a.league_saison_id=".$pref['league_my_saison']."
   			";
$sql->db_Select_gen($menu_lasg_qry);
$saisoncount=0;
if($ligas_count > 1)
	{
	while($row = $sql-> db_Fetch())
	 		{
	 		for($R=0; $R< $ligas_count; $R++ )
	 			{	
	 			if($ligas[$R]==$row['league_id'])
	 				{
					$SAISON_FM[$saisoncount]['league_name']=$row['league_name'];
					$SAISON_FM[$saisoncount]['saison_name']=$row['saison_name'];
					$SAISON_FM[$saisoncount]['saison_id']=$row['saison_id'];
					$SAISON_FM[$saisoncount]['league_id']=$row['league_id'];
					$saisoncount++;
					}
				}
		 }
	}
else{
	while($row = $sql-> db_Fetch())
	 		{
			$SAISON_FM[$saisoncount]['league_name']=$row['league_name'];
			$SAISON_FM[$saisoncount]['saison_name']=$row['saison_name'];
			$SAISON_FM[$saisoncount]['saison_id']=$row['saison_id'];
			$SAISON_FM[$saisoncount]['league_id']=$row['league_id'];
			$saisoncount++;
			}
	}
if($saisoncount > 0)
	{
	for($LC=0; $LC < $saisoncount;$LC++ )
		{
		$LID=$SAISON_FM[$LC]['league_id'];
//////////////////////////////////////////// Last Games  /////////////////////////////////////
 	  $menu_lasg_qry="
   	SELECT a.*, ab.*, ac.* FROM ".MPREFIX."league_games AS a
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ab ON ab.leagueteam_id=a.game_home_id
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ac ON ac.leagueteam_id=a.game_gast_id  
   	WHERE a.game_date < ".(time()-7200)." AND ab.leagueteam_league_id=$LID OR a.game_date < ".(time()-7200)." AND ac.leagueteam_league_id=$LID ORDER BY a.game_date DESC  LIMIT ".$pref['sport_league_last_games']."
		";
		$sql->db_Select_gen($menu_lasg_qry);	
	 	$gamecount[$LC]=0;
	 	while($row = $sql-> db_Fetch())
	 			{
					$GAME[$gamecount[$LC]]['game_id']=$row['game_id'];
  				$GAME[$gamecount[$LC]]['game_league_id']=$row['game_league_id'];
  				$GAME[$gamecount[$LC]]['game_week']=$row['game_week'];
  				$GAME[$gamecount[$LC]]['game_date']=$row['game_date'];
 					$GAME[$gamecount[$LC]]['game_time']=$row['game_time'];
  				$GAME[$gamecount[$LC]]['game_home_id']=$row['game_home_id'];
  				$GAME[$gamecount[$LC]]['game_gast_id']=$row['game_gast_id'];
  				$GAME[$gamecount[$LC]]['game_goals_home']=$row['game_goals_home'];
  				$GAME[$gamecount[$LC]]['game_goals_gast']=$row['game_goals_gast'];
  				$GAME[$gamecount[$LC]]['game_un']=$row['game_un'];
  				$GAME[$gamecount[$LC]]['game_enable']=$row['game_enable'];
  				if(!$GAME[$gamecount[$LC]]['game_enable']){$GAME[$gamecount[$LC]]['game_goals_home']="x";$GAME[$gamecount[$LC]]['game_goals_gast']="x";}
  				$GAME[$gamecount[$LC]]['game_news_id']=$row['game_news_id'];
					$gamecount[$LC]++;
				}
if($gamecount[$LC] > 0)
	{
	for($i=0; $i < $gamecount[$LC]; $i++)
		{
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$GAME[$i]['game_home_id']."
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();	
		  $GAME[$i]['home_team_id']=$row['team_id'];       				// Home Mannschaft  ID
      $GAME[$i]['home_team_icon']=$row['team_icon'];     			// Home Mannschaft  Logo
      $GAME[$i]['home_team_url']=$row['team_url'];     				// Home Mannschaft  URL
     	$GAME[$i]['home_team_name']=$row['team_name'];    			// Home Mannschaft  Name
			$GAME[$i]['home_team_kurzname']=$row['team_kurzname'];  // Home Mannschaft  Name
			$GAME[$i]['leagueteam_league_id']=$row['leagueteam_league_id'];  // leagueteam_league_id  
			$GAME[$i]['home_my_team']=$row['leagueteam_my_team'];  // leagueteam_league_id  
	  
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$GAME[$i]['game_gast_id']."
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();	
		  $GAME[$i]['gast_team_id']=$row['team_id'];       				// Gast Mannschaft  ID
      $GAME[$i]['gast_team_icon']=$row['team_icon'];     			// Gast Mannschaft  Logo
      $GAME[$i]['gast_team_url']=$row['team_url'];     				// Gast Mannschaft  URL
     	$GAME[$i]['gast_team_name']=$row['team_name'];    			// Gast Mannschaft  Name
			$GAME[$i]['gast_team_kurzname']=$row['team_kurzname'];  // Gast Mannschaft  Name	
			$GAME[$i]['gast_my_team']=$row['leagueteam_my_team'];  // leagueteam_league_id  		
		}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$lastgame_text[$LC] =LAN_LAST_NEXT_GAME_24;
if($pref['sport_league_gamesmenu_scroll']=="0")
	{
$lastgame_text[$LC] .="<MARQUEE border='0' style='height:350px;' scrollamount='2' scrolldelay='2' DIRECTION='up' align='top' onMouseover='this.scrollAmount=0' onMouseout='this.scrollAmount=2'><center>";
	}
for($i=0; $i < $gamecount[$LC]; $i++)
	{	
if($pref['sport_league_gamesmenu_my_only']!="")
		{
			if($GAME[$i]['gast_my_team']=='0'&& $GAME[$i]['home_my_team']=='0')
				{
					continue;
				}
		}

$lastgame_text[$LC] .="<table style='width:100%;background:transparent;' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:100%;' colspan='3'>
							am ".strftime("%a %d %b %Y",$GAME[$i]['game_date'])." um ".strftime("%H:%M",$GAME[$i]['game_date'])."
							</td>
						</tr>";
if(($pref['sport_league_L_N_logo_menu']==1) || ($pref['sport_league_L_N_logo_menu']==3) || ($pref['sport_league_L_N_logo_menu']==5))
	{$lastgame_text[$LC] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;'>
								<a target='_blank' href='".$GAME[$i]['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME[$i]['home_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/".$LOGO_PFAD."/".$GAME[$i]['home_team_icon']."' ".$LOGO_SIZE.">
								</a>
							</td>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:10%;'>";
if($pref['sport_league_menu_Stats_link']=="0")
	{
	$lastgame_text[$LC] .="<a href='".e_PLUGIN."sport_league_e107/lique_stats.php?team_a=".$GAME[$i]['game_home_id']."&&team_b=".$GAME[$i]['game_gast_id']."' title='".LAN_LAST_NEXT_GAME_27."'>
							".LAN_LAST_NEXT_GAME_14."</a>";
	}
else{$lastgame_text[$LC] .=LAN_LAST_NEXT_GAME_14;}						
$lastgame_text[$LC] .="</td>
							<td style='vertical-align: middle; text-align:left; background:transparent; width:45%;'>
								<a target='_blank' href='".$GAME[$i]['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME[$i]['gast_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/".$LOGO_PFAD."/".$GAME[$i]['gast_team_icon']."' ".$LOGO_SIZE.">
								</a>
							</td>
						</tr>";
	}
if($pref['sport_league_L_N_logo_menu']!=1){
$lastgame_text[$LC] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;'>
								<a target='_blank' href='".$GAME[$i]['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1."".$GAME[$i]['home_team_name']."'>";
if($pref['sport_league_L_N_logo_menu']>3)
	{$lastgame_text[$LC] .="".$GAME[$i]['home_team_kurzname']."&nbsp;";}
else{$lastgame_text[$LC] .="".$GAME[$i]['home_team_name']."&nbsp;";}
$lastgame_text[$LC] .="</a>
							</td>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:10%;'>";
if($pref['sport_league_menu_Stats_link']=="0")
	{
	$lastgame_text[$LC] .="<a href='".e_PLUGIN."sport_league_e107/lique_stats.php?team_a=".$GAME[$i]['game_home_id']."&&team_b=".$GAME[$i]['game_gast_id']."' title='".LAN_LAST_NEXT_GAME_27."'>
							".LAN_LAST_NEXT_GAME_15."</a>";
	}
else{$lastgame_text[$LC] .=LAN_LAST_NEXT_GAME_15;}		
		
$lastgame_text[$LC] .="</td>
							<td style='vertical-align: middle; text-align:left; background:transparent; width:45%;'>
								<a target='_blank' href='".$GAME[$i]['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME[$i]['gast_team_name']."'>";
if($pref['sport_league_L_N_logo_menu']>3)
	{$lastgame_text[$LC] .="&nbsp;".$GAME[$i]['gast_team_kurzname']."";}
else{$lastgame_text[$LC] .="&nbsp;".$GAME[$i]['gast_team_name']."";}
$lastgame_text[$LC] .="</a>
							</td>
						</tr>";
	}
if(($GAME[$i]['gast_my_team'])||($GAME[$i]['home_my_team']))
	{$GAME[$i]['my_game']=1;}
else{$GAME[$i]['my_game']=0;}
if(($pref['sport_league_menu_report_link']==2) || ($GAME[$i]['my_game']==1))
	{$lastgame_text[$LC] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:right;'>
							<a target='_blank' href='".e_PLUGIN."sport_league_e107/game_report.php?game_id=".$GAME[$i]['game_id']."' title='".LAN_LAST_NEXT_GAME_26."'>
							".$GAME[$i]['game_goals_home']."</a></td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:10%;font-size:18px;font-weight:bold;text-align:center;'>:</td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:left;'>
							<a target='_blank' href='".e_PLUGIN."sport_league_e107/game_report.php?game_id=".$GAME[$i]['game_id']."' title='".LAN_LAST_NEXT_GAME_26."'>
							".$GAME[$i]['game_goals_gast']."</a></td></tr>";		
	}
else{	
$lastgame_text[$LC] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:right;'>
							".$GAME[$i]['game_goals_home']."</td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:10%;font-size:18px;font-weight:bold;text-align:center;'>:</td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:left;'>
							".$GAME[$i]['game_goals_gast']."</td></tr>";
		}						
if(ADMIN){
	$AD="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_games_config.php?edit.".$GAME[$i]['leagueteam_league_id'].".".$GAME[$i]['game_id']."' title='".LAN_LAST_NEXT_GAME_7."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";
					}else{$AD="";}
$lastgame_text[$LC] .=($GAME[$i]['game_un']) ? "<tr>
							<td style='text-align:center;' colspan='3'> (n.P.) ".$AD."</td></tr>" : "";							
$lastgame_text[$LC] .="</table><br/>";
		}			
if($pref['sport_league_gamesmenu_scroll']=="0")
	{
$lastgame_text[$LC] .="</MARQUEE>";
	}					
 }else
 	{
 	$lastgame_text[$LC] ="<b>".LAN_LAST_NEXT_GAME_23."<b/><br/><br/>";
 	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////																				Next Game!!!!
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 	  $menu_lasg_qry="
   	SELECT a.*, ab.*, ac.* FROM ".MPREFIX."league_games AS a
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ab ON ab.leagueteam_id=a.game_home_id
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ac ON ac.leagueteam_id=a.game_gast_id  
   	WHERE a.game_date > '".(time()-7200)."' AND ab.leagueteam_league_id='".$SAISON_FM[$LC]['league_id']."' OR a.game_date > '".(time()-7200)."' AND ab.leagueteam_league_id='".$SAISON_FM[$LC]['league_id']."' ORDER BY a.game_date LIMIT ".$pref['sport_league_last_games']."
		";
		$sql->db_Select_gen($menu_lasg_qry);	
	 	$gamecount2[$LC]=0;
	 	while($row = $sql-> db_Fetch())
	 			{
					$GAME2[$gamecount2[$LC]]['game_id']=$row['game_id'];
  				$GAME2[$gamecount2[$LC]]['game_league_id']=$row['game_league_id'];
  				$GAME2[$gamecount2[$LC]]['game_week']=$row['game_week'];
  				$GAME2[$gamecount2[$LC]]['game_date']=$row['game_date'];
 					$GAME2[$gamecount2[$LC]]['game_time']=$row['game_time'];
  				$GAME2[$gamecount2[$LC]]['game_home_id']=$row['game_home_id'];
  				$GAME2[$gamecount2[$LC]]['game_gast_id']=$row['game_gast_id'];
  				$GAME2[$gamecount2[$LC]]['game_goals_home']=$row['game_goals_home'];
  				$GAME2[$gamecount2[$LC]]['game_goals_gast']=$row['game_goals_gast'];
  				$GAME2[$gamecount2[$LC]]['game_un']=$row['game_un'];
  				$GAME2[$gamecount2[$LC]]['game_enable']=$row['game_enable'];
  				if(!$GAME2[$gamecount2[$LC]]['game_enable']){$GAME2[$gamecount2[$LC]]['game_goals_home']="x";$GAME2[$gamecount2[$LC]]['game_goals_gast']="x";}
  				$GAME2[$gamecount2[$LC]]['game_news_id']=$row['game_news_id'];
					$gamecount2[$LC]++;
				}
if($gamecount2[$LC] > 0)
	{
	for($i=0; $i < $gamecount2[$LC]; $i++)
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
			$GAME2[$i]['home_my_team']=$row['leagueteam_my_team']; 
	  
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
			$GAME2[$i]['gast_my_team']=$row['leagueteam_my_team'];  // leagueteam_league_id  	
		}
///////////////////////////////////////////////////////////////////////////////////////////////////////
/// 										Ausgabe Nextgame
///////////////////////////////////////////////////////////////////////////////////////////////////////
$nextgame_text[$LC] .=LAN_LAST_NEXT_GAME_25;

if($pref['sport_league_gamesmenu_scroll']=="0")
	{
	$nextgame_text[$LC] .="<MARQUEE border='0' style='height:350px;' scrollamount='2' scrolldelay='2' DIRECTION='up' align='top' onMouseover='this.scrollAmount=0' onMouseout='this.scrollAmount=2'><center>";
	}
for($i=0; $i < $gamecount2[$LC]; $i++)
	{
if($pref['sport_league_gamesmenu_my_only']=='0')
		{
			if($GAME2[$i]['gast_my_team']=='0'&& $GAME2[$i]['home_my_team']=='0')
				{
					continue;
				}
		}		

$nextgame_text[$LC] .="<table style='width:100%;background:transparent;' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:100%;' colspan='3'>
							am ".strftime("%a %d %b %Y",$GAME2[$i]['game_date'])." um ".strftime("%H:%M",$GAME2[$i]['game_date'])."
							</td>
						</tr>";
if(($pref['sport_league_L_N_logo_menu']==1) || ($pref['sport_league_L_N_logo_menu']==3) || ($pref['sport_league_L_N_logo_menu']==5))
	{$nextgame_text[$LC] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;'>
								<a target='_blank' href='".$GAME2[$i]['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME2[$i]['home_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/".$LOGO_PFAD."/".$GAME2[$i]['home_team_icon']."' ".$LOGO_SIZE.">
								</a>
							</td>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:10%;'>";
if($pref['sport_league_menu_Stats_link']=="0")
	{
	$nextgame_text[$LC] .="<a href='".e_PLUGIN."sport_league_e107/lique_stats.php?team_a=".$GAME2[$i]['game_home_id']."&&team_b=".$GAME2[$i]['game_gast_id']."' title='".LAN_LAST_NEXT_GAME_27."'>
							".LAN_LAST_NEXT_GAME_14."</a>";
	}
else{$nextgame_text[$LC] .=LAN_LAST_NEXT_GAME_14;}						
$nextgame_text[$LC] .="</td>
							<td style='vertical-align: middle; text-align:left; background:transparent; width:45%;'>
								<a target='_blank' href='".$GAME2[$i]['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME2[$i]['gast_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/".$LOGO_PFAD."/".$GAME2[$i]['gast_team_icon']."' ".$LOGO_SIZE.">
								</a>
							</td>
						</tr>";
	}
if($pref['sport_league_L_N_logo_menu']!=1){
$nextgame_text[$LC] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;'>
								<a target='_blank' href='".$GAME2[$i]['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1."".$GAME2[$i]['home_team_name']."'>";
if($pref['sport_league_L_N_logo_menu']>3)
	{$nextgame_text[$LC] .="".$GAME2[$i]['home_team_kurzname']."&nbsp;";}
else{$nextgame_text[$LC] .="".$GAME2[$i]['home_team_name']."&nbsp;";}
$nextgame_text[$LC] .="</a>
							</td>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:10%;'>";
if($pref['sport_league_menu_Stats_link']=="0")
	{
	$nextgame_text[$LC] .="<a href='".e_PLUGIN."sport_league_e107/lique_stats.php?team_a=".$GAME2[$i]['game_home_id']."&&team_b=".$GAME2[$i]['game_gast_id']."' title='".LAN_LAST_NEXT_GAME_27."'>
							".LAN_LAST_NEXT_GAME_15."</a>";
	}
else{$nextgame_text[$LC] .=LAN_LAST_NEXT_GAME_15;}				
$nextgame_text[$LC] .="</td>
							<td style='vertical-align: middle; text-align:left; background:transparent; width:45%;'>
								<a target='_blank' href='".$GAME2[$i]['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME2[$i]['gast_team_name']."'>";
if($pref['sport_league_L_N_logo_menu']>3)
	{$nextgame_text[$LC] .="&nbsp;".$GAME2[$i]['gast_team_kurzname']."";}
else{$nextgame_text[$LC] .="&nbsp;".$GAME2[$i]['gast_team_name']."";}
$nextgame_text[$LC] .="</a>
							</td>
						</tr>";
}
	
if(($GAME2[$i]['gast_my_team'])||($GAME2[$i]['home_my_team']))
	{$GAME2[$i]['my_game']=1;}
else{$GAME2[$i]['my_game']=0;}
if(($pref['sport_league_menu_report_link']==2) || ($GAME2[$i]['my_game']==1))
	{$nextgame_text[$LC] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:right;'>
							<a target='_blank' href='".e_PLUGIN."sport_league_e107/game_report.php?game_id=".$GAME2[$i]['game_id']."' title='".LAN_LAST_NEXT_GAME_26."'>
							".$GAME2[$i]['game_goals_home']."</a></td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:10%;font-size:18px;font-weight:bold;text-align:center;'>:</td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:left;'>
							<a target='_blank' href='".e_PLUGIN."sport_league_e107/game_report.php?game_id=".$GAME2[$i]['game_id']."' title='".LAN_LAST_NEXT_GAME_26."'>
							".$GAME2[$i]['game_goals_gast']."</a></td></tr>";		
	}
else{	
$nextgame_text[$LC] .="
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:right;'>
							".$GAME2[$i]['game_goals_home']."</td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:10%;font-size:18px;font-weight:bold;text-align:center;'>:</td>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;font-size:18px;font-weight:bold;text-align:left;'>
							".$GAME2[$i]['game_goals_gast']."</td></tr>";
		}						
if(ADMIN){
	$AD="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_games_config.php?edit.".$GAME2[$i]['leagueteam_league_id'].".".$GAME[$i]['game_id']."' title='".LAN_LAST_NEXT_GAME_7."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";
					}else{$AD="";}
$nextgame_text[$LC] .=($GAME2[$i]['game_un']) ? "<tr>
							<td style='text-align:center;' colspan='3'> (n.P.) ".$AD."</td></tr>" : "";							
$nextgame_text[$LC] .="</table><br/>";
		}			
if($pref['sport_league_gamesmenu_scroll']=="0")
	{
$nextgame_text[$LC] .="</MARQUEE>";
	}					
 }else
 	{
 	$nextgame_text[$LC] ="<b>".LAN_LAST_NEXT_GAME_8."<b/><br/><br/>";
 	}
////////////////////////////////////////////////////////////////
$ausgabe[$LC] .= "<div style='text-align:center;'><b>";
if(ADMIN){
	$ausgabe[$LC] .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_games_config.php?list.".$GAME[$i]['leagueteam_league_id']."' title='".LAN_LAST_NEXT_GAME_9."'>
						".$SAISON_FM[$LC]['league_name']." (".$SAISON_FM[$LC]['saison_name'].")</a>";
					}	
else{
	$ausgabe[$LC] .= "".$SAISON_FM[$LC]['league_name']." (".$SAISON_FM[$LC]['saison_name'].")";
		}
		
if($pref['sport_league_next_games']==1)
	{
	$NEXT_WYSIBLE="";
	$LAST_WYSIBLE="style='$expand_autohide'";	
	}
else
	{
	$NEXT_WYSIBLE="style='$expand_autohide'";
	$LAST_WYSIBLE="";	
	}
		
$ausgabe[$LC] .= "</b><br/></div>
			<div id='exp_m_lastgame_".$LC."' ".$NEXT_WYSIBLE.">
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>	
						<td class='forumheader' style='text-align:center; width:50%; height: 10px'>
							<div style='cursor:pointer' onclick=\"expandit('exp_m_lastgame_".$LC."'), expandit('exp_m_nextgame_".$LC."')\"><b>".LAN_LAST_NEXT_GAME_10."</b></div>
						</td>
						<td class='forumheader2' style='text-align:center; width:50%; height: 10px'>
							<b>".LAN_LAST_NEXT_GAME_11."</b>
						</td>
					</tr>
				</table>
					<div style='width:100%; text-align:center'><br/>";
$ausgabe[$LC] .=$lastgame_text[$LC];
$ausgabe[$LC] .="</div></div>";
/////////////////////////////////////////////////////////////////
$ausgabe[$LC] .= "<div id='exp_m_nextgame_".$LC."' ".$LAST_WYSIBLE.">
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>	
						<td class='forumheader2' style='text-align:center; width:50%; height: 10px'>
							<b>".LAN_LAST_NEXT_GAME_10."</b>
						</td>
						<td class='forumheader' style='text-align:center; width:50%; height: 10px'>
							<div style='cursor:pointer' onclick=\"expandit('exp_m_nextgame_".$LC."'), expandit('exp_m_lastgame_".$LC."')\"><b>".LAN_LAST_NEXT_GAME_11."</b></div>
						</td>
					</tr>
				</table>
					<div style='width:100%; text-align:center'><br/>";
$ausgabe[$LC] .= $nextgame_text[$LC];		
$ausgabe[$LC] .="</div></div>";
//////////////////////////////////////////////////////////////////
	$ausgabe[$LC] .="<div style='width:100%; text-align:center'><a href='".e_PLUGIN."sport_league_e107/league_games.php?Liga=".$SAISON_FM[$LC]['league_id']."'>".LAN_LAST_NEXT_GAME_3."</a><br/></div>";
	if($saisoncount > 1)
		{
		$ausgabe[$LC] .="<div style='width:100%; text-align:center'>-----<br/></div>";
		}
	$text .=$ausgabe[$LC];
	}
}
else
{
$text=LAN_LAST_NEXT_GAME_12; ///Keine Date liegen vor oder der Saison nicht ausgewÃƒÂ¤hlt!!!
}			                                                                                                                                                                                                                                                                                   
$title = "<b>".LAN_LAST_NEXT_GAME_13."</b>";
$ns -> tablerender($title, $text);
?>