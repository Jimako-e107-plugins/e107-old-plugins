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

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin\.php\?SaveMap/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?SaveMap/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}

$mid = intval($_POST['mid']);
$gid = intval($_REQUEST['gid']);
$lid = intval($_GET['lid']);
$mapname = mysql_real_escape_string($_REQUEST['mapname']);

if($mid > 0 && $gid > 0){
	
	require_once(e_ADMIN.'auth.php');
	if(intval($_POST['delimage']) == 1){
		$sql->db_Update("clan_wars_maps", "image='' WHERE mid='$mid'");	
	}	
	//Check if theres a file selected
	if(isset($_FILES['mapimage'])) {	
		//check is there a new name given
		$filename = $_FILES['mapimage']['name']; 
		if($filename !=""){
			$sql->db_Select("clan_games", "abbr, gname", "gid='$gid'");
			$row = $sql->db_Fetch();
			$abbr = $row['abbr'];
			$gname = $row['gname'];

			$filename = explode(".", $filename);
			$ext = strtolower($filename[count($filename) -1]);
			$image = preg_replace("/[^a-zA-Z0-9\s-_]/", "", ($abbr?$abbr:$gname)."-".$mapname)."-".rand(100, 999).".".$ext;
			$image = str_replace(" ", "_", $image);
			if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
				$text = "<center><br />"._WONLYTYPESALLOWED."<br /><br /></center>";
			}else{		
				//upload the file 
				move_uploaded_file($_FILES['mapimage']['tmp_name'], "images/Maps/$image"); 
				chmod("images/Maps/$image", 0777);			
				$sql->db_Update("clan_wars_maps", "image='$image' WHERE mid='$mid'");	
			}
		}
	}
	if($mapname !=""){
		$result = $sql->db_Update("clan_wars_maps", "name='$mapname' WHERE mid='$mid'");
		$text .= "<center><br />The map has been updated<br /><br /></center>";
		header("Refresh:1;url=admin.php?ManageMaps&gid=$gid");		
	}else{
		$text .= "<center><br />"._WFILLINNAME."<br /><br /></center>";
		header("Refresh:2;url=admin.php?ManageMaps&gid=$gid");
	}
		
	$ns->tablerender(_CLANWARS, $text);
	require_once(e_ADMIN.'footer.php');
	exit;	
}elseif($lid > 0 ){
	if($mapname !=""){
		$gametype = mysql_real_escape_string($_GET['gametype']);
		$our_score = intval($_GET['our_score']);
		$opp_score = intval($_GET['opp_score']);
		
		$sql->db_Select("clan_wars_maps", "mid", "name='$mapname' AND gid='$gid'");
		$row = $sql->db_Fetch();
		if(intval($row['mid']) > 0){ 
			$mid = $row['mid'];
		}else{
			$mid = $sql->db_Insert("clan_wars_maps", array("gid" => $gid, "name" => $mapname));
		}
		$result = $sql->db_Update("clan_wars_maplink", "mapname='$mid', gametype='$gametype', our_score='$our_score', opp_score='$opp_score' WHERE lid='$lid'");
		print '1';		
	}
}
		
?>