<?php

if($menu_pref['onlineinfo_last']==1){

	if($menu_pref['onlineinfo_hidelast']==1){
		$text .= "<br /><div style='cursor:hand' title='".ONLINEINFO_LOGIN_MENU_L31."' onclick=\"expandit('lastv')\"><table style='width:".$menu_pref['onlineinfo_width']."'><tr><td class='smallblacktext' ><a  href='javascript:void(0);'  title='".ONLINEINFO_LOGIN_MENU_L31."'><b>&plusmn;&nbsp;".ONLINEINFO_LOGIN_MENU_L31."</b></a>
		</td>
		</tr>
		</table></div>";
		$text .="<div id='lastv' style=\"display:none\">";
		$text .= "<table class='forumheader3' style='width:".$menu_pref['onlineinfo_width']."'>";

	}else{
	$text .="<br /><span class='smallblacktext'><b>".ONLINEINFO_LOGIN_MENU_L31."</b></span><br /><div style='text-align:left'><left><table width='".$menu_pref['onlineinfo_width']."'>";
	}

	$gen = new convert;

	if(!$sql -> db_Select("user", "user_id, user_name, user_currentvisit", "ORDER BY user_currentvisit DESC LIMIT 0,".$menu_pref['onlineinfo_lastnum']."", "no_where")){
		$text .= "<span class=\"smalltext\">No members yet<br />";
	}else{
		while(list($user_id, $user_name, $user_currentvisit) = $sql-> db_Fetch()){
			$user = $user_name;
			$userid = $user_id;
			//$datestamp = date("d/m H:m", $user_currentvisit);
			$datestamp = $gen->convert_date($user_currentvisit, "short");

			$text .= "<tr><td style='vertical-align:top' align='left'><img src='".e_PLUGIN."onlineinfo4_menu/images/user.png' alt='' style='vertical-align:middle' /></td>
			<td valign='top' align='left' style='width:".$menu_pref['onlineinfo_width'].";'><a href='".e_BASE."user.php?id.$user_id'>".$user."</a> ".$datestamp."</td></tr>";
		}
	}


	if($menu_pref['onlineinfo_hidelast']==1){

		$text .="</table></div>";
	}else{
		$text .= "</table></left></div>";
	}
}
?>