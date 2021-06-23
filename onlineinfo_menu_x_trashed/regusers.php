<?php
if (!defined('e107_INIT')) { exit; }

if(check_class($pref['onlineinfo_showregusers'])){


if ($pref['onlineinfo_hideregusers'] == 1)
{

$text .= "<div id='regu-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".ONLINEINFO_LOGIN_MENU_L79."'>&nbsp;".ONLINEINFO_LOGIN_MENU_L79."</div>";
	$text .= "<div id='regu' class='switchgroup1' style='display:none;'>";

}else{

	$text .= "<div>";
}

    $total_members = $sql->db_Count("user");
    if ($total_members > 1)
    {
        $newest_member = $sql->db_Select("user", "user_id, user_name", "ORDER BY user_join DESC LIMIT 0,1", "no_where");
        $row = $sql->db_Fetch();
        extract($row);

           	$text .= "<div class='smallblacktext' style='margin-left:5px; width:".$onlineinfomenuwidth."'>" . ONLINE_EL5 . $total_members . ONLINE_EL10 . "</div>
           	<div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>".ONLINE_EL6.": <a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name."</a></div>";
    }


$text.="<br /></div>";


}
    ?>