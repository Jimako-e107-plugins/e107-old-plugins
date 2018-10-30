<?php if (!defined('e107_INIT')) { exit; } ?>
</body>
</html>
<?php
//debug and traffic info
$eTimingStop = microtime();
global $eTimingStart;
$rendertime = number_format($eTraffic->TimeDelta( $eTimingStart, $eTimingStop ), 4);
$db_time    = number_format($db_time,4);
$rinfo = '';
    if ((ADMIN || $pref['developer']) && E107_DEBUG_LEVEL) {
    	if($pref['displayrendertime']){ $rinfo .= "Render time: {$rendertime} second(s); {$db_time} of that for queries. "; }
    	if($pref['displaysql']){ $rinfo .= "DB queries: ".$sql -> db_QueryCount().". "; }
    	if(isset($pref['display_memory_usage']) && $pref['display_memory_usage']){ $rinfo .= "Memory Usage: ".$e107->get_memory_usage(); }
    	if(isset($pref['displaycacheinfo']) && $pref['displaycacheinfo']){ $rinfo .= $cachestring."."; }
    	echo ($rinfo ? "\n<div style='text-align:center' class='smalltext'>{$rinfo}</div>\n" : "");

    
    	global $db_debug;
    	echo "\n<!-- DEBUG -->\n";
    	$db_debug->Show_All();
    }

$sql -> db_Close();

if ($pref['developer']) {
	global $oblev_at_start,$oblev_before_start;
	if (ob_get_level() != $oblev_at_start) {
		$oblev = ob_get_level();
		$obdbg = "<div style='text-align:center' class='smalltext'>Software defect detected; ob_*() level {$oblev} at end instead of ($oblev_at_start). POPPING EXTRA BUFFERS!</div>";
		while (ob_get_level() > $oblev_at_start) {
			ob_end_flush();
		}
		echo $obdbg;
	}
	// 061109 PHP 5 has a bug such that the starting level might be zero or one.
	// Until they work that out, we'll disable this message.
	// Devs can re-enable for testing as needed.
	//
	if (0 && $oblev_before_start != 0) {
		$obdbg = "<div style='text-align:center' class='smalltext'>Software warning; ob_*() level {$oblev_before_start} at start; this page not properly integrated into its wrapper.</div>";
		echo $obdbg;
	}
}

if((ADMIN == true || $pref['developer']) && $error_handler->debug == true) {
	echo "
	<br /><br />
	<div>
		<h3>PHP Errors:</h3><br />
		".$error_handler->return_errors()."
	</div>
	";
}

//qick time counter
	$tmp = eQTimeElapsed();
	if (strlen($tmp)) {
		global $ns;
		$ns->tablerender('Quick Admin Timer',"Results: {$tmp} microseconds");
	}
	
$page = ob_get_clean();

$etag = md5($page);
header("Cache-Control: must-revalidate");
header("ETag: {$etag}");

$pref['compression_level'] = 6;
if(strstr(varset($_SERVER["HTTP_ACCEPT_ENCODING"],""), "gzip")) {
	$browser_support = true;
}
if(ini_get("zlib.output_compression") == false && function_exists("gzencode")) {
	$server_support = true;
}
if(varset($pref['compress_output'],false) && $server_support == true && $browser_support == true) {
	$level = intval($pref['compression_level']);
	$page = gzencode($page, $level);
	header("Content-Encoding: gzip", true);
	header("Content-Length: ".strlen($page), true);
	echo $page;
} else {
	header("Content-Length: ".strlen($page), true);
	echo $page;
}
?>