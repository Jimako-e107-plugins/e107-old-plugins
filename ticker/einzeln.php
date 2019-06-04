<?php

require_once("../../class2.php");
include_once("languages/".e_LANGUAGE.".php");

define("PAGETITLE",LAN_ONCE_ENTRY);

include_once("header.php");
include_once(e_HANDLER."user_handler.php");
$users = new myusers();
include_once(e_HANDLER."bbcode_handler.php");
$bb = new e_bbcode();
include_once(e_HANDLER."emote_filter.php");
$emo = new e_emotefilter();

global $gen;
$gen = new convert();

$qry = explode(".",e_QUERY);

if(!$qry[0]) {

	header("location: tick.php") and exit;

} else {

	$id = intval($qry[0]);
	$sql->db_select_gen("SELECT * FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`id` = '".$id."'");
	$tmp = $sql->db_fetch();

	$style = $users->getusercolor($tmp[3]);
	$time = $gen->convert_date($tmp[2],"short");
	$message = $tmp[1];

	print "

		<table cellspacing='0' cellpadding='0' border='0'>

			<tr>

				<td valign='top'>

					<h2>".LAN_CAT.": ".$tmp[5]."</h2>

				</td>

			</tr>
			<tr>

				<td valign='top' style='line-height:30px;'>

					(<a {$style} href='".e_BASE."user.php?id.".$tmp[3]."'>".$tmp[4]."</a> @ ".$time."):<br>
					 ".$bb->parseBBCodes($emo->filterEmotes($message),true)."
				</td>
				
			</tr>
			<tr>

				<td valign='top'>

					<br><a style='font-size:10px;' href='tick.php'>".LAN_BACKTOTICKER."</a>

				</td>

			</tr>

		</table>

	";

}

include_once("footer.php");

?>