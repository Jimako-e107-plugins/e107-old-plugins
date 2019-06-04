<?php

require_once("../../class2.php");
include_once(e_PLUGIN."ticker/languages/".e_LANGUAGE.".php");
include_once(e_PLUGIN."ticker/languages/".e_LANGUAGE."_admin.php");
define("PAGETITLE","Poster Config");
require_once("header.php");
require_once("set_auth.php");

if(!$auth) {

	header("location: tick.php") and exit;

}

$qry = explode(".",e_QUERY);

print "

	<table cellspacing='0' border='0' cellpadding='0'>

		<tr>

			<td valign='top'>
	
				<a href='".e_BASE."'>".LAN_TOPAGE."</a> | <a href='tick.php'>".LAN_TOTICKER."</a>| <a href='".e_SELF.($qry[0] == 'doreload' ? '' : '?doreload')."'>".LAN_AUTORELOAD." ".($qry[0] == 'doreload' ? LAN_OFF : LAN_ON)." </a> | <a href='archiv.php'>".LAN_ARCHIV."</a> ".($auth === true ? "| <a href='".e_SELF."".($qry[0] == 'adminm0de' ? '' : '?adminm0de')."'>".LAN_ADMIN." ".($qry[0] == 'adminm0de' ? LAN_OFF : LAN_ON)."</a>" : "")." ".($auth === true ? "| <a href='poster_config.php'>".LAN_TICKER_POSTER_ADMINISTRATE."</a>" : "")."

			</td>

		</tr>

	</table>
	

";

if(!$qry[0]) {

	$sql->db_select_gen("SELECT message FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`cat` = 'new' AND `".MPREFIX."ticker`.`active` = '1'");
	$row = $sql->db_fetch();

	if($row[0] == "" OR !$row[0]) {

		print "<h1>".LAN_NOTICKER."</h1>";

	} else {

		print "<h1>".LAN_ACTIVE." &quot;".$row[0]."&quot; ".LAN_ACTIVE_2."!</h1>";

	}

	print "<h2>".LAN_START."</h2> ";

	print "

		<form method='post' action='".e_SELF."?new'>

			<input type='text' name='name' size='20' class='tbox'>
			<input type='submit' value='".LAN_NEW."' class='button'>

		</form>

		<br><br>
		".LAN_WARN_NEW."

		<br><br>
		<h2>".LAN_CLOSE_TICKER."</h2>
		<form method='post' action='".e_SELF."?close'>

			<select name='cat' class='tbox'>
	";

	$sql->db_select_gen("SELECT * FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`cat` = 'new' AND `".MPREFIX."ticker`.`active` = '1' ORDER BY `".MPREFIX."ticker`.`id` DESC");
		
	while($row = $sql->db_fetch()) {

		print "

			<option value='".$row[0]."'>".$row[1]."</option>

		";

	}

	print "

			</select>
			<input type='submit' class='button' value='".LAN_CLOSE."'>

		</form>

		<h2>".LAN_REOPEN."</h2>

		".LAN_WARN_REOPEN."
		<form method='post' action='".e_SELF."?open'>

			<select name='cat' class='tbox'>
	";

	$sql->db_select_gen("SELECT * FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`cat` = 'new' AND `".MPREFIX."ticker`.`active` = '0' ORDER BY `".MPREFIX."ticker`.`id` DESC");
		
	while($row = $sql->db_fetch()) {

		print "

			<option value='".$row[0]."'>".$row[1]."</option>

		";

	}

	print "

			</select>
			<input type='submit' class='button' value='".LAN_OPEN."'>

		</form>

		<h2>".LAN_RENAME."</h2>

		<form method='post' action='".e_SELF."?rename'>

			<select name='cat' class='tbox'>
	";

	$sql->db_select_gen("SELECT * FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`cat` = 'new' ORDER BY `".MPREFIX."ticker`.`id` DESC");
		
	while($row = $sql->db_fetch()) {

		print "

			<option value='".$row[0]."'>".$row[1]."</option>

		";

	}

	print "

			</select> ".LAN_RENTO." 
			<input type='text' name='newname' class='tbox'>
			<input type='submit' class='button' value='".LAN_RENITTO."'>

		</form>

	";
		

} elseif($qry[0] == "new" AND $_SERVER['REQUEST_METHOD'] == "POST") {

	$name = $_POST['name'];
	$time = time();
	$userid = USERID;
	$username = USERNAME;

	$sql->db_select_gen("SELECT * FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`cat` = 'new' AND `".MPREFIX."ticker`.`active` = '1'");
	$row = $sql->db_fetch();
	
	if($row[0]) {

		$sql->db_select_gen("UPDATE `".MPREFIX."ticker` SET `".MPREFIX."ticker`.`active` = '0' WHERE `".MPREFIX."ticker`.`id` = '".$row[0]."'");

	}

	$sql->db_select_gen("INSERT INTO `".MPREFIX."ticker` (timestamp,userid,username,cat,message,active) VALUES ('$time','$userid','$username','new','$name','1');");

	header("location: admin_config.php") and exit;

} elseif($qry[0] == "close" AND $_SERVER['REQUEST_METHOD'] == "POST" AND $_POST['cat']) {

	$sql->db_select_gen("UPDATE `".MPREFIX."ticker` SET `".MPREFIX."ticker`.`active` = '0' WHERE `".MPREFIX."ticker`.`id` = '".mysql_real_escape_string(intval($_POST['cat']))." LIMIT 1'");
	
	header("location: admin_config.php") and exit;

} elseif($qry[0] == "open" AND $_SERVER['REQUEST_METHOD'] == "POST" AND $_POST['cat']) {

	$sql->db_select_gen("SELECT * FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`cat` = 'new' AND `".MPREFIX."ticker`.`active` = '1'");
	$row = $sql->db_fetch();
	
	if($row[0]) {

		$sql->db_select_gen("UPDATE `".MPREFIX."ticker` SET `".MPREFIX."ticker`.`active` = '0' WHERE `".MPREFIX."ticker`.`id` = '".$row[0]."'");

	}

	$sql->db_select_gen("UPDATE `".MPREFIX."ticker` SET `".MPREFIX."ticker`.`active` = '1' WHERE `".MPREFIX."ticker`.`id` = '".mysql_real_escape_string(intval($_POST['cat']))." LIMIT 1'");
	
	header("location: admin_config.php") and exit;

} elseif($qry[0] == "rename" AND $_SERVER['REQUEST_METHOD'] == "POST" AND $_POST['cat']) {

	$sql->db_select_gen("SELECT cat,message FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`id` = '".mysql_real_escape_string(intval($_POST['cat']))."'");
	$row = $sql->db_fetch();

	if($row[0] == "new" AND $_POST['newname']) {

		
		$sql->db_select_gen("UPDATE `".MPREFIX."ticker` SET `".MPREFIX."ticker`.`message` = '".mysql_real_escape_string($_POST['newname'])."' WHERE `".MPREFIX."ticker`.`id` = '".$_POST['cat']."' LIMIT 1");
		$sql->db_select_gen("UPDATE `".MPREFIX."ticker` SET `".MPREFIX."ticker`.`cat` = '".mysql_real_escape_string($_POST['newname'])."' WHERE `".MPREFIX."ticker`.`cat` = '".$row[1]."'");

	}

	header("location: admin_config.php") and exit;

}

require_once("footer.php");

?>
	
