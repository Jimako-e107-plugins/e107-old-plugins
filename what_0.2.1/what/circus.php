<?php

// what plugin
// .. and the functions leave town


function get_username($userid){
    $sql = new db;
    $sql->db_Select("user", "user_name", "user_id='".$userid."'");
    while ($row = $sql->db_Fetch()) {
        $user_name = stripslashes($row['user_name']);
    }
    return $user_name;
}

function get_downloadcat($catid){
	$sql = new db;
	$sql->db_Select("download_category", "download_category_name", "download_category_id='".$catid."'");
	while($row = $sql->db_Fetch()){
		$category_name = stripslashes($row['download_category_name']);
	}
	return $category_name;
}

function get_newstitle($newsid){
	$sql = new db;
	$sql->db_Select("news", "news_title", "news_id='".$newsid."'");
	while($row = $sql->db_Fetch()){
		$news_title = stripslashes($row['news_title']);
	}
	return $news_title;
}

?>