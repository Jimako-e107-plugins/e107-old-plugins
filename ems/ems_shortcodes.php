<?php
/*
+---------------------------------------------------------------+
|        EMS v1.0 - by iNfLuX (influx604@gmail.com)
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
$ems_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);

/*


SC_BEGIN USER_EMAIL
global $user,$tp;
return ($user['user_hideemail'] && !ADMIN) ? "<i>".EMS_148."</i>" : "".$user['user_email']."";
SC_END

SC_BEGIN USER_JOIN
global $user;
return date("d/m/Y", $user['user_join']);
SC_END

SC_BEGIN USER_ICON
if(defined("USER_ICON"))
{
	return USER_ICON;
}
if(file_exists(THEME."generic/user.png"))
{
	return "<img src='".THEME_ABS."generic/user.png' alt='' style='border:0px;vertical-align:middle;' /> ";
}
return "<img src='".e_IMAGE_ABS."user_icons/user_".IMODE.".png' alt='' style='border:0px;vertical-align:middle;' /> ";
SC_END

SC_BEGIN USER_ICON_LINK
global $user;
if(defined("USER_ICON"))
{
	$icon = USER_ICON;
}
else if(file_exists(THEME."generic/user.png"))
{
	$icon = "<img src='".THEME_ABS."generic/user.png' alt='' style='border:0px;vertical-align:middle;' /> ";
}
else
{
	$icon = "<img src='".e_IMAGE_ABS."user_icons/user_".IMODE.".png' alt='' style='border:0px;vertical-align:middle;' /> ";
}
return "<a href='".e_BASE."user.php?id.{$user['user_id']}'>{$icon}</a>";
SC_END

SC_BEGIN USER_ID
global $user;
return $user['user_id'];
SC_END

SC_BEGIN USER_NAME
global $user;
return $user['user_name'];
SC_END

SC_BEGIN USER_BURTSDAY
global $user;
if($user['user_hideemail'] && !ADMIN) {return "";}
else{
if($user['user_burtd']==0){return "<i>".EMS_149."</i>";;}
else{return $user['user_burtd'];}
}
SC_END

SC_BEGIN USER_ALTER
global $user;
if($user['user_hideemail'] && !ADMIN) {return "<i>".EMS_148."</i>";}
else{
if($user['user_alter']==0){return "";}
else{return "(".$user['user_alter'].")".EMS_152."";}
}
SC_END

SC_BEGIN USER_NAMERICH
global $user;
if($user['user_login']!="")
	{
	return ($user['user_hideemail'] && !ADMIN) ? "<i>".EMS_148."</i>" : "".$user['user_login']."";
	}
else{return "<i>".EMS_149."</i>";}
SC_END

SC_BEGIN USER_DATA_VON
global $user;
global $pref;
$AUS=$user['user_von']."-".$user['user_bis'];
///if($AUS=="-")
return ($AUS=="-") ? "<i>".EMS_149."</i>" : $AUS;
SC_END

SC_BEGIN USER_NAME_LINK
global $user;
return "<a href='".e_BASE."user.php?id.{$user['user_id']}'>".$user['user_name']."</a>";
SC_END

SC_BEGIN USER_PHOTO
global $user;
$R=rand(1,3);
if($user['user_sess'])
		 {$U_photo = "<img src='".e_BASE."e107_files/public/avatars/{$user['user_sess']}' alt='' style='border:0px;vertical-align:middle;width:70px;padding:0px;' /> ";}
 else{
 	if($user['sex']==1)
 		{
		$U_photo = "<img src='".e_PLUGIN."ems/images/M_1.png' alt='' style='border:0px;vertical-align:middle;width:70px;padding:0px;' /> ";
 		}
 	elseif($user['sex']==2)
 		{
		$U_photo = "<img src='".e_PLUGIN."ems/images/W_3.png' alt='' style='border:0px;vertical-align:middle;width:70px;padding:0px;' /> ";
 		}
 	elseif($user['sex']==3)
 		{
		$U_photo = "<img src='".e_PLUGIN."ems/images/paar.png' alt='' style='border:0px;vertical-align:middle;width:70px;padding:0px;' /> ";
 		}
 	else{
 		$U_photo = "<img src='".e_PLUGIN."ems/images/M_3.png' alt='' style='border:0px;vertical-align:middle;width:70px;padding:0px;' /> ";
 		}			
	}
return $U_photo;
SC_END

SC_BEGIN USER_TAB_COUNT
global $user;
return $user['nr'];
SC_END

SC_BEGIN USER_LOGINNAME
global $user;
if(ADMIN && getperms("4")) {
	return $user['user_loginname'];
}
SC_END

SC_BEGIN USER_STATUS
global $sql, $user;
$on_name = "".$user['user_id'].".".$user['user_name']."";
	$mysql_result = mysql_query("SELECT * FROM ".MPREFIX."online WHERE online_user_id='".$on_name."'") or die(mysql_error());
    $mysql_row = mysql_fetch_array($mysql_result);

if ($mysql_row > 0)  {
	
	$online = "<img src='".e_PLUGIN."ems/images/onlineuser.gif' title='' alt='online'  />";
    } else {
    $online = "<img src='".e_PLUGIN."ems/images/offlineuser.gif' title='' alt='offline'  />";
}
return $online;
SC_END
*/
?>