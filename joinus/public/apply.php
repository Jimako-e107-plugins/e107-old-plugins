<?php
/*
+ -----------------------------------------------------------------+
| e107: Join Us 1.0                                                |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!(defined('JOIN_PUB') && preg_match("/joinus\.php\?Apply/i", $_SERVER['REQUEST_URI']))){
    die ("Access denied.");
}

$uname = mysql_real_escape_string($_POST['uname']);
$email = mysql_real_escape_string($_POST['email']);
$xfire = mysql_real_escape_string($_POST['xfire']);
$steam = mysql_real_escape_string($_POST['steam']);
$msn = mysql_real_escape_string($_POST['msn']);
$age = mysql_real_escape_string($_POST['age']);
$clans = mysql_real_escape_string($_POST['clans']);
$location = mysql_real_escape_string($_POST['location']);
$apply = mysql_real_escape_string($_POST['apply']);
$conn = mysql_real_escape_string($_POST['conn']);
$micro = mysql_real_escape_string($_POST['micro']);
$extra = mysql_real_escape_string($_POST['extra']);

if($conf['linkmembers']){
	$apply = "";
	$games = $_POST['games'];
	foreach($games as $game){
		$apply .= ($apply !=""?",":"").intval($game);
	}
}

if($sql->db_Count("clan_applications", "*", "username='$uname'") > 0){
	echo "<center><br /><br /><b>"._SRY." $uname, "._ALREADYAPP."</b><br /><br /><br /></center>";
}else{
	if($uname !="" && $email !="" && $apply !="" && $location !="" && $conn !="" && $age !=""){
		$sql->db_Insert("clan_applications", array("username" => $uname, "email" => $email, "xfire" => $xfire, "steam" => $steam, "msn" => $msn, "age" => $age, "clans" => $clans, "location" => $location, "apply" => $apply, "conn" => $conn, "micro" => $micro, "extra" => $extra, "date" => time()));
		if($conf['linkmembers']){
			$sql->db_Select("clan_games","gname", "gid='$apply'");
			$row = $sql->db_Fetch();
			$gname = $row['gname'];
		}else{
			$gname = $apply;
		}
		
		//Send E-Mail to Admin
		if($conf['sendmail'] == 1){
			$to = $conf['mailto'];
			$subject = SITENAME.": "._NEWAPP;
			
			
			
			$pageURL = "http";
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://".dirname($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
				
			//Begin Message
			$message =  _NEWJOINFOR." ".$gname."<br /><br />
			
			"._PRESS." - <a href=\"$pageURL/admin.php?App&aid=$result\">"._LINK."</a> - "._TOSEEREQ.". <br /><br />
			
			<b>"._NICK."</b>: $uname<br />
			<b>"._EMAIL."</b>: $email<br />
			<b>"._XFIRE."</b>: $xfire<br />
			<b>"._STEAM."</b>: $steam<br />
			<b>"._MSN."</b>: $msn<br />
			<b>"._AGE."</b>: $age<br />
			<b>"._LOCATION."</b>: $location<br /> 
			<b>"._PCLANS."</b>: $clans<br />
			<b>"._APPLYF."</b>: $gname<br />
			<b>"._CONNSPEED."</b>: $conn<br />
			<b>"._MICRO."</b>: ".($micro?_YES:_NO)."<br /><br />
			
			<b>"._EXTRAINFO."</b>:<br />
			".nl2br($_POST['extra']);
			//End Message
			$header  = 'MIME-Version: 1.0' . "\r\n";
			$header .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$header .= "From: $uname <$email>\n";
			$header .= "Reply-To: $email";
			mail($to,$subject,$message,$header);
		}
		
		//Post Forum Thread
		if($conf['postthread']){
			$threadcontent = "[b]"._NICK."[/b]: $uname
				[b]"._EMAIL."[/b]: $email
				[b]"._XFIRE."[/b]: $xfire
				[b]"._STEAM."[/b]: $steam
				[b]"._MSN."[/b]: $msn
				[b]"._AGE."[/b]: $age
				[b]"._LOCATION."[/b]: $location 
				[b]"._PCLANS."[/b]: $clans
				[b]"._APPLYF."[/b]: $gname
				[b]"._CONNSPEED."[/b]: $conn
				[b]"._MICRO."[/b]: ".($micro?_YES:_NO);
			if($extra !=""){
				$threadcontent .=  "
				[b]"._EXTRAINFO."[/b]:
				".$extra;
			}
			$threadtitle = str_replace("(username)", $uname, $conf['threadtitle']);
			$threadid = $sql->db_Insert("forum_t", array("thread_name" => $threadtitle, 
											"thread_thread" => $threadcontent, 
											"thread_forum_id" => $conf['postin'], 
											"thread_datestamp" => time(), 
											"thread_user" => (USER?USERID.".".USERNAME:"0.".$uname), 
											"thread_active" => 1, 
											"thread_lastpost" => time()));
			$sql->db_Update("forum","forum_lastpost_user='".(USER?USERID.".".USERNAME:"0.".$uname)."', forum_lastpost_info='".time().".$threadid' WHERE forum_id='".$conf['postin']."'");
		}
		$text = "<center><br /><br />"._THX."<br /><br /><br /></center>";
	}else{
		$text = "<center><br /><br />"._FILLFIELDS."<br /><br /><a href='javascript:history.go(-1)'>"._JUGOBACK."</a><br /><br /><br /></center>";
	}
	$ns->tablerender(_JOINUS, $text);
}
?>