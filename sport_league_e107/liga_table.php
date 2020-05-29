<?php
/*
+---------------------------------------------------------------+
|  e107 website system  liga_table.php
|                             
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/last_next_menu_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/last_next_menu_lan.php");
require_once(e_PLUGIN."sport_league_e107/functionen.php");
require_once("header.php");

$text="<tr>
			<td style='text-align:right;background:#b80000 url(images/navbar_bg.png) repeat-x;width:100%;height:100px;color:#ffffff;font-weight:bold;padding:15px;'>
				<div style='color:#fff;text-align:center;background: url(images/back2.png);width:274px;height:66px;'><a href='javascript:history.back()'>Zurück</a></div>
			</td>
		</tr>
		<tr>
			<td style='background:#101010 url(images/body_bg.png) repeat-x;width:100%;text-align:center;vertical-align:top;color:#ffffff;font-weight:bold;padding:20px;'>";


if(file_exists("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_table_menu_lan.php")){
require_once("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_table_menu_lan.php");
	}else{require_once("".e_PLUGIN."sport_league_e107/languages/German/league_table_menu_lan.php");}

if (file_exists(e_PLUGIN."sport_league_e107/handler/Scroll_main15.js")){
  echo "<script type='text/javascript' src='".e_PLUGIN."sport_league_e107/handler/Scroll_main15.js' language='JavaScript1.2'></script>";
	} 
require_once(e_PLUGIN."sport_league_e107/functionen.php");
$text.="";
if($pref['sport_league_logo_w_menu']!="")
 {
 $LOGO_SIZE=" width='90' ";
 $TAX=$LOGO_SIZE;
 }
elseif($pref['sport_league_logo_h_menu']!="")
 {
$LOGO_SIZE=" height='60' ";
$TAX=10;
 }
else
{$LOGO_SIZE="";}
///////////////////////////////////
$expand_autohide = "display:none; ";
$STYLES_KLASSES[0]="";
$STYLES_KLASSES[1]="fcaption";
$STYLES_KLASSES[2]="forumheader";
$STYLES_KLASSES[3]="forumheader2";
$STYLES_KLASSES[4]="forumheader3";
$STYLES_KLASSES[5]="forumheader4";

$Saison=$pref['league_my_saison'];
///////////////////////////////////
$MENUTABEL_TOP="<td class='fcaption' style='text-align:right;width:2%;'>Pl.</td>";
if($pref['sport_league_logo_menu']=='0')
	{
	$MENUTABEL_TOP .="<td class='fcaption' style='border-right:0px;width:".$TAX."px;text-align:center'><b>".LAN_LEAGUE_TABLE_MENU_01."</b></td>";
	}
$MENUTABEL_TOP.="
				<td class='fcaption' style='width:80%;'><b>".LAN_LEAGUE_TABLE_MENU_02."</b></td>
				<td class='fcaption' style='border-left:0px;width:10%;text-align:center;'><b>".LAN_LEAGUE_TABLE_MENU_03."</b></td>
				<td class='fcaption' style='border-left:0px;width:10%;text-align:center;'><b>".LAN_LEAGUE_TABLE_MENU_04."</b></td>
			</tr>";	
////////////////////////////////////////////////////////////////////////
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_saison AS a 
   	LEFT JOIN ".MPREFIX."league_leagues AS ae ON ae.league_saison_id=a.saison_id   
   	WHERE a.saison_id='".$Saison."'
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
		$inhalttext= "<div style='text-align:center; font-size:70px;'>";
		if(ADMIN)
				{
				$Ligatext ="<b><a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_tleague_config.php?list.".$SAISON[$JS]['league_id']."' title='".LAN_LEAGUE_TABLE_MENU_08."'>
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
		for($i=0;$i < $count[$JS]; $i++)
				{
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
		for($i=0;$i < $count[$JS]; $i++)
			{
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
////////////////Sort ///////////
    for($j=0;$j<($count[$JS]-1);$j++)
   		{   
      for($i=$j+1;$i<($count[$JS]);$i++)
   			{
      	if(($TEAM[$JS][6][$j]== $TEAM[$JS][6][$i])&&(($TEAM[$JS][11][$j]< $TEAM[$JS][11][$i]))||($TEAM[$JS][6][$j]< $TEAM[$JS][6][$i]))
        		{
         		for($k=0;$k< 32;$k++)
           		{
           		$zwisch[$k]=$TEAM[$JS][$k][$j];
           		}
        		for($k=0;$k< 32;$k++)
           		{
           		$TEAM[$JS][$k][$j]=$TEAM[$JS][$k][$i];
           		}
        		for($k=0;$k< 32;$k++)
           		{
           		$TEAM[$JS][$k][$i]=$zwisch[$k];
           		}
        		}
  			 }
  		} 
///////////////////////////////////
$gesammt ="
<div id='exp_menu_gesammt_table_".$JS."'>
				<b>".LAN_LEAGUE_TABLE_MENU_17."</b> ".$Ligatext." <br/>
				<table cellpadding='0' cellspacing='0' width='100%' style='font-size:50px;'>
					<tr>	
						<td class='forumheader' style='text-align:center; width:33%; height: 20px'>
							<div style='cursor:pointer' onclick=\"ausblenden('exp_menu_gesammt_table_".$JS."'), ausblenden('exp_menu_gast_table_".$JS."'), einblenden('exp_menu_home_table_".$JS."')\"><b>".LAN_LEAGUE_TABLE_MENU_09."</b></div>
						</td>
						<td class='forumheader2' style='text-align:center; width:33%; height: 20px'>
							<b>".LAN_LEAGUE_TABLE_MENU_11."</b>
						</td>
						<td class='forumheader' style='text-align:center; width:33%; height: 20px'>
						<div style='cursor:pointer' onclick=\"ausblenden('exp_menu_gesammt_table_".$JS."'), ausblenden('exp_menu_home_table_".$JS."'), einblenden('exp_menu_gast_table_".$JS."')\"><b>".LAN_LEAGUE_TABLE_MENU_10."</b></div>
						</td>
					</tr>
				</table>
<table style='width:100%' cellspacing='0' cellpadding='0' style='font-size:50px;'><tr>";
$gesammt.=$MENUTABEL_TOP;

for($i=0; $i < $count[$JS]; $i++)     
   {
   	$gesammt .="<tr>";
   	
   	if($TEAM[$JS][27][$i]=='1' && $pref['sport_league_tab_myteam']=='0')
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style3']];}
			else{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style1']];}		
		if($pref['sport_league_tab_spalten']=='0' && $i < $pref['sport_league_tab_spalt_ab']-1)
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style3']];}
		elseif($pref['sport_league_tab_spalten']=='0' && $i >= $pref['sport_league_tab_spalt_bis']-1)
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style2']];}
		elseif($pref['sport_league_tab_spalten']=='0' && $i < $pref['sport_league_tab_spalt_bis']-1 && $i >= $pref['sport_league_tab_spalt_ab']-1)
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style1']];}		
		if($pref['sport_league_tab_zebra']=='0' && $i%2)
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style1']];}
		elseif($pref['sport_league_tab_zebra']=='0')	
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style2']];}	
   	
   	
		$gesammt .="<tr><td class='".$zeilestyle."' style='text-align:right;width:2%;border-right:0px;border-top:0px;padding:2px;'>".($i+1).".</td>";
		if($pref['sport_league_logo_menu']=='0')
			{
			$gesammt .="<td class='".$zeilestyle."' style='border-right:0px;border-top:0px;text-align:center;padding:2px;'><a target='_blank' href='".$TEAM[$JS][2][$i]."' style='border:0px;' title=''><img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$TEAM[$JS][1][$i]."'".$LOGO_SIZE."></a></td>";
			}
$gesammt .="<td class='".$zeilestyle."' style='border-top:0px;width:45%;text-align:left;font-size:50px;'>".$TEAM[$JS][3][$i]."</td>";
$gesammt .="<td class='".$zeilestyle."' style='border-left:0px;border-top:0px;padding-top:2px;padding-bottom:2px;width:10%;text-align:center;font-size:50px;'>".$TEAM[$JS][14][$i]."</td>";
if($TEAM[$JS][6][$i]==''){$TEAM[$JS][6][$i]='0';}
$gesammt .="<td class='".$zeilestyle."' style='border-left:0px;border-top:0px;padding-top:2px;padding-bottom:2px;width:10%;text-align:center;font-size:50px;'>".$TEAM[$JS][6][$i]."</td>";
$gesammt .="	</tr>";
    }
$gesammt .="</table></div>";
$inhalttext .=$gesammt;
////////#############################################
////////////////Sort hOME///////////
    for($j=0;$j<($count[$JS]-1);$j++)
   		{   
      for($i=$j+1;$i<($count[$JS]);$i++)
   			{
      	if(($TEAM[$JS][29][$j]== $TEAM[$JS][29][$i])&&(($TEAM[$JS][30][$j]< $TEAM[$JS][30][$i]))||($TEAM[$JS][29][$j]< $TEAM[$JS][29][$i]))
        		{
         		for($k=0;$k< 32;$k++)
           		{
           		$zwisch[$k]=$TEAM[$JS][$k][$j];
           		}
        		for($k=0;$k< 32;$k++)
           		{
           		$TEAM[$JS][$k][$j]=$TEAM[$JS][$k][$i];
           		}
        		for($k=0;$k< 32;$k++)
           		{
           		$TEAM[$JS][$k][$i]=$zwisch[$k];
           		}
        		}
  			 }
  		} 
/////////////////////////////////// 
$ausg_home ="<div id='exp_menu_home_table_".$JS."' style='$expand_autohide'>
			  <b>".LAN_LEAGUE_TABLE_MENU_15."</b> ".$Ligatext." <br/>
				<table cellpadding='0' cellspacing='0' width='100%' style='font-size:50px;'>
					<tr>	
						<td class='forumheader2' style='text-align:center; width:33%; height: 20px'><b>".LAN_LEAGUE_TABLE_MENU_09."</b>			
						</td>
						<td class='forumheader' style='text-align:center; width:33%; height: 20px'>
						<div style='cursor:pointer' onclick=\"einblenden('exp_menu_gesammt_table_".$JS."'), ausblenden('exp_menu_gast_table_".$JS."'), ausblenden('exp_menu_home_table_".$JS."')\"><b>".LAN_LEAGUE_TABLE_MENU_11."</b></div>
						</td>
						<td class='forumheader' style='text-align:center; width:33%; height: 20px'>
						<div style='cursor:pointer' onclick=\"ausblenden('exp_menu_gesammt_table_".$JS."'), ausblenden('exp_menu_home_table_".$JS."'), einblenden('exp_menu_gast_table_".$JS."')\"><b>".LAN_LEAGUE_TABLE_MENU_10."</b></div>
						</td>
					</tr>
				</table>
						<table style='width:100%' cellspacing='0' cellpadding='0' style='font-size:50px;'><tr>";
$ausg_home.=$MENUTABEL_TOP;

for($i=0; $i < $count[$JS]; $i++)     
   {
   	$ausg_home .="<tr>";
   	
   	if($TEAM[$JS][27][$i]=='1' && $pref['sport_league_tab_myteam']=='0')
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style3']];}
			else{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style1']];}		
		if($pref['sport_league_tab_spalten']=='0' && $i < $pref['sport_league_tab_spalt_ab']-1)
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style3']];}
		elseif($pref['sport_league_tab_spalten']=='0' && $i >= $pref['sport_league_tab_spalt_bis']-1)
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style2']];}
		elseif($pref['sport_league_tab_spalten']=='0' && $i < $pref['sport_league_tab_spalt_bis']-1 && $i >= $pref['sport_league_tab_spalt_ab']-1)
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style1']];}		
		if($pref['sport_league_tab_zebra']=='0' && $i%2)
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style1']];}
		elseif($pref['sport_league_tab_zebra']=='0')	
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style2']];}	
   	
   	
		$ausg_home .="<tr><td class='".$zeilestyle."' style='text-align:right;width:2%;border-right:0px;border-top:0px;padding:2px;'>".($i+1).".</td>";
		if($pref['sport_league_logo_menu']=='0')
			{
			$ausg_home .="<td class='".$zeilestyle."' style='border-right:0px;border-top:0px;text-align:center;padding:2px;'><a target='_blank' href='".$TEAM[$JS][2][$i]."' style='border:0px;' title=''><img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$TEAM[$JS][1][$i]."'".$LOGO_SIZE."></a></td>";
			}
		$ausg_home .="<td class='".$zeilestyle."' style='border-top:0px;width:45%;text-align:left;font-size:50px;'>".$TEAM[$JS][3][$i]."</td>";
		$ausg_home .="<td class='".$zeilestyle."' style='border-left:0px;border-top:0px;padding-top:2px;padding-bottom:2px;width:10%;text-align:center;font-size:50px;'>".$TEAM[$JS][12][$i]."</td>";
		if($TEAM[$JS][29][$i]==''){$TEAM[$JS][29][$i]='0';}
		$ausg_home .="<td class='".$zeilestyle."' style='border-left:0px;border-top:0px;padding-top:2px;padding-bottom:2px;width:10%;text-align:center;font-size:50px;'>".$TEAM[$JS][29][$i]."</td>";
		$ausg_home .="	</tr>";
    }
$ausg_home .="</table></div>";
$inhalttext .=$ausg_home;
////////#############################################
////////////////Sort Gast///////////
    for($j=0;$j<($count[$JS]-1);$j++)
   		{   
      for($i=$j+1;$i<($count[$JS]);$i++)
   			{
      	if(($TEAM[$JS][28][$j]== $TEAM[$JS][28][$i])&&(($TEAM[$JS][31][$j]< $TEAM[$JS][31][$i]))||($TEAM[$JS][28][$j]< $TEAM[$JS][28][$i]))
        		{
         		for($k=0;$k< 32;$k++)
           		{
           		$zwisch[$k]=$TEAM[$JS][$k][$j];
           		}
        		for($k=0;$k< 32;$k++)
           		{
           		$TEAM[$JS][$k][$j]=$TEAM[$JS][$k][$i];
           		}
        		for($k=0;$k< 32;$k++)
           		{
           		$TEAM[$JS][$k][$i]=$zwisch[$k];
           		}
        		}
  			 }
  		} 
/////////////////////////////////// 
$ausg_gast ="
<div id='exp_menu_gast_table_".$JS."' style='$expand_autohide'>
				<b>".LAN_LEAGUE_TABLE_MENU_16."</b> ".$Ligatext." <br/>
				<table cellpadding='0' cellspacing='0' width='100%' style='font-size:50px;'>
					<tr>	
						<td class='forumheader' style='text-align:center; width:33%; height: 20px'>
						<div style='cursor:pointer' onclick=\"ausblenden('exp_menu_gesammt_table_".$JS."'), einblenden('exp_menu_home_table_".$JS."'), ausblenden('exp_menu_gast_table_".$JS."')\"><b>".LAN_LEAGUE_TABLE_MENU_09."</b></div>			
						</td>
						<td class='forumheader' style='text-align:center; width:33%; height: 20px'>
						<div style='cursor:pointer' onclick=\"einblenden('exp_menu_gesammt_table_".$JS."'), ausblenden('exp_menu_gast_table_".$JS."'), ausblenden('exp_menu_home_table_".$JS."')\"><b>".LAN_LEAGUE_TABLE_MENU_11."</b></div>
						</td>
						<td class='forumheader2' style='text-align:center; width:33%; height: 20px'><b>".LAN_LEAGUE_TABLE_MENU_10."</b>
						</td>
					</tr>
				</table>
						<table style='width:100%' cellspacing='0' cellpadding='0' style='font-size:50px;'><tr>";
$ausg_gast.=$MENUTABEL_TOP;

for($i=0; $i < $count[$JS]; $i++)     
   {
   	$ausg_gast .="<tr>";
   	
   	if($TEAM[$JS][27][$i]=='1' && $pref['sport_league_tab_myteam']=='0')
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style3']];}
			else{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style1']];}		
		if($pref['sport_league_tab_spalten']=='0' && $i < $pref['sport_league_tab_spalt_ab']-1)
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style3']];}
		elseif($pref['sport_league_tab_spalten']=='0' && $i >= $pref['sport_league_tab_spalt_bis']-1)
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style2']];}
		elseif($pref['sport_league_tab_spalten']=='0' && $i < $pref['sport_league_tab_spalt_bis']-1 && $i >= $pref['sport_league_tab_spalt_ab']-1)
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style1']];}		
		if($pref['sport_league_tab_zebra']=='0' && $i%2)
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style1']];}
		elseif($pref['sport_league_tab_zebra']=='0')	
			{$zeilestyle=$STYLES_KLASSES[$pref['sport_league_tab_style2']];}	
   	
   	
		$ausg_gast .="<tr><td class='".$zeilestyle."' style='text-align:right;width:2%;border-right:0px;border-top:0px;padding:2px;'>".($i+1).".</td>";
		if($pref['sport_league_logo_menu']=='0')
			{
			$ausg_gast .="<td class='".$zeilestyle."' style='border-right:0px;border-top:0px;text-align:center;padding:2px;'><a target='_blank' href='".$TEAM[$JS][2][$i]."' style='border:0px;' title=''><img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$TEAM[$JS][1][$i]."'".$LOGO_SIZE."></a></td>";
			}
$ausg_gast .="<td class='".$zeilestyle."' style='border-top:0px;width:45%;text-align:left;font-size:50px;'>".$TEAM[$JS][3][$i]."</td>";
$ausg_gast .="<td class='".$zeilestyle."' style='border-left:0px;border-top:0px;padding-top:2px;padding-bottom:2px;width:10%;text-align:center;font-size:50px;'>".$TEAM[$JS][13][$i]."</td>";
if($TEAM[$JS][28][$i]==''){$TEAM[$JS][28][$i]='0';}
$ausg_gast .="<td class='".$zeilestyle."' style='border-left:0px;border-top:0px;padding-top:2px;padding-bottom:2px;width:10%;text-align:center;font-size:50px;'>".$TEAM[$JS][28][$i]."</td>";
$ausg_gast .="	</tr>";
    }
$ausg_gast .="</table></div>";
$inhalttext .=$ausg_gast;

////////#############################################
$inhalttext .="<div style='font-size:10px;'><a href='".e_PLUGIN."sport_league_e107/league_table.php?".$SAISON[$JS]['saison_id'].".".$SAISON[$JS]['league_id'].".'>".LAN_LEAGUE_TABLE_MENU_06."</a><br/>-----<br/></div></div>";
$text .=$inhalttext;	
	}
}



                                                                                                                                                                                                                                                          
$title = "<b>".LAN_LAST_NEXT_GAME_13."</b>";
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernÃƒÂ¼nftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================
//$ns -> tablerender($title, $text);
echo $text;
require_once("footer.php");
//////////////////////////////////////
//////////////////////////////////////

?>