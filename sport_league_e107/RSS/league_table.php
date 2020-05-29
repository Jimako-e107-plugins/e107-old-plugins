
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
|		$Source: ../e107_plugins/sport_league_e107/RSS/league_table.php
|		$Revision: 1.0 $
|		$Date: 2008/04/10 $
|		$Author: ***RuSsE*** $  
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");  

$HEADER="";
$FOOTER="";
$CUSTOMHEADER = "";
$CUSTOMFOOTER = "";

if(file_exists("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_table_lan.php")){
require_once("".e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_table_lan.php");
}else{require_once("".e_PLUGIN."sport_league_e107/languages/German/league_table_lan.php");}
 
 
 if (file_exists(e_PLUGIN."sport_league_e107/handler/Scroll_main15.js")){
  echo "<script type='text/javascript' src='".e_PLUGIN."sport_league_e107/handler/Scroll_main15.js' language='JavaScript1.2'></script>";
} 
require_once("".e_PLUGIN."sport_league_e107/functionen.php");


$text ="";
//$LOGO_X=$pref['sport_league_logo_w_menu'];
//$LOGO_Y=$pref['sport_league_logo_h_menu'];
$LOGO_X="30";
$LOGO_Y="30";
$TAX=$LOGO_X;
///////////////////////////////////

$expand_autohide = "display:none; ";    

if(e_QUERY)
	{
	list($Saison, $liga, $from, $thema) = explode(".", e_QUERY);
	$Saison = intval($Saison);
	$liga = intval($liga);
	$from = intval($from);
	$thema = intval($thema);
	unset($tmp);
	}

if(!$Saison)
	{
	$Saison=$pref['league_my_saison'];
	}
if(!$liga)
	{
	$liga=$_POST['Saison'];
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
$TABEL_TOP="<td class='fcaption' style='width:40%;font-weight: bold;'>".LAN_LEAGUE_TABLE_02."</td>
				<td class='fcaption' style='border-left:0px;width:6%;text-align:center;font-weight: bold;'>".LAN_LEAGUE_TABLE_20."</td>
				<td class='fcaption' style='border-left:0px;width:6%;text-align:center;font-weight: bold;'>".LAN_LEAGUE_TABLE_06."</td>
				<td class='fcaption' style='border-left:0px;width:6%;text-align:center;font-weight: bold;'>".LAN_LEAGUE_TABLE_15."</td>
				<td class='fcaption' style='border-left:0px;width:6%;text-align:center;font-weight: bold;'>".LAN_LEAGUE_TABLE_16."</td>
				<td class='fcaption' style='border-left:0px;width:6%;text-align:center;font-weight: bold;'>".LAN_LEAGUE_TABLE_17."</td>
				<td class='fcaption' style='border-left:0px;width:6%;text-align:center;font-weight: bold;'>".LAN_LEAGUE_TABLE_18."</td>
				<td class='fcaption' style='border-left:0px;width:8%;text-align:center;font-weight: bold;'>".LAN_LEAGUE_TABLE_19."</td>
				<td class='fcaption' style='border-left:0px;width:6%;text-align:center;font-weight: bold;'>".LAN_LEAGUE_TABLE_04."</td>
			</tr>";		

	for($JS=0; $JS < $saisoncount;$JS++ )
		{

$inhalttext= "<div style='text-align:center'>";
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
 ///****************  Nullen schreiben 
 for($j=0;$j< $count[$JS]-1;$j++)
   		{for($k=0;$k< 32;$k++)
   			{ 		
 				if($TEAM[$JS][$k][$j]==''){$TEAM[$JS][$k][$j]='0';}
 				}
 			}
/////////////////////////////////// 
//$gesammt ="<div id='exp_gesammt_tabel_".$JS."' style='$expand_autohide'>
$gesammt ="
<div id='exp_gesammt_tabel_".$JS."'>
				<b>".LAN_LEAGUE_TABLE_14."</b> ".$Ligatext." <br/>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>	
						<td class='forumheader' style='text-align:center; width:33%; height: 10px'>
							<div style='cursor:pointer' onclick=\"ausblenden('exp_gesammt_tabel_".$JS."'), ausblenden('exp_gast_tabel_".$JS."'), einblenden('exp_home_tabel_".$JS."')\"><b>".LAN_LEAGUE_TABLE_09."</b></div>
						</td>
						<td class='forumheader2' style='text-align:center; width:33%; height: 10px'>
							<b>".LAN_LEAGUE_TABLE_11."</b>
						</td>
						<td class='forumheader' style='text-align:center; width:33%; height: 10px'>
						<div style='cursor:pointer' onclick=\"ausblenden('exp_gesammt_tabel_".$JS."'), ausblenden('exp_home_tabel_".$JS."'), einblenden('exp_gast_tabel_".$JS."')\"><b>".LAN_LEAGUE_TABLE_10."</b></div>
						</td>
					</tr>
				</table>
<table style='width:100%' cellspacing='0' cellpadding='0'><tr>";
if($pref['sport_league_logo_menu']=='0'){$gesammt .="<td class='fcaption' style='border-right:0px;width:".$TAX."px;text-align:center'><b>".LAN_LEAGUE_TABLE_01."</b></td>";}	
$gesammt .=$TABEL_TOP;

for($i=0; $i < $count[$JS]; $i++)     
        {
			$gesammt .="<tr>";
if($TEAM[$JS][27][$i]=='1'){$zeilestyle="forumheader";}else{$zeilestyle="forumheader3";}
if($pref['sport_league_logo_menu']=='0'){
$gesammt .="<td class='".$zeilestyle."' style='border-right:0px;border-top:0px;text-align:center;'><img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$TEAM[$JS][1][$i]."' height='".$LOGO_Y."' width='".$LOGO_X."'></td>";}
$gesammt .="<td class='".$zeilestyle."' style='border-top:0px;font-weight:bold;width:40%;text-align:left;'><div style='cursor:pointer' onclick=\"expandit('exp_ges".$TEAM[$JS][0][$i]."_".$JS."')\">".$TEAM[$JS][3][$i]."</div>
<div id='exp_ges".$TEAM[$JS][0][$i]."_".$JS."' style='".$expand_autohide."' colspan='10' >";
$gesammt .=team_links($TEAM[$JS][26][$i], $TEAM[$JS][3][$i], $SAISON[$JS]['league_id']);
$gesammt .="</div>
</td>"; 
//$gesammt .="<td class='".$zeilestyle."' style='width:45%;text-align:left;'><a target='_blank' href='".$TEAM[$JS][2][$i]."' title='".LAN_LEAGUE_TABLE_05." ".$TEAM[$JS][24][$i]."'>".$TEAM[$JS][3][$i]."</a></td>";
$gesammt .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][14][$i]."</td>";
$gesammt .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][21][$i]."</td>";
$gesammt .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][22][$i]."</td>";
$gesammt .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][23][$i]."</td>";
$gesammt .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][9][$i]."</td>";
$gesammt .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][10][$i]."</td>";
$gesammt .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:8%;text-align:center;'>".$TEAM[$JS][11][$i]."</td>";
$gesammt .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][6][$i]."</td>";
$gesammt .="	</tr>";
/*
$gesammt .="
	<tr>
	<td id='exp_".$TEAM[$JS][0][$i]."_".$JS."' class='".$zeilestyle."' style='".$expand_autohide."' colspan='10' >Clubinfo Kader Statistik Spielplan</td>
	</tr>
	";
*/
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
 ///****************  Nullen schreiben 
 for($j=0;$j< $count[$JS];$j++)
   		{for($k=0;$k< 32;$k++)
   			{ 		
 				if($TEAM[$JS][$k][$j]==''){$TEAM[$JS][$k][$j]='0';}
 				}
 			}
/////////////////////////////////// 
$ausg_home ="<div id='exp_home_tabel_".$JS."' style='$expand_autohide'>
			  <b>".LAN_LEAGUE_TABLE_12."</b> ".$Ligatext." <br/>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>	
						<td class='forumheader2' style='text-align:center; width:33%; height: 10px'><b>".LAN_LEAGUE_TABLE_09."</b>			
						</td>
						<td class='forumheader' style='text-align:center; width:33%; height: 10px'>
						<div style='cursor:pointer' onclick=\"einblenden('exp_gesammt_tabel_".$JS."'), ausblenden('exp_gast_tabel_".$JS."'), ausblenden('exp_home_tabel_".$JS."')\"><b>".LAN_LEAGUE_TABLE_11."</b></div>
						</td>
						<td class='forumheader' style='text-align:center; width:33%; height: 10px'>
						<div style='cursor:pointer' onclick=\"ausblenden('exp_gesammt_tabel_".$JS."'), ausblenden('exp_home_tabel_".$JS."'), einblenden('exp_gast_tabel_".$JS."')\"><b>".LAN_LEAGUE_TABLE_10."</b></div>
						</td>
					</tr>
				</table>
						<table style='width:100%' cellspacing='0' cellpadding='0'><tr>";
if($pref['sport_league_logo_menu']=='0'){$ausg_home .="<td class='fcaption' style='border-right:0px;width:".$TAX."px;text-align:center'><b>".LAN_LEAGUE_TABLE_01."</b></td>";}	
$ausg_home .=$TABEL_TOP;

for($i=0; $i < $count[$JS]; $i++)     
        {
			$ausg_home .="<tr>";
if($TEAM[$JS][27][$i]=='1'){$zeilestyle="forumheader";}else{$zeilestyle="forumheader3";}
if($pref['sport_league_logo_menu']=='0'){
$ausg_home .="<td class='".$zeilestyle."' style='border-right:0px;border-top:0px;text-align:center;'><img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$TEAM[$JS][1][$i]."' height='".$LOGO_Y."' width='".$LOGO_X."'></td>";}
$ausg_home .="<td class='".$zeilestyle."' style='font-weight:bold;width:40%;text-align:left;border-top:0px;'><div style='cursor:pointer' onclick=\"expandit('exp_home".$TEAM[$JS][0][$i]."_".$JS."')\">".$TEAM[$JS][3][$i]."</div>
<div id='exp_home".$TEAM[$JS][0][$i]."_".$JS."' style='".$expand_autohide."' colspan='10' >";
$ausg_home .=team_links($TEAM[$JS][26][$i],$TEAM[$JS][3][$i], $SAISON[$JS]['league_id']); 
$ausg_home .="</div>
</td>";
//$gesammt .="<td class='".$zeilestyle."' style='width:45%;text-align:left;'><a target='_blank' href='".$TEAM[$JS][2][$i]."' title='".LAN_LEAGUE_TABLE_05." ".$TEAM[$JS][24][$i]."'>".$TEAM[$JS][3][$i]."</a></td>";
$ausg_home .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][12][$i]."</td>";
$ausg_home .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][15][$i]."</td>";
$ausg_home .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][16][$i]."</td>";
$ausg_home .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][17][$i]."</td>";
$ausg_home .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][4][$i]."</td>";
$ausg_home .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][5][$i]."</td>";
$ausg_home .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:8%;text-align:center;'>".$TEAM[$JS][30][$i]."</td>";
$ausg_home .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][29][$i]."</td>";
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
///****************  Nullen schreiben 
 for($j=0;$j< $count[$JS] ;$j++)
   		{for($k=0;$k< 32;$k++)
   			{ 		
 				if($TEAM[$JS][$k][$j]==''){$TEAM[$JS][$k][$j]='0';}
 				}
 			}
/////////////////////////////////// 
$ausg_gast ="
<div id='exp_gast_tabel_".$JS."' style='$expand_autohide'>
				<b>".LAN_LEAGUE_TABLE_13."</b> ".$Ligatext." <br/>
				<table cellpadding='0' cellspacing='0' width='100%'>
					<tr>	
						<td class='forumheader' style='text-align:center; width:33%; height: 10px'>
						<div style='cursor:pointer' onclick=\"ausblenden('exp_gesammt_tabel_".$JS."'), einblenden('exp_home_tabel_".$JS."'), ausblenden('exp_gast_tabel_".$JS."')\"><b>".LAN_LEAGUE_TABLE_09."</b></div>			
						</td>
						<td class='forumheader' style='text-align:center; width:33%; height: 10px'>
						<div style='cursor:pointer' onclick=\"einblenden('exp_gesammt_tabel_".$JS."'), ausblenden('exp_gast_tabel_".$JS."'), ausblenden('exp_home_tabel_".$JS."')\"><b>".LAN_LEAGUE_TABLE_11."</b></div>
						</td>
						<td class='forumheader2' style='text-align:center; width:33%; height: 10px'><b>".LAN_LEAGUE_TABLE_10."</b>
						</td>
					</tr>
				</table>
						<table style='width:100%' cellspacing='0' cellpadding='0'><tr>";
if($pref['sport_league_logo_menu']=='0'){$ausg_gast .="<td class='fcaption' style='border-right:0px;width:".$TAX."px;text-align:center'><b>".LAN_LEAGUE_TABLE_01."</b></td>";}	
$ausg_gast .=$TABEL_TOP;

for($i=0; $i < $count[$JS]; $i++)     
        {
			$ausg_gast .="<tr>";
if($TEAM[$JS][27][$i]=='1'){$zeilestyle="forumheader";}else{$zeilestyle="forumheader3";}
if($pref['sport_league_logo_menu']=='0'){
$ausg_gast .="<td class='".$zeilestyle."' style='border-right:0px;border-top:0px;text-align:center;'><img border='0' src='".e_PLUGIN."sport_league_e107/logos/".$TEAM[$JS][1][$i]."' height='".$LOGO_Y."' width='".$LOGO_X."'></td>";}
$ausg_gast .="<td class='".$zeilestyle."' style='border-top:0px;font-weight:bold;width:40%;text-align:left;'><div style='cursor:pointer' onclick=\"expandit('exp_gast".$TEAM[$JS][0][$i]."_".$JS."')\">".$TEAM[$JS][3][$i]."</div>
<div id='exp_gast".$TEAM[$JS][0][$i]."_".$JS."' style='".$expand_autohide."' colspan='10' >";
$ausg_gast .=team_links($TEAM[$JS][26][$i],$TEAM[$JS][3][$i], $SAISON[$JS]['league_id']);
$ausg_gast .="</div>
</td>"; 
//$gesammt .="<td class='".$zeilestyle."' style='width:45%;text-align:left;'><a target='_blank' href='".$TEAM[$JS][2][$i]."' title='".LAN_LEAGUE_TABLE_05." ".$TEAM[$JS][24][$i]."'>".$TEAM[$JS][3][$i]."</a></td>";
$ausg_gast .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][13][$i]."</td>";
$ausg_gast .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][18][$i]."</td>";
$ausg_gast .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][19][$i]."</td>";
$ausg_gast .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][20][$i]."</td>";
$ausg_gast .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][7][$i]."</td>";
$ausg_gast .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][8][$i]."</td>";
$ausg_gast .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:8%;text-align:center;'>".$TEAM[$JS][31][$i]."</td>";
$ausg_gast .="<td class='".$zeilestyle."' style='font-weight: bold;border-left:0px;border-top:0px;width:6%;text-align:center;'>".$TEAM[$JS][28][$i]."</td>";
$ausg_gast .="	</tr>";
    }
$ausg_gast .="</table></div>";
$inhalttext .=$ausg_gast;

////////#############################################

$MYTEXT .=$inhalttext;
$MYTEXT .="<br/>";
	}
}
$MYTEXT .=powered_by();
$MYTEXT .="</div>";
$title = LAN_LEAGUE_TABLE_07;
//$From="league_table.php?1.1";

if($_GET['Template']){
				$text ="<link rel='stylesheet' type='text/css' media='screen' href='".e_THEME."".$_GET['Template']."/style.css'>";
				}
else{$text ="<link rel='stylesheet' type='text/css' media='screen' href='".THEME."style.css'>";}
$text .="<div style='width:100%; text-align: center;'><div style='text-align:right'>";
$text .="</div><div style='text-align:center'>";
$text .=$MYTEXT;
                                                                         
// ========= End of the BODY ===================================================                                                                                    
echo $ns -> tablerender($title, $text);     

?>