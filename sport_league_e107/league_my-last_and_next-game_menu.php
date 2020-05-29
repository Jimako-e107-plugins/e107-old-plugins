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
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/last_next_menu_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/last_next_menu_lan.php");
require_once(e_PLUGIN."sport_league_e107/functionen.php");
$text="";
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
   	WHERE a.game_date < ".(time()-7200)." AND ab.leagueteam_league_id='".$SAISON[$JS]['league_id']."' AND ab.leagueteam_my_team='1' OR a.game_date < ".(time()-7200)." AND ac.leagueteam_league_id='".$SAISON[$JS]['league_id']."' AND ac.leagueteam_my_team='1' ORDER BY a.game_date DESC  LIMIT 1
		";
		$sql->db_Select_gen($menu_lasg_qry);	
		
	 	$gamecount=0;
	 	while($row = $sql-> db_Fetch())
	 			{
					$GAME['game_id']=$row['game_id'];
  				$GAME['game_league_id']=$row['game_league_id'];
  				$GAME['game_week']=$row['game_week'];
  				$GAME['game_date']=$row['game_date'];
 					$GAME['game_time']=$row['game_time'];
  				$GAME['game_home_id']=$row['game_home_id'];
  				$GAME['game_gast_id']=$row['game_gast_id'];
  				$GAME['game_goals_home']=$row['game_goals_home'];
  				$GAME['game_goals_gast']=$row['game_goals_gast'];
  				$GAME['game_un']=$row['game_un'];
  				$GAME['game_enable']=$row['game_enable'];
  				$GAME['game_news_id']=$row['game_news_id'];
					$gamecount++;
				}
if($gamecount > 0)
	{
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$GAME['game_home_id']."
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();	
		  $GAME['home_team_id']=$row['team_id'];       				// Home Mannschaft  ID
      $GAME['home_team_icon']=$row['team_icon'];     			// Home Mannschaft  Logo
      $GAME['home_team_url']=$row['team_url'];     				// Home Mannschaft  URL
     	$GAME['home_team_name']=$row['team_name'];    			// Home Mannschaft  Name
			$GAME['home_team_kurzname']=$row['team_kurzname'];  // Home Mannschaft  Name
			$GAME['leagueteam_league_id']=$row['leagueteam_league_id'];  // leagueteam_league_id

	  
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$GAME['game_gast_id']."
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();	
		  $GAME['gast_team_id']=$row['team_id'];       				// Gast Mannschaft  ID
      $GAME['gast_team_icon']=$row['team_icon'];     			// Gast Mannschaft  Logo
      $GAME['gast_team_url']=$row['team_url'];     				// Gast Mannschaft  URL
     	$GAME['gast_team_name']=$row['team_name'];    			// Gast Mannschaft  Name
			$GAME['gast_team_kurzname']=$row['team_kurzname'];  // Gast Mannschaft  Name			

		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$lastgame_text ="<b>".LAN_LAST_NEXT_GAME_18."</b> 
<table style='width:100%;background:transparent;' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;'>
								<a target='_blank' href='".$GAME['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME['home_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$GAME['home_team_icon']."' width='100'>
								</a>
							</td>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:10%;'><a href='".e_PLUGIN."sport_league_e107/game_report.php?game_id=".$GAME['game_id']."' title=''>".LAN_LAST_NEXT_GAME_15."</a>

							</td>
							<td style='vertical-align: middle; text-align:left; background:transparent; width:45%;'>
								<a target='_blank' href='".$GAME['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME['gast_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$GAME['gast_team_icon']."' width='100'>
								</a>
							</td>
						</tr>
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;'>
								<a target='_blank' href='".$GAME['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME['home_team_name']."'>
									".$GAME['home_team_name']."
								</a>
							</td>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:10%;'><a href='".e_PLUGIN."sport_league_e107/game_report.php?game_id=".$GAME['game_id']."' title=''>".LAN_LAST_NEXT_GAME_15."</a>
							</td>
							<td style='vertical-align: middle; text-align:left; background:transparent; width:45%;'>
								<a target='_blank' href='".$GAME['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME['gast_team_name']."'>
									".$GAME['gast_team_name']."
								</a>
							</td>
						</tr>
					</table><br/><b>".LAN_LAST_NEXT_GAME_4." ";
$lastgame_text .=($GAME['game_un']) ? LAN_LAST_NEXT_GAME_5 : LAN_LAST_NEXT_GAME_6;
if(ADMIN){
	$lastgame_text .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_games_config.php?edit.".$GAME['leagueteam_league_id'].".".$GAME['game_id']."' title='".LAN_LAST_NEXT_GAME_7."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";
					}

$lastgame_text .="<b/>";
$lastgame_text .="	<table style='width:100%;background:transparent;' cellspacing='0' cellpadding='0'>
						<tr>
							<td class='fcaption' colspan='2'> <b>".strftime("%a %d %b %Y",$GAME['game_date'])."</b> ".LAN_LAST_NEXT_GAME_2." <b>".strftime("%H:%M",$GAME['game_date'])."</b>
							</td>
							<td class='fcaption' style='border-left:0px;width:6%;vertical-align:middle;text-align:center;'>1
							</td>";
					if($pref['sport_league_periods']>1){
							$lastgame_text .="<td class='fcaption' style='border-left:0px;width:6%;vertical-align:middle;text-align:center;'>2
							</td>";}
					if($pref['sport_league_periods']>2){
							$lastgame_text .="<td class='fcaption' style='border-left:0px;width:6%;vertical-align:middle;text-align:center;'>3
							</td>";}
							$lastgame_text .="<td class='fcaption' style='border-left:0px;width:6%;vertical-align:middle;text-align:center;'>".LAN_LAST_NEXT_GAME_16."
							</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width:10%;vertical-align: middle; text-align:center;border-top:0px;'>
								<a target='_blank' href='".$GAME['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME['home_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$GAME['home_team_icon']."' height='20px'>
								</a>
							</td>
							<td class='forumheader3' style='width:62%;vertical-align: middle; text-align:left;border-top:0px;border-left:0px;font-weight: bold;'>
								<div style='cursor:pointer' onclick=\"expandit('exp_home')\">".$GAME['home_team_name']."</div>
									<div id='exp_home' style='".$expand_autohide."'>";								
		$lastgame_text .=team_links($GAME['game_home_id'],$GAME['home_team_name'], $GAME['game_league_id'], $GAME['home_team_url']); 
		$lastgame_text .="</div>
								</td>
							<td class='forumheader3' style='width:6%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>".goals_zaehlen($GAME['game_id'],$GAME['game_home_id'],"1")."
							</td>";
				if($pref['sport_league_periods']>1){
							$lastgame_text .="<td class='forumheader3' style='width:6%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>".goals_zaehlen($GAME['game_id'],$GAME['game_home_id'],"2")."
							</td>";}
				if($pref['sport_league_periods']>2){
							$lastgame_text .="<td class='forumheader3' style='width:6%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>".goals_zaehlen($GAME['game_id'],$GAME['game_home_id'],"3")."
							</td>";}
							$lastgame_text .="<td class='forumheader' style='width:10%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>".$GAME['game_goals_home']."
							</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width:10%;vertical-align: middle; text-align:center;border-top:0px;'>
								<a target='_blank' href='".$GAME['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME['gast_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$GAME['gast_team_icon']."' height='20px'>
								</a>
							</td>
							<td class='forumheader3' style='width:62%;vertical-align: middle; text-align:left;border-top:0px;border-left:0px;font-weight: bold;'>
								<div style='cursor:pointer' onclick=\"expandit('exp_gast')\">".$GAME['gast_team_name']."</div>
									<div id='exp_gast' style='".$expand_autohide."'>";								
		$lastgame_text .=team_links($GAME['game_gast_id'],$GAME['gast_team_name'], $GAME['game_league_id'], $GAME['gast_team_url']); 
		$lastgame_text .="</div>
							</td>
							<td class='forumheader3' style='width:6%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>".goals_zaehlen($GAME['game_id'],$GAME['game_gast_id'],"1")."
							</td>";
							if($pref['sport_league_periods']>1){
							$lastgame_text .="<td class='forumheader3' style='width:6%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>".goals_zaehlen($GAME['game_id'],$GAME['game_gast_id'],"2")."
							</td>";}
							if($pref['sport_league_periods']>2){
							$lastgame_text .="<td class='forumheader3' style='width:6%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>".goals_zaehlen($GAME['game_id'],$GAME['game_gast_id'],"3")."
							</td>";}
							$lastgame_text .="<td class='forumheader' style='width:10%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>".$GAME['game_goals_gast']."
							</td>
						</tr>
					</table>";
 }else
 	{
 	$lastgame_text ="<b>".LAN_LAST_NEXT_GAME_18."<br/><br/><br/><br/>".LAN_LAST_NEXT_GAME_23."<b/><br/><br/><br/><br/><br/>";
 	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////																				Next Game!!!!
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 	  $menu_lasg_qry="
   	SELECT a.*, ab.*, ac.* FROM ".MPREFIX."league_games AS a
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ab ON ab.leagueteam_id=a.game_home_id
   	LEFT JOIN ".MPREFIX."league_leagueteams AS ac ON ac.leagueteam_id=a.game_gast_id  
   	WHERE a.game_date > ".time()." AND ab.leagueteam_league_id='".$SAISON[$JS]['league_id']."' AND ab.leagueteam_my_team='1' OR a.game_date > ".time()." AND ab.leagueteam_league_id='".$SAISON[$JS]['league_id']."' AND ac.leagueteam_my_team='1' ORDER BY a.game_date LIMIT 1
		";
		$sql->db_Select_gen($menu_lasg_qry);	
	 	$gamecount2=0;
	 	while($row = $sql-> db_Fetch())
	 			{
					$GAME2['game_id']=$row['game_id'];
  				$GAME2['game_league_id']=$row['game_league_id'];
  				$GAME2['game_week']=$row['game_week'];
  				$GAME2['game_date']=$row['game_date'];
 					$GAME2['game_time']=$row['game_time'];
  				$GAME2['game_home_id']=$row['game_home_id'];
  				$GAME2['game_gast_id']=$row['game_gast_id'];
  				$GAME2['game_goals_home']=$row['game_goals_home'];
  				$GAME2['game_goals_gast']=$row['game_goals_gast'];
  				$GAME2['game_un']=$row['game_un'];
  				$GAME2['game_enable']=$row['game_enable'];
  				$GAME2['game_news_id']=$row['game_news_id'];
					$gamecount2++;
				}
if($gamecount2 > 0)
	{
	for($i=0; $i < $gamecount2; $i++)
		{
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$GAME2['game_home_id']."
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();	
		  $GAME2['home_team_id']=$row['team_id'];       				// Home Mannschaft  ID
      $GAME2['home_team_icon']=$row['team_icon'];     			// Home Mannschaft  Logo
      $GAME2['home_team_url']=$row['team_url'];     				// Home Mannschaft  URL
     	$GAME2['home_team_name']=$row['team_name'];    			// Home Mannschaft  Name
			$GAME2['home_team_kurzname']=$row['team_kurzname'];  // Home Mannschaft  Name
	  	$GAME2['leagueteam_league_id']=$row['leagueteam_league_id'];  // leagueteam_league_id 
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_id =".$GAME2['game_gast_id']."
   			";
		$sql->db_Select_gen($qry1);
  	$row = $sql-> db_Fetch();	
		  $GAME2['gast_team_id']=$row['team_id'];       				// Gast Mannschaft  ID
      $GAME2['gast_team_icon']=$row['team_icon'];     			// Gast Mannschaft  Logo
      $GAME2['gast_team_url']=$row['team_url'];     				// Gast Mannschaft  URL
     	$GAME2['gast_team_name']=$row['team_name'];    			// Gast Mannschaft  Name
			$GAME2['gast_team_kurzname']=$row['team_kurzname'];  // Gast Mannschaft  Name
		}
///////////////////////////////////////////////////////////////////////////////////////////////////////
/// 										Ausgabe Nextgame
///////////////////////////////////////////////////////////////////////////////////////////////////////
$nextgame_text ="<b>".LAN_LAST_NEXT_GAME_17."<b/>
					<table style='width:100%;background:transparent;' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;'>
								<a target='_blank' href='".$GAME2['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME2['home_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$GAME2['home_team_icon']."' width='100'>
								</a>
							</td>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:10%;'><a href='".e_PLUGIN."sport_league_e107/league_stats.php?team_a=".$GAME2['game_home_id']."&&team_b=".$GAME2['game_gast_id']."' title='Mannschaften vergleichen'><=></a>";					
if(ADMIN){
	$nextgame_text .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_games_config.php?edit.".$GAME2['leagueteam_league_id'].".".$GAME2['game_id']."' title='".LAN_LAST_NEXT_GAME_7."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png'></a>";
					}					
else{$nextgame_text .="<br/>";}										
$nextgame_text .="</td>
							<td style='vertical-align: middle; text-align:left; background:transparent; width:45%;'>
								<a target='_blank' href='".$GAME2['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME2['gast_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$GAME2['gast_team_icon']."' width='100'>
								</a>
							</td>
						</tr>
						<tr>
							<td style='vertical-align:middle;text-align:right;background:transparent;width:45%;'>
								<a target='_blank' href='".$GAME2['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME2['home_team_name']."'>
									".$GAME2['home_team_name']."
								</a>
							</td>
							<td style='vertical-align:middle;text-align:center;background:transparent;width:10%;'><a href='".e_PLUGIN."sport_league_e107/league_global_stats.php?team_a=".$GAME2['game_home_id']."&&team_b=".$GAME2['game_gast_id']."' title='Mannschaften vergleichen'>".LAN_LAST_NEXT_GAME_15."</a>
							</td>
							<td style='vertical-align: middle; text-align:left; background:transparent; width:45%;'>
								<a target='_blank' href='".$GAME2['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME2['gast_team_name']."'>
									".$GAME2['gast_team_name']."
								</a>
							</td>
						</tr>
					</table><br/><br/>";		
$nextgame_text .="	<table style='width:100%;background:transparent;' cellspacing='0' cellpadding='0'>
						<tr>
							<td class='fcaption' colspan='2'> <b>".strftime("%a %d %b %Y",$GAME2['game_date'])."</b> ".LAN_LAST_NEXT_GAME_2." <b>".strftime("%H:%M",$GAME2['game_date'])."</b>
							</td>
							<td class='fcaption' style='width:6%;vertical-align: middle; text-align:center;border-left:0px;'>Sp.
							</td>
							<td class='fcaption' style='width:6%;vertical-align: middle; text-align:center;border-left:0px;'>S.
							</td>
							<td class='fcaption' style='width:6%;vertical-align: middle; text-align:center;border-left:0px;'>N.
							</td>
							<td class='fcaption' style='width:10%;vertical-align: middle; text-align:center;border-left:0px;'>P.
							</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width:10%;vertical-align: middle; text-align:center;border-top:0px;'>
								<a target='_blank' href='".$GAME2['home_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME2['home_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$GAME2['home_team_icon']."' height='20px'>
								</a>
							</td>
							<td class='forumheader3' style='width:62%;vertical-align: middle; text-align:left;border-top:0px;border-left:0px;font-weight: bold;'>
								<div style='cursor:pointer' onclick=\"expandit('exp_hom2')\">".$GAME2['home_team_name']."</div>
									<div id='exp_hom2' style='".$expand_autohide."'>";								
		$nextgame_text .=team_links($GAME2['game_home_id'],$GAME2['home_team_name'], $GAME2['game_league_id'],$GAME2['home_team_url']); 
		$nextgame_text .="</div>
							</td>
							<td class='forumheader3' style='width:6%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>";
		$nextgame_text .=zaehlen($GAME2['game_home_id'],"games");
		$nextgame_text .="</td>
							<td class='forumheader3' style='width:6%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>";
		$nextgame_text .=zaehlen($GAME2['game_home_id'],"win");
		$nextgame_text .="</td>
							<td class='forumheader3' style='width:6%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>";
		$nextgame_text .=zaehlen($GAME2['game_home_id'],"lost");
		$nextgame_text .="</td>
							<td class='forumheader' style='width:10%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>";
		$nextgame_text .=zaehlen($GAME2['game_home_id'],"points");
		$nextgame_text .="</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width:10%;vertical-align: middle; text-align:center;border-top:0px;'>
								<a target='_blank' href='".$GAME2['gast_team_url']."' title='".LAN_LAST_NEXT_GAME_1." ".$GAME2['gast_team_name']."'>
									<img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$GAME2['gast_team_icon']."' height='20px'>
								</a>
							</td>
							<td class='forumheader3' style='width:62%;vertical-align: middle; text-align:left;border-top:0px;border-left:0px;font-weight: bold;'>
								<div style='cursor:pointer' onclick=\"expandit('exp_gast2')\">".$GAME2['gast_team_name']."</div>
									<div id='exp_gast2' style='".$expand_autohide."'>";								
		$nextgame_text .=team_links($GAME2['game_gast_id'],$GAME2['gast_team_name'], $GAME2['game_league_id'],$GAME2['gast_team_url']); 
		$nextgame_text .="</div>
							</td>
							<td class='forumheader3' style='width:6%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>";
$nextgame_text .=zaehlen($GAME2['game_gast_id'],"games");
$nextgame_text .="</td>
							<td class='forumheader3' style='width:6%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>";
$nextgame_text .=zaehlen($GAME2['game_gast_id'],"win");
$nextgame_text .="</td>
							<td class='forumheader3' style='width:6%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>";
$nextgame_text .=zaehlen($GAME2['game_gast_id'],"lost");
$nextgame_text .="</td>
							<td class='forumheader' style='width:10%;vertical-align: middle; text-align:center;border-top:0px;border-left:0px;'>";
$nextgame_text .=zaehlen($GAME2['game_gast_id'],"points");
$nextgame_text .="</td>
						</tr>
					</table>";	
////////////////////////////////////////////////////////////////////////////////////////////////////////
}else
	{
$nextgame_text ="<b>".LAN_LAST_NEXT_GAME_8."<b/><br/><br/>";
	}
if($gamecount  > 0 || $gamecount2 > 0)
	{
	$text .= "<div style='text-align:center;'><b>";
	if(ADMIN){
	$text .="<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_games_config.php?list.".$GAME['leagueteam_league_id']."' title='".LAN_LAST_NEXT_GAME_9."'>
						".$SAISON[$JS]['league_name']." (".$SAISON[$JS]['saison_name'].")</a>";
					}	
	else{
		$text .= "".$SAISON[$JS]['league_name']." (".$SAISON[$JS]['saison_name'].")";
		}	
////////////////////////////////////////////////
if($pref['sport_league_my_last_or_next']=="0")
	{$LG=time()-$GAME['game_date'];$LG=$LG*$LG;
	 $NG=time()-$GAME2['game_date'];$NG=$NG*$NG;
	if($NG > $LG){
		$expand_autohide1 = "display:none; ";
		$expand_autohide2 = "";
		}
	else{
		$expand_autohide1 = "";
		$expand_autohide2 = "display:none; ";
		}
	}
else{$expand_autohide1 = "display:none; ";$expand_autohide2 = "";}
///////////////////////////////////////////////////////
	$text .= "</b><br/></div>
			<div id='exp_lastgame_".$JS."' style='$expand_autohide1'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>	
						<td class='forumheader' style='text-align:center; width:50%; height: 10px'>
							<div style='cursor:pointer' onclick=\"expandit('exp_lastgame_".$JS."'), expandit('exp_nextgame_".$JS."')\"><b>".LAN_LAST_NEXT_GAME_11."</b></div>
						</td>
						<td class='forumheader2' style='text-align:center; width:50%; height: 10px'>
							<b>".LAN_LAST_NEXT_GAME_10."</b>
						</td>
					</tr>
				</table>
					<div style='width:100%; text-align:center'><br/>";
$text .=$nextgame_text;//lastgame_text
$text .="</div></div>";
/////////////////////////////////////////////////////////////////
$text .= "<div id='exp_nextgame_".$JS."' style='$expand_autohide2'>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>	
						<td class='forumheader2' style='text-align:center; width:50%; height: 10px'>
							<b>".LAN_LAST_NEXT_GAME_11."</b>
						</td>
						<td class='forumheader' style='text-align:center; width:50%; height: 10px'>
							<div style='cursor:pointer' onclick=\"expandit('exp_nextgame_".$JS."'), expandit('exp_lastgame_".$JS."')\"><b>".LAN_LAST_NEXT_GAME_10."</b></div>
						</td>
					</tr>
				</table>
					<div style='width:100%; text-align:center'><br/>";
$text .= $lastgame_text;		
$text .="</div></div>";
//////////////////////////////////////////////////////////////////
if($GAME2['game_league_id']!=''){$Saison_ID_for_Link=$GAME2['game_league_id'];}
else{$Saison_ID_for_Link=$GAME['game_league_id'];}
	$text .="<div style='width:100%; text-align:center'><a href='".e_PLUGIN."sport_league_e107/league_games.php?Liga=".$Saison_ID_for_Link."'>".LAN_LAST_NEXT_GAME_3."</a><br/></div>";
	if($saisoncount > 1)
		{
		$text .="<div style='width:100%; text-align:center'>-----<br/></div>";
		}
	}
 }
}
else
{
$text=LAN_LAST_NEXT_GAME_12; ///Keine Date liegen vor oder der Saison nicht ausgewÃƒÂ¤hlt!!!
}			                                                                                                                                                                                                                                                                                   
$title = "<b>".LAN_LAST_NEXT_GAME_13."</b>";
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernÃ¼nftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================
$ns -> tablerender($title, $text);

function zaehlen($team_ID,$typ)
	{
	global $sql2,$pref;
	$HOMEDATA['S']=0;
	$HOMEDATA['N']=0;
	$HOMEDATA['ET']=0;
	$HOMEDATA['GT']=0;
	$HOMEDATA['P']=0;
	$counthome=0;
	$sql2 -> db_Select("league_games", "*", "game_home_id='".$team_ID."' AND game_enable=1");
	while($row = $sql2-> db_Fetch())
	 			{
	 			if($row['game_goals_home'] > $row['game_goals_gast'])
	 				{$HOMEDATA['S']++;
	 				 if($row['game_un']==true)
	 				 		{
	 				 		$HOMEDATA['P']=$HOMEDATA['P']+$pref['sport_league_points_winer2'];	
	 				 		}
	 				 else
	 				 		{
	 				 		$HOMEDATA['P']=$HOMEDATA['P']+$pref['sport_league_points_winer'];
	 						}
	 				}
	 			elseif($row['game_goals_home'] < $row['game_goals_gast'])
	 				{$HOMEDATA['N']++;
	 				 if($row['game_un']==true)
	 				 		{
	 				 		$HOMEDATA['P']=$HOMEDATA['P']+$pref['sport_league_points_louser2'];	
	 				 		}
	 				 else
	 				 		{
	 				 		$HOMEDATA['P']=$HOMEDATA['P']+$pref['sport_league_points_louser'];
	 						}
	 				}
	 			$HOMEDATA['ET']=$HOMEDATA['ET']+$row['game_goals_home'];
				$HOMEDATA['GT']=$HOMEDATA['GT']+$row['game_goals_gast'];
	 			
	 			$counthome++;
	 			}			
	$GASTDATA['S']=0;
	$GASTDATA['N']=0;
	$GASTDATA['ET']=0;
	$GASTDATA['GT']=0;
	$GASTDATA['P']=0;
	$countgast=0;
	$sql2 -> db_Select("league_games", "*", "game_gast_id='".$team_ID."' AND game_enable=1");
	while($row = $sql2-> db_Fetch())
	 			{
	 			if($row['game_goals_home'] < $row['game_goals_gast'])
	 				{$GASTDATA['S']++;
	 				 if($row['game_un']==true)
	 				 		{
	 				 		$GASTDATA['P']=$GASTDATA['P']+$pref['sport_league_points_winer2'];	
	 				 		}
	 				 else
	 				 		{
	 				 		$GASTDATA['P']=$GASTDATA['P']+$pref['sport_league_points_winer'];
	 						}
	 				}
	 			elseif($row['game_goals_home'] > $row['game_goals_gast'])
	 				{$GASTDATA['N']++;
	 				if($row['game_un']==true)
	 				 		{
	 				 		$GASTDATA['P']=$GASTDATA['P']+$pref['sport_league_points_louser2'];	
	 				 		}
	 				 else
	 				 		{
	 				 		$GASTDATA['P']=$GASTDATA['P']+$pref['sport_league_points_louser'];
	 						}
	 				}
	 			$GASTDATA['ET']=$GASTDATA['ET']+$row['game_goals_gast'];
				$GASTDATA['GT']=$GASTDATA['GT']+$row['game_goals_home'];
	 			$countgast++;
	 			}			
	$DATA['S']=$HOMEDATA['S']+$GASTDATA['S'];
	$DATA['N']=$HOMEDATA['N']+$GASTDATA['N'];
	$DATA['ET']=$HOMEDATA['ET']+$GASTDATA['ET'];
	$DATA['GT']=$HOMEDATA['GT']+$GASTDATA['GT'];
	$DATA['P']=$HOMEDATA['P']+$GASTDATA['P'];
	$DATA['Sp']=$counthome+$countgast;
	$DATA['Div']=$DATA['ET']-$DATA['GT'];
  switch ($typ) {
	case "games":
			return $DATA['Sp'];
      break;
 	case "win":
			return $DATA['S'];
      break;
  case "lost":
			return $DATA['N'];
      break;
  case "points":
			return $DATA['P'];
      break;
  case "div":
			return $DATA['Div'];
			break;
     }

	}

///////////////////////////////////////////////////////
function goals_zaehlen($game_id,$team_ID,$typ)
	{global $sql2,$pref;
	$Periods=	$pref['sport_league_periods'];
	$Times=$pref['sport_league_times'];	
	$Times2=$Times*2;
	$Times3=$Times*3;	
	$GOALS[1]=0;
	$GOALS[2]=0;
	$GOALS[3]=0;
	$Points_count=0;
	$sql2 -> db_Select("league_points", "*", "points_game_id='".$game_id."' AND points_team_id='".$team_ID."' AND points_value='1'");
	while($row = $sql2-> db_Fetch())
	 			{
	 			$POINT[$Points_count]=$row['points_time'];
				$Points_count++;
				}
	for($i=0; $i < $Points_count; $i++)
		{
		if($POINT[$i] <= "".$Times.":00")
			{
			$GOALS[1]++;continue;	
			}
		elseif($POINT[$i] < "".$Times2.":00" && $POINT[$i] >= "".$Times.":00")
			{
			$GOALS[2]++;continue;	
			}
		elseif($POINT[$i] > "".$Times2.":00" && $POINT[$i] <= "".$Times3.":00")
			{
			$GOALS[3]++;continue;	
			}
		}
  switch ($typ) {
	case "1":
			return $GOALS[1];
      break;
 	case "2":
			return $GOALS[2];
      break;
  case "3":
			return $GOALS[3];
      break;
  case "div":
			return $DATA['Div'];
      break;
     }
	}
?>