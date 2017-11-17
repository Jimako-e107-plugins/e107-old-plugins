<?php
/*
+---------------------------------------------------------------+
|        Tournaments plugin for e107 v0.7
|
|        A plugin for the e107 website system
|        http://www.e107.org/
|
|        ©Stratos Geroulis
|        http://www.stratosector.net/
|        stratosg@stratosector.net
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

/*
| This menu will only show up during an ongoing tournament or if there is an upcoming one
| if there is no ongoing tournament and no upcoming one it will not show at all
*/

if(file_exists(e_PLUGIN."tournaments/language/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."tournaments/language/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."tournaments/language/English.php");
}

$text = "";

$tournaments = get_current_tournaments();

if(count($tournaments) > 0){//then should show up
	
	$text .= "<center><b>".TOURNAMENTS_89."</b>";
	$text .= "<br><a href='".e_PLUGIN."tournaments/index.php'><img src='".e_PLUGIN."tournaments/images/play.gif'></a>";//disable image bu commenting out this line
	$text .= "<br><table width=100%>";
	$text .= "<tr>";
	$text .= "<th>".TOURNAMENTS_90."</th><th>".TOURNAMENTS_91."</th>";
	$text .= "</tr>";
	foreach($tournaments as $cur_tournament){
		$text .= "<tr>";
		$text .= "<td><center><b><a href='".e_PLUGIN."tournaments/index.php?t=".$cur_tournament['tournament_id']."'>".$cur_tournament['game_title']."</a></b></center></td>";
		$text .= "<td><center>".$cur_tournament['user_name']."</center></td>";
		$text .= "</tr>";
	}
	$text .= "</table></center>";
}

$upcoming_tournaments = get_upcoming_tournaments();

if(count($upcoming_tournaments) > 0){//disable the upcoming tournaments by replacing count($upcoming_tournaments) width false
	$text .= "<br><center><b>".TOURNAMENTS_92."</b><br>";
	
	$text .= "<table width=100%>";
	$text .= "<tr>";
	$text .= "<th>".TOURNAMENTS_93."</th><th>".TOURNAMENTS_94."</th>";
	$text .= "</tr>";
	foreach($upcoming_tournaments as $tournament){
		$text .= "<tr>";
		$text .= "<td><center>".$tournament['game_title']."</center></td>";
		$text .= "<td><center>".gmstrftime('%Y/%m/%d %I:%M %P', $tournament['tournament_start'])."</center></td>";
		$text .= "</tr>";
	}
	$text .= "</table></center>";
}

if($text != ""){//show only if tournament running or upcoming
	$ns -> tablerender(TOURNAMENTS_88, $text);
}

function get_upcoming_tournaments(){
	global $sql;
	
	$tournaments = array();
	
	$now = gettimeofday();
	$sql->mySQLresult = @mysql_query("SELECT tournament_start, game_title FROM ".MPREFIX."tournaments_tournaments, ".MPREFIX."tournaments_games WHERE ".MPREFIX."tournaments_tournaments.game_id = ".MPREFIX."tournaments_games.game_id AND ".MPREFIX."tournaments_tournaments.tournament_start > ".$now['sec'].";");
	$i=0;
	while($row = $sql->db_Fetch()){
		$tournaments[$i]['tournament_start'] = $row['tournament_start'];
		$tournaments[$i]['game_title'] = $row['game_title'];
		$i++;
	}
	
	return $tournaments;
}

function get_current_tournaments(){
	global $sql;
	$tournament = array();
	$now = gettimeofday();
	
	$sql->mySQLresult = @mysql_query("SELECT game_title, user_name, score, ".MPREFIX."tournaments_tournaments.tournament_id FROM ".MPREFIX."tournaments_tournaments, ".MPREFIX."tournaments_games, ".MPREFIX."tournaments_plays, ".MPREFIX."user WHERE ".MPREFIX."tournaments_tournaments.game_id = ".MPREFIX."tournaments_games.game_id AND ".MPREFIX."user.user_id = ".MPREFIX."tournaments_plays.player_id AND ".MPREFIX."tournaments_tournaments.tournament_id = ".MPREFIX."tournaments_plays.tournament_id AND ".MPREFIX."tournaments_tournaments.tournament_end > ".$now['sec']." AND ".MPREFIX."tournaments_tournaments.tournament_start < ".$now['sec'].";");
	while($row = $sql->db_Fetch()){
		if(isset($tournament['tournament_id'])){
			//tournament previous score check if update needed
			if($tournament['tournament_id']['score'] < $row['score']){//should update
				$tournament['tournament_id']['game_title'] = $row['game_title'];
				$tournament['tournament_id']['user_name'] = $row['user_name'];
				$tournament['tournament_id']['score'] = $row['score'];
				$tournament['tournament_id']['tournament_id'] = $row['tournament_id'];
			}
		}
		else{
			$tournament['tournament_id']['game_title'] = $row['game_title'];
			$tournament['tournament_id']['user_name'] = $row['user_name'];
			$tournament['tournament_id']['score'] = $row['score'];
			$tournament['tournament_id']['tournament_id'] = $row['tournament_id'];
		}
	}
	
	return $tournament;
}

?>