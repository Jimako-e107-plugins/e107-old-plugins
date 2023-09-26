if ($pref['favdls_enable_forumcount'] == "1"){


global $post_info, $sql;

$postowner  = $post_info['user_id'];

$sql->mySQLresult = @mysql_query("select user_id, count(user_favdls) as favs from ".MPREFIX."aacgc_favdls where user_id='".intval($postowner)."';");
$result = $sql->db_fetch();

$favdlcount = $result['favs'];


return "Favorite Downloads: ".$favdlcount."<br>";

}

