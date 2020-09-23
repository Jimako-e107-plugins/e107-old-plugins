<?php
		if($menu_pref['onlineinfo_show_info']==1){
			$text .= "<br /><div style='cursor:hand' title='View Extra Information...' onclick=\"expandit('info')\">
			<table style='width:".$menu_pref['onlineinfo_width']."'>
			<tr><td class='smallblacktext' ><a  href='javascript:void(0);' title='View Extra Information...'><b>&plusmn;&nbsp;".ONLINEINFO_LOGIN_MENU_L38."</b></a>
			</td></tr></table></div>";
			$text .="<div id='info' style=\"display:none\">";
			$text .= "<table class='forumheader3' style='width:".$menu_pref['onlineinfo_width']."'><tr><td>";
		}

		require_once(e_PLUGIN."onlineinfo4_menu/".$menu_pref['onlineinfo_extraorder1']."");
		require_once(e_PLUGIN."onlineinfo4_menu/".$menu_pref['onlineinfo_extraorder2']."");
		require_once(e_PLUGIN."onlineinfo4_menu/".$menu_pref['onlineinfo_extraorder3']."");
		require_once(e_PLUGIN."onlineinfo4_menu/".$menu_pref['onlineinfo_extraorder4']."");
		require_once(e_PLUGIN."onlineinfo4_menu/".$menu_pref['onlineinfo_extraorder5']."");
		require_once(e_PLUGIN."onlineinfo4_menu/".$menu_pref['onlineinfo_extraorder6']."");

		if($menu_pref['onlineinfo_show_info']==1){ $text .="</td></tr></table></div>";}
?>