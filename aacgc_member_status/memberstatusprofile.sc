if ($pref['ms_enable_profile'] == "1"){

include_lan(e_PLUGIN."aacgc_member_status/languages/".e_LANGUAGE.".php");

global $sql,$sql2,$user, $tp; 

$suser = "";
$USER_ID = "";

$url = $_SERVER["REQUEST_URI"];
$suser = explode(".", $url);
if ($suser[1] == 'php?id')
{$suser = $suser[2];}

$SUSER_ID = $suser;

        $datestamp = time();
        $sql ->db_Select("aacgc_member_status", "*", "status_user='".intval($SUSER_ID)."'");
        $row = $sql ->db_Fetch();

if ($row['status_text'] != ""){

        $gen = new convert;
        $updated = $gen -> computeLapse($row['status_date'], false, false, true, 'short');
        $when = ($updated ? $updated : "1 ".LANDT_09)." ".LANDT_AGO;

$userstatus = "	<tr>
		<td class='forumheader3' style='text-align:left'>".MS_18.":</td>
		<td class='forumheader3' style='text-align:left'>".$tp -> toHTML($row['status_text'], TRUE)." <i>(".$when.")</i></td>
		</tr>";

return $userstatus;}


}