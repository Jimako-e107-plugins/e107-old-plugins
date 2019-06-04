<?php

require_once("../../class2.php");
require_once("set_auth.php");

include_once(e_PLUGIN."ticker/languages/".e_LANGUAGE.".php");
define("PAGETITLE","Archiv");
include_once("header.php");

global $gen;
$gen = new convert();

include_once(e_HANDLER."user_handler.php");
$users = new myusers();
include_once(e_HANDLER."bbcode_handler.php");
$bb = new e_bbcode();
include_once(e_HANDLER."emote_filter.php");
$emo = new e_emotefilter();

$qry = explode(".",e_QUERY);

if($auth === true AND $qry[0] == "del" AND $qry[1]) {

	$id = intval($qry[1]);
	$sql->db_select_gen("SELECT cat FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`id` = '".$id."'");
	$cat = $sql->db_fetch();

	if($cat[0] == "new") {

		exit;

	} else {

		$sql->db_select_gen("UPDATE `".MPREFIX."ticker` SET `".MPREFIX."ticker`.`active` = '0' WHERE `".MPREFIX."ticker`.`id` = '".$id."' LIMIT 1");
		header("location: archiv.php?adminm0de.".$qry[2]."") and exit;
	}

} elseif($auth === true AND $qry[0] == "reset") {

	$id = intval($qry[1]);
	$sql->db_select_gen("SELECT cat FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`id` = '".$id."'");
	$cat = $sql->db_fetch();

	if($cat[0] == "new") {

		exit;

	} else {

		$sql->db_select_gen("UPDATE `".MPREFIX."ticker` SET `".MPREFIX."ticker`.`active` = '1' WHERE `".MPREFIX."ticker`.`id` = '".$id."' LIMIT 1");
		header("location: archiv.php?adminm0de.".$qry[2]."") and exit;
	}

} elseif($auth === true AND $qry[0] == "edit" AND $qry[1]) {

	if($_SERVER['REQUEST_METHOD'] != "POST") {
	
		$sql->db_select_gen("SELECT message FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`id` = '".intval($qry[1])."'");
		$row = $sql->db_fetch();

		print "

			<table cellspacing='0' border='0' cellpadding='4px'>

				<tr>

					<td colspan='3' valign='top'>
						<br>
						<form method='post' action='".e_SELF."?edit.".$qry[1]."'>
		
							<textarea autocomplete='off' type='text' name='tick' class='tbox' rows='10' cols='250'>".$row[0]."</textarea>
							<input type='submit' name='submit' class='button' value='".LAN_EDIT."'>

						</form>
			
					</td>

				</tr>

			</table>

		";

		exit;

	} else {

		$sql->db_select_gen("UPDATE `".MPREFIX."ticker` SET `".MPREFIX."ticker`.`message` = '".$_POST['tick']."' WHERE `".MPREFIX."ticker`.`id` = '".intval($qry[1])."' LIMIT 1");
		header("location: archiv.php?adminm0de.".$qry[1]."") and exit;

	}


}

print "

	<table cellspacing='0' border='0' cellpadding='0' style='width:1000px;'>

			<tr>

				<td valign='top'>

					".($qry[1] ? "" : "<h1>Archiv</a>")."

				</td>
				<td valign='top'>

					<a href='tick.php'>".LAN_TOTICKER."</a> | <a href='archiv.php'>".LAN_ALLARCHIV."</a> ".($auth === true ? "| <a href='".e_SELF."".($qry[0] == 'adminm0de' ? '?archiv.'.$qry[1] : '?adminm0de.'.$qry[1])."'>".LAN_ADMIN." ".($qry[0] == 'adminm0de' ? LAN_OFF : LAN_ON)."</a>" : "")."

				</td>
				
			</tr>

	</table>

";


if(!$qry[1]) {

	print "<table cellspacing='0' border='0' cellpadding='4px'>";

	$sql->db_select_gen("SELECT * FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`cat` = 'new' ORDER BY `".MPREFIX."ticker`.`id` DESC");

	while($tmp = $sql->db_fetch()) {

		$mydb = new db();
		$mydb->db_select_gen("SELECT COUNT(id) FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`cat` LIKE '".$tmp[1]."'");
		$count = $mydb->db_fetch();
		$time = $gen->convert_date($tmp[2],"short");
		$message = $tmp[1];
		$style = $users->getusercolor($tmp[3]);

		print "

			<tr>
	
				<td valign='top' style='width:500px;'>		
	
					(".LAN_STARTED_ON_FROM." <a {$style} href='".e_BASE."user.php?id.".$tmp[3]."'>".$tmp[4]."</a> @ ".$time."):
	
				</td>
				<td valign='top' style='width:35px;'>
		
				</td>
				<td valign='top'>

					 <a href='archiv.php?".($qry[0] ? $qry[0].".".intval($tmp[0]) : "archiv.".intval($tmp[0]))."'>".$message."</a> (".$count[0]." ".LAN_INSERTS.")
	
				</td>
	
			</tr>

		";

	}

	print "</table>" and exit;

} else {

	$id = intval($qry[1]);
	$sql->db_select_gen("SELECT * FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`id` = '".$id."'");
	$row = $sql->db_fetch();
	
	$name = $row[1];
	$style = $users->getusercolor($row[3]);

	if($row[5] != "new") {

		header("location: archiv.php") and exit;

	}

	$user = "<a {$style} href='".e_BASE."user.php?id.".$row[3]."'>".$row[4]."</a>";
	$time = $gen->convert_date($row[2],"forum");
	unset($row);

	print "<table cellspacing='0' border='0' cellpadding='4px'>";

	print "

		<tr>

			<td>

				<h1>".$name."</h1><h3>".LAN_INARCHIV."</h3><h4>".LAN_STARTED_ON." ".$time." von ".$user." ".LAN_OPENED."</h4>

			</td>

		</tr>

	";

	$sql->db_select_gen("SELECT * FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`cat` = '".$name."' ORDER BY `".MPREFIX."ticker`.`id` DESC");
		
	while($tmp = $sql->db_fetch()) {
	
		if($tmp[6] == "0" AND $qry[0] != "adminm0de") {

			continue;

		} else {

			if($tmp[6] == "0" AND $qry[0] == "adminm0de" AND $auth === true) {

				$del = "style='opacity:0.5;' title='Dieser Eintrag wurde gel&ouml;scht!'";

			}

			$time = $gen->convert_date($tmp[2],"short");
			$message = $tmp[1];
			$style = $users->getusercolor($tmp[3]);
	
			print "

				<tr {$del}>

					<td valign='top' style='line-height:30px;'>

						".($auth === true && $qry[0] == "adminm0de" ? "<a title='L&ouml;schen' href='".e_SELF."?del.".$tmp[0].".adminm0de'><img src='".e_IMAGE."admin_images/delete_16.png' border='0' /></a> <a title='Wiederherstellen' href='".e_SELF."?reset.".$tmp[0].".adminm0de'><img src='".e_IMAGE."admin_images/plugins_16.png' border='0' /></a> <a title='L&ouml;schen' href='".e_SELF."?edit.".$tmp[0].".adminm0de'><img src='".e_IMAGE."admin_images/edit_16.png' border='0' /></a>" : "")."(<a {$style} href='".e_BASE."user.php?id.".$tmp[3]."'>".$tmp[4]."</a> @ ".$time."):<br>
						 ".$bb->parseBBCodes($emo->filterEmotes($message),true)."
	
					</td>
				
				</tr>
				<tr>

					<td valign='top'>

						<br>

					</td>

				</tr>

			";

			unset($del);

		}

	}

	print "</table>";

}

include_once("footer.php");

?>

