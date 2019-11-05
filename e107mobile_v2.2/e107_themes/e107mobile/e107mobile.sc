global $tp,$pref;
$ret = "";

				include_lan(e_PLUGIN."login_menu/languages/".e_LANGUAGE.".php");

				$sep = (defined("LOGINC_SEP")) ? LOGINC_SEP : "<span class='loginc sep'>|</span>";

				if (USER == TRUE){
						//$ret .= "<span class='mediumtext'><span class='loginc welcome'>".LOGIN_MENU_L5." ".USERNAME.".</span><br/>".$sep." ";
						if(ADMIN == TRUE){
								$ret .= "<a class='loginc admin' href='".e_ADMIN."admin.php'>".LOGIN_MENU_L11."</a> ".$sep." ";
						}
						$ret .= ($custom_query[0] != "login noprofile") ? "<a class='loginc profile' href='".e_BASE."user.php?id.".USERID."'>".LOGIN_MENU_L13."</a>\n".$sep." ":"";
						$ret .= "<a class='loginc usersettings' href='" . e_BASE . "usersettings.php'>".LOGIN_MENU_L12."</a> ".$sep." <a class='loginc logout' href='".e_BASE."index.php?logout'>".LOGIN_MENU_L8."</a></span>";
				} else {
						$ret .= "<h3>Please <a href='".e_HTTP ."login.php'>login</a> or <a href='".e_HTTP ."signup.php'>register</a>.</h3>";			
				}
				return $ret;

