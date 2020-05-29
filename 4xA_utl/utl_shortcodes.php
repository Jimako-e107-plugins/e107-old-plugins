<?php
/*
+---------------------------------------------------------------+
|        4xA-UTL (Users-Team-List or Website-Crew) v0.3 - by ***RuSsE*** (www.e107.4xA.de) 06.05.2009
|	sorce: ../../4xA_utl/utl_shortcodes.php
|
|        For the e107 website system
|        Steve Dunstan
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
$utl_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);
/*

SC_BEGIN UTL_LIST_IS
global $user;
return $user['e4xA_utl_id'];
SC_END

SC_BEGIN USER_DATA_DESC
global $user,$tp;
if($user['e4xA_utl_text']=="")
{return "<i>".e4xA_UTL_NO_DATA."</i>";}
else
return $tp -> toHTML($user['e4xA_utl_text'], TRUE, '', '');
SC_END

SC_BEGIN USER_AUFG
global $user,$tp,$sql,$pref;
$sql -> db_Select("e4xA_utl_param", "*", "e4xA_param_name!='' ORDER BY e4xA_param_sort ");
$par_count =0;
while($row = $sql-> db_Fetch())
	{
	if($pref['4xA_utl_show']==2)
		{
		$SACHBEREICH[$row['e4xA_param_id']]= "<img border='0' style='vertical-align:middle;width:30px;' title='".$row['e4xA_param_name']."' src='".e_PLUGIN."4xA_utl/logos/".$row['e4xA_param_img']."'alt='".$row['e4xA_param_name']."' />";
		}
	elseif($pref['4xA_utl_show']==3)
		{
		$SACHBEREICH[$row['e4xA_param_id']]= "<img border='0' style='vertical-align:middle;width:30px;' title='".$row['e4xA_param_name']."' src='".e_PLUGIN."4xA_utl/logos/".$row['e4xA_param_img']."' />-".$row['e4xA_param_name']."";
		}	
	else{
		$SACHBEREICH[$row['e4xA_param_id']]=$row['e4xA_param_name'];	
	 }
	}
$SACHBEREICHE="";
$tmpll=explode("~", $user['e4xA_utl_para']);
$max=count($tmpll);
for($i=0; $i< $max; $i++)
{
if($tmpll[$i]){
	$SACHBEREICHE.=$SACHBEREICH[$tmpll[$i]];
	if($i <($max-2))
		{
		if($pref['4xA_utl_show']==3)
			{
			$SACHBEREICHE.="<br/>";
			}
		else{
			$SACHBEREICHE.=", ";
		  }
		}
	
	}
}

return $SACHBEREICHE;
SC_END




SC_BEGIN USER_EMAIL
global $user,$tp;
return ($user['user_hideemail'] && !ADMIN) ? "<i>".e4xA_UTL_NO_MAIL."</i>" : "".$user['user_email']."";
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

SC_BEGIN USER_NAMERICH
global $user;
if($user['user_login']!="")
	{
	return ($user['user_hideemail'] && !ADMIN) ? "<i><a href='".e_BASE."user.php?id.{$user['user_id']}'>".e4xA_UTL_NO_RIG_NAME."</i></i>" : "<a href='".e_BASE."user.php?id.{$user['user_id']}'>".$user['user_login']."</a>";
	}
else{return "<i><a href='".e_BASE."user.php?id.{$user['user_id']}'>".e4xA_UTL_NO_RIG_NAME."</a></i>";}
SC_END

SC_BEGIN USER_NAME_LINK
global $user;
return "<a href='".e_BASE."user.php?id.{$user['user_id']}'>".$user['user_name']."</a>";
SC_END

SC_BEGIN USER_PHOTO
global $user,$tp;
$R=rand(1,3);
if($user['user_sess'])
		 {$U_photo = "<img src='".e_BASE."e107_files/public/avatars/{$user['user_sess']}' alt='' style='border:0px;vertical-align:middle;width:100px;padding:0px;' /> ";}
 else{
 		if($user['user_image']!="")
 			{$U_photo = $tp->parseTemplate("{USER_AVATAR=".$user['user_image']."}", true);}
 		else{
 			$U_photo = "<img src='".e_PLUGIN."4xA_utl/images/M_3.png' alt='' style='border:0px;vertical-align:middle;width:100px;padding:0px;' /> ";
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
	
	$online = "<img src='".e_PLUGIN."4xA_utl/images/onlineuser.gif' title='' alt='online'  />";
    } else {
    $online = "<img src='".e_PLUGIN."4xA_utl/images/offlineuser.gif' title='' alt='offline'  />";
}
return $online;
SC_END
*/
?>