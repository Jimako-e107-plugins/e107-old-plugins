if ($pref['fl_enable_forumcount'] == "1"){

include_lan(e_PLUGIN."aacgc_friendsys/languages/".e_LANGUAGE.".php");

global $post_info, $sql;

$postowner  = $post_info['user_id'];

$sql->mySQLresult = @mysql_query("select user_id, count(user_friends) as friends from ".MPREFIX."aacgc_friend_sys where user_id='".intval($postowner)."';");
$result = $sql->db_fetch();

$friendcount = $result['friends'];


return "".FSYS_16.": ".$friendcount."<br>";

}

