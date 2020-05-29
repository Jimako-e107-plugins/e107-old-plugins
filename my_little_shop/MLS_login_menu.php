<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.7/e107_plugins/my_little_shop/login_menu.php,v $
|     $Revision: 1.53 $
|     $Date: 2007/05/27 18:57:44 $
|     $Author: e107steved $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

if(defined("FPW_ACTIVE"))
{
	return;      // prevent failed login attempts when fpw.php is loaded before this menu.
}
require_once(e_PLUGIN."my_little_shop/handler/constanten.php");
global $eMenuActive, $e107, $tp, $use_imagecode, $ADMIN_DIRECTORY,$bullet;
require_once(e_PLUGIN.PLUG_FOLDER."templates/login_menu_shortcodes.php");
$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/login_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/login_lan.php");

$ip = $e107->getip();

	if(defined("BULLET"))
	{
   		$bullet = "<img src='".THEME_ABS."images/".BULLET."' alt='' style='vertical-align: middle;' />";
	}
	elseif(file_exists(THEME."images/bullet2.gif"))
	{
		$bullet = "<img src='".THEME_ABS."images/bullet2.gif' alt='bullet' style='vertical-align: middle;' />";
	}
	else
	{
		$bullet = "";
	}

if (defined('CORRUPT_COOKIE') && CORRUPT_COOKIE == TRUE)
{
	$text = "<div style='text-align:center'>".MLS_LOGIN_MENU_L7."<br /><br />
	".$bullet." <a href='".e_BASE."index.php?logout'>".MLS_LOGIN_MENU_L8."</a></div>";
	$ns->tablerender(MLS_LOGIN_MENU_L9, $text, 'login');
}
$use_imagecode = ($pref['logcode'] && extension_loaded('gd'));

if ($use_imagecode)
{
	global $sec_img;
	include_once(e_HANDLER.'secure_img_handler.php');
	$sec_img = new secure_image;
}
$text = '';
if (USER == TRUE || ADMIN == TRUE)
{
	if (!isset($LOGIN_MENU_LOGGED)) {
		if (file_exists(THEME."login_menu_template.php")){
	   		require(THEME."login_menu_template.php");
		}else{
			require(e_PLUGIN.PLUG_FOLDER."templates/login_menu_template.php");
		}
	}

	if(!$LOGIN_MENU_LOGGED){ // if still doesn't exist in the user template.
    	require(e_PLUGIN.PLUG_FOLDER."templates/login_menu_template.php");
	}

    $text = $tp->parseTemplate($LOGIN_MENU_LOGGED, true, $login_menu_shortcodes);

	if ($sql->db_Select('online', 'online_ip', "`online_ip` = '{$ip}' AND `online_user_id` = '0' "))
	{	// User now logged in - delete 'guest' record (tough if several users on same IP)
		$sql->db_Delete('online', "`online_ip` = '{$ip}' AND `online_user_id` = '0' ");
	}

	
	if (file_exists(THEME.'images/login_menu.png')) {
		$caption = '<img src="'.THEME_ABS.'images/login_menu.png" alt="" />'.MLS_LOGIN_MENU_L5.' '.USERNAME;
	} else {
		$caption = MLS_LOGIN_MENU_L5.' '.USERNAME;
	}
	$ns->tablerender($caption, $text, 'login');
} else {
	if (!$LOGIN_MENU_FORM || !$LOGIN_MENU_MESSAGE) {
		if (file_exists(THEME."login_menu_template.php")){
	   		require_once(THEME."login_menu_template.php");
		}else{
			require_once(e_PLUGIN.PLUG_FOLDER."templates/login_menu_template.php");
		}
	}
	if(!$LOGIN_MENU_FORM || !$LOGIN_MENU_MESSAGE){
    	require(e_PLUGIN.PLUG_FOLDER."templates/login_menu_template.php");
	}

	if (strpos(e_SELF, $ADMIN_DIRECTORY) === FALSE)
	{

		if (LOGINMESSAGE != '') {
			$text = $tp->parseTemplate($LOGIN_MENU_MESSAGE, true, $login_menu_shortcodes);
		}

		$text .= '<form method="post" action="'.e_SELF.(e_QUERY ? '?'.e_QUERY : '').'">';
		$text .= $tp->parseTemplate($LOGIN_MENU_FORM, true, $login_menu_shortcodes);
		$text .= '</form>';
	} else {
		$text = $tp->parseTemplate("<div style='padding-top: 150px'>{LM_FPW_LINK}</div>", true, $login_menu_shortcodes);
	}
	if (file_exists(THEME.'images/login_menu.png')) {
		$caption = '<img src="'.THEME_ABS.'images/login_menu.png" alt="" />'.MLS_LOGIN_MENU_L5;
	} else {
		$caption = MLS_LOGIN_MENU_L5;
	}
	$ns->tablerender($caption, $text, 'login');
}

?>
