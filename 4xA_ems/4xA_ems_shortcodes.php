<?php
/*
+---------------------------------------------------------------+
|	4xA-EMS v0.7 - by ***RuSsE*** (www.e107.4xA.de) 29.10.2009
|	sorce: ../../4xA_ems/4xA_ems_shortcodes.php
| 	Original- Idee stamm von EMS-Plugin version 1.0 trunk of iNfLuX (influx604@gmail.com)
|
|	For the e107 website system
|	©Steve Dunstan
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
$e4xA_ems_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);
/*

SC_BEGIN USER_EMAIL
global $user,$tp;
$VERST= "<i>".e4xA_EMS_NO_VIEW."</i>";
return ($user['user_hideemail'] && !ADMIN) ? $VERST : $user['user_email'];
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

SC_BEGIN USER_NAME_LINK
global $user;
return "<a href='".e_BASE."user.php?id.{$user['user_id']}'>".$user['user_name']."</a>";
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
	
	$online = "<img src='".e_PLUGIN."4xA_ems/images/onlineuser.gif' title='' alt='online'  />";
    } else {
    $online = "<img src='".e_PLUGIN."4xA_ems/images/offlineuser.gif' title='' alt='offline'  />";
}
return $online;
SC_END

SC_BEGIN USER_NAMERICH
global $user;
$verst="<i>".e4xA_EMS_NO_VIEW."</i>";
if($user['user_login']!="")
	{
	return ($user['user_hideemail'] && !ADMIN) ? $verst : $user['user_login'];
	}
else{return "<i>".e4xA_EMS_NO_DATA."</i>";}
SC_END

SC_BEGIN USER_BURTSDAY
global $user;
$MY_BUT_FIELD_NAME = "user_".$pref['4xA_ems_burt_field'];
if($user['user_hideemail'] && !ADMIN) {return "";}
else{
		if($user[$MY_BUT_FIELD_NAME]==0){return "<i>".e4xA_EMS_NO_DATA."</i>";;}
		else{return $user[$MY_BUT_FIELD_NAME];}
		}
SC_END

SC_BEGIN USER_ALTER
global $user;
if($user['user_hideemail'] && !ADMIN)
		{return "<i>".e4xA_EMS_NO_VIEW."</i>";}
else{
		if($user['user_alter']==0)
			{return "";}
		else{return " / (".$user['user_alter'].")".e4xA_EMS_ALTER."";}
		}
SC_END




SC_BEGIN USER_PHOTO
global $user,$tr;
$R=rand(1,3);
if($user['user_image']!="")
	{$avater_flag=true;
	list($firs,$style, $file_pfad) = explode("-", $user['user_image']);
	if($style=="upload")
		{$Avatar_pfad=e_BASE."e107_files/public/avatars/".$file_pfad;}
	else{
		list($vd,$pfad) = explode("://", $firs);
		if($vd=="http"){
			$Avatar_pfad=$user['user_image'];}
		else{
			$Avatar_pfad=e_BASE."e107_images/avatars/".$vd;
			}
		}
$Avatar_img="<img src='".$Avatar_pfad."' alt='' style='border:0px;vertical-align:middle;width:70px;padding:0px;'/>";	
	}
else{$avater_flag=false;}

if(file_exists(e_BASE."e107_files/public/avatars/".$user['user_sess']) && $user['user_sess']!="")
		 {
		 	$U_photo = "<img src='".e_BASE."e107_files/public/avatars/".$user['user_sess']."' alt='' style='border:0px;vertical-align:middle;width:70px;padding:0px;' /> ";
		 }
elseif($avater_flag && file_exists($Avatar_pfad))
		{$U_photo = $Avatar_img;
		}
 else{
	$MY_SEX_FIELD_NAM = "user_".$pref['4xA_ems_gen_field'];
	switch ($user[$MY_SEX_FIELD_NAM]) 
		{
		case "Mann":
			$U_photo = "<img src='".e_PLUGIN."4xA_ems/images/M_1.png' alt='' style='border:0px;vertical-align:middle;width:70px;padding:0px;' /> ";
			break;
		case "Frau":
			$U_photo = "<img src='".e_PLUGIN."4xA_ems/images/W_3.png' alt='' style='border:0px;vertical-align:middle;width:70px;padding:0px;' /> ";
			break;
		default:
			$U_photo = "<img src='".e_PLUGIN."4xA_ems/images/M_3.png' alt='' style='border:0px;vertical-align:middle;width:70px;padding:0px;' /> ";
			break;
		}		
	}
return $U_photo;
SC_END
*/
?>