<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

require_once("../../class2.php");

if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}
require_once("macgurublog_dt.php");

$pref_temp['logcode'] = $pref['logcode'];
$pref_temp['auth_method'] = $pref['auth_method'];
$pref_temp['user_tracking'] = $pref['user_tracking'];
$pref_temp['disallowMultiLogin'] = $pref['disallowMultiLogin'];

$pref['logcode'] = false;
$pref['auth_method'] = 'e107';
$pref['user_tracking'] = 'cookie';
$pref['disallowMultiLogin'] = false;
require_once(e_HANDLER."login.php");

$pref['logcode'] = $pref_temp['logcode'];
$pref['auth_method'] = $pref_temp['auth_method'];
$pref['user_tracking'] = $pref_temp['user_tracking'];
$pref['disallowMultiLogin'] = $pref_temp['disallowMultiLogin'];
//------------
function wapurls($buffer) {
	$buffer = eregi_replace('<a [^<]*href=["|\']?([^ "\']*)["|\']?[^>]*>', '<a href="\1">', $buffer);
	return eregi_replace('<img [^<]*src=["|\']?([^ "\']*)["|\']?[^>]*alt=["|\']?([^ "\']*)["|\']?[^<>]*>', '<img src="\1" alt="\2"/>', $buffer);
}

class mgbwap {
	var $metas = array();
	var $rnd;
	var $rndp;
	var $timer = false;
	
	function mgbwap() {
		global $wapmode;
		$wapmode = true;
		if (isset($_POST['userlogin'])) {
			$usr = new userlogin($_POST['username'], $_POST['userpass'], $_POST['autologin']);
		}
		init_session();
		if (!defined("LOGINMESSAGE")) {
			define("LOGINMESSAGE", "");
		}
	}
	
	
	function head($useform = false) {
		global $pref;
		if (USER === false && substr(e_SELF, -7) != "wap.php") {
			header('Location: wap.php');
		} else {
			ob_start("wapurls");
			if ($pref['macgurublog_6'] == 0 || ($pref['macgurublog_6'] == 1 && $useform)) {
				header('Content-type: text/vnd.wap.wml', false);
			}
			
			$this->metas[] = 'http-equiv="Cache-Control" content="no-cache"';
			$this->metas[] = 'name="Cache-control" content="no-cache"';
			$this->metas[] = 'name="Pragma" content="no-cache"';

			echo '<?xml version="1.0" encoding="'.$pref['macgurublog_5'].'"?>'."\n";
			echo '<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.3//EN "'."\n".'"http://www.wapforum.org/DTD/wml13.dtd">';
			echo "<wml>\n";
			echo "<head>\n";
			foreach ($this->metas as $meta) {
				echo "<meta ".$meta." />\n";
			}
			echo "</head>\n";
			echo "<card id=\"mgb\" title=\"".($pref['macgurublog_11'])."\"".($this -> timer ? ' ontimer="wapblog.php"' : '').">\n";
			if ($this -> timer) {
				echo '<timer value="25"/>'."\n";
			}
		}
		$this -> metas = array();
		if ($pref['macgurublog_7'] == 0 || ($pref['macgurublog_7'] == 1 && $useform)) {
			$this -> rnd();
		}
		
	}
	function foot() {
		echo "\n</card>\n</wml>\n";
		ob_end_flush();
	}
	function rnd() {
		$this -> rnd = '?rnd='.sprintf('%02d', mt_rand(0, 99));
		$this -> rndp = '&rnd='.sprintf('%02d', mt_rand(0, 99));
	}
}


$mgbw = new mgbwap();
?>