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
|     $Source: /cvsroot/e107/e107_0.7/e107_plugins/custom_theme/module.php,v $
|     $Revision: 1.0 $
|     $Date: 2005/07/01 08:03:58 $
|     $Author: lisa_ $
+----------------------------------------------------------------------------+
*/

global $sql, $pref;

// reversestrrchr()
unset($haystack, $needle);
function reversestrrchr($haystack, $needle){
   $pos = strrpos($haystack, $needle);
   if($pos === false) {
	   return $haystack;
   }
   return substr($haystack, 1, $pos);
}

// use this to divide the full url into seperate vars for each folder and subfolders
$vars = explode("/", reversestrrchr($_SERVER['PHP_SELF'], '/'));
for($a=0;$a<count($vars);$a++){
	if($vars[$a] != ""){
		$folders[] = $vars[$a];
	}
}
$PAGEROOT = $folders[count($folders)-1];

// check data from database --------------------------------------
$sql = new db;
$num_rows = $sql -> db_Select("core", "*", "e107_name='custom_theme' ");
$row = $sql -> db_Fetch();
$customtheme_pref = $eArrayStorage->ReadArray($row['e107_value']);
// end -----------------------------------------------------------

function check($path){
	global $customtheme_pref;
	$c = FALSE;
	if(isset($customtheme_pref[$path]) && $customtheme_pref[$path]){
		$c = TRUE;
	}
	return $c;
}

if ((strstr(e_SELF, "usersettings.php") && is_numeric(e_QUERY) && getperms("4") && ADMIN) || (strstr(e_SELF, $ADMIN_DIRECTORY) || strstr(e_SELF, "admin") || (isset($eplug_admin) && $eplug_admin == TRUE)) && $pref['admintheme'] && !$_POST['sitetheme']) {
	if (strpos(e_SELF.'?'.e_QUERY, 'menus.php?configure') !== FALSE) {
		checkvalidtheme($pref['sitetheme']);
	} else if (strstr(e_SELF, "newspost.php")) {
		define("MAINTHEME", e_THEME.$pref['sitetheme']."/");
		checkvalidtheme($pref['admintheme']);
	}
	else {
		checkvalidtheme($pref['admintheme']);
	}
} else {
	if(defined("USERTHEME") && USERTHEME != FALSE && USERTHEME != "USERTHEME"){
		checkvalidtheme(USERTHEME);
	}else{
		$path = e_PAGE.(e_QUERY ? "?".e_QUERY : "");

		//added better query handler to provide partly entered queries
		if(e_QUERY){
			$tmp = explode(".", e_QUERY);
			for($a=0;$a<count($tmp);$a++){
				if($tmp[$a] != ""){
					$curpage[] = $tmp[$a];
				}
				$return = "";
				for($b=0;$b<$a;$b++){
					$return .= $tmp[$b].".";
				}
				$return = e_PAGE."?".substr($return,0,-1);
				if(isset($customtheme_pref[$return]) && $customtheme_pref[$return]){
					checkvalidtheme($customtheme_pref[$return]);
					break;
				}
			}
		}
		if(isset($customtheme_pref[$path]) && $customtheme_pref[$path]){
			checkvalidtheme($customtheme_pref[$path]);
		}else{
			if(!is_object($sql)){ $sql = new db; }
			if(!$sql -> db_Select("plugin", "plugin_path", "plugin_installflag = '1' AND plugin_path = '".$PAGEROOT."' AND plugin_path != 'custom_theme' ORDER BY plugin_name ")){
				checkvalidtheme($pref['sitetheme']);	
			}else{
				while($row = $sql -> db_Fetch()){
					$pluginpath = $row['plugin_path'];
					if(isset($customtheme_pref[$pluginpath]) && $customtheme_pref[$pluginpath] != $pref['sitetheme']){
						if($PAGEROOT == $pluginpath){
							if($customtheme_pref[$pluginpath] != ""){
								checkvalidtheme($customtheme_pref[$pluginpath]);
							}else{
								checkvalidtheme($pref['sitetheme']);
							}
						}else{
							checkvalidtheme($pref['sitetheme']);
						}
					}else{
						checkvalidtheme($pref['sitetheme']);
					}
				}
			}
		}
	}
}
@require_once(THEME."theme.php");


// this is the original checkvalidtheme function from the class2.php file.
// it has to be copied (be double) because the module.php can not be looped back to
function checkvalidtheme($theme_check) {
	// arg1 = theme to check
	global $ADMIN_DIRECTORY, $tp, $e107;

	if(strstr(e_QUERY, "themepreview")) {
		list($action, $id) = explode('.', e_QUERY);
		require_once(e_HANDLER."theme_handler.php");
		$themeArray = themeHandler :: getThemes("id");
		if(!defined("PREVIEWTHEME")){ define("PREVIEWTHEME", e_THEME.$themeArray[$id]."/"); }
		if(!defined("PREVIEWTHEMENAME")){ define("PREVIEWTHEMENAME", $themeArray[$id]); }
		if(!defined("THEME")){ define("THEME", e_THEME.$themeArray[$id]."/"); }
		if(!defined("THEME_ABS")){ define("THEME_ABS", e_THEME_ABS.$themeArray[$id]."/"); }
		return;
	}
	if (@fopen(e_THEME.$theme_check."/theme.php", r)) {
		if(!defined("THEME")){ define("THEME", e_THEME.$theme_check."/"); }
		if(!defined("THEME_ABS")){ define("THEME_ABS", e_THEME_ABS.$theme_check."/"); }
		$e107->site_theme = $theme_check;
	} else {
		function search_validtheme() {
			global $e107;
			$th=substr(e_THEME, 0, -1);
			$handle=opendir($th);
			while ($file = readdir($handle)) {
				if (is_dir(e_THEME.$file) && is_readable(e_THEME.$file.'/theme.php')) {
					closedir($handle);
					$e107->site_theme = $file;
					return $file;
				}
			}
			closedir($handle);
		}
		$e107tmp_theme = search_validtheme();
		if(!defined("THEME")){ define("THEME", e_THEME.$e107tmp_theme."/"); }
		if(!defined("THEME_ABS")){ define("THEME_ABS", e_THEME_ABS.$e107tmp_theme."/"); }
		if (ADMIN && !strstr(e_SELF, $ADMIN_DIRECTORY)) {
			echo '<script>alert("'.$tp->toJS(CORE_LAN1).'")</script>';
		}
	}
	$themes_dir = $e107->e107_dirs["THEMES_DIRECTORY"];
	$e107->http_theme_dir = "{$e107->server_path}{$themes_dir}{$e107->site_theme}/";
}

?>