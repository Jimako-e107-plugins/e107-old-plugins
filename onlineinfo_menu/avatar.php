<?php
if (!defined('e107_INIT')) { exit; }



$bulletimageintheme = THEME.'images/bullet2.gif';
$bulletimage = file_exists($bulletimageintheme) ? $bulletimageintheme : e_PLUGIN.'onlineinfo_menu/images/bullet2.gif';

if(check_class($orderclass))
{

if ($orderhide == 1)
    {

    $text .= '<div id="avatar-title" style="cursor:hand; text-align:left; font-size: '.$onlineinfomenufsize.'px; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold;" title="'.ONLINEINFO_LOGIN_MENU_L80.'">&nbsp;'.ONLINEINFO_LOGIN_MENU_L80.'</div>
	<div id="avatar" class="switchgroup1" style="display:none; margin-left:2px;">';

}else{
	$text .= '<div>';

}

unset($avatardata);
unset($avatarimage);
	
		$sql = new db;
		if($sql -> db_Select("user", "*", "user_id='".USERID."'")){
			$row = $sql -> db_Fetch();
			if($row[user_image] == '') {
				$user_image = e_PLUGIN.'onlineinfo_menu/images/default.png';
				$avatarimage .= '<img src="'.$user_image.'" width="50" alt="" />';
			}else{
				$user_image = $row[user_image];
				require_once(e_HANDLER.'avatar_handler.php');
				$user_image = avatar($user_image);
				$avatarimage .= '<img src="'.$user_image.'" width="50" alt="" />';
			}
		
			if(ADMIN == TRUE){
				$adminfpage = (!$pref["adminstyle"] || $pref["adminstyle"] == 'default' ? 'admin.php' : $pref["adminstyle"].'.php');				
				$avatardata .= ($pref["maintainance_flag"]==1 ? '<div style="text-align:center"><b>'.ONLINEINFO_LOGIN_MENU_L10.'</div></b><br />' : '' );
				$avatardata .= '<img src="'.$bulletimage.'" alt="bullet" />&nbsp;<a href="'.e_ADMIN.$adminfpage.'">'.ONLINEINFO_LOGIN_MENU_L11.'</a><br />';
			}
			
				$sql3 = new db;
						$bikeplugin = $sql3->db_Count("plugin", "(*)", "WHERE plugin_name='My Bike' and plugin_installflag='1'");

					  if ($bikeplugin)
				      {
						
						$avatardata.='<img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_PLUGIN.'bikes/bike.php?id.'.USERID.'">'.ONLINEINFO_LIST_BIKE1.'</a><br />';
						
					}
					
					
			// Add in look for Delete Me Plugin
			

			
			if ($pref['onlineinfo_deleteme']==1)
				      {
			$avatardata.='<img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_PLUGIN.'deleteme/deleteme.php">'.ONLINEINFO_LOGIN_MENU_L93.'</a><br />';
			}
			
			$avatardata .= '<img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_BASE.'usersettings.php">'.ONLINEINFO_LOGIN_MENU_L12.'</a><br /><img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_BASE.'user.php?id.'.USERID.'">'.ONLINEINFO_LOGIN_MENU_L13.'</a><br /><img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_BASE.'index.php?logout">'.ONLINEINFO_LOGIN_MENU_L8.'</a>';
			if(!$sql -> db_Select("online", "*", "online_ip='".$ip."' AND online_user_id='0' ")){
				$sql -> db_Delete("online", "online_ip='".$ip."' AND online_user_id='0' ");
			}
		$new_total = 0;
		$time = USERLV;
		}
		
		
		$text .='<table style="width:'.$onlineinfomenuwidth.'">
		<tr>
		<td valign="middle">';
		
		if($pref['onlineinfo_turnoffavatar']==0){
		$text.=$avatarimage;
		}
		
		$text.='</td>
		<td valign="middle" align="left">'.$avatardata.'</td>
		</tr></table>
		<br /></div>';

}
?>