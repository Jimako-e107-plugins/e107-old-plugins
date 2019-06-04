<?php


if(strpos($_SERVER['HTTP_USER_AGENT'],"iPhone") === false) {

	header("location: tick.php") and exit;

}

require_once("../../class2.php");
require_once("set_auth.php");

include_once(e_HANDLER."user_handler.php");
$users = new myusers();
include_once(e_HANDLER."bbcode_handler.php");
$bb = new e_bbcode();
include_once(e_HANDLER."emote_filter.php");
$emo = new e_emotefilter();

include_once(e_PLUGIN."ticker/languages/".e_LANGUAGE.".php");
$qry = explode(".",e_QUERY);

global $gen;
$gen = new convert();

print "<div style='width:100%;'>";

if($auth === true AND $qry[0] == "del" AND $qry[1]) {

	$id = intval($qry[1]);
	$sql->db_select_gen("SELECT cat FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`id` = '".$id."'");
	$cat = $sql->db_fetch();

	if($cat[0] == "new") {

		exit;

	} else {

		$sql->db_select_gen("UPDATE `".MPREFIX."ticker` SET `".MPREFIX."ticker`.`active` = '0' WHERE `".MPREFIX."ticker`.`id` = '".$id."' LIMIT 1");
		header("location: iPhone.php".($qry[2] ? '?'.$qry[2] : '')."") and exit;

	}

} elseif($auth === true AND $qry[0] == "reset" AND $qry[1]) {

	$id = intval($qry[1]);
	$sql->db_select_gen("SELECT cat FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`id` = '".$id."'");
	$cat = $sql->db_fetch();

	if($cat[0] == "new") {

		exit;

	} else {

		$sql->db_select_gen("UPDATE `".MPREFIX."ticker` SET `".MPREFIX."ticker`.`active` = '1' WHERE `".MPREFIX."ticker`.`id` = '".$id."' LIMIT 1");
		header("location: iPhone.php".($qry[2] ? '?'.$qry[2] : '')."") and exit;

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
						<form method='post' action='".e_SELF."?edit.".$qry[1].".adminm0de'>
		
							<textarea autocomplete='off' type='text' name='tick' class='tbox' rows='10' cols='30' style='font-size:50px;'>".$row[0]."</textarea><br>
							<input type='submit' name='submit' class='button' style='font-size:50px; width:100%; height:75px;' value='".LAN_EDIT."'>

						</form>
			
					</td>

				</tr>

			</table>

		";

		exit;

	} else {

		$sql->db_select_gen("UPDATE `".MPREFIX."ticker` SET `".MPREFIX."ticker`.`message` = '".$_POST['tick']."' WHERE `".MPREFIX."ticker`.`id` = '".intval($qry[1])."' LIMIT 1");
		header("location: iPhone.php".($qry[2] ? '?'.$qry[2] : '')."") and exit;

	}


}

$sql->db_select_gen("SELECT * FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`cat` = 'new' AND `".MPREFIX."ticker`.`active` = '1'");
$row = $sql->db_fetch();

if(!$row[0] OR $row[0] == "") {

	define("PAGETITLE",LAN_NOTICKER);
	print "

		<table cellspacing='0' border='0' cellpadding='0'>

			<tr>

				<td valign='top' style='width:75%;' colspan='2'>

					<h1>".LAN_NOTICKER."</h1> <h3>".LAN_BACKSOON."</h3>

				</td>

			</tr>

		</table>

	";

	$sql->db_select_gen("SELECT user_id,user_name FROM `".MPREFIX."user` WHERE `".MPREFIX."user`.`user_id` = '1'");
	$tmp = $sql->db_fetch();
	$style = $users->getusercolor($tmp[0]);

	print "

		<table cellspacing='0' border='0' cellpadding='0'>

			<tr>

				<td valign='top' style='line-height:30px;'>

						(<a {$style} href='".e_BASE."user.php?id.".$tmp[0]."'>".$tmp[1]."</a> @ ".$gen->convert_date(time(),"forum")."):<br>
						 ".LAN_SORRY."
				</td>
				
			</tr>
			<tr>
	
				<td valign='top'>

					<br>

				</td>

			</tr>

		</table>

	";

} else {

define("PAGETITLE",$row[1]);

$date = $gen->convert_date($row[2],"forum");

print "

	<table cellspacing='0' border='0' cellpadding='0'>

		<tr>

			<td valign='top' style='width:75%;' colspan='2'>

				<h1 style='font-size:50px;'>".$row[1]."</h1> <h3 style='font-size:40px;'>".LAN_STARTED." ".$date."</h3>

			</td>

		</tr>

	</table>
	

";

print "<table cellspacing='0' border='0' cellpadding='4px'>";

if($auth === true) {

	print "

		<tr>

			<td colspan='3' valign='top'>
				<br>
				<form method='post' action='".e_SELF."?new.".$qry[0]."'>
	
					<textarea autocomplete='off' type='text' name='tick' class='tbox' rows='10' cols='150'></textarea><br>
					<input type='submit' name='submit' class='button' style='font-size:50px; width:100%; height:75px;' value='".LAN_SUBMIT."'>

				</form>
			
			</td>

		</tr>

	";


}

}

include_once("header.php");

$sql->db_select_gen("SELECT * FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`cat` = '".$row[1]."' ORDER BY `".MPREFIX."ticker`.`timestamp` DESC");

$rowstyle = "1";

while($tmp = $sql->db_fetch()) {

	if($tmp[6] == "0" AND $qry[0] != "adminm0de") {

		continue;

	} else {

		if($tmp[6] == "0" AND $qry[0] == "adminm0de" AND $auth === true) {

			$del = "style='opacity:0.5;' title='".LAN_DELETED."'";

		}

		$time = $gen->convert_date($tmp[2],"short");
		$message = $tmp[1];
		$style = $users->getusercolor($tmp[3]);

		print "

			<tr {$del}>

				<td valign='top' style='background-color:".($rowstyle == '0' ? '#fff' : '#b5b5b5')."; line-height:30px; font-size:30px;'>

					".($auth === true && $qry[0] == "adminm0de" ? " <a href='einzeln.php?".$tmp[0]."'># ".$tmp[0]."</a> <a title='".LAN_DEL."' href='".e_SELF."?del.".$tmp[0].".adminm0de'><img src='".e_IMAGE."admin_images/delete_32.png' border='0' /></a> <a title='".LAN_RESET."' href='".e_SELF."?reset.".$tmp[0].".adminm0de'><img src='".e_IMAGE."admin_images/plugins_32.png' border='0' /></a> <a title='".LAN_EDIT."' href='".e_SELF."?edit.".$tmp[0].".adminm0de'><img src='".e_IMAGE."admin_images/edit_32.png' border='0' /></a> " : "")."(<a {$style} href='".e_BASE."user.php?id.".$tmp[3]."'>".$tmp[4]."</a> @ ".$time."):<br>
					 ".$bb->parseBBCodes($emo->filterEmotes($message),true)."
				</td>
				
			</tr>
			<tr>

				<td valign='top' style='background-color:".($rowstyle == '0' ? '#fff' : '#b5b5b5').";'>

					<br>

				</td>

			</tr>

		";

		unset($del);

	}

$rowstyle = ($rowstyle == "0" ? "1" : "0");

}

print "

			<tr>

				<td>

				</td>

			</tr>
			<tr>

				<td valign='top' style='font-size:30px;'>

					<a href='".e_BASE."'>".LAN_TOPAGE."</a> | <a href='".e_SELF.($qry[0] == 'doreload' ? '' : '?doreload')."'>".LAN_AUTORELOAD." ".($qry[0] == 'doreload' ? LAN_OFF : LAN_ON)." </a> | <a href='archiv.php'>".LAN_ARCHIV."</a> ".($auth === true ? "| <a href='".e_SELF."".($qry[0] == 'adminm0de' ? '' : '?adminm0de')."'>".LAN_ADMIN." ".($qry[0] == 'adminm0de' ? LAN_OFF : LAN_ON)."</a>" : "")." ".($auth === true ? "| <a href='poster_config.php'>".LAN_TICKER_POSTER_ADMINISTRATE."</a>" : "")."

				</td>

			</tr>

	</table>

";


if($_SERVER['REQUEST_METHOD'] == "POST" AND $qry[0] == "new" AND $auth === true) {

	$message = $_POST['tick'];
	$userid = USERID;
	$username = USERNAME;
	$time = time();
	$sql->db_select_gen("INSERT INTO `".MPREFIX."ticker` (message,timestamp,userid,username,cat,active) VALUES ('$message','$time','$userid','$username','$row[1]','1')");

	header("location: iPhone.php".($qry[1] ? '?'.$qry[1] : '')."") and exit;

}

if($qry[0] == "doreload") {

	print "<script>window.setTimeout('window.location.reload()',10000);</script>";

}

print "</div>";

include_once("footer.php");

?>