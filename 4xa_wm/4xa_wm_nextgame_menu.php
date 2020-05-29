<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v0.9 - by ***RuSsE*** (www.e107.4xA.de)
|	released 28.06.2011
|	sorce: ../../4xa_wm/4xa_wm_nextgame_menu.php
|	
|        	For the e107 website system
|        	Steve Dunstan
|        	http://e107.org
|        	jalist@e107.org
|
|        	Released under the terms and conditions of the
|        	GNU General Public License (http://gnu.org).
|				
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
$lan_file = e_PLUGIN."4xa_wm/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xa_wm/languages/German.php");


if($pref['4xa_wm_menu_timer_value']==3){$multiplicator=604800;} //Wochen
elseif($pref['4xa_wm_menu_timer_value']==2){$multiplicator=86400;} //Tagen
else{$multiplicator=3600;} //Minuten

$Zeitfenster= ($pref['4xa_wm_menu_timer']*$multiplicator); // 172800 sind 48 Stunden also zeigen alle Spiele die in den Nächsten 48 Stunden gespielt werden!
$Zeit_von=(time()-($pref['4xa_wm_gametime']*60)); // 5400 sind 90 Min. also zeigen bis das Spiel zu ende ist!
$Zeit_bis=(time()+$Zeitfenster);
$menu_sql= new db;
$mtotal = $menu_sql->db_Count("4xa_wm_games", "(*)", "WHERE game_id!='0'");

$text= "<div style='font-size:70%; text-align:center;'>".LAN_4xA_SPORTTIPPS_173."<br/>".LAN_4xA_SPORTTIPPS_174."".strftime('%d.%m.%Y  %H:%M Uhr',$Zeit_von)."<br/>".LAN_4xA_SPORTTIPPS_175."".strftime('%d.%m.%Y  %H:%M Uhr',$Zeit_bis)."</div>";

if($mtotal > 0)
	{
	$qry="SELECT a.*, b.*, c.*, d.*, e.*,f.* FROM ".MPREFIX."4xa_wm_games AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams_in_groups AS b ON b.teams_in_groups_id=a.home
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS c ON c.team_id=b.team_id
    	LEFT JOIN ".MPREFIX."4xa_wm_groups AS d ON d.group_id=a.group_pre
   		LEFT JOIN ".MPREFIX."4xa_wm_rounds AS e ON e.round_id=a.rounde
   		LEFT JOIN ".MPREFIX."4xa_wm_stadions AS f ON f.stadion_id=a.stadion
   		WHERE a.timeof_game >'".$Zeit_von."' AND a.timeof_game <'".$Zeit_bis."' ORDER BY a.timeof_game";
		$menu_sql->db_Select_gen($qry);
		$counter=0;
		$MY_FLAG=FALSE;

	while($row = $menu_sql-> db_Fetch())
		{
		$my_game[$counter]=$row;
		$my_game[$counter]['home_tid']=$row['team_id'];
		$my_game[$counter]['home_name']=$row['team_name'];
		$my_game[$counter]['home_icon']=$row['team_icon'];
		if($row['team_id'] < 1)
			{
			$my_game[$counter]['home_name']=$row['teams_virtual_name'];
			$my_game[$counter]['home_icon']="active.gif";	
			}
		if(($my_game[$counter]['timeof_game']-$condown) > time()){$MY_FLAG=TRUE;}
		$counter++;
		}
	for($i=0; $i < $counter; $i++)
		{
		$qry="SELECT a.*, b.* FROM ".MPREFIX."4xa_wm_teams_in_groups AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS b ON b.team_id=a.team_id
   		WHERE a.teams_in_groups_id='".$my_game[$i]['guest']."'LIMIT 1";   		
	$menu_sql->db_Select_gen($qry);
	$row = $menu_sql-> db_Fetch();

	if($row['team_id'] < 1)
		{
		$my_game[$i]['gast_name']=$row['teams_virtual_name'];
		$my_game[$i]['gast_icon']="active.gif";	
		continue;
		}
	else{
	$my_game[$i]['gast_tid']=$row['team_id'];
	$my_game[$i]['gast_name']=$row['team_name'];
	$my_game[$i]['gast_icon']=$row['team_icon'];
			}
		}

if($counter >0)
	{
$text.="<div style='width:100%;text-align:center;'>
 				<table style='width:100%' class='' cellspacing='0' cellpadding='0'>";
	for($i=0; $i < $counter; $i++)
		{
		 $text.=" <tr>
								<td class='".$pref['4xa_wm_tablestyle4']."' style='text-align:center;' colspan='2'>".LAN_4xA_SPORTTIPPS_003."<b>".strftime('%A %d.%m.%Y',$my_game[$i]['timeof_game'])."</b></td>
   						</tr>
		 					<tr>
								<td class='".$pref['4xa_wm_tablestyle4']."' style='text-align:center;' colspan='2'>".LAN_4xA_SPORTTIPPS_004."<b>".strftime('%H:%M',$my_game[$i]['timeof_game'])."</b> ".LAN_4xA_SPORTTIPPS_005."</td>
   						</tr>
		 					<tr>
								<td class='".$pref['4xa_wm_tablestyle5']."' style='text-align:center;border-botom:#ccc 1px dashed;'><img src='".e_PLUGIN."4xa_wm/img_teams/".$my_game[$i]['home_icon']."' alt='".$my_game[$i]['home_name']."' title='".$my_game[$i]['home_name']."' border='0'></td>
								<td class='".$pref['4xa_wm_tablestyle5']."' style='text-align:left;border-botom:#ccc 1px dashed;'>".$my_game[$i]['home_name']."</td>
   						</tr>
   						<tr>
								<td class='".$pref['4xa_wm_tablestyle5']."' style='text-align:center;'><img src='".e_PLUGIN."4xa_wm/img_teams/".$my_game[$i]['gast_icon']."' alt='".$my_game[$i]['gast_name']."' title='".$my_game[$i]['gast_name']."' border='0'></td>
								<td class='".$pref['4xa_wm_tablestyle5']."' style='text-align:left;'>".$my_game[$i]['gast_name']."</td>
   						</tr>
   						<tr>
								<td class='".$pref['4xa_wm_tablestyle4']."' style='text-align:center;' colspan='2'>In ".$my_game[$i]['stadion_ort']."</td>
   						</tr>
   						<tr>
								<td class='".$pref['4xa_wm_tablestyle4']."' style='text-align:center;' colspan='2'><img src='".e_PLUGIN."4xa_wm/img_stations/".$my_game[$i]['stadion_icon']."' alt='".$my_game[$i]['stadion_ort']."' title='".$my_game[$i]['stadion_ort']."' border='0'></td>
   						</tr>";
   		   	if(USER)
   		{
   		$text.=" <tr>
								<td class='".$pref['4xa_wm_tablestyle3']."' style='text-align:center;' colspan='2'>
								<a href='".e_PLUGIN."4xa_wm/gamelist.php?".$my_game[$i]['round_id']."'><b>".LAN_4xA_SPORTTIPPS_176."</b></a>
								</td>
   						</tr>";
   		}
   		$text.="	<tr>
								<td class='' style='text-align:center;border:0px;' colspan='2'><br/>---<br/></td>
   						</tr>
   						";
		
		}
$text.="</table></div>";
	}
else{
		if(($Zeitfenster / 86400) <= 2 )
				{
				$TIMER=	round(($Zeitfenster / 3600),0)." ".LAN_4xA_SPORTTIPPS_177.".";
				}
		else{
				$TIMER=	round(($Zeitfenster / 86400),0)." ".LAN_4xA_SPORTTIPPS_178.".";
				}
		$text.="<div style='text-align:center;'>".LAN_4xA_SPORTTIPPS_179."".$TIMER;
		$text.="<br/><br/>";
		$text.="<a href='".e_PLUGIN."4xa_wm/gamelist.php'>
					<img src='".e_PLUGIN."4xa_wm/images/logo.png".$my_game[$i]['home_icon']."' alt='' title='' border='0'><br/><br/>
						<b>".LAN_4xA_SPORTTIPPS_180."</b></a>";
		}
	}
else{
	$text.=LAN_4xA_SPORTTIPPS_181;
	}
/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!   
$text.="<br/><br/><font style='font-size:60%;'>.:: powered by <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>".LAN_4xA_SPORTTIPPS_NAME."</a> v.".LAN_4xA_SPORTTIPPS_VERS." ::.</font></div>";
////////////////////////////////////////
$ns->tablerender(LAN_4xA_SPORTTIPPS_182, $text);
//----------------------------------------//----------------------------------------
?>