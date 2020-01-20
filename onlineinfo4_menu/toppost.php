<?php
if ($menu_pref['onlineinfo_showforum'] == 1)
{ 
    // Fourm
    if ($menu_pref['onlineinfo_hideforum'] == 1)
    {
        $text .= "<br /><div style='cursor:hand' title='" . ONLINEINFO_LOGIN_MENU_L40 . "' onclick=\"expandit('toppost')\">
		<table style='width:" . $menu_pref['onlineinfo_width'] . "'>
		<tr>
		<td class='smallblacktext' ><a  href='javascript:void(0);' title='" . ONLINEINFO_LOGIN_MENU_L40 . "'><b>&plusmn;&nbsp;" . ONLINEINFO_LOGIN_MENU_L40 . "</b></a>
		</td>
		</tr>
		</table></div>";
        $text .= "<div id='toppost' style=\"display:none\">";
        $text .= "<table class='forumheader3' style='width:" . $menu_pref['onlineinfo_width'] . "'>";
    } 
    else
    {
        $text .= "<br /><span class='smallblacktext'><b>" . ONLINEINFO_LOGIN_MENU_L40 . "</b></span><br />
		<div style='text-align:left'><left>
		<span class=\"smalltext\"><table width='" . $menu_pref['onlineinfo_width'] . "'>";
    } 

    if (!$sql->db_Select("user", "*", "ORDER BY user_forums DESC LIMIT 0, " . $menu_pref['onlineinfo_forumno'] . "", "no_where"))
    {
        $text .= "<span class=\"smalltext\">No Forum posts yet<br />";
    } 
    else
    {
        while ($row = $sql->db_Fetch())
        {
            extract($row);

            $text .= "<tr><td style='vertical-align:top' align='left'><a href='" . e_BASE . "user.php?id.$user_id'>$user_name</a></td>
			<td valign='top' align='left'>$user_forums</td></tr>";
        } 
    } 

    if ($menu_pref['onlineinfo_hideforum'] == 1)
    {
        $text .= "</table></div>";
    } 
    else
    {
        $text .= "</table></left></div>";
    } 

} 

?>