<?php
/*
+---------------------------------------------------------------+
|     e107 website system
|    GNU General Public License (http://gnu.org).
|		
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."e107_league_tipp/languages/".e_LANGUAGE."/liga_tipps_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."e107_league_tipp/languages/German/liga_tipps_lan.php");
/// Mein ID Hollen 
$sql -> db_Select("league_tipp_users", "*", "lique_users_user_id ='".USERID."' ");		
if($row = $sql-> db_Fetch())
 {
  $MYID=$row['lique_users_id'];
  $MYSTATUS=$row['lique_users_status'];
  
  if($MYSTATUS==2)
  {
if(IsSet($_POST['abgabe'])){

    for($i=0; $i< $_POST['anzahl']; $i++)
    {
    if($_POST['old_'.$i.'']< 1)
    		{
    		$message = ($sql -> db_Insert("league_tipp_tab", "0, ".$_POST['user_'.$i.''].", ".$_POST['game_ID_'.$i.''].", ".$_POST['mytipp_HT_'.$i.''].", ".$_POST['mytipp_GT_'.$i.''].", ".time()."  ")) ? LAN_CREATED : LAN_CREATED_FAILED;	
    		}
		else{
				$message = ($sql -> db_Update("league_tipp_tab", "league_tipp_user_id='".$_POST['user_'.$i.'']."', league_tipp_game_id='".$_POST['game_ID_'.$i.'']."', league_tipp_HT='".$_POST['mytipp_HT_'.$i.'']."', league_tipp_GT='".$_POST['mytipp_GT_'.$i.'']."', league_tipp_date='".time()."' WHERE league_tipp_id='".$_POST['old_'.$i.'']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
				}
    }
}

// Voreinstellungen
$limit=60;
$ganz=$pref['league_tipp_treffer'];
$tendenz=$pref['league_tipp_tendenz'];
$leer=$pref['league_tipp_tendenz'];
$SAISON=$pref['league_tipp_saison'];

$timeout=(60 * $pref['league_tipp_timeout']);
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
  				if($Game[$count]['games_date'] < (time()+$timeout)){$Game[$count]['spere']=1;}
  				else{$Game[$count]['spere']=0;}
         	$count++;
         }
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
$MYSUMME=0;
for($i=0; $i < $count; $i++)
		{
		$sql -> db_Select("league_tipp_tab", "*", "league_tipp_user_id ='".$MYID."' AND league_tipp_game_id='".$Game[$i]['games_id']."' ");
		if($row = $sql-> db_Fetch())
			{
			$Game[$i]['league_tipps_id']=$row['league_tipp_id'];
  		$Game[$i]['mytipp_HT']=$row['league_tipp_HT'];
  		$Game[$i]['mytipp_GT']=$row['league_tipp_GT'];
  		$Game[$i]['mytipp_data']=$row['league_tipp_date'];
  		
  		if($Game[$i]['games_enable']==1 && $Game[$i]['games_date'] < (time()+$timeout))
  			{
  			if($Game[$i]['mytipp_HT']==$Game[$i]['games_goals_home']&&$Game[$i]['mytipp_GT']==$Game[$i]['games_goals_gast'])
  					{
  					$Game[$i]['mytipp_Point']=$ganz;
  					$MYSUMME=$MYSUMME+$Game[$i]['mytipp_Point'];	
  					}
  			elseif(($Game[$i]['mytipp_HT']-$Game[$i]['mytipp_GT'])==($Game[$i]['games_goals_home']-$Game[$i]['games_goals_gast']))
  					{
  					$Game[$i]['mytipp_Point']=$tendenz;
  					$MYSUMME=$MYSUMME+$Game[$i]['mytipp_Point'];		
  					}
  			elseif((($Game[$i]['mytipp_HT']-$Game[$i]['mytipp_GT'])>0 == ($Game[$i]['games_goals_home']-$Game[$i]['games_goals_gast'])>0)&&(($Game[$i]['mytipp_GT']-$Game[$i]['mytipp_HT'])>0 == ($Game[$i]['games_goals_gast']-$Game[$i]['games_goals_home'])>0))
  					{
 					$Game[$i]['mytipp_Point']=$tendenz;
  					$MYSUMME=$MYSUMME+$Game[$i]['mytipp_Point'];
  					}
  			else
  					{
  					$Game[$i]['mytipp_Point']=0;
  					$MYSUMME=$MYSUMME+$Game[$i]['mytipp_Point'];
  					}
  			}
  		else{$Game[$i]['mytipp_Point']="x";}				
			}
		else
			{
			$Game[$i]['league_tipps_id']=0;
  		$Game[$i]['mytipp_HT']="x";
  		$Game[$i]['mytipp_GT']="x";
  		$Game[$i]['mytipp_data']=time();
  		$Game[$i]['mytipp_Point']="x";
			}
		}

//// Woche zuweisen /////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// Ausgabe---------------------------------------------

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
		</table>";



$text.="<form method='post' action='".e_SELF."' id='tipabgabe'>
				<div style='width:100%; text-align:center;'>
				<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
				<tr>
					<td class='fcaption' style='text-align:center'>".LAN_LEAGUE_TIPPS_2."</td>
					<td class='fcaption' style='text-align:center'>".LAN_LEAGUE_TIPPS_3."</td>
					<td class='fcaption' style='text-align:center'>".LAN_LEAGUE_TIPPS_4."</td>
					<td class='fcaption' style='text-align:center'>".LAN_LEAGUE_TIPPS_5."</td>
					<td class='fcaption' style='text-align:center'>".LAN_LEAGUE_TIPPS_6."</td>
					<td class='fcaption' colspan='2' style='text-align:center'>".LAN_LEAGUE_TIPPS_7."</td>
					<td class='fcaption' style='text-align:center'>".LAN_LEAGUE_TIPPS_8."</td>
				<tr>
				";
$colcount=0;
for($i=0; $i < $count; $i++)
		{
		if($Game[$i]['week']!=$myweek){continue;}	
		if($Game[$i]['spere']==1){$tabstyle="forumheader3";}else{$tabstyle="forumheader2";}
			
		$text.="
				<tr>
					<td class='".$tabstyle."' style='padding:5px;text-align:center;border-top:0px;border-right:0px;'>".strftime("%a %d.%b.%y",$Game[$i]['games_date'])."</td>
					<td class='".$tabstyle."' style='text-align:center;border-top:0px;border-right:0px;'>".strftime("%H:%M",$Game[$i]['games_date'])."</td>
					<td class='".$tabstyle."' style='text-align:right;border-top:0px;border-right:0px;'><a href='".e_PLUGIN."lique/lique_games.php?Saison=".$SAISON."&&team=".$Game[$i]['games_home_id']."' title='".LAN_LEAGUE_TIPPS_10." ".$Game[$i]['games_home_name']."'>".$Game[$i]['games_home_name']."</a> <a href='".e_PLUGIN."lique/lique_stats.php?team_a=".$Game[$i]['games_home_id']."&&team_b=".$Game[$i]['games_gast_name']."' title='".LAN_LEAGUE_TIPPS_9."'>vs.</a> </td>
					<td class='".$tabstyle."' style='text-align:left;border-top:0px;border-right:0px;border-left:0px;'><a href='".e_PLUGIN."lique/lique_games.php?Saison=".$SAISON."&&team=".$Game[$i]['games_gast_id']."' title='".LAN_LEAGUE_TIPPS_10." ".$Game[$i]['games_gast_name']."'>".$Game[$i]['games_gast_name']."</a></td>";

		if($Game[$i]['games_enable']==1)
			{
			$text.="<td class='".$tabstyle."' style='border-top:0px;border-right:0px;text-align:center;padding: 0px;'><b>(<a href='".e_PLUGIN."lique/startseite.php?game_id=".$Game[$i]['games_id']."'title='".LAN_LEAGUE_TIPPS_11."'>".$Game[$i]['games_goals_home'].":".$Game[$i]['games_goals_gast']."</a>)</b></td>";
			}
		else{$text.="<td class='".$tabstyle."' style='border-top:0px;border-right:0px;text-align:center;padding: 0px;'><b>(".$Game[$i]['games_goals_home'].":".$Game[$i]['games_goals_gast'].")</b></td>";}
					                    
if($Game[$i]['spere']!=1)
				{
				$text.="
					<td class='".$tabstyle."' style='text-align:right;border-top:0px;border-right:0px;'><input name='anzahl' type='hidden' value='".$count."'><input name='game_ID_".$colcount."' type='hidden' value='".$Game[$i]['games_id']."'><input name='mytipp_HT_".$colcount."' type='textarea' size='2' style='width:30px;text-align:right' maxlength='3' value='".$Game[$i]['mytipp_HT']."'>:</td>
					<td class='".$tabstyle."' style='text-align:left;padding-left:0px;border-left:0px;border-top:0px;border-right:0px;'><input name='old_".$colcount."' type='hidden' value='".$Game[$i]['league_tipps_id']."'><input name='user_".$colcount."' type='hidden' value='".$MYID."'><input name='mytipp_GT_".$colcount."' type='textarea' size='2' style='width:30px' maxlength='3' value='".$Game[$i]['mytipp_GT']."'></td>";	
				$colcount++;
				}		
		else{					
				$text.="<td class='".$tabstyle."' style='text-align:center;border-top:0px;border-right:0px;' colspan='2'>".$Game[$i]['mytipp_HT'].":".$Game[$i]['mytipp_GT']."</td>";
				}		
		if($Game[$i]['mytipp_Point']==$ganz){$tabelclass="#".$pref['league_tipp_treffer_color']."";}
					elseif($Game[$i]['mytipp_Point']==$tendenz){$tabelclass="#".$pref['league_tipp_tendenz_color']."";}
					elseif($Game[$i]['mytipp_Point']=='x'){$tabelclass="#".$pref['league_tipp_tabelgames_color']."";}
					else{$tabelclass="";}							
				$text.="<td style='background-color: ".$tabelclass."; text-align:center;'>".$Game[$i]['mytipp_Point']."</td><tr>";
		}
$text.="</table>
				<table style='width:100%' cellspacing='0' cellpadding='0'>
					<tr>
						<td style='width:50%;text-align:right;vertical-align:top;padding-right:5px;padding-top:5px;'>
							<input class='button' type='submit' name='abgabe' value='".LAN_LEAGUE_TIPPS_12."'/></form>
						</td><form method='get' action='league_tipp_login.php' id='back'>
						<td style='width:50%;text-align:left;vertical-align:top;padding-left:5px;padding-top:5px;'>
							<input class='button' type='submit' name='back' value='".LAN_LEAGUE_TIPPS_13."'/></form>
						</td>
					</tr>
				</table>";
 		}
 elseif($MYSTATUS==3)
 	{
 	$text="<div style='width:100%; text-align:center;'><br/><br/>".LAN_LEAGUE_TIPPS_14."<br/><br/><br/>";
 	}
 else{$text="<div style='width:100%; text-align:center;'><br/><br/>".LAN_LEAGUE_TIPPS_15."<br/><br/><br/>";
	}
 }
else{$text=LAN_LEAGUE_TIPPS_16;}
$text.="<br/><br/>
				<div class='smalltext' style='width:100%; text-align: center;'>:: Powered by <a target='_blank' href='http://www.e107.4xa.de' title='besuche mich'>e107 LIGA-TIPP</a> - Version 1.5 ::</div>
				<br/>
				</div>";
$title = LAN_LEAGUE_TIPPS_1;//"<b>Tipp- Abgabe</b>";
$ns -> tablerender($title, $text);
require_once(FOOTERF);
?>