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

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}

$tp = e107::getParser();
$sql = e107::getDb();

$memberid = intval($_POST['memberid']);
$member = $tp->toDB($_POST['member']);

$gender = $tp->toDB($_POST['gender']);
$xfire = $tp->toDB($_POST['xfire']);
$steam = $tp->toDB($_POST['steam']);
$realname = $tp->toDB($_POST['realname']);
$location = $tp->toDB($_POST['location']);
$country = $tp->toDB($_POST['country']);
$xactive = intval($_POST['xactive']);
$rank = intval($_POST['rank']);

$dd = intval($_POST['dd']);
$mm = intval($_POST['mm']);
$yyyy = intval($_POST['yyyy']);
$joind = intval($_POST['joind']);
$joinm = intval($_POST['joinm']);
$joiny = intval($_POST['joiny']);

$manufacturer = $tp->toDB($_POST['manufacturer']);
$cpu = $tp->toDB($_POST['cpu']);
$memory = $tp->toDB($_POST['memory']);
$hdd = $tp->toDB($_POST['hdd']);
$vga = $tp->toDB($_POST['vga']);
$monitor = $tp->toDB($_POST['monitor']);
$sound = $tp->toDB($_POST['sound']);
$speakers = $tp->toDB($_POST['speakers']);
$keyboard = $tp->toDB($_POST['keyboard']);
$mouse = $tp->toDB($_POST['mouse']);
$surface = $tp->toDB($_POST['surface']);
$os = $tp->toDB($_POST['os']);
$mainboard = $tp->toDB($_POST['mainboard']);
$pccase = $tp->toDB($_POST['pccase']);

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
	if($conf['enableprofile'] && $conf['enablehardware']){
		//Update Hardware		
		$qry .= "manufacturer='$manufacturer', cpu='$cpu', memory='$memory', hdd='$hdd', vga='$vga', monitor='$monitor', sound='$sound', speakers='$speakers', keyboard='$keyboard', mouse='$mouse', surface='$surface', os='$os', mainboard='$mainboard', pccase='$pccase', ";
	}
	
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
		}if(VisibleInfo("Activity")){
			$qry .= "active='$xactive', ";
		}if($conf['rank_per_game'] == 0 && (VisibleInfo("Rank") or VisibleInfo("Rank Image"))){
			$qry .= "rank='$rank'";
		}	
		if(substr($qry,-2) == ", "){
			$qry = substr($qry,0,-2);
		}
		$updateres = $sql->db_Update("clan_members_info", $qry." WHERE userid='$memberid'");
		

$sql1 = e107::getDB();
//Update Games Memberships
$sql->select("clan_games", "gid");	
	while($row = $sql->fetch()){
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
$sql->select("clan_teams", "tid");	
	while($row = $sql->fetch()){
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

//Awards
$sql->select("clan_members_awardlink", "id", "userid='$memberid'");	
if($sql->db_Rows() > 0 && $conf['showawards']){
	while($row = $sql->fetch()){
		$id = $row['id'];
		if(intval($awards[$id]) == 0){
			$sql1->db_Delete("clan_members_awardlink", "id='$id' AND userid='$memberid'");
		}
	}
}

header("refresh:1;URL=admin_old.php");

$ns->tablerender(_CLANMEMBERS, "<center>"._INFOOF.$member._HASBEENUPDATED."</center>");


?>