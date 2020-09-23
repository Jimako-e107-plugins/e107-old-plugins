<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('CM_PUB')) {
    die ("You can't access this file directly...");
}

$memberid = intval($_POST['memberid']);
$member = mysql_real_escape_string($_POST['member']);

$gender = mysql_real_escape_string($_POST['gender']);
$xfire = mysql_real_escape_string($_POST['xfire']);
$steam = mysql_real_escape_string($_POST['steam']);
$realname = mysql_real_escape_string($_POST['realname']);
$location = mysql_real_escape_string($_POST['location']);
$country = mysql_real_escape_string($_POST['country']);

$dd = intval($_POST['dd']);
$mm = intval($_POST['mm']);
$yyyy = intval($_POST['yyyy']);

$manufacturer = mysql_real_escape_string($_POST['manufacturer']);
$cpu = mysql_real_escape_string($_POST['cpu']);
$memory = mysql_real_escape_string($_POST['memory']);
$hdd = mysql_real_escape_string($_POST['hdd']);
$vga = mysql_real_escape_string($_POST['vga']);
$monitor = mysql_real_escape_string($_POST['monitor']);
$sound = mysql_real_escape_string($_POST['sound']);
$speakers = mysql_real_escape_string($_POST['speakers']);
$keyboard = mysql_real_escape_string($_POST['keyboard']);
$mouse = mysql_real_escape_string($_POST['mouse']);
$surface = mysql_real_escape_string($_POST['surface']);
$os = mysql_real_escape_string($_POST['os']);
$mainboard = mysql_real_escape_string($_POST['mainboard']);
$pccase = mysql_real_escape_string($_POST['pccase']);

$showage = intval($_POST['showage']);
$delete = intval($_POST['delete']);

$userid = USERID;
if($userid != $memberid or !is_clanmember($memberid)){
	header("Location: clanmembers.php");
	die();
}

if($delete == 1){
	$sql->db_Update("clan_members_info", "avatar='' WHERE userid='$memberid'");	
}
$text = "";
if(isset($_FILES['newimage']) && $conf['allowupimage']) { 
	if($conf['maxfilesize'] == 0 || $_FILES['newimage']['size'] <= ($conf['maxfilesize'] * 1024)){
		//select filename and filesize
		$filename = $_FILES['newimage']['name']; 
		if($filename !=""){		
		
			$filename = explode(".", $filename);
			$ext = strtolower($filename[count($filename) -1]);
			$newimage = preg_replace("/[^a-zA-Z0-9\s]/", "", $member)."_".rand(1000, 9999).".".$ext;		
			$newimage = str_replace(" ","_",$newimage);
			
			if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
				$text = "<center><br />"._ONLYIMGSALLOWED."<br /><br /></center>";
			}else{	
				//upload the file 
				move_uploaded_file($_FILES['newimage']['tmp_name'], "images/UserImages/".$newimage);			
				//chmod the file so everyine can see it 
				chmod("images/UserImages/".$newimage, 0777); 
				$sql->db_Update("clan_members_info", "avatar='$newimage' WHERE userid='$memberid'");
			}
		}
	}else{
		$text = "<center><br />"._IMGNOTUPLMAXSIZE.$conf['maxfilesize']."kB.<br /><br /></center>";
	}
}		
	$qry = "";
	if($conf['allowchangeinfo']){
		if($conf['enableprofile'] && $conf['enablehardware']){
			//Update Hardware		
			$qry .= "manufacturer='$manufacturer', cpu='$cpu', memory='$memory', hdd='$hdd', vga='$vga', monitor='$monitor', sound='$sound', speakers='$speakers', keyboard='$keyboard', mouse='$mouse', surface='$surface', os='$os', mainboard='$mainboard', pccase='$pccase', ";
		}
		
		if(VisibleInfo("Age") or VisibleInfo("Birthday")){
			if($showage){
			 	$birthday = mktime(0,0,0,$mm, $dd, $yyyy);
			}else{
				$birthday = 0;
			}	
			$qry .= "birthday='$birthday', ";
		}if(VisibleInfo("Gender")){
			$qry .= "gender='$gender', ";
		}if(VisibleInfo("Xfire")){
			$qry .= "xfire='$xfire', ";
		}if(VisibleInfo("Steam ID")){
			$qry .= "steam='$steam', ";
		}if(VisibleInfo("Realname")){
			$qry .= "realname='$realname', ";
		}if(VisibleInfo("Location")){
			$qry .= "location='$location', ";
		}if(VisibleInfo("Country")){
			$qry .= "country='$country'";
		}
		
		if(substr($qry,-2) == ", "){
			$qry = substr($qry,0,-2);
		}
		$sql->db_Update("clan_members_info", $qry." WHERE userid='$memberid'");
	}

if($conf['allowchangeinfo']){
	$text .= "<center><br />"._URINFOSAVED."<br /><br /></center>";
}else{
	if($text == "")
	$text = "<center><br />"._URIMGISUPDATED."<br /><br /></center>";
}

$ns->tablerender($conf['cmtitle'], $text);

header("refresh:1;url=clanmembers.php");

?>