<?php
// $Id: login_template.php,v 1.8 2007/12/06 21:36:02 e107steved Exp $

if (!defined('e107_INIT')) { exit; }

// ##### LOGIN HEADER TABLE -----------------------------------------------------------------------
if(!isset($LOGIN_TABLE_HEADER))
{
	$LOGIN_TABLE_HEADER .= "
	<div style='width:100%;text-align:center; margin-left: auto;margin-right: auto'>";
}

	$LOGIN_TABLE_USERNAME = "<input class='tbox' type='text' name='username' size='10' maxlength='100' />";
	$LOGIN_TABLE_PASSWORD = "<input class='tbox' type='password' name='userpass' size='10' maxlength='100' />";
	$login_message = "Login | ".SITENAME;

// ##### LOGIN TABLE -----------------------------------------------------------------------------
if(!isset($LOGIN_TABLE))
{
		$LOGIN_TABLE = "";
		if($LOGIN_TABLE_LOGINMESSAGE != ""){
				//$LOGIN_TABLE .= "<div style='text-align:center'>{LOGIN_TABLE_LOGINMESSAGE}</div>";
		}
		
		/* $LOGIN_TABLE .= "
		<div style='text-align:center'>
		".$rs -> form_open("post", e_SELF)."<table class='fborder' style='width:60%' >\n<tr>\n<td class='forumheader' style='text-align:center;' colspan='3'>Login</td>\n
		</tr>\n<tr>\n<td class='forumheader3' width='40%'>".LAN_LOGIN_1."</td>\n<td class='forumheader3' width='40%'>{LOGIN_TABLE_USERNAME}</td>\n<td class='forumheader3' width='20%' rowspan='".($LOGIN_TABLE_SECIMG_SECIMG ? 3 : 2)."' style='vertical-align: middle; margin-left: auto; margin-right: auto; text-align: center;'></td>\n</tr>\n<tr>\n<td class='forumheader3'>".LAN_LOGIN_2."</td>\n<td class='forumheader3'>{LOGIN_TABLE_PASSWORD}</td>\n</tr>\n";
 */	
	
		$LOGIN_TABLE .= "
		<div style='text-align:center'>
		".$rs -> form_open("post", e_SELF)."<table style='width:100%;text-align:center'>\n<tr>\n<td class='forumheader' style='text-align:center;' colspan='2'>Login</td>\n
		</tr>\n<tr>\n<td class='forumheader3'>".LAN_LOGIN_1."</td>\n<td class='forumheader3'>{LOGIN_TABLE_USERNAME}</td>\n</tr>\n
		<tr>\n<td class='forumheader3'>".LAN_LOGIN_2."</td>\n<td class='forumheader3'>{LOGIN_TABLE_PASSWORD}</td>\n</tr>\n";
	
	if($LOGIN_TABLE_SECIMG_SECIMG){
		$LOGIN_TABLE .= "<tr><td class='forumheader3'>{LOGIN_TABLE_SECIMG_LAN}</td>\n<td class='forumheader3'>{LOGIN_TABLE_SECIMG_HIDDEN} {LOGIN_TABLE_SECIMG_SECIMG} {LOGIN_TABLE_SECIMG_TEXTBOC}</td>\n</tr>\n";
	}

	$LOGIN_TABLE .= "<tr>\n<td class='forumheader2' style='text-align:center;' colspan='2'>{LOGIN_TABLE_AUTOLOGIN}<span class='smalltext'>{LOGIN_TABLE_AUTOLOGIN_LAN}</span><br />{LOGIN_TABLE_SUBMIT}</td>\n</tr>\n</table>".
	$rs -> form_close()."\n</div>";
}
// ##### ------------------------------------------------------------------------------------------

// ##### LOGIN TABLE FOOTER -----------------------------------------------------------------------
if(!isset($LOGIN_TABLE_FOOTER))
{
			$LOGIN_TABLE_FOOTER = "
			<div style='width:70%;margin-right:auto;margin-left:auto'>
				<div style='text-align:center'><br />
					{LOGIN_TABLE_FOOTER_USERREG}
				</div>
			</div>
	</div>";
}
// ##### ------------------------------------------------------------------------------------------


?>