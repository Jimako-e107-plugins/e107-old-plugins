<?php
if ($menu_pref['onlineinfo_showvisit'] == 1)
{ 
    // Most Visits
    if ($menu_pref['onlineinfo_hidevisit'] == 1)
    {
        $text .= "<br />
		<div style='cursor:hand' title='" . ONLINEINFO_LOGIN_MENU_L41 . "' onclick=\"expandit('topvisit')\">
		<table style='width:" . $menu_pref['onlineinfo_width'] . "'>
		<tr>
		<td class='smallblacktext' ><a href='javascript:void(0);'  title='" . ONLINEINFO_LOGIN_MENU_L41 . "'><b>&plusmn;&nbsp;" . ONLINEINFO_LOGIN_MENU_L41 . "</b></a>
		</td>
		</tr>
		</table></div>";
        $text .= "<div id='topvisit' style=\"display:none\">";
        $text .= "<table class='forumheader3' style='width:" . $menu_pref['onlineinfo_width'] . "'>";
    } 
    else
    {
        $text .= "<br /><span class='smallblacktext'><b>" . ONLINEINFO_LOGIN_MENU_L41 . "</b></span><br /><div style='text-align:left'><left><table width='" . $menu_pref['onlineinfo_width'] . "'>";
    } 

    if (!$sql->db_Select("user", "*", "ORDER BY user_visits DESC LIMIT 0, " . $menu_pref['onlineinfo_visitno'] . "", "no_where"))
    {
        $text .= "<span class=\"smalltext\">No visitors yet<br />";
    } 
    else
    {
        while ($row = $sql->db_Fetch())
        {
            extract($row);

            $text .= "<tr>
			<td style='vertical-align:top' align='left'><a href='" . e_BASE . "user.php?id.$user_id'>$user_name</a>
			</td>
			<td valign='top' align='left'>$user_visits</td>
			</tr>";
        } 
    } 

    if ($menu_pref['onlineinfo_hidevisit'] == 1)
    {

        $text .= "</table></div>";
    } 
    else
    {
        $text .= "</table></left></div>";

    } 
} 

?>