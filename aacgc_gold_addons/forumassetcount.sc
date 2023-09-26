if ($pref['goldaddon_enable_forumassetcount'] == "1"){


global $post_info, $sql;

$postowner  = $post_info['user_id'];

$sql->mySQLresult = @mysql_query("select gasset_user_id, count(gasset_asset) as assets from ".MPREFIX."gold_asset where gasset_user_id= $postowner;");
$assetscount = $sql->db_fetch();


return "Presents: ".$assetscount['assets']."<br>";

}
