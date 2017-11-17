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
$map = mysql_real_escape_string($_POST['map']);
$players = intval($_POST['players']);
$serverip = mysql_real_escape_string($_POST['serverip']);
$serverpw = mysql_real_escape_string($_POST['serverpw']);
$extra = mysql_real_escape_string($_POST['extra']);

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

	$sql->db_Insert("clan_challenges", array("username" => $uname, "email" => $email, "msn" => $msn, "xfire" => $xfire, "clantag" => $clantag, "clanname" => $clanname, "clansite" => $clansite, "country" => $country, "chdate" => $newdate, "game" => $game, "map" => $map, "players" => $players, "ip" => $serverip, "pw" => $serverpw, "extra" => $extra, "date" => time()));
	
	if($conf['sendmail'] == 1 && $conf['mailto'] !=""){
		if(intval($game) > 0 && $conf['linkwars']){
			$sql->db_Select("clan_games", "gname", "gid='$game'");
			$row = $sql->db_Fetch();
			$game = $row['gname'];
		}
		$subject = SITENAME.": "._NEWCHA."";
		$message = _CHALLBY." $uname "._FORA." $game "._WARAGAINST." $clanname";
		$header = "From: $username <$email>\n";
		$header .= "Reply-To: $email";
		mail($conf['mailto'],$subject,$message,$header);
	}
	
	$text = "<center><br /><br />"._THX."<br /><br /><br /></center>";

}else{
	$text = "<center><br /><br />"._FILLFIELDS."<br /><br /><a href='javascript:history.go(-1)'>"._JUGOBACK."</a><br /><br /><br /></center>";
}
		
$ns->tablerender(_CHAUS, $text);
?>