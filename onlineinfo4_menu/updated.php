<?php
if ($menu_pref['onlineinfo_showupdates'] == 1)
{
    $new_news = $sql->db_Count("news", "(*)", "WHERE news_datestamp>'" . $time . "' ");
    if (!$new_news)
    {
        $new_news = "0";
    } 
    $new_comments = $sql->db_Count("comments", "(*)", "WHERE comment_datestamp>'" . $time . "' ");
    if (!$new_comments)
    {
        $new_comments = "0";
    } 
    $new_chat = $sql->db_Count("chatbox", "(*)", "WHERE cb_datestamp>'" . $time . "' ");
    if (!$new_chat)
    {
        $new_chat = "0";
    } 
    $new_forum = $sql->db_Count("forum_t", "(*)", "WHERE thread_datestamp>'" . $time . "' ");
    if (!$new_forum)
    {
        $new_forum = "0";
    } 
    $new_users = $sql->db_Count("user", "(*)", "WHERE user_join>'" . $time . "' ");
    if (!$new_users)
    {
        $new_users = "no";
    } 

    if ($menu_pref['onlineinfo_coppermine'] == 1)
    {
        $new_picture = $sql->db_Count("CPG_pictures", "(*)", "WHERE ctime>'" . $time . "' ");
        if (!$new_picture)
        {
            $new_picture = "no";
        } 
    } 

    if ($menu_pref['onlineinfo_downloads'] == 1)
    {
        $new_downloads = $sql->db_Count("download", "(*)", "WHERE download_datestamp>'" . $time . "' ");
        if (!$new_downloads)
        {
            $new_downloads = "no";
        } 
    } 
    if ($menu_pref['onlineinfo_hideupdates'] == 1)
    {
        $text .= "<br />
		<div style='cursor:hand' title='" . ONLINEINFO_LOGIN_MENU_L39 . "' onclick=\"expandit('updates')\"><table style='width:" . $menu_pref['onlineinfo_width'] . "'>
		<tr><td class='smallblacktext' ><a  href='javascript:void(0);' title='" . ONLINEINFO_LOGIN_MENU_L39 . "'><b>&plusmn;&nbsp;" . ONLINEINFO_LOGIN_MENU_L39 . "</b></a>
		</td></tr>
		</table>
		</div>";
        $text .= "<div id='updates' style=\"display:none\">";
        $text .= "<table class='forumheader3' style='width:" . $menu_pref['onlineinfo_width'] . "'><tr><td>";
    } 
    else
    {
        $text .= "<br /><span class='smallblacktext'><b>" . ONLINEINFO_LOGIN_MENU_L39 . "</b></span><br />
		<div style='text-align:left'><left>
		<table width='" . $menu_pref['onlineinfo_width'] . "'><tr><td>";
    } 

    $text .= "<a href='" . e_PLUGIN . "list_new/new.php'>" . ONLINEINFO_LOGIN_MENU_L24 . "</a><br /><b>" . ONLINEINFO_LOGIN_MENU_L27 . "</b><br />";
    if ($new_news <> 0)
    {
        if ($menu_pref['onlineinfo_new_icon'] == 1)
        {
            $text .= "$new_news " . ($new_news == 1 ? ONLINEINFO_LOGIN_MENU_L14 : ONLINEINFO_LOGIN_MENU_L15) . "<img src='" . e_PLUGIN . "onlineinfo4_menu/images/" . $menu_pref['onlineinfo_new_icontype'] . "' alt='' style='vertical-align:middle' /><br />";
        } 
        else
        {
            $text .= "$new_news " . ($new_news == 1 ? ONLINEINFO_LOGIN_MENU_L14 : ONLINEINFO_LOGIN_MENU_L15) . "<br />";
        } 
    } 
    else
    {
        $text .= "$new_news " . ($new_news == 1 ? ONLINEINFO_LOGIN_MENU_L14 : ONLINEINFO_LOGIN_MENU_L15) . "<br />";
    } 
    if ($new_chat <> 0)
    {
        if ($menu_pref['onlineinfo_new_icon'] == 1)
        {
            $text .= "$new_chat " . ($new_chat == 1 ? ONLINEINFO_LOGIN_MENU_L16 : ONLINEINFO_LOGIN_MENU_L17) . "<img src='" . e_PLUGIN . "onlineinfo4_menu/images/" . $menu_pref['onlineinfo_new_icontype'] . "' alt='' style='vertical-align:middle' /><br />";
        } 
        else
        {
            $text .= "$new_chat " . ($new_chat == 1 ? ONLINEINFO_LOGIN_MENU_L16 : ONLINEINFO_LOGIN_MENU_L17) . "<br />";
        } 
    } 
    else
    {
        $text .= "$new_chat " . ($new_chat == 1 ? ONLINEINFO_LOGIN_MENU_L16 : ONLINEINFO_LOGIN_MENU_L17) . "<br />";
    } 
    if ($new_comments <> 0)
    {
        if ($menu_pref['onlineinfo_new_icon'] == 1)
        {
            $text .= "$new_comments " . ($new_comments == 1 ? ONLINEINFO_LOGIN_MENU_L18 : ONLINEINFO_LOGIN_MENU_L19) . "<img src='" . e_PLUGIN . "onlineinfo4_menu/images/" . $menu_pref['onlineinfo_new_icontype'] . "' alt='' style='vertical-align:middle' /><br />";
        } 
        else
        {
            $text .= "$new_comments " . ($new_comments == 1 ? ONLINEINFO_LOGIN_MENU_L18 : ONLINEINFO_LOGIN_MENU_L19) . "<br />";
        } 
    } 
    else
    {
        $text .= "$new_comments " . ($new_comments == 1 ? ONLINEINFO_LOGIN_MENU_L18 : ONLINEINFO_LOGIN_MENU_L19) . "<br />";
    } 
    if ($new_forum <> 0)
    {
        if ($menu_pref['onlineinfo_new_icon'] == 1)
        {
            $text .= "$new_forum " . ($new_forum == 1 ? ONLINEINFO_LOGIN_MENU_L20 : ONLINEINFO_LOGIN_MENU_L21) . "<img src='" . e_PLUGIN . "onlineinfo4_menu/images/" . $menu_pref['onlineinfo_new_icontype'] . "' alt='' style='vertical-align:middle' /><br />";
        } 
        else
        {
            $text .= "$new_forum " . ($new_forum == 1 ? ONLINEINFO_LOGIN_MENU_L20 : ONLINEINFO_LOGIN_MENU_L21) . "<br />";
        } 
    } 
    else
    {
        $text .= "$new_forum " . ($new_forum == 1 ? ONLINEINFO_LOGIN_MENU_L20 : ONLINEINFO_LOGIN_MENU_L21) . "<br />";
    } 

    if ($menu_pref['onlineinfo_downloads'] == 1)
    {
        if ($new_downloads <> "no")
        {
            if ($menu_pref['onlineinfo_new_icon'] == 1)
            {
                $text .= "$new_downloads " . ($new_downloads == 1 ? ONLINEINFO_LOGIN_MENU_L32 : ONLINEINFO_LOGIN_MENU_L33) . "<img src='" . e_PLUGIN . "onlineinfo4_menu/images/" . $menu_pref['onlineinfo_new_icontype'] . "' alt='' style='vertical-align:middle' /><br />";
            } 
            else
            {
                $text .= "$new_downloads " . ($new_downloads == 1 ? ONLINEINFO_LOGIN_MENU_L32 : ONLINEINFO_LOGIN_MENU_L33) . "<br />";
            } 
        } 
        else
        {
            $text .= "$new_downloads " . ($new_downloads == 1 ? ONLINEINFO_LOGIN_MENU_L32 : ONLINEINFO_LOGIN_MENU_L33) . "<br />";
        } 
    } 

    if ($menu_pref['onlineinfo_coppermine'] == 1)
    {
        if ($new_picture <> "no")
        {
            if ($menu_pref['onlineinfo_new_icon'] == 1)
            {
                $text .= "$new_picture " . ($new_picture == 1 ? ONLINEINFO_LOGIN_MENU_L34 : ONLINEINFO_LOGIN_MENU_L35) . "<img src='" . e_PLUGIN . "onlineinfo4_menu/images/" . $menu_pref['onlineinfo_new_icontype'] . "' alt='' style='vertical-align:middle' /><br />";
            } 
            else
            {
                $text .= "$new_picture " . ($new_picture == 1 ? ONLINEINFO_LOGIN_MENU_L34 : ONLINEINFO_LOGIN_MENU_L35) . "<br />";
            } 
        } 
        else
        {
            $text .= "$new_picture " . ($new_picture == 1 ? ONLINEINFO_LOGIN_MENU_L34 : ONLINEINFO_LOGIN_MENU_L35) . "<br />";
        } 
    } 

    if ($new_users <> "no")
    {
        if ($menu_pref['onlineinfo_new_icon'] == 1)
        {
            $text .= "$new_users " . ($new_users == 1 ? ONLINEINFO_LOGIN_MENU_L22 : ONLINEINFO_LOGIN_MENU_L23) . ".<img src='" . e_PLUGIN . "onlineinfo4_menu/images/" . $menu_pref['onlineinfo_new_icontype'] . "' alt='' style='vertical-align:middle' />
				<br />";
        } 
        else
        {
            $text .= "$new_users " . ($new_users == 1 ? ONLINEINFO_LOGIN_MENU_L22 : ONLINEINFO_LOGIN_MENU_L23) . "
				<br />";
        } 
    } 
    else
    {
        $text .= "$new_users " . ($new_users == 1 ? ONLINEINFO_LOGIN_MENU_L22 : ONLINEINFO_LOGIN_MENU_L23) . "
			<br />";
    } 

    $total_members = $sql->db_Count("user");
    if ($total_members > 1)
    {
        $newest_member = $sql->db_Select("user", "user_id, user_name", "ORDER BY user_join DESC LIMIT 0,1", "no_where");
        $row = $sql->db_Fetch();
        extract($row);
        $text .= "<span class='smalltext'>" . ONLINE_EL5 . $total_members . ONLINE_EL10 . "<br />" . ONLINE_EL6 . ": <a href='" . e_BASE . "user.php?id." . $user_id . "'>" . $user_name . "</a></span>";
    } 

    if ($menu_pref['onlineinfo_hideupdates'] == 1)
    {
        $text .= "</td></tr></table></div>";
    } 
    else
    {
        $text .= "</table></left></div>";
    } 

} 

?>