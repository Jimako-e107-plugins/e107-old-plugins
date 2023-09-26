if ($pref['goldaddon_enable_forumprescount'] == "1"){


global $post_info, $sql;

$postowner  = $post_info['user_id'];

$sql->mySQLresult = @mysql_query("select gpressy_recipient_id, count(gpressy_present) as presents from ".MPREFIX."gold_present where gpressy_recipient_id= $postowner;");
$prescount = $sql->db_fetch();


return "Presents: ".$prescount['presents']."<br>";

}
