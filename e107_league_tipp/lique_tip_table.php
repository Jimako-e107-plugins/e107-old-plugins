<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        

|    GNU General Public License (http://gnu.org).
|		 Suitable only for e107 v0.7xx
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."e107_league_tipp/languages/".e_LANGUAGE."/liga_tipps_table_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."e107_league_tipp/languages/German/liga_tipps_table_lan.php");
// ------------------------------
$limit=$pref['e107_league_tipp_tabelgames'];
// Voreinstellungen
$ganz=$pref['league_tipp_treffer'];
$tendenz=$pref['league_tipp_tendenz'];
$leer=0;
$timeout=(60 * $pref['league_tipp_timeout']);

if($_GET['Saison']){$SAISON=$_GET['Saison'];}
elseif($_POST['Saison']){$SAISON=$_POST['Saison'];}
else{
$SAISON=$pref['league_tipp_saison'];
} 

// Spiele Laden
if($pref['league_tipp_saison_or_liga']==1)
 {
   $qry="
   SELECT u.*, uh.*, ub.*, ec.*, eh.* FROM ".MPREFIX."league_saison AS u 
   LEFT JOIN ".MPREFIX."league_leagues AS uh ON uh.league_saison_id=u.saison_id 
   LEFT JOIN ".MPREFIX."league_games AS ub ON ub.game_league_id=uh.league_id 
   LEFT JOIN ".MPREFIX."league_leagueteams AS ec ON ec.leagueteam_id=ub.game_home_id
   LEFT JOIN ".MPREFIX."league_teams AS eh ON eh.team_id=ec.leagueteam_team_id
   WHERE u.saison_id='".$SAISON."' AND ub.game_date >0  ORDER BY ub.game_date 
   		";
 }else{
 	
 	  $qry="
   SELECT u.*, ub.*, ec.*, eh.* FROM ".MPREFIX."league_leagues AS u 
   LEFT JOIN ".MPREFIX."league_games AS ub ON ub.game_league_id=u.league_id 
   LEFT JOIN ".MPREFIX."league_leagueteams AS ec ON ec.leagueteam_id=ub.game_home_id
   LEFT JOIN ".MPREFIX."league_teams AS eh ON eh.team_id=ec.leagueteam_team_id
   WHERE u.league_id='".$SAISON."' AND ub.game_date >0  ORDER BY ub.game_date 
   		";
 	}
   			$count=0;
   			 	$sql->db_Select_gen($qry);
   				while($row = $sql-> db_Fetch()){
  				$Game[$count]['games_id']=$row['game_id'];
  				$Game[$count]['games_saison_id']=$row['game_saison_id'];
  				$Game[$count]['games_week']=$row['game_week'];
  				$Game[$count]['games_date']=$row['game_date'];
  				$Game[$count]['games_time']=$row['game_time'];
  				$Game[$count]['games_home_id']=$row['game_home_id'];
  				$Game[$count]['games_gast_id']=$row['game_gast_id'];
  				$Game[$count]['games_goals_home']=$row['game_goals_home'];
  				$Game[$count]['games_goals_gast']=$row['game_goals_gast'];
  				$Game[$count]['games_un']=$row['game_un'];
  				$Game[$count]['games_enable']=$row['game_enable'];
  				$Game[$count]['games_home_name']=$row['team_name'];
  				$Game[$count]['home_team_kurzname']=$row['team_kurzname'];
  				$Game[$count]['home_team_url']=$row['team_url'];
  				$Game[$count]['home_team_icon']=$row['team_icon'];
  				if($Game[$count]['games_date'] < (time()- $timeout)){$Game[$count]['spere']=1;}
  				else{$Game[$count]['spere']=0;}
         	$count++;
         }
//// Woche zuweisen
if($pref['league_tipp_week']==1)
	{
	$week_time=259200;
	}
else{$week_time=129600;}
////////////---------------------------
$weekcount=0;
$weekarea[$weekcount]['begin']=false;
$weekarea[$weekcount]['end']=false;
if($pref['league_tipp_week']!=3)
{
$j=0;
for($i=0; $i < ($count); $i++)
		{
		if(!$weekarea[$weekcount]['begin'])
			{$weekarea[$weekcount]['begin']=$Game[$i]['games_date'];}
		$Game[$i]['week']=$weekcount+1; // Spielwoche
		if(($Game[$i+1]['games_date']-$Game[$j]['games_date']) > $week_time || !$Game[$i+1]['games_date'])
				{$j=$i+1;
				$weekarea[$weekcount]['end']=$Game[$i]['games_date'];
				$weekcount++;
				}
		}
	}	
else
 {
$z=0;
$j=0;
for($i=0; $i < ($count); $i++)
		{$z++;
		if(!$weekarea[$weekcount]['begin'])
			{$weekarea[$weekcount]['begin']=$Game[$i]['games_date'];}
		$Game[$i]['week']=$weekcount+1; // Spielwoche
		if($z==$pref['league_tipp_tabelcount'])
				{$j=$i+1;$z=0;
				$weekarea[$weekcount]['end']=$Game[$i]['games_date'];
				$weekcount++;
			  }
			}
  }	
//// aktuelle Woche
for($i=0; $i < ($count); $i++)
		{
		if($Game[$i]['games_date']>(time()-$week_time)&&$Game[$i]['games_date']<(time()+$week_time))
			{$myweek=$Game[$i]['week'];break;}
		}
if(!$myweek){$myweek=1;}
if($_GET['week']){$myweek=$_GET['week'];}
if($_POST['week']){$myweek=$_POST['week'];}

if(IsSet($_POST['vor']))
	{
	$myweek=$_POST['woche']+1;
	if($myweek> $weekcount+1){$myweek=$weekcount+1;}
	}
if(IsSet($_POST['back']))
	{
	$myweek=$_POST['woche']-1;
	if($myweek< 1){$myweek=1;}
	}
//////////////////
$liste2="<select name='week' size='1' style='width:100%;font-weight: bold;' onChange='this.form.submit()'>";
for($i=1; $i < $weekcount+1; $i++)
		{
		$liste2.="<option ";
		if($i==$myweek)
			{
			$liste2.="selected ";
			}
		$liste2.="value='".$i."'>";
		$liste2.="".$i."".LAN_LEAGUE_TIP_TABLE_15."</option>";
		}
$liste2.="</select>";
/////////////////////
for($i=0; $i < $count; $i++)
		{
		$qry="
   	SELECT v.*, vh.* FROM ".MPREFIX."league_leagueteams AS v 
   	LEFT JOIN ".MPREFIX."league_teams AS vh ON vh.team_id=v.leagueteam_team_id
   	WHERE v.leagueteam_id='".$Game[$i]['games_gast_id']."'
   	";
   	$sql->db_Select_gen($qry);

   	$row = $sql-> db_Fetch();
		$Game[$i]['games_gast_name']=$row['team_name'];
  	$Game[$i]['gast_team_kurzname']=$row['team_kurzname'];
  	$Game[$i]['gast_team_url']=$row['team_url'];
  	$Game[$i]['gast_team_icon']=$row['team_icon'];
		}
// Spiele Laden
   $qry="
   SELECT u.*, uh.* FROM ".MPREFIX."league_tipp_users AS u 
   LEFT JOIN ".MPREFIX."user AS uh ON uh.user_id=u.lique_users_user_id 
   WHERE u.lique_users_user_id!=''
   		";
   			$ucount=0;
   			 	$sql->db_Select_gen($qry);
   				while($row = $sql-> db_Fetch()){
   					$User[$ucount]['id']=$row['lique_users_id'];
   					$User[$ucount]['benutzer_id']=$row['user_id'];
   					$User[$ucount]['name']=$row['user_name'];
   					$User[$ucount]['mail']=$row['user_email'];
   					$ucount++;
   				}

for($j=0; $j < $ucount; $j++)
{
	$User[$j]['MYSUMME']=0;
for($i=0; $i < $count; $i++)
		{
		$sql -> db_Select("league_tipp_tab", "*", "league_tipp_user_id ='".$User[$j]['id']."' AND league_tipp_game_id='".$Game[$i]['games_id']."' ");
		if($row = $sql-> db_Fetch())
			{
			$TIPP[$j][$i]['league_tipp_id']==$row['league_tipp_id'];
			$TIPP[$j][$i]['league_tipp_id']=$row['league_tipp_id'];
  		$TIPP[$j][$i]['mytip_HT']=$row['league_tipp_HT'];
  		$TIPP[$j][$i]['mytip_GT']=$row['league_tipp_GT'];
  		$TIPP[$j][$i]['mytip_data']=$row['league_tipp_date'];
  		
  		if($Game[$i]['games_enable']==1 && $Game[$i]['games_date'] < (time()+$timeout))
  			{
  			if($TIPP[$j][$i]['mytip_HT']==$Game[$i]['games_goals_home']&&$TIPP[$j][$i]['mytip_GT']==$Game[$i]['games_goals_gast'])
  					{
  					$TIPP[$j][$i]['mytip_Point']=$ganz;
  					$User[$j]['MYSUMME']=$User[$j]['MYSUMME']+$TIPP[$j][$i]['mytip_Point'];	
  					}
  			elseif(($TIPP[$j][$i]['mytip_HT']-$TIPP[$j][$i]['mytip_GT'])==($Game[$i]['games_goals_home']-$Game[$i]['games_goals_gast']))
  					{
  					$TIPP[$j][$i]['mytip_Point']=$tendenz;
  					$User[$j]['MYSUMME']=$User[$j]['MYSUMME']+$TIPP[$j][$i]['mytip_Point'];		
  					}
  			elseif((($TIPP[$j][$i]['mytip_HT']-$TIPP[$j][$i]['mytip_GT'])>0 == ($Game[$i]['games_goals_home']-$Game[$i]['games_goals_gast'])>0)&&(($TIPP[$j][$i]['mytip_GT']-$TIPP[$j][$i]['mytip_HT'])>0 == ($Game[$i]['games_goals_gast']-$Game[$i]['games_goals_home'])>0))
  					{
 					$TIPP[$j][$i]['mytip_Point']=$tendenz;
  					$User[$j]['MYSUMME']=$User[$j]['MYSUMME']+$TIPP[$j][$i]['mytip_Point'];
  					}
  			else
  					{
  					$TIPP[$j][$i]['mytip_Point']=0;
  					$User[$j]['MYSUMME']=$User[$j]['MYSUMME']+$TIPP[$j][$i]['mytip_Point'];
  					}
  			}
  		else{$TIPP[$j][$i]['mytip_Point']="999";}				
			}
		else
			{
			$TIPP[$j][$i]['league_tipp_id']=0;
  		$TIPP[$j][$i]['mytip_HT']="x";
  		$TIPP[$j][$i]['mytip_GT']="x";
  		$TIPP[$j][$i]['mytip_data']=time();
  		$TIPP[$j][$i]['mytip_Point']="999";
			}
		}
 $Users[$j]['ID'];
 }

///////////// Sortieren nach punkte

for($i=0; $i < $ucount; $i++)
		{
			for($j=0; $j < $ucount-1; $j++)
				{
					if($User[$i]['MYSUMME']> $User[$j]['MYSUMME'])
						{
						/// Spieler-Daten tauschen	
							
						$ablage_User['id']=$User[$i]['id'];
   					$ablage_User['benutzer_id']=$User[$i]['benutzer_id'];
   					$ablage_User['name']=$User[$i]['name'];
   					$ablage_User['mail']=$User[$i]['mail'];
   					$ablage_User['MYSUMME']=$User[$i]['MYSUMME'];
   					
   					$User[$i]['id']=$User[$j]['id'];
   					$User[$i]['benutzer_id']=$User[$j]['benutzer_id'];
   					$User[$i]['name']=$User[$j]['name'];
   					$User[$i]['mail']=$User[$j]['mail'];
   					$User[$i]['MYSUMME']=$User[$j]['MYSUMME'];
   					
   					$User[$j]['id']=$ablage_User['id'];
   					$User[$j]['benutzer_id']=$ablage_User['benutzer_id'];
   					$User[$j]['name']=$ablage_User['name'];
   					$User[$j]['mail']=$ablage_User['mail'];
   					$User[$j]['MYSUMME']=$ablage_User['MYSUMME'];
   					
   					/// Spiel-Tippsergäbnisse tauschen
   					for($k=0; $k < $count; $k++)
							{
   						$ablage_Tip['league_tipp_id']=$TIPP[$i][$k]['league_tipp_id'];
  						$ablage_Tip['mytip_HT']=$TIPP[$i][$k]['mytip_HT'];
  						$ablage_Tip['mytip_GT']=$TIPP[$i][$k]['mytip_GT'];
  						$ablage_Tip['mytip_data']=$TIPP[$i][$k]['mytip_data'];
  						$ablage_Tip['mytip_Point']=$TIPP[$i][$k]['mytip_Point'];
  						
  						$TIPP[$i][$k]['league_tipp_id']=$TIPP[$j][$k]['league_tipp_id'];
  						$TIPP[$i][$k]['mytip_HT']=$TIPP[$j][$k]['mytip_HT'];
  						$TIPP[$i][$k]['mytip_GT']=$TIPP[$j][$k]['mytip_GT'];
  						$TIPP[$i][$k]['mytip_data']=$TIPP[$j][$k]['mytip_data'];
  						$TIPP[$i][$k]['mytip_Point']=$TIPP[$j][$k]['mytip_Point'];
  						
  						$TIPP[$j][$k]['league_tipp_id']=$ablage_Tip['league_tipp_id'];
  						$TIPP[$j][$k]['mytip_HT']=$ablage_Tip['mytip_HT'];
  						$TIPP[$j][$k]['mytip_GT']=$ablage_Tip['mytip_GT'];
  						$TIPP[$j][$k]['mytip_data']=$ablage_Tip['mytip_data'];
  						$TIPP[$j][$k]['mytip_Point']=$ablage_Tip['mytip_Point'];  						
   						}   					
						}
				}
		}

///////////////////////////////////////////////////////////
$A=strftime("%d %B %Y", $weekarea[$myweek-1]['begin']);
$B=strftime("%d %B %Y", $weekarea[$myweek-1]['end']);
$beg=$begin-1;

$title = "".LAN_LEAGUE_TIP_TABLE_1." ".LAN_LEAGUE_TIP_TABLE_16." <b>".$A."</b> ".LAN_LEAGUE_TIP_TABLE_17." <b>".$B."</b>";

$text.="<div style='text-align:center; vertical-align:top;'>
		<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
			<tr>
				<form action='".e_SELF."' method='post' id='neu'>
				<td class='fcaption' style='text-align: left; width: 10%; border-top: 0px'><input class='button' type='submit' id='submitit' name='back' value='".LAN_LEAGUE_TIP_TABLE_3."' /><input type='hidden' name='woche' value='".$myweek."'></td> 
				<td class='fcaption' style='text-align: right; width: 40%; border-top: 0px'>".LAN_LEAGUE_TIP_TABLE_4.":</td>  
				<td class='fcaption' style='text-align: left; width: 40%; border-top: 0px'>".$liste2."<input type='hidden' name='Saison' value='".$Saison."'></td>      
				<td class='fcaption' style='text-align: right; width: 10%; border-top: 0px'><input class='button' type='submit' id='submitit' name='vor' value='".LAN_LEAGUE_TIP_TABLE_2."' /></td>
				</form>
			</tr>
		</table>
		<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
				<tr>
					<td class='forumheader' style=' text-align:center;'>".LAN_LEAGUE_TIP_TABLE_5."</td>";
$Games_toweek_count=0;
for($j=0; $j < $count; $j++)
		{if($Game[$j]['week']==$myweek){
		$Games_toweek_count++;				
		$text.="<td class='fcaption' style='text-align:center;'>".$DATUM=strftime("%d.%m.%y", $Game[$j]['games_date'])."<br/>".$ZEIT=strftime("%H:%M", $Game[$j]['games_date'])."<br/><a href='".e_PLUGIN."sport_league_e107/league_games.php?Saison=".$SAISON."&&team=".$Game[$j]['games_home_id']."' title='".LAN_LEAGUE_TIP_TABLE_7." ".$Game[$j]['games_home_name']."'>".$Game[$j]['home_team_kurzname']."</a><br/> ".LAN_LEAGUE_TIP_TABLE_8."<br/><a href='".e_PLUGIN."sport_league_e107/league_games.php?Saison=".$SAISON."&&team=".$Game[$j]['games_gast_id']."' title='".LAN_LEAGUE_TIP_TABLE_7." ".$Game[$j]['games_gast_name']."'>".$Game[$j]['gast_team_kurzname']."</a><br/>".$Game[$j]['games_goals_home'].":".$Game[$j]['games_goals_gast']."</td>";
			}
		}
$text.="<td class='forumheader' style='text-align:center;'>".LAN_LEAGUE_TIP_TABLE_6."</td><tr>";
for($i=0; $i < $ucount; $i++)
		{
		$text.="<tr><td class='forumheader'><a href='../../user.php?id.".$User[$i]['id']."'>".$User[$i]['name']."</td>";
		for($j=0; $j < $count; $j++)
				{if($Game[$j]['week']==$myweek){
					if($TIPP[$i][$j]['mytip_Point']==$ganz){$tabelclass="#".$pref['league_tipp_treffer_color']."";}
					elseif($TIPP[$i][$j]['mytip_Point']==$tendenz){$tabelclass="#".$pref['league_tipp_tendenz_color']."";}
					elseif($TIPP[$i][$j]['mytip_HT']=='x'){$tabelclass="#".$pref['league_tipp_noresult_color']."";}
					elseif($TIPP[$i][$j]['mytip_Point']=='999'){$tabelclass="";}
					else{$tabelclass="#".$pref['league_tipp_tabelgames_color']."";}							
				$text.="<td style='border:#444 1px solid;background-color: ".$tabelclass." ; text-align:center;'>";
				if($Game[$j]['spere']!=1 && $TIPP[$i][$j]['mytip_HT']!='x'){
				$text.="?:?";
					}
				else{
				$text.="".$TIPP[$i][$j]['mytip_HT'].":".$TIPP[$i][$j]['mytip_GT']."</td>";}
				 }
				}
$text.="<td class='forumheader' style='text-align:center;'>".$User[$i]['MYSUMME']."</td></tr>";
		}
$text.="</table>";
	if($Games_toweek_count==0){$text.=LAN_LEAGUE_TIP_TABLE_9;$title=LAN_LEAGUE_TIP_TABLE_1;}

$text.="<br/><br/><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
					<tr>
						<td style='border:#444 1px solid;background-color:#".$pref['league_tipp_treffer_color']."; text-align:center;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class='forumheader3'>".$ganz.".".LAN_LEAGUE_TIP_TABLE_11." </td>
					<tr>
					</tr>
						<td style='border:#444 1px solid;background-color:#".$pref['league_tipp_tendenz_color']."; text-align:center;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class='forumheader3'>".$tendenz.".".LAN_LEAGUE_TIP_TABLE_12." </td>
					<tr>
					</tr>
						<td style='border:#444 1px solid;background-color:#".$pref['league_tipp_tabelgames_color']."; text-align:center;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class='forumheader3'>0.".LAN_LEAGUE_TIP_TABLE_13."</td>
					<tr>
					</tr>
						<td style='border:#444 1px solid;background-color:#".$pref['league_tipp_noresult_color']."; text-align:center;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class='forumheader3'>".LAN_LEAGUE_TIP_TABLE_14."</td>
					</tr>
				</table>
				<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
					<tr>
					<td class='fcaption' style='text-align: center; width: 60%; border-top: 0px'>Woche wählen:</td>  
					<td class='fcaption' style='text-align: center; width: 30%; border-top: 0px'><form action='".e_SELF."' method='post' id='neu'>".$liste2." <input type='hidden' name='Saison' value='".$Saison."'></form></td>      
				</tr></table>
			<form method='get' action='league_tipp_login.php' id='back'><input class='button' type='submit' name='back' value='".LAN_LEAGUE_TIP_TABLE_10."' /></form>
				<br/>
				<div class='smalltext' style='width:100%; text-align: center;'>:: Powered by <a target='_blank' href='http://www.e107.4xa.de' title='besuche mich'>e107 LIGA-TIPP</a> - Version 1.5 ::</div>
				<br/>
</div>";
$ns -> tablerender($title, $text);
require_once(FOOTERF);
?>