<?php
/*
+ -----------------------------------------------------------------+
| e107: Challenge Us 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/
if (!(defined('CHAL_PUB') && preg_match("/challengeus\.php\?Challenge/i", $_SERVER['REQUEST_URI']))){
    die ("Access denied.");
}
	
$uname = mysql_real_escape_string($_POST['uname']);
$email = mysql_real_escape_string($_POST['email']);
$msn = mysql_real_escape_string($_POST['msn']);
$xfire = mysql_real_escape_string($_POST['xfire']);
$clantag = mysql_real_escape_string($_POST['clantag']);
$clanname = mysql_real_escape_string($_POST['clanname']);
$clansite = mysql_real_escape_string($_POST['clansite']);
$country = mysql_real_escape_string($_POST['country']);
$chdate = mysql_real_escape_string($_POST['chdate']);
$chtime = mysql_real_escape_string($_POST['chtime']);
$game = mysql_real_escape_string($_POST['game']);
$teams = $_POST['teams'];
$map = mysql_real_escape_string($_POST['map']);
$players = intval($_POST['players']);
$serverip = mysql_real_escape_string($_POST['serverip']);
$serverpw = mysql_real_escape_string($_POST['serverpw']);
$extra = mysql_real_escape_string($_POST['extra']);

$teamids = "";
foreach($teams as $team){
	if(intval($team) > 0)
	$teamids .= ",".$team;
}
if($teamids !="") $teamids = substr($teamids, 1);

if($uname !="" && $email !="" && $clantag !="" && $clanname !="" && $chdate !="" && $chtime !="" && $game !=""){
	if($chdate == ""){
		$newdate = -1;
	}else{			
		$dot = explode(":",$chtime);
		$hour = intval($dot[0]);
		$min = intval($dot[1]);
		
		$exp1 = explode("/",$conf['dateformat']);
		$exp2 = explode("/",$chdate);
		$dates = array();
		for($i=0;$i<=2;$i++){
			$dates[$exp1[$i]] = intval($exp2[$i]);
		}
		$newdate = mktime($hour, $min, 0, $dates['mm'], $dates['dd'], $dates['yyyy']);
	}

	$result = $sql->db_Insert("clan_challenges", array("username" => $uname, "email" => $email, "msn" => $msn, "xfire" => $xfire, "clantag" => $clantag, "clanname" => $clanname, "clansite" => $clansite, "country" => $country, "chdate" => $newdate, "game" => $game, "teams" => $teamids, "map" => $map, "players" => $players, "ip" => $serverip, "pw" => $serverpw, "extra" => $extra, "date" => time()));
	
	if($conf['sendmail'] == 1 && $conf['mailto'] !=""){
		if(intval($game) > 0 && $conf['linkwars']){
			$sql->db_Select("clan_games", "gname", "gid='$game'");
			$row = $sql->db_Fetch();
			$game = $row['gname'];
		}
		
		$teamnames = "";
		foreach($teams as $team){
			if(intval($team) > 0){
				$sql->db_Select("clan_teams", "team_name", "tid='$team'");
				$row = $sql->db_Fetch();
				$team_name = $row['team_name'];
				$teamnames .= ", ".$team_name;
			}
		}
		$teamnames = substr($teamnames, 2);
		
		$subject = SITENAME.": "._NEWCHA."";
		
		if($conf['linkmembers']){
			$sql->db_Select("clan_games","gname", "gid='$game'");
			$row = $sql->db_Fetch();
			$gname = $row['gname'];
		}else{
			$gname = $game;
		}
		$pageURL = "http";
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://".dirname($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		$message =  _NEWCHALFOR." ".$gname."<br /><br />
		
		"._PRESS." - <a href=\"$pageURL/admin.php?Challenge&cid=$result\">"._LINK."</a> - "._TOSEEREQ.". <br /><br />
		<u><b>"._URINFO."</b></u><br />
		<b>"._NICK."</b>: $uname<br />
		<b>"._EMAIL."</b>: $email<br />
		<b>"._MSN."</b>: $msn<br />
		<b>"._XFIRE."</b>: $xfire<br /><br />
		<u><b>"._CLANINFO."</b></u><br />
		<b>"._TAG."</b>: $clantag<br />
		<b>"._NAME."</b>: $clanname<br />
		<b>"._SITE."</b>: $clansite<br /> 
		<b>"._COUNTRY."</b>: $country<br /><br />
		<u><b>"._MTCHINFO."</b></u><br />
		<b>"._DATE."</b>: ".date("j M Y H:i", $newdate)."<br />
		<b>"._GAME."</b>: $gname<br />
		<b>"._TEAMS."</b>: $teamnames<br />
		<b>"._MAP."</b>: $map<br />
		<b>"._PLAYERS."</b>: $players<br /><br />
		<u><b>"._SRVRINFO."</b></u><br />
		<b>"._IP."</b>: $serverip<br />
		<b>"._PW."</b>: $serverpw<br /><br />
		
		<u><b>"._OTHERINFO."</b></u><br />
		".nl2br($_POST['extra']);



		$header  = 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$header .= "From: $uname <$email>\n";
		$header .= "Reply-To: $email";
		mail($conf['mailto'],$subject,$message,$header);
	}
	
	$text = "<center><br /><br />"._THX."<br /><br /><br /></center>";

}else{
	$text = "<center><br /><br />"._FILLFIELDS."<br /><br /><a href='javascript:history.go(-1)'>"._JUGOBACK."</a><br /><br /><br /></center>";
}
		
$ns->tablerender(_CHAUS, $text);
?>