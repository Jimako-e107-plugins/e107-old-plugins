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
|		$Source: ../e107_plugins/sport_league_e107/league_teaminfo.php
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");                                                                                       
require_once(HEADERF); 

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_teaminfo_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/league_teaminfo_lan.php");

require_once("functionen.php");

 if (file_exists(e_PLUGIN."sport_league_e107/handler/Scroll_main15.js")){
  echo "<script type='text/javascript' src='".e_PLUGIN."sport_league_e107/handler/Scroll_main15.js' language='JavaScript1.2'></script>";
} 
$LIEAGUEPREAF1[0]="";
$LIEAGUEPREAF1[1]=LAN_LEAGUE_TEAMINFO_1;
$LIEAGUEPREAF1[2]=LAN_LEAGUE_TEAMINFO_2;
$LIEAGUEPREAF1[3]=LAN_LEAGUE_TEAMINFO_3;
$expand_autohide = "display:none; ";   
$text ="";
///////////////////////////////////

$expand_autohide = "display:none; ";    

if(e_QUERY)
	{
	list($team, $liga, $from) = explode(".", e_QUERY);
	$team = intval($team);
	$liga = intval($liga);
	$from = intval($from);
	unset($tmp);
	}

	  $qry1="
   	SELECT a.*, ae.*, ac.*, ab.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	LEFT JOIN ".MPREFIX."league_stadions AS ac ON ac.stadions_id=ae.team_stadion_id 
   	LEFT JOIN ".MPREFIX."user AS ab ON ab.user_id=ae.team_admin_id  
   	WHERE a.leagueteam_id='".$team."' LIMIT 1
   			";
   	$rrr=0;		
		$sql->db_Select_gen($qry1);
$row = $sql-> db_Fetch();

	$TEAMDATA['leagueteam_id']=$row['leagueteam_id'];
  $TEAMDATA['team_id']=$row['team_id'];
  $TEAMDATA['team_name']=$row['team_name'];
  $TEAMDATA['team_kurzname']=$row['team_kurzname'];
  $TEAMDATA['team_admin_id']=$row['team_admin_id'];
  $TEAMDATA['admin_name']=$row['user_name'];
  $TEAMDATA['team_url']=$row['team_url'];
  $TEAMDATA['team_icon']=$row['team_icon'];
  $TEAMDATA['team_description']=$row['team_description'];
  $TEAMDATA['team_stadion_id']=$row['team_stadion_id'];
  $TEAMDATA['stadions_id']=$row['stadions_id'];
  $TEAMDATA['stadions_name']=$row['stadions_name'];
  $TEAMDATA['stadions_ort']=$row['stadions_ort'];
  $TEAMDATA['stadions_plz']=$row['stadions_plz'];
  $TEAMDATA['stadions_street']=$row['stadions_street'];
  $TEAMDATA['stadions_tel']=$row['stadions_tel'];
  $TEAMDATA['stadions_fax']=$row['stadions_fax'];
  $TEAMDATA['stadions_contakt']=$row['stadions_contakt'];
  $TEAMDATA['stadions_url']=$row['stadions_url'];
  $TEAMDATA['stadions_image']=$row['stadions_image'];
  $TEAMDATA['stadions_description']=$row['stadions_description'];


$text="<div style='text-align:center'>
				<table style='width:100%' cellspacing='0' cellpadding='0'>
					<tr>
						<td class='forumheader3' style='width:20%;text-align:left;vertical-align:top;border-right:0px;border-bottom:0px'>".LAN_LEAGUE_TEAMINFO_4."
						</td>
						<td class='forumheader3' style='width:60%;text-align:left;vertical-align:top;border-right:0px;border-bottom:0px'><b>".$TEAMDATA['team_name']."</b>";
if(ADMIN){						
$text .=	"<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_teams_config.php?edit.".$TEAMDATA['team_id']."' title='".LAN_LEAGUE_TEAMINFO_5."'>
						<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png' alt='' title=''>
							</a>";						
				}	
						
$text .=	"	</td>
						<td class='forumheader' style='width:20%;text-align:left;vertical-align:top' rowspan='4'><img border='0' src='".e_PLUGIN."sport_league_e107/logos/big/".$TEAMDATA['team_icon']."' alt='' title='' width='100'>
						</td>						
					</tr>
					<tr>
						<td class='forumheader3' style='width:20%;text-align:left;vertical-align:top;border-right:0px;border-bottom:0px'>".LAN_LEAGUE_TEAMINFO_6."
						</td>
						<td class='forumheader3' style='width:60%;text-align:left;vertical-align:top;border-right:0px;border-bottom:0px'><b>".$TEAMDATA['team_kurzname']."</b>
						</td>
					</tr>
					<tr>
						<td class='forumheader3' style='width:20%;text-align:left;vertical-align:top;border-right:0px;border-bottom:0px'>".LAN_LEAGUE_TEAMINFO_7."
						</td>
						<td class='forumheader3' style='width:60%;text-align:left;vertical-align:top;border-right:0px;border-bottom:0px'><b>".$TEAMDATA['admin_name']."</b>
						</td>
					</tr>
					<tr>
						<td class='forumheader3' style='width:20%;text-align:left;vertical-align:top;border-right:0px;border-bottom:0px'>".LAN_LEAGUE_TEAMINFO_8."
						</td>
						<td class='forumheader3' style='width:60%;text-align:left;vertical-align:top;border-right:0px;border-bottom:0px'><a target='_blank' href='".$TEAMDATA['team_url']."'>".$TEAMDATA['team_url']."</a>
						</td>
					</tr>
					<tr>
						<td class='forumheader3' style='width:20%;text-align:left;vertical-align:top' colspan='3'>
							<b>".LAN_LEAGUE_TEAMINFO_9."</b><br/> ".$tp->toHTML($TEAMDATA['team_description'],TRUE)."
						</td>
					</tr>
				</table>
<br/><br/>
<div style='cursor:pointer' onclick=\"expandit('exp_stadion')\">
<table style='width:100%' cellspacing='0' cellpadding='0'>
	<tr>
		<td class='fcaption' style='width:100%;text-align:center;'><b> >>".LAN_LEAGUE_TEAMINFO_10."".$TEAMDATA['team_name']." << </b></td>
	</tr>
</table><br/>
</div>
<div id='exp_stadion' style=''><b>".$TEAMDATA['stadions_name']."</b>";
if(ADMIN){						
$text .=	"<a target='_blank' href='".e_PLUGIN."sport_league_e107/admin/admin_stadions_config.php?edit.".$TEAMDATA['stadions_id']."' title='".LAN_LEAGUE_TEAMINFO_5."'>
						<img border='0' src='".e_PLUGIN."sport_league_e107/images/system/edit_16.png' alt='' title=''>
							</a>";						
				}
if($TEAMDATA['stadions_name']=="" ||$TEAMDATA['stadions_ort']==""||$TEAMDATA['stadions_street']=="")
	{
		$text .="<br/>".LAN_LEAGUE_TEAMINFO_11."<br/><br/><br/><br/>";
	}
else{	
$text .="<br/><br/>
				<table style='width:100%' cellspacing='0' cellpadding='0'>
					<tr>
						<td style='width:20%;text-align:left;vertical-align:top;border-right:0px'><b>".LAN_LEAGUE_TEAMINFO_12."</b>
						</td>
						<td style='width:40%;text-align:left;vertical-align:top;border-right:0px'>".$TEAMDATA['stadions_street']."<br/>".$TEAMDATA['stadions_plz']." ".$TEAMDATA['stadions_ort']."<br/>
						</td>
						<td style='width:40%;text-align:right;vertical-align:top' rowspan='5'>";				
		if($TEAMDATA['stadions_image'])
							{						
		$text .="<img border='0' src='".e_PLUGIN."sport_league_e107/stadions_images/".$TEAMDATA['stadions_image']."' alt='' title=''>";
							}
		$text .="</td>						
					</tr>
					<tr>
						<td style='width:20%;text-align:left;vertical-align:top;border-right:0px'><b>".LAN_LEAGUE_TEAMINFO_13."</b>
						</td>
						<td style='width:40%;text-align:left;vertical-align:top;border-right:0px'>".$TEAMDATA['stadions_tel']."
						</td>
					</tr>
					<tr>
						<td style='width:20%;text-align:left;vertical-align:top;border-right:0px'><b>".LAN_LEAGUE_TEAMINFO_14."</b>
						</td>
						<td style='width:40%;text-align:left;vertical-align:top;border-right:0px'> ".$TEAMDATA['stadions_fax']."
						</td>
					</tr>
					<tr>
						<td style='width:20%;text-align:left;vertical-align:top;border-right:0px'><b>".LAN_LEAGUE_TEAMINFO_15."</b>
						</td>
						<td style='width:40%;text-align:left;vertical-align:top;border-right:0px'><a target='_blank' href='".$TEAMDATA['stadions_url']."'>".$TEAMDATA['stadions_url']."</a>
						</td>
					</tr>
					<tr>
						<td style='width:20%;text-align:left;vertical-align:top'><b>".LAN_LEAGUE_TEAMINFO_16."</b>
						</td>
						<td style='width:40%;text-align:left;vertical-align:top'>";

$text .="<a target='_blank' href='"; 
$text .= locator($TEAMDATA);
$text .="'><img border='0' src='".e_PLUGIN."sport_league_e107/images/map.png' title='".LAN_LEAGUE_TEAMINFO_17."'></a>";
$text .=	"</td>
					</tr>
					<tr>
						<td class='forumheader3' style='width:20%;text-align:left;vertical-align:top' colspan='3'>
							<b>".LAN_LEAGUE_TEAMINFO_18."</b><br/> ".$tp->toHTML($TEAMDATA['stadions_description'],TRUE)."
						</td>
					</tr>
				</table><br/>";}
				
	  $qry1="
   	SELECT a.*, ae.*, ac.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_leagues AS ae ON ae.league_id=a.leagueteam_league_id   
   	LEFT JOIN ".MPREFIX."league_saison AS ac ON ac.saison_id=ae.league_saison_id   
   	WHERE a.leagueteam_team_id='".$TEAMDATA['team_id']."' ORDER BY ac.saison_beginn DESC
   			";
   	$saisonscount=0;		
		$sql->db_Select_gen($qry1);
while ($row = $sql-> db_Fetch())
		{
  $SAISONDATA[$saisonscount]['saison_id']= $row['saison_id'];
  $SAISONDATA[$saisonscount]['saison_name']= $row['saison_name'];
  $SAISONDATA[$saisonscount]['saison_beginn']= $row['saison_beginn'];
  $SAISONDATA[$saisonscount]['saison_end']= $row['saison_end'];
  $SAISONDATA[$saisonscount]['league_id']= $row['league_id'];
  $SAISONDATA[$saisonscount]['league_name']= $row['league_name'];
  $SAISONDATA[$saisonscount]['league_saison_id']= $row['league_saison_id'];
  $SAISONDATA[$saisonscount]['league_description']= $row['league_description'];
  $SAISONDATA[$saisonscount]['league_pref1']= $row['league_pref1'];
  $SAISONDATA[$saisonscount]['league_pref2']= $row['league_pref2'];
  $SAISONDATA[$saisonscount]['league_pref3']= $row['league_pref3'];
  $SAISONDATA[$saisonscount]['league_pref4']= $row['league_pref4'];
  $saisonscount++;
		}
$text .=	"</div><br/>				
<div style='cursor:pointer' onclick=\"expandit('exp_ligas')\">
<table style='width:100%' cellspacing='0' cellpadding='0'>
	<tr>
		<td class='fcaption' style='width:100%;text-align:center;'> <b> >> ".LAN_LEAGUE_TEAMINFO_19." << </b></td>
	</tr>
</table>					
</div>
<div id='exp_ligas' style=''>
				<table style='width:100%;border-bottom: solid #000 1px;' cellspacing='0' cellpadding='0'>
				<tr>
						<td class='forumheader' style='width:30%;text-align:center;border-right:0px;border-bottom:0px'>".LAN_LEAGUE_TEAMINFO_20."</td>
						<td class='forumheader' style='width:20%;text-align:center;border-right:0px;border-bottom:0px;'>".LAN_LEAGUE_TEAMINFO_21."</td>
						<td class='forumheader' style='width:20%;text-align:center;border-right:0px;border-bottom:0px;'>".LAN_LEAGUE_TEAMINFO_22."</td>
						<td class='forumheader' style='width:20%;text-align:center;border-right:0px;border-bottom:0px;'>".LAN_LEAGUE_TEAMINFO_23."</td>
						<td class='forumheader' style='width:10%;text-align:center;border-bottom:0px;'>".LAN_LEAGUE_TEAMINFO_24."</td>
					</tr>
				";
for($i=0; $i < $saisonscount; $i++)
		{
$POS=statik($TEAMDATA['team_id'],$SAISONDATA[$i]['league_id']);
if ($POS['POS']=="X")
	{
$POS= arhiv_statik($TEAMDATA['team_id'],$SAISONDATA[$i]['league_id']);		
	}

$text .="<tr>
						<td class='forumheader3' style='text-align:left;border-right:0px;border-bottom:0px;'>".$SAISONDATA[$i]['saison_name']."</td>
						<td class='forumheader3' style='text-align:left;border-right:0px;border-bottom:0px;'><a target='_blank' href='".e_PLUGIN."sport_league_e107/league_table.php?".$SAISONDATA[$i]['saison_id'].".".$SAISONDATA[$i]['league_id']."'>".$SAISONDATA[$i]['league_name']."</a></td>
						<td class='forumheader3' style='text-align:center;border-right:0px;border-bottom:0px;'>".$LIEAGUEPREAF1[$SAISONDATA[$i]['league_pref1']]."</td>
						<td class='forumheader3' style='text-align:center;border-right:0px;border-bottom:0px;'>".$POS['G']."/".$POS['W']."/".$POS['L']."</td>
						<td class='forumheader3' style='vertical-align:middle;text-align:right;padding-right:10px;border-bottom:0px'>";
						if($POS['POS']==1)
							{
				$text .="<img border='0' src='".e_PLUGIN."sport_league_e107/images/pokal.png' alt='' title=''>";				
							}
		$text .="<b>  ".$POS['POS']."</b></td>
					</tr>";
			}
	$text .=	"</table></div><br/><br/>
					";

$text .="<br/>";
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================
$text .="</div>";
$title = "".LAN_LEAGUE_TEAMINFO_25."".$TEAMDATA['team_name']."";
$title .= "";
$ns -> tablerender($title, $text);                                                                              
// ========= End of the BODY ===================================================                                                                                    
require_once(FOOTERF);     


function statik($TEAM_IDS, $SAISON)
{global $sql;
     $sql -> db_Select("league_leagueteams", "*","leagueteam_league_id='".$SAISON."'");
        $count=0;
         while($row = $sql-> db_Fetch())
       			{
						$TEAM[0][$count]=$row['leagueteam_team_id'];
						$TEAM[26][$count]=$row['leagueteam_id'];
						$TEAM[27][$count]=$row['leagueteam_my_team'];
						$count++;
						}

for($i=0;$i < $count; $i++){
     $sql -> db_Select("league_teams", "*","team_id='".$TEAM[0][$i]."' LIMIT 1");
         while($row = $sql-> db_Fetch())
       			{
       			$TEAM[25][$i]=$row['team_id'];
        		$TEAM[1][$i]=$row['team_icon'];
        		$TEAM[2][$i]=$row['team_url'];
        		$TEAM[24][$i]=$row['team_name'];
        		if($pref['sport_league_teamname_menu']==2){$TEAM[3][$i]=$row['team_kurzname'];}
        		else{$TEAM[3][$i]=$row['team_name'];}
       			}
  				}
/////////////-------////////////////////////////
for($i=0;$i < $count; $i++){
			$TEAM[4][$i]= 0;		///ET Home
			$TEAM[5][$i]= 0;		///GT Home
			$TEAM[6][$i]= 0;		///Points
			$TEAM[7][$i]= 0;		///ET	Gast
			$TEAM[8][$i]= 0;		///GT	Gast
			$TEAM[9][$i]= 0;		///ET
			$TEAM[10][$i]= 0;		///GT
			$TEAM[11][$i]= 0;		///Diff
			$TEAM[12][$i]= 0;		///Anzahl Games Home
			$TEAM[13][$i]= 0;		///Anzahl Games Gast
			$TEAM[14][$i]= 0;		///Games
			$TEAM[15][$i]= 0;		///Win Home
			$TEAM[16][$i]= 0;		///Lost Home
			$TEAM[17][$i]= 0;		///Un Home
			$TEAM[18][$i]= 0;		///Win Gast
			$TEAM[19][$i]= 0;		///Lost Gast
			$TEAM[20][$i]= 0;		///Un Gast
			$TEAM[21][$i]= 0;		///Win
			$TEAM[22][$i]= 0;		///Lost
			$TEAM[23][$i]= 0;		///Un
			$TEAM[28][$i]= 0;		///P G
			$TEAM[29][$i]= 0;		///P H
		}
//////////////////////  Punkte Rechnen /////////////////////////////////////
			for($i=0;$i<($count);$i++)
				{
				$sql -> db_Select("league_games","*","game_enable=1 and game_home_id=".$TEAM[26][$i]."");
				while($row = $sql-> db_Fetch())
       			{
						$TEAM[4][$i]=$TEAM[4][$i]+$row['game_goals_home'];
						$TEAM[5][$i]=$TEAM[5][$i]+$row['game_goals_gast'];
						$TEAM[12][$i]=$TEAM[12][$i]+1;
						if($row['game_goals_home']> $row['game_goals_gast'])
						   {
						    if($row['game_un']==true)
						    	{
						    	 $TEAM[6][$i]=$TEAM[6][$i]+$pref['sport_league_points_winer2']; /// Points
						    	 $TEAM[29][$i]=$TEAM[29][$i]+$pref['sport_league_points_winer2'];
						    	 //$TEAM[15][$i]=$TEAM[15][$i]+1;
						    	 $TEAM[17][$i]=$TEAM[17][$i]+1;   //Un Home
						    	}
						   	else
						   		{
						   		$TEAM[6][$i]=$TEAM[6][$i]+$pref['sport_league_points_winer'];
						   		$TEAM[29][$i]=$TEAM[29][$i]+$pref['sport_league_points_winer'];
						   		$TEAM[15][$i]=$TEAM[15][$i]+1;
						   		}
						   }
						elseif($row['game_goals_gast']==$row['game_goals_home'])
								{
								$TEAM[6][$i]=$TEAM[6][$i]+$pref['sport_league_game_unistun'];
								$TEAM[29][$i]=$TEAM[29][$i]+$pref['sport_league_game_unistun'];
							  $TEAM[17][$i]=$TEAM[17][$i]+1;
								} 
						else
							 {
							  if($row['game_un']==true)
							    {
							    $TEAM[6][$i]=$TEAM[6][$i]+$pref['sport_league_points_louser2'];
							    $TEAM[29][$i]=$TEAM[29][$i]+$pref['sport_league_points_louser2'];
							    //$TEAM[16][$i]=$TEAM[16][$i]+1;
							    $TEAM[17][$i]=$TEAM[17][$i]+1;
							    }
						   	else
						   	  {
						   	  $TEAM[6][$i]=$TEAM[6][$i]+$pref['sport_league_points_louser'];
						   	  $TEAM[29][$i]=$TEAM[29][$i]+$pref['sport_league_points_louser'];
						   	  $TEAM[16][$i]=$TEAM[16][$i]+1;
						   	  }
							 }
				  	}
				$sql -> db_Select("league_games","*","game_enable=1 and game_gast_id=".$TEAM[26][$i]."");
				while($row = $sql-> db_Fetch())
       			{
						$TEAM[7][$i]=$TEAM[7][$i]+$row['game_goals_gast'];
						$TEAM[8][$i]=$TEAM[8][$i]+$row['game_goals_home'];
						$TEAM[13][$i]=$TEAM[13][$i]+1;
						if($row['game_goals_gast']> $row['game_goals_home'])
						   {
						    if($row['game_un']==true)
						      {
						    	$TEAM[6][$i]=$TEAM[6][$i]+$pref['sport_league_points_winer2'];
						    	$TEAM[28][$i]=$TEAM[28][$i]+$pref['sport_league_points_winer2'];
						    	//$TEAM[18][$i]=$TEAM[18][$i]+1;
						    	$TEAM[20][$i]=$TEAM[20][$i]+1;
						    	}
						   	else
						   	  {
						   	  $TEAM[6][$i]=$TEAM[6][$i]+$pref['sport_league_points_winer'];
						   	  $TEAM[28][$i]=$TEAM[28][$i]+$pref['sport_league_points_winer'];
						   	  $TEAM[18][$i]=$TEAM[18][$i]+1;
						   	  }
						   }
					elseif($row['game_goals_gast']==$row['game_goals_home'])
								{
								$TEAM[6][$i]=$TEAM[6][$i]+$pref['sport_league_game_unistun'];
								$TEAM[28][$i]=$TEAM[28][$i]+$pref['sport_league_game_unistun'];
							  $TEAM[20][$i]=$TEAM[20][$i]+1;
								} 
						else
							 {
							  if($row['game_un']==true)
							  	{
							  	$TEAM[6][$i]=$TEAM[6][$i]+$pref['sport_league_points_louser2'];
							  	$TEAM[28][$i]=$TEAM[28][$i]+$pref['sport_league_points_louser2'];
							  	//$TEAM[19][$i]=$TEAM[19][$i]+1;
							  	$TEAM[20][$i]=$TEAM[20][$i]+1;
							  	}
						   	else
						   		{
						   		$TEAM[6][$i]=$TEAM[6][$i]+$pref['sport_league_points_louser'];
						   		$TEAM[28][$i]=$TEAM[28][$i]+$pref['sport_league_points_louser'];
						   		$TEAM[19][$i]=$TEAM[19][$i]+1;
						   		}
							 }						
				  	}
				}
/////////////Eigen/Gegen- Tore und Spiele und Diff Ausrechnen /////////////////
			for($i=0;$i<($count);$i++)
				{
				$TEAM[9][$i]= $TEAM[4][$i]+$TEAM[7][$i];		///ET Total
				$TEAM[10][$i]= $TEAM[5][$i]+$TEAM[8][$i];		///GT Total
				$TEAM[14][$i]= $TEAM[12][$i]+$TEAM[13][$i];	///Anzahl Games Total
				$TEAM[11][$i]= $TEAM[9][$i]-$TEAM[10][$i];	///Dif Total
				$TEAM[21][$i]= $TEAM[15][$i]+$TEAM[18][$i];	///Wins Total
				$TEAM[23][$i]= $TEAM[17][$i]+$TEAM[20][$i];	///Un Total
				$TEAM[22][$i]= $TEAM[16][$i]+$TEAM[19][$i];	///Lost Total
				$TEAM[30][$i]= $TEAM[4][$i]-$TEAM[5][$i];	///Dif Home
				$TEAM[31][$i]= $TEAM[7][$i]-$TEAM[8][$i];	///Dif Gast
				}
////////////////Sort ///////////
    for($j=0;$j<($count-1);$j++)
   		{   
      for($i=$j+1;$i<($count);$i++)
   			{
      	if(($TEAM[6][$j]== $TEAM[6][$i])&&(($TEAM[11][$j]< $TEAM[11][$i]))||($TEAM[6][$j]< $TEAM[6][$i]))
        		{
         		for($k=0;$k< 32;$k++)
           		{
           		$zwisch[$k]=$TEAM[$k][$j];
           		}
        		for($k=0;$k< 32;$k++)
           		{
           		$TEAM[$k][$j]=$TEAM[$k][$i];
           		}
        		for($k=0;$k< 32;$k++)
           		{
           		$TEAM[$k][$i]=$zwisch[$k];
           		}
        		}
  			 }
  		} 
/////////////////////////////////// 	
      for($i=0; $i< $count; $i++)
   			{
   			if($TEAM[25][$i]==$TEAM_IDS)
   				{  				
   				$AUSGABE['G']= ($TEAM[14][$i]==0)? "X" : $TEAM[14][$i];
   				$AUSGABE['W']= ($TEAM[21][$i]==0 && $TEAM[14][$i]==0)? "X" : $TEAM[21][$i];
   				$AUSGABE['L']= ($TEAM[22][$i]==0 && $TEAM[14][$i]==0)? "X" : $TEAM[22][$i];	
   				$AUSGABE['POS']= ($AUSGABE['G']!=0)? ($i+1) : "X";
	   			return $AUSGABE; 	
   			  }
   			}	
}
////////////////////////////////////

function locator($ADRESS)
{
	$COUNTRY="Germany";
	
	$href_string ="http://maps.google.com/maps?near=".$ADRESS['stadions_street']."+".$ADRESS['stadions_plz']."+".$ADRESS['stadions_ort']."+".$COUNTRY."";
	


//        if ($ADRESS['locator_city'] <> "") {$href_string .= "city=".trim($ADRESS['locator_city'])."&";}
//        if ($ADRESS['locator_state'] <> "") {$href_string .= "state=".trim($ADRESS['locator_state'])."&";}
//        if ($ADRESS['locator_address1'] <> "") {$href_string .= "address=".trim($ADRESS['locator_address1'])."&";}
//        if ($ADRESS['locator_zipcode'] <> "") {$href_string .= "zip=".trim($ADRESS['locator_zipcode'])."&";}
//        if ($ADRESS['locator_country'] <> "") {$href_string .= "country=".trim($display_country)."&";}
//        // Add zoom factor for MapQuest
//        $href_string .= "zoom=".$zoomfactor;

return $href_string;
}
////////////////////////////////////
function arhiv_statik($TEAM_IDS, $SAISON)
{global $sql;
	$teamscount=0;
	$AUSGABE['G']=0;
	$AUSGABE['W']=0;
	$AUSGABE['L']=0;
	$AUSGABE['POS']=0;
	$sql -> db_Select("league_ligas_arhiv","*","ligas_arhiv_league_id='$SAISON' ORDER BY ligas_arhiv_points DESC");
	while($row = $sql-> db_Fetch())
		{$teamscount++;
		if($row['ligas_arhiv_team_id']==$TEAM_IDS)
			{
			$AUSGABE['G']=$row['ligas_arhiv_games'];
			$AUSGABE['W']=$row['ligas_arhiv_winn'];
			$AUSGABE['L']=$row['ligas_arhiv_lost'];
			$AUSGABE['POS']=$teamscount;
			return $AUSGABE;
			}
		}	
$AUSGABE['G']="X";
$AUSGABE['W']="X";
$AUSGABE['L']="X";	
$AUSGABE['POS']="X";
return $AUSGABE; 	
}

?>