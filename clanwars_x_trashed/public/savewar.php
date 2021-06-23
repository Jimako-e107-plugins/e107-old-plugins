<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Wars 1.0                                              |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('WARS_SPEC') or stristr($_SERVER['SCRIPT_NAME'], "savewar.php")) {
    die ("You can't access this file directly...");
}if(!canaddwars()){
	die('Access Denied');
}

$wid = intval($_POST['wid']);
$new = intval($_POST['new']);
$status = intval($_POST['status']);
$game = intval($_POST['game']);
$wardate = mysql_real_escape_string($_POST['wardate']);
$wartime = mysql_real_escape_string($_POST['wartime']);
$team = intval($_POST['team']);
$opp_tag = mysql_real_escape_string($_POST['opp_tag']);
$opp_name = mysql_real_escape_string($_POST['opp_name']);
$opp_url = mysql_real_escape_string($_POST['opp_url']);
$opp_country = mysql_real_escape_string($_POST['opp_country']);
$style = mysql_real_escape_string($_POST['style']);
$players = intval($_POST['players']);
$our_score = intval($_POST['our_score']);
$opp_score = intval($_POST['opp_score']);
$serverip = mysql_real_escape_string($_POST['serverip']);
$serverpass = mysql_real_escape_string($_POST['serverpass']);
$wreport = mysql_real_escape_string($_POST['wreport']);
$report_url = mysql_real_escape_string($_POST['report_url']);
$wholineup = intval($_POST['wholineup']);

if($wid <= 0){
	die();
}

if((!$conf['caneditwar'] or $new) && !$sql->db_Count("clan_wars", "(*)", "WHERE wid='$wid' AND addedby='".USERNAME."' AND active='0' AND opp_name='' AND opp_tag='' AND game IS NULL")){
	echo '<center>'._WCANTMAKECHANGESTOWAR.'</center>';
	require_once(FOOTERF);
	exit;
}

if($conf['autocalcscore']){
		$sql->db_Select("clan_wars_maplink", "SUM(our_score) as totalscore", "wid='$wid'");
		$row = $sql->db_Fetch();
		$our = $row['totalscore'];
		$sql->db_Select("clan_wars_maplink", "SUM(opp_score) as totalscore", "wid='$wid'");
		$row = $sql->db_Fetch();
		$opp = $row['totalscore'];
			
		if($our > 0 or $opp > 0){
			$our_score = $our;
			$opp_score = $opp;
		}
	}
if($wardate == ""){
	$newdate = -1;
}else{			
	$dot = explode(":",$wartime);
	$hour = intval($dot[0]);
	$min = intval($dot[1]);
	
	$exp1 = explode("/",$conf['dateformat']);
	$exp2 = explode("/",$wardate);
	$dates = array();
	for($i=0;$i<=2;$i++){
		$dates[$exp1[$i]] = intval($exp2[$i]);
	}
	
	$newdate = mktime($hour, $min, 0, $dates['mm'], $dates['dd'], $dates['yyyy']);
}

//E-Mail Function
	if($conf['enablemail'] && $conf['requireapproval'] == 0){
		$sendemail = $_POST["sendemail"];
		if($sendemail == 1){
			$result = $sql->db_Select("clan_wars_mail", "*", "active='1'");
				while($row = $sql->db_Fetch()){
					$email = $row['email'];
					$emaillist .= ",".$row['email'];
				}
				$emaillist = substr($emaillist, 1);
			if($emaillist !=""){
				if($opp_name == ""){
					$opponent = $opp_tag;
				}else{
					$opponent = $opp_name;
				}
					
				if($style !=""){
					$stylemail = _WSTYLE.": $style\n";
				}
					
				if($players > 0){
					$playersmail = _WPLAYERS.": ".$players."on".$players."\n"; 
				}
					
				$sql->db_Select("clan_wars_games", "*", "gid='$game'");
				$row = $sql->db_Fetch();
					$gname = $row['gname'];
				$maplist = "";
				$sql1 = new db;
				$result = $sql->db_Select("clan_wars_maplink", "*", "wid='$wid'");
					while($row = $sql->db_Fetch()){
						$mapname = $row['mapname'];
						$gametype = $row['gametype'];
						if(intval($mapname) > 0){
							$sql1->db_Select("clan_wars_maps", "name", "mid='$mapname'");
							$row2 = $sql1->db_Fetch();
							$mapname = $row2['name'];
						}
						$maplist .= "$mapname $gametype\n";
					}
				if($maplist !=""){
					$mapsmail = _WMAPLIST.":\n$maplist\n";
				}
				$pageURL = 'http';
				if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
				$pageURL .= "://".dirname($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
				$message = _WDATE.": ".date($conf['formatdetails'], $newdate)."\n"
						  ._WGAME.": $gname\n"
						  .$stylemail
						  .$playersmail
						  ."\n"._WOPP.": $opponent\n"
						  ._WCOUNTRY.": $opp_country\n"
						  ."\n"
						  .$mapsmail
						  ._WLINK.": $pageURL/clanwars.php?Details&wid=$wid";
					
				$fromaddress = "wars@".str_replace(array("http://", "https://", "www"), array("","",""), SITEURLBASE);
				$headers = "From: ".SITENAME." <".$fromaddress.">"
				. "\r\n" 
				. 'X-Mailer: PHP/' . phpversion();	
				
				mail($emaillist, (($status) ? _WFINWAR."!" : _WUPCWAR."!"), $message, $headers);
			}
		}			
	}
	//End Mail

//Update database	
$opp_url = str_replace('http://', '', $opp_url);
$report_url = str_replace('http://', '', $report_url);
$result = $sql->db_Update("clan_wars", "status='$status', game='$game', wardate='$newdate', team='$team', opp_tag='$opp_tag', opp_name='$opp_name', opp_url='$opp_url', opp_country='$opp_country', style='$style', players='$players', our_score='$our_score', opp_score='$opp_score', serverip='$serverip', serverpass='$serverpass', report='$wreport', report_url='$report_url', wholineup='$wholineup', lastupdate='".time()."' where wid='$wid'");

if($new){
	$text = "<center><br />"._WAWAITINGAPPROVAL."<br /><br /></center>";
	header("Refresh:1;URL=clanwars.php");
}else{
	$text = "<center><br />"._WUPDATED."<br /><br /></center>";
	header("Refresh:1;URL=clanwars.php?Details&wid=$wid");
}

$ns->tablerender(_CLANWARS, $text);
?>