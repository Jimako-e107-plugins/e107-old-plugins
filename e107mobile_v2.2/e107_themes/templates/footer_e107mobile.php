<?php
/*
* e107 website system
*
* Copyright 2001-2010 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* Default footer for user pages
*
* $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_themes/templates/footer_default.php $
* $Id: footer_default.php 11753 2010-09-06 20:59:15Z e107coders $
*
*/

if (!defined('e107_INIT')) { exit; }
$In_e107_Footer = TRUE;	// For registered shutdown function

// simple SESSION Fixation
	if(!session_id()) // someone closed the session?
	{
		session_start(); // restart
	}
	
	// regenerate SID
	$oldSID = session_id(); // old SID
	$oldSData = $_SESSION; // old session data
	session_regenerate_id(false); // true don't work on php4 - so time to move on people!	
	$newSID = session_id(); // new SID
	
	// Clean
	session_id($oldSID); // switch to the old session
	session_destroy(); // destroy it
	
	// set new ID, reopen the session, set saved data
	session_id($newSID);
	session_start();
	$_SESSION = $oldSData;
	// give 3rd party code a way to prevent token re-generation
	if(!defsettrue('e_TOKEN_FREEZE'))
	{
		$_SESSION['regenerate_'.e_TOKEN_NAME] = time(); // class2 have to re-create token on the next request
	}
	unset($oldSID, $newSID, $oldSData);
	
	// write session data
	session_write_close();
// SESSION End

global $eTraffic, $error_handler, $db_time, $sql, $sql2, $mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb, $CUSTOMFOOTER, $FOOTER, $e107, $e107ParseHeaderFlag, $e107CustomFooter;
global $pref;
//
// SHUTDOWN SEQUENCE
//
// The following items have been carefully designed so page processing will finish properly
// Please DO NOT re-order these items without asking first! You WILL break something ;)
// These letters match the USER footer (that's why there may be B.1,B.2)
//
// A Ensure sql and traffic objects exist
// [Next few ONLY if a regular page; not done for popups]
// B Send the footer templated data
// C Dump any/all traffic and debug information
// [end of regular-page-only items]
// D Close the database connection
// E Themed footer code
// F Configured footer scripts
// G Browser-Server time sync script (must be the last one generated/sent)
// H Final HTML (/body, /html)
// I collect and send buffered page, along with needed headers
//

//
// A Ensure sql and traffic objects exist
//

if(!is_object($sql)){
	// reinstigate db connection if another connection from third-party script closed it ...
	$sql = new db;
	$sql -> db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);
}
if (!is_object($eTraffic)) {
	$eTraffic = new e107_traffic;
	$eTraffic->Bump('Lost Traffic Counters');
}

unset($fh);


if(varset($e107_popup)!=1){
	//
	// B Send footer template
	//
	parseheader(($e107ParseHeaderFlag ? $e107CustomFooter : $FOOTER));

	//
	// C Dump all debug and traffic information
	//
	$eTimingStop = microtime();
	global $eTimingStart;
	$rendertime = number_format($eTraffic->TimeDelta( $eTimingStart, $eTimingStop ), 4);
	$db_time    = number_format($db_time,4);
	$rinfo = '';

	if($pref['displayrendertime']){ $rinfo .= CORE_LAN11.$rendertime.CORE_LAN12.$db_time.CORE_LAN13; }
	if($pref['displaysql']){ $rinfo .= CORE_LAN15.$sql -> db_QueryCount().". "; }
	if(isset($pref['display_memory_usage']) && $pref['display_memory_usage']){ $rinfo .= CORE_LAN16.$e107->get_memory_usage(); }
	if(isset($pref['displaycacheinfo']) && $pref['displaycacheinfo']){ $rinfo .= $cachestring."."; }
	echo ($rinfo ? "\n<div style='text-align:center' class='smalltext'>{$rinfo}</div>\n" : "");


	if ((ADMIN || $pref['developer']) && E107_DEBUG_LEVEL) {
		global $db_debug;
		echo "\n<!-- DEBUG -->\n";
		$db_debug->Show_All();
	}

	/*
	changes by jalist 24/01/2005:
	show sql queries
	usage: add ?showsql to query string, must be admin
	*/

	if(ADMIN && isset($queryinfo) && is_array($queryinfo))
	{
		$c=1;
		$mySQLInfo = $sql->mySQLinfo;
		echo "<table class='fborder' style='width: 100%;'>
		<tr>
		<td class='fcaption' style='width: 5%;'>ID</td><td class='fcaption' style='width: 95%;'>SQL Queries</td>\n</tr>\n";
		foreach ($queryinfo as $infovalue)
		{
			echo "<tr>\n<td class='forumheader3' style='width: 5%;'>{$c}</td><td class='forumheader3' style='width: 95%;'>{$infovalue}</td>\n</tr>\n";
			$c++;
		}
		echo "</table>";
	}

} // End of regular-page footer (the above NOT done for popups)

//
// D Close DB connection. We're done talking to underlying MySQL
//
	$sql -> db_Close();  // Only one is needed; the db is only connected once even with several $sql objects

	//
	// Just before we quit: dump quick timer if there is any
	// Works any time we get this far. Not calibrated, but it is quick and simple to use.
	// To use: eQTimeOn(); eQTimeOff();
	//
	$tmp = eQTimeElapsed();
	if (strlen($tmp)) {
		global $ns;
		$ns->tablerender('Quick Admin Timer',"Results: {$tmp} microseconds");
	}

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

if((ADMIN == true || $pref['developer']) && count($error_handler->errors) && $error_handler->debug == true) 
{
	echo "
	<div class='e107_debug php_err block-text'>
		<h3>PHP Errors:</h3><br />
		".$error_handler->return_errors()."
	</div>
	";
}

//
// E Last themed footer code, usually JS
//
if (function_exists('theme_foot'))
{
   	echo theme_foot();
}

//
// F any included JS footer scripts
//
global $footer_js;
if(isset($footer_js) && is_array($footer_js))
{
	$footer_js = array_unique($footer_js);
	foreach($footer_js as $fname)
	{
		echo "<script type='text/javascript' src='{$fname}'></script>\n";
		$js_included[] = $fname;
	}
}

//
// G final JS script keeps user and server time in sync.
//   It must be the last thing created before sending the page to the user.
//
// see e107.js and class2.php
// This must be done as late as possible in page processing.
$_serverTime=time();
$lastSet = isset($_COOKIE['e107_tdSetTime']) ? $_COOKIE['e107_tdSetTime'] : 0;
if (abs($_serverTime - $lastSet) > 120) {
	/* update time delay every couple of minutes.
	* Benefit: account for user time corrections and changes in internet delays
	* Drawback: each update may cause all server times to display a bit different
	*/
	echo "<script type='text/javascript'>\n";
	echo "SyncWithServerTime('{$_serverTime}');
       </script>\n";
}

//
// H Final HTML
//
echo "</body></html>";

//
// I Send the buffered page data, along with appropriate headers
//
$page = ob_get_clean();

$etag = md5($page);

if (isset($_SERVER['HTTP_IF_NONE_MATCH']))
{
	$IF_NONE_MATCH = str_replace('"','',$_SERVER['HTTP_IF_NONE_MATCH']);
	/*
	$data = "IF_NON_MATCH = ".$IF_NONE_MATCH;
	$data .= "\nEtag = ".$etag;
	file_put_contents(e_THEME."templates/etag_log.txt",$data);
	*/
	
	if($IF_NONE_MATCH == $etag || ($IF_NONE_MATCH == ($etag."-gzip")))
	{
		header('HTTP/1.1 304 Not Modified');
		exit();	
	}
}

$pref['compression_level'] = 6;
$browser_support = FALSE;
$server_support = FALSE;
if(strstr(varset($_SERVER["HTTP_ACCEPT_ENCODING"],""), "gzip")) 
{
	$browser_support = true;
}
if(ini_get("zlib.output_compression") == '' && function_exists("gzencode")) 
{
	$server_support = true;
}
if(varset($pref['compress_output'],false) && $server_support == true && $browser_support == true) 
{
	$level = intval($pref['compression_level']);
	header("ETag: \"{$etag}-gzip\"");
	$page = gzencode($page, $level);
	header("Content-Encoding: gzip", true);
	header("Content-Length: ".strlen($page), true);
	echo $page;
} 
else 
{
	if($browser_support==TRUE) 
	{
		header("ETag: \"{$etag}-gzip\"");	
	}
	else
	{
		header("ETag: \"{$etag}\"");	
	}
	
	header("Content-Length: ".strlen($page), true);
	echo $page;
}

unset($In_e107_Footer);
$e107_Clean_Exit=TRUE;	// For registered shutdown function -- let it know all is well!
?>