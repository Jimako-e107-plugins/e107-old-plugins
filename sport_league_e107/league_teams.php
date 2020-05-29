<?
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        ©Steve Dunstan 2001-2006
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/league_teams.php
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");                                                                                       
require_once(HEADERF); 
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_table_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/league_table_lan.php");
require_once("functionen.php");  
if(file_exists(e_PLUGIN."sport_league_e107/handler/Scroll_main15.js")){
echo "<script type='text/javascript' src='".e_PLUGIN."sport_league_e107/handler/Scroll_main15.js' language='JavaScript1.2'></script>";
} 

$text ="";
//$LOGO_X=$pref['sport_league_logo_w_menu'];
//$LOGO_Y=$pref['sport_league_logo_h_menu'];
$LOGO_X="70";
$LOGO_Y="70";
$TAX=$LOGO_X;
$COLS=2;
///////////////////////////////////
$expand_autohide = "display:none; ";    

if(e_QUERY)
	{
	list($Saison, $liga, $from) = explode(".", e_QUERY);
	$Saison = intval($Saison);
	$liga = intval($liga);
	$from = intval($from);
	unset($tmp);
	}

if(!$Saison)
	{
	$Saison=$pref['league_my_saison'];
	}

	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_saison AS a 
   	LEFT JOIN ".MPREFIX."league_leagues AS ae ON ae.league_saison_id=a.saison_id   
   	WHERE a.saison_id='".$Saison."'
   			";
if($liga)
	{
	$qry1.=" AND ae.league_id='".$liga."' LIMIT 1";	
	}
	
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

if(ADMIN){
	$Ligatext ="<b><a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_tleague_config.php?list.".$SAISON[$JS]['league_id']."' title='".LAN_LEAGUE_TABLE_08."'>
									".$SAISON[$JS]['league_name']." (".$SAISON[$JS]['saison_name'].")</a></b>";
					}
		else{
				$Ligatext ="<b>".$SAISON[$JS]['league_name']." (".$SAISON[$JS]['saison_name'].")</b>";
				}

     $sql -> db_Select("league_leagueteams", "*","leagueteam_league_id='".$SAISON[$JS]['league_id']."'");
        $count[$JS]=0;
         while($row = $sql-> db_Fetch())
       			{
						$TEAM[$JS][0][$count[$JS]]=$row['leagueteam_team_id'];
						$TEAM[$JS][26][$count[$JS]]=$row['leagueteam_id'];
						$TEAM[$JS][27][$count[$JS]]=$row['leagueteam_my_team'];
						$count[$JS]++;
						}

for($i=0;$i < $count[$JS]; $i++){
     $sql -> db_Select("league_teams", "*","team_id='".$TEAM[$JS][0][$i]."' LIMIT 1");
         while($row = $sql-> db_Fetch())
       			{
       			$TEAM[$JS][25][$i]=$row['team_id'];
        		$TEAM[$JS][1][$i]=$row['team_icon'];
        		$TEAM[$JS][2][$i]=$row['team_url'];
        		$TEAM[$JS][24][$i]=$row['team_name'];
        		if($pref['sport_league_teamname_menu']==2){$TEAM[$JS][3][$i]=$row['team_kurzname'];}
        		else{$TEAM[$JS][3][$i]=$row['team_name'];}
       			}
  				}
/////////////-------////////////////////////////
for($i=0;$i < $count[$JS]; $i++){
			$TEAM[$JS][4][$i]= 0;		///ET Home
			$TEAM[$JS][5][$i]= 0;		///GT Home
			$TEAM[$JS][6][$i]= 0;		///Points
			$TEAM[$JS][7][$i]= 0;		///ET	Gast
			$TEAM[$JS][8][$i]= 0;		///GT	Gast
			$TEAM[$JS][9][$i]= 0;		///ET
			$TEAM[$JS][10][$i]= 0;		///GT
			$TEAM[$JS][11][$i]= 0;		///Diff
			$TEAM[$JS][12][$i]= 0;		///Anzahl Games Home
			$TEAM[$JS][13][$i]= 0;		///Anzahl Games Gast
			$TEAM[$JS][14][$i]= 0;		///Games
			$TEAM[$JS][15][$i]= 0;		///Win Home
			$TEAM[$JS][16][$i]= 0;		///Lost Home
			$TEAM[$JS][17][$i]= 0;		///Un Home
			$TEAM[$JS][18][$i]= 0;		///Win Gast
			$TEAM[$JS][19][$i]= 0;		///Lost Gast
			$TEAM[$JS][20][$i]= 0;		///Un Gast
			$TEAM[$JS][21][$i]= 0;		///Win
			$TEAM[$JS][22][$i]= 0;		///Lost
			$TEAM[$JS][23][$i]= 0;		///Un			
			$TEAM[$JS][28][$i]= 0;		///P G
			$TEAM[$JS][29][$i]= 0;		///P H
}	

//////////////////////  Punkte Rechnen /////////////////////////////////////
			for($i=0;$i<($count[$JS]);$i++)
				{
				$sql -> db_Select("league_games","*","game_enable=1 and game_home_id=".$TEAM[$JS][26][$i]."");
				while($row = $sql-> db_Fetch())
       			{
						$TEAM[$JS][4][$i]=$TEAM[$JS][4][$i]+$row['game_goals_home'];
						$TEAM[$JS][5][$i]=$TEAM[$JS][5][$i]+$row['game_goals_gast'];
						$TEAM[$JS][12][$i]=$TEAM[$JS][12][$i]+1;
						if($row['game_goals_home']> $row['game_goals_gast'])
						   {
						    if($row['game_un']==true)
						    	{
						    	 $TEAM[$JS][6][$i]=$TEAM[$JS][6][$i]+$pref['sport_league_points_winer2']; /// Points
						    	 $TEAM[$JS][29][$i]=$TEAM[$JS][29][$i]+$pref['sport_league_points_winer2'];
						    	 //$TEAM[$JS][15][$i]=$TEAM[$JS][15][$i]+1;
						    	 $TEAM[$JS][17][$i]=$TEAM[$JS][17][$i]+1;   //Un Home
						    	}
						   	else
						   		{
						   		$TEAM[$JS][6][$i]=$TEAM[$JS][6][$i]+$pref['sport_league_points_winer'];
						   		$TEAM[$JS][29][$i]=$TEAM[$JS][29][$i]+$pref['sport_league_points_winer'];
						   		$TEAM[$JS][15][$i]=$TEAM[$JS][15][$i]+1;
						   		}
						   }
						elseif($row['game_goals_gast']==$row['game_goals_home'])
								{
								$TEAM[$JS][6][$i]=$TEAM[$JS][6][$i]+$pref['sport_league_game_unistun'];
								$TEAM[$JS][29][$i]=$TEAM[$JS][29][$i]+$pref['sport_league_game_unistun'];
							  $TEAM[$JS][17][$i]=$TEAM[$JS][17][$i]+1;
								} 
						else
							 {
							  if($row['game_un']==true)
							    {
							    $TEAM[$JS][6][$i]=$TEAM[$JS][6][$i]+$pref['sport_league_points_louser2'];
							    $TEAM[$JS][29][$i]=$TEAM[$JS][29][$i]+$pref['sport_league_points_louser2'];
							    //$TEAM[$JS][16][$i]=$TEAM[$JS][16][$i]+1;
							    $TEAM[$JS][17][$i]=$TEAM[$JS][17][$i]+1;
							    }
						   	else
						   	  {
						   	  $TEAM[$JS][6][$i]=$TEAM[$JS][6][$i]+$pref['sport_league_points_louser'];
						   	  $TEAM[$JS][29][$i]=$TEAM[$JS][29][$i]+$pref['sport_league_points_louser'];
						   	  $TEAM[$JS][16][$i]=$TEAM[$JS][16][$i]+1;
						   	  }
							 }
				  	}
				$sql -> db_Select("league_games","*","game_enable=1 and game_gast_id=".$TEAM[$JS][26][$i]."");
				while($row = $sql-> db_Fetch())
       			{
						$TEAM[$JS][7][$i]=$TEAM[$JS][7][$i]+$row['game_goals_gast'];
						$TEAM[$JS][8][$i]=$TEAM[$JS][8][$i]+$row['game_goals_home'];
						$TEAM[$JS][13][$i]=$TEAM[$JS][13][$i]+1;
						if($row['game_goals_gast']> $row['game_goals_home'])
						   {
						    if($row['game_un']==true)
						      {
						    	$TEAM[$JS][6][$i]=$TEAM[$JS][6][$i]+$pref['sport_league_points_winer2'];
						    	$TEAM[$JS][28][$i]=$TEAM[$JS][28][$i]+$pref['sport_league_points_winer2'];
						    	//$TEAM[$JS][18][$i]=$TEAM[$JS][18][$i]+1;
						    	$TEAM[$JS][20][$i]=$TEAM[$JS][20][$i]+1;
						    	}
						   	else
						   	  {
						   	  $TEAM[$JS][6][$i]=$TEAM[$JS][6][$i]+$pref['sport_league_points_winer'];
						   	  $TEAM[$JS][28][$i]=$TEAM[$JS][28][$i]+$pref['sport_league_points_winer'];
						   	  $TEAM[$JS][18][$i]=$TEAM[$JS][18][$i]+1;
						   	  }
						   }
					elseif($row['game_goals_gast']==$row['game_goals_home'])
								{
								$TEAM[$JS][6][$i]=$TEAM[$JS][6][$i]+$pref['sport_league_game_unistun'];
								$TEAM[$JS][28][$i]=$TEAM[$JS][28][$i]+$pref['sport_league_game_unistun'];
							  $TEAM[$JS][20][$i]=$TEAM[$JS][20][$i]+1;
								} 
						else
							 {
							  if($row['game_un']==true)
							  	{
							  	$TEAM[$JS][6][$i]=$TEAM[$JS][6][$i]+$pref['sport_league_points_louser2'];
							  	$TEAM[$JS][28][$i]=$TEAM[$JS][28][$i]+$pref['sport_league_points_louser2'];
							  	//$TEAM[$JS][19][$i]=$TEAM[$JS][19][$i]+1;
							  	$TEAM[$JS][20][$i]=$TEAM[$JS][20][$i]+1;
							  	}
						   	else
						   		{
						   		$TEAM[$JS][6][$i]=$TEAM[$JS][6][$i]+$pref['sport_league_points_louser'];
						   		$TEAM[$JS][28][$i]=$TEAM[$JS][28][$i]+$pref['sport_league_points_louser'];
						   		$TEAM[$JS][19][$i]=$TEAM[$JS][19][$i]+1;
						   		}
							 }						
				  	}
				}
/////////////Eigen/Gegen- Tore und Spiele und Diff Ausrechnen /////////////////
			for($i=0;$i<($count[$JS]);$i++)
				{
				$TEAM[$JS][9][$i]= $TEAM[$JS][4][$i]+$TEAM[$JS][7][$i];		///ET Total
				$TEAM[$JS][10][$i]= $TEAM[$JS][5][$i]+$TEAM[$JS][8][$i];		///GT Total
				$TEAM[$JS][14][$i]= $TEAM[$JS][12][$i]+$TEAM[$JS][13][$i];	///Anzahl Games Total
				$TEAM[$JS][11][$i]= $TEAM[$JS][9][$i]-$TEAM[$JS][10][$i];	///Dif Total
				$TEAM[$JS][21][$i]= $TEAM[$JS][15][$i]+$TEAM[$JS][18][$i];	///Wins Total
				$TEAM[$JS][23][$i]= $TEAM[$JS][17][$i]+$TEAM[$JS][20][$i];	///Un Total
				$TEAM[$JS][22][$i]= $TEAM[$JS][16][$i]+$TEAM[$JS][19][$i];	///Lost Total
				$TEAM[$JS][30][$i]= $TEAM[$JS][4][$i]-$TEAM[$JS][5][$i];	///Dif Home
				$TEAM[$JS][31][$i]= $TEAM[$JS][7][$i]-$TEAM[$JS][8][$i];	///Dif Gast
				}
/////////////////////////////////// 
$text .="<div style='text-align:center'>".$Ligatext."<table style='width:100%' cellspacing='0' cellpadding='0'>
							<tr>
								<td>
								</td>
								<td>	
								<table style='width:100%' cellspacing='0' cellpadding='0'>
									<tr>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/league_table.php?".$SAISON[$JS]['league_id']."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/table_icon.gif' alt='' title='".LAN_LEAGUE_TABLE_27."'>
											</a>
										</td>
										<td style='width: 90%; text-align: left'>
											<a href='".e_PLUGIN."sport_league_e107/league_table.php?".$SAISON[$JS]['saison_id'].".".$SAISON[$JS]['league_id']."' title='".LAN_LEAGUE_TABLE_27." '>
												<b>&nbsp;&nbsp;".LAN_LEAGUE_TABLE_27."</b>
											</a>
										</td>
									</tr>
									<tr>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/league_calendar.php?Liga=".$SAISON[$JS]['league_id']."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/calendar_icon.gif' alt='' title='".LAN_LEAGUE_TABLE_26."'>
											</a>
										</td>
										<td style='width: 90%; text-align: left'>
											<a href='".e_PLUGIN."sport_league_e107/league_calendar.php?Liga=".$SAISON[$JS]['league_id']."'>
												<b>&nbsp;&nbsp;".LAN_LEAGUE_TABLE_26."</b>
											</a>
										</td>
									</tr>
									<tr>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/league_games.php?Liga=".$SAISON[$JS]['league_id']."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/termin_icon.gif' alt='' title='".LAN_LEAGUE_TABLE_23."'>
											</a>
										</td>
										<td style='width: 90%; text-align: left'>
											<a href='".e_PLUGIN."sport_league_e107/league_games.php?Liga=".$SAISON[$JS]['league_id']."'>
												<b>&nbsp;&nbsp;".LAN_LEAGUE_TABLE_23."</b>
											</a>
										</td>
									</tr>
									<tr>
										<td style='width: 10%; text-align: center'>
											<a href='".e_PLUGIN."sport_league_e107/game_days.php?Liga=".$Saison."&Liga=".$SAISON[$JS]['league_id']."'>
												<img border='0' src='".e_PLUGIN."sport_league_e107/images/gameday_icon.gif' alt='' title='".LAN_LEAGUE_TABLE_25."'>
											</a>
										</td>
										<td style='width: 90%; text-align: left'>
											<a href='".e_PLUGIN."sport_league_e107/game_days.php?Liga=".$Saison."&Liga=".$SAISON[$JS]['league_id']."' title='".LAN_LEAGUE_TABLE_25."'>
												<b>&nbsp;&nbsp;".LAN_LEAGUE_TABLE_25."</b>
											</a>
										</td>
									</tr>
								</table></td></tr></table>";


$text .="<table style='width:96%'><tr>";

for($i=0; $i < $count[$JS]; $i++)     
        {
 $text .="<td style='padding:2px'>";      
$text .=team_data($TEAM[$JS][26][$i], $TEAM[$JS][3][$i], $SAISON[$JS]['league_id'], $TEAM[$JS][1][$i], $LOGO_Y, $LOGO_X, $TEAM[$JS][2][$i]);
 $text .="</td>"; 
 if(($i+1)%($COLS)==0){$text .="</tr><tr>";}

 				}
$text .="</table></div>";
$text .="<br/>";
	}
}
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================
$text .="</div>";
$title = LAN_LEAGUE_TABLE_22;
$title .= $SAISON[0]['saison_name'];
$From="league_table.php?1.1";
$ns -> tablerender($title, $text);                                                                              
// ========= End of the BODY ===================================================                                                                                    
require_once(FOOTERF);
?>