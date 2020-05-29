<?php
/*
+------------------------------------------------------------------------------+
+------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit(); }

$Timeinterval=432000; // 5-Days;  7-Days=>604800;   3-Days=>259200;  
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/e_last_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/e_last_lan.php");
$LIGid = $pref['league_my_saison'];
$GamesCC=0;
$GamesCD=0;
   $qry1="
   SELECT a.*, b.*, c.* FROM ".MPREFIX."league_games AS a 
   LEFT JOIN ".MPREFIX."league_leagues AS b ON b.league_id=a.game_league_id
   LEFT JOIN ".MPREFIX."league_saison AS c ON c.saison_id=b.league_saison_id
   WHERE c.saison_id='".$LIGid."' AND a.game_date > ".(time()-$Timeinterval)." AND a.game_date < ".(time()+$Timeinterval)." ORDER BY a.game_date
   		";
		$sql->db_Select_gen($qry1);	
	 	while($row = $sql-> db_Fetch())
	 			{
				$games[$GamesCC]=$row;
				$GamesCC++;
				}
for($i=0; $i< $GamesCC ; $i++)
		{
			if (!$games[$i]['game_enable'])
				{
				$GamesCD++;
				}
		}
if ($GamesCC > 0) {
	$text.= "<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."sport_league_e107/images/system/date.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' /> ";
	$text .= "".LAN_LEAGUE_LAST_000.": <a href='".e_PLUGIN."sport_league_e107/league_games.php?Liga=".$games[0]['league_id']."'>".$GamesCC."</a><br/>";
	$text .= "<img src='".e_PLUGIN."sport_league_e107/images/system/date_error.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' />
".LAN_LEAGUE_LAST_002.": <a href='".e_PLUGIN."sport_league_e107/admin/admin_games_config.php?list.".$games[0]['league_id']."'>".$GamesCD."</a><br/>";
}
else{
$text.= "<div style='padding-bottom: 2px;'><img src='".e_PLUGIN."sport_league_e107/images/system/date_magnify.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' />".LAN_LEAGUE_LAST_003."";
}
$text .= '</div>';
?>
