<?php
if ($menu_pref['onlineinfo_online'] == 1)
{
    $text .= "<br /><span class='smallblacktext'><b>" . ONLINEINFO_LOGIN_MENU_L30 . "</b></span><br />";

    if ($menu_pref['onlineinfo_online_plug'] == "Standard")
    { 
        // ========== START Standard Currently Online ============= //
        if (MEMBERS_ONLINE)
        {
            $text .= ONLINE_EL2 . "(" . MEMBERS_ONLINE . ")<br />";
            $sql->db_Select("online", "*", "online_user_id!='0' ORDER BY online_user_id ASC ");
            while ($row = $sql->db_Fetch())
            {
                extract($row);

                if ($menu_pref['onlineinfo_avatar'] == 1)
                {
                    $sql2 = new db;
                    if ($sql2->db_Select("user", "*", "user_id='" . substr($online_user_id, 0, strpos($online_user_id, ".")) . "'"))
                    {
                        $row = $sql2->db_Fetch();
                        $isadmin = $row[user_admin];
                        if ($row[user_image] == "")
                        {
                            $user_image = "" . e_PLUGIN . "onlineinfo4_menu/images/default.png";
                            $AVATAR = "<div class='spacer'><img src='" . $user_image . "' width='25' alt='' /></div>";
                        } 
                        else
                        {
                            $user_image = $row[user_image];
                            require_once(e_HANDLER . "avatar_handler.php");
                            $user_image = avatar($user_image);
                            $AVATAR = "<div class='spacer'><img src='" . $user_image . "' width='25' alt='' /></div>";
                        } 
                    } 
                } 
                else
                {
                    $AVATAR = "<img src='" . e_PLUGIN . "onlineinfo4_menu/images/user.png'  alt='' style='vertical-align:middle;' />";
                } 

                $oid = substr($online_user_id, 0, strpos($online_user_id, "."));
                $oname = substr($online_user_id, (strpos($online_user_id, ".") + 1));
                $online_location_page = eregi_replace(".php", "", substr(strrchr($online_location, "/"), 1));
                if ($online_location_page == "log" || $online_location_page == "error")
                {
                    $online_location = "news.php";
                    $online_location_page = "news";
                } 
                if ($online_location_page == "request")
                {
                    $online_location = "download.php";
                } 
                if (strstr($online_location_page, "forum"))
                {
                    $online_location = "forum.php";
                    $online_location_page = "forum";
                } 
                $text .= "<div style='text-align:left;'><table style='width:" . $menu_pref['onlineinfo_width'] . ";'>";
                $text .= "<tr><td style='vertical-align:middle;text-align:left;'";

                if ($menu_pref['onlineinfo_showicons'] == 1)
                {
                    $text .= " rowspan='2' ";
                } 
                $online_eloc = ONLINE_EL7;
                if ($isadmin)
                {
                    $online_location = "javascript:void(0);" ;
                    $online_location_page = ONLINEINFO_LOGIN_MENU_L43;
                    $online_eloc = "";
                } 
                $text .= ">" . $AVATAR . "</td>
					<td valign='middle' align='left'>$oname" . $online_eloc . " <a href='$online_location'>$online_location_page</a></td></tr>";

                if ($menu_pref['onlineinfo_showicons'] == 1)
                {
                    $text .= "<tr><td valign='middle'>&nbsp;&nbsp;";
                    if (file_exists(e_PLUGIN . "pm_menu/pm_inc.php"))
                    {
                        $text .= "<a href='" . e_PLUGIN . "pm_menu/pm.php?send.$oid'><img src='" . e_PLUGIN . "onlineinfo4_menu/images/icon_pm.png'  alt='PM this user' style='vertical-align:middle;border:0;' /></a>&nbsp;";
                    } 

                    $text .= "<a href='" . e_BASE . "user.php?id.$oid'><img src='" . e_PLUGIN . "onlineinfo4_menu/images/profile.png'  alt='Users Profile' style='vertical-align:middle;border:0;' /></a>&nbsp;";

                    if ($menu_pref['onlineinfo_showadmin'] == 1)
                    {

                        if ($isadmin == 1)
                        {
                            $text .= "<img src='" . e_PLUGIN . "onlineinfo4_menu/images/admin.png'  alt='Site Admin' style='vertical-align:middle;border:0;' />&nbsp;";
                        } 
                    } 
                } 
                $text .= "</td></tr><tr><td colspan='2' ></td></tr>";

                $text .= "</table></div>";
            } 

            if ($menu_pref['onlineinfo_guest'] == 1)
            {
                $text .= "<br />" . ONLINE_EL1 . "(" . GUESTS_ONLINE . ")<br />";
                $sql->db_Select("online", "*", "online_user_id='0' ORDER BY online_user_id ASC ");
                while ($row = $sql->db_Fetch())
                {
                    extract($row);
                    $oname = $online_ip;
                    $online_location_page = eregi_replace(".php", "", substr(strrchr($online_location, "/"), 1));
                    if ($online_location_page == "log" || $online_location_page == "error")
                    {
                        $online_location = "news.php";
                        $online_location_page = "news";
                    } 
                    if ($online_location_page == "request")
                    {
                        $online_location = "download.php";
                    } 
                    if (strstr($online_location_page, "forum"))
                    {
                        $online_location = "forum.php";
                        $online_location_page = "forum";
                    } 
                    $text .= "<div style='text-align:left;'>
					<table style='width:" . $menu_pref['onlineinfo_width'] . ";'>";
                    if (ADMIN)
                    {
                        $text .= "<tr><td style='vertical-align:top;' align='left'><img src='" . e_PLUGIN . "onlineinfo4_menu/images/guest.png' alt='' style='vertical-align:middle;' /></td>
								<td valign='top' align='left'><a href='" . e_ADMIN . "userinfo.php?$oname'>$oname</a> is in <a href='$online_location'>$online_location_page</a></td></tr>";
                    } 
                    else
                    {
                        $text .= "<tr><td style='vertical-align:top;' align='left'><img src='" . e_PLUGIN . "onlineinfo4_menu/images/guest.png' alt='' style='vertical-align:middle;' /></td>
								<td valign='top' align='left'>$oname is in <a href='$online_location'>$online_location_page</a></td></tr>";
                    } 

                    $text .= "</table></div>";
                } 
            } 
        } 
        // ========== END Standard Currently Online ============= //
    } 
    else
    { 
        // ========== START Cam's Currently Online ============= //
        if (MEMBERS_ONLINE)
        {
            $text .= "<div style='cursor:hand;text-align:left;' title='View members online' onclick=\"expandit('members') \"><table style='width:" . $menu_pref['onlineinfo_width'] . ";'><tr><td class='smalltext' align='left'><a href='javascript:void(0);' title='View members online'><b>" . ONLINEINFO_LOGIN_MENU_L36 . "</b></a><b><a  href='javascript:void(0);' title='View members online'>(" . MEMBERS_ONLINE . ")</a></b></td></tr></table></div>";
            $text .= "<div id='members' style=\"display:none;text-align:left\" >";
            $text .= "<table class='forumheader3' style='width:" . $menu_pref['onlineinfo_width'] . ";'>
			";
            $sql->db_Select("online", "*", "online_user_id!='0' ORDER BY online_user_id ASC ");
            while ($row = $sql->db_Fetch())
            {
                $spanit = "";
                extract($row);

                if ($menu_pref['onlineinfo_avatar'] == 1)
                {
                    $sql2 = new db;
                    if ($sql2->db_Select("user", "*", "user_id='" . substr($online_user_id, 0, strpos($online_user_id, ".")) . "'"))
                    {
                        $row = $sql2->db_Fetch();
                        $isadmin = $row[user_admin];
                        if ($row[user_image] == "")
                        {
                            $user_image = "" . e_PLUGIN . "onlineinfo4_menu/images/default.png";
                            $AVATAR = "<div class='spacer'><img src='" . $user_image . "' width='25' alt='' /></div>";
                        } 
                        else
                        {
                            $user_image = $row[user_image];
                            require_once(e_HANDLER . "avatar_handler.php");
                            $user_image = avatar($user_image);
                            $AVATAR = "<div class='spacer'><img src='" . $user_image . "' width='25' alt='' /></div>";
                        } 
                    } 
                } 
                else
                {
                    $AVATAR = "<img src='" . e_PLUGIN . "onlineinfo4_menu/images/user.png'  alt='' style='vertical-align:middle;' />";
                } 

                $oid = substr($online_user_id, 0, strpos($online_user_id, "."));
                $oname = substr($online_user_id, (strpos($online_user_id, ".") + 1));
                $online_location_page = eregi_replace(".php", "", substr(strrchr($online_location, "/"), 1));
                if ($online_location_page == "log" || $online_location_page == "error")
                {
                    $online_location = "news.php";
                    $online_location_page = "news";
                } 
                if ($online_location_page == "request")
                {
                    $online_location = "download.php";
                } 
                if (strstr($online_location_page, "forum"))
                {
                    $online_location = "forum.php";
                    $online_location_page = "forum";
                } 
                $online_eloc = ONLINE_EL7;
                if ($isadmin)
                {
                    $online_location = "javascript:void(0);" ;
                    $online_location_page = ONLINEINFO_LOGIN_MENU_L43;
                    $online_eloc = "";
                } 
                // ##
                $text .= "<tr><td style='vertical-align:middle;' align='left' rowspan='2'>" . $AVATAR . "</td>
					<td valign='middle' align='left'>$oname<span style='color:black;'> " . $online_eloc . " </span><a $spanit href='$online_location'>$online_location_page</a></td></tr>";
                if ($menu_pref['onlineinfo_showicons'] == 1)
                {
                    $text .= "<tr><td align='right' valign='middle'>&nbsp;&nbsp;";

                    if (file_exists(e_PLUGIN . "pm_menu/pm_inc.php"))
                    {
                        $text .= "<a href='" . e_PLUGIN . "pm_menu/pm.php?send.$oid'><img src='" . e_PLUGIN . "onlineinfo4_menu/images/icon_pm.png'  alt='PM this user' style='vertical-align:middle;border:0;' /></a>&nbsp;";
                    } 

                    $text .= "<a href='" . e_BASE . "user.php?id.$oid'><img src='" . e_PLUGIN . "onlineinfo4_menu/images/profile.png'  alt='Users Profile' style='vertical-align:middle;border:0;' /></a>&nbsp;";

                    if ($isadmin == 1 && $menu_pref['onlineinfo_showadmin'] == 1)
                    {
                        $text .= "<img src='" . e_PLUGIN . "onlineinfo4_menu/images/admin.png'  alt='Site Admin' style='vertical-align:middle;border:0;' />&nbsp;";
                    } 
                    $text .= "</td></tr><tr><td colspan='2' ></td></tr>";
                } 
            } 
            $text .= "</table></div>";

            if ($menu_pref['onlineinfo_guest'] == 1)
            {
                $onlineinf_count = $sql->db_Select("online", "*", "online_user_id='0' ORDER BY online_user_id ASC ");
                if ($onlineinf_count > 0)
                {
                    $text .= "<div style='cursor:hand;text-align:left;' onclick=\"expandit('guests')\">
				<table style='width:" . $menu_pref['onlineinfo_width'] . ";'>
				<tr>
				<td class='smalltext'><a href='javascript:void(0);' ><b>" . ONLINEINFO_LOGIN_MENU_L37 . "</b></a><b><a  href='javascript:void(0);'  >(" . GUESTS_ONLINE . ")</a></b>
				</td>
				</tr>
				</table></div>";
                } 
                else
                {
                    $text .= "<div style='cursor:hand;text-align:left;' onclick=\"expandit('guests')\">
				<table style='width:" . $menu_pref['onlineinfo_width'] . ";'>
				<tr>
				<td class='smalltext'><b>" . ONLINEINFO_LOGIN_MENU_L37 . "</b><b>(" . GUESTS_ONLINE . ")</b>
				</td>
				</tr>
				</table></div>";
                } 
                $text .= "<div id='guests' style='display:none;text-align:left;'>
				<table class='forumheader3'>";
                if ($onlineinf_count > 0)
                {
                    while ($row = $sql->db_Fetch())
                    {
                        extract($row);
                        $online_location_page = eregi_replace(".php", "", substr(strrchr($online_location, "/"), 1));
                        if ($online_location_page == "log" || $online_location_page == "error")
                        {
                            $online_location = "news.php";
                            $online_location_page = "news";
                        } 
                        if ($online_location_page == "request")
                        {
                            $online_location = "download.php";
                        } 
                        if (strstr($online_location_page, "forum"))
                        {
                            $online_location = "forum.php";
                            $online_location_page = "forum";
                        } 
                        $text .= "
					<tr>
					<td class='smalltext' colspan='2' align='left'>&nbsp;<img src='" . e_PLUGIN . "onlineinfo4_menu/images/guest.png' alt='' style='vertical-align:middle;' />";
                        if (ADMIN)
                        {
                            $text .= "<a $spanit href='" . e_ADMIN . "userinfo.php?$online_ip'>$online_ip</a><span style='color:black;'> " . ONLINE_EL7 . " </span><a $spanit href='$online_location'>$online_location_page</a>";
                        } 
                        else
                        {
                            $text .= "$online_ip<span style='color:black;'> " . ONLINE_EL7 . " </span><a $spanit href='$online_location'>$online_location_page</a>";
                        } 
                        $text .= "</td></tr>";
                    } 
                } 
                else
                {
                    $text .= "<tr><td style='width:100%'>" . ONLINE_EL7 . " </td></tr>";
                } 
                $text .= "</table></div>";
            } 
            else
            {
                $text .= "";

#                $text .= "  <table style='width:" . $menu_pref['onlineinfo_width'] . ";'><tr ><td class='smalltext' ><a  href='javascript:void(0);' ><b>" . ONLINEINFO_LOGIN_MENU_L37 . "</b></a></td><td class='smalltext' style='text-align:right;'><b><a  href='javascript:void(0);'  >" . GUESTS_ONLINE . "</a></b></td></tr></table>";
            } 
        } 
    } 
    // ========== END Cam's Currently Online ============= //
} 

?>