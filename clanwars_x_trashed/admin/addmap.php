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

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin\.php\?AddMap/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?AddMap/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}
$wid = intval($_GET['wid']);
$gid = intval($_GET['gid']);
$mapname = mysql_real_escape_string($_REQUEST['mapname']);

if($wid == 0){
	require_once(e_ADMIN.'auth.php');
	$image = "";
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
				//voor linux of unix hosts chmodden we het bestand naar 777 zodat iedereen um kan zien 
				chmod("images/Maps/$image", 0777);			
			}
		}
	}
	
	if($mapname !="") $res = $sql->db_Insert("clan_wars_maps", array("gid" => $gid, "name" => $mapname, "image" => $image));	
	if(intval($res) > 0){
		$ns->tablerender(_CLANWARS, "<center>The map has been added.</center>");
	}else{
		$ns->tablerender(_CLANWARS, "<center>Error while adding map...</center>");
	}
	header("Refresh: 1;url=admin.php?ManageMaps&gid=$gid");
	require_once(e_ADMIN.'footer.php');
	exit;
}elseif($wid > 0){
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
		$result = $sql->db_Insert("clan_wars_maplink", array("wid" => $wid, "mapname" => $mid, "gametype" => $gametype, "our_score" => $our_score, "opp_score" => $opp_score));	
		echo $result;
	}
}
?>