<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members Basic 1.0                                     |
| =============================                                    |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}
$memberid = intval($_POST['memberid']);
$member = mysql_real_escape_string($_POST['member']);

$gender = mysql_real_escape_string($_POST['gender']);
$xfire = mysql_real_escape_string($_POST['xfire']);
$steam = mysql_real_escape_string($_POST['steam']);
$realname = mysql_real_escape_string($_POST['realname']);
$location = mysql_real_escape_string($_POST['location']);
$country = mysql_real_escape_string($_POST['country']);
$xactive = intval($_POST['xactive']);
$rank = intval($_POST['rank']);

$dd = intval($_POST['dd']);
$mm = intval($_POST['mm']);
$yyyy = intval($_POST['yyyy']);
$joind = intval($_POST['joind']);
$joinm = intval($_POST['joinm']);
$joiny = intval($_POST['joiny']);

$showjoin = intval($_POST['showjoin']);
$showage = intval($_POST['showage']);
$delete = intval($_POST['delete']);

if($delete == 1){
	$sql->db_Update("clan_members_info", "avatar='' WHERE userid='$memberid'");	
}
if(isset($_FILES['newimage'])) { 
	//select filename and filesize
	$filename = $_FILES['newimage']['name']; 
	if($filename !=""){		
	
		$filename = explode(".", $filename);
		$ext = strtolower($filename[count($filename) -1]);
		$newimage = preg_replace("/[^a-zA-Z0-9\s]/", "", $member)."_".rand(1000, 9999).".".$ext;		
		$newimage = str_replace(" ","_",$newimage);
		
		if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
			echo"<center><br />"._ONLYIMGSALLOWED."<br /><br /></center>";
		}else{	
			//upload the file 
			move_uploaded_file($_FILES['newimage']['tmp_name'], "images/UserImages/".$newimage);			
			//chmod the file so everyine can see it 
			chmod("images/UserImages/".$newimage, 0777); 
			$sql->db_Update("clan_members_info", "avatar='$newimage' WHERE userid='$memberid'");
		}
	}
}		
	$qry = "";
	
		if(VisibleInfo("Join Date")){
			if($showjoin){
			 	$joindate = mktime(0,0,0,$joinm, $joind, $joiny);
			}else{
				$joindate = 1;
			}					
			$qry .= "joindate='$joindate', ";
		}if(VisibleInfo("Age") or VisibleInfo("Birthday")){
			if($showage){
			 	$birthday = mktime(0,0,0,$mm, $dd, $yyyy);
			}else{
				$birthday = 1;
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
			$qry .= "country='$country', ";
		}	
		if(substr($qry,-2) == ", "){
			$qry = substr($qry,0,-2);
		}
		$updateres = $sql->db_Update("clan_members_info", $qry." WHERE userid='$memberid'");
		

$sql1 = new db;
//Update Games Memberships
$sql->db_Select("clan_games", "gid");	
	while($row = $sql->db_Fetch()){
	$gid = $row['gid'];
	
	if($_POST["game$gid"] == 1){			
		if($conf['rank_per_game'] == 1){
			$rank = $_POST["rank$gid"];
			if($conf['gamesorteams'] == "Teams"){
				$rank = 0;
			}
		}
			
		if($sql1->db_Count("clan_members_gamelink", "(*)", "WHERE gid='$gid' AND userid='$memberid'") == 0){		
			$sql1->db_Insert("clan_members_gamelink", array("gid" => $gid, "userid" => $memberid, "rank" => $rank));
		}else{
			$sql1->db_Update("clan_members_gamelink", "rank='$rank' WHERE gid='$gid' AND userid='$memberid'");
		}			
	}else{
		$sql1->db_Delete("clan_members_gamelink", "gid='$gid' AND userid='$memberid'");
	}		
}

//Update Team Memberships
$sql->db_Select("clan_teams", "tid");	
	while($row = $sql->db_Fetch()){
	$tid = $row['tid'];
	
	if($_POST["team$tid"] == 1){			
		if($conf['rank_per_game'] == 1){
			$rank = $_POST["rank$tid"];
			if($conf['gamesorteams'] == "Games"){
				$rank = 0;
			}
		}
					
		if($sql1->db_Count("clan_members_teamlink", "(*)", "WHERE tid='$tid' AND userid='$memberid'") == 0){		
			$sql1->db_Insert("clan_members_teamlink", array("tid" => $tid, "userid" => $memberid, "rank" => $rank));
		}else{
			$sql1->db_Update("clan_members_teamlink", "rank='$rank' WHERE tid='$tid' AND userid='$memberid'");
		}			
	}else{
		$sql1->db_Delete("clan_members_teamlink", "tid='$tid' AND userid='$memberid'");
	}		
}

header("refresh:1;URL=admin.php");

$ns->tablerender(_CLANMEMBERS, "<center>"._INFOOF.$member._HASBEENUPDATED."</center>");


?>