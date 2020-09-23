<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        Online Info Menu v3.0 for e107 v0.616 by TheMadMonk
|              TheMadMonk@GamingMad.com
|
|      Released under the terms and conditions of the
|      GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "onlineinfo4_menu/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "onlineinfo4_menu/languages/" . e_LANGUAGE . ".php");
} 
else
{
    include_once(e_PLUGIN . "onlineinfo4_menu/languages/English.php");
} 
$use_imagecode = ($pref['logcode'] && extension_loaded("gd"));
if ($use_imagecode)
{
    require_once(e_HANDLER . "secure_img_handler.php");
    if (!is_object($sec_img))
    {
        $sec_img = new secure_image;
    } 
} 
unset($text);
$sql2 = new db;

$text .= "";

if ($menu_pref['onlineinfo_caption'] == "[Welcome User]")
{
    $caption = ONLINEINFO_LOGIN_MENU_L5 . "&nbsp;" . USERNAME;
} 
else
{
    $caption = $menu_pref['onlineinfo_caption'];
} 

if ($pref['user_reg'] == 1 || ADMIN == true)
{
    $text = "";
    if (USER == true || ADMIN == true)
    {
        list($uid, $upw) = ($_COOKIE[$pref['cookie_name']] ? explode(".", $_COOKIE[$pref['cookie_name']]) : explode(".", $_SESSION[$pref['cookie_name']]));

        require_once(e_PLUGIN . "onlineinfo4_menu/" . $menu_pref['onlineinfo_order1'] . "");
        require_once(e_PLUGIN . "onlineinfo4_menu/" . $menu_pref['onlineinfo_order2'] . "");
        require_once(e_PLUGIN . "onlineinfo4_menu/" . $menu_pref['onlineinfo_order3'] . "");
        require_once(e_PLUGIN . "onlineinfo4_menu/" . $menu_pref['onlineinfo_order4'] . "");

        $ns->tablerender($caption, $text);
    } 
    else
    {
        if (LOGINMESSAGE != "")
        {
            $text = "<div style='text-align:center'>" . LOGINMESSAGE . "</div>";
        } 
        $text .= "<div style='text-align:center'>\n<form method='post' action='" . e_SELF;
        if (e_QUERY)
        {
            $text .= "?" . e_QUERY;
        } 

        $text .= "'><p>\n" . ONLINEINFO_LOGIN_MENU_L1 . "<br />\n
	<input class='tbox' type='text' name='username' size='15' value='' maxlength='30' />\n
	<br />\n" . ONLINEINFO_LOGIN_MENU_L2 . "\n<br />\n
	<input class='tbox' type='password' name='userpass' size='15' value='' maxlength='20' />\n\n<br />\n
	";
        if ($use_imagecode)
        {
            $text .= "<input type='hidden' name='rand_num' value='" . $sec_img->random_number . "'>";
            $text .= $sec_img->r_image();
            $text .= "<br /><input class='tbox' type='text' name='code_verify' size='15' maxlength='20'><br />";
        } 
        $text .= "
	<input class='button' type='submit' name='userlogin' value='" . ONLINEINFO_LOGIN_MENU_L28 . "' />\n\n
	<br />\n<input type='checkbox' name='autologin' value='1' /> " . ONLINEINFO_LOGIN_MENU_L6;

        if ($pref['user_reg'])
        {
            $text .= "<br /><br />";
            if (!$pref['auth_method'] || $pref['auth_method'] == "e107")
            {
                $text .= "[ <a href='" . e_BASE . e_SIGNUP . "'>" . ONLINEINFO_LOGIN_MENU_L3 . "</a> ]<br />[ <a href='" . e_BASE . "fpw.php'> " . ONLINEINFO_LOGIN_MENU_L4 . "</a> ]";
            } 
        } 
        $text .= "</p></form></div>";

        if ($menu_pref['onlineinfo_guestmessage'] == 1)
        {
            $text .= "<script type='text/javascript'>
		var message='" . $menu_pref['onlineinfo_guest_message'] . "'
		var backgroundcolor='" . $menu_pref['onlineinfo_guest_bg'] . "'
		var displaymode=" . $menu_pref['onlineinfo_guest_displaymode'] . "
		var displayduration=" . $menu_pref['onlineinfo_guest_displaytime'] . "
		var flashmode=" . $menu_pref['onlineinfo_guest_flash'] . "
		var flashtocolor='" . $menu_pref['onlineinfo_guest_flashcolour'] . "'
		var guestheight='" . $menu_pref['onlineinfo_guest_height'] . "px'
		var guestwidth='" . $menu_pref['onlineinfo_guest_width'] . "px'
		</script>

		<script language='JavaScript' src='" . e_PLUGIN . "onlineinfo4_menu/topmsg.js'></script>";
        } 

        $caption = $menu_pref['onlineinfo_caption'];

        if ((MEMBERS_ONLINE + GUESTS_ONLINE) > ($menu_pref['most_members_online'] + $menu_pref['most_guests_online']))
        {
            $menu_pref['most_members_online'] = MEMBERS_ONLINE;
            $menu_pref['most_guests_online'] = GUESTS_ONLINE;
            $menu_pref['most_online_datestamp'] = time();
            $tmp = addslashes(serialize($menu_pref));
            $sql->db_Update("core", "e107_value='$tmp' WHERE e107_name='menu_pref' ");
        } 
        // require_once("search.php");
        $ns->tablerender($caption, $text);
    } 
} 

?>