<?php
		$text .="<table style='width:".$menu_pref['onlineinfo_width']."'><tr><td colspan='2' valign='middle'>";
		$sql = new db;
		if($sql -> db_Select("user", "*", "user_id='".USERID."'")){
			$row = $sql -> db_Fetch();
			if($row[user_image] == "") {
				$user_image = "".e_PLUGIN."onlineinfo4_menu/images/default.png";
				$text .= "<div class='spacer'><img src='".$user_image."' width='50' alt='' /></div>";
			}else{
				$user_image = $row[user_image];
				require_once(e_HANDLER."avatar_handler.php");
				$user_image = avatar($user_image);
				$text .= "<div class='spacer'><img src='".$user_image."' width='50' alt='' /></div>";
			}
		}

		$text .="</td><td colspan='2' valign='middle'>";
		$sql = new db;
		if($sql -> db_Select("user", "*", "user_id='$uid' AND md5(user_password)='$upw'")){
			if(ADMIN == TRUE){
				$adminfpage = (!$pref['adminstyle'] || $pref['adminstyle'] == "default" ? "admin.php" : $pref['adminstyle'].".php");
				$text .= ($pref['maintainance_flag']==1 ? "<div style='text-align:center'><b>".ONLINEINFO_LOGIN_MENU_L10."</div></b><br />" : "" );
				$text .= "<img src='".THEME."images/bullet2.gif' alt='bullet' />&nbsp;<a href='".e_ADMIN.$adminfpage."'>".ONLINEINFO_LOGIN_MENU_L11."</a><br />";
			}
			$text .= "<img src='".THEME."images/bullet2.gif' alt='bullet' /> <a href='".e_BASE."usersettings.php'>".ONLINEINFO_LOGIN_MENU_L12."</a>\n<br />\n<img src='".THEME."images/bullet2.gif' alt='bullet' /> <a href='".e_BASE."user.php?id.".USERID."'>".ONLINEINFO_LOGIN_MENU_L13."</a>\n<br />\n<img src='".THEME."images/bullet2.gif' alt='bullet' /> <a href='".e_BASE."?logout'>".ONLINEINFO_LOGIN_MENU_L8."</a>";
			if(!$sql -> db_Select("online", "*", "online_ip='$ip' AND online_user_id='0' ")){
				$sql -> db_Delete("online", "online_ip='$ip' AND online_user_id='0' ");
			}
		$new_total = 0;
		$time = USERLV;
		}

		$text .="</td></tr></table>";
?>