<?php

global $pref;
$ticker_prefs = $pref['ticker'];

$time = time();
$day = strftime("%d",$time);
$dir = e_PLUGIN."ticker/";

if(!file_exists($dir.$day) AND $ticker_prefs['startdaily'] == "1") {

	@unlink($dir.($day-"1"));
	$f = @fopen($dir.$day,"w");
	@fwrite($f,"1");
	@fclose($f);
	include_once("languages/months_".e_LANGUAGE.".php");

	$sql->db_select_gen("SELECT * FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`cat` = 'new' AND `".MPREFIX."ticker`.`active` = '1'");
	$row = $sql->db_fetch();

	if($row[0]) {

		$sql->db_select_gen("UPDATE `".MPREFIX."ticker` SET `".MPREFIX."ticker`.`active` = '0' WHERE `".MPREFIX."ticker`.`id` = '".$row[0]."'");

	}

	$sql->db_select_gen("SELECT user_name FROM `".MPREFIX."user` WHERE `".MPREFIX."user`.`user_id` = '1'");
	$row = $sql->db_fetch();
	$username = $row[0];

	$months = array("",LAN_JAN,LAN_FEB,LAN_MAR,LAN_APR,LAN_MAY,LAN_JUN,LAN_JUL,LAN_AUG,LAN_SEP,LAN_OKT,LAN_NOV,LAN_DEZ);
	$month = strftime("%m",$time);
	$dayname = strftime("%A",$time);

	$date = $day.". ".$months[$month]." - ".$dayname;

	$sql->db_select_gen("INSERT INTO `".MPREFIX."ticker` (message,timestamp,userid,username,cat,active) VALUES ('$date','$time','1','$username','new','1');");

}

?>