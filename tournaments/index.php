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

require_once("../../class2.php");
require_once(HEADERF);
//require_once(e_PLUGIN."tournaments/language/".e_LANGUAGE.".php");

if(file_exists(e_PLUGIN."tournaments/language/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."tournaments/language/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."tournaments/language/English.php");
}

if(!USER){
	echo "<br><br>";
	echo "<center><b>You must be logged in to play Arcade Games.";
	echo "<br>Please either log in or if you are not registered click <a href='".e_BASE."signup.php'>here</a> to signup</center></b>";
	require_once(FOOTERF);
	exit;
}

if(isset($_GET['t'])){
	$sql->mySQLresult = @mysql_query("SELECT display_width, display_height, game_filename, game_title, tournament_id, tournament_desc, tournament_prize, tournament_start, tournament_end FROM ".MPREFIX."tournaments_tournaments, ".MPREFIX."tournaments_games WHERE ".MPREFIX."tournaments_games.game_id=".MPREFIX."tournaments_tournaments.game_id AND ".MPREFIX."tournaments_tournaments.tournament_id=".$_GET['t'].";");
	$row = $sql->db_Fetch();
	$now = gettimeofday();
	if($row['tournament_start']> $now['sec']){//upcoming
		echo "<center><br><h1>".TOURNAMENTS_60."</h1></center>";
	}
	else{
		$tournament = $row;
		$sql->mySQLresult = @mysql_query("SELECT ".MPREFIX."tournaments_plays.*, ".MPREFIX."user.user_name FROM ".MPREFIX."user, ".MPREFIX."tournaments_plays WHERE ".MPREFIX."tournaments_plays.tournament_id=".$_GET['t']." AND ".MPREFIX."user.user_id=".MPREFIX."tournaments_plays.player_id;");
		$rows = $sql->db_Rows();
		$players = array();
		for($i=0; $i<$rows; $i++){
			$row = $sql->db_Fetch();
			$players[] = $row;
		}
		usort($players, "sort_players");
		
		$text = "
				<center><br><h2>".$tournament['tournament_desc']."</h2><br>
				".TOURNAMENTS_52.":".$tournament['tournament_prize']."<br><br>
				";
			
		if($tournament['tournament_end'] > $now['sec']){//tournament in progress adding play
			$text .= "<a href='".e_SELF."?t=".$_GET['t']."' onClick='javascript:window.open(\"".e_PLUGIN."tournaments/games/".$tournament['game_filename'].".swf?t=".$_GET['t'].'&u_id='.USERID."\", \"playgame\", \"toolbar=0,location=0,directories=0,status=0, menubar=0,scrollbars=0,resizable=1,width=".$tournament['display_width'].",height=".$tournament['display_height']."\");'><h1>".TOURNAMENTS_68." ".$tournament['game_title']."!</h1></a>";
		}
		if(count($players)==0){
			$text .= "<h3>".TOURNAMENTS_63."</h3>";
		}
		else{
			$text .= "<br><br>
					<table width=50%>
						<tr>
							<td><center><img alt='ribbon' src='".e_PLUGIN."tournaments/images/ribbon_small.gif'></center></td>
							<td><center><h2>".$players[0]['user_name']."</h2></center></td>
							<td><center><img alt='ribbon' src='".e_PLUGIN."tournaments/images/ribbon_small.gif'></center></td>
						</tr>
					</table>
					<br>
					";
			if($tournament['tournament_end'] < $now['sec']){//tournament ended
				$text .= "<center><b><h3>".TOURNAMENTS_62."</h3></b></center>";
			}
			else{
				$text .= "<center><b><h3>".TOURNAMENTS_61."</h3></b></center>";
			}
			$text .= "<br><br>
					<table width=75%>
						<tr>
							<th>".TOURNAMENTS_64."</th><th>".TOURNAMENTS_65."</th><th>".TOURNAMENTS_66."</th>
						</tr>
					";
			
			for($i=0; $i<count($players); $i++){
				if($i==0){
					$text .= "
							<tr bgcolor='#00FF00'>";
				}
				else{
					$text .= "
							<tr bgcolor='#CCCCCC'>";
				}
				$text .= "
							<td><center>".($i+1)."</center></td>
							<td><center>".$players[$i]['user_name']."</center></td>
							<td><center>".$players[$i]['score']."</center></td>
						</tr>
						";
			}
			
			$text .= "</table>";
		}
		
		$text .= "
				<br><br><a href='".e_SELF."'>".TOURNAMENTS_67."</a>
				</center>";
		$ns -> tablerender($tournament['game_title']." ".TOURNAMENTS_59, $text);
	}
	
	require_once(FOOTERF);
	exit;
}

echo "
<center>
<br>
<h1>".TOURNAMENTS_48."</h1>
<br>
</center>
";

$sql->mySQLresult = @mysql_query("SELECT game_title, tournament_id, tournament_desc, tournament_prize, tournament_start, tournament_end FROM ".MPREFIX."tournaments_tournaments, ".MPREFIX."tournaments_games WHERE ".MPREFIX."tournaments_games.game_id=".MPREFIX."tournaments_tournaments.game_id;");
$rows = $sql->db_Rows();
$current_t = array();
$upcoming_t = array();
$ended_t = array();
$now = gettimeofday();

for($i=0; $i<$rows; $i++){
	$row = $sql->db_Fetch();
	if($row['tournament_start'] > $now['sec']){
		$upcoming_t[] = $row;
	}
	elseif($row['tournament_end'] < $now['sec']){
		$ended_t[] = $row;
	}
	else{
		$current_t[] = $row;
	}
}

if(count($current_t) == 0){
	$text = "<center><h2>".TOURNAMENTS_58."</h2></center>";
}
else{

	$text = "
	<center>
	<table width=100%>
		<tr>
			<th>".TOURNAMENTS_50."</th>
			<th>".TOURNAMENTS_52."</th>
			<th>".TOURNAMENTS_53."</th>
			<th>".TOURNAMENTS_54."</th>
			<th>".TOURNAMENTS_95."</th>
		</tr>
	";

	for($i=0; $i<count($current_t); $i++){
		$now = gettimeofday();
		$left = calculate_date_dif($current_t[$i]['tournament_end'], $now['sec']);
		$text .= "
				<tr>
					<td><center><a href='".e_SELF."?t=".$current_t[$i]['tournament_id']."'><u><b>".TOURNAMENTS_87." ".$current_t[$i]['game_title']."</b></u></a></center></td>
					<td><center>".$current_t[$i]['tournament_prize']."</center></td>
					<td><center>".gmstrftime('%Y/%m/%d %I:%M %P', $current_t[$i]['tournament_start'])."</center></td>
					<td><center>".gmstrftime('%Y/%m/%d %I:%M %P', $current_t[$i]['tournament_end'])."</center></td>
					<td><center>".$left['days']."d ".$left['hours']."h ".$left['mins']."m</center></td>
				</tr>
				";
	}

	$text .= "
	</table>
	</center>
	";
}

$ns -> tablerender(TOURNAMENTS_49, $text);

if(count($upcoming_t) == 0){
	$text = "<center><h2>".TOURNAMENTS_58."</h2></center>";
}
else{

	$text = "
	<center>
	<table width=100%>
		<tr>
			<th>".TOURNAMENTS_50."</th>
			<th>".TOURNAMENTS_52."</th>
			<th>".TOURNAMENTS_53."</th>
			<th>".TOURNAMENTS_54."</th>
			<th>".TOURNAMENTS_96."</th>
		</tr>
	";

	for($i=0; $i<count($upcoming_t); $i++){
		$now = gettimeofday();
		$left = calculate_date_dif($upcoming_t[$i]['tournament_start'], $now['sec']);
		$text .= "
				<tr>
					<td><center>".$upcoming_t[$i]['game_title']."</center></td>
					<td><center>".$upcoming_t[$i]['tournament_prize']."</center></td>
					<td><center>".gmstrftime('%Y/%m/%d %I:%M %P', $upcoming_t[$i]['tournament_start'])."</center></td>
					<td><center>".gmstrftime('%Y/%m/%d %I:%M %P', $upcoming_t[$i]['tournament_end'])."</center></td>
					<td><center>".$left['days']."d ".$left['hours']."h ".$left['mins']."m</center></td>
				</tr>
				";
	}

	$text .= "
	</table>
	</center>
	";
}

$ns -> tablerender(TOURNAMENTS_56, $text);

if(count($ended_t) == 0){
	$text = "<center><h2>".TOURNAMENTS_58."</h2></center>";
}
else{

	$text = "
	<center>
	<table width=100%>
		<tr>
			<th>".TOURNAMENTS_50."</th>
			<th>".TOURNAMENTS_52."</th>
			<th>".TOURNAMENTS_53."</th>
			<th>".TOURNAMENTS_54."</th>
		</tr>
	";

	for($i=0; $i<count($ended_t); $i++){
		$text .= "
				<tr>
					<td><center><a href='".e_SELF."?t=".$ended_t[$i]['tournament_id']."'>".$ended_t[$i]['game_title']."</a></center></td>
					<td><center>".$ended_t[$i]['tournament_prize']."</center></td>
					<td><center>".gmstrftime('%Y/%m/%d %I:%M %P', $ended_t[$i]['tournament_start'])."</center></td>
					<td><center>".gmstrftime('%Y/%m/%d %I:%M %P', $ended_t[$i]['tournament_end'])."</center></td>
				</tr>
				";
	}

	$text .= "
	</table>
	</center>
	";
}

$ns -> tablerender(TOURNAMENTS_57, $text);

require_once(FOOTERF);

function sort_players($a, $b){
	if($a['score'] > $b['score']){
		return -1;
	}
	elseif($a['score'] < $b['score']){
		return 1;
	}
	else{
		return 0;
	}
}

function calculate_date_dif($date1, $date2){
	//86400 secs per day
	//3600 secs in hours
	$secs = abs($date1 - $date2);
	$days = floor($secs / 86400);
	$secs = $secs - ($days * 86400);
	$hours = floor($secs / 3600);
	$secs = $secs - ($hours * 3600);
	$mins = floor($secs / 60);
	$hour = array('days' => $days, 'hours' => $hours, 'mins' => $mins);
	return $hour;
}
?>