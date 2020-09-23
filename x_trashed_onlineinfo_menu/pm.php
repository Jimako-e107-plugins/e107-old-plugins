<?php
if (!defined('e107_INIT')) { exit; }


function onlineinfo_pm_show_popup()
			{
				global $pm_inbox, $pm_prefs;
				$alertdelay = intval($pm_prefs['popup_delay']);
				if($alertdelay == 0) { $alertdalay = 60; }
				setcookie("pm-alert", "ON", time()+$alertdelay);
				$popuptext = "
				<html>
					<head>
						<title>".$pm_inbox['inbox']['new']." ".ONLINEINFO_LAN_PM_109."</title>
						<link rel=stylesheet href=" . THEME . "style.css>
					</head>
					<body style=\'padding-left:2px;padding-right:2px;padding:2px;padding-bottom:2px;margin:0px;text-align:center\' marginheight=0 marginleft=0 topmargin=0 leftmargin=0>
					<table style=\'width:100%;text-align:center;height:99%;padding-bottom:2px\' class=\'bodytable\'>
						<tr>
							<td width=100% >
								<center><b>--- ".ONLINEINFO_LAN_PM." ---</b><br />".$pm_inbox['inbox']['new']." ".ONLINEINFO_LAN_PM_109."<br />".$pm_inbox['inbox']['unread']." ".ONLINEINFO_LAN_PM_37."<br /><br />
								<form>
									<input class=\'button\' type=\'submit\' onclick=\'self.close();\' value = \'".ONLINEINFO_LAN_PM_110."\' />
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
				winl=(screen.width-200)/2;
				wint = (screen.height-100)/2;
				winProp = 'width=200,height=100,left='+winl+',top='+wint+',scrollbars=no';
				window.open('javascript:document.write(\"".$popuptext."\");', \"pm_popup\", winProp);
				</script >";
				return $text;
	}


if($pref['onlineinfo_ibfpm']==0){

	if(check_class($orderclass)){


if ($orderhide == 1)
    {

$text .= "<div id='pm-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".ONLINEINFO_LOGIN_MENU_L29."'>&nbsp;".ONLINEINFO_LOGIN_MENU_L29." (".$unreadpms.")</div>";
$text .= "<div id='pm' class='switchgroup1' style='display:none'>";
$text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:20px;'><tr><td>";

}else{
$text .= "<div class='smallblacktext' style='text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".ONLINEINFO_LOGIN_MENU_L29."'>".ONLINEINFO_LOGIN_MENU_L29."</div>";
$text .= "<div>";
$text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:20px;'><tr><td>";
}



			global $sysprefs, $pref, $pm_prefs;
			if(!isset($pm_prefs['perpage']))
			{
				$pm_prefs = $sysprefs->getArray("pm_prefs");
			}
			require_once(e_PLUGIN."pm/pm_func.php");
			pm_getInfo('clear');

			define("OLPM_INBOX_ICON", "<img src='".e_PLUGIN."onlineinfo_menu/images/mail_get.png' style='height:16px; border:0' alt='".ONLINEINFO_LAN_PM_25."' title='".ONLINEINFO_LAN_PM_25."' />");
			define("OLPM_OUTBOX_ICON", "<img src='".e_PLUGIN."onlineinfo_menu/images/mail_send.png' style='height:16px; border:0' alt='".ONLINEINFO_LAN_PM_26."' title='".ONLINEINFO_LAN_PM_26."' />");
			define("PM_SEND_LINK", ONLINEINFO_LAN_PM_35);
			define("NEWPM_ANIMATION", "<img src='".e_PLUGIN."pm/images/newpm.gif' alt='' style='border:0' />");

			$sc_style['SEND_PM_LINK']['pre'] = "<br />[ ";
			$sc_style['SEND_PM_LINK']['post'] = " ]";

			$sc_style['INBOX_FILLED']['pre'] = "[";
			$sc_style['INBOX_FILLED']['post'] = "%]";

			$sc_style['OUTBOX_FILLED']['pre'] = "[";
			$sc_style['OUTBOX_FILLED']['post'] = "%]";

			$sc_style['NEWPM_ANIMATE']['pre'] = "<a href='".e_PLUGIN_ABS."pm/pm.php?inbox'>";
			$sc_style['NEWPM_ANIMATE']['post'] = "</a>";


			if(!defined($pm_menu_template))
			{
				$pm_menu_template = "
				<a href='".e_PLUGIN_ABS."pm/pm.php?inbox'>".OLPM_INBOX_ICON."</a>
				<a href='".e_PLUGIN_ABS."pm/pm.php?inbox'>".ONLINEINFO_LAN_PM_25."</a>
				{NEWPM_ANIMATE}
				<br />
				{INBOX_TOTAL} ".ONLINEINFO_LAN_PM_36.", {INBOX_UNREAD} ".ONLINEINFO_LAN_PM_37." {INBOX_FILLED}
				<br />
				<a href='".e_PLUGIN_ABS."pm/pm.php?outbox'>".OLPM_OUTBOX_ICON."</a>
				<a href='".e_PLUGIN_ABS."pm/pm.php?outbox'>".ONLINEINFO_LAN_PM_26."</a><br />
				{OUTBOX_TOTAL} ".ONLINEINFO_LAN_PM_36.", {OUTBOX_UNREAD} ".ONLINEINFO_LAN_PM_37." {OUTBOX_FILLED}
				{SEND_PM_LINK}
				";
			}

			if(check_class($pm_prefs['pm_class']))
			{
				global $tp, $pm_inbox;
				$pm_inbox = pm_getInfo('inbox');
				require_once(e_PLUGIN."pm/pm_shortcodes.php");
				$text .= $tp->parseTemplate($pm_menu_template, TRUE, $pm_shortcodes);
				if($pm_inbox['inbox']['new'] > 0 && $pm_prefs['popup'] && strpos(e_SELF, "pm.php") === FALSE && $_COOKIE["pm-alert"] != "ON")
				{
					$text .= onlineinfo_pm_show_popup();
					
					if($pref['onlineinfo_sound']!="none" || $pref['onlineinfo_sound']!=""){
						
							$checkpath = explode("/pm/",e_SELF);
	
	if($checkpath[1] != "pm.php"){
				$text.="<embed src=\"".e_PLUGIN."onlineinfo_menu/sounds/".$pref['onlineinfo_sound']."\" autostart=\"true\" loop=\"1\" hidden=\"true\"></embed>";
				}
}
				}

			}


	$text .= "</td></tr></table><br /></div>";

		}




}
// IPB Forum PM System


if($pref['onlineinfo_ibfpm']==1){
	$onlineinfo_ipb_sql = new db;

	// check e107 userid = IPB userid

	$sql -> db_Select("user","*","user_id=".USERID."");
	while($row = $sql -> db_Fetch())
		{
		extract($row);
		$userloginname= $user_loginname;

		}

	//get userid from IPB
	$script="SELECT * FROM ".$pref['onlineinfo_ibfprefix']."members WHERE name ='".$userloginname."'";
	$onlineinfo_getipbuserid = $onlineinfo_ipb_sql->db_Select_gen($script);
	while ($row = $onlineinfo_ipb_sql->db_Fetch())
	{
	$ipbuserid=	$row['id'];
	}

 if($ipbuserid==USERID)
 	{

		define("PM_INBOX_ICON", "<img src='".e_PLUGIN."onlineinfo_menu/images/mail_get.png' style='height:16;width:16;border:0' alt='".ONLINEINFO_LAN_PM_25."' title='".LAN_PM_25."' />");
		define("PM_OUTBOX_ICON", "<img src='".e_PLUGIN."onlineinfo_menu/images/mail_send.png' style='height:16;width:16;border:0' alt='".ONLINEINFO_LAN_PM_26."' title='".LAN_PM_26."' />");
		define("PM_SEND_LINK", ONLINEINFO_LAN_PM_35);
		define("NEWPM_ANIMATION", "<img src='".e_PLUGIN."onlineinfo_menu/images/newpm.gif' alt='' style='border:0' />");


		$script="SELECT * FROM ".$pref['onlineinfo_ibfprefix']."message_topics WHERE mt_to_id = ".USERID;
		$onlineinfo_getipbinbox = $onlineinfo_ipb_sql->db_Select_gen($script);
		$script="SELECT * FROM ".$pref['onlineinfo_ibfprefix']."message_topics WHERE mt_from_id = ".USERID;
		$onlineinfo_getipboutbox = $onlineinfo_ipb_sql->db_Select_gen($script);
		// $script="SELECT * FROM ".$pref['onlineinfo_ibfprefix']."message_topics WHERE mt_read=0 AND mt_to_id = ".USERID;
		// $onlineinfo_getipbinboxunread = $onlineinfo_ipb_sql->db_Select_gen($script);
		$script="SELECT * FROM ".$pref['onlineinfo_ibfprefix']."message_topics WHERE mt_read=0 AND mt_from_id = ".USERID;
		$onlineinfo_getipboutboxunread = $onlineinfo_ipb_sql->db_Select_gen($script);



	$text .= "<div id='pm-title' style='cursor:hand; text-align:left; vertical-align: font-size: ".$onlineinfomenufsize."px; middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".ONLINEINFO_LOGIN_MENU_L66.ONLINEINFO_LOGIN_MENU_L29."'>&nbsp;".ONLINEINFO_LOGIN_MENU_L66.ONLINEINFO_LOGIN_MENU_L29." (".$onlineinfo_getipbinboxunread.")</div>";
	$text .= "<div id='pm' class='switchgroup1' style='display:none'>";
$text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:20px;'><tr><td>";







		if ($onlineinfo_getipbinboxunread!=0){
			$text.="<a href='".SITEURL.$pref['onlineinfo_ibflocation']."/index.php?act=Msg&CODE=01&VID=in'>".NEWPM_ANIMATION."</a><br />";
		}

		$text.="<a href='".SITEURL.$pref['onlineinfo_ibflocation']."/index.php?act=Msg&CODE=01&VID=in'>".PM_INBOX_ICON."</a>
		<a href='".SITEURL.$pref['onlineinfo_ibflocation']."/index.php?act=Msg&CODE=01&VID=in'>".ONLINEINFO_LAN_PM_25."</a>";




		$text.="<br />
		".$onlineinfo_getipbinbox."&nbsp;".ONLINEINFO_LAN_PM_36.",&nbsp;".$onlineinfo_getipbinboxunread."&nbsp;".ONLINEINFO_LAN_PM_37."
		<br />
		<a href='".SITEURL.$pref['onlineinfo_ibflocation']."/index.php?act=Msg&CODE=01&VID=sent'>".PM_OUTBOX_ICON."</a>
		<a href='".SITEURL.$pref['onlineinfo_ibflocation']."/index.php?act=Msg&CODE=01&VID=sent'>".ONLINEINFO_LAN_PM_26."</a><br />
		".$onlineinfo_getipboutbox."&nbsp;".ONLINEINFO_LAN_PM_36.",&nbsp;".$onlineinfo_getipboutboxunread."&nbsp;".ONLINEINFO_LAN_PM_37."
		<br />[<a href='".SITEURL.$pref['onlineinfo_ibflocation']."/index.php?act=Msg&CODE=04'>".ONLINEINFO_LAN_PM_35."</a> ]";


		$text .= "</td></tr></table></div>";

	}
}
?>