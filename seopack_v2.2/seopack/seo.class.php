<?php
class naja7host_seo 
{
	
	function deleteSpider() {
		global $sql;
			foreach($_POST['spider_id'] as $import)
			{
				//$message .= "Log id $import ";
				$message .= ($sql -> db_Delete("seo_spiderlog", "spider_id='".$import."'")) ? "<div class='success'>Log Id $import ".LAN_DELETED."</div>" : "<div class='error'>Log Id $import ".LAN_DELETED_FAILED."</div>";
				$message .= "<br />";
			}	
			return $message;
	}
	
	function deletespiderall() {
		global $sql;
		$message = ($sql->db_Delete('seo_spiderlog')) ? "<div class='success'>All entries was ".LAN_DELETED."</div>" : "<div class='error'>All entries was ".LAN_DELETED_FAILED."</div>";
		return $message;
	}
	
	function deletekeywords() {
		global $sql;
			foreach($_POST['keyword_id'] as $import)
			{
				//$message .= "Log id $import ";
				$message .= ($sql -> db_Delete("seo_keywords", "keyword_id='".$import."'")) ? "<div class='success'>Log Id $import ".LAN_DELETED."</div>" : "<div class='error'>Log Id $import ".LAN_DELETED_FAILED."</div>";
				$message .= "<br />";
			}	
			return $message;
	}	

	function update_htaccess() {
		if (file_exists(e_BASE."/.htaccess")) {
			$htaccess_file = e_BASE."/.htaccess";
			$htaccessnew = stripslashes($_POST['htaccessnew']);
			if (is_writeable($htaccess_file)) {
				$f = fopen($htaccess_file, 'w+');
				fwrite($f, $htaccessnew);
				fclose($f);
				$message = "<div class='success'><h2>".SEOPACK_MENU_L53 . LAN_UPDATED."</h2></div>";
			}
			else 
				$message = "<div class='error'><h2>".SEOPACK_MENU_L53 . LAN_UPDATED_FAILED."</h2></div>";
		} 
		return $message;
	}

	function update_robot() {
		if (file_exists(e_BASE."/robots.txt")) {
			$robots_file = e_BASE."/robots.txt";
			$robotsnew = stripslashes($_POST['robotstxtcontent']);
			if (is_writable($robots_file)) {
				$f = fopen($robots_file, 'w+');
				fwrite($f, $robotsnew);
				fclose($f);
				$message = "<div class='success'><h2>".SEOPACK_MENU_L52 . LAN_UPDATED."</h2></div>";
			}
			else 
				$message = "<div class='error'><h2>".SEOPACK_MENU_L52 . LAN_UPDATED_FAILED."</h2></div>";
		} 
		return $message;
	}

	function getDefault_seopack() {
		global $sql, $eArrayStorage;
			$seopack_pref = getDefault_seopackPrefs();
			$tmp = $eArrayStorage->WriteArray($seopack_pref);
			$sql -> db_Update("core", "e107_value='$tmp' WHERE e107_name='seopack_prefs' ");
			$message = "<div class='success'><h2>".SEOPACK_MENU_L8."</h2>";
			$message .= "<p>".SEOPACK_MENU_TITLE . LAN_ENABLED."</p></div>";
			return $message;
	}

	function update_seopackPrefs() {
		global $sql, $eArrayStorage, $tp; 
		
		
			foreach (array(	'seopack_active', 'seopack_prevnextnews', 'seopack_generator',
							'indexfollow','spideractive','keywordsactive','keywordsnews',
							'search', 'logininput', 'admin', 'noodp', 'noydir', 'noarchive') 
				as $option_name) {
				if (isset($_POST[$option_name])) {
					$seopack_pref[$option_name] = true;
				} else {
					$seopack_pref[$option_name] = false;
				}
			}

			foreach (array('googleverify', 'msverify', 'seopack_distribution', 'seopack_author', 'spiderlist' ) as $option_name) {
				if (isset($_POST[$option_name])) {
					$seopack_pref[$option_name] = $tp->toDB($_POST[$option_name]);
				}
			}
			
		$tmp = $eArrayStorage->WriteArray($seopack_pref);
		$sql -> db_Update("core", "e107_value='$tmp' WHERE e107_name='seopack_prefs' ");
		
		if($seopack_pref['seopack_active'] == 1){$div_style="success";}else if($seopack_pref['seopack_active'] == 0){$div_style="error";}
			
			$message = "<div class='".$div_style."'><h2>".SEOPACK_MENU_L8."</h2>";
		if($seopack_pref['seopack_active'] == 1){
			$message .= "<p>".SEOPACK_MENU_TITLE . LAN_ENABLED."</p></div>";
		}else if($seopack_pref['seopack_active'] == 0){
			$message .= "<p>".SEOPACK_MENU_TITLE . LAN_DISABLED. "</p></div>";
			}

		return $message;

	}	
	
	function get_search_keywords($url = '')	{
		global $sql ;
		// Get the referrer
		$referrer = (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';
		$referrer = (!empty($url)) ? $url : $referrer;
		if (empty($referrer))
			return false;

		// Parse the referrer URL
		$parsed_url = parse_url($referrer);
		if (empty($parsed_url['host']))
			return false;
		$host = $parsed_url['host'];
		$query_str = (!empty($parsed_url['query'])) ? $parsed_url['query'] : '';
		$query_str = (empty($query_str) && !empty($parsed_url['fragment'])) ? $parsed_url['fragment'] : $query_str;
		if (empty($query_str))
			return false;

		// Parse the query string into a query array
		parse_str($query_str, $query);
		if (e_QUERY) 
			{
				$tmp = explode('.', e_QUERY);
			}
		// Check some major search engines to get the correct query var
		$search_engines = array(
			'q' => 'alltheweb|aol|ask|bing|google',
			'p' => 'yahoo',
			'wd' => 'baidu',
			'text' => 'yandex'
		);
		foreach ($search_engines as $query_var => $se)
		{
		
			$date	= time();
			$se = trim($se);
			
			preg_match('/(' . $se . ')\./', $host, $matches);
			//echo e_PAGE ;
			if (!empty($matches[1]) && !empty($query[$query_var])) {
				$message = ($sql -> db_Insert("seo_keywords", "'', '$tmp[1]', '".e_PAGE."', '$query[$query_var]', '$date', '$matches[1]'")) ? LAN_CREATED : LAN_CREATED_FAILED;
				//echo $message ;
				return $query[$query_var];				
			}	
		}
		return false;
	}

	function spiderlog($url = '') {
		global $sql , $seopack_pref;
		// Get the user agent	
		$useragent	= (!empty($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : ''; 
		$useragent = (!empty($url)) ? $url : $useragent;
		if (empty($useragent))
			return false;

		$host 	= getip(); // IP of spider
		$today	= time(); // Todays Date
		//echo $seopack_pref['spiderlist'];
		$spider_chk = explode(",", $seopack_pref['spiderlist']);

		while(list($key, $logspider) = each($spider_chk))
		{
					if(eregi($logspider, $useragent)) 
					{
							$url = "http://".$_SERVER['SERVER_NAME'].urldecode($_SERVER['REQUEST_URI']);
							//$message = ($sql -> db_Insert("spiderlog", "'', '$url', '$today', '$useragent', '$host'")) ? LAN_CREATED : LAN_CREATED_FAILED;
							$sql -> db_Insert("seo_spiderlog", "'', '$url', '$today', '$useragent', '$host'");
					}
		}			
	}

	function meta()	{
		global $seopack_pref, $finalmeta;
		$finalmeta = '';
		if ($seopack_pref['seopack_distribution'])
			$finalmeta .=  '<meta name="distribution" content="'.$seopack_pref['seopack_distribution'].'" />'."\n";

		if ($seopack_pref['seopack_generator'])
			$finalmeta .=  '<meta name="generator" content="e107" />'."\n";	
			
		if ($seopack_pref['seopack_author'])	
			$finalmeta .=  '<link rel="author" href="'.$seopack_pref['seopack_author'].'" />'."\n";

		if ($seopack_pref['googleverify'])	
			$finalmeta .=  '<meta name="google-site-verification" content="'.$seopack_pref['googleverify'].'" />'."\n";
			
		if ($seopack_pref['msverify'])	
			$finalmeta .=  '<meta name="msvalidate.01" content="'.$seopack_pref['msverify'].'" />'."\n";

		if (defined('ADMIN_PAGE') && $seopack_pref['admin'] || e_PAGE == 'login.php' && $seopack_pref['logininput'] || e_PAGE == 'signup.php' && $seopack_pref['logininput'])	
			$finalmeta .=  '<meta name="robots" content="noindex" />'."\n";	
			
			$meta = "";	
			if (!defined('ADMIN_PAGE') && !$seopack_pref['indexfollow'] )
				$meta = "";	
			else 
				$meta = "index,follow";	
			
			if (e_PAGE == 'search.php' && $seopack_pref['search']) 
				$meta = "noindex,follow";

			if ($seopack_pref['noodp']) {
				if ($meta != "") {
					$meta .= ",";
				}
				$meta .= "noodp";
			} 
			if ($seopack_pref['noydir']) {
				if ($meta != "") {
					$meta .= ",";
				}
				$meta .= "noydir";
			}

			if ($meta != "") {
				$finalmeta .= '<meta name="robots" content="'.$meta.'" />'."\n";
			}
	return $finalmeta;
	echo "111 ". $finalmeta ;	
	}			
	
	function jscss() {	
		$js ="";
		if ($_SERVER['PHP_SELF'] == e_PLUGIN_ABS."seopack/admin_conf.php" ) 
		{
			if ( !defined('JQUERY') ) 
			{
				define('JQUERY','<script src="http://code.jquery.com/jquery-latest.js"></script>');
				$js .= JQUERY;	
			}	
			$js .= "
			<link rel='stylesheet' href='".e_PLUGIN_ABS. "seopack/css.css' type='text/css' />
			<script type='text/javascript' src='".e_PLUGIN_ABS."seopack/js/check.js'></script>
			<script type='text/javascript' src='".e_PLUGIN_ABS."seopack/js/jquery.idTabs.js'></script>
			";	
		}
		return $js;
	}

	function nextprev()	{
		global $prev_news, $next_news , $seopack_pref;
		if ($seopack_pref['seopack_prevnextnews']){
			if ($prev_news)
				$prev = "<link rel='prev' title='".$prev_news['news_title']."' href='".e_SELF."?extend.".$prev_news['news_id']."' />\n";

			if ($next_news)
				$next = "<link rel='next' title='".$next_news['news_title']."' href='".e_SELF."?extend.".$next_news['news_id']."' />\n";
		}	
		return $prev . $next ;
	}
	
	function showcssadmin()	{	
				return "<link rel='stylesheet' href='".e_PLUGIN_ABS. "seopack/css.css' type='text/css' />\n";	
	}
	
	function showkeywords () {
		global $sql , $NEWSSTYLE ;
		if (e_QUERY) 
			{
				$tmp = explode('.', e_QUERY);
			}
			
		if($sql -> db_Select("seo_keywords",  "*", "keyword_type ='".e_PAGE."' AND keyword_page ='".$tmp[1]."' ") )
				$NEWSSTYLE .= SEOPACK_MENU_L34 . " : <br />";
			while ($row = $sql-> db_Fetch()) 
			{
				extract($row);
				$NEWSSTYLE .= " - <a href='http://".$_SERVER['SERVER_NAME'].urldecode($_SERVER['REQUEST_URI'])."'>".$keyword_keywords."</a><br />" ;
				// echo $keyword_keywords . $keyword_page ;
				
			}
		return $NEWSSTYLE;
	}
}
?>