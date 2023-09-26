if ($pref['ms_enable_forum'] == "1"){

include_lan(e_PLUGIN."aacgc_member_status/languages/".e_LANGUAGE.".php");

global $post_info, $sql, $tp;

$postowner  = $post_info['user_id'];

$sql->db_Select("aacgc_member_status", "*", "status_user='".intval($postowner)."'");
while($row = $sql->db_Fetch()){
$gen = new convert;
$updated = $gen -> computeLapse($row['status_date'], false, false, true, 'short');
$when = ($updated ? $updated : "1 ".LANDT_09)." ".LANDT_AGO;

$forummemstatus .= "<br><div style='width:150px' class='forumheader3'><b><u>".MS_18."</u>:</b><br>".$tp -> toHTML($row['status_text'], TRUE)."<br><i>(".$when.")</i></div>";}


return "".$forummemstatus."";
}