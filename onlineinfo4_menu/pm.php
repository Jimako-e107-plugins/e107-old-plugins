<?php
if ($menu_pref['onlineinfo_pm'] == 1)
{
    if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "pm/languages/" . e_LANGUAGE . ".php"))
    {
        include_once(e_PLUGIN . "pm/languages/" . e_LANGUAGE . ".php");
    } 
    else
    {
        include_once(e_PLUGIN . "pm/languages/English.php");
    } 
    global $sysprefs, $pref, $pm_prefs;
    if (!isset($pm_prefs['perpage']))
    {
        $pm_prefs = $sysprefs->getArray("pm_prefs");
    } 
    require_once(e_PLUGIN . "pm/pm_func.php");
    pm_getInfo('clear');
    define("PM_INBOX_ICON", "<img src='" . e_PLUGIN . "pm/images/mail_get.png' style='height:16;width:16;border:0' alt='" . LAN_PM_25 . "' title='" . LAN_PM_25 . "' />");
    define("PM_OUTBOX_ICON", "<img src='" . e_PLUGIN . "pm/images/mail_send.png' style='height:16;width:16;border:0' alt='" . LAN_PM_26 . "' title='" . LAN_PM_26 . "' />");
    define("PM_SEND_LINK", LAN_PM_35);
    define("NEWPM_ANIMATION", "<img src='" . e_PLUGIN . "pm/images/newpm.gif' alt='' style='border:0' />");

    $sc_style['SEND_PM_LINK']['pre'] = "<br /><br />[ ";
    $sc_style['SEND_PM_LINK']['post'] = " ]";

    $sc_style['INBOX_FILLED']['pre'] = "[";
    $sc_style['INBOX_FILLED']['post'] = "%]";

    $sc_style['OUTBOX_FILLED']['pre'] = "[";
    $sc_style['OUTBOX_FILLED']['post'] = "%]";

    $sc_style['NEWPM_ANIMATE']['pre'] = "<a href='" . e_PLUGIN_ABS . "pm/pm.php?inbox'>";
    $sc_style['NEWPM_ANIMATE']['post'] = "</a>";

    if (!defined($pm_menu_template))
    {
        $pm_menu_template = "
	<a href='" . e_PLUGIN_ABS . "pm/pm.php?inbox'>" . PM_INBOX_ICON . "</a>
	<a href='" . e_PLUGIN_ABS . "pm/pm.php?inbox'>" . LAN_PM_25 . "</a>
	{NEWPM_ANIMATE}
	<br />
	{INBOX_TOTAL} " . LAN_PM_36 . ", {INBOX_UNREAD} " . LAN_PM_37 . " {INBOX_FILLED}
	<br />
	<a href='" . e_PLUGIN_ABS . "pm/pm.php?outbox'>" . PM_OUTBOX_ICON . "</a>
	<a href='" . e_PLUGIN_ABS . "pm/pm.php?outbox'>" . LAN_PM_26 . "</a><br />
	{OUTBOX_TOTAL} " . LAN_PM_36 . ", {OUTBOX_UNREAD} " . LAN_PM_37 . " {OUTBOX_FILLED}
	{SEND_PM_LINK}
	";
    } 

    global $tp, $pm_inbox;
    $pm_inbox = pm_getInfo('inbox');
    require_once(e_PLUGIN . "pm/pm_shortcodes.php");
    $text .= $tp->parseTemplate($pm_menu_template, true, $pm_shortcodes);
    if ($pm_inbox['inbox']['new'] > 0 && $pm_prefs['popup'] && strpos(e_SELF, "pm.php") === false && $_COOKIE["pm-alert"] != "ON")
    {
        $text .= online_pm_show_popup();
    } 
	$text .="<br />";
} 

function online_pm_show_popup()
{
    global $pm_inbox, $pm_prefs;
    $alertdelay = intval($pm_prefs['popup_delay']);
    if ($alertdelay == 0)
    {
        $alertdalay = 60;
    } 
    setcookie("pm-alert", "ON", time() + $alertdelay);
    $popuptext = "
	<html>
		<head>
			<title>" . $pm_inbox['inbox']['new'] . " New Message(s)</title>
			<link rel=stylesheet href=" . THEME . "style.css>
		</head>
		<body style=\'padding-left:2px;padding-right:2px;padding:2px;padding-bottom:2px;margin:0px;text-align:center\' marginheight=0 marginleft=0 topmargin=0 leftmargin=0>
		<table style=\'width:100%;text-align:center;height:99%;padding-bottom:2px\' class=\'bodytable\'>
			<tr>
				<td width=100% >
					<center><b>--- Private Message ---</b><br />" . $pm_inbox['inbox']['new'] . " New Private Messages<br />" . $pm_inbox['inbox']['unread'] . " Unread messages<br /><br />
					<form>
						<input class=\'button\' type=\'submit\' onclick=\'self.close();\' value = \'ok\' />
					</form>
					</center>
				</td>
			</tr>
		</table>
		</body>
	</html> ";
    $popuptext = str_replace("\n", "", $popuptext);
    $popuptext = str_replace("\t", "", $popuptext);
    $text .= "
	<script type='text/javascript'>
	<!--
	winl=(screen.width-200)/2;
	wint = (screen.height-100)/2;
	winProp = 'width=200,height=100,left='+winl+',top='+wint+',scrollbars=no';
	window.open('javascript:document.write(\"" . $popuptext . "\");', \"pm_popup\", winProp);
	--></script >";
    return $text;
} 

?>