<?
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        Â©Steve Dunstan 2001-2006
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/league_links_menu.php
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
$text = "";
require_once("../../class2.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/league_link_menu_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/league_link_menu_lan.php"); 
if(file_exists(e_PLUGIN."sport_league_e107/handler/Scroll_main15.js")){
echo "<script type='text/javascript' src='".e_PLUGIN."sport_league_e107/handler/Scroll_main15.js' language='JavaScript1.2'></script>";
} 
require_once(e_PLUGIN."sport_league_e107/functionen.php");
///////////////////////////////////
$text="";
$expand_autohide = "display:none; ";    
$text="";
$sql -> db_Select("league_saison", "*","saison_name!='' ORDER BY saison_order DESC");
$saisoncount=0;
while($row = $sql-> db_Fetch())
	 		{
			$SAISON[$saisoncount]['saison_name']=$row['saison_name'];
			$SAISON[$saisoncount]['saison_id']=$row['saison_id'];
			$saisoncount++;
			}
if($saisoncount > 0)
	{
	for($i=0; $i< $saisoncount; $i++)	
			{
			$text .="<div class='forumheader' style='cursor:pointer' onclick=\"expandit('exp_saison_".$SAISON[$i]['saison_id']."')\"><b><img border='0' src='".THEME."images/bullet2.gif'>  ".$SAISON[$i]['saison_name']."</b></div>
						<div id='exp_saison_".$SAISON[$i]['saison_id']."' style='".$expand_autohide."'>
							";				
			$sql -> db_Select("league_leagues", "*","league_saison_id='".$SAISON[$i]['saison_id']."' ORDER BY league_name");
			$ligacount=0;
			while($row = $sql-> db_Fetch())
	 			{
				$LIGA[$i][$ligacount]['league_name']=$row['league_name'];
				$LIGA[$i][$ligacount]['saison_id']=$row['league_saison_id'];
				$LIGA[$i][$ligacount]['league_id']=$row['league_id'];
				$LIGA[$i][$ligacount]['league_pref1']=$row['league_pref1'];
				$LIGA[$i][$ligacount]['league_pref2']=$row['league_pref2'];
				$LIGA[$i][$ligacount]['league_pref3']=$row['league_pref3'];
				$ligacount++;
				}
			$SAISON[$i]['ligacount']=$ligacount;
			if($SAISON[$i]['ligacount'] > 0)
				{
				 for($j=0; $j< $SAISON[$i]['ligacount']; $j++)	
					{ 
				 	$text .="<div class='forumheader3' style='cursor:pointer' onclick=\"expandit('exp_Liga_".$LIGA[$i][$j]['saison_id']."_".$LIGA[$i][$j]['league_id']."')\">    <img border='0' src='".THEME."images/bullet2.gif'> <b>".$LIGA[$i][$j]['league_name']."</b></div>				 	
				 	<div id='exp_Liga_".$LIGA[$i][$j]['saison_id']."_".$LIGA[$i][$j]['league_id']."' style='".$expand_autohide."'>
				 		<div class='forumheader2'><a href='".e_PLUGIN."sport_league_e107/league_teams.php?".$LIGA[$i][$j]['saison_id'].".".$LIGA[$i][$j]['league_id']."' Title=''>".LAN_LEAGUE_NAV_4."</a></div>
				 		<div class='forumheader2'><a href='".e_PLUGIN."sport_league_e107/league_table.php?".$LIGA[$i][$j]['saison_id'].".".$LIGA[$i][$j]['league_id']."' Title=''>".LAN_LEAGUE_NAV_5."</a></div>
				 		<div class='forumheader2'><a href='".e_PLUGIN."sport_league_e107/league_games.php?Liga=".$LIGA[$i][$j]['league_id']."' Title=''>".LAN_LEAGUE_NAV_6."</a></div>
				 		<div class='forumheader2'><a href='".e_PLUGIN."sport_league_e107/league_calendar.php?Liga=".$LIGA[$i][$j]['league_id']."' Title=''>".LAN_LEAGUE_NAV_7."</a></div>	
				 	</div>				 	
				 	";
					}
				}
				else{$text .=LAN_LEAGUE_NAV_3;}
			$text .="</div>";
			}
	}	
else{
$text=LAN_LEAGUE_NAV_2;
		}
$title = LAN_LEAGUE_NAV_1;
$ns ->tablerender($title, $text, 'league_nav_menu');
require_once(FOOTERF);
?>