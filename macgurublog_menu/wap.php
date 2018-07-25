<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once('mgbwap.php');

if (e_QUERY == "loggout") {
	$udata=(USER === TRUE) ? USERID.".".USERNAME : "0";
	$sql->db_Update("online", "online_user_id = '0', online_pagecount=online_pagecount+1 WHERE online_user_id = '{$udata}' LIMIT 1");

	cookie($pref['cookie_name'], NULL, (time() - 2592000));
	$_COOKIE[$pref['cookie_name']] = NULL;
	$e_event->trigger("logout");
	header('Location: wap.php'.$mgbw->rnd);
	exit;
}

require_once(e_LANGUAGEDIR.e_LANGUAGE."/lan_login.php");

if (USER === true) {
	$mgbw -> metas[] = 'http-equiv="refresh" content="5;URL=wapblog.php'.'"';
	$mgbw -> timer = true;
}
$mgbw -> head(true);
//----------------------------------------
if (USER === false) {
echo '
<p align="center">
<img src="'."images/icon_32.png".'" alt="BLOG"/><br/>
'.SITENAME.'</p>
<p align="center">
'.(LOGINMESSAGE != NULL ? '<b>'.LOGINMESSAGE."</b><br/>" : '').'
'.LAN_LOGIN_1.': <input type="text" name="xname" /><br/>
'.LAN_LOGIN_2.': <input type="password" name="xpass" value="" /><br/>
<anchor>
<go method="post" href="wap.php'.$mgbw->rnd.'">
<postfield name="username" value="$(xname)"/>
<postfield name="userpass" value="$(xpass)"/>
<postfield name="userlogin" value="login"/>
</go>
'.MACGURUBLOG_MENU_89.'
</anchor>
</p>
';
} else {
	echo '<p align="center">'.MACGURUBLOG_MENU_90."<br/><a href=\"wapblog.php\">".MACGURUBLOG_MENU_92."</a>\n</p>";
}
//----------------------------------------
$mgbw -> foot();
?>