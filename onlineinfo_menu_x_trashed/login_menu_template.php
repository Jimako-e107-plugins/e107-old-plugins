<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.7/e107_plugins/login_menu/login_menu_template.php,v $
|     $Revision: 1.6 $
|     $Date: 2006/10/21 17:23:39 $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/
$sc_style['LM_SIGNUP_LINK']['pre'] = "<br />[ ";
$sc_style['LM_SIGNUP_LINK']['post'] = " ]";

$sc_style['LM_FPW_LINK']['pre'] = "<br />[ ";
$sc_style['LM_FPW_LINK']['post'] = " ]";

$sc_style['LM_RESEND_LINK']['pre'] = "<br />[ ";
$sc_style['LM_RESEND_LINK']['post'] = " ]";

$sc_style['LM_REMEMBERME']['pre'] = "<br />";
$sc_style['LM_REMEMBERME']['post'] = "";

if (!isset($LOGIN_MENU_FORM)){

	$LOGIN_MENU_FORM = "
	<div style='text-align: center'>".
    LOGIN_MENU_L1."
	<br />\n
	{LM_USERNAME_INPUT}
	<br />".
	LOGIN_MENU_L2."
	<br />\n
    {LM_PASSWORD_INPUT}
	<br />\n
  {LM_IMAGECODE}
	{LM_LOGINBUTTON}
  {LM_REMEMBERME}
	<br />
	{LM_SIGNUP_LINK}
	{LM_FPW_LINK}
	{LM_RESEND_LINK}
	</div>
	";
}

if (!isset($LOGIN_MENU_LOGGED)){
    $sc_style['LM_ADMINLINK']['pre'] = "";
	$sc_style['LM_ADMINLINK']['post'] = "<br />";

	$LOGIN_MENU_LOGGED = "
		{LM_MAINTENANCE}
		{LM_ADMINLINK_BULLET} {LM_ADMINLINK}
		{LM_BULLET} {LM_USERSETTINGS}<br />
		{LM_BULLET}	{LM_PROFILE}<br />
		{LM_BULLET} {LM_LOGOUT}
	";
}

if (!isset($LOGIN_MENU_MESSAGE)){
	$LOGIN_MENU_MESSAGE = '<div style="text-align: center;">{LM_MESSAGE}</div>';
}
?>
