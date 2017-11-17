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

require_once("../../../class2.php");

if(file_exists(e_PLUGIN."tournaments/language/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."tournaments/language/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."tournaments/language/English.php");
}

$text = "";
$cheating = FALSE;

$url = parse_url($_SERVER['HTTP_REFERER']);
parse_str($url['query'], $t);

$sql->mySQLresult = @mysql_query("SELECT tournament_start, tournament_end FROM ".MPREFIX."tournaments_tournaments WHERE tournament_id=".$t['t'].";");
$row = $sql->db_Fetch();
$tournament_start = $row['tournament_start'];
$tournament_end = $row['tournament_end'];

$now = gettimeofday();

if($now['sec'] > $tournament_end || $now['sec'] < $tournament_start){
	$cheating = TRUE;
}

if ($_SERVER['HTTP_REFERER'] != "") {
	if (strpos($_SERVER['HTTP_REFERRER'], $SERVER['HTTP_HOST']) > 0) {
		$cheating = TRUE;
	}
}
if ((!isset($_POST['gscore'])) or (!isset($_POST['gname']))) {
	$cheating = TRUE;
}

if($cheating == TRUE){
	echo TOURNAMENTS_69;
	exit;
}

$sql->mySQLresult = @mysql_query("SELECT score FROM ".MPREFIX."tournaments_plays WHERE tournament_id=".$t['t']." AND player_id=".$t['u_id'].";");
$rows = $sql->db_Rows();
$row = $sql->db_Fetch();

$score = $row['score'];

if($score > $_POST['gscore']){
	$message = TOURNAMENTS_70." ".$_POST['gscore']." ".TOURNAMENTS_71." ".$score."<br><h2>".TOURNAMENTS_72."</h2>";
}
else{
	if($rows > 0){
		$sql->mySQLresult = @mysql_query("UPDATE ".MPREFIX."tournaments_plays SET score='".$_POST['gscore']."' WHERE tournament_id=".$t['t']." AND player_id=".$t['u_id'].";");
	}
	else{
		$sql->mySQLresult = @mysql_query("INSERT INTO ".MPREFIX."tournaments_plays VALUES('', ".$t['u_id'].", ".$t['t'].", '".$_POST['gscore']."');");
	}
	$message = "<h1>".TOURNAMENTS_73."</h3><br>".TOURNAMENTS_74." ".$_POST['gscore']." ".TOURNAMENTS_75;
}

$left = parse_date($tournament_end - $now['sec']);

echo "<center><img src='../images/army.gif' alt='army'><br>";
echo $message;
echo "<br>".TOURNAMENTS_76." ".$left['days'].TOURNAMENTS_77.$left['hours'].TOURNAMENTS_78.$left['mins'].TOURNAMENTS_79." ".TOURNAMENTS_80;
echo "<br><br><form><input type='button' value='Play Again!' onClick='history.back()'>";
echo "<input type='button' value='Close' onClick='window.close()'></form></center>";

function parse_date($secs){
	//86400 secs per day
	//3600 secs in hours
	$days = floor($secs / 86400);
	$secs = $secs - ($days * 86400);
	$hours = floor($secs / 3600);
	$secs = $secs - ($hours * 3600);
	$mins = floor($secs / 60);
	$hour = array('days' => $days, 'hours' => $hours, 'mins' => $mins);
	return $hour;
}

?>