<?php
/*
+------------------------------------------------------------------------------+
|     e107 Mobile  v2.2 by Martinj
|	November 2010
|	Visit www.martinj.co.uk for help and support
+------------------------------------------------------------------------------+
*/

if($pref['mobile_active']=="true") {
	function detect_mobile_device(){
	$agent=$_SERVER['HTTP_USER_AGENT'];

		// check for blank agent or iPad etc.. send them to a normal theme...
		$a=array("iPad","");

			foreach ($a as $aCh) {
				if(strpos($agent,$aCh)==true) {
					return false;
				}
			}

			$b = array('acs-','alav','alca','amoi','audi','aste','avan','benq','bird','blac','blaz','brew','cell','cldc','cmd-',
			'dang',' doco','eric','hipt','inno','ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-','maui','maxo'
			,'midp',' mits','mmef','mobi','mot-','moto','mwbp','nec-','newt','noki','opwv','palm','pana','pant','pdxg','phil','play'
			,'pluc',' port','prox','qtek','qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar','sie-','siem','smal',
			'smar',' sony','sph-','symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda','w3c ','wap-','wapa','wapi',
			'wapp','wapr','webc','winw','winw','xda','xda-');
				if(isset($b[substr($agent,0,4)])){
							return true;
					}

			$c = array('Googlebot-Mobile','YahooSeeker/M1A1-R2D2','W3C-mobileOK','iPhone','Android','iPod','Maemo Browser','Nokia','BlackBerry','HTC_Smart','HTC Hero',
			'UP.Browser','UP.Link','IEMobile','Opera Mini','MIDP','Symbian','WAP','J-PHONE','Mobile Safari','PalmOS','webOS','PalmCentro','PalmSource');
				foreach ($c as $bCh) {
					if(strpos($agent,$bCh)==true) {
						return true;
					}
				}

			if(stristr($_SERVER['HTTP_USER_AGENT'],'windows')&&!stristr($_SERVER['HTTP_USER_AGENT'],'windows ce')){
					return false;
			}

			if(stristr($_SERVER['HTTP_ACCEPT'],'text/vnd.wap.wml')||stristr($_SERVER['HTTP_ACCEPT'],'application/vnd.wap.xhtml+xml')){
					return true;
			}

	} // end detect mobile function

		session_start();

		switch($_GET['e107mobile']) {
			case 'cs':
				unset($_SESSION['e107mobile']);
				break;
			case 'on':
				$_SESSION['e107mobile']='e107_mobile_theme';
				break;
			case 'off':
				$_SESSION['e107mobile']='e107_core_theme';
				break;
		default;
		}

		if(!ISSET($_SESSION['e107mobile'])) {
			$_SESSION['e107mobile'] = (detect_mobile_device() ? 'e107_mobile_theme' : 'e107_core_theme');
			// check for iPhone
			if($_SESSION['e107mobile'] == 'e107_mobile_theme') {
			$browser=strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");

				if($browser !==FALSE) {
				$_SESSION['e107mobile']="e107_iphone_theme";
				}
			}
		}

		switch($_SESSION['e107mobile']) {
			case 'e107_mobile_theme':
				define("THEME", e_THEME.$pref['mobile_theme']."/");
				define("THEME_ABS", e_THEME_ABS.$pref['mobile_theme']."/");
				$e107->site_theme = $pref['mobile_theme'];
				break;

			case 'e107_iphone_theme':
				define("THEME", e_THEME.$pref['mobile_iphone']."/");
				define("THEME_ABS", e_THEME_ABS.$pref['mobile_iphone']."/");
				$e107->site_theme = $pref['mobile_iphone'];
				break;

				default:
		}

	// preview (doesnt save the theme, just uses it)
	if($_GET['e107mobile']=='temp') {
		define("THEME", e_THEME.$pref['mobile_theme']."/");
		define("THEME_ABS", e_THEME_ABS.$pref['mobile_theme']."/");
	}
}

	define("footerlink","PGEgaHJlZj0iaHR0cDovL3d3dy5tYXJ0aW5qLmNvLnVrIj5Nb2JpbGUgVGhlbWUgYnkgTWFydGluajwvYT4=");

			